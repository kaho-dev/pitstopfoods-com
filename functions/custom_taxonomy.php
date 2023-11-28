<?php

function custom_taxonomy() {
    $labels = array(
        'name' => _x('Recipe Categories', 'taxonomy general name'),
        'singular_name' => _x('Recipe Category', 'taxonomy singular name'),
        'search_items' => __('Search Recipe Categories'),
        'all_items' => __('All Recipe Categories'),
        'parent_item' => __('Parent Recipe Category'),
        'parent_item_colon' => __('Parent Recipe Category:'),
        'edit_item' => __('Edit Recipe Category'),
        'update_item' => __('Update Recipe Category'),
        'add_new_item' => __('Add New Recipe Category'),
        'new_item_name' => __('New Recipe Category Name'),
        'menu_name' => __('Recipe Categories'),
    );

    $args = array(
        'hierarchical' => true,  // Set this to true for categories, false for tags
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'recipe-category'),  // Customize the URL slug
    );

    register_taxonomy('recipe_category', 'recipes', $args);
}

add_action('init', 'custom_taxonomy');
