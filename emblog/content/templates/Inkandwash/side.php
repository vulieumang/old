	<div id="sidebar" role="complementary">
		<!-- Search Start -->
		<div id="search">
			<form name="keyform" method="get" id="searchform" action="<?php echo BLOG_URL; ?>index.php">
				<span class="st"><input type="text" value="" name="keyword" id="keyword" class="searchtxt" /></span><span class="ss"><input type="submit" value="" class="searchsm" /></span>
			</form>
		</div>
		<div class="clear"></div>
		<!-- Search End -->
		<ul>
<?php 
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
doAction('diff_side');
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content'], $val);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>
			<li class="widget widget_rss">
		    <ul>
				<a href="<?php echo BLOG_URL; ?>rss.php" title="订阅本站RSS" target="_blank"></a>
			</ul>
			</li>
		</ul>
  </div>
