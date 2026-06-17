<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "abc123456", 
    "cafe_db"
);

if (!$conn) {
    die("Connection Failed");
}

?>