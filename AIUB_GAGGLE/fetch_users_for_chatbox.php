<?php

session_start();

$imgpath = "IMAGE/";
$unseen_msg = "";

include('db_connection.php');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$syn = '';
$sql = 'select * from user_info where user_id <> "'.$_POST['user_id'].'" and dept_id ="'.$_POST['dept_id'].'"';
$result = $conn->query($sql);

date_default_timezone_set("Asia/Dhaka");
$current_timestamp = strtotime(date('Y-m-d H:i:s'). '-10 second');
$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);


while($row = $result->fetch_assoc()) {
	$sql2 = 'select * from login_details where user_id ='.$row['user_id'].' order by last_activity desc limit 1';
	$result2 = $conn->query($sql2);
	if(mysqli_num_rows($result2)>0) {
		$row2 = $result2->fetch_assoc();
		$last_act = $row2['last_activity'];

		if($last_act > $current_timestamp) {
			$statusVal = 'Active';
			$statusClass = 'activeimg';


			$sql12 = 'select count(*) as msg from chat_message where from_user_id = '.$row['user_id'].' and to_user_id = '.$_POST['user_id'].' and status = 1';
			$result12 = $conn->query($sql12);
			if(mysqli_num_rows($result12)>0) {
				$row12 = $result12->fetch_assoc();
				if($row12['msg'] > 0) {
					$unseen_msg = '<p style="background-color:white; color: green; width: 20px; text-align: center; margin-right:8px; border-radius: 10px; font-weight:bold;">'.$row12['msg'].'</p>';
				}
			}
			




			$syn .='<li id="'.$row['user_id'].'"><div id="contain-leftright"><div id="left-sec2"><img src="'.$imgpath.$row['image'].'" class="listimg2"><p>'.$row["name"].'</p></div><div id="right-sec2">'.$unseen_msg.'<p id="'.$statusClass.'"></p></div></div></li>';
		}
	}
}

echo $syn;


?>