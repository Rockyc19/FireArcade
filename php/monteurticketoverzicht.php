<?php
    include_once 'dbconn.php';

    session_start();

    if(empty($_SESSION['Naam']) || $_SESSION['Naam'] == ''){
        header("Location: ../php/login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Overview</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Ticket Overview</h2>
    <?php
    // Retrieve tickets from the database
    $sql = "SELECT * FROM Tickets";
    $result = mysqli_query($conn, $sql);

    // Check if any tickets are found
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Ticket ID</th><th>User ID</th><th>Order ID</th><th>Description</th><th>Type</th><th>Creation Date</th><th>Completed</th></tr>";
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row["TicketID"]."</td>";
            echo "<td>".$row["GebruikerID"]."</td>";
            echo "<td>".$row["BestellingID"]."</td>";
            echo "<td>".$row["Omschrijving"]."</td>";
            echo "<td>".$row["Type"]."</td>";
            echo "<td>".$row["Aanmaakdatum"]."</td>";
            echo "<td>".($row["Is_Voltooid"] ? 'Yes' : 'No')."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No tickets found";
    }

    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>
