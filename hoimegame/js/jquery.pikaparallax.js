/*
* jquery.pikaparallax.js
* horizontal parralax scroll on object
* Version: 0.2
* Anthony Ly - http://anthonyly.com
*/
(function( $ ) {
  $.fn.pikaparallax = function(distance) {
  	var $this = $(this);
  	var obj = $this;
    var distance = distance;
	var objXDepart = obj.offset().left;
	var widthViewport = $(window).width();
	var lastScrollLeft = 0;
	var objXFin = objXDepart+widthViewport+distance;

	function isOnScreen(){
		if (
			obj.offset().left+obj.width()>lastScrollLeft 
			&& obj.offset().left<widthViewport+lastScrollLeft
			) {
			return true;
		}else{
			return false;
		}
	}

	$(window).scroll(function() {

	    var documentScrollLeft = $(document).scrollLeft();
	    

	    if (lastScrollLeft != documentScrollLeft) {
	    	if (isOnScreen()) {
	    		var newLeft = objXDepart + (lastScrollLeft/objXFin)*distance;
	    		obj.stop().animate({
	    			'left': newLeft
	    		},600,'linear')
	    	}
	        
	    }
	    lastScrollLeft = documentScrollLeft;
	});

  };
})( jQuery );
