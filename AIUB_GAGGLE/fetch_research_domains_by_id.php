<?php

include('db_connection.php');


$syn = '';
$sql = 'select * from interest where user_id = '.$_POST['user_id'];
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$sql2 = 'select domain_name from research_domains where domain_id = '.$row['domain_id'];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$syn .= '<option>'.$row2['domain_name'].'</option>';
}

echo $syn;

?>