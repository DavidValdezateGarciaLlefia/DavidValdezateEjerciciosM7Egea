<?php
include('database_connection.php');
include_once('ChatMessage.php');

session_start();

$login = new Login($connect);
$loginDetails = new LoginDetails($connect);
$chatMessage = new ChatMessage($connect);

$users = $login->fetchAllUsers($_SESSION['user_id']);
$output = '
<table class="table table-bordered table-striped">
    <tr>
        <th width="70%">Username</th>
        <th width="20%">Status</th>
        <th width="10%">Action</th>
    </tr>
';

foreach ($users as $row) {
    $status = $loginDetails->isUserOnline($row['user_id']) ? '<span class="label label-success">Online</span>' : '<span class="label label-danger">Offline</span>';
    $unseenCount = $chatMessage->countUnseenMessage($row['user_id'], $_SESSION['user_id']);  // Adjusted to ensure $chatMessage is defined
    $typingStatus = $loginDetails->fetchIsTypeStatus($row['user_id']);  // Assuming this method exists

    $output .= '
    <tr>
        <td>' . $row['username'] . ' ' . $unseenCount . ' ' . $typingStatus . '</td>
        <td>' . $status . '</td>
        <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['user_id'] . '" data-tousername="' . $row['username'] . '">Start Chat</button></td>
    </tr>
    ';
}

$output .= '</table>';
echo $output;
?>