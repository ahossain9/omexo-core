<?php
/**
 * omexer_insight blog post widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Blog_Post extends Widget_Base {

	public function get_name() {
        return 'omexer-blog-post';
    }
    
    public function get_title() {
        return __( 'Blog Post', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-table-of-contents';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [
            'blog',
            'blog post',
            'latest blog',
            'latest news',
            'omexer',
        ];
    }

    public function post_category() {
        $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ) );

        $cats = [];

        if( !empty($terms) && ! is_wp_error($terms) ) {
            foreach($terms as $term) {
                $cats[$term->term_id] = $term->name;
            }
        }

        return $cats;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'omexer-insight' ),
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
            'post_per_page',
            [
                'label' => __( 'Post Per Page', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 3,
            ]
        );
        
        
        $this->add_control(
            'post_desc_length',
            [
                'label' => __( 'Descroption Length', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
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
            'post_category',
            [
                'label' => __( 'Categories', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->post_category(),
                'multiple' => true,
            ]
        );
        
        $this->add_control(
            'post_orderby',
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
            'post_order',
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
                'author_switcher',
                [
                    'label' => __( 'Author', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
        
            $this->add_control(
                'date_switcher',
                [
                    'label' => __( 'Date', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'button_switcher',
                [
                    'label' => __( 'Button', 'omexer-insight' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'omexer-insight' ),
                    'label_off' => __( 'Hide', 'omexer-insight' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'read_more_btn_text',
                [
                    'label' => __( 'Button Text', 'omexer-insight' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Read More', 'omexer-insight' ),
                    'placeholder' => __( 'Type your button text', 'omexer-insight' ),
                    'condition' => ['button_switcher' => 'yes']
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
                'post_global_align',
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
                        '{{WRAPPER}} .blog-post' => 'text-align: {{VALUE}}!important;',
                    ],
                    'default' => 'left',
                ]
            );
        
            $this->add_responsive_control(
                'post_global_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
                
            $this->start_controls_tabs(
                'post_global_box_shadow_tabs'
            );
            
                $this->start_controls_tab(
                    'post_global_normal_tab',
                    [
                        'label' => __( 'Normal', 'omexer-insight' ),
                    ]
                );

                $this->add_control(
                    'global_background_color',
                    [
                        'label' => __( 'Background Color', 'omexer-insight' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-post' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'post_global_border',
                        'label' => __( 'Border', 'omexer-insight' ),
                        'selector' => '{{WRAPPER}} .blog-post',
                    ]
                );
            
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'post_global_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'omexer-insight' ),
                        'selector' => '{{WRAPPER}} .blog-post',
                    ]
                );
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'post_global_hover_tab',
                    [
                        'label' => __( 'Hover', 'omexer-insight' ),
                    ]
                );
                
                    $this->add_control(
                        'global_background_hover_color',
                        [
                            'label' => __( 'Background Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'post_global_hover_border',
                            'label' => __( 'Border', 'omexer-insight' ),
                            'selector' => '{{WRAPPER}} .blog-post:hover',
                        ]
                    );
                
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'post_global_hover_box_shadow',
                            'label' => __( 'Box Shadow', 'omexer-insight' ),
                            'selector' => '{{WRAPPER}} .blog-post:hover',
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();

            $this->add_responsive_control(
                'post_global_radius',
                [
                    'label' => __( 'Border Radius', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_responsive_control(
                'post_image_width',
                [
                    'label' => __( 'Width', 'omexer-insight' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 600,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .post-media img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'post_image_border',
                    'label' => __( 'Border', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .post-media img',
                ]
            );
        
            $this->add_responsive_control(
                'post_image_radius',
                [
                    'label' => __( 'Border Radius', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .post-media img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        
            $this->add_responsive_control(
                'post_content_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'post_title_heading',
                [
                    'label' => __( 'Title', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_title_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content h3 a',
                ]
            );
        
            $this->add_responsive_control(
                'post_title_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
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
                        '{{WRAPPER}} .blog-post .blog-post-content h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'post_title_color_tabs'
            );
            
                $this->start_controls_tab(
                    'post_title_color_normal_tab',
                    [
                        'label' => __( 'Normal', 'omexer-insight' ),
                    ]
                );
        
        
                    $this->add_control(
                        'post_title_color',
                        [
                            'label' => __( 'Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content h3 a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'post_title_color_hover_tab',
                    [
                        'label' => __( 'Hover', 'omexer-insight' ),
                    ]
                );
        
                    $this->add_control(
                        'post_title_hover_color',
                        [
                            'label' => __( 'Hover Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content h3:hover a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
            $this->add_control(
                'post_description_heading',
                [
                    'label' => __( 'Description', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->add_control(
                'post_description_color',
                [
                    'label' => __( 'Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_description_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content p',
                ]
            );
        
            $this->add_responsive_control(
                'post_description_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
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
                        '{{WRAPPER}} .blog-post .blog-post-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => __( 'Meta', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'post_author_date_heading',
                [
                    'label' => __( 'Author & Date', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'post_author_date_margin',
                [
                    'label' => __( 'Margin', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_author_date_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a',
                ]
            );
        
            $this->add_control(
                'post_author_date_icon_color',
                [
                    'label' => __( 'Icon Color', 'omexer-insight' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a i' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_author_date_spacing',
                [
                    'label' => __( 'Spacing', 'omexer-insight' ),
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
                        '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'post_author_date_icon_sizing',
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
                        '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'post_author_date_icon_spacing',
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
                        '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a i' => 'padding-right: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->start_controls_tabs(
                'author_date_tabs'
            );
            
                $this->start_controls_tab(
                    'author_date_normal_tab',
                    [
                        'label' => __( 'Normal', 'omexer-insight' ),
                    ]
                );
        
                    $this->add_control(
                        'author_date_color',
                        [
                            'label' => __( 'Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a' => 'color: {{VALUE}}'
                            ]
                        ]
                    );

                    $this->add_control(
                        'author_date_icon_color',
                        [
                            'label' => __( 'Icon Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a i' => 'color: {{VALUE}}'
                            ]
                        ]
                    );
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'author_date_hover_tab',
                    [
                        'label' => __( 'Hover', 'omexer-insight' ),
                    ]
                );
        
                    $this->add_control(
                        'author_date_hover_color',
                        [
                            'label' => __( 'Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a:hover' => 'color: {{VALUE}}'
                            ]
                        ]
                    );

                    $this->add_control(
                        'author_date_icon_hover_color',
                        [
                            'label' => __( 'Icon Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content ul.post-meta li a:hover i' => 'color: {{VALUE}}'
                            ]
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();

            $this->add_control(
                'post_button_heading',
                [
                    'label' => __( 'Button', 'omexer-insight' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_button_typography',
                    'label' => __( 'Typography', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a',
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
            $this->start_controls_tabs(
                'post_button_tabs'
            );
            
                $this->start_controls_tab(
                    'post_button_normal_tab',
                    [
                        'label' => __( 'Normal', 'omexer-insight' ),
                        'condition' => ['button_switcher' => 'yes']
                    ]
                );
        
                    $this->add_control(
                        'post_button_color',
                        [
                            'label' => __( 'Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a' => 'color: {{VALUE}}'
                            ],
                            'condition' => ['button_switcher' => 'yes']
                        ]
                    );
        
                    $this->add_control(
                        'post_button_bg_color',
                        [
                            'label' => __( 'Background Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a' => 'background-color: {{VALUE}}'
                            ],
                            'condition' => ['button_switcher' => 'yes']
                        ]
                    );
        
                $this->end_controls_tab();
        
                $this->start_controls_tab(
                    'post_button_hover_tab',
                    [
                        'label' => __( 'Hover', 'omexer-insight' ),
                        'condition' => ['button_switcher' => 'yes']
                    ]
                );
        
                    $this->add_control(
                        'post_button_hover_color',
                        [
                            'label' => __( 'Hover Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a:hover' => 'color: {{VALUE}}'
                            ],
                            'condition' => ['button_switcher' => 'yes']
                        ]
                    );
        
                    $this->add_control(
                        'post_button_hover_bg_color',
                        [
                            'label' => __( 'Hover Background Color', 'omexer-insight' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a:hover' => 'background-color: {{VALUE}}'
                            ],
                            'condition' => ['button_switcher' => 'yes']
                        ]
                    );
        
                $this->end_controls_tab();
        
            $this->end_controls_tabs();
        
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'post_button_border',
                    'label' => __( 'Border', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a',
                    'separator' => 'before',
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
            $this->add_responsive_control(
                'post_button_radius',
                [
                    'label' => __( 'Border Radius', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'post_button_shadow',
                    'label' => __( 'Box Shadow', 'omexer-insight' ),
                    'selector' => '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a',
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
            $this->add_responsive_control(
                'post_button_padding',
                [
                    'label' => __( 'Padding', 'omexer-insight' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .blog-post .blog-post-content .post-read-more-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => ['button_switcher' => 'yes']
                ]
            );
        
        $this->end_controls_section();
    }

    protected function render() { 

        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => esc_attr($settings['post_per_page']),
            'orderby'        => $settings['post_orderby'],
            'order'          => $settings['post_order'],
        ];

        if( !empty( $settings['post_category'] ) ) {
            $args['category__in'] = $settings['post_category'];
        }

        $query = new \WP_Query($args);

        if( $query->have_posts() ) :
    ?>
    <div class="blog-post-grid-wrap row">
        <?php while( $query->have_posts() ): ?>
        <?php $query->the_post(); ?>
        <div class="col-md-<?php echo esc_attr($settings['layout_columns']); ?>">
            <article id="post-<?php the_ID();?>" <?php post_class( ['blog-post'] );?>>
                <?php
                if ( has_post_thumbnail() ): ?>
                    <div class="post-media">
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail( 'full', ['class' => 'img-fluid'] );?>
                        </a>
                    </div>
                <?php endif;?>
                <div class="blog-post-content">
                    <ul class="post-meta">
                        <?php if( $settings['author_switcher'] == 'yes' ) : ?>
                            <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></li>
                        <?php endif; ?>
                        <?php if( $settings['date_switcher'] == 'yes' ): ?>
                            <li><a href="<?php echo esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ); ?>"><i class="fa fa-calendar"></i>20 Oct, 2020</a></li>
                        <?php endif; ?>   
                    </ul>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), $settings['post_desc_length']['size'], '' ) ); ?></p>
                    <?php if( $settings['button_switcher'] == 'yes' ): ?>
                        <div class="post-read-more-btn">
                        <?php if(!empty($settings['read_more_btn_text'])):?>
                            <a href="<?php the_permalink();?>"><?php echo esc_html($settings['read_more_btn_text'])?> <i class="icofont-simple-right"></i></a>
                        <?php else:?>
                            <a href="<?php the_permalink();?>"><?php _e('Read More', 'omexer-insight')?> <i class="icofont-simple-right"></i></a>
                        <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article><!-- #post-<?php the_ID();?> -->
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>

    <?php
        else:
    ?>
        <div class="omexer-blog-post-alert">
            <h2 class="mb-0"><?php esc_html_e('No Post Found','omexer-insight'); ?></h2>
        </div>
    <?php endif; ?>
    <?php
    }

}