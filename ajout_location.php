<?php
require_once 'inc/init.php';

// Redirection de l'utilisateur si il n'est pas connecté à la page de connexion.

if (!isLogged()) {
    header('Location: connexion.php');
}

$errors = [];

$showMessage = '';
?>

<?php require_once 'common/header.php'; ?>


<?php require_once 'common/footer.php'; ?>