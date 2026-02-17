<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Team_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-team-member';
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
	public function get_title() {
		return __( 'RT Team Grid', 'rsaddon' );
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
	public function get_icon() {
		return 'glyph-icon flaticon-network';
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
	public function get_categories() {
        return [ 'pielements_category' ];
    }

	

	/**
	 * Register team grid widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'team_grid_source',
			[
				'label'   => esc_html__( 'Select Team Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'rsaddon'),
					'dynamic' => esc_html__('Dynamic', 'rsaddon')					
				],											
			]
		);
		$this->add_control(
			'team_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => esc_html__('Style 1', 'rsaddon'),			
					'style2' => esc_html__('Style 2', 'rsaddon'),			
				],
				'separator' => 'before',										
			]
		);
		$this->add_control(
			'team_category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],	
			]
		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Team Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
			]
		);
		$this->add_control(
            'post_offset',
            [
                'label' => esc_html__('Offset', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
            ]
        );	
		$this->add_control(
			'team_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
							
			]
		);

		$this->add_control(
			'memeber_image',
			[
				'label' => esc_html__( 'Member Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'custom',
				],
			]
		);
		$this->add_responsive_control(
			'item_bottom_spacing',
			[
				'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
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
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
				'selectors' => [
					'{{WRAPPER}} .team-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_middle_spacing',
			[
				'label' => esc_html__( 'Item Middle Gap', 'rtelements' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
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
                    '{{WRAPPER}} .rs-team-grid .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}} !important;',
                ],
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
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
            ]
        ); 

		$this->add_control(
			'team_pagination',
			[
				'label' => esc_html__( 'Pagination', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'separator' => 'before',
				'default' => 'no',
			]
		);
		$this->add_control(
			'team_pagination_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Pagination text here', 'rsaddon' ),
				'default' => esc_html__( 'Load More', 'rsaddon' ),
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_pagination' => 'yes',
				],
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
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_pagination' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .teams-pagination-load-more' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Name', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'default' => 'Elements Name',
                'placeholder' => esc_html__( 'Type Member Name', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
			]
        );

        $this->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'rsaddon' ),
                'separator' => 'before',
                'placeholder' => esc_html__( 'Type Member Designation', 'rsaddon' ),
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'phone',
            [
                'label' => esc_html__( 'Phone', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',                
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Email Address', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Email Address', 'rsaddon' ),
                'separator' => 'before',               
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );

        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Short Bio', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 5,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );

        $this->add_control(
            'popup_description',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here.',
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 10,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__( 'Social Profiles', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
 		$repeater = new Repeater();
 		
 		$repeater->add_control(
 		    'link',
 		    [
 		        'label' => esc_html__('Enter Link', 'rsaddon'),
 		        'type' => Controls_Manager::URL,                
 		    ]
 		); 
		 $repeater->add_control(
			'social_icon_pick',
			[
				'label'     => esc_html__( 'Icon', 'pielements' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
			]
		);
 		$this->add_control(
 		    'social_icon_list',
 		    [
 		        'show_label' => false,
 		        'type' => Controls_Manager::REPEATER,
 		        'fields' => $repeater->get_controls(),
 		        'title_field' => '{{{ social_icon_pick.value }}}',
 		        'default' => [
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-facebook-f',
                    ],
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-twitter',
                    ],
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-linkedin-in',
                    ],                  
                ],
 		    ]
 		);
        $this->add_control(
			'image_spacing_custom',
			[
				'label'      => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator'  => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],		
				'selectors' => [
                    '{{WRAPPER}} .team-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
			]
		);  
				
		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_box_style',
			[
				'label' => esc_html__( 'Box', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .team-item' => 'background: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .team-item',
			]
		);
		$this->add_control(
            'item_hover_border_color',
            [
                'label' => esc_html__( 'Hover Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .team-item:hover' => 'border-color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .team-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .team-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content__style',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_styles',
			[
				'label' => esc_html__( 'Title Style', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);		
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}} !important;',						
                    '{{WRAPPER}} .title' => 'color: {{VALUE}} !important;',						
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title a:hover' => 'color: {{VALUE}} !important;',		
                    '{{WRAPPER}} .title:hover' => 'color: {{VALUE}} !important;',		
                ],                
            ]
        );   
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rsaddon' ),
				
				'selector' =>
                    '{{WRAPPER}} .title'
			]
		);
		$this->add_control(
			'des_styles',
			[
				'label' => esc_html__( 'Designation Style', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .designation' => 'color: {{VALUE}} !important;',
                ],                
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => esc_html__( 'Typography', 'rsaddon' ),
				
				'selector' =>
                    '{{WRAPPER}} .designation'
			]
		);
		$this->add_control(
			'short_des_styles',
			[
				'label' => esc_html__( 'Short Description', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'short_des_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .staf-info__speciality p' => 'color: {{VALUE}} !important;',
                ],   
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],             
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'short_des_typography',
				'label' => esc_html__( 'Typography', 'rsaddon' ),
				
				'selector' =>'{{WRAPPER}} .staf-info__speciality p',
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'short_des_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .staf-info__speciality' => 'border-color: {{VALUE}} !important;',
                ],                  
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],              
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_social_style',
			[
				'label' => esc_html__( 'Social', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'social_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .social-icon i' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'social_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .social-icon:hover i' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_responsive_control(
			'social_spacing',
			[
				'label' => esc_html__( 'Gap', 'rtelements' ),
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
					'{{WRAPPER}} .staf-info__social' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_mail_style',
			[
				'label' => esc_html__( 'Email', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'mail_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .email-contact' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'mail_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .email-contact:hover' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'mail_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .email-contact i' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'mail_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .email-contact i:hover' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_phone_style',
			[
				'label' => esc_html__( 'Phone', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
			]
		);
		$this->add_control(
            'phone_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .phone-contact' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'phone_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .phone-contact:hover' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'phone_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .phone-contact i' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_control(
            'phone_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .phone-contact i:hover' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
				],
		    ]
		);

		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'color: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'btn_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .react_button',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_border',
		        'selector' => '{{WRAPPER}} .react_button',
		    ]
		);
		$this->add_control(
		    'btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .react_button',
		    ]
		);
		$this->add_responsive_control(
		    'btn_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        ); 
		$this->add_control(
		    'btn_hover_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button:hover span i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button:hover span svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);	
		$this->add_control(
		    'btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button::after' => 'background: {{VALUE}};',
		        ],
		    ]
		);		
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_hover_typography',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_hover_border',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		    ]
		);
		$this->add_control(
		    'btn_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .react_button:hover',
		    ]
		);
		$this->add_responsive_control(
		    'btn_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_hover_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
		    'pagination_sections',
		    [
		        'label' => esc_html__( 'Pagination', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_grid_source' => 'dynamic',
					'team_grid_style' => 'style2',
					'team_pagination' => 'yes'
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

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$popup_title_color = !empty( $settings['popup_title_color']) ? 'style="color: '.$settings['popup_title_color'].'"' : '';
		$popup_designation_color = !empty( $settings['popup_designation_color']) ? 'style="color: '.$settings['popup_designation_color'].'"' : '';
		$popup_content_color = !empty( $settings['popup_content_color']) ? 'style="color: '.$settings['popup_content_color'].'"' : '';
		$popup_phn_email_color = !empty( $settings['popup_phn_email_color']) ? 'style="color: '.$settings['popup_phn_email_color'].'"' : '';
		$popup_background = !empty( $settings['popup_background']) ? 'style="background: '.$settings['popup_background'].'"' : '';

		//Icon Style
		$icon_style='';
		if(!empty($settings['popup_icon_color']) && empty($settings['popup_icon_bg_color'])){
			$icon_style = 'style="color: '.$settings['popup_icon_color'].'"';				
		}
		if(!empty($settings['popup_icon_bg_color'])){
			$icon_style = ($settings['popup_icon_bg_color']) ? ' style="background: '.$settings['popup_icon_bg_color'].'"' : '';
		}

		if(!empty($settings['popup_icon_color']) && !empty($settings['popup_icon_bg_color'])){
			$icon_style = 'style="background: '.$settings['popup_icon_bg_color'].'; color: '.$settings['popup_icon_color'].'"';				
		} ?>

		<?php		
			$x=1;
			$cat = $settings['team_category'];	

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


			$args = array(
				'post_type'      => 'teams',
				'posts_per_page' => $settings['per_page'],
				//'paged'          => $paged					
			);

			if(!empty($cat)){

				$args['tax_query'] = array(
					array(
						'taxonomy' => 'team-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
					),
				); 
			}   
			
			$best_wp = new wp_Query($args);	  
			
			$ajax_settings = array(
				'team_grid_style' => $settings['team_grid_style'],
				'team_columns'    => $settings['team_columns'],
				'thumbnail_size' => $settings['thumbnail_size'],
				'team_grid_source' => $settings['team_grid_source'],
			);		

			$unique = uniqid();
		?>
		<div class="teams-wrapper <?php echo esc_attr( $unique ) ?>">			
			<?php
			if($settings['team_grid_source'] == 'dynamic'){
				?>
				<div class="rs-team-grid rs-team team-grid-<?php echo esc_html($settings['team_grid_style']); ?>">
					<div class="row">
						<?php
						while($best_wp->have_posts()): $best_wp->the_post();

							if('style1' == $settings['team_grid_style']){
								require plugin_dir_path(__FILE__)."/style1.php";
							}elseif ('style2' == $settings['team_grid_style']){
								require plugin_dir_path(__FILE__)."/style2.php";
							}			

						endwhile;
						//wp_reset_postdata();  
						?>  
					</div>
				</div>
			<?php
			}else{ ?>

				<div class="rs-team-grid rs-team team-grid-<?php echo esc_html($settings['team_grid_style']);?> rsaddon_pro_box">
					<?php 
						$unique = rand(2012,3554120);
					?>
					<div class="team-item">
						<div class="team-inner-wrap">
							<div class="image-wrap">
								<a aria-label="team" class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($unique);?>" data-effect="mfp-zoom-in">
									<?php if ( $settings['memeber_image']['url'] ) : ?>
									<img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
									<?php endif; ?>
								</a>

								<?php if('style1' == $settings['team_grid_style']){ ?>
								<div class="social-icons1">	
									<?php foreach ( $settings['social_icon_list'] as $index => $item ) :

										$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
										$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
										$iconPick         = !empty($item['social_icon_pick']) ? $item['social_icon_pick']['value'] : '';
										?>
											<a aria-label="team" href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
												<i class="<?php echo esc_html($iconPick); ?>"></i>
											</a>			
										
								<?php  endforeach; ?>   
							</div> 
								<?php } ?>
							</div>

							<div class="team-content">
								<div class="member-desc">								
									<?php if($settings['title']):?>
										<h3 class="team-name"><a aria-label="team" class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($unique);?>"><?php echo esc_html($settings['title']);?></a></h3>
									<?php endif; 

									if($settings['designation']) : ?>
										<span class="team-title"><?php echo esc_html($settings['designation']);?></span>
									<?php endif ; ?>
								</div>
								<?php if($settings['bio']): ?>
										<p class="team-desc"><?php echo esc_html($settings['bio']);?></p>
									<?php endif; ?>								  	
								<?php if ( !empty(is_array( $settings['social_icon_list'] )) ) : ?>
									<div class="social-icons">	
										<?php foreach ( $settings['social_icon_list'] as $index => $item ) :

											$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
											$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
											$iconPick         = !empty($item['social_icon_pick']) ? $item['social_icon_pick']['value'] : '';
										?>

											<a aria-label="team" href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
												<i class="<?php echo esc_html($iconPick); ?>"></i>
											</a>			
										
										<?php  endforeach; ?>   
									</div>	
								<?php endif; ?>	
							</div>
						</div>
					</div>

					<!-- Hidden PupupBox Text -->
					<div id="rs_popupBox_<?php echo esc_attr($unique);?>" class="rspopup_style1 mfp-with-anim mfp-hide" <?php echo wp_kses_post($popup_background);?>>
						<div class="row">
							<div class="col-md-5">
								<div class="rsteam_img">
									<?php if ( $settings['memeber_image']['url'] ) : ?>
									<img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
									<?php endif; ?>	
								</div>
							</div>
							<div class="col-md-7">
								<div class="rsteam_content">
									<div class="team-content">
										<div class="team-heading">

											<?php if($settings['title']) : ?>
											<h3 class="team-name"><a aria-label="team" class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($x);?>" data-effect="mfp-zoom-in"><?php echo esc_html($settings['title']);?></a></h3>
											<?php endif; ?>
											<?php if($settings['designation']) : ?>
												<span class="team-title"><?php echo esc_html($settings['designation']);?></span>
											<?php endif; ?>	
										</div> 

										
										<?php if($settings['popup_description']) : ?>
										<div class="team-des" <?php echo wp_kses_post($popup_content_color);?>>
											<?php echo esc_html($settings['popup_description']);?>
										</div>
										<?php endif; ?>


										<?php if($settings['phone'] || $settings['email'])   : ?>
										<div class="contact-info">

											<ul>
												<?php if($settings['phone']): ?>
													<li <?php echo wp_kses_post($popup_phn_email_color);?>>
														<span><?php echo esc_html('Phone:', 'rsaddon');?> </span>
														<?php echo esc_html($settings['phone']);?>
													</li>

												<?php endif; ?>
												
												<?php if($settings['email']): ?>
													<li <?php echo wp_kses_post($popup_phn_email_color);?>>
														<span><?php echo esc_html('Email:', 'rsaddon');?> </span>
														<a aria-label="team" href="<?php echo esc_html($show_email); ?>"<?php echo wp_kses_post($popup_phn_email_color);?>>
															<?php echo esc_html($settings['email']);?></a>
													</li>
												<?php endif; ?>
											</ul>
										</div>
										<?php endif; ?>

										<div class="rs-social-icons">
											<div class="social-icons1">	
											<?php foreach ( $settings['social_icon_list'] as $index => $item ) :
												$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
												$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
												$iconPick         = !empty($item['social_icon_pick']) ? $item['social_icon_pick']['value'] : '';
											?>
																		
													<a aria-label="team" href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
													<i class="<?php echo esc_html($iconPick); ?>"></i>
													</a>			
												
										<?php  endforeach; ?>   
									</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			<?php 

			}
			
			$post_counts = wp_count_posts('teams'); 
            $total_posts = isset($post_counts->publish) ? $post_counts->publish : 0;
            $per_page = !empty($settings['per_page']) ? $settings['per_page'] : ''; 
			if($settings['team_pagination'] == 'yes' && $total_posts > $per_page) { 
				if(!empty($settings['team_pagination_text'])) : ?>
					<div class="teams-pagination-load-more text-center">
						<button class="load-more-btn load" current-page="2"><?php echo wp_kses_post($settings['team_pagination_text']); ?>
							<span class="ajax-loader"><img src="<?php echo plugin_dir_url(__FILE__) ?>/white-spinner.gif"></span>
						</button>
						<p class="no-result-notice"></p>
					</div>
					<?php 
				endif;
			} ?>

			<!-- start pagination  -->
			<script>
				(function ($) {
					$(document).ready(function () {

						$('.teams-wrapper.<?php echo esc_attr( $unique ) ?> .load-more-btn').click(function (e) { 
							e.preventDefault();
							$('.teams-wrapper.<?php echo esc_attr( $unique ) ?> .teams-pagination-load-more .ajax-loader').css('display', 'inline-block');
							let paginationBtn = $(this);
							let currentPage = $(paginationBtn).attr('current-page');
							let resultContainer = $(this).parent().parent().find('.rs-team-grid .row');
							//let errorMsg = '
							
							$.ajax({
								type: "post",
								url: rtajax.ajaxurl,
								data: {
									action: 'load_more_team',
									args: '<?php echo wp_json_encode($args); ?>',
									settings:  '<?php echo wp_json_encode($ajax_settings); ?>',
									currentPage: currentPage
								},
								//dataType: "json",
								success: function (response) {
									console.log(response);
									
									setTimeout(() => {
										if(response){
											$('.teams-pagination-load-more .ajax-loader').css('display', 'none');
											$(resultContainer).append(response);
											$(paginationBtn).attr('current-page', parseInt(currentPage) + parseInt(1));
											if(response.success == false){
												$(paginationBtn).hide();
												$('.teams-wrapper.<?php echo esc_attr( $unique ) ?> .no-result-notice').html('Oops! No More Results Found.');
											}
										}
									}, 1500);									
								}
							});


						});
		
					});
				})(jQuery);
			</script>
		
		</div>
		<?php

	}
	    public function getCategories(){
	        $cat_list = [];
	         	if ( post_type_exists( 'teams' ) ) { 
	          	$terms = get_terms( array(
	             	'taxonomy'    => 'team-category',
	             	'hide_empty'  => true            
	         	) ); 
		        foreach($terms as $post) {
		        	$cat_list[$post->slug]  = [$post->name];
		        }
	    	}  
	        return $cat_list;
	    }
}?>