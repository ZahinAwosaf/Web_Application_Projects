<?php

include('db_connection.php');


$syn = '<tr><th width="300px">File Name</th><th>Publication Year</th><th>Domain Name</th><th>View</th><th>Download</th><th>Delete</th></tr>';
$sql = 'select * from research_info where user_id = '.$_POST['user_id'].' and lower(file_name) like "'.$_POST['search'].'%"';
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	$sql2 = 'select domain_name from research_domains where domain_id = '.$row['domain_id'];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();

	$syn .= '<tr><td>'.$row['file_name'].'</td><td>'.$row['pub_year'].'</td><td>'.$row2['domain_name'].'</td><td><button id="view-btn" class="btn">View</button></td><td><button id="download-btn" class="btn">Download</button></td><td><button id="delete-btn" class="btn">Delete</button></td></tr>';
}

echo $syn;

?>