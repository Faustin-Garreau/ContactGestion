
<?php
session_start();
try {
    $dbh = new PDO('mysql:host=localhost:3306;dbname=contact', 'root', '');
} catch (PDOException $e) {
    var_dump("Erreur !: " . $e->getMessage());
    die();
}
?>