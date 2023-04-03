<?php
require_once('config.php');

if(!isset($_SESSION['erreur'])){
  $_SESSION['erreur'] = null;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['codepostal'], $_POST['entreprise'], $_POST['telephone']) &&
        !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['codepostal']) && !empty($_POST['entreprise']) && !empty($_POST['telephone'])) {

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email = htmlentities($_POST['email']);
        $adresse = htmlentities($_POST['adresse']);
        $codepostal = htmlentities($_POST['codepostal']);
        $entreprise = htmlentities($_POST['entreprise']);
        $telephone = htmlentities($_POST['telephone']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['erreur'] = "Adresse mail invalide";
            $class = 'error';
        } else {
            $count_mail = $dbh->prepare('SELECT COUNT(*) FROM informations WHERE email = ?');
            $count_mail->execute(array($email));
            $mail_count = $count_mail->fetchColumn();
            if($mail_count > 0) {
                $_SESSION['erreur'] = "Le mail est déjà utilisé";
                $class = 'error';
            } else {
                if(!preg_match("/^[0-9]{5}$/", $codepostal)) {
                    $_SESSION['erreur'] = "Le code postal doit contenir 5 chiffres";
                    $class = 'error';
                } else if(!preg_match("/^[0-9]{10}$/", $telephone)) {
                    $_SESSION['erreur'] = "Le numéro de téléphone doit contenir 10 chiffres";
                    $class = 'error';
                } else {
                    $insert = $dbh->prepare("INSERT INTO informations(nom, prenom, email, adresse, code_postal, entreprise, telephone) VALUES(?, ?, ?, ?, ?, ?, ?)");
                    $insert->execute(array($nom, $prenom, $email, $adresse, $codepostal, $entreprise, $telephone));
                    $_SESSION['erreur'] = "Votre demande a bien été envoyée !";
                    $class = 'succes';
                }
            }
        }
    } else {
        $_SESSION['erreur'] = 'Tous les champs doivent être remplis';
        $class = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Page de contact</title>
</head>
<body>
    <header>
        <div class="navbar">
            <a class="active" href="#">Accueil</a>
            <a href="#contact">Contact</a>
        </div>
    </header>

    <div class="form_placement">
        <form action="index.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom">

            <label for="email">Email :</label>
            <input type="text" id="email" name="email">

            <label for="adresse">Adresse :</label>
            <textarea id="adresse" name="adresse" rows="3"></textarea>

            <label for="codepostal">Code postal :</label>
            <input type="text" id="codepostal" name="codepostal">

            <label for="entreprise">Entreprise :</label>
            <input type="text" id="entreprise" name="entreprise">

            <label for="telephone">Numéro de téléphone :</label>
            <input type="tel" id="telephone" name="telephone">

            <input type="submit" value="Envoyer">
            <?php if(isset($_SESSION['erreur'])){ ?>
                <p class="<?= $class ?>"><?= $_SESSION['erreur'] ?></p>
                <?php } ?>
        </form>
    </div>
</body>
</html>