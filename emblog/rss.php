<?php
/**
 * Xuat RSS
 * @copyright (c) Emlog All Rights Reserved
 * $Id: rss.php 1853 2011-03-15 16:26:45Z emloog $
 */

require_once './init.php';

header('Content-type: application/xml');

$sort = isset($_GET['sort']) ? intval($_GET['sort']) : '';

$URL = BLOG_URL;
$blog = getBlog($sort);
$user_cache = $CACHE->readCache('user');

echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title><![CDATA['.Option::get('blogname').']]></title> 
<description><![CDATA['.Option::get('bloginfo').']]></description>
<link>'.$URL.'</link>
<language>vn-vn</language>
<generator>www.emlog.net</generator>';

foreach($blog as $value){
	$link = Url::log($value['id']);
	$abstract = str_replace('[break]','',$value['content']);
	$pubdate =  gmdate('r',$value['date']);
	$author = $user_cache[$value['author']]['name'];
	doAction('rss_display');
	echo <<< END

<item>
	<title>{$value['title']}</title>
	<link>$link</link>
	<description><![CDATA[{$abstract}]]></description>
	<pubDate>$pubdate</pubDate>
	<author>$author</author>
	<guid>$link</guid>

</item>
END;
}
echo <<< END
</channel>
</rss>
END;

/**
 * Lay thong tin bai viet
 *
 * @return array
 */
function getBlog($sort = null) {
	$DB = MySql::getInstance();
	$subsql = $sort ? "and sortid=$sort" : '';
	$sql = "SELECT * FROM ".DB_PREFIX."blog  WHERE hide='n' and type='blog' $subsql ORDER BY date DESC limit 0," . Option::get('rss_output_num');
	$result = $DB->query($sql);
	$blog = array();
	while ($re = $DB->fetch_array($result))
	{
		$re['id'] 		= $re['gid'];
		$re['title']    = htmlspecialchars($re['title']);
		$re['date']		= $re['date'];
		$re['content']	= $re['content'];
		if(!empty($re['password']))
		{
			$re['content'] = '<p>[Bài viết có mật khẩu]</p>';
		}elseif(Option::get('rss_output_fulltext') == 'n' && !empty($re['excerpt'])){
		    $re['content'] = $re['excerpt'] . '<p><a href="'.Url::log($re['id']).'">Xem chi tiết &gt;&gt;</a></p>';
		}

		$blog[] = $re;
	}
	return $blog;
}
