
<?php
session_start();
include 'class/Liste.php';
$liste = new Liste;
// $_Session["list_id"];
// var_dump($_Session["list_id"]);
$note = $liste->readNote(2);
header('Content-Type: application/json');
$note_json = json_encode($note);
echo $note_json;
// var_dump($note_json);

