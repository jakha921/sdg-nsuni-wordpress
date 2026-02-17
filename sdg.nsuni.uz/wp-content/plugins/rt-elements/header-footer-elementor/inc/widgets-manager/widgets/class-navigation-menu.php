<?php
namespace Rts_HFE\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Rts__Navigation_Menu extends Widget_Base {
	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	public function get_name() {
		return 'navigation-menu';
	}

	public function get_title() {
		return __( 'Navigation Menu', 'back' );
	}

	public function get_icon() {
		return 'rts-icon-navigation-menu';
	}

	public function get_categories() {
		return [ 'rts-widgets' ];
	}

	/**
	 * Retrieve the list of scripts the navigation menu depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'rts-frontend-js' ];
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
	}

	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'back' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'back' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'back' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'back' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}


		$current_theme = wp_get_theme();


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'nav_border_',
				'selector' => '{{WRAPPER}} .rts-horizental-menu ul > li > a',
			]
		);

		$this->add_control(
			'show_icon_menu',
			[
				'label' => esc_html__( 'Show Menu Icon', 'back' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'back' ),
				'label_off' => esc_html__( 'Hide', 'back' ),
				'default' => 'no'
			]
		);

		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'back' ),
				]
			);

			$this->add_control(
				'Rts__menu_layout',
				[
					'label'   => __( 'Layout', 'back' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'rts-horizental-menu',
					'options' => [
						'rts-horizental-menu' => __( 'Horizontal', 'back' ),
						'rts-vertical-menu'   => __( 'Vertical', 'back' ),
					]					 
				]
			);


		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'back' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					[
						'label' => __( 'Normal', 'back' ),
					]
				);

				$this->add_control(
					'color_menu_item',
					[
						'label'     => __( 'Text Color', 'back' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .rts-horizental-menu ul > li > a, {{WRAPPER}} .rts-vertical-menu ul > li > a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'main_item_typography',
						'separator' => 'before',
						'selector'  => '{{WRAPPER}} .rts-horizental-menu ul > li > a, {{WRAPPER}} .rts-vertical-menu ul > li > a',
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'back' ),
					]
				);

				$this->add_control(
					'color_menu_item_hover',
					[
						'label'     => __( 'Text Color', 'back' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rts-horizental-menu ul > li:hover > a, {{WRAPPER}} .rts-vertical-menu ul > li > a:hover' => 'color: {{VALUE}}',
						],
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'back' ),
					]
				);

				$this->add_control(
					'color_menu_item_active',
					[
						'label'     => __( 'Text Color', 'back' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .rts-horizental-menu ul li.current-menu-ancestor a, {{WRAPPER}} .rts-horizental-menu ul li.current_page_item a, {{WRAPPER}} .rts-vertical-menu ul li.current_page_item a' => 'color: {{VALUE}}',
						],
					]
				);

			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
			    'menu_item__padding_',
			    [
			        'label' => esc_html__( 'Padding', 'back' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', 'em', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .rts-horizental-menu ul > li > a, {{WRAPPER}} .rts-vertical-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_responsive_control(
	            'menu_item__margin_',
	            [
	                'label' => esc_html__( 'Margin', 'back' ),
	                'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', 'em', '%' ],
	                'condition' => ['Rts__menu_layout' => 'rts-vertical-menu'],
	                'selectors' => [
	                    '{{WRAPPER}} .rts-vertical-menu ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'menu_border_ver',
					'selector' => '{{WRAPPER}} .rts-vertical-menu ul > li + li',
					'condition' => ['Rts__menu_layout' => 'rts-vertical-menu']
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'back' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => ['Rts__menu_layout' => 'rts-horizental-menu'],
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_item_style' );

			$this->start_controls_tab(
				'tab_dropdown_item_normal',
				[
					'label' => __( 'Normal', 'back' ),
				]
			);

			$this->add_control(
				'color_dropdown_item',
				[
					'label'     => __( 'Text Color', 'back' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .rts-horizental-menu ul li ul.sub-menu li a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_dropdown_item_hover',
				[
					'label' => __( 'Hover', 'back' ),
				]
			);

			$this->add_control(
				'color_dropdown_item_hover',
				[
					'label'     => __( 'Text Color', 'back' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .rts-horizental-menu ul li ul.sub-menu li:hover > a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_dropdown_item_active',
				[
					'label' => __( 'Active', 'back' ),
				]
			);

			$this->add_control(
				'color_dropdown_item_active',
				[
					'label'     => __( 'Text Color', 'back' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .rts-horizental-menu ul li ul.sub-menu li.current-menu-ancestor > a, {{WRAPPER}} .rts-horizental-menu ul li ul.sub-menu li.current_page_item > a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'separator' => 'before',
					'selector'  => '{{WRAPPER}} .rts-horizental-menu ul ul.sub-menu li a',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} .rts-horizental-menu ul li + li',
				]
			);


			$this->add_responsive_control(
			    'vertical__padding_area',
			    [
			        'label' => esc_html__( 'Padding', 'back' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', 'em', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .rts-horizental-menu ul li ul.sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);			
		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 * @since 1.5.2
	 * @param string $atts link attributes.
	 * @access public
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 * @since 1.6.0
	 * @param string $value link attributes.
	 * @access public
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render() {

		$menus = $this->get_available_menus();

		if ( empty( $menus ) ) {
			return false;
		}

		$settings = $this->get_settings_for_display();

		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'rts-nav-menu-elementor',
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallRts_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => new Menu_Walker,
		];
		$menu_html = wp_nav_menu( $args );
		$menu_layout = ('rts-vertical-menu' === $settings['Rts__menu_layout']) ? $settings['Rts__menu_layout'] : 'rts-horizental-menu' ; 
		$show_icon_menu = ($settings['show_icon_menu'] == 'yes') ? 'rts-menu-icon-on' : 'rts-menu-icon-off' ;
		?>
		<div class="<?php echo $menu_layout; ?> <?php echo esc_attr($show_icon_menu); ?>">
			<nav>
				<?php 
					global $post;  
					$value = get_post_meta($post->ID, 'Rts_custom_meta_key', true);
					if ($value == 'on') {
					    wp_nav_menu( array(
					        'theme_location' => 'menu-2',
					        'menu_id'        => 'primary-menu-single',
					    ) );
					} else {
					   echo $menu_html;
					}
				?>
			</nav>
			<?php if('rts-horizental-menu' === $settings['Rts__menu_layout']){ ?>
				<span class="rts-humbarger-close-menu rts-canvas-icon"> <i class="ri-menu-3-line"></i> </span>
			<?php } ?>
		</div>
		<?php		
	}
}

