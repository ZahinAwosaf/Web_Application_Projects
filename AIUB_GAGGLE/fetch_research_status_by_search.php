<?php

session_start();

include('db_connection.php');

$file_path = 'RESEARCH_PAPER/';

$syn = '<tr><th width="750px">File Name</th><th>View</th><th>Download</th></tr>';


$sql = 'select * from research_domains where domain_name = "'.$_POST['domain_name'].'"';
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql = 'select * from research_info where user_id = '.$_POST['user_id'].' and domain_id = '.$row['domain_id'].' and dept_id = '.$_POST['dept_id'].' and lower(file_name) like "'.$_POST["search"].'%" order by pub_year desc';


$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {

	$syn .= '<tr><td>'.$row['file_name'].'</td><td><a href="'.$file_path.$row['file_name'].'" target="_blank"><button id="view-btn" class="btn">View</button></a></td><td><a href="'.$file_path.$row['file_name'].'" download="'.$row['file_name'].'"><button id="download-btn" class="btn">Download</button></a></td></tr>';
	
}

echo $syn;

?>