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
    
    add_theme_support( 'post-thumbnails' );
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

// Hapus class admin-bar dari body
function remove_admin_bar_body_class($classes) {
    return array_diff($classes, array('admin-bar'));
}
add_filter('body_class', 'remove_admin_bar_body_class', 1000);

// Hapus style inline admin bar
function remove_admin_bar_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_bar_header');

function custom_breadcrumbs() {

    global $post;

    $separator  = ' » ';
    $home_label = 'Home';
    
    echo '<div class="breadcrumbs">';
    
    // Link Home
    echo '<a href="' . home_url() . '">' . $home_label . '</a>';
    
    // Jika bukan front page / blog home
    if ( ! is_front_page() && ! is_home() ) {
        echo $separator;
        
        if ( is_single() ) {
             // Handle single posts - add blog page
            $blog_page_id = get_option('page_for_posts');
            if ($blog_page_id) {
                echo '<a href="' . get_permalink($blog_page_id) . '">' . get_the_title($blog_page_id) . '</a>';
                echo $separator;
            }
            the_title(); // Current post title
            
        } elseif ( is_page() ) {
            global $post;
            
            // Tangani hirarki page
            $ancestors = get_post_ancestors( $post->ID );
            if ( ! empty( $ancestors ) ) {
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor_id ) {
                    echo '<a href="' . get_permalink( $ancestor_id ) . '">'
                         . get_the_title( $ancestor_id ) .
                         '</a>' . $separator;
                }
            }
            
            // Judul halaman saat ini
            echo get_the_title( $post->ID );
            
        } elseif ( is_category() ) {
            // Kategori
            single_cat_title();
            
        } elseif ( is_archive() ) {
            // Archive generic (tag, author, date, custom post type)
            echo get_the_archive_title();
            
        } elseif ( is_search() ) {
            // Hasil pencarian
            echo 'Hasil pencarian: "' . get_search_query() . '"';
            
        } elseif ( is_404() ) {
            // 404
            echo 'Halaman Tidak Ditemukan';
        }
        
    } else {
        // PERBAIKAN DI SINI: Handle khusus untuk homepage
        $postTitle = get_the_title(get_option('page_for_posts'));
        
        // Jika frontpage adalah halaman statis, gunakan judulnya
        if ( $postTitle ) {
            echo $separator . esc_html( $postTitle );
        } 
        // Jika tidak (blog traditional), gunakan nama situs
        else {
            echo $separator . get_bloginfo( 'name' );
        }
    }
    
    echo '</div>';
}


//functions ini untuk bug yang pagination ajaxnya berhenti di halaman 6
function dominus_vobiscum_posts_per_page( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', 1 );
    }
}
add_action( 'pre_get_posts', 'dominus_vobiscum_posts_per_page', 1 );

// Daftarkan folder widget tema
// functions.php

// 1. Daftarkan folder widget
function dominus_register_widget_folders($folders) {
    $folders[] = get_template_directory() . '/inc/widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'dominus_register_widget_folders');

// 2. Tambah tab Custom Widgets (prioritas tinggi)
add_filter('siteorigin_panels_widget_dialog_tabs', function($tabs) {
    $tabs[] = [
        'title'  => __('Custom Widgets', 'dominus-vobiscum'),
        'filter' => ['groups' => ['dominus-vobiscum']],
    ];
    return $tabs;
}, 5); // Prioritas 5 (lebih tinggi)

// 3. Pastikan widget terdaftar dengan grup yang benar
add_filter('siteorigin_panels_widgets', function($widgets) {
    // Tambahkan grup ke semua widget custom
    foreach($widgets as $class => $settings) {
        if(strpos($class, 'Hello_World') !== false) {
            $widgets[$class]['groups'] = ['dominus-vobiscum'];
            $widgets[$class]['icon'] = 'dashicons dashicons-smiley';
        }
    }
    return $widgets;
}, 20);