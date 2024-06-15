<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve order details and total from the client-side
$orderDetails = json_decode($_POST['orderDetails'], true);
$total = floatval($_POST['total']);

// Insert order details into the 'orders' table
foreach ($orderDetails as $item) {
    $itemName = $item['name'];
    $itemPrice = $item['price'];
    $itemQuantity = $item['quantity'];

    $sql = "INSERT INTO orders (item_name, item_price, item_quantity) VALUES ('$itemName', $itemPrice, $itemQuantity)";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit(); // Exit script if there's an error
    }
}

// Insert total into the 'order_totals' table
$sqlTotal = "INSERT INTO order_totals (total) VALUES ($total)";

if ($conn->query($sqlTotal) !== TRUE) {
    echo "Error: " . $sqlTotal . "<br>" . $conn->error;
    exit(); // Exit script if there's an error
}

// Return a success message to the client-side
echo "Order placed successfully";

$conn->close();
?>
