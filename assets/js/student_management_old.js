function get_student_management_data(a, srch) {
	$("#list_table_header").show();
	$("#list_table").show();
	$("#details_table").hide();
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#list_table").html(b);
	SendData = "page=" + a + "&srch=" + srch;
	$.ajax({
		url: site_url + "admin/StudManageList",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#list_table").html("");
			apply_student_management_data(d, srch)
		}
	})
}

function get_student_management_all_data(a, srch) {
	$("#list_table_header").show();
	$("#list_table").show();
	$("#details_table").hide();
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#list_table").html(b);
	SendData = "page=" + a + "&srch=" + srch;
	$.ajax({
		url: site_url + "admin/StudManageList",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#list_table").html("");
			apply_student_management_header_data();
			apply_student_management_data(d, srch)
		}
	})
}

function open_details_table(val)
{
	$("#details_table").show();
	$("#list_table").hide();
	$("#list_table_header").hide();

	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#details_table").html(b);
	SendData = "Val="+val;
	$.ajax({
		url: site_url + "admin/StudManageDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#details_table").html("");
			$("#pd_but").css("background-color", "#95bcf2");
			$("#ar_but").css("background-color", "#FFFFFF");
			$("#am_but").css("background-color", "#FFFFFF");
			$("#stud_personal_det").show();
			$("#stud_academic_det").hide();
			$("#stud_app_right").hide();
			open_details_head_data(d);
		}
	})
}

function open_stud_personal_det(val)
{
	$("#pd_but").css("background-color", "#95bcf2");
	$("#ar_but").css("background-color", "#FFFFFF");
	$("#am_but").css("background-color", "#FFFFFF");
	$("#stud_personal_det").show();
	$("#stud_academic_det").hide();
	$("#stud_app_right").hide();
}

function open_stud_acad_det(val)
{
	$("#am_but").css("background-color", "#95bcf2");
	$("#pd_but").css("background-color", "#FFFFFF");
	$("#ar_but").css("background-color", "#FFFFFF");
	$("#stud_academic_det").show();
	$("#stud_personal_det").hide();
	$("#stud_app_right").hide();
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#stud_academic_det").html(b);
	SendData = "Val="+val;
	$.ajax({
		url: site_url + "admin/StudManageAcademicDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#stud_academic_det").html("");
			apply_student_academic_details_data(d);
		}
	})
}

function open_stud_appright_det(val)
{
	$("#ar_but").css("background-color", "#95bcf2");
	$("#pd_but").css("background-color", "#FFFFFF");
	$("#am_but").css("background-color", "#FFFFFF");
	$("#stud_app_right").show();
	$("#stud_personal_det").hide();
	$("#stud_academic_det").hide();
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#stud_app_right").html(b);
	SendData = "Val="+val;
	$.ajax({
		url: site_url + "admin/StudManageApprightDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#stud_app_right").html("");
			apply_student_app_right_details_data(d);
		}
	})
}

function open_details_head_data(n) {
	var o = '';
	o += '<div class="row">';
	o += '<div class="col-md-7">';
	if (n.totalPages > 0) {
		o += '<div class="btn-group btn-group-justified">';
		o += '<a id="pd_but" onclick="open_stud_personal_det(1);" href="javascript:void(0);" class="btn btn-default" style="background-color:#95bcf2;">Personal Details</a>';
		o += '<a id="am_but" onclick="open_stud_acad_det(\''+n.Val+'\');" href="javascript:void(0);" class="btn btn-default">Academic Management</a>';
		o += '<a id="ar_but" onclick="open_stud_appright_det(\''+n.Val+'\');" href="javascript:void(0);" class="btn btn-default">App Rights</a>';
		o += '</div>';
	}
	o += '</div>';
	o += '<div class="col-md-1 pull-right">';
	o += '<button class="btn default" onclick="get_student_management_data(1, \'\');">Back</button>';
	o += '</div>';
	o += '</div>';
	o += '<div class="space40"></div>';
	o += '<div id="stud_personal_det">';
	o += '</div>';
	o += '<div id="stud_academic_det" style="display:none;">';
	o += '</div>';
	o += '<div id="stud_app_right" style="display:none;">';
	o += '</div>';
	$("#details_table").html(o);
	apply_student_management_details_data(n);
};

