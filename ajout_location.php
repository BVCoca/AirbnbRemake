<?php
require_once 'inc/init.php';
?>
<?php linkResource("stylesheet", "common/style.css"); ?>

<?php
// Redirection de l'utilisateur si il n'est pas connecté à la page de connexion.
// Mis en commentaire en attente de la création de la page connexion.

if (!isLogged()) {
    header('Location: connexion.php');
}


$errors = [];

$showMessage = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $codePostal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    $dateD = isset($_POST['dateD']) ? $_POST['dateD'] : '';
    $dateF = isset($_POST['dateF']) ? $_POST['dateF'] : '';
    $filtre = isset($_POST['filtres']) ? $_POST['filtres'] : '';
    $image = isset($_POST['image']) ? $_POST['image'] : '';

    if (isset($_GET['action']) && $_GET['action'] == 'update') {
        $nomImage = $_POST['oldImage'];
    }

    if (empty($titre)) {
        $errors['titre'] = "Le titre est obligatoire";
    }

    if (empty($description)) {
        $errors['description'] = "La description est obligatoire";
    } elseif (strlen($description) < 20) {
        $errors['description'] = "La description doit faire minimum 20 caractères";
    }

    if (empty($ville)) {
        $errors['ville'] = "La ville est obligatoire";
    }

    if (empty($codePostal)) {
        $errors['codePostal'] = "Le code postal est obligatoire";
    } elseif (!is_numeric($codePostal) || strlen($codePostal) !== 5) {
        $errors['codePostal'] = "Le format du code postal n'est pas correct.";
    }

    if (empty($prix)) {
        $errors['prix'] = "Le prix est obligatoire";
    } elseif (!is_numeric($prix) || $prix <= 0) {
        $errors['prix'] = "Le format du prix n'est pas correct.";
    }

    if (empty($dateD) || empty($dateF)) {
        $errors['date'] = "La date est obligatoire";
    } elseif ($dateD > $dateF) {
        $errors['date'] = "La date d'arrivée ne peut pas être après la date de fin";
    } elseif ($dateD < date('Y-m-d')) {
        $errors['date'] = "La date d'arrivée ne peut pas être antérieur à la date d'aujourd'hui";
    }

    if (empty($filtre)) {
        $errors['filtre'] = "Le filtre est obligatoire";
    }

    // Gestion de l'image

    if (!empty($_FILES['image']['name'])) {
        $tabExt = ['jpg', 'png', 'jpeg']; // Les extensions de fichiers autorisées

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        if (!in_array($extension, $tabExt)) {
            $errors['image'] = "L'extension n'est pas valide";
        }

        if ($_FILES['image']['size'] > 8000000) {
            $errors['image'] = "L'image ne doit pas dépasser 8Mo";
        }
        $nomImage = bin2hex(random_bytes(16)) . '.' . $extension;
        move_uploaded_file($_FILES['image']['tmp_name'], BASE . $nomImage);
    }

    if (empty($errors)) {

        if (isset($_GET['action']) && $_GET['action'] == 'update') {
            $id_location = $_POST['id'];
            $query = $db->prepare('UPDATE `location` SET `titre`=:titre,`description`=:description,`prix`=:prix,`ville`=:ville,`code_postal`=:code_postal,`date_debut`=:date_debut,`date_fin`=:date_fin, `filtre`=:filtre WHERE id = :id_location');
            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_INT);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':code_postal', $codePostal, PDO::PARAM_INT);
            $query->bindValue(':date_debut', $dateD, PDO::PARAM_STR);
            $query->bindValue(':date_fin', $dateF, PDO::PARAM_STR);
            $query->bindValue(':filtre', $filtre, PDO::PARAM_STR);
            $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
            if ($query->execute()) {
                $query = $db->prepare('UPDATE `image` SET `imgName`= :imgName WHERE id_location = :id_location');
                $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
                $query->bindValue(':imgName', $nomImage, PDO::PARAM_STR);
                if ($query->execute()) {
                    $showMessage .= '<div class="alert alert-success">L\'article a été modifié</div>';
                }
            } else {
                $showMessage .= '<div class="alert alert-danger">Une erreur est survenue</div>';
            }
        } else {
            // enregistrement de l'article en BDD
            $id_user = $_SESSION['user']['id'];
            $query = $db->prepare('INSERT INTO location (titre, description, prix, ville, code_postal, date_debut, date_fin, filtre, id_user) VALUES (:titre, :description, :prix, :ville, :codePostal, :dateD, :dateF, :filtre, :id_user)');

            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':codePostal', $codePostal, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            $query->bindValue(':dateD', $dateD, PDO::PARAM_STR);
            $query->bindValue(':dateF', $dateF, PDO::PARAM_STR);
            $query->bindValue(':filtre', $filtre, PDO::PARAM_STR);
            $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);

            if ($query->execute()) {
                $id_location = $db->lastInsertId();
                $query = $db->prepare('INSERT INTO image (imgName, id_location) VALUES (:img, :id_location)');
                $query->bindValue(':img', $nomImage, PDO::PARAM_STR);
                $query->bindValue(':id_location', $id_location, PDO::PARAM_STR);
                if ($query->execute()) {
                    $showMessage .= '<div class="alert alert-success">L\'article a été ajouté</div>';
                }
            } else {
                $showMessage .= '<div class="alert alert-danger">Une erreur est survenue</div>';
            }
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $id_location = $_GET['id_location'];
    $query = $db->prepare('SELECT * FROM location WHERE id = :id_location');
    $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
    if ($query->execute()) {
        $location = $query->fetch(PDO::FETCH_ASSOC);
        $query = $db->prepare('SELECT imgName FROM image WHERE id_location = :id_location');
        $query->bindValue(':id_location', $id_location, PDO::PARAM_INT);
        $query->execute();
        $imgName = $query->fetch(PDO::FETCH_ASSOC);
    }
}

