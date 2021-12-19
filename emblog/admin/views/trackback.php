<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>
$(document).ready(function(){
	$("#adm_tb_list tbody tr:odd").addClass("tralt_b");
	$("#adm_tb_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
</script>
<div class=containertitle><b>Quản lý trích dẫn</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa trích dẫn thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Hãy chọn trích dẫn!</span><?php endif;?>
</div>
<div class=line></div>
<form action="trackback.php?action=dell" method="post" name="form_tb" id="form_tb">
  <table width="100%" id="adm_tb_list" class="item_list">
  <thead>
      <tr>
        <th width="10"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></th>
        <th width="270"><b>Tiêu đề</b></th>
        <th width="300"><b>Nguồn</b></th>
		<th width="80"><b>IP</b></th>
        <th width="120"><b>Thời gian</b></th>
      </tr>
  </thead>
  <tbody>
	<?php foreach($trackback as $key=>$value):?>	
      <tr>
        <td><input type="checkbox" name="tb[]" value="<?php echo $value['tbid']; ?>" class="ids" ></td>
        <td><a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['title']; ?></a></td>
        <td><?php echo $value['blog_name']; ?></td>
        <td><?php echo $value['ip']; ?></td>
        <td><?php echo $value['date']; ?></td>
      </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
<div class="list_footer">Thao tác: <a href="javascript:tbact('del');">Xóa</a></div>
<div class="page"><?php echo $pageurl; ?>(Có <?php echo $tbnum; ?> trích dẫn)</div> 
</form>
<script>
function tbact(act){
	if (getChecked('ids') == false) {
		alert('hãy chọn trích dẫn');
		return;
	}
	if(act == 'del' && !confirm('Bạn có muốn xóa trích dẫn này không?')){return;}
	$("#operate").val(act);
	$("#form_tb").submit();
}
$("#menu_tb").addClass('sidebarsubmenu1');
</script>