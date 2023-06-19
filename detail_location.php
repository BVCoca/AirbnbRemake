<?php require_once 'inc/init.php'; ?>

<?php

// if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
//     header('Location: index.php');
//     exit();
// }
if (isset($_GET['id'])) {
    $data = $db->prepare('SELECT * FROM `location` WHERE id = :id');
    $data->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $data->execute();
}
if ($data->rowCount() <= 0) {
    header('Location: index.php');
    exit();
}
$img = $db->prepare('SELECT `imgName` FROM `image` WHERE `id` = :id');
$img->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$img->execute();
$image = $img->fetch(PDO::FETCH_ASSOC);
var_dump($image);
$location = $data->fetch(PDO::FETCH_ASSOC);
$content = '';
$content .= '<div class="card my-2 img-thumbnail" style="width: 18rem;">';
$content .= '<img src="' . $image['imgName'] . '" class="card-img-top" alt="...">';
$content .= '<div class="card-body">';
$content .= '<h5 class="card-title">' . $location['titre'] . '</h5>';
$content .= '<p class="card-text">' . $location['description'] . '</p>';
$content .= '<p class="card-text">' . $location['prix'] . '</p>';
$content .= '<p class="card-text">' . $location['ville'] . '</p>';
$content .= '<p class="card-text">' . $location['code_postal'] . '</p>';
$content .= '<p class="card-text">' . $location['date_debut'] . ' ' . $location['date_fin'] . '</p>';
$content .= '<a href="detail_location.php?id=' . $location['id'] . '" class="btn btn-primary">Voir la location</a>';
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
</div>

<?php require_once 'common/footer.php';
var_dump($_SESSION);
?>