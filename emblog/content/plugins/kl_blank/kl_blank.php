<?php
/*
Plugin Name: 新窗口打开外链
Version: 1.5
Plugin URL: http://kller.cn/?post=36
Description: 在新窗口中打开非本博客域名下的链接。
Author: KLLER
Author Email: kller@foxmail.com
Author URL: http://kller.cn
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function kl_blank(){
	$active_plugins = Option::get('active_plugins');
	if(!in_array('kl_load_jquery/kl_load_jquery.php', $active_plugins)) echo '<script type="text/javascript" src="'.BLOG_URL.'include/lib/js/jquery/jquery-1.2.6.js"></script>'."\r\n";
	$kl_blank_js = '<script type="text/javascript">jQuery(function($){$("a[href*=://]:not(a[href^='.rtrim(BLOG_URL, '/').'],a[href^=javascript:])").attr("target", "_blank");})</script>'."\r\n";
	echo $kl_blank_js;
}

addAction('index_head', 'kl_blank');