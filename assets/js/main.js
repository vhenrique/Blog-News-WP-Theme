$ = jQuery.noConflict();
$(document).ready(function(){

	// Fixed header 
	var stickyOffset = $('#site-header').offset().top;
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();

		if ( scroll > stickyOffset ) {
			$('#site-header').addClass('fixed');
		} else {
			$('#site-header').removeClass('fixed');
		}
	});

	/**
	 * Responsive menu
	 */
	$('.showMenu').click(function(){
		console.log('test');
		$('#main-menu > .hover-menu').toggleClass('active');
	});	


	// HOME
	$('.showShare').click(function(){
		$(this).next('.shareContent').addClass('active');
	});
	$('.closeShare').click(function(){
		$(this).parent('.shareContent').removeClass('active');
	});
});