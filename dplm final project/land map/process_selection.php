<?php
// Check if the land part is set in the request
if (isset($_GET['landPart'])) {
    $selectedLandPart = $_GET['landPart'];

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

    // Insert the selected land part into the database
    $sql = "INSERT INTO property(part) VALUES ('$selectedLandPart')";
    if ($conn->query($sql) === TRUE) {
        echo "your selected property is " .$selectedLandPart;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();


}
?>
<html>
    <body>
    <button class="done-button" onclick="redirectToForm()">Done</button>

    <script>
    // JavaScript for interactivity
   

    // Function to redirect to the form_page.php
    function redirectToForm() {
        window.location.href = "form_page.php";
    }
</script>
    </body>

</html>

