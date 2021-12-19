<?php
/*
Plugin Name: Tips
Version: 1.0
Plugin URL: http://emlog.net
Description: Hỗ trợ cho những người mới sử dụng Emlog
Author: dawei
Author Email: emloog@gmail.com
Author URL: http://www.emlog.net/blog/
*/

!defined('EMLOG_ROOT') && exit('access deined!');

$array_tips = array(
'Bạn có thể đính kèm nhiều tập tin trong bài viết.',
'Emlog hỗ trợ phân loại tags rất linh hoạt.',
'Hỗ trợ chức năng thụt lề bằng phím TAB.',
'Có thể tùy biến cột bên linh hoạt.',
'Có thể dễ dàng thay đổi thời gian viết bài.',
'Có thể ghi trích dẫn ở trang ngoài.',
'Chức năng tự động lưu giúp an toàn hơn khi viết bài.',
'Cho phép chèn flash trong bài viết.',
'Hỗ trợ biểu tượng cảm xúc trong bài viết.',
'Hỗ trợ tốt trích dẫn',
'Hỗ trợ nhạc nền ở cột bên.',
'Có thể lưu thành bản nháp để viết tiếp vào lúc khác.',
'Tự động hình thành ảnh thu nhỏ để giảm thời gian tải trang.',
'Emlog mã nguồn blog miễn phí.',
'Các bài viết mới sẽ được cập nhật ở cột bên',
'Có thể sử dụng hình ảnh torng đính kèm để minh họa bài viết.',
'Có thể thiết lập mật khẩu cho bài viết.',
'Hỗ trợ nhiều người viết cùng.',
'Hỗ trợ trang tự xây dựng...',
'Có thể thu nhỏ các widget tại cột bên.',
'Kiểm tra tập tin install.php nếu có tồn tại hãy xóa nó để giữ bảo mật.',
'Bạn sao lưu dữ liệu của mình chưa?',
'Bạn đã ghi twitter chưa?',
);

function tips()
{
	global $array_tips;
	$i = mt_rand(0, count($array_tips) - 1);
	$tip = $array_tips[$i];	
	echo "<div id=\"tip\"> $tip</div>";
}

addAction('adm_main_top', 'tips');

function tips_css()
{
	echo "
	<style type='text/css'>
	#tip{
		background:url(../content/plugins/tips/icon_tips.gif) no-repeat left 3px;
		padding:3px 18px;
		margin:5px 0px;
		font-size:12px;
		color:#999999;
	}
	</style>";
}

addAction('adm_head', 'tips_css');

?>