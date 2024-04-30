<?php

//group_chat.php

include_once('database_connection.php');
include_once('ChatMessage.php');

session_start();

$chatMessage = new ChatMessage($connect);

if($_POST["action"] == "insert_data") {
    $fromUserId = $_SESSION["user_id"];
    $chatMessageContent = $_POST['chat_message'];
    $status = '1'; 
    if($chatMessage->insertGroupChatMessage($fromUserId, $chatMessageContent, $status)) {
        $groupChatHistory = fetch_group_chat_history($chatMessage);
        $output = '';
        foreach ($groupChatHistory as $row) {
            $output .= $row['chat_message'] . '<br>';
        }
        echo $output;
    } else {
        echo "Error al insertar el mensaje.";
    }
}

if($_POST["action"] == "fetch_data") {
    $groupChatHistory = fetch_group_chat_history($chatMessage);
    $output = '';
    foreach ($groupChatHistory as $row) {
        $output .= $row['chat_message'] . '<br>';
    }
    echo $output;
}
?>