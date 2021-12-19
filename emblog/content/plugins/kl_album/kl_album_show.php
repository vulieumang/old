<?php
!defined('EMLOG_ROOT') && exit('access deined!');
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
global $CACHE;
$options_cache = $CACHE->readCache('options');
$navibar = unserialize($options_cache['navibar']);
$DB = MySql::getInstance();
$blogname = Option::get('blogname');
$bloginfo = Option::get('bloginfo');
$blogtitle = Option::get('blogname');
$description = Option::get('bloginfo');
$site_key = Option::get('site_key');
$istwitter = Option::get('istwitter');
$comments = array('commentStacks'=>array(), 'commentPageUrl'=>'');
$ckname = $ckmail = $ckurl = $verifyCode = false;
$icp = Option::get('icp');
$footer_info = Option::get('footer_info');

if(isset($navibar['kl_album'])){
	if($navibar['kl_album']['hide'] == 'y') emMsg('不存在的页面！');
	//显示相册列表
	if($album === ''){
		$log_title = '';
		$log_content = '';
		$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
		if($DB->num_rows($query) == 0){
			$log_content = "还没有创建相册！";
		}else{
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			krsort($kl);
			$query1 = $DB->query("select a.* from (select album, addtime, id from ".DB_PREFIX."kl_album order by album, addtime desc, id desc) a group by album");
			$new_str_arr = array();
			while($row1 = $DB->fetch_array($query1)){
				$new_str_arr[$row1['album']] = time() - $row1['addtime'] < 3600*24*15 ? ' background:url(./content/plugins/kl_album/images/new.gif) no-repeat;' : '';
			}
			$log_content =	'<div id="kl_album_list"><ul style="list-style: none; font-size:12px;color: #666666;float:left;margin:3px;padding:0px;text-align:center;">';
			foreach ($kl as $val){
				if($val['name'] == '') continue;
				if(ROLE != 'admin'){
					if($val['restrict'] == 'private') continue;
				}
				if($val['restrict'] == 'private'){
					$coverPath = 'images/only_me.jpg';
				}else{
					if(isset($val['head']) && $val['head'] != 0){
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE id={$val['head']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_row($iquery);
							$coverPath = substr($irow[2], strpos($irow[2], 'upload/'), strlen($irow[2])-strpos($irow[2], 'upload/'));
						}else{
							$coverPath = 'images/no_cover_s.jpg';
						}
					}else{
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album={$val['addtime']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_array($iquery);
							$coverPath = substr($irow['filename'], strpos($irow['filename'], 'upload/'), strlen($irow['filename'])-strpos($irow['filename'], 'upload/'));
						}else{
							$coverPath = 'images/no_cover_s.jpg';
						}
					}
				}
				$log_content .=	'
<li style="display:inline; width:130px; height:180px; float:left; margin: 5px 5px 5px; border:1px solid #ccc;padding:0px;">
<table border="0" style="border:0px solid #CCC;width:130px;">
<tr><td style="border:0px solid #CECECE; height:125px; vertical-align:middle; text-align:center; padding:0px;'.$new_str_arr[$val['addtime']].'"><a href="./?plugin=kl_album&album='.$val['addtime'].'" title="'.$val['description'].'"><img style="border:0px; padding:5px 5px 5px;" src="./content/plugins/kl_album/'.$coverPath.'"></a></td></tr>
<tr><td style="border:0px; height:20px;padding:0px; vertical-align:middle; text-align:center;">'.$val['name'].'</td></tr>
</table>
</li>';
			}
			$log_content .=	'</ul></div>';
		}

		addAction('index_head', 'kl_album_show_js');
		$allow_remark = 'n';
		$logid = '';

		include View::getView('header');
		include View::getView('page');
	}
	//显示单个相册里的照片
	if($album !== ''){
		$log_title = '';
		$log_content = '';
		$qu = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
		$row = $DB->fetch_row($qu);
		$kl = unserialize($row[2]);
		$exist_album = false;
		if(is_array($kl)){
			foreach ($kl as $val){
				if($val['addtime'] == $album){
					$albumrestrict = $val['restrict'];
					$albumname = $val['name'];
					$albumpwd = isset($val['pwd']) ? $val['pwd'] : '';
					$exist_album = true;
				}
			}
			if($exist_album === false || ($albumrestrict == 'private' && ROLE != 'admin')){
				$log_content .= '不存在的相册';
			}else{
				if($albumrestrict == 'protect' && ROLE != 'admin'){
					$postpwd = isset($_POST['albumpwd']) ? addslashes(trim($_POST['albumpwd'])) : '';
					$cookiepwd = isset($_COOKIE['kl_albumpwd_'.$album]) ? addslashes(trim($_COOKIE['kl_albumpwd_'.$album])) : '';
					kl_album_AuthPassword($postpwd, $cookiepwd, $albumpwd, $album, BLOG_URL.'?plugin=kl_album', 'kl_albumpwd_');
				}
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album=$album ORDER BY id DESC");
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$page_all_no = $DB->num_rows($query);
				$page_num = isset($navibar['kl_album']['num_rows']) ? $navibar['kl_album']['num_rows'] : 20;
				$pageurl =  pagination($page_all_no, $page_num, $page, './?plugin=kl_album&album='.$album.'&page=');
				$start_num = !empty($page) ? ($page - 1) * $page_num : 0;
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album=$album ORDER BY id DESC LIMIT $start_num, $page_num");
				$photos = array();
				$log_content .= '
<div style="text-align:left; font-size:12px; padding:0px 20px;"> <a href="./?plugin=kl_album">&laquo;返回相册列表</a></div>
<div id="kl_album_photo_list" style="height:auto!important;min-height:150px;height:150px;margin-bottom:20px;"><ul style="list-style: none; font-size:12px;color: #666666;float:left;margin:5px; padding:0px; text-align:center;">';
				while($photo = $DB->fetch_array($query)){
					$log_content .=	'
<li style=" border:1px solid #CCC;display:inline; width:110px; height:120px; float:left; padding:5px; margin:10px 5px 5px;">
<a href="'.str_replace('thum-', '', substr($photo['filename'], 1, strlen($photo['filename']))).'" title="相片名称：'.$photo['truename'].'　相片描述：'.$photo['description'].'">
<img style="border:0px; padding:5px 5px 5px;" src="'.substr($photo['filename'], 1, strlen($photo['filename'])).'" /></a>
</li>';
				}
				$log_content .= '</ul></div><div id="pagenavi">'.$pageurl.'<span>(共有'.$page_all_no.'张相片)</span></div>';
			}
		}else{
			$log_content .= '参数错误。';
		}

		$allow_remark = 'n';
		$logid = '';

		addAction('index_head', 'kl_album_show_js');

		include View::getView('header');
		include View::getView('page');
	}
}else{
	emMsg('不存在的页面！');
}

function kl_album_show_js(){
	$active_plugins = Option::get('active_plugins');
	if(!in_array('kl_load_jquery/kl_load_jquery.php', $active_plugins)) echo '<script type="text/javascript" src="'.BLOG_URL.'include/lib/js/jquery/jquery-1.2.6.js"></script>'."\r\n";
	echo '<script type="text/javascript" src="./content/plugins/kl_album/js/jquery.lazyload.mini.js"></script>
<script type="text/javascript" src="./content/plugins/kl_album/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="./content/plugins/kl_album/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
jQuery(function($){
$(\'img\').lazyload({effect:\'fadeIn\',placeholder:\'./content/plugins/kl_album/images/grey.gif\',threshold:200});
$(\'#kl_album_photo_list a\').lightBox();
$(\'#kl_album_list img, #kl_album_photo_list img\').mouseover(function(){ $(this).css(\'border\', \'1px solid green\')});
$(\'#kl_album_list img, #kl_album_photo_list img\').mouseout(function(){ $(this).css(\'border\', \'0px\')});
});
</script>';
}
?>