function apply_student_management_details_data(n) {
	var o = '';
	o += '<div class="table-responsive">';
	o += '<div class="table-scrollable">';
	o += '<table class="table table-striped table-hover table-bordered">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>';
	o += 'First Name';
	o += '</th>';
	o += '<th>';
	o += 'Last Name';
	o += '</th>';
	o += '<th>';
	o += 'University Email';
	o += '</th>';
	o += '<th>';
	o += 'Password';
	o += '</th>';
	o += '<th>';
	o += 'Display Name';
	o += '</th>';
	o += '<th>';
	o += 'Join Date';
	o += '</th>';
	o += '<th>';
	o += 'Program';
	o += '</th>';
	o += '<th>';
	o += 'Program Start';
	o += '</th>';
	o += '<th>';
	o += 'Program End';
	o += '</th>';
	o += '<th>';
	o += 'Edit';
	o += '</th>';
	o += '<th>';
	o += 'Delete';
	o += '</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	if (n.totalPages == 0) {
		o += '<tr>';
		o += '<td>';
		o += 'No result found';
		o += '</td>';
		o += '</tr>';
	} else {
		$.each(n, function () {
			$.each(this, function (b, d) {
				if (d.id_user != null) {
					o += '<tr id="tr_'+d.id_user+'">';
					o += '<td>';
					o += d.firstname;
					o += '</td>';
					o += '<td>';
					o += d.lastname;
					o += '</td>';
					o += '<td>';
					o += d.login_email;
					o += '</td>';
					o += '<td>';
					o += '******';
					o += '</td>';
					o += '<td>';
					o += d.displayname;
					o += '</td>';
					o += '<td>';
					o += d.join_date;
					o += '</td>';
					o += '<td>';
					o += d.program;
					o += '</td>';
					o += '<td>';
					o += d.prm_start_year;
					o += '</td>';
					o += '<td>';
					o += d.prm_end_year;
					o += '</td>';
					o += '<td>';
					o += '<a class="edit" href="javascript:;" onclick="edit_row_stud('+d.id_user+')"> Edit </a>';
					o += '</td>';
					o += '<td>';
					o += '<a class="delete" href="javascript:;" onclick="delete_row_stud('+d.id_user+')"> Delete </a>';
					o += '</td>';
					o += '</tr>';
				}
			})
		});
	}
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	o += '</div>';
	o += '</div>';
	$("#stud_personal_det").html(o);
};

function edit_row_stud(Val)
{
	SendData = "Val="+Val;
	$.ajax({
		url: site_url + "admin/EditStudDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			edit_row_data_stud(d);
		}
	})
}

function delete_row_stud(Val)
{
	if(confirm("You sure to delete this details"))
	{
		SendData = "Val="+Val;
		$.ajax({
			url: site_url + "admin/DeleteStudDetails",
			type: "POST",
			data: SendData,
			dataType: "json",
			success: function (d) {
				open_details_head_data(d);
			}
		});
	}
}

function saveapprights(Val)
{
	if (!jQuery("#user_access_div input[type='checkbox']").is(":checked"))
	{
		$("#modelAlertAccess").html("Please check atleast one checkbox.");
		return false
	}
	else
	{
		$("#modelAlertAccess").html("");
		var d = $("#user_access_div input:checkbox:checked").map(function () {
			return $(this).val()
		}).get();
		SendData = "Val="+Val+"&ModRights="+d;
		$.ajax({
			url: site_url + "admin/SaveAppRights",
			type: "POST",
			data: SendData,
			dataType: "json",
			success: function (d) {
				//
			}
		});
	}
}

