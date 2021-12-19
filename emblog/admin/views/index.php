<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="admindex">
<div id="admindex_main">
    <div id="tw">
        <div class="main_img"><a href="./blogger.php"><img src="<?php echo $avatar; ?>" height="52" width="52" /></a></div>
        <div class="right">
        <form method="post" action="twitter.php?action=post">
        <div class="msg2"><a href="blogger.php"><?php echo $name; ?></a> (Có <span class=care2><b><?php echo $sta_log;?></b></span> bài viết và <span class=care2><b><?php echo $sta_tw;?></b></span> twitter)</div>
        <div class="box_1"><textarea class="box2" name="t">Hãy viết gì đó...</textarea></div>
        <div class="tbutton" style="display:none;"><input type="submit" value="Đăng" onclick="return checkt();"/> <a href="javascript:closet();">Đóng</a> <span>(Bạn có thể nhập 140 ký tự)</span></div>
        </form>
        </div>
		<div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<div id="admindex_servinfo">
<h3>Thông tin hệ thống</h3>
<ul>
	<li>PHP: <?php echo $php_ver; ?></li>
	<li>MySQL: <?php echo $mysql_ver; ?></li>
	<li>Server: <?php echo $serverapp; ?></li>
	<li>Thư viện GD: <?php echo $gd_ver; ?></li>
	<li>Chế độ Safe Mode: <?php echo $safe_mode ? 'Mở' : 'Tắt'; ?></li>
	<li>Dung lượng tải lên: <?php echo $uploadfile_maxsize; ?></li>
	<li><a href="index.php?action=phpinfo">Xem thêm &raquo;</a></li>
</ul>
<p id="m"><a title="Phiên bản điện thoại"><?php echo BLOG_URL.'m'; ?></a></p>
</div>
<div id="admindex_msg">
<h3>Tin tức cập nhật</h3>
<ul></ul>
</div>
<div class="clear"></div>
</div>
<script>
$(document).ready(function(){
    $(".box2").focus(function(){
        $(this).val('').css('height','50px').unbind('focus');
        $(".tbutton").show();
    });
    $(".box2").keyup(function(){
       var t=$(this).val();
       var n = 140 - t.length;
       if (n>=0){
         $(".tbutton span").html("(Bạn có thể nhập "+n+" ký tự)");
       }else {
         $(".tbutton span").html("<span style=\"color:#FF0000\">(Quá giới hạn "+Math.abs(n)+" ký tự)</span>");
       }
    });
	$("#admindex_msg ul").html("<span class=\"ajax_remind_1\">Đang nhận...</span>");
	$.getJSON("http://www.emlog.net/services/messenger.php?callback=?",
	function(data){
		$("#admindex_msg ul").html("");
		$.each(data.items, function(i,item){
			var image = '';
			if (item.image != ''){
				image = "<a href=\""+item.url+"\" target=\"_blank\" title=\""+item.title+"\"><img src=\""+item.image+"\"></a><br />";
			}
			$("#admindex_msg ul").append("<li class=\"msg_type_"+item.type+"\">"+image+"<span>"+item.date+"</span><a href=\""+item.url+"\" target=\"_blank\">"+item.title+"</a></li>");
		});
	});
});
function closet(){
    $(".tbutton").hide();
    $(".tbutton span").html("(Giới hạn 140 ký tự)");
    $(".box2").val('Hãy viết gì đó...').css('height','17px').bind('focus',function(){
        $(this).val('').css('height','50px').unbind('focus');
        $(".tbutton").show();});
}
function checkt(){
    var t=$(".box2").val();
    var n=140 - t.length;
    if (n<0){return false;}
}
</script>
