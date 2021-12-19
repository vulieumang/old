<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<div class=containertitle><b>Quản lý templates</b><?php if(isset($_GET['activated'])):?><span class="actived">Thay đổi template thành công</span><?php endif;?></div>
<div class=line></div>
<?php if(!$nonceTplData): ?>
<div class="error_msg">Template đang sử dụng (<?php echo $nonce_templet; ?>) đã bị xóa hoặc hỏng. Hãy chọn template khác.</div>
<?php else:?>
<table cellspacing="10" cellpadding="0" width="80%" border="0">
    <tr>
      <td width="27%">
	  <a title="Cick để xem hình gốc" href="<?php echo TPLS_URL.$nonce_templet; ?>/preview.jpg" target="_blank"><img src="<?php echo TPLS_URL.$nonce_templet; ?>/preview.jpg" width="300" height="225"  border="1" /></a></td>
	  <td width="73%">
	  <?php echo $tplName; ?><br>
	  <?php echo $tplAuthor; ?><br>
	  <?php echo $tplDes; ?><br>
	  <?php if ('default' == $nonce_templet): ?>
	  <div class="custom_top_button"><a href="./template.php?action=custom-top">Chỉnh đầu trang</a></div>
	  <?php endif; ?>
	  </td>
    </tr>
</table>
<?php endif;?>
<div class=containertitle><b>Thư viện template</b></div>
<div class=template_line>Số templates: <?php echo $tplnums; ?><br><a href="http://www.emlog.net/template/" target="_blank">Tải template &raquo;</a></div>
<table cellspacing="0" cellpadding="0" width="99%" border="0" class="adm_tpl_list">
<?php 
$i = 0;
foreach($tpls as $key=>$value):
if($i % 3 == 0){echo "<tr>";}
$i++;
?>
      <td align="center" width="300">
	  <a href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>">
	  <img title="Nhấn vào để kích hoạt template này" src="<?php echo TPLS_URL.$value['tplfile']; ?>/preview.jpg" width="180" height="150" border="0" />
	  </a><br />
      <b><a href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>" title="Kích hoạt template này!"><?php echo $value['tplname']; ?></a></b><br />
      </td>
<?php 
if($i > 0 && $i % 3 == 0){echo "</tr>";}
endforeach; 
?>
</table>