<?php

include('db_connection.php');


$syn = '';
$sql = 'select domain_name from research_domains';
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
	$syn .= '<option>'.$row['domain_name'].'</option>';
}

echo $syn;

?>