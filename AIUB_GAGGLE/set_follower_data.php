<?php

include('db_connection.php');

$sql = 'insert into following(follower_id,followed_id) values('.$_POST['follower_id'].','.$_POST['followed_id'].')';
$conn->query($sql);
$conn->close();

?>