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
    <div class="entier fr">
        <a href="index.php?filtre=wow">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/comic.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Wow !
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=wow">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/comic.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Wow !
                </p>
            </div>
        </a>
    </div>
    <div class="entier fr">
        <a href="index.php?filtre=lac">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/river.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Bord de lac
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=lac">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/river.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    At the lake
                </p>
            </div>
        </a>
    </div>
    <div class="entier fr">
        <a href="index.php?filtre=mer">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/vacations.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Bord de mer
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=mer">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/vacations.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    At the sea
                </p>
            </div>
        </a>
    </div>
    <div class="entier fr">
        <a href="index.php?filtre=luxe">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/value.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Luxueux
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=luxe">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/value.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Luxury
                </p>
            </div>
        </a>
    </div>
    <div class="entier fr">
        <a href="index.php?filtre=chateaux">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/fortress.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Châteaux
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=chateaux">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/fortress.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Castle
                </p>
            </div>
        </a>
    </div>

    <div class="entier fr">
        <a href="index.php?filtre=surEau">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/onwater.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    Sur l'eau
                </p>
            </div>
        </a>
    </div>
    <div class="entier en">
        <a href="index.php?filtre=surEau">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <img src="img/onwater.png" alt="montagne" classe="montagne">
                </div>
                <p>
                    On the water
                </p>
            </div>
        </a>
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