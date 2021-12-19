<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tải lên</title>
<link href="./views/css/css-att.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="./views/js/common.js"></script>
</head>
<script>
function showupload()
{
	var as_logid = parent.document.getElementById('as_logid').value
	window.location.href="attachment.php?action=selectFile&logid="+as_logid;	
}
function showattlib()
{
	var as_logid = parent.document.getElementById('as_logid').value
	window.location.href="attachment.php?action=attlib&logid="+as_logid;	
}
</script>
<body>
<div id="media-upload-header">
	<span><a href="javascript:showupload();">Đính kèm</a></span>
	<span id="curtab"><a href="javascript:showattlib();">Danh sách (<?php echo $attachnum; ?>)</a></span>
</div>
<div id="media-upload-body">
<?php if(!$attach): ?>
<p id="attmsg">Bài viết không có đính kèm</p>
<?php else:
foreach($attach as $key=>$value):
	$extension  = strtolower(substr(strrchr($value['filepath'], "."),1));
	$atturl = BLOG_URL.substr(str_replace('thum-','',$value['filepath']),3);
	$emImageType = array('gif', 'jpg', 'jpeg', 'png', 'bmp');// Dinh dang anh cho phep
	if($extension == 'zip' || $extension == 'rar'){
		$imgpath = "./views/images/tar.gif";
		$embedlink = '';
	}elseif (in_array($extension, $emImageType)) {
		$imgpath = $value['filepath'];
		$ed_imgpath = BLOG_URL.substr($imgpath,3);
		$embedlink = "<a href=\"javascript: parent.addattach('$atturl','$ed_imgpath',{$value['aid']});\">Mã</a>";
	}else {
		$imgpath = "./views/images/fnone.gif";
		$embedlink = '';
	}
?>
	<li id="attlist"><a href="<?php echo $atturl; ?>" target="_blank" title="<?php echo $value['filename']; ?>"><img src="<?php echo $imgpath; ?>" width="60" height="60" border="0" align="absmiddle"/></a>
	<br><a href="javascript: em_confirm(<?php echo $value['aid']; ?>, 'attachment');">Xóa</a> <?php echo $embedlink; ?></li>
<?php endforeach; endif; ?>
</div>
</body>
</html>