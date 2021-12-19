<?php 
/*
* Twitter
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div class="templatemo_post">
<div id="post-114" class="post-114 post type-post status-publish format-standard hentry category-1 tag-13"> 
  <?php doAction('index_loglist_top');?>
		<div class="col-top"></div> 
		<div class="col-mid"> 
			<div class="entry-header"> 
				<h2 class="entry-title">
				<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
				<a href="<?php echo BLOG_URL . 'admin/twitter.php' ?>">Viết twitter</a>
				<?php endif; ?>
				</h2> 
			</div> 
 
				<div class="entry-content"> 
				<?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/' . ADMIN_TPL . '/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    ?>

            <?php echo $val['t'];?></p>
          <div class="clear"></div>
          <div class="bttome">
            <p class="post"><a href="javascript:loadr('<?php echo DYNAMIC_BLOGURL; ?>?action=getr&tid=<?php echo $tid;?>','<?php echo $tid;?>');">Trả lời (<span id="rn_<?php echo $tid;?>"><?php echo $val['replynum'];?></span>)</a></p>
            <p class="time"><?php echo $val['date'];?> </p>
          </div>
          <div class="clear"></div>
          <ul id="r_<?php echo $tid;?>" class="r">
          </ul>
          <div class="huifu" id="rp_<?php echo $tid;?>">
            <textarea cols="100" id="rtext_<?php echo $tid; ?>"></textarea>
            <div class="tbutton">
              <div class="tinfo" style="display:<?php if(ROLE == 'admin' || ROLE == 'writer'){echo 'none';}?>"> Nickname: 
                <input type="text" id="rname_<?php echo $tid; ?>" value="" />
                <span style="display:<?php if($reply_code == 'n'){echo 'none';}?>">Mã xác nhận: 
                <input type="text" id="rcode_<?php echo $tid; ?>" value="" />
                <?php echo $rcode; ?></span> </div>
              <input class="button_p" type="button" onclick="reply('<?php echo DYNAMIC_BLOGURL; ?>?action=reply',<?php echo $tid;?>);" value="Trả lời" />
              <div class="msg"><span id="rmsg_<?php echo $tid; ?>" style="color:#FF0000"></span></div>
            </div>
          </div>
		  <hr>
        <?php endforeach;?>
		<center><?php echo $pageurl;?><span>(Có <?php echo $twnum; ?> twitter)</span></center>
	 </div> 
	
		</div> 
		<div class="col-btm"></div> 
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>
