<?php
function register_new_widgets( $widget_manager ) {

require_once( get_stylesheet_directory(). '/Widgets/home_post_loop.php' );

$widget_manager->register( new \Elementor_Post_Widget() );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );