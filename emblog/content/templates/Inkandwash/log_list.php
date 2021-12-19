<?php 
/*
* Danh sach bai viet
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="content" role="main">
		<div class="content_top conleft"></div>
<?php doAction('index_loglist_top'); ?>
<?php foreach($logs as $value): ?>
			<div class="post hentry" id="post-<?php echo $value['logid']; ?>">
				<h2><?php topflg($value['top']); ?><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
				<div class="post_intro">
					<span><?php blog_author($value['author']); ?>  <?php blog_sort($value['logid']); ?> <?php blog_tag($value['logid']); ?></span>
					<?php editflg($value['logid'],$value['author']); ?>
				</div>
				<div class="content_date">
					<div class="datebg">
						<span class="day"><?php echo gmdate('d', $value['date']); ?></span>
						<span><?php echo gmdate('n', $value['date']); ?></span>
						<span><?php echo gmdate('Y', $value['date']); ?></span>
					</div>
				</div>
				<div class="comments">
					<span class="cmt_num"><a href="<?php echo $value['log_url']; ?>#comment"><?php echo $value['comnum']; ?></a></span>
				</div>

				<div class="entry">
					<?php echo $value['log_description']; ?>
				</div>

			</div>
<?php endforeach; ?>
        <div class="page_navi clear">
			<?php echo $page_url;?>
		</div>
        <div class="content_foot conleft"></div>
    </div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>