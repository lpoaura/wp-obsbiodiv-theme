/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
			
			if (to) {
				$( '#accueil-content .site-description' ).removeClass('cache');
			} else {
				$( '#accueil-content .site-description' ).addClass('cache');
			}
		} );
	} );
	wp.customize( 'titre_ligne1_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-title-ligne1' ).text( to );
			var test = $( '.site-title-ligne2' ).text();
			
			if (to) {
				$( '.site-title-ligne1' ).removeClass('cache');
				$( '#accueil-content .site-title' ).addClass('cache');
			} else if (test) {
				$( '.site-title-ligne1' ).addClass('cache');
				$( '#accueil-content .site-title' ).addClass('cache');
			} else {
				$( '.site-title-ligne1' ).addClass('cache');
				$( '#accueil-content .site-title' ).removeClass('cache');
			}
		} );
	} );
	wp.customize( 'titre_ligne2_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-title-ligne2' ).text( to );
			var test = $( '.site-title-ligne1' ).text();
			
			if (to) {
				$( '.site-title-ligne2' ).removeClass('cache');
				$( '#accueil-content .site-title' ).addClass('cache');
			} else if (test) {
				$( '.site-title-ligne2' ).addClass('cache');
				$( '#accueil-content .site-title' ).addClass('cache');
			} else {
				$( '.site-title-ligne2' ).addClass('cache');
				$( '#accueil-content .site-title' ).removeClass('cache');
			}
		} );
	} );
	
	
	wp.customize( 'footer_titre_1_setting', function( value ) {
		value.bind( function( to ) {
			$( '.footer-titre-1' ).text( to );
			
			if (to) {
				$( '.footer-titre-1' ).removeClass('cache');
			} else {
				$( '.footer-titre-1' ).addClass('cache');
			}
		} );
	} );
	
	wp.customize( 'footer_titre_form_setting', function( value ) {
		value.bind( function( to ) {
			$( '.footer-titre-2' ).text( to );
			
			if (to) {
				$( '.footer-titre-form' ).removeClass('cache');
			} else {
				$( '.footer-titre-form' ).addClass('cache');
			}
		} );
	} );
	
	// Header text color.
	wp.customize( 'nav_titre_color_setting', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
			
			console.log(to);
			$( 'a.site-title' ).css( {
				'color': to
			} );
		} );
	} );
} )( jQuery );
