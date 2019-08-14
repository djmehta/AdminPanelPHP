<script src="<?php echo base_url('assets/js/common.js') ?>" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
<style>
.ui-autocomplete {
z-index: 100;
}

	.container{
		background:white;
		width:600px;
		padding:0px;
		margin:40px auto;
		align:left;

	}

	ul{
		padding:0px;
		margin:0px;
	}
	li{
		list-style-type: none;
		padding:10px;
		background:#DCDCDC;
		margin:5px;
		color:black;
		font-weight:bold;
		cursor:pointer;
	}


</style>
<script>
$(function() {

		$("#sortable").sortable({
			connectWith:"ul",
			items : "li"
		});

		

		$('[data-toggle="tooltip"]').tooltip(); 


		// jquery save event trigger
		$('.save').click(function(){
			var plist = $('#sortable').sortable('toArray', { attribute : "qplist" });
			$("#au_msg").show();
			$("#au_msg").html("<img src='assets/img/input-spinner.gif'>");
			//alert(plist);
			$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "themes/update_playlist_order",
			  data: 'plist='+plist,
			  success: function(d) {
					$("#au_msg").html("List Updated !!");
			  }
			});
		});
		
		
		$('#saveList').click(function(){
			var playlist = $("#plistdata").val();
			var pdata = playlist.split("|^^|");
			var pid = pdata[0];
			//alert(pid);
			var slist = $('#sortableList').sortable('toArray', { attribute : "qsong" });
			//alert(slist);
			
			$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "themes/update_songs_order",
			  data: 'slist='+slist+"&pid="+pid,
			  success: function(d) {
					$("#perr").show();
					$("#perr").html("New Playlist Order Saved!!");
					$( "#plist").html(d);
					
					$("#sortableList").sortable({
						connectWith:"ul",
						items : "li"
					});
			  }
			});
		});

		$( "#search_songs" ).autocomplete({
			delay: 200,
			minLength: 3,
			source: function( request, response ) {
			  	$.ajax({
				  type: "POST",
				  dataType: "json",
				  url: "admin/search_top_audios", 
				  data: 'q='+$("#search_songs").val(),
				  success: function(data) {
					 // alert(data);
					 var totRes = data.length;
					 //alert(totRes);
					 $( "#search_res" ).html("");
					 $( "#search_res" ).show();
					 $( "#search_res" ).html("<p class='small' style='color:red'>Double click to select a song</p>");
					 for(i=0;i<totRes;i++)
					  {
						 $( "#search_res" ).append( "<p class='psearch' ondblclick='selSearchRes("+data[i]['metasea_id']+")'>"+data[i]['title']+"</p>" );
					  }
										 
				  }
				});
			},
			select: function (event, ui) {
				//alert(ui.item.value);
				//$("#search_res").html("<p>"+ui.item.value+"</p>");
			},
		});

		

		

	});

function edit_playlist(pid)
{
	$("#pid").val(pid);
	var playlist = $('#play_info_'+pid).val(); 
	var pdata = playlist.split("|^^|");
	//alert(pdata[0]);
	$.ajax({
	  type: "POST",
	  dataType: "text",
	  url: "themes/get_playlist",
	  data: 'pid='+pid,
	  success: function(data) {
		
			$("#add_aud").hide();
			$("#edt_play").show();
			$("#perr").hide();
			$("#plist").html(data);
			$("#pname").html("<div class='col-sm-2' style='align:center;padding-top:5px;padding-left:25px;'><img src='assets/img/icon-playlist.gif'></div><div class='col-sm-10' style='padding-top:5px;'><p><strong>"+pdata[0]+"</strong></p><span class='small' >"+pdata[1]+"</span></div>");
			$("#plistdata").val(pid+'|^^|'+playlist);

			$("#sortableList").sortable({
				connectWith:"ul",
				items : "li"
			});
			
	  }
	});
	
}

