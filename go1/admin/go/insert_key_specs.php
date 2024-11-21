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
        $RAM = trim($_POST['RAM']);
        $Processor = trim($_POST['Processor']);
        $Rear_Camera = trim($_POST['Rear_Camera']);
        $Front_Camera = trim($_POST['Front_Camera']);
        $Battery = trim($_POST['Battery']);
        $Display = trim($_POST['Display']);
    

        // Validate inputs
        if (empty($RAM) || empty($Processor)) {
            echo "Camera and Resolution are required fields!";
        } else {
            $stmt = $conn->prepare("INSERT INTO key_specs 
            (RAM, Processor, Rear_Camera, Front_Camera, Battery, Display, device_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");

           // Bind parameters to the statement
           $stmt->bind_param("ssssssi", $RAM, $Processor, $Rear_Camera, $Front_Camera, $Battery, $Display, $device_id);

           // Execute the statement
          if ($stmt->execute()) {
          echo "Key specs data inserted successfully!";
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
                    <label for="ram">RAM:</label>
                    <input type="text" id="ram" name="ram" required><br><br>

                    <label for="processor">Processor:</label>
                    <input type="text" id="processor" name="processor" required><br><br>

                    <label for="rear_camera">Rear Camera:</label>
                    <input type="text" id="rear_camera" name="rear_camera" required><br><br>

                    <label for="front_camera">Front Camera:</label>
                    <input type="text" id="front_camera" name="front_camera" required><br><br>

                    <label for="battery">Battery:</label>
                    <input type="text" id="battery" name="battery" required><br><br>

                    <label for="display">Display:</label>
                    <input type="text" id="display" name="display" required><br><br>

                    <button type="submit">Insert Key Specifications</button>

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
