<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;


defined('ABSPATH') || die();

class ReacTheme_Related_Post_Slider_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rt-relatd-post';
    }

    /**
     * Get widget title.
     *
     * Retrieve rsgallery widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Relatd Post', 'rtelements');
    }

    /**
     * Get widget icon.
     *
     * Retrieve rsgallery widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-slider-3';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the rsgallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['pielements_category'];
    }
    /**
     * Register rsgallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'portfolio_slider_style',
            [
                'label'   => esc_html__('Select Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => 'Style 1',
                ],
            ]
        );
        $this->add_control(
            'title_word_count',
            [
                'label' => esc_html__('Title Word Count', 'rtelements'),
                'type' => Controls_Manager::NUMBER,

            ]
        );
        $this->add_control(
            'per_page',
            [
                'label' => esc_html__('Portfolio Show Per Page', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('example 3', 'rtelements'),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );        
        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'rtelements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                    '2.4' => esc_html__('2.4 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '3.8' => esc_html__('3.8 Column', 'rsaddon'),
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
                    '2.4' => esc_html__('2.4 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '3.8' => esc_html__('3.8 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]

        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Laptop > 991px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '3.8' => esc_html__('3.8 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rtelements'),
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
            'slider_autoplay',
            ['label'   => esc_html__('Autoplay', 'rtelements'),
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

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Middle Gap', 'rtelements'),
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
            ]
        );

        $this->add_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__('Item Bottom Gap', 'rtelements'),
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
                    '{{WRAPPER}} .event_item' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'item_box_style',
			[
				'label' => esc_html__( 'Box', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .event_item' => 'background: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'item_hover_bgcolor',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                                            
                    '{{WRAPPER}} .event_item:hover' => 'background: {{VALUE}};',    
                    '{{WRAPPER}} .event_item:hover::after' => 'background: {{VALUE}};',                                       
                ],                
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .event_item',
			]
		);
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'related_post_section_title',
			[
				'label' => esc_html__( 'Section Tilte', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'related_title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .related_event_title' => 'color: {{VALUE}} !important;',                               
                ],                
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'related_title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .related_event_title',                    
			]
		);		
		$this->add_responsive_control(
			'related_title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .related_event_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'related_title_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .related_event_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .event-title' => 'color: {{VALUE}} !important;',     
                    '{{WRAPPER}} .event-title a' => 'color: {{VALUE}} !important;',                            
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                                    
                    '{{WRAPPER}} .event-title:hover a' => 'color: {{VALUE}} !important;',   
                    '{{WRAPPER}} .single-event:hover .single-event-content .event-title' => 'color: {{VALUE}} !important;',                                     
                ],                
            ]            
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .event-title',                    
			]
		);		
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .event-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_image_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_image_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__single--event--thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'event_meta_style',
			[
				'label' => esc_html__( 'Meta', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'date__style',
            [
                'label' => esc_html__( 'Date', 'rtelements' ),
                'type' => Controls_Manager::HEADING,         
            ]
        );
		$this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date span' => 'color: {{VALUE}};',                  
                    '{{WRAPPER}} .date svg path' => 'fill: {{VALUE}} !important;',                   
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .date span',                    
			]
		);		
		$this->add_responsive_control(
			'date_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'date_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
            'location__style',
            [
                'label' => esc_html__( 'Location', 'rtelements' ),
                'type' => Controls_Manager::HEADING,         
            ]
        );
		$this->add_control(
            'location_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .location span' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .location svg path' => 'fill: {{VALUE}} !important;',                   
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'location_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .location',                    
			]
		);		
		$this->add_responsive_control(
			'location_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'location_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_control(
            'time__style',
            [
                'label' => esc_html__( 'Time', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
		$this->add_control(
            'time_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .time span' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .time svg path' => 'fill: {{VALUE}} !important;',                   
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .time',        		             
			]
		);		
		$this->add_responsive_control(
			'time_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				], 
			]
		);
		$this->add_responsive_control(
			'time_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],  
			]
		);
        $this->end_controls_section();


        // $this->start_controls_section(
        //     'arrow_options',
        //     [
        //         'label' => esc_html__('Arrow Style', 'rtelements'),
        //         'tab' => Controls_Manager::TAB_STYLE,
        //     ]
        // );
        
        // $this->add_control(
        //     'navigation_arrow_background',
        //     [
        //         'label' => esc_html__('Background', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-prev' => 'background: {{VALUE}};',
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-next' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_nav' => 'true'
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'navigation_arrow_background_hover',
        //     [
        //         'label' => esc_html__('Hover Background', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-prev:hover' => 'background: {{VALUE}};',
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-next:hover' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_nav' => 'true'
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'navigation_arrow_icon_color',
        //     [
        //         'label' => esc_html__('Icon Color', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-prev i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-next i' => 'color: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_nav' => 'true'
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'navigation_arrow_icon_color_hvoer',
        //     [
        //         'label' => esc_html__('Icon Hover Color', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-prev:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .portfolio-slider-nav .swiper-button-next:hover i' => 'color: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_nav' => 'true'
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'bullet_options',
        //     [
        //         'label' => esc_html__('Bullet Style', 'rtelements'),
        //         'type' => Controls_Manager::HEADING,
        //         'separator' => 'before',
        //         'condition' => [
        //             'slider_dots' => 'true'
        //         ]
        //     ]
        // );
        // $this->add_control(
        //     'navigation_dot_icon_background',
        //     [
        //         'label' => esc_html__('Background Color', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .swipper-bulet-pagination .swiper-pagination-bullets .swiper-pagination-bullet' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_dots' => 'true'
        //         ]
        //     ]
        // );
        // $this->add_control(
        //     'navigation_dot_border_color_active',
        //     [
        //         'label' => esc_html__('Active Color', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .swipper-bulet-pagination .swiper-pagination-bullets .swiper-pagination-bullet-active' => 'background: {{VALUE}} !important;',

        //         ],
        //         'condition' => [
        //             'slider_dots' => 'true'
        //         ]
        //     ]
        // );
        // $this->add_control(
        //     'navigation_dot_shape_icon_background',
        //     [
        //         'label' => esc_html__('Background Color', 'rtelements'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .swipper-bulet-pagination .swiper-pagination-bullets' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'slider_dots' => 'true'
        //         ]
        //     ]
        // );
        // $this->end_controls_section();
    }

    /**
     * Render rsgallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    public function get_venue_data($event_id) {
		$venues    = [];
		$settings  = $this->get_settings_for_display();		
        //$event_id  = $this->get_event_id();
		$venue_ids = tec_get_venue_ids( $event_id );
		$target    = $settings['venue_website_link_target'] ?? '_self';

		foreach ( $venue_ids as $venue_id ) {
			$phone               = tribe_get_phone( $venue_id );
			$venues[ $venue_id ] = [
				'id'         => $venue_id,
				'name'       => tribe_get_venue( $venue_id ),
				'address'    => tribe_get_full_address( $venue_id ),
				'city'    => tribe_get_address( $venue_id ),
				'phone'      => $phone,
				'phone_link' => tribe_is_truthy( $settings['link_venue_phone'] ?? false ) ? $this->format_phone_link( $phone ) : false,
				'map_link'   => tribe_get_map_link_html( $venue_id ),
				'website'    => tribe_get_venue_website_link( $venue_id, null, $target ),
				'map'        => tribe_get_embedded_map( $venue_id, '100%', '100%' ),
			];
		}

		return $venues;
	}

    protected function render() {
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
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $item_gap   = $settings['item_gap_custom']['size'];
        $item_gap   = !empty($item_gap) ? $item_gap : '30';
        $unique = rand(2012, 35120);
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

        $current_post_id = get_the_ID(); 
        $current_post_categories = wp_get_post_terms( $current_post_id, 'tribe_events_cat', array( 'fields' => 'ids' ) ); 

        if ( !empty( $current_post_categories ) ) {
            $events = tribe_get_events( array( 
                'posts_per_page' => $settings['per_page'], 
                'post__not_in' => array( $current_post_id ), 
                'tax_query' => array(
                    array(
                        'taxonomy' => 'tribe_events_cat',
                        'field'    => 'term_id',
                        'terms'    => $current_post_categories,
                    ),
                ),
            ) );
        }
        ?>           
       
        <div class="swiper rtaddon-portfolio-slider-<?php echo esc_attr($unique); ?>  rsaddon-unique-slider rs-addon-slider rt-portfolio-slider rt-portfolio rt-portfolio-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?> center-mode-<?php echo $centerMode; ?>">          
            
            <?php 
            if ( !empty( $events ) ) { 
                    echo '<h3 class="related_event_title">Related Event</h3>';
                
            } ?>     

            <div class="swiper-wrapper">                
                <?php 
                    if ('1' == $settings['portfolio_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style1.php";
                    }else {
                        include plugin_dir_path(__FILE__) . "/style1.php";
                    } 
                ?>
            </div>
            <div class="swiper-pagination-new"></div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                var swiper = new Swiper(".rtaddon-portfolio-slider-<?php echo esc_attr($unique); ?>", {
                    slidesPerView: <?php echo $slidesToShow; ?>,
                    <?php if ('6' == $settings['portfolio_slider_style']) { ?>
                        loop: true,
                        loopedSlides: 50,
                        autoHeight: true,
                        shortSwipes: false,
                        longSwipes: false,
                        effect: 'fade',
                        speed: 500,
                        autoplay: {
                            delay: 1500,
                        },
                    <?php } else {
                                echo $seffect; ?>
                        speed: <?php echo esc_attr($autoplaySpeed); ?>,
                        loop: <?php echo esc_attr($infinite); ?>,
                        <?php echo esc_attr($slider_autoplay); ?>,
                    <?php } ?>

                    spaceBetween: <?php echo esc_attr($item_gap); ?>,

                    centeredSlides: <?php echo esc_attr($centerMode); ?>,

                    <?php if ($sliderDots == 'true') : ?>
                        pagination: {
                            el: ".swiper-pagination-new",
                            clickable: true
                        },
                    <?php endif; ?>

                    breakpoints: {
                        0: {
                            slidesPerView: <?php echo esc_attr($col_xs); ?>,

                        },
                        <?php echo (!empty($col_xs)) ?  '575: { slidesPerView: ' . $col_xs . ' },' : '';
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
?>