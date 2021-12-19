<?php 
/*
* Danh sach bai viet
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="content">
<div id="contentleft">
<?php doAction('index_loglist_top'); ?>
<?php foreach($logs as $value): ?>
	<h2><?php topflg($value['top']); ?><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
	<p class="date">Viết bởi <?php blog_author($value['author']); ?> lúc <?php echo gmdate('j-n-Y G:i', $value['date']); ?> 
	<?php blog_sort($value['logid']); ?> 
	<?php editflg($value['logid'],$value['author']); ?>
	</p>
	<?php echo $value['log_description']; ?>
	<p class="att"><?php blog_att($value['logid']); ?></p>
	<p class="tag"><?php blog_tag($value['logid']); ?></p>
	<p class="count">
	<a href="<?php echo $value['log_url']; ?>#comments">Nhận xét (<?php echo $value['comnum']; ?>)</a>
	<a href="<?php echo $value['log_url']; ?>#tb">Trích dẫn (<?php echo $value['tbcount']; ?>)</a>
	<a href="<?php echo $value['log_url']; ?>">Xem (<?php echo $value['views']; ?>)</a>
	</p>
	<div style="clear:both;"></div>
<?php endforeach; ?>

<div id="pagenavi">
	<?php echo $page_url;?>
</div>

</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>