<?php 
/*
* 底部信息
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
       </div>

       <div id="footer" class="clear">
       	 <div class="wrap">
       	  <span>Powered By <a href="http://www.tienvu.tv" title="emlog <?php echo Option::EMLOG_VERSION;?>">emlog</a> Theme Designed By <a href="http://www.tienvu.tv" target="_blank">TienVu</a>. <?php echo $icp; ?> <?php echo $footer_info; ?></span>
         </div>
       </div>
</div>
<?php doAction('index_footer'); ?>
</body>
</html>