function edit_row_data_stud(n)
{
	var o ='';
	$.each(n, function () {
		$.each(this, function (b, d) {
			if (d.id_user != null) {
				o += '<td>';
				o += '<input type="text" name="val1" id="val1" class="form-control input-small" value="' + d.firstname + '">';
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val2" id="val2" class="form-control input-small" value="' + d.lastname + '">';
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val3" id="val3" class="form-control input-small" value="' + d.login_email + '">';
				o += '</td>';
				o += '<td>';
				o += '<input type="password" name="val4" id="val4" class="form-control input-small" value="">';
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val5" id="val5" class="form-control input-small" value="' + d.displayname + '">';
				o += '</td>';
				o += '<td>';
				o += d.join_date;
				/*o += '<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="datetimepicker5">';
				o += '<input type="text" class="form-control input-small" name="val6" id="val6" readonly value="' + d.join_date + '">';
				o += '<span class="input-group-btn">';
				o += '<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>';
				o += '</span>';
				o += '</div>';*/
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val7" id="val7" class="form-control input-small" value="' + d.program + '">';
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val8" id="val8" class="form-control input-small" value="' + d.prm_start_year + '">';
				o += '</td>';
				o += '<td>';
				o += '<input type="text" name="val9" id="val9" class="form-control input-small" value="' + d.prm_end_year + '">';
				o += '</td>';
				o += '<td>';
				o += '<a class="Save" href="javascript:;" onclick="save_row_stud('+d.id_user+')"> Save </a>';
				o += '</td>';
				o += '<td>';
				o += '<a class="Cancel" href="javascript:;" onclick="cancel_row_stud('+d.id_user+')"> Cancel </a>';
				o += '</td>';
			}
		});
	});
	/*$('#datetimepicker5').datetimepicker({
					pickTime: false
				});*/
	$("#tr_"+n.Val).html(o);
}

function save_row_stud(Val)
{
	var val1 = $("#val1").val();
	var val2 = $("#val2").val();
	var val3 = $("#val3").val();
	var val4 = $("#val4").val();
	var val5 = $("#val5").val();
	var val6 = $("#val6").val();
	//var val6 = '';
	var val7 = $("#val7").val();
	var val8 = $("#val8").val();
	var val9 = $("#val9").val();

	SendData = "Val="+Val+"&val1="+val1+"&val2="+val2+"&val3="+val3+"&val4="+val4+"&val5="+val5+"&val6="+val6+"&val7="+val7+"&val8="+val8+"&val9="+val9;
	$.ajax({
		url: site_url + "admin/SaveStudDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			display_row_data_stud(d);
		}
	})
}

function cancel_row_stud(Val)
{
	SendData = "Val="+Val;
	$.ajax({
		url: site_url + "admin/StudManageDetails",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			display_row_data_stud(d);
		}
	})
}

function display_row_data_stud(n)
{
	var o ='';
	$.each(n, function () {
		$.each(this, function (b, d) {
			if (d.id_user != null) {
				o += '<td>';
				o += d.firstname;
				o += '</td>';
				o += '<td>';
				o += d.lastname;
				o += '</td>';
				o += '<td>';
				o += d.login_email;
				o += '</td>';
				o += '<td>';
				o += '******';
				o += '</td>';
				o += '<td>';
				o += d.displayname;
				o += '</td>';
				o += '<td>';
				o += d.join_date;
				o += '</td>';
				o += '<td>';
				o += d.program;
				o += '</td>';
				o += '<td>';
				o += d.prm_start_year;
				o += '</td>';
				o += '<td>';
				o += d.prm_end_year;
				o += '</td>';
				o += '<td>';
				o += '<a class="edit" href="javascript:;" onclick="edit_row_stud('+d.id_user+')"> Edit </a>';
				o += '</td>';
				o += '<td>';
				o += '<a class="delete" href="javascript:;" onclick="delete_row_stud('+d.id_user+')"> Delete </a>';
				o += '</td>';
			}
		});
	});
	$("#tr_"+n.Val).html(o);
}

