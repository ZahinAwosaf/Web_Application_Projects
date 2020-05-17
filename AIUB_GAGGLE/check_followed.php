<?php

include('db_connection.php');

$check = '';
$sql = 'select * from following where followed_id = '.$_POST['followed_id'].' and follower_id = '.$_POST['follower_id'];
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0)
	$check = "Inserted";
echo $check;
$conn->close();

?>