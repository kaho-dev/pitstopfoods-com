<?php get_header() ?>

<?php

    $cat_id = get_queried_object_id();

    $paged = (get_query_var( 'page' )) ? get_query_var( 'page' ) : 1;
    
    $args = array(
        'post_type' => 'recipes',
        'posts_per_page' => 9,
        'cat' => $cat_id,
        'paged' => $paged,
        'order' => 'ASC',
        'orderby' => 'title',
    );
    $query = new WP_Query( $args );
    $description = get_the_archive_description();

    $cats = get_recipe_categories();
?>


<div class="container">

<div class="row mt-3 d-flex justify-content-center">

    <div class="col-9 mb-4">
        <h1 class="text-center"><?php single_cat_title(); ?></h1>
    </div>

    <p class="mt-3 mb-3"><?php echo wp_kses_post( wpautop( $description ) ); ?></p>
    
</div>

<div class="row">
        <div class="col-12 col-md-3">

            <div class="mb-5">
                <h2 class="text-center">Categories</h2>
                <ul class="list-group recipes__category-list">
                    <a href="/recipes/" class="list-group-item list-group-item-action" >All</a>

                    <?php get_category_links_sidebar($cats) ?>

                </ul>
            </div>

        </div>

        <div class="col-12 col-md-9">

            <div class="row mt-2 mb-4 d-flex justify-content-center">
                <?php if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
                    <div class="col-4 p-2">
                        <div class="category__recipe-card">
                            <a href="<?php the_permalink() ?>">
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ) ); ?>
                                <div class="category__container-image">
                                    <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                                </div>
                                <div class="category__card-text pt-3">
                                <h3><?php the_title() ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php endwhile; ?>

                    <div class="pagination__links">
                        <ul class="pagination">
                        <?php echo create_pagination_links($query) ?>
                        </ul>
                    </div>

                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>

        </div>

    </div>

</div>


<?php
?>


<?php get_footer(); ?>