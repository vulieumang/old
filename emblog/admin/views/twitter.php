<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Twitter</b>
<?php if(isset($_GET['active_t'])):?><span class="actived">Đăng twitter thành công!</span><?php endif;?>
<?php if(isset($_GET['active_set'])):?><span class="actived">Thiết lập thành công</span><?php endif;?>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa twitter thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Hãy viết gì đó!</span><?php endif;?>
</div>
<div class=line></div>
<div id="tw">
    <div class="main_img"><a href="./blogger.php"><img src="<?php echo $avatar; ?>" height="52" width="52" /></a></div>
    <div class="right">
    <form method="post" action="twitter.php?action=post">
    <div class="msg">Giới hạn 140 ký tự</div>
    <div class="box_1"><textarea class="box" name="t"></textarea></div>
    <div class="tbutton"><input type="submit" value="Gửi" onclick="return checkt();"/></div>
    </form>
    <?php if (ROLE == 'admin'):?>
    <div class="op"><a href="javascript:displayToggle('sz_box', 2);">Thiết lập</a></div>
    <form method="post" action="twitter.php?action=set">
        <div class="sz_box" id="sz_box">
            <span>Hiển thị: <input type="checkbox" style="vertical-align:middle;" value="y" name="istwitter" id="istwitter" <?php echo $conf_istwitter; ?> /></span>
            <span>Mã xác nhận: <input type="checkbox" style="vertical-align:middle;" value="y" name="reply_code" id="reply_code" <?php echo $conf_reply_code; ?> /></span>
            <span>Kiểm duyệt trả lời: <input type="checkbox" style="vertical-align:middle;" value="y" name="ischkreply" id="ischkreply" <?php echo $conf_ischkreply; ?> /></span>
           	<span>Số twitter trên trang: <input type="text" name="index_twnum" maxlength="3" value="<?php echo Option::get('index_twnum'); ?>" style="width:25px;" /></span>
           	<span>Hiển thị trên thanh điều hướng: <input type="text" name="twnavi" value="<?php echo Option::get('twnavi'); ?>" style="width:66px;" /></span>
            <input class="tbutton" type="submit" value="Thiết lập" />
        </div>
    </form>
    <?php endif;?>
    </div>
    <div class="clear"></div>
    <ul>
    <?php
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $replynum = $Reply_Model->getReplyNum($tid);
    $hidenum = $replynum - $val['replynum'];
    ?>
    <li class="li">
    <div class="main_img"><img src="<?php echo $avatar; ?>" width="32px" height="32px" /></div>
    <p class="post1"><?php echo $author; ?><br /><?php echo $val['t'];?></p>
    <div class="clear"></div>
    <div class="bttome">
        <p class="post" id="<?php echo $tid;?>"><a href="javascript:void(0);">Trả lời: </a>( <span><?php echo $replynum;?></span> <small><?php echo $hidenum > 0 ? $hidenum : '';?></small> )</p>
        <p class="time"><?php echo $val['date'];?> <a href="javascript: em_confirm(<?php echo $tid;?>, 'tw');">Xóa</a> </p>
    </div>
	<div class="clear"></div>
   	<div id="r_<?php echo $tid;?>" class="r"></div>
    <div class="huifu" id="rp_<?php echo $tid;?>">
	<textarea name="reply"></textarea>
    <div><input class="button_p" type="button" onclick="doreply(<?php echo $tid;?>);" value="Trả lời" /> <span style="color:#FF0000"></span></div>
    </div>
    </li>
    <?php endforeach;?>
	 <li class="page"><?php echo $pageurl;?>(Có <?php echo $twnum; ?> twitter)</li>
    </ul>
</div>
<script>
$(document).ready(function(){
    $(".post a").toggle(
      function () {
        tid = $(this).parent().attr('id');
        $("#r_" + tid).html('<p class="loading"></p>');
        $.get("twitter.php?action=getreply&tid="+tid+"&stamp="+timestamp(), function(data){
        $("#r_" + tid).html(data);
        $("#rp_"+tid).show();
      })},
      function () {
        tid = $(this).parent().attr('id');
        $("#r_" + tid).html('');
        $("#rp_"+tid).hide();
    });
    $(".box").keyup(function(){
       var t=$(this).val();
       var n = 140 - t.length;
       if (n>=0){
         $(".msg").html("Bạn có thể nhập "+n+" ký tự");
       }else {
         $(".msg").html("<span style=\"color:#FF0000\">Quá giới hạn "+Math.abs(n)+" ký tự</span>");
       }
    });
    setTimeout(hideActived,2600);
    $("#sz_box").css('display', $.cookie('em_sz_box') ? $.cookie('em_sz_box') : '');
    $("#menu_tw").addClass('sidebarsubmenu1');
    $(".box").focus();
});
function reply(tid, rp){
    $("#rp_"+tid+" textarea").val(rp);
    $("#rp_"+tid+" textarea").focus();
}
function doreply(tid){
    var r = $("#rp_"+tid+" textarea").val();
    var post = "r="+encodeURIComponent(r);
	$.post('twitter.php?action=reply&tid='+tid+"&stamp="+timestamp(), post, function(data){
		data = $.trim(data);
		if (data == 'err1'){
            $(".huifu span").text('Giới hạn 140 ký tự');
		}else if(data == 'err2'){
		    $(".huifu span").text('Câu trả lời đã tồn tại.');
		}else{
    		$("#r_"+tid).append(data);
    		var rnum = Number($("#"+tid+" span").text());
    		$("#"+tid+" span").html(rnum+1);
    		$(".huifu span").text('')
    	}
	});
}
function delreply(rid,tid){
    if(confirm('Bạn có muốn xóa twitter này không? Thao tác không thể phục hồi!')){
        $.get("twitter.php?action=delreply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(data){
            var tid = Number(data);
            var rnum = Number($("#"+tid+" span").text());
            $("#"+tid+" span").text(rnum-1);
            if ($("#reply_"+rid+" span a").text() == 'Kiểm tra'){
                var rnum = Number($("#"+tid+" small").text());
                if(rnum == 1){$("#"+tid+" small").text('');}else{$("#"+tid+" small").text(rnum-1);}
            }
            $("#reply_"+rid).hide("slow");
        })}else {return;}
}
function hidereply(rid,tid){
    $.get("twitter.php?action=hidereply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(){
        $("#reply_"+rid).css('background-color','#FEE0E4');
        $("#reply_"+rid+" span a").text('Kiểm tra');
        $("#reply_"+rid+" span a").attr("href","javascript: pubreply("+rid+","+tid+")");
        var rnum = Number($("#"+tid+" small").text());
        $("#"+tid+" small").text(rnum+1);
        });
}
function pubreply(rid,tid){
    $.get("twitter.php?action=pubreply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(){
        $("#reply_"+rid).css('background-color','#FFF');
        $("#reply_"+rid+" span a").text('Kiểm tra');
        $("#reply_"+rid+" span a").attr("href","javascript: hidereply("+rid+","+tid+")");
        var rnum = Number($("#"+tid+" small").text());
        if(rnum == 1){$("#"+tid+" small").text('');}else{$("#"+tid+" small").text(rnum-1);}
        });
}
function checkt(){
    var t=$(".box").val();
    var n=140 - t.length;
    if (n<0){return false;}
}
</script>