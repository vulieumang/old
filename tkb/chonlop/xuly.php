<div>
	<?php

		
		include "index.php";
		$text=$_POST['cboCourse'];

		
	
		$filename = '../lop.txt';
		$somecontent = $text;

		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {

			// In our example we're opening $filenarme in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'w')) {
				 echo "Không thể kết nối tới file lop.txt";
				 exit;
			}

			// Write $somecontent to our opened file.
			if (fwrite($handle, $somecontent) === FALSE) {
				echo "Không thể lưu lại lớp, bạn nên sửu trực hiếp file lop.txt";
				exit;
			}

			echo "OK, đã ghi ($somecontent) vào cơ sở dữ liệu";

			fclose($handle);

		} 
		else 
		{
			echo "The file $filename is not writable";
		}
	
	?>
	
	
	
</div>