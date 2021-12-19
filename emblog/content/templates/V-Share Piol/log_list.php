<?php 
/*
* Danh sach bai viet
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php foreach($logs as $value):?>
	<div id="post-114" class="post-114 post type-post status-publish format-standard hentry category-1 tag-13"> 
	 <?php doAction('index_loglist_top');?>
		<div class="col-top"></div> 
		<div class="col-mid"> 
			<div class="entry-header"> 
				<div class="entry-date"> 
					<span class="entry-month"><?php echo gmdate('m', $value['date']); ?></span> 
					<span class="entry-day"><?php echo gmdate('j', $value['date']); ?></span> 
				</div> 
				<h2 class="entry-title"><?php topflg($value['top']); ?><a href="<?php echo BLOG_URL; ?>?post=<?php echo $value['logid']; ?>"><?php echo $value['log_title'];?></a></h2> 
				<div class="entry-meta"> 
					<span class="comments-link"><?php echo $value['comnum']; ?> nhận xét</span> 
					Viết: <?php blog_author($value['author']); ?> | 
					Lúc: <?php echo gmdate('j-n-Y G:i', $value['date']); ?> | Trong: <?php blog_sort($value['logid']); ?> <?php editflg($logid,$author);?>
				</div> 
			</div> 
			<div class="entry-content"> 
			<?php echo $value['log_description'];?>
			<?php blog_att($value['logid']);?>
			<?php blog_tag($value['logid']); ?>
			</div> 
		</div> 
		<div class="col-btm"></div> 
	</div> 
<?php endforeach; ?>
	<div id="nav-below" class="navigation"> 
		<div class="col-top"></div> 
		<div class="col-mid"> 
		<?php echo $page_url;?>
		</div> 
		<div class="col-btm"></div> 
	</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>
