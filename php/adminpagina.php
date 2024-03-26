<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">

    <title>Document</title>
</head>

<body>

    <header class="header" id="header">
        <nav class="nav container">
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="../php/adminpagina.php" class="nav__link active__link">
                            <i class="ri-user-line"></i>
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

        <a href="gebruikertoevoegen.php" div class="button_plus"></div> </a>
       

        <div class="table-container">
        <form class="filter-form" action="" method="GET">
            <label for="type">Filter op type:</label>
            <select name="type" id="type">
                <option value="">Alle</option>
                <option value="Admin">Admin</option>
                <option value="Monteur">Monteur</option>
                <option value="Klant">Klant</option>
            </select>
            <button type="submit">Zoek</button>
        </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naam</th>
                        <th>Achternaam</th>
                        <th>Wachtwoord</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Telefoonnummer</th>
                        <th>Straatnaam</th>
                        <th>Huisnummer</th>
                        <th>Postcode</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbconn.php';
                    include 'session.php';
                    session_start();

                

                    // Controleer of een filter is toegepast
                    $whereClause = "";
                    if (isset($_GET['type']) && !empty($_GET['type'])) { //Controleert of een filter is toegepast op het gebruikerstype//
                        $type = $_GET['type'];
                        $whereClause = " WHERE Type = '$type'";
                    }

                    // Voer de query uit om alleen gebruikers van het geselecteerde type op te halen
                    $sql = "SELECT * FROM gebruiker" . $whereClause;
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    // Loop door de resultaten en toon elke gebruiker
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['GebruikerID'] . "</td>";
                        echo "<td>" . $row['Naam'] . "</td>";
                        echo "<td>" . $row['Achternaam'] . "</td>";
                        echo "<td>" . $row['Wachtwoord'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Type'] . "</td>";
                        echo "<td>" . $row['Telefoonnummer'] . "</td>";
                        echo "<td>" . $row['Straatnaam'] . "</td>";
                        echo "<td>" . $row['Huisnummer'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-primary btn-sm' href='editgebruiker.php?GebruikerID=" . $row['GebruikerID'] . "'>Edit</a>";
                        echo "<a class='btndelete btn-primary btn-sm' href='gebruikerdelete.php?GebruikerID=" . $row['GebruikerID'] . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </header>

</body>

</html>
