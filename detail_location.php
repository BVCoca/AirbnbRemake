<?php require_once 'inc/init.php'; ?>
<?php linkResource("stylesheet", "common/style.css"); ?>

<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_GET['id'])) {
    $data = $db->prepare('SELECT * FROM `location` WHERE id = :id');
    $data->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $data->execute();
}
if ($data->rowCount() <= 0) {
    header('Location: index.php');
    exit();
}
$location = $data->fetch(PDO::FETCH_ASSOC);

$img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
$img->bindValue(':id_location', $location['id'], PDO::PARAM_INT);
$img->execute();


$locationDebut = afficherDateEnFrancais($location['date_debut']);
$locationFin = afficherDateEnFrancais($location['date_fin']);

$content = '';
$content .= '<div class="carteAll">';
$content .= '<div class="containerImg">';
while ($image = $img->fetch(PDO::FETCH_ASSOC)) {
    $content .= '<img class="carteImg" src="' . URL . $image['imgName'] . '" alt="...">';
}
$content .= '</div>';
$content .= '<div class="carteTexte">';
$content .= '<h3>' . $location['titre'] . '</h3>';
$content .= '<h5>' . $location['description'] . '</h5>';
$content .= '<p>' . $location['prix'] . ' €</p>';
$content .= '<p>' . $location['ville'] . '</p>';
$content .= '<p>' . $location['code_postal'] . '</p>';
$content .= '<p>' . $locationDebut . ' - ' . $locationFin . '</p>';
$content .= '</div>';
$content .= '<div class="boutons">';
$content .= '<a href="index.php" class="fr">Réserver la location</a>';
$content .= '<a href="index.php" class="en">Reserve the rental</a>';
$content .= '<br>';
$content .= '<a href="index.php" class="fr">Retour vers les locations</a>';
$content .= '<a href="index.php" class="en">Back to rentals</a>';
$content .= '</div>';
$content .= '</div>';

?>
<?php require_once 'common/header.php'; ?>

<div class="container">
    <h1 class="text-center fr">
        Détail de la location
        <?= $location['titre'] ?>
    </h1>
    <h1 class="text-center en">
        Details of the rental
        <?= $location['titre'] ?>
    </h1>
    <div class="row">
        <div class="col-md-10 m-auto ">
            <?php echo $content; ?>
        </div>
    </div>

    <h2 class="fr">Accès :</h2>
    <h2 class="en">Access :</h2>
    <div class="carte">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13141.25444086716!2d6.133487039056882!3d46.178449753360304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c7ade25172c85%3A0xe122805a12be20a4!2zRW1tYcO8cyBHZW7DqHZl!5e0!3m2!1sfr!2sfr!4v1687260994973!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>