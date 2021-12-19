<?php

$file=fopen("lop.txt","r") or exit ("Khong the mo file lop.txt");
while(!feof($file))
	{
		$lop = fgets($file);
	}
	fclose($file);
	
?>


