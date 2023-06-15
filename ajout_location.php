<?php
require_once 'inc/init.php';

// Redirection de l'utilisateur si il n'est pas connecté à la page de connexion.
// Mis en commentaire en attente de la création de la page connexion.

/* 
if (!isLogged()) {
    header('Location: connexion.php');
}
 */

$errors = [];

$showMessage = '';
?>

<?php require_once 'common/header.php'; ?>
<!-- Titre pour savoir que c'est la page ajout_location.php -->
<h1>Ajouter une location</h1>

<?php require_once 'common/footer.php'; ?>