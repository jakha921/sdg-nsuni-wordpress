<?php
/**
 * Icon List
 *
 */
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class RTS_Academic_Widget extends \Elementor\Widget_Base {

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

    public function get_name() {
        return 'rt-academic';
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
        return esc_html__( 'RT Academic', 'rtelements' );
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
        return 'glyph-icon flaticon-price';
    }
	public function get_categories() {
        return [ 'pielements_category' ];
    }
    public function get_keywords() {
        return [ 'list', 'title', 'program', 'heading', 'plan' ];
    }
	protected function register_controls() {

        $this->start_controls_section(
			'general_program_list',
			[
				'label' => esc_html__( 'General', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);  
        $this->add_control(
			'rt-program-category',
			[
				'label'   => esc_html__( 'Category', 'rselements' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',		
			]
		);
        $this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Show Per Page', 'rselements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 5', 'rselements' ),
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
			'search_section',
			[
				'label' => esc_html__( 'Search', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);          
        $this->add_control(
            'search_label',
            [
                'label' => esc_html__( 'Label', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Areas of Study:', 'rtelements' ),
                'label_block' => 'true',
            ]
        );   
        $this->add_control(
            'search_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'What interests you?', 'rtelements' ),
                'label_block' => 'true',
            ]
        ); 
        $this->add_control(
			'search_icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'rt-search',
					'library' => 'rt-icons',
				],
			]
		);        
        $this->end_controls_section();

        $this->start_controls_section(
			'select_section',
			[
				'label' => esc_html__( 'Select  ', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);          
        $this->add_control(
            'select_label',
            [
                'label' => esc_html__( 'Label', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Department Type:', 'rtelements' ),
                'label_block' => 'true',
            ]
        );          
        $this->end_controls_section();

        $this->start_controls_section(
			'pagintation_section',
			[
				'label' => esc_html__( 'Pagination', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);  

        $this->add_control(
			'academic_pagination',
			[
				'label' => esc_html__( 'Pagination', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'separator' => 'before',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'academic_pagination_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Pagination text here', 'rsaddon' ),
				'default' => esc_html__( 'Load More', 'rsaddon' ),
			]
		);
		$this->add_responsive_control(
			'load_top_spacing',
			[
				'label' => esc_html__( 'Top Spacing', 'rsaddon' ),
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
					'{{WRAPPER}} .academic-pagination-load-more' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'search_styles',
            [
                'label' => esc_html__( 'Search', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'search_label_color',
            [
                'label' => esc_html__( 'Label Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-search h6' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_label_typography',
                'selector' => '{{WRAPPER}} .category-search h6',
                
            ]
        );  
        $this->add_control(
            'search__color',
            [
                'label' => esc_html__( 'Search Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-filter .category-search .cat-search-form input' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .search-filter .category-search .cat-search-form input',
			]
		);
        $this->add_control(
            'search_focus_color',
            [
                'label' => esc_html__( 'Focus Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-filter .category-search .cat-search-form input:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_input_typography',
                'selector' => '{{WRAPPER}} .search-filter .category-search .cat-search-form input',
                
            ]
        );  
        $this->add_responsive_control(
			'search_input_padding',
			[
				'label' => esc_html__( 'Padding', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .search-filter .category-search .cat-search-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'search_icon_styles',
            [
                'label' => esc_html__( 'Icon', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );         
        $this->add_control(
            'search_icon_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-filter .category-search .cat-search-form .cat-search' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .search-filter .category-search .cat-search-form .cat-search svg path' => 'fill: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
			'search_icon_width',
			[
				'label' => esc_html__( 'Size', 'rtelements' ),
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
					'{{WRAPPER}} .search-filter .category-search .cat-search-form .cat-search' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .search-filter .category-search .cat-search-form .cat-search svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'select_styles',
            [
                'label' => esc_html__( 'Select', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'select_label_color',
            [
                'label' => esc_html__( 'Label Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-filter h6' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'select_label_typography',
                'selector' => '{{WRAPPER}} .category-filter h6',
                
            ]
        );  
        $this->add_control(
            'select__color',
            [
                'label' => esc_html__( 'Select Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-filter .category-filter #cat-filter' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'select_border',
				'selector' => '{{WRAPPER}} .search-filter .category-filter #cat-filter',
			]
		);  
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'select__typography',
                'selector' => '{{WRAPPER}} .search-filter .category-filter #cat-filter',
                
            ]
        );  
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Content', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cat-link-arrow i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cat-link-arrow svg path' => 'fill: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title:hover a::after' => 'background: {{VALUE}};',
                ],
            ]
        ); 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .single-cat-item .cat-meta .cat-title a',
                
            ]
        );  
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'text_border',
                'selector' => '{{WRAPPER}} .cat-meta'                
            ]
        );
       $this->add_responsive_control(
            'text_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cat-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'text_margin',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        
        $this->add_control(
			'cat_styles',
			[
				'label' => esc_html__( 'Category', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		); 
        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat-link-btn' => 'color: {{VALUE}};',
                ],
            ]
        ); 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'selector' => '{{WRAPPER}} .cat-link-btn',
                
            ]
        );  
       $this->add_responsive_control(
            'cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cat-link-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'cat_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cat-link-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
			'icon_styles',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow svg path' => 'fill: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow' => 'background: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'icon_hover_bgcolor',
            [
                'label' => esc_html__( 'Hover Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow' => 'border-color: {{VALUE}};',
                ],
            ]
        ); 
        $this->end_controls_section(); 


        $this->start_controls_section(
		    'pagination_sections',
		    [
		        'label' => esc_html__( 'Pagination', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'academic_pagination' => 'yes'
				],
		    ]
		);
		$this->start_controls_tabs('loads_tabs_button');

		$this->start_controls_tab(
            'load_btn_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'load_btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .load' => 'color: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'load_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .load' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'load_btn_typography',
		        'selector' => '{{WRAPPER}} .load',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'load_btn_border',
		        'selector' => '{{WRAPPER}} .load',
		    ]
		);
		$this->add_control(
		    'load_btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'load_button_box_shadow',
		        'selector' => '{{WRAPPER}} .load',
		    ]
		);
		$this->add_responsive_control(
		    'load_btn_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'load_btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'load_btn_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'load_btn_hover_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .load:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .load:hover span i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .load:hover span svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'load_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .load::after' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'load_btn_hover_typography',
		        'selector' => '{{WRAPPER}} .load:hover',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'load_btn_hover_border',
		        'selector' => '{{WRAPPER}} .load:hover',
		    ]
		);
		$this->add_control(
		    'load_btn_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load_:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'load_button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .load:hover',
		    ]
		);
		$this->add_responsive_control(
		    'load_btn_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'load_btn_hover_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .load:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $img_alt = !empty($settings['bg_img']['alt']) ? $settings['bg_img']['alt'] : 'Image';  
        ?>       

        <div class="search-filter">
            <div class="row g-5">
                <div class="col-lg-7 col-md-6">
                    <div class="category-search">
                        <?php 
                        if(!empty($settings['search_label'])) : ?>
                            <h6><?php echo wp_kses_post($settings['search_label']); ?></h6>
                            <?php 
                        endif; ?>
                        <form action="#" class="cat-search-form">
                            <input type="text" placeholder="<?php echo esc_attr($settings['search_placeholder']); ?>" name="s" id="cat">
                            <button type="submit" class="cat-search"><?php \Elementor\Icons_Manager::render_icon( $settings['search_icon'], [ 'aria-hidden' => 'true' ] ); ?></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="category-filter">
                        <?php 
                        if(!empty($settings['search_label'])) : ?>
                            <h6><?php echo wp_kses_post($settings['select_label']); ?></h6>
                            <?php 
                        endif; ?>
                        <select name="cat-search" id="cat-filter">
                            <option value=""><?php echo wp_kses_post('All Departments');?></option>
                            <?php 
                                $dep_args = array(
                                    'post_type' => 'rt-department',
                                    'posts_per_page' => '-1'
                                );

                                $dep_query = new WP_Query($dep_args);

                                while($dep_query->have_posts()) : $dep_query->the_post(); ?>

                                    <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>

                                    <?php 
                                endwhile; 
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="all-program-category">  
            <div class="full-screen-ajax-loader">
                <div class="inner-bg"></div>
                <span class="ajax-loader"><img src="<?php echo plugin_dir_url(__FILE__) ?>/white-spinner.gif"></span>
            </div>
            <div class="row">                       
            <?php 
                $ajax_settings = [];
                $ajax_settings['thumbnail_size'] = $settings['thumbnail_size'];

                $x=1;
                $cat = $settings['rt-program-category'];		      
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                    'post_type'      => 'rt-program',
                    'posts_per_page' => $settings['per_page'],
                    'order'          => 'ASC'			
                );

                if(!empty($cat)){
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'rt-program-category',
                            'field'    => 'slug', //can be set to ID
                            'terms'    => $cat //if field is ID you can reference by cat/term number
                        ),
                    );
                }   

                $best_wp = new WP_Query($args);
               
                while($best_wp->have_posts()): $best_wp->the_post();					
                    $termsArray  = get_the_terms( $best_wp->ID, "rt-program-category" );  //Get the terms for this particular item
                    $termsString = ""; //initialize the string that will contain the terms
                    $termsSlug   = "";
                    if(!empty($termsArray)): 
                        $x = 0;
                        foreach ( $termsArray as $term ) { 
                            $x++;
                            $termsString .= 'filter_'.$term->slug.' '; 
                            if($x > 1){
                                $termsSlug .= ', ';
                            }
                            $termsSlug .= $term->name;                            
                        }		
                    endif;		
                    $content = get_the_content();	
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-cat-item">
                            <div class="cat-thumb">
                                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                                <?php 
                                if(!empty($termsSlug)) : ?>
                                    <a href="<?php the_permalink(); ?>" class="cat-link-btn"><?php echo $termsSlug; ?></a>
                                    <?php 
                                endif; ?>
                            </div>
                            <div class="cat-meta">
                                <div class="cat-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="cat-link">
                                    <a href="<?php the_permalink(); ?>" class="cat-link-arrow"><i class="rt-arrow-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php
                endwhile;
                wp_reset_query();  
                ?>    
            </div>
        </div> 

        <?php 
            if($settings['academic_pagination'] == 'yes') { 
                if(!empty($settings['academic_pagination_text'])) : ?>
                    <div class="academic-pagination-load-more text-center">
                        <p class="no-result-notice"></p>
                        <button class="load-more-btn load" current-page="2"><?php echo wp_kses_post($settings['academic_pagination_text']); ?>
                            <span class="ajax-loader"><img src="<?php echo plugin_dir_url(__FILE__) ?>/white-spinner.gif"></span>
                        </button>
                    </div>
                    <?php 
                endif ;
            } 
        ?>

        <!-- start pagination  -->
			<script>
				(function ($) {
					$(document).ready(function () {

                        function searchPrograms( ) { 
                            
                         }
                 
                        $('.search-filter .category-search .cat-search-form input, .search-filter .category-filter select#cat-filter').on('keyup change paste', function (e) { 

                            $('.full-screen-ajax-loader').css('display', 'inline-block');

                           

							let searchKey = $('.search-filter .category-search .cat-search-form input').val();

                            let departmentId = $('.search-filter .category-filter select#cat-filter').val();

                            $('.no-result-notice').html('');

                            let paginationBtn = $('.academic-pagination-load-more .load-more-btn');

                            
                            
							$.ajax({
								type: "post",
								url: rtajax.ajaxurl,
								data: {
									action: 'getAcademicSearchResult',
									args: '<?php echo wp_json_encode($args); ?>',
									settings:  '<?php echo wp_json_encode($ajax_settings); ?>',
                                    searchKey: searchKey,
                                    departmentId: departmentId,
								},

								//dataType: "json",
								success: function (response) {
									setTimeout(() => {
										if(response){
											//$('.teams-pagination-load-more .ajax-loader').css('display', 'none');
                                            $('.full-screen-ajax-loader').css('display', 'none');
											$('.all-program-category .row').html(response);

                                            let result_count = $('.all-program-category .row .result-col').length;

                                            if(result_count < 2){
                                                $(paginationBtn).hide();
                                            }else{
                                                $(paginationBtn).css('display', 'inline-block');
                                            };
										}
                                        if(response.success == false){
                                            $(paginationBtn).hide();
											$('.no-result-notice').html('Oops! No Results Found.');
										}
									}, 1500);
									
									
									
									
								}
							});
						});

						$('.academic-pagination-load-more .load-more-btn').click(function (e) { 
							e.preventDefault();
							$('.academic-pagination-load-more .ajax-loader').css('display', 'inline-block');
                            $('.full-screen-ajax-loader').css('display', 'inline-block');

							let paginationBtn = $(this);
							let currentPage = $(paginationBtn).attr('current-page');
                            let searchKey = $('.search-filter .category-search .cat-search-form input').val();
                            let departmentId = $('.search-filter .category-filter select#cat-filter').val();							
							
							$.ajax({
								type: "post",
								url: rtajax.ajaxurl,
								data: {
									action: 'getAcademicSearchResult',
									args: '<?php echo wp_json_encode($args); ?>',
									settings:  '<?php echo wp_json_encode($ajax_settings); ?>',
                                    searchKey: searchKey,
                                    departmentId: departmentId,
									currentPage: currentPage
								},
								//dataType: "json",
								success: function (response) {
									setTimeout(() => {
										if(response){
											$('.academic-pagination-load-more .ajax-loader').css('display', 'none');
											$('.full-screen-ajax-loader').css('display', 'none');
											$('.all-program-category .row').append(response);
											$(paginationBtn).attr('current-page', parseInt(currentPage) + parseInt(1));
											if(response.success == false){
												$(paginationBtn).hide();
												$('.no-result-notice').html('Oops! No More Results Found.');
											}
										}
									}, 1500);
									
								}
							});


						});
		
					});
				})(jQuery);
			</script>
        <?php 
    }

    public function getCategories(){
        $cat_list = [];
             if ( post_type_exists( 'rt-program' ) ) { 
              $terms = get_terms( array(
                 'taxonomy'    => 'rt-program-category',
                 'hide_empty'  => true            
             ) ); 
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}
