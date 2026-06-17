<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['user_id'])) die("Unauthorized");

$type = $_GET['type'] ?? ''; // 'order' or 'booking'
$id = (int)($_GET['id'] ?? 0);
$user_id = (int)$_SESSION['user_id'];

if ($type === 'order') {
    $conn->query("UPDATE order_tbl SET order_status='Cancelled' WHERE order_id='$id' AND customer_id='$user_id'");
} elseif ($type === 'booking') {
    $conn->query("UPDATE catbooking_tbl SET booking_status='Cancelled' WHERE booking_id='$id' AND customer_id='$user_id'");
}

header("Location: profile.php?msg=cancelled");