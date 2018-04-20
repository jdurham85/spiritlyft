var post_update_timer = '';
var st;
var selected_emojli = 0;
var emojlis = ["COOL", "LOVE", "LAUGHING", "SAD" , "CONFUSED"];
var old_post = [];
/*
function showEmojli(wall)
{
	window.parent.WallbackScreen_show(wall);
}

function setSelectedEmojli(emojli)
{
	selected_emojli = emojli;	
}

function SelectedEmojli(wall)
{
	return selected_emjoli;	
}*/
	
function slideshow_show(wallpost)
{
	window.parent.slideshow_show(wallpost);
}
	
function slideshow_close()
{
	window.parent.slideshowclose();
}
/*---------------------------------------------*/
	
function emotionview_panel_close()
{
			
}

function emotionview_panel_show(wall)
{
	window.parent.emotionview_panel_show(wall);	
}

function emotionview_panel_show_with_seperated_emojli(wall, id)
{
	window.parent.emotionview_panel_show_with_seperated_emojli(wall, id);
}

function wallcomment_sub_inputbox_show(id)
{
	$("#wallcomment_sub_inputbox"+id).fadeIn();
	$("#wallcomment_sub_txt"+id).focus();
}

function wallcomment_sub_inputbox_hide(id)
{
	$("#wallcomment_sub_inputbox"+id).fadeOut();
	$("#wallcomment_sub_txt"+id).focusout();
}

function emojli_container_show(wall)
{
	$("#emojli_container"+wall).fadeIn();
}

function emojli_container_hide(wall)
{
	$("#emojli_container"+wall).fadeOut();
}

function wall_exist(wall)
{
	$.post("include/wall_exist.php",{Wallid: wall}, function(result){
		if(result == 0)
		{
			return false;
		}
	});
}

function check_wall_exist(wall)
{
	$.post("include/wall_exist.php",{Wallid: wall}, function(result){
		if(result == 0)
		{
			alert("The post you are looking for do not exist");
			return 0;
		}
	});
}

function wallframe_close()
{
	$("#comment_bg").fadeOut();
	$("#wall_frame").html("");
	$(".post_panel").show();
}

function wallframe_show(wall)
{
	if(check_wall_exist(wall) != 0)
	{
		$("#wall_frame").load("include/WallView.php?wallid="+wall);
		//$("#wall_frame").fadeIn();
		$("#comment_bg").show();
		$(".post_panel").hide();
	}
}

var postarray_track = 0;
var wall_comment_sub_track = 0;
function auto_update_post()
{
	clearTimeout(post_update_timer);
	var postwallid_list = [];
	var wallcomment_list = [];
	var wallcomment_sub_list = [];
	
	$('.lower_footer').each(function(){
		postwallid_list.push($(this).attr("id").substring(12));
		//alert($(this).attr("id").substring(12));
		//console.log($(this).attr("id").substring(12));
	});
	

	for(var postarray = 0; postarray < postwallid_list.length; postarray++)
	{
		postarray_track = postarray;
		
		$(".wallcomment_header", "#lower_footer"+postwallid_list[postarray]).each(function(){
			wallcomment_list.push($(this).attr("id").substring(11));
		});
		
		
		
		$(".wallcomment_sub_inputbox").each(function(){
			wallcomment_sub_list.push($(this).attr("id").substring(24));
			//console.log($(this).attr("id"));
		});
		
		
		//Check WallComment Mode 1
		$.post("include/auto_update_post.php", {Wallid: postwallid_list[postarray_track], Mode: 1, WallElements: wallcomment_list}, function(post){
			if(!post == "")
			{
				//console.log(postwallid_list[postarray_track]);
				//$("#lower_footer_td"+postwallid_list[postarray_track]).before(post);
				$("#wallcomment_inputbox"+postwallid_list[postarray_track]).fadeIn(4000).before(post);
			}
		});
		
		//console.log(wallcomment_sub_list);
		
		//Check WallCommentSub Mode 2
		for(var wallcommentsubcount = 0; wallcommentsubcount < wallcomment_sub_list.length; wallcommentsubcount++)
		{
			wall_comment_sub_track = wallcommentsubcount;
			//console.log(wallcomment_sub_list[wall_comment_sub_track]);
			//console.log(wallcomment_sub_list[wall_comment_sub_track] + "\n");
			$.post("include/auto_update_post.php", {Wallid: postwallid_list[postarray_track], Mode: 2, WallElements: wallcomment_sub_list}, function(post){
				if(!post == "")
				{
					//$("#wallcomment_sub_inputbox"+wallcomment_sub_list[wall_comment_sub_track]).before(post);
					//$("#wallcomment_sub_tb"+wallcomment_sub_list[wall_comment_sub_track]).before(post);
				} 
				console.log(post);
			}); //await sleep(2000);  
		}
		
		
			
		
		
		
		
		wallcomment_list = [];
		wallcomment_sub_list = [];
		
		//await sleep(2000);
	}
}

