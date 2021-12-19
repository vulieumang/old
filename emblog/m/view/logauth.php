<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./" id="active">Trang chủ</a> 
<a href="./?action=tw">Twitter</a> 
<a href="./?action=com">Nhận xét</a> 
<?php if(ISLOGIN === true): ?>
<a href="./?action=write">Viết</a> 
<a href="./?action=logout">Thoát</a>
<?php else:?>
<a href="<?php echo BLOG_URL; ?>m/?action=login">Đăng nhập</a>
<?php endif;?>
</div>
<div id="m">
Bài viết có mật khẩu, hãy nhập mật khẩu vào.
<form action="" method="post">
<br /><input type="password" name="logpwd" /> <input type="submit" value="Nhập" />
<br /><br /><a href="./">&laquo; Quay lại</a>
</form>
</div>