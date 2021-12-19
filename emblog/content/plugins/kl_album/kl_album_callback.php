<?php
function callback_init()
{
	global $CACHE;
	$DB = MySql::getInstance();
	$navibar = Option::get('navibar');

	$is_exist_album_query = $DB->query('show tables like "'.DB_PREFIX.'kl_album"');
	if($DB->num_rows($is_exist_album_query) == 0)
	{
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
	if(!isset($navibar['kl_album']))
	{
		$navibar['kl_album'] = array('title'=>'相册', 'url'=>BLOG_URL.'?plugin=kl_album', 'is_blank'=>'_parent', 'hide'=>'n');
		$DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
		$CACHE->updateCache('options');
	}

	kl_album_callback_do('n');
}

function callback_rm()
{
	kl_album_callback_do('y');
}

function kl_album_callback_do($hide)
{
	global $CACHE;
	$DB = MySql::getInstance();
	$navibar = Option::get('navibar');
	if(!isset($navibar['kl_album'])) return;
	$navibar['kl_album']['hide'] = $hide;
	$navibar['kl_album']['url'] = BLOG_URL.'?plugin=kl_album';
	$result = $DB->query("UPDATE ".DB_PREFIX."options SET option_value='".serialize($navibar)."' where option_name='navibar'");
	$CACHE->updateCache('options');
}
?>