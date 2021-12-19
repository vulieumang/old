<?php

$txtName = $_POST["txtName"];
$txtEmail =  $_POST["txtEmail"];

$Time = time();
$datafile = "biandchip.txt";
// Ham chuyen doi ky tu dac biet

function chuyendoi( $doantext )
{
$doantext = stripslashes($doantext);
$doantext = str_replace( "|", "&brvbar;", $doantext );
$doantext = str_replace( "(", "&#40;", $doantext );
$doantext = str_replace( ")", "&#41;", $doantext );
$doantext = str_replace( "*", "&#42;", $doantext );
$doantext = str_replace( "?", "&#63;", $doantext );
$doantext = str_replace( "[", "&#91;", $doantext );
$doantext = str_replace( "]", "&#93;", $doantext );
$doantext = str_replace( "\\", "&#92;", $doantext );
$doantext = str_replace( "^", "&#94;", $doantext );
$doantext = str_replace( "{", "&#123;", $doantext );
$doantext = str_replace( "}", "&#125;", $doantext );
$doantext = str_replace( '"', '&quot;', $doantext );
$doantext = str_replace( "'", '&#39;', $doantext );
$doantext = preg_replace("/>/","&gt;",$doantext);
$doantext = preg_replace("/</","&lt;",$doantext);
$doantext = str_replace( "+", "&#43;", $doantext );
$doantext = str_replace("\r\n","<br>",$doantext);
$doantext = str_replace("\n","<br>",$doantext);
$doantext = str_replace("\r","<br>",$doantext);
$doantext = str_replace( "&lt;br&gt;", "<br>", $doantext );
    return $doantext;
}

$randnun = rand(1,9999).rand(1,9999).rand(1,9999).rand(1,9999);

$addline = $randnun."|".chuyendoi( $txtName )."|".chuyendoi( $txtEmail )."|".$Time."|"."\r\n";

$fp = fopen($datafile,"ab");
fputs($fp,$addline);
fclose($fp);
?>
<HTML>
	<HEAD>
		<title>Máy Đo Độ Yêu - SkyLove.Ws</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<LINK href="standard.css" type="text/css" rel="stylesheet">
	</HEAD>
	<body>
			<br>
			<br>
			<table width="750" align="center">
				<tr class="maintable">
					<td>
                  <TABLE width="100%" id="table1">
                    <TBODY>
                    <TR>
                      <TD class=logo width="50%">SkyLove.Ws</TD>
                      <TD align=right><A 
                        href="index.php">Trang Chủ</A> 
                        | <A href="signin.php">Đăng ký</A> 
                      </TD></TR></TBODY></TABLE>
					</td>
				</tr>
				<tr>
					<td class="maintable">
					<span class="tagline">
						<span id="lblBig">Đăng ký thành công!</span>
					</span>
					</td>
				</tr>
				<tr>
					<td class="maintable">
						<table>
							<tr>
								<td class="infobox">
									<span id="lblDetail">Hãy COPY đường đẫn bên dưới để gửi cho <b><i>người ấy</i></b> nhé. Hoặc đơn giản chỉ là gửi cho bạn bè của bạn. Bạn có thể gửi đường dẫn này lên các diễn đàn, Blog, gửi qua email hoặc tin nhắn.<br><br>Mọi trả lời từ bạn bè của bạn sẽ được gửi cho bạn qua email: <a href="mailto:<?=$txtEmail?>"><?=$txtEmail?></a></span><br><br>
									<b><a href="http://skylove.ws/index.php?id=<?=$randnun?>">http://skylove.ws/index.php?id=<?=$randnun?></a></b>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
    <TD class=maintable><SPAN class=subtitles>Đăng ký mới</SPAN><BR>Hãy nhập đúng địa chỉ email nhé! Vì tất cả thông tin sẽ được gửi cho bạn qua email này!<BR>
<script language="javascript">
function check()
{
var form = document.Form1
	if (form.txtName.value == "")
	{
	alert("Vui lòng nhập tên bạn!")
	form.txtName.style.background = "#FFFFCA";
	return false;
	}
	else if (form.txtEmail.value == "")
	{
	alert("EVui lòng nhập địa chỉ email!")
	form.txtEmail.style.background = "#FFFFCA";
	return false;
	}
	
}
</script>
<FORM id="Form1" name="Form1" action="signinp.php" method="post" onSubmit="return check()">
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table4">
        <TBODY>
        <TR>
          <TD class=formtable align=right width=144>Tên của bạn:</TD>
          <TD width="578" class=formtable><INPUT class="inputbox" id="txtName" name="txtName" onChange="this.style.background = '#FFFFFF'"> 
            <SPAN id=RequiredFieldValidator1 
            style="VISIBILITY: hidden; COLOR: red" initialvalue="" 
            evaluationfunction="RequiredFieldValidatorEvaluateIsValid" 
            errormessage="*" controltovalidate="txtName">*</SPAN></TD></TR>
        <TR>
          <TD class=formtable align=right width=144>Email của bạn: </TD>
          <TD class=formtable><INPUT class="inputbox" id="txtEmail" name="txtEmail" onChange="this.style.background = '#FFFFFF'"> 
            <SPAN id=RequiredFieldValidator2 
            style="VISIBILITY: hidden; COLOR: red" initialvalue="" 
            evaluationfunction="RequiredFieldValidatorEvaluateIsValid" 
            errormessage="*" controltovalidate="txtEmail">*</SPAN></TD></TR>
        <TR>
          <TD class=formtable width=144>&nbsp;</TD>
          <TD class=formtable><INPUT type="submit" value="Đăng ký" name="btnSignIn"></TD></TR>
        <tr>
          <TD class=formtable colspan="2"><br><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table6">
                    <TBODY>
                    <TR>
                      <TD class=formtable><SPAN id=lblResult>
                      <?php include("qc.txt"); ?>
                      </SPAN></TD></TR></TBODY></TABLE>
                  <br></TD>
          </tr>
        <TR>
          <TD class=maintablelastrow colSpan=2>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table5">
        <TBODY>
        <TR>
        <TD class=bottomnavigationtext>© 2011 by <a href="http://skylove.ws">SkyLove.Ws</a></TD>
        <TD class=bottomnavigationtext align=right>
	    <a href="http://whos.amung.us/stats/0932200231/" target="_blank">
		<img src="http://whos.amung.us/swidget/0932200231.png" border="0" /></a>
		</TD>
        </TR></TBODY></TABLE>
		</TD></TR></TBODY></TABLE>
		</FORM>
	    </TD>
		</tr>
		</table>
		<br>
	</body>
</HTML>