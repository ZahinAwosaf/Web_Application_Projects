<?php

include('db_connection.php');

$sql = 'delete from following where followed_id = '.$_POST['followed_id'].' and follower_id = '.$_POST['follower_id'];
$conn->query($sql);
$conn->close();

?>