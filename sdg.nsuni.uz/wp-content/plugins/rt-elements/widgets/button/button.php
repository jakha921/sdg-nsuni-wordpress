<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Reactheme_Button_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'react-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RT Button', 'rtelements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-menu';
	}

	

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'rtelements_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'button' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'primary_btn',
				'separator' => 'before',
				'options' => [					
					'primary_btn' => esc_html__( 'Primary Button', 'rtelements'),
					'secondary_btn' => esc_html__( 'Secondary Button', 'rtelements'),
					'default_btn' => esc_html__( 'Default Button', 'rtelements'),
					'transparent_btn' => esc_html__( 'Transparent Button', 'rtelements')
				],
			]
		);
		
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'rtelements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__( 'Button Text', 'rtelements' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__( ' Button Link', 'rtelements' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rtelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rtelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rtelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rtelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react_button' => 'text-align: {{VALUE}}'
                ]
            ]
        );
		
		$this->add_control(
            'icon',
            [
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type'  => Controls_Manager::HEADING,               
            ]
        );

		$this->add_control(
            'show_icon',
            [
				'label'        => esc_html__( 'Show Icon', 'rtelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rtelements' ),
				'label_off'    => esc_html__( 'Hide', 'rtelements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );
		$this->add_control(
			'btn_icon',
			[
				'label'     => esc_html__( 'Icon', 'rtelements' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'rt rt-arrow-right-regular',	
					'library' => 'rt-icons',		
				],
				'condition' => [
					'show_icon' => 'yes'
				]			
			]
		);
		$this->add_responsive_control(
			'btn__width',
			[
				'label' => esc_html__( 'Button Custom Width', 'rtelements' ),
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
					'{{WRAPPER}} .react_button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'btn__stretch',
            [
                'label' => esc_html__( 'Stretch', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-block' => [
                        'title' => esc_html__( 'Inline', 'rtelements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Full', 'rtelements' ),
                        'icon' => 'eicon-h-align-stretch',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react_button' => 'display: {{VALUE}}'
                ]
            ]
        );	
		
		$this->end_controls_section();	

		//********** STYLE **********//
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
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
		            '{{WRAPPER}} .react_button.secondary_btn' => 'border-color: {{VALUE}};',
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
		            '{{WRAPPER}} .react_button.secondary_btn:hover ' => 'border-color: {{VALUE}};',
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
		        'condition' => [
		        	'button_style' => ['primary_btn']
		        ]
		    ]
		);		
		$this->add_control(
		    '2ndbtn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover' => 'background: {{VALUE}};',
		        ],
		        'condition' => [
		        	'button_style' => ['secondary_btn','default_btn','transparent_btn']
		        ]
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
		    '_section_style_icon',
		    [
		        'label' => esc_html__( 'Icon', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icon' => 'yes'
				]
		    ]
		);
		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button span i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button span svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .react_button.secondary_btn span i' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react_button.secondary_btn span svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .react_button:hover span i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react_button:hover span svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .react_button.secondary_btn:hover span i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react_button.secondary_btn:hover span svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'rtelements' ),
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
					'{{WRAPPER}} .react_button span' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);			
		$this->add_responsive_control(
		    'btn_icon_width',
		    [
		        'label' => esc_html__( 'Width', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [		      		            
		            '{{WRAPPER}} .react_button span' => 'width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_icon_height',
		    [
		        'label' => esc_html__( 'Height', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
		        'selectors' => [		      		            
		            '{{WRAPPER}} .react_button span' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',		            
		        ],
		    ]
		);	

		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'btn_text', 'basic' );
        $this->add_render_attribute( 'btn_text', 'class', 'btn_text' );
	?>	
		<?php 
		if($settings['button_style'] == 'primary_btn'):?>
			<a aria-label="button" class="react_button" href="<?php echo esc_url($settings['btn_link']['url']);?>">	
				<?php echo esc_html($settings['btn_text']);?>				
				<?php if (!empty($settings['btn_icon']['value'])) : ?>
					<span>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>
			</a>			
			<?php 
		elseif($settings['button_style'] == 'default_btn') : ?>
			<a aria-label="button" class="react_button <?php echo esc_attr($settings['button_style']); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>">	
				<?php echo esc_html($settings['btn_text']);?>
				<?php if (!empty($settings['btn_icon']['value'])) : ?>
					<span>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>
			</a>		
			<?php 
		elseif($settings['button_style'] == 'transparent_btn') : ?>
			<a aria-label="button" class="react_button <?php echo esc_attr($settings['button_style']); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>">	
				<?php echo esc_html($settings['btn_text']);?>
				<?php if (!empty($settings['btn_icon']['value'])) : ?>
					<span>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>
			</a>		
			<?php 
		else:		
			$target = $settings['btn_link']['is_external'] ? 'target=_blank' : ''; ?>
			<a aria-label="button" class="react_button <?php echo esc_attr($settings['button_style']); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>">	
				<?php echo esc_html($settings['btn_text']);?>
				<?php if (!empty($settings['btn_icon']['value'])) : ?>
					<span>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>
			</a>			
			<?php 
		endif;
	}
}