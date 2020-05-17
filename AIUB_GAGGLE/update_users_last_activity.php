<?php

session_start();

include('db_connection.php');
date_default_timezone_set("Asia/Dhaka");
$current_timestamp = date('Y-m-d H:i:s');

$sql = 'update login_details set last_activity = "'.$current_timestamp.'" where login_id = "'.$_SESSION['login_details_id'].'"';
$conn->query($sql);


?>