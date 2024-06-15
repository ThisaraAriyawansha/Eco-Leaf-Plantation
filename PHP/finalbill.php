<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tempUserResult = $conn->query("SELECT username, password
FROM templogin
WHERE loginid = (SELECT MAX(loginid) FROM templogin);
");

if (!$tempUserResult) {
    die("Query failed: " . $conn->error);
}

$tempUserData = $tempUserResult->fetch_assoc();

$tempUserResult->close();

if ($tempUserData) {
    $customerResult = $conn->query("SELECT username, email FROM customer WHERE username = '{$tempUserData['username']}' AND password = '{$tempUserData['password']}'");

    if (!$customerResult) {
        die("Query failed: " . $conn->error);
    }

    $customerData = $customerResult->fetch_assoc();

    $customerResult->close();

    if ($customerData) {
        $finalUsername = $customerData['username'];
        $finalEmail = $customerData['email'];
    } else {
        echo "User not found in the customer table.";
    }
} else {
    echo "Temporary user not found.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        emailjs.init('8s1S0xeQ1QbQkGmEy');
    </script>
    <title>Final Bill</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
        footer {
            background-color: #ffffff;
            color: rgb(11, 11, 11);
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        nav {
            background-color: #fcfffc;
            overflow: hidden;
            padding: 5px; 
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px; 
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .up {
            background-color: #0a4603;
            color: #fff;
            padding: 5px; 
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
        }
        .user-info {
            max-width: 400px;
            margin: 20px 0 20px 20px;
            padding: 20px;
            border: 0px solid #ccc;
            border-radius: 8px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .user-image {
            max-width: 100px; 
            border-radius: 50%; 
            margin-left: 20px; 
        }
        .button-container {
             text-align: right;
            }

            #placeOrderBtn {
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            #placeOrderBtn:hover {
                background-color: #45a049;
            }





    </style>
</head>
<body>
<header class="up">
        <h1>Final Bill</h1>
    </header>
    <nav>
        <a href="../HTML/index.html" style="color: black;"><i class="fas fa-home"></i> Home</a>
    </nav>    
 <section style=" background-color: #fffffb; display: flex; justify-content: space-around; align-items: center;" >
        <div style="width: 650px; background-color: #fff; padding: 20px; box-shadow: 0 20px 10px rgba(0, 0, 0, 0.1); border-radius: 8px; position: relative;">
            <h1 style="color: #908e39;">Your Info:</h1>
            <p style="color: #666; line-height: 1.6;">
                
                 <div class="user-info">
        <label for="username">Name:</label>
    <input type="text" id="username" name="username" autocomplete="username" value="<?php echo $finalUsername; ?>"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" autocomplete="email" value="<?php echo $finalEmail; ?>">
</div>   
            </p>
        </div>
        <img src="../image/payment.jpg" alt="Plantation Image" style="width: 750px; height: 500px; border-radius: 8px; margin: 20px;">
    </section>

    <h2>Final Bill</h2>
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price per Unit</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "plantation";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT item_name, item_quantity, item_price
                                    FROM orders");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . (isset($row['item_quantity']) ? $row['item_quantity'] : '') . "</td>";
                echo "<td>" . (isset($row['item_price']) ? $row['item_price'] : '') . "</td>";

                if (isset($row['item_quantity'], $row['item_price'])) {
                    echo "<td>" . ($row['item_quantity'] * $row['item_price']) . "</td>";
                } else {
                    echo "<td></td>";
                }

                echo "</tr>";
            }

            $conn->close();
            ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total</td>
                <td>
                    <?php
                    $connTotal = new mysqli($servername, $username, $password, $dbname);
                    
                    $resultTotal = $connTotal->query("SELECT SUM(total) AS total FROM order_totals");

                    $total = $resultTotal->fetch_assoc()['total'];
                    echo $total;
                    
                    $connTotal->close();
                    ?>
                </td>
            </tr>

        </tfoot>
    </table><br> &nbsp;&nbsp;&nbsp;
    <div style="text-align: right;">
    <div class="button-container">
    <button id="placeOrderBtn" onclick="placeOrder()">Place Order</button> &nbsp;&nbsp;&nbsp;
</div>
</div>


    <br><br><br><br><br><br>
    <footer>
        &copy; 2024 Eco Leaf Plantation. All rights reserved.
    </footer>
</body>
<script>
    function placeOrder() {
        var total = <?php echo $total; ?>;
        var finalEmail = '<?php echo $finalEmail; ?>';
        var finalUsername = '<?php echo $finalUsername; ?>';

        console.log('Total:', total);
        console.log('Final Email:', finalEmail);
        console.log('Name:', finalUsername);

        fetch('update_product_quantities.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error updating product quantities.');
                }
                return response.text();
            })
            .then(result => {
                console.log(result);
                return fetch('place_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `total=${total}&email=${finalEmail}`,
                });
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error placing order.');
                }
                return response.text();
            })
            .then(result => {
                console.log(result);
                return emailjs.send('service_pdockat', 'template_7qh1dup', {
                    email: finalEmail,
                    subject: 'Order Confirmation',
                    message: `Dear ${finalUsername},\n\nYour order is confirmed! Please make the payment via Bank Deposit to:\n\n
                        Bank: BOC\nAccount: 458963258\nAmount: Rs.${total}\n\
                        After payment, share the bank slip photo with us. Any questions? Contact us at ecoleafplantation@gmail.com\n\n
                        Thank you for choosing Us!\n\n
                        Best Regards,\n\n
                        Eco-Leaf Plantation`,
                    from_name: 'Eco Leaf Plantation'
                });
            })
            .then(response => {
                console.log('Email sent successfully:', response);
                clearOrdersAndTotals();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    }

    function clearOrdersAndTotals() {
        var xhr1 = new XMLHttpRequest();
        xhr1.onreadystatechange = function() {
            if (xhr1.readyState == 4) {
                if (xhr1.status == 200) {
                    alert(xhr1.responseText);
                } else {
                    console.error('Error clearing orders:', xhr1.status, xhr1.statusText);
                    alert('Error clearing orders. Please try again.');
                }
            }
        };
        xhr1.open("GET", "clear_orders.php", true);
        xhr1.send();

        var xhr2 = new XMLHttpRequest();
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4) {
                if (xhr2.status == 200) {
                    alert(xhr2.responseText);
                } else {
                    console.error('Error clearing order_totals:', xhr2.status, xhr2.statusText);
                    alert('Error clearing order_totals. Please try again.');
                }
            }
        };
        xhr2.open("GET", "clear_order_totals.php", true);
        xhr2.send();
    }
</script>

</html>
