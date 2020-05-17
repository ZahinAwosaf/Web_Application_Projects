<?php

include('db_connection.php');

$sql = 'update user_info set password="'.$_POST['r_pass'].'" where user_id='.$_POST['user_id'];
$conn->query($sql);

?>