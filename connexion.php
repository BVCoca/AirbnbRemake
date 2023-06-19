<?php
require_once 'inc/init.php';

if (isLogged()) {
    header('Location: index.php');
}
$showMessage = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(addslashes($value));
    }
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $errors = [];
    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email n'est pas valide";
    }
    if (empty($password)) {
        $errors['password'] = "Le mot de passe est obligatoire";
    }
    if (empty($errors)) {
        $query = $db->prepare('SELECT * FROM `users` WHERE email = :email');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['nom'] = $user['nom'];
                $_SESSION['user']['prenom'] = $user['prenom'];
                $_SESSION['user']['email'] = $user['email'];
                $_SESSION['user']['telephone'] = $user['telephone'];
                header('Location: index.php');
                exit;
            } else {
                $showMessage = '<div class="alert alert-warning text-center"> 
                Email ou mot de passe incorrect
                </div>';
            }
        } else {
            $showMessage = '<div class="alert alert-danger"> 
                Email ou mot de passe incorrect
            </div>';
        }
    }
}
?>
<?php require_once 'Common/header.php'; ?>

<div class="container">
    <div class="row text-center">
        <h1 class="display-1 my-3">
            Connexion
        </h1>
    </div>
    <div class="row">
        <div class="col-md-6 m-auto shadow p-4">
            <?= $showMessage ?>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Entrez votre email" class="form-control my-3">
                <input type="password" name="password" placeholder="Entrez votre mot de passe" class="form-control my-3">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'Common/footer.php'; ?>