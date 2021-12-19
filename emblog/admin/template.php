<?php
/**
 * Quan ly chu giao dien, chu de
 * @copyright (c) Emlog All Rights Reserved
 * $Id: template.php 1945 2011-04-23 12:02:52Z emloog $
 */

require_once 'globals.php';

if($action == '') {
	$nonce_templet = Option::get('nonce_templet');
	$nonceTplData = @implode('', @file(TPLS_PATH.$nonce_templet.'/header.php'));
	preg_match("/Template Name:(.*)/i", $nonceTplData, $tplName);
	preg_match("/Author:(.*)/i", $nonceTplData, $tplAuthor);
	preg_match("/Description:(.*)/i", $nonceTplData, $tplDes);
	preg_match("/Author Url:(.*)/i", $nonceTplData, $tplUrl);
	$tplName = !empty($tplName[1]) ? trim($tplName[1]) : $nonce_templet;
	$tplDes = !empty($tplDes[1]) ? $tplDes[1] : '';
	if(isset($tplAuthor[1]))
	{
		$tplAuthor = !empty($tplUrl[1]) ? "Tác giả: <a href=\"{$tplUrl[1]}\">{$tplAuthor[1]}</a>" : "Tác giả: {$tplAuthor[1]}";
	}else{
		$tplAuthor = '';
	}
	// Danh sach chu de
	$handle = @opendir(TPLS_PATH) OR die('Đường dẫn sai!');
	$tpls = array();
	while ($file = @readdir($handle))
	{
		if(file_exists(TPLS_PATH.$file.'/header.php'))
		{
			$tplData = implode('', @file(TPLS_PATH.$file.'/header.php'));
			preg_match("/Template Name:([^\r\n]+)/i", $tplData, $name);
			preg_match("/Sidebar Amount:([^\r\n]+)/i", $tplData, $sidebar);
			$tplInfo['tplname'] = !empty($name[1]) ? trim($name[1]) : $file;
			$tplInfo['sidebar'] = !empty($sidebar[1]) ? intval($sidebar[1]) : 1;
			$tplInfo['tplfile'] = $file;

			$tpls[] = $tplInfo;
		}
	}
	closedir($handle);

	$tplnums = count($tpls);

	include View::getView('header');
	require_once View::getView('template');
	include View::getView('footer');
	View::output();
}
// Chu de
if($action == 'usetpl')
{
	$tplName = isset($_GET['tpl']) ? addslashes($_GET['tpl']) : '';
	$tplSideNum = isset($_GET['side']) ? intval($_GET['side']) : '';

	Option::updateOption('nonce_templet', $tplName);
	Option::updateOption('tpl_sidenum', $tplSideNum);
	$CACHE->updateCache('options');
	header("Location: ./template.php?activated=true");
}


// Tuy chinh dau trang
if($action == 'custom-top')
{
	$topimg = Option::get('topimg');

	$top_image_path = TPLS_PATH . 'default/images/top/';

	$handle = @opendir($top_image_path) OR die('emlog default template path error!');
	$default_topimgs = array();
    while ($file = @readdir($handle)) 
    {
    	if (getFileSuffix($file) == 'jpg' && !strstr($file, '_mini.jpg')) {
        	$default_topimgs[] = array('path'=>'content/templates/default/images/top/'.$file);
    	}
    }
    $custom_topimgs = Option::get('custom_topimgs');
    $topimgs = array_merge($default_topimgs, $custom_topimgs);
	closedir($handle);

	include View::getView('header');
	require_once View::getView('template_top');
	include View::getView('footer');
	View::output();
}

// Cap nhat dau trang
if($action == 'update_top')
{
	$top = isset($_GET['top']) ? addslashes($_GET['top']) : '';

	Option::updateOption('topimg', $top);
	$CACHE->updateCache('options');
	header("Location: ./template.php?action=custom-top&activated=true");
}

// Xoa dau trang
if($action == 'del_top')
{
	$top = isset($_GET['top']) ? addslashes($_GET['top']) : '';

	$custom_topimgs = Option::get('custom_topimgs');
	$key = array_search($top, $custom_topimgs);
	if(isset($custom_topimgs[$key])) {
		unset($custom_topimgs[$key]);
	}

	$top_mini = str_replace('.jpg', '_mini.jpg', $top);
	@unlink('../' . $top);
	@unlink('../' . $top_mini);

	Option::updateOption('custom_topimgs', serialize($custom_topimgs));

	$CACHE->updateCache('options');
	header("Location: ./template.php?action=custom-top&active_del=true");
}

// Tai len dau trang
if ($action == 'upload_top') {
	$photo_type = array('jpg', 'jpeg', 'png');
	$topimg = '';

	if($_FILES['topimg']['error'] != 4)
	{
		$topimg = uploadFile($_FILES['topimg']['name'], $_FILES['topimg']['error'], $_FILES['topimg']['tmp_name'], $_FILES['topimg']['size'], $photo_type, false, false);
	}else{
		header("Location: ./template.php?action=custom-top");
		exit;
	}

	include View::getView('header');
	require_once View::getView('template_crop');
	include View::getView('footer');
	View::output();
}

// Cat anh
if ($action == 'crop') {
	$x1 = isset($_POST['x1']) ? intval($_POST['x1']) : 0;
	$y1 = isset($_POST['y1']) ? intval($_POST['y1']) : 140;
	$width = isset($_POST['width']) ? intval($_POST['width']) : 960;
	$height = isset($_POST['height']) ? intval($_POST['height']) : 134;
	$top_img = isset($_POST['img']) ? $_POST['img'] : '';

	$time = time();

	// Tao anh dau trang
	$topimg_path = Option::UPLOADFILE_PATH . gmdate('mY') . '/top-' . $time . '.jpg';
	$ret = imageCropAndResize($top_img, $topimg_path, 0, 0, $x1, $y1, $width, $height, $width, $height);
	if (false === $ret) {
		header("Location: ./template.php?action=custom-top&error_a=true");
		exit;
	}

	// Tao anh dau trang
	$topimg_mini_path = Option::UPLOADFILE_PATH . gmdate('mY') . '/top-' . $time . '_mini.jpg';
	$ret = imageCropAndResize($topimg_path, $topimg_mini_path, 0, 0, 0, 0, 230, 48, $width, $height);
	if (false === $ret) {
		header("Location: ./template.php?action=custom-top&error_a=true");
		exit;
	}

	@unlink($top_img);

	$custom_topimgs = Option::get('custom_topimgs');
	array_push($custom_topimgs, substr($topimg_path, 3));

	Option::updateOption('topimg', substr($topimg_path, 3));
	Option::updateOption('custom_topimgs', serialize($custom_topimgs));
	$CACHE->updateCache('options');
	header("Location: ./template.php?action=custom-top&activated=true");
}
