// PNG Fallback for SVG
$(document).ready(function() {
	if(!Modernizr.svg) {
    	$('img[src*="svg"]').attr('src', function() {
        	return $(this).attr('src').replace('.svg', '.png');
		});
	}
	var now = new Date();
	var year = now.getFullYear()+1;
	$('#thisyear').html(year);
});

// Legal notice
$(function() {
	$(".link_legal-notice").click(function() {
		$("#legal-notice-wrapper").slideToggle();
		$("html, body").animate({
			scrollTop: $("#legal-notice-wrapper").offset().top
		}, 1000);
		return false;
	});
	
	$("#legal-notice-wrapper .btn-close").click(function() {
		$("#legal-notice-wrapper").slideUp();
		return false;
	});
});

// Effects
$(document).ready(function() {
	$('.action--legal').on("click", function(e) {
		e.preventDefault();
		
		$('.legal-notice').slideToggle(400);
		$(document).scrollTo( $(this), 400 );
		
		return false;
	});
});

//Lightning
//First day
$(document).ready(function() {
	var currentDate = new Date();
	
	$('.firstday').countEverest({
		day: 14,
	    month: 12,
	    year: 2014,
	    hour: 3,
	    minute: 31,
	    second: 18,
	    countUp: true
		// day: currentDate.getDate(),
	    // month: currentDate.getMonth() + 1,
	    // year: currentDate.getFullYear(),
	    // hour: currentDate.getHours(),
	    // minute: currentDate.getMinutes(),
	    // second: currentDate.getSeconds(),
	});
	
	//Fallback for Internet Explorer
	if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
		$('html').addClass('ce-ie');
	}
});
//I Do
$(document).ready(function() {
	var now = new Date();
	
	$('.ido').countEverest({
		hours: 15,
		minutes: 31,
		seconds: 18,
		day: 18,
	    month: 7,
	    year: 2015,
	    countUp: true
	});
	
	//Fallback for Internet Explorer
	if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
		$('html').addClass('ce-ie');
	}
});
//Promises day
$(document).ready(function() {
	var now = new Date();
	
	$('.promises').countEverest({
		day: 11,
	    month: 1,
	    year: now.getFullYear()+1,
	    countUp: false
	});
	
	//Fallback for Internet Explorer
	if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
		$('html').addClass('ce-ie');
	}
});



//Xmas
$(document).ready(function() {
	var now = new Date();
	
	$('.example--xmas .ce-countdown').countEverest({
		day: 25,
		month: 12,
		year: now.getFullYear(),
		onComplete: function() {
			$('.ce-duration').hide();
			$('.ce-oncomplete').addClass('shake');
		}
	});
	
	$('.complete-xmas').click(function () {
		$('.ce-duration').toggle();
		$('.ce-oncomplete').toggleClass('shake');
		return false;
	});
});

