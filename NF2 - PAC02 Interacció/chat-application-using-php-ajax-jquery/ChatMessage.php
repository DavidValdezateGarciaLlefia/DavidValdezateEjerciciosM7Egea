<?php
class ChatMessage extends DataBoundObject {
    protected $chat_message_id;
    protected $to_user_id;
    protected $from_user_id;
    protected $chat_message;
    protected $timestamp;
    protected $status;
    private $pdo;  

    protected function DefineTableName() {
        return "chat_message";
    }

    protected function DefineRelationMap() {
        return array(
            "chat_message_id" => "ID",
            "to_user_id" => "ToUserID",
            "from_user_id" => "FromUserID",
            "chat_message" => "ChatMessage",
            "timestamp" => "Timestamp",
            "status" => "Status"
        );
    }

    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    public function fetchChatHistory($from_user_id, $to_user_id) {
        $strQuery = "SELECT * FROM " . $this->DefineTableName() . " 
                     WHERE (from_user_id = :from_user_id AND to_user_id = :to_user_id) 
                     OR (from_user_id = :to_user_id AND to_user_id = :from_user_id) 
                     ORDER BY timestamp DESC";
        $objStatement = $this->pdo->prepare($strQuery); // Using the correct property
        $objStatement->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
        $objStatement->bindParam(':to_user_id', $to_user_id, PDO::PARAM_INT);
        $objStatement->execute();
        return $objStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateMessageStatus($from_user_id, $to_user_id) {
        $strQuery = "UPDATE " . $this->DefineTableName() . " SET status = '0' 
                     WHERE from_user_id = :from_user_id AND to_user_id = :to_user_id AND status = '1'";
        $objStatement = $this->pdo->prepare($strQuery); // Using the correct property
        $objStatement->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
        $objStatement->bindParam(':to_user_id', $to_user_id, PDO::PARAM_INT);
        $objStatement->execute();
    }

    public function countUnseenMessages($fromUserId, $toUserId) {
        $strQuery = "SELECT COUNT(*) FROM " . $this->DefineTableName() . " WHERE from_user_id = :from_user_id AND to_user_id = :to_user_id AND status = '1'";
        $objStatement = $this->pdo->prepare($strQuery); // Using the correct property
        $objStatement->bindParam(':from_user_id', $fromUserId, PDO::PARAM_INT);
        $objStatement->bindParam(':to_user_id', $toUserId, PDO::PARAM_INT);
        $objStatement->execute();
        return $objStatement->fetchColumn();
    }
    public function insertGroupChatMessage($fromUserId, $chatMessage, $status) {
        $strQuery = "INSERT INTO " . $this->DefineTableName() . " (from_user_id, chat_message, status) VALUES (:from_user_id, :chat_message, :status)";
        $objStatement = $this->pdo->prepare($strQuery);
        $objStatement->bindParam(':from_user_id', $fromUserId, PDO::PARAM_INT);
        $objStatement->bindParam(':chat_message', $chatMessage, PDO::PARAM_STR);
        $objStatement->bindParam(':status', $status, PDO::PARAM_INT);
        return $objStatement->execute();
    }

    public function fetchGroupChatHistory() {
        $strQuery = "SELECT * FROM " . $this->DefineTableName() . " ORDER BY timestamp DESC";
        $objStatement = $this->pdo->prepare($strQuery);
        $objStatement->execute();
        return $objStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}