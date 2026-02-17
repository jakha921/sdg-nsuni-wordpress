<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Reactheme_Faculty_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-faculty-grid';
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
		return __( 'RT Faculty Grid', 'rtelements' );
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
		return 'glyph-icon flaticon-grid';
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
	 * Register rsgallery widget controls.
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
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'faculty_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
				],											
			]
		);
		$this->add_control(
			'faculty_category',
			[
				'label'   => esc_html__( 'Category', 'rtelements' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
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

		$this->add_control(
            'title_word_count',
            [
                'label' => esc_html__('Title Word Count', 'rtelements'),
                'type' => Controls_Manager::NUMBER,
				'condition' => [
					'faculty_grid_style' => '3'
				]

            ]
        );
		$this->add_control(
			'port_link',
			[
				'label' => esc_html__( 'Enable Link', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rtelements' ),
				'label_off' => esc_html__( 'Hide', 'rtelements' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Project Show Per Page', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'faculty_columns',
			[
				'label'   => esc_html__( 'Columns', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-eye',
					'library' => 'fa-solid',
				],
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
                'condition' => ['faculty_grid_style' => ['1']],
			]
		); 
        $this->add_responsive_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rtelements' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],			
				'selectors' => [
                    '{{WRAPPER}} .faculty-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .faculty-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .grid-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .grid-faculty .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}} !important;',
                ],
			]
		);  		
		$this->add_control(
			'read_more_btn',
			[
				'label' => esc_html__( 'Button Text', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your button text here', 'rtelements' ),
				'label_block' => true,
				'separator' => 'before'
			]
		);  			
		$this->end_controls_section();
		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_styles',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'type' => Controls_Manager::HEADING,                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts__faculty--single--meta--title' => 'color: {{VALUE}};',                   
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts__faculty--single--meta--title:hover' => 'color: {{VALUE}};',                                      
                ],                
            ]            
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .rts__faculty--single--meta--title',                    
			]
		);		
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__faculty--single--meta--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rts__faculty--single--meta--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'des_styles',
            [
                'label' => esc_html__( 'Description', 'rtelements' ),
                'type' => Controls_Manager::HEADING,     
				'separator' => 'before'           
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts__faculty--single--meta--excerpt' => 'color: {{VALUE}};',                   
                ],                
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .rts__faculty--single--meta--excerpt',                    
			]
		);		
		$this->add_responsive_control(
			'des_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__faculty--single--meta--excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'des_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .rts__faculty--single--meta--excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
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
	$popup_port_title_color = !empty( $settings['popup_port_title_color']) ? 'style="color: '.$settings['popup_port_title_color'].'"' : '';
	$popup_port_content_color = !empty( $settings['popup_port_content_color']) ? 'style="color: '.$settings['popup_port_content_color'].'"' : '';
	$popup_port_info_color = !empty( $settings['popup_port_info_color']) ? 'style="color: '.$settings['popup_port_info_color'].'"' : '';
	$popup_port_background = !empty( $settings['popup_port_background']) ? 'style="background: '.$settings['popup_port_background'].'"' : '';

	 $team_link = (!empty($settings['port_link'])) ? 'link-en' : 'link-dis' ; ?>

	<div class="rt-faculty-style<?php echo esc_attr($settings['faculty_grid_style']); ?> grid-faculty <?php echo esc_attr($team_link); ?>">
		<div class="grid">
			<div class="row">
			<?php 
				if('1' == $settings['faculty_grid_style']){
					require_once plugin_dir_path(__FILE__)."/style1.php";
				}
				if('2' == $settings['faculty_grid_style']){
					require_once plugin_dir_path(__FILE__)."/style2.php";
				}
				if('3' == $settings['faculty_grid_style']){
					require_once plugin_dir_path(__FILE__)."/style3.php";
				}
			?>
			</div>
		</div>
	</div>

	<?php

	}
public function getCategories(){
    $cat_list = [];
     	if ( post_type_exists( 'rt-faculty' ) ) { 
      	$terms = get_terms( array(
         	'taxonomy'    => 'rt-faculty-category',
         	'hide_empty'  => true            
     	) );
        
        foreach($terms as $post) {
        	$cat_list[$post->slug]  = [$post->name];
        }
	}  
    return $cat_list;
}
}?>