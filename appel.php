<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" type="text/css" href="">
</head>
<?php include 'class/Liste.php'; ?>
<body>
    <div id="data-container"></div>

    <script>
        fetch('test.php')
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
</html>