function remove_song(pid, cid)
{
	$("#perr").hide();
	$("#perr").html("");
	var c = confirm("Remove this song?");
	if(c == true)
	{
		$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "themes/update_playlist",
			  data: 'pid='+pid+'&cid='+cid,
			  success: function(d) {
					//$('#lis_'+cid).remove();
					$("#perr").html("Song Added to Playlist !!");
				    $( "#plist").html(d);
					
					$("#sortableList").sortable({
						connectWith:"ul",
						items : "li"
					});
			  }
			});
	}

}

function cng_title()
{
	//alert(pid);
	$("#perr").hide();
	$("#perr").html("");
	var playlist = $('#plistdata').val(); 
	var pdata = playlist.split("|^^|");
	$("#pname").hide();
	$("#pedit").show();
	$("#pid").val(pdata[0]);
	$("#ptitle").val(pdata[1]);
	$("#pdesc").val(pdata[2]);
	

}

function update_playlist_title()
{
	var title = $("#ptitle").val();
	var desc = $("#pdesc").val();
	var pid = $("#pid").val();


	if(title != '' || desc!='' || pid!='')
	{
		$("#psub").show();
		$( "#psub" ).html("<img src='assets/img/input-spinner.gif'>");
		$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "themes/update_playlist_title",
			  data: 'pid='+pid+'&title='+title+'&desc='+desc,
			  success: function(d) {
				    $("#perr").show();
					$("#perr").html("Playlist Updated !!");
					$("#ptitle").val("");
					$("#pdesc").val("");
					$("#pid").val("");
					$("#pedit").hide();
					$("#pname").show();
					$("#pname").html("<div class='col-sm-2' style='align:center;padding-top:5px;padding-left:25px;'><img src='assets/img/icon-playlist.gif'></div><div class='col-sm-10' style='padding-top:5px;'><p ondblclick='cng_title(\""+title+"\",\""+desc+"\",\""+pid+"\");'><strong>"+title+"</strong></p><span class='small' ondblclick='cng_title(\""+title+"\",\""+desc+"\",\""+pid+"\");'>"+desc+"</span></div>");
					$("#psub").hide();
					$( "#psub" ).html("");
					$('#plistdata').val(pid+"|^^|"+title+"|^^|"+desc);
			  }
			});
	}
	else
	{
		alert("Title and Description cannot be blank");
	}
}

function selSearchRes(id)
{
	//var curContentId = $("#edit_cont_id").val();
	//alert(id+"-"+curContentId);
	var playlist = $("#plistdata").val();
	var pdata = playlist.split("|^^|");
	var pid = pdata[0];
	//alert(pid + "-" +id);
	
	$.ajax({
		  type: "POST",
		  dataType: "text",
		  url: "themes/add_song_to_playlist", 
		  data: 'q='+id+'&pid='+pid,
		  success: function(data) {
			 $("#perr").show();
			  if(data == "Err")
			  {
				   $("#perr").html("Song already exist in playlist !!");
			  }
			  else
			  {
				   $("#perr").html("Song Added to Playlist !!");
				   $("#plist").html(data);
				   $("#sortableList").sortable({
						connectWith:"ul",
						items : "li"
					});
			  }
			 

			 $( "#search_res" ).html("");
			 $( "#search_res" ).hide();
			 $( "#search_songs" ).val("");
			
			 
		  }
		});
	$('#selTopA').modal('hide');	
	
}
</script>


