<?php

/**
 *
 * Get all the category links for the sidebar
 * @param array
 * 
 */
function get_category_links_sidebar($categories): void {

    for($i = 0; $i < (count($categories)); $i++) {

        if ($categories[$i] == null);

        if ( $categories[$i]->name === 'Uncategorized' ) continue;

        if ( $categories[$i]->name === 'Food' ) continue;

        if ( $categories[$i]->name === null  ) continue;

        echo '<a href="'. get_home_url() .'/'. strtolower( $categories[$i]->name ) 
        .'" class="list-group-item list-group-item-action">'
        . $categories[$i]->name .'</a>';

    }

}