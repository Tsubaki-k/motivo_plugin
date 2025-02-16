<?php

/**
 * Plugin Name: Motivo-core
 * Plugin URI: https://www.your-site.com/
 * Description: This is features for motivo
 * Version: 1.1
 * Author: Tsubaki
 * Author URI: https://t.me/Tsubakii_chan
 **/




if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


// Include the main plugin file

// Register our widget with Elementor
//add_action( 'elementor/widgets/widgets_registered', function() {
//    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \motivo_accordion\motivo_accordion() );
//} );



function register_oembed_widget( $widgets_manager ) {

    require_once( plugin_dir_path( __FILE__ ) . 'includes/accordion/motivo_accordion.php' );

    $widgets_manager->register( new \motivo_accordion\motivo_accordion() );

}
add_action( 'elementor/widgets/register', 'register_oembed_widget' );




//function my_plugin_frontend_scripts() {
//    wp_register_script( 'accordion_script', plugins_url( '', __FILE__ ), [], '1.0', true );
//    wp_enqueue_script( 'accordion_script' );
//}
//add_action( 'elementor/frontend/after_register_scripts', 'my_plugin_frontend_scripts' );

function motivo_script_registering( )
{
    wp_register_script(
        'my-custom-widget-script',
        plugin_dir_url(__FILE__) . 'includes/accordion/script.js',
        ['jquery'], // Dependencies (if any)
        '1.0.0',
        true // Load in footer
    );

    wp_enqueue_script('my-custom-widget-script');
}

add_action('elementor/frontend/after_register_scripts', 'motivo_script_registering');
add_action('elementor/frontend/after_enqueue_scripts', 'motivo_script_registering');
add_action('elementor/editor/after_register_scripts', 'motivo_script_registering');
add_action('elementor/editor/after_enqueue_scripts', 'motivo_script_registering');

function my_plugin_frontend_stylesheets() {
    wp_register_style( 'accordion_style', plugins_url( 'includes/accordion/style.css', __FILE__ ) );
    wp_enqueue_style( 'accordion_style' );
}
add_action( 'elementor/frontend/after_enqueue_styles', 'my_plugin_frontend_stylesheets' );
