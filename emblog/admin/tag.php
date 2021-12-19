<?php
/**
 * Quan ly tags
 * @copyright (c) Emlog All Rights Reserved
 * $Id: tag.php 1791 2010-10-21 14:35:27Z emloog $
 */

require_once 'globals.php';

$Tag_Model = new Tag_Model();

if($action == '')
{
	$tags = $Tag_Model->getTag();
	include View::getView('header');
	require_once View::getView('tag');
	include View::getView('footer');
	View::output();
}

if ($action== "mod_tag")
{
	$tagId = isset($_GET['tid']) ? intval($_GET['tid']) : '';
	$tag = $Tag_Model->getOneTag($tagId);
	extract($tag);
	include View::getView('header');
	require_once View::getView('tagedit');
	include View::getView('footer');View::output();
}

// Cap nhat tag
if($action=='update_tag')
{
	$tagName = isset($_POST['tagname']) ? addslashes($_POST['tagname']) : '';
	$tagId = isset($_POST['tid']) ? intval($_POST['tid']) : '';
	$Tag_Model->updateTagName($tagId, $tagName);
	$CACHE->updateCache(array('tags', 'logtags'));
	header("Location: ./tag.php?active_edit=true");
}

// Xoa tat ca tag
if($action== 'dell_all_tag')
{
	$tags = isset($_POST['tag']) ? $_POST['tag'] : '';
	if(!$tags)
	{
		header("Location: ./tag.php?error_a=true");
		exit;
	}
	foreach($tags as $key=>$value)
	{
		$Tag_Model->deleteTag($key);
	}
	$CACHE->updateCache(array('tags', 'logtags'));
	header("Location: ./tag.php?active_del=true");
}
