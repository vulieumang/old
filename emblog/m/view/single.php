<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./"  id="active">Trang chủ</a> 
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
	<div class="posttitle"><?php echo $log_title; ?></div>
	<div class="postinfo">Gửi bởi: <?php echo $user_cache[$author]['name'];?> <?php echo gmdate('j-n-Y G:i', $date); ?>
	<?php if(ROLE == 'admin' || $author == UID): ?>
	<a href="./?action=dellog&gid=<?php echo $logid;?>">Xóa</a>
	<?php endif;?>
	</div>
	<div class="postcont"><?php echo $log_content; ?></div>
	<div class="t">Nhận xét:</div>
	<div class="c">
		<?php foreach($comments as $key=>$value):
			$value['poster'] = $value['url'] ? '<a href="'.$value['url'].'" target="_blank">'.$value['poster'].'</a>' : $value['poster'];
		?>
		<div class="l">
		<b><?php echo $value['poster']; ?></b>
		<div class="info"><?php echo $value['date']; ?> <a href="./?action=reply&cid=<?php echo $value['cid'];?>">Trả lời</a></div>
		<div class="comcont"><?php echo $value['content']; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="t">Nhận xét: </div>
	<div class="c">
		<form method="post" action="./index.php?action=addcom&gid=<?php echo $logid; ?>">
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
</div>