<?php
session_start();

$status_data = array();

include('db_connection.php');

$sql = 'select * from users_status where status_id = '.$_POST['status_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$status_data['place'] = $row['place'];

$t1 = new DateTime($row['start_timestamp']);
$t2 = new DateTime($row['end_timestamp']);

$tf = $t1->diff($t2);
$c_h = '';

if($tf->h != 0)
	$c_h .= $tf->h." hour";
else
	$c_h .= $tf->i." minutes";

$status_data['c_h'] = $c_h;

$sql = 'select * from user_status_subjects where status_id = '.$_POST['status_id'];
$result = $conn->query($sql);

$subs = "";
$r_subs = "";
$n_r = mysqli_num_rows($result);
$i = 0;
while($row = $result->fetch_assoc()) {
	$sql2 = 'select name from subjects where sub_id = '.$row['sub_id'];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$subs .= '<option>'.$row2['name'].'</option>';
	$r_subs .= '<option selected="selected">'.$row2['name'].'</option>';
	if($i < ($n_r - 1)) {
		$subs .= ':';
		$r_subs .= ':';
	}

}

$status_data['subjects'] = $subs;
$status_data['r_subjects'] = $r_subs;

echo json_encode($status_data);

?>