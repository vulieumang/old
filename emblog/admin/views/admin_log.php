<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
$isdraft = $pid == 'draft' ? '&pid=draft' : '';
$isDisplaySort = !$sid ? "style=\"display:none;\"" : '';
$isDisplayTag = !$tagId ? "style=\"display:none;\"" : '';
$isDisplayUser = !$uid ? "style=\"display:none;\"" : '';
?>
<div class=containertitle><b><?php echo $pwd; ?></b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa bài viết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_up'])):?><span class="actived">Đưa lên TOP thành công!</span><?php endif;?>
<?php if(isset($_GET['active_down'])):?><span class="actived">Hạ TOP bài viết thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Hãy chọn bài viết để thực hiện</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">Chọn 1 thao tác để thực hiện!</span><?php endif;?>
<?php if(isset($_GET['active_post'])):?><span class="actived">Đăng bài viết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_move'])):?><span class="actived">Di chuyển bài viết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_change_author'])):?><span class="actived">Thay đổi người viết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_hide'])):?><span class="actived">Ẩn bài viết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_savedraft'])):?><span class="actived">Lưu nháp thành công!</span><?php endif;?>
<?php if(isset($_GET['active_savelog'])):?><span class="actived">Lưu bài viết thành công!</span><?php endif;?>
</div>
<div class=line></div>
<div class="filters">
<div id="f_title">
<span <?php echo !$sid && !$tagId && !$uid ? "class=\"filter\"" : ''; ?>><a href="./admin_log.php?<?php echo $isdraft; ?>">Bản nháp</a></span> | 
<span id="f_t_sort"><a href="javascript:void(0);">Phân loại</a></span> | 
<span id="f_t_tag"><a href="javascript:void(0);">Tags</a></span> | 
<span id="f_t_user"><a href="javascript:void(0);">Người viết</a></span>
</div>
<div id="f_sort" <?php echo $isDisplaySort ?>>
	Phân loại: <span <?php echo $sid == -1 ?  "class=\"filter\"" : ''; ?>><a href="./admin_log.php?sid=-1&<?php echo $isdraft; ?>">Chưa phân loại</a></span>
	<?php foreach($sorts as $val):
		$a = "sort_{$val['sid']}";
		$$a = '';
		$b = "sort_$sid";
		$$b = "class=\"filter\"";
	?>
	<span <?php echo $$a; ?>><a href="./admin_log.php?sid=<?php echo $val['sid'].$isdraft; ?>"><?php echo $val['sortname']; ?></a></span>
	<?php endforeach;?>
</div>
<div id="f_tag" <?php echo $isDisplayTag ?>>
	Tags: 
	<?php foreach($tags as $val):
		$a = 'tag_'.$val['tid'];
		$$a = '';
		$b = 'tag_'.$tagId;
		$$b = "class=\"filter\"";
	?>
	<span <?php echo $$a; ?>><a href="./admin_log.php?tagid=<?php echo $val['tid'].$isdraft; ?>"><?php echo $val['tagname']; ?></a></span>
	<?php endforeach;?>
</div>
<div id="f_user" <?php echo $isDisplayUser ?>>
	Người viết: 
	<?php foreach($users as $key => $val):
		if (ROLE != 'admin' && $key != UID){
			continue;
		}
		$a = 'user_'.$key;
		$$a = '';
		$b = 'user_'.$uid;
		$$b = "class=\"filter\"";
		$val['name'] = $val['name'];
	?>
	<span <?php echo $$a; ?>><a href="./admin_log.php?uid=<?php echo $key.$isdraft; ?>"><?php echo $val['name']; ?></a></span>
	<?php endforeach;?>
