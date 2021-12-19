<?php
error_reporting(0);
$id = $_GET['id'];
$lines=file("biandchip.txt");
$found=0;
$i=0;
global $id,$ten,$email,$time;
$ten ="$tennguoinhan";
$email = "tienvuitdlu@gmail.com";
foreach ($lines as $thisline) {
    if (preg_match("/^($id\|)/",$thisline)) {
    	$thisline=chop($thisline);
        list($id,$ten,$email,$time)=explode("|",$thisline);
        $found=1;
        break;
    }
    $i++;
}
?>
<HTML><HEAD><TITLE>Máy Đo Độ Yêu - tienvu.tv/love</TITLE>
<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="standard.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.2180" name=GENERATOR></HEAD>
<BODY>
<script language="javascript">
function check()
{
var form = document.sendmail
	if (form.friend_name.value == "")
	{
	alert("Nhập họ tên của bạn!")
	form.friend_name.style.background = "#FFFFCA";
	return false;
	}
	else if (form.friend_name2.value == "")
	{
	alert("Nhập tên những đối tượng bạn quan tâm nhất!")
	form.friend_name2.style.background = "#FFFFCA";
	return false;
	}
	
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width=593 align=center border=0>
  <TBODY>
  <TR vAlign=top>
    <TD width=593>
      <TABLE height=591 cellSpacing=0 cellPadding=0 width=593 border=0>
        <TBODY>
        <TR vAlign=top>
          <TD><BR>
            <TABLE height=552 width=750 align=center>
              <TBODY>
              <TR class=maintable>
                <TD>
                  <TABLE width="100%">
                    <TBODY>
                    <TR>
                      <TD class=logo width="50%">Máy Đo Độ Yêu - TienVu.Tv</TD>
                      <TD align=right><A 
                        href="index.php">Trang Chủ</A> 
                      
                      </TD></TR></TBODY></TABLE></TD></TR>
              <TR>
                <TD class=maintable><SPAN class=tagline>Aj là Ngườj bạn yêu nhất</SPAN> 
</TD></TR>
              <TR>
                <TD class=maintable>Chào mừng bạn đến với máy tình yêu!
				Chiếc máy sẽ trả lời giúp bạn tình cảm hiện tại của bạn
				là một <em><strong>tình yêu thực thụ</strong></em> hay dơn
				 giản chỉ là một sự <em><strong>ham muốn nhất thời.</strong></em><br><br>
				Nó sẽ giúp bạn tìm được đúng mục tiêu của mình để không bao giờ phải có những sự <em><strong>cố gắng vô ích.</strong></em><br><br>
				Máy sẽ tìm trong số những người bạn quan tâm, <em>ai sẽ là người thích hợp nhất với bạn</em>.
                  <BR><BR><SPAN class=subtitles>Máy tình yêu:</SPAN><br>
				  <BR>Tên đầy đủ của bạn (Cả <strong>họ</strong> và <strong>tên</strong> đó nha):<br>
                  <form action="cp.php" name="sendmail" method="POST" onSubmit="return check();">
				  <input type="hidden" name="mailsend" value="<?=$email?>">
				  <input type="hidden" name="namesend" value="<?=$ten;?>">  
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=formtable width=20>&nbsp;</TD>
                      <TD class=formtable>
                      <INPUT class=inputbox id=friend_name name=friend_name onChange="this.style.background = '#FFFFFF'"> 
                      <SPAN style="COLOR: red">*</SPAN> 
                  </TD></TR></TBODY></TABLE><BR>Họ & Tên 3 người bạn cảm thấy <em><strong>quan trọng nhất (muốn thử)</strong></em> đối với bạn.
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=formtable align=middle width=20>1.</TD>
                      <TD class=formtable>
					  <INPUT class=inputbox id=friend_name2 name=friend_name2  onchange="this.style.background = '#FFFFFF'">
					  </TD></TR>
                    <TR>
                      <TD class=formtable align=middle width=20>2.</TD>
                      <TD class=formtable>
					  <INPUT class=inputbox id=friend_name3 name=friend_name3>
					</TD></TR>
                    <TR>
                      <TD class=formtable align=middle width=20>3.</TD>
                      <TD class=formtable>
					  <INPUT class=inputbox id=friend_name4 name=friend_name4> 
                  </TD></TR></TBODY></TABLE><BR><em>Bây giờ thì bạn có thể biết được ai là người thích hợp nhất đối với bạn rồi</em>! <BR>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=formtable width=20>&nbsp;</TD>
                      <TD class=formtable><SPAN class=formtable>
                      <INPUT type=submit value="Úm ba la xì bùa! Nhấn nào" name=btnSendMail> 
                        </SPAN></TD></TR></TBODY></TABLE>
                  </form>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=formtable><SPAN id=lblResult>
                      <?php include("qc.txt"); ?>
                      </SPAN></TD></TR></TBODY></TABLE>
                  </TD></TD></TR>
              <TR>
                <TD class=maintablelastrow>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table1">
        <TBODY>
        <TR>
          <TD class=bottomnavigationtext>© 2011 by <a href="http://skylove.ws">TienVu.Tv</a></TD>
          <TD class=bottomnavigationtext align=right>
          <a href="http://whos.amung.us/stats/0932200231/" target="_blank">
		  <img src="http://whos.amung.us/swidget/0932200231.png" border="0" /></a>
		  </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
      </FORM></TD></TR></TBODY></TABLE>
</BODY>
</HTML>
