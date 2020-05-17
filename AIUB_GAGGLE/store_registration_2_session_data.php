<?php 

// session_start();
// session_destroy();
session_start();

include('db_connection.php');
$dept = '';
$dept_r = '';
$subs_r = '';
$subs = '';
$res_d = '';
$res_d_r = '';
$id = '';
$dept_id = '';

if($_POST['dept'] != '') {

	$sql = 'select * from department where dept_id = '.$_POST['dept'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$dept = '<option value="'.$_POST['dept'].'">'.$row['name'].'</option>';
	$dept_r = '<option value="'.$_POST['dept'].'" selected="selected">'.$row['name'].'</option>';

	$dept_id = $_POST['dept'];

}

if($_POST['subs'] != '') {

	$_POST['subs'] = join(',',$_POST['subs']);

	$subjectList = explode(',', $_POST['subs']);
	$subs = '';
	$subs_r = '';

	$ln = sizeof($subjectList);
	for ($i=0; $i < $ln ; $i++) { 
		$subs .= '<option>'.$subjectList[$i].'</option>';
		$subs_r .= '<option selected="selected">'.$subjectList[$i].'</option>';
		if($i < ($ln-1)) {
			$subs .= ',';
			$subs_r .= ',';
		}
	}


}


if($_POST['res_d'] != '') {

	$_POST['res_d'] = join(',',$_POST['res_d']);
	$research_dm = explode(',', $_POST['res_d']);

	$ln = sizeof($research_dm);
	for ($i=0; $i < $ln ; $i++) { 
		$res_d .= '<option>'.$research_dm[$i].'</option>';
		$res_d_r .= '<option selected="selected">'.$research_dm[$i].'</option>';
		if($i < ($ln-1)) {
			$res_d .= ',';
			$res_d_r .= ',';
		}
	}

}



if($_POST['aiub_id'] != '')
	$id = $_POST['aiub_id'];

$_SESSION['dept'] = $dept;
$_SESSION['dept_r'] = $dept_r;
$_SESSION['subs'] = $subs;
$_SESSION['subs_r'] = $subs_r;
$_SESSION['res_d'] = $res_d;
$_SESSION['res_d_r'] = $res_d_r;
$_SESSION['aiub_id'] = $id;
$_SESSION['dept_id'] = $dept_id;


?>