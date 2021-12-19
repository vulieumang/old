<?php
function jatbi($url)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,"Windows-Media-Player/10.00.00.xxxx");
return curl_exec($ch);
}
$link = $_GET['link'];		
$link_get = jatbi($link);
$link_download = explode('</a><a title="Tải nhạc 128Kb" href="',$link_get);
$link_download = explode('"',$link_download[1]);
$link_download = $link_download[0];
header("Location: ".$link_download);
?>