<?php
session_start();

$u_info = array();

$u_info['dept_id'] = $_SESSION['dept_id'];
$u_info['user_id'] = $_SESSION['user_id'];


echo json_encode($u_info);


?>