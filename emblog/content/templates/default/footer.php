<?php 
/*
* Chan trang
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div>
<div style="clear:both;"></div>
<div id="footerbar">
Powered: <a href="http://www.emlog.net" title="emlog <?php echo Option::EMLOG_VERSION;?>">Emlog</a> - Việt hóa: <a href="http://v-share.info">V-Share Team</a> - Tested: <a href="http://vn-max.net">VN-MAX.net</a> <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
<?php doAction('index_footer'); ?>
</div>
</body>
</html>