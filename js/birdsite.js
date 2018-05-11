////////////////////////////////////////
// init
jQuery( function() {

	jQuery( window ).load(function() {

		// set drawer navigation
		if ( window.matchMedia ) {
			// MediaQueryList
			var mq = window.matchMedia( '( max-width: 600px )' );
			var birdsiteNavigation = function ( mq ) {
				if ( mq.matches ) {
					jQuery( ".menu" ).addClass( 'drawer-nav' );
					jQuery('.drawer').drawer({
						class: {
							nav: 'drawer-nav',
							toggle: 'drawer-toggle',
							background: '#000'
						},
						scroll: {
							mouseWheel: true,
							preventDefault: false
						},
						showOverlay: true
					});
				}
				else {
					// cancel drawer navigation
					if( jQuery( '.drawer-nav' ).length ) {
						jQuery('.drawer').drawer('destroy');
						jQuery( ".menu" ).removeClass( 'drawer-nav' );
					}
				}
			};

			mq.addListener( birdsiteNavigation );
			birdsiteNavigation( mq );
		}
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
