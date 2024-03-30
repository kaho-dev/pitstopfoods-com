<?php get_header(); ?>

<div class="container pt-5 pb-5">
    <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

        <h1 class="text-left recipes__main-title" ><?php the_title(); ?></h1>

        <div class="row mt-5">
            <div class="col-12 col-md-12 d-flex justify-content-center">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' ); ?>
                <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
            </div>
        </div>

        <div class="row mt-5 mb-5">

            <div class="col-12 col-md-4 mb-3">
                <h3>Ingredients List</h3>
                <ol class="list-group list-group-numbered">
                <?php for ($i = 1; $i < 21; $i++) : ?>
                    <?php if ( get_field( "ingred_$i", get_the_id() ) ) : ?>
                        <li class="list-group-item">
                        <span><?php the_field("ingred_$i", get_the_id()); ?> </span><span><?php the_field("measure_$i", get_the_id()); ?></span>
                        </li>
                    <?php else : ?>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endfor; ?>
                </ol>
            </div>

            <div class="col-12 col-md-8">
                <h2>Instructions</h2>
                <p><?php the_content(); ?></p>
            </div>
        </div>

        <?php endwhile; else: ?>
            <p>sorry, no posts found</p>
    <?php endif; ?>

    <h2 class="mt-3 recipes__might-like">You might also like</h2>
    <?php related_recipes_widget() ?>

</div>
<?php get_footer(); ?>