</div>
</div>
<form action="admin_log.php?action=operate_log" method="post" name="form_log" id="form_log">
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
  <table width="100%" id="adm_log_list" class="item_list">
  <thead>
      <tr>
        <th width="21"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></th>
        <th width="490"><b>Tiêu đề</b></th>
		<?php if ($pid != 'draft'): ?>
		<th width="40" class="tdcenter"><b>Xem</b></th>
		<?php endif; ?>
		<th width="100"><b>Người viết</b></th>
        <th width="146"><b>Phân loại</b></th>
        <th width="148"><b><a href="./admin_log.php?sortDate=<?php echo $sortDate.$sorturl; ?>">Ngày viết</a></b></th>
		<th width="40" class="tdcenter"><b><a href="./admin_log.php?sortComm=<?php echo $sortComm.$sorturl; ?>">Nhận xét</a></b></th>
		<th width="40" class="tdcenter"><b><a href="./admin_log.php?sortView=<?php echo $sortView.$sorturl; ?>">Lượt xem</a></b></th>
      </tr>
	</thead>
 	<tbody>
	<?php
	foreach($logs as $key=>$value):
	$sortName = $value['sortid'] == -1 && !array_key_exists($value['sortid'], $sorts) ? 'Chưa có phân loại' : $sorts[$value['sortid']]['sortname'];
	$author = $users[$value['author']]['name'];
	$tags = isset($log_cache_tags[$value['gid']]) ? $log_cache_tags[$value['gid']] : '' ;
	$tagStr = '';
	if (is_array($tags) && !empty($tags)) {
		foreach ($tags as $val) {
			$tagStr .="<span class=logtag><a href=\"./admin_log.php?tagid={$val['tid']}$isdraft\">{$val['tagname']}</a></span>";
		}
		if ($tagStr) {
			$tagStr = '<span class=logtags>'.$tagStr.'</span>';
		}
	}
	?>
      <tr>
      <td><input type="checkbox" name="blog[]" value="<?php echo $value['gid']; ?>" class="ids" /></td>
      <td>
      <a href="write_log.php?action=edit&gid=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a>
      <?php echo $value['attnum']; ?>
      <?php echo $value['istop']; ?>
      <?php echo $tagStr; ?>
      </td>
	  <?php if ($pid != 'draft'): ?>
	  <td class="tdcenter">
	  <a href="<?php echo Url::log($value['gid']); ?>" target="_blank" title="Xem trong trang mới">
	  <img src="./views/images/vlog.gif" align="absbottom" border="0" /></a>
	  </td>
	  <?php endif; ?>
      <td><a href="./admin_log.php?uid=<?php echo $value['author'].$isdraft;?>"><?php echo $author; ?></a></td>
      <td><a href="./admin_log.php?sid=<?php echo $value['sortid'].$isdraft;?>"><?php echo $sortName; ?></a></td>
      <td><?php echo $value['date']; ?></td>
	  <td class="tdcenter"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
	  <td class="tdcenter"><?php echo $value['views']; ?></a></td>
      </tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<input name="operate" id="operate" value="" type="hidden" />
	<div class="list_footer">
	Thao tác: 
    <a href="javascript:logact('del');">Xóa</a> | 
	<?php if($pid == 'draft'): ?>
	<a href="javascript:logact('pub');">Đăng</a> | 
	<?php else: ?>
	<a href="javascript:logact('hide');">Ẩn</a> | 

	<?php if (ROLE == 'admin'):?>
	<a href="javascript:logact('top');">Đưa lên TOP</a> | 
    <a href="javascript:logact('notop');">Hạ TOP</a> | 
    <?php endif;?>

	<select name="sort" id="sort" onChange="changeSort(this);">
	<option value="" selected="selected">Hãy chọn..</option>
	<?php foreach($sorts as $val):?>
	<option value="<?php echo $val['sid']; ?>"><?php echo $val['sortname']; ?></option>
	<?php endforeach;?>
	<option value="-1">Chưa có phân loại</option>
	</select>

	<?php if (ROLE == 'admin' && count($users) > 1):?>
	<select name="author" id="author" onChange="changeAuthor(this);">
	<option value="" selected="selected">Hãy chọn...</option>
	<?php foreach($users as $key => $val):
	$val['name'] = $val['name'];
	?>
	<option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
	<?php endforeach;?>
	</select>
	<?php endif;?>

	<?php endif;?>
	</div>
</form>
<div class="page"><?php echo $pageurl; ?> (Có <?php echo $logNum; ?> <?php echo $pid == 'draft' ? 'bản nháp' : 'bài viết'; ?>)</div>
<script>
$(document).ready(function(){
	$("#adm_log_list tbody tr:odd").addClass("tralt_b");
	$("#adm_log_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")});
	$("#f_t_sort").click(function(){$("#f_sort").toggle();$("#f_tag").hide();$("#f_user").hide();});
	$("#f_t_tag").click(function(){$("#f_tag").toggle();$("#f_sort").hide();$("#f_user").hide();});
	$("#f_t_user").click(function(){$("#f_user").toggle();$("#f_sort").hide();$("#f_tag").hide();});
});
setTimeout(hideActived,2600);
function logact(act){
	if (getChecked('ids') == false) {
		alert('Hãy chọn bài viết');
		return;}
	if(act == 'del' && !confirm('Bạn có muốn xóa bài viết này không?')){return;}
	$("#operate").val(act);
	$("#form_log").submit();
}
function changeSort(obj) {
	var sortId = obj.value;
	if (getChecked('ids') == false) {
		alert('Hãy chọn bài viết');
		return;}
	if($('#sort').val() == '')return;
	$("#operate").val('move');
	$("#form_log").submit();
}
function changeAuthor(obj) {
	var sortId = obj.value;
	if (getChecked('ids') == false) {
		alert('Hãy chọn bài viết');
		return;}
	if($('#author').val() == '')return;
	$("#operate").val('change_author');
	$("#form_log").submit();
}
<?php if ($isdraft) :?>
$("#menu_draft").addClass('sidebarsubmenu1');
<?php else:?>
$("#menu_log").addClass('sidebarsubmenu1');
<?php endif;?>
</script>