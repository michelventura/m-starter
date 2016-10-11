jQuery( function( $ ) {
    'use strict';

    $( '.nav-primary' ).gamajoResponsiveAccessibleMenu(
        {
            l10n: starterMenuPrimaryL10n
        }
    );

    $( '.nav-footer' ).gamajoResponsiveAccessibleMenu(
        {
            l10n: starterMenuFooterL10n,
            navSelector: '.nav-footer',
            mainMenuButtonClass: 'footer-menu-toggle'
        }
    );
} );
