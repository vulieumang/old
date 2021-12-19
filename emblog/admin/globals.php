<?php
/**
 * Cau hinh quan tri
 * @copyright (c) Emlog All Rights Reserved
 * $Id: globals.php 1942 2011-04-23 07:11:58Z emloog $
 */

require_once '../init.php';

define('TEMPLATE_PATH', EMLOG_ROOT.'/admin/views/');//Lay duong dan giao dien

$sta_cache = $CACHE->readCache('sta');
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';

// Xac thuc dang nhap
if ($action == 'login') {
	$username = isset($_POST['user']) ? addslashes(trim($_POST['user'])) : '';
	$password = isset($_POST['pw']) ? addslashes(trim($_POST['pw'])) : '';
	$ispersis = isset($_POST['ispersis']) ? intval($_POST['ispersis']) : false;
	$img_code = Option::get('login_code') == 'y' && isset($_POST['imgcode']) ? addslashes(trim(strtoupper($_POST['imgcode']))) : '';

	if (checkUser($username, $password, $img_code) === true) {
		setAuthCookie($username, $ispersis);
		header("Location: ./");
	}else{
		loginPage();
	}
}
// Dang xuat
if ($action == 'logout'){
	setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
	header("Location: ../");
	exit;
}

if(ISLOGIN === false){
	loginpage();
}

$request_uri = strtolower(substr(basename($_SERVER['SCRIPT_NAME']), 0, -4));
if (ROLE == 'writer' && !in_array($request_uri, array('write_log','admin_log','twitter','attachment','blogger','comment','index','save_log','trackback'))){
	formMsg('Bạn không có quyền truy cập!','./', 0);
}
