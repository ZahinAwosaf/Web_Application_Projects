<?php

include('db_connection.php');


$syn = '';
$sql = 'select * from subjects where dept_id = '.$_POST['dept_id'];
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
	$syn .= '<option>'.$row['name'].'</option>';
}

echo $syn;

?>