function apply_student_academic_details_data(n) {
	var o = '';
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>';
	o += 'First Name';
	o += '</th>';
	o += '<th>';
	o += 'Last Name';
	o += '</th>';
	o += '<th>';
	o += 'University Email';
	o += '</th>';
	o += '<th>';
	o += 'Password';
	o += '</th>';
	o += '<th>';
	o += 'Display Name';
	o += '</th>';
	o += '<th>';
	o += 'Join Date';
	o += '</th>';
	o += '<th>';
	o += 'Program';
	o += '</th>';
	o += '<th>';
	o += 'Program Start';
	o += '</th>';
	o += '<th>';
	o += 'Program End';
	o += '</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	if (n.totalPages == 0) {
		o += '<tr>';
		o += '<td>';
		o += 'No result found';
		o += '</td>';
		o += '</tr>';
	} else {
		$.each(n, function () {
			$.each(this, function (b, d) {
				if (d.id_user != null) {
					o += '<tr>';
					o += '<td>';
					o += d.firstname;
					o += '</td>';
					o += '<td>';
					o += d.lastname;
					o += '</td>';
					o += '<td>';
					o += d.login_email;
					o += '</td>';
					o += '<td>';
					o += '******';
					o += '</td>';
					o += '<td>';
					o += d.displayname;
					o += '</td>';
					o += '<td>';
					o += d.join_date;
					o += '</td>';
					o += '<td>';
					o += d.program;
					o += '</td>';
					o += '<td>';
					o += d.prm_start_year;
					o += '</td>';
					o += '<td>';
					o += d.prm_end_year;
					o += '</td>';
					o += '</tr>';
				}
			})
		});
	}
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	o += '<div class="space20"></div>';
	o += '<div class="row col-md-12">Current Academic Enrollment</div>';
	o += '<div class="clearfix"></div>';
	o += '<div class="space20"></div>';
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered" id="sample_editable_5">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>Semester</th>';
	o += '<th>Department</th>';
	o += '<th>Class Code</th>';
	o += '<th>Class Name</th>';
	o += '<th>Batch Number</th>';
	o += '<th>Professor</th>';
	o += '<th>Capacity</th>';
	o += '<th>Delete</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	o += '<tr>';
	o += '<td colspan="8">No, result found</td>';
	o += '</tr>';
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	o += '<div class="col-md-12">';
	//o += '<img id="sample_editable_5_new" src="'+base_url+'assets/img/add_class.png" alt="" class="img-responsive" style="cursor:pointer;">';
	o += '</div>';
	o += '<div class="clearfix"></div>';
	o += '<div class="space20"></div>';
	o += '<div class="row col-md-12">Previous Academic Enrollment</div>';
	o += '<div class="clearfix"></div>';
	o += '<div class="space20"></div>';
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>Semester</th>';
	o += '<th>Department</th>';
	o += '<th>Class Code</th>';
	o += '<th>Class Name</th>';
	o += '<th>Batch Number</th>';
	o += '<th>Professor</th>';
	o += '<th>Capacity</th>';
	o += '<th>Delete</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	o += '<tr>';
	o += '<td colspan="8">No, result found</td>';
	o += '</tr>';
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	$("#stud_academic_det").html(o);
};

