////////////////////////////////////////
// init
jQuery( function() {

	// Browser supports matchMedia
	if (window.matchMedia) {
		if (window.matchMedia("(min-width:600px)").matches) {
			// PC
			jQuery('body').removeClass('drawer-open');
		}
		else {
			// mobile
		}
		function matchFunc() {
			if (window.matchMedia("(min-width:600px)").matches) {
				// PC
				jQuery('body').removeClass('drawer-open');
			}
			else {
				// mobile
			}
		}
		window.matchMedia("(min-width:1000px)").addListener(matchFunc);
	};
	
	// close small menu
	jQuery("#menu-wrapper .close, .drawer-overlay").click(function () {
		jQuery("#small-menu").click();
		return false;
	});

	// back to pagetop
	var totop = jQuery( '#back-top' );
	totop.hide();
	jQuery( window ).scroll(function(){
		if( jQuery( this ).scrollTop() > 800 ) totop.fadeIn(); else totop.fadeOut();
	});
	totop.click( function () {
		jQuery( 'body, html' ).animate( { scrollTop: 0 }, 500 ); return false;
	});
});

////////////////////////////////////////
// Navigation for mobile
window.addEventListener('DOMContentLoaded', function (e) {

	var $toggle = document.getElementById('small-menu');

	$toggle.addEventListener('click', function (e) {
		jQuery("body").toggleClass("drawer-open");

		if (jQuery("body").hasClass('drawer-open')) {
			jQuery('#menu-wrapper').scrollTop(0);
		}
	});
});