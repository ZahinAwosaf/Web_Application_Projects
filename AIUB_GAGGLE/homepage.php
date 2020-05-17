<?php 

session_start();
if(!isset($_SESSION["user_id"])) {
	header("location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/chosen.css">
	<link rel="stylesheet" type="text/css" href="CSS/homepage_css_design.css">
	<link rel="stylesheet" type="text/css" href="CSS/jquery-ui.css">
	<script src="JS/jquery-3.4.1.js" type="text/javascript"></script>
	<script src="JS/chosen.jquery.js" type="text/javascript"></script>
	<script src="JS/jquery-ui.min.js" type="text/javascript"></script>
	<script src="JS/homepage.js" type="text/javascript"></script>
</head>
<body>
	<header>
		<div id="logo">
			<h1>AIUB Gaggle</h1>
		</div>
		<div id="right-sec">
			<div id="header-right-sec-1">
				<div id="img-profile">
				</div>
				<span><?php echo $_SESSION['name']; ?></span>
			</div>
			<img src="IMAGE/plus.png" id="plus-img">
		</div>
	</header>


	<div id="profile-img-click">
		<ul id="profile-img-click-ul">
			<li id="view-profile-click">View Profile</li>
			<li id="setting-click">Setting</li>
			<li id="log-out-click">Log Out</li>
		</ul>
	</div>


	<div id="main-page-sec-search-list">
		<ul id="main-page-sec-list">

		</ul>
	</div>


	<div id="dialogs">

	</div>


	<div id="status">
		<ul>
			<li id="chlist">
				<label>Counseling Hour</label>
				<select id="chour">

				</select>
			</li>
			<li id="placehlist">
				<label>Places</label>
				<select id="place">

				</select>
			</li>
			<li id="subjectlist">
				<label>Choose Subjects</label>
				<select id="subjects" multiple="yes" data-placeholder="Choose Teching Subjects">
				</select>
			</li>
			<li id="btn">
				<button id="btncancel">Cancel</button>
				<button id="btnsubmit">Submit</button>
			</li>
		</ul>
	</div>


	<div id="header-setting-view-page">

	</div>


	<div id="main">
		<div id="sidebar">
			<ul class="list1">
				<li class="list1" id="main-sidebar-home-li">Home</li>
				<li id="dept" class="list1">Department
					<ul class="list2" id="dept_h_list">
						<li id="header-department-cse">CSE</li>
						<li id="header-department-bba">BBA</li>
						<li id="header-department-se">SE</li>
						<li id="header-department-eee">EEE</li>
					</ul>
				</li>
				<li class="list1" id="res-sidebar">Research</li>
				<li class="list1" id="faq-sidebar">FAQ</li>
			</ul>
		</div>
		<div id="main_sec">

		</div>
		<div id="sidebar_active_member_sec">

		</div>
	</div>
</body>
</html>