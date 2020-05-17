<?php

session_start();

include('db_connection.php');
$syn = '<ul id="chatbox_list_text_msg">';
$user_name = '';
date_default_timezone_set("Asia/Dhaka");
$current_timestamp = date('Y-m-d H:i:s');
$st = 1;

$sql = 'insert into chat_message(from_user_id,to_user_id,message,timestamp,status) values('.$_POST['from_user_id'].','.$_POST['to_user_id'].',"'.$_POST['msg'].'","'.$current_timestamp.'",'.$st.')';

if($conn->query($sql) == true) {

	$sql = 'select * from chat_message where (from_user_id = '.$_POST['from_user_id'].' and to_user_id = '.$_POST['to_user_id'].') or (from_user_id = '.$_POST['to_user_id'].' and to_user_id = '.$_POST['from_user_id'].') order by timestamp desc';
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		if($row['from_user_id'] == $_POST['from_user_id']) {
			$user_name = 'You';
		} else {
			$user_name = getUserName_byID($_POST['to_user_id']);
		}
		$syn .= '<li><p><b>'.$user_name.' - </b>'.$row['message'].'</p><div id="timestamp-for-msg-right"><small><em>'.$row['timestamp'].'</em></small></div></li>';
	}

	$syn .= '</ul>';

	echo $syn;

}


function getUserName_byID($uID) {
	$conn = mysqli_connect("localhost","root","","aiub_gaggle");
	$sql = 'select name from user_info where user_id = '.$uID;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	return $row['name'];
}



$conn->close();



?>