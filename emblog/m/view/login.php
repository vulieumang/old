<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">Trang chủ</a> 
<a href="./?action=tw">Twitter</a> 
<a href="./?action=com">Nhận xét</a> 
<?php if(ISLOGIN === true): ?>
<a href="./?action=write">Viết</a> 
<a href="./?action=logout">Thoát</a>
<?php else:?>
<a href="<?php echo BLOG_URL; ?>m/?action=login" id="active">Đăng nhập</a>
<?php endif;?>
</div>
<div id="m">
	<form method="post" action="./index.php?action=auth">
		Tài khoản: <br />
	    <input type="text" name="user" /><br />
	    Mật khẩu: <br />
	    <input type="password" name="pw" /><br />
	    <?php echo $ckcode; ?>
	    <br /><input type="submit" value="Đăng nhập" />
	</form>
</div>