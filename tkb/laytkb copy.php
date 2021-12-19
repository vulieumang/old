<?php
	include 'lop.php';
	function laytkb($week)
	{
		global $lop;
		//mở đọc code html của trang web
		$f = fopen("http://www.dlu.edu.vn/timetable_display.aspx?course=$lop&subjectcode=&week=$week", "rb");
		if ($f)
		{
			$contents = '';
			while (!feof($f)) {
			  $contents .= fread($f, 8192);
			}
			fclose($f);
			//echo  $contents;
			$pattern = '/<div class="fl pad_l6 tl">(.*)<!-- } mid column -->/si';
			if(preg_match($pattern,$contents,$str))
				$xuat = "<html><head><link href='style.css' rel='stylesheet' type='text/css' />";
				$xuat .= "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>";
				$xuat .= "<script type='text/javascript' src='date.js'></script>";
				$xuat .= "</head><body onload='date();'>" . $str[0] . "</body></html>";
			echo $xuat;
		}
		else
		{
			echo 'Không thể kết nối tới DLU.EDU.VN bạn có muốn dùng cache không?';
		}
	}
?>