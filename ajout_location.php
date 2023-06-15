<?php
require_once 'inc/init.php';

// Redirection de l'utilisateur si il n'est pas connecté à la page de connexion.

if (!isLogged()) {
    header('Location: connexion.php');
}
