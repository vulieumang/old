<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<div class="containertitle2">
<a class="navi3" href="./configure.php">Cấu hình</a>
<a class="navi4" href="./style.php">Giao diện</a>
<a class="navi4" href="./permalink.php">Liên kết</a>
<a class="navi4" href="./blogger.php">Thông tin</a>
<?php if(isset($_GET['activated'])):?><span class="actived">Cầu hình thành công!</span><?php endif;?>
</div>
<form action="configure.php?action=mod_config" method="post" name="input" id="input">
  <table cellspacing="8" cellpadding="4" width="95%" align="center" border="0">
    <tbody>
      <tr nowrap="nowrap">
        <td width="18%" align="right">Tên trang:</td>
        <td width="82%"><input maxlength="200" size="35" value="<?php echo $blogname; ?>" name="blogname" /></td>
      </tr>
      <tr nowrap="nowrap">
        <td align="right" valign="top">Giới thiệu:</td>
        <td><textarea name="bloginfo" cols="" rows="2" style="width:300px;"><?php echo $bloginfo; ?></textarea></td>
      </tr>
      <tr nowrap="nowrap">
        <td align="right">Địa chỉ: </td>
        <td class="care"><input maxlength="200" size="35" value="<?php echo $blogurl; ?>" name="blogurl" /></td>
      </tr>
      <tr nowrap="nowrap">
        <td align="right">Từ khóa: </td>
        <td><input maxlength="200" size="35" value="<?php echo $site_key; ?>" name="site_key" /> (Phân cách bởi dấu phẩu ",")</td>
      </tr>
      <tr nowrap="nowrap">
        <td align="right">Giấy phép ICP: </td>
        <td><input maxlength="200" size="35" value="<?php echo $icp; ?>" name="icp" /></td>
      </tr>
      <tr nowrap="nowrap">
        <td align="right">Số bài mỗi trang: </td>
        <td><input maxlength="5" size="8" value="<?php echo $index_lognum; ?>" name="index_lognum" /></td>
      </tr>
	  <tr>
        <td valign="top" align="right">Múi giờ<br /></td>
        <td>
		<select name="timezone">
<?php
		$tzlist = array('-12'=>'(GMT -12) Eniwetok, Kwajalein',
							'-11'=>'(GMT -11) Midway Island, Samoa',
							'-10'=>'(GMT -10) Hawaii',
							'-9'=>'(GMT -9) Alaska',
							'-8'=>'(GMT -8) Pacific Time (US &amp; Canada)',
							'-7'=>'(GMT -7) Mountain Time (US &amp; Canada)',
							'-6'=>'(GMT -6) Central Time (US &amp; Canada), Mexico City',
							'-5'=>'(GMT -5) Eastern Time (US &amp; Canada), Bogota, Lima',
							'-4'=>'(GMT -4) Atlantic Time (Canada), La Paz, Santiago',
							'-3.5'=>'(GMT -3:30) Newfoundland',
							'-3'=>'(GMT -3) Brazil, Buenos Aires, Georgetown',
							'-2'=>'(GMT -2) Mid-Atlantic',
							'-1'=>'(GMT -1) Azores, Cape Verde Islands',
							'0'=>'(GMT) Western Europe Time, London, Lisbon, Casablanca',
							'1'=>'(GMT +1) Brussels, Copenhagen, Madrid, Paris',
							'2'=>'(GMT +2) Kaliningrad, South Africa',
							'3'=>'(GMT +3) Baghdad, Riyadh, Moscow, St. Petersburg',
							'3.5'=>'(GMT +3:30) Tehran',
							'4'=>'(GMT +4) Abu Dhabi, Muscat, Baku, Tbilisi',
							'4.5'=>'(GMT +4:30) Kabul',
							'5'=>'(GMT +5) Ekaterinburg, Islamabad, Karachi, Tashkent',
							'5.5'=>'(GMT +5:30) Mumbai, Kolkata, Chennai, New Delhi',
							'6'=>'(GMT +6) Almaty, Dhaka, Colombo',
							'7'=>'(GMT +7) Bangkok, Hà Nội, Jakarta',
							'8'=>'(GMT +8) Beijing, Perth, Singapore, Hong Kong',
							'9'=>'(GMT +9) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
							'9.5'=>'(GMT +9:30) Adelaide, Darwin',
							'10'=>'(GMT +10) Eastern Australia, Guam, Vladivostok',
							'11'=>'(GMT +11) Magadan, Solomon Islands, New Caledonia',
							'12'=>'(GMT +12) Auckland, Wellington, Fiji, Kamchatka',
		);
