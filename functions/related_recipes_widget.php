<?php

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
        'posts_per_page'  => '8',
        'orderby' => 'rand'


     );

    $related_cats_post = new WP_Query( $query_args ); ?>
    <div class="container mt-3">
        <div class="row">
            
            <?php if($related_cats_post->have_posts()):
                while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
                    
                    <div class="col-12 col-md-3 mb-5">
                        <div class="recipes__related">
                            <a href="<?php the_permalink(); ?>">
                                <div class="recipes__related__img">
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' ); ?>
                                    <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                                </div>
                                <div class="recipes__related__text">
                                    <div class="pt-3">
                                        <h3><?php the_title(); ?></h3>
                                    </div>
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
<?php } ?>