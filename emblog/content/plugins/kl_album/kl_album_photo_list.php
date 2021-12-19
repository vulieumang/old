<?php
!defined('EMLOG_ROOT') && exit('access deined!');
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
$qu = $DB->query("SELECT * FROM ".DB_PREFIX."options WHERE option_name='kl_album_info'");
$row = $DB->fetch_row($qu);
$kl = unserialize($row[2]);
$albumname = '';
$albumlist_option_str = '';
$head = '';
foreach($kl as $val){
	if($val['addtime'] == $album){
		$albumname = $val['name'];
		if(isset($val['head'])) $head .= $val['head'];
	}else{
		$albumlist_option_str .= "<option value='{$val['addtime']}'>{$val['name']}</option>";
	}
}
?>
<style type="text/css">
#gallery {padding: 10px;text-align:left; font-size:12px;height:360px;overflow:auto;}
#gallery ul { list-style: none;margin:0px}
#gallery ul li { display: inline; width:360px; height:110px; float:left; margin: 5px 5px 5px; border:0px solid #ccc;}
#gallery ul a:hover img {border:1px solid green;margin:0px;}
.notfengmian{padding: 5px 5px;border:0px; margin:0px;}
.fengmian{padding: 5px 5px;border:2px solid green; margin:0px;}
.pic_back {text-align:left; font-size:12px; padding:0px 20px;}
.lanniu {-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:transparent url(../content/plugins/kl_album/images/lanniu.jpg) no-repeat scroll 0 0;border:medium none;display:inline;height:21px;line-height:21px;margin-right:10px;text-align:center;width:61px;}
.o_bg_color{background-color:#EAEAEA}
.no_bg_color{background-color:#FFFFFF}
</style>
<script type="text/javascript">
jQuery(function($){
	$("#kl_album").addClass('sidebarsubmenu1');
	$('#xiangceliebiao').click(function(){location.href='./plugin.php?plugin=kl_album&kl_album_action=display'});
	$('#quanxuan').click(function(){$(':checkbox').each(function(){$(this).attr('checked',true)})});
	$('#fanxuan').click(function(){$(':checkbox').each(function(){$(this).attr('checked',!this.checked)})});
	$('#sanchu').click(function(){var ids='';$(':checked').each(function(){ids=ids+$(this).val()+'|'});if(ids!=''){if(confirm('确定要删除所有选中的图片？')){$.get('../content/plugins/kl_album/kl_album_ajax_do.php?action=del&sid='+Math.random(),{ids:ids},function(result){if($.trim(result).indexOf(ids)!=-1){window.location.reload()}else{alert('删除失败:'+result)}})}}else{alert('请勾选要删除的图片')}});
	$('#queding').click(function(){if($('#album').val()!==''){var ids='';$(':checked').each(function(){ids=ids+$(this).val()+'|'});if(ids!=''){if(confirm('确定要移动这些相片到选定的相册？')){$.get('../content/plugins/kl_album/kl_album_ajax_do.php?action=move&sid='+Math.random(),{ids:ids,newalbum:$('#album').val()},function(result){if($.trim(result).indexOf(ids)!=-1){window.location.reload()}else{alert('移动失败:'+result)}})}}else{alert('请勾选要移动的图片')}}else{alert('请选择目的相册')}});
	$('#shangchuan').click(function(){location.href='./plugin.php?plugin=kl_album&kl_album_action=upload&album=<?php echo $album; ?>'});

})
function getclick(num){$('input[name^=tn_'+num+'],input[name^=d_'+num+']').click(function(){$(this).removeClass('o_bg_color').addClass('no_bg_color');})};
function edit(num){$.get('../content/plugins/kl_album/kl_album_ajax_do.php?action=edit&sid='+Math.random(),{id:num,tn:$('input[name^=tn_'+num+']').val(),d:$('input[name^=d_'+num+']').val()},function(result){if($.trim(result).indexOf('kl_album_successed')!=-1){$('input[name^=tn_'+num+'],input[name^=d_'+num+']').removeClass('no_bg_color').addClass('o_bg_color');}else{alert('保存失败：'+result)};});}
function setHead(num){$.get('../content/plugins/kl_album/kl_album_ajax_do.php?action=setHead&sid='+Math.random(),{id:num,album:<?php echo $album; ?>},function(result){if($.trim(result).indexOf('kl_album_successed')!=-1){$('.fengmian').removeClass('fengmian').addClass('notfengmian');$('#img_'+num).addClass('fengmian')}else{alert('设置失败:'+result)}})}
</script>
<div class=containertitle><b>相册 <?php echo $albumname;?> 中的相片</b></div>
<div class=line></div>
<div id="content">
<div style="height:30px;">
<span style="float:left;">
<input id="xiangceliebiao" type="button" value="相册列表" class="lanniu" />
<input id="quanxuan" type="button" value="全选" class="lanniu" />
<input id="fanxuan" type="button" value="反选" class="lanniu" />
<input id="sanchu" type="button" value="删除" class="lanniu" />
<select id="album"><option value="">移动到..</option><?php echo $albumlist_option_str; ?>'</select>
<input id="queding" type="button" value="确定" class="lanniu" />
</span>
<span style="padding-top:6px;"><input id="shangchuan" type="image" src="../content/plugins/kl_album/images/upload.jpg" />
</span>
</div>
<div id="gallery">
<ul>
<?php
$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album=$album");
if($DB->num_rows($query) == 0){
	echo '<p>此相册还没有上传过相片！</p>';
	echo '<p><a href="./plugin.php?plugin=kl_album&kl_album_action=upload&album='.$album.'"><b>现在就去上传</b></a></p>';
	exit;
}
$photos = array();
while($photo = $DB->fetch_array($query)){
	$photos[] = $photo;
}
foreach ($photos as $val){
	if($val['addtime'] == $album) $albumname = $val['name'];
}

$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album=$album ORDER BY id DESC");
$photos = array();
while($photo = $DB->fetch_array($query)){
	$photos[] = $photo;
}
foreach($photos as $val):
?>
<li>
<table height="100%" width="100%" border="0" style="border:1px solid #CCC;">
  <tr>
	<td width="110" height="110" rowspan="2" align="center"><a href="<?php echo str_replace('thum-', '', $val['filename']); ?>" target="_blank"><img class="<?php echo $val['id'] == $head ? 'fengmian' : 'notfengmian'; ?>" id="img_<?php echo $val['id']; ?>" src="<?php echo $val['filename']; ?>" /></a></td>
	<td vlign="top">
	  <table border="0" width="100%" height="100%" style="border:1px solid #CCC;">
		<tr>
		  <td width="40" height="35"><nobr>相片名称：</nobr></td>
		  <td><input name="tn_<?php echo $val['id']; ?>" type="text" value="<?php echo $val['truename']; ?>" class="o_bg_color" onclick="getclick(<?php echo $val['id']; ?>)" /></td>
		</tr>
		<tr>
		  <td height="35"><nobr>相片描述：</nobr></td>
		  <td><input name="d_<?php echo $val['id']; ?>" type="text" value="<?php echo $val['description']; ?>" class="o_bg_color" onclick="getclick(<?php echo $val['id']; ?>)" /></td>
		</tr>
		<tr>
		  <td height="30"><mobr>操　　作：</td>
		  <td><input type="checkbox" value="<?php echo $val['id']; ?>" /><input id="edit_<?php echo $val['id']; ?>" type="button" value="保存" class="lanniu" onclick="edit(<?php echo $val['id']; ?>)" /><input id="fenmian_<?php echo $val['id']; ?>" type="button" value="设为封面" class="lanniu" onclick="setHead(<?php echo $val['id']; ?>)" /></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>