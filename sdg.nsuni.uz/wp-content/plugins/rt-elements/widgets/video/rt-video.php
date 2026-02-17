<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined('ABSPATH') || die();

class Reactheme_Elementor_Video_Widget extends \Elementor\Widget_Base
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
		return 'react-video';
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
		return __('RT Video', 'rtelements');
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
		return 'glyph-icon flaticon-multimedia';
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
		return ['rtelements_category'];
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
	public function get_keywords()
	{
		return ['video'];
	}



	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_counter',
			[
				'label' => esc_html__('Content', 'rtelements'),
			]
		);
		$this->add_control(
			'popup_video',
			[
				'label' => esc_html__( 'Video Popup', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'yes' => esc_html__( 'Yes', 'rtelements' ),
				'no' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__('Enter Link Here', 'rtelements'),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__('Video link here', 'rtelements'),
				'condition' => ['popup_video' => 'yes']
			]
		);
		$this->add_control(
			'rotate_text',
			[
				'label' => esc_html__('Rotate Text', 'rtelements'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'rtelements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'rtelements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'rtelements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'rtelements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'rtelements'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default'     => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .react-video' => 'text-align: {{VALUE}}'
				],
			]
		);		
		$this->add_control(
			'rotate_off',
			[
				'label' => esc_html__( 'Rotate', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'yes' => esc_html__( 'Yes', 'rtelements' ),
				'no' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'video_icon',
			[
				'label' => esc_html__( 'Video Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Content', 'rtelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_area_style',
			[
				'label' => esc_html__('Content Area Style', 'rtelements'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);	
		$this->add_control(
			'content_area_bg_color',
			[
				'label' => esc_html__('Background Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_area_width',
			[
				'label' => esc_html__('Width', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'content_area_height',
			[
				'label' => esc_html__('Height', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_area_line_height',
			[
				'label' => esc_html__('Line Height', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);		
		$this->add_responsive_control(
			'content_area_align',
			[
				'label' => esc_html__('Alignment', 'rtelements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'rtelements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'rtelements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'rtelements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'rtelements'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2' => 'text-align: {{VALUE}}'
				],
			]
		);	
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_area_border',
		        'selector' => '{{WRAPPER}} .rts__circle.v__2',
		    ]
		);
		$this->add_control(
		    'content_area_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rts__circle.v__2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		$this->add_control(
		    'content_area_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rts__circle.v__2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',       
		        ],
		    ]
		);
		

		$this->add_control(
			'title_style',
			[
				'label' => esc_html__('Rotate Text Style', 'rtelements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rts__circle.v__2 text textPath' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_rotate_text',
				'selector' => '{{WRAPPER}} .rts__circle.v__2 text textPath',

			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__('Icon', 'rtelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-video .video-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react-video .video-icon svg path' => 'fill: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'rtelements'),
				'name' => 'typography_icon',
				'selector' => '{{WRAPPER}} .react-video .video-icon i',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_top_position',
			[
				'label' => esc_html__('Top Position', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-video .video-icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_left_position',
			[
				'label' => esc_html__('Left Position', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-video .video-icon' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'icon_with',
			[
				'label' => esc_html__('Icon Width', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-video .video-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
		$rand = rand(12, 3330);
		$rotate_off = (!empty($settings['rotate_off'] === 'yes') ? 'spinner' : '');
		$popup_video = (!empty($settings['popup_video'] === 'yes') ? 'popup-videos' : 'popup_of');
		$video_link = ($settings['popup_video'] === 'yes') ? 'href="' . esc_url($settings['video_link']) . '"' : '';
		?>

		<div class="react-video video-item-<?php echo esc_attr($rand); ?>">
			<div class="overly-border">
				<div class="banner__content--circle rts__circle v__2">
					<?php if(!empty($settings['rotate_text'])) : ?>
						<svg class="<?php echo esc_attr($rotate_off); ?>" viewBox="0 0 100 100">
							<defs>
								<path id="circle" d="M50,50 m-37,0a37,37 0 1,1 74,0a37,37 0 1,1 -74,0"></path>
							</defs>
							<text>
								<textPath xlink:href="#circle"><?php echo wp_kses_post($settings['rotate_text']); ?></textPath>
							</text>
						</svg>
					<?php 
					endif; ?>

					<a aria-label="video" class="video-icon <?php echo esc_attr($popup_video); ?>" <?php  echo $video_link; ?>>						
						<?php if(!empty($settings['video_icon']['value'])) : ?>	
							<?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php 
						else : ?>
							<i class="fa fa-play"></i>
							<?php 
						endif; ?>
					</a>
				</div>
				
			</div>
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.popup-videos').magnificPopup({
					disableOn: 10,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
				
			});	

			
		</script>

<?php
	}
}