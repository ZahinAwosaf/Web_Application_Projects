<?php

session_start();

include('db_connection.php');

$sql = 'delete from user_status_subjects where status_id = '.$_POST['state_ID'];
$conn->query($sql);

$sql = 'delete from users_status where status_id = '.$_POST['state_ID'];
$conn->query($sql);

$conn->close();

?>