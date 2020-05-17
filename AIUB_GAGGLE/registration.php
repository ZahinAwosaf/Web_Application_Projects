<?php

session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="CSS/chosen.css">
	<link rel="stylesheet" type="text/css" href="CSS/jquery-ui.css">
	<script src="JS/jquery-3.4.1.js" type="text/javascript"></script>
	<script src="JS/chosen.jquery.js" type="text/javascript"></script>
	<script src="JS/jquery-ui.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){

			$('#dob').datepicker();
			var dept_id = 0;
			var check_pre_btn_click = 0;
			var main_url = 'http://localhost/AIUB_GAGGLE/index.php';

			$('#main').on('click','#btnNext',function(){

				var check_pre_btn_click_for_next = 0;

				if(check_pre_btn_click == 1)
					check_pre_btn_click_for_next = 1;


				var nm = $('#name').val();
				var em = $('#email').val();
				var dob = $('#dob').val();
				dob = dob.split('/');
				dob = dob.reverse();
				dob = dob.join('-');
				var pass = $('#password').val();
				var ph = $('#phone').val();


				if(nm != '') {

					if(em != '') {

						if(pass != '') {

							if(ph != '') {

								if(dob != '') {

									$.ajax({
										url : "verify_email.php",
										method : "POST",
										data : { email: em},
										dataType : "text",
										success: function(data) {
											if(data != '') {
												$('#error-btn').html("<span>Email Already Used</span>");
											} else {



												$.ajax({
													url : "store_registration_session_data.php",
													method : "POST",
													data : { name : nm, email: em, DOB: dob, password: pass, phone: ph},
													dataType : "text",
													success: function(data) {
														// console.log(data);
													}


												});

												$.ajax({
													url : "get_registration_session_data.php",
													method : "POST",
													data : {check_pre_btn_click_for_next: check_pre_btn_click_for_next},
													dataType : "json",
													success: function(data) {
														var presData = data;

														var nextHtml = '<div id="reg-form"><div id="form-page2"><ul id="form-login2"><li class="l1"><label id="header-reg">Registration</label></li><li class="l1"><label>Choose Department</label><select id="dept" class="text"></select></li><li class="l1"><label>Choose Subjects</label><select id="subs" multiple="yes"></select></li><li class="l1"><label>AIUB ID</label><input type="text" id="aiub_id" required="" class="text" value="'+presData['aiub_id']+'"></li><li class="l1"><label>Choose Research Domains</label><select id="res-domain" multiple="yes"></select></li><li class="l1" id="img-sec"><div id="profile"><div id="text-file"><label>Profile Picture</label><input type="file" name="image_file" id="img-file-pro"></div><div id="pro-img"></div></div></li><li class="l1"><div id="error-msg"></div><div id="btnlist"><button id="btnPre">Pres</button><button id="btnNext2">Sign Up</button></div></li></ul></div></div>';

														$('#main').html(nextHtml);
														$('#subs').chosen();
														$('#dept').chosen();
														$('#res-domain').chosen();

														fetch_department_name_id(presData);
														
														if(check_pre_btn_click_for_next == 1) {
															fetch_subjects(presData);
															fetch_res_pres(presData, dept_id);
															// if(presData['dept'] == '')
															// 	fetch_research_domains_dept_id(dept_id);
														}

														$('#form-login2').on('change','#dept',function(){
															
															var dID = $('#dept').val();
															dept_id = dID;
															$.ajax({
																url : "fetch_subjects.php",
																method : "POST",
																data: {dept_id: dID},
																dataType : "text",
																success: function(data) {

																	$('#subs').html(data);
																	$('#subs').trigger('chosen:updated');
																}
															});

															fetch_res_pres(presData, dept_id);




														});


														$('#img-file-pro').change(function(e){
															for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

																var file = e.originalEvent.srcElement.files[i];

																img = document.createElement("img");
																var reader = new FileReader();
																reader.onloadend = function() {
																	img.src = reader.result;
																}
																reader.readAsDataURL(file);
																$("#pro-img").html(img);

															}
														});





													}
												});





											}
										}
									});

								} else {
									alert("Please fill your Date of Birth");
								}
							} else {
								alert("Please fill your phone no.");
							}
						} else {
							alert("Please fill password");
						}

					} else {
						alert("Please fill your email");
					}

				} else {
					alert("Please fill your name");
				}


			});

		function fetch_res_pres(presData, dept_id) {
			$.ajax({
					url : "fetch_select_domain_name_by_dept.php",
					method : "POST",
					data : {dept_id: dept_id},
					dataType : "text",
					async: false,
					success: function(data) {

						if(presData['res_d'] != '') {
							var splitpresData = presData['res_d'].split(',');
							var splitpresDataRep = presData['res_d_r'].split(',');

							var i = 0;
							for(i = 0; i<splitpresData.length; i++) {
								data = data.replace(splitpresData[i],splitpresDataRep[i]);
							}
							$('#res-domain').html(data);
							$('#res-domain').trigger('chosen:updated');
						}

						$('#res-domain').html(data);
						$('#res-domain').trigger('chosen:updated');
					}
				});

		}

		function fetch_research_domains_dept_id(dept_id) {
			$.ajax({
				url : "fetch_select_domain_name_by_dept.php",
				method : "POST",
				dataType : "text",
				async : false,
				data : {dept_id: dept_id},
				success: function(data) {
					$('#res-domain').html(data);
					$('#res-domain').trigger('chosen:updated');
				}
			});
		}


		function fetch_subjects(presData) {

			var dID = presData['dept_id'];
			$.ajax({
				url : "fetch_subjects.php",
				method : "POST",
				data: {dept_id: dID},
				dataType : "text",
				success: function(data) {

					if(presData['subs'] != '') {
						var splitpresData = presData['subs'].split(',');
		  				var splitpresDataRep = presData['subs_r'].split(',');

		  				var i = 0;
		  				for(i = 0; i<splitpresData.length; i++) {
		  					data = data.replace(splitpresData[i],splitpresDataRep[i]);
		  				}
					}

					$('#subs').html(data);
					$('#subs').trigger('chosen:updated');
				}
			});
		}


		function fetch_department_name_id(presData) {
			$.ajax({
				url : "fetch_department_name_id.php",
				method : "POST",
				dataType : "text",
				success: function(data) {
					if(presData['dept'] != '') {
						data = data.replace(presData['dept'],presData['dept_r']);
					}
					$('#dept').html(data);
					$('#dept').trigger('chosen:updated');
					

				}
			});
		}



		$('#main').on('click','#btnPre',function(){

			check_pre_btn_click = 1;

			var dept = $('#dept').val();
			dept_id = dept;
			var subs = $('#subs').val();
			var res_d = $('#res-domain').val();
			var id = $('#aiub_id').val();

			if(dept == 'Choose Department')
				dept = "";
			if(subs == '')
				subs = '';
			if(res_d == '')
				res_d = '';
			if(id == '')
				id = '';


			$.ajax({
				url : "store_registration_2_session_data.php",
				method : "POST",
				data : { dept: dept, subs: subs, res_d: res_d, aiub_id: id},
				dataType : "text",
				success: function(data) {
					
					var preHtml = '';

					$.ajax({
						url : "get_registration_session_data.php",
						method : "POST",
						data : { check_pre_btn_click_for_next: 0},
						dataType : "json",
						success: function(data) {

							preHtml = '<div id="reg-form"><div id="form-page"><ul id="form-login"><li><label id="header-reg">Registration</label></li><li><label>Name</label><input type="text" id="name" class="text" value="'+data['name']+'"></li><li><label>Email</label><input type="email" id="email" class="text" value="'+data['email']+'"></li><li><label>Password</label><input type="password" id="password" class="text" value="'+data['password']+'"></li><li><label>Phone</label><input type="text" id="phone" class="text" value="'+data['phone']+'"></li><li><label>Date Of Birth</label><input type="text" id="dob" class="text" value="'+data['dob']+'"></li><li><div id="error-btn"></div><button id="btnNext">Next</button></li></ul></div></div>';

							$('#main').html(preHtml);
							$('#dob').datepicker();
						}
					});





				}
			});




		});




		$('#main').on('click','#btnNext2',function(){

			var dept = $('#dept').val();
			var subs = $('#subs').val();
			var res_d = $('#res-domain').val();
			var id = $('#aiub_id').val();

			if(dept != 'Choose Department') {

				if(subs != '') {

					if(id != '') {

						if(res_d != '') {

							if($('#img-file-pro').val() != '') {

								$.ajax({
									url : "verify_aiub_id.php",
									method : "POST",
									data: {aiub_id: id},
									dataType : "text",
									success: function(data) {
										if(data != "error") {

											var fd = new FormData();
											var files = $('#img-file-pro')[0].files[0];
											fd.append('file',files);
											fd.append('subs',subs);
											fd.append('res_d',res_d);
											fd.append('aiub_id',id);
											fd.append('dept',dept);

											$.ajax({
												url : "registration_data_insert.php",
												method : "POST",
												data : fd,
												contentType: false,
												processData: false,
												dataType: "text",
												success: function(data) {
													if(data != '') 
														alert("Registration Is Not Successful");
													else
														window.location.replace(main_url);
												}
											});



										} else {
											$('#error-msg').html('<span id="error-text">ID Already Used</span>');
										}
									}
								});


							} else {
								alert("Please add your image");
							}
						} else {
							alert("Please fill your interested Research Domain");
						}
					} else {
						alert("Please fill your ID");
					}
				} else {
					alert("Please fill your expertise Subjects");
				}
			} else {
				alert("Please fill your Department");
			}

		});






		});
	</script>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			background-color: #88DCD7;
		}
		#main {
			height: auto;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		#reg-form {
			border-radius: 50px;
			padding: 50px;
			width: 500px;
			margin-top: 30px;
			height: auto;
			background-color: #00B3AA;
			display: flex;
			justify-content: center;
			align-items: center;
			box-shadow: 5px 5px 10px;
		}
		#form-page {
			width: 100%;
			height: auto;
		}
		#form-login li label {
			margin-bottom: 10px;
			color: white;
		}
		.text {
			text-align: center;
			height: 30px;
			border-radius: 10px;
			border-style: none;
			border: 1px solid #00B3AA;
		}
		#form-login li {
			display: flex;
			flex-direction: column;
			justify-content: flex-end;
			margin-bottom: 20px;
		}
		#header-reg {
			font-size: 30px;
			align-self: center;
			text-shadow: 1px 1px 1px;
		}
		#btnNext {
			width: 100px;
			align-self: flex-end;
			height: 30px;
			border-style: none;
			border: 1px solid #00B3AA;
			color: black;
			border-radius: 10px;
		}
		#btnNext:hover {
			cursor: pointer;
		}

		#error-btn {
			color: red;
		}
		#error-text {
			color: red;
		}

		/*For Next Button CLick CSS*/

		#form-page2 {
			width: 100%;
			height: auto;
		}
		#form-login2 li label {
			margin-bottom: 10px;
			color: white;
		}
		.text {
			text-align: center;
			height: 30px;
			border-radius: 10px;
			border-style: none;
			border: 1px solid #00B3AA;
		}
		#form-login2 li {
			display: flex;
			flex-direction: column;
			justify-content: flex-end;
		}
		#form-login2 {
			list-style: none;
		}
		#header-reg {
			font-size: 30px;
			align-self: center;
			text-shadow: 1px 1px 1px;
		}
		#btnlist {
			align-self: flex-end;
		}
		#btnNext2, #btnPre {
			width: 100px;
			height: 30px;
			border-style: none;
			border: 1px solid #00B3AA;
			color: black;
			border-radius: 10px;
			margin-left: 7px;
		}
		#btnNext2:hover, #btnPre:hover {
			cursor: pointer;
		}
		.chosen-container .chosen-results {
			max-height: 100px;
		}
		.chosen-container {
			max-height: 100px;
		}
		.l1 {
			margin-bottom: 20px;
		}
		#pro-img {
			max-width: 80px;
			max-height: 80px;
		}
		#pro-img img {
			width: 100%;
			height: 100%;
		}
		#profile {
			display: flex;
			justify-content: space-between;
			width: 100%;
			height: 100%;
		}
		#text-file {
			display: flex;
			flex-direction: column;
		}


	</style>
</head>
<body>
<div id="main">
	<div id="reg-form">
		<div id="form-page">
			<ul id="form-login">
				<li>
					<label id="header-reg">Registration</label>
				</li>
				<li>
					<label>Name</label>
					<input type="text" id="name" class="text" value="">
				</li>
				<li>
					<label>Email</label>
					<input type="email" id="email" class="text" value="">
				</li>
				<li>
					<label>Password</label>
					<input type="password" id="password" class="text" value="">
				</li>
				<li>
					<label>Phone</label>
					<input type="text" id="phone" class="text" value="">
				</li>
				<li>
					<label>Date Of Birth</label>
					<input type="text" id="dob" class="text" value="">
				</li>
				<li>
					<div id="error-btn">
					</div>
					<button id="btnNext">Next</button>
				</li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>