<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM order_totals";
if ($conn->query($sql) === TRUE) {
    echo "order_totals table cleared successfully";
} else {
    echo "Error clearing order_totals table: " . $conn->error;
}

$conn->close();
?>
