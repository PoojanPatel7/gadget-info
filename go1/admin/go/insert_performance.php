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
        $chipset = trim($_POST['chipset']);
        $CPU = trim($_POST['CPU']);
        $architecture = trim($_POST['architecture']);
        $fabrication = trim($_POST['fabrication']);
        $graphics = trim($_POST['graphics']);
        $RAM = trim($_POST['RAM']);
        $RAM_type = trim($_POST['RAM_type']);

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
                    <label for="chipset">Chipset:</label>
                    <input type="text" id="chipset" name="chipset" required><br><br>
            
                    <label for="CPU">CPU:</label>
                    <input type="text" id="CPU" name="CPU" required><br><br>

                    <label for="architecture">Architecture:</label>
                    <input type="text" id="architecture" name="architecture" required><br><br>

                   <label for="fabrication">Fabrication:</label>
                   <input type="text" id="fabrication" name="fabrication" required><br><br>

                   <label for="graphics">Graphics:</label>
                   <input type="text" id="graphics" name="graphics" required><br><br>

                   <label for="RAM">RAM:</label>
                   <input type="text" id="RAM" name="RAM" required><br><br>

                   <label for="RAM_type">RAM Type:</label>
                   <input type="text" id="RAM_type" name="RAM_type" required><br><br>

                   <button type="submit">Insert Performance Data</button>

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
