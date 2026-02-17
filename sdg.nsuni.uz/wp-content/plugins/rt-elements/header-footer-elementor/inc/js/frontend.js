( function( $ ) {
	function _handleSinglePageMenu( id, layout ) {
		$( '.elementor-element-' + id + ' ul.hfe-nav-menu li a' ).on(
			'click',
			function () {
				var $this = $( this );
				var link  = $this.attr( 'href' );
				var linkValue = '';
				if ( link.includes( '#' ) ) {
					var index     = link.indexOf( '#' );
					linkValue = link.slice( index + 1 );
				}
				if ( linkValue.length > 0 ) {
					if ( 'expandible' == layout ) {
						$( '.elementor-element-' + id + ' .hfe-nav-menu__toggle' ).trigger( "click" );
						if ($this.hasClass( 'hfe-sub-menu-item' )) {
							$( '.elementor-element-' + id + ' .hfe-menu-toggle' ).trigger( "click" );
						}
					} else {
						if ( window.matchMedia( '(max-width: 1024px)' ).matches && ( 'horizontal' == layout || 'vertical' == layout ) ) {
							$( '.elementor-element-' + id + ' .hfe-nav-menu__toggle' ).trigger( "click" );
							if ($this.hasClass( 'hfe-sub-menu-item' )) {
								$( '.elementor-element-' + id + ' .hfe-menu-toggle' ).trigger( "click" );
							}
						} else {
							if ($this.hasClass( 'hfe-sub-menu-item' )) {
								_closeMenu( id );
								$( '.elementor-element-' + id + ' .hfe-menu-toggle' ).trigger( "click" );
							}
							_closeMenu( id );
						}
					}
				}
			}
		);
	}
} )( jQuery );
