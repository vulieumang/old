<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<div class=containertitle><b>Quản lý liên kết</b>
<?php if(isset($_GET['active_taxis'])):?><span class="actived">Cập nhật phân loại thành công!</span><?php endif;?>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa liên kết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><span class="actived">Sửa liên kết thành công!</span><?php endif;?>
<?php if(isset($_GET['active_add'])):?><span class="actived">Thêm liên kết thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Tên và địa chỉ không được để trống.</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">Không có liên kết nào để sắp xếp.</span><?php endif;?>
</div>
<div class=line></div>
<form action="link.php?action=link_taxis" method="post">
  <table width="100%" id="adm_link_list" class="item_list">
    <thead>
      <tr>
	  	<th width="50"><b>STT</b></th>
        <th width="230"><b>Liên kết</b></th>
		<th width="30" class="tdcenter"><b>Xem</b></th>
		<th width="550"><b>Mô tả</b></th>
        <th width="100"></th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($links as $key=>$value):?>  
      <tr>
		<td><input class="num_input" name="link[<?php echo $value['id']; ?>]" value="<?php echo $value['taxis']; ?>" maxlength="4" /></td>
		<td><a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>" title="Sửa liên kết"><?php echo $value['sitename']; ?></a></td>
		<td class="tdcenter">
	  	<a href="<?php echo $value['siteurl']; ?>" target="_blank" title="Xem trong trang mới">
	  	<img src="./views/images/vlog.gif" align="absbottom" border="0" /></a>
	  	</td>
        <td><?php echo $value['description']; ?></td>
        <td><a href="javascript: em_confirm(<?php echo $value['id']; ?>, 'link');">Xóa</a> | <a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>" title="Sửa liên kết">Sửa</a></td>
      </tr>
	<?php endforeach; ?>
    </tbody>
  </table>
  <div class="list_footer"><input type="submit" value="Lưu thay đổi" class="submit" /></div>
</form>
<form action="link.php?action=addlink" method="post" name="link" id="link">
<div style="margin:30px 0px 10px 0px;"><a href="javascript:displayToggle('link_new', 2);">+ Thêm liên kết</a></div>
<div id="link_new">
	<li>Số thứ tự: </li>
	<li><input maxlength="4" style="width:228px;" name="taxis" /></li>
	<li>Tên website: </li>
	<li><input maxlength="200" style="width:228px;" name="sitename" /></li>
	<li>Địa chỉ: </li>
	<li><input maxlength="200" style="width:228px;" name="siteurl" /></li>
	<li>Mô tả: </li>
	<li><textarea name="description" type="text" style="width:230px;height:60px;overflow:auto;"></textarea></li>
	<li><input type="submit" name="" value="Thêm"  /></li>
</div>
</form>
<script>
$("#link_new").css('display', $.cookie('em_link_new') ? $.cookie('em_link_new') : 'none');
$(document).ready(function(){
	$("#adm_link_list tbody tr:odd").addClass("tralt_b");
	$("#adm_link_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
$("#menu_link").addClass('sidebarsubmenu1');
</script>