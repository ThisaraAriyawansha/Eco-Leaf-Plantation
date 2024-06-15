<!DOCTYPE html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $landPart = $_POST["landPart"];
    $fullName = $_POST["fullName"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plantation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE property SET name='$fullName', phoneno='$phoneNumber', email='$email' WHERE part='$landPart'";

    if ($conn->query($sql) === TRUE) {
        ?>

<html lang="en">
        <head>
            <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        </head>
        <body>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    emailjs.init('8s1S0xeQ1QbQkGmEy');

                    const serviceId = 'service_pdockat';
                    const templateId = 'template_7qh1dup';

                    const templateParams = {
                        email: '<?php echo $email; ?>',
                        subject: 'Reservation request approval',
                        message: 'Hello, your request for the reservation is successful. Please visit our land <?php echo $landPart; ?> and confirm your reservation by paying an advance.',
                        to_name: 'User',
                        from_name: 'Eco-Leaf-Plantation'
                    };

                    emailjs.send(serviceId, templateId, templateParams)
                        .then((response) => {
                            console.log('Email sent successfully:', response);
                            alert('Email sent successfully!');
                            window.location.href = 'landmap.php';
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
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
