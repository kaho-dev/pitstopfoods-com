<?php
//function for testing
function dd($value){
	echo '<pre>';
	var_dump($value);
	echo '</pre>';
	die();
}

function add_bootstrap() {
	wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' );
}
add_action( 'wp_enqueue_scripts', 'add_bootstrap' );


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
}


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



function my_plugin_rest_route_for_post( $route, $post ) {
    if ( $post->post_type === 'recipes' ) {
        $route = '/wp/v2/recipes/' . $post->ID;
    }

    return $route;
}
add_filter( 'rest_route_for_post', 'my_plugin_rest_route_for_post', 10, 2 );


function create_pagination_links($wpquery) {

	$paged = (get_query_var( 'page' )) ? get_query_var( 'page' ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );
	$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

	$pagination_args = array(
		'base' =>  $pagenum_link,
		'format'    => '?page=%#%',
		'total'     => $wpquery->max_num_pages,
		'current'   => $paged,
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
	);

	return paginate_links($pagination_args);

}


function category_slider($cat) {

    $args = array(
        'post_type' => 'recipes',
        'posts_per_page' => 9,
        'order' => 'ASC',
        'orderby' => 'title',
        'cat' => $cat,
    );
    
    $query = new WP_Query( $args );
    ?>

    <div class="">
    <swiper-container slides-per-view="3" loop="true" navigation="true" pagination="true">
    <?php if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
        <swiper-slide>
        <div class="m-4 p-3">
            <a href="<?php the_permalink() ?>">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ) ); ?>
                <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                <div class="">
                <h3><?php the_title() ?></h3>
                </div>
            </a>
        </div>
        </swiper-slide>
        <?php endwhile; ?>

        <?php endif; ?>
        </swiper-container>
        <?php wp_reset_postdata(); ?>
    </div>
    <?php
}


function register_new_widgets( $widget_manager ) {

	require_once( __DIR__ . '/widgets/post-loop.php' );

	$widget_manager->register( new \Elementor_Post_Widget() );

}
add_action( 'elementor/widgets/register', 'register_new_widgets' );


function pagination($pages = '', $range = 4) {
    $showitems = ($range * 2)+1;
 
    global $paged;
    if(empty($paged)) $paged = 1;
 
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
 
    if(1 != $pages)
    {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
 
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}


/**
 *
 * Generate related recipes for the widget for the single-recipes page. 
 * 
 * @return void
 */
function related_recipes_widget() {

    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);
    $query_args = array( 

        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '4',
        'orderby' => 'rand'


     );

    $related_cats_post = new WP_Query( $query_args ); ?>
    <div class="container px-4">
        <div class="row">
            
            <?php if($related_cats_post->have_posts()):
                while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
                    
                    <div class="col-12 col-md-3">
                        <div class="recipes__related">
                            <a href="<?php the_permalink(); ?>">
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' ); ?>
                                <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                                <div class="bg-light p-4">
                                <h3><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php endwhile;

                // Restore original Post Data
                wp_reset_postdata();
            endif; ?>
            
        </div>
    </div>
<?php }


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
