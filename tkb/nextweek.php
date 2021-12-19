<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Phần mềm tra cứu thời khóa biểu Đại Học Đà Lạt</title>
<link rel="shortcut icon"	href="favicon.ico">
</head>

<body>
<?php
	include 'laytkb-o.php';
	$today = date('m/d/Y');	
	$days = strtotime($today) - strtotime("07/21/2012");
	//echo $x/3600/24;
	$week=(int)($days/3600/24/7) + 1;
	echo '<span id="week">' . ' Tuần: '. $week . '</span>'; 
	//echo '<input id="pre" type="button" value="Tuần trước" onclick="preweek('. $week . ');"/>';
	//echo '<input id="next" type="button" value="Tuần sau" onclick="nextweek('. $week . ');"/>';
	
	echo '<a id="pre" href="index.php"></a>';

	laytkb($week);

?>
</body>
</html>