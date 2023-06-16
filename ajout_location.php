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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Failles XSS
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(addslashes($value));
    }

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $codePostal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    $dateD = isset($_POST['dateD']) ? $_POST['dateD'] : '';
    $dateF = isset($_POST['dateF']) ? $_POST['dateF'] : '';

    // A faire : Gestion de l'image
}
?>

<?php require_once 'common/header.php'; ?>
<!-- Titre pour savoir que c'est la page ajout_location.php -->
<h1>Ajouter une location</h1>

<div class="row">
    <div class="col-md-9 m-auto">
        <?= $showMessage ?>
        <form action="" method="post" enctype="multipart/form-data">

            <label for="titre" class="mb-3">Titre :</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Insérer le titre de la location" name="titre">
            </div>

            <label for="description" class="mb-3">Description :</label>
            <div class="input-group mb-3">
                <textarea name="description" class="form-control" placeholder="Insérer les équipements, le nombre de pièces, le type de pièces, etc.." rows="10"></textarea>
            </div>

            <label for="ville" class="mb-3">Lieux :</label>
            <div class="input-group mb-3">
                <!-- Voir pour modifier la base de données champ lieux -> ville et code_postal -->
                <input type="text" class="form-control" placeholder="Ajouter une ville" name="ville">
                <input type="text" class="form-control" placeholder="Code Postal" name="code_postal">
            </div>

            <label for="prix" class="mb-3">Prix :</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Insérer le prix de la location" name="prix">
            </div>

            <div class="input-group mb-3 d-flex justify-content-around">
                <label for="dateD">Date début :</label>
                <label for="dateF" class="ml-3">Date fin :</label>
            </div>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="dateD">
                <input type="date" class="form-control" name="dateF">
            </div>

            <label for="image" class="mb-3">Ajout au moins d'une image :</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" placeholder="image" name="image">
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>

        </form>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>