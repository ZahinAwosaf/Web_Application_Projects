$(document).ready(function(){

	$main_url = 'http://localhost/AIUB_GAGGLE/index.php';

	var checkResearch_Page_Click = 0;

	var setIn1 = 0;
	var setIn2 = 0;
	var setIn3 = 0;

	var setIntervalTime = 5000;

	var sdata = fetch_session_data();

	function fetch_session_data() {
		var sdata = [];
		$.ajax({
  			url : 'fetch_user_session_data.php',
  			method : "POST",
  			dataType : "json",
  			async: false,
  			success: function(data) {
  				sdata.push(data['dept_id']);
  				sdata.push(data['user_id']);
  			}
  		});
  		return sdata;
	}

	var G_dept_id = sdata[0];
	var G_user_id = sdata[1];

	// After Login - Call Own Department

	fetch_users_by_department(G_user_id,G_dept_id);
	

	// Sidebar Department Click Section List JS

	$(document).on('click','#dept',function(){
		$('#dept_h_list').toggle();
	});

	$(document).on('click','#header-department-cse',function(){
		G_dept_id = 101;
		if(checkResearch_Page_Click == 0) {
			fetch_users_by_department(G_user_id,G_dept_id);
		}
		else {
			fetch_searchbox_and_select();
		}
		
	});

	$(document).on('click','#header-department-se',function(){
		G_dept_id = 105;
		if(checkResearch_Page_Click == 0) {
			fetch_users_by_department(G_user_id,G_dept_id);
		}
		else {
			fetch_searchbox_and_select();
		}
	});

	$(document).on('click','#header-department-eee',function(){
		G_dept_id = 104;
		if(checkResearch_Page_Click == 0) {
			fetch_users_by_department(G_user_id,G_dept_id);
		}
		else {
			fetch_searchbox_and_select();
		}
	});

	$(document).on('click','#header-department-bba',function(){
		G_dept_id = 102;
		if(checkResearch_Page_Click == 0) {
			fetch_users_by_department(G_user_id,G_dept_id);
		}
		else {
			fetch_searchbox_and_select();
		}
	});




	function home_page_main_sys() {
		
		var syn = '<div id="main-search-sec"><input type="text" id="searchbox"><div id="checkboxforsearch"><div id="left-ch"><input type="radio" name="checkbox" class="ch" value="user" checked><label class="sh">Search Username</label></div><div id="right-ch"><input type="radio" name="checkbox" class="ch" value="subject"><label class="sh">Search by Subject</label></div></div></div><div id="main-page-sec"><div id="main-page-for-status"></div></div>';
		
		$('#main_sec').html(syn);

		syn = '<div id="sidebar_active_member_sec-for-chatbox"><div id="chatbox-header"><p>ChatBox</p></div><div id="chatbox-body"><ul id="chatbox-body-list"></ul></div></div><div id="sidebar_active_member_sec-for-profile"></div>';

		$('#sidebar_active_member_sec').html(syn);


		$('#main_sec').css('width','55%');
		$('#sidebar_active_member_sec').css('width','23%');
		$('#sidebar_active_member_sec').show();

	}






	function fetch_users_by_department(G_user_id,G_dept_id) {

		home_page_main_sys();
		$('#searchbox').val("");
		$('#main-page-sec-search-list').hide();

		stopInterVals();

		fetch_users_in_chatbox(G_user_id,G_dept_id);
		fetch_user_status(G_user_id,G_dept_id);

		setIn1 = setInterval(function() {
			update_users_last_activity();
			update_chat_histroy_data();
		},setIntervalTime);

		setIn2 = setInterval(function() {
			fetch_users_in_chatbox(G_user_id,G_dept_id);
			fetch_user_status(G_user_id,G_dept_id);
		},setIntervalTime);

	}


	function fetch_users_in_chatbox(uid,deptID) {

		$.ajax({
			url : "fetch_users_for_chatbox.php",
			method : "POST",
			data : {user_id: uid, dept_id: deptID},
			dataType : "text",
			success: function(data) {
				$('#chatbox-body-list').html(data);
			}
		});

	}

	function update_users_last_activity() {

		$.ajax({
			url : "update_users_last_activity.php",
			method : "POST",
			dataType : "text",
			success: function(data) {
			}
		});

	}


	function fetch_user_status(G_user_id,G_dept_id) {
		$.ajax({
			url : "fetch_users_status.php",
			method : "POST",
			data : { user_id: G_user_id, dept_id: G_dept_id},
			dataType : "text",
			success: function(data) {
  				$('#main-page-for-status').html(data);
	  		}
	  	});

	}


	function stopInterVals() {
		clearInterval(setIn2);
		clearInterval(setIn3);
	}


	// Sidebar home button click event


	// For Research Page Home Button click


	function fetch_searchbox_and_select() {
		checked_my_list_btn_click = 0;
		fetch_searchbox_and_searched_data();
		fetch_select_domain_name_by_dept();
	}


	function fetch_searchbox_and_searched_data() {

		var syn = fetch_searchbox();
		syn += '<select id="search_by_domain_name"></select><table id="main-content-table"></table></div>';
		$('#main_sec').html(syn);
		$('#search_by_domain_name').chosen();
	}

	function fetch_searchbox() {
		var syn = '<div id="main-search-sec"><input type="text" id="searchbox"></div><div id="main-content"></div>';
		return syn;
	}


	function fetch_select_domain_name_by_dept() {

  		$.ajax({
  			url : "fetch_select_domain_name_by_dept.php",
  			method : "POST",
  			data : { dept_id: G_dept_id},
  			dataType : "text",
  			success: function(data) {
  				
  				$('#search_by_domain_name').html(data);
  				$('#search_by_domain_name').trigger("chosen:updated");

  				var domain_name = $('#search_by_domain_name').val();
  				research_paper_search_by_dept(domain_name);

  			}
  		});

  	}


  	function research_paper_search_by_dept(domain_name) {
  		if(domain_name != null) {
  			$.ajax({
  				url : "research_paper_search_by_department.php",
  				method : "POST",
  				data : { dept_id: G_dept_id, domain_name: domain_name},
  				dataType : "text",
  				success: function(data) {
  					$('#main-content-table').html(data);
  				}
  			});
  		}
  	}




	$(document).on('click','#main-sidebar-home-li',function(){

		// G_dept_id = "<?php echo $_SESSION['dept_id']; ?>";
		G_dept_id = sdata[0];

		if(checkResearch_Page_Click == 0) {
			fetch_users_by_department(G_user_id,G_dept_id);
		}
		else {
			fetch_searchbox_and_select();
		}
		
	});



	// SearchBox Search By Department

	var checkboxChecked = '';
	
	$(document).on('change','.ch',function(){
  		checkboxChecked = $(this).attr('value');
  	});

  	function search_box_by_department(G_user_id, G_dept_id, search_text) {

  		var nurl = '';

  		if(checkboxChecked == 'user' || checkboxChecked == '')
  			nurl = "fetch_users.php";
  		else
  			nurl = "fetch_subs.php";
  		$.ajax({
  			url : nurl,
  			method : "POST",
  			data : { search : search_text, user_id: G_user_id, dept_id: G_dept_id},
  			dataType : "text",
  			success: function(data) {
  				$('#main-page-sec-list').html(data);
  			}
  		});

  	}


	$(document).on('keyup','#searchbox',function(){

	  	var txt = $('#searchbox').val();
	  	txt = txt.toLowerCase();

	  	if(checkResearch_Page_Click == 0) {

		  	if(txt != '') {
		  		$('#main-page-sec-search-list').show();
			  	search_box_by_department(G_user_id, G_dept_id, txt);
		  	} else {
		  		$('#main-page-sec-search-list').hide();
		  	}
		}
		else {
			var domain_name = $('#search_by_domain_name').val();

			if(checked_my_list_btn_click == 0) {

			  	if(txt != '') {
				  	research_search_box_by_department(G_user_id, G_dept_id, txt, domain_name);
			  	} else {
			  		$('#main-content-table').html('');
			  	}

			} else {

			  	if(txt != '') {

				  	$.ajax({
			  			url : "fetch_own_research_paper_search.php",
			  			method : "POST",
			  			data : { search : txt, user_id: G_user_id},
			  			dataType : "text",
			  			success: function(data) {
			  				$('#main-content-table').html(data);
			  			}
			  		});

			  	} else {
			  		fetch_research_paper_by_id(G_user_id);
			  	}

			}
		}

  	});




	// This is for research page searchbox JS

	$(document).on('change','#search_by_domain_name',function(){
  		$('#searchbox').val("");
  		$('#main-content-table').html('');
  		research_paper_search_by_dept($(this).val());
  	});


	function research_search_box_by_department(G_user_id, G_dept_id, search_text, domain_name) {

  		$.ajax({
  			url : "fetch_research_status_by_search.php",
  			method : "POST",
  			data : { search : search_text, user_id: G_user_id, dept_id: G_dept_id, domain_name: domain_name},
  			dataType : "text",
  			success: function(data) {
  				$('#main-content-table').html(data);
  			}
  		});

  	}


  	function message_box(userID) {

  		var syn = '<div class="chat_dialog_boxs '+userID+'" id="user-dialog-'+userID+'"><div id="chat-history'+userID+'" class="chat-history"></div><div id="chat-msg-box"><textarea name="chat-msg" id="text-area-for-msg'+userID+'" class="text-area-for-msg"></textarea></div><div id="btn-for-send"><button name="'+userID+'" id="btn-send-chat">Send</button></div></div>';

  		$('#dialogs').html(syn);
  		$('#user-dialog-'+userID).css({'margin':'0px','padding':'0px'});

  		$('#user-dialog-'+userID).dialog({
  			closeOnEscape: false,
  			autoOpen: false,
  			resizable: false,
  			width: 330,
  			close: function(event, ui) {
  				$(this).dialog('destroy').remove();
  			}
  		});


  		$.ajax({
  			url : "fetch_users_info.php",
  			method : "POST",
  			data : { user_id : userID},
  			dataType : "json",
  			success: function(data) {
  				var uName = 'You are chatting with '+data.name;
  				$('#user-dialog-'+userID).dialog({title : uName});
  			}
  		});

  		$('#user-dialog-'+userID).dialog('open');

  	}



	$(document).on('click','#chatbox-body-list li',function(){

		$('#searchbox').val("");
		$('#main-page-sec-search-list').hide();

	  	var userID = $(this).attr('id');
	  	message_box(userID);

	  	update_chat_histroy_data();

	});

	$(document).on('click','#btn-send-chat',function(){

		var to_user_id = $(this).attr('name');
		var from_user_id = G_user_id;

		var message = $('#text-area-for-msg'+to_user_id).val();

		if(message != '') {

			$.ajax({
	  			url : "insert_chat_message.php",
	  			method : "POST",
	  			data : { from_user_id : from_user_id, to_user_id: to_user_id, msg: message},
	  			dataType : "text",
	  			success: function(data) {
		  			$('#chat-history'+to_user_id).html(data);
	  			}
	  		});
			$('#text-area-for-msg'+to_user_id).val("");
		}

	});


	function update_chat_histroy_data() {

		$('.chat_dialog_boxs').each(function(){
			var from_user_id = G_user_id;
			var to_user_id = $(this).attr('class').split(' ');
			to_user_id = to_user_id[1];

			$.ajax({
				url : "fetch_chat_history_message.php",
				method : "POST",
				data : { from_user_id : from_user_id, to_user_id: to_user_id},
				dataType : "text",
				success: function(data) {
					$('#chat-history'+to_user_id).html(data);
				}

			});

		});
	}


	// Header Section Show View Profile, Setting, Logout hover event JS

	$('#header-right-sec-1').mouseover(function(){
		$('#profile-img-click').show();

	});

	$('#header-right-sec-1').mouseout(function(){
		
		$('#profile-img-click').hide();

	});

	$('#profile-img-click').mouseover(function(){
		
		$(this).show();

	});

	$('#profile-img-click').mouseout(function(){
		
		$(this).hide();

	});



	//  Header Section Profile Image Change Event
	
	profile_image_update();
	function profile_image_update() {
		var syn = '';
		$.ajax({
			url : "fetch_users_info.php",
			method : "POST",
			data : { user_id: G_user_id},
			dataType : "json",
			async : false,
			success: function(data) {
				syn = '<img src="IMAGE/'+data['image']+'" id="header-pro-img">';
				$('#img-profile').html(syn);
			}

		});
	}



	// Header Section Plus Button Click Event


	$('#plus-img').click(function(){
		$('#btnsubmit').text("Submit");
		$('#status').show();
		$('#main').css('filter','blur(1px)');
  	
		$('#chour').chosen();
		$('#place').chosen();
		$('#subjects').chosen();

	  	var chouroptionvalue = '<option>Choose Counseling Hour</option><option>30 minutes</option><option>1 hour</option><option>2 hour</option><option>3 hour</option><option>4 hour</option><option>5 hour</option><option>6 hour</option>';

	  	$('#chour').html(chouroptionvalue);
	  	$('#chour').trigger('chosen:updated');

	  	var placeoptionvalue = '<option>Choose Place</option><option>D Building</option><option>Annex 1</option><option>Annex 2</option><option>Annex 3</option><option>Annex 4</option><option>Annex 5</option><option>Annex 6</option>';

	  	$('#place').html(placeoptionvalue);
	  	$('#place').trigger('chosen:updated');

	  	fetch_subjects_for_status(G_user_id);			
	  	function fetch_subjects_for_status(G_user_id) {
	  		$.ajax({
	  			url : "fetch_subjects_by_id.php",
	  			method : "POST",
	  			data : { user_id: G_user_id},
	  			dataType : "text",
	  			success: function(data) {
	  				$('#subjects').html(data);
	  				$('#subjects').trigger('chosen:updated');
	  			}
	  		});
	  	}
	});


	$(document).on('click','#btncancel',function(){

	  	$('#status').hide();
	  	$('#main').css('filter','blur(0px)');

	});



$(document).on('click','#btnsubmit',function(){

  	if($('#btnsubmit').text() == "Submit") {
  	
	  	if($('#chour').val() != 'Choose Counseling Hour') {

	  		if($('#place').val() != 'Choose Place') {

	  			if($('#subjects').val() != '') {
	  				
	  				var counseling_h = $('#chour').val();
	  				var subject_list = $('#subjects').val();
	  				var pla = $('#place').val();

				  	$.ajax({
				  		url : "add_status_on_database.php",
				  		method : "POST",
				  		data : { c_h: counseling_h, subs: subject_list, pl: pla},
				  		dataType : "text",
				  		success: function(data) {
				  			alert("Status Added");
				  		}
				  	});

				  	$('#main').css('filter','blur(0px)');
				  	$('#status').hide();


	  			} else
	  				alert("Please Select at least One Subjects");
	  		} else
	  			alert("Please Select Place");

		  } else
		  	alert("Please Select Counseling Hour");
	} else {

		var State_ID = $('#btnsubmit').attr('class');

		var counseling_h = $('#chour').val();
		var subject_list = $('#subjects').val();
		var pla = $('#place').val();

		$.ajax({
			url : "update_status_on_database.php",
			method : "POST",
			data : { c_h: counseling_h, subs: subject_list, pl: pla, stat_id: State_ID},
			dataType : "text",
			success: function(data) {
				alert("Updated Status");
				$('#status').hide();
				$('#main').css('filter','blur(0px)');
				$('#btnsubmit').text("Submit");
			}
		});

	}

});


// Main Page Or Home Page Status Lists View Profile Click Event


$(document).on('click','#homepage-view-pro-btn',function() {
	var str = $(this).attr('class');
  	var store = str.split(' ');
  	var selectedUserID = parseInt(store[1]);

  	$.ajax({
  		url : "fetch_activity_status_by_id.php",
  		method : "POST",
  		data : { user_id: selectedUserID},
  		dataType : "text",
  		success: function(data) {
  			var str = data.split('-');
  			var statusString = '';
  			if(str[0] == "Active")
  				statusString = 'Online';
  			else
  				statusString = "Offline";
  			var status = str[1];
  			view_profile_by_id(selectedUserID,statusString,status);
  		}
  	});


});


// Header section Log Out Button Click


$(document).on('click','#log-out-click',function(){
	$.ajax({
		url : 'logout.php',
		method : "POST",
		success: function(data) {
			window.location.replace($main_url);
		}
	});
});



// SideBar Research Button CLick Event

	$(document).on('click','#res-sidebar',function(){

		checkResearch_Page_Click = 1;
		checked_my_list_btn_click = 0;

		// G_dept_id = "<?php echo $_SESSION['dept_id']; ?>";
		G_dept_id = sdata[0];
		
		var syn = '<ul class="list1"><li class="" id="main-sidebar-home-li">Home</li><li id="dept" class="">Department<ul class="list2" id="dept_h_list"><li id="header-department-cse">CSE</li><li id="header-department-bba">BBA</li><li id="header-department-se">SE</li><li id="header-department-eee">EEE</li></ul></li><li class="" id="sidebar_upload_file">Upload File</li><li class="" id="sidebar_my_list">My List</li></ul><ul id="go-to-homepage-btn" class="list1"><li id="go-to-homepage">Go To Homepage</li></ul>';

		$('#sidebar').html(syn);
		$('#sidebar').css('flex-direction','column');
		$('#sidebar').css('justify-content','flex-start');

		$('#main_sec').html("");
		$('#main_sec').css('width','79%');
		$('#sidebar_active_member_sec').html('');
		$('#sidebar_active_member_sec').css('display','none');

		fetch_select_domain_name_by_dept();
		fetch_searchbox_and_searched_data();

	});





	$(document).on('click','#go-to-homepage',function(){

		var syn = '<ul class="list1"><li class="list1" id="main-sidebar-home-li">Home</li><li id="dept" class="list1">Department<ul class="list2" id="dept_h_list"><li id="header-department-cse">CSE</li><li id="header-department-bba">BBA</li><li id="header-department-se">SE</li><li id="header-department-eee">EEE</li></ul></li><li class="list1" id="res-sidebar">Research</li><li class="list1" id="faq-sidebar">FAQ</li></ul>';

		$('#sidebar').html(syn);

		// home_page_main_sys();

		checkResearch_Page_Click = 0;
		checked_my_list_btn_click = 0;

		// G_dept_id = "<?php echo $_SESSION['dept_id']; ?>";
		G_dept_id = sdata[0];

		fetch_users_by_department(G_user_id,G_dept_id);

	});


  	// Upload Paper Click Event


  	function sidebar_upload_file_page() {

  		var syn = '<div id="research_paper_upload_sec"><div id="input-for-research"><div id="research-pub-year" class="flex-col"><span><i>Publication Year</i></span><input type="text" id="date-for-pub-year"></div><div id="research-domain-name" class="flex-col"><span><i>Select Domain Name</i></span><select id="select-domain-in-res-sec"></select></div><div id="research-paper-file" class="flex-col"><span><i>Upload Paper</i></span><input type="file" id="res-paper-file"></div><div id="research-submit-btn"><button id="upload-res-paper-btn">Submit</button></div></div></div>';
  		$('#main_sec').html(syn);
  		$('#select-domain-in-res-sec').chosen();
  		$('#date-for-pub-year').datepicker();
  		$('#date-for-pub-year').css('height','30px');
  		
  		$.ajax({
  			url : 'fetch_research_domains_by_id.php',
  			method : "POST",
  			data : { user_id: G_user_id},
  			success: function(data) {
  				$('#select-domain-in-res-sec').html(data);
  				$('#select-domain-in-res-sec').trigger('chosen:updated');

  			}
  		});

  	}


  	$(document).on('click','#sidebar_upload_file',function(){
  		sidebar_upload_file_page();
  	});


  	$(document).on('click','#research-submit-btn #upload-res-paper-btn',function() {

  		if($('#research_paper_upload_sec #date-for-pub-year').val() != '') {
  			if($('#res-paper-file')[0].files.length > 0) {
  				var form_data = new FormData();
				var file_name = '';
				var file_check = '';
					
				if($('#res-paper-file')[0].files.length > 0) {
					file_name = $('#res-paper-file')[0].files[0];
					form_data.append('file',file_name);
					form_data.append('file_check',"image");
				}
				else {
					form_data.append('file_check',"");
				}

				var dID = sdata[0];

				var dob = $('#research_paper_upload_sec #date-for-pub-year').val();
				dob = dob.split('/');
				dob = dob.reverse();
				dob = dob.join('-');

				form_data.append('domain_name',$('#research_paper_upload_sec #select-domain-in-res-sec').val());
				form_data.append('pub_year',dob);
				form_data.append('user_id',G_user_id);
				form_data.append('dept_id',dID);



				$.ajax({
					url : "insert_research_paper.php",
					method : "POST",
					data : form_data,
					contentType: false,
					processData: false,
					dataType: "text",
					async : false,
					success: function(data) {
						if(data == "") {
							alert("Research Paper Uploaded");
							sidebar_upload_file_page();
						}
						else
							alert(data);
					}
				});
  			} else 
  				alert("Please Put Research Paper");
  		} else {
  			alert("Please Put Publication Date");
  		}

  	});



  	var checked_my_list_btn_click = 0;

  	$(document).on('click','#sidebar_my_list',function(){

  		checked_my_list_btn_click = 1;

  		var syn = fetch_searchbox();
  		syn += '<table id="main-content-table"></table></div>';
  		$('#main_sec').html(syn);
  		fetch_research_paper_by_id(G_user_id);

  		$(document).on('click','#delete-btn',function() {
  			var res_id = $(this).attr('class');
  			res_id = res_id.split(' ');
  			res_id = parseInt(res_id[1]);

  			$.ajax({
  				url : "delete_research_paper_by_id.php",
  				method : "POST",
  				data : { res_id: res_id},
  				dataType : "text",
  				success: function(data) {
  					fetch_research_paper_by_id(G_user_id);
  				}
  			});

  		});

  	});

  	function fetch_research_paper_by_id(G_user_id) {
  		var syn = '';
  		$.ajax({
  			url : "fetch_research_paper_by_id.php",
  			method : "POST",
  			data : { user_id: G_user_id},
  			dataType : "text",
  			success: function(data) {
  				$('#main-content-table').html(data);
  			}
  		});
  	}







  	// Header Section View Profile Click Event


  	function fetch_subjects_by_id(uID) {
  		$.ajax({
  			url : 'fetch_subjects_by_id.php',
  			method : "POST",
  			data : { user_id: uID},
  			dataType : "text",
  			success: function(data) {
  				$('#profile-expertise-subjects').html(data);
  				$('#profile-expertise-subjects').trigger('chosen:updated');
  			}
  		});
  	}

  	function fetch_research_domains_by_id(uID) {
  		$.ajax({
  			url : 'fetch_research_domains_by_id.php',
  			method : "POST",
  			data : { user_id: uID},
  			dataType : "text",
  			success: function(data) {
  				$('#profile-research-domains').html(data);
  				$('#profile-research-domains').trigger('chosen:updated');
  			}
  		});
  	}


  	//  Header Section View Profile Click Event


  	function view_profile_by_id(uID, statusString, statusColor) {

  		stopInterVals();
  		
  		// $('#main-page-sec-search-list').hide();
  		// $('#main-search-sec').html('');

  		var btns = '<button id="btn-follow-click" class="btn-follow-click-'+uID+'">Follow</button><button id="profile-message-box-btn" class="view-pro-msg-btn-'+uID+'">Message</button>';
  		var nurl = '';

  		var img = '';
  		var nm = '';
  		var id = '';
  		$.ajax({
			url : "fetch_users_info.php",
			method : "POST",
			data : { user_id: uID},
			dataType : "json",
			success: function(data) {
				img = data['image'];
				id = data['aiub_id'];
				nm = data['name'];
				dept_name = data['dept_name'];
				id = data['aiub_id'];

				// G_dept_id = "<?php echo $_SESSION['dept_id']; ?>";



				if(statusString == "" && statusColor == "") {
					statusString = "Online";
					statusColor = "activeimg";
					btns = "";
					nurl = 'fetch_user_status_by_id_for_profile.php';
				}
				else
					nurl = 'fetch_user_status_by_id.php';

		  		var viewProfileSyn = '<div id="view-profile-page-sec"><div><ul id="view-profile-page-sec-ul"><li id="pro-img-follow"><div id="profile-img"><img src="IMAGE/'+img+'"></div><div id="pro-btn-status">'+btns+'<ul id="pro-btn-status-ul"><li><div id="pro-status-activity-text-sec"><span>Status:</span><span id="pro-status-activity">'+statusString+'</span></div></li><li><p id="'+statusColor+'"></p></li></ul></div></li><li id="pro-name-sec"><span>Name</span><span>'+nm+'</span></li><li id="pro-dept-sec"><span>Department</span><span>'+dept_name+'</span></li><li id="pro-id-sec"><span>ID</span><span>'+id+'</span></li><li id="pro-subs-sec"><span>Expertise subjects</span><select id="profile-expertise-subjects"></select></li><li id="pro-res-domain-sec"><span>Interest Research Domains</span><select id="profile-research-domains"></select></li></ul></div></div>';

		  		$.ajax({
		  			url : 'check_followed.php',
		  			method : "POST",
		  			data : { followed_id: uID, follower_id: G_user_id},
		  			dataType: "text",
		  			success: function(data) {
		  				if(data != '')
		  					$('.btn-follow-click-'+uID).text("Unfollow");
		  				else
		  					$('.btn-follow-click-'+uID).text("Follow");
		  			}
		  		});


		  		$(document).on('click','.btn-follow-click-'+uID,function(){

		  			var selector = $(this).attr('class');
		  			if($(this).text() == "Follow") {

		  				$.ajax({
		  					url : 'set_follower_data.php',
		  					method : "POST",
		  					data : { followed_id: uID, follower_id: G_user_id},
		  					success: function(data) {
		  						$('.'+selector).text("Unfollow");
		  					}
		  				});
		  			} else {

		  				$.ajax({
		  					url : 'unset_follower_data.php',
		  					method : "POST",
		  					data : { followed_id: uID, follower_id: G_user_id},
		  					success: function(data) {
		  						$('.'+selector).text("Follow");
		  					}
		  				});
		  			}


		  		});

		  		$(document).on('click','.view-pro-msg-btn-'+uID,function(){
		  			message_box(uID);
		  		});


		  		if(checkResearch_Page_Click == 1)
		  			checkResearch_Page_Click = 0;

				var syn = '<ul class="list1"><li class="list1" id="main-sidebar-home-li">Home</li><li id="dept" class="list1">Department<ul class="list2" id="dept_h_list"><li id="header-department-cse">CSE</li><li id="header-department-bba">BBA</li><li id="header-department-se">SE</li><li id="header-department-eee">EEE</li></ul></li><li class="list1" id="res-sidebar">Research</li><li class="list1" id="faq-sidebar">FAQ</li></ul>';

				$('#sidebar').html(syn);

				home_page_main_sys();
				$('#main-page-sec-search-list').hide();
				$('#main-search-sec').html('');


		  		$('#sidebar_active_member_sec-for-profile').html(viewProfileSyn);


		  		$('#sidebar_active_member_sec-for-chatbox').html("");
		  		$('#sidebar_active_member_sec').css('width','26%');
		  		$('#main_sec').css('width','53%');
		  		$('#sidebar_active_member_sec').css('overflow-y','hidden');
		  		$('#profile-expertise-subjects').chosen();
		  		$('#profile-research-domains').chosen();

		  		fetch_subjects_by_id(uID);
		  		fetch_research_domains_by_id(uID,"","");

		  		fetch_user_status_by_id();

		  		setIn3 = setInterval(fetch_user_status_by_id,setIntervalTime);


		  		function fetch_user_status_by_id() {

		  			$.ajax({
		  				url : nurl,
		  				method : "POST",
		  				data : {user_id: uID},
		  				dataType : "text",
		  				success: function(data) {
		  					$('#main-page-for-status').html(data);
		  				}
		  			});
		  		}


			}

		});



  	}



  	$('#view-profile-click').click(function(){

  		view_profile_by_id(G_user_id,"","");

  	});



// Searched data list click event by user ID


$('#main-page-sec-list').on('click','li',function(){

  	var str = $(this).attr('id');
  	var store = str.split('-');
  	var selectedUserID = parseInt(store[0]);
  	var status = store[1];
  	var statusString = '';

  	if(status.search('active') >= 0)
  		statusString = "Online";
  	else
  		statusString = "Offline";

  	view_profile_by_id(selectedUserID,statusString,status);

});







  	$(document).on('click','.cur_status .edit-status-in-profile',function(){

  		var selectedStatusID = $(this).attr("id");

  		$.ajax({
  			url : "fetch_selected_subjects_place_hour.php",
  			method : "POST",
  			data : { status_id: selectedStatusID},
  			dataType : "json",
  			success: function(data) {

  				var selectedData = data;
  				var ch = '<option>'+data["c_h"]+'</option>';
  				var pl = '<option>'+data["place"]+'</option>';

  				$('#status').show();
  				$('#btnsubmit').text("Update");
  				$('#btnsubmit').attr('class',selectedStatusID);
  				$('#main').css('filter','blur(1px)');

  				$('#chour').chosen();
  				$('#place').chosen();
  				$('#subjects').chosen();

  				var chouroptionvalue = '<option>Choose Counseling Hour</option><option>30 minutes</option><option>1 hour</option><option>2 hour</option><option>3 hour</option><option>4 hour</option><option>5 hour</option><option>6 hour</option>';

  				chouroptionvalue = chouroptionvalue.replace(ch,'<option selected="selected">'+data["c_h"]+'</option>');


  				$('#chour').html(chouroptionvalue);
  				$('#chour').trigger('chosen:updated');

  				var placeoptionvalue = '<option>Choose Place</option><option>D Building</option><option>Annex 1</option><option>Annex 2</option><option>Annex 3</option><option>Annex 4</option><option>Annex 5</option><option>Annex 6</option>';


  				placeoptionvalue = placeoptionvalue.replace(pl,'<option selected="selected">'+data["place"]+'</option>');

  				$('#place').html(placeoptionvalue);
  				$('#place').trigger('chosen:updated');

  				var splitSelectedData = selectedData['subjects'].split(':');
  				var splitSelectedDataRep = selectedData['r_subjects'].split(':');
  				selectedData = splitSelectedData.join("");

  				var i = 0;
  				for(i = 0; i<splitSelectedData.length; i++) {
  					selectedData = selectedData.replace(splitSelectedData[i],splitSelectedDataRep[i]);
  				}

  				$('#subjects').html(selectedData);
  				$('#subjects').trigger('chosen:updated');

  			}
  		});
  	});


  	//  Status Delete button click event

  	$(document).on('click','.cur_status .view_pro_status_delete_btn',function() {
  		var selectedStatusID = $(this).attr("id");
  		$.ajax({
  			url : 'delete_status.php',
  			method : "POST",
  			data : {state_ID: selectedStatusID},
  			dataType : "text",
  			success: function(data) {
  				alert("Status Deleted");
  			}
  		});

  	});




	// Header section Setting button click event


	$(document).on('click','#setting-click',function(){

		var syn = '<div id="setting-view-page"><div id="sidebar2"><ul class="list13"><li id="sidebar-edit-pro-btn">Edit Profile</li><li id="sidebar-change-pass-btn">Change Password</li><li id="sidebar-go-to-main-btn">Go To Main</li></ul></div><div id="setting-main"><div><ul id="edit-profile-sec"></ul></div></div></div>';
		$('#header-setting-view-page').html(syn);
		$('#main,header').css('filter','blur(1px)');
		fetch_edit_pro();
	});



	function fetch_edit_pro() {

		var syn = '';
		$.ajax({
			url : 'fetch_users_info.php',
			method : "POST",
			data : {user_id: G_user_id},
			dataType : "json",
			success: function(data) {
				syn = '<li><span>Name</span><input type="text" id="edit-pro-name" class="input-txt" value="'+data['name']+'"></li><li><span>Email</span><input type="email" id="edit-pro-email" class="input-txt" value="'+data['email']+'"></li><li><span>Phone</span><input type="text" id="edit-pro-phone" class="input-txt" value="'+data['phone']+'"></li><li><span>Date of Birth</span><input type="text" id="edit-pro-dob" class="input-txt" value="'+data['dob']+'"></li><li><span>Aiub ID</span><input type="text" id="edit-pro-id" class="input-txt" value="'+data['aiub_id']+'"></li><li><span>Profile Picture</span><input type="file" id="edit-pro-file" class="input-txt"></li><li id="edit-pro-btn-sec"><button id="edit-pro-btn" class="edit-pro-submit-btn">Submit</button></li>';
				$('#edit-profile-sec').html(syn);
				$('#edit-pro-dob').datepicker();
			}
		});
		
	}

	$(document).on('click','#sidebar-edit-pro-btn',function(){
		fetch_edit_pro();
	});
	$(document).on('click','#sidebar-change-pass-btn',function(){
		var syn = '<li><span>Current Password</span><input type="password" id="change-pass-cur_pass" class="input-txt"></li><li><span>New Password</span><input type="password" id="change-pass-new_pass" class="input-txt"></li><li><span>Re-enter Password</span><input type="password" id="change-pass-re_pass" class="input-txt"></li><li id="edit-pro-btn-sec"><button id="edit-pro-btn" class="change-pass-submit-btn">Submit</button></li>';

		$('#edit-profile-sec').html(syn);
	});

	$(document).on('click','#sidebar-go-to-main-btn',function(){
		$('#header-setting-view-page').html('');
		$('#main,header').css('filter','blur(0px)');
	});



	// Edit Profile Update Event JS

	$(document).on('click','.edit-pro-submit-btn',function(){

		var form_data = new FormData();
		var file_name = '';
			
		if($('#edit-pro-file')[0].files.length > 0) {
			file_name = $('#edit-pro-file')[0].files[0];
			form_data.append('file',file_name);
			form_data.append('file_check',"image");
		}
		else {
			form_data.append('file_check',"");
		}
		form_data.append('name',$('#edit-pro-name').val());
		form_data.append('email',$('#edit-pro-email').val());
		form_data.append('phone',$('#edit-pro-phone').val());
		form_data.append('dob',$('#edit-pro-dob').val());
		form_data.append('aiub_id',$('#edit-pro-id').val());
		form_data.append('user_id',G_user_id);

		console.log(file_name);
		$.ajax({
			url : "update_user_info_data.php",
			method : "POST",
			data : form_data,
			contentType: false,
			processData: false,
			dataType: "text",
			async: false,
			success: function(data) {
			}
		});
		profile_image_update();
		$('#header-setting-view-page').html('');
		$('#main,header').css('filter','blur(0px)');

	});


	$(document).on('click','.change-pass-submit-btn',function(){

		var c_pass = $('#change-pass-cur_pass').val();
		var n_pass = $('#change-pass-new_pass').val();
		var r_pass = $('#change-pass-re_pass').val();

		if(c_pass != '') {
			if(n_pass != '') {
				if(r_pass != '') {

					$.ajax({
						url : 'fetch_users_info.php',
						method : "POST",
						data : {user_id: G_user_id},
						dataType : "json",
						success: function(data) {
							if(data['password'] == c_pass)
							{
								if(n_pass == r_pass) {

									$.ajax({
										url : "update_change_password.php",
										method : "POST",
										data : { r_pass: r_pass, user_id: G_user_id},
										dataType: "text",
										success: function(data) {
											window.location.replace($main_url);
										}
									});

								}
								else
									alert("New password & Re-enter password Not Matched");
							}
							else
								alert("Wrong Current Password");
						}
					});

				}
				else 
					alert("Please Input Re-enter password");
			}
			else
				alert("Please Input New password");
		}
		else
			alert("Please Input Current password");


	});




	

	// Sidebar FAQ button click event and FAQ Page Events

	$(document).on('click','#faq-sidebar',function(){
		$('#main_sec').html("");
		$('#main_sec').css('width','79%');
		$('#sidebar_active_member_sec').html('');
		$('#sidebar_active_member_sec').css('display','none');

		var syn = '<div id="faq-question-ans"><div id="add-question-on-faq"></div><div id="faq-question-section"></div></div>';

		$('#main_sec').html(syn);
		set_question_box();
		fetch_faq_question_and_answer();
	});



	
	function fetch_faq_question_and_answer() {
		$.ajax({
			url : "fetch_faq_question_and_answer.php",
			method : "POST",
			dataType : "text",
			success: function(data) {
				$('#faq-question-section').html(data);
			}
		});
	}

	function set_question_box() {
		var syn = '<textarea id="faq-question-textarea"></textarea><button id="faq-add-question-btn">Add Question</button>';
		$('#add-question-on-faq').html(syn);
	}

	$(document).on('click','#faq-showmore-btn',function() {
		var q_id = $(this).attr('class');
		$('#question-hide-sec-'+q_id).toggle();
	});

	$(document).on('click','#faq-reply-btn',function() {
		var q_id = $(this).attr('class');
		var syn = '<div id="faq-reply-box"><h4>Question : '+$(this).attr('name')+'</h4><div id="add-question-on-faq" class="add-question-on-faq-2"><textarea id="textarea-'+q_id+'" class="faq-question-textarea-2"></textarea><button id="'+q_id+'" class="reply-btn-for-faq">Reply</button></div></div>';
		$('#add-question-on-faq').html(syn);
		fetch_faq_question_and_answer();
	});

	$(document).on('click','.reply-btn-for-faq',function() {
		var q_id = $(this).attr('id');
		var textareaData = $('#textarea-'+q_id).val();
		if(textareaData != '') {
			$.ajax({
				url : "insert_faq_question_answer.php",
				method : "POST",
				data : { q_id: q_id, ans : textareaData},
				dataType : "text",
				success: function(data) {
					fetch_faq_question_and_answer();
					set_question_box();
				}
			});
		}
	});


	$(document).on('click','#faq-add-question-btn',function() {

		var text = $('#faq-question-textarea').val();
		if(text != '') {
			$.ajax({
				url : "insert_faq_question.php",
				method : "POST",
				data : { que_text: text},
				dataType : "text",
				success: function(data) {
					$('#faq-question-textarea').val("");
					fetch_faq_question_and_answer();
				}
		  	});
		}
	});


});