<?php 
include 'dbconn.php';
 ?>

<html>

<head>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
</head>

<body>
    <div class="container">
        <div class="greeting">
            <h1>Hallo monteur,</h1>
            <p>Welkom op uw monteurpagina. Hier heeft u toegang tot de tickets van onze klanten en kunt u deze bekijken
                en beheren.</p>
        </div>

        <nav class="nav">
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="../php/monteurpagina.php" class="nav__link active__link">
                            <i class="ri-home-5-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="../php/monteurticketoverzicht.php" class="nav__link">
                            <i class="ri-user-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="../php/bestelling.php" class="nav__link">
                            <i class="ri-product-hunt-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <i class="ri-service-line"></i>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link">
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
    </div>
</body>

</html>