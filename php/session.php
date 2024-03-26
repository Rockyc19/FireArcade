<?php if(empty($_SESSION['Naam']) || $_SESSION['Naam'] == ''){
    header("Location: ../php/login.php");
    die(); 
}