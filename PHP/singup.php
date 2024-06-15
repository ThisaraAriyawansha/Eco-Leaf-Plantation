<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "plantation";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO customer (username, email, password, phone) VALUES ('$username', '$email', '$password', '$phone')";

    if ($conn->query($sql) === TRUE) {
        ?>
        <html>
        <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <script>
            emailjs.init('8s1S0xeQ1QbQkGmEy');

const serviceId = 'service_pdockat';
const templateId = 'template_7qh1dup';

            const templateParams = {
                email: '<?php echo $email; ?>',
                subject: 'Subject of your email',
                message: `Hello <?php echo $username; ?>, Thank you for signing up EcoLeafPlantation!`,
                to_name: '<?php echo $username; ?>',
                from_name: 'Eco-Leaf-Plantation'
            };

            emailjs.send(serviceId, templateId, templateParams)
                .then((response) => {
                    console.log('Email sent successfully:', response);
                    window.location.href = '../HTML/create_account-temp.html';
                })
                .catch((error) => {
                    console.error('Error sending email:', error);
                    alert('Error sending email. Please try again.');
                });
        </script>
        </html>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
