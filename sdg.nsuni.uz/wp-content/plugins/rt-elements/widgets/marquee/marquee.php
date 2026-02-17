<?php

/**
 * Marquee widget class
 *
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Marquee_Widget extends \Elementor\Widget_Base {


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
        return 'rt-marquee';
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
        return esc_html__('RT Marquee', 'rtelements');
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
        return ['logo', 'clients', 'brand', 'parnter', 'image'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'logo_list_section',
            [
                'label' => esc_html__( 'Logo List', 'rtelements' ),
            ]
        );        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Marquee Text', 'rtelements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Website', 'rtelements'),
                'label_block' => true
            ]
        );        
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Separator Icon', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );        
        $this->add_control(
            'logo_list',
            [
                'label' => esc_html__( 'Repeater List', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => esc_html__( 'Website', 'rtelements' ),
                    ],
                ],
                'title_field' => '{{{ text }}}', 
            ]
        );      
        $this->add_control(
			'select_animate_style',
			[
				'label' => esc_html__( 'Animate Style', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Left', 'rtelements' ),
					'right' => esc_html__( 'Right', 'rtelements' ),
				],
			]
		);
        $this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Spped Time', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::NUMBER,	
                'default' => 40			
			]
		);
        $this->end_controls_section();  
        
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
		    'text-color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .title' => 'color: {{VALUE}} !important;',
		        ],
		    ]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => 'text_typo',
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
		    'text-padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'text-margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
        $this->end_controls_section();  

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'rtelements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
		    'icon-color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .title .icon svg path' => 'fill: {{VALUE}} !important;',
		            '{{WRAPPER}} .title .icon i' => 'color: {{VALUE}} !important;',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 18,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .title .icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
		$this->add_responsive_control(
		    'icon-padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon-margin',
		    [
		        'label' => esc_html__( 'Margin', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

        $this->end_controls_section();  
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $animate_direction = ($settings['select_animate_style'] == 'right') ? "v__2" : '';        
    ?>
        
        <div class="single__marque__item <?php echo esc_attr($animate_direction); ?>">
            <ul class="single__marque__item__list">
                <?php
                    foreach ($settings['logo_list'] as $items) :                       
                        if(!empty($items['text'])) : ?>
                            <li class="single__marque__item__list__text title"><?php echo wp_kses_post($items['text']);  ?>                               
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $items['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </li>
                            <?php 
                        endif; ?>
                        <?php 
                    endforeach; 
                ?>                    
            </ul>
            <ul class="single__marque__item__list">
                <?php
                    foreach ($settings['logo_list'] as $items) :                       
                        if(!empty($items['text'])) : ?>
                            <li class="single__marque__item__list__text title"><?php echo wp_kses_post($items['text']);  ?>                               
                                <span>
                                    <?php \Elementor\Icons_Manager::render_icon( $items['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </li>
                            <?php 
                        endif; ?>
                        <?php 
                    endforeach; 
                ?>                    
            </ul>
        </div>   
    <?php
    }
}
