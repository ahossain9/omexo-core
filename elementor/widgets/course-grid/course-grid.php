<?php
/**
 * omexer_insight course grid widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */
namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Course_Grid extends Widget_Base {

    public function get_name() {
        return 'omexer-course-grid';
    }
    
    public function get_title() {
        return __( 'Course Grid', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [ 
            'course',
            'courses',
            'course grid',
            'omexer course',
            'omexer courses',
            'omexer',
        ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'omexer-insight' ),
            ]
        );
        
        $this->add_control(
            'layout_style',
            [
                'label' => __( 'Style', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Layout 1', 'omexer-insight' )
                ],
                'default' => '1',
            ]
        );
        
        $this->add_control(
            'layout_columns',
            [
                'label' => __( 'Columns', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '12' => __( '1', 'omexer-insight' ),
                    '6' => __( '2', 'omexer-insight' ),
                    '4' => __( '3', 'omexer-insight' ),
                    '3' => __( '4', 'omexer-insight' ),
                ],
                'default' => '4',
            ]
        );
        
        $this->add_control(
            'course_per_page',
            [
                'label' => __( 'Course Per Page', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 6,
            ]
        );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Query', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'course_category',
            [
                'label' => __( 'Categories', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->course_category(),
                'multiple' => true,
            ]
        );
        
        $this->add_control(
            'course_orderby',
            [
                'label' => __( 'Order By', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => __( 'Date', 'omexer-insight' ),
                    'title' => __( 'Title', 'omexer-insight' ),
                    'rand' => __( 'Random', 'omexer-insight' )
                ],
                'default' => 'date',
            ]
        );
        
        $this->add_control(
            'course_order',
            [
                'label' => __( 'Order', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __( 'Ascending', 'omexer-insight' ),
                    'DESC' => __( 'Desending', 'omexer-insight' )
                ],
                'default' => 'DESC',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_meta',
            [
                'label' => __( 'Meta', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'course_pricing_switcher',
                [
                    'label' => __( 'Price', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'course_rating_switcher',
                [
                    'label' => __( 'Rating', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'course_difficulty_level',
                [
                    'label' => __( 'Difficulty Level', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'course_meta_switcher',
                [
                    'label' => __( 'Meta', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'General', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'course_global_align',
                [
                    'label' => __( 'Alignment', 'omexer-insight' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'omexer-insight' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'omexer-insight' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'omexer-insight' ),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'text-align: {{VALUE}}!important;',
                    ],
                    'default' => 'left',
                ]
            );
        
            $this->add_responsive_control(
                'course_global_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_global_margin',
                [
                    'label' => __( 'Margin', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_global_border',
                    'label' => __( 'Border', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-card',
                ]
            );
        
            $this->add_responsive_control(
                'course_global_radius',
                [
                    'label' => __( 'Border Radius', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            
            $this->add_control(
                'global_background_color',
                [
                    'label' => __( 'Background Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
        
            $this->start_controls_tabs(
                'course_global_box_shadow_tabs'
            );
            
                $this->start_controls_tab(
                    'course_global_box_shadow_normal_tab',
                    [
                        'label' => __( 'Normal', 'omexer-insight' ),
                    ]
                );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'course_global_normal_box_shadow',
                            'label' => __( 'Box Shadow', 'omexer-insight' ),
                            'selector' => '{{WRAPPER}} .course-card',
                        ]
                    );
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'course_global_box_shadow_hover_tab',
                    [
                        'label' => __( 'Hover', 'omexer-insight' ),
                    ]
                );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'course_global_hover_box_shadow',
                            'label' => __( 'Hover Box Shadow', 'omexer-insight' ),
                            'selector' => '{{WRAPPER}} .course-card:hover',
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'course_image_width',
                [
                    'label' => __( 'Width', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
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
                        '{{WRAPPER}} .course-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_image_border',
                    'label' => __( 'Border', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-thumbnail img',
                ]
            );
        
            $this->add_responsive_control(
                'course_image_radius',
                [
                    'label' => __( 'Border Radius', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_title_heading',
            [
                'label' => __( 'Title', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
    
        $this->start_controls_tabs(
            'course_title_color_tabs'
        );
        
            $this->start_controls_tab(
                'course_title_color_normal_tab',
                [
                    'label' => __( 'Normal', 'omexer-insight' ),
                ]
            );
    
    
                $this->add_control(
                    'course_title_color',
                    [
                        'label' => __( 'Color', 'omexer-insight' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-title a' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
    
            $this->end_controls_tab();
    
            $this->start_controls_tab(
                'course_title_color_hover_tab',
                [
                    'label' => __( 'Hover', 'omexer-insight' ),
                ]
            );
    
                $this->add_control(
                    'course_title_hover_color',
                    [
                        'label' => __( 'Hover Color', 'omexer-insight' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .course-title a:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
    
            $this->end_controls_tab();
    
        $this->end_controls_tabs();

            $this->add_responsive_control(
                'course_content_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_title_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-title a',
                ]
            );
        
            $this->add_responsive_control(
                'course_title_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'course_price',
                [
                    'label' => __( 'Price', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ],
                ]
            );
        
            $this->add_control(
                'course_price_color',
                [
                    'label' => __( 'Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-price span' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_price_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-price span',
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_price_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_pricing_switcher' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'course_rating',
                [
                    'label' => __( 'Rating', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_rating_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-rating .course-rating-count',
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );
        
            $this->add_control(
                'course_rating_icon_color',
                [
                    'label' => __( 'Icon Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'course_rating_icon_sizing',
                [
                    'label' => __( 'Icon Size', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'course_rating_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-rating .tutor-star-rating-group i' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
                    ],
                    'condition' => [
                        'course_rating_switcher' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'course_level',
                [
                    'label' => __( 'Difficulty Level', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );
        
            $this->add_control(
                'course_level_color',
                [
                    'label' => __( 'Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'course_level_bg_color',
                [
                    'label' => __( 'Background Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_level_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-card .course-difficulty-level',
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_level_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_level_margin',
                [
                    'label' => __( 'Margin', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-card .course-difficulty-level' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'course_difficulty_level' => 'yes'
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => __( 'Meta', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_meta_switcher' => 'yes'
                ]
            ]
        );

            $this->add_responsive_control(
                'course_meta_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'course_meta_margin',
                [
                    'label' => __( 'Margin', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'course_meta_border',
                    'label' => __( 'Border', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-content-footer',
                ]
            );

            $this->add_responsive_control(
                'course_meta_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer .course-duration' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_meta_icon_size',
                [
                    'label' => __( 'Icon Size', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer li i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'course_meta_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 20,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .course-content-footer li i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'course_meta_text_color',
                [
                    'label' => __( 'Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .course-content-footer li' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_control(
                'course_meta_icon_color',
                [
                    'label' => __( 'Icon Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}  .course-content-footer li i' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'course_meta_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .course-content-footer li',
                ]
            );
            
        $this->end_controls_section();
    }

    protected function course_category() {
        $terms = get_terms( array(
            'taxonomy' => 'course-category',
            'hide_empty' => false,
        ) );

        $cats = [];

        if( !empty($terms) && ! is_wp_error($terms) ) {
            foreach($terms as $term) {
                $cats[$term->slug] = $term->name;
            }
        }

        return $cats;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'courses',
            'posts_per_page' => esc_attr($settings['course_per_page']),
            'orderby'        => $settings['course_orderby'],
            'order'          => $settings['course_order'],
        ];
    
        if( !empty( $settings['course_category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'course-category',
                    'field'     => 'slug',
                    'terms'     => $settings['course_category']
                ]
            ];
        }
    
        $the_query = new \WP_Query($args);
        if( $the_query->have_posts() ) :
        ?>
        <div class="course-list-wrap row">
            <?php
            while( $the_query->have_posts() ) : $the_query->the_post();
            $course_duration = get_tutor_course_duration_context();
            $course_students = tutor_utils()->count_enrolled_users_by_course();
            $course_students = !empty($course_students) ? $course_students : 0;
            $course_rating = tutor_utils()->get_course_rating();
            $review_count = $course_rating->rating_count > 1 ? 'Reviews' : 'Review';
            ?>
            <div class="col-lg-<?php echo esc_attr($settings['layout_columns']); ?> col-sm-6">
                <div class="course-card course-card-<?php echo esc_attr(get_the_ID()); ?>">
                    <div class="course-header">
                        <?php if ("yes" == $settings['course_difficulty_level']):?>
                            <span class="course-difficulty-level"><?php echo esc_html(get_tutor_course_level());?></span>
                        <?php endif;?>
                        <?php if(has_post_thumbnail()):?>
                        <div class="course-thumbnail">
                            <a href="<?php echo esc_attr(get_the_permalink());?>"><?php the_post_thumbnail();?></a>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="course-content">
                        <?php if('yes' == $settings['course_pricing_switcher']):?>
                        <div class="course-price">
                            <?php
                            $course_id = get_the_ID();
                            $price_html = '<span>'.__('Free', 'omexer-insignt').'</span>';
                            if (tutor_utils()->is_course_purchasable()) {
                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                $product    = wc_get_product( $product_id );
                                if ( $product ) {
                                    $price_html = '<span> '.$product->get_price_html() . '</span> ';
                                }
                            }
                                echo $price_html;
                            ?>
                        </div>
                        <?php endif;?>
                        <div class="course-title">
                            <h3><a href="<?php echo esc_attr(get_the_permalink());?>"><?php the_title(); ?></a></h3>
                        </div>
                        <?php if('yes' == $settings['course_rating_switcher']):?>
                        <div class="course-rating">
                            <?php
                            
                            tutor_utils()->star_rating_generator($course_rating->rating_avg);
                            ?>
                            <span class="course-rating-count">
                                <?php
                                echo '<span>(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) .' <span>'.$review_count.')</span></span>';
                                ?>
                            </span>
                        </div>
                        <?php endif;?>
                        <?php if('yes' == $settings['course_meta_switcher']):?>
                        <div class="course-content-footer">
                            <ul>
                                <li class="course-duration"><i class="fas tutor-icon-clock"></i> <?php echo $course_duration;?></li>
                                <li class="course-user"><i class="fas tutor-icon-user"></i> <?php echo $course_students;?></li>
                            </ul>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        ?>
        </div>
        <?php endif;?>
        <?php
        
    }
}
