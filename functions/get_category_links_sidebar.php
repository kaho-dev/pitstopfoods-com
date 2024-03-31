<?php

/**
 *
 * Get all the category links for the sidebar
 * @param array
 * 
 */
function get_category_links_sidebar($categories): void {

    foreach($categories as $category) {

        if ($category == null);

        if ( $category->name === 'Uncategorized' ) continue;

        if ( $category->name === 'Food' ) continue;

        if ( $category->name === null  ) continue;

        echo '<a href="'. get_home_url() .'/'. strtolower( $category->name ) 
        .'" class="list-group-item list-group-item-action">'
        . $category->name .'</a>';
    }

}