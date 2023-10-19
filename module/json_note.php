<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: ../page/connexion.php');
    exit;
}

if (isset($_GET['list_id'])) {
    include '../class/Liste.php';
    $liste = new Liste;
    $id_list = $_GET["list_id"];
    $notes = $liste->jsonNote($id_list);
    header('Content-Type: application/json');
    echo json_encode($notes);
} else {
    // Gérez l'erreur de liste non spécifiée ici si nécessaire
    echo json_encode(array('error' => 'List ID not specified'));
}