foreach($tzlist as $key=>$value):
$ex = $key==$timezone?"selected=\"selected\"":'';
?>
		<option value="<?php echo $key; ?>" <?php echo $ex; ?>><?php echo $value; ?></option>
<?php endforeach;?>
        </select>
        (Hiện tại :<?php echo gmdate('d-m-Y H:i:s', time() + $timezone * 3600); ?>)
        </td>
      </tr>
      <tr>
        <td align="right">Mã đăng nhập: <br /></td>
        <td class="care"><input type="checkbox" style="vertical-align:middle;" value="y" name="login_code" id="login_code" <?php echo $conf_login_code; ?> /></td>
      </tr>
	  <tr>
        <td align="right">Bật trích dẫn: <br /></td>
		<td class="care"><input type="checkbox" style="vertical-align:middle;" value="y" name="istrackback" id="istrackback" <?php echo $conf_istrackback; ?> /></td>
      </tr>
      <tr>
        <td align="right">Bật GZIP: <br /></td>
        <td class="care"><input type="checkbox" style="vertical-align:middle;" value="y" name="isgzipenable" id="isgzipenable" <?php echo $conf_isgzipenable; ?> /></td>
      </tr>
	  <tr>
        <td align="right">Bật XMLRPC: <br /></td>
        <td class="care"><input type="checkbox" style="vertical-align:middle;" value="y" name="isxmlrpcenable" id="isxmlrpcenable" <?php echo $conf_isxmlrpcenable; ?> /></td>
      </tr>
    </tbody>
  </table>
  <div class="setting_line"></div>
  <table cellspacing="8" cellpadding="4" width="95%" align="center" border="0">
    <tbody>
      <tr>
        <td align="right" width="18%">Số RSS: <br /></td>
        <td width="82%"><input maxlength="5" size="8" value="<?php echo $rss_output_num; ?>" name="rss_output_num" /></td>
      </tr>
      <tr>
        <td align="right">Kiểu RSS<br /></td>
        <td>
		<select name="rss_output_fulltext">
		<option value="y" <?php echo $ex1; ?>>Toàn bộ</option>
		<option value="n" <?php echo $ex2; ?>>Tóm tắt</option>
        </select>
		</td>
      </tr>
    </tbody>
  </table>
  <div class="setting_line"></div>
  <table cellspacing="8" cellpadding="4" width="95%" align="center" border="0">
    <tbody>
      <tr>
        <td align="right" width="18%">Kiểm tra nhận xét: <br /></td>
        <td width="82%"><input type="checkbox" style="vertical-align:middle;" value="y" name="ischkcomment" id="ischkcomment" <?php echo $conf_ischkcomment; ?> /></td>
      </tr>
      <tr>
        <td align="right">Mã nhận xét: <br /></td>
        <td><input type="checkbox" style="vertical-align:middle;" value="y" name="comment_code" id="comment_code" <?php echo $conf_comment_code; ?> /></td>
      </tr>
      <tr>
        <td align="right">Cho phép Gravata: <br /></td>
        <td><input type="checkbox" style="vertical-align:middle;" value="y" name="isgravatar" id="isgravatar" <?php echo $conf_isgravatar; ?> /></td>
      </tr>
      <tr>
        <td align="center" colspan="2"><input type="submit" value="Cấu hình" class="button" /></td>
      </tr>
    </tbody>
  </table>
</form>