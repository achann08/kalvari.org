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


function dominus_vobiscum_scripts(){
    wp_enqueue_script('dominus_vobiscum_enqueue_scripts', get_template_directory_uri() . '/build/index.js', array('jquery'), '1.0', true);
    wp_enqueue_style('dominus_vobiscum_enqueue_style', get_template_directory_uri() . '/build/style-index.css');
    if( !wp_script_is('jquery')){
		wp_enqueue_script('jquery');
	}

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

}
add_action( 'after_setup_theme', 'dominus_vobiscum_config', 0 );