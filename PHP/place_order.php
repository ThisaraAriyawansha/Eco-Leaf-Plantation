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
    $total = $_POST['total'];
    $email = $_POST['email'];

    $sql = "INSERT INTO final_order (email, total, order_date) VALUES ('$email', $total, NOW())";

    if ($conn->query($sql) === TRUE) {
        echo 'Order placed successfully.';
    } else {
        echo "Error placing order: " . $conn->error;
    }
} else {
    echo "Error clearing order_totals table: " . $conn->error;
}

$conn->close();
?>
