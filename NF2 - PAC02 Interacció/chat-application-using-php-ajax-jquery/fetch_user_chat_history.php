<?php

include('database_connection.php');
include_once('ChatMessage.php');

session_start();

$chatMessage = new ChatMessage($connect);

$userId = $_SESSION['user_id'] ?? null;  
$toUserId = $_POST['to_user_id'] ?? null;

if ($userId && $toUserId) {
    $chatHistory = $chatMessage->fetchChatHistory($userId, $toUserId);

    if (!empty($chatHistory)) {
        $output = '<ul class="list-unstyled">';

        foreach ($chatHistory as $row) {
            $user_name = $userId == $row["from_user_id"] ? 'You' : $chatMessage->getUserName($row['from_user_id']);  // Assuming getUserName is a method in ChatMessage or adjust accordingly
            $chat_message = $row["status"] == '2' ? '<em>This message has been removed</em>' : $row['chat_message'];
            $dynamic_background = $userId == $row["from_user_id"] ? 'background-color:#ffe6e6;' : 'background-color:#ffffe6;';
            
            $output .= '
            <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
                <p><b class="text-' . ($userId == $row["from_user_id"] ? 'success' : 'danger') . '">' . htmlspecialchars($user_name) . '</b> - ' . htmlspecialchars($chat_message) . '
                    <div align="right">
                        - <small><em>' . $row['timestamp'] . '</em></small>
                    </div>
                </p>
            </li>';
        }

        $output .= '</ul>';

        echo $output;
    } else {
        echo "<p>No chat history available.</p>";
    }
} else {
    echo "Invalid user ID or destination user ID.";
}

?>