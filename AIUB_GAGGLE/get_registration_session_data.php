<?php 

session_start();

$reg = array();

$reg['name'] = $_SESSION['name'];
$reg['email'] = $_SESSION['email'];
$reg['password'] = $_SESSION['password'];
$reg['phone'] = $_SESSION['phone'];
$reg['dob'] = $_SESSION['dob'];

if($_POST['check_pre_btn_click_for_next'] == 1) {

	$reg['dept'] = $_SESSION['dept'];
	$reg['dept_r'] = $_SESSION['dept_r'];
	$reg['subs'] = $_SESSION['subs'];
	$reg['subs_r'] = $_SESSION['subs_r'];
	$reg['res_d'] = $_SESSION['res_d'];
	$reg['res_d_r'] = $_SESSION['res_d_r'];
	$reg['aiub_id'] = $_SESSION['aiub_id'];
	$reg['dept_id'] = $_SESSION['dept_id'];

} else {
	$reg['dept'] = "";
	$reg['dept_r'] = "";
	$reg['subs'] = "";
	$reg['subs_r'] = "";
	$reg['res_d'] = "";
	$reg['res_d_r'] = "";
	$reg['aiub_id'] = "";
	$reg['dept_id'] = '';
}

echo json_encode($reg);

?>