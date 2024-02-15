<?php

/**
 * omexer_insight logo widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

defined('ABSPATH') || die();

class Site_Logo extends Widget_Base
{

    public function get_name()
    {
        return 'omexer-site-logo';
    }

    public function get_title()
    {
        return __('Site Logo', 'omexer-insight');
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
            'site logo',
            'logo',
        ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'omexer-insight'),
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label' => __('Logo', 'omexer-insight'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default-logo' => __('Default', 'omexer-insight'),
                    'custom-logo' => __('Custom', 'omexer-insight')
                ],
                'default' => 'default-logo',
            ]
        );

        $this->add_control(
            'custom_logo_image',
            [
                'label' => esc_html__('Choose Image', 'omexer-insight'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'logo_type' => 'custom-logo',
                ]
            ]
        );

        $this->add_control(
            'custom_logo_link',
            [
                'label'       => __('Link', 'omexer-insight'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'default',
                'options'     => [
                    'default' => __('Default', 'omexer-insight'),
                    'custom'  => __('Custom URL', 'omexer-insight')
                ],
                'condition' => [
                    'logo_type' => 'custom-logo',
                ]
            ]
        );

        $this->add_control(
            'custom_logo_link_url',
            [
                'label'       => __('Link', 'omexer-insight'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active'  => true
                ],
                'placeholder' => __('https://your-link.com', 'omexer-insight'),
                'condition'   => [
                    'custom_logo_link' => 'custom'
                ],
                'show_label'  => false
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __('General', 'omexer-insight'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'logo_align',
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
                    '{{WRAPPER}} .site-main-logo' => 'text-align: {{VALUE}}!important;',
                ],
                'default' => 'left',
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'omexer-insight'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .site-main-logo img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label'      => __('Max Width', 'omexer-insight'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .site-main-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="site-main-logo">
            <?php
            if ($settings['logo_type'] == 'default-logo') {
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h4 class="site-title"><a href="'. esc_url(home_url('/')) .'" rel="home">'. bloginfo('name'). '</a></h4>';
                 }
            }
            if ( $settings['logo_type'] == 'custom-logo' ) {
                if ($settings['custom_logo_link'] == 'default') {
                    echo '<a href="' . home_url() . '"><img src="' . $settings['custom_logo_image']['url'] . '" alt="' . esc_attr__('logo', 'omexer-insight'). '"></a>';
                }
                if( $settings['custom_logo_link'] == 'custom' ){
                    echo '<a href="' . $settings['custom_logo_link_url']['url'] . '"><img src="' . $settings['custom_logo_image']['url'] . '" alt="'.esc_attr__( 'logo', 'omexer-insight' ).'"></a>';
                }
            }
            ?>
        </div>
<?php

    }
}
