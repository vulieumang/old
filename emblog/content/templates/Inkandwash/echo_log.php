<?php 
/*
* Xem bai viet
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="content" class="widecolumn" role="main">
		<div class="content_top conleft"></div>

		<div class="post hentry" id="post-<?php echo $logid; ?>">
			<h2><?php topflg($top); ?><?php echo $log_title; ?></h2>
				<div class="post_intro">
					<span><?php blog_author($author); ?>  <?php blog_sort($logid); ?> <?php blog_tag($logid); ?></span>
					<?php editflg($logid,$author); ?>
				</div>
				<div class="content_date">
					<div class="datebg">
						<span class="day"><?php echo gmdate('d', $date); ?></span>
						<span><?php echo gmdate('n', $date); ?></span>
						<span><?php echo gmdate('Y', $date); ?></span>
					</div>
				</div>
				<div class="comments">
					<span class="cmt_num"><a href="#comment"><?php echo $comnum; ?></a></span>
				</div>
				
			<div class="entry">
				<?php echo $log_content; ?>
				<?php blog_att($logid); ?>
				<?php neighbor_log($neighborLog); ?>
			</div>
		</div>
		<div style="padding:15px 14px;">
			<?php doAction('log_related', $logData); ?>
		</div>
			<?php blog_comments($comments); ?>
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark);?>
            <div class="content_foot conleft"></div>
        </div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>