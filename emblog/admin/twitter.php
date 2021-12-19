<?php
/**
 * Twitter
 * @copyright (c) Emlog All Rights Reserved
 * $Id: twitter.php 1825 2011-02-04 15:06:55Z emloog $
 */

require_once 'globals.php';

$Twitter_Model = new Twitter_Model();

if ($action == '') {
    $user_cache = $CACHE->readCache('user');
    $Reply_Model = new Reply_Model();

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $tws = $Twitter_Model->getTwitters($page,1);
    $twnum = $Twitter_Model->getTwitterNum(1);
    $pageurl =  pagination($twnum, Option::get('admin_perpage_num'), $page, 'twitter.php?page');
    $avatar = empty($user_cache[UID]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[UID]['avatar'];

    $conf_istwitter = Option::get('istwitter') == 'y' ? 'checked="checked"' : '';
    $conf_reply_code = Option::get('reply_code') == 'y' ? 'checked="checked"' : '';
    $conf_ischkreply = Option::get('ischkreply') == 'y' ? 'checked="checked"' : '';

    include View::getView('header');
    require_once View::getView('twitter');
    include View::getView('footer');
    View::output();
}
// Dang twitter
if ($action == 'post') {
    $t = isset($_POST['t']) ? addslashes(trim($_POST['t'])) : '';

    if (!$t){
        header("Location: twitter.php?error_a=true");
        exit;
    }

    $tdata = array('content' => $Twitter_Model->formatTwitter($t),
            'author' => UID,
            'date' => time(),
    );

    $Twitter_Model->addTwitter($tdata);
    $CACHE->updateCache(array('sta','newtw'));
    doAction('post_twitter', $t);
    header("Location: twitter.php?active_t=true");
}
// Xoa twitter
if ($action == 'del') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Twitter_Model->delTwitter($id);
	$CACHE->updateCache(array('sta','newtw'));
	header("Location: twitter.php?active_del=true");
}
// Tra loi
if ($action == 'getreply') {
    $tid = isset($_GET['tid']) ? intval($_GET['tid']) : null;

    $Reply_Model = new Reply_Model();
    $replys = $Reply_Model->getReplys($tid);

    $response = '';
    foreach($replys as $val){
         if ($val['hide'] == 'n'){
            $style = "background-color:#FFF";
            $act = "<span><a href=\"javascript: hidereply({$val['id']},{$tid});\">Ẩn</a></span> ";
         } else {
            $style = "background-color:#FEE0E4";
            $act = "<span><a href=\"javascript: pubreply({$val['id']},{$tid});\">Hiện</a></span> ";
         }
         $response .= "
         <li id=\"reply_{$val['id']}\" style=\"{$style}\">
         <span class=\"name\">{$val['name']}</span> {$val['content']}<span class=\"time\">{$val['date']}</span>{$act}
         <a href=\"javascript: delreply({$val['id']},{$tid});\">Xóa</a> 
         <em><a href=\"javascript:reply({$tid}, '@{$val['name']}:');\">Trả lời</a></em>
         </li>";
    }
    echo $response;
}
// Tra loi twitter
if ($action == 'reply') {
    $user_cache = $CACHE->readCache('user');

    $r = isset($_POST['r']) ? addslashes(trim($_POST['r'])) : '';
    $tid = isset($_GET['tid']) ? intval($_GET['tid']) : null;

    if (!$r || strlen($r) > 420){
        exit('err1');
    }

    $date = time();
    $name =  $user_cache[UID]['name'];

    $rdata = array(
            'tid' => $tid,
            'content' => $r,
            'name' => $name,
            'date' => $date,
    );

    $Reply_Model = new Reply_Model();
    $rid = $Reply_Model->addReply($rdata);
    if ($rid === false){
        exit('err2');
    }
    $Twitter_Model->updateReplyNum($tid, '+1');
    $CACHE->updateCache('sta');

    $date = smartDate($date);
    $r = htmlClean(stripslashes($r));
    $response = "
         <li id=\"reply_{$rid}\" style=\"background-color:#FFEEAA\">
         <span class=\"name\">{$name}</span> {$r}<span class=\"time\">{$date}</span>
         <span><a href=\"javascript: hidereply({$rid},{$tid});\">Ẩn</a></span> 
         <a href=\"javascript: delreply({$rid},{$tid});\">Xóa</a> 
         <em><a href=\"javascript:reply({$tid}, '@{$name}:');\">Trả lời</a></em>
         </li>";
    echo $response;
}
// Xoa tra loi
if ($action == 'delreply') {
    $rid = isset($_GET['rid']) ? intval($_GET['rid']) : null;
    $tid = isset($_GET['tid']) ? intval($_GET['tid']) : null;
    $Reply_Model = new Reply_Model();
    if( $Reply_Model->delReply($rid) == 'n'){
        $Twitter_Model->updateReplyNum($tid, '-1');
    }
    echo $tid;
}
// Ẩn trả lời
if ($action == 'hidereply') {
    $rid = isset($_GET['rid']) ? intval($_GET['rid']) : null;
    $tid = isset($_GET['tid']) ? intval($_GET['tid']) : null;
    $Reply_Model = new Reply_Model();
    $Reply_Model->hideReply($rid);
    $Twitter_Model->updateReplyNum($tid, '-1');
}
// Hiện trả lời
if ($action == 'pubreply') {
    $rid = isset($_GET['rid']) ? intval($_GET['rid']) : null;
    $tid = isset($_GET['tid']) ? intval($_GET['tid']) : null;
    $Reply_Model = new Reply_Model();
    $Reply_Model->pubReply($rid);
    $Twitter_Model->updateReplyNum($tid, '+1');
}
// Thiet lap twitter
if ($action == 'set') {
    $data = array(
        'istwitter' => isset($_POST['istwitter']) ? addslashes($_POST['istwitter']) : 'n',
        'ischkreply' => isset($_POST['ischkreply']) ? addslashes($_POST['ischkreply']) : 'n',
        'reply_code' => isset($_POST['reply_code']) ? addslashes($_POST['reply_code']) : 'n',
        'index_twnum' => isset($_POST['index_twnum']) ? intval($_POST['index_twnum']) : 10,
    	'twnavi' => isset($_POST['twnavi']) ? addslashes($_POST['twnavi']) : '',
    );

	foreach ($data as $key => $val){
		Option::updateOption($key, $val);
	}

	$CACHE->updateCache('options');
    header("Location: twitter.php?active_set=true");
}
