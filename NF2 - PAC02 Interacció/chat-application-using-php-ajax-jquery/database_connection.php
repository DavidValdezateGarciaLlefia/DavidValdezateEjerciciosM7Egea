<?php

include_once('class.login.php');
include_once('class.loginDetails.php');
include_once('ChatMessage.php');

$connect = new PDO("pgsql:host=localhost;dbname=chat;user=postgres;password=root");
date_default_timezone_set('Asia/Kolkata');

$login = new Login($connect);
$loginDetails = new LoginDetails($connect);
$chatMessage = new ChatMessage($connect);


function fetch_user_chat_history($fromUserId, $toUserId, $chatMessage) {
    global $login; // Accessing the login object
    $chatHistory = $chatMessage->fetchChatHistory($fromUserId, $toUserId);
    $output = '<ul class="list-unstyled">';
    foreach ($chatHistory as $row) {
        $user_name = $fromUserId == $row["from_user_id"] ? 'You' : $login->getUserName($row['from_user_id']);
        $chat_message = $row["status"] == '2' ? '<em>This message has been removed</em>' : $row['chat_message'];
        $dynamic_background = $fromUserId == $row["from_user_id"] ? 'background-color:#ffe6e6;' : 'background-color:#ffffe6;';
        $output .= '
        <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
            <p><b class="text-' . ($fromUserId == $row["from_user_id"] ? 'success' : 'danger') . '">' . $user_name . '</b> - ' . $chat_message . '
                <div align="right">
                    - <small><em>' . $row['timestamp'] . '</em></small>
                </div>
            </p>
        </li>';
    }
    $output .= '</ul>';
    return $output;
}

function count_unseen_message($fromUserId, $toUserId, $chatMessage) {
    return $chatMessage->countUnseenMessages($fromUserId, $toUserId);
}

function fetch_group_chat_history($chatMessage) {
    return $chatMessage->fetchGroupChatHistory();
}

?>