<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM orders";
if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error clearing orders table: " . $conn->error;
}

$conn->close();
?>
