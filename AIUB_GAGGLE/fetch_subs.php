<?php

session_start();

$imgpath = "IMAGE/";


include('db_connection.php');

$syn = '';
$sql = 'select u.user_id,u.name,u.image from subjects s,expertise e, user_info u where s.name like "'.$_POST["search"].'%" and s.sub_id=e.sub_id and e.user_id=u.user_id and u.user_id <> '.$_POST['user_id'].' and u.dept_id = '.$_POST['dept_id'];

$result = $conn->query($sql);

date_default_timezone_set("Asia/Dhaka");

$current_timestamp = strtotime(date('Y-m-d H:i:s'). '-10 second');
$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);


while($row = $result->fetch_assoc()) {
	$syn .= '<li ';
	$sql2 = 'select * from login_details where user_id='.$row['user_id'].' order by last_activity desc limit 1';
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

	$syn .='id="'.$row['user_id'].'-'.$statusClass.'"><div id="left-sec"><img src="'.$imgpath.$row['image'].'" class="listimg"><p>'.$row["name"].'</p></div><div id="right-sec"><span class="text2">Status : '.$statusVal.'</span><p id="'.$statusClass.'"></p></div></li>';
}

echo $syn;


?>




