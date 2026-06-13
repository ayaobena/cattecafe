<?php
require_once 'config.php';

date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

$inputData = json_decode(file_get_contents('php://input'), true);

if (!empty($inputData['seatingarea_id'])) {
    $customer_id = $_SESSION['user_id']; 
    $seatingarea_id = intval($inputData['seatingarea_id']);
    $cat_ids = isset($inputData['cat_ids']) && is_array($inputData['cat_ids']) ? $inputData['cat_ids'] : [1]; 
    
    $booking_date = date('Y-m-d');
    $booking_time = date('H:i:s');
    $booking_status = 'Pending';

    mysqli_begin_transaction($conn);

    try {
        $query_area = "INSERT INTO `areabooking_tbl` (`customer_id`, `seatingarea_id`, `booking_date`, `booking_time`, `booking_status_`) 
                       VALUES (?, ?, ?, ?, ?)";
        $stmt_area = mysqli_prepare($conn, $query_area);
        mysqli_stmt_bind_param($stmt_area, "iisss", $customer_id, $seatingarea_id, $booking_date, $booking_time, $booking_status);
        mysqli_stmt_execute($stmt_area);
        
        $new_areabooking_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt_area);

        $query_update = "UPDATE `seatingarea_tbl` SET `status` = 'Occupied' WHERE `seatingarea_id` = ?";
        $stmt_update = mysqli_prepare($conn, $query_update);
        mysqli_stmt_bind_param($stmt_update, "i", $seatingarea_id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        $query_cat = "INSERT INTO `catbooking_tbl` (`customer_id`, `cat_id`, `areabooking_id`, `booking_date`, `booking_time`, `booking_status`) 
                      VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_cat = mysqli_prepare($conn, $query_cat);
        
        foreach ($cat_ids as $cat_id) {
            $current_cat_id = intval($cat_id);
            mysqli_stmt_bind_param($stmt_cat, "iiisss", $customer_id, $current_cat_id, $new_areabooking_id, $booking_date, $booking_time, $booking_status);
            mysqli_stmt_execute($stmt_cat);
        }
        mysqli_stmt_close($stmt_cat);

        mysqli_commit($conn);
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => 'Transaction Failure: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing seatingarea_id.']);
}

mysqli_close($conn);
?>