<?php
/*
Template Name:Inkandwash
Description:Inkandwash...
Author:Xiaozi
Author Url:http://xiaozi.littlefox.name/
Sidebar Amount:1
ForEmlog:4.1.0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once (View::getView('module'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<title><?php echo $blogtitle; ?></title>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>style.css" type="text/css" media="screen" />
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/DD_belatedPNG.js"></script>
<script>DD_belatedPNG.fix('.logo,.nav li,.searchsm'); </script>
<![endif]-->
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>

<body>
   <div id="fullwrapper">
       <div class="wrap">
           <div class="header">
               <div class="logo">
                    <li id="title"><h1><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1></li>
			        <li id="tagline"><?php echo $bloginfo; ?></li>
                </div>
               	<ul class="nav">
					<li><a href="<?php echo BLOG_URL; ?>">Home</a></li>
					<li><a href="<?php echo BLOG_URL; ?>about/">About</a></li>
				    <?php if($istwitster == 'y'):?>
        			<li class="<?php echo $curpage == CURPAGE_TW ? 'current' : 'common';?>"><a href="<?php echo BLOG_URL; ?>about/"><?php echo Option::get('twnavi');?></a></li>
        			<?php endif;?>
					<?php 
					foreach ($navibar as $key => $val):
					if ($val['hide'] == 'y'){continue;}
					if (empty($val['url'])){$val['url'] = Url::log($key);}
					?>
					<li><a href="<?php echo $val['url']; ?>" target="<?php echo $val['is_blank']; ?>"><?php echo $val['title']; ?></a></li>
					<?php endforeach;?>
					<?php doAction('navbar', '<li>', '</li>'); ?>
                </ul>
           </div>
       </div>
       <div class="wrap">