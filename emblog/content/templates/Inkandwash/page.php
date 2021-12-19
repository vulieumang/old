<?php 
/*
* Trang
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
	<div id="content" class="narrowcolumn" role="main">
		<div class="content_top conleft"></div>
		<div class="post" id="post-<?php echo $logid; ?>">
		<h2><?php echo $log_title; ?></h2>
			<div class="entry">
				<?php echo $log_content; ?>
				<?php blog_att($logid); ?>
			</div>
		</div>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	<div class="content_foot conleft clear"></div>
	</div>
<?php 
include View::getView('side');
include View::getView('footer');
?>