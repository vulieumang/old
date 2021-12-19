<?php
/**
 * Quan ly du lieu
 * @copyright (c) Emlog All Rights Reserved
 * $Id: data.php 1880 2011-03-31 05:00:57Z qiyuuu $
 */

require_once 'globals.php';

if($action == ''){
	$retval = glob('../content/backup/*.sql');
	$bakfiles = $retval ? $retval : array();
	$timezone = Option::get('timezone');
	$tables = array('attachment', 'blog', 'comment', 'options', 'reply', 'sort', 'link','tag','trackback','twitter','user');
	$defname = 'emlog_'. gmdate('dmY', time() + $timezone * 3600) . '_' . substr(md5(gmdate('dmYHis', time() + $timezone * 3600)),0,18);
	doAction('data_prebakup');

	include View::getView('header');
	require_once(View::getView('data'));
	include View::getView('footer');
	View::output();
}

if($action == 'bakstart'){
	$bakfname = isset($_POST['bakfname']) ? $_POST['bakfname'] : '';
	$table_box = isset($_POST['table_box']) ? array_map('addslashes', $_POST['table_box']) : array();
	$bakplace = isset($_POST['bakplace']) ? $_POST['bakplace'] : 'local';

	$timezone = Option::get('timezone');

	if(!preg_match("/^[a-zA-Z0-9_]+$/",$bakfname)){
		header("Location: ./data.php?error_b=true");
		exit;
	}
	$filename = '../content/backup/'.$bakfname.'.sql';

	$sqldump = '';
	foreach($table_box as $table){
		$sqldump .= dataBak($table);
	}
	if(trim($sqldump)){
		$dumpfile = '#version:emlog '. Option::EMLOG_VERSION . "\n";
		$dumpfile .= '#date:' . gmdate('d-m-Y H:i', time() + $timezone * 3600) . "\n";
		$dumpfile .= '#tableprefix:' . DB_PREFIX . "\n";
		$dumpfile .= $sqldump;
		$dumpfile .= "\n#the end of backup";
		if($bakplace == 'local'){
			header('Content-Type: text/x-sql');
			header('Expires: '. gmdate('D, d M Y H:i:s', time() + $timezone * 3600) . ' GMT');
			header('Content-Disposition: attachment; filename=emlog_'. gmdate('dmY', time() + $timezone * 3600).'.sql');
			if (preg_match("/MSIE ([0-9].[0-9]{1,2})/", $_SERVER['HTTP_USER_AGENT'])){
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
			} else {
				header('Pragma: no-cache');
				header('Last-Modified: '. gmdate('D, d M Y H:i:s', time() + $timezone * 3600) . ' GMT');
			}
			echo $dumpfile;
		} else {
			@$fp = fopen($filename, 'w+');
			if ($fp)
			{
				@flock($fp, 3);
				if(@!fwrite($fp, $dumpfile))
				{
					@fclose($fp);
					emMsg('Sao lưu không thành công! Vui lòng CHMOD thư mục (content/backup)','javascript:history.go(-1);',0);
				}else{
					header("Location: ./data.php?active_backup=true");
				}
			}else{
				emMsg('Sao lưu không thành công! Vui lòng CHMOD thư mục (content/backup)','javascript:history.go(-1);');
			}
		}
	}else{
		formMsg('Không có dữ liệu!','javascript:history.go(-1);',0);
	}
}

// Nhap tap tin sao luu
if ($action == 'renewdata'){
	$sqlfile = isset($_GET['sqlfile']) ? $_GET['sqlfile'] : '';
	if (!file_exists($sqlfile)){
		formMsg('Tập tin không tồn tại!', 'javascript:history.go(-1);',0);
	}

	if (getFileSuffix($sqlfile) !== 'sql'){
		formMsg('Chỉ có thể nhập dạng .SQL', 'javascript:history.go(-1);',0);
	}
	checkSqlFileInfo($sqlfile);
	bakindata($sqlfile);
	$CACHE->updateCache();
	header("Location: ./data.php?active_import=true");
}

// Nhap tap tin sao luu
if ($action == 'import'){
	$sqlfile = isset($_FILES['sqlfile']) ? $_FILES['sqlfile'] : '';
	if (!$sqlfile) {
		formMsg('Thông tin không hợp lệ!', 'javascript:history.go(-1);',0);
	}
	if (getFileSuffix($sqlfile['name']) != 'sql') {
		formMsg('Chỉ có thể nhập dạng .SQL', 'javascript:history.go(-1);',0);
	}
	if ($sqlfile['error'] == 1){
		formMsg('Vượt quá dung lượng giới hạn '.ini_get('upload_max_filesize').'', 'javascript:history.go(-1);', 0);
	}elseif ($sqlfile['error'] > 1){
		formMsg('Tải lên không thành công: '.$sqlfile['error'], 'javascript:history.go(-1);', 0);
	}
	checkSqlFileInfo($sqlfile['tmp_name']);
	bakindata($sqlfile['tmp_name']);
	$CACHE->updateCache();
	header("Location: ./data.php?active_import=true");
}

