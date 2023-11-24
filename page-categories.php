<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

<?php get_header(); ?>


<div class="container">

    <h1 class="text-center m-3">food Categories</h1>
    <p>Explore the World of Flavors!</p>
    <p>
        Welcome to our food recipes website, your gateway to a world of flavors and culinary delights. Dive into our food categories, 
        where you'll find a treasure trove of mouthwatering recipes to tantalize your taste buds. 
        From appetizers to desserts, we have something to satisfy every craving. 
    </p>
    <p>
        Discover the art of creating delicious soups, explore the vibrant world of vegetarian cuisine, or indulge in decadent desserts that will leave you craving for more.
        Our website is your ultimate guide to culinary exploration, offering a diverse range of recipes that will inspire your creativity in the kitchen. 
        Get ready to embark on a gastronomic adventure and let the flavors of our food categories take you on a delicious journey.
    </p>

    <div class="row">

        <h2>Beef Recipes</h2>
        
        <?php category_slider(36) ?>

    </div>

    <div class="row">

        <h2>Chicken Recipes</h2>

        <?php category_slider(37) ?>

    </div>

    <div class="row">

        <h2>Breakfast Recipes</h2>

        <?php category_slider(48) ?>

    </div>

</div>


<?php get_footer(); ?>