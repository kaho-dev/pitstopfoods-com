<?php 

/**
 *
 * Return all the categories of the Recipes
 *
 * @return      array
 */
function get_recipe_categories(): array {

    $args = array(
        'post_type' => 'recipes',
        'orderby' => 'name',
        'order'   => 'ASC'
    );

    $cats = get_categories($args);

    return $cats;

}