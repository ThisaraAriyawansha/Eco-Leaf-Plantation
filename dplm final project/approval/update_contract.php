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

// Get form data
$contractId = $_POST['contractId'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];

// Perform the update logic (update the product and quantity columns)
$sql = "UPDATE $table_name SET product = '$product', quantity = '$quantity' WHERE id = $contractId";
if ($conn->query($sql) === TRUE) {
    // Data insertion successful, retrieve email and redirect to Approval page.html
    $getEmailQuery = "SELECT email FROM $table_name WHERE id = $contractId";
    $result = $conn->query($getEmailQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Include the script tags here -->
            <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        </head>
        <body>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize EmailJS with your user ID
                    emailjs.init('8s1S0xeQ1QbQkGmEy');

                    // Replace these values with your actual EmailJS credentials
                    const serviceId = 'service_pdockat';
                    const templateId = 'template_7qh1dup';

                    const templateParams = {
                        email: '<?php echo $email; ?>',
                        subject: 'contract request approval',
                        message: 'Hello, Your contract is successfully approved. Stay tuned with our latest updates.',
                        to_name: 'User',
                        from_name: 'Eco-Leaf-Plantation'
                    };

                    // Send the email using EmailJS
                    emailjs.send(serviceId, templateId, templateParams)
                        .then((response) => {
                            console.log('Email sent successfully:', response);
                            alert('Email sent successfully!');
                            // Redirect to the approval page after sending the email
                            window.location.href = 'Approval page.html';
                        })
                        .catch((error) => {
                            console.error('Error sending email:', error);
                            alert('Error sending email. Please try again.');
                        });
                });
            </script>
        </body>
        </html>
        <?php
        exit(); // Ensure the PHP execution stops after sending the HTML content
    } else {
        echo "Email not found for contract ID: $contractId";
    }
} else {
    // If an error occurs, you might want to handle it accordingly
    echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
