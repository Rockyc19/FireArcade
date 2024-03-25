<?php
session_start();

include_once 'dbconn.php';

if(empty($_SESSION['GebruikerID']) || $_SESSION['GebruikerID'] == ''){
    header("Location: ../php/login.php");
    die();
}

// Retrieve the current user's UserID from the session
$currentUserID = $_SESSION['GebruikerID'];

// Retrieve tickets associated with the current user's UserID
$sql = "SELECT * FROM ticket WHERE GebruikerID = $currentUserID";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
</head>
<style>
    /* CSS for styling the ticket container and table */
    * {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    
.ticket-container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.ticket-container h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
    .ticket-container {
        padding: 15px;
    }

    table {
        font-size: 14px;
    }
}

</style>
<body>
    <nav class="nav container">
        <div class="nav__menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="../php/klantpagina.php" class="nav__link">
                        <i class="ri-home-5-line"></i>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="../php/klantticketoverzicht.php" class="nav__link active__link">
                        <i class="ri-user-line"></i>
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

    <div class="ticket-container">
        <h2>Your Tickets:</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Ticket ID</th><th>Order ID</th><th>Description</th><th>Type</th><th>Creation Date</th><th>Completed</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row["TicketID"]."</td>";
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
        ?>
    </div>
</body>
</html>
