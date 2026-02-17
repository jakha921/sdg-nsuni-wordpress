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

class Reactheme_Notice_Widget extends \Elementor\Widget_Base {

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
		return 'rt-notice';
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
		return __( 'RT Notice', 'rtelements' );
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
			'notice_category',
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
				'lable_block' => true,
				'separator' => 'before'
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
			'notice_columns',
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
                    '{{WRAPPER}} .single-notice' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		);    						
		$this->end_controls_section();

		$this->start_controls_section(
			'item_box_style',
			[
				'label' => esc_html__( 'Box', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
		$this->add_control(
            'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .notice-list ul .single-notice' => 'background: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice',
			]
		);
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __('Border Radius', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'item_content_style',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-content p a' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice-item .notice-content p a',                    
			]
		);	
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'date_styles',
            [
                'label' => esc_html__( 'Date', 'rtelements' ),
                'type' => Controls_Manager::HEADING,               
            ]
        );
		$this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                           
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'color: {{VALUE}} !important;',                              
                    '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date span' => 'color: {{VALUE}} !important;',                              
                ],                
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Typography', 'rtelements' ),
				
				'selector' => '{{WRAPPER}} .notice-list ul .single-notice-item .notice-date',                    
			]
		);	
		$this->add_responsive_control(
			'date_padding',
			[
				'label'      => __('Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'date_margin',
			[
				'label'      => __('Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .notice-list ul .single-notice-item .notice-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	
	?>
	<div class="notce">
		<div class="row">
			<?php 
				$cat = $settings['notice_category'];
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				if(empty($cat)){
					$best_wp = new wp_Query(array(
							'post_type'      => 'rt-notice',
							'posts_per_page' => $settings['per_page'],								
					));	  
				}   
				else{
					$best_wp = new wp_Query(array(
						'post_type'      => 'rt-notice',
						'posts_per_page' => $settings['per_page'],				
						'tax_query'      => array(
							array(
								'taxonomy' => 'rt-notice-category',
								'field'    => 'slug', //can be set to ID
								'terms'    => $cat //if field is ID you can reference by cat/term number
							),
						)
					));	  
				}

				$x=1;
				$details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'Case Details';
				while($best_wp->have_posts()): $best_wp->the_post();						
					$content       = get_the_content();
					$client        = get_post_meta( get_the_ID(), 'client', true );
					$location      = get_post_meta( get_the_ID(), 'event_location', true );
					$surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
					$created       = get_post_meta( get_the_ID(), 'created', true );
					$date          = get_post_meta( get_the_ID(), 'event_date', true );
					$project_value = get_post_meta( get_the_ID(), 'project_value', true );

					$cats_show = get_the_term_list( $best_wp->ID, 'rt-notice-category', ' ', '<span class="separator">,</span> ');
					$termsArray  = get_the_terms( $best_wp->ID, "rt-notice-category" );  //Get the terms for this particular item
					$termsString = ""; //initialize the string that will contain the terms
					$termsSlug   = "";

					foreach ( $termsArray as $term ) { 
						$termsString .= 'filter_'.$term->slug.' '; 
						$termsSlug .= $term->name;
					}							
				?>
				<div class="col-lg-<?php echo esc_html($settings['notice_columns']);?> col-md-12 col-xs-1 grid-item <?php echo $termsString;?>">
					<div class="notice-list">
						<ul>
							<li class="single-notice">
								<div class="single-notice-item">
									<div class="notice-date">
										<?php echo get_the_date('d'); ?>
										<span><?php echo get_the_date('M'); ?></span>
									</div>
									<div class="notice-content">
										<p>
											<?php 
											$length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '10'; ?>
											<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $length, '' );	?></a>
										</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
					
				<?php
				$x++;	
				endwhile;
				wp_reset_query();  
			?>  
		</div>
	</div>

	<?php 
    }
    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'rt-notice' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'rt-notice-category',
                'hide_empty'  => true            
            ) );
            
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}?>