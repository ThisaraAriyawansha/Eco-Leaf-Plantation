<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "plantation";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM manager WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Admin credentials are valid
    $response['success'] = true;
} else {
    // Invalid credentials
    $response['success'] = false;
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
