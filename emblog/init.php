<?php
/**
 * Nap cac muc
 * @copyright (c) Emlog All Rights Reserved
 * $Id: init.php 1907 2011-04-09 11:11:06Z emloog $
 */

error_reporting(7);
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
header('Content-Type: text/html; charset=UTF-8');

define('EMLOG_ROOT', dirname(__FILE__));

require_once EMLOG_ROOT.'/config.php';
require_once EMLOG_ROOT.'/include/lib/function.base.php';
require_once EMLOG_ROOT.'/include/lib/function.login.php';

doStripslashes();

$CACHE = Cache::getInstance();

$userData = array();

define('ISLOGIN',	isLogin());
// Nhom thanh vien: admin (quan tri vien), writer (Nguoi viet cung), visitor (Khach)
define('ROLE', ISLOGIN === true ? $userData['role'] : 'visitor');
// ID nguoi dung
define('UID', ISLOGIN === true ? $userData['uid'] : '');
// Dia chi blog
define('BLOG_URL', Option::get('blogurl'));
// Dia chi giao dien
define('TPLS_URL', BLOG_URL.'content/templates/');
// Duong dan thu muc giao dien
define('TPLS_PATH', EMLOG_ROOT.'/content/templates/');
//Dia chi dong
define('DYNAMIC_BLOGURL', getBlogUrl());
// Duong dan mau
define('TEMPLATE_URL', 	TPLS_URL.Option::get('nonce_templet').'/');

$active_plugins = Option::get('active_plugins');
$emHooks = array();
if ($active_plugins && is_array($active_plugins)) {
	foreach($active_plugins as $plugin) {
		if(true === checkPlugin($plugin)) {
			include_once(EMLOG_ROOT . '/content/plugins/' . $plugin);
		}
	}
}
