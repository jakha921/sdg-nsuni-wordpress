<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
defined( 'ABSPATH' ) || die();
class Rsaddon_Elementor_Languages_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *    
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rt-languages';
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
        return esc_html__( 'RT Languages', 'rtelements' );
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
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {

    $this->start_controls_section(
        '_section_content',
        [
            'label' => esc_html__( 'Languages', 'rtelements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );
    $this->add_control(
        'lang-title',
        [
            'label' => esc_html__( 'Label', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'English', 'rtelements' ),
            'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
        ]
    );
        // Define the repeater control
    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'features_title',
        [
            'label' => esc_html__( 'Title', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'English' , 'rtelements' ),
            'label_block' => true,
        ]
    );
    $repeater->add_control(
        'features_url',
        [
            'label' => esc_html__( 'URL', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::URL,
            'options' => [ 'url', 'is_external', 'nofollow' ],
            'default' => [
                'url' => '#en',
            ],
            'label_block' => true,
        ]
    );
    // Add the repeater to your widget
    $this->add_control(
        'list',
        [
            'label' => esc_html__( 'Languages List', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'features_title' => esc_html__( 'English', 'rtelements' ),                        
                    'features_url' => '#en',                        
                ],
            ],
            'title_field' => '{{{ features_title }}}',
        ]
    );
    $this->add_control(
        'lang-icon',
        [
            'label' => esc_html__( 'Icon', 'rtelements' ),
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
    $this->add_control(
        'text_color',
        [
            'label' => esc_html__( 'Color', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lang__trigger' => 'color: {{VALUE}}',
                '{{WRAPPER}} .lang__trigger i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .lang__trigger svg path' => 'fill: {{VALUE}}',
            ],
        ]
    );
    $this->add_control(
        'sticky_text_color',
        [
            'label' => esc_html__( 'Sticky Color', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                'header.sticky-header .lang__trigger' => 'color: {{VALUE}} !important',
                'header.sticky-header .lang__trigger i' => 'color: {{VALUE}} !important',
                'header.sticky-header .lang__trigger svg path' => 'fill: {{VALUE}} !important',
            ],
        ]
    );
    $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display(); ?> 
            <div id="langSwitcher" class="lang__trigger">
                <span class="selected__lang"><?php echo wp_kses_post($settings['lang-title']); ?></span>               
                <?php if(!empty($settings['lang-icon']['value'])) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['lang-icon'], [ 'aria-hidden' => 'true' ] );
                   else:  ?>
                    <i class="rt rt-circle-user-regular"></i> 
                    <?php
                endif; ?>
                <div class="translate__lang">
                    <ul>
                        <?php foreach( $settings['list'] as $items ) : ?>
                            <li><a aria-label="language" href="<?php echo esc_url($items['features_url']['url']); ?>"><?php echo esc_html($items['features_title']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php  
    }
}