$id_location = isset($location['id']) ? $location['id'] : '';
$titre = isset($location['titre']) ? $location['titre'] : '';
$description = isset($location['description']) ? $location['description'] : '';
$prix = isset($location['prix']) ? $location['prix'] : '';
$ville = isset($location['ville']) ? $location['ville'] : '';
$codePostal = isset($location['code_postal']) ? $location['code_postal'] : '';
$dateD = isset($location['date_debut']) ? $location['date_debut'] : '';
$dateF = isset($location['date_fin']) ? $location['date_fin'] : '';
$filtre = isset($location['filtre']) ? $location['filtre'] : '';
$image = isset($imgName['imgName']) ? $imgName['imgName'] : '';

?>

<?php require_once 'common/header.php'; ?>
<!-- Titre pour savoir que c'est la page ajout_location.php -->
<div class="container">
    <div class="container text-center">
        <h1>Ajouter une location</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-9 m-auto">
        <?= $showMessage ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id_location ?>">

            <label for="titre" class="mb-3">Titre :</label><br>
            <?php if (isset($errors['titre'])): ?>
                <small class="text-danger">
                    <?= $errors['titre']; ?>
                </small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Insérer un titre pour la location" name="titre"
                    value="<?= $titre ?>">
            </div>

            <label for="description" class="mb-3">Description :</label><br>
            <?php if (isset($errors['description'])): ?>
                <small class="text-danger">
                    <?= $errors['description']; ?>
                </small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <textarea name="description" class="form-control"
                    placeholder="Insérer les équipements, le nombre de pièces, le type de pièces, etc.."
                    rows="10"><?= $description ?></textarea>
            </div>

            <label for="ville" class="mb-3">Lieux :</label><br>
            <div class="d-flex justify-content-around">
                <?php if (isset($errors['ville'])): ?>
                    <small class="text-danger text-center">
                        <?= $errors['ville']; ?>
                    </small>
                <?php endif; ?>
                <?php if (isset($errors['codePostal'])): ?>
                    <small class="text-danger">
                        <?= $errors['codePostal']; ?>
                    </small>
                <?php endif; ?>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Ajouter une ville" name="ville"
                    value="<?= $ville ?>">
                <input type="text" class="form-control" placeholder="Code Postal" name="code_postal"
                    value="<?= $codePostal ?>">
            </div>

            <label for="prix" class="mb-3">Prix :</label><br>
            <?php if (isset($errors['prix'])): ?>
                <small class="text-danger">
                    <?= $errors['prix']; ?>
                </small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Insérer le prix de la location" name="prix"
                    value="<?= $prix ?>">
            </div>

            <div class="input-group mb-3 d-flex justify-content-around">
                <label for="dateD">Date début :</label>
                <label for="dateF" class="ml-3">Date fin :</label>
            </div>
            <?php if (isset($errors['date'])): ?>
                <small class="text-danger">
                    <?= $errors['date']; ?>
                </small>
            <?php endif; ?>

            <div class="input-group mb-3">
                <input type="date" class="form-control" name="dateD" value="<?= $dateD ?>">
                <input type="date" class="form-control" name="dateF" value="<?= $dateF ?>">
            </div>

            <label for="filtres" class="mb-3">Catégorie :</label><br>
            <?php if (isset($errors['filtre'])): ?>
                <small class="text-danger">
                    <?= $errors['filtre']; ?>
                </small>
            <?php endif; ?>

            <div class="input-group mb-3">
                <select name="filtres" id="filtres">
                    <option value="<?= $filtre ?>">--Choisir une catégorie de location--</option>
                    <option value="wow">Wow !</option>
                    <option value="chateaux">Chateaux</option>
                    <option value="luxe">Luxe</option>
                    <option value="lac">Bord de lac</option>
                    <option value="mer">Bord de mer</option>
                    <option value="surEau">Sur l'eau</option>
                </select>
            </div>

            <label for="image" class="mb-3">Photos :</label><br>
            <?php if (isset($errors['image'])): ?>
                <small class="text-danger">
                    <?= $errors['image']; ?>
                </small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <input type="file" class="form-control" placeholder="image" name="image" value="<?= $image ?>">
            </div>
            <?php if (!empty($image)): ?>
                <img src="<?= URL . $image ?>" alt="" width="200">
            <?php endif; ?>
            <input type="hidden" name="oldImage" value="<?= $image ?>">

            <div class="d-grid gap-2 col-6 mx-auto">
                <?php if (isset($_GET['action']) && $_GET['action'] == 'update'): ?>
                    <button type="submit" class="btn btn-warning">Modifier</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<?php require_once 'common/footer.php'; ?>