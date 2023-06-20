<?php require_once 'inc/init.php'; ?>

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
$image = $img->fetch(PDO::FETCH_ASSOC);

$locationDebut = afficherDateEnFrancais($location['date_debut']);
$locationFin = afficherDateEnFrancais($location['date_fin']);

$content = '';
$content .= '<div class="d-flex justify-content-center">';
$content .= '<div style="width: 35rem;">';
$content .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top" alt="...">';
$content .= '<h3 class="card-title">' . $location['titre'] . '</h3>';
$content .= '<h5 class="card-text">' . $location['description'] . '</h5>';
$content .= '<p class="card-text">' . $location['prix'] . '</p>';
$content .= '<p class="card-text">' . $location['ville'] . '</p>';
$content .= '<p class="card-text">' . $location['code_postal'] . '</p>';
$content .= '<p class="card-text">' . $locationDebut . ' - ' . $locationFin . '</p>';
$content .= '<a href="index.php" class="btn btn-primary">Réserver la location</a>';
$content .= '<br>';
$content .= '<br>';
$content .= '<a href="index.php" class="btn btn-primary">Retour vers les locations</a>';
$content .= '</div>';
$content .= '</div>';

?>
<?php require_once 'common/header.php'; ?>

<div class="container">
    <h1 class="text-center">
        Détail de l'article :
        <?= $location['titre'] ?>
    </h1>
    <div class="row">
        <div class="col-md-10 m-auto ">
            <?php echo $content; ?>
        </div>
    </div>
    <h2>Accès :</h2>
    <div class="carte" style="display: flex; justify-content: center; align-items: center; margin-top: 15px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13141.25444086716!2d6.133487039056882!3d46.178449753360304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c7ade25172c85%3A0xe122805a12be20a4!2zRW1tYcO8cyBHZW7DqHZl!5e0!3m2!1sfr!2sfr!4v1687260994973!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>