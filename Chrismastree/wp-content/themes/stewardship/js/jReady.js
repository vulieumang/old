/* ------------------------------------------------- */
/* ------ The Christmas Tree from Stewardship ------ */
/* ------------------ MASTER JS -------------------- */
/* ------------------------------------------------- */

/*
Created for Stewardship -- http://www.stewardship.org.uk/
Created by Steve O -- http://vdotgood.com
and Ahead In The Clouds -- http://aheadintheclouds.org/

Dependancies: jQuery, jRedirect, Modernizr, Zachstronaut jQuery rotate/css transform patch, jQuery Easing, Easel JS, jQuery Snowfall.
Last updated: 06.12.11
*/

$(document).ready(function() { //when the document is ready...
    
	// IMPORTANT VARS
	var winW = $(window).width();
	var winH = $(window).height();
	var $window = $(window);
	var initialLoad = false;
	var browserSafe = true;
	var ieversion;

	// GET BROWSER VERSION IF IE
	if ($.browser.msie){
		ieversion = $.browser.version; // USE JQUERY BROWSER API
		$('html').addClass("ie" + Math.floor(ieversion));
        if (ieversion <= 8){	
		browserSafe = false;
		}
	}
	
	// START BY HIDING ALL SECTIONS (+ SHOWING PRELOADER IMAGE WITH INLINE JS)
	$('.hide').hide();    

	// SET PAGE SCROLL POSITION TO TOP
	$('html, body').animate({'scrollTop':1}, 0);
		
	// NEXT INITIALISE THE SPARKLES!
	if(browserSafe){ initSparkle(); }
	
	// CLICKS + HOVERS
	$("#sign_wood span").click(function(event){
		$('html, body').animate({'scrollTop':1700}, 1500);
		//sparkleIt(event);
	});
		
	// CONTENT VIEWER
	$(".story-link").click(function() {
		//sparkleIt();
		openViewer("story");
		var rel = $(this).attr("rel");
		var id = "#" + rel + ".story, #share_" + rel;
		$("#main_box_story").addClass($(this).attr("data-length"));
		$(id).show();
		location.hash = "/" + rel.replace("story_", "");
		return false;
	});
	$(".note-link").click(function() {
		//sparkleIt();
		openViewer("note");      
		var id = "#" + $(this).attr("rel") + ".note, #share_note_" + $(this).attr("rel");
		$(id).show();
		return false;
	});
	$(".video-link").click(function() {
		//sparkleIt();
		openViewer("video");
        var vid = "#" + $(this).attr("rel");
		var sid = "#share_" + $(this).attr("rel");
        var id = vid + ", " + sid;
        if($.browser.msie && ieversion > 9){
            $(vid).addClass('ontop');
            $(sid).show();
        }else{
    		$(id).show();
        }
		return false;
	});
	
	var sparkleTimer;
	$(".story-link, .note-link, .video-link").mouseenter(function() {
		sparkling;
		sparkleTimer = setTimeout(sparkling, 200);
	}).mouseleave(function() {
		clearTimeout(sparkleTimer);
	});
	
	var sparkling = function(){
		if(browserSafe){
			//console.log("called");
			addSparkles(Math.random()*10+5|0, stage.mouseX, stage.mouseY,1);
			
			sparkleTimer = setTimeout(sparkling, 200);
		}
	}
	
	
	/*######################################*/
	//      *** WINDOW RESIZE EVENT ***     //
	/*######################################*/
	var boxTop, boxPos, scrollPos;
    var element = null;
	
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	
	$(window).resize(function() {
		delay(function(){
			winW = $(window).width();
			winH = $(window).height();
			scrollPos = $window.scrollTop();
			
			if(element !== null){
            if(element.length > 0){
				if((element.height() + 100) >= winH){
					boxTop = scrollPos + 50;
					boxPos = "absolute";
				}else{
					boxTop = ((winH - element.height())/2) - 50;
					boxPos = "fixed";
				}
				$("div#main_box").css({position:boxPos, top:boxTop});
			}
            }
            
            if(!stockingEditor){
                $("#content_stocking").css({bottom:winH+200});
            }else{
                $("#content_stocking").css({bottom:(winH/2)-100});
            }

		}, 300);
	});
	
	
	/*#################################*/
	//      *** CONTENT VIEWER ***     //
	/*#################################*/
	function closeViewer(){
		initialLoad = false;
		$("div#main_overlay, div#main_box").animate({opacity:0}, function(){
			$(this).hide();
			$("div.content, div.story, div.note, div.share").hide();
            if($.browser.msie && ieversion >= 9){
                $("div.video").removeClass('ontop');   
            }else{
                $("div.video").hide();
            }

			$("div.video_player").each(function(index){
				var tempPlayer = $(this).html();
				$(this).html(" ")
				$(this).html(tempPlayer);
			});
			$("div.content").attr('class', 'content');
		});
		location.hash = "/";
		return false;
	}
	
	function openViewer(type){
		scrollPos = $window.scrollTop();
		$("div#main_box").css({position:"absolute", top:scrollPos+100, opacity:0});
		
		switch(type){
			case "story":
				element = $("#main_box_story");				
				break;
			case "note":
				element = $("#main_box_note");				
				break;
			case "video":
				element = $("#main_box_video");
				break;
		}
		
		if((element.height() + 100) >= winH){
			boxTop = scrollPos + 50;
			boxPos = "absolute";
		}else{
			boxTop = ((winH - element.height())/2) - 50;
			boxPos = "fixed";
		}
		element.show();
		$("div#main_box").css({position:boxPos, top:boxTop, opacity:0});
		$("div#main_overlay, div#main_box").show().animate({opacity:1}, function(){
			lightsOff();
			//$(document).snowfall("stop");
			if(!initialLoad) sparkleIt();
		});
	}
	
	$("span#main_box_close").click(function(){
		closeViewer();
		//$(document).snowfall("start");
		if(lightsCurrSeq !== null)
			lightsTimer = setTimeout(lightsCurrSeq);
	});
	
	
	
	
	/*###########################*/
	//      *** PARALLAX ***     //
	/*###########################*/
	// SAVE SELECTORS FOR BETTER PERFORMANCE
	var $bg = $('#main_background');
	var $header = $('#main_header');
	var $sign = $('#main_sign');
	var $sign_candy = $('#sign_candy');
	var $sign_candy_title = $('#sign_candy_title');
	var $sign_candy_info = $('#sign_candy_info');
	var $sign_wood = $('#sign_wood');
	var $sign_sharing = $('#sign_sharing');
	var $enter_sf = $('#enter_sf');
	var $controls = $("#main_controls");
	var $view_content = $('#view_content');
	var $sf_left = $('#content_sf_left');
	var $sf_right = $('#content_sf_right');
	
	function getPos(sPos, tPos, scrollS, scrollD, scrollPos){
		var moveD = tPos - sPos;
		var scrollMax = scrollS + scrollD;
		var scrollPerc = (scrollPos-scrollS)/(scrollD);
		var diff = sPos + (scrollPerc * moveD);
		
		if(scrollPos >= (scrollS + scrollD)){
			diff = tPos;
		}else if(scrollPos <= scrollS){
			diff = sPos;
		}
		//$('#main_header').html(diff);
		return Math.round(diff);
	}
	
	var candySign = false;
	var controls = false;
	//function to be called whenever the window is scrolled or resized
	function onScroll(){ 
		var pos = $window.scrollTop(); //position of the scrollbar
		//console.log(pos);
		//alert(pos);
		
		$sign_candy.css({left: getPos(-430, -550, 100, 400, pos)});
		$sign_wood.css({left: getPos(-360, -480, 100, 400, pos), top: getPos(-28, -150, 100, 200, pos)});
		$sign_sharing.css({left: getPos(-330, -450, 100, 400, pos), top: getPos(-40, -155, 100, 200, pos)});
		
		$enter_sf.css({top: getPos(60, -960, 0, 2000, pos)});
		
		$header.css({top:getPos(0, -400, 1800, 700, pos)});
		$sign.css({top:getPos(70, -470, 1800, 300, pos)});		
		
		if(pos >= 1200){
			if(!lightsStart){
				lightsTimer = setTimeout(lightsSeq1, 500);
				lightsStart = true;
			}
		}else if(pos <= 1200){
			if(lightsStart){
				clearTimeout(lightsTimer);
				lightsStart = false;
			}
		}
		
		if(pos >= 1500){
			if(!candySign){
				candySign = true;
				$sign_candy_title.stop().animate({top:200}, function(){
					$sign_candy_info.stop().animate({top:10});
				});
			}
		}else if(pos <= 1500){
			if(candySign){
				candySign = false;
				$sign_candy_info.stop().animate({top:200}, function(){
					$sign_candy_title.stop().animate({top:0});
				});
			}
		}
		
		if(pos < 1750){
			$sf_left.css({position: "fixed", top:getPos(-1100, 200, 1000, 700, pos)});	
			$sf_right.css({position: "fixed", top:getPos(-1100, 150, 1000, 700, pos)});
		}
		
		if(pos > 1800){
			$bg.css({position: "absolute", top:"1800px"});
		}else{
			$bg.css({position: "fixed", top:"0px"});
			$header.css({position: "fixed", top:"0px"});
			$sign.css({position: "fixed", top:"70px"});
		}
		
		if(pos >= 2000){
			if(!controls){
				controls = true;
				$controls.stop().animate({bottom:"10px"});
			}
		}else if(pos <= 2000){
			if(controls){
				controls = false;
				$controls.stop().animate({bottom:"-200px"});
			}
		}
	}
	$(window).scroll(function(){ //when the user is scrolling...
		onScroll();
	});
	
	
	/*###############################*/
	//      *** TREE LIGHTS! ***     //
	/*###############################*/
	var lightsStart = false;
	var lightsTimer;
	var lightsCurrSeq = null;
	var lightEven = true;
    var lightArray = ['white', 'red', 'green', 'blue', 'purple', 'yellow'];
	var seqSetup = false;
	var count = 0;
	var fuseCounter = 0;
	var lightsChange = false;
    
	var lightsSeq1 = function() {
		$('.light').removeClass('white red green blue purple yellow');
		$("#lights_seq").html("Flash");
		lightsCurrSeq = lightsSeq1;
		
		if(lightEven){
			$('.light.odd').addClass('white');
			$('.light.even').removeClass('white');
			lightEven = false;
		}else{
			$('.light.odd').removeClass('white');
			$('.light.even').addClass('white');
			lightEven = true;
		}
        
		lightsTimer = setTimeout(lightsSeq1, 500);
    };
	
	var lightsSeq2 = function() {
		$("#lights_seq").html("Super");
		lightsCurrSeq = lightsSeq2;
		
		$('.light').each(function(index){
			if(!seqSetup){
				if((index+1)%6 == 0){ count = 0; }else{ count++; }
				$(this).addClass(lightArray[count]);
			}
			if($(this).hasClass('white')){ $(this).removeClass('white').addClass('red');
			}else if($(this).hasClass('red')){ $(this).removeClass('red').addClass('green');
			}else if($(this).hasClass('green')){ $(this).removeClass('green').addClass('blue');
			}else if($(this).hasClass('blue')){ $(this).removeClass('blue').addClass('purple');
			}else if($(this).hasClass('purple')){ $(this).removeClass('purple').addClass('yellow');
			}else if($(this).hasClass('yellow')){ $(this).removeClass('yellow').addClass('white'); }			
		});
        		
		seqSetup = true;
		
		lightsTimer = setTimeout(lightsSeq2, 500);
    };
	
	var lightsSeq3 = function() {
		$("#lights_seq").html("Wow!");
		lightsCurrSeq = lightsSeq3;
		
		$('.light').each(function(index){
			$(this).removeClass('white red green blue purple yellow').addClass(lightArray[Math.floor(Math.random()*6)]);
		});
		
		lightsTimer = setTimeout(lightsSeq3, 200);
    };
	
	var lightsOff = function() {
		$("#lights_seq").html("Off");
		lightsCurrSeq = null;
		$('.light').removeClass('white red blue green purple yellow');
		seqSetup = false;
		count = 0;
        if(lightsChange){
		fuseCounter++;
		if(fuseCounter == 4){
			fuseCounter = 0;
			fuseBlown();
		}
        lightsChange = false;
        }
		clearTimeout(lightsTimer);
    };
	
	$("#control_lights").mouseenter(function(){
		$("ul#lightometer_options").animate({bottom:45});
		$("div#lightometer").animate({height:265});
	}).mouseleave(function(){
		$("ul#lightometer_options").animate({bottom:-200});
		$("div#lightometer").animate({height:65});
	});
	
	$("#option_off").click(function(){ lightsChange = true; lightsOff(); });
	$("#option_flash").click(function(){ lightsChange = true; lightsOff(); lightsSeq1(); });
	$("#option_super").click(function(){ lightsChange = true; lightsOff(); lightsSeq2(); });
	$("#option_wow").click(function(){ lightsChange = true; lightsOff(); lightsSeq3(); });
	
	
	/*#############################*/
	//      *** FUSE BLOWN ***     //
	/*#############################*/
	$("#main_warning").css({bottom:winH+200});
	
	function fuseBlown(){
		playPreAudio("boom");
		setTimeout(function(){
			$("#main_overlay").css({opacity:0});
			$("#main_overlay").show().animate({opacity:1});
			lightsOff();
			setTimeout(function(){
				$("#main_warning").animate({bottom: (winH/2)-100}, { duration: 1000, easing: "easeOutBounce"});
			}, 2000);
		}, 4000);
	}
	function fuseFixed(){      
        $("#main_warning").animate({bottom: winH+200}, { duration: 1000, easing: "easeOutQuad"});
		$("#main_overlay").animate({opacity:0}, function(){
			$(this).hide();
			$("#lever, #warning_switch").removeClass("on");
		});
		fuseCounter = 0;
	}
	$("#lever").click(function(){
		$("#lever, #warning_switch").addClass("on");
		sparkleIt();
		setTimeout(fuseFixed, 3000);
	});
	
	
	/*########################*/
	//      *** NUTS ***      //
	/*########################*/
	$("#nut1").mouseover(function(){ $(this).stop().animate({top: 860}, { duration: 1000, easing: "easeOutBounce"}); });
	$("#nut2").mouseover(function(){ $(this).stop().animate({top: 865}, { duration: 1000, easing: "easeOutBounce"}); });
	$("#nut3").mouseover(function(){ $(this).stop().animate({top: 600}, { duration: 500, easing: "easeOutBounce"}); });
	$("#nut4").mouseover(function(){ $(this).stop().animate({top: 960}, { duration: 1000, easing: "easeOutBounce"}); });
	$("#nut5").mouseover(function(){ $(this).stop().animate({top: 1310}, { duration: 1500, easing: "easeOutBounce"}); });
	$("#nut6").mouseover(function(){ $(this).stop().animate({top: 1105}, { duration: 600, easing: "easeOutBounce"}); });
	$("#nut7").mouseover(function(){ $(this).stop().animate({top: 990}, { duration: 500, easing: "easeOutBounce"}); });
	$("#nut8").mouseover(function(){ $(this).stop().animate({top: 1400}, { duration: 1000, easing: "easeOutBounce"}); });
	
	
	/*###############################*/
	//      *** CANDY CANES ***      //
	/*###############################*/
	$("li.candycane").click(function(){
		if($(this).hasClass('bite1')){
			playPreAudio("candy1");
			$(this).removeClass('bite1').addClass('bite2');
		}else if($(this).hasClass('bite2')){
			playPreAudio("candy2");
			$(this).removeClass('bite2').addClass('bite3');
		}else if($(this).hasClass('bite3')){
			playPreAudio("candy1");
			$(this).removeClass('bite3').addClass('bite4');
		}else if($(this).hasClass('bite4')){
			playPreAudio("candy3");
			$(this).hide();
			sparkleIt();
		}else{
			playPreAudio("candy1");
			$(this).addClass('bite1');
		}
	});
	
	/*####################################*/
	//      *** GINGER BREAD MEN ***      //
	/*####################################*/
	$("li.gbm").click(function () {
        playPreAudio("wee");
        if($.browser.msie){  
        var topPos = $(this).position().top;
        $(this).animate({top: topPos-30}, { duration: 500, easing: "easeInBounce"}).animate({top: topPos}, { duration: 300, easing: "easeOutBounce"});
        }else{
		var rotation = 720;
		$(this).animate({rotate: '-='+rotation+'deg'}, 300);
        }	
    });
	
	/*#########################*/
	//      *** BELLS ***      //
	/*#########################*/
	$("li.bell").click(function () {
        playPreAudio("bell");
		$(this).animate({rotate: '+=10deg'}, 100).animate({rotate: '-=10deg'}, 100).animate({rotate: '+=10deg'}, 100).animate({rotate: '-=10deg'}, 100);
	});	
	
	/*#############################*/
	//      *** STOCKINGS ***      //
	/*#############################*/
    $("#content_stocking").css({bottom:winH+200});
	var stockingEditor = false;
    var currentStocking, size, sizeInt, resizer, desiredWidth;
	
	$("li.stocking").click(function(){
		$("div#content_stocking").animate({bottom: (winH/2)-100}, { duration: 1000, easing: "easeOutBounce"});
		currentStocking = $(this);
        stockingEditor = true;
	});
	$("div#stocking_input input").keyup(function(){
		desiredWidth = currentStocking.find("span").width() - 10;
		resizer = $("#stocking_resizer");
		resizer.html($(this).val());
		
		sizeInt = setInterval(function(){
			size = parseInt(resizer.css("font-size"), 10);
			
			if(resizer.width() > desiredWidth){
				if(size < 10){ size = 10 }
				resizer.css("font-size", size - 1);
			}else if(resizer.width() < desiredWidth){
				if(size > 48){ size = 48 }
				resizer.css("font-size", size + 1);
			}
		}, 500);
		
		currentStocking.find("span").css("font-size", size).html($(this).val());
	});
	$("span#stocking_no").click(function(){
		clearInterval(sizeInt);
        stockingEditor = false;

		$("div#content_stocking").animate({bottom: winH+200}, { duration: 1000, easing: "easeOutQuad"});
	});
	$("span#stocking_yes").click(function(){
		clearInterval(sizeInt);    
        stockingEditor = false;
	
		$("div#content_stocking").animate({bottom: winH+200}, { duration: 1000, easing: "easeOutQuad"});
	});
	
	
	/*############################*/
	//      *** SOUND FX ***      //
	/*############################*/
	function playPreAudio(id) {
		if($("html").hasClass("audio")){
            if(!$.browser.msie){
			var oPreAudio = document.getElementById(id);
			//oPreAudio.pause();
			oPreAudio.play();
            }
		}
    }
	
	
	/*###############################*/
	//      *** LET IT SNOW! ***     //
	/*###############################*/
	//Start the snow default options you can also make it snow in certain elements, etc.
	var snowing = true;
	$("div#control_snow").css({opacity:0.6});
	$("div#control_snow").click(function(){
		if(snowing){
			$("#main").snowfall('clear');
			snowing = false;
			$("div#control_snow").animate({opacity:0.6});
			$("#snow_title").html("SNOW ON");
		}else{
			$("#main").snowfall({flakeCount : 250, minSize : 2, maxSize : 6, round : true});
			snowing = true;
			$("div#control_snow").animate({opacity:1});
			$("#snow_title").html("SNOW OFF");
		}
	});
	
	
	/*###############################*/
	//      *** ADD SPARKLES ***     //
	/*###############################*/
	//$("#sparkles").attr('width', winW).attr('height', winH).css({'width' : winW, 'height' : winH});
	
	function sparkleIt(){
		if(browserSafe){
			$("#sparkles").css({'z-index' : 1010});
			addSparkles(Math.random()*100+50|0, stage.mouseX, stage.mouseY,2);
			var testInt = setInterval(function(){
				//alert("BOOM!");
				$("#sparkles").css({'z-index' : 15});
				clearInterval(testInt);
			}, 1000);
		}
	}
	
	
	/*####################################*/
	//      *** BROWSER POLYFILLS ***     //
	/*####################################*/	
	// FIX PLACEHOLDER TEXT IN IE + OTHERS
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur().parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		}
	  })
	});
	
	
	/*###################################################*/
	//      *** ANY REQUESTED STORY? GET IT NOW! ***     //
	/*###################################################*/
	if(window.location.hash.length > 2) {
		var pageArray = [];
		$(".story-link").each(function(){
			pageArray.push($(this).attr("rel").replace('story_', ''));
			//console.log($(this).attr("rel").replace('story_', ''));
		});
		initialLoad = true;
		var story = window.location.hash.replace('#', '').replace(/\/$/, '').substr(1);
		
		if(story !== ""){
			//console.log("Result: " + $.inArray(story, pageArray));
			if($.inArray(story, pageArray) !== -1){
				$('html, body').animate({'scrollTop':1700}, 0);
				openViewer("story");
				var id = "#story_" + story + ".story, #share_story_" + story;
				var length = $("li[rel='story_" + story + "']").attr("data-length");
				$("#main_box_story").addClass("story_" + story + " " + length);
				$(id).show();
			}else{
				window.location.hash = "";
			}
		}
	}
	
});


