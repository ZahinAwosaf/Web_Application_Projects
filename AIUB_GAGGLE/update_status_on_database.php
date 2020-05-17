<?php

session_start();
include('db_connection.php');


$c_h = $_POST["c_h"];
$pl = $_POST["pl"];
$subjects = $_POST["subs"];

$sql = 'select * from users_status where status_id = '.$_POST['stat_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$current_timestamp = $row['start_timestamp'];


if(strpos($c_h, "minutes")) {
	$end_status_timestamp = strtotime($current_timestamp. $c_h);
	$end_status_timestamp = date('Y-m-d H:i:s', $end_status_timestamp);
} else {
	$end_status_timestamp = strtotime($current_timestamp. $c_h);
	$end_status_timestamp = date('Y-m-d H:i:s', $end_status_timestamp);
}



$sql = 'update users_status set start_timestamp = "'.$current_timestamp.'", end_timestamp = "'.$end_status_timestamp.'", place = "'.$pl.'", status_timestamp = "'.$current_timestamp.'" where status_id = '.$_POST['stat_id'];

$conn->query($sql);


$sql = 'delete from user_status_subjects where status_id = '.$_POST['stat_id'];
$conn->query($sql);

$statusID = $_POST['stat_id'];

foreach ($subjects as $str) {
	$sql = 'select sub_id from subjects where name = "'.$str.'"';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$sql = 'INSERT INTO user_status_subjects (status_id, sub_id) VALUES ('.$statusID.','.$row['sub_id'].')';
	$conn->query($sql);
}


$conn->close();

?>