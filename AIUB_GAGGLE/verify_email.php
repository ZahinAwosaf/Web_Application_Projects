<?php

$error_msg = '';

include('db_connection.php');

$sql = 'select user_id from user_info where email = "'.$_POST['email'].'"';
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0)
	$error_msg = "error";

echo $error_msg;

?>