function apply_student_app_right_details_data(n) {
	var o = '';
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>';
	o += 'First Name';
	o += '</th>';
	o += '<th>';
	o += 'Last Name';
	o += '</th>';
	o += '<th>';
	o += 'University Email';
	o += '</th>';
	o += '<th>';
	o += 'Password';
	o += '</th>';
	o += '<th>';
	o += 'Display Name';
	o += '</th>';
	o += '<th>';
	o += 'Join Date';
	o += '</th>';
	o += '<th>';
	o += 'Program';
	o += '</th>';
	o += '<th>';
	o += 'Program Start';
	o += '</th>';
	o += '<th>';
	o += 'Program End';
	o += '</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	if (n.totalPages == 0) {
		o += '<tr>';
		o += '<td>';
		o += 'No result found';
		o += '</td>';
		o += '</tr>';
	} else {
		$.each(n, function () {
			$.each(this, function (b, d) {
				if (d.id_user != null) {
					o += '<tr>';
					o += '<td>';
					o += d.firstname;
					o += '</td>';
					o += '<td>';
					o += d.lastname;
					o += '</td>';
					o += '<td>';
					o += d.login_email;
					o += '</td>';
					o += '<td>';
					o += '******';
					o += '</td>';
					o += '<td>';
					o += d.displayname;
					o += '</td>';
					o += '<td>';
					o += d.join_date;
					o += '</td>';
					o += '<td>';
					o += d.program;
					o += '</td>';
					o += '<td>';
					o += d.prm_start_year;
					o += '</td>';
					o += '<td>';
					o += d.prm_end_year;
					o += '</td>';
					o += '</tr>';
				}
			})
		});
	}
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	o += '<div class="space20"></div>';
	o += '<div class="row col-md-12"> Application Rights </div>';
	o += '<div class="clearfix"></div>';
	o += '<div class="space20"></div>';
	o += '<div class="row col-md-4">';
	var u;
	var es;
	var m;
	var t;
	var f;
	var p;
	var n;
	var d;
	$.each(n.Module_Arr, function () {
		if(this.module == 'CourseTrack')
		{
			var s = this.module_action.split(",");
			for (var y = 0; y < s.length; y++) {
				if (s[y] == "View") {
					u = "checked"
				}
				if (s[y] == "Edit") {
					es = "checked"
				}
			}
		}
		if(this.module == 'Messages')
		{
			var s = this.module_action.split(",");
			for (var y = 0; y < s.length; y++) {
				if (s[y] == "View") {
					m = "checked"
				}
				if (s[y] == "Edit") {
					t = "checked"
				}
			}
		}
		if(this.module == 'Feed')
		{
			var s = this.module_action.split(",");
			for (var y = 0; y < s.length; y++) {
				if (s[y] == "View") {
					f = "checked"
				}
				if (s[y] == "Edit") {
					p = "checked"
				}
			}
		}
		if(this.module == 'News')
		{
			var s = this.module_action.split(",");
			for (var y = 0; y < s.length; y++) {
				if (s[y] == "View") {
					n = "checked"
				}
				if (s[y] == "Edit") {
					d = "checked"
				}
			}
		}
	});
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>Module</th>';
	o += '<th>View</th>';
	o += '<th>Use/Edit</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody id="user_access_div">';
	o += '<tr>';
	o += '<td>CourseTrack</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRights" id="ModRights" value="CourseTrack_View" '+u+'>';
	o += '</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRightsEdit" id="ModRightsEdit" value="CourseTrack_Edit" '+es+'>';
	o += '</td>';
	o += '</tr>';
	o += '<tr>';
	o += '<td>Messages</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRights" id="ModRights" value="Messages_View" '+m+'>';
	o += '</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRightsEdit" id="ModRightsEdit" value="Messages_Edit" '+t+'>';
	o += '</td>';
	o += '</tr>';
	o += '<tr>';
	o += '<td>Feed</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRights" id="ModRights" value="Feed_View" '+f+'>';
	o += '</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRightsEdit" id="ModRightsEdit" value="Feed_Edit" '+p+'>';
	o += '</td>';
	o += '</tr>';
	o += '<tr>';
	o += '<td>News</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRights" id="ModRights" value="News_View" '+n+'>';
	o += '</td>';
	o += '<td>';
	o += '<input type="checkbox" name="ModRightsEdit" id="ModRightsEdit" value="News_Edit" '+d+'>';
	o += '</td>';
	o += '</tr>';
	o += '<tr>';
	o += '<td colspan="3"><button class="btn blue" onclick="saveapprights('+n.Val+');">Save Changes</button></td>';
	o += '</tr>';
	o += '</tbody>';
	o += '</table>';
	o += '</div>';
	$("#stud_app_right").html(o);
};