/*######################################*/
//      *** CREATE THE SPARKLE! ***     //
/*######################################*/
// Based on and using the glorious EaselJS - http://easeljs.com/
var canvas;
var stage;

var imgSeq = new Image();		// The image for the sparkle animation
var bmpSeq;						// The animated sparkle template to clone
var fpsLabel;

function initSparkle(){
	// create a new stage and point it at our canvas:
	canvas = document.getElementById("sparkles");
	stage = new Stage(canvas);

	// load the sprite sheet image, and wait for it to complete before proceeding:
	imgSeq.onload = handleImageLoad;
	imgSeq.src = "sparkle_21x23.png";
}

function handleImageLoad(){
	// attach mouse handlers directly to the source canvas.
	// better than calling from canvas tag for cross browser compatibility:
	//canvas.onmousemove = moveCanvas;
	//canvas.onclick = clickCanvas;

	// this instance will be cloned as needed to create new sparkles.
	// note that we are using a simple SpriteSheet with no frameData.
	// by default, it will loop through all of the frames in the image.
	bmpSeq = new BitmapSequence(new SpriteSheet(imgSeq,21,23));
	bmpSeq.regX = bmpSeq.frameWidth/2|0;
	bmpSeq.regY = bmpSeq.frameHeight/2|0;

	// add a text object to output the current FPS:
	fpsLabel = new Text("-- fps","bold 14px Arial","#FFF");
	stage.addChild(fpsLabel);
	fpsLabel.x = -10;
	fpsLabel.y = -20;

	// start the tick and point it at the window so we can do some work before updating the stage:
	Ticker.setFPS(20);
	Ticker.addListener(window);
}

