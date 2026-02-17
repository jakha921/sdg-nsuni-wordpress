<?php
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;


/**
 * Elementor Table Widget.
 *
 * @since 1.0.0
 */
class Rsaddon_Pro_Table_Elementor_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'RS-Table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RT Table', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'flaticon-table-for-data';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'rsaddon_category' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_table_header',
			[
				'label' => esc_html__( 'Table Header', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'table_header',
			[
				'label' => esc_html__( 'Table Header Cell', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'rsaddon' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Table Header', 'rsaddon' ),
						'default' => esc_html__( 'Table Header', 'rsaddon' ),
						'dynamic' => [
		                    'active' => true,
		                ]
					],
					[
						'name'	=> 'advance',
						'label' => esc_html__( 'Advance Settings', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspan',
						'label' => esc_html__( 'colSpan', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspannumber',
						'label' => esc_html__( 'colSpan Number', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'advance' => 'yes',
							'colspan' => 'yes',
						],
						'placeholder' => esc_html__( '1', 'rsaddon' ),
						'default' => esc_html__( '1', 'rsaddon' ),
					],
					[
						'name'	=> 'customwidth',
						'label' => esc_html__( 'Custom Width', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'width',
						'label' => esc_html__( 'Width', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'condition' => [
							'advance' => 'yes',
							'customwidth' => 'yes',
						],
						'range' => [
							'%' => [
								'min' => 0,
								'max' => 100,
							],
							'px' => [
								'min' => 1,
								'max' => 1000,
							],
						],
						'default' => [
							'size' => 30,
							'unit' => '%',
						],
						'size_units' => [ '%', 'px' ],
						'selectors' => [ '{{WRAPPER}} table.rselements-table .rselements-table-header {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
						]
					],
					[
						'name' => 'align', 
						'label' => esc_html__( 'Alignment', 'rsaddon' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'rsaddon' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rsaddon' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'rsaddon' ),
								'icon' => 'eicon-text-align-right',
							],
							'justify' => [
								'title' => esc_html__( 'Justified', 'rsaddon' ),
								'icon' => 'eicon-text-align-justify',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-header {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					[
						'name' => 'vertical_align', 
						'label' => esc_html__( 'Vertical Alignment', 'rsaddon' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							'top' => [
								'title' => esc_html__( 'Top', 'rsaddon' ),
								'icon' => 'eicon-v-align-up',
							],
							'middle' => [
								'title' => esc_html__( 'Middle', 'rsaddon' ),
								'icon' => 'eicon-v-align-middle',
							],
							'bottom' => [
								'title' => esc_html__( 'Bottom', 'rsaddon' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-header {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					
					[
						'name'	=> 'decoration',
						'label' => esc_html__( 'Decoration', 'rsaddon' ),
						'type' => Controls_Manager::SELECT,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							''  => esc_html__( 'Default', 'rsaddon' ),
							'underline' => esc_html__( 'Underline', 'rsaddon' ),
							'overline' => esc_html__( 'Overline', 'rsaddon' ),
							'line-through' => esc_html__( 'Line Through', 'rsaddon' ),
							'none' => esc_html__( 'None', 'rsaddon' ),
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-header {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
						],
					],
					[
						'name'	=> 'table_head_tooltip',
						'label' => esc_html__( 'Tooltip Settings', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'table_head_tooltip_icon',
						'label' => esc_html__( 'Tooltip Icon', 'rsaddon' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-question-circle',
							'library' => 'fa-solid',
						],
						'condition' => [
							'table_head_tooltip' => 'yes',
						],
					],
					[
						'name'	=> 'table_head_tooltip_description',
						'label' => esc_html__('Tooltip Description', 'rsaddon' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'rows' => 10,
						'placeholder' => esc_html__( 'Type your tooltip description here', 'rsaddon' ),
						'condition' => [
							'table_head_tooltip' => 'yes',
						],
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'content_table_footer',
			[
				'label' => esc_html__( 'Table footer', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'table_footer',
			[
				'label' => esc_html__( 'Table footer Cell', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				 'prevent_empty' => false,
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'rsaddon' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Table footer', 'rsaddon' ),
						'default' => esc_html__( 'Table footer', 'rsaddon' ),
						'dynamic' => [
							'active' => true,
						]
					],
					[
						'name'	=> 'advance',
						'label' => esc_html__( 'Advance Settings', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspan',
						'label' => esc_html__( 'colSpan', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspannumber',
						'label' => esc_html__( 'colSpan Number', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'advance' => 'yes',
							'colspan' => 'yes',
						],
						'placeholder' => esc_html__( '1', 'rsaddon' ),
						'default' => esc_html__( '1', 'rsaddon' ),
					],
					[
						'name'	=> 'customwidth',
						'label' => esc_html__( 'Custom Width', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'width',
						'label' => esc_html__( 'Width', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'condition' => [
							'advance' => 'yes',
							'customwidth' => 'yes',
						],
						'range' => [
							'%' => [
								'min' => 0,
								'max' => 100,
							],
							'px' => [
								'min' => 1,
								'max' => 1000,
							],
						],
						'default' => [
							'size' => 30,
							'unit' => '%',
						],
						'size_units' => [ '%', 'px' ],
						'selectors' => [ '{{WRAPPER}} table.rselements-table .rselements-table-footer {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
						]
					],
					[
						'name' => 'align', 
						'label' => esc_html__( 'Alignment', 'rsaddon' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'rsaddon' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rsaddon' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'rsaddon' ),
								'icon' => 'eicon-text-align-right',
							],
							'justify' => [
								'title' => esc_html__( 'Justified', 'rsaddon' ),
								'icon' => 'eicon-text-align-justify',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-footer {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					[
						'name' => 'vertical_align', 
						'label' => esc_html__( 'Vertical Alignment', 'rsaddon' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							'top' => [
								'title' => esc_html__( 'Top', 'rsaddon' ),
								'icon' => 'eicon-v-align-up',
							],
							'middle' => [
								'title' => esc_html__( 'Middle', 'rsaddon' ),
								'icon' => 'eicon-v-align-middle',
							],
							'bottom' => [
								'title' => esc_html__( 'Bottom', 'rsaddon' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-footer {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					
					[
						'name'	=> 'decoration',
						'label' => esc_html__( 'Decoration', 'rsaddon' ),
						'type' => Controls_Manager::SELECT,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							''  => esc_html__( 'Default', 'rsaddon' ),
							'underline' => esc_html__( 'Underline', 'rsaddon' ),
							'overline' => esc_html__( 'Overline', 'rsaddon' ),
							'line-through' => esc_html__( 'Line Through', 'rsaddon' ),
							'none' => esc_html__( 'None', 'rsaddon' ),
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table .rselements-table-footer {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
						],
					],
					[
						'name'	=> 'table_foot_tooltip',
						'label' => esc_html__( 'Tooltip Settings', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'table_foot_tooltip_icon',
						'label' => esc_html__( 'Tooltip Icon', 'rsaddon' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-question-circle',
							'library' => 'fa-solid',
						],
						'condition' => [
							'table_foot_tooltip' => 'yes',
						],
					],
					[
						'name'	=> 'table_foot_tooltip_description',
						'label' => esc_html__('Tooltip Description', 'rsaddon' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'rows' => 10,
						'placeholder' => esc_html__( 'Type your tooltip description here', 'rsaddon' ),
						'condition' => [
							'table_foot_tooltip' => 'yes',
						],
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'content_table_body',
			[
				'label' => esc_html__( 'Table Body', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		
		$repeater->add_control(
			'row', [
				'label' => esc_html__( 'New Row', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'table_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'text', [
				'label' => esc_html__( 'Text', 'rsaddon' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'placeholder' => esc_html__( 'Table Data', 'rsaddon' ),
				'default' => esc_html__( 'Table Data', 'rsaddon' ),
				'dynamic' => [
		            'active' => true,
		        ]
			]
		);

		$repeater->add_control(
			'advance', [
				'label' => esc_html__( 'Advance Settings', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'colspan', [
				'label' => esc_html__( 'colSpan', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'colspannumber', [
				'label' => esc_html__( 'colSpan Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'colspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'rsaddon' ),
				'default' => esc_html__( '1', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'rowspan', [
				'label' => esc_html__( 'rowSpan', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'rowspannumber', [
				'label' => esc_html__( 'rowSpan Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'rowspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'rsaddon' ),
				'default' => esc_html__( '1', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'align', [
				'label' => esc_html__( 'Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rsaddon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rsaddon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rsaddon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'vertical_align', [
				'label' => esc_html__( 'Vetical Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
				'top' => [
					'title' => esc_html__( 'Top', 'rsaddon' ),
					'icon' => 'eicon-v-align-top',
				],
				'middle' => [
					'title' => esc_html__( 'Middle', 'rsaddon' ),
					'icon' => 'eicon-v-align-middle',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'rsaddon' ),
					'icon' => 'eicon-v-align-bottom',
				],
			],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body {{CURRENT_ITEM}}' => 'vertical-align: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'advanced_item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				]
			]
		);
		$repeater->add_control(
			'advanced_item_text_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				]
			]
		);
		$repeater->add_control(
			'tb_cswidthS',
			[
				'label' => esc_html__( 'Custom Width', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);	
		$repeater->add_control(
			'tb_cswidth',
			[
			'label' => esc_html__( 'Width', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'condition' => [
				'advance' => 'yes',
				'tb_cswidthS' => 'yes',
			],
			'range' => [
				'%' => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			
			'selectors' => [ '{{WRAPPER}} table.rselements-table .rselements-table-body {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
			]
			],
		);

		$repeater->add_control(
			'decoration',
			[
				'label' => esc_html__( 'Decoration', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
					''  => esc_html__( 'Default', 'rsaddon' ),
					'underline' => esc_html__( 'Underline', 'rsaddon' ),
					'overline' => esc_html__( 'Overline', 'rsaddon' ),
					'line-through' => esc_html__( 'Line Through', 'rsaddon' ),
					'none' => esc_html__( 'None', 'rsaddon' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-decoration:{{VALUE}};',
				],
			]
		);	
		$repeater->add_control(
			'table_body_tooltip',
			[
			'label' => esc_html__( 'Tooltip Settings', 'rsaddon' ),
			'type' => Controls_Manager::SWITCHER,
			'label_off' => esc_html__( 'No', 'rsaddon' ),
			'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
			);
		$repeater->add_control(
			'table_body_tooltip_icon',
			[
				'label' => esc_html__( 'Tooltip Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-question-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'table_body_tooltip' => 'yes',
				],
			]
			);
		$repeater->add_control(
			'table_body_tooltip_description',
			[
				'label' => esc_html__('Tooltip Description', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => esc_html__( 'Type your tooltip description here', 'rsaddon' ),
				'condition' => [
					'table_body_tooltip' => 'yes',
				],
			]
			);

		$this->add_control(
			'table_body',
			[
				'label' => esc_html__( 'Table Body Cell', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Table Data', 'rsaddon' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'General Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'vertical_align_table', [
				'label' => esc_html__( 'Vetical Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
				'top' => [
					'title' => esc_html__( 'Top', 'rsaddon' ),
					'icon' => 'eicon-v-align-top',
				],
				'middle' => [
					'title' => esc_html__( 'Middle', 'rsaddon' ),
					'icon' => 'eicon-v-align-middle',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'rsaddon' ),
					'icon' => 'eicon-v-align-bottom',
				],
			],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body td' => 'vertical-align: {{VALUE}};',
					'{{WRAPPER}} table.rselements-table .rselements-table-body th' => 'vertical-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'table_padding',
			[
				'label' => esc_html__( 'Table Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} table.rselements-table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'table_border',
				'label' => esc_html__( 'Border', 'rsaddon' ),
				'selector' => '{{WRAPPER}} table.rselements-table tbody',
			]
		);

		$this->end_controls_section();




		$this->start_controls_section(
			'table_header_style',
			[
				'label' => esc_html__( 'Table Header Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'header_align',
			[
				'label' => esc_html__( 'Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rsaddon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rsaddon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rsaddon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-header',
				
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'table_thead_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'body_head_border',
				'selector' => '{{WRAPPER}} .table.rselements-table .rselements-table-header th',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_footer_style',
			[
				'label' => esc_html__( 'Table footer Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'footer_align',
			[
				'label' => esc_html__( 'Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rsaddon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rsaddon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rsaddon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-footer' => 'text-align: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'footer_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-footer' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'footer_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-footer',
				
			]
		);

		$this->add_control(
			'footer_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-footer' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'table_tfoot_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-footer th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'body_foot_border',
				'selector' => '{{WRAPPER}} .table.rselements-table .rselements-table-footer th',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'table_body_style',
			[
				'label' => esc_html__( 'Table Body Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_align',
			[
				'label' => esc_html__( 'Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rsaddon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rsaddon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rsaddon' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'body_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'color: {{VALUE}};',
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'body_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-body',
				
			]
		);

		$this->add_control(
			'body_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'striped_bg', 
			[
				'label' => esc_html__( 'Striped Background', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);
		$this->add_control(
			'striped_bg_color', 
			[
				'label' => esc_html__( 'Secondary Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'striped_bg' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body tr:nth-of-type(2n)' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'body_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body td i' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.rselements-table .rselements-table-body td svg path' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'body_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .table.rselements-table .rselements-table-body td i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .table.rselements-table .rselements-table-body td svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'body_icon_gap',
			[
				'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body td i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} table.rselements-table .rselements-table-body td svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'table_tbody_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'body_border',
				'selector' => '{{WRAPPER}} .table.rselements-table .rselements-table-body td',
			]
		);
		$this->add_control(
			'tooltip_heading',
			[
				'label' => esc_html__( 'Tooltip Options', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'tooltip_icon_color',
			[
				'label' => esc_html__( 'Tooltip Icon Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .table_tolltip i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} table.rselements-table .table_tolltip svg path' => 'fill: {{VALUE}} !important;',
				]
			]
		);
		$this->add_control(
			'tooltip_icon_size',
			[
				'label' => esc_html__( 'Tooltip Icon Size', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .table.rselements-table .table_tolltip i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .table.rselements-table .table_tolltip svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_control(
			'tooltip_icon_margin',
			[
				'label' => esc_html__( 'Tooltip Icon Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .table.rselements-table .table_tolltip i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .table.rselements-table .table_tolltip svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tooltip_align',
			[
				'label' => esc_html__( 'Tooltip Align', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rsaddon' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'rsaddon' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rsaddon' ),
						'icon' => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'rsaddon' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$unique = rand(10,6554120);	
		$tooltip_align = $settings['tooltip_align'];

		?>
	<!-- Tooltip element -->
		<table class="rselements-table table single-plan" id="table-<?php echo esc_attr($unique);?>">
			<thead  class="rselements-table-header">
				<tr class="single-plan__header">
					<?php
					foreach ($settings['table_header'] as $index => $headeritem) {
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'table_header', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$colspan = ($headeritem['colspan'] == 'yes' && $headeritem['advance'] == 'yes') ? 'colSpan="'.$headeritem['colspannumber'].'"' : '';
						echo '<th class="header-title elementor-inline-editing elementor-repeater-item-'.$headeritem['_id'].'"  '.$colspan.' '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$headeritem['text'];
						if ($headeritem['table_head_tooltip'] == 'yes') {
							echo '<span class="table_tolltip" data-bs-custom-class="tooltip-table-title" data-bs-toggle="tooltip" data-bs-placement="'.$tooltip_align.'" title="'.wp_kses_post( $headeritem['table_head_tooltip_description'] ).'">';
							\Elementor\Icons_Manager::render_icon( $headeritem['table_head_tooltip_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</span>';
						}

						echo '</th>';
					}
					?>
				</tr>
			</thead>
			<tbody class="rselements-table-body">
				<tr class="single-plan__content">
					<?php
						foreach ($settings['table_body'] as $index => $item) {

							$table_icon = !empty($item['table_icon']) ? $item['table_icon'] : '';

							$table_body_key = $this->get_repeater_setting_key('text', 'table_body', $index);
							$this->add_render_attribute($table_body_key, 'class', 'plan-title elementor-repeater-item-' . $item['_id']);
							$this->add_inline_editing_attributes($table_body_key);

							if ($item['row'] == 'yes') {
								echo '</tr><tr class="single-plan__content">';
							}

							$colspan = ($item['colspan'] == 'yes' && $item['advance'] == 'yes') ? 'colspan="' . $item['colspannumber'] . '"' : '';
							$rowspan = ($item['rowspan'] == 'yes' && $item['advance'] == 'yes') ? 'rowspan="' . $item['rowspannumber'] . '"' : '';

							echo '<td ' . $colspan . ' ' . $rowspan . ' ' . $this->get_render_attribute_string($table_body_key) . '>';
							if (!empty($item['table_icon'])) {
								\Elementor\Icons_Manager::render_icon($item['table_icon'], ['aria-hidden' => 'true']);
							}
							echo $item['text'];
							if ($item['table_body_tooltip'] == 'yes') {
								echo '<span class="table_tolltip" data-bs-custom-class="tooltip-table-title" data-bs-toggle="tooltip" data-bs-placement="'.$tooltip_align.'" title="'.wp_kses_post( $item['table_body_tooltip_description'] ).'">';
								\Elementor\Icons_Manager::render_icon( $item['table_body_tooltip_icon'], [ 'aria-hidden' => 'true' ] );
								echo '</span>';
							}
							echo '</td>';
						}
					?>
				</tr>
			</tbody>
			<tfoot class="rselements-table-footer">
				<tr class="single-plan__footer">
					<?php
					foreach ($settings['table_footer'] as $index => $footeritem) {
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'table_footer', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$colspan = ($footeritem['colspan'] == 'yes' && $footeritem['advance'] == 'yes') ? 'colSpan="'.$footeritem['colspannumber'].'"' : '';
						echo '<th class="footer-title elementor-inline-editing elementor-repeater-item-'.$footeritem['_id'].'"  '.$colspan.' '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$footeritem['text'];
						if ($footeritem['table_foot_tooltip'] == 'yes') {
							echo '<span class="table_tolltip" data-bs-custom-class="tooltip-table-title" data-bs-toggle="tooltip" data-bs-placement="'.$tooltip_align.'" title="'.wp_kses_post( $footeritem['table_foot_tooltip_description'] ).'">';
							\Elementor\Icons_Manager::render_icon( $footeritem['table_foot_tooltip_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</span>';
						}

						echo '</th>';
					}
					?>
				</tr>
			</tfoot>
		</table>
		
		<?php
	}
}
