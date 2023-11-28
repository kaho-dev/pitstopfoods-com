<?php

function recipes_custom_post_type() {
	
	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'custom-fields',
		'comments',
	);
	
	$labels = array(
		'name' => __( 'Recipes', 'textdomain' ),
		'singular_name' => __('Recipe', 'textdomain'),
	);
	
	$args = array (
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'recipes' ),
		'taxonomies' => array( 'recipes', 'category' ),
		'query_var' => true,
		'exclude_from_search' => false,
        'show_in_rest' => true
	);
	
    register_post_type('recipes', $args );
}
add_action('init',  'recipes_custom_post_type');
