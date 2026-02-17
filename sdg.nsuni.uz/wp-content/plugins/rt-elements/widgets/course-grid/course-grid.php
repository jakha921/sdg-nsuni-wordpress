<?php
use Tutor\Models\CourseModel;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class ReacTheme_RT_Course_Grid_Widget extends \Elementor\Widget_Base
{

    /**
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'react-course-grid-tutor';
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
    public function get_title()
    {
        return __('RT Course Grid', 'rtelements');
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
    public function get_icon()
    {
        return 'glyph-icon flaticon-network';
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
    public function get_categories()
    {
        return ['pielements_category'];
    }

    /**
     * Register rsgallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    public function get_selected_post_type(){
        $post_type = $this->get_data()['settings']['post_type'];
        return $post_type;
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label'   => esc_html__('Post Type', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'options'   => $this->rt_get_post_types(),
                'multiple' => false,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'taxonomy',
            [
                'label'   => esc_html__('Taxonomy', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'options'   => $this->rt_get_taxonomies(),
                //'multiple' => true,
                'separator' => 'before',
                'frontend' => true,
            ]
        );
        $this->add_control(
            'cat',
            [
                'label'   => esc_html__('Category', 'rtelements'),
                'type'    => Controls_Manager::SELECT2,
                'options'   => $this->getCategories(),
                'multiple' => true,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'course_col',
            [
                'label'   => esc_html__('Columns', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    '6' => esc_html__('2 Column', 'rtelements'),
                    '4' => esc_html__('3 Column', 'rtelements'),
                    '3' => esc_html__('4 Column', 'rtelements'),
                    '2' => esc_html__('6 Column', 'rtelements'),
                    '12' => esc_html__('1 Column', 'rtelements'),
                ],
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
            'course_contetn_word_show',
            [
                'label' => esc_html__( 'Show Hover Content Limit', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'rtelements' ),
                'default' => '15',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'course_per',
            [
                'label' => esc_html__('Course Per Page', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('example 3', 'rtelements'),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Course offset', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('You can write how many course offset. ex(2)', 'rtelements'),
                'separator' => 'before',

            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'meta_section',
            [
                'label' => esc_html__('Meta Settings', 'rtelements'),
            ]
        );
        $this->add_control(
            'show_cates',
            [
                'label' => esc_html__('Show Category', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );
        $this->add_control(
            'show_heart',
            [
                'label' => esc_html__('Show Bookmark Icon', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );
        $this->add_control(
            'show_lesson',
            [
                'label' => esc_html__('Show Lesson', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );
        $this->add_control(
            'show_course_time',
            [
                'label' => esc_html__('Show Time', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );

        $this->add_control(
            'show_enrolled_count',
            [
                'label' => esc_html__('Show Enrolled Count', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );

        $this->add_control(
            'show_admin',
            [
                'label' => esc_html__('Show Admin', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );
        $this->add_control(
			'lesson_text',
			[
                'label'       => esc_html__( 'Lesson Text', 'rtelements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Lesson',
                'placeholder' => esc_html__( 'Lesson', 'rtelements' ),
                'separator'   => 'before',
                'condition' => [
                    'show_lesson' => 'yes',
                ], 
			]
		);
        $this->add_control(
			'student_text',
			[
                'label'       => esc_html__( 'Student Text', 'rtelements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Student',
                'placeholder' => esc_html__( 'Student', 'rtelements' ),
                'condition' => [
                    'show_enrolled_count' => 'yes',
                ],
			]
		);
        $this->end_controls_section();


        $this->start_controls_section(
            'filter_section',
            [
                'label' => esc_html__('Filter Settings', 'rtelements'),
            ]
        );
        $this->add_control(
            'show_filter_option',
            [
                'label' => esc_html__('Show Filter ?', 'prelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__('Show', 'prelements'),
                    'label_off' => esc_html__('Hide', 'prelements'),
                ],
            ]
        );
        $this->add_control(
            'filter_style_one_title',
            [
                'label' => esc_html__('Filter Title (All)', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All', 'plugin-name'),
                'placeholder' => esc_html__('Type your title here', 'plugin-name'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();    
        
        // ********** Card ********* //
        $this->start_controls_section(
            'course_style_card_style',
            [
                'label' => esc_html__('Card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
         );
            $this->add_control(
                'course_style_card_style_color',
                [
                    'label' => esc_html__('Background Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper' => 'background: {{VALUE}}',
                    ],
                ]
            );            
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'course_style_card_style_border',
                    'selector' => '{{WRAPPER}} .gridarea__wraper',
                ]
            );
            $this->add_responsive_control(
                'course_style_card_style_radius',
                [
                    'label'      => __('Border Radius', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
            $this->add_responsive_control(
                'course_style_card_style_margin',
                [
                    'label'      => __('Margin', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
            $this->add_responsive_control(
                'course_style_card_style_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();  

        $this->start_controls_section(
            'filter_top_style_twoo_filter',
            [
                'label' => esc_html__('Filter/Button', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter_option' => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'filter_top_style_one_button_align',
            [
                'label'         => esc_html__('Button Alignment', 'plugin-name'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                ],
                'default'         => 'right',
                'selectors'     => [
                    '{{WRAPPER}} .gridfilter_nav' => 'text-align: {{VALUE}};',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'filter_top_style_twoo_filter_typography',
                'selector' => '{{WRAPPER}} .grid__filter__2 button',
            ]
        );
        $this->add_control(
            'filter_top_style_twoo_filterc_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'filter_top_style_twoo_filter_active_color',
            [
                'label' => esc_html__('Hover & Active Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button:hover' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .grid__filter__2 button.active' => 'color: {{VALUE}} !important',
                ],
            ]
        );       
        $this->add_control(
            'filter_top_style_twoo_filter_color',
            [
                'label' => esc_html__('Background Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'filter_top_style_twoo_filter_active_bgcolor',
            [
                'label' => esc_html__('Hover & Active Background', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button.active' => 'background: {{VALUE}} !important',
                    '{{WRAPPER}} .grid__filter__2 button:hover' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_top_style_twoo_filter_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_top_style_twoo_filter_margin',
            [
                'label' => esc_html__('Item Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2 button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_top_style_twoo_filter_area_margin',
            [
                'label' => esc_html__('Item Area Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .grid__filter__2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // ********** Category ********* //
        $this->start_controls_section(
            'course_style_cat',
            [
                'label' => esc_html__('Category', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cates' => 'yes',
                ],
            ]
         );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_cat_typ',
                    'selector' => '{{WRAPPER}} .gridarea__wraper .gridarea__content .categories .grid__badge',
                    'selector' => '{{WRAPPER}} .style6 .gridarea__wraper .gridarea__img .categories .grid__badge.seller_cat',
                ]
            );

            $this->add_control(
                'course_style_cat_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .categories .grid__badge' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .style6 .gridarea__wraper .gridarea__img .categories .grid__badge.seller_cat' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'course_style_cat_colorb',
                [
                    'label'     => esc_html__('Background Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .categories .grid__badge' => 'background: {{VALUE}};',
                        '{{WRAPPER}} .style6 .gridarea__wraper .gridarea__img .categories .grid__badge.seller_cat' => 'background: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_cat_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .categories .grid__badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .style6 .gridarea__wraper .gridarea__img .categories .grid__badge.seller_cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_style_cat_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .categories .grid__badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .style6 .gridarea__wraper .gridarea__img .categories .grid__badge.seller_cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
        $this->end_controls_section();
        
        // ********** Wishlist ********* //
        $this->start_controls_section(
            'course_style_wishlist',
            [
                'label' => esc_html__('Wishlist', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_heart' => 'yes'
                ]
            ]   
         );

            $this->add_control(
                'course_style_wishlist_color',
                [
                    'label' => esc_html__('Icon Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img .gridarea__small__icon i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'course_style_wishlist_hover_color',
                [
                    'label' => esc_html__('Icon Hover Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img .gridarea__small__icon:hover i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'course_style_wishlistb_color',
                [
                    'label' => esc_html__('Background Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img .tutor-iconic-btn' => 'background: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'course_style_wishlistbh_color',
                [
                    'label' => esc_html__('Hover Background', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img .tutor-iconic-btn:hover' => 'background: {{VALUE}}',
                    ],
                ]
            );
        $this->end_controls_section();

        // ********** Image ********* //
        $this->start_controls_section(
            'course_style_image',
            [
                'label' => esc_html__('Image', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
         );
            $this->add_responsive_control(
                'course_style_image_height',
                [
                    'label'       => esc_html__('Height', 'plugin-name'),
                    'type'        => Controls_Manager::TEXT,
                    'description' => 'Custom image size (Example: 300)',
                    'selectors'   => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img img ' => 'height: {{VALUE}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_image_width',
                [
                    'label'       => esc_html__('Width', 'plugin-name'),
                    'type'        => Controls_Manager::TEXT,
                    'description' => 'Custom image size (Example: 300)',
                    'selectors'   => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img img ' => 'width: {{VALUE}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_image_border_radius',
                [
                    'label'      => __('Border Radius', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();

        // ********** Lesson ********* //
        $this->start_controls_section(
            'course_style_lesson',
            [
                'label' => esc_html__('Lesson', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_lesson' => 'yes'
                ]
            ]
         );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_lesson_typ',
                    'selector' => '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .lesson',

                ]
            );
            $this->add_control(
                'course_style_lesson_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .lesson' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'iconnn_lesson_color',
                [
                    'label' => esc_html__('Icon Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .lesson i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_lesson_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .lesson' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_lesson_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .lesson' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();

        // ********** Time ********* //
        $this->start_controls_section(
            'course_style_time',
            [
                'label' => esc_html__('Time', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_course_time' => 'yes'
                ]
            ]
         );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_time_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__list ul .clock',

                ]
            );
            $this->add_control(
                'course_style_time_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__list ul .clock' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__list ul .tutor-color-secondary' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'iconnnn_clock_color',
                [
                    'label' => esc_html__('Icon Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .clock i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_time_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .clock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_time_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .clock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();

        // ********** Student ********* //
        $this->start_controls_section(
            'course_style_student',
            [
                'label' => esc_html__('Student', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_enrolled_count' => 'yes'
                ]
            ]
         );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_user_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__list ul .user',

                ]
            );
            $this->add_control(
                'course_style_user_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__list ul .user' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'iconnnn_user_color',
                [
                    'label' => esc_html__('Icon Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .user i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_user_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .user' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_user_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__list ul .user' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();
        
        // ********** Title ********* //
        $this->start_controls_section(
            'course_style_title',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,                
            ]
          );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_title_typ',
                    'selector' => '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__heading h3 a',

                ]
            );

            $this->add_control(
                'course_style_title_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__heading h3 a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'course_style_title_color_hover',
                [
                    'label'     => esc_html__('Hover Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__heading h3 a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_title_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__heading h3 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_title_padding',
                [
                    'label'      => __('Padding', 'plugin-name'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__heading h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
        $this->end_controls_section();
           
        // ********** Price ********* //
        $this->start_controls_section(
            'course_style_price',
            [
                'label' => esc_html__('Price', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
         );
            $this->add_control(
                'more_ofwssptionsw',
                [
                    'label' => esc_html__('Price Free', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'spinner_typ',
                    'selector' => '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__bottom .price-tutor',

                ]
            );
            $this->add_control(
                'spinfdffner_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__bottom .price-tutor' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'spinddddner_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .gridarea__wraper .gridarea__content .gridarea__bottom .price-tutor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'more_ofwfssptionsw',
                [
                    'label' => esc_html__('Reguler Price', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'spidfdfnner_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .list-item-price del',

                ]
            );
            $this->add_control(
                'spisfdnner_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-item-price del' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'spidfdnner_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .list-item-price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'more_offwfssptionsw',
                [
                    'label' => esc_html__('Sale Price', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'spifasfsdafnner_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .list-item-price.tutor-item-price span',

                ]
            );
            $this->add_control(
                'spinhraner_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .list-item-price.tutor-item-price span' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'spinnerter_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .list-item-price.tutor-item-price span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
        $this->end_controls_section();

        // ********** Author ********* //
        $this->start_controls_section(
            'course_style_author',
            [
                'label' => esc_html__('Author Name', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_admin' => 'yes'
                ]
            ]
         );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_author_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__small__content h6',

                ]
            );
            $this->add_control(
                'course_style_author_color',
                [
                    'label'     => esc_html__('Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__small__content h6' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'course_style_author_colorh',
                [
                    'label'     => esc_html__('Hover Color', 'plugin-name'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__small__content h6:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_style_author_margin',
                [
                    'label' => esc_html__('Margin', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__small__content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
            
        // ********** Rating ********* //
            $this->start_controls_section(
                'course_style_rating',
                [
                    'label' => esc_html__('Rating', 'plugin-name'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_rating' => 'yes'
                    ]
                ]
            );          
            $this->add_control(
                'rating_text_color',
                [
                    'label' => esc_html__('Text Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-average' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'rating_text_count_color',
                [
                    'label' => esc_html__('Ratings Count Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-count' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_rating_text_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-count,{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-average',

                ]
            );
            $this->add_control(
                'course_style_rating_color',
                [
                    'label' => esc_html__('Icon Color', 'plugin-name'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-stars>*' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
              Group_Control_Typography::get_type(),
                [
                    'label'    => esc_html__('Typography', 'plugin-name'),
                    'name'     => 'course_style_rating_icon_typ',
                    'selector' => '{{WRAPPER}} .coursearea .gridarea__wraper .gridarea__content .gridarea__bottom .tutor-ratings-stars>*',

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
    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        $style = $settings['course_grid_style'];
        $limit = !empty($settings['course_contetn_word_show'])  ? $settings['course_contetn_word_show'] : '15';
        $post_type = $settings['post_type'];
        $taxonomy = $settings['taxonomy'];

        $cat = $settings['cat'];
        global $post, $authordata;  
        
        $args = [
            'post_type'      => $post_type, // Replace 'post' with your custom post type, e.g., 'course'.
            'posts_per_page' => $settings['course_per'],    // Show all posts.
            'post_status'    => 'publish',
            'orderby'        => 'date', // Customize as needed (e.g., 'title', 'menu_order').
            'order'          => 'DESC',
            'ignore_sticky_posts' => 1,
            'offset'              => $settings['offset'],
        ];

        if (empty($cat)) {
            $best_wp = new wp_Query( $args);
        } else {
            $best_wp = new wp_Query($args);
        }
        ?>
        <?php if (isset($settings['show_filter']) &&  'yes' === $settings['show_filter']) { ?>
            <div class="courses-filter">
                <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']); ?></button>
                        <?php
                            $taxonomy = "";
                            $taxonomy = "course-category";
                            foreach ($cat as $cat) {
                                $term = get_term_by('slug', $cat, $taxonomy);
                                if($term){
                                    $term_name  =  $term->name;
                                    $term_slug  =  $term->slug;
                                    ?>
                                    <button data-filter=".filter_<?php echo esc_html($term_slug); ?>"><?php echo esc_html($term_name); ?></button>
                                    <?php 
                                }
                            } ?>
            </div>
        <?php } ?>

        <?php 

        include plugin_dir_path(__FILE__) . "/style1.php"; 

        if ( ! is_user_logged_in() ) {
            tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php' );
        }
        
        ?>       
    <?php

    }
    public function rt_get_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $posts = array();
        foreach ($post_types as $post_type) {
            $posts[$post_type->name] = $post_type->labels->singular_name;
        }
        return $posts;
    }
    public function rt_get_taxonomies(){
        $args       = array(
            'public'      => true,
            'show_ui'     => true,
        );
        $taxonomies = get_taxonomies( $args, 'object' );
        $response   = array();
        foreach ( $taxonomies as $taxonomy ) {
            $response[$taxonomy->name] = $taxonomy->label;
        }
        return $response;
    }

    public function getCategories(){


        $terms = get_terms(array(
            'hide_empty'  => true
        ));

        $cat_list = [];

        foreach ($terms as $post) {
            $cat_list[$post->slug]  = [$post->name];
        }
        return $cat_list;
    }

    
} ?>