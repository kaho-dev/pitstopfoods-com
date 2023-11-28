<?php

function my_plugin_rest_route_for_post( $route, $post ) {
    if ( $post->post_type === 'recipes' ) {
        $route = '/wp/v2/recipes/' . $post->ID;
    }

    return $route;
}
add_filter( 'rest_route_for_post', 'my_plugin_rest_route_for_post', 10, 2 );