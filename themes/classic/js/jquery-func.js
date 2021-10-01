$(document).ready(function() {
    
    $("a.slide-down").click(function () {
    	$('#contact .slide-area').slideToggle('fast');
   		$(this).toggleClass("active");	
    });
    
    $(".slider-carousel").jcarousel({
		scroll:1,
		wrap:"both",
		visible:1,
        itemFirstInCallback: mycarousel_itemFirstInCallback,
        initCallback: mycarousel_initCallback,
        start: 1
	});
	
});

function mycarousel_initCallback(carousel) {
	    carousel.container.next('.slider-navigation').find('a').bind('click', function() {
	        carousel.scroll($.jcarousel.intval($(this).text()));
	        return false;
	    });	        
};
	
function mycarousel_itemFirstInCallback(carousel, item, idx, state) {
	carousel.container.next('.slider-navigation').find('a').removeClass('active');
	carousel.container.next('.slider-navigation').find('a').eq(idx-1).addClass('active');


};