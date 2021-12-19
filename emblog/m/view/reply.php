<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">Trang chủ</a> 
<a href="./?action=tw">Twitter</a> 
<a href="./?action=com" id="active">Nhận xét</a> 
<?php if(ISLOGIN === true): ?>
<a href="./?action=write">Viết</a> 
<a href="./?action=logout">Thoát</a>
<?php else:?>
<a href="<?php echo BLOG_URL; ?>m/?action=login">Đăng nhập</a>
<?php endif;?>
</div>
<div id="m">
	<div class="comcont">Trả lời<b><?php echo $poster; ?></b>:<?php echo $comment; ?></div>
	<form method="post" action="./index.php?action=addcom&gid=<?php echo $gid; ?>&pid=<?php echo $cid; ?>">
	<?php
		if(ISLOGIN == true):
		$CACHE = Cache::getInstance();
		$user_cache = $CACHE->readCache('user');
	?>
	Đăng nhập với tài khoản: <b><?php echo $user_cache[UID]['name']; ?></b><br />
	<input type="hidden" name="comname" value="<?php echo $user_cache[UID]['name']; ?>" />
	<input type="hidden" name="commail" value="<?php echo $user_cache[UID]['mail']; ?>" />
	<input type="hidden" name="comurl" value="<?php echo BLOG_URL; ?>" />
	<?php else: ?>
	Tên<br /><input type="text" name="comname" value="" /><br />
	Email (Bắt buộc)<br /><input type="text" name="commail" value="" /><br />
	Website<br /><input type="text" name="comurl" value="" /><br />
	<?php endif; ?>
	Nội dung<br /><textarea name="comment" rows="10"></textarea><br />
	<?php echo $verifyCode; ?><br /><input type="submit" value="Gửi" />
	</form>
</div>