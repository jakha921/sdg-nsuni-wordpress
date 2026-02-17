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

class RTS_Program_List_Widget extends \Elementor\Widget_Base {

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
        return 'rt-program';
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
        return esc_html__( 'RT Program List', 'rtelements' );
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
            'program_select',
            [
                'label'   => esc_html__('Select Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',
                    'style3' => 'Style 3',
                    'style4' => 'Style 4',
                ],
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
			'_section_header',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);          
        $this->add_control(
            'program_title',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Undergraduate', 'rtelements' ),
                'label_block' => 'true',
                'condition' => [
                    'program_select' => ['style1']
                ]
            ]
        );   
        $this->add_control(
			'bg_img',
			[
				'label' => esc_html__( 'Choose Image', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],                
                'condition' => [
                    'program_select' => ['style1']
                ]
			]
		);
        $this->add_control(
            'program_btn',
            [
                'label' => esc_html__( 'Button', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'rtelements' ),
                'label_block' => 'true',
                'condition' => [
                    'program_select' => ['style2']
                ]
            ]
        ); 
        $this->add_control(
			'program_icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'rt rt-arrow-right-regular',
					'library' => 'rt-icons',
				],
			]
		);
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('Icon Width', 'rtelements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .program-list .program-item span svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .program-list .program-item span i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,                
                'condition' => [
                    'program_select' => ['style1','style2']
                ]
            ]
        );  
        $this->add_control(
            'p-item-active-color',
            [
                'label' => esc_html__( 'Active Color', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rtelements' ),
                'label_off' => esc_html__( 'No', 'rtelements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'program_select' => ['style1','style2']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'List Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .p_item::before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_border',
                'selector' => '{{WRAPPER}} .p_item'                
            ]
        );

       $this->add_responsive_control(
            'program_title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .p_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .p_item'
            ]
        );  
        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .p_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .p_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();   

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'program_select' => ['style1']
                ]
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--title' => 'color: {{VALUE}};',
                ],
            ]
        ); 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .program__single--item--title',
                
            ]
        );  
        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .program__single--item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->end_controls_section(); 

        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Program', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'rtelements' ),
			]
		);
        $this->add_control(
            'list_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list' => 'color: {{VALUE}} ;',
                    '{{WRAPPER}} .program-list .program-item' => 'color: {{VALUE}} ;',
                ],
            ]
        );  
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_bg',
                'label' => esc_html__( 'Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .program__single--item--list--item .link__list',                
                'condition' => [
                    'program_select' => ['style1','style2']
                ]
            ]
        ); 
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_icon_border',
                'selector' => '{{WRAPPER}} .program__single--item--list--item .link__list',
                'condition' => [
                    'program_select' => ['style1','style2']
                ]                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'program3_list_typography',
                'selector' => '{{WRAPPER}} .program-list .program-item',
                                
                'condition' => [
                    'program_select' => ['style3']
                ] 
            ]
        );  
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'program_list_typography',
                'selector' => '{{WRAPPER}} .program__single--item--list--item .link__list',
                                
                'condition' => [
                    'program_select' => ['style1','style2']
                ] 
            ]
        ); 
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item3_border',
                'selector' => '{{WRAPPER}} .program-list .program-item',
                'condition' => [
                    'program_select' => ['style3']
                ]                
            ]
        );
        $this->add_responsive_control(
            'program_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'program_select' => ['style1','style2']
                ]
            ]
        );
        $this->add_responsive_control(
            'list_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .program-list .program-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'list_margin',
            [
                'label' => esc_html__( 'Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .program-list .program-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'list_hover_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .program__single--item--list--item .link__list:hover' => 'color: {{VALUE}} ;',
                    '{{WRAPPER}} .program-list .program-item:hover' => 'color: {{VALUE}} ;',
                ],
            ]
        );  
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_hover_bg',
                'label' => esc_html__( 'Background', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .program__single--item--list--item .link__list:hover',
                'condition' => [
                    'program_select' => ['style1','style2']
                ]
            ]
        ); 
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_icon_hover_border',
                'selector' => '{{WRAPPER}} .program__single--item--list--item .link__list:hover',                
                'condition' => [
                    'program_select' => ['style1','style2']
                ]                
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item3_hover_border',
                'selector' => '{{WRAPPER}} .program-list .program-item:hover',
                'condition' => [
                    'program_select' => ['style3']
                ]                
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $img_alt = !empty($settings['bg_img']['alt']) ? $settings['bg_img']['alt'] : 'Image';   

        $active_bg = ($settings['p-item-active-color'] == 'yes') ? $settings['p-item-active-color'] : '';

        if (  $settings['program_select'] == 'style1' ) {
            include plugin_dir_path(__FILE__) . "/style1.php";
        }elseif ( $settings['program_select'] == 'style2' ) {
            include plugin_dir_path(__FILE__) . "/style2.php";
        }elseif ( $settings['program_select'] == 'style3' ) {
            include plugin_dir_path(__FILE__) . "/style3.php";
        }elseif ( $settings['program_select'] == 'style4' ) {
            include plugin_dir_path(__FILE__) . "/style4.php";
        }else {
            include plugin_dir_path(__FILE__) . "/style1.php";
        }
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
