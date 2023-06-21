<?php require_once 'common/header.php'; ?>
<?php require_once 'inc/init.php';
linkResource("stylesheet", "common/style.css");


$req = $db->prepare('SELECT DISTINCT (filtre) FROM location');
$req->execute();
$content = '';
$linkFiltre = '';


// while ($filtres = $req->fetch(PDO::FETCH_ASSOC)) {
//     $linkFiltre .= "<a href='?filtre=" . $filtres['filtre'] . "'>" . $filtres['filtre'] . "</a><br>";
// }

if (isset($_GET['filtre'])) {
    $req1 = $db->prepare('SELECT * FROM location WHERE filtre = :filtre');
    $req1->bindValue(':filtre', $_GET['filtre'], PDO::PARAM_STR);
    $req1->execute();

    if ($req1->rowCount() <= 0) {
        header('location: index.php');
        exit();
    }

    while ($locations = $req1->fetch(PDO::FETCH_ASSOC)) {
        if (is_array($locations)) {
            $locationDebut = afficherDateEnFrancais($locations['date_debut']);
            $locationFin = afficherDateEnFrancais($locations['date_fin']);

            $img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
            $img->bindValue(':id_location', $locations['id'], PDO::PARAM_INT);
            $img->execute();
            $image = $img->fetch(PDO::FETCH_ASSOC);

            $content .= '<div class="card my-2 img-thumbnail" style="width: 18rem;">';
            $content .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top" alt="...">';
            $content .= '<div class="card-body">';
            $content .= '<h5 class="card-title">' . $locations['titre'] . '</h5>';
            $content .= '<p class="card-text">' . substringsfn($locations['description'], 50) . '</p>';
            $content .= '<p class="card-text">' . $locations['prix'] . ' €</p>';
            $content .= '<p class="card-text">' . $locations['ville'] . '</p>';
            $content .= '<p class="card-text">' . $locations['code_postal'] . '</p>';
            $content .= '<p class="card-text">' . $locationDebut . ' - ' . $locationFin . '</p>';
            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary">Voir la location</a>';
            $content .= '</div>';
            $content .= '</div>';
        }
    }
} else {
    $req2 = $db->prepare('SELECT * FROM location');
    $req2->execute();

    while ($locations = $req2->fetch(PDO::FETCH_ASSOC)) {
        if (is_array($locations)) {
            $locationDebut = afficherDateEnFrancais($locations['date_debut']);
            $locationFin = afficherDateEnFrancais($locations['date_fin']);

            $img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
            $img->bindValue(':id_location', $locations['id'], PDO::PARAM_INT);
            $img->execute();
            $image = $img->fetch(PDO::FETCH_ASSOC);

            $content .= '<div class="card my-2 img-thumbnail" style="width: 18rem;">';
            $content .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top" alt="...">';
            $content .= '<div class="card-body">';
            $content .= '<h5 class="card-title">' . $locations['titre'] . '</h5>';
            $content .= '<p class="card-text">' . substringsfn($locations['description'], 50) . '</p>';
            $content .= '<p class="card-text">' . $locations['prix'] . ' €</p>';
            $content .= '<p class="card-text">' . $locations['ville'] . '</p>';
            $content .= '<p class="card-text">' . $locations['code_postal'] . '</p>';
            $content .= '<p class="card-text">' . $locationDebut . ' - ' . $locationFin . '</p>';
            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary">Voir la location</a>';
            $content .= '</div>';
            $content .= '</div>';
        }
    }
}


?>
<?php //$linkFiltre ?>

<div class="container">
    <div class="row text-center">
        <h3>
            Nos locations :
        </h3>
    </div>
    <div class="row d-flex justify-content-between">
        <?php echo $content; ?>
        <?php
        /*  $data = $db->prepare('SELECT * FROM `location` ORDER BY titre DESC');
        $data->execute();
        while ($location = $data->fetch(PDO::FETCH_ASSOC)) {


            if (is_array($location)) {
                $locationDebut = afficherDateEnFrancais($location['date_debut']);
                $locationFin = afficherDateEnFrancais($location['date_fin']);
                $author = $db->prepare('SELECT `id`, `nom`, `prenom`, `password`, `email`, `telephone` FROM `users` WHERE id = :id_user');
                $author->bindValue(':id_user', $location['id'], PDO::PARAM_INT);
                $author->execute();

                $img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
                $img->bindValue(':id_location', $location['id'], PDO::PARAM_INT);
                $img->execute();

                $image = $img->fetch(PDO::FETCH_ASSOC);
                $card = '';
                $card .= '<div class="card my-2 img-thumbnail" style="width: 18rem;">';
                $card .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top" alt="...">';
                $card .= '<div class="card-body">';
                $card .= '<h5 class="card-title">' . $location['titre'] . '</h5>';
                $card .= '<p class="card-text">' . substringsfn($location['description'], 50) . '</p>';
                $card .= '<p class="card-text">' . $location['prix'] . ' €</p>';
                $card .= '<p class="card-text">' . $location['ville'] . '</p>';
                $card .= '<p class="card-text">' . $location['code_postal'] . '</p>';
                $card .= '<p class="card-text">' . $locationDebut . ' - ' . $locationFin . '</p>';
                $card .= '<a href="detail_location.php?id=' . $location['id'] . '" class="btn btn-primary">Voir la location</a>';
                $card .= '</div>';
                $card .= '</div>';
                echo $card;
            }
        } */
        ?>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>