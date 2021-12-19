<?php
/**
 * Quan ly bai viet
 * @copyright (c) Emlog All Rights Reserved
 * $Id: admin_log.php 1791 2010-10-21 14:35:27Z emloog $
 */

require_once 'globals.php';

$Log_Model = new Log_Model();

// Hien thi bai viet, ban nhap
if($action == '')
{
	$Tag_Model = new Tag_Model();
	$User_Model = new User_Model();

	$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
	$tagId = isset($_GET['tagid']) ? intval($_GET['tagid']) : '';
	$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '';
	$uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

	$sortView = (isset($_GET['sortView']) && $_GET['sortView'] == 'ASC') ?  'DESC' : 'ASC';
	$sortComm = (isset($_GET['sortComm']) && $_GET['sortComm'] == 'ASC') ?  'DESC' : 'ASC';
	$sortDate = (isset($_GET['sortDate']) && $_GET['sortDate'] == 'DESC') ?  'ASC' : 'DESC';

	$sqlSegment = '';
	if($tagId)
	{
		$blogIdStr = $Tag_Model->getTagById($tagId);
		$sqlSegment = "and gid IN ($blogIdStr)";
	}elseif ($sid){
		$sqlSegment = "and sortid=$sid";
	}elseif ($uid){
		$sqlSegment = "and author=$uid";
	}
	$sqlSegment .= ' ORDER BY ';
	if(isset($_GET['sortView']))
	{
		$sqlSegment .= "views $sortView";
	}elseif(isset($_GET['sortComm'])){
		$sqlSegment .= "comnum $sortComm";
	}elseif(isset($_GET['sortDate'])){
		$sqlSegment .= "date $sortDate";
	}else {
		$sqlSegment .= 'top DESC,date DESC';
	}

	$hide_state = $pid ? 'y' : 'n';
	if($pid == 'draft')
	{
		$hide_stae = 'y';
		$sorturl = '&pid=draft';
		$pwd = 'Bản nháp';
	}else{
		$hide_stae = 'n';
		$sorturl = '';
		$pwd = 'Bài viết';
	}

	$logNum = $Log_Model->getLogNum($hide_state, $sqlSegment, 'blog', 1);
	$logs = $Log_Model->getLogsForAdmin($sqlSegment, $hide_state, $page);
	$sorts = $CACHE->readCache('sort');
	$users = $CACHE->readCache('user');
	$log_cache_tags = $CACHE->readCache('logtags');
	$tags = $Tag_Model->getTag();

	$subPage = '';
	foreach ($_GET as $key=>$val)
	{
		$subPage .= $key != 'page' ? "&$key=$val" : '';
	}
	$pageurl =  pagination($logNum, Option::get('admin_perpage_num'), $page, "admin_log.php?{$subPage}&page");

	include View::getView('header');
	require_once View::getView('admin_log');
	include View::getView('footer');View::output();
}

// Thao tac
if($action == 'operate_log')
{
	$operate = isset($_POST['operate']) ? $_POST['operate'] : '';
	$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
	$logs = isset($_POST['blog']) ? array_map('intval', $_POST['blog']) : array();
	$sort = isset($_POST['sort']) ? intval($_POST['sort']) : '';
	$author = isset($_POST['author']) ? intval($_POST['author']) : '';

	if($operate == '')
	{
		header("Location: ./admin_log.php?pid=$pid&error_b=true");
		exit;
	}
	if(empty($logs))
	{
		header("Location: ./admin_log.php?pid=$pid&error_a=true");
		exit;
	}

	switch ($operate)
	{
		case 'del':
			foreach($logs as $val)
			{
				$Log_Model->deleteLog($val);
				doAction('del_log', $val);
			}
			$CACHE->updateCache();
			if($pid == 'draft')
			{
				header("Location: ./admin_log.php?pid=draft&active_del=true");
			}else{
				header("Location: ./admin_log.php?active_del=true");
			}
			break;
		case 'top':
			foreach($logs as $val)
			{
				$Log_Model->updateLog(array('top'=>'y'), $val);
			}
			header("Location: ./admin_log.php?active_up=true");
			break;
		case 'notop':
			foreach($logs as $val)
			{
				$Log_Model->updateLog(array('top'=>'n'), $val);
			}
			header("Location: ./admin_log.php?active_down=true");
			break;
		case 'hide':
			foreach($logs as $val)
			{
				$Log_Model->hideSwitch($val, 'y');
			}
			$CACHE->updateCache();
			header("Location: ./admin_log.php?active_hide=true");
			break;
		case 'pub':
			foreach($logs as $val)
			{
				$Log_Model->hideSwitch($val, 'n');
			}
			$CACHE->updateCache();
			header("Location: ./admin_log.php?pid=draft&active_post=true");
			break;
		case 'move':
			foreach($logs as $val)
			{
				$Log_Model->updateLog(array('sortid'=>$sort), $val);
			}
			$CACHE->updateCache(array('sort', 'logsort'));
			header("Location: ./admin_log.php?active_move=true");
			break;
		case 'change_author':
			if (ROLE != 'admin')
			{
				formMsg('Bạn không có quyền truy cập!','./', 0);
			}
			foreach($logs as $val)
			{
				$Log_Model->updateLog(array('author'=>$author), $val);
			}
			$CACHE->updateCache('sta');
			header("Location: ./admin_log.php?active_change_author=true");
			break;
	}
}
