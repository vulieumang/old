<?php 
/*
* Xem bai viet
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div class="templatemo_post">
<div id="post-114" class="post-114 post type-post status-publish format-standard hentry category-1 tag-13"> 
		<div class="col-top"></div> 
		<div class="col-mid"> 
			<div class="entry-header"> 
				<div class="entry-date"> 
					<span class="entry-month"><?php echo gmdate('m', $date); ?></span> 
					<span class="entry-day"><?php echo gmdate('j', $date); ?></span> 
				</div> 
				<h2 class="entry-title"><?php topflg($value['top']); ?><?php echo $log_title; ?></a></h2> 
				<div class="entry-meta"> 
					<span class="comments-link"><?php echo $comnum; ?> nhận xét</span> 
					Viết: <?php blog_author($author); ?> | 
					Lúc: <?php echo gmdate('j-n-Y G:i', $date); ?> | Trong: <?php blog_sort($sortid, $logid);?> <?php editflg($logid,$author);?>
					</div> 
			</div> 
 
				<div class="entry-content"> 
				<?php echo $log_content;?>
    <?php blog_att($logid);?>
    <br />
    <?php blog_tag($logid); ?>
    <br />
    <?php doAction('log_related');?>
    <br />
	<center> <?php neighbor_log($neighborLog); ?></center>
	<?php blog_trackback($tb, $tb_url, $allow_tb); ?>
	 </div> 
	
		</div> 
		<div class="col-btm"></div> 
	</div> 



	<div id="post-114" class="post-114 post type-post status-publish format-standard hentry category-1 tag-13"> 
		<div class="col-top"></div> 
		<div class="col-mid"> 

 
				<div class="entry-content"> 
					<?php blog_comments($comments); ?>

					<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>

	 </div> 
	
		</div> 
		<div class="col-btm"></div> 
	</div> 

 
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>