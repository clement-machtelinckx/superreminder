<?php

class Liste {

    private $id;

    private $id_user;

    private $list_name;

    private $list_content;


    public function __construct(
        int $id = null,
        int $id_user = null,
        string $list_name = "",
        string $list_content = ""
    )
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->list_name = $list_name;
        $this->list_content = $list_content;
        
    }

    public function getIt(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function setId_user($id_user){
        $this->id_user = $id_user;
    }
    public function getList_name(){
        return $this->list_name;
    }
    public function setList_name($list_name){
        $this->list_name = $list_name;
    }
    public function getList_content(){
        return $this->list_content;
    }
    public function setList_content($list_content){
        $this->list_content = $list_content;
    }

    public function addNote($id_list, $date_end, $note_content){
       
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "superreminder";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        $sql = "INSERT INTO note (id_list, date_end, note_content)
        VALUES (:id_list, :date_end, :note_content)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_list', $id_list, PDO::PARAM_STR);
            $stmt->bindParam(':date_end', $date_end, PDO::PARAM_STR);
            $stmt->bindParam(':note_content', $note_content, PDO::PARAM_STR);

            $stmt->execute();
            echo "Note ajoutée avec succès.";
            return true; // Retourne true pour indiquer le succès de l'opération.
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur lors de l'insertion, retourne false.
        }

    }

    public function delNote(){

    }
    public function updateNote(){

    }

    public function readNote($id_list){
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "superreminder";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connexion réussie<br>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
                // Récupérez les expériences pour ce CV
        $sql = "SELECT * FROM note WHERE id_list = :id_list";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_list', $id_list, PDO::PARAM_STR);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'notes' => $notes
        ];
    }

    public function getListDetails($id_list) {
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "superreminder";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    
        // Récupérez les expériences pour ce CV
        $sql = "SELECT * FROM note WHERE id_list = :id_list";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_list', $id_list, PDO::PARAM_STR);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
        // Vous pouvez maintenant retourner ces données pour les utiliser dans votre vue
        return [
            'notes' => $notes
        ];
    }
}