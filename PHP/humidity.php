<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="html2pdf.bundle.min.js"></script>
    <title>Sensor Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #1d4a0d;
            color: white;
            text-align: center;
            padding: 10px;
        }

        h2 {
            color: #333;
        }

        main {
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        table {
            width: calc(100% - 24px);
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #2c662d;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #ffffff;
            color: rgb(11, 11, 11);
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .download-btn {
            background-color: #2c662d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Sensor Data Table</h1>
    </header>

    <main>
        <button class="download-btn" onclick="downloadPDF()">Download as PDF</button>

        <div id="pdf-wrapper"> 
            <h2>Humidity Data</h2>

            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "test";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT humidity, timestamp FROM sensor_data ORDER BY timestamp DESC LIMIT 20";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Humidity</th><th>Time</th></tr>";

                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["humidity"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
                    }

                    echo "</table>";
                } else {
                    echo "0 results";
                }

                $conn->close();
            ?>
        </div> 

    </main>

    <br><br><br>
    <footer>
        &copy; 2024 Eco Leaf Plantation. All rights reserved.
    </footer>

    <script>
        function downloadPDF() {
            const element = document.querySelector('#pdf-wrapper');

            html2pdf(element);
        }
    </script>
</body>
</html>
