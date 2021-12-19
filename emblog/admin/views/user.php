<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class=containertitle><b>Người dùng</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">Xóa người dùng thành công!</span><?php endif;?>
<?php if(isset($_GET['active_update'])):?><span class="actived">Sửa thông tin người dùng thành công!</span><?php endif;?>
<?php if(isset($_GET['active_add'])):?><span class="actived">Thêm người dùng thành công!</span><?php endif;?>
<?php if(isset($_GET['error_login'])):?><span class="error">Hãy nhập tài khoản!</span><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><span class="error">Tài khoản đã tồn tại!</span><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><span class="error">Mật khẩu từ 6 ký tự trở lên!</span><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><span class="error">Hai mật khẩu không phù hợp!</span><?php endif;?>
</div>
<div class=line></div>
<form action="comment.php?action=admin_all_coms" method="post" name="form" id="form">
  <table width="100%" id="adm_comment_list" class="item_list">
  	<thead>
      <tr>
        <th width="90"><b>Tài khoản</b></th>
        <th width="70"><b>Nickname</b></th>
        <th width="170"><b>Tự bạch</b></th>
        <th width="150"><b>Email</b></th>
		<th width="80" class="tdcenter"><b>Đăng nhập</b></th>
		<th width="130"></th>
      </tr>
    </thead>
    <tbody>
	<?php
	$user_cache = $CACHE->readCache('user');
	foreach($users as $key => $val):
		$avatar = empty($user_cache[$val['uid']]['avatar']) ? './views/images/avatar.jpg' : '../' . $user_cache[$val['uid']]['avatar'];
	?>
     <tr>
        <td style="padding:3px; text-align:center;"><img src="<?php echo $avatar; ?>" height="40" width="40" /></td>
		<td><a href="user.php?action=edit&uid=<?php echo $val['uid']?>"><?php echo empty($val['name']) ? $val['login'] : $val['name']; ?></a></td>
		<td><?php echo $val['description']; ?></td>
		<td><?php echo $val['email']; ?></td>
		<td class="tdcenter"><a href="./admin_log.php?uid=<?php echo $val['uid'];?>"><?php echo $sta_cache[$val['uid']]['lognum']; ?></a></td>
		<td><a href="javascript: em_confirm(<?php echo $val['uid']; ?>, 'user');">Xóa</a></td>
     </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
</form>
<form action="user.php?action=new" method="post">
<div style="margin:30px 0px 10px 0px;"><a href="javascript:displayToggle('user_new', 2);">+ Thêm người dùng</a></div>
<div id="user_new">
	<li>Tài khoản: </li>
	<li><input name="login" type="text" id="login" value="" style="width:180px;" /></li>
	<li>Mật khẩu: </li>
	<li><input name="password" type="password" id="password" value="" style="width:180px;" /></li>
	<li>Nhập lại mật khẩu: </li>
	<li><input name="password2" type="password" id="password2" value="" style="width:180px;" /></li>
	<li><br></li>
	<li><input type="submit" name="" value="Thêm"  /></li>
</div>
</div>
</form>
<script>
$("#user_new").css('display', $.cookie('em_user_new') ? $.cookie('em_user_new') : 'none');
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
$("#menu_user").addClass('sidebarsubmenu1');
</script>