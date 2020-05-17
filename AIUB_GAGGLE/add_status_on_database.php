<?php

session_start();

include('db_connection.php');


$c_h = $_POST["c_h"];
$pl = $_POST["pl"];
$subjects = $_POST["subs"];

date_default_timezone_set("Asia/Dhaka");
$current_timestamp = date('Y-m-d H:i:s');

if(strpos($c_h, "minutes")) {
	$end_status_timestamp = strtotime(date('Y-m-d H:i:s'). $c_h);
	$end_status_timestamp = date('Y-m-d H:i:s', $end_status_timestamp);
} else {
	$end_status_timestamp = strtotime(date('Y-m-d H:i:s'). $c_h);
	$end_status_timestamp = date('Y-m-d H:i:s', $end_status_timestamp);
}


$sql = 'INSERT INTO users_status (start_timestamp, end_timestamp, place, status_timestamp, user_id) VALUES ("'.$current_timestamp.'","'.$end_status_timestamp.'","'.$pl.'","'.$current_timestamp.'",'.$_SESSION['user_id'].')';

$result = $conn->query($sql);

$sql = 'select status_id from users_status where status_timestamp = "'.$current_timestamp.'"';

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$statusID = $row['status_id'];

foreach ($subjects as $str) {
	$sql = 'select sub_id from subjects where name = "'.$str.'"';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$sql = 'INSERT INTO user_status_subjects (status_id, sub_id) VALUES ('.$statusID.','.$row['sub_id'].')';
	$conn->query($sql);
}


$conn->close();

?>