<?php

/**
 * Plugin Name: Motivo Accordion
 * Plugin URI: https://motivo.one/
 * Description: An image synced accordion for motivo
 * Version: 1.1
 * Author: Tsubaki
 * Author URI: https://github.com/Tsubaki-k/motivo_plugin
 **/


// Prevent direct file access
if( !defined('ABSPATH') ) {
    exit;
}

/**
 * Register the custom Elementor widget
 *
 * @param \Elementor\Widgets_Manager $widgets_manager The Elementor widgets manager instance
 * @return void
 * @since 1.0.0
 */
function register_oembed_widget( $widgets_manager )
{
    // Include the custom widget class
    require_once plugin_dir_path(__FILE__) . 'includes/accordion/motivo_accordion.php';

    // Register the widget with Elementor
    $widgets_manager->register(new \motivo_accordion\motivo_accordion());
}

add_action('elementor/widgets/register', 'register_oembed_widget');

/**
 * Register and enqueue custom JavaScript for the accordion widget
 * *
 * * @return void
 * * @since 1.0.0
 */
function motivo_script_registering()
{
    wp_register_script('my-custom-widget-script', plugin_dir_url(__FILE__) . 'includes/accordion/script.js', [ 'jquery' ], // Dependencies (if any)
                       '1.0.0', true // Load in footer
    );

    wp_enqueue_script('my-custom-widget-script');
}

// Enqueue scripts in both frontend and editor modes for Elementor
add_action('elementor/frontend/after_register_scripts', 'motivo_script_registering');
add_action('elementor/frontend/after_enqueue_scripts', 'motivo_script_registering');
add_action('elementor/editor/after_register_scripts', 'motivo_script_registering');
add_action('elementor/editor/after_enqueue_scripts', 'motivo_script_registering');

/**
 * Register and enqueue custom styles for the accordion widget
 * *
 * * @return void
 * * @since 1.0.0
 */
function my_plugin_frontend_stylesheets()
{
    wp_register_style('accordion_style', plugins_url('includes/accordion/style.css', __FILE__));
    wp_enqueue_style('accordion_style');
}

// Enqueue styles for frontend display
add_action('elementor/frontend/after_enqueue_styles', 'my_plugin_frontend_stylesheets');
