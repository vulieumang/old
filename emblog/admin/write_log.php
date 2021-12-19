<?php
/**
 * Viet bai
 * @copyright (c) Emlog All Rights Reserved
 * $Id: write_log.php 1797 2010-10-31 14:16:55Z emloog $
 */

require_once 'globals.php';

// Hien thi viet bai
if($action == '') {
	$Tag_Model = new Tag_Model();
	$Sort_Model = new Sort_Model();

	$sorts = $Sort_Model->getSorts();
	$tags = $Tag_Model->getTag();

	$localtime = time() + Option::get('timezone') * 3600;
	$postDate = gmdate('d-m-Y H:i:s', $localtime);

	include View::getView('header');
	require_once View::getView('add_log');
	include View::getView('footer');
	View::output();
}

// Sua bai
if ($action == 'edit') {
	$Log_Model = new Log_Model();
	$Tag_Model = new Tag_Model();
	$Sort_Model = new Sort_Model();

	$logid = isset($_GET['gid']) ? intval($_GET['gid']) : '';
	$blogData = $Log_Model->getOneLogForAdmin($logid);
	extract($blogData);
	$sorts = $Sort_Model->getSorts();
	//Tag
	$tags = array();
	foreach ($Tag_Model->getTag($logid) as $val) {
		$tags[] = $val['tagname'];
	}
	$tagStr = implode(',', $tags);
	//Tag cu
	$tags = $Tag_Model->getTag();

	$is_top = $top == 'y' ? 'checked="checked"' : '';
    $is_allow_remark = $allow_remark == 'y' ? 'checked="checked"' : '';
    $is_allow_tb = $allow_tb == 'y' ? 'checked="checked"' : '';

	include View::getView('header');
	require_once View::getView('edit_log');
	include View::getView('footer');View::output();
}
