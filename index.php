<?php require_once 'common/header.php'; ?>
<?php require_once 'inc/init.php';
linkResource("stylesheet", "common/style.css");


$req = $db->prepare('SELECT DISTINCT (filtre) FROM location');
$req->execute();


// while ($filtres = $req->fetch(PDO::FETCH_ASSOC)) {
//     $linkFiltre .= "<a href='?filtre=" . $filtres['filtre'] . "'>" . $filtres['filtre'] . "</a><br>";
// }

if (isset($_GET['filtre'])) {
    $req1 = $db->prepare('SELECT * FROM location WHERE filtre = :filtre');
    $req1->bindValue(':filtre', $_GET['filtre'], PDO::PARAM_STR);
    $req1->execute();

    if ($req1->rowCount() <= 0) {
        $searchFilter .= "Aucune location disponible";
        $searchFilter .= '<a href="index.php" class="btn btn-primary fr">Retour vers les locations</a>';
    }

    while ($locations = $req1->fetch(PDO::FETCH_ASSOC)) {
        if (is_array($locations)) {
            $locationDebut = afficherDateEnFrancais($locations['date_debut']);
            $locationFin = afficherDateEnFrancais($locations['date_fin']);

            $img = $db->prepare('SELECT `imgName` FROM `image` WHERE id_location = :id_location');
            $img->bindValue(':id_location', $locations['id'], PDO::PARAM_INT);
            $img->execute();
            $image = $img->fetch(PDO::FETCH_ASSOC);

            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="lienCarte">';
            $content .= '<div class="carteIndex" style="width: 15rem;">';
            $content .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top mb-3" alt="...">';
            $content .= '<div class="carteBody">';
            $content .= '<h5 class="card-title">' . $locations['titre'] . '</h5>';
            /* $content .= '<p class="card-text">' . substringsfn($locations['description'], 50) . '</p>'; */
            $content .= '<p class="card-text"> À ' . $locations['ville'] . '</p>';
            /*  $content .= '<p class="card-text">' . $locations['code_postal'] . '</p>'; */
            $content .= '<p class="card-text">' . $locations['prix'] . ' €</p>';
            $content .= '<p class="card-text">' . $locationDebut . ' au ' . $locationFin . '</p>';
            /* $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary fr">Voir la location</a>';
            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary en">See more</a>'; */
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</a>';
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

            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="lienCarte">';
            $content .= '<div class="carteIndex" style="width: 15rem;">';
            $content .= '<img src="' . URL . $image['imgName'] . '" class="card-img-top mb-3" alt="...">';
            $content .= '<div class="carteBody">';
            $content .= '<h5 class="card-title">' . $locations['titre'] . '</h5>';
            /* $content .= '<p class="card-text">' . substringsfn($locations['description'], 50) . '</p>'; */
            $content .= '<p class="card-text"> À ' . $locations['ville'] . '</p>';
            /*  $content .= '<p class="card-text">' . $locations['code_postal'] . '</p>'; */
            $content .= '<p class="card-text">' . $locations['prix'] . ' €</p>';
            $content .= '<p class="card-text">' . $locationDebut . ' au ' . $locationFin . '</p>';
            /* $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary fr">Voir la location</a>';
            $content .= '<a href="detail_location.php?id=' . $locations['id'] . '" class="btn btn-primary en">See more</a>'; */
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</a>';
        }
    }
}


?>
<?php //$linkFiltre 
?>
<div class="barre" style="display: flex; justify-content: space-evenly; margin-top: 20px; margin-bottom: 30px;">
    <div class="entierM">
        <div>
            <img src="img/comic.png" alt="montagne" classe="montagne">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=wow">Wow !</a>
            <a class="en" href="index.php?filtre=wow">Wow !</a>
        </div>
    </div>
    <div class="entierR">
        <div>
            <img src="img/river.png" alt="riviere" classe="riviere">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=lac">Bord de lac</a>
            <a class="en" href="index.php?filtre=lac">At the lake</a>
        </div>
    </div>
    <div class="entierV">
        <div>
            <img src="img/vacations.png" alt="vacation" class="vacation">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=mer">Bord de mer</a>
            <a class="en" href="index.php?filtre=mer">At the sea</a>
        </div>
    </div>
    <div class="entierL">
        <div>
            <img src="img/value.png" alt="luxe" class="luxe">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=luxe">Luxueux</a>
            <a class="en" href="index.php?filtre=luxe">Luxury</a>
        </div>
    </div>
    <div class="entierC">
        <div>
            <img src="img/fortress.png" alt="chateau" class="chateau">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=chateaux">Châteaux</a>
            <a class="en" href="index.php?filtre=chateaux">Castle</a>
        </div>
    </div>
    <div class="entierC">
        <div>
            <img src="img/onwater.png" alt="chateau" class="chateau">
        </div>
        <div>
            <a class="fr" href="index.php?filtre=surEau">Sur l'eau</a>
            <a class="en" href="index.php?filtre=surEau">On the water</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row text-center">
        <h3 class="fr">
            Nos locations :
        </h3>
        <h3 class="en">
            Our rentals :
        </h3>
    </div>
    <div class="container d-flex justify-content-between mt-5">
        <?php echo $searchFilter; ?>
        <?php echo $content; ?>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>