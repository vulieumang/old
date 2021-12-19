/* Author: Anthony Ly */
$(function(){
	//social
	$("#facebook-button").bind("click",function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		window.open(href,'mywindow','width=640,height=380');
	});

	$("#twitter-button").click(function(e) {
		e.preventDefault();
		var href = $(this).attr("href");
		window.open(href,'mywindow','width=550,height=250');
	});
	$("#google-plus-button").click(function(e) {
		e.preventDefault();
		var href = $(this).attr("href");
		window.open(href,'mywindow','width=660,height=300');
	});

	//lang
	if($("body").hasClass("en")){switchLang("en");}
	$("ul.lang a").bind("click",function(e){
		e.preventDefault();
		if($(this).hasClass("active")) return;
		var lang = $(this).attr("id");
		switchLang(lang);
	});
	function switchLang(lang){
		$("ul.lang a.active").removeClass("active");
		$("ul.lang li a#"+lang).addClass("active");
		var id = lang;
		
		$.getJSON('data/lang/'+id+'.json', function(data) {
			$.each(data, function(key, val) {
				$(key).html(val);
			});
		});
		//slideshow
		var langUpper = id.toUpperCase(); 
		for (var s = 1; s<=4; s++) {
			$("ul.slideshow li img#slide-"+s).attr("src","img/screenshot"+s+langUpper+".jpg");
		};
		//appstore
		$("a.button-appstore").attr("href","http://tienvu.net/chat");
		//video
		var youtube = $('.video iframe');
		var srcYoutube;
		if(lang == 'fr'){
			srcYoutube = 'http://www.youtube.com/embed/wam-oMub8EU';
		}else{
			srcYoutube = 'http://www.youtube.com/embed/wam-oMub8EU';
		}
		youtube.attr('src', srcYoutube);
		//twitter
		var twitterLink;
		if(lang == 'fr'){
			twitterLink = 'http://twitter.com/share?text=Hội những người phát cuồng vì GAME!';
		}else{
			twitterLink = 'http://twitter.com/share?text=Hội những người phát cuồng vì GAME!';
		}
	}

	//Anim Chuck
	function animChuck(){
		var chuck = $("div.chuck");
		if (chuck.hasClass("shoot")) {chuck.removeClass("shoot");};

		if(chuck.hasClass("walk")){
			chuck.removeClass("walk");
		}else{
			chuck.addClass("walk");
		}
	}
	$(".chuck").bind("click",function(e){
		e.preventDefault;
		var chuck = $(this);
		if (!chuck.hasClass("shoot")) {chuck.addClass("shoot");};
		var balleLeft = $(this).offset().left + $(this).width()/2 - 5;
		var balleTop = $(this).offset().top +85;
		var balle = $("<img>");
		balle.attr("src","img/ball.png");
		balle.attr("class","ball");
		balle.css({
			'left':balleLeft,
			'top':balleTop
		});
		$(".wrap").append(balle);
		balle.animate({
			'top': -16
		},1000,'linear',function(){$(this).remove();});
	});
	$(window).scroll(function() {
		animChuck();
	});

	var timeSlidePage = 1500;
	//resize
	var limiteResponsiveWidth = 600;
	function resize(){
		var viewportWidth = $(window).width();
		if(viewportWidth<=limiteResponsiveWidth){
			$("html").unbind("mousewheel",mousewheelStep);
			var leftToCenter = -((limiteResponsiveWidth-viewportWidth)/2);
			$(".wrap-page").each(function(){
				$(this).css({
						"width" : viewportWidth,
						"left": leftToCenter
				});
			});
			$(".wrap").css("background-position", leftToCenter+"px 0px");
			return;
		} 
		$("html").bind("mousewheel",mousewheelStep);
		var viewportHeight = $(window).height();
		var pageWidth = $(".page").width();
		var wrapPageWidth, wrapPageHeight;
		var totalWidth = 500;
		$("body").css("height",viewportHeight)
		if(viewportWidth>800){wrapPageWidth=viewportWidth;}
		else{wrapPageWidth=800;}
		var i = 0;
		$(".wrap-page").each(function(){
			totalWidth += wrapPageWidth+300;
			$(this).css({
				"width" : wrapPageWidth,
				"left" : (wrapPageWidth*i)+(300*i)+250,

			})
			i++;
		});
		//fond
		if(viewportHeight>820){
			wrapPageHeight = viewportHeight;
		}else{
			wrapPageHeight = 820;
		}
		var htmlBody = $("html, body");
		htmlBody.css({
			'width':totalWidth,
			'height':viewportHeight
		});
		
		var fonds = $("div.fond-back, div.fond-front");
		fonds.css('width',totalWidth);

		var sea = $("div.fond-back div.sea");
		var seaTop = $(".page").offset().top+$(".page").height()-220;
		sea.css("top",seaTop);

		var mound = $("div.fond-front div.mound");
		var moundTop = seaTop+60;
		mound.css('top',moundTop);

		var sand1 = $("div.fond-front div.sand1");
		var sand1Top = moundTop+mound.height();
		var sand1Height = viewportHeight - sand1Top + 150;
		sand1.css({
			'height': sand1Height,
			'top':sand1Top
		});
		var clouds = $("div.fond-back div.clouds");
		var cloudsTop = seaTop-clouds.height();
		clouds.css("top",cloudsTop);
	}//resize()
	$(window).resize(function() {
		resize();
	});
	$(window).bind( 'orientationchange', function(e){
	    resize();
	});
	resize();

	//parralax
	function initParralax(){
		//parallax-back
		var parrot4 = $("div.parralax-back img.parrot-4");
		var parrot4Top = $("#page-2").offset().top;
		var parrot4Left = $("#page-2").offset().left+100;
		parrot4.css({
			'left': parrot4Left,
			'top':parrot4Top
		});

		var parrot6 = $("div.parralax-back img.parrot-6");
		var parrot6Top = $("#page-3").offset().top+300;
		var parrot6Left = $("#page-3").offset().left-600;
		parrot6.css({
			'left': parrot6Left,
			'top':parrot6Top
		});

		var parrot8 = $("div.parralax-back img.parrot-8");
		var parrot8Top = $(".sea").offset().top-20;
		var parrot8Left = $("#page-4").offset().left-700;
		parrot8.css({
			'left': parrot8Left,
			'top':parrot8Top
		});

		var parrot4bis = $("div.parralax-back img.parrot-4bis");
		var parrot4bisTop = $("#page-5").offset().top+160;
		var parrot4bisLeft = $("#page-5").offset().left-1100;
		parrot4bis.css({
			'left': parrot4bisLeft,
			'top':parrot4bisTop
		});
	//parallax-front
		var parrot1 = $("div.parralax-front img.parrot-1");
		var parrot1Top = $("#page-1").offset().top + $("#page-1").height()-150;
		var parrot1Left = $("#page-1").offset().left-200;
		parrot1.css({
			'left': parrot1Left,
			'top':parrot1Top
		});

		var parrot2 = $("div.parralax-front img.parrot-2");
		var parrot2Top = $("#page-1").offset().top + $("#page-1").height()-130;
		var parrot2Left = $("#page-1").offset().left + $("#page-1").width();
		parrot2.css({
			'left': parrot2Left,
			'top':parrot2Top
		});

		var parrot5 = $("div.parralax-front img.parrot-5");
		var parrot5Top = $("#page-2").offset().top + $("#page-2").height()-180;
		var parrot5Left = $("#page-2").offset().left + $("#page-2").width();
		parrot5.css({
			'left': parrot5Left,
			'top':parrot5Top
		});

		var parrot7 = $("div.parralax-front img.parrot-7");
		var parrot7Top = $("#page-3").offset().top + $("#page-3").height()-60;
		var parrot7Left = $("#page-3").offset().left + $("#page-3").width()-200;
		parrot7.css({
			'left': parrot7Left,
			'top':parrot7Top
		});

		var coin2 = $("div.parralax-front img.coins-2");
		var coin2Top = $("#page-4").offset().top + $("#page-4").height()-60;
		var coin2Left = $("#page-4").offset().left + $("#page-4").width();
		coin2.css({
			'left': coin2Left,
			'top':coin2Top
		});


		var parrot10 = $("div.parralax-front img.parrot-10");
		var parrot10Top = $("#page-5").offset().top + 80;
		var parrot10Left = $("#page-5").offset().left-700;
		parrot10.css({
			'left': parrot10Left,
			'top':parrot10Top
		});

		var chuck = $(".chuck");
		var chuckTop = $("#page-1").offset().top + 330;
		var chuckLeft = $("#page-1").offset().left;
		chuck.css({
			'left': chuckLeft,
			'top':chuckTop
		});
	//parallax-front-2
		var parrot3 = $("div.parralax-front-2 img.parrot-3");
		var parrot3Top = $("#page-1").offset().top  + $("#page-1").height() - 200;
		var parrot3Left = $("#page-1").offset().left + $("#page-1").width() + 200;
		parrot3.css({
			'left': parrot3Left,
			'top':parrot3Top
		});

		var coin1 = $("div.parralax-front-2 img.coins-1");
		var coin1Top = $("#page-2").offset().top + 70 ;
		var coin1Left = $("#page-2").offset().left + $("#page-1").width() - 400;
		coin1.css({
			'left': coin1Left,
			'top':coin1Top
		});

		var parrot9 = $("div.parralax-front-2 img.parrot-9");
		var parrot9Top = $("#page-4").offset().top  + $("#page-4").height() - 50;
		var parrot9Left = $("#page-4").offset().left ;
		parrot9.css({
			'left': parrot9Left,
			'top':parrot9Top
		});

		var parrot11 = $("div.parralax-front-2 img.parrot-11");
		var parrot11Top = $("#page-5").offset().top  + $("#page-4").height() - 50;
		var parrot11Left = $("#page-5").offset().left ;
		parrot11.css({
			'left': parrot11Left,
			'top':parrot11Top
		});
	}

	function animateClouds(){
		$("body.desktop div.fond-back div.clouds").animate({left:-50000},4000000,'linear',function(){
			$("body.desktop div.fond-back div.clouds").css("left",0);
			animateClouds();
		});
	}

	animateClouds();
	initParralax();

	$(".parrot-4").pikaparallax(1200);
	$(".parrot-6").pikaparallax(1000);
	$(".parrot-8").pikaparallax(1000);
	$(".parrot-4bis").pikaparallax(1200);

	$(".parrot-1").pikaparallax(600);
	$(".parrot-2").pikaparallax(600);
	$(".parrot-5").pikaparallax(600);
	$(".parrot-7").pikaparallax(600);
	$(".coins-2").pikaparallax(600);

	$(".parrot-10").pikaparallax(900);

	$(".parrot-3").pikaparallax(200);
	$(".parrot-4").pikaparallax(200);
	$(".parrot-9").pikaparallax(200);
	$(".coins-1").pikaparallax(200);
	$(".parrot-11").pikaparallax(200);

	$(".chuck").pikaparallax(800);

	//navigation
	$('html,body').animate({scrollLeft:$("#wrap-page-1").offset().left},0)

	$("body.desktop div.nav ul.navigation li a").hover(
		function(){
			var itemInfo = $(this).find("span");
			itemInfo.fadeIn();
		},
		function(){
			var itemInfo = $(this).find("span");
			itemInfo.hide();
		}
	);
	$("div.nav ul.navigation li a").bind("click",function(e){
		e.preventDefault();
		var anchor = $(this).attr("href");
		$('html,body').stop().animate({scrollLeft: $(anchor).offset().left},timeSlidePage,'linear',resize());
	})
	
	//page 3
	var timerSlideshow;
	var slideshowInterval = 3000;

	$("body.desktop #page-3 div.item").hover(
		function(){
			var idItem = $(this).attr("id").substr($(this).attr("id").length-1);
			var slideshow = $("#page-3 ul.slideshow");
			clearInterval(timerSlideshow);
			if(slideshow.find("li:nth-child("+(idItem)+")").hasClass("active")) return;
			slideshow.find("li.active").removeClass("active");
			slideshow.find("li:nth-child("+(idItem)+")").addClass("active");
			slideshow.stop().animate({'left':-(220*(idItem-1))});
		},
		function(){
			timerSlideshow = setInterval(slideshow,slideshowInterval);
		}
	);

	function slideshow(){
		var slideshow = $("#page-3 ul.slideshow");
		var currentItem = slideshow.find("li.active");
		var nextItem = ($("#page-3 ul.slideshow li.active:last-child").length) ? $("#page-3 ul.slideshow li:first-child") : currentItem.next();
		slideshow.find("li.active").removeClass("active");
		nextItem.addClass("active");
		var nextItemIndex = slideshow.find("li.active").index();
		slideshow.stop().animate({'left':-(220*nextItemIndex)});
	}
	
	timerSlideshow = setInterval(slideshow,slideshowInterval);

	//page-4
	$("body.desktop #page-4 ul.how-to li").hover(
		function(){

			var imgAnim = $(this).find("img.step-animation");

			var idAnim = parseInt(imgAnim.attr("id").substr(imgAnim.attr("id").length-1));
			switch(idAnim){
				case 1 : srcAnim = "img/cell2MoveOver.gif"; break;
				case 2 : srcAnim = "img/cell2ShootOver.gif"; break;
				case 3 : srcAnim = "img/cell2BonusOver.gif"; break;
			}

			imgAnim.attr("src",srcAnim);
		},
		function(){
			var imgAnim = $(this).find("img.step-animation");
			var idAnim = parseInt(imgAnim.attr("id").substr(imgAnim.attr("id").length-1));
			var srcAnim;
			switch(idAnim){
				case 1 : srcAnim = "img/cell2Move.png"; break;
				case 2 : srcAnim = "img/cell2Shoot.png"; break;
				case 3 : srcAnim = "img/cell2Bonus.png"; break;
			}
			imgAnim.attr("src",srcAnim);
		}
	);

	function mousewheelStep(event, delta){
		this.scrollLeft -= (delta * 50);
		event.preventDefault();
	}
	
	//IE 8
	$("ul.navigation li:last-child").css("margin-right",0);

});
