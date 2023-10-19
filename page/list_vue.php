
<?php
session_start();
include '../class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php
include "../class/Liste.php";

$user = new User(); // Créez une instance de la classe User

var_dump($_SESSION["username"]);
var_dump($_SESSION['id']);
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



    <h1>List</h1>

<div id="data-container"></div>

<script>
fetch('../module/json_list.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('La requête a échoué. Statut : ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('data-container');
        data.lists.forEach(list => {
            const listElement = document.createElement('div');
            listElement.textContent = `list name: ${list.list_name}`;
            const loadNotesButton = document.createElement('button');
            loadNotesButton.textContent = 'Charger les notes';

            // Ajoutez une classe unique basée sur l'ID de la liste
            listElement.classList.add(`list-${list.id}`);

            loadNotesButton.addEventListener('click', () => {
                fetch(`../module/json_note.php?list_id=${list.id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('La requête a échoué. Statut : ' + response.status);
                        }
                        return response.json();
                    })
                    .then(notesData => {
                        // Récupérez la div correspondante en utilisant la classe unique
                        const listDiv = document.querySelector(`.list-${list.id}`);

                        // Créez un élément de paragraphe pour afficher les données JSON
                        const notesParagraph = document.createElement('p');
                        notesData.notes.forEach(note => {
                        notesParagraph.textContent += `Date de fin: ${note.date_end}, Contenu: ${note.note_content}\n`;

                        
                     });


                        // Ajoutez le paragraphe à la div de la liste
                        listDiv.appendChild(notesParagraph);
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des notes :', error);
                    });
            });

            container.appendChild(listElement);
            container.appendChild(loadNotesButton);
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