<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class="containertitle2">
<?php if (ROLE == 'admin'):?>
<a class="navi1" href="./configure.php">Cấu hình</a>
<a class="navi4" href="./style.php">Giao diện</a>
<a class="navi4" href="./permalink.php">Liên kết</a>
<a class="navi2" href="./blogger.php">Thông tin</a>
<?php else:?>
<a class="navi1" href="./blogger.php">Thông tin</a>
<?php endif;?>
<?php if(isset($_GET['active_edit'])):?><span class="actived">Sửa thông tin thành công!</span><?php endif;?>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa ảnh đại diện thành công!</span><?php endif;?>
</div>
<div style="margin-left:20px;">
<form action="blogger.php?action=update" method="post" name="blooger" id="blooger" enctype="multipart/form-data" class="mb-8">
<div>
	<li>Tên</li>
	<li><input maxlength="50" style="width:210px;" value="<?php echo $nickname; ?>" name="name" /></li>
	<li>Email</li>
	<li><input name="email" value="<?php echo $email; ?>" style="width:210px;" maxlength="200" /></li>
	<li><?php echo $icon; ?><input type="hidden" name="photo" value="<?php echo $photo; ?>"/></li>
	<li>Ảnh đại diện (Giới hạn kích thước 120x120 định dạng jpg, png)</li>
	<li><input name="photo" type="file" style="width:245px;" /></li>
	<li>Tự giới thiệu: </li>
	<li><textarea name="description" style="width:300px; height:65px;" type="text" maxlength="500"><?php echo $description; ?></textarea></li>
	<li><input type="submit" value="Cập nhật" class="submit" /></li>
	<li style="margin-top:30px;"><a href="javascript:displayToggle('chpwd', 2);">Nâng cao +</a></li>
</div>
</form>
<form action="blogger.php?action=update_pwd" method="post" name="blooger" id="blooger">
<div id="chpwd">
	<li>Mật khẩu cũ: </li>
	<li><input type="password" maxlength="200" style="width:200px;" value="" name="oldpass" /></li>
	<li>Mật khẩu mới: </li>
	<li><input type="password" maxlength="200" style="width:200px;" value="" name="newpass" /></li>
	<li>Nhập lại mật khẩu: </li>
	<li><input type="password" maxlength="200" style="width:200px;" value="" name="repeatpass" /></li>
	<li>Tài khoản</li>
	<li><input maxlength="200" style="width:200px;" name="username" /></li>
	<li></li>
	<li><input type="submit" value="Đổi mật khẩu" class="submit" /></li>
</div>
</form>
</div>
<script>
$("#chpwd").css('display', $.cookie('em_chpwd') ? $.cookie('em_chpwd') : 'none');
setTimeout(hideActived,2600);
</script>