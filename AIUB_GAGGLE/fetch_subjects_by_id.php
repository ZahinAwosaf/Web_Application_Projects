<?php


include('db_connection.php');


$syn = '';
$sql = 'select * from expertise where user_id = '.$_POST['user_id'];
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$sql2 = 'select name from subjects where sub_id = '.$row['sub_id'];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$syn .= '<option>'.$row2['name'].'</option>';
}

echo $syn;

?>