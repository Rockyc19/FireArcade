<?php
include 'dbconn.php';

session_start();


if (isset ($_POST['submit'])) {
    // Get the form input values
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Wachtwoord = $_POST['Wachtwoord'];

    // Invoer valideren: Controleert of de gebruiker een e-mailadres en wachtwoord heeft ingevoerd.//
    // Als dit niet het geval is, wordt een foutmelding gegenereerd en wordt de gebruiker teruggestuurd naar de inlogpagina.
    if (empty ($Email) || empty ($Wachtwoord)) {
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: ../php/login.php");
        exit();
    } else {
        $select = "SELECT `Wachtwoord`, `Naam`, `Type` FROM `gebruiker` WHERE `Email` = '$Email'";
        $result = mysqli_query($conn, $select);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['Wachtwoord'];

            // Verify the password
            if ($Wachtwoord == $storedPassword) {
                // Authentication successful

                // Set session variables
                $_SESSION['Naam'] = $row['Naam'];
                $_SESSION['Type'] = $row['Type'];

                // Redirect the user based on the user type
                switch ($_SESSION['Type']) {
                    case 'Admin':
                        header("Location: ../php/adminpagina.php");
                        exit();
                    case 'Klant':
                        header("Location: ../php/klantpagina.php");
                        exit();
                    case 'Monteur':
                        header("Location: ../php/monteurpagina.php");
                        exit();
                    default:
                        $_SESSION['error'] = "Vekeerde Gebruiker type!";
                        header("Location: ../php/login.php");
                        exit();
                }
            } else {
                $_SESSION['error'] = "Foute email of wachtwoord!";
                header("Location: ../php/login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Foute email of wachtwoord!";
            header("Location: ../php/login.php");
            exit();
        }
    }
}

$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">

            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(../images/Arcade-Stock-Picture.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Welkom</h3>
                                    <spanclass="subtitle">vul uw gegevens in om verder te gaan.</span>

                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">

                                    </p>
                                </div>
                            </div>
                            <form action="#" method="POST" >
                                <div class="form-group mb-3">
                                    <label class="label" for="Email">Email</label>
                                    <input type="email" class="form-control" name="Email" id="Email"
                                        placeholder="naam@mail.com" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="Wachtwoord">Wachtwoord</label>
                                    <input type="password" class="form-control" name="Wachtwoord" id="Wachtwoord"
                                        placeholder="wachtwoord" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit"
                                        class="form-control btn btn-primary rounded submit px-3">Log In</button>
                                </div>
                                <?php if (isset ($_SESSION['error'])) {
                                    echo $_SESSION['error'];
                                    ;
                                    unset($_SESSION['error']);
                                } ?>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left"></div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>