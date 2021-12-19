function date()
{	
	
	var d=new Date();
	var theDay=d.getDay();
	//$fthu= $("[align='center']");
	// $fthu= $("table");
	$thu = $("#day th");
	$thu[0].style.color ="yellow";
	//alert($fthu.length);
	switch (theDay)
	{
		case 1:
		  $thu[0].color ="yellow";
		  //$fthu[5].background = "blue";
		  //$fthu[3].align = "left";
		  break;
		case 2:
		  $thu[1].color ="yellow";
		  break;
		case 3:
		  $thu[2].color ="yellow";
		  break;
		case 4:
		  $thu[3].color ="yellow";
		  break;
		case 5:
		  $thu[4].color ="yellow";
		  break;
		case 6:
		  $thu[5].color ="yellow";
		  break;
		case 0:
		  $thu[6].color ="yellow";
		  break;
		default:
		  break;
	}
}
