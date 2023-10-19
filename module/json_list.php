<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: ../page/connexion.php');
    exit;
}

include '../class/Liste.php';
$liste = new Liste;
$id_user = $_SESSION['id'];
// $_Session["list_id"];
// var_dump($_Session["list_id"]);
$lists = $liste->jsonList($id_user);
header('Content-Type: application/json');
$lists_json = json_encode($lists);
echo $lists_json;
// var_dump($note_json);