function loadnew_WallComment(wallid, lastwallcommentid)
{
	
}

function loadnew_WallComment_sub(wallid, lastwallcommentid)
{
	
}

function update_post(wallid)
{
	$.post("include/updatepost.php",{wallid: wallid}, function(post){
		$("#post_panel"+wallid).html(post);
	});

	//alert("THANK YOU GOD THANK YOU JESUS");
}

function setWallCommentTotal(wall)
{
	$.post("include/getWallCommentTotal.php", {Wallid: wall}, function(total){
			$("#wall_comment_total"+wall).html(total);
		});	
}

function WallComment_Delete(id, wall)
{
	$.post("include/WallComment_Delete.php", {id: id}, function(result){
			if(result == 0)
			{
				$("#wallcomment"+id).fadeOut().remove();	
			}
			setWallCommentTotal(wall);
		});	
}

function WallComment_txt_focus(id)
{
	$("#wallcomment_txt"+id).focus();	
}

function WallComment_Insert(event, id)
{
	if(event.which == 13 || event.keyCode == 13 && $("#wallcomment_txt"+id).val().length > 0)
	{
		$.post("include/insert_wallComment.php", {Wallid: id, Description: $("#wallcomment_txt"+id).val()}, function(wc){
			$("#wallcomment_inputbox"+id).before(wc).fadeIn();
			$("#wallcomment_txt"+id).val('');
			setWallCommentTotal(id);
		});	
	}
}

function WallComment_update()
{
	var wallcomment_list = [];
	var lastwallcommentid = '';

	$(".wallcomment_header").each(function(){
		wallcomment_list.push($(this).attr("id").substring(11));
	});
	
	lastwallcommentid = wallcomment_list.length;
}

////////////////////////////////////////////////////

function WallComment_sub_txt_focus(id)
{
	$("#wallcomment_sub_txt"+id).focus();	
}

function WallComment_sub_Insert(wall, event, id)
{
	if(event.which == 27 || event.keyCode == 27)
	{
		$("#wallcomment_sub_txt"+id).val('');	
		wallcomment_sub_inputbox_hide(id);
	}	
	
	if(event.which == 13 || event.keyCode == 13 && $("#wallcomment_sub_txt"+id).val().length > 0)
	{
		wallcomment_sub_inputbox_hide(id);
		$.post("include/InsertWallComment_sub.php", {Wallid: wall, WallCommentid: id, Description: $("#wallcomment_sub_txt"+id).val()}, function(wc){
			$("#wallcomment_sub_inputbox"+id).before(wc);
			$("#wallcomment_sub_txt"+id).val('');
		});	
	}	
}

function wallcomment_like_wall(WallCommentid)
{
	$("#wallcomment_emojli_container"+WallCommentid).fadeIn();
}

function wallcomment_like(WallCommentid, emojli)
{
	//emojlis array
	$.post("include/like_wall_comment.php", {WallCommentid: WallCommentid, Emojli: emojli}, function(wc){
		$("#wall_comment_total_likes"+WallCommentid).html(wc);
		wallcomment_emojli_container_hide(WallCommentid);
		$("#wallcomment_like_wall_btn"+WallCommentid).html(emojlis[emojli]);
		$("#wallcomment_like_wall_btn"+WallCommentid).attr("onClick", "wallcomment_unlike("+WallCommentid+");")
	});
}

function wallcomment_unlike(WallCommentid)
{
	$.post("include/unlike_wall_comment.php",{WallCommentid: WallCommentid}, function(wc){
	$("#wall_comment_total_likes"+WallCommentid).html(wc);

		$("#wallcomment_like_wall_btn"+WallCommentid).attr("onClick", "wallcomment_like_wall("+WallCommentid+");");
		$("#wallcomment_like_wall_btn"+WallCommentid).html("React");
	});
}


function wallcomment_emojli_container_hide(WallCommentid)
{
	$("#wallcomment_emojli_container"+WallCommentid).fadeOut();
}

function WallComment_sub_Delete(id)
{
	$.post("include/WallComment_sub_Delete.php", {id: id}, function(result){
		$("#Wallcomment_sub"+id).remove();	
		});	
}

