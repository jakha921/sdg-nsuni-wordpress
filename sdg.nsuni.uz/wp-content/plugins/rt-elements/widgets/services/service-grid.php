<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

defined('ABSPATH') || die();

class Reactheme_Elementor_Sservices_Grid_Widget extends \Elementor\Widget_Base
{


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
	public function get_name()
	{
		return 'rt-service-grid';
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
	public function get_title()
	{
		return esc_html__('RT Services', 'rtelements');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'glyph-icon flaticon-support';
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
	public function get_categories()
	{
		return ['pielements_category'];
	}


	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'service_general_content',
			[
				'label' => esc_html__('General', 'rtelements')
			]
		);
		$this->add_control(
			'select_style',
			[
				'label'     => esc_html__('Select Style', 'rtelements'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					'style1'      => esc_html__('Style 1', 'rtelements'),
					'style2'      => esc_html__('Style 2', 'rtelements'),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'service_content',
			[
				'label' => esc_html__('Content', 'rtelements')
			]
		);		
		$this->add_control(
			'service_title',
			[
				'label' => esc_html__('Title', 'rtelements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Student Life', 'rtelements'),
				'placeholder' => esc_html__('Type your title here', 'rtelements'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'service_text',
			[
				'label' => esc_html__('Description', 'rtelements'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('Building a vibrant community of creative and accomplished people from around.', 'rtelements'),
				'placeholder' => esc_html__('Type your description here', 'rtelements'),
				'condition' => [
					'select_style' => ['style1']
				]
			]
		);
		$this->add_control(
			'service_bg',
			[
				'label' => esc_html__('Choose Image', 'rtelements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'service-button-area',
			[
				'label' => esc_html__('Button', 'rtelements')
			]
		);		
		$this->add_control(
			'service_icon',
			[
				'label' => esc_html__('Button Icon', 'rtelements'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'service_link',
			[
				'label' => esc_html__('Link', 'rtelements'),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'rtelements' ),
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
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .title a span svg' => 'width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .button svg' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);		
		$this->end_controls_section();

		// ===============================Style============================================//
		$this->start_controls_section(
			'services_style_box',
			[
				'label' => esc_html__('Box', 'rtelements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'service_box_tabs'
		);
		
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'rtelements' ),
			]
		);
			$this->add_control(
				'servcie_box_color',
				[
					'label' => esc_html__('Background Color', 'rtelements'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item_box' => 'background: {{VALUE}}',				
					],
				]
			);			
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'box-border',
					'selector' => '{{WRAPPER}} .item_box',
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_box_shadow',
					'selector' => '{{WRAPPER}} .rts-single-service-solar-energy',
				]
			);
			$this->add_responsive_control(
				'servcie_box_border_radius',
				[
					'label'      => __('Border Radius', 'rtelements'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .item_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'servcie_box_padding',
				[
					'label'      => __('Padding', 'rtelements'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .item_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_responsive_control(
				'servcie_box_margin',
				[
					'label'      => __('Margin', 'rtelements'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .item_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_box_tab',
			[
				'label' => esc_html__( 'Hover', 'rtelements' ),
			]
		);
		$this->add_control(
			'servcie_box_hover_color',
			[
				'label' => esc_html__('Background Color', 'rtelements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover' => 'background: {{VALUE}}',				
				],
			]
		);			
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box-hover_border',
				'selector' => '{{WRAPPER}} .item_box:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_hover_shadow',
				'selector' => '{{WRAPPER}} .rts-single-service-solar-energy:hover',
			]
		);
		$this->add_responsive_control(
			'servcie_box_hover_border_radius',
			[
				'label'      => __('Border Radius', 'rtelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .item_box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'servcie_box_hover_padding',
			[
				'label'      => __('Padding', 'rtelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .item_box:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'servcie_box_hover_margin',
			[
				'label'      => __('Margin', 'rtelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .item_box:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'services_style_title',
			[
				'label' => esc_html__('Title', 'rtelements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'rtelements'),
				'name'     => 'services_style_title_typ',
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_control(
			'services_style_title_color',
			[
				'label'     => esc_html__('Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'services_style_title_colorhc',
			[
				'label'     => esc_html__('Hover Color (Box)', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover .title a' => 'color: {{VALUE}};',					
				],
			]
		);
		$this->add_control(
			'services_hover_border_color',
			[
				'label'     => esc_html__('Hover Border Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover .title a::before' => 'background: {{VALUE}};',					
				],
				'condition' => [
					'select_style' => ['style2']
				]
			]
		);
		$this->add_responsive_control(
			'services_style_title_margin',
			[
				'label' => esc_html__('Margin', 'rtelements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'services_style_title_padding',
			[
				'label'      => __('Padding', 'rtelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'services_style_desc',
			[
				'label' => esc_html__('Description', 'rtelements'),
				'tab'   => Controls_Manager::TAB_STYLE,				
				'condition' => [
					'select_style' => ['style1']
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'rtelements'),
				'name'     => 'services_style_desc_typ',
				'selector' => '{{WRAPPER}} .des',

			]
		);
		$this->add_control(
			'services_style_desc_color',
			[
				'label'     => esc_html__('Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .des' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'services_style_desc_hover_color',
			[
				'label'     => esc_html__('Hover Color (Box)', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover .des' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'services_style_desc_margin',
			[
				'label' => esc_html__('Margin', 'rtelements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'services_style_desc_padding',
			[
				'label'      => __('Padding', 'rtelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'services_style_btn_normal',
			[
				'label' => esc_html__('Button', 'rtelements'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_style' => ['style1']
				]
			]
		);
		$this->add_control(
			'service_icon_box_hover',
			[
				'label'     => esc_html__('Box Hover Icon Style', 'rtelements'),
				'type'      => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'service_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .button svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_bhover_color',
			[
				'label'     => esc_html__('Icon Hover Color (box)', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover .button i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_border_color',
			[
				'label'     => esc_html__('Border Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_bhover_border_color',
			[
				'label'     => esc_html__('Border Hover Color (Box)', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_box:hover .button' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_hover_style',
			[
				'label'     => esc_html__('Icon Hover Style', 'rtelements'),
				'type'      => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'service_icon_hover_color',
			[
				'label'     => esc_html__('Icon Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .button:hover svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_hover_bg',
			[
				'label'     => esc_html__('Background Color', 'rtelements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button:hover' => 'background: {{VALUE}};',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$img_alt = !empty($settings['service_bg']['alt']) ? $settings['service_bg']['alt'] : 'Image';
		
		if( $settings['select_style'] == 'style1' ) : ?>
			<div class="campus__life--single item_box">
				<?php if(!empty($settings['service_bg']['url'])) : ?>
					<div class="campus__life--single--bg">
						<img src="<?php echo esc_url($settings['service_bg']['url']); ?>" alt="<?php echo esc_attr($img_alt); ?>">
					</div>
					<?php 
				endif; ?>
				<div class="campus__life--single--flex">
					<div class="campus__life--single--content">
						<?php if(!empty($settings['service_title'])) : ?>
							<h4 class="campus__life--single--title title"><a aria-label="service" href="<?php echo esc_url($settings['service_link']['url']); ?>"><?php echo wp_kses_post($settings['service_title']); ?></a></h4>
							<?php 
						endif;

						if(!empty($settings['service_text'])) : ?>
							<p class="campus__life--single--description des"><?php echo wp_kses_post($settings['service_text']); ?></p>
							<?php 
						endif; ?>					
					</div>

					<?php if (!empty($settings['service_icon']['value'])) :   ?>
						<div class="campus__life--single--button">
							<a aria-label="service" class="button" href="<?php echo esc_url($settings['service_link']['url']); ?>"><?php \Elementor\Icons_Manager::render_icon($settings['service_icon'], ['aria-hidden' => 'true']); ?></a>
						</div>					
					<?php endif ?>
				</div>
			</div> 		
			<?php 
		elseif( $settings['select_style'] == 'style2' ) : ?>				
			<div class="campus__single--item item_box">
				<?php if(!empty($settings['service_bg']['url'])) : ?>
					<a aria-label="service" href="<?php echo esc_url($settings['service_link']['url']); ?>">
						<div class="campus__single--item--thumb">
							<img src="<?php echo esc_url($settings['service_bg']['url']); ?>" alt="<?php echo esc_attr($img_alt); ?>">
						</div>
					</a>
					<?php 
				endif; 				
				if(!empty($settings['service_title'])) : ?>
					<h5 class="campus__single--item--title title"><a aria-label="service" href="<?php echo esc_url($settings['service_link']['url']); ?>"><?php echo wp_kses_post($settings['service_title']); ?> <span><?php \Elementor\Icons_Manager::render_icon($settings['service_icon'], ['aria-hidden' => 'true']); ?></span></a></h5>
					<?php 
				endif; ?>
			</div>	
			<?php 
		else: ?>
			<div class="campus__life--single item_box">
				<?php if(!empty($settings['service_bg']['url'])) : ?>
					<div class="campus__life--single--bg">
						<img src="<?php echo esc_url($settings['service_bg']['url']); ?>" alt="<?php echo esc_attr($img_alt); ?>">
					</div>
					<?php 
				endif; ?>
				<div class="campus__life--single--flex">
					<div class="campus__life--single--content">
						<?php if(!empty($settings['service_title'])) : ?>
							<h4 class="campus__life--single--title title"><a aria-label="service" href="<?php echo esc_url($settings['service_link']['url']); ?>"><?php echo wp_kses_post($settings['service_title']); ?></a></h4>
							<?php 
						endif;

						if(!empty($settings['service_text'])) : ?>
							<p class="campus__life--single--description des"><?php echo wp_kses_post($settings['service_text']); ?></p>
							<?php 
						endif; ?>					
					</div>

					<?php if (!empty($settings['service_icon']['value'])) :   ?>
						<div class="campus__life--single--button">
							<a aria-label="service" class="button" href="<?php echo esc_url($settings['service_link']['url']); ?>"><?php \Elementor\Icons_Manager::render_icon($settings['service_icon'], ['aria-hidden' => 'true']); ?></a>
						</div>					
					<?php endif ?>
				</div>
			</div> 
			<?php 
		endif; 
		
	}
}

?>