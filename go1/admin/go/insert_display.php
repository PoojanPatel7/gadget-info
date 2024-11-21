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
        $display_type = trim($_POST['display_type']);
        $screen_size = trim($_POST['screen_size']);
        $resolution = trim($_POST['resolution']);
        $peak_brightness = trim($_POST['peak_brightness']);
        $refresh_rate = trim($_POST['refresh_rate']);
        $aspect_ratio = trim($_POST['aspect_ratio']);
        $pixel_density = trim($_POST['pixel_density']);
        $screen_to_body_ratio = trim($_POST['screen_to_body_ratio']);
        $screen_protection = trim($_POST['screen_protection']);
        $bezel_less_display = isset($_POST['bezel_less_display']) ? 1 : 0; // Checkbox for bezel-less display
        $touch_screen = isset($_POST['touch_screen']) ? 1 : 0; // Checkbox for touch screen
        $hdr_support = isset($_POST['hdr_support']) ? 1 : 0; // Checkbox for HDR support

        // Validate inputs
        if (empty($display_type) || empty($screen_size)) {
            echo "Camera and Resolution are required fields!";
        } else {
            $stmt = $conn->prepare("INSERT INTO display 
        (device_id, display_type, screen_size, resolution, peak_brightness, refresh_rate, aspect_ratio, 
        pixel_density, screen_to_body_ratio, screen_protection, bezel_less_display, touch_screen, hdr_support) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param(
        "issssiisssiii",
        $device_id,
        $display_type,
        $screen_size,
        $resolution,
        $peak_brightness,
        $refresh_rate,
        $aspect_ratio,
        $pixel_density,
        $screen_to_body_ratio,
        $screen_protection,
        $bezel_less_display,
        $touch_screen,
        $hdr_support
    );

    // Execute and check for success
    if ($stmt->execute()) {
        echo "Display data inserted successfully!";
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
                    <label for="display_type">Display Type:</label>
            <input type="text" id="display_type" name="display_type" required><br><br>

            <label for="screen_size">Screen Size:</label>
            <input type="text" id="screen_size" name="screen_size" required><br><br>

            <label for="resolution">Resolution:</label>
            <input type="text" id="resolution" name="resolution" required><br><br>

            <label for="peak_brightness">Peak Brightness:</label>
            <input type="text" id="peak_brightness" name="peak_brightness"><br><br>

            <label for="refresh_rate">Refresh Rate:</label>
            <input type="text" id="refresh_rate" name="refresh_rate"><br><br>

            <label for="aspect_ratio">Aspect Ratio:</label>
            <input type="text" id="aspect_ratio" name="aspect_ratio"><br><br>

            <label for="pixel_density">Pixel Density:</label>
            <input type="text" id="pixel_density" name="pixel_density"><br><br>

            <label for="screen_to_body_ratio">Screen to Body Ratio:</label>
            <input type="text" id="screen_to_body_ratio" name="screen_to_body_ratio"><br><br>

            <label for="screen_protection">Screen Protection:</label>
            <input type="text" id="screen_protection" name="screen_protection"><br><br>

            <label for="bezel_less_display">Bezel-less Display:</label>
            <input type="checkbox" id="bezel_less_display" name="bezel_less_display"><br><br>

            <label for="touch_screen">Touch Screen:</label>
            <input type="checkbox" id="touch_screen" name="touch_screen" checked><br><br>

            <label for="hdr_support">HDR Support:</label>
            <input type="checkbox" id="hdr_support" name="hdr_support"><br><br>

            <button type="submit">Insert Display</button>

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
