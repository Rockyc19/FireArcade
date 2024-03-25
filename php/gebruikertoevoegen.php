<?php
include 'dbconn.php';
session_start();

// De variabelen $Naam, 
// $Email, $Wachtwoord
// en $User_Type worden ingesteld om de ingevoerde gegevens van het formulier op te slaan.

$Naam = "";
$Achternaam = "";
$Wachtwoord = "";
$Email = "";
$Type = "";
$Telefoonnummer = "";
$Straatnaam = "";
$Huisnummer = "";
$Postcode = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Naam = $_POST["Naam"];
    $Achternaam = $_POST["Achternaam"];
    $Wachtwoord = $_POST["Wachtwoord"];
    $Email = $_POST["Email"];
    $Type = $_POST["Type"];
    $Straatnaam = $_POST["Straatnaam"];
    $Huisnummer = $_POST["Huisnummer"];
    $Postcode = $_POST["Postcode"];

    // Controleer of alle velden zijn ingevuld
    if (empty($Naam) || empty($Achternaam) || empty($Wachtwoord) ||  empty($Email) || empty($Type) || empty($Straatnaam) || empty($Huisnummer) || empty($Postcode)) {
    } else {
        // Hash het wachtwoord voordat het wordt opgeslagen
        $hashed_password = password_hash($Wachtwoord, PASSWORD_DEFAULT);
        
        // Voeg nieuwe gebruiker toe aan de database met het gehashte wachtwoord
        $sql = "INSERT INTO gebruiker (Naam, Achternaam, Wachtwoord, Email, Type, Straatnaam, Huisnummer, Postcode ) VALUES ('$Naam', '$Achternaam', '$hashed_password', '$Email', '$Type', '$Straatnaam', '$Huisnummer', '$Postcode')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['User_Bewerkt'] = "Gebruiker succesvol toegevoegd";
            header("location: ../php/adminpagina.php");
            exit;
        } else {
            $errorMessage = "Fout bij toevoegen van gebruiker: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Gebruiker toevoegen</title>
</head>

<body>

<div class="form-container">
    <form method="post">
        <div class="name-container"> <!-- Hier worden naam, achternaam, wachtwoord en email onder elkaar geplaatst -->
            <div class="mb-3">
                <label for="Naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="Naam" name="Naam" value="<?php echo $Naam; ?>">
            </div>

            <div class="mb-3">
                <label for="Achternaam" class="form-label">Achternaam</label>
                <input type="text" class="form-control" id="Naam" name="Achternaam" value="<?php echo $Achternaam; ?>">
            </div>

            <div class="mb-3">
                <label for="Wachtwoord" class="form-label">Wachtwoord</label>
                <input type="password" class="form-control" id="Wachtwoord" name="Wachtwoord" value="<?php echo $Wachtwoord; ?>">
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>">
            </div>
        </div>

        <div class="other-fields"> <!-- Hier worden type, telefoonnummer, straatnaam, huisnummer en postcode naast elkaar geplaatst -->
            <div class="mb-3">
                <label for="Type" class="user-type-label">Type</label>
                <select class="form-control user-type-select" id="Type" name="Type">
                    <option value="">Selecteer User Type</option>
                    <option value="Gebruiker" <?php if ($Type == "Gebruiker") echo "selected"; ?>>Gebruiker</option>
                    <option value="Admin" <?php if ($Type == "Admin") echo "selected"; ?>>Admin</option>
                    <option value="Klant" <?php if ($Type == "Klant") echo "selected"; ?>>Klant</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Telefoonnummer" class="form-label">Telefoonnummer</label>
                <input type="number" class="form-control" id="Telefoonnummer" name="Telefoonnummer" min="1" max="900000000" value="<?php echo $Telefoonnummer; ?>">
            </div>

            <div class="mb-3">
                <label for="Straatnaam" class="form-label">Straatnaam</label>
                <input type="text" class="form-control" id="Straatnaam" name="Straatnaam" value="<?php echo $Straatnaam; ?>">
            </div>

            <div class="mb-3">
                <label for="Huisnummer" class="form-label">Huisnummer</label>
                <input type="number" class="form-control" id="Huisnummer" name="Huisnummer" min="6" max="500" value="<?php echo $Huisnummer; ?>">
            </div>

            <div class="mb-3">
                <label for="Postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="Postcode" name="Postcode" min="1" max="500" value="<?php echo $Postcode; ?>">
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary btn-sm">Opslaan</button>
            <a class="btn btn-primary btn-sm" href="../php/adminpagina.php" role="button">Annuleren</a>
        </div>
    </form>
</div>

</body>


</html>