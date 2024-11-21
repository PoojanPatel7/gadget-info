<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "go";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data where device_id is 2
$device_id = 2;
$stmt = $conn->prepare("SELECT * FROM device WHERE device_id = ?");
$stmt->bind_param("i", $device_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $device = $result->fetch_assoc();
} else {
    $device = null;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        p {
            margin: 10px 0;
        }
        .highlight {
            font-weight: bold;
            color: #ffdb4d;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($device): ?>
            <h1>Device Details</h1>
            <p><span class="highlight">Device ID:</span> <?php echo $device['device_id']; ?></p>
            <p><span class="highlight">Model Name:</span> <?php echo $device['model_name']; ?></p>
            <p><span class="highlight">Brand:</span> <?php echo $device['brand']; ?></p>
            
        <?php else: ?>
            <h1>Device Not Found</h1>
        <?php endif; ?>
    </div>
</body>
</html>
