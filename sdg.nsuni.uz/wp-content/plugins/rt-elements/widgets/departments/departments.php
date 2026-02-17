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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class RTS_Department_Widget extends \Elementor\Widget_Base {

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
        return 'rt-department';
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
        return esc_html__( 'RT Departments', 'rtelements' );
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
        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Item Bottom Gap', 'rtelements'),
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
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Content', 'rtelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cat-link-arrow i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cat-link-arrow svg path' => 'fill: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-title:hover a::after' => 'background: {{VALUE}};',
                ],
            ]
        ); 
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .single-cat-item .cat-meta .cat-title a',
                
            ]
        );  
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'text_border',
                'selector' => '{{WRAPPER}} .cat-meta'                
            ]
        );
       $this->add_responsive_control(
            'text_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cat-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single-cat-item .cat-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
			'icon_styles',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow svg path' => 'fill: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow' => 'background: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'icon_hover_bgcolor',
            [
                'label' => esc_html__( 'Hover Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cat-item .cat-meta .cat-link .cat-link-arrow' => 'border-color: {{VALUE}};',
                ],
            ]
        ); 
        $this->end_controls_section(); 
    }



	protected function render() {
        $settings = $this->get_settings_for_display();
        $img_alt = !empty($settings['bg_img']['alt']) ? $settings['bg_img']['alt'] : 'Image';  
        $department_id = get_the_ID();
        ?>

        <div class="row">
            <?php 
            $query_args = array(
                'post_type'      => 'rt-department',
                'posts_per_page' => $settings['per_page'],
            );	
            $best_wp = new WP_Query($query_args);

            while( $best_wp->have_posts() ) : $best_wp->the_post();  ?>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <?php 
                        if(has_post_thumbnail()) : ?>
                            <div class="cat-thumb">
                                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                            </div>
                            <?php 
                        endif; ?>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <div class="cat-link">
                                <a href="<?php the_permalink(); ?>" class="cat-link-arrow"><?php \Elementor\Icons_Manager::render_icon( $settings['program_icon'], [ 'aria-hidden' => 'true' ] ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                    
            <?php 
            endwhile;
            wp_reset_query();
            ?>
        </div>
    <?php 
    }
}
