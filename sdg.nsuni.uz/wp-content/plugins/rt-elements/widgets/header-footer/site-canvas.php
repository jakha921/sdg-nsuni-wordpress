<?php use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Site Logo widget
 *
 * HFE widget for Site Logo.
 *
 * @since 1.3.0
 */
class RTS_Offcanvas extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'site-off-canvas';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site OffCanvas', 'rtelements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-bar';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'header_footer_rts' ];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Canvas Settings', 'rtelements'),
            ]
        );

        $this->add_control(
            'layout_settings',
            [
                'label'     => __( 'Layout', 'rtelements'),
                'type'      => \Elementor\Controls_Manager::HEADING,               
                
            ]
        );
        $this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Select Layout', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Layout 1', 'rtelements'),
					'2'  => esc_html__( 'Layout 2', 'rtelements'),					
				],
			]
		);
 		$this->add_control(
            'icon_settings',
            [
                'label'     => __( 'Icon Settings', 'rtelements'),
                'type'      => \Elementor\Controls_Manager::HEADING,               
                
            ]
        );

        $this->add_control(
            'dot_icon_color',
            [
                'label'     => __( 'Off Canvas Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '{{WRAPPER}} svg path' => 'fill: {{VALUE}}', 
                ],
                'condition' => [
                	'layout' => '2',
                ],
                
            ]
        );
		$this->add_control( 
            'sticky_dot_icon_color',
            [
                'label'     => __( 'Sticky Off Canvas Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    'header.sticky-header ul.offcanvas-icon .nav-link-container a svg path' => 'fill: {{VALUE}} !important', 
                ],
                'condition' => [
                	'layout' => '2',
                ],
                
            ]
        );

        $this->add_control(
            'bar_icon_color',
            [
                'label'     => __( 'Off Canvas Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '{{WRAPPER}} .offcanvas-icon .nav-link-container .nav-menu-link span' => 'background: {{VALUE}}', 
                ],
                'condition' => [
                	'layout' => '1',
                ],
                
            ]
        );

		$this->add_control(
            'dot_icon_color_hover',
            [
                'label'     => __( 'Off Canvas Icon Hover Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .nav-menu-link:hover svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .nav-menu-link:hover svg path' => 'fill: {{VALUE}}',
                
                ],
                'separator' => 'before',
                
            ]
        );
        $this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Off Canvas Icon Box Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Off Canvas Icon Box Height', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon__size',
			[
				'label' => esc_html__( 'Icon Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],				
				'selectors' => [
					'{{WRAPPER}} .offcanvas-icon .nav-link-container .nav-menu-link svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dot_icon_color_box',
            [
                'label'     => __( 'Off Canvas Icon Box BG', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'background: {{VALUE}}',
                ],
                
            ]
        );

        $this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label'              => __( 'Border Radius', 'rtelements' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);

        $this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				
				'toggle' => true,
				'selectors' => [
				    '{{WRAPPER}} .offcanvas-icon.layout-2 .nav-menu-link' => 'text-align: {{VALUE}}'
				],
			]
		);

        $this->add_control(
            'content_settings',
            [
                'label'     => __( 'Content Area Settings', 'rtelements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',               
            ]
        );

       
        $this->add_group_control(
        	\Elementor\Group_Control_Background::get_type(),
        	[
        		'name' => 'background',
        		'label' => esc_html__( 'Background', 'rtelements' ),
        		'types' => [ 'classic', 'gradient', 'video' ],
        		'selector' => '.menu-wrap-off',
        				
        		]
        );

        $this->add_control(
            'close_icon_settings',
            [
                'label'     => __( 'Close Icon Settings', 'rtelements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
                
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label'     => __( 'Close Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'color: {{VALUE}}',
                ],
                
            ]
        );
         $this->add_control(
            'close_icon_bg',
            [
                'label'     => __( 'Close Icon Background', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'background: {{VALUE}}',
                ],
                
            ]
        );

		$this->add_control(
            'responsive_settings',
            [
                'label'     => __( 'Responsive Menu Color Settings', 'rtelements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
                
            ]
        );

        $this->add_control(
            'menu_icon',
            [
                'label'     => __( 'Menu Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '#mobile_menu .submenu-button' => 'color: {{VALUE}}',
                ],
                
            ]
        );

		$this->add_control(
            'menu_icon_bg',
            [
                'label'     => __( 'Menu Icon Bg', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '#mobile_menu .submenu-button' => 'background: {{VALUE}}',
                ],
                
            ]
        );
         $this->add_control(
            'menu_text',
            [
                'label'     => __( 'Menu Text Hover Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '.sidenav .widget_nav_menu ul li a:hover' => 'color: {{VALUE}}',
					'.sidenav .widget_nav_menu ul li.current-menu-item a' => 'color: {{VALUE}}',
                ],
                
            ]
        );
	
	}
	
	protected function render() {		
		$settings = $this->get_settings_for_display(); ?>
		<div class="sidebarmenu-area text-right desktop">			
			<ul class="offcanvas-icon layout-<?php echo $settings['layout'];?>">
				<li class="nav-link-container "> 
					<a aria-label="off canvas" href='#' class="nav-menu-link menu-button">
						<?php if($settings['layout'] == '2'){ ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="17" viewBox="0 0 22 18" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 0.25H21.5V2H0.5V0.25ZM0.5 16H21.5V17.75H0.5V16ZM21.5 5.5H0.5V7.25H21.5V5.5ZM0.5 10.75H21.5V12.5H0.5V10.75Z" fill="#890C25"/>
</svg>
						<?php } else{ ?> 
							<span class="dot1"></span>
							<span class="dot2"></span>
							<span class="dot3"></span>
							<span class="dot4"></span>
							<span class="dot5"></span>
							<span class="dot6"></span>
							<span class="dot7"></span>
							<span class="dot8"></span>
							<span class="dot9"></span>
						<?php } ?>                                         
					</a> 
				</li>
			</ul>		
		</div>
	<?php
	}

}