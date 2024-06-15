<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Give Contract</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  

  <form action="update_contract.php" method="post">
    <h2>Create Contract </h2><br>
    <label for="contractId">Contract ID:</label>
            <?php
            // Assuming you have a database connection established
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "plantation";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch value from the database and assign it to the landPart input
            $result = $conn->query("SELECT approve_id 
            FROM approve 
            WHERE id = (SELECT MAX(id) FROM approve)");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $landPartValue = $row["approve_id"];
            } else {
                $landPartValue = ""; // Set a default value if no result is found
            }

            $conn->close();
?>
    <input type="text" id="contractId" name="contractId"value="<?php echo $landPartValue; ?>" readonly >
    <label for="productName">Select Product:</label>
    <select id="product" name="product">
  <?php
    // Connect to your database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plantation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch product names from the database
    $sql = "SELECT pname FROM product";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['pname'] . '">' . $row['pname'] . '</option>';
        }
    } else {
        echo '<option value="">No products available</option>';
    }

    // Close the database connection
    $conn->close();
  ?>
</select>


    <label for="quantity">Quantity:</label>
    <input type="text" id="quantity" name="quantity" required>

    <input type="submit" value="Submit" >
  </form>

</body>
</html>