<?php
session_start();
include"../class/Liste.php";
if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    $session_id = $_SESSION["id"];
}
var_dump($session_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" type="text/css" href="style/style_inscription.css">
</head>
<body>

<div id="form">
        <form name="list_selector" id="list_selector" method="get" action="../module/module_selectList.php">
        <label for="select_list">Sélectionnez une liste : </label>
        <select id="select_list" name="select_list">
        <?php

        $listOfList = $user->getList_list($session_id);

        foreach ($listOfList as $list) {
            echo '<option value="' . $list['id'] . '">' . $list['list_name'] . '</option>';
        }
        ?>
        </select>
        <input type="submit" name="load_list" value="Charger la list sélectionné">
        </form>

        <?php echo "list charger : " . $_SESSION["id_list"] ?>
    </div>


    <script>
        // Remplacez {votre_url} par le chemin complet vers votre point d'entrée list_details.php
        fetch("../list_vue_inst.php")
        .then(response => {
            if (!response.ok) {
                throw new Error('La réponse du serveur n\'est pas valide');
            }
            return response.json();
        })
        .then(data => {
            // Utilisez les données récupérées ici (data)
            console.log(data);
        })
        .catch(error => {
            // Gérer les erreurs ici
            console.error('Une erreur s\'est produite :', error);
        });
    </script>
</body>
</html>
