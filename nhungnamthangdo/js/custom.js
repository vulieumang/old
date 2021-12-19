$(document).ready(function() {

// initial fade effect for the entire screen
	var $content = $('#wrapper');
	$content.css('opacity',0);
	$('#progress').fadeOut(500, function() {
		$content.animate({'opacity':1}, 500);
	});


// cowntdown function. Set the date by modifying the date in next line (June 1, 2012 00:00:00):
	var austDay = new Date("June 1, 2012 00:00:00");
		$('#countdown').countdown({until: austDay, layout: '<div class="item"><p>{dn}</p> {dl}<div class="lines"></div></div> <div class="item"><p>{hn}</p> {hl}<div class="lines"></div></div> <div class="item"><p>{mn}</p> {ml}<div class="lines"></div></div> <div class="item"><p>{sn}</p> {sl}</div>'});
		$('#year').text(austDay.getFullYear());
			

// toggle function
	$('a.trigger').click(function(){
		if( ! $(this).hasClass('active')){
			$("#totoggle").slideToggle("slow");
			$(this).addClass('active');
			$('#container').append('<div class="text">Gửi những người tôi yêu quý!</div>').show('slow');
		} else {
		$("#totoggle").slideToggle("slow");
			$(this).removeClass('active');
			$('.text').remove();
		}
	});	
				
			
// hover effects for the functionality buttons inside the box 			
	$("ul.buttons li, ul.top-buttons li").hover(function() {
		$(this).children('a').animate({opacity:"1"},{queue:false,duration:300}) },
		function() {
			$(this).children('a').animate({opacity:"0.5"},{queue:false,duration:300})
			});			

			
// draggable function
	$( "#container" ).draggable({ handle: ".drag", containment: "#supersized", scroll: false });			


//functions for the info, contact and back home buttons

// from home to info
	function infopage() {
		if  ($("#infopage").is(":hidden")) {
			
				$("a.info").css({"background":"url(images/home.png) no-repeat scroll 0 0"});
				$("a.contact").css({"background":"url(images/home.png) no-repeat scroll 0 0"});
				$("#homepage").animate({height: "toggle", opacity: "toggle"}, "slow" );
				$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			}
			else {
				$("a.info").css({"background":"url(images/info.png) no-repeat scroll 0 0"});
				$("a.contact").css({"background":"url(images/contact.png) no-repeat scroll 0 0"});
				$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
				$("#homepage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			}
		}
		
//run from home to info
	$(".info").click(function(){infopage()});	


// from home to contact
	function contactpage() {
		if ($("#contactpage").is(":hidden"))
		{
			$("a.contact").css({"background":"url(images/home.png) no-repeat scroll 0 0"});
			$("a.info").css({"background":"url(images/home.png) no-repeat scroll 0 0"});
			$("#homepage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
		else{
			$("a.contact").css({"background":"url(images/contact.png) no-repeat scroll 0 0"});
			$("a.info").css({"background":"url(images/info.png) no-repeat scroll 0 0"});
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#homepage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
	}

//run from home to contact
	$(".contact").click(function(){contactpage()});	


//from info to contact
	function infocontact() {
		if ($("#contactpage").is(":hidden"))
		{
			$("a.contact").css({"background":"url(images/home.png) no-repeat scroll 0 0"});
			$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
		else{
			$("a.contact").css({"background":"url(images/contact.png) no-repeat scroll 0 0"});
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
	}
	
// run from info to contact
	$(".infocontact").click(function(){infocontact()});	


// from contact to info
	function contactinfo() {
		if ($("#infopage").is(":hidden"))
		{
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
		else{
			$("#infopage").animate({height: "toggle", opacity: "toggle"}, "slow" );
			$("#contactpage").animate({height: "toggle", opacity: "toggle"}, "slow" );
		}
	}
	
// run from contact to info
	$(".contactinfo").click(function(){contactinfo()});	

});	


// full screen slider	
$(document).ready( function(){
	
	$.supersized({
	
		// Functionality
		slide_interval          :   8000,		// Length between transitions
		transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	1000,		// Speed of transition
												   
		// Components							
		slide_links				:	'false',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		slides 					:  	[			// Slideshow Images
{image : 'images/gallery/slide1.jpg', thumb : 'images/gallery/thumb1.jpg', url : ''}, 
{image : 'images/gallery/slide2.jpg', thumb : 'images/gallery/thumb2.jpg', url : ''}, 
{image : 'images/gallery/slide3.jpg', thumb : 'images/gallery/thumb3.jpg', url : ''}, 
{image : 'images/gallery/slide4.jpg', thumb : 'images/gallery/thumb4.jpg', url : ''}, 
{image : 'images/gallery/slide5.jpg', thumb : 'images/gallery/thumb5.jpg', url : ''}, 
{image : 'images/gallery/slide6.jpg', thumb : 'images/gallery/thumb6.jpg', url : ''}, 
{image : 'images/gallery/slide7.jpg', thumb : 'images/gallery/thumb7.jpg', url : ''}, 
{image : 'images/gallery/slide8.jpg', thumb : 'images/gallery/thumb8.jpg', url : ''}, 
{image : 'images/gallery/slide9.jpg', thumb : 'images/gallery/thumb9.jpg', url : ''}, 
{image : 'images/gallery/slide10.jpg', thumb : 'images/gallery/thumb10.jpg', url : ''}, 
{image : 'images/gallery/slide11.jpg', thumb : 'images/gallery/thumb11.jpg', url : ''}, 
{image : 'images/gallery/slide12.jpg', thumb : 'images/gallery/thumb12.jpg', url : ''}, 
{image : 'images/gallery/slide13.jpg', thumb : 'images/gallery/thumb13.jpg', url : ''}, 
{image : 'images/gallery/slide14.jpg', thumb : 'images/gallery/thumb14.jpg', url : ''}, 
{image : 'images/gallery/slide15.jpg', thumb : 'images/gallery/thumb15.jpg', url : ''}, 
{image : 'images/gallery/slide16.jpg', thumb : 'images/gallery/thumb16.jpg', url : ''}, 
{image : 'images/gallery/slide17.jpg', thumb : 'images/gallery/thumb17.jpg', url : ''}, 
{image : 'images/gallery/slide18.jpg', thumb : 'images/gallery/thumb18.jpg', url : ''}, 
{image : 'images/gallery/slide19.jpg', thumb : 'images/gallery/thumb19.jpg', url : ''}, 
{image : 'images/gallery/slide20.jpg', thumb : 'images/gallery/thumb20.jpg', url : ''}, 
{image : 'images/gallery/slide21.jpg', thumb : 'images/gallery/thumb21.jpg', url : ''}, 
{image : 'images/gallery/slide22.jpg', thumb : 'images/gallery/thumb22.jpg', url : ''}, 
{image : 'images/gallery/slide23.jpg', thumb : 'images/gallery/thumb23.jpg', url : ''}, 
{image : 'images/gallery/slide24.jpg', thumb : 'images/gallery/thumb24.jpg', url : ''}, 
{image : 'images/gallery/slide25.jpg', thumb : 'images/gallery/thumb25.jpg', url : ''}, 
{image : 'images/gallery/slide26.jpg', thumb : 'images/gallery/thumb26.jpg', url : ''}, 
{image : 'images/gallery/slide27.jpg', thumb : 'images/gallery/thumb27.jpg', url : ''}, 
{image : 'images/gallery/slide28.jpg', thumb : 'images/gallery/thumb28.jpg', url : ''}, 
{image : 'images/gallery/slide29.jpg', thumb : 'images/gallery/thumb29.jpg', url : ''}, 
{image : 'images/gallery/slide30.jpg', thumb : 'images/gallery/thumb30.jpg', url : ''}, 
{image : 'images/gallery/slide31.jpg', thumb : 'images/gallery/thumb31.jpg', url : ''}, 
{image : 'images/gallery/slide32.jpg', thumb : 'images/gallery/thumb32.jpg', url : ''}, 
{image : 'images/gallery/slide33.jpg', thumb : 'images/gallery/thumb33.jpg', url : ''}, 
{image : 'images/gallery/slide34.jpg', thumb : 'images/gallery/thumb34.jpg', url : ''}, 
{image : 'images/gallery/slide35.jpg', thumb : 'images/gallery/thumb35.jpg', url : ''}, 
{image : 'images/gallery/slide36.jpg', thumb : 'images/gallery/thumb36.jpg', url : ''}, 
{image : 'images/gallery/slide37.jpg', thumb : 'images/gallery/thumb37.jpg', url : ''}, 
{image : 'images/gallery/slide38.jpg', thumb : 'images/gallery/thumb38.jpg', url : ''}, 
{image : 'images/gallery/slide39.jpg', thumb : 'images/gallery/thumb39.jpg', url : ''}, 
{image : 'images/gallery/slide40.jpg', thumb : 'images/gallery/thumb40.jpg', url : ''}, 
{image : 'images/gallery/slide41.jpg', thumb : 'images/gallery/thumb41.jpg', url : ''}, 
{image : 'images/gallery/slide42.jpg', thumb : 'images/gallery/thumb42.jpg', url : ''}, 
{image : 'images/gallery/slide43.jpg', thumb : 'images/gallery/thumb43.jpg', url : ''}, 
{image : 'images/gallery/slide44.jpg', thumb : 'images/gallery/thumb44.jpg', url : ''}, 
{image : 'images/gallery/slide45.jpg', thumb : 'images/gallery/thumb45.jpg', url : ''}, 
{image : 'images/gallery/slide46.jpg', thumb : 'images/gallery/thumb46.jpg', url : ''}, 
{image : 'images/gallery/slide47.jpg', thumb : 'images/gallery/thumb47.jpg', url : ''}, 
{image : 'images/gallery/slide48.jpg', thumb : 'images/gallery/thumb48.jpg', url : ''}, 
{image : 'images/gallery/slide49.jpg', thumb : 'images/gallery/thumb49.jpg', url : ''}, 
{image : 'images/gallery/slide50.jpg', thumb : 'images/gallery/thumb50.jpg', url : ''}, 
{image : 'images/gallery/slide51.jpg', thumb : 'images/gallery/thumb51.jpg', url : ''}, 
{image : 'images/gallery/slide52.jpg', thumb : 'images/gallery/thumb52.jpg', url : ''}, 
{image : 'images/gallery/slide53.jpg', thumb : 'images/gallery/thumb53.jpg', url : ''}, 
{image : 'images/gallery/slide54.jpg', thumb : 'images/gallery/thumb54.jpg', url : ''}, 
{image : 'images/gallery/slide55.jpg', thumb : 'images/gallery/thumb55.jpg', url : ''}, 
{image : 'images/gallery/slide56.jpg', thumb : 'images/gallery/thumb56.jpg', url : ''}, 
{image : 'images/gallery/slide57.jpg', thumb : 'images/gallery/thumb57.jpg', url : ''}, 
{image : 'images/gallery/slide58.jpg', thumb : 'images/gallery/thumb58.jpg', url : ''}, 
{image : 'images/gallery/slide59.jpg', thumb : 'images/gallery/thumb59.jpg', url : ''}, 
{image : 'images/gallery/slide60.jpg', thumb : 'images/gallery/thumb60.jpg', url : ''}, 
{image : 'images/gallery/slide61.jpg', thumb : 'images/gallery/thumb61.jpg', url : ''}, 
{image : 'images/gallery/slide62.jpg', thumb : 'images/gallery/thumb62.jpg', url : ''}, 
{image : 'images/gallery/slide63.jpg', thumb : 'images/gallery/thumb63.jpg', url : ''}, 
{image : 'images/gallery/slide64.jpg', thumb : 'images/gallery/thumb64.jpg', url : ''}, 
{image : 'images/gallery/slide65.jpg', thumb : 'images/gallery/thumb65.jpg', url : ''}, 
{image : 'images/gallery/slide66.jpg', thumb : 'images/gallery/thumb66.jpg', url : ''}, 
{image : 'images/gallery/slide67.jpg', thumb : 'images/gallery/thumb67.jpg', url : ''}, 
{image : 'images/gallery/slide68.jpg', thumb : 'images/gallery/thumb68.jpg', url : ''}, 
{image : 'images/gallery/slide69.jpg', thumb : 'images/gallery/thumb69.jpg', url : ''}, 
{image : 'images/gallery/slide70.jpg', thumb : 'images/gallery/thumb70.jpg', url : ''}, 
{image : 'images/gallery/slide71.jpg', thumb : 'images/gallery/thumb71.jpg', url : ''}, 
{image : 'images/gallery/slide72.jpg', thumb : 'images/gallery/thumb72.jpg', url : ''}, 
{image : 'images/gallery/slide73.jpg', thumb : 'images/gallery/thumb73.jpg', url : ''}, 
{image : 'images/gallery/slide74.jpg', thumb : 'images/gallery/thumb74.jpg', url : ''}, 
{image : 'images/gallery/slide75.jpg', thumb : 'images/gallery/thumb75.jpg', url : ''}, 
{image : 'images/gallery/slide76.jpg', thumb : 'images/gallery/thumb76.jpg', url : ''}, 
{image : 'images/gallery/slide77.jpg', thumb : 'images/gallery/thumb77.jpg', url : ''}, 
{image : 'images/gallery/slide78.jpg', thumb : 'images/gallery/thumb78.jpg', url : ''}, 
{image : 'images/gallery/slide79.jpg', thumb : 'images/gallery/thumb79.jpg', url : ''}, 
{image : 'images/gallery/slide80.jpg', thumb : 'images/gallery/thumb80.jpg', url : ''}, 
{image : 'images/gallery/slide81.jpg', thumb : 'images/gallery/thumb81.jpg', url : ''}, 
{image : 'images/gallery/slide82.jpg', thumb : 'images/gallery/thumb82.jpg', url : ''}, 
{image : 'images/gallery/slide83.jpg', thumb : 'images/gallery/thumb83.jpg', url : ''}, 
{image : 'images/gallery/slide84.jpg', thumb : 'images/gallery/thumb84.jpg', url : ''}, 
{image : 'images/gallery/slide85.jpg', thumb : 'images/gallery/thumb85.jpg', url : ''}, 
{image : 'images/gallery/slide86.jpg', thumb : 'images/gallery/thumb86.jpg', url : ''}, 
{image : 'images/gallery/slide87.jpg', thumb : 'images/gallery/thumb87.jpg', url : ''}, 
{image : 'images/gallery/slide88.jpg', thumb : 'images/gallery/thumb88.jpg', url : ''}, 
{image : 'images/gallery/slide89.jpg', thumb : 'images/gallery/thumb89.jpg', url : ''}, 
{image : 'images/gallery/slide90.jpg', thumb : 'images/gallery/thumb90.jpg', url : ''}, 
{image : 'images/gallery/slide91.jpg', thumb : 'images/gallery/thumb91.jpg', url : ''}, 
{image : 'images/gallery/slide92.jpg', thumb : 'images/gallery/thumb92.jpg', url : ''}, 
{image : 'images/gallery/slide93.jpg', thumb : 'images/gallery/thumb93.jpg', url : ''}, 
{image : 'images/gallery/slide94.jpg', thumb : 'images/gallery/thumb94.jpg', url : ''}, 
{image : 'images/gallery/slide95.jpg', thumb : 'images/gallery/thumb95.jpg', url : ''}, 
{image : 'images/gallery/slide96.jpg', thumb : 'images/gallery/thumb96.jpg', url : ''}, 
{image : 'images/gallery/slide97.jpg', thumb : 'images/gallery/thumb97.jpg', url : ''}, 
{image : 'images/gallery/slide98.jpg', thumb : 'images/gallery/thumb98.jpg', url : ''}, 
{image : 'images/gallery/slide99.jpg', thumb : 'images/gallery/thumb99.jpg', url : ''}, 
{image : 'images/gallery/slide100.jpg', thumb : 'images/gallery/thumb100.jpg', url : ''}, 
{image : 'images/gallery/slide101.jpg', thumb : 'images/gallery/thumb101.jpg', url : ''}, 
{image : 'images/gallery/slide102.jpg', thumb : 'images/gallery/thumb102.jpg', url : ''}, 
{image : 'images/gallery/slide103.jpg', thumb : 'images/gallery/thumb103.jpg', url : ''}, 
{image : 'images/gallery/slide104.jpg', thumb : 'images/gallery/thumb104.jpg', url : ''}, 
{image : 'images/gallery/slide105.jpg', thumb : 'images/gallery/thumb105.jpg', url : ''}, 
{image : 'images/gallery/slide106.jpg', thumb : 'images/gallery/thumb106.jpg', url : ''}, 
{image : 'images/gallery/slide107.jpg', thumb : 'images/gallery/thumb107.jpg', url : ''}, 
{image : 'images/gallery/slide108.jpg', thumb : 'images/gallery/thumb108.jpg', url : ''}, 
{image : 'images/gallery/slide109.jpg', thumb : 'images/gallery/thumb109.jpg', url : ''}, 
{image : 'images/gallery/slide110.jpg', thumb : 'images/gallery/thumb110.jpg', url : ''}, 
{image : 'images/gallery/slide111.jpg', thumb : 'images/gallery/thumb111.jpg', url : ''}, 
{image : 'images/gallery/slide112.jpg', thumb : 'images/gallery/thumb112.jpg', url : ''}, 
{image : 'images/gallery/slide113.jpg', thumb : 'images/gallery/thumb113.jpg', url : ''}, 
{image : 'images/gallery/slide114.jpg', thumb : 'images/gallery/thumb114.jpg', url : ''}, 
{image : 'images/gallery/slide115.jpg', thumb : 'images/gallery/thumb115.jpg', url : ''}, 
{image : 'images/gallery/slide116.jpg', thumb : 'images/gallery/thumb116.jpg', url : ''}, 
{image : 'images/gallery/slide117.jpg', thumb : 'images/gallery/thumb117.jpg', url : ''}, 
{image : 'images/gallery/slide118.jpg', thumb : 'images/gallery/thumb118.jpg', url : ''}, 
{image : 'images/gallery/slide119.jpg', thumb : 'images/gallery/thumb119.jpg', url : ''}, 
{image : 'images/gallery/slide120.jpg', thumb : 'images/gallery/thumb120.jpg', url : ''}, 
{image : 'images/gallery/slide121.jpg', thumb : 'images/gallery/thumb121.jpg', url : ''}, 
{image : 'images/gallery/slide122.jpg', thumb : 'images/gallery/thumb122.jpg', url : ''}, 
{image : 'images/gallery/slide123.jpg', thumb : 'images/gallery/thumb123.jpg', url : ''}, 
{image : 'images/gallery/slide124.jpg', thumb : 'images/gallery/thumb124.jpg', url : ''}, 
{image : 'images/gallery/slide125.jpg', thumb : 'images/gallery/thumb125.jpg', url : ''}, 
{image : 'images/gallery/slide126.jpg', thumb : 'images/gallery/thumb126.jpg', url : ''}, 
{image : 'images/gallery/slide127.jpg', thumb : 'images/gallery/thumb127.jpg', url : ''}, 
{image : 'images/gallery/slide128.jpg', thumb : 'images/gallery/thumb128.jpg', url : ''}, 
{image : 'images/gallery/slide129.jpg', thumb : 'images/gallery/thumb129.jpg', url : ''}, 
{image : 'images/gallery/slide130.jpg', thumb : 'images/gallery/thumb130.jpg', url : ''}, 
{image : 'images/gallery/slide131.jpg', thumb : 'images/gallery/thumb131.jpg', url : ''}, 
{image : 'images/gallery/slide132.jpg', thumb : 'images/gallery/thumb132.jpg', url : ''}, 
{image : 'images/gallery/slide133.jpg', thumb : 'images/gallery/thumb133.jpg', url : ''}, 
{image : 'images/gallery/slide134.jpg', thumb : 'images/gallery/thumb134.jpg', url : ''}, 
{image : 'images/gallery/slide135.jpg', thumb : 'images/gallery/thumb135.jpg', url : ''}, 
{image : 'images/gallery/slide136.jpg', thumb : 'images/gallery/thumb136.jpg', url : ''}, 
{image : 'images/gallery/slide137.jpg', thumb : 'images/gallery/thumb137.jpg', url : ''}, 
{image : 'images/gallery/slide138.jpg', thumb : 'images/gallery/thumb138.jpg', url : ''}, 
{image : 'images/gallery/slide139.jpg', thumb : 'images/gallery/thumb139.jpg', url : ''}, 
{image : 'images/gallery/slide140.jpg', thumb : 'images/gallery/thumb140.jpg', url : ''}, 
{image : 'images/gallery/slide141.jpg', thumb : 'images/gallery/thumb141.jpg', url : ''}, 
{image : 'images/gallery/slide142.jpg', thumb : 'images/gallery/thumb142.jpg', url : ''}, 
{image : 'images/gallery/slide143.jpg', thumb : 'images/gallery/thumb143.jpg', url : ''}, 
{image : 'images/gallery/slide144.jpg', thumb : 'images/gallery/thumb144.jpg', url : ''}, 
{image : 'images/gallery/slide145.jpg', thumb : 'images/gallery/thumb145.jpg', url : ''}, 
{image : 'images/gallery/slide146.jpg', thumb : 'images/gallery/thumb146.jpg', url : ''}, 
{image : 'images/gallery/slide147.jpg', thumb : 'images/gallery/thumb147.jpg', url : ''}, 
{image : 'images/gallery/slide148.jpg', thumb : 'images/gallery/thumb148.jpg', url : ''}

									]
	});
});
