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

// Fetch contract requests from the database
$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td><input type="radio" name="selected_request" value="' . $row["id"] . '"></td>
                <td>' . $row["name"] . '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["contact"] . '</td>
                <td>' . $row["title"] . '</td>
                <td>' . $row["description"] . '</td>
                <td>' . $row["status"] . '</td>
              </tr>';
    }
} else {
    echo '<tr><td colspan="7">No contract requests found.</td></tr>';
}

// Close the database connection
$conn->close();
?>