//Vertical Flip
$(document).ready(function() {
	var $countdown = $('.example--vertical-flip .ce-countdown'),
	firstCalculation = true,
	now = new Date();
	
	$countdown.countEverest({
		day: now.getDate(),
		month: (now.getMonth()+3),
		year: now.getFullYear(),
		leftHandZeros: true,
		afterCalculation: function() {
			var plugin = this,
			units = {
				days: this.days,
				hours: this.hours,
				minutes: this.minutes,
				seconds: this.seconds
			},
			//max values per unit
			maxValues = {
				hours: '23',
				minutes: '59',
				seconds: '59'
			},
			actClass = 'active',
			befClass = 'before';
			
			//build necessary elements
			if (firstCalculation == true) {
				firstCalculation = false;
				
				//build necessary markup
				$countdown.find('.ce-unit-wrap div').each(function () {
					var $this = $(this),
					className = $this.attr('class'),
					value = units[className],
					sub = '',
					dig = '';
					
					//build markup per unit digit
					for(var x = 0; x < 10; x++) {
						sub += [
						'<div class="digits-inner">',
						'<div class="flip-wrap">',
						'<div class="up">',
						'<div class="shadow"></div>',
						'<div class="inn">' + x + '</div>',
						'</div>',
						'<div class="down">',
						'<div class="shadow"></div>',
						'<div class="inn">' + x + '</div>',
						'</div>',
						'</div>',
						'</div>'
						].join('');
					}
					
					//build markup for number
					for (var i = 0; i < value.length; i++) {
						dig += '<div class="digits">' + sub + '</div>';
					}
					$this.append(dig);
				});
			}
			
			//iterate through units
			$.each(units, function(unit) {
				var digitCount = $countdown.find('.' + unit + ' .digits').length,
				maxValueUnit = maxValues[unit],
				maxValueDigit,
				value = plugin.strPad(this, digitCount, '0');
				
				//iterate through digits of an unit
				for (var i = value.length - 1; i >= 0; i--) {
					var $digitsWrap = $countdown.find('.' + unit + ' .digits:eq(' + (i) + ')'),
					$digits = $digitsWrap.find('div.digits-inner');
					
					//use defined max value for digit or simply 9
					if (maxValueUnit) {
						maxValueDigit = (maxValueUnit[i] == 0) ? 9 : maxValueUnit[i];
						} else {
						maxValueDigit = 9;
					}
					
					//which numbers get the active and before class
					var activeIndex = parseInt(value[i]),
					beforeIndex = (activeIndex == maxValueDigit) ? 0 : activeIndex + 1;
					
					//check if value change is needed
					if ($digits.eq(beforeIndex).hasClass(actClass)) {
						$digits.parent().addClass('play');
					}
					
					//remove all classes
					$digits
					.removeClass(actClass)
					.removeClass(befClass);
					
					//set classes
					$digits.eq(activeIndex).addClass(actClass);
					$digits.eq(beforeIndex).addClass(befClass);
				}
			});
		}
	});
});

//Circle
$(document).ready(function() {
	now = new Date();
	
	$(".example--circle .ce-countdown").countEverest({
		day: (now.getDate()+2),
		month: (now.getMonth()+2),
		year: now.getFullYear(),
		leftHandZeros: false,
		onChange: function() {
			drawCircle(document.getElementById('ce-days'), this.days, 365);
			drawCircle(document.getElementById('ce-hours'), this.hours, 24);
			drawCircle(document.getElementById('ce-minutes'), this.minutes, 60);
			drawCircle(document.getElementById('ce-seconds'), this.seconds, 60);
		}
	});
	
	function deg(v) {
		return (Math.PI/180) * v - (Math.PI/2);
	}
	
	function drawCircle(canvas, value, max) {
		var	circle = canvas.getContext('2d');
		
		circle.clearRect(0, 0, canvas.width, canvas.height);
		circle.lineWidth = 4;
		
		circle.beginPath();
		circle.arc(
		canvas.width / 2, 
		canvas.height / 2, 
		canvas.width / 2 - circle.lineWidth, 
		deg(0), 
		deg(360 / max * (max - value)), 
		false);
		circle.strokeStyle = '#282828';
		circle.stroke();
		
		circle.beginPath();
		circle.arc(
		canvas.width / 2, 
		canvas.height / 2, 
		canvas.width / 2 - circle.lineWidth, 
		deg(0), 
		deg(360 / max * (max - value)), 
		true);
		circle.strokeStyle = '#117d8b';
		circle.stroke();
	}
});

//Lovely
$(document).ready(function() {
	var $example = $(".example--lovely"),
	now = new Date(),
	then = new Date(now.getTime() + (14 * 24*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear()
	});
});

