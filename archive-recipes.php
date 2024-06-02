<?php 
get_header(); 

$cats = get_recipe_categories();

?>

<div class="container mt-3">
	
	<div class="pf__breadcrumbs"><?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); } ?></div>

    <div class="mt-3 mb-5 text-left">
        <h1 class="text-center">Recipes</h1>

        <p class="mt-5">Welcome to the <a href="/">Pit Stop Foods</a> Recipes page, your ultimate destination for culinary inspiration. Here, we celebrate the joy of cooking by offering a diverse collection of recipes that cater to different tastes and dietary preferences.</p>

        <p>Our recipes are more than just a list of ingredients and steps. They are a journey through the world of flavors, a testament to the transformative power of food, and a tribute to the cultures and traditions that have shaped our palates.</p>

        <p>From hearty main courses that will impress your dinner guests, to quick and easy snacks perfect for a busy weekday, our recipes cater to all occasions. Looking for a healthy salad to kickstart your wellness journey? Or perhaps a decadent dessert to satisfy your sweet tooth? You'll find it all here.</p>

        <p>We believe that everyone can cook, and our goal is to make the cooking process as enjoyable as the meal itself. That's why our recipes are easy to follow, with clear instructions and helpful tips. Whether you're a seasoned home cook or a beginner in the kitchen, our recipes will help you create delicious meals with confidence.</p>

        <p>But the Pitstop Foods Recipes page is more than just a recipe collection. It's a community of food lovers. We encourage you to share your cooking experiences, exchange ideas, and learn from each other. After all, the best meals are those shared with others.</p>

        <p>So go ahead, explore our recipes, ignite your culinary curiosity, and let's create delicious memories together. Happy cooking!</p>
    </div>

    <div class="row">
        <div class="col-12 col-md-3">

            <div class="mb-5">
                <h3 class="text-center">Categories</h3>
                <ul class="list-group category__category-list">
                    <a href="/recipes/" class="list-group-item list-group-item-action" >All</a>

                    <?php get_category_links_sidebar($cats) ?>
                

                </ul>
            </div>
        </div>

        <div class="col-12 col-md-9">

            <div class="row">

                <?php if ( have_posts() ): ?>

                    <?php while ( have_posts() ): the_post(); ?>
                        
                        <div class="col-12 col-md-4 p-2 gy-4">
                            <div class="category__recipe-container">
                                <a href="<?php the_permalink() ?>">
                                    <div class="category__recipe-card">
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ) ); ?>
                                        <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                                    </div>
                                    <div class="bg-light p-3">
                                    <h3><?php the_title() ?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                    
                        <div class="text-center mt-5 mb-3 category__pagination-links" >
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