// Xoa tap tin sao luu
if($action == 'dell_all_bak'){
	if(!isset($_POST['bak'])){
		header("Location: ./data.php?error_a=true");
	}else{
		foreach($_POST['bak'] as $val){
			unlink($val);
		}
		header("Location: ./data.php?active_del=true");
	}
}

// Cap nhat bo nho dem
if ($action == 'Cache'){
	$CACHE->updateCache();
	header("Location: ./data.php?active_mc=true");
}

/**
 * Kiem tra tap tin sao luu
 * 
 * @param file $sqlfile
 */
function checkSqlFileInfo($sqlfile) {
	// Dpc thong tin
	$fp = @fopen($sqlfile, 'r');
	if ($fp){
		$dumpinfo = array();
		$line = 0;
		while (!feof($fp)){
			$dumpinfo[] = fgets($fp, 4096);
			$line++;
			if ($line == 3) break;
		}
		fclose($fp);
		if (!empty($dumpinfo)){
			// Kiem tra phien ban
			if (preg_match('/#version:emlog '. Option::EMLOG_VERSION .'/', $dumpinfo[0]) === 0) {
				formMsg("Nhập không thành công! Sai phiên bản", 'javascript:history.go(-1);',0);
			}
			// Kiem tra tien to
			if (preg_match('/#tableprefix:'. DB_PREFIX .'/', $dumpinfo[2]) === 0) {
				formMsg("Nhập không thành công! tiền tố không phù hợp!" . $dumpinfo[2], 'javascript:history.go(-1);',0);
			}
		} else {
			formMsg("Nhập không thành công! Sai định dạng!", 'javascript:history.go(-1);',0);
		}
	} else {
		formMsg("Nhập không thành công! Không thể đọc tập tin!", 'javascript:history.go(-1);',0);
	}
}

/**
 * Sao luu tap tin SQl
 *
 * @param string $filename
 */
function bakindata($filename) {
	global $db;
	$DB = MySql::getInstance();
	$setchar = $DB->getMysqlVersion() > '4.1' ? "ALTER DATABASE {$db} DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;" : '';
	$sql = file($filename);
	if(isset($sql[0]) && !empty($sql[0]) && checkBOM($sql[0])) {
	    $sql[0] = substr($sql[0], 3);
	}
	array_unshift($sql,$setchar);
	$query = '';
	foreach($sql as $value){
		$value = trim($value);
		if(!$value || $value[0]=='#'){
			continue;
		}
		if(preg_match("/\;$/i", $value)){
			$query .= $value;
			if(preg_match("/^CREATE/i", $query)){
				$query = preg_replace("/\DEFAULT CHARSET=([a-z0-9]+)/is",'',$query);
			}
			$DB->query($query);
			$query = '';
		} else{
			$query .= $value;
		}
	}
}

/**
 * Sao luu csdl va cau truc
 *
 * @param string $table
 * @return string
 */
function dataBak($table){
	$DB = MySql::getInstance();
	$sql = "DROP TABLE IF EXISTS $table;\n";
	$createtable = $DB->query("SHOW CREATE TABLE $table");
	$create = $DB->fetch_row($createtable);
	$sql .= $create[1].";\n\n";

	$rows = $DB->query("SELECT * FROM $table");
	$numfields = $DB->num_fields($rows);
	$numrows = $DB->num_rows($rows);
	while ($row = $DB->fetch_row($rows)){
		$comma = "";
		$sql .= "INSERT INTO $table VALUES(";
		for ($i = 0; $i < $numfields; $i++){
			$sql .= $comma."'".mysql_escape_string($row[$i])."'";
			$comma = ",";
		}
		$sql .= ");\n";
	}
	$sql .= "\n";
	return $sql;
}

/**
 * Kiem tra tap tin BOM(byte-order mark)
 */
function checkBOM($contents) {
    $charset[1] = substr($contents, 0, 1);
    $charset[2] = substr($contents, 1, 1);
    $charset[3] = substr($contents, 2, 1);
    if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) {
        return true;
    } else {
        return false;
    }
}
