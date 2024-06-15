<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input data from the POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Always use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM customer WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // User exists, perform your logic here

    // Now, let's insert the data into the templogin table
    $insertStmt = $conn->prepare("INSERT INTO templogin (username, password) VALUES (?, ?)");
    $insertStmt->bind_param("ss", $username, $password);
    $insertStmt->execute();
    $insertStmt->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
