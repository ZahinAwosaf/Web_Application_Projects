<?php

session_start();

include('db_connection.php');

if($_POST['file_check'] != '') {
	$file_name = $_FILES['file']['name'];
	$location = "IMAGE/".$file_name;
	move_uploaded_file($_FILES['file']['tmp_name'], $location);

	$sql = 'update user_info set name="'.$_POST['name'].'", email="'.$_POST['email'].'", phone="'.$_POST['phone'].'", dob="'.$_POST['dob'].'", image="'.$file_name.'", aiub_id="'.$_POST['aiub_id'].'" where user_id='.$_POST['user_id'];
	$conn->query($sql);
}
else {
	$sql = 'update user_info set name="'.$_POST['name'].'", email="'.$_POST['email'].'", phone="'.$_POST['phone'].'", dob="'.$_POST['dob'].'", aiub_id="'.$_POST['aiub_id'].'" where user_id='.$_POST['user_id'];
	$conn->query($sql);
}

?>