<?php
    require_once('config.php');
    $contact = $dbh->prepare('SELECT * FROM informations WHERE id = ?');
    $contact->execute(array($_GET['id']));
    $contact = $contact ->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Liste des contacts</title>
</head>
<body>
    <header>
        <div class="navbar">
            <a class="active" href="index.php">Accueil</a>
            <a href="contact.php">Liste des contacts</a>
        </div>
    </header>
    <div class="card-container">
        <div class="card" style="width: 50%">
            <div class="card-header">
                <h1><?= $contact['nom'] . ' ' . $contact['prenom']; ?></h1>
            </div>
            <div class="card-body" style="font-size: 20px;">
                <p><?= $contact['email']; ?></p>
                <p><?= $contact['telephone']; ?></p>
                <p><?= $contact['entreprise']; ?></p>
                <p><?= $contact['adresse'] . ', ' . $contact['code_postal'] ?></p>
            </div>
            <div class="card-footer">
               <a href="delete.php?id=<?= $contact['id'] ?>"><button>Supprimer</button></a>
               <a href="modif_contact.php?id=<?= $contact['id'] ?>"><button>Modifier</button></a>

            </div>
        </div>
    </div>
</body>
</html>