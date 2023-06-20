<?php require_once 'common/header.php'; ?>
<?php require_once 'inc/init.php'; ?>

<div class="container">
    <div class="row text-center">
        <h1>
            Site de location
        </h1>
        <h3>
            Nos dernières locations :
        </h3>
    </div>
    <div class="row d-flex justify-content-between">
        <?php
        $data = $db->prepare('SELECT * FROM `location` ORDER BY titre DESC');
        $data->execute();
        while ($location = $data->fetch(PDO::FETCH_ASSOC)) {
            $locationDebut = afficherDateEnFrancais($location['date_debut']);
            $locationFin = afficherDateEnFrancais($location['date_fin']);
            if (is_array($location)) {
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
                $card .= '<p class="card-text">' . $location['prix'] . '</p>';
                $card .= '<p class="card-text">' . $location['ville'] . '</p>';
                $card .= '<p class="card-text">' . $location['code_postal'] . '</p>';
                $card .= '<p class="card-text">' . $locationDebut . ' - ' . $locationFin . '</p>';
                $card .= '<a href="detail_location.php?id=' . $location['id'] . '" class="btn btn-primary">Voir la location</a>';
                $card .= '</div>';
                $card .= '</div>';
                echo $card;
            }
        }
        ?>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>