<?php
/*
Template Name: V-Share Piol
Description: Giao diện trắng phong cách...
Author: C7SKY.COM - Convert: NICKY
Author Url: http://nhatnamz.info
Sidebar Amount: 1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $blogtitle; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body>
<body class="home blog"> 
<div id="wrapper"> 
	<div id="header"> 
		<div id="masthead"> 
			<h1 id="logo"> 
				<a href="index.php" title="<?php echo $blogtitle; ?>" rel="home"><img src="<?php echo TEMPLATE_URL; ?>images/logo.png" alt="<?php echo $blogtitle; ?>"></a> 
			</h1> 
			<div id="rss"> 
				<a href="rss.php" target="_blank"><img src="<?php echo TEMPLATE_URL; ?>images/rss.png" alt="Xem RSS"></a> 
			</div> 
			<div id="menu"> 
				<div>
				    <ul class="menu">
					<li class="<?php echo $curpage == CURPAGE_HOME ? 'current' : 'common';?>"><a href="<?php echo BLOG_URL; ?>">Trang chủ</a></li>
					<?php if($istwitter == 'y'):?>
					<li class="<?php echo $curpage == CURPAGE_TW ? 'current' : 'common';?>"><a href="<?php echo BLOG_URL; ?>t/"><?php echo Option::get('twnavi');?></a></li>
					<?php endif;?>
					<?php 
						foreach ($navibar as $key => $val):
						if ($val['hide'] == 'y'){continue;}
						if (empty($val['url'])){$val['url'] = BLOG_URL.'?post='.$key;}
					?>
					<li class="<?php echo isset($logid) && $key == $logid ? 'current' : 'common';?>"><a href="<?php echo $val['url']; ?>" target="<?php echo $val['is_blank']; ?>"><?php echo $val['title']; ?></a></li>
					<?php endforeach;?>
					<?php doAction('navbar', '<li class="common">', '</li>'); ?>
					<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
					<li class="common"><a href="<?php echo BLOG_URL; ?>admin/write_log.php">Viết bài</a></li>
					<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">Quản lý</a></li>
					<li class="common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">Thoát</a></li>
					<?php else: ?>
					<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">Quản lý</a></li>
					<?php endif; ?>
					</ul>
				</div>
				<a href="http://vn-max.net" title="VN-MAX.net" target="_blank" id="mblog" class="qq">VN-MAX.net</a> 
				<form method="get" action="<?php echo BLOG_URL; ?>index.php" id="searchform"> 
					<div> 
						<input type="text" value="" name="s" id="s"/> 
						<input type="submit" onclick="return keyw()" id="searchsubmit" value="Tìm kiếm" /> 
					</div> 
				</form> 
			</div> 
		</div> 
	</div> 
	<div id="main">
		<div id="container"> 
		<div id="ann"> 
		<div class="col-top"></div> 
		<div class="col-mid"> 
			<img src="<?php echo TEMPLATE_URL; ?>images/megaphone.gif" alt="Loa"> 
			<p>Chào mừng đến với <?php echo $blogname; ?>. Chúc các bạn vui vẻ!!! :)~</p> 
		</div> 
		<div class="col-btm"></div> 
	</div> 