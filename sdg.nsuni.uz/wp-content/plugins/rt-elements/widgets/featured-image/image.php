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

class Reactheme_Featured_Image_Showcase_Widget extends \Elementor\Widget_Base {
    /**    
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

     public function get_name() {
        return 'rt-featured-img';
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
        return esc_html__( 'RT Featured Image', 'rtelements' );
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
                    '{{WRAPPER}} .react-featured-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'react_image_size',
            [
                'label' => esc_html__( 'Image Size', 'rtelements' ),
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
					'{{WRAPPER}} .react-featured-image img' => 'width: {{SIZE}}{{UNIT}};',
				],                  
            ]
        ); 
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 
        ?>
        <div class="react-featured-image">
            <?php the_post_thumbnail(); ?>
        </div>

        <?php
    } 
}
