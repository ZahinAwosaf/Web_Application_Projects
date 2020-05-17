<?php

include('db_connection.php');


$syn = '<option value="Choose Department">Choose Department</option>';
$sql = 'select * from department';
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
	$syn .= '<option value="'.$row['dept_id'].'">'.$row['name'].'</option>';
}

echo $syn;

?>