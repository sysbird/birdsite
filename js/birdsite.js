////////////////////////////////////////
// init
jQuery( function() {

	// slide Navigation
	var birdsite_menu_width = jQuery( '#menu-wrapper' ).width();
	jQuery( '#small-menu' ).click(function(){
		var left = 0;
		if( jQuery( 'body' ).hasClass( 'open-menu' ) ){
			// colse Navigation
			left = '-' +  birdsite_menu_width + 'px';
		}
		else{
			// open Navigation
			jQuery( 'body' ).addClass( 'open-menu' );
		}

		jQuery('#menu-wrapper').animate(
			{ 'left' : left },
			300, function() {
				if(0 != left){
					// close Navigation
					jQuery( 'body' ).removeClass( 'open-menu' );
				}
		});
	});

 	jQuery(window).resize(function() {
		// close Navigation
		if( jQuery( 'body' ).hasClass( 'open-menu' ) ){
			jQuery( 'body' ).removeClass( 'open-menu' );
			jQuery('#menu-wrapper').css( { 'left': '-' +  birdsite_menu_width + 'px' } );
		}
 	});

	jQuery( '.overlay' ).click(function(){
		// close Navigation
		jQuery( '#small-menu' ).click();
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
