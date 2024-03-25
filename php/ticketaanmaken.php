<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firearcade";

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO `ticket`(`Omschrijving`, `Type`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Get data from form
    $Omschrijving = $_POST['Omschrijving'];
    $Type = $_POST['Type'];

    // Bind parameters
    $stmt->bind_param("ss", $Omschrijving, $Type);

    // Execute SQL statement
    if ($stmt->execute()) {
        $message = "New record created successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Form</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create New Ticket</h2>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="Omschrijving">Omschrijving:</label>
                <textarea id="Omschrijving" name="Omschrijving" required></textarea>
            </div>
            <div class="form-group">
                <label for="Type">Type:</label>
                <input type="text" id="Type" name="Type" required>
            </div>
            <div class="form-group">
                <label for="Product">Product:</label>
                <select id="Product" name="Product" required>
                    <option value="Product1">Product 1</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Create Ticket">
            </div>
        </form>
    </div>
</body>
</html>
