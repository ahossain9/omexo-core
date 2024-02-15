<?php

/**
 * omexer_insight mini cart widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

defined('ABSPATH') || die();

class Mini_Cart extends Widget_Base
{

    public function get_name()
    {
        return 'omexer-mini-cart';
    }

    public function get_title()
    {
        return __('Mini Cart', 'omexer-insight');
    }

    public function get_icon()
    {
        return 'omexer-insight-icon eicon-cart-medium';
    }

    public function get_categories()
    {
        return ['omexer_insight_cat_two'];
    }

    public function get_keywords()
    {
        return [
            'cart',
            'mini cart',
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
            'styles',
            [
                'label' => __('Styles', 'omexer-insight'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-one' => __('Style One', 'omexer-insight')
                ],
                'default' => 'style-one'
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
            'cart_align',
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
                    '{{WRAPPER}} .omexer-insight-mini-cart' => 'text-align: {{VALUE}}!important;',
                ],
                'default' => 'left',
            ]
        );
        $this->add_control(
            'icon_size_heading',
            [
                'label' => __('Cart Icon', 'omexer-insight'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Size', 'omexer-insight'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quantity_heading',
            [
                'label' => __('Quantity Number', 'omexer-insight'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'quantity_size',
            [
                'label'          => __('Size', 'omexer-insight'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon .cart-total-number' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'quantity_color',
            [
                'label' => __('Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon .cart-total-number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quantity_bg_color',
            [
                'label' => __('Background Color', 'omexer-insight'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon .cart-total-number' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'quantity_position',
            [
                'label' => __('Position', 'omexer-insight'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon .cart-total-number' => 'position: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'quantity_width',
            [
                'label'          => __('Width', 'omexer-insight'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .omexer-insight-mini-cart .cart-icon .cart-total-number' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="omexer-insight-mini-cart">
            <?php global $woocommerce;
            ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon">
                <i class="eicon-cart-medium"></i>
                <span class="cart-total-number"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
            </a>
        </div>
<?php

    }
}
