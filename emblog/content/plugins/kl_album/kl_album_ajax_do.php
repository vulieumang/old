<?php
/**
 * kl_data_call_setting.php
 * design by KLLER
 */
require_once('../../../init.php');
$DB = MySql::getInstance();
$navibar = Option::get('navibar');
if(isset($_POST['album']) && $_FILES['Filedata']){
	if(function_exists('ini_get')){
		$kl_album_memory_limit = ini_get('memory_limit');
		$kl_album_memory_limit = substr($kl_album_memory_limit, 0, strlen($kl_album_memory_limit)-1);
		$kl_album_memory_limit = ($kl_album_memory_limit+20).'M';
		ini_set('memory_limit', $kl_album_memory_limit);
	}
	define('KL_UPLOADFILE_MAXSIZE', kl_album_get_upload_max_filesize());
	define('KL_UPLOADFILE_PATH', '../../../content/plugins/kl_album/upload/');
	define('KL_IMG_ATT_MAX_W',	100);//图片附件缩略图最大宽
	define('KL_IMG_ATT_MAX_H',	100);//图片附件缩略图最大高
	$att_type = array('jpg', 'jpeg', 'png', 'gif');//允许上传的文件类型
	$album = isset($_POST['album']) ? intval($_POST['album']) : '';
	if($_FILES['Filedata']['error'] != 4){
		$upfname = klUploadFile($_FILES['Filedata']['name'], $_FILES['Filedata']['error'], $_FILES['Filedata']['tmp_name'], $_FILES['Filedata']['size'], $_FILES['Filedata']['type'], $att_type);
		$DB->query("INSERT INTO ".DB_PREFIX."kl_album(truename, filename, description, album, addtime) VALUES('".$_FILES['Filedata']['name']."', '".$upfname."', '".date('Y-m-d', time())."', $album, ".time().")");
	}
	exit;
}
if(ROLE != 'admin') exit('access deined!');
if(isset($_GET['action']) && $_GET['action']!=''){
	switch (trim($_GET['action'])){
		case 'edit':
			$id = intval($_GET['id']);
			$tn = addslashes(trim($_GET['tn']));
			$d = addslashes(trim($_GET['d']));
			$result = $DB->query('update '.DB_PREFIX."kl_album set truename='{$tn}', description='{$d}' where id={$id}");
			if($result) echo 'kl_album_successed';
			break;
		case 'del':
			$ids = addslashes(trim($_GET['ids']));
			$id_arr = explode('|', substr($ids, 0, strlen($ids)-1));
			$reids = '';
			foreach($id_arr as $id){
				$query = $DB->query("select * from ".DB_PREFIX."kl_album where id=$id");
				$photo = $DB->fetch_row($query);
				@unlink('../../'.str_replace('thum-', '', $photo[2]));
				@unlink('../../'.$photo[2]);
				$result = $DB->query('delete from '.DB_PREFIX."kl_album where id={$id}");
				if($result) $reids .= $id.'|';
			}
			//如果说移动的相片是某相册封面则删除
			$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			foreach ($kl as $key => $val){
				if($kl[$key]['head'] = $id) unset($kl[$key]['head']);
			}
			$kl_album_info = serialize($kl);
			$DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
			echo $reids;
			break;
		case 'move':
			$ids = addslashes(trim($_GET['ids']));
			$id_arr = explode('|', substr($ids, 0, strlen($ids)-1));
			$reids = '';
			if(trim($_GET['newalbum']) === '') exit('未获取到相册名称');
			$newalbum = intval($_GET['newalbum']);
			foreach($id_arr as $id){
				$result = $DB->query("update ".DB_PREFIX."kl_album set album={$newalbum} where id={$id}");
				if($result) $reids .= $id.'|';
			}
			//如果说移动的相片是某相册封面则删除
			$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			foreach ($kl as $key => $val){
				if($kl[$key]['head'] = $id) unset($kl[$key]['head']);
			}
			$kl_album_info = serialize($kl);
			$DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
			echo $reids;
			break;
		case 'setHead':
			if(trim($_GET['album']) === '') exit('未获取到相册名称');
			$id = intval($_GET['id']);
			$album = intval($_GET['album']);
			$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			foreach ($kl as $key => $val){
				if($val['addtime'] == $album) $kl[$key]['head'] = $id;
			}
			$kl_album_info = serialize($kl);
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
			if($result) echo 'kl_album_successed';
			break;
		case 'album_edit':
			$key = intval($_GET['key']);
			$n = addslashes(trim($_GET['n']));
			$d = addslashes(trim($_GET['d']));
			$r = addslashes(trim($_GET['r']));
			$p = isset($_GET['p']) ? addslashes(trim($_GET['p'])) : '';
			$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			$kl[$key]['name'] = $n;
			$kl[$key]['description'] = $d;
			$kl[$key]['restrict'] = $r;
			$kl[$key]['pwd'] = $p;
			$kl_album_info = addslashes(serialize($kl));
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
			if($result) echo json_encode(array('Y', $r));
			break;
		case 'album_del':
			$album = intval($_GET['album']);
			$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
			$row = $DB->fetch_row($query);
			$kl = unserialize($row[2]);
			foreach ($kl as $key => $val){
				$album = intval($_GET['album']);
				if($val['addtime'] == $album) unset($kl[$key]);
			}
			$kl = array_values($kl);
			$kl_album_info = addslashes(serialize($kl));
			$DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
			$delquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album={$album}");
			while($delrow = $DB->fetch_array($delquery)){
				@unlink('../../'.$delrow['filename']);
				@unlink('../../'.str_replace('thum-', '', $delrow['filename']));
			}
			$result = $DB->query("DELETE FROM ".DB_PREFIX."kl_album WHERE album={$album}");
			echo 'kl_album_successed';
			break;
		case 'album_create':
			if($_GET['is_create'] == 'Y'){
				$kl_album_arr['name'] = '新相册';
				$kl_album_arr['description'] = date('Y-m-d', time());
				$kl_album_arr['restrict'] = 'public';
				$kl_album_arr['addtime'] = time();
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
				if($DB->num_rows($query) > 0){
					$row = $DB->fetch_row($query);
					$kl = unserialize($row[2]);
					array_push($kl, $kl_album_arr);
					$kl_album_info = addslashes(serialize($kl));
					$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='$kl_album_info' where option_name='kl_album_info'");
				}else{
					$kl = array();
					array_push($kl, $kl_album_arr);
					$kl_album_info = addslashes(serialize($kl));
					$result = $DB->query("INSERT INTO ".DB_PREFIX."options(option_name, option_value) VALUES('kl_album_info', '$kl_album_info')");
				}
				if($result) echo 'kl_album_successed';
			}
			break;
		case 'set_navibar':
			$kl_album_navibar_name = trim($_GET['kl_album_navibar_name']) != '' ? kl_album_addslashes(trim($_GET['kl_album_navibar_name'])) : '相册';
			$navibar['kl_album']['title'] = $kl_album_navibar_name;
			$navibar['kl_album']['url'] = BLOG_URL.'?plugin=kl_album';
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
			$CACHE->updateCache('options');
			if($result) echo json_encode(array('Y', $kl_album_navibar_name));
			break;
		case 'is_hide':
			$is_hide = addslashes(trim($_GET['is_hide']));
			$navibar['kl_album']['hide'] = $is_hide;
			$navibar['kl_album']['url'] = BLOG_URL.'?plugin=kl_album';
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
			$CACHE->updateCache('options');
			if($result) echo 'kl_album_successed';
			break;
		case 'set_num_rows':
			$kl_album_num_rows = trim($_GET['kl_album_num_rows']) != '' ? intval(trim($_GET['kl_album_num_rows'])) : 20;
			$navibar['kl_album']['num_rows'] = $kl_album_num_rows;
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
			$CACHE->updateCache('options');
			if($result) echo json_encode(array('Y', $kl_album_num_rows));
			break;
		case 'set_compression_size':
			$kl_album_compression_length = trim($_GET['kl_album_compression_length']) != '' ? intval(trim($_GET['kl_album_compression_length'])) : 1024;
			$kl_album_compression_width = trim($_GET['kl_album_compression_width']) != '' ? intval(trim($_GET['kl_album_compression_width'])) : 768;
			$navibar['kl_album']['compression_length'] = $kl_album_compression_length;
			$navibar['kl_album']['compression_width'] = $kl_album_compression_width;
			$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
			$CACHE->updateCache('options');
			if($result) echo json_encode(array('Y', $kl_album_compression_length, $kl_album_compression_width));
			break;
		case 'remove':
			$remove = $_GET['remove'];
			if($remove == 'Y'){
				$DB->query("DROP TABLE IF EXISTS `".DB_PREFIX."kl_album`");
				$DB->query("DELETE FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
				unset($navibar['kl_album']);
				$DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
				$CACHE->updateCache('options');
				echo 'kl_album_successed';
			}
			break;
		case 'init':
			$create = $_GET['create'];
			if($create == 'Y'){
				$is_exist_album_query = $DB->query('show tables like "'.DB_PREFIX.'kl_album"');
				if($DB->num_rows($is_exist_album_query) == 0){
					$dbcharset = 'utf8';
					$type = 'MYISAM';
					$add = $DB->getMysqlVersion() > '4.1' ? "ENGINE=".$type." DEFAULT CHARSET=".$dbcharset.";":"TYPE=".$type.";";
					$sql = "
CREATE TABLE `".DB_PREFIX."kl_album` (
`id` int(10) unsigned NOT NULL auto_increment,
`truename` varchar(255) NOT NULL,
`filename` varchar(255) NOT NULL,
`description` text,
`album` varchar(255) NOT NULL,
`addtime` int(10) NOT NULL default '0',
PRIMARY KEY  (`id`)
)".$add;
					$DB->query($sql);
				}
				if(!isset($navibar['kl_album'])){
					$navibar['kl_album'] = array('title'=>'相册', 'url'=>BLOG_URL.'?plugin=kl_album', 'is_blank'=>'_parent', 'hide'=>'n');
					$DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
					$CACHE->updateCache('options');
				}
				echo 'kl_album_successed';
			}
			break;
		default:
			break;
	}
}
?>