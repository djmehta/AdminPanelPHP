function get_chat_data(a, srch) {
	if(srch == '')
	{
		$('#srch_chat').val('');
	}
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#chat_data").html(b);
	SendData = "page=" + a + "&srch=" + srch;
	$.ajax({
		url: site_url + "admin/chat_list",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#chat_data").html("");
			apply_chat_data(d, srch);
			get_confl_chat_data(a, srch);
		}
	})
}

function apply_chat_data(n, srch) {
	var o = '';
	if (n.totalPages == 0) {
		o += '<div class="col-md-12">';
		o += 'No result found';
		o += '</div>';
	} else {
		$.each(n, function () {
			$.each(this, function (b, d) {
				if (d.id!= null) {
					var name = d.firstname+' '+d.lastname;
					o += '<div class="space5"></div>';
					o += '<div class="col-md-12" style="border:1px solid #000;">';
					o += '<div class="col-md-1" style="padding-left:0px;padding-right:0px">';
					o += '<img src="'+base_url+'assets/img/chat-icon.png" class="img-responsive" style="padding-top: 15%;">';
					o += '</div>';
					o += '<div class="col-md-11">';
					o += '<p>';
					o += name;
					o += '</p>';
					o += '<p>';
					o += d.description;
					o += '</p>';
					o += '</div>';
					o += '</div>';
				}
			})
		});
	}
	//o += pagination_datachat(n, srch);
	$("#chat_data").html(o);
};

function get_confl_chat_data(a, srch) {
	var b = "";
	b += '<div class="col-md-12 ilist-listing">';
	b += '<div class="row">';
	b += '<img src="' + base_url + 'assets/img/ajaxLoading.gif" alt="" class="img-responsive">';
	b += "</div>";
	b += "</div>";
	b += '<div class="clearfix"></div>';
	$("#confl_chat_data").html(b);
	SendData = "page=" + a + "&srch=" + srch;
	$.ajax({
		url: site_url + "admin/conflict_chat_list",
		type: "POST",
		data: SendData,
		dataType: "json",
		success: function (d) {
			$("#confl_chat_data").html("");
			apply_confl_chat_data(d, srch)
		}
	})
}

function apply_confl_chat_data(n, srch) {
	var v = '';
	if (n.conflchattotalPages == 0) {
		v += '<div class="col-md-12">';
		v += 'No result found';
		v += '</div>';
	} else {
		$.each(n, function () {
			$.each(this, function (j, s) {
				if (s.id!= null) {
					var name = s.firstname+' '+s.lastname;
					v += '<div class="space5"></div>';
					v += '<div class="col-md-12" style="border:1px solid #000;">';
					v += '<div class="col-md-1" style="padding-left:0px;padding-right:0px">';
					v += '<img src="'+base_url+'assets/img/chat-icon.png" class="img-responsive" style="padding-top: 15%;">';
					v += '</div>';
					v += '<div class="col-md-11">';
					v += '<p>';
					v += name;
					v += '</p>';
					v += '<p>';
					v += s.description;
					v += '</p>';
					v += '</div>';
					v += '</div>';
				}
			})
		});
	}
	//o += pagination_datachat(n, srch);
	$("#confl_chat_data").html(v);
};

function delete_rowchat(Val, srch)
{
	if(confirm("You sure to delete this details"))
	{
		SendData = "Val="+Val;
		$.ajax({
			url: site_url + "admin/DeleteChatDetails",
			type: "POST",
			data: SendData,
			dataType: "json",
			success: function (d) {
				get_chat_data(1, srch);
			}
		});
	}
}

function pagination_datachat(i, srch) {
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
			n += '<li><a class="pageButton" id="page-' + (m - 1) + '" href="javascript:void(0);" onclick="nxt_pagchat(' + (m - 1) + ", '" + srch + "');\"><<</a></li>"
		}
		for (var k = m; k <= l; k++) {
			n += '<li' + (i.currentPage == k ? ' class="active"' : "") + '><a class="pageButton" id="page-' + k + '" href="javascript:void(0);" onclick="nxt_pagchat(' + k + ", '" + srch + "');\">" + k + "</a></li>"
		}
		if (l < (1 * i.totalPages)) {
			n += '<li><a class="pageButton" id="page-' + (l + 1) + '" href="javascript:void(0);" onclick="nxt_pagchat(' + (l + 1) + ", '" + srch + "');\">>></a></li>"
		}
		n += "</ul></div>"
	}
	return n
}

function nxt_pagchat(h, srch) {
	get_chat_data(h, srch)
}
