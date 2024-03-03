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
        return esc_html__( 'Motivo Accordion', 'elementor-list-widget' );
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
        return 'eicon-toggle';
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
            'accordion_title',
            [
                'label'       => esc_html__( 'Accordion Title', 'elementor-list-widget' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( '', 'elementor-list-widget' ),
                'default'     => esc_html__( '', 'elementor-list-widget' ),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'image_origin',
            [
                'label'   => esc_html__( 'Image Position', 'motivo_title' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => esc_html__( 'Left', 'motivo_title' ),
                    'right' => esc_html__( 'Right', 'motivo_title' ),
                ],
            ]
        );


        $this->add_control(
            'color',
            [
                'label'     => esc_html__( 'Color Scheme', 'motivo_title' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   =>  '#6b6bff',
                'selectors' => [
                    '{{WRAPPER}} .motivo-accordion-container .accordion-button.active svg ' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .motivo-accordion-container .accordion-button:before'      => 'background: {{VALUE}}',
                ],
            ]
        );


        /* Start repeater */

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_text',
            [
                'label'       => __( 'Accordion Text', 'your-text-domain' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '', 'your-text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_svg',
            [
                'label'       => __( 'Accordion SVG', 'your-text-domain' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '', 'your-text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_image',
            [
                'label'       => __( 'Accordion Image', 'your-text-domain' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label'      => __( 'Accordion Content', 'your-text-domain' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( '', 'your-text-domain' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label'       => __( 'Accordions', 'your-text-domain' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
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
        $settings        = $this->get_settings_for_display();
        $accordion_title = $settings[ 'accordion_title' ];
        $image_origin    = $settings[ 'image_origin' ];

        ?>
        <div class="motivo-accordion-container">

            <div class="show-image   <?php echo $image_origin === 'left' ? 'order-1' : 'order-3' ?> "></div>

            <div class="acc order-2">

                <h2> <?php echo $accordion_title ?> </h2>

                <?php
                foreach ( $settings[ 'accordions' ] as $index => $item ) {
                    $accordion_text    = $item[ 'accordion_text' ];
                    $accordion_content = $item[ 'accordion_content' ];
                    $accordion_image   = $item[ 'accordion_image' ][ 'url' ]; // Use ['url'] to get the image URL
                    $accordion_svg     = $item[ 'accordion_svg' ];
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