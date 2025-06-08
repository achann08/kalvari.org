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

// Load custom widgets
// require get_template_directory() . '/inc/widget/custom-widget.php';

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


// 1) Buat halaman admin baru di bawah Appearance → Theme Settings
add_action( 'admin_menu', 'dominus_register_theme_settings_page' );
function dominus_register_theme_settings_page() {
    // Parameter: 
    //   - page_title: judul halaman di <title> dan header
    //   - menu_title: judul menu yang muncul di Appearance
    //   - capability: siapa yang boleh mengakses (biasanya 'edit_theme_options')
    //   - menu_slug: slug unik → dihasilkan URL: themes.php?page=dominus-vobiscum
    //   - function callback: fungsi yang akan menampilkan konten halaman
    add_theme_page(
        __('Dominus Vobiscum Settings','dominus-vobiscum'),
        __('Dominus Widgets','dominus-vobiscum'),
        'edit_theme_options',
        'dominus-vobiscum',
        'dominus_render_theme_settings_page'
    );
}

// 2) Daftarkan Setting dan Field di Settings API
add_action( 'admin_init', 'dominus_register_theme_settings' );
function dominus_register_theme_settings() {
    // Kita akan menyimpan semua opsi widget custom di satu option array:
    //   option name: dominus_widgets_options
    register_setting(
        'dominus_widgets_options_group', // group settings, akan digunakan di settings_fields()
        'dominus_widgets_options',       // nama option di DB (array)
        'dominus_sanitize_widgets_options' // callback sanitasi
    );

    // Tambahkan satu section—misal “Custom Widgets”
    add_settings_section(
        'dominus_widgets_section',          // ID section
        __('Custom Widget Settings','dominus-vobiscum'), // Judul section
        'dominus_widgets_section_callback', // Callback untuk menampilkan deskripsi section
        'dominus-vobiscum'                  // Slug halaman (sama dengan menu_slug di add_theme_page)
    );

    // Tambahkan field (checkbox) untuk Hello World Widget
    add_settings_field(
        'hello_world_widget_enabled',         // ID field
        __('Enable Hello World Widget','dominus-vobiscum'), // Label “Enable …”
        'dominus_render_hello_world_field',   // Callback untuk menampilkan field input
        'dominus-vobiscum',                   // Slug halaman (samples: 'dominus-vobiscum')
        'dominus_widgets_section',            // Slug section tempat field muncul
        array( 'label_for' => 'hello_world_widget_enabled' )
    );

    // Kalau Anda memiliki widget lain (misalnya My Carousel, My Features, dll),
    // cukup tambahkan add_settings_field() lain di bawah ini, dengan ID field unik.
    //
    // contoh:
    // add_settings_field(
    //   'my_carousel_widget_enabled',
    //   __('Enable My Carousel Widget','dominus-vobiscum'),
    //   'dominus_render_my_carousel_field',
    //   'dominus-vobiscum',
    //   'dominus_widgets_section',
    //   array( 'label_for' => 'my_carousel_widget_enabled' )
    // );
}

// 2.1) Callback sanitasi—cek nilai input apabila ada, simpan boolean saja
function dominus_sanitize_widgets_options( $input ) {
    $sanitized = array();

    // Periksa apakah checkbox hello_world_widget_enabled ada (value '1')
    $sanitized['hello_world_widget_enabled'] = isset( $input['hello_world_widget_enabled'] ) && $input['hello_world_widget_enabled'] ? '1' : '';

    // Jika ada widget lain, ambil juga di sini:
    // $sanitized['my_carousel_widget_enabled'] = isset( $input['my_carousel_widget_enabled'] ) && $input['my_carousel_widget_enabled'] ? '1' : '';

    return $sanitized;
}

// 2.2) Deskripsi di atas tiap field section (opsional)
function dominus_widgets_section_callback() {
    echo '<p>' . esc_html__( 'Di sini Anda bisa menentukan widget‐widget custom mana yang akan muncul di Page Builder SiteOrigin. Centang agar widget tampil; hilangkan centang untuk menyembunyikan widget.', 'dominus-vobiscum' ) . '</p>';
}

// 2.3) Render input checkbox untuk Hello World Widget
function dominus_render_hello_world_field() {
    // Ambil opsi yang sudah disimpan
    $opts = get_option( 'dominus_widgets_options', array() );
    ?>
    <label for="hello_world_widget_enabled">
        <!-- Checkbox bernilai “1” jika aktif -->
        <input
            type="checkbox"
            id="hello_world_widget_enabled"
            name="dominus_widgets_options[hello_world_widget_enabled]"
            value="1"
            <?php checked( isset( $opts['hello_world_widget_enabled'] ) && $opts['hello_world_widget_enabled'], '1' ); ?>
        />
        <?php esc_html_e( 'Yes, tampilkan Hello World Widget di Page Builder', 'dominus-vobiscum' ); ?>
    </label>
    <?php
}

// 3) Render lengkap halaman ‘Dominus Widgets’ di Appearance → Tema
function dominus_render_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Dominus Vobiscum Widgets Settings', 'dominus-vobiscum' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            // Tampilkan seluruh fields & sections yang sudah kita register
            settings_fields( 'dominus_widgets_options_group' );
            do_settings_sections( 'dominus-vobiscum' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}