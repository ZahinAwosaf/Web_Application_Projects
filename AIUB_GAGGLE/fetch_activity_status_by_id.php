<?php

include('db_connection.php');
$statusVal = '';
$statusClass = '';
$current_timestamp = strtotime(date('Y-m-d H:i:s'). '-10 second');
$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

$sql2 = 'select * from login_details where user_id='.$_POST['user_id'].' order by last_activity desc limit 1';
$result2 = $conn->query($sql2);
if(mysqli_num_rows($result2)>0) {
	$row2 = $result2->fetch_assoc();
	$last_act = $row2['last_activity'];

	if($last_act > $current_timestamp) {
		$statusVal = 'Active';
		$statusClass = 'activeimg';
	} else {
		$statusVal = 'Offline';
		$statusClass = 'offlineimg';
	}
} else {
	$statusVal = 'Offline';
	$statusClass = 'offlineimg';
}


echo $statusVal."-".$statusClass;

?>