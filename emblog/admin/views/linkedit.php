<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Sửa liên kết</b></div>
<div class=line></div>
<form action="link.php?action=update_link" method="post">
<div>
	<li>Tên website</li>
	<li><input size="40" value="<?php echo $sitename; ?>" name="sitename" /></li>
	<li>Địa chỉ</li>
	<li><input size="40" value="<?php echo $siteurl; ?>" name="siteurl" /></li>
	<li>Mô tả</li>
	<li><textarea name="description" rows="3" cols="45"><?php echo $description; ?></textarea></li>
	<li>
	<input type="hidden" value="<?php echo $linkId; ?>" name="linkid" />
	<input type="submit" value="Sửa" class="submit" />
	<input type="button" value="Quay lại" class="submit" onclick="javascript: window.history.back();" /></li>
</div>
</form>
<script>
$("#menu_link").addClass('sidebarsubmenu1');
</script>