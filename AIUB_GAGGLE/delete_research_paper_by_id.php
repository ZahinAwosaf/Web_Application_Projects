<?php

session_start();

include('db_connection.php');

$sql = 'delete from research_info where research_id = '.$_POST['res_id'];
$conn->query($sql);

$conn->close();

?>