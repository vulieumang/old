<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<div class=containertitle><b>Điều chỉnh đầu trang</b>
<?php if(isset($_GET['activated'])):?><span class="actived">Điều chỉnh thành công!</span><?php endif;?>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Cắt hình ảnh thất bại!</span><?php endif;?>
</div>
<div class=line></div>
<?php if(!file_exists('../' . $topimg)): ?>
<div class="error_msg">Hình ảnh đang dùng đã được gỡ bỏ hoặc bị hỏng, hãy chọn hình ảnh khác.</div>
<?php else:?>
<div id="topimg_preview"><img src="<?php echo '../'.$topimg; ?>" width="758" height="105" /></div>
<?php endif;?>
<form action="configure.php?action=mod_config" method="post" name="input" id="input">
<div class="topimg_line">Tùy chọn ảnh</div>
<div id="topimg_default">
	<?php 
	foreach ($topimgs as $val): 
	$imgpath = $val;
	if(is_array($val)) {
		$imgpath = $val['path'];
	}
	$imgpath_url = urlencode($imgpath);
	$mini_imgpath = str_replace('.jpg', '_mini.jpg', $imgpath);
	if (!file_exists('../' . $mini_imgpath)) {
		continue;
	}
	?>
	<div>
	<a href="./template.php?action=update_top&top=<?php echo $imgpath_url; ?>" title="Nhấn vào để thay đổi" >
	<img src="../<?php echo $mini_imgpath; ?>" width="230px" height="48px" class="topTH" />
	</a>
	<?php if (!is_array($val)):?>
	<li class="admin_style_info" >
	<a href="./template.php?action=del_top&top=<?php echo $imgpath_url; ?>">Xóa</a>
	</li>
	<?php endif;?>
	</div>
	<?php endforeach; ?>
</div>
</form>
<div class="topimg_line">Tải ảnh lên</div>
<form action="./template.php?action=upload_top" method="post" enctype="multipart/form-data" >
<div id="topimg_custom">
	<li></li>
	<li>
	<input name="topimg" type="file" />
	<input type="submit" value="Cắt" class="submit" /> (Cắt hình ảnh cho vừa kích thước, cho phép JPG,PNG)
	</li>
</div>
</form>