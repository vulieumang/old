<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script charset="utf-8" src="./editor/kindeditor.js"></script>
<div class=containertitle><b>Viết bài</b><span id="msg_2"></span></div><div id="msg"></div>
<div class=line></div>
  <form action="save_log.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
    <table cellspacing="1" cellpadding="4" width="720" border="0">
      <tbody>
        <tr nowrap="nowrap">
          <td><b>Tiêu đề: </b><br />
          <input type="text" maxlength="200" style="width:380px;" name="title" id="title"/>
	      <select name="sort" id="sort">
	        <option value="-1">Hãy chọn...</option>
			<?php foreach($sorts as $val):?>
			<option value="<?php echo $val['sid']; ?>"><?php echo $val['sortname']; ?></option>
			<?php endforeach;?>
	      </select>
	      <input maxlength="200" style="width:139px;" name="postdate" id="postdate" value="<?php echo $postDate; ?>"/>
	      <input name="date" id="date" type="hidden" value="" >
        </td>
        </tr>
        <tr>
          <td>
          <b>Chức năng: </b> <a href="javascript: displayToggle('FrameUpload', 0);autosave(1);" class="thickbox">File đính kèm</a><span id="asmsg">
          <?php doAction('adm_writelog_head'); ?>
          <input type="hidden" name="as_logid" id="as_logid" value="-1"></span><br />
          <div id="FrameUpload" style="display: none;"><iframe width="720" height="160" frameborder="0" src="attachment.php?action=selectFile"></iframe></div>
		  <textarea id="content" name="content" cols="100" rows="8" style="width:719px; height:460px;"></textarea>
          <script>loadEditor('content');</script>
          </td>
        </tr>
        <tr nowrap="nowrap">
          <td><b>Tags: </b>(Mỗi tags phân cách nhau bằng dấu phẩy ",")<br />
          <input name="tag" id="tag" maxlength="200" style="width:715px;" />
          <?php if (!empty($tags)):?>
          <br /><div style="color:#2A9DDB;cursor:pointer;"><a href="javascript:displayToggle('tagbox', 0);">+ Thêm tag</a></div>
          <?php endif; ?>
          <div id="tagbox" style="width:688px;margin-left:30px;display:none;">
          <?php 
          $tagStr = '';
          foreach ($tags as $val){
          	$tagStr .=" <a href=\"javascript: insertTag('{$val['tagname']}','tag');\">{$val['tagname']}</a> ";
          }
          echo $tagStr;
          ?>
          </div>
          </td>
        </tr>
	</tbody>
	</table>
	<div id="show_advset" onclick="displayToggle('advset', 1);"><b>Nâng cao</b></div>
	<table cellspacing="1" cellpadding="4" width="720" border="0" id="advset">
        <tr nowrap="nowrap">
          <td><b>Trích dẫn: </b><br />
			<textarea id="excerpt" name="excerpt" style="width:719px; height:260px; border:#CCCCCC solid 1px;"></textarea>
            <script>loadEditor('excerpt');</script>
          </td>
        </tr>
        <tr nowrap="nowrap">
          <td><span id="alias_msg_hook"></span><b>Liên kết:</b> (Tùy chỉnh liên kết trang. Cần <a href="./permalink.php" target="_blank">cấu hình liên kết</a>)<br />
			<input name="alias" id="alias" style="width:711px;" />
          </td>
        </tr>   
        <tr nowrap="nowrap">
          <td><b>Địa chỉ trích dẫn: </b>(Mỗi giá trị một dòng)<br />
			<textarea name="pingurl" id="pingurl" style="width:715px; height:50px;" class="input"></textarea>
          </td>
        </tr>
        <tr>
          <td><b>Mật khẩu: </b>
          <input type="text" value="" name="password" id="password" style="width:80px;" /> (Mật khẩu để xem bài viết)
          <span id="post_options">
          <input type="checkbox" value="y" name="top" id="top" />
          <label for="top">Đưa lên TOP</label>
          <input type="checkbox" value="y" name="allow_remark" id="allow_remark" checked="checked" />
          <label for="allow_remark">Cho phép nhận xét</label>
          <input type="checkbox" value="y" id="allow_tb" name="allow_tb" checked="checked" />
          <label for="allow_tb">Cho phép trích dẫn</label>
          </span>
		  </td>
        </tr>
	</table>
	<table cellspacing="1" cellpadding="4" width="720" border="0">
		<tr>
          <td align="center"><br>
          <input type="hidden" name="ishide" id="ishide" value="">
          <input type="submit" value="Đăng bài" onclick="return checkform();" class="button" />
          <input type="hidden" name="author" id="author" value=<?php echo UID; ?> />	 
          <input type="button" name="savedf" id="savedf" value="Lưu nháp" onclick="autosave(2);" class="button" />
		  </td>
        </tr>
    </table>
  </form>
<div class=line></div>
<script>
$("#title").focus();
$("#menu_wt").addClass('sidebarsubmenu1');
$("#advset").css('display', $.cookie('em_advset') ? $.cookie('em_advset') : '');
$("#alias").keyup(function(){checkalias();});
setTimeout("autosave(0)",60000);
</script>