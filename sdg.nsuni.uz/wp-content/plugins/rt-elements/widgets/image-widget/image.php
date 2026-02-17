<?php
/**
 * Image widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Reactheme_Image_Showcase_Widget extends \Elementor\Widget_Base {
    /**    
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rt-react-image';
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
        return esc_html__( 'RT Image Showcase', 'rtelements' );
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
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    

	protected function register_controls() {
		$this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Image Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 
        $this->add_control(
			'img_select_type',
			[
				'label' => esc_html__( 'Image Animate Type', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__( 'Normal', 'rtelements' ),
					'jarallax' => esc_html__( 'Jarallax', 'rtelements' ),
				],
			]
		);
        $this->add_control(
            'first_image',
            [
                'label' => esc_html__( 'Choose Image', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::MEDIA,     
                'separator' => 'before',
            ]
        ); 

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rtelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rtelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rtelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rtelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
                'condition' => [
                    'img_select_type' => ['normal']
                ]
            ]
        );

        $this->add_control(
            'image_animation_reveal',
            [
                'label' => esc_html__( 'Image Reveal', 'rtelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rtelements' ),
                'label_off' => esc_html__( 'Hide', 'rtelements' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'img_select_type' => ['normal']
                ]
            ]
        ); 


        $this->add_control(
            'image_animation_rotate',
            [
                'label' => esc_html__( 'Image Rotate', 'rtelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rtelements' ),
                'label_off' => esc_html__( 'Hide', 'rtelements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'img_select_type' => ['normal']
                ]
            ]
        ); 

        $this->add_control(
            'image_animation_scale',
            [
                'label' => esc_html__( 'Image Scale', 'rtelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rtelements' ),
                'label_off' => esc_html__( 'Hide', 'rtelements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'img_select_type' => ['normal']
                ]
            ]
        ); 

        $this->add_control(
            'image_animation',
            [
                'label' => esc_html__( 'Animation', 'rtelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rtelements' ),
                'label_off' => esc_html__( 'Hide', 'rtelements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'img_select_type' => ['normal']
                ]
            ]
        );

        $this->add_responsive_control(
            'react_image_width',
            [
                'label' => esc_html__( 'Width', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'selectors' => [
					'{{WRAPPER}} img.react-multi-image' => 'width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .react-jarallax-img' => 'width: {{SIZE}}{{UNIT}} !important;',                   
				],                  
            ]
        ); 
        $this->add_responsive_control(
            'react_image_height',
            [
                'label' => esc_html__( 'Height', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} img.react-multi-image' => 'height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .react-jarallax-img' => 'height: {{SIZE}}{{UNIT}} !important;',                   
				],                  
            ]
        ); 
        $this->add_responsive_control(
            'react_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} img.react-multi-image' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .react-jarallax-img .jarallax-container' => 'border-radius: {{SIZE}}{{UNIT}} !important;',                   
				],                  
            ]
        ); 
        $this->add_control(
            'images_translate',
            [
                'label'   => esc_html__( 'Translate Position', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'veritcal',
                'options' => [                  
                    'veritcal' => esc_html__( 'Veritcal', 'rtelements'),
                    'horizontal' => esc_html__( 'Horizontal', 'rtelements'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_image_duration',
            [

                'label' => esc_html__( 'Animation Duration', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 20,
                   ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .react-image.react-multi-image' => 'animation-duration: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'react_image_animation_start_x',
            [

                'label' => esc_html__( 'Translate X Start', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'horizontal',
                ],
            ]
        );  

        $this->add_responsive_control(
            'react_image_animation_end_x',
            [

                'label' => esc_html__( 'Translate X End', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => -100,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'horizontal',
                ],
            ]
        ); 


        $this->add_responsive_control(
            'react_image_animation_start_y',
            [

                'label' => esc_html__( 'Translate Y Start', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 100,
                   ],
                   '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'veritcal',
                ],
            ]
        );  

        $this->add_responsive_control(
            'react_image_animation_end_y',
            [

                'label' => esc_html__( 'Translate Y End', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => -100,
                       'max' => 100,
                   ],
                   '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'veritcal',
                ],
            ]
        );     
       

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 
        $image_rotate =  !empty($settings['image_animation_rotate']) ? 'image-rotate' : '';
        $image_scale =  !empty($settings['image_animation_scale']) ? 'image-scale' : '';
        ?>
        <?php 
        if($settings['img_select_type'] == 'jarallax') { ?>
            <div data-jarallax class="react-jarallax-img jarallax react-image">
                <?php if(!empty($settings['first_image']['url'])) : ?>
                    <img class="jarallax-img <?php echo esc_attr($settings['images_translate']); ?>" src="<?php echo esc_url($settings['first_image']['url']);?>"/>
                <?php endif; ?>
            </div>
            <?php 

        } else {
            if(!empty($settings['image_animation_reveal'])) {
                if(!empty($settings['first_image']['url'])) : ?>
                <div class="reveal-item overflow-hidden aos-init">
                     <div class="reveal-animation reveal-end reveal-primary aos aos-init" data-aos="reveal-end"></div>
                     <img class="react-multi-image <?php echo esc_attr($settings['images_translate']); ?> " src="<?php echo esc_url($settings['first_image']['url']);?>" alt="<?php echo esc_attr($settings['first_image']['alt']); ?>"/>
                 </div>
                 <?php endif;
             }        
             else {
                 ?>
                     <div class="react-image <?php echo esc_attr($settings['image_animation']); ?>">
                         <?php if(!empty($settings['first_image']['url'])) : ?>
                             <img class="react-multi-image <?php echo esc_attr($settings['images_translate']); ?> <?php echo esc_attr($image_rotate);?> <?php echo esc_attr($image_scale);?>" src="<?php echo esc_url($settings['first_image']['url']);?>" alt="<?php echo esc_attr($settings['first_image']['alt']); ?>"/>
                         <?php endif; ?>
                     </div>
                 <?php
     
             }  
                if(!empty($settings['react_image_animation_start_x']['size'])):
                     $start   = $settings['react_image_animation_start_x']['size'].$settings['react_image_animation_start_x']['unit'];   
                 endif; 
     
                 if(!empty($settings['react_image_animation_end_x']['size'])):         
                 $end     = $settings['react_image_animation_end_x']['size'].$settings['react_image_animation_end_x']['unit'];  
                 endif;
     
                 if(!empty($settings['react_image_animation_start_y']['size'])):          
                 $start_y = $settings['react_image_animation_start_y']['size'].$settings['react_image_animation_start_y']['unit'];  
                 endif; 
     
                 if(!empty($settings['react_image_animation_end_y']['size'])):          
                 $end_y   = $settings['react_image_animation_end_y']['size'].$settings['react_image_animation_end_y']['unit'];
                 endif; 

        }  ?>
       
    <?php
    }
}