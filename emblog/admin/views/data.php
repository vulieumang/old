<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<div class=containertitle><b>Quản lý dữ liệu</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa tập tin sao lưu thành công!</span><?php endif;?>
<?php if(isset($_GET['active_backup'])):?><span class="actived">Sao lưu dữ liệu thành công!</span><?php endif;?>
<?php if(isset($_GET['active_import'])):?><span class="actived">Nhập tập tin sao lưu thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Vui lòng chọn tập tin sao lưu!</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">Tên tập tin lỗi!</span><?php endif;?>
</div>
<div class=line></div>
<form  method="post" action="data.php?action=dell_all_bak" name="form_bak" id="form_bak">
<table width="100%" id="adm_bakdata_list" class="item_list">
  <thead>
    <tr>
      <th width="22"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></th>
      <th width="661"><b>Tập tin sao lưu</b></th>
      <th width="226"><b>Thời gian sao lưu</b></th>
      <th width="149"><b>Kích thước</b></th>
      <th width="87"></th>
    </tr>
  </head>
  <tbody>
	<?php
		foreach($bakfiles  as $value):
		$modtime = smartDate(filemtime($value),'d-m-Y H:i:s');
		$size =  changeFileSize(filesize($value));
		$bakname = substr(strrchr($value,'/'),1);
	?>
    <tr>
      <td><input type="checkbox" value="<?php echo $value; ?>" name="bak[]" class="ids" /></td>
      <td><a href="../content/backup/<?php echo $bakname; ?>"><?php echo $bakname; ?></a></td>
      <td><?php echo $modtime; ?></td>
      <td><?php echo $size; ?></td>
      <td><a href="javascript: em_confirm('<?php echo $value; ?>', 'backup');">Nhập</a></td>
    </tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="list_footer">Thao tác: <a href="javascript:bakact('del');">Xóa</a></div>
</form>
<div style="margin:20px 0px 20px 0px;"><a href="javascript:$('#import').hide();displayToggle('backup', 0);">+ Sao lưu dữ liệu</a><br><a href="javascript:$('#backup').hide();displayToggle('import', 0);">+ Nhập tập tin sao lưu</a></div>
<form action="data.php?action=bakstart" method="post">
<div id="backup">
	<p>Danh sách bảng: <br /><select multiple="multiple" size="11" name="table_box[]">
		<?php foreach($tables  as $value): ?>
		<option value="<?php echo DB_PREFIX; ?><?php echo $value; ?>" selected="selected"><?php echo DB_PREFIX; ?><?php echo $value; ?></option>
		<?php endforeach; ?>
      	</select></p>
	<p>Tên tập tin (Cho phép a-Z, 0-9 và "_")<br /><input maxlength="200" size="35" value="<?php echo $defname; ?>" name="bakfname" /><b>.sql</b></p>
	<p>Nơi sao lưu: <input type="radio" checked="checked" value="local" name="bakplace" id="bakup_place" />
	Tải về<input type="radio" value="server" name="bakplace" id="bakup_place" />Máy chủ</p>
	<p><input type="submit" value="Tiến hành sao lưu" class="submit" /></p>
</div>
</form>
<form action="data.php?action=import" enctype="multipart/form-data" method="post">
<div id="import">
	<p><input type="file" name="sqlfile" /> <input type="submit" value="Nhập" class="submit" /></p>
</div>
</form>
<div class=containertitle><b>Cập nhật bộ nhớ đệm</b>
<?php if(isset($_GET['active_mc'])):?><span class="actived">Cập nhật bộ nhớ đệm thành công</span><?php endif;?>
</div>
<div class=line></div>
<div style="margin:0px 0px 20px 0px;">
	<p class="des">Bộ nhớ đệm giúp tăng một cách đáng kể tốc độ tải của trang chủ. Thông thường hệ thống sẽ tự động cập nhật bộ nhớ đệm nhưng trong một số trường hợp bạn phải tự cập nhật bộ nhớ đệm.</p>
	<p style="margin-left:10px;"><input type="button" onclick="window.location='data.php?action=Cache';" value="Cập nhật" class="submit" /></p>
</div>
<script>
setTimeout(hideActived,2600);
$(document).ready(function(){
	$("#adm_bakdata_list tbody tr:odd").addClass("tralt_b");
	$("#adm_bakdata_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
function bakact(act){
	if (getChecked('ids') == false) {
		alert('Hãy chọn tập tin');
		return;
	}
	if(act == 'del' && !confirm('Bạn có muốn xóa tập tin này không?')){return;}
	$("#operate").val(act);
	$("#form_bak").submit();
}
$("#menu_data").addClass('sidebarsubmenu1');
</script>