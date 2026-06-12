<?php
header('Content-Type: application/json');
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['customer_id'], $input['delivery'], $input['cart_items'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required data parameters.']);
    exit();
}

$customer_id    = intval($input['customer_id']);
$cart_items     = $input['cart_items'];
$address        = trim($input['delivery']['address']);
$recipient      = trim($input['delivery']['recipient']);
$contact_number = intval($input['delivery']['contact']); 
$payment_method = trim($input['delivery']['payment']);

if (empty($cart_items)) {
    echo json_encode(['success' => false, 'message' => 'Cannot process an empty cart.']);
    exit();
}

try {
    mysqli_begin_transaction($conn);

    $total_amount = 0.00;
    foreach ($cart_items as $item) {
        $price = floatval($item['price']);
        $qty = intval($item['quantity']);
        $total_amount += ($price * $qty);
    }

    $order_type   = 'Delivery';
    $order_date   = date('Y-m-d');
    $order_status = 'Pending';

    $order_query = "INSERT INTO order_tbl (customer_id, order_type, order_date, total_amount, order_status) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt, "issds", $customer_id, $order_type, $order_date, $total_amount, $order_status);
    
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Master order log creation aborted: " . mysqli_stmt_error($stmt));
    }
    $order_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    $details_query = "INSERT INTO orderdetails_tbl (order_id, item_id, quantity, sub_total) VALUES (?, ?, ?, ?)";
    $d_stmt = mysqli_prepare($conn, $details_query);

    foreach ($cart_items as $item) {
        $item_id   = intval($item['id']);
        $quantity  = intval($item['quantity']);
        $sub_total = intval(floatval($item['price']) * $quantity);

        mysqli_stmt_bind_param($d_stmt, "iiii", $order_id, $item_id, $quantity, $sub_total);
        if (!mysqli_stmt_execute($d_stmt)) {
            throw new Exception("Line breakdown item entry execution failure: " . mysqli_stmt_error($d_stmt));
        }
    }
    mysqli_stmt_close($d_stmt);

    $paypal_details    = isset($input['delivery']['paypal_details']) ? $input['delivery']['paypal_details'] : null;
    $db_payment_method = ($payment_method === 'Online' && $paypal_details !== null) ? 'PayPal' : 'Cash';
    $payment_status    = ($db_payment_method === 'PayPal') ? 'Completed' : 'Pending';

    $payment_query = "INSERT INTO payment_tbl (order_id, customer_id, payment_method, amount, payment_status) VALUES (?, ?, ?, ?, ?)";
    $p_stmt = mysqli_prepare($conn, $payment_query);
    mysqli_stmt_bind_param($p_stmt, "iisds", $order_id, $customer_id, $db_payment_method, $total_amount, $payment_status);

    if (!mysqli_stmt_execute($p_stmt)) {
        throw new Exception("Billing payment ledger registration failed: " . mysqli_stmt_error($p_stmt));
    }
    mysqli_stmt_close($p_stmt);

    $delivery_status = 'Pending';
    $delivery_query = "INSERT INTO delivery_tbl (customer_id, delivery_address, recipient_name, contact_number, delivery_status) VALUES (?, ?, ?, ?, ?)";
    $del_stmt = mysqli_prepare($conn, $delivery_query);
    mysqli_stmt_bind_param($del_stmt, "issss", $customer_id, $address, $recipient, $contact_number, $delivery_status);

    if (!mysqli_stmt_execute($del_stmt)) {
        throw new Exception("Logistics manifest instantiation failed: " . mysqli_stmt_error($del_stmt));
    }
    mysqli_stmt_close($del_stmt);

    mysqli_commit($conn);

    echo json_encode([
        'success' => true,
        'message' => 'Complete customer order and transaction states written to tables successfully!',
        'order_id' => $order_id
    ]);

} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>