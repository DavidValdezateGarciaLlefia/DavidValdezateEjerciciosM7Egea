<?php
class LoginDetails extends DataBoundObject {


protected $login_details_id;
protected $user_id;
protected $last_activity;
protected $is_type;


protected function DefineTableName() {
    return "login_details";
}


protected function DefineRelationMap() {
    return array(
        "login_details_id" => "login_details_id",
        "user_id" => "user_id",
        "last_activity" => "last_activity",
        "is_type" => "is_type"
    );
}
public function updateLoginDetails() {
    if (!$this->isLoaded()) {
        $this->Save();  
    }
}

public function fetchLastActivity() {
    $strQuery = "SELECT last_activity FROM " . $this->DefineTableName() . " WHERE user_id = :user_id ORDER BY last_activity DESC LIMIT 1";
    $objStatement = $this->objPDO->prepare($strQuery);
    $objStatement->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
    $objStatement->execute();
    $result = $objStatement->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['last_activity'] : null;
}
public function fetchChatHistory($from_user_id, $to_user_id) {
    $strQuery = "SELECT * FROM " . $this->DefineTableName() . " 
                 WHERE (from_user_id = :from_user_id AND to_user_id = :to_user_id) 
                 OR (from_user_id = :to_user_id AND to_user_id = :from_user_id) 
                 ORDER BY timestamp DESC";
    $objStatement = $this->objPDO->prepare($strQuery);
    $objStatement->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
    $objStatement->bindParam(':to_user_id', $to_user_id, PDO::PARAM_INT);
    $objStatement->execute();
    return $objStatement->fetchAll(PDO::FETCH_ASSOC);
}

public function updateMessageStatus($from_user_id, $to_user_id) {
    $strQuery = "UPDATE " . $this->DefineTableName() . " SET status = '0' 
                 WHERE from_user_id = :from_user_id AND to_user_id = :to_user_id AND status = '1'";
    $objStatement = $this->objPDO->prepare($strQuery);
    $objStatement->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
    $objStatement->bindParam(':to_user_id', $to_user_id, PDO::PARAM_INT);
    $objStatement->execute();
}
public function isUserOnline($userId) {
    $lastActivity = $this->fetchLastActivity($userId);
    if ($lastActivity) {
        $currentTimestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
        return strtotime($lastActivity) > $currentTimestamp;
    }
    return false;
}



}
