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




function my_plugin_frontend_scripts() {
    wp_register_script( 'accordion_script', plugins_url( 'includes/accordion/script.js', __FILE__ ) );
    wp_enqueue_script( 'accordion_script' );
}
add_action( 'elementor/frontend/after_register_scripts', 'my_plugin_frontend_scripts' );


function my_plugin_frontend_stylesheets() {
    wp_register_style( 'accordion_style', plugins_url( 'includes/accordion/style.css', __FILE__ ) );
    wp_enqueue_style( 'accordion_style' );
}
add_action( 'elementor/frontend/after_enqueue_styles', 'my_plugin_frontend_stylesheets' );
