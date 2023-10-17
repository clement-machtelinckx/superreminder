
<?php
session_start();
include '../class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php
include "../class/Liste.php";

$user = new User(); // Créez une instance de la classe User

var_dump($_SESSION["username"]);
if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    $session_id = $_SESSION["id"];
    // Utilisez la méthode getUserInfo pour obtenir les données de l'utilisateur
    $userData = $user->getUserInfos($email);

?>
<?php


if (isset($_SESSION["id_list"]) && !empty($_SESSION["id_list"])) {
    $list = new Liste;

    // Récupérez les détails du CV en utilisant la méthode getCvDetails
    $listDetails = $list->getListDetails($_SESSION["id_list"]);

    // Maintenant, vous pouvez accéder aux expériences, formations et loisirs
    $notes = $listDetails['notes']; // Utilisez la clé 'notes' pour accéder aux données
    var_dump($notes);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list_vue</title>
    <link rel="stylesheet" type="text/css" href="">

</head>
<body>
    <form method="post" action="../module/module_createList.php">
        <label for="list_name">Create list</label>
        <input type="text" id="list_name" name="list_name">
        <input type="submit" value="enter">
    </form>

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
    <?php var_dump($listOfList); ?>
    <form method="post" action="../module/module_addNote.php">
        <input type="date" id="date_end" name="date_end">
        <label for="note_content">ajouter une note </label>
        <input type="text" id="note_content" name="note_content">
        <input type="submit" value="enter">

    </form>

    <h1>list</h1>


        <div id="data-container"></div>

<script>
    fetch('../module/module_selectList.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('La requête a échoué. Statut : ' + response.status);
            }
            return response.json(); // Analysez la réponse JSON
        })
        .then(data => {
            console.log(data); // Affichez les données dans la console

            // Récupérer la référence de la div container
            const container = document.getElementById('data-container');

            // Parcourir les données et créer les éléments HTML
            data.notes.forEach(note => {
                const noteElement = document.createElement('div');
                noteElement.textContent = `ID: ${note.id}, ID Liste: ${note.id_list}, Date: ${note.date_end}, Contenu: ${note.note_content}`;

                // Ajouter l'élément à la div container
                container.appendChild(noteElement);
            });
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
</script>
</body>

<?php
};
 ?>