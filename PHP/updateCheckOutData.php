<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$qrCodeNumber = $_POST['qrCodeNumber']; 

$sql = "INSERT INTO vehiclecheckinout (vehicle_number, checkin_time,checkout_time) VALUES ('$qrCodeNumber', '',NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Check-In successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
