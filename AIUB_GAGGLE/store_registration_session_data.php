<?php 

// session_start();
// session_destroy();
session_start();

$reg = array();


$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['dob'] = $_POST['DOB'];


$reg['name'] = $_SESSION['name'];
$reg['email'] = $_SESSION['email'];
$reg['password'] = $_SESSION['password'];
$reg['phone'] = $_SESSION['phone'];
$reg['dob'] = $_SESSION['dob'];

echo json_encode($reg);

?>