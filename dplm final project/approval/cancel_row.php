<?php
// Your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "plantation";
$table_name = "contract";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the row ID from the request
$rowId = $_GET['id'];

// Perform the cancellation logic (you may want to delete the row or perform other actions)
$sql = "DELETE FROM $table_name WHERE id = $rowId";
$conn->query($sql);

// Close the database connection
$conn->close();
?>
