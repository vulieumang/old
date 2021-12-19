<?php
/*
Plugin Name: highslide
Version: 2.0
Plugin URL: http://kller.cn/?post=43
Description: 给博客中的图片添加highslide效果。
Author: KLLER
Author Email: kller@foxmail.com
Author URL: http://kller.cn
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function kl_highslide()
{
	if(isset($_GET['plugin']) && $_GET['plugin'] == 'kl_album') return;

	$path = '';
	if(isset($_SERVER['REQUEST_URI']))
	{
		$path = $_SERVER['REQUEST_URI'];
	}else{
		if(isset($_SERVER['argv']))
		{
			$path = $_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0];
		}else{
			$path = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
	}
	//for ie6 header location
	$r = explode('#', $path, 2);
	$path = $r[0];
	//for iis6
	$path = str_replace('index.php', '', $path);
	//for subdirectory
	$t = parse_url(BLOG_URL);
	$path = str_replace($t['path'], '/', $path);
	if($path == '/t/') return;

	$data = ob_get_contents();
	$dataArr = array();
	$search_pattern = "%<a([^>]*?)href=\"[^\"]*?(jpg|gif|png|jpeg|bmp)\"([^>]*?)>.*?</a>%s";
	preg_match_all($search_pattern, $data, $dataArr, PREG_PATTERN_ORDER);
	if(empty($dataArr[0])) return;

	$active_plugins = Option::get('active_plugins');
	if(!in_array('kl_load_jquery/kl_load_jquery.php', $active_plugins))	echo '<script type="text/javascript" src="'.BLOG_URL.'include/lib/js/jquery/jquery-1.2.6.js"></script>'."\r\n";
	echo '<link href="'.BLOG_URL.'content/plugins/kl_highslide/highslide/highslide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="'.BLOG_URL.'content/plugins/kl_highslide/highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = "'.BLOG_URL.'content/plugins/kl_highslide/highslide/graphics/";
    hs.outlineType = "rounded-white";
    jQuery(function($){$("a[href$=jpg],a[href$=gif],a[href$=png],a[href$=jpeg],a[href$=bmp]").addClass("highslide").each(function(){this.onclick=function(){return hs.expand(this)}});})
</script>'."\r\n";
}

addAction('index_footer', 'kl_highslide');