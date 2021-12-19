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
<?php 
foreach($comment as $value):
	$ishide = ISLOGIN === true && $value['hide']=='y'?'<font color="red" size="1">[Ẩn]</font>':'';
?>
<div class="comcont"><a href="<?php echo BLOG_URL; ?>m/?post=<?php echo $value['gid']; ?>"><?php echo $value['content']; ?></a>
<?php if(ISLOGIN === true): ?>
<a href="./?action=delcom&id=<?php echo $value['cid'];?>"><font size="1">Xóa]</font></a>
<?php endif;?>
</div>
<?php if(ISLOGIN === true): ?>
<div class="info">Thuộc bài: <?php echo $value['title']; ?></div>
<?php endif;?>
<div class="cominfo">
<?php if(ISLOGIN === true && $value['hide'] == 'n'): ?>
<a href="./?action=hidecom&id=<?php echo $value['cid'];?>">Ẩn</a>
<?php elseif(ISLOGIN === true && $value['hide'] == 'y'):?>
<a href="./?action=showcom&id=<?php echo $value['cid'];?>">Hiện</a>
<?php endif;?>
<a href="./?action=reply&cid=<?php echo $value['cid'];?>">Trả lời</a>
<br />
<?php if(ISLOGIN === true): ?>
<?php echo $value['date']; ?> by:<?php echo $value['cname']; ?>
<?php else:?>
bởi: <?php echo $value['name']; ?>
<?php endif;?>
</div>
<?php endforeach; ?>
<div id="page"><?php echo $pageurl;?></div>
</div>