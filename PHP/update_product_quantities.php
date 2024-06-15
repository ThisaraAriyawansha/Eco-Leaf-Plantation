<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT item_name, item_quantity
                        FROM orders");

while ($row = $result->fetch_assoc()) {
    $productName = $row['item_name'];
    $orderedQuantity = $row['item_quantity'];

    $conn->query("UPDATE product SET quantity = quantity - $orderedQuantity WHERE pname = '$productName'");
}

$conn->close();
?>
