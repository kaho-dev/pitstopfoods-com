<?php

if ( WP_ENV === 'local') {
    $directory = 'D:\Websites\htdocs\pitstopfoods\wp-content\themes\recipes\functions';
} else {
    $directory = get_stylesheet_directory_uri() . '/functions';
}

$entries = scandir( $directory );

foreach( $entries as $entry ) {
    if ($entry !== '.' && $entry !== '..') {
        $path = $directory . '/' . $entry;
        if ( is_file( $path ) ) {
            include_once $path;
        }
    }
}



function register_new_widgets( $widget_manager ) {

	require_once( __DIR__ . '/widgets/post-loop.php' );

	$widget_manager->register( new \Elementor_Post_Widget() );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );

