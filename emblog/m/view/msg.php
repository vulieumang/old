<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">Trang chủ</a> 
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
<div><?php echo $msg;?></div>
<div><a href="<?php echo $url; ?>">Quay lại</a></div>
</div>