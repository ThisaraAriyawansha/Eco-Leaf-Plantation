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

// Retrieve the product name from the AJAX request
$productName = $_POST['productName'];

// Query the database to get the quantity
$sql = "SELECT quantity FROM product WHERE pname = '$productName'";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Product found, send the quantity as JSON response
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];

        // Retrieve the requested quantity from the AJAX request
        $requestedQuantity = intval($_POST['requestedQuantity']);

        if ($requestedQuantity > $quantity) {
            // Requested quantity exceeds available quantity
            echo json_encode(['success' => false, 'message' => 'Requested quantity exceeds available quantity']);
        } else {
            echo json_encode(['success' => true, 'quantity' => $quantity]);
        }
    } else {
        // Product not found
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }
} else {
    // Handle database query error
    echo json_encode(['success' => false, 'message' => 'Database query error']);
}

$conn->close();
?>
