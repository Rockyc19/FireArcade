<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
    <title>Ticket Overview</title>



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
                    <a href="../php/monteurticketoverzicht.php" class="nav__link">
                        <i class="ri-user-line"></i>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="../php/bestelling.php" class="nav__link active__link ">
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
    // Verbinding met de database maken
    include 'dbconn.php';
    session_start();

    // Query om alle gebruikers van het type "Klant" op te halen
    $sql = "SELECT GebruikerID, Naam FROM gebruiker WHERE Type = 'Klant'";
    $result = $conn->query($sql);

    // Array om gebruikersgegevens op te slaan
    $users = array();

    // Als er gebruikers zijn gevonden
    if ($result->num_rows > 0) { //Controleert of er resultaten zijn gevonden in de query-uitvoer.//
        // Gebruikersgegevens toevoegen aan de array
        while ($row = $result->fetch_assoc()) { //Haalt elke rij met gebruikersgegevens op en slaat deze op in de array $users.//
            $users[] = array(
                'GebruikerID' => $row['GebruikerID'],
                'Naam' => $row['Naam']
            );
        }
    }

    // Query om alle spelkasten op te halen
    $sql = "SELECT SpelkastID, Naam FROM spelkast";
    $result = $conn->query($sql);

    // Array om spelkastgegevens op te slaan
    $spelkasten = array();

    // Als er spelkasten zijn gevonden
    if ($result->num_rows > 0) {
        // Spelkastgegevens toevoegen aan de array
        while ($row = $result->fetch_assoc()) {
            $spelkasten[] = array(
                'SpelkastID' => $row['SpelkastID'],
                'Naam' => $row['Naam']
            );
        }
    }



    // Controleer of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Gegevens ophalen uit het formulier
        $GebruikerID = $_POST['GebruikerID'] ?? '';
        $SpelkastID = $_POST['SpelkastID'] ?? '';
        $Geldigsheidsdatum = $_POST['Geldigsheidsdatum'] ?? '';
        $Datum = $_POST['Datum'] ?? '';

        // Insert query
        $sql = "INSERT INTO bestellingen (GebruikerID, SpelkastID, Geldigheidsdatum, Datum) 
        VALUES ('$GebruikerID', '$SpelkastID', '$Geldigsheidsdatum', '$Datum')";

        // Uitvoeren van de query
        if ($conn->query($sql) === TRUE) { //Hier wordt de SQL-query uitgevoerd om de bestelling in te voegen in de database.//
            echo "Bestelling succesvol aangemaakt!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $ticket_sql = "INSERT INTO ticket (GebruikerID, TicketID, BestellingID, Omschrijving, Type, aanmaakdatum, Is_voltooid) 
        VALUES ('$GebruikerID', '$TicketID', 'Nieuwe bestelling aangemaakt', 'Bestelling', NOW(), 0)";

        // Uitvoeren van de ticket query
        if ($conn->query($ticket_sql) === TRUE) {
            echo "Bestelling en ticket succesvol aangemaakt!";
        } else {
            echo "Error bij het aanmaken van het ticket: " . $conn->error;
        }
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style1.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
        <title>Nieuwe Bestelling</title>
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
                        <a href="../php/monteurticketoverzicht.php" class="nav__link">
                            <i class="ri-user-line"></i>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="../php/bestelling.php" class="nav__link active__link ">
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

        <div class="form-container">
            <form method="post">
                <div class="mb-3">
                    <label for="GebruikerID" class="form-label">Klant</label>
                    <select name="GebruikerID" class="form-control">
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['GebruikerID']; ?>">
                                <?php echo $user['Naam']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="SpelkastID" class="form-label">Console</label>
                    <select name="SpelkastID" class="form-control">
                        <?php foreach ($spelkasten as $spelkast): ?>
                            <option value="<?php echo $spelkast['SpelkastID']; ?>">
                                <?php echo $spelkast['Naam']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Geldigsheidsdatum" class="form-label">Garantie (2 jaar standaard)</label>
                    <select name="Geldigsheidsdatum" class="form-control">
                        <?php foreach (range(2, 6) as $year): ?>
                            <?php $selected = ($year == $_POST['Geldigsheidsdatum']) ? 'selected' : ''; ?>
                            <option value="<?php echo $year; ?>" <?php echo $selected; ?>>
                                <?php echo $year; ?> jaar
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Datum" class="form-label">Aangemaakt</label>
                    <input type="date" class="form-control" id="Datum" name="Datum"
                        value="<?php echo date('Y-m-d'); ?>">
                </div>

                <input type="submit" value="Bestelling Aanmaken">
            </form>
        </div>

    </body>

    </html>