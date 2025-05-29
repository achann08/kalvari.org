<?php 
/**
 * Dominus Vobiscum functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dominus Vobiscum
 */

// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
// Register Customizer
require_once get_template_directory() . '/inc/customizer.php';

function dominus_vobiscum_scripts(){
    wp_enqueue_script('dominus_vobiscum_enqueue_scripts', get_template_directory_uri() . '/build/index.js', array('jquery'), '1.0', true);
    wp_enqueue_style('dominus_vobiscum_enqueue_style', get_template_directory_uri() . '/build/style-index.css');
    if( !wp_script_is('jquery')){
		wp_enqueue_script('jquery');
	}

	wp_enqueue_style( 'dashicons' );
	 // Font Awesome dari CDNJS
    wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css', array(), '6.7.2', 'all');

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '4.6.2', true );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.6.2', 'all' );

}
add_action( 'wp_enqueue_scripts', 'dominus_vobiscum_scripts' );


function dominus_vobiscum_config(){
    register_nav_menus(
		array(
			'dominus_vobiscum_nav_menu' => 'Header Nav Menu'
		)
	);

	add_theme_support( 'custom-logo', array(
		'height' 		=> 160,
		'width'			=> 160,
		'flex_height'	=> true,
		'flex_width'	=> true
	));
}
add_action( 'after_setup_theme', 'dominus_vobiscum_config', 0 );


function dominus_vobiscum_sidebars(){
	register_sidebar(
		array(
			'name' 			=> 'Dominus Vobiscum Sidebar',
			'id'			=> 'dominus-vobiscum-sidebar',
			'description'	=> 'Drag and drop your widget here',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<p class="h4">',
			'after_title' 	=> '</p>'
		)
	);
	register_sidebar(
		array(
			'name'			=> 'Dominus Vobiscum Footer',
			'id' 			=> 'dominus-vobiscum-footer',
			'description' 	=> 'Drag and drop your widgets here',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s widget-wrapper col-12 col-md-2">', 
			'after_widget'	=> '</div>',
			'before_title'	=> '<p class="h5">',
			'after_title'	=> '</p>'
		)
	);
}
add_action('widgets_init', 'dominus_vobiscum_sidebars');


add_filter('nav_menu_link_attributes', function($atts, $item, $args, $depth){
	if(in_array('menu-item-has-children', $item->classes)){
		$args->before = '<div class="btn-group" style="flex-direction: row-reverse;">';
		$atts['class'] .= ' dropdown-toggle dropdown-toggle-split';
		$atts['data-toggle'] = 'dropdown';
		$atts['aria-haspopup'] = 'true';
		$atts['aria-expanded'] = 'false';
	}
	return $atts;
}, 10, 4);

add_filter('nav_menu_item_title', function($title, $item, $args, $depth){
	if(in_array('menu-item-has-children', $item->classes)){
		$title = '<span class="sr-only">' . esc_html__( 'Toggle Dropdown', 'your-text-domain' ) . '</span>';
		$title .= '<a href="' . esc_url( $item->url ) . '" class="nav-link">' . esc_html( $item->title ) . '</a>';
		$args->after = '</div>';
	}
	return $title;
}, 10, 4);