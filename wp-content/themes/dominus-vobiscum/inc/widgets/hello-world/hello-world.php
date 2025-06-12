<?php
/*
Widget Name: Hello World Widget
Description: A simple hello world widget.
Author: Your Name
Author URI: http://yourdomain.com
*/

class Hello_World_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'hello-world-widget',
            __('Hello World Widget', 'dominus-vobiscum'),
            array(
                'description' => __('Displays a simple hello world message', 'dominus-vobiscum'),
                'help' => 'https://example.com'
            ),
            array(),
            array(
                'message' => array(
                    'type' => 'text',
                    'label' => __('Message', 'dominus-vobiscum'),
                    'default' => 'Hello, World!'
                ),
            ),
            get_template_directory() . '/inc/widgets/hello-world/tpl/'
        );
    }

    function get_template_name($instance) {
        return 'hello-world-template';
    }
    
    // Tentukan grup widget di sini
    function get_widget_form_groups() {
        return [
            'dominus-vobiscum' => [
                'name' => __('Custom Widgets', 'dominus-vobiscum'),
                'priority' => 5
            ]
        ];
    }
}

// Daftarkan widget
siteorigin_widget_register('hello-world-widget', __FILE__, 'Hello_World_Widget');