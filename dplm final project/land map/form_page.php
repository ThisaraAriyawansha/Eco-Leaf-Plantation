<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land Information Form</title>
    <style>
    body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #e0f2f1; /* Light green background color for the body */
        }

        .form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #43a047; /* Dark green border color for the form container */
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* White background color for the form container */
        }

        .form-field {
            margin-bottom: 15px;
        }

        .form-field label {
            display: block;
            margin-bottom: 5px;
            color: #43a047; /* Dark green text color for labels */
        }

        .form-field input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #43a047; /* Dark green border color for inputs */
            border-radius: 3px;
        }

        .form-submit {
            background-color: #43a047; /* Dark green background color for submit button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
    
</head>
<body>

<div class="form-container">
    <h2>Land Information Form</h2>
    <form action="process_form.php" method="post">
        <div class="form-field">
            <label for="landPart">Land Part:</label>
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
            $result = $conn->query("SELECT part FROM property WHERE email IS NULL");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $landPartValue = $row["part"];
            } else {
                $landPartValue = ""; // Set a default value if no result is found
            }

            $conn->close();
?>
            
            
            <input type="text" id="landPart" name="landPart" value="<?php echo $landPartValue; ?>" readonly>
                    </div>
        <div class="form-field">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>
        <div class="form-field">
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
        </div>
        <div class="form-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <input type="submit" value="Submit" class="form-submit">
    </form>
</div>

</body>
</html>
