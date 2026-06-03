<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$status_message = "";

$query = $conn->query("SELECT * FROM customer_tbl WHERE customer_id = '$user_id' LIMIT 1");
$user = $query->fetch_assoc();

$orders_query = $conn->query("SELECT * FROM order_tbl WHERE customer_id = '$user_id' ORDER BY order_date DESC");

$bookings_query = $conn->query("
    SELECT cb.*, c.cat_name 
    FROM catbooking_tbl cb 
    LEFT JOIN cat_tbl c ON cb.cat_id = c.cat_id 
    WHERE cb.customer_id = '$user_id' 
    ORDER BY cb.booking_date DESC
");

if (!$user) {
    echo "Account record data trace missing.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname   = $conn->real_escape_string(trim($_POST['Fname']));
    $mname   = $conn->real_escape_string(trim($_POST['Mname']));
    $lname   = $conn->real_escape_string(trim($_POST['Lname']));
    $contact = $conn->real_escape_string(trim($_POST['contact']));

$update_sql = "UPDATE customer_tbl SET Fname='$fname', Mname='$mname', Lname='$lname', contact='$contact' WHERE customer_id='$user_id'";    
    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['user_fname'] = $fname;
        $status_message = "<div class='alert alert-success d-flex align-items-center gap-2 small rounded-3'><i class='bi bi-check-circle-fill'></i> Profile updated successfully!</div>";
        
        $user['Fname'] = $fname;
        $user['Mname'] = $mname;
        $user['Lname'] = $lname;
        $user['contact'] = $contact;
    } else {
        $status_message = "<div class='alert alert-danger small rounded-3'>Error updating dashboard metadata: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Cat Cafe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght=0,400..900;1,400..900&family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    
</head>

<body class="py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="mb-4">
                    <a href="index.php" class="btn-back d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i> Return to Cafe Lounge
                    </a>
                </div>

                <div class="card profile-card">
                    
                    <div class="profile-header-banner d-flex flex-column flex-sm-row align-items-center gap-4 text-center text-sm-start">
                        <div class="avatar-circle shadow-sm">
                            <?php echo strtoupper(substr($user['Fname'], 0, 1)); ?>
                        </div>
                        <div>
                            <div class="h1 h3 fw-bold mb-1">Account Workspace</div>
                            <div class="p mb-0 text-white-50 small">Manage your contact definitions and internal preferences</div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-sm-5 bg-white">
                        
                        <?php echo $status_message; ?>

                        <form action="profile.php" method="POST" autocomplete="off">
                            
                            <div class="h3 h5 fw-bold text-dark mb-4 pb-2 border-bottom opacity-75">Personal Details</div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-3" id="fName" name="Fname" value="<?php echo htmlspecialchars($user['Fname']); ?>" placeholder="First Name" required>
                                        <label for="fName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-3" id="mName" name="Mname" value="<?php echo htmlspecialchars($user['Mname']); ?>" placeholder="Middle Name">
                                        <label for="mName">Middle Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-3" id="lName" name="Lname" value="<?php echo htmlspecialchars($user['Lname']); ?>" placeholder="Last Name" required>
                                        <label for="lName">Last Name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="h3 h5 fw-bold text-dark mb-4 pb-2 border-bottom opacity-75">Contact Credentials</div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" placeholder="Contact Number" required>
                                <label for="contact">Contact Number</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control rounded-3 bg-light text-muted" id="emailAddress" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email Address" readonly style="cursor: not-allowed;">
                                <label for="emailAddress">Email Address (Cannot be modified)</label>
                            </div>

                            <div class="d-flex justify-content-end pt-2">
                                <button type="submit" class="btn btn-save shadow-sm d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-person-check-fill"></i> Save Updates
                                </button>
                            </div>

                            <hr class="my-5">


                        </form>

                        <hr class="my-5 border-secondary">

                        <div class="h4 h5 fw-bold text-dark mb-4">Activity Dashboard</div>

<ul class="nav nav-tabs" id="profileTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#orders" type="button">My Orders</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bookings" type="button">Cat Bookings</button>
    </li>
</ul>

<div class="tab-content pt-4">
    <div class="tab-pane fade show active" id="orders">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr><th>Order ID</th><th>Date</th><th>Total</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php if ($orders_query->num_rows > 0): ?>
                        <?php while($row = $orders_query->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td><span class="badge bg-success"><?php echo htmlspecialchars($row['status']); ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted">No orders placed yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="bookings">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr><th>Booking ID</th><th>Cat Name</th><th>Date</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php if ($bookings_query->num_rows > 0): ?>
                        <?php while($row = $bookings_query->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $row['booking_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['cat_name']); ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><span class="badge bg-info"><?php echo htmlspecialchars($row['status']); ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted">No cat bookings yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>