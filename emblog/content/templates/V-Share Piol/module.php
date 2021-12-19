<?php 
/*
* Cot ben. module
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
// Widget: Thong tin
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg" align="center">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p align="center"><b><?php echo $name; ?></b><br>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
<?php }?>
<?php
// Widget: Lich
function widget_calendar($title){ ?>
  <h3><span onclick="showhidediv('calendar')"><?php echo $title; ?></span></h3>
  <div id="calendar" align="center"> </div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
<?php }?>
<?php
// Widget: Tag
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
  <h3><span onclick="showhidediv('blogtags')"><?php echo $title; ?></span></h3>
      <?php foreach($tag_cache as $value): ?>
      <span style="font-size:<?php echo $value['fontsize']; ?>pt; height:30px;"> <a href="<?php echo BLOG_URL; ?>?tag=<?php echo $value['tagurl']; ?>" title="<?php echo $value['usenum']; ?> tag"><?php echo $value['tagname']; ?></a></span>
      <?php endforeach; ?>

<?php }?>
<?php
// Widget: Phan loai
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
  <h3><span onclick="showhidediv('blogsort')"><?php echo $title; ?></span></h3>
    <?php foreach($sort_cache as $value): ?>
    <li style="list-style: none;"> <a href="<?php echo BLOG_URL; ?>?sort=<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a> <a href="<?php echo BLOG_URL; ?>rss.php?sort=<?php echo $value['sid']; ?>"><img align="absmiddle" src="<?php echo TEMPLATE_URL; ?>images/rss_icon.png" alt="Xem RSS"/></a> </li>
    <?php endforeach; ?>
<?php }?>
<?php
// Widget: Twitter
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<h3><span onclick="showhidediv('blogsort')"><?php echo $title; ?></span></h3>
	<ul>
	<?php foreach($newtws_cache as $value): ?>
	<li><?php echo $value['t']; ?><p> <?php echo smartDate($value['date']); ?> </p></li>
    <?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p align="right"><a href="<?php echo BLOG_URL . 't/'; ?>">Xem thêm &raquo;</a></p>
	<?php endif;?>
	</ul>
<?php }?>
<?php
// Widget: Binh luan moi
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
  <h3><?php echo $title; ?></h3>
  <ul>
    <?php
	foreach($com_cache as $value):
	$url = BLOG_URL.'?post='.$value['gid'].'#'.$value['cid'];
	?>
    <li><?php echo $value['name']; ?>
      <?php if($value['reply']): ?>
      <a href="<?php echo $url; ?>" title="Trả lời: <?php echo $value['reply']; ?>"> <img src="<?php echo TEMPLATE_URL; ?>images/reply.gif" align="absmiddle"/> </a>
      <?php endif;?>
      <br />
      <a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
    <?php endforeach; ?>
	</ul>
<?php }?>
<?php
// Widget: Bai moi
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
  <h3><span onclick="showhidediv('newlog')"><?php echo $title; ?></span></h3>
  <ul id="newlog">
    <?php foreach($newLogs_cache as $value): ?>
    <li><a href="<?php echo BLOG_URL; ?>?post=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a></li>
    <?php endforeach; ?>
  </ul>
<?php }?>
<?php
// Widget: Bai ngau nhien
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
	<?php foreach($randLogs as $value): ?>
	 <li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
// Widget: Tim kiem
function widget_search($title){ ?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logserch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>">
	<input name="keyword"  type="text" value="" style="width:120px;"/>
	<input type="submit" id="logserch_logserch" value="Tìm" />
	</form>
	</ul>
<?php } ?>
<?php
// Widget: Luu tru
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
<?php } ?>
<?php
// Widget: Tu dat
function widget_custom_text($title, $content){ ?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
<?php } ?>
<?php
// Widget: Lien ket
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
// Blog: TOP
function topflg($istop){
	$topflg = $istop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/import.gif\" title=\"Bài viết TOP\" /> " : '';
	echo $topflg;
}
?>
<?php
// Blog: Chinh Sua
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? ' - <a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">Sửa bài</a>' : '';
	echo $editflg;
}
?>
<?php
// Blog: Phan loai
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
// Blog: File dinh kem
function blog_att($blogid){
	global $CACHE;
	$log_cache_atts = $CACHE->readCache('logatts');
	$att = '';
	if(!empty($log_cache_atts[$blogid])){
		$att .= '<br><b>File đính kèm:</b>';
		foreach($log_cache_atts[$blogid] as $val){
			$att .= '<br /><a href="'.BLOG_URL.$val['url'].'" target="_blank">'.$val['filename'].'</a> - '.$val['size'];
		}
	}
	echo $att;
}
?>
<?php
// Blog: Tag
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<br><b>Tags:</b>';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
// Blog: Tac gia
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
// Blog: Bai lien quan
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a> &raquo;
	<?php endif;?>
<?php }?>
<?php
// Blog: Trich dan
function blog_trackback($tb, $tb_url, $allow_tb){
    if($allow_tb == 'y' && Option::get('istrackback') == 'y'):?>
	<div id="trackback_address">
	<p align="center">Trích dẫn: <input type="text" style="width:90%" class="input" value="<?php echo $tb_url; ?>">
	<a name="tb"></a></p>
	</div>
	<?php endif; ?>
	<?php foreach($tb as $key=>$value):?>
		<ul id="trackback">
		<li><a href="<?php echo $value['url'];?>" target="_blank"><?php echo $value['title'];?></a></li>
		<li>BLOG: <?php echo $value['blog_name'];?></li><li><?php echo $value['date'];?></li>
		</ul>
	<?php endforeach; ?>
<?php }?>
<?php
// Blog: Binh luan
function blog_comments($comments){
    if($comments): ?>
	<p class="comment-header"><b>Nhận xét:</b><a name="comments"></a></p>
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($comments as $key=>$comment):
	if($comment['pid'] != 0) continue;
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><?php endif; ?>
		<div class="comment-body">
			<b><?php echo $comment['poster']; ?> </b> (<span class="comment-time"><?php echo $comment['date']; ?></span>)
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">Trả lời</a></div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
// Blog: Binh luan con
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><?php endif; ?>
		<div class="comment-info" style="padding-left: 30px;">
			|- <b><?php echo $comment['poster']; ?> </b> (<span class="comment-time"><?php echo $comment['date']; ?></span>)
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">Trả lời</a></div><?php endif; ?>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
// Blog: Gui binh luan
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<hr>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">Hủy</a></div>
		<p class="comment-header"><b>Viết nhận xét</b><a name="respond"></a></p>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == 'visitor'): ?>
			<p>
				<input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1">
				<label for="author"><small>Tên: </small></label>
			</p>
			<p>
				<input type="text" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2">
				<label for="email"><small>Email (Bắt buộc)</small></label>
			</p>
			<p>
				<input type="text" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3">
				<label for="url"><small>Website</small></label>
			</p>
			<?php endif; ?>
			<p><textarea name="comment" id="comment" style="width: 100%;" rows="5" tabindex="4"></textarea></p><br>
			<p><?php echo $verifyCode; ?> <input type="submit" id="comment_submit" value="Gửi nhận xét" /></p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>