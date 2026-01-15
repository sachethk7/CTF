<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .dog-card {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 5px solid #2196f3;
        }
        .dog-info {
            font-size: 18px;
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .error {
            color: #d32f2f;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 5px;
        }
        .hint {
            margin-top: 30px;
            padding: 15px;
            background-color: #fff3e0;
            border-radius: 5px;
            font-size: 14px;
            color: #e65100;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: #2196f3;
        }
        .form-group button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #2196f3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐕 Dog Viewer</h1>
        
        <div class="hint">
            <strong>Welcome!</strong> This application lets you view information about our dogs.
        </div>

        <form method="GET" action="">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '1'; ?>" placeholder="Enter dog ID">
                <button type="submit">View Dog</button>
            </div>
        </form>

        <?php
        $host = 'db';
        $dbname = 'ctf_challenge';
        $username = 'root';
        $password = 'root';

        try {
            $conn = new mysqli($host, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("<div class='error'>Database connection failed: " . htmlspecialchars($conn->connect_error) . "</div>");
            }

            $id = isset($_GET['id']) ? $_GET['id'] : '1';

            $query = "SELECT name, breed, color, owner FROM dogs WHERE id = " . $id;
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='dog-card'>";
                echo "<div class='dog-info'><span class='label'>Name:</span> " . htmlspecialchars($row['name']) . "</div>";
                echo "<div class='dog-info'><span class='label'>Breed:</span> " . htmlspecialchars($row['breed']) . "</div>";
                echo "<div class='dog-info'><span class='label'>Color:</span> " . htmlspecialchars($row['color']) . "</div>";
                echo "<div class='dog-info'><span class='label'>Owner:</span> " . htmlspecialchars($row['owner']) . "</div>";
                echo "</div>";
            } else {
                echo "<div class='error'>No dog found with ID: " . htmlspecialchars($id) . "</div>";
            }

            $conn->close();
        } catch (Exception $e) {
            echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        ?>

        <div class="hint" style="margin-top: 30px;">
        </div>
    </div>
</body>
</html>