//Modern
$(document).ready(function() {
	var $example = $(".example--modern"),
	$ceHours = $example.find('.ce-hours'),
	$ceMinutes = $example.find('.ce-minutes'),
	$ceSeconds = $example.find('.ce-seconds'),
	now = new Date(),
	then = new Date(now.getTime() + (23.5*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		second: (then.getSeconds() + 30),
		minute: then.getMinutes(),
		hour: then.getHours(),
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear(),
		onChange: function() {
			countEverestAnimate( $(".ce-countdown").find('.ce-digits span') );
		}
	});
	
	function countEverestAnimate($el) {
		$el.each( function(index) {
			var $this = $(this),
			fieldText = $this.text(),
			fieldData = $this.attr('data-value'),
			fieldOld = $this.attr('data-old');
			
			if (typeof fieldOld === 'undefined') {
				$this.attr('data-old', fieldText);
			}
			
			if (fieldText != fieldData) {
				
				$this
				.attr('data-value', fieldText)
				.attr('data-old', fieldData)
				.addClass('ce-animate');
				
				window.setTimeout(function() {
					$this
					.removeClass('ce-animate')
					.attr('data-old', fieldText);
				}, 300);
			}
		});
	}
});

//Horizontal Flip
$(document).ready(function() {
	var now = new Date(),
	$example = $(".example--horizontal-flip"),
	$ceHours = $example.find('.ce-hours'),
	$ceMinutes = $example.find('.ce-minutes'),
	$ceSeconds = $example.find('.ce-seconds');
	
	$example.find(".ce-countdown").countEverest({
		day: (now.getDate()+1),
		month: (now.getMonth()+1),
		year: now.getFullYear(),
		hoursWrapper: '.ce-hours .ce-flip-back',
		minutesWrapper: '.ce-minutes .ce-flip-back',
		secondsWrapper: '.ce-seconds .ce-flip-back',
		wrapDigits: false,
		onChange: function() {
			countEverestAnimate($('.ce-countdown .ce-col>div'), this);
		}
	});
	
	function countEverestAnimate($el, data) {
		$el.each( function(index) {
			var $this = $(this),
			$flipFront = $this.find('.ce-flip-front'),
			$flipBack = $this.find('.ce-flip-back'),
			field = $flipBack.text(),
			fieldOld = $this.attr('data-old');
			if (typeof fieldOld === 'undefined') {
				$this.attr('data-old', field);
			}
			if (field != fieldOld) {
				$this.addClass('ce-animate');
				window.setTimeout(function() {
					$flipFront.text(field);
					$this
					.removeClass('ce-animate')
					.attr('data-old', field);
				}, 800);
			}
		});
	}
	
	//Fallback for Internet Explorer
	if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
		$('html').addClass('internet-explorer');
	}
});

//Marker
$(document).ready(function() {
	var $example = $(".example--marker"),
	$ceHours = $example.find('.ce-hours'),
	$ceMinutes = $example.find('.ce-minutes'),
	now = new Date(),
	then = new Date(now.getTime() + (10.4*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		second: (then.getSeconds() + 30),
		minute: then.getMinutes(),
		hour: then.getHours(),
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear(),
		wrapDigits: false
	});
});

//Girlie
$(document).ready(function() {
	var $example = $(".example--girlie"),
	now = new Date(),
	then = new Date(now.getTime() + (14 * 24*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear()
	});
});

//Night
$(document).ready(function() {
	var $example = $(".example--night"),
	$ceMinutes = $example.find('.ce-minutes'),
	$ceSeconds = $example.find('.ce-seconds'),
	now = new Date(),
	then = new Date(now.getTime() + (23.5*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		second: (then.getSeconds() + 30),
		minute: then.getMinutes(),
		hour: then.getHours(),
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear()
	});
});

