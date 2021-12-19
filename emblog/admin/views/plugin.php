<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Quản lý plugin</b><div id="msg"></div>
<?php if(isset($_GET['active'])):?><span class="actived">Cài đặt plugin thành công.</span><?php endif;?>
<?php if(isset($_GET['active_error'])):?><span class="error">Cài đặt plugin không thành công.</span><?php endif;?>
<?php if(isset($_GET['inactive'])):?><span class="actived">Vô hiệu hóa plugin thành công.</span><?php endif;?>
</div>
<div class=line></div>
<form action="trackback.php?action=dell_all_tb" method="post">
  <table width="100%" id="adm_plugin_list" class="item_list">
  <thead>
      <tr>
        <th width="100" class="tdcenter">Tên plugin</th>
        <th width="36" class="tdcenter"><b>Tình trạng</b></th>
		<th width="30" class="tdcenter"><b>Phiên bản</b></th>
		<th width="500" class="tdcenter"><b>Mô tả</b></th>
      </tr>
  </thead>
  <tbody>
	<?php 
	$i = 0;
	foreach($plugins as $key=>$val):
		$plug_state = 'inactive';
		$plug_action = 'active';
		$plug_state_des = 'Không hoạt động';
		if (in_array($key, $active_plugins))
		{
			$plug_state = 'active';
			$plug_action = 'inactive';
			$plug_state_des = 'Đã kích hoạt';
		}
		$i++;
	?>	
      <tr>
        <td class="tdcenter"><?php echo $val['Name']; ?></td>
		<td class="tdcenter" id="plugin_<?php echo $i;?>">
		<a href="./plugin.php?action=<?php echo $plug_action;?>&plugin=<?php echo $key;?>"><img src="./views/images/plugin_<?php echo $plug_state; ?>.gif" title="<?php echo $plug_state_des; ?>" align="absmiddle" border="0"></a>
		</td>
        <td class="tdcenter"><?php echo $val['Version']; ?></td>
        <td>
		<?php echo $val['Description']; ?>
		<?php if ($val['Url'] != ''):?><a href="<?php echo $val['Url'];?>" target="_blank">Link &raquo;</a><?php endif;?>
		<br />
		<?php if ($val['Author'] != ''):?>
		Tác giả:
			<?php if ($val['Email'] != ''):?>
			<a href="mailto:<?php echo $val['Email'];?>"><b><?php echo $val['Author'];?></b></a>
			<?php else:?>
			<?php echo $val['Author'];?>
			<?php endif;?>
		<?php endif;?>
		<?php if ($val['AuthorUrl'] != ''):?> - <a href="<?php echo $val['AuthorUrl'];?>" target="_blank">Trang chủ</a><?php endif;?>
		</td>
      </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
</form>
<div style="margin:30px 0px 10px 3px;">
    <a href="http://www.emlog.net/extend/plugins" target="_blank">Lấy thêm plugin &raquo;</a>
    <a href="javascript: em_confirm(0, 'reset_plugin');" style="margin-left:30px;">Vô hiệu tất cả &raquo;</a>
</div>
<script>
$("#adm_plugin_list tbody tr:odd").addClass("tralt_b");
$("#adm_plugin_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")})
setTimeout(hideActived,2600);
$("#menu_plug").addClass('sidebarsubmenu1');
</script>