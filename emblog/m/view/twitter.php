<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">Trang chủ</a> 
<a href="./?action=tw" id="active">Twitter</a> 
<a href="./?action=com">Nhận xét</a> 
<?php if(ISLOGIN === true): ?>
<a href="./?action=write">Viết</a> 
<a href="./?action=logout">Thoát</a>
<?php else:?>
<a href="<?php echo BLOG_URL; ?>m/?action=login">Đăng nhập</a>
<?php endif;?>
</div>
<div id="m">
<?php if(ISLOGIN === true): ?>
<form method="post" action="./index.php?action=t" >
<input name="t" value="" /> <input type="submit" value="Gửi" />
</form>
<?php endif;?>
<?php 
foreach($tws as $value):
$by = $value['author'] != 1 ? 'by:'.$user_cache[$value['author']]['name'] : '';
?>
<div class="twcont"><?php echo $value['content'];?></a></div>
<div class="twinfo"><?php echo $by.' '.$value['date'];?>
<?php if(ISLOGIN === true && $value['author'] == UID || ROLE == 'admin'): ?>
 <a href="./?action=delt&id=<?php echo $value['id'];?>">Xóa</a>
<?php endif;?>
</div>
<?php endforeach; ?>
<div id="page"><?php echo $pageurl;?></div>
</div>