//Bars
$(document).ready(function() {
	var $example = $(".example--bars"),
	$ceDays = $example.find('.ce-days'),
	$ceHours = $example.find('.ce-hours'),
	$ceMinutes = $example.find('.ce-minutes'),
	$ceSeconds = $example.find('.ce-seconds'),
	$daysFill = $('.ce-bar-days').find('.ce-fill'),
	$hoursFill = $('.ce-bar-hours').find('.ce-fill'),
	$minutesFill = $('.ce-bar-minutes').find('.ce-fill'),
	$secondsFill = $('.ce-bar-seconds').find('.ce-fill'),
	now = new Date(),
	then = new Date(now.getTime() + (14 * 24*60*60*1000));
	
	$example.find(".ce-countdown").countEverest({
		day: then.getDate(),
		month: (then.getMonth()+1),
		year: then.getFullYear(),
		onChange: function() {
			setBar($daysFill, this.days, 365);
			setBar($hoursFill, this.hours, 24);
			setBar($minutesFill, this.minutes, 60);
			setBar($secondsFill, this.seconds, 60);
		}
	});
	
	function setBar($el, value, max) {
		barWidth = 100 -(100/max * value);
		$el.width( barWidth + '%' );
	}
});

//Basic example
$(document).ready(function() {
	var now = new Date();
	
	$(".example--basic .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+2),
		month: (now.getMonth()+1),
		year: now.getFullYear()
	});
});

//Example with days only
$(document).ready(function() {
	var now = new Date();
	
	$(".example--days .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+11),
		month: (now.getMonth()+1),
		year: now.getFullYear()
	});
});

//Example with deciseconds
$(document).ready(function() {
	var now = new Date();
	
	$(".example--deciseconds .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+2),
		month: (now.getMonth()+1),
		year: now.getFullYear()
	});
});

//Example with singular unit labels
$(document).ready(function() {
	var now = new Date();
	
	$(".example--singularlabels .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+2),
		month: (now.getMonth()+1),
		year: now.getFullYear(),
		singularLabels: true
	});
});

//Example without singular unit labels
$(document).ready(function() {
	var now = new Date();
	
	$(".example--plurallabels .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+2),
		month: (now.getMonth()+1),
		year: now.getFullYear()
	});
});

//Example with translated units
$(document).ready(function() {
	var now = new Date();
	
	$(".example--translated .ce-countdown").countEverest({
		second: now.getSeconds(),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: (now.getDate()+2),
		month: (now.getMonth()+1),
		year: now.getFullYear(),
		daysLabel: 'Tage',
		dayLabel: 'Tag',
		hoursLabel: 'Stunden',
		hourLabel: 'Stunde',
		minutesLabel: 'Minuten',
		minuteLabel: 'Minute',
		secondsLabel: 'Sekunden',
		secondLabel: 'Sekunde'
	});
});

//Target date is the current date plus 45 seconds
$(document).ready(function() {
	var now = new Date();
	
	$(".example--30seconds .ce-countdown").countEverest({
		second: (now.getSeconds() + 45),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: now.getDate(),
		month: (now.getMonth()+1),
		year: now.getFullYear()
	});
});

//Using the callback function onComplete
$(document).ready(function() {
	var now = new Date();
	
	$(".example--oncomplete .ce-countdown").countEverest({
		second: (now.getSeconds() + 30),
		minute: now.getMinutes(),
		hour: now.getHours(),
		day: now.getDate(),
		month: (now.getMonth()+1),
		year: now.getFullYear(),
		onComplete: function() {
			$('.example--oncomplete .status').slideUp(400, function() {
				$(this).text('Complete.').addClass('status--complete');
			}).slideDown(400);
		}
	});
});

//Count up time since page load
$(document).ready(function() {
	var currentDate = new Date();
	
	$('.example--countup-pageload .ce-countdown').countEverest({
	    day: currentDate.getDate(),
	    month: currentDate.getMonth() + 1,
	    year: currentDate.getFullYear(),
	    hour: currentDate.getHours(),
	    minute: currentDate.getMinutes(),
	    second: currentDate.getSeconds(),
	    countUp: true
	});
});

//Count up with specific start date (01 January 15)
$(document).ready(function() {
	$('.example--countup-specific .ce-countdown').countEverest({
	    day: 1,
	    month: 1,
	    year: 2015,
	    countUp: true
	});
});