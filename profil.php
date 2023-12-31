<?php require_once 'inc/init.php'; ?>
<?php linkResource("stylesheet", "common/style.css"); ?>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id_location = $_GET['id_location'];
    $query = $db->prepare('SELECT * FROM location WHERE id = :id_location');
    $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
    if ($query->execute()) {
        $infoLocation = $query->fetch(PDO::FETCH_ASSOC);
        $req = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
        $req->bindValue(':id_location', $infoLocation['id'], PDO::PARAM_INT);
        $req->execute();
        $infoImage = $req->fetch(PDO::FETCH_ASSOC);
        if ($infoLocation['id_user'] == $_SESSION['user']['id']) {
            $query = $db->prepare('DELETE FROM location WHERE id = :id_location');
            $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
            unlink(URLUNLINK . $infoImage['imgName']);
            if ($query->execute()) {
                header('Location: profil.php');
            }
        }
    } else {
        $showMessage .= '<div class="alert alert-danger">Une erreur est survenue</div>';
    }
}


if (!isLogged()) {
    header('Location: connexion.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

$data = $db->prepare('SELECT * FROM location WHERE id_user = :user_id');
$data->bindValue(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
$data->execute();

$locations = $data->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once 'common/header.php'; ?>

<div class="container">
    <div class="row text-center">
        <h1 class="display-1 my-3">
            Mon compte
        </h1>
    </div>

    <div class="container">
        <div class="card">
            <h5 class="card-header">Vos Infos</h5>
            <div class="card-body">
                <h5 class="card-title">
                    <?= $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>
                </h5>
                <p class="card-text">
                    <?= $_SESSION['user']['email']; ?>
                </p>
                <a href="ajout_location.php" class="btn btn-outline-primary">Ajout d'une annonce</a>
                <a href="profil.php?action=logout" class="btn btn-danger">Deconnexion</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h4 class="text-center my-4">
            Vos annonces
        </h4>
        <?php if (count($locations) <= -0) : ?>
            <div class="alert alert-info">
                Vous n'avez pas encore d'annonces
            </div>
        <?php else : ?>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <?php
                        for ($i = 0; $i < $data->columnCount(); $i++) {
                            $colonne = $data->getColumnMeta($i);
                            echo "<th>$colonne[name]</th>";
                        }
                        echo '<th>Photo</th>';
                        echo '<th>Actions</th>';

                        foreach ($locations as $location) {
                            $img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
                            $img->bindValue(':id_location', $location['id'], PDO::PARAM_INT);
                            $img->execute();

                            $image = $img->fetch(PDO::FETCH_ASSOC);
                            echo '<tr>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['id'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['id_user'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['titre'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . substr($location['description'], 0, 20) . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['prix'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['ville'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['code_postal'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['date_debut'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle; width:100px;">' . $location['date_fin'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;">' . $location['filtre'] . '</td>';
                            echo '<td style="text-align:center; vertical-align:middle;"> <img class="img-fluid w-50" src="' . URL . $image['imgName'] . '"></td>';
                            echo '<td><a href="ajout_location.php?action=update&id_location=' . $location['id'] . '" class="btn btn-warning mt-4 mb-2">Modifier</a>
                            <a href="profil.php?action=delete&id_location=' . $location['id'] . '" class="btn btn-danger mb-4 mt-2">Supprimer</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tr>
                </thead>

            </table>
        <?php endif; ?>


    </div>
</div>
<?php require_once 'common/footer.php'; ?>