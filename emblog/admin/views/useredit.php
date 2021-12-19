<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Sửa thông tin thành viên</b>
<?php if(isset($_GET['error_login'])):?><span class="error">Hãy nhập tài khoản!</span><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><span class="error">Tài khoản đã tồn tại!</span><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><span class="error">Mật khẩu từ 6 ký tự trở lên!</span><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><span class="error">Hai mật khẩu không phù hợp!</span><?php endif;?>
</div>
<div class=line></div>
<form action="user.php?action=update" method="post">
<div>
	<li>Tài khoản: </li>
	<li><input type="text" value="<?php echo $username; ?>" name="username" style="width:200px;" /></li>
	<li>Nickname: </li>
	<li><input type="text" value="<?php echo $nickname; ?>" name="nickname" style="width:200px;" /></li>
	<li>Mật khẩu: </li>
	<li><input type="password" value="" name="password" style="width:200px;" /> (Để trống nếu không đổi)</li>
	<li>Nhập lại mật khẩu: </li>
	<li><input type="password" value="" name="password2" style="width:200px;" /></li>
	<li>Email: </li>
	<li><input type="text"  value="<?php echo $email; ?>" name="email" style="width:200px;" /></li>
	<li>Tự giới thiệu: </li>
	<li><textarea name="description" rows="5" style="width:260px;"><?php echo $description; ?></textarea></li>
	<li>
	<input type="hidden" value="<?php echo $uid; ?>" name="uid" />
	<input type="submit" value="Lưu" class="submit" />
	<input type="button" value="Quay lại" class="submit" onclick="window.location='user.php';" /></li>
</div>
</form>
<script>
setTimeout(hideActived,2600);
$("#menu_user").addClass('sidebarsubmenu1');
</script>