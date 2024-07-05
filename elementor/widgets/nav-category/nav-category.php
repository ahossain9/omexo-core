<?php

/**
 * omexer_insight nav category widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Nav_Category extends Widget_Base
{
    private function get_available_menus()
    {

        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ($menus as $menu) :
            $options[$menu->slug] = $menu->name;
        endforeach;
        return $options;
    }

    protected $nav_menu_index = 1;

    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }

    public function get_name()
    {
        return 'omexer-nav-category';
    }

    public function get_title()
    {
        return __('Nav Category', 'omexer-insight');
    }

    public function get_icon()
    {
        return 'omexer-insight-icon eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['omexer_insight_cat_two'];
    }

    public function get_keywords()
    {
        return [
            'nav category',
            'category',
            'omexer',
        ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Menu', 'omexer-insight'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) :
            $this->add_control(
                'menu',
                [
                    'label'        => __('Choose Menu', 'omexer-insight'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                ]
            );
        else :
            $this->add_control(
                'menu_alert',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>No menu is available. Please .</strong><br>Go to the <a href="%s" target="_blank">Menus Settings</a> to create a menu.', 'omexer-insight'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info'
                ]
            );
        endif;

        $this->end_controls_section();

        $this->start_controls_section(
            'responsive_menu',
            [
                'label' => __('Responsive Menu', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tablet_responsive_menu',
            [
                'label' => __('Tablet', 'omexer-insight'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'omexer-insight'),
                'label_off' => __('Hide', 'omexer-insight'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'mobile_responsive_menu',
            [
                'label' => __('Mobile', 'omexer-insight'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'omexer-insight'),
                'label_off' => __('Hide', 'omexer-insight'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'sticky_menu',
            [
                'label' => __('Sticky Menu', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_sticky_menu',
            [
                'label' => __('Enable', 'omexer-insight'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'omexer-insight'),
                'label_off' => __('No', 'omexer-insight'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_style',
            [
                'label' => __('Menu', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'menu_global_align',
            [
                'label' => __('Alignment', 'omexer-insight'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __('Left', 'omexer-insight'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'omexer-insight'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'omexer-insight'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-menu-area' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => __('Typography', 'omexer-insight'),
                'selector' => '{{WRAPPER}} .omexo-nav-menu-wrap ul li a',
            ]
        );
        $this->add_responsive_control(
            'menu_global_padding',
            [
                'label' => __('Padding', 'omexer-insight'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_global_margin',
            [
                'label' => __('Margin', 'omexer-insight'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'menu_active_color',
            [
                'label' => __('Active Menu Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->start_controls_tabs(
            'menu_color_tabs'
        );
            $this->start_controls_tab(
                'menu_color_normal_tab',
                [
                    'label' => __('Normal', 'omexer-insight'),
                ]
            );
            $this->add_control(
                'menu_normal_color',
                [
                    'label' => __('Color', 'omexer-insight'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul li a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'menu_color_hover_tab',
                [
                    'label' => __('Hover', 'omexer-insight'),
                ]
            );
            $this->add_control(
                'menu_hover_color',
                [
                    'label' => __('Color', 'omexer-insight'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .omexo-nav-menu-wrap ul li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_dropdown_style',
            [
                'label' => __('Dropdown Menu', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dropdown_menu_global_heading',
            [
                'label' => __('Global', 'omexer-insight'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_menu_typography',
                'label' => __('Typography', 'omexer-insight'),
                'selector' => '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu a, .omexo-nav-menu-wrap ul.children li a',
            ]
        );
        $this->add_responsive_control(
            'dropdown_menu_width',
            [
                'label' => __('Width', 'omexer-insight'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu, .omexo-nav-menu-wrap ul.children' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dropdown_menu_global_bg',
            [
                'label' => __('Background', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu, .omexo-nav-menu-wrap ul.children' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dropdown_menu_global_box_shadow',
                'label' => __('Area Box Shadow', 'omexer-insight'),
                'selector' => '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu, .omexo-nav-menu-wrap ul.children',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_menu_global_border',
                'label' => __('Border', 'omexer-insight'),
                'selector' => '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu, .omexo-nav-menu-wrap ul.children',
            ]
        );

        $this->add_responsive_control(
            'dropdown_menu_global_border_radius',
            [
                'label' => __('Border Radius', 'omexer-insight'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu, .omexo-nav-menu-wrap ul.children' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dropdown_menu_item_heading',
            [
                'label' => __('Menu Item', 'omexer-insight'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_menu_item_border',
                'label' => __('Dropdown Item Border', 'omexer-insight'),
                'selector' => '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu a, .omexo-nav-menu-wrap ul.children li a',
            ]
        );
        $this->add_responsive_control(
            'dropdown_menu_item_padding',
            [
                'label' => __('Padding', 'omexer-insight'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .omexo-nav-menu-wrap ul .sub-menu a, .omexo-nav-menu-wrap ul.children li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_sticky_style',
            [
                'label' => __('Sticky Menu', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sticky_menu_global_bg',
            [
                'label' => __('Background', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .enable-sticky .header-btm-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'sticky_menu_color',
            [
                'label' => __('Menu Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .enable-sticky .omexo-nav-menu-wrap ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'sticky_menu_active_color',
            [
                'label' => __('Active Menu Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .enable-sticky .main-navigation ul li.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'nav-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'container'   => '',
        ];

        $menu_html = wp_nav_menu($args);
        ?>
        <div class="nav-menu-area">
            <nav id="nav-menu" class="omexo-nav-menu-wrap">
                <?php echo trim($menu_html); ?>
            </nav>
            <div id="responsive-menu-wrap"></div>
        </div>
    <?php

    }
}
