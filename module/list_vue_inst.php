<?php
// Inclure la classe Liste
include '../class/Liste.php';

// Assurez-vous que vous recevez un ID de liste valide en tant que paramètre GET
if (isset($_GET['select_list'])) {
    $select_list = $_GET['select_list'];
    
    // Créez une instance de la classe Liste
    $liste = new Liste();

    // Appelez la méthode getListDetails
    $listDetails = $liste->getListDetails($select_list);

    // Encodez les résultats en JSON et renvoyez-les
    header('Content-Type: application/json');
    echo json_encode($listDetails);
} else {
    // En cas de paramètre manquant ou invalide, renvoyez une réponse d'erreur
    http_response_code(400); // Code d'erreur Bad Request
    echo json_encode(['message' => 'Paramètre id_list manquant ou invalide.']);
}
?>
