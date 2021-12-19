<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Danh sách trang</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa trang thành công!</span><?php endif;?>
<?php if(isset($_GET['active_hide_n'])):?><span class="actived">Đăng trang thành công!</span><?php endif;?>
<?php if(isset($_GET['active_hide_y'])):?><span class="actived">Ẩn trang thành công!</span><?php endif;?>
<?php if(isset($_GET['active_pubpage'])):?><span class="actived">Lưu trang thành công!</span><?php endif;?>
</div>
<div class=line></div>
<form action="page.php?action=operate_page" method="post" name="form_page" id="form_page">
  <table width="100%" id="adm_comment_list" class="item_list">
  	<thead>
      <tr>
      	<th width="21"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></th>
        <th width="460"><b>Tên trang</b></th>
        <th width="30" class="tdcenter"><b>Nhận xét</b></th>
        <th width="280"><b>Ngày đăng</b></th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($pages as $key => $value):
	if (empty($navibar[$value['gid']]['url']))
	{
		$navibar[$value['gid']]['url'] = Url::log($value['gid']);
	}
	$isHide = $value['hide'] == 'y' ? 
	'<font color="red">[Ẩn]</font>' : 
	'<a href="'.$navibar[$value['gid']]['url'].'" target="_blank" title="Xem trong trang mới"><img src="./views/images/vlog.gif" align="absbottom" border="0" /></a>';
	?>
     <tr>
     	<td><input type="checkbox" name="page[]" value="<?php echo $value['gid']; ?>" class="ids" /></td>
        <td>
        <a href="page.php?action=mod&id=<?php echo $value['gid']?>"><?php echo $value['title']; ?></a> 
        <?php echo $value['attnum']; ?>
        <?php echo $isHide; ?>
        </td>
        <td class="tdcenter"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
        <td><?php echo $value['date']; ?></td>
     </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
  <input name="operate" id="operate" value="" type="hidden" />
</form>
<div class="list_footer">Thao tác: 
<a href="javascript:pageact('del');">Xóa</a> | 
<a href="javascript:pageact('hide');">Ẩn</a> | 
<a href="javascript:pageact('pub');">Hiện</a>
</div>
<div style="margin:20px 0px 0px 0px;"><a href="page.php?action=new">+ Tạo trang mới</a></div>
<div class="page"><?php echo $pageurl; ?> (Có <?php echo $pageNum; ?> trang)</div>
<script>
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
function pageact(act){
	if (getChecked('ids') == false) {
		alert('Hãy chọn trang');
		return;}
	if(act == 'del' && !confirm('Bạn có muốn xóa trang này không?')){return;}
	$("#operate").val(act);
	$("#form_page").submit();
}
$("#menu_page").addClass('sidebarsubmenu1');
</script>