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
<?php foreach($logs as $value): ?>
<div class="title"><a href="<?php echo BLOG_URL; ?>m/?post=<?php echo $value['logid'];?>"><?php echo $value['log_title']; ?></a></div>
<div class="info"><?php echo gmdate('j-n-Y G:i', $value['date']); ?></div>
<div class="info2">
Nhận xét: <?php echo $value['comnum']; ?> Xem: <?php echo $value['views']; ?>
<?php if(ROLE == 'admin' || $value['author'] == UID): ?>
<a href="./?action=write&id=<?php echo $value['logid'];?>">Viết</a>
<?php endif;?>
</div>
<?php endforeach; ?>
<div id="page"><?php echo $page_url;?></div>
</div>