<?php
/**
 * omexer_insight pricing table widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */
namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Pricing_Table extends Widget_Base {

    public function get_name() {
        return 'omexer-pricing-table';
    }

    public function get_title() {
        return esc_html__( 'Pricing Table', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-price-table';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [ 
            'pricing',
            'price',
            'pricing table',
            'table',
            'package',
            'plan',
            'omexer',
        ];
    }

	protected function register_controls() {

        //Header Sections
		$this->start_controls_section(
			'_section_header',
			[
				'label' => __( 'Header', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => __( 'Basic', 'omexer-insight' ),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'media_type',
			[
				'label' => __( 'Media Type', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'separator' => 'before',
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'omexer-insight' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'omexer-insight' ),
						'icon' => 'eicon-image',
					],
				],
				'default' => 'icon',
				'toggle' => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'omexer-insight' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-place-of-worship',
					'library' => 'solid',
				],
				'condition' => [
					'media_type' => 'icon'
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'omexer-insight' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'media_type' => 'image'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'media_thumbnail',
				'default' => 'full',
				'separator' => 'none',
				'exclude' => [
					'custom',
				],
				'condition' => [
					'media_type' => 'image'
				]
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Position', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before_header',
				'options' => [
					'after_header'  => __( 'After Title', 'omexer-insight' ),
					'before_header'  => __( 'Before Title', 'omexer-insight' ),
				],
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		//Pricing Sections
		$this->start_controls_section(
			'_section_pricing',
			[
				'label' => __( 'Pricing', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					''             => __( 'None', 'omexer-insight' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'omexer-insight' ),
					'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'omexer-insight' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'omexer-insight' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'omexer-insight' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'omexer-insight' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'omexer-insight' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'omexer-insight' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'omexer-insight' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'omexer-insight' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'omexer-insight' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'omexer-insight' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'omexer-insight' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'omexer-insight' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'omexer-insight' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'omexer-insight' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'omexer-insight' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'omexer-insight' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'omexer-insight' ),
					'custom'       => __( 'Custom', 'omexer-insight' ),
				],
				'default' => 'dollar',
			]
		);

		$this->add_control(
			'currency_custom',
			[
				'label' => __( 'Custom Symbol', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency' => 'custom',
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => '9.99',
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'original_price',
			[
				'label' => __( 'Original Price', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => '8.99',
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'omexer-insight' ),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'price_position',
			[
				'label' => __( 'Position', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after_header',
				'options' => [
					'after_header'  => __( 'After Header', 'omexer-insight' ),
					'before_button'  => __( 'Before Button', 'omexer-insight' ),
				],
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();


		//Features & Description Sections
		$this->start_controls_section(
			'_section_features_and_description',
			[
				'label' => __( 'Features & Description', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'features_title',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Features', 'omexer-insight' ),
				'separator' => 'after',
				'dynamic' => [
					'active' => true
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'omexer-insight' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-regular' => [
                        'check-square',
                        'window-close',
                    ],
                    'fa-solid' => [
                        'check',
                    ]
                ]
            ]
        );

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Exciting Feature', 'omexer-insight' ),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$repeater->add_control(
			'tooltip_text',
			[
				'label' => __( 'Tooltip Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'show_label' => false,
				'prevent_empty' => false,
				'default' => [
					[
						'icon' => 'fa fa-check',
						'text' => __( 'Standard Feature', 'omexer-insight' ),
					],
					[
						'icon' => 'fa fa-check',
						'text' => __( 'Another Great Feature', 'omexer-insight' ),
						'tooltip_text' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'omexer-insight' ),
					],
					[
						'icon' => 'fa fa-close',
						'text' => __( 'Obsolete Feature', 'omexer-insight' ),
					],
					[
						'icon' => 'fa fa-check',
						'text' => __( 'Exciting Feature', 'omexer-insight' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'omexer-insight' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'omexer-insight' ),
				'placeholder' => __( 'Type description', 'omexer-insight' ),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'features_alignment',
			[
				'label' => __( 'Features Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'omexer-insight' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'omexer-insight' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'omexer-insight' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-body' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		//Footer Section
		$this->start_controls_section(
			'_section_footer',
			[
				'label' => __( 'Footer', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Subscribe', 'omexer-insight' ),
				'placeholder' => __( 'Type button text here', 'omexer-insight' ),
				'label_block' => false,
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'https://siteurl.com/',
				'default' => [
					'url' => '#'
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'footer_description',
			[
				'label' => __( 'Footer Description', 'omexer-insight' ),
				'show_label' => true,
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		//Badge Section
		$this->start_controls_section(
			'_section_badge',
			[
				'label' => __( 'Badge', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'show_badge',
			[
				'label' => __( 'Show', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label' => __( 'Badge Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Recommended', 'omexer-insight' ),
				'placeholder' => __( 'Type badge text', 'omexer-insight' ),
				'condition' => [
					'show_badge' => 'yes'
				],
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label' => __( 'Position', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'omexer-insight' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'omexer-insight' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'default' => 'left',
				'style_transfer' => true,
				'condition' => [
					'show_badge' => 'yes'
				]
			]
		);

		$this->end_controls_section();

        //General Style
		$this->start_controls_section(
			'_section_style_general',
			[
				'label' => __( 'General', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-icon,'
					. '{{WRAPPER}} .pricing-table-title,'
					. '{{WRAPPER}} .pricing-table-currency,'
					. '{{WRAPPER}} .pricing-table-period,'
					. '{{WRAPPER}} .pricing-table-features-title,'
					. '{{WRAPPER}} .pricing-table-features-list li,'
					. '{{WRAPPER}} .pricing-table-price-text,'
					. '{{WRAPPER}} .pricing-table-description,'
					. '{{WRAPPER}} .pricing-table-footer-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overflow',
			[
				'label' => __( 'Overflow', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'' => __( 'Default', 'omexer-insight' ),
					'hidden' => __( 'Hidden', 'omexer-insight' ),
				],
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => 'overflow: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'omexer-insight' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'omexer-insight' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'omexer-insight' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();



		//Header Style
		$this->start_controls_section(
			'_section_style_header',
			[
				'label' => __( 'Header', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_area_header',
			[
				'label' => __( 'Container', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'header_area_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_area_background',
				'label' => __( 'Background', 'omexer-insight' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pricing-table-header',
			]
		);

		$this->add_control(
			'title_style_header',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pricing-table-title'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .pricing-table-title',
			]
		);

		$this->add_control(
			'icon_style_header',
			[
				'label' => __( 'Media', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-media--icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table-media--icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pricing-table-media--image > img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-media' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-media--icon > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pricing-table-media--icon > svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'media_type' => 'icon',
				]
			]
		);

		$this->end_controls_section();


		//Pricing Style
		$this->start_controls_section(
			'_section_style_pricing',
			[
				'label' => __( 'Pricing', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_header_pricing_area',
			[
				'label' => __( 'Pricing Area', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'pricing_area_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pricing_area_background',
				'label' => __( 'Background', 'omexer-insight' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pricing-table-price',
			]
		);

		$this->add_control(
			'_heading_price',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Price', 'omexer-insight' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'price_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .pricing-table-price-text'
			]
		);

		$this->add_control(
			'_heading_currency',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Currency', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'currency_spacing',
			[
				'label' => __( 'Side Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'currency_position',
			[
				'label' => __( 'Position', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-current-price .pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'currency_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-currency' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'currency_typography',
				'selector' => '{{WRAPPER}} .pricing-table-currency'
			]
		);

		$this->add_control(
			'_heading_original_price',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Original Price', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'original_price_spacing',
			[
				'label' => __( 'Side Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-original-price' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'original_price_position',
			[
				'label' => __( 'Position', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-original-price .pricing-table-currency,'
				   .'{{WRAPPER}} .pricing-table-original-price .pricing-table-price-text' => 'top: {{SIZE}}{{UNIT}};position:relative;',
				],
			]
		);


		$this->add_control(
			'original_price_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-original-price .pricing-table-currency' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pricing-table-original-price .pricing-table-price-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'original_price_typography',
				'selector' => '{{WRAPPER}} .pricing-table-original-price .pricing-table-currency,{{WRAPPER}} .pricing-table-original-price .pricing-table-price-text'
			]
		);

		$this->add_control(
			'_heading_period',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Period', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'period_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'period_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'selector' => '{{WRAPPER}} .pricing-table-period'
			]
		);

		$this->end_controls_section();


		//Features & Description Style
		$this->start_controls_section(
			'_section_style_features_description',
			[
				'label' => __( 'Features & Description', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'_heading_features',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Features', 'omexer-insight' ),
			]
		);

		$this->add_responsive_control(
			'features_container_spacing',
			[
				'label' => __( 'Container Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_container_padding',
			[
				'label' => __( 'Container Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_features_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'features_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_title_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-features-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_title_typography',
				'selector' => '{{WRAPPER}} .pricing-table-features-title'
			]
		);

		$this->add_control(
			'_heading_features_list',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'List', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'features_list_spacing',
			[
				'label' => __( 'Spacing Between', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_list_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-features-list > li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pricing-table-features-list > li svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_typography',
				'selector' => '{{WRAPPER}} .pricing-table-features-list > li'
			]
		);

		$this->add_control(
			'_heading_description_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description__padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .pricing-table-description'
			]
		);
		$this->end_controls_section();


		//Features Tooltip Style
		$this->start_controls_section(
			'_section_style_tooltip',
			[
				'label' => __( 'Features Tooltip', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_tooltip_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-feature-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_tooltip_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-feature-tooltip-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_tooltip_border',
				'label' => __( 'Border', 'omexer-insight' ),
				'selector' => '{{WRAPPER}} .pricing-table-feature-tooltip-text',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_tooltip_background',
				'label' => __( 'Background', 'omexer-insight' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pricing-table-feature-tooltip-text',
				'separator' => 'before',
				'exclude' => [
					'image',
				],
			]
		);

		$this->add_control(
			'price_tooltip_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-feature-tooltip-text' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_tooltip_typography',
				'selector' => '{{WRAPPER}} .pricing-table-feature-tooltip-text'
			]
		);
		$this->end_controls_section();


		//Footer -> Button and Footer Description
		$this->start_controls_section(
			'_section_style_footer',
			[
				'label' => __( 'Footer', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_button',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Button', 'omexer-insight' ),
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .pricing-table-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .pricing-table-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .pricing-table-btn'
			]
		);

		$this->add_responsive_control(
			'button_translate_y',
			[
				'label' => __( 'Offset Y', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => '--pricing-table-btn-translate-y: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_button_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn:hover, {{WRAPPER}} .pricing-table-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn:hover, {{WRAPPER}} .pricing-table-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-btn:hover, {{WRAPPER}} .pricing-table-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'footer_description_style_heading',
			[
				'label' => __( 'Footer Description', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'footer_description_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-footer-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'footer_description_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-footer-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'footer_description_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-footer-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'footer_description_typography',
				'selector' => '{{WRAPPER}} .pricing-table-footer-description'
			]
		);
		$this->end_controls_section();


		//Badge Style
		$this->start_controls_section(
			'_section_style_badge',
			[
				'label' => __( 'Badge', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'selector' => '{{WRAPPER}} .pricing-table-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_box_shadow',
				'selector' => '{{WRAPPER}} .pricing-table-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'label' => __( 'Typography', 'omexer-insight' ),
				'selector' => '{{WRAPPER}} .pricing-table-badge'
			]
		);

		$this->add_control(
			'badge_translate_toggle',
			[
				'label' => __( 'Offset', 'omexer-insight' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'badge_translate_x',
			[
				'label' => __( 'Offset X', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'badge_translate_toggle' => 'yes'
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .pricing-table-badge' => '--pricing-table-badge-translate-x: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'badge_translate_y',
			[
				'label' => __( 'Offset Y', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'badge_translate_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => '--pricing-table-badge-translate-y: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_popover();

		$this->add_control(
			'badge_rotate_toggle',
			[
				'label' => __( 'Rotate', 'omexer-insight' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'show_badge' => 'yes'
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'badge_rotate_z',
			[
				'label' => __( 'Rotate Z', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'badge_rotate_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-badge' => '--pricing-table-badge-rotate: {{SIZE}}deg;'
				]
			]
		);

		$this->end_popover();
		$this->end_controls_section();
	}

	private static function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'baht'         => '&#3647;',
			'bdt'          => '&#2547;',
			'dollar'       => '&#36;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'pound'        => '&#163;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'rupee'        => '&#8360;',
			'real'         => 'R$',
			'krona'        => 'kr',
			'won'          => '&#8361;',
			'yen'          => '&#165;',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'badge_text', 'class',
			[
				'pricing-table-badge',
				'pricing-table-badge--' . $settings['badge_position']
			]
		);

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'pricing-table-title' );

		$this->add_inline_editing_attributes( 'price', 'basic' );
		$this->add_render_attribute( 'price', 'class', 'pricing-table-price-text' );

		$this->add_inline_editing_attributes( 'original_price', 'basic' );
		$this->add_render_attribute( 'original_price', 'class', 'pricing-table-price-text' );

		$this->add_inline_editing_attributes( 'period', 'basic' );
		$this->add_render_attribute( 'period', 'class', 'pricing-table-period' );

		$this->add_inline_editing_attributes( 'features_title', 'basic' );
		$this->add_render_attribute( 'features_title', 'class', 'pricing-table-features-title' );

		$this->add_inline_editing_attributes( 'description', 'intermediate' );
		$this->add_render_attribute( 'description', 'class', 'pricing-table-description' );

		$this->add_inline_editing_attributes( 'button_text', 'none' );
		$this->add_render_attribute( 'button_text', 'class', 'pricing-table-btn' );

		$this->add_inline_editing_attributes( 'footer_description', 'intermediate' );
		$this->add_render_attribute( 'footer_description', 'class', 'pricing-table-footer-description' );

		$this->add_link_attributes( 'button_text', $settings['button_link'] );

		if ( $settings['currency'] === 'custom' ) {
			$currency = $settings['currency_custom'];
		} else {
			$currency = self::get_currency_symbol( $settings['currency'] );
		}
		?>

		<?php if ( $settings['show_badge'] ) : ?>
			<span <?php $this->print_render_attribute_string( 'badge_text' ); ?>><?php echo esc_html( $settings['badge_text'] ); ?></span>
		<?php endif; ?>

		<div class="pricing-table-header">
			<?php if ( 'before_header' == $settings['icon_position'] ) : ?>
				<?php if ( $settings['media_type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
					$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
					?>
					<div class="pricing-table-media pricing-table-media--image">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ); ?>
					</div>
				<?php elseif ( ! empty( $settings['icon'] ) && ! empty( $settings['icon']['value'] ) ) : ?>
					<div class="pricing-table-media pricing-table-media--icon">
						<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( $settings['title'] ) : ?>
				<h2 <?php $this->print_render_attribute_string( 'title' ); ?>><?php echo omexer_kses_basic( $settings['title'] ); ?></h2>
			<?php endif; ?>
			<?php if ( 'after_header' == $settings['icon_position'] ) : ?>
				<?php if ( $settings['media_type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
					$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
					?>
					<div class="pricing-table-media pricing-table-media--image">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ); ?>
					</div>
				<?php elseif ( ! empty( $settings['icon'] ) && ! empty( $settings['icon']['value'] ) ) : ?>
					<div class="pricing-table-media pricing-table-media--icon">
						<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<?php if ( 'after_header' == $settings['price_position'] ) : ?>
			<div class="pricing-table-price">
				<div class="pricing-table-price-tag">
					<?php if ( $settings['original_price'] ):?>
						<div class="pricing-table-original-price">
							<span class="pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'original_price' ); ?>><?php echo omexer_kses_basic( $settings['original_price'] ); ?></span>
						</div>
					<?php endif; ?>
					<div class="pricing-table-current-price">
						<span class="pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'price' ); ?>><?php echo omexer_kses_basic( $settings['price'] ); ?></span>
					</div>
				</div>
				<?php if ( $settings['period'] ) : ?>
					<div <?php $this->print_render_attribute_string( 'period' ); ?>><?php echo omexer_kses_basic( $settings['period'] ); ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="pricing-table-body">
			<?php if ( $settings['features_title'] ) : ?>
				<h3 <?php $this->print_render_attribute_string( 'features_title' ); ?>><?php echo omexer_kses_basic( $settings['features_title'] ); ?></h3>
			<?php endif; ?>

			<?php if ( is_array( $settings['features_list'] )  && 0 != count($settings['features_list']) ) :  ?>
				<ul class="pricing-table-features-list">
					<?php foreach ( $settings['features_list'] as $index => $feature ) :
						$name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
						// $this->add_inline_editing_attributes( $name_key, 'intermediate' );
						$this->add_render_attribute( $name_key, 'class', 'pricing-table-feature-text' );
						if ( $feature['tooltip_text'] ) {
							$this->add_render_attribute( $name_key, 'class', 'pricing-table-feature-tooltip' );
						}
						?>
						<li class="<?php echo 'elementor-repeater-item-' . $feature['_id']; ?>">
							<?php if ( ! empty( $feature['icon'] ) || ! empty( $feature['selected_icon'] ) ) :
                                Icons_Manager::render_icon( $feature['icon'], [ 'aria-hidden' => 'true' ] );
							endif; ?>
							<div <?php $this->print_render_attribute_string( $name_key ); ?>>
								<?php echo omexer_kses_intermediate( $feature['text'] ); ?>
								<?php if ( $feature['tooltip_text'] ) : ?>
									<span class="pricing-table-feature-tooltip-text"><?php echo esc_html( $feature['tooltip_text'] ); ?></span>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if ( $settings['description'] ) : ?>
			<div <?php $this->print_render_attribute_string( 'description' ); ?>><?php echo omexer_kses_intermediate( $settings['description'] ); ?></div>
		<?php endif; ?>

		<?php if ( 'before_button' == $settings['price_position'] ) : ?>
			<div class="pricing-table-price">
				<div class="pricing-table-price-tag">
					<?php if($settings['original_price'] ):?>
						<div class="pricing-table-original-price">
							<span class="pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'original_price' ); ?>><?php echo omexer_kses_basic( $settings['original_price'] ); ?></span>
						</div>
					<?php endif; ?>
					<div class="pricing-table-current-price">
						<span class="pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'price' ); ?>><?php echo omexer_kses_basic( $settings['price'] ); ?></span>
					</div>
				</div>
				<?php if ( $settings['period'] ) : ?>
					<div <?php $this->print_render_attribute_string( 'period' ); ?>><?php echo omexer_kses_basic( $settings['period'] ); ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $settings['button_text'] ) : ?>
			<a <?php $this->print_render_attribute_string( 'button_text' ); ?>><?php echo omexer_kses_basic( $settings['button_text'] ); ?></a>
		<?php endif; ?>

		<?php if ( $settings['footer_description'] ) : ?>
			<div <?php $this->print_render_attribute_string( 'footer_description' ); ?>><?php echo omexer_kses_intermediate( $settings['footer_description'] ); ?></div>
		<?php endif; ?>

		<?php
	}
}