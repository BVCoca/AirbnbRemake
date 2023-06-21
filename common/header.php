<?php require_once './inc/init.php'; ?>
<?php linkResource("stylesheet", "/css/style.css"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Airbnb</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon-16x16.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
</head>

<body>
    <div class="logo">
        <a href="index.php"><img src="./img/logo_AIRBNB.png" alt="logo" class="logorbnb"></a>
        <a href="" class=""></a>
        <nav id="fr" class="navbar navbar-expand-lg bg-light-100">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="index.php">Airbnb</a> -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active fr" aria-current="page" href="index.php">Accueil</a>
                            <a class="nav-link active en" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fr" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Changer de langue
                            </a>
                            <a class="nav-link dropdown-toggle en" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Change the language
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item btnFr" href="#">Français</a></li>
                                <li><a class="dropdown-item btnEn" href="#">English</a></li>
                            </ul>
                        </li>
                        <?php if (isLogged()): ?>
                            <li class="nav-item">
                                <a class="nav-link active fr" aria-current="page" href="profil.php">Profil</a>
                                <a class="nav-link active en" aria-current="page" href="profil.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fr" href="ajout_location.php">Ajouter une location</a>
                                <a class="nav-link en" href="ajout_location.php">Add a new location</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link fr" href="inscription.php">Inscription</a>
                                <a class="nav-link en" href="inscription.php">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fr" href="connexion.php">Connexion</a>
                                <a class="nav-link en" href="connexion.php">Sign In</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    <div class="barre" style="display: flex; justify-content: space-evenly; margin-top: 20px; margin-bottom: 30px;">
        <div class="entierM">
            <div>
                <img src="img/comic.png" alt="montagne" classe="montagne">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=wow">Wow</a>
                <a class="en" href="index.php?filtre=wow">Wow !</a>
            </div>
        </div>
        <div class="entierR">
            <div>
                <img src="img/river.png" alt="riviere" classe="riviere">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=lac">Bord de lac</a>
                <a class="en" href="index.php?filtre=lac">At the lake</a>
            </div>
        </div>
        <div class="entierV">
            <div>
                <img src="img/vacations.png" alt="vacation" class="vacation">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=mer">Bord de mer</a>
                <a class="en" href="index.php?filtre=mer">At the sea</a>
            </div>
        </div>
        <div class="entierL">
            <div>
                <img src="img/value.png" alt="luxe" class="luxe">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=luxe">Luxueux</a>
                <a class="en" href="index.php?filtre=luxe">Luxury</a>
            </div>
        </div>
        <div class="entierC">
            <div>
                <img src="img/fortress.png" alt="chateau" class="chateau">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=chateaux">Châteaux</a>
                <a class="en" href="index.php?filtre=chateaux">Castle</a>
            </div>
        </div>
        <div class="entierC">
            <div>
                <img src="img/onwater.png" alt="chateau" class="chateau">
            </div>
            <div>
                <a class="fr" href="index.php?filtre=surEau">Sur l'eau</a>
                <a class="en" href="index.php?filtre=surEau">On the water</a>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">