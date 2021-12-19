<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Quản lý tags</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa tags thành công!</span><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><span class="actived">Sửa tags thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Hãy chọn tags muốn xóa!</span><?php endif;?>
</div>
<div class=line></div>
<form action="tag.php?action=dell_all_tag" method="post">
<div>
<li>
<?php foreach($tags as $key=>$value): ?>	
<input type="checkbox" name="tag[<?php echo $value['tid']; ?>]" value="1" >
<a href="tag.php?action=mod_tag&tid=<?php echo $value['tid']; ?>"><?php echo $value['tagname']; ?></a> &nbsp;&nbsp;&nbsp;
<?php endforeach; ?>
</li>
<li style="margin:20px 0px"><input type="submit" value="Xóa" class="submit" /></li>
</div>
</form>
<script>
setTimeout(hideActived,2600);
$("#menu_tag").addClass('sidebarsubmenu1');
</script>