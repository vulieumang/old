var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");


//main class
function App() {
    var _self   = this;
    
    this.oldPosition = 0;
    
    //views objects
    this.views  = {
        countdown:  $("#countdown"),
        clouds:     $("#clouds"),
        city:       $("#city"),
        city2:      $("#city2"),
        car:        $("#car"),
        form:       $("#form-newsletter")
    };
    
    //init function
    this.init = function() {
        
        //date to countdown
        date = new Date(2015, 0, 1),
        
        //init countdown
        this.views.countdown.countdown({
            timestamp	: date
        });
                
                
        this.views.form.validate();
        this.views.form.submit(this.subscribeSubmit);
                
        //animate background
        this.animate();      
    };
    
    this.animate = function() {
        //offset for clouds and cities
        var offset = 0;
        //offset for car
        var carOffset = parseInt(this.views.car.css('left'));
        
        //move clouds and cities
        window.setInterval(function(){
            _self.views.clouds.attr("style", "background-position: " + offset + "px 0px");
            _self.views.city.attr("style", "background-position: " + offset * 0.5 + "px 0px");
            _self.views.city2.attr("style", "background-position: " + offset * -1 + "px 0px");
            
            offset -= 1;
        }, 30);
        
        
        //first car animate
        var tmp = ($(document).width() - $(".center").width()) / 2;
        tmp += 215;
        _self.views.car.animate({
            left:  tmp  * -1
        }, 8000);
        
        //loop for car animate
        window.setInterval(function() {
            _self.views.car.removeAttr('style');
            _self.views.car.css('left', $(".center").width() + tmp);
            
            _self.views.car.animate({
                left:  tmp  * -1
            }, 8000);
        }, 8100);
        
    };
    
    
     //subscribe click
    this.subscribeSubmit = function() {
        
        //if form is valid
        if($(this).valid()) {
            //save email in newsletter file
            $.post("php/newsletter.php", {
                email:   $("input#email").val()
            }, function(data) {
                 //if everything is ok, close dialog and show message
                 if(data == "1") {
                     alert("Email saved. Thank you");
                 } else { //else show error
                    alert("Something goes wrong. Please try one more time.");
                 }
             });
        }
                 
        return false;
    };
}

$(document).ready(function(){
   //create and init app class
   window.app = new App();
   window.app.init();
});

}
/*
     FILE ARCHIVED ON 14:16:35 Jan 25, 2014 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 10:54:04 Dec 19, 2021.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  CDXLines.iter: 23.946 (3)
  LoadShardBlock: 106.312 (3)
  PetaboxLoader3.resolve: 147.354
  esindex: 0.011
  captures_list: 146.738
  PetaboxLoader3.datanode: 112.184 (4)
  cdx.remote: 0.099
  exclusion.robots: 0.144
  exclusion.robots.policy: 0.136
  load_resource: 170.749
*/