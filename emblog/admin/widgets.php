<?php
/**
 * Quan ly widget
 * @copyright (c) Emlog All Rights Reserved
 * $Id: widgets.php 1768 2010-10-10 14:22:14Z emloog $
 */

require_once 'globals.php';

// Quan ly cac thanh phan
if($action == '') {
	$wgNum = isset($_GET['wg']) ? intval($_GET['wg']) : 1;
	$widgets = Option::get('widgets'.$wgNum);
	$widgetTitle = Option::get('widget_title');
	$custom_widget = Option::get('custom_widget');
	$widgetTitle = array_map('htmlspecialchars', $widgetTitle);
	$tpl_sidenum = Option::get('tpl_sidenum');

	foreach ($custom_widget as $key => $val) {
		$custom_widget[$key] = array_map('htmlspecialchars', $val);
	}

	$customWgTitle = array();
	foreach ($widgetTitle as $key => $val) {
		if(preg_match("/^.*\s\((.*)\)/", $val, $matchs)) {
			$customWgTitle[$key] = $matchs[1];
		}else{
			$customWgTitle[$key] = $val;
		}
	}

	include View::getView('header');
	require_once View::getView('widgets');
	include View::getView('footer');
	View::output();
}

// Sua doi cac thanh phan
if($action == 'setwg') {
	$widgetTitle = Option::get('widget_title'); // Than phan tieu de
	$widget = isset($_GET['wg']) ? $_GET['wg'] : '';			// Sua doi thanh phan
	$wgTitle = isset($_POST['title']) ? $_POST['title'] : '';	// Ten moi

	preg_match("/^(.*)\s\(.*/", $widgetTitle[$widget], $matchs);
	$realWgTitle = isset($matchs[1]) ? $matchs[1] : $widgetTitle[$widget];

	$widgetTitle[$widget] = $realWgTitle != $wgTitle ? $realWgTitle.' ('.$wgTitle.')' : $realWgTitle;
	$widgetTitle = addslashes(serialize($widgetTitle));

	Option::updateOption('widget_title', $widgetTitle);

	switch ($widget) {
		case 'newcomm':
			$index_comnum = isset($_POST['index_comnum']) ? intval($_POST['index_comnum']) : 10;
			$comment_subnum = isset($_POST['comment_subnum']) ? intval($_POST['comment_subnum']) : 20;
			Option::updateOption('index_comnum', $index_comnum);
			Option::updateOption('comment_subnum', $comment_subnum);
			$CACHE->updateCache('comment');
			break;
		case 'twitter':
			$index_newtwnum = isset($_POST['index_newtwnum']) ? intval($_POST['index_newtwnum']) : 10;
			Option::updateOption('index_newtwnum', $index_newtwnum);
			$CACHE->updateCache('newtw');
			break;
		case 'newlog':
			$index_newlog = isset($_POST['index_newlog']) ? intval($_POST['index_newlog']) : 10;
			Option::updateOption('index_newlognum', $index_newlog);
			$CACHE->updateCache('newlog');
			break;
		case 'random_log':
			$index_randlognum = isset($_POST['index_randlognum']) ? intval($_POST['index_randlognum']) : 20;
			Option::updateOption('index_randlognum', $index_randlognum);
			break;
		case 'custom_text':
			$custom_widget = Option::get('custom_widget');
			$title = isset($_POST['title']) ? $_POST['title'] : '';
			$content = isset($_POST['content']) ? $_POST['content'] : '';
			$custom_wg_id = isset($_POST['custom_wg_id']) ? $_POST['custom_wg_id'] : '';// Sua doi thanh phan theo ID
			$new_title = isset($_POST['new_title']) ? $_POST['new_title'] : '';
			$new_content = isset($_POST['new_content']) ? $_POST['new_content'] : '';
			$rmwg = isset($_GET['rmwg']) ? addslashes($_GET['rmwg']) : '';// Loai bo thanh phan theo ID
			// Them thanh phan moi
			if($new_content) {
				// Xac dinh thanh phan moi
				$i = 0;
				$maxKey = 0;
				if(is_array($custom_widget)) {
					foreach ($custom_widget as $key => $val) {
						preg_match("/^custom_wg_(\d+)/", $key, $matches);
						$k = $matches[1];
						if($k > $i) {
							$maxKey = $k;
						}
						$i = $k;
					}
				}
				$custom_wg_index = $maxKey + 1;
				$custom_wg_index = 'custom_wg_'.$custom_wg_index;
				$custom_widget[$custom_wg_index] = array('title'=>$new_title,'content'=>$new_content);
				$custom_widget_str = addslashes(serialize($custom_widget));
				Option::updateOption('custom_widget', $custom_widget_str);
			}elseif ($content){
				$custom_widget[$custom_wg_id] = array('title'=>$title,'content'=>$content);
				$custom_widget_str = addslashes(serialize($custom_widget));
				Option::updateOption('custom_widget', $custom_widget_str);
			}elseif ($rmwg){
				for($i=1; $i<5; $i++) {
					$widgets = Option::get('widgets'.$i);
					if(is_array($widgets) && !empty($widgets)) {
						foreach ($widgets as $key => $val) {
							if($val == $rmwg) {
								unset($widgets[$key]);
							}
						}
						$widgets_str = addslashes(serialize($widgets));
						Option::updateOption("widgets$i", $widgets_str);
					}
				}
				unset($custom_widget[$rmwg]);
				$custom_widget_str = addslashes(serialize($custom_widget));
				Option::updateOption('custom_widget', $custom_widget_str);
			}
			break;
	}
	$CACHE->updateCache('options');
	header("Location: ./widgets.php?activated=true");
}

// Luu thanh phan
if($action == 'compages') {
	$wgNum = isset($_POST['wgnum']) ? intval($_POST['wgnum']) : 1;// So cot ben 1,2,3...
	$widgets = isset($_POST['widgets']) ? serialize($_POST['widgets']) : '';
	Option::updateOption("widgets{$wgNum}", $widgets);
	$CACHE->updateCache('options');
	header("Location: ./widgets.php?activated=true&wg=$wgNum");
}

// Khoi phuc widget ban dau
if($action == 'reset') {
	$widget_title = serialize(Option::getWidgetTitle());
	$default_widget = serialize(Option::getDefWidget());

	Option::updateOption("widget_title", $widget_title);
	Option::updateOption("custom_widget", 'a:0:{}');
	Option::updateOption("widgets1", $default_widget);

	$CACHE->updateCache('options');
	header("Location: ./widgets.php?activated=true");
}
