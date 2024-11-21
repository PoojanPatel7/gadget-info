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
        $camera = trim($_POST['camera']);
        $resolution = trim($_POST['resolution']);
        $autofocus = trim($_POST['autofocus']);
        $ois = isset($_POST['ois']) ? 1 : 0;
        $flash = isset($_POST['flash']) ? 1 : 0;
        $image_resolution = trim($_POST['image_resolution']);
        $settings = trim($_POST['settings']);
        $shooting_modes = trim($_POST['shooting_modes']);
        $camera_features = trim($_POST['camera_features']);
        $video_recording = isset($_POST['video_recording']) ? 1 : 0;
        $video_recording_features = trim($_POST['video_recording_features']);
        $camera_setup = trim($_POST['camera_setup']);

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
                    <label for="camera">Camera:</label>
                    <input type="text" id="camera" name="camera" required>
                    <label for="resolution">Resolution:</label>
                    <input type="text" id="resolution" name="resolution" required>
                    <label for="autofocus">Autofocus:</label>
                    <input type="text" id="autofocus" name="autofocus">
                    <label for="ois">OIS:</label>
                    <input type="checkbox" id="ois" name="ois">
                    <label for="flash">Flash:</label>
                    <input type="checkbox" id="flash" name="flash">
                    <label for="image_resolution">Image Resolution:</label>
                    <input type="text" id="image_resolution" name="image_resolution">
                    <label for="settings">Settings:</label>
                    <textarea id="settings" name="settings"></textarea>
                    <label for="shooting_modes">Shooting Modes:</label>
                    <textarea id="shooting_modes" name="shooting_modes"></textarea>
                    <label for="camera_features">Camera Features:</label>
                    <textarea id="camera_features" name="camera_features"></textarea>
                    <label for="video_recording">Video Recording:</label>
                    <input type="checkbox" id="video_recording" name="video_recording">
                    <label for="video_recording_features">Video Recording Features:</label>
                    <textarea id="video_recording_features" name="video_recording_features"></textarea>
                    <label for="camera_setup">Camera Setup:</label>
                    <input type="text" id="camera_setup" name="camera_setup">
                    <button type="submit">Insert Camera</button>
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
