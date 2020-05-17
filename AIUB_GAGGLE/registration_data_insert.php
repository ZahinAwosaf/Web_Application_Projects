<?php

session_start();
$error = '';

$file_name = $_FILES['file']['name'];
$location = "IMAGE/".$file_name;
move_uploaded_file($_FILES['file']['tmp_name'], $location);


include('db_connection.php');



$sql = 'insert into user_info(name,email,phone,password,dob,image,dept_id,aiub_id) values("'.$_SESSION['name'].'","'.$_SESSION['email'].'","'.$_SESSION['phone'].'","'.$_SESSION['password'].'","'.$_SESSION['dob'].'","'.$file_name.'",'.$_POST['dept'].',"'.$_POST['aiub_id'].'")';


if($conn->query($sql) == true) {

	$sql = 'select user_id from user_info where email = "'.$_SESSION['email'].'"';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$uID = $row['user_id'];



	$subs = explode(',', $_POST['subs']);

	foreach ($subs as $s) {
			$sql = 'select sub_id from subjects where name = "'.$s.'" and dept_id = "'.$_POST['dept'].'"';
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			$subID = $row['sub_id'];

			$sql = 'insert into expertise(user_id,sub_id) values('.$uID.','.$subID.')';
			if($conn->query($sql) == true) {

			}
			else {
				$error = "0";
				break;
			}
	}

	if($error == "") {
		$res_d = explode(',', $_POST['res_d']);

		foreach ($res_d as $r) {

			$sql2 = 'select domain_id from research_domains where domain_name = "'.$r.'"';
			$result2 = $conn->query($sql2);
			$row2 = $result2->fetch_assoc();

			$sql = 'insert into interest(domain_id,user_id) values('.$row2['domain_id'].','.$uID.')';
			if($conn->query($sql) == true) {
			}
			else {
				$error = "0";
				break;
			}
		}
		
	}

}
else
	$error = "0";

session_destroy();


echo $error;

$conn->close();



?>