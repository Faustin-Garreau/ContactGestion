<?php
    require_once('config.php');
    $contacts = $dbh->query('SELECT * FROM informations')->fetchAll();
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
        <?php foreach($contacts as $contact) { ?>
        <div class="card">
            <div class="card-header">
                <h2><?= $contact['nom'] . ' ' . $contact['prenom']; ?></h2>
            </div>
            <div class="card-body">
                <p><?= $contact['email']; ?></p>
                <p><?= $contact['telephone']; ?></p>
            </div>
            <div class="card-footer">
               <a href="one_contact.php?id=<?= $contact['id'] ?>"><button>Voir le contact</button></a>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>