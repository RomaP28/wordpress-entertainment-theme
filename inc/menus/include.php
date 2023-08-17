<?php
require_once get_template_directory().'/inc/menus/walkers.php';

function add_menus() {
    register_nav_menu('header-menu-left',__( 'Header Menu Left' ));
    register_nav_menu('header-menu-right',__( 'Header Menu Right' ));
    register_nav_menu('reservations',__( 'Reservations' ));
//    register_nav_menu('mobile-reservations',__( 'Mobile Reservations' ));
    register_nav_menu('footer-play',__( 'Footer Play' ));
    register_nav_menu('footer-party',__( 'Footer Party' ));
    register_nav_menu('footer-company',__( 'Footer Company' ));
    register_nav_menu('footer-help',__( 'Footer Help' ));
    register_nav_menu('footer-legal',__( 'Footer Legal' ));
    register_nav_menu('footer-mobile-menu',__( 'Footer Mobile Menu' ));

}
add_action( 'init', 'add_menus' );