function WallComment_sub_update()
{
	
}
	
function share_wall_show_or_hide(wall)
{
	$("#share_wall_panel"+wall).slideToggle();
}
	
function share_wall_show(wall)
{
	$("#share_wall_panel"+wall).slideToggle();
}
	
function share_wall_hide(wall)
{
	$("#share_wall_panel"+wall).fadeOut();
}
	
function share_wall(wall, level)
{
	$.post("include/wall_share.php", {wallid: wall, level: level});
	
	$("#share_btn"+wall).html("Shared");
	
	$("#share_btn"+wall).attr("onclick", "unshare_wall("+wall+");");
	
	share_wall_hide(wall);
}
	
function unshare_wall(wall)
{
	$.post("include/wall_unshare.php", {wallid: wall});
	
	$("#share_btn"+wall).html("Share");
	share_wall_hide(wall);
	$("#share_btn"+wall).attr("onclick", "share_wall_show("+wall+");");
}

function like_wall(wall, emojli)
{
	emojli_container_hide(wall);
	
	$.post("include/like_wall.php", {Wallid: wall, emojli: emojli}, function(result){
			$("#like_btn"+wall).html(emojlis[emojli]);
			$("#like_btn"+wall).attr("onClick", "unlike_wall("+wall+");");
					
			$("#wall_total_likes"+wall).html(result);
		});	
}


function unlike_wall(wall)
{
	$.post("include/unlike_wall.php", {Wallid: wall}, function(result){
			$("#like_btn"+wall).html("React");
			$("#like_btn"+wall).attr("onClick", "emojli_container_show("+wall+");");
			
			emojli_container_hide(wall);
			$("#wall_total_likes"+wall).html(result);
		});		
}

function deleteWall(wall)
{
	$.post("include/delete_post.php", {Wallid: wall}, function(result){
			$("#post_panel"+wall).fadeOut(function(){$(this).remove();});
		});
}

function hideWall(parentwall, wall)
{
	//$("#post_panel"+wall).fadeOut(function(){$(this).remove();});	

	$.post("include/Wall_hide.php", {parentid: parentwall, wallid: wall}, function(result){
			$("#post_panel"+wall).fadeOut(function(){$(this).remove();});
		});	
}

function fileBrowser_open()
{
	$("#mfile").trigger('click');
}

function clear_fileinput()
{
	window.parent.clear_fileinput()
	loading_scr_hide();
}

function errorMessage(message)
{
	alert(message);
	loading_scr_hide();	
}

function loading_scr_show()
{
	$("#loading_screen").show();	
}

function loading_scr_hide()
{
	$("#loading_screen").hide();	
}

function loadPost(page, wall_old_post)
{
	//$("#post_panelsub").html("");
	$.post("include/loadPost.php",{page: page}, function(post){
		$("#post_panelsub").html(post);
	});
}

function loadmyPost(page, wall_old_post)
{
	//$("#post_panelsub").html("Loading...");
	$.post("include/loadmyPost.php",{page: page}, function(post){
		$("#post_panelsub").html(post);
	});
}

function loadmemberPost(profileid, wall_old_post)
{
	$("#post_panelsub").html("Loading...");
	$.post("include/loadmemberPost.php",{profileid: profileid}, function(post){
		$("#post_panelsub").html(post);
	});
}

function loadNewMPost()
{ 
	loading_scr_show();
	$.post("include/loadNewMPost.php", function(post){
		$("#post_panelsub").before(post);
		loading_scr_hide();
	});
}


var timeout_wall_btn='';

function loadNewestPost()
{
	$.post("include/getNewestPost.php", {oldpost: old_post}, function(newpost){
		$("#post_panelsub").after($(newpost).fadeIn(1000));
	});

	//$(document).scrollTop(1);
}
	
function wall_btn_mouseover(wall)
{
	timeout_wall_btn = setTimeout(function(){emojli_container_show(wall);}, 2000);
	//emojli_container_show(wall);
}
	
function wall_btn_mouseleave(wall)
{
	//setTimeout(function(){emojli_container_hide(wall);}, 2000);
	emojli_container_hide(wall);
	clearTimeout(timeout_wall_btn);
}

function test(){alert('Thank you Lord Jesus God');}

$("#comment_bg").height($(window).height());
$("#loading_screen").height($(window).height());



function submitdata()
{
	if($("#postinput").val().length != 0 || $("#mfile").val().length != 0)
	{
		$("#submit1").trigger('click');
		$("#post_btn").html("Posting...");
		$("#post_btn").prop("disabled", true);
	}
}