function apply_student_management_header_data() {
	var o = '';
	o += '<div class="row">';
	o += '<div class="col-md-6 col-sm-12">';
	o += '<div id="sample_editable_1_length" class="dataTables_length"></div>';
	o += '</div>';
	o += '<div class="col-md-6 col-sm-12">';
	o += '<div class="dataTables_filter" id="sample_editable_1_filter">';
	o += '<label>Search: <input type="text" aria-controls="sample_editable_1" class="form-control input-medium input-inline" onkeyup="get_student_management_data(1, this.value);"></label>';
	o += '</div>';
	o += '</div>';
	o += '</div>';
	$("#list_table_header").html(o);
};

function apply_student_management_data(n, srch) {
	var o = '';
	o += '<div class="table-responsive">';
	o += '<table class="table table-striped table-hover table-bordered" id="sample_1">';
	o += '<thead>';
	o += '<tr>';
	o += '<th>';
	o += 'First Name';
	o += '</th>';
	o += '<th>';
	o += 'Last Name';
	o += '</th>';
	o += '<th>';
	o += 'University Email';
	o += '</th>';
	o += '<th>';
	o += 'Password';
	o += '</th>';
	o += '<th>';
	o += 'Display Name';
	o += '</th>';
	o += '<th>';
	o += 'Join Date';
	o += '</th>';
	o += '<th>';
	o += 'Program';
	o += '</th>';
	o += '<th>';
	o += 'Program Start';
	o += '</th>';
	o += '<th>';
	o += 'Program End';
	o += '</th>';
	o += '</tr>';
	o += '</thead>';
	o += '<tbody>';
	if (n.totalPages == 0) {
		o += '<tr>';
		o += '<td colspan="9">';
		o += 'No result found';
		o += '</td>';
		o += '</tr>';
	} else {
		$.each(n, function () {
			$.each(this, function (b, d) {
				if (d.id_user != null) {
					o += '<tr onclick="open_details_table('+d.id_user+');" style="cursor:pointer;">';
					o += '<td>';
					o += d.firstname;
					o += '</td>';
					o += '<td>';
					o += d.lastname;
					o += '</td>';
					o += '<td>';
					o += d.login_email;
					o += '</td>';
					o += '<td>';
					o += '******';
					o += '</td>';
					o += '<td>';
					o += d.displayname;
					o += '</td>';
					o += '<td>';
					o += d.join_date;
					o += '</td>';
					o += '<td>';
					o += d.program;
					o += '</td>';
					o += '<td>';
					o += d.prm_start_year;
					o += '</td>';
					o += '<td>';
					o += d.prm_end_year;
					o += '</td>';
					o += '</tr>';
				}
			})
		});
	}
	o += '</tbody>';
	o += '</table>';
	o += pagination_datacoll_stud(n, srch);
	o += '</div>';
	$("#list_table").html(o);
};


function pagination_datacoll_stud(i, srch) {
	var n = "";
	if (i.totalPages > 1) {
		n += '<div class="pagination"><ul>';
		var m = 1;
		var l = (1 * i.totalPages);
		if (l > 10) {
			m = (1 * i.currentPage) - 5;
			m = m > 1 ? m : 1;
			l = l > (m + 9) ? (m + 9) : l
		}
		if (m > 1) {
			n += '<li><a class="pageButton" id="page-' + (m - 1) + '" href="javascript:void(0);" onclick="nxt_pagcoll_stud(' + (m - 1) + ", '" + srch + "');\"><<</a></li>"
		}
		for (var k = m; k <= l; k++) {
			n += '<li' + (i.currentPage == k ? ' class="active"' : "") + '><a class="pageButton" id="page-' + k + '" href="javascript:void(0);" onclick="nxt_pagcoll_stud(' + k + ", '" + srch + "');\">" + k + "</a></li>"
		}
		if (l < (1 * i.totalPages)) {
			n += '<li><a class="pageButton" id="page-' + (l + 1) + '" href="javascript:void(0);" onclick="nxt_pagcoll_stud(' + (l + 1) + ", '" + srch + "');\">>></a></li>"
		}
		n += "</ul></div>"
	}
	return n
}

function nxt_pagcoll_stud(h, srch) {
	get_student_management_data(h, srch)
}
