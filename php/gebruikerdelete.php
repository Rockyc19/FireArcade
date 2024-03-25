<?php
session_start();

// Controleer of GebruikerID is ingesteld
if(isset($_GET["GebruikerID"])) {
    $GebruikerID = $_GET["GebruikerID"];

    // Controleer of de bevestigingsparameter is ingesteld
    if(isset($_GET["confirm"]) && $_GET["confirm"] == "true") {
        // Voer de verwijderingsquery uit als bevestigd
        include 'dbconn.php';
        $sql = "DELETE FROM gebruiker WHERE GebruikerID = $GebruikerID";
        $conn->query($sql);
        $conn->close();

        // Stuur de gebruiker terug naar het bedrijfsdashboard na verwijdering
        header("location: ../php/adminpagina.php");
        exit;
    } else {
        // Toon een bevestigingsvraag als de bevestigingsparameter niet is ingesteld
        echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>";
        echo "Weet je zeker dat je deze gebruiker wilt verwijderen?<br>";
        echo "<a href='gebruikerdelete.php?GebruikerID=$GebruikerID&confirm=true'>Ja</a> | ";
        echo "<a href='../php/adminpagina.php'>Nee</a>";
    }
} else {
    // Als GebruikerID niet is ingesteld, stuur de gebruiker terug naar het bedrijfsdashboard
    header("location: ../php/adminpagina.php");
    exit;
}
