<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Trả lời nhận xét</b>
</div>
<div class=line></div>
<form action="comment.php?action=doreply" method="post">
<div>
	<li>Người gửi: <?php echo $poster; ?></li>
	<li>Ngày gửi: <?php echo $date; ?></li>
	<li>Nội dung: <?php echo $comment; ?></li>
	<li><textarea name="reply" rows="5" cols="60"></textarea></li>
	<li>
	<input type="hidden" value="<?php echo $commentId; ?>" name="cid" />
	<input type="hidden" value="<?php echo $gid; ?>" name="gid" />
	<input type="hidden" value="<?php echo $hide; ?>" name="hide" />
	<input type="submit" value="Trả lời" class="submit" />
	<?php if ($hide == 'y'): ?>
	    <input type="submit" value="Trả lời" name="pub_it" class="submit" />
	<?php endif; ?>
	<input type="button" value="Quay lại" class="submit" onclick="javascript: window.history.back();"/></li>
</div>
</form>
<script>
$("#menu_cm").addClass('sidebarsubmenu1');
</script>