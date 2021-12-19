<?php
/**
 * Quan ly chung
 * @copyright (c) Emlog All Rights Reserved
 * $Id: index.php 1825 2011-02-04 15:06:55Z emloog $
 */

require_once 'globals.php';

if ($action == '') {
	$user_cache = $CACHE->readCache('user');
    $avatar = empty($user_cache[UID]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[UID]['avatar'];
    $name =  $user_cache[UID]['name'];

    $sta_log = ROLE == 'admin' ? $sta_cache['lognum'] : $sta_cache[UID]['lognum'];
    $sta_tw = ROLE == 'admin' ? $sta_cache['twnum'] : $sta_cache[UID]['twnum'];

	$serverapp = $_SERVER['SERVER_SOFTWARE'];
	$DB = MySql::getInstance();
	$mysql_ver = $DB->getMysqlVersion();
	$php_ver = PHP_VERSION;
	$uploadfile_maxsize = ini_get('upload_max_filesize');
	$safe_mode = ini_get('safe_mode');

	if (function_exists("imagecreate"))
	{
		if(function_exists('gd_info'))
		{
			$ver_info = gd_info();
			$gd_ver = $ver_info['GD Version'];
		}else{
			$gd_ver = 'Có hỗ trợ';
		}
	}else{
		$gd_ver = 'Không hỗ trợ';
	}

	include View::getView('header');
	require_once(View::getView('index'));
	include View::getView('footer');
	View::output();
}
// Phpinfo()
if ($action == 'phpinfo') {
	@phpinfo() OR formMsg("PHPINFO đã bị vô hiệu!", "javascript:history.go(-1);", 0);
}
