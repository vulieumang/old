<?php
/**
 * Quan ly plugin
 * @copyright (c) Emlog All Rights Reserved
 * $Id: plugin.php 1791 2010-10-21 14:35:27Z emloog $
 */

require_once 'globals.php';

$plugin = isset($_GET['plugin']) ? $_GET['plugin'] : '';

if($action == '' && !$plugin) {
	$Plugin_Model = new Plugin_Model();
	$plugins = $Plugin_Model->getPlugins();

	include View::getView('header');
	require_once(View::getView('plugin'));
	include View::getView('footer');
	View::output();
}
// Kich hoat
if ($action == 'active') {
	$Plugin_Model = new Plugin_Model();
	if ($Plugin_Model->activePlugin($plugin) ){
	    $CACHE->updateCache('options');
	    header("Location: ./plugin.php?active=true");
	} else {
	    header("Location: ./plugin.php?active_error=true");
	}
}
// Vo hieu
if($action == 'inactive') {
	$Plugin_Model = new Plugin_Model();
	$Plugin_Model->inactivePlugin($plugin);
	$CACHE->updateCache('options');
	header("Location: ./plugin.php?inactive=true");
}
// Tai cau hinh plugin
if ($action == '' && $plugin) {
	include View::getView('header');
	require_once "../content/plugins/{$plugin}/{$plugin}_setting.php";
	plugin_setting_view();
	include View::getView('footer');
}
// Luu thiet lap plugin
if ($action == 'setting') {
	if(!empty($_POST)) {
		require_once "../content/plugins/{$plugin}/{$plugin}_setting.php";
		if(false === plugin_setting()){
		    header("Location: ./plugin.php?plugin={$plugin}&error=true");
		}else{
		    header("Location: ./plugin.php?plugin={$plugin}&setting=true");
		}
	}else{
	    header("Location: ./plugin.php?plugin={$plugin}&error=true");
	}
}
// Vo hieu tat ca plugin
if($action == 'reset') {
    Option::updateOption('active_plugins', 'a:0:{}');
	$CACHE->updateCache('options');
	header("Location: ./plugin.php?inactive=true");
}
