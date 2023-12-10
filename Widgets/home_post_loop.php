<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Elementor Recipes Grid Widget.
 *
 * Elementor widget that creates a WP loop with the latest recipes posts
 *
 * @since 1.0.0
 */
class Elementor_Post_Widget extends \Elementor\Widget_base {

    public function get_name() {
        return 'post-loop';
    }

    public function get_title() {
        return esc_html__('post loop', 'post-loop');
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

    public function get_keywords() {
		return [ 'post-loop' ];
	}

    	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-post-loop' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'size',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Number of Slides', 'textdomain' ),
				'placeholder' => '4',
				'min' => 4,
				'max' => 16,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'recipes',
            'posts_per_page' => $settings['size'],
            'order' => 'ASC',
            'orderby' => 'date',
    
        );
        
        $query = new WP_Query( $args );
        ?>

        <div class="row g-3">
            <?php if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
                
                <div class="col-12 col-md-3">
                    <div class="bg-light home__recent-recipes">
                        <a href="<?php the_permalink() ?>">
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ) ); ?>
                            <img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                            <h3 class="p-3"><?php the_title() ?></h3>
                        </a>
                    </div>
                </div>    
    
                <?php endwhile; ?>
        
                <?php endif; ?>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php

	}

}