function tick(){
	// loop through all of the active sparkles on stage:
	var l = stage.getNumChildren();
	for (var i=l-1; i>0; i--) {
		var sparkle = stage.getChildAt(i);

		// apply gravity and friction
		sparkle.vY += 2;
		sparkle.vX *= 0.98;

		// update position, scale, and alpha:
		sparkle.x += sparkle.vX;
		sparkle.y += sparkle.vY;
		sparkle.scaleX = sparkle.scaleY = sparkle.scaleX+sparkle.vS;
		sparkle.alpha += sparkle.vA;

		//remove sparkles that are off screen or not invisble
		if (sparkle.alpha <= 0 || sparkle.y > canvas.height) {
			stage.removeChildAt(i);
		}
	}

	//Ticker.getMeasuredFPS();
	fpsLabel.text = Math.round(Ticker.getMeasuredFPS())+" fps";

	// draw the updates to stage
	stage.update();
}

//sparkle explosion
function clickCanvas(e) {
	
	addSparkles(Math.random()*200+100|0, stage.mouseX, stage.mouseY,2);
	var testInt = setInterval(function(){
		//alert("BOOM!");
		clearInterval(testInt);
	}, 1000);
	e.preventDefault();
}

//sparkle trail
function moveCanvas(e) {
	addSparkles(Math.random()*0.5+0.75|0, stage.mouseX, stage.mouseY,1);
}

function addSparkles(count, x, y, speed) {
	//create the specified number of sparkles
	for (var i=0; i<count; i++) {
		// clone the original sparkle, so we don't need to set shared properties:
		var sparkle = bmpSeq.clone();

		// set display properties:
		sparkle.x = x;
		sparkle.y = y;
		sparkle.rotation = Math.random()*360;
		sparkle.alpha = Math.random()*0.5+0.5;
		sparkle.scaleX = sparkle.scaleY = Math.random()+0.3;

		// set up velocities:
		var a = Math.PI*2*Math.random();
		var v = (Math.random()-0.5)*30*speed;
		sparkle.vX = Math.cos(a)*v;
		sparkle.vY = Math.sin(a)*v;
		sparkle.vS = (Math.random()-0.5)*0.2; // scale
		sparkle.vA = -Math.random()*0.05-0.01; // alpha

		// start the animation on a random frame:
		sparkle.currentFrame = Math.random()*12|0;

		// add to the display list:
		stage.addChild(sparkle);
	}
}


/*###################################*/
//      *** EMAIL VALIDATION ***     //
/*###################################*/
function validateEmail(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}