<?php
/**
 * Tab widget class
 *
 */
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Reactheme_Tab_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'rt-tab';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RT Tab', 'rtelements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-tabs-1';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'tab', 'vertical', 'icon', 'horizental' ];
    }


	protected function register_controls() {
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'rtelements' ),
            ]
        );

       

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__( 'Title & Description', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tab Title', 'rtelements' ),
                'placeholder' => esc_html__( 'Tab Title', 'rtelements' ),
                'label_block' => true,
            ]
        );
       
        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Content', 'rtelements' ),
                'default' => esc_html__( 'Tab Content', 'rtelements' ),
                'placeholder' => esc_html__( 'Tab Content', 'rtelements' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,                
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'is_external' => 'true',
                ],
                'dynamic' => [
                    'active' => true,
                ],                
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs Items', 'rtelements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title' => esc_html__( 'Tab #1', 'rtelements' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rtelements' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Tab #2', 'rtelements' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rtelements' ),
                    ],

                    [
                        'tab_title' => esc_html__( 'Tab #3', 'rtelements' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rtelements' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__( 'View', 'rtelements' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );




        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    
                    'vertical' => esc_html__( 'Vertical', 'rtelements' ),
                    'horizontal' => esc_html__( 'Horizontal', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();

        //start title styling

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__( 'Navigation', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .rts-tab-style-one .button-area button',
                
            ]
        );
        $this->add_responsive_control(
		    'tab_title_spacing_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .rts-tab-style-one .button-area button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'tab_title_spacing_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .rts-tab-style-one .button-area button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);   
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} .rts-tab-style-one .button-area button',
			]
		); 
        $this->add_responsive_control(
		    'nav_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
		        'selectors' => [
		            '{{WRAPPER}} .rts-tab-style-one .button-area button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'tab_title_area_padding',
            [
                'label' => esc_html__( 'Area Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .button-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( '_tabs_title_icon' );

        $this->start_controls_tab(
            'tab_icon_bg_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        ); 
        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .button-area button' => 'color: {{VALUE}};',
                ],               
            ]
        );
        $this->add_control(
            'tab_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .button-area button' => 'background: {{VALUE}};',
                ],               
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_bg_hover_tab',
            [
                'label' => esc_html__( 'Active', 'rtelements' ),
            ]
        );        
        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .button-area button.active' => 'color: {{VALUE}};',
                   
                ],
               
            ]
        );
        $this->add_control(
            'tab_active_bgcolor',
            [
                'label' => esc_html__( 'Active Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .button-area button.active' => 'background: {{VALUE}};',
                   
                ],
               
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();   
        $this->end_controls_section();

        $this->start_controls_section(
			'item_box_style',
			[
				'label' => esc_html__( 'Item', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
		$this->add_control(
            'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .notice-list ul .single-notice' => 'background: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice',
			]
		);
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .notice-list ul .single-notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .notice-list ul .single-notice' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        //start content styling
        $this->start_controls_section(
            'section_content_style',
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
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-content p a' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice-item .notice-content p a',                    
			]
		);	
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'date_styles',
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
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'color: {{VALUE}} !important;',                              
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date span' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date',                    
			]
		);	
		$this->add_responsive_control(
			'date_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'content_top_gap',
            [
                'label' => esc_html__( 'Content Top Gap', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],                
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rts-tab-style-one .tab-content .rts-tab-content-one' => 'margin-top: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );  
        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $tabs     = $this->get_settings_for_display('tabs');  
        $settings = $this->get_settings_for_display();  
        $id_int   = substr( $this->get_id_int(), 0, 3 ); 

        require plugin_dir_path(__FILE__)."/style1.php";
      
    }
}