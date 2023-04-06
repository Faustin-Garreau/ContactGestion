<?php 
require_once('config.php');

if (isset($_GET['id'])) {
    $del_user = $dbh->prepare("DELETE FROM informations WHERE id = :id");
    $del_user->bindParam(":id", $_GET['id']);
    $del_user->execute();
    header('location:/contact.php'); 
}
?>