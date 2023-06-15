<?php

// Fonction pour vérifier si l'utilisateur est connecté.
function isLogged()
{
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
