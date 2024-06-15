<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "plantation";

    $conn = new mysqli($servername, $username, $password, $database); 

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contactus(name, email, massage) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";

        ?>
        <html>
        <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <script>
            emailjs.init('8s1S0xeQ1QbQkGmEy');

                const serviceId = 'service_pdockat';
                const templateId = 'template_7qh1dup';

            const templateParams = {
                email: '<?php echo $email; ?>',
                subject: 'Thanks for Visiting!',
                message: `A big thank you for checking out our page! We appreciate your visit. If you have any questions or feedback, feel free to reach out. Hope to see you again soon!`,
                to_name: '<?php echo $name; ?>',
                from_name: 'Eco-Leaf-Plantation'
            };

            emailjs.send(serviceId, templateId, templateParams)
                .then((response) => {
                    console.log('Email sent successfully:', response);
                    window.location.href = '../HTML/contactus.html';
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

    $conn->close();
}

?>
