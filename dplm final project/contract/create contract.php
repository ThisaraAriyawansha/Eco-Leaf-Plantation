<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Your database credentials
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "plantation";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO contract (name, email, contact, title, description) VALUES ('$name', '$email', '$contact', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        echo '<script>
                alert("Data inserted successfully");
                // Redirect to create_contract.html
                window.location.href = "create contract.html";
              </script>';
    } else {
        // Error in data insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    

    // Close the database connection
    $conn->close();
}
?>
