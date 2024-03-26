<?php
include_once 'dbconn.php';

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Ticket Form</title>
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
                    <option value="Product2">Product 2</option>
                    <option value="Product3">Product 3</option>
                    <option value="Product4">Product 4</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Create Ticket">
            </div>
        </form>
    </div>
</body>
</html>
