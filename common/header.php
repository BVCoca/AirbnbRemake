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
        <img src="./img/logo_AIRBNB.png" alt="logo" class="logorbnb" href="index.php">
        <nav class="navbar navbar-expand-lg bg-light-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Airbnb</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <?php if (isLogged()): ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="profil.php">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ajout_location.php">Ajouter une location</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription.php">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
    </div>
    <div class="barre" style="display: flex; justify-content: space-evenly; margin-top: 20px; margin-bottom: 30px;">
        <div class="entierM">
            <div>
                <img src="img/comic.png" alt="montagne" classe="montagne">
            </div>
            <div>
                <a href="index.php?filtre=wow">Wow</a>
            </div>
        </div>
        <div class="entierR">
            <div>
                <img src="img/river.png" alt="riviere" classe="riviere">
            </div>
            <div>
                <a href="index.php?filtre=lac">Bord de lac</a>
            </div>
        </div>
        <div class="entierV">
            <div>
                <img src="img/vacations.png" alt="vacation" class="vacation">
            </div>
            <div>
                <a href="index.php?filtre=mer">Bord de mer</a>
            </div>
        </div>
        <div class="entierL">
            <div>
                <img src="img/value.png" alt="luxe" class="luxe">
            </div>
            <div>
                <a href="index.php?filtre=luxe">Luxueux</a>
            </div>
        </div>
        <div class="entierC">
            <div>
                <img src="img/fortress.png" alt="chateau" class="chateau">
            </div>
            <div>
                <a href="index.php?filtre=chateaux">Châteaux</a>
            </div>
        </div>
        <div class="entierC">
            <div>
                <img src="img/onwater.png" alt="chateau" class="chateau">
            </div>
            <div>
                <a href="index.php?filtre=surEau">Sur l'eau</a>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">