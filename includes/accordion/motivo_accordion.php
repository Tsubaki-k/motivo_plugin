<?php

namespace motivo_accordion;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class motivo_accordion extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve list widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     */
    public function get_name()
    {
        return 'list';
    }

    /**
     * Get widget title.
     *
     * Retrieve list widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     */
    public function get_title()
    {
        return esc_html__( 'Listtt', 'elementor-list-widget' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve list widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     */
    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @return string Widget help URL.
     * @since 1.0.0
     * @access public
     */
    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the list widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     */
    public function get_categories()
    {
        return [ 'layout' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the list widget belongs to.
     *
     * @return array Widget keywords.
     * @since 1.0.0
     * @access public
     */
    public function get_keywords()
    {
        return [ 'list', 'lists', 'ordered', 'unordered' ];
    }

    /**
     * Register list widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'List Content', 'elementor-list-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'header',
            [
                'label'       => esc_html__( 'Header Title', 'elementor-list-widget' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'This is header', 'elementor-list-widget' ),
                'default'     => esc_html__( 'This is header', 'elementor-list-widget' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'image_origin',
            [
                'label' => esc_html__( 'Image Position', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Left', 'textdomain' ),
                    'right' => esc_html__( 'Right', 'textdomain' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        /* Start repeater */

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_text',
            [
                'label' => __('Accordion Text', 'your-text-domain'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'your-text-domain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label' => __('Accordion Content', 'your-text-domain'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Accordion Content goes here', 'your-text-domain'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'accordion_image',
            [
                'label' => __('Accordion Image', 'your-text-domain'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_svg',
            [
                'label' => __('Accordion SVG', 'your-text-domain'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Accordion SVG code', 'your-text-domain'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => __('Accordions', 'your-text-domain'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ accordion_text }}}',
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Render list widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $header_title = $settings['header'];
        $image_origin = $settings['image_origin'];

//        $this->add_render_attribute( 'list', 'class', 'elementor-list-widget' );
        ?>
        <div class="accordion-container">

            <div class="show-image   <?php echo $image_origin === 'left' ? 'order-1' : 'order-3'  ?> "></div>

            <div class="acc order-2">
                <!--                <h2> --><?php //$this->print_render_attribute_string( 'header' ); ?><!-- </h2>-->
                <h2> <?php echo $settings['header'] ?> </h2>

                <?php
                foreach ( $settings[ 'accordions' ] as $index => $item ) {
//                    $repeater_setting_key = $this->get_repeater_setting_key( 'text', 'list_items', $index );
//                    $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-list-widget-text' );
//                    $this->add_inline_editing_attributes( $repeater_setting_key );

                    $accordion_text = $item['accordion_text'];
                    $accordion_content = $item['accordion_content'];
                    $accordion_image = $item['accordion_image']['url']; // Use ['url'] to get the image URL
                    $accordion_svg = $item['accordion_svg'];
                    ?>

                    <div class="accordion-item">
                        <div class="image-container">
                            <img src="<?php echo $accordion_image; ?>"/>
                        </div>
                        <button class="accordion-button">
                            <?php echo $accordion_svg; ?>
                            <?php echo $accordion_text; ?>
                        </button>
                        <div class="panel">
                            <?php echo $accordion_content; ?>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>

        <?php
    }



}