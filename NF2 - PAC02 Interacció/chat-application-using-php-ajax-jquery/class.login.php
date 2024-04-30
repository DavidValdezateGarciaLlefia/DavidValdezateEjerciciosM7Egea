<?php
include_once('abstract.databoundobject.php');
class Login extends DataBoundObject {
    protected $id;        
    protected $username;
    protected $password;
    protected $objPDO; 

    public function __construct($pdo) {
        $this->objPDO = $pdo;
    }
    protected function DefineTableName() {
        return "login";
    }

    protected function DefineRelationMap() {
        return array(
            "id" => "user_id",   
            "username" => "username",
            "password" => "password"
        );
    }

    public function LoadByUsername() {
        $strQuery = "SELECT " . $this->arRelationMap['id'] . " FROM " . $this->DefineTableName() . " WHERE username = :username";
        $objStatement = $this->objPDO->prepare($strQuery);
        $objStatement->bindParam(':username', $this->username, PDO::PARAM_STR);
        $objStatement->execute();
        $arRow = $objStatement->fetch(PDO::FETCH_ASSOC);
        if ($arRow) {
            $this->id = $arRow[$this->arRelationMap['id']]; 
            $this->Load(); 
        }
    }
    public function fetchUserDetails() {
        $strQuery = "SELECT user_id, username, password FROM " . $this->DefineTableName() . " WHERE username = :username";
        $objStatement = $this->objPDO->prepare($strQuery);
        $objStatement->bindParam(':username', $this->username, PDO::PARAM_STR);
        $objStatement->execute();
        return $objStatement->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchAllUsers($currentUserId) {
        $strQuery = "SELECT * FROM " . $this->DefineTableName() . " WHERE user_id != :user_id";
        $objStatement = $this->objPDO->prepare($strQuery);
        $objStatement->bindParam(':user_id', $currentUserId, PDO::PARAM_INT);
        $objStatement->execute();
        return $objStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserName($userId) {
        $stmt = $this->pdo->prepare("SELECT username FROM login WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['username'] : "Unknown user";
    }
}


?>
