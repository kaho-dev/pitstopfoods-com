<?php
get_header();

function add_recipe_post() {

    $categories = [ 'Beef', 'Breakfast', 'Chicken', 'Dessert', 'Goat', 'Lamb', 'Miscellaneous', 'Pasta', 'Pork', 'Seafood', 'Side', 'Starter', 'Vegan', 'Vegetarian' ];

    $args = array(
        'headers' => array(
            'Content-type' => 'application/json',
        ),
        'sslverify' => true,
    );

    $recipeIdArray = [];

    foreach ($categories as $category) {
        $url = 'www.themealdb.com/api/json/v2/9973533/filter.php?c=' . $category;
        $content = wp_remote_get( esc_url_raw( $url ) );
        $body = wp_remote_retrieve_body( $content );

        $body = json_decode( $body );

        foreach($body as $c) {

            for($i = 0; $i < count($c); $i++) {
                $recipeId = $c[$i]->idMeal;
                array_push( $recipeIdArray, $recipeId );
            }

        }

    }

    return $recipeIdArray;
}

//$recipes = add_recipe_post();

function push_single_recipes_to_database( $recipeId ) {
    
    $url = 'www.themealdb.com/api/json/v2/9973533/lookup.php?i=' . $recipeId;
    $content = wp_remote_get( esc_url_raw( $url ) );
    $body = wp_remote_retrieve_body( $content );
    $body = json_decode( $body );



    foreach( $body as $c ) {
        for($i = 0; $i < count($c); $i++) {
            $strMeal = $c[$i]->strMeal;
            echo $strMeal;
            $strCategory = $c[$i]->strCategory;
            $cat_id = get_cat_ID( $strCategory );
            $strInstructions = $c[$i]->strInstructions;
            $strThumbnail = $c[$i]->strMealThumb;
            $strYoutube = $c[$i]->strYoutube;
            $ingredients1 = $c[$i]->strIngredient1;
            $ingredients2 = $c[$i]->strIngredient2;
            $ingredients3 = $c[$i]->strIngredient3;
            $ingredients4 = $c[$i]->strIngredient4;
            $ingredients5 = $c[$i]->strIngredient5;
            $ingredients6 = $c[$i]->strIngredient6;
            $ingredients7 = $c[$i]->strIngredient7;
            $ingredients8 = $c[$i]->strIngredient8;
            $ingredients9 = $c[$i]->strIngredient9;
            $ingredients10 = $c[$i]->strIngredient10;
            $ingredients11 = $c[$i]->strIngredient11;
            $ingredients12 = $c[$i]->strIngredient12;
            $ingredients13 = $c[$i]->strIngredient13;
            $ingredients14 = $c[$i]->strIngredient14;
            $ingredients15  = $c[$i]->strIngredient15;
            $ingredients16 = $c[$i]->strIngredient16;
            $ingredients17 = $c[$i]->strIngredient17;
            $ingredients18 = $c[$i]->strIngredient18;
            $ingredients19 = $c[$i]->strIngredient19;
            $ingredients20 = $c[$i]->strIngredient20;
            $measure1 = $c[$i]->strMeasure1;
            $measure2 = $c[$i]->strMeasure2;
            $measure3 = $c[$i]->strMeasure3;
            $measure4 = $c[$i]->strMeasure4;
            $measure5 = $c[$i]->strMeasure5;
            $measure6 = $c[$i]->strMeasure6;
            $measure7 = $c[$i]->strMeasure7;
            $measure8 = $c[$i]->strMeasure8;
            $measure9 = $c[$i]->strMeasure9;
            $measure10 = $c[$i]->strMeasure10;
            $measure11 = $c[$i]->strMeasure11;
            $measure12 = $c[$i]->strMeasure12;
            $measure13 = $c[$i]->strMeasure13;
            $measure14 = $c[$i]->strMeasure14;
            $measure15 = $c[$i]->strMeasure15;
            $measure16 = $c[$i]->strMeasure16;
            $measure17 = $c[$i]->strMeasure17;
            $measure18 = $c[$i]->strMeasure18;
            $measure19 = $c[$i]->strMeasure19;
            $measure20 = $c[$i]->strMeasure20;
            $strSource = $c[$i]->strSource;

            $test_args = array(
                'post_title' => $strMeal,
                'post_type' => 'recipes',
                'post_category' => array( $cat_id ),
                'post_content' => $strInstructions,
                'post_status' => 'publish',
                'meta_input' => array(
                    'ingred_1' => $ingredients1,
                    'ingred_2' => $ingredients2,
                    'ingred_3' => $ingredients3,
                    'ingred_4' => $ingredients4,
                    'ingred_5' => $ingredients5,
                    'ingred_6' => $ingredients6,
                    'ingred_7' => $ingredients7,
                    'ingred_8' => $ingredients8,
                    'ingred_9' => $ingredients9,
                    'ingred_10' => $ingredients10,
                    'ingred_11' => $ingredients11,
                    'ingred_12' => $ingredients12,
                    'ingred_13' => $ingredients13,
                    'ingred_14' => $ingredients14,
                    'ingred_15' => $ingredients15,
                    'ingred_16' => $ingredients16,
                    'ingred_17' => $ingredients17,
                    'ingred_18' => $ingredients18,
                    'ingred_19' => $ingredients19,
                    'ingred_20' => $ingredients20,
                    'measure_1' => $measure1,
                    'measure_2' => $measure2,
                    'measure_3' => $measure3,
                    'measure_4' => $measure4,
                    'measure_5' => $measure5,
                    'measure_6' => $measure6,
                    'measure_7' => $measure7,
                    'measure_8' => $measure8,
                    'measure_9' => $measure9,
                    'measure_10' => $measure10,
                    'measure_11' => $measure11,
                    'measure_12' => $measure12,
                    'measure_13' => $measure13,
                    'measure_14' => $measure14,
                    'measure_15' => $measure15,
                    'measure_16' => $measure16,
                    'measure_17' => $measure17,
                    'measure_18' => $measure18,
                    'measure_19' => $measure19,
                    'measure_20' => $measure20,
                ),
            );
            
            $post_id = wp_insert_post( $test_args );
            $image_id = media_sideload_image( $strThumbnail, $post_id, '', 'id' );
            update_post_meta($post_id, '_thumbnail_id', $image_id);
            echo $image_id;
        }
    }


}
//run this function when you want to update the recipes
// foreach ($recipes as $recipe) {
//     push_single_recipes_to_database( $recipe );
// }



// echo '<pre>';
// print_r(add_recipe_post());
// echo '</pre>';

get_footer();

?>

