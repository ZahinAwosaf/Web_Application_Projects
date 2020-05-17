<?php

session_start();

include('db_connection.php');

date_default_timezone_set("Asia/Dhaka");
$current_timestamp = date('Y-m-d H:i:s');

$sql = 'insert into faq_questions(question_text,timestamp) values("'.$_POST['que_text'].'","'.$current_timestamp.'")';

$conn->query($sql);

$conn->close();



?>