<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<div class="containertitle2">
<a class="navi1" href="./configure.php">Cấu hình</a>
<a class="navi4" href="./style.php">Giao diện</a>
<a class="navi2" href="./permalink.php">Liên kết</a>
<a class="navi4" href="./blogger.php">Thông tin</a>
<?php if(isset($_GET['activated'])):?><span class="actived">Thiết lập thành công!</span><?php endif;?>
<?php if(isset($_GET['error'])):?><span class="error">Kiểm tra CHMOD tập tin .htaccess</span><?php endif;?>
</div>
<div style="margin-left:10px;">
<div class="des">Bạn có thể tùy chỉnh các liên kết của website để nâng cao khả năng SEO và thân thiện với người dùng.<br /> Nếu thay đổi liên kết gây lỗi, vui lòng để lại mặc định.
</div>
<form action="permalink.php?action=update" method="post">
<div style="margin:10px 10px;">
	<li><input type="radio" name="permalink" value="0" <?php echo $ex0; ?>>Mặc định: <span class="permalink_url"><?php echo BLOG_URL; ?>?post=1</span></li>
    <li><input type="radio" name="permalink" value="1" <?php echo $ex1; ?>>Kiểu 1: <span class="permalink_url"><?php echo BLOG_URL; ?>post-1.html</span></li>
    <li><input type="radio" name="permalink" value="2" <?php echo $ex2; ?>>Kiểu 2: <span class="permalink_url"><?php echo BLOG_URL; ?>post/1</span></li>
	<li><input type="radio" name="permalink" value="3" <?php echo $ex3; ?>>Kiểu 3: <span class="permalink_url"><?php echo BLOG_URL; ?>category/1.html</span></li>
    <div style="border-top:1px solid #F7F7F7; width:521px; margin:10px 0px 10px 0px;"></div>
	<li>Kích hoạt tính năng: <input type="checkbox" style="vertical-align:middle;" value="y" name="isalias" id="isalias" <?php echo $isalias; ?> /></li>
	<li>Sử dụng hậu tố HTML: <input type="checkbox" style="vertical-align:middle;" value="y" name="isalias_html" id="isalias_html" <?php echo $isalias_html; ?> /></li>
	<li style="margin-top:10px;"><input type="submit" value="Thiết lập" class="button" /></li>
</div>
</form>
</div>