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
        $capacity = trim($_POST['capacity']);
        $type = trim($_POST['type']);
        $removable = isset($_POST['removable']) ? 1 : 0;
        $talk_time = trim($_POST['talk_time']);
        $wireless_charging = isset($_POST['wireless_charging']) ? 1 : 0;
        $quick_charging = isset($_POST['quick_charging']) ? 1 : 0;
        $usb_type_c = isset($_POST['usb_type_c']) ? 1 : 0;
        // Validate inputs
        if (empty($capacity) || empty($type)) {
            echo "Camera and Resolution are required fields!";
        } else {
            // Insert into the camera table
            $stmt = $conn->prepare("INSERT INTO battery 
            (capacity, type, removable, talk_time, wireless_charging, quick_charging, usb_type_c, device_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssisiiii",
            $capacity,
            $type,
            $removable,
            $talk_time,
            $wireless_charging,
            $quick_charging,
            $usb_type_c,
            $device_id
        );

            if ($stmt->execute()) {
                echo "Battery data inserted successfully!";
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
                    <label for="capacity">Capacity (mAh):</label>
                    <input type="text" id="capacity" name="capacity" required>

                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" required>

                    <label for="removable">Removable Battery:</label>
                    <input type="checkbox" id="removable" name="removable">

                    <label for="talk_time">Talk Time:</label>
                    <input type="text" id="talk_time" name="talk_time">

                    <label for="wireless_charging">Wireless Charging:</label>
                    <input type="checkbox" id="wireless_charging" name="wireless_charging">

                    <label for="quick_charging">Quick Charging:</label>
                    <input type="checkbox" id="quick_charging" name="quick_charging">

                    <label for="usb_type_c">USB Type-C:</label>
                    <input type="checkbox" id="usb_type_c" name="usb_type_c">

                    <button type="submit" name="submit_battery">Submit</button>
            </form>

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
