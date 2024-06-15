<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Land Map</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .land-map-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-top: 20px; /* Adjust the top margin */
        }

        .land-map {
            position: relative;
            width: 600px;
            height: 400px;
            background-image: url('your_map_image.jpg'); /* Replace with your map image */
            background-size: cover;
        }

        .map-part {
            position: absolute;
            cursor: pointer;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: #4CAF50; /* Default green color for unselected parts */
            color: #fff; /* White text color for better visibility */
        }

        .selected {
            background-color: #FF0000; /* Red background color for selected parts */
        }

        .map-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .map-card {
            width: 150px;
            height: 100px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<br>

<div class="land-map-container">
    <div class="land-map">
    <br>
        <!-- Define each selectable part with a div -->
        <div class="map-part" style="top: 50px; left: 50px; width: 150px; height: 100px;" onclick="selectPart('A')">A</div>
        <div class="map-part" style="top: 50px; left: 220px; width: 120px; height: 80px;" onclick="selectPart('B')">B</div>
        <div class="map-part" style="top: 50px; left: 350px; width: 80px; height: 100px;" onclick="selectPart('C')">C</div>
        <div class="map-part" style="top: 50px; left: 500px; width: 120px; height: 80px;" onclick="selectPart('D')">D</div>

        <!-- Add 10 more map parts -->
        <div class="map-part" style="top: 200px; left: 50px; width: 100px; height: 60px;" onclick="selectPart('E')">E</div>
        <div class="map-part" style="top: 200px; left: 200px; width: 90px; height: 70px;" onclick="selectPart('F')">F</div>
        <div class="map-part" style="top: 200px; left: 350px; width: 80px; height: 120px;" onclick="selectPart('G')">G</div>
        <div class="map-part" style="top: 200px; left: 500px; width: 130px; height: 90px;" onclick="selectPart('H')">H</div>
        <div class="map-part" style="top: 330px; left: 50px; width: 110px; height: 50px;" onclick="selectPart('I')">I</div>
        <div class="map-part" style="top: 330px; left: 200px; width: 70px; height: 60px;" onclick="selectPart('L')">L</div>
        <div class="map-part" style="top: 330px; left: 350px; width: 80px; height: 100px;" onclick="selectPart('K')">K</div>
        <div class="map-part" style="top: 330px; left: 500px; width: 120px; height: 80px;" onclick="selectPart('M')">M</div>
        <div class="map-part" style="top: 50px; left: 650px; width: 100px; height: 100px;" onclick="selectPart('N')">N</div>
        <div class="map-part" style="top: 170px; left: 650px; width: 100px; height: 100px;" onclick="selectPart('O')">O</div>
       
    </div>
<br>
    <!-- Cards for each land part -->
    <div class="map-card-container">
        <div class="map-card">A - Beautiful Tea Garden with Stunning Views</div>
        <div class="map-card">B - Serene Tea Plantation Surrounded by Nature</div>
        <div class="map-card">C - Lush Greenery and Charming Landscape</div>
        <div class="map-card">D - Tranquil Tea Estate with Rich Flora</div>
        <div class="map-card">E - Picturesque Tea Fields and Refreshing Ambiance</div>
        <div class="map-card">F - Calm and Relaxing Tea Estate Experience</div>
        <div class="map-card">G - Scenic Beauty and Abundant Tea Plantations</div>
        <div class="map-card">H - Breathtaking Views of Tea Gardens</div>
        <div class="map-card">I - Idyllic Tea Estate Amidst Rolling Hills</div>
        <div class="map-card">L - A Harmony of Nature and Tea Cultivation</div>
        <div class="map-card">K - Charming Tea Estate with Unique Flair</div>
        <div class="map-card">M - Blissful Tea Plantation with Cultural Charm</div>
        <div class="map-card">N - Pristine Tea Gardens with Mountain Backdrop</div>
        <div class="map-card">O - Tea Estate Oasis in the Heart of Tranquility</div>
       
       
    </div>
</div>

<script>
    // JavaScript for interactivity
    function selectPart(part) {
        // Add your logic here to handle the selection of each part
        window.location.href = "process_selection.php?landPart=" + part;
       
         alert('Selected: ' + part);
    }
</script>

</body>
</html>
