<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Get admin username
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
            animation: fadeIn 2s ease-in-out;
        }

        h1 {
            text-align: center;
            color: #333;
            animation: slideDown 1s ease-out;
        }

        .welcome-message {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeInUp 1s 1s forwards;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-top: 50px;
            opacity: 0;
            animation: fadeInUp 1.5s 1s forwards;
        }

        /* Add styles for the row layout */
        .button-pair {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .button-container button {
            width: 200px;
            padding: 15px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s ease-in-out;
        }

        .button-container button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .button-container button:focus {
            outline: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<h1>Insert Data Into Tables</h1>

<div class="welcome-message">
    <p>Welcome, Admin: <?php echo $username; ?>!</p>
</div>

<div class="button-container">
<p>Device</p>
<div class="button-pair">
        <button onclick="window.location.href='insert_device.php'">Insert Device</button>
        <button onclick="window.location.href='update_device.php'">Update Device</button>
</div>


    <div class="button-pair">
        <button onclick="window.location.href='insert_battery.php'">Insert Battery</button>
        <button onclick="window.location.href='update_battery.php'">Update Battery</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_camera.php'">Insert Camera</button>
        <button onclick="window.location.href='update_camera.php'">Update Camera</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_design.php'">Insert Design</button>
        <button onclick="window.location.href='update_design.php'">Update Design</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_display.php'">Insert Display</button>
        <button onclick="window.location.href='update_display.php'">Update Display</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_general.php'">Insert General</button>
        <button onclick="window.location.href='update_general.php'">Update General</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_key_specs.php'">Insert Key Specs</button>
        <button onclick="window.location.href='update_key_specs.php'">Update Key Specs</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_multimedia.php'">Insert Multimedia</button>
        <button onclick="window.location.href='update_multimedia.php'">Update Multimedia</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_network_connectivity.php'">Insert Network Connectivity</button>
        <button onclick="window.location.href='update_network_connectivity.php'">Update Network Connectivity</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_performance.php'">Insert Performance</button>
        <button onclick="window.location.href='update_performance.php'">Update Performance</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_sensors.php'">Insert Sensors</button>
        <button onclick="window.location.href='update_sensors.php'">Update Sensors</button>
    </div>
    <div class="button-pair">
        <button onclick="window.location.href='insert_storage.php'">Insert Storage</button>
        <button onclick="window.location.href='update_storage.php'">Update Storage</button>
    </div>
</div>

</body>
</html>
