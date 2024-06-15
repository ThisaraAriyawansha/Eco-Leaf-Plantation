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

// Fetch all data from the database table
$sql = " SELECT * FROM $table_name WHERE status IS NULL";
$result = $conn->query($sql);

echo '<div class="table-container"><table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["name"] . '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["contact"] . '</td>
                <td>' . $row["title"] . '</td>
                <td>' . $row["description"] . '</td>
                <td>
                  <button onclick="approveRow(' . $row["id"] . ')">Approve</button>
                  <button onclick="cancelRow(' . $row["id"] . ')">Cancel</button>
                </td>
              </tr>';
    }
} else {
    echo '<tr><td colspan="7">No data found in the table.</td></tr>';
}

echo '</tbody></table></div>';

// Close the database connection
$conn->close();
?>
