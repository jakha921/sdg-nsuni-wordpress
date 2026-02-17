<?php

include 'helper.php';
   
/**
 * breadrumb Widget
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class ReacTheme_Breadrumb_Widget extends \Elementor\Widget_Base {

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
        return 'rtbreadrumb';
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
        return esc_html__( 'RT Breadrumb', 'pielements' );
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
        return 'glyph-icon flaticon-ballot-box';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'breadrumb_section',
            [
                'label' => esc_html__( 'Content', 'pielements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
			'breadrumb_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Height', 'pielements' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
				'selectors' => [
					'{{WRAPPER}} .reactheme-breadcrumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'breadrumb_inner_with',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Inner Width', 'pielements' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'custom_home_title',
            [
                'label'       => esc_html__( 'Custom Home Title', 'pielements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
            ]
        ); 
        $this->add_control(
            'custom_title',
            [
                'label'       => esc_html__( 'Custom Title', 'pielements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
            ]
        );   
        $this->add_control(
            'custom_path',
            [
                'label'       => esc_html__( 'Custom Path Title', 'pielements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
            ]
        );        

        $this->add_control(
			'separator_icon',
			[
				'label' => esc_html__( 'Separator Icon', 'pielements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
			]
		); 
        $this->add_control(
            'search_custom_title',
            [
                'label'       => esc_html__( 'Search Page Title', 'pielements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
                'default'     => esc_html__( 'Search Result', 'pielements' ),
            ]
        );  
        $this->add_control(
            'search_result_title',
            [
                'label'       => esc_html__( 'Search Result Title', 'pielements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
                'default'     => esc_html__( 'Search Results for:', 'pielements' ),
            ]
        );  
        $this->end_controls_section();

        $this->start_controls_section(
            'breadrumb_container_style',
            [
                'label' => esc_html__( 'Container', 'pielements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );           
        $this->add_responsive_control(
			'content_align',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'pielements' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'pielements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'pielements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'pielements' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet' ],
				'prefix_class' => 'content-align-%s',
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .page-title' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path' => 'text-align: {{VALUE}}',
                ],
			]
		);
        $this->add_control(
            'breadrumb_bg_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Background', 'pielements' ),
                'separator' => 'before',               
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'breadcrumb_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .reactheme-breadcrumb',
			]
		);
        $this->add_control(
            'breadrumb_bg_overlay_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Background Overlay', 'pielements' ),
                'separator' => 'before',               
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'breadcrumb_background_overlay',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .reactheme-breadcrumb:before',
			]
		);
        $this->add_responsive_control(
            'breadrumb_padding',
            [
                'label' => esc_html__( 'Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'breadcrumb_inner_pading',
            [
                'label' => esc_html__( 'Inner Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();


        
        $this->start_controls_section(
            'breadrumb_title_style',
            [
                'label' => esc_html__( 'Title', 'pielements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );          
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'pielements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .page-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'pielements' ),
                'selector' => '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .page-title',
            ]
        );        
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .page-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .page-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'breadrumb_path_style',
            [
                'label' => esc_html__( 'Path', 'pielements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );          
        $this->add_control(
            'path_color',
            [
                'label' => esc_html__( 'Path Color', 'pielements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'path_typography',
                'label' => esc_html__( 'Typography', 'pielements' ),
                'selector' => '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path a',
            ]
        );

        $this->add_responsive_control(
            'path_padding',
            [
                'label' => esc_html__( 'Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'path_margin',
            [
                'label' => esc_html__( 'Margin', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-path' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(  
            'breadrumb_separtor_style',
            [
                'label' => esc_html__( 'Separtor', 'pielements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );          
        $this->add_responsive_control(
			'separtor_size',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Size (For Svg)', 'pielements' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'separtor_color',
            [
                'label' => esc_html__( 'Separtor Color', 'pielements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'separtor_typography',
                'label' => esc_html__( 'Typography', 'pielements' ),
                'selector' => '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor a i',
            ]
        );

        $this->add_responsive_control(
            'separtor_padding',
            [
                'label' => esc_html__( 'Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'separtor_margin',
            [
                'label' => esc_html__( 'Margin', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .reactheme-breadcrumb .breadcrumb-inner .breadcrumb-separtor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();

    }
  
    protected function render() {

        $settings = $this->get_settings_for_display();          
        $custom_home_title = $settings['custom_home_title'];     
        $custom_title = $settings['custom_title'];     
        $custom_path = $settings['custom_path'];     
        $separator_icon = $settings['separator_icon'];
        $search_custom_title = $settings['search_custom_title'];
        $search_result_title = $settings['search_result_title'];

        echo get_rt_breadcrumb($custom_title, $custom_path, $separator_icon, $custom_home_title, $search_custom_title,$search_result_title);
        
    }
}
