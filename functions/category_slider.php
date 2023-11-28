<?php 

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
