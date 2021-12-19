<HTML><HEAD><TITLE>Máy Đo Độ Yêu - SkyLove.Ws</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8"><LINK 
href="standard.css" type=text/css 
rel=stylesheet>
<META content="MSHTML 6.00.2900.2180" name=GENERATOR>
</HEAD>
<BODY >
<script language="javascript">
function check()
{
var form = document.Form1
	if (form.txtName.value == "")
	{
	alert("Vui lòng nhập tên của bạn!")
	form.txtName.style.background = "#FFFFCA";
	return false;
	}
	else if (form.txtEmail.value == "")
	{
	alert("Vui lòng nhập email của bạn!")
	form.txtEmail.style.background = "#FFFFCA";
	return false;
	}
	
}
</script>
<FORM id="Form1" name="Form1" action="signinp.php" method="post" onSubmit="return check()">
 <BR><BR>
<TABLE width=750 align=center>
  <TBODY>
  <TR class=maintable>
    <TD>
                  <TABLE width="100%" id="table2">
                    <TBODY>
                    <TR>
                      <TD class=logo width="50%">Máy Đo Độ Yêu - SkyLove.Ws</TD>
                      <TD align=right><A 
                        href="index.php">Trang Chủ</A> 
                        | <A href="signin.php">Đăng ký</A> 
                      </TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=maintable><SPAN class=tagline><SPAN id=lblBig>Trang thành viên</SPAN> </SPAN></TD></TR>
  <TR>
    <TD class=maintable>
      <TABLE>
        <TBODY>
        <TR>
          <TD class=infobox><SPAN id=lblDetail>Chào mừng bạn đã gia nhập trò Phishing này!</SPAN><BR></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=maintable><SPAN class=subtitles>Đăng ký mới</SPAN><br>
      <BR>
        <em>Hãy nhập đúng địa chỉ email nhé! Vì tất cả thông tin sẽ được gửi cho bạn qua email này !</em><br>
        <BR>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=formtable align=right width=141>Tên bạn:</TD>
          <TD width="581" class=formtable><INPUT class="inputbox" id="txtName" name="txtName" onChange="this.style.background = '#FFFFFF'"> 
            <SPAN id=RequiredFieldValidator1 
            style="VISIBILITY: hidden; COLOR: red" initialvalue="" 
            evaluationfunction="RequiredFieldValidatorEvaluateIsValid" 
            errormessage="*" controltovalidate="txtName">*</SPAN></TD></TR>
        <TR>
          <TD class=formtable align=right width=141>Email của bạn: </TD>
          <TD class=formtable><INPUT class="inputbox" id="txtEmail" name="txtEmail" onChange="this.style.background = '#FFFFFF'"> 
            <SPAN id=RequiredFieldValidator2 
            style="VISIBILITY: hidden; COLOR: red" initialvalue="" 
            evaluationfunction="RequiredFieldValidatorEvaluateIsValid" 
            errormessage="*" controltovalidate="txtEmail">*</SPAN> &nbsp;<SPAN class=subtitles>[&nbsp;&nbsp;Hỗ trợ đa số Mail hiện nay. Khuyên dùng Gmail, Yahoo Mail, Zing Mail (kiểm tra trong mục Spam nếu không có thư đến)&nbsp;&nbsp;]</SPAN></TD></TR>
        <TR>
          <TD class=formtable width=141>&nbsp;</TD>
          <TD class=formtable><INPUT type="submit" value="Đăng ký" name="btnSignIn"></TD></TR>
        <tr>
          <TD class=formtable colspan="2">
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table3">
                    <TBODY>
                    <TR>
                      <TD class=formtable><SPAN id=lblResult>
                      <?php include("qc.txt"); ?>
                      </SPAN></TD></TR></TBODY></TABLE><br>
           </TD>
          </tr>
        <TR>
          <TD class=maintablelastrow colSpan=2>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table1">
        <TBODY>
        <TR>
          <TD class=bottomnavigationtext>© 2011 by <a href="http://skylove.ws">SkyLove.Ws</a></TD>
          <TD class=bottomnavigationtext align=right>
		  <a href="http://whos.amung.us/stats/0932200231/" target="_blank">
		  <img src="http://whos.amung.us/swidget/0932200231.png" border="0" /></a>
	      </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
</FORM></BODY></HTML>
