<?php
/*
Widget Name: Hello World Widget
Description: Widget sederhana untuk menampilkan teks "Hello World".
Author: Nama Anda
*/
class Hello_World_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'hello-world-widget',
            __('Hello World Widget', 'dominus-vobiscum'),
            array(
                'description' => __('Widget sederhana untuk menampilkan teks "Hello World".', 'dominus-vobiscum'),
                'help' => 'https://example.com/help'
            ),
            array(), // Control options
            array(   // Form fields (opsional)
                'text' => array(
                    'type' => 'text',
                    'label' => __('Teks', 'dominus-vobiscum'),
                    'default' => 'Hello World!'
                )
            ),
            false // Tidak pakai file template terpisah
        );
        $this->initialize();
    }

    // Kita render HTML langsung di sini (bisa juga pakai file template .tpl atau .php)
    function get_html_content($instance, $args, $template_vars, $css_name) {
        ob_start();
        ?>
        <div class="hello-world-widget">
            <?php echo esc_html($instance['text']); ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

// PENTING: register ID dan nama class
siteorigin_widget_register('hello-world-widget', __FILE__, 'Hello_World_Widget');
