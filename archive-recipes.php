<?php 
get_header(); 

$cats = get_recipe_categories();

?>

<div class="container">

    <div class="mt-3 mb-5 text-center">
        <h1>Recipes</h1>
        <p>This is some description about the recipes page that I will write at some point</p>
    </div>

    <div class="row">
        <div class="col-12 col-md-3">

            <div>
                <h3 class="text-center">Categories</h3>
                <ul class="list-group recipes__category-list">
                    <a href="http://pitstopfoods.test/recipes/" class="list-group-item list-group-item-action" >All</a>

                    <?php for($i = 0; $i < count($cats); $i++): ?>
                        <a href="<?php get_home_url() ?>/category/<?php echo $cats[$i]->name ?>" class="list-group-item list-group-item-action" ><?php echo $cats[$i]->name ?></a>
                    <?php endfor; ?>
                

                </ul>
            </div>
        </div>

        <div class="col-12 col-md-9">

            <div class="row">

                <?php if ( have_posts() ): ?>

                    <?php while ( have_posts() ): the_post(); ?>
                        
                        <div class="col-12 col-md-4 p-2 gy-4">
                            <div class="recipes__recipe-card">
                                <a href="<?php the_permalink() ?>">
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ) ); ?>
                                    <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                                    <div class="bg-light p-3">
                                    <h3><?php the_title() ?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                    
                        <div class="text-center mt-5 mb-3 recipes__pagination-links" >
                            <?php echo paginate_links(); ?>
                        </div>
                    <?php else: ?>

                        <?php _e( 'Sorry, no posts matched your criteria', 'textdomain' ) ?>

                <?php endif; ?>
            </div>  
        
        </div>

    </div>    

</div>

<?php get_footer(); ?>