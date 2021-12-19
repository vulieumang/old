<?php
/**
 * Phien ban di dong
 *
 * @copyright (c) Emlog All Rights Reserved
 * $Id: index.php 1929 2011-04-20 02:46:02Z qiyuuu $
 */

require_once '../init.php';

define ('TEMPLATE_PATH', EMLOG_ROOT . '/m/view/');

$isgzipenable = 'n'; // Bat GZIP
$index_lognum = 5;

$logid = isset ($_GET['post']) ? intval ($_GET['post']) : '';
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';

// Bai moi
if (empty ($action) && empty ($logid)) {
	$Log_Model = new Log_Model();
	$page = isset($_GET['page']) ? abs(intval ($_GET['page'])) : 1;
	$sqlSegment = "ORDER BY top DESC ,date DESC";
	$sta_cache = $CACHE->readCache('sta');
	$lognum = $sta_cache['lognum'];
	$pageurl = '?page';
	$logs = $Log_Model->getLogsForHome ($sqlSegment, $page, $index_lognum);
	$page_url = pagination($lognum, $index_lognum, $page, $pageurl);

	include View::getView('header');
	include View::getView('log');
	include View::getView('footer');
	View::output();
}
//  Binh luan
if (!empty ($logid)) {
	$Log_Model = new Log_Model();
	$Comment_Model = new Comment_Model();

	$logData = $Log_Model->getOneLogForHome($logid);
	if ($logData === false) {
		mMsg ('Mục không tồn tại.', './');
	}
	extract($logData);
	if (!empty($password)) {
		$postpwd = isset($_POST['logpwd']) ? addslashes(trim ($_POST['logpwd'])) : '';
		$cookiepwd = isset($_COOKIE ['em_logpwd_' . $logid]) ? addslashes(trim($_COOKIE ['em_logpwd_' . $logid])) : '';
		authPassword ($postpwd, $cookiepwd, $password, $logid);
	}
	// Binh luan
	$verifyCode = Option::get('comment_code') == 'y' ? "<img src=\"../include/lib/checkcode.php\" /><br /><input name=\"imgcode\" type=\"text\" />" : '';
	$comments = $Comment_Model->getComments(0, $logid, 'n');

	$user_cache = $CACHE->readCache('user');

	$Log_Model->updateViewCount($logid);
	include View::getView('header');
	include View::getView('single');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 'write') {
	$logid = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Sort_Model = new Sort_Model();
	$sorts = $Sort_Model->getSorts();
	if ($logid) {
		$Log_Model = new Log_Model();
		$Tag_Model = new Tag_Model();

		$blogData = $Log_Model->getOneLogForAdmin($logid);
		extract($blogData);
		$tags = array();
		foreach ($Tag_Model->getTag($logid) as $val) {
			$tags[] = $val['tagname'];
		}
		$tagStr = implode(',', $tags);
	}else {
		$title = '';
		$sortid = -1;
		$content = '';
		$excerpt = '';
		$tagStr = '';
		$logid = -1;
		$author = UID;
		$date = '';
	}
	include View::getView('header');
	include View::getView('write');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 'savelog') {
	$Log_Model = new Log_Model();
	$Tag_Model = new Tag_Model();

	$title = isset($_POST['title']) ? addslashes(trim($_POST['title'])) : '';
	$sort = isset($_POST['sort']) ? intval($_POST['sort']) : '';
	$content = isset($_POST['content']) ? addslashes(trim($_POST['content'])) : '';
	$excerpt = isset($_POST['excerpt']) ? addslashes(trim($_POST['excerpt'])) : '';
	$tagstring = isset($_POST['tag']) ? addslashes(trim($_POST['tag'])) : '';
	$blogid = isset($_POST['gid']) ? intval(trim($_POST['gid'])) : -1;
	$date = isset($_POST['date']) ? addslashes($_POST['date']) : '';
	$author = isset($_POST['author']) ? intval(trim($_POST['author'])) : UID;
	$postTime = $Log_Model->postDate(Option::get('timezone'), $date);	

	$logData = array('title' => $title,
		'content' => $content,
		'excerpt' => $excerpt,
		'author' => $author,
		'sortid' => $sort,
		'date' => $postTime,
		'allow_remark' => 'y',
		'allow_tb' => 'y',
		'hide' => 'n',
		'password' => ''
		);

	if ($blogid > 0) {
		$Log_Model->updateLog($logData, $blogid);
		$Tag_Model->updateTag($tagstring, $blogid);
	}else {
		$blogid = $Log_Model->addlog($logData);
		$Tag_Model->addTag($tagstring, $blogid);
	}
	$CACHE->updateCache();
	header ("Location: ./");
}
if (ISLOGIN === true && $action == 'dellog') {
	$Log_Model = new Log_Model();
	$id = isset($_GET['gid']) ? intval($_GET['gid']) : -1;
	$Log_Model->deleteLog($id);
	$CACHE->updateCache();
	header("Location: ./");
}
// Gui binh luan
if ($action == 'addcom') {
	$Comment_Model = new Comment_Model();

	$name = isset($_POST['comname']) ? addslashes(trim($_POST['comname'])) : '';
    $content = isset($_POST['comment']) ? addslashes(trim($_POST['comment'])) : '';
    $mail = isset($_POST['commail']) ? addslashes(trim($_POST['commail'])) : '';
    $url = isset($_POST['comurl']) ? addslashes(trim($_POST['comurl'])) : '';
    $imgcode = isset($_POST['imgcode']) ? strtoupper(trim($_POST['imgcode'])) : '';
	$blogId = isset($_GET['gid']) ? intval($_GET['gid']) : -1;
	$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

	if($Comment_Model->isLogCanComment($blogId) === false){
        mMsg('Gửi nhận xét thất bại. Bài viết không cho phép nhận xét','./?post=' . $blogId);
    } elseif ($Comment_Model->isCommentExist($blogId, $name, $content) === true){
        mMsg('Gửi nhận xét thất bại. Nội dung đã tồn tại.','./?post=' . $blogId);
    } elseif (preg_match("/['<>,#|;\/\$\\&\r\t()%@+?^]/",$name) || strlen($name) > 20 || strlen($name) == 0){
        mMsg('Gửi nhận xét thất bại. Tên không phù hợp.','./?post=' . $blogId);;
    } elseif ($mail != '' && !checkMail($mail)) {
        mMsg('Gửi nhận xét thất bại. Email sai.', './?post=' . $blogId);
    } elseif (ISLOGIN == false && $Comment_Model->isNameAndMailValid($name, $mail) === false){
        mMsg('Gửi nhận xét thất bại. Tên hoặc email bị cấm.','./?post=' . $blogId);
    } elseif (strlen($content) == '' || strlen($content) > 2000) {
        mMsg('Gửi nhận xét thất bại. Nội dung quá dài.','./?post=' . $blogId);
    } elseif (Option::get('comment_code') == 'y' && session_start() && $imgcode != $_SESSION['code']) {
        mMsg('Gửi nhận xét thất bại. Mã xác nhận sai.','./?post=' . $blogId);
    } else {
		$DB = MySql::getInstance();
        $ipaddr = getIp();
		$utctimestamp = time();
		if($pid != 0) {
			$comment = $Comment_Model->getOneComment($pid);
			$content = '@' . $comment['poster'] . ': ' . $content;
		}
		$ischkcomment = Option::get('ischkcomment');
		$sql = 'INSERT INTO '.DB_PREFIX."comment (date,poster,gid,comment,mail,url,hide,ip,pid)
				VALUES ('$utctimestamp','$name','$blogId','$content','$mail','$url','$ischkcomment','$ipaddr','$pid')";
		$ret = $DB->query($sql);
		$CACHE = Cache::getInstance();
		if ($ischkcomment == 'n') {
			$DB->query('UPDATE '.DB_PREFIX."blog SET comnum = comnum + 1 WHERE gid='$blogId'");
			$CACHE->updateCache(array('sta', 'comment'));
            doAction('comment_saved');
            header("Location: ".'./?post=' . $blogId);
		} else {
		    $CACHE->updateCache('sta');
		    doAction('comment_saved');
		    mMsg('Đã gửi nhận xét, hãy chờ kiểm duyệt.', './?post=' . $blogId);
		}
    }
}
if ($action == 'com') {
	if (ISLOGIN === true) {
		$hide = '';
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

		$Comment_Model = new Comment_Model();

		$comment = $Comment_Model->getComments(1, null, $hide, $page);
		$cmnum = $Comment_Model->getCommentNum(null, $hide);
		$pageurl = pagination($cmnum, Option::get('admin_perpage_num'), $page, "./?action=com&page");
	}else {
		$comment = $CACHE->readCache('comment');
		$pageurl = '';
	}
	include View::getView('header');
	include View::getView('comment');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 'delcom') {
	$Comment_Model = new Comment_Model();
	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Comment_Model->delComment($id);
	$CACHE->updateCache(array('sta','comment'));
	header("Location: ./?action=com");
}
if (ISLOGIN === true && $action == 'showcom') {
	$Comment_Model = new Comment_Model();
	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Comment_Model->showComment($id);
	$CACHE->updateCache(array('sta','comment'));
	header("Location: ./?action=com");
}
if (ISLOGIN === true && $action == 'hidecom') {
	$Comment_Model = new Comment_Model();
	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Comment_Model->hideComment($id);
	$CACHE->updateCache(array('sta','comment'));
	header("Location: ./?action=com");
}
if ($action == 'reply') {
	$Comment_Model = new Comment_Model();
	$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	$commentArray = $Comment_Model->getOneComment($cid);
	if(!$commentArray) {
		mMsg('Thông số lỗi', './');
	}
	extract($commentArray);
	$verifyCode = Option::get('comment_code') == 'y' ? "<img src=\"../include/lib/checkcode.php\" /><br /><input name=\"imgcode\" type=\"text\" />" : '';
	include View::getView('header');
	include View::getView('reply');
	include View::getView('footer');
	View::output();
}
// Twitter
if ($action == 'tw') {
    $Twitter_Model = new Twitter_Model();
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $user_cache = $CACHE->readCache('user');
    $tws = $Twitter_Model->getTwitters($page);
    $twnum = $Twitter_Model->getTwitterNum();
    $pageurl =  pagination($twnum, Option::get('index_twnum'), $page, './?action=tw&page');

	include View::getView('header');
	include View::getView('twitter');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 't') {
    $Twitter_Model = new Twitter_Model();

    $t = isset($_POST['t']) ? addslashes(trim($_POST['t'])) : '';
    if (!$t){
        header ("Location: ./?action=tw");
        exit;
    }
    $tdata = array('content' => $Twitter_Model->formatTwitter($t),
            'author' => UID,
            'date' => time(),
    );
    $Twitter_Model->addTwitter($tdata);
    $CACHE->updateCache(array('sta','newtw'));
    doAction('post_twitter', $t);
    header ("Location: ./?action=tw");
}
if (ISLOGIN === true && $action == 'delt') {
    $Twitter_Model = new Twitter_Model();
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Twitter_Model->delTwitter($id);
	$CACHE->updateCache(array('sta','newtw'));
	header("Location: ./?action=tw");
}
if ($action == 'login') {
	Option::get('login_code') == 'y' ? $ckcode = "<span>Mã xác nhận: </span>
    <div class=\"val\"><img src=\"../include/lib/checkcode.php\" /><br />
	<input name=\"imgcode\" id=\"imgcode\" type=\"text\" />
    </div>" : $ckcode = '';
	include View::getView('header');
	include View::getView('login');
	include View::getView('footer');
	View::output();
}
if ($action == 'auth') {
	session_start();
	$username = addslashes(trim($_POST['user']));
	$password = addslashes(trim($_POST['pw']));
	$img_code = (Option::get('login_code') == 'y' && isset ($_POST['imgcode'])) ? addslashes (trim (strtoupper ($_POST['imgcode']))) : '';
	$ispersis = true;
	if (checkUser($username, $password, $img_code) === true) {
		setAuthCookie($username, $ispersis);
		header("Location: ?tem=" . time());
	}else {
		header("Location: ?action=login");
	}
}
if ($action == 'logout') {
	setcookie(AUTH_COOKIE_NAME, ' ', time () - 31536000, '/');
	header("Location: ?tem=" . time());
}
function mMsg($msg, $url) {
	include View::getView('header');
	include View::getView('msg');
	include View::getView('footer');
	View::output();
}
function authPassword($postPwd, $cookiePwd, $logPwd, $logid) {
	$pwd = $cookiePwd ? $cookiePwd : $postPwd;
	if ($pwd !== addslashes($logPwd)) {
		include View::getView('header');
		include View::getView('logauth');
		include View::getView('footer');
		if ($cookiePwd) {
			setcookie('em_logpwd_' . $logid, ' ', time() - 31536000);
		}
		View::output();
	}else {
		setcookie('em_logpwd_' . $logid, $logPwd);
	}
}
