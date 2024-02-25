<?php


//
///**
// * Create a widget class and extend elementor widget class.
// */
//class Webkul_Elementor_Widget  extends Elementor\Widget_Base {
//
//    public function get_name() {
//        return 'widget_name';
//    }
//
//    public function get_title() {
//        return esc_html__( 'My Widget Name', 'textdomain' );
//    }
//
//    public function get_icon() {
//        return 'eicon-code';
//    }
//
//    public function get_custom_help_url() {
//        return 'https://go.elementor.com/widget-name';
//    }
//
//    public function get_categories() {
//        return [ 'general' ];
//    }
//
//    public function get_keywords() {
//        return [ 'keyword', 'keyword' ];
//    }
//    /**
//     * Show output
//     *
//     * @return void
//     */
//    public function render() {
//        echo '<p>';
//        echo "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ";
//        echo '</p>';
//    }
//}
//
//
//
///**
// * Register widget.
// */
//add_action( 'elementor/widgets/register', 'Register_custom_widget' );
//function Register_custom_widget( $widgets_manager ) {
//    include plugin_dir_path( __FILE__ ) . 'widget/class-Webkul-Elementor-widget.php';
//    $widgets_manager->register( new Webkul_Elementor_Widget() );
//}