<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script charset="utf-8" src="./editor/kindeditor.js"></script>
<div class=containertitle><b>Tạo trang</b><span id="msg_2"></span></div><div id="msg"></div>
<div class=line></div>
  <form action="page.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
    <table cellspacing="1" cellpadding="4" width="720" border="0">
      <tbody>
        <tr nowrap="nowrap">
          <td><b>Tên trang: </b><br />
          <input maxlength="200" style="width:380px;" name="title" id="title"/>
	      <input name="date" id="date" type="hidden" value="" >
        </td>
        </tr>
        <tr>
          <td>
          <b>Chức năng: </b> <a href="javascript: displayToggle('FrameUpload', 0);autosave(4);" class="thickbox">Đính kèm+</a><span id="asmsg">
          <?php doAction('adm_writelog_head'); ?>
          <input type="hidden" name="as_logid" id="as_logid" value="-1"></span><br />
          <div id="FrameUpload" style="display: none;"><iframe width="720" height="160" frameborder="0" src="attachment.php?action=selectFile"></iframe></div>
		  <textarea id="content" name="content" style="width:719px; height:460px; border:#CCCCCC solid 1px;"></textarea>
          <script>loadEditor('content');</script>
		  </td>
        </tr>
        <tr nowrap="nowrap">
          <td><span id="alias_msg_hook"></span><b>Liên kết:</b> (Tùy chỉnh liên kết trang. Cần <a href="./permalink.php" target="_blank">tùy chỉnh liên kết</a>)<br />
			<input name="alias" id="alias" style="width:711px;" />
          </td>
        </tr> 
        <tr nowrap="nowrap">
          <td><b>Địa chỉ: </b>(Nếu nhập giá trị, trang sẽ chuyển đến địa chỉ này)<br />
          <input name="url" id="url" maxlength="200" style="width:715px;" /><br />
          </td>
        </tr>
        <tr>
          <td>
          <span id="page_options">
          <label for="allow_remark">Cho phép nhận xét</label>
          <input type="checkbox" value="y" name="allow_remark" id="allow_remark" />
          <label for="allow_tb">Cho phép trích dẫn</label>
          <input type="checkbox" value="y" id="is_blank" name="is_blank" />
          </span>
          </td>
        </tr>
		<tr>
          <td align="center"><br>
          <input type="hidden" name="ishide" id="ishide" value="">
          <input type="submit" value="Đăng trang" onclick="return checkform();" class="button" />
          <input type="button" name="savedf" id="savedf" value="Lưu nháp" onclick="autosave(3);" class="button" />
		  </td>
        </tr>
	</tbody>
	</table>
  </form>
<div class=line></div>
<script>
$("#title").focus();
$("#menu_page").addClass('sidebarsubmenu1');
$("#alias").keyup(function(){checkalias();});
</script>