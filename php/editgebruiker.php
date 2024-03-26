<?php
 include 'dbconn.php';
 include 'session.php';
session_start();

// Controleer of GebruikerID is ingesteld
if (isset ($_GET["GebruikerID"])) {
    $GebruikerID = $_GET["GebruikerID"];

    // Controleer of de gebruiker gegevens heeft verzonden via het formulier
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Haal de gegevens op uit het formulier
        $Naam = $_POST["Naam"];
        $Achternaam = $_POST["Achternaam"];
        $Wachtwoord = $_POST["Wachtwoord"];
        $Email = $_POST["Email"];
        $Type = $_POST["Type"];
        $Telefoonnummer = $_POST["Telefoonnummer"];
        $Straatnaam = $_POST["Straatnaam"];
        $Huisnummer = $_POST["Huisnummer"];
        $Postcode = $_POST["Postcode"];

        // Controleer of alle velden zijn ingevuld
        if (!empty ($Naam) && !empty ($Achternaam) && !empty ($Wachtwoord) && !empty ($Email) && !empty ($Type) && !empty ($Telefoonnummer) && !empty ($Straatnaam) && !empty ($Huisnummer) && !empty ($Postcode)) {
            // Hash het wachtwoord voordat het wordt opgeslagen
            $hashed_password = password_hash($Wachtwoord, PASSWORD_DEFAULT);

            // Update de gebruiker in de database
            $sql = "UPDATE gebruiker SET Naam='$Naam', Achternaam='$Achternaam', Wachtwoord='$hashed_password', Email='$Email', Type='$Type', Straatnaam='$Straatnaam', Telefoonnummer='$Telefoonnummer', Huisnummer='$Huisnummer', Postcode='$Postcode' WHERE GebruikerID=$GebruikerID";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['User_Bewerkt'] = "Gebruiker succesvol bewerkt";
                header("location: ../php/adminpagina.php");
                exit;
            } else {
                $errorMessage = "Fout bij bewerken van gebruiker: " . $conn->error;
            }
        }
    } else {
        // Haal de gegevens van de gebruiker op uit de database om het formulier in te vullen
        $sql = "SELECT * FROM gebruiker WHERE GebruikerID=$GebruikerID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Naam = $row["Naam"];
            $Achternaam = $row["Achternaam"];
            // Wachtwoord wordt niet vooringevuld vanwege veiligheidsredenen
            $Email = $row["Email"];
            $Type = $row["Type"];
            $Telefoonnummer = $row["Telefoonnummer"];
            $Straatnaam = $row["Straatnaam"];
            $Huisnummer = $row["Huisnummer"];
            $Postcode = $row["Postcode"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gebruiker bewerken</title>

</head>

<body>

    <div class="form-container">
        <form method="post">
            <div class="mb-3">
                <label for="Naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="Naam" name="Naam" value="<?php echo $Naam; ?>">
            </div>

            <div class="mb-3">
                <label for="Achternaam" class="form-label">Achternaam</label>
                <input type="text" class="form-control" id="Achternaam" name="Achternaam"
                    value="<?php echo $Achternaam; ?>">
            </div>

            <div class="mb-3">
                <label for="Wachtwoord" class="form-label">Wachtwoord</label>
                <input type="password" class="form-control" id="Wachtwoord" name="Wachtwoord">
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>">
            </div>


            <div class="form-group">
                <label for="Type" class="user-type-label">Type</label>
                <select class="form-control user-type-select" id="Type" name="Type">
                    <option value="">Selecteer User Type</option>
                    <option value="Gebruiker" <?php if ($Type == "Gebruiker")
                        echo "selected"; ?>>Gebruiker</option>
                    <option value="Admin" <?php if ($Type == "Admin")
                        echo "selected"; ?>>Admin</option>
                    <option value="Klant" <?php if ($Type == "Klant")
                        echo "selected"; ?>>Klant</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Telefoonnummer" class="form-label">Telefoonnummer</label>
                <input type="number" class="form-control" id="Telefoonnummer" name="Telefoonnummer" min="1"
                    max="900000000" value="<?php echo $Telefoonnummer; ?>">
            </div>

            <div class="mb-3">
                <label for="Straatnaam" class="form-label">Straatnaam</label>
                <input type="text" class="form-control" id="Straatnaam" name="Straatnaam"
                    value="<?php echo $Straatnaam; ?>">
            </div>

            <div class="mb-3">
                <label for="Huisnummer" class="form-label">Huisnummer</label>
                <input type="number" class="form-control" id="Huisnummer" name="Huisnummer" min="6" max="500"
                    value="<?php echo $Huisnummer; ?>">
            </div>

            <div class="mb-3">
                <label for="Postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="Postcode" name="Postcode" min="1" max="500"
                    value="<?php echo $Postcode; ?>">
            </div>

            <div class="form-group button-container">
                <button type="submit" class="btn btn-primary btn-sm btn-annuleren">Opslaan</button>
                <a class="btn btn-primary btn-sm btn-annuleren" href="../php/adminpagina.php"
                    role="button">Annuleren</a>
            </div>
        </form>
    </div>