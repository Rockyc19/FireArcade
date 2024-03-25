<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style1.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
<title>Ticket Overview</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .edit-form input[type="submit"] {
        padding: 5px 10px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }

    .completed {
        color: green;
    }

    .not-completed {
        color: red;
    }
</style>
</head>
<body>
<nav class="nav container">
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="../php/monteurpagina.php" class="nav__link">
                            <i class="ri-home-5-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="../php/monteurticketoverzicht.php" class="nav__link active__link">
                            <i class="ri-user-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="../php/contractbeheer.php" class="nav__link">
                            <i class="ri-service-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="" class="nav__link">
                            <i class="ri-service-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="" class="nav__link">
                            <i class="ri-service-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="../php/logout.php" class="nav__link">
                            <i class="ri-logout-box-r-line"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
<?php
include_once 'dbconn.php';

session_start();

if(empty($_SESSION['Naam']) || $_SESSION['Naam'] == ''){
    header("Location: ../php/login.php");
    die();
}

// Function to update completion status
function updateCompletionStatus($ticketID, $status) {
    global $conn;
    $status = ($status == 1) ? 0 : 1; // Toggle status
    $sql = "UPDATE ticket SET Is_Voltooid = $status WHERE TicketID = $ticketID";
    mysqli_query($conn, $sql);
}

// Handle form submission for updating completion status
if(isset($_POST['submit'])) {
    $ticketID = $_POST['ticketID'];
    $status = $_POST['status'];
    updateCompletionStatus($ticketID, $status);
}

// Retrieve tickets from the database
$sql = "SELECT * FROM ticket";
$result = mysqli_query($conn, $sql);

// Check if any tickets are found
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Ticket ID</th><th>User ID</th><th>Order ID</th><th>Description</th><th>Type</th><th>Creation Date</th><th>Completed</th><th>Action</th></tr>";
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row["TicketID"]."</td>";
        echo "<td>".$row["GebruikerID"]."</td>";
        echo "<td>".$row["BestellingID"]."</td>";
        echo "<td>".$row["Omschrijving"]."</td>";
        echo "<td>".$row["Type"]."</td>";
        echo "<td>".$row["Aanmaakdatum"]."</td>";
        if ($row["Is_Voltooid"]) {
            echo "<td class='completed'>Yes</td>";
            echo "<td>";
            echo "<form class='edit-form' method='post'>";
            echo "<input type='hidden' name='ticketID' value='".$row["TicketID"]."'>";
            echo "<input type='hidden' name='status' value='".$row["Is_Voltooid"]."'>";
            echo "<input type='submit' name='submit' value='Toggle Status' class='edit-btn completed'>";
            echo "</form>";
            echo "</td>";
        } else {
            echo "<td class='not-completed'>No</td>";
            echo "<td>";
            echo "<form class='edit-form' method='post'>";
            echo "<input type='hidden' name='ticketID' value='".$row["TicketID"]."'>";
            echo "<input type='hidden' name='status' value='".$row["Is_Voltooid"]."'>";
            echo "<input type='submit' name='submit' value='Toggle Status' class='edit-btn not-completed'>";
            echo "</form>";
            echo "</td>";
        }
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
