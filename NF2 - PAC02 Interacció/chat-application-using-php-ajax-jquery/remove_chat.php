<?php




if(isset($_POST["chat_message_id"]))
{
    $chatMessage = new ChatMessage($connect);
    $chatMessage->ID = $_POST["chat_message_id"];
    $chatMessage->Load();


    $chatMessage->status = '2';
    $chatMessage->Save();
}


?>
