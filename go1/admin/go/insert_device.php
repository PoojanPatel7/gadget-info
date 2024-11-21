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

// Insert data into device table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $brand = trim($_POST['brand']);
    $model_name = trim($_POST['model_name']);

    // Validate the inputs
    if (empty($brand) || empty($model_name)) {
        echo "Brand and Model Name are required fields!";
    } else {
        // Prepare SQL query to insert data into the device table
        $stmt = $conn->prepare("INSERT INTO device (brand, model_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $brand, $model_name);

        // Execute the query
        if ($stmt->execute()) {
            echo "Device data inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Device Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            animation: fadeIn 2s ease-in;
        }

        .form-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: slideIn 1s ease-out;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
            color: #333;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .form-container button:active {
            transform: scale(0.98);
            transition: transform 0.1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
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

    <h2>Insert Device Data</h2>

    <div class="form-container">
        <!-- Form to insert data into the device table -->
        <form action="" method="POST">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required><br><br>

            <label for="model_name">Model Name:</label>
            <input type="text" id="model_name" name="model_name" required><br><br>

            <button type="submit">Insert Device</button>
        </form>
    </div>

</body>
</html>
