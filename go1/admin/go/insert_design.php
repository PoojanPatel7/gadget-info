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

// Pagination setup
$devices_per_page = 5; // Number of devices displayed per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $devices_per_page;

// Device selection form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_device'])) {
    $device_id = intval($_POST['select_device']);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert Design Data</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
            .form-container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            label, input, textarea, button { display: block; width: 100%; margin-bottom: 15px; }
            button { background: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
            button:hover { background: #45a049; }
        </style>
    </head>
    <body>
        <h2>Insert Design Data for Device ID: <?php echo $device_id; ?></h2>
        <div class="form-container">
            <form action="" method="POST">
                <input type="hidden" name="device_id" value="<?php echo $device_id; ?>">
                <label for="height">Height:</label>
                <input type="text" id="height" name="height" required>
                <label for="width">Width:</label>
                <input type="text" id="width" name="width" required>
                <label for="thickness">Thickness:</label>
                <input type="text" id="thickness" name="thickness" required>
                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" required>
                <label for="build_material">Build Material:</label>
                <input type="text" id="build_material" name="build_material">
                <label for="colours">Colours:</label>
                <input type="text" id="colours" name="colours">
                <label for="waterproof">Waterproof:</label>
                <input type="checkbox" id="waterproof" name="waterproof">
                <label for="ruggedness">Ruggedness:</label>
                <input type="checkbox" id="ruggedness" name="ruggedness">
                <button type="submit">Insert Design</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert Design Data
    $device_id = intval($_POST['device_id']);
    $height = trim($_POST['height']);
    $width = trim($_POST['width']);
    $thickness = trim($_POST['thickness']);
    $weight = trim($_POST['weight']);
    $build_material = trim($_POST['build_material']);
    $colours = trim($_POST['colours']);
    $waterproof = isset($_POST['waterproof']) ? 1 : 0;
    $ruggedness = isset($_POST['ruggedness']) ? 1 : 0;

    if (empty($height) || empty($width) || empty($thickness) || empty($weight)) {
        echo "Height, Width, Thickness, and Weight are required fields!";
    } else {
        $stmt = $conn->prepare("INSERT INTO design (device_id, height, width, thickness, weight, build_material, colours, waterproof, ruggedness) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssii", $device_id, $height, $width, $thickness, $weight, $build_material, $colours, $waterproof, $ruggedness);
        if ($stmt->execute()) {
            echo "Design data inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch devices for the current page
$result = $conn->query("SELECT device_id, model_name FROM device LIMIT $devices_per_page OFFSET $offset");
$total_devices_result = $conn->query("SELECT COUNT(*) as total FROM device");
$total_devices = $total_devices_result->fetch_assoc()['total'];
$total_pages = ceil($total_devices / $devices_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Device</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .form-container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        select, button { display: block; width: 100%; margin-bottom: 15px; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a { padding: 8px 12px; margin: 0 5px; background: #007BFF; color: white; text-decoration: none; border-radius: 5px; }
        .pagination a:hover { background: #0056b3; }
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
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>" <?php echo $i == $page ? 'style="background:#0056b3;"' : ''; ?>>
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
