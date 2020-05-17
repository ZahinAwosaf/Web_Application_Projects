<?php

include('db_connection.php');



$sql = 'select * from user_info where user_id = '.$_POST['user_id'];
$result = $conn->query($sql);
if($result != null) {
	if(mysqli_num_rows($result) > 0)
		$row = $result->fetch_assoc();
}

$u_info = array();

$u_info['name'] = $row['name'];
$u_info['image'] = $row['image'];
$u_info['dept_id'] = $row['dept_id'];
$u_info['aiub_id'] = $row['aiub_id'];
$u_info['phone'] = $row['phone'];
$u_info['email'] = $row['email'];
$u_info['dob'] = $row['dob'];
$u_info['password'] = $row['password'];

$sql = 'select name from department where dept_id = '.$row['dept_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$u_info['dept_name'] = $row['name'];


echo json_encode($u_info);

$conn->close();


?>