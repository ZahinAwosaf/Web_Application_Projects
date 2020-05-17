<?php

session_start();

include('db_connection.php');



$sql = 'select * from research_domains where domain_name = "'.$_POST['domain_name'].'" and dept_id = '.$_POST['dept_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$domain_id = $row['domain_id'];

if($_POST['file_check'] != '') {

	$file_name = $_FILES['file']['name'];

	$imgFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	if($imgFileType == "pdf" || $imgFileType == "docx") {

		$location = "RESEARCH_PAPER/".$file_name;
		move_uploaded_file($_FILES['file']['tmp_name'], $location);
		
		$sql = 'insert into research_info(pub_year,file_name,dept_id,user_id,domain_id) values ("'.$_POST['pub_year'].'","'.$file_name.'",'.$_POST['dept_id'].','.$_POST['user_id'].','.$domain_id.')';
		$conn->query($sql);
	} else {
		echo "File Type Not Acceptable!!!";
	}
}

// echo $_POST['pub_year'];

$conn->close();



?>