<?php
// Pastikan SiteOrigin Widgets aktif
if (!class_exists('SiteOrigin_Widget')) return;

// Tambahkan folder modules kita sebelum SOWB membangun daftar widget
function dom_wpb_register_my_widget_folder( $folders ) {
    $folders[] = get_template_directory() . '/inc/widget/modules/';
    return $folders;
}
// Priority 5 agar dieksekusi lebih dahulu daripada default filter SOWB (yang biasanya priority 10).
add_filter( 'siteorigin_widgets_widget_folders', 'dom_wpb_register_my_widget_folder', 5 );

function register_custom_so_widgets() {
    $widget_files = glob(get_template_directory() . '/inc/widget/modules/*.php');
    foreach ($widget_files as $file) {
        require_once $file;
        // Membentuk nama class dari nama file hello-world.php  -> Hello_World_Widget
        $filename  = basename($file, '.php');
        $classname = str_replace('-', '_', ucwords($filename, '-')) . '_Widget';
        if (class_exists($classname)) {
            register_widget($classname);
        }
    }
}
add_action('widgets_init', 'register_custom_so_widgets');
