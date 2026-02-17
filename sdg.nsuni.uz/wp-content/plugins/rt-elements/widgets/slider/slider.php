<?php

/**
 * Logo widget class
 *
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined('ABSPATH') || die();
class Reactheme_Elementor_Slider_Widget  extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *   
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'rt-testimonial-slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('RT Testimonial Slider', 'rtelements');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }
    public function get_categories()
    {
        return ['pielements_category'];
    }
    public function get_keywords()
    {
        return ['slider'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            '_services_slider_s',
            [
                'label' => esc_html__('Slider Style', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rt_slider_style',
            [
                'label'   => esc_html__('Select Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'rtelements'),
                    'style2' => esc_html__('Style 2', 'rtelements'),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Slider Item', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'sub-name',
            [
                'label' => esc_html__('Sub Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('designation', 'rtelements'),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Testimonial Name', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('Name', 'rtelements'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,        
                'condition' => [
                    'rt_slider_style' => 'style1'
                ]
            ]
        );
        $repeater->add_control(
            'rating_title',
            [
                'label' => esc_html__('Rating TItle', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4.9 Out of 5 Star', 'plugin-name'),
                'placeholder' => esc_html__('Type your title here', 'plugin-name'),
                'label_block' => true,        
                'condition' => [
                    'rt_slider_style' => 'style1'
                ]
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'rtelements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('Description', 'rtelements'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'rating_unmber',
            [
                'label'   => esc_html__('Select Rating', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => esc_html__('1', 'rtelements'),
                    '1.5' => esc_html__('1.5', 'rtelements'),
                    '2' => esc_html__('2', 'rtelements'),
                    '2.5' => esc_html__('2.5', 'rtelements'),
                    '3' => esc_html__('3', 'rtelements'),
                    '3.5' => esc_html__('3.5', 'rtelements'),
                    '4' => esc_html__('4', 'rtelements'),
                    '4.5' => esc_html__('4.5', 'rtelements'),
                    '5' => esc_html__('5', 'rtelements'),
                ],
            ]
        );
        $repeater->add_control(
            'rating_text',
            [
                'label' => esc_html__('Rating Text', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('4.5 ( 112 Review)', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('rating text', 'rtelements'),
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );
        $this->add_control(
			'quote_icon',
			[
				'label' => esc_html__( 'Quote Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-left',
					'library' => 'fa-solid',
				],
			]
		);   
        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__('Wide Screen > 1399px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '4.5' => esc_html__('4.5 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__('Desktops > 1199px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Desktops > 991px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 768px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__('Slide To Scroll', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Item', 'rtelements'),
                    '2' => esc_html__('2 Item', 'rtelements'),
                    '3' => esc_html__('3 Item', 'rtelements'),
                    '4' => esc_html__('4 Item', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );
        $this->add_control(
            'rt_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'rsaddon'),
                    'fade' => esc_html__('Fade', 'rsaddon'),
                    'flip' => esc_html__('Flip', 'rsaddon'),
                    'cube' => esc_html__('Cube', 'rsaddon'),
                    'coverflow' => esc_html__('Coverflow', 'rsaddon'),
                    'creative' => esc_html__('Creative', 'rsaddon'),
                    'cards' => esc_html__('Cards', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__('Navigation Dots', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );
        $this->add_control(
            'slider_dots_color',
            [
                'label' => esc_html__('Navigation Dots Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_dots' => 'true',],
            ]
        );
        $this->add_control(
            'slider_dots_color_active',
            [
                'label' => esc_html__('Active Navigation Dots Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_dots' => 'true',],
            ]
        );
        $this->add_responsive_control(
            'dots-top-spacing',
            [
                'label' => esc_html__('Top Spacing', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination.testimonial' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_nav',
            [
                'label'   => esc_html__('Navigation Nav', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pcat_nav_text_bg',
            [
                'label' => esc_html__('Nav BG Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span' => 'background: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover',
            [
                'label' => esc_html__('Nav BG Hover Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_icon',
            [
                'label' => esc_html__('Nav BG Icon Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover_icon',
            [
                'label' => esc_html__('Nav BG Icon Hover Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_border_color',
            [
                'label' => esc_html__('Nav Border Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_hover_border_color',
            [
                'label' => esc_html__('Nav Hover Border Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swipper-navigation.testimonial span:hover' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__('Autoplay', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__('Autoplay Slide Speed', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '1000' => esc_html__('1 Seconds', 'rtelements'),
                    '2000' => esc_html__('2 Seconds', 'rtelements'),
                    '3000' => esc_html__('3 Seconds', 'rtelements'),
                    '4000' => esc_html__('4 Seconds', 'rtelements'),
                    '5000' => esc_html__('5 Seconds', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__('Autoplay Interval', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '5000' => esc_html__('5 Seconds', 'rtelements'),
                    '4000' => esc_html__('4 Seconds', 'rtelements'),
                    '3000' => esc_html__('3 Seconds', 'rtelements'),
                    '2000' => esc_html__('2 Seconds', 'rtelements'),
                    '1000' => esc_html__('1 Seconds', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]
        );
        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__('Stop On Interaction', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );
        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__('Stop on Hover', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__('Loop', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__('Center Mode', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );
        $this->add_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Gap', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'slider_item_styles',
            [
                'label' => esc_html__('Box', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .slider_item',
                'css' => [
                    'important' => true,
                ],
            ]
        );
        
        $this->add_responsive_control(
            'item_radius',
            [
                'label' => esc_html__('Border Radius', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__('Title', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
                'fields_options' => [
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} .title' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sub_title_style',
            [
                'label' => esc_html__('Subtitle', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Sub Title Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .designation' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .designation',
                'fields_options' => [
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} .designation' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                ],
            ]
        ); 
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'des__style',
            [
                'label' => esc_html__('Description', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'des__color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .des' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'des_typography',
                'selector' => '{{WRAPPER}} .des',
                'fields_options' => [
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} .des' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'des__padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'des__margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ratting_style',
            [
                'label' => esc_html__('Ratting', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,                         
                'condition' => [
                    'rt_slider_style' => ['style1','style2']
                ]
            ]
        );
        $this->add_control(
            'ratting_color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating ' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'rating_typography',
                'selector' => '{{WRAPPER}} .rating',
                'fields_options' => [
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} .rating' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
			'ratting-gap',
			[
				'label' => esc_html__( 'Middle Gap', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rating' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_responsive_control(
            'ratting_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__rating--star' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'ratting_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__rating--star' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'ratting_text_style',
            [
                'label' => esc_html__('Text', 'rtelements'),
                'type' => Controls_Manager::HEADING,               
                 'condition' => [
                    'rt_slider_style' => ['style2']
                ]
            ]
        );
        $this->add_control(
            'ratting_text_color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating-star .des ' => 'color: {{VALUE}} !important',
                ],
                'condition' => [
                    'rt_slider_style' => ['style2']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'rating_text_typography',
                'selector' => '{{WRAPPER}} .rating-star .des',
                'fields_options' => [
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} .rating-star .des' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                ],
                'condition' => [
                    'rt_slider_style' => ['style2']
                ]
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'img_style',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'img_radius',
            [
                'label' => esc_html__('Border Radius', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__author--img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
			'img-size',
			[
				'label' => esc_html__( 'With', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .rts__author--img img' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_control(
			'img-gap',
			[
				'label' => esc_html__( 'Right Gap', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts__single--testimonial--author--meta' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'img_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__author--img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__author--img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'quote_style',
            [
                'label' => esc_html__('Quote Icon', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'quote_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts__single--testimonial--quote svg path' => 'fill: {{VALUE}} !important;',
                    '{{WRAPPER}} .rts__single--testimonial--quote i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
			'quote_sizes',
			[
				'label' => esc_html__( 'Size', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts__single--testimonial--quote svg' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_responsive_control(
            'quote_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__single--testimonial--quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rts__single--testimonial--quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();
       
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $item_gap        = $settings['item_gap_custom']['size'];
        $item_gap        = !empty($item_gap) ? $item_gap : '30';
       
       
        $next_text       = !empty($next_text) ? $next_text : '';
        $unique          = rand(2012, 35120);
        $all_pcat = rselemetns_woocommerce_product_categories();
        if ($slider_autoplay == 'true') {
            $slider_autoplay = 'autoplay: { ';
            $slider_autoplay .= 'delay: ' . $interval;
            if ($pauseOnHover == 'true') {
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            } else {
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if ($pauseOnInter == 'true') {
                $slider_autoplay .= ', disableOnInteraction: true';
            } else {
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        } else {
            $slider_autoplay = 'autoplay: false';
        }

        $effect = $settings['rt_pslider_effect'];

        if ($effect == 'fade') {
            $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
        } elseif ($effect == 'cube') {
            $seffect = "effect: 'cube',";
        } elseif ($effect == 'flip') {
            $seffect = "effect: 'flip',";
        } elseif ($effect == 'coverflow') {
            $seffect = "effect: 'coverflow',";
        } elseif ($effect == 'creative') {
            $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
        } elseif ($effect == 'cards') {
            $seffect = "effect: 'cards',";
        } else {
            $seffect = '';
        }

        if (empty($settings['logo_list'])) {
            return;
        }
       
        ?>
        <div class="slider-inner-wrapper testimonial <?php echo esc_attr($settings['rt_slider_style']); ?>">
            <div class="swiper rt--slider slider-<?php echo esc_attr($settings['rt_slider_style']); ?> rt_slider-<?php echo esc_attr($unique); ?>">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($settings['logo_list'] as $index => $item) :
                        $imgId = $item['image']['id'];
                        if ($imgId) {
                            $image = wp_get_attachment_image_src($imgId, 'full')[0];
                            $IMGstyle = 'style="background-image: url( ' . $image . ' );"';
                        } else {
                            $IMGstyle = '';
                            $image = '';
                        }
                        $title        = !empty($item['name']) ? $item['name'] : '';
                        $sub_title    = !empty($item['sub-name']) ? $item['sub-name'] : '';
                        $description  = !empty($item['description']) ? $item['description'] : '';
                        $btn_text     = !empty($item['btn_text']) ? $item['btn_text'] : '';
                        $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';
                        $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';
                        //$img_gap = $item['img_margin'];

                        if ($settings['rt_slider_style'] == 'style1') {
                            require plugin_dir_path(__FILE__) . "/style1.php";
                        }elseif ($settings['rt_slider_style'] == 'style2') {
                            require plugin_dir_path(__FILE__) . "/style2.php";
                        } else {
                            require plugin_dir_path(__FILE__) . "/style1.php";
                        }
                    endforeach; ?>
                </div>
            </div>

            <?php
                if ($sliderDots == 'true') echo '<div class="swiper-pagination testimonial ' . esc_attr($settings['rt_slider_style']) . ' "></div>';      
            ?>
        </div>  
        <?php 
            if ($sliderNav == 'true') : ?>
                <div class="swipper-navigation testimonial <?php echo esc_attr($settings['rt_slider_style']); ?>">
                    <span class="prev rts-prev<?php echo esc_attr($unique); ?>"><i class="rt-arrow-left"></i></span>  
                    <span class="next rts-next<?php echo esc_attr($unique); ?>"><i class="rt-arrow-right"></i></span>                   
                </div>
                <?php  
            endif;
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                var swiper<?php echo esc_attr($unique); ?> = new Swiper(".rt_slider-<?php echo esc_attr($unique); ?>", {
                    slidesPerView: 1,
                    <?php echo $seffect; ?>
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    slidesPerGroup: 1,
                    loop: <?php echo esc_attr($infinite); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    spaceBetween: <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".rts-next<?php echo esc_attr($unique); ?>",
                        prevEl: ".rts-prev<?php echo esc_attr($unique); ?>",
                    },
                    breakpoints: {
                        <?php
                                echo (!empty($col_xs)) ?  '575: { slidesPerView: ' . $col_xs . ' },' : '';
                                echo (!empty($col_sm)) ?  '767: { slidesPerView: ' . $col_sm . ' },' : '';
                                echo (!empty($col_md)) ?  '991: { slidesPerView: ' . $col_md . ' },' : '';
                                echo (!empty($col_lg)) ?  '1199: { slidesPerView: ' . $col_lg . ' },' : '';
                                ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xl); ?>,
                            spaceBetween: <?php echo esc_attr($item_gap); ?>
                        }
                    }
                });
            });
        </script>
<?php
    }
}
