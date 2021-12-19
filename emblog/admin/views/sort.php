<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<script>setTimeout(hideActived,2600);</script>
<div class=containertitle><b>Quản lý phân loại</b>
<?php if(isset($_GET['active_taxis'])):?><span class="actived">Cập nhật phân loại thành công!</span><?php endif;?>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa phân loại thành công!</span><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><span class="actived">Sửa phân loại thành công!</span><?php endif;?>
<?php if(isset($_GET['active_add'])):?><span class="actived">Thêm phân loại thành công!</span><?php endif;?>
<?php if(isset($_GET['error_a'])):?><span class="error">Vui lòng nhập tên phân loại!</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">Chưa có phân loại!</span><?php endif;?>
<?php if(isset($_GET['error_c'])):?><span class="error">Liên kết chỉ được sử dụng chữ cái, chữ số, gạch ngang "-" và gạch dưới "_"!</span><?php endif;?>
<?php if(isset($_GET['error_d'])):?><span class="error">Liên kết bị trùng!</span><?php endif;?>
<?php if(isset($_GET['error_e'])):?><span class="error">Xung đột với hệ thống liên kết!</span><?php endif;?>
<?php if(isset($_GET['error_f'])):?><span class="error">Liên kết không thể toàn số!</span><?php endif;?>

</div>
<div class=line></div>
<form  method="post" action="sort.php?action=taxis">
  <table width="100%" id="adm_sort_list" class="item_list">
    <thead>
      <tr>
        <th width="55"><b>STT</b></th>
        <th width="300"><b>Tên phân loại</b></th>
		<th width="300"><b>Liên kết</b></th>
        <th width="50" class="tdcenter"><b>Bài viết</b></th>
        <th width="100"></th>
      </tr>
    </thead>
    <tbody>
<?php foreach($sorts as $key=>$value): ?>
      <tr>
        <td>
        <input type="hidden" value="<?php echo $value['sid'];?>" class="sort_id" />
        <input maxlength="4" class="num_input" name="sort[<?php echo $value['sid']; ?>]" value="<?php echo $value['taxis']; ?>" /></td>
		<td class="sortname"><?php echo $value['sortname']; ?></td>
		<td class="alias"><?php echo $value['alias']; ?></td>
		<td class="tdcenter"><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><?php echo $value['lognum']; ?></a></td>
        <td><a href="javascript: em_confirm(<?php echo $value['sid']; ?>, 'sort');">Xóa</a></td>
      </tr>
<?php endforeach;?>   
</tbody>
</table>
<div class="list_footer"><input type="submit" value="Lưu thay đổi" class="submit" /></div>
</form>
<form action="sort.php?action=add" method="post">
<div style="margin:30px 0px 10px 0px;"><a href="javascript:displayToggle('sort_new', 2);">+ Tạo phân loại mới</a></div>
<div id="sort_new">
	<li>Số thứ tự</li>
	<li><input maxlength="4" style="width:200px;" name="taxis" /></li>
	<li>Tên phân loại</li>
	<li><input maxlength="200" style="width:200px;" name="sortname" id="sortname" /></li>
	<li>Liên kết</li>
	<li><input maxlength="200" style="width:200px;" name="alias" id="alias" /> (Giúp URL thân thiện hơn)</li><br>
	<li><input type="submit" id="addsort" value="Thêm" class="submit"/><span id="alias_msg_hook"></span></li>
</div>
</form>
<script>
$("#sort_new").css('display', $.cookie('em_sort_new') ? $.cookie('em_sort_new') : 'none');
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
	var reg1=/^[\w-]*$/;
	var reg2=/^[\d]+$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
		return 3;
	} else {
		return 0;
	}
}
function checksortalias(){
	var a = $.trim($("#alias").val());
	if (1 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">Liên kết chỉ được sử dụng chữ cái, chữ số, gạch ngang "-" và gạch dưới "_"!</span>');
	}else if (2 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">Liên kết không thể toàn số!</span>');
	}else if (3 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">Xung đột với hệ thống liên kết!</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
		$("#addsort").attr("disabled", '');
	}
}
$(document).ready(function(){
	$("#adm_sort_list tbody tr:odd").addClass("tralt_b");
	$("#adm_sort_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")});
	$(".sortname").click(function a(){
		if($(this).find(".sort_input").attr("type") == "text"){return false;}
		var name = $.trim($(this).html());
		var m = $.trim($(this).text());
		$(this).html("<input type=text value=\""+name+"\" class=sort_input>");
		$(this).find(".sort_input").focus();
		$(this).find(".sort_input").bind("blur", function(){
			var n = $.trim($(this).val());
			if(n != m && n != ""){
				window.location = "sort.php?action=update&sid="+$(this).parent().parent().find(".sort_id").val()+"&name="+encodeURIComponent(n);
			}else{
				$(this).parent().html(name);
			}
		});
	});
	$(".alias").click(function b(){
		if($(this).find(".alias_input").attr("type") == "text"){return false;}
		var name = $.trim($(this).html());
		var m = $.trim($(this).text());
		$(this).html("<input type=text value=\""+name+"\" class=alias_input>");
		$(this).find(".alias_input").focus();
		$(this).find(".alias_input").bind("blur", function(){
			var n = $.trim($(this).val());
			if(n != m){
				window.location = "sort.php?action=update&sid="+$(this).parent().parent().find(".sort_id").val()+"&alias="+encodeURIComponent(n);
			}else{
				$(this).parent().html(name);
			}
		});
	});
	$("#menu_sort").addClass('sidebarsubmenu1');
});
</script>