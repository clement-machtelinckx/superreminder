<?php
session_start();
include '../class/Liste.php';

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_SESSION['username']) && isset($_SESSION["id"])) {
    $id_list = $_GET["select_list"];
    // var_dump($id_list);
    $_SESSION["id_list"] = $id_list;
    $liste = new Liste;
    $note = $liste->readNote($id_list);
    header('Content-Type: application/json');
    $note_json = json_encode($note);
    echo $note_json;
    // var_dump($note_json);

    // Utilisez la fonction header() pour rediriger vers create_cv.php avec l'ID du CV en tant que paramètre GET
    header("Location: ../page/list_vue.php?id_list=" . $_SESSION["id_list"]);
    exit;
}
?>
