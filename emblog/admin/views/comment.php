<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Quản lý nhận xét</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa nhận xét thành công!</span><?php endif;?>
<?php if(isset($_GET['active_show'])):?><span class="actived">Hiển thị nhận xét thành công!</span><?php endif;?>
<?php if(isset($_GET['active_hide'])):?><span class="actived">Ẩn nhận xét thành công!</span><?php endif;?>
<?php if(isset($_GET['active_rep'])):?><span class="actived">Trả lời nhận xét thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Hãy chọn nhận xét để thực hiện!</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">Chọn 1 thao tác để thực hiện</span><?php endif;?>
<?php if(isset($_GET['error_c'])):?><span class="error">Hãy nhập nội dung trả lời!</span><?php endif;?>
<?php if(isset($_GET['error_d'])):?><span class="error">Nội dung trả lời quá dài!</span><?php endif;?>
</div>
<div class=line></div>
<?php if ($hideCommNum > 0) : 
$hide_ = $hide_y = $hide_n = '';
$a = "hide_$hide";
$$a = "class=\"filter\"";
?>
<div class="filters">
<span <?php echo $hide_; ?>><a href="./comment.php?<?php echo $addUrl_1 ?>">Tất cả</a></span>
<span <?php echo $hide_y; ?>><a href="./comment.php?hide=y&<?php echo $addUrl_1 ?>">Chờ
<?php
$hidecmnum = ROLE == 'admin' ? $sta_cache['hidecomnum'] : $sta_cache[UID]['hidecommentnum'];
if ($hidecmnum > 0) echo '('.$hidecmnum.')';
?>
</a></span>
<span <?php echo $hide_n; ?>><a href="comment.php?hide=n&<?php echo $addUrl_1 ?>">Hiện</a></span>
</div>
<?php endif; ?>
<form action="comment.php?action=admin_all_coms" method="post" name="form_com" id="form_com">
  <table width="100%" id="adm_comment_list" class="item_list">
  	<thead>
      <tr>
        <th width="19"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></th>
        <th width="350"><b>Nội dung</b></th>
		<th width="300"><b>Trả lời</b></th>
        <th width="250"><b>Bài viết</b></th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($comment as $key=>$value):
	$ishide = $value['hide']=='y'?'<font color="red">[Chờ]</font>':'';
	$mail = !empty($value['mail']) ? "({$value['mail']})" : '';
	$ip = !empty($value['ip']) ? "<br />Từ: {$value['ip']}" : '';
	$poster = !empty($value['url']) ? '<a href="'.$value['url'].'" target="_blank">'. $value['poster'].'</a>' : $value['poster'];
	$value['content'] = str_replace('<br>',' ',$value['content']);
	$sub_content = subString($value['content'], 0, 50);
	$value['title'] = subString($value['title'], 0, 50);
	doAction('adm_comment_display');
	?>
     <tr>
        <td><input type="checkbox" value="<?php echo $value['cid']; ?>" name="com[]" class="ids" /></td>
        <td><a href="comment.php?action=reply_comment&amp;cid=<?php echo $value['cid']; ?>" title="<?php echo $value['content']; ?>"><?php echo $sub_content; ?></a> <?php echo $ishide; ?>
        <br /><?php echo $value['date']; ?>
		<span style="display:none; margin-left:8px;">    
		<a href="javascript: em_confirm(<?php echo $value['cid']; ?>, 'comment');">Xóa</a>
		<?php if($value['hide'] == 'y'):?>
		<a href="comment.php?action=show&amp;id=<?php echo $value['cid']; ?>">Hiện</a>
		<?php else: ?>
		<a href="comment.php?action=hide&amp;id=<?php echo $value['cid']; ?>">Ẩn</a>
		<?php endif;?>
		<a href="comment.php?action=reply_comment&amp;cid=<?php echo $value['cid']; ?>">Trả lời</a>
		</span>
		</td>
		<td><?php echo $poster;?> <?php echo $mail;?> <?php echo $ip;?></td>
        <td><a href="<?php echo Url::log($value['gid']); ?>" target="_blank" title="Xem trong trang mới"><?php echo $value['title']; ?></a></td>
     </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
	<div class="list_footer">
	Thao tác: 
    <a href="javascript:commentact('del');">Xóa</a> | 
	<a href="javascript:commentact('hide');">Ẩn</a> | 
	<a href="javascript:commentact('pub');">Hiện</a>
	<input name="operate" id="operate" value="" type="hidden" />
	</div>
    <div class="page"><?php echo $pageurl; ?>(Có <?php echo $cmnum; ?> nhận xét)</div> 
</form>
<script>
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
		.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();})
});
setTimeout(hideActived,2600);
function commentact(act){
	if (getChecked('ids') == false) {
		alert('Hãy chọn nhận xét');
		return;
	}
	if(act == 'del' && !confirm('Bạn có muốn xóa nhận xét này không?')){return;}
	$("#operate").val(act);
	$("#form_com").submit();
}
$("#menu_cm").addClass('sidebarsubmenu1');
</script>