<?php

/**
 *
 * Get all the category links for the sidebar
 * @param array
 * @return void
 */
function get_category_links_sidebar($categories): void {

    foreach($categories as $category) {

        if ($category == null);

        if ( $category->name === 'Uncategorized' ) continue;

        if ( $category->name === 'Foods' ) continue;

        if ( $category->name === null  ) continue;

        $category_name = strtolower( $category->name );

        $category_name = str_replace( ' ', '-', $category_name );

        echo '<a href="'. get_home_url() .'/'. $category_name 
        .'" class="list-group-item list-group-item-action">'
        . $category->name .'</a>';
    }

}