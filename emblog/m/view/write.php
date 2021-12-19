<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">Trang chủ</a> 
<a href="./?action=tw">Twitter</a> 
<a href="./?action=com">Nhận xét</a> 
<?php if(ISLOGIN === true): ?>
<a href="./?action=write" id="active">Viết</a> 
<a href="./?action=logout">Thoát</a>
<?php else:?>
<a href="<?php echo BLOG_URL; ?>m/?action=login">Đăng nhập</a>
<?php endif;?>
</div>
<div id="m">
<form action="./index.php?action=savelog" method="post">
Tiêu đề: <br /><input type="text" name="title" value="<?php echo $title; ?>" /><br />
Phân loại: <br />
	      <select name="sort" id="sort">
			<?php
			$sorts[] = array('sid'=>-1, 'sortname'=>'Hãy chọn...');
			foreach($sorts as $val):
			$flg = $val['sid'] == $sortid ? 'selected' : '';
			?>
			<option value="<?php echo $val['sid']; ?>" <?php echo $flg; ?>><?php echo $val['sortname']; ?></option>
			<?php endforeach; ?>
	      </select>
<br />
Nội dung: <br /><textarea name="content" class="texts"><?php echo $content; ?></textarea><br />
Trích dẫn: <br /><textarea name="excerpt" class="excerpt"><?php echo $excerpt; ?></textarea><br />
Tags: <br /><input type="text" name="tag" value="<?php echo $tagStr; ?>" /><br />
<input type="hidden" name="gid" value=<?php echo $logid; ?> />
<input type="hidden" name="author" value=<?php echo $author; ?> />
<input name="date" type="hidden" value="<?php print !empty($date) ? gmdate('d-m-Y H:i:s', $date) : ''; ?>" />
<input type="submit" value="Gửi" />
</form>
</div>
