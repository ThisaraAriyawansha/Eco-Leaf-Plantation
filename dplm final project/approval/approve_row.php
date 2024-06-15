\<?php
// Your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "plantation";
$table_name = "contract";
$approve_table_name = "approve";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the row ID from the request
$rowId = $_GET['id'];

// Perform the approval logic (you may want to update the status or perform other actions)
$sql = "UPDATE $table_name SET status = 'approved' WHERE id = $rowId";
if ($conn->query($sql) === TRUE) {
    // Insert the ID into the approve table
    $approve_sql = "INSERT INTO $approve_table_name (approve_id) VALUES ($rowId)";
    $conn->query($approve_sql);

    // Close the database connection
    $conn->close();

    // Redirect to the page where the approve button was clicked
    
} else {
    // Error in approval
    echo "Error: " . $sql . "<br>" . $conn->error;
    // Handle the error as needed
}

?>