<div class="tab-content">

        <div class="row" >
          	<div class="col-md-4" style="padding-left:50px;background:#A7A7C9;width:100%;height:40px; line-height: 40px;">
				<h4>Theme Playlists</h4>
			</div>
        </div>

        <div class="row">
            <div id="add_aud" style="width:70%;" >

			 <div class="container" style="align:left;padding:5px;">
			 <div style="align:left;padding:5px;"><button class="save btn btn-default">SAVE</button><span id="au_msg" style="display:none;padding-left:10px;color:red;" class="lead">List Updated !!</span></div>
				<ul class="sortable" id="sortable">
				<?php
				foreach($themes as $playlist_info)
				{
				?><li qplist="<?php echo $playlist_info['PLAYLIST_ID'];?>" id="li_<?php echo $playlist_info['PLAYLIST_ID'];?>">
					<div class="row" style="padding-left:0px;">
						<input type="hidden" id="play_info_<?php echo $playlist_info['PLAYLIST_ID'];?>" value="<?php echo $playlist_info['TITLE'];?>|^^|<?php echo $playlist_info['DESCRIPTION'];?>">
						<div class="col-sm-9">
								<p><strong><a href="#"  class="btn-au"><?php echo $playlist_info['TITLE'];?></a></strong></p>
								<span class="small"><?php echo $playlist_info['DESCRIPTION'];?></span>
						</div>
						<div class="col-sm-3">
							<button type="button" onclick="javascript:edit_playlist('<?php echo $playlist_info['PLAYLIST_ID'];?>');" class="btn btn-info btn-sm" >Edit Playlist</button>
						</div>
					</div>
				</li>
				<?php
				}?>
			  </ul>
			 

			</div>

            </div><!--end of container div-->
       
        </div><!--end of add_aud div-->
		<div id="edt_play" style="width:100%;height:400px;display:none;padding:20px;" class="row">
			
			<div class="row">
				<div class="col-md-12  ">
					<div class="btn-group btn-group-justified">
					   <a class="btn btn-default" href="javascript:void(0);" data-toggle="modal" data-target="#selTopA"">ADD SONG</a>
							
						<a class="btn btn-default" href="javascript:void(0);" id="saveList">
							SAVE ORDER
						</a>
						<a class="btn btn-default" href="javascript:void(0);" onclick="cng_title();">
							EDIT TITLE
						</a>
						<a class="btn btn-default" href="<?php echo site_url().'themes'?>" >
							BACK 
						</a>
						
					</div>
				</div>
			</div>
			<div id='perr' style='padding-top:20px;display:none;padding-left:10px;color:red;' class='lead'><h4>Playlist Updated !!</h4></div>
			
			<input type="hidden" id="plistdata" name="plistdata">
			
			<div id="pname" data-toggle="tooltip" title="Double click to edit playlist title and description" class="container" style="align:left;padding:5px;width:100%;border:1px solid gray;" ondblclick="javascript:cng_title();" >
			</div>

			<div id="pedit"  class="container" style="align:left;padding:15px;width:100%;display:none;" >
				<form class="form-horizontal" role="form">
					<input type="hidden" name="pid" id="pid" value="">
					<div class="form-group form-group-sm">
						<label class="control-label col-sm-2" for="ptitle">Title : </label>
						<div class="col-sm-10"><input class='form-control input-sm' type='text' id='ptitle' name='ptitle' maxlength='100' required value=''></div>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label col-sm-2" for="pdesc">Description : </label>
						<div class="col-sm-10"><input class='form-control input-sm' type='text' id='pdesc' name='pdesc' maxlength='100' required value=''></div>
					</div>
					<div class="form-group form-group-sm" style="align-content: center;">
						<span class="col-sm-5" style="align-content: center;"><input  type='button' value='Update' onclick="update_playlist_title()" class='btn btn-info btn-sm' ></span>
						<span class="col-sm-5" id="psub" style="align-content: center;padding-left:10px;color:red;" class="lead"></span>
					</div>
				</form>
			</div>
			
			<div id="plist" class="row" style="padding-left:12px;height:300px;overflow:scroll;border:1px solid grey;">
				<ul class='sortable' id='sortableList'>
				</ul>
			</div>

			<!-- modal div -->
				<div class="modal fade" id="selTopA" >
					<div class="modal-dialog">
    
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Search Songs</h4>
						</div>
						<div class="modal-body">
						  
						  <p><input type="text" id="search_songs" name="search_songs"></p>

						  <div id="search_res" style="height:350px;overflow:scroll;display:none;"></div>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					  </div>
      
				</div>
			  </div>
			   <!-- end of modal div -->
				
		</div>


</div>

<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- BEGIN CONTENT -->
</div>



