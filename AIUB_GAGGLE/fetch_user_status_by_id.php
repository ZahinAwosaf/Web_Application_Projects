<?php

session_start();

$imgpath = "IMAGE/";
include('db_connection.php');

$sql3 = 'select name,image from user_info where user_id="'.$_POST['user_id'].'"';

$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();

$img = $row3["image"];
$user_name = $row3["name"];

$sql4 = 'select status_id,time_format(start_timestamp,"%r") as st,time_format(end_timestamp,"%r") as et,time_format(status_timestamp,"%r") as sst,place from users_status where user_id = '.$_POST['user_id'].' order by status_timestamp desc';

$result4 = $conn->query($sql4);

if(mysqli_num_rows($result4)>0) {

	while($row4 = $result4->fetch_assoc()) {

		$syn = '<div class="cur_status"><div id="header-for-status"><div id="pro"><div id="pro-img"><img ';

		$syn .= 'src="'.$imgpath.$img.'"></div><span>'.$user_name.'</span></div><div id="rightside"><button class="btn2">View Profile</button></div></div><div id="content"><ul><li><span>Time </span><span id="status-time">'.$row4["st"].' to '.$row4["et"].'</span></li><li><span>Subjects</span><span id="status-subs';

			$sql5 = 'select sub_id from user_status_subjects where status_id= '.$row4['status_id'];
			$result5 = $conn->query($sql5);
			$sublist = '';
			$no_r = mysqli_num_rows($result5);

			$i = 0;
			while($row5 = $result5->fetch_assoc()) {
				$sql6 = 'select name from subjects where sub_id= '.$row5['sub_id'];
				$result6 = $conn->query($sql6);
				$row6 = $result6->fetch_assoc();
				$sublist .= $row6["name"];
				if($i < ($no_r - 1))
					$sublist .= ', ';
				$i++;
			}

			$syn .= '">'.$sublist.'</span></li><li><span>Places</span><span id="status-place">'.$row4["place"].'</span></li></ul></div></div>';

			echo $syn;
		}

		
}

?>