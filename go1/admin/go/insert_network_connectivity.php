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

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['device_id'])) {
        // Step 2: Insert Camera Data
        $device_id = intval($_POST['device_id']);
        $sim_slots = trim($_POST['sim_slots']);
        $sim_size = trim($_POST['sim_size']);
        $network_support = trim($_POST['network_support']);
        $volte = isset($_POST['volte']) ? 1 : 0;
        $sim_1 = trim($_POST['sim_1']);
        $sim_2 = trim($_POST['sim_2']);
        $sar_value = trim($_POST['sar_value']);
        $wifi = isset($_POST['wifi']) ? 1 : 0;
        $wifi_features = trim($_POST['wifi_features']);
        $wifi_calling = isset($_POST['wifi_calling']) ? 1 : 0;
        $bluetooth = trim($_POST['bluetooth']);
        $gps = isset($_POST['gps']) ? 1 : 0;
        $nfc = isset($_POST['nfc']) ? 1 : 0;
        $usb_connectivity = trim($_POST['usb_connectivity']);

        // Validate inputs
        if (empty($camera) || empty($resolution)) {
            echo "Camera and Resolution are required fields!";
        } else {
            // Insert into the camera table
            $stmt = $conn->prepare("INSERT INTO camera (device_id, camera, resolution, autofocus, ois, flash, image_resolution, settings, shooting_modes, camera_features, video_recording, video_recording_features, camera_setup) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssiissssiss", $device_id, $camera, $resolution, $autofocus, $ois, $flash, $image_resolution, $settings, $shooting_modes, $camera_features, $video_recording, $video_recording_features, $camera_setup);

            if ($stmt->execute()) {
                echo "Camera data inserted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } elseif (isset($_POST['select_device'])) {
        // Step 1: Handle Device ID selection
        $device_id = intval($_POST['select_device']);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Insert Camera Data</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
                .form-container { width: 50%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                label { display: block; margin-top: 10px; }
                input, textarea, button { width: 100%; margin-top: 5px; padding: 10px; font-size: 16px; }
                button { background: #4CAF50; color: white; border: none; cursor: pointer; }
                button:hover { background: #45a049; }
            </style>
        </head>
        <body>
            <h2>Insert Camera Data</h2>
            <div class="form-container">
                <form action="" method="POST">
                    <input type="hidden" name="device_id" value="<?php echo $device_id; ?>">
                    <label for="sim_slots">SIM Slots:</label>
                    <input type="text" id="sim_slots" name="sim_slots" required><br><br>
            
                    <label for="sim_size">SIM Size:</label>
                    <input type="text" id="sim_size" name="sim_size" required><br><br>

                    <label for="network_support">Network Support:</label>
                    <input type="text" id="network_support" name="network_support" required><br><br>

                    <label for="volte">VoLTE:</label>
                    <input type="checkbox" id="volte" name="volte"><br><br>

                    <label for="sim_1">SIM 1:</label>
                    <input type="text" id="sim_1" name="sim_1"><br><br>

                   <label for="sim_2">SIM 2:</label>
                   <input type="text" id="sim_2" name="sim_2"><br><br>

                   <label for="sar_value">SAR Value:</label>
                   <input type="text" id="sar_value" name="sar_value"><br><br>

                   <label for="wifi">Wi-Fi:</label>
                   <input type="checkbox" id="wifi" name="wifi"><br><br>

                   <label for="wifi_features">Wi-Fi Features:</label>
                   <textarea id="wifi_features" name="wifi_features" rows="3"></textarea><br><br>

                   <label for="wifi_calling">Wi-Fi Calling:</label>
                   <input type="checkbox" id="wifi_calling" name="wifi_calling"><br><br>

                   <label for="bluetooth">Bluetooth:</label>
                   <input type="text" id="bluetooth" name="bluetooth"><br><br>

                   <label for="gps">GPS:</label>
                   <input type="checkbox" id="gps" name="gps"><br><br>

                   <label for="nfc">NFC:</label>
                   <input type="checkbox" id="nfc" name="nfc"><br><br>

                   <label for="usb_connectivity">USB Connectivity:</label>
                   <input type="text" id="usb_connectivity" name="usb_connectivity"><br><br>

                   <button type="submit">Insert Network Connectivity</button>

                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
} else {
    // Display device selection form
    $result = $conn->query("SELECT device_id, model_name FROM device");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select Device</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
            .form-container { width: 50%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            label, select, button { display: block; margin-top: 10px; font-size: 16px; width: 100%; }
            button { background: #007BFF; color: white; padding: 10px; border: none; cursor: pointer; }
            button:hover { background: #0056b3; }
        </style>
    </head>
    <body>
        <h2>Select Device</h2>
        <div class="form-container">
            <form action="" method="POST">
                <label for="select_device">Select Device:</label>
                <select name="select_device" id="select_device" required>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['device_id']; ?>"><?php echo $row['model_name']; ?></option>
                    <?php } ?>
                </select>
                <button type="submit">Next</button>
            </form>
        </div>
    </body>
    </html>
    <?php
}
$conn->close();
?>
