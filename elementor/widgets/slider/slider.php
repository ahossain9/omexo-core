<?php
/**
 * omexer_insight step flow widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */
namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;
// Exit if accessed directly

class Slider extends Widget_Base {

    public function get_name() {
        return 'omexer-slider';
    }

    public function get_title() {
        return __( 'Slider', 'omexer-insight' );
    }

    public function get_icon() {
        return 'emexso-icon eicon-slides';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_script_depends() {
        return [
            'omexer-script',
        ];
    }

    public function get_keywords() {
        return [
            'slider',
            'carousel',
            'omexer slider',
            'slider show',
            'slidershow',
            'omexer'
        ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slider_image',
            [
                'label' => __( 'Image', 'omexer-insight' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'slider_image_size',
                'default' => 'large',
            ]
        );
        $repeater->add_control(
			'show_slider_bg_image',
			[
				'label' => __( 'Show Background Image', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $repeater->add_control(
            'slider_bg_image',
            [
                'label' => __( 'Background Image', 'omexer-insight' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_slider_bg_image' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'slider_sub_title', [
                'label'       => __( 'Sub Title', 'omexer-insight' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Limited Time Offer', 'omexer-insight' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'slider_title', [
                'label'       => __( 'Title', 'omexer-insight' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Best Fashionable Digital Watch.', 'omexer-insight' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'slider_description', [
                'label'      => __( 'Description', 'omexer-insight' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'omexer-insight' ),
                'show_label' => false,
            ]
        );
        $repeater->add_control(
			'button_text', [
				'label'       => __( 'Button Text', 'omexer-insight' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Shop Now' , 'omexer-insight' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label'         => __( 'Button', 'plugin-domain' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'omexer-insight' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);
        $this->add_control(
            'slider_item',
            [
                'label'   => __( 'Slider Item', 'omexer-insight' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_sub_title'   => __( 'Slider Sub Title 1', 'omexer-insight' ),
                        'slider_title'       => __( 'Slider Title 1', 'omexer-insight' ),
                        'slider_description' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'omexer-insight' ),
                    ],
                    [
                        'slider_sub_title'   => __( 'Slider Sub Title 2', 'omexer-insight' ),
                        'slider_title'       => __( 'Slider Title 2', 'omexer-insight' ),
                        'slider_description' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'omexer-insight' ),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );
        $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'omexer-insight' ),
            ]
        );
        $this->add_control(
            'slider_in_animation',
            [
                'label' => __( 'In Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeIn',
            ]
        );
        $this->add_control(
            'slider_out_animation',
            [
                'label' => __( 'Out Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeOut',
            ]
        );
        $this->add_control(
            'slider_items',
            [
                'label'   => esc_html__( 'Slider Items', 'omexer-insight' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 5,
                'step'    => 1,
                'default' => 1
            ]
        );
        $this->add_control(
            'slider_arrows',
            [
                'label'        => esc_html__( 'Slider Arrow', 'omexer-insight' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );
        $this->add_control(
            'slider_dots',
            [
                'label' => esc_html__( 'Slider Dots', 'omexer-insight' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'slider_pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label_off'    => __( 'No', 'omexer-insight' ),
                'label_on'     => __( 'Yes', 'omexer-insight' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'label'        => __( 'Pause on Hover?', 'omexer-insight' ),
            ]
        );
        $this->add_control(
            'slider_centermode',
            [
                'label'        => esc_html__( 'Center Mode', 'omexer-insight' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'slider_centerpadding',
            [
                'label'     => esc_html__( 'Center padding', 'omexer-insight' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 500,
                'step'      => 1,
                'default'   => 50,
                'condition' => [
                    'slcentermode' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_autolay',
            [
                'label'        => esc_html__( 'Slider Autoplay', 'omexer-insight' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator'    => 'before',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => __( 'Autoplay Speed', 'omexer-insight' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'slider_animation_speed',
            [
                'label'   => __( 'Autoplay Animation speed', 'omexer-insight' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'heading_tablet',
            [
                'label'     => __( 'Tablet', 'omexer-insight' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'slider_tablet_display_items',
            [
                'label'   => __( 'Slider Items', 'omexer-insight' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'slider_heading_mobile',
            [
                'label'     => __( 'Mobile Phone', 'omexer-insight' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'slider_mobile_display_items',
            [
                'label'   => __( 'Slider Items', 'omexer-insight' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 4,
                'step'    => 1,
                'default' => 1,
            ]
        );
        $this->end_controls_section();

        // Style tab
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => __( 'General', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'slider_global_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_global_bg_color',
            [
                'label' => __( 'Background Color', 'omexer-insight' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-color: {{VALUE}}',
                ],
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
        $this->add_control(
            'slider_img_title_heading',
            [
                'label' => __( 'Slide Image', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_responsive_control(
            'slider_img_spacing',
            [
                'label' => __( 'Sapcing', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .slider-image' => 'margin-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'slider_img_border',
            [
                'label'      => __( 'Border Radius', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_bg_img_title_heading',
            [
                'label' => __( 'Background Image', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_bg_image_size',
            [
                'label' => __( 'Background Size', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __( 'Cover', 'omexer-insight' ),
                    'contain' => __( 'Contain', 'omexer-insight' ),
                    'auto' => __( 'Auto', 'omexer-insight' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-size: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'slider_bg_image_position',
            [
                'label' => __( 'Position', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'left top' => __( 'left top','omexer-insight' ),
                    'left center' => __( 'left center', 'omexer-insight' ),
                    'left bottom' => __( 'left bottom', 'omexer-insight' ),
                    'right top' => __( 'right top', 'omexer-insight' ),
                    'right center' => __( 'right center', 'omexer-insight' ),
                    'right bottom' => __( 'right bottom', 'omexer-insight' ),
                    'center top' => __( 'center top', 'omexer-insight' ),
                    'center center' => __( 'center center', 'omexer-insight' ),
                    'center bottom' => __( 'center bottom', 'omexer-insight' ),
                    'initial' => __( 'initial', 'omexer-insight' ),
                    'inherit' => __( 'inherit', 'omexer-insight' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-single' => 'background-position: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'show_slider_bg_img_overlay',
            [
                'label' => __( 'Background Overlay', 'omexer-insight' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'no',
            ]
        );
        $this->add_control(
            'slider_bg_img_overlay_color',
            [
                'label' => __( 'Color', 'omexer-insight' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-single:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_slider_bg_img_overlay' => 'yes',
                ]
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
            'slider_content_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_content_align',
            [
                'label'   => __( 'Alignment', 'omexer-insight' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'omexer-insight' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'omexer-insight' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'omexer-insight' ),
                        'icon'  => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content' => 'text-align: {{VALUE}};',
                ],
                'default'   => 'left',
            ]
        );
        $this->add_responsive_control(
            'slider_content_spacing',
            [
                'label' => __( 'Sapcing', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .slider-content' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label'      => __( 'Width', 'omexer-insight' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'  => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_sub_title_heading',
            [
                'label' => __( 'Sub Title', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_sub_title_color',
            [
                'label' => __( 'Color', 'omexer-insight' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_sub_title_typography',
                'label' => __( 'Typography', 'omexer-insight' ),
                'selector' => '{{WRAPPER}} .slider-content h4',
            ]
        );
        $this->add_responsive_control(
            'slider_sub_title_spacing',
            [
                'label' => __( 'Spacing', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_sub_title_animation',
			[
				'label' => __( 'Show Animation', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_sub_title_animation',
            [
                'label' => __( 'Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_sub_title_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_sub_title_anim_delay',
            [
                'label' => __( 'Animation Delay', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'show_sub_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_title_heading',
            [
                'label' => __( 'Title', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_title_color',
            [
                'label' => __( 'Color', 'omexer-insight' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_title_typography',
                'label' => __( 'Typography', 'omexer-insight' ),
                'selector' => '{{WRAPPER}} .slider-content h2',
            ]
        );
        $this->add_responsive_control(
            'slider_title_spacing',
            [
                'label' => __( 'Spacing', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_title_animation',
			[
				'label' => __( 'Show Animation', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_title_animation',
            [
                'label' => __( 'Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_title_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_title_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_title_anim_delay',
            [
                'label' => __( 'Animation Delay', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'show_title_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_desc_heading',
            [
                'label' => __( 'Description', 'omexer-insight' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_desc_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slider_desc_color',
            [
                'label' => __( 'Color', 'omexer-insight' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_desc_typography',
                'label' => __( 'Typography', 'omexer-insight' ),
                'selector' => '{{WRAPPER}} .slider-description',
            ]
        );
        $this->add_responsive_control(
            'slider_desc_spacing',
            [
                'label' => __( 'Spacing', 'omexer-insight' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'show_desc_animation',
			[
				'label' => __( 'Show Animation', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_desc_animation',
            [
                'label' => __( 'Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_desc_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_desc_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_desc_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_desc_anim_delay',
            [
                'label' => __( 'Animation Delay', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'condition' => [
                    'show_desc_animation' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => __( 'Button', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'slider_button_typography',
                'label'    => __( 'Typography', 'omexer-insight' ),
                'selector' => '{{WRAPPER}} .slider-btn a',
            ]
        );
        $this->start_controls_tabs(
            'slider_button_tabs'
        );
            $this->start_controls_tab(
                'slider_button_normal_tab',
                [
                    'label' => __( 'Normal', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_button_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_button_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_button_hover_tab',
                [
                    'label' => __( 'Hover', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_button_hover_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_button_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider-btn a:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_button_border',
                'label'     => __( 'Border', 'omexer-insight' ),
                'selector'  => '{{WRAPPER}} .slider-btn a',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'slider_button_radius',
            [
                'label'      => __( 'Border Radius', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_button_shadow',
                'label'    => __( 'Box Shadow', 'omexer-insight' ),
                'selector' => '{{WRAPPER}} .slider-btn a',
            ]
        );

        $this->add_responsive_control(
            'slider_button_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
			'show_button_animation',
			[
				'label' => __( 'Show Animation', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'slider_button_animation',
            [
                'label' => __( 'Animation', 'omexer-insight' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'fadeIn'             => __( 'Fade In','omexer-insight' ),
                    'fadeInDown'         => __( 'Fade In Down','omexer-insight' ),
                    'fadeInDownBig'      => __( 'Fade In Down Big','omexer-insight' ),
                    'fadeInLeft'         => __( 'Fade In Left','omexer-insight' ),
                    'fadeInLeftBig'      => __( 'Fade In Left Big','omexer-insight' ),
                    'fadeInRight'        => __( 'Fade In Right','omexer-insight' ),
                    'fadeInRightBig'     => __( 'Fade In Right Big','omexer-insight' ),
                    'fadeInUp'           => __( 'Fade In Up','omexer-insight' ),
                    'fadeInUpBig'        => __( 'Fade In Up Big','omexer-insight' ),
                    'fadeInTopLeft'      => __( 'Fade In Top Left','omexer-insight' ),
                    'fadeInTopRight'     => __( 'Fade In Top Right','omexer-insight' ),
                    'fadeInBottomLeft'   => __( 'Fade In Bottom Left','omexer-insight' ),
                    'fadeInBottomRight'  => __( 'Fade In Bottom Right','omexer-insight' ),
                    'fadeOut'            => __( 'Fade Out','omexer-insight' ),
                    'fadeOutDown'        => __( 'Fade Out Down','omexer-insight' ),
                    'fadeOutDownBig'     => __( 'Fade Out Down Big','omexer-insight' ),
                    'fadeOutLeft'        => __( 'Fade Out Left','omexer-insight' ),
                    'fadeOutLeftBig'     => __( 'Fade Out Left Big','omexer-insight' ),
                    'fadeOutRight'       => __( 'Fade Out Right','omexer-insight' ),
                    'fadeOutRightBig'    => __( 'Fade Out Right Big','omexer-insight' ),
                    'fadeOutUp'          => __( 'Fade Out Up','omexer-insight' ),
                    'fadeOutUpBig'       => __( 'Fade Out Up Big','omexer-insight' ),
                    'fadeOutTopLeft'     => __( 'Fade Out Top Left','omexer-insight' ),
                    'fadeOutTopRight'    => __( 'Fade Out Top Right','omexer-insight' ),
                    'fadeOutBottomRight' => __( 'Fade Out Bottom Right','omexer-insight' ),
                    'fadeOutBottomLeft'  => __( 'Fade Out Bottom Left','omexer-insight' ),
                    'bounce'             => __( 'Bounce','omexer-insight' ),
                    'flash'              => __( 'Flash','omexer-insight' ),
                    'pulse'              => __( 'Pulse','omexer-insight' ),
                    'rubberBand'         => __( 'Rubber Band','omexer-insight' ),
                    'shakeX'             => __( 'ShakeX','omexer-insight' ),
                    'shakeY'             => __( 'ShakeY','omexer-insight' ),
                    'headShake'          => __( 'Head Shake','omexer-insight' ),
                    'swing'              => __( 'Swing','omexer-insight' ),
                    'tada'               => __( 'Tada','omexer-insight' ),
                    'wobble'             => __( 'Wobble','omexer-insight' ),
                    'heartBeat'          => __( 'Heart Beat','omexer-insight' ),
                    'backInDown'         => __( 'Back In Down','omexer-insight' ),
                    'backInLeft'         => __( 'Back In Left','omexer-insight' ),
                    'backInRight'        => __( 'Back In Right','omexer-insight' ),
                    'backInUp'           => __( 'Back In Up','omexer-insight' ),
                    'backOutDown'        => __( 'Back Out Down','omexer-insight' ),
                    'backOutLeft'        => __( 'Back Out Left','omexer-insight' ),
                    'backOutRight'       => __( 'Back Out Right','omexer-insight' ),
                    'backOutUp'          => __( 'Back Out Up','omexer-insight' ),
                    'bounceIn'           => __( 'Bounce In','omexer-insight' ),
                    'bounceInDown'       => __( 'Bounce In Down','omexer-insight' ),
                    'bounceInLeft'       => __( 'Bounce In Left','omexer-insight' ),
                    'bounceInRight'      => __( 'bounceInRight','omexer-insight' ),
                    'bounceInUp'         => __( 'Bounce In Up','omexer-insight' ),
                    'bounceOut'          => __( 'Bounce Out','omexer-insight' ),
                    'bounceOutDown'      => __( 'Bounce Out Down','omexer-insight' ),
                    'bounceOutLeft'      => __( 'Bounce Out Left','omexer-insight' ),
                    'bounceOutRight'     => __( 'Bounce Out Right','omexer-insight' ),
                    'bounceOutUp'        => __( 'Bounce Out Up','omexer-insight' ),
                    'flip'               => __( 'Flip','omexer-insight' ),
                    'flipInX'            => __( 'Flip In X','omexer-insight' ),
                    'flipInY'            => __( 'Flip In Y','omexer-insight' ),
                    'flipOutX'           => __( 'Flip Out X','omexer-insight' ),
                    'flipOutY'           => __( 'Flip Out Y','omexer-insight' ),
                    'lightSpeedInRight'  => __( 'Light Speed In Right','omexer-insight' ),
                    'lightSpeedInLeft'   => __( 'Light Speed In Left','omexer-insight' ),
                    'lightSpeedOutRight' => __( 'Light Speed Out Right','omexer-insight' ),
                    'lightSpeedOutLeft'  => __( 'Light Speed Out Left','omexer-insight' ),
                    'rotateIn'           => __( 'Rotate In','omexer-insight' ),
                    'rotateInDownLeft'   => __( 'Rotate In Down Left','omexer-insight' ),
                    'rotateInDownRight'  => __( 'Rotate In Down Right','omexer-insight' ),
                    'rotateInUpLeft'     => __( 'Rotate In Up Left','omexer-insight' ),
                    'rotateInUpRight'    => __( 'Rotate In Up Right','omexer-insight' ),
                    'rotateOut'          => __( 'Rotate Out','omexer-insight' ),
                    'rotateOutDownLeft'  => __( 'Rotate Out Down Left','omexer-insight' ),
                    'rotateOutDownRight' => __( 'Rotate Out Down Right','omexer-insight' ),
                    'rotateOutUpLeft'    => __( 'Rotate Out Up Left','omexer-insight' ),
                    'rotateOutUpRight'   => __( 'Rotate Out Up Right','omexer-insight' ),
                    'hinge'              => __( 'Hinge','omexer-insight' ),
                    'jackInTheBox'       => __( 'Jack In The Box','omexer-insight' ),
                    'rollIn'             => __( 'Roll In','omexer-insight' ),
                    'rollOut'            => __( 'Roll Out','omexer-insight' ),
                    'zoomIn'             => __( 'Zoom In','omexer-insight' ),
                    'zoomInDown'         => __( 'Zoom In Down','omexer-insight' ),
                    'zoomInLeft'         => __( 'Zoom In Left','omexer-insight' ),
                    'zoomInRight'        => __( 'Zoom In Right','omexer-insight' ),
                    'zoomInUp'           => __( 'Zoom In Up','omexer-insight' ),
                    'zoomOut'            => __( 'Zoom Out','omexer-insight' ),
                    'zoomOutDown'        => __( 'Zoom Out Down','omexer-insight' ),
                    'zoomOutLeft'        => __( 'Zoom Out Left','omexer-insight' ),
                    'zoomOutRight'       => __( 'Zoom Out Right','omexer-insight' ),
                    'zoomOutUp'          => __( 'Zoom Out Up','omexer-insight' ),
                    'slideInDown'        => __( 'Slide In Down','omexer-insight' ),
                    'slideInLeft'        => __( 'Slide In Left','omexer-insight' ),
                    'slideInRight'       => __( 'Slide In Right','omexer-insight' ),
                    'slideInUp'          => __( 'Slide In Up','omexer-insight' ),
                    'slideOutDown'       => __( 'Slide Out Down','omexer-insight' ),
                    'slideOutLeft'       => __( 'Slide Out Left','omexer-insight' ),
                    'slideOutRight'      => __( 'Slide Out Right','omexer-insight' ),
                    'slideOutUp'         => __( 'Slide Out Up','omexer-insight' ),
                ],
                'condition' => [
                    'show_button_animation' => 'yes',
                ],
                'default'   => 'fadeInUp',
            ]
        );
        $this->add_control(
            'slider_button_anim_duartion',
            [
                'label' => __( 'Animation Duration', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'condition' => [
                    'show_button_animation' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'slider_button_anim_delay',
            [
                'label' => __( 'Animation Delay', 'omexer-insight' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 800,
                'condition' => [
                    'show_button_animation' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_nav_style',
            [
                'label' => __( 'Navigation', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'arrow_size',
			[
				'label' => __( 'Icon Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider.owl-carousel .owl-nav > div i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->start_controls_tabs(
            'slider_nav_tabs'
        );
            $this->start_controls_tab(
                'slider_nav_normal_tab',
                [
                    'label' => __( 'Normal', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_nav_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div i' => 'color: {{VALUE}}'
                        ],
                    ]
                );

                $this->add_control(
                    'slider_nav_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_nav_hover_tab',
                [
                    'label' => __( 'Hover', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_nav_hover_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div i:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_nav_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_nav_border',
                'label'     => __( 'Border', 'omexer-insight' ),
                'selector'  => '{{WRAPPER}} .slider.owl-carousel .owl-nav > div',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_nav_radius',
            [
                'label'      => __( 'Border Radius', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_nav_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_dot_style',
            [
                'label' => __( 'Dots', 'omexer-insight' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'slider_dot_tabs'
        );
            $this->start_controls_tab(
                'slider_dot_normal_tab',
                [
                    'label' => __( 'Normal', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_dot_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'color: {{VALUE}}'
                        ],
                    ]
                );

                $this->add_control(
                    'slider_dot_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'slider_dot_hover_tab',
                [
                    'label' => __( 'Hover', 'omexer-insight' ),
                ]
            );
                $this->add_control(
                    'slider_dot_hover_color',
                    [
                        'label'     => __( 'Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $this->add_control(
                    'slider_dot_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'omexer-insight' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .slider.owl-carousel .owl-nav > div:hover' => 'background-color: {{VALUE}}'
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'slider_dot_border',
                'label'     => __( 'Border', 'omexer-insight' ),
                'selector'  => '{{WRAPPER}} .slider.owl-carousel .owl-nav > div',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'slider_dot_radius',
            [
                'label'      => __( 'Border Radius', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_dot_padding',
            [
                'label'      => __( 'Padding', 'omexer-insight' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .slider.owl-carousel .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slider_settings = [
            'in_animation'    => $settings['slider_in_animation'],
            'out_animation'   => $settings['slider_out_animation'],
            'arrows'          => ( 'yes' === $settings['slider_arrows'] ),
            'dots'            => ( 'yes' === $settings['slider_dots'] ),
            'autoplay'        => ( 'yes' === $settings['slider_autolay'] ),
            'center_mode'     => ( 'yes' === $settings['slider_centermode'] ),
            'autoplay_speed'  => absint( $settings['slider_autoplay_speed'] ),
            'animation_speed' => absint( $settings['slider_animation_speed'] ),
            'pause_on_hover'  => ( 'yes' === $settings['slider_pause_on_hover'] ),
        ];

        $slider_responsive_settings = [
            'display_items'        => $settings['slider_items'],
            'tablet_display_items' => $settings['slider_tablet_display_items'],
            'mobile_display_items' => $settings['slider_mobile_display_items'],
        ];

        $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
        $this->add_render_attribute( 'slider_area_attr', 'class', 'slider owl-carousel' );
        $this->add_render_attribute( 'slider_area_attr', 'data-settings', wp_json_encode( $slider_settings ) );

        ?>
        <style>
            <?php if($settings['show_sub_title_animation'] == 'yes'):?>
            .owl-item.active .slider-content h4 {
                -webkit-animation: <?php echo $settings['slider_sub_title_anim_duartion'].'ms '.$settings['slider_sub_title_anim_delay'].'ms '.$settings['slider_sub_title_animation'];?> both;
                animation: <?php echo $settings['slider_sub_title_anim_duartion'].'ms '.$settings['slider_sub_title_anim_delay'].'ms '.$settings['slider_sub_title_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_title_animation'] == 'yes'):?>
            .owl-item.active .slider-content h2 {
                -webkit-animation: <?php echo $settings['slider_title_anim_duartion'].'ms '.$settings['slider_title_anim_delay'].'ms '.$settings['slider_title_animation'];?> both;
                animation: <?php echo $settings['slider_title_anim_duartion'].'ms '.$settings['slider_title_anim_delay'].'ms '.$settings['slider_title_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_desc_animation'] == 'yes'):?>
            .owl-item.active .slider-content .slider-description {
                -webkit-animation: <?php echo $settings['slider_desc_anim_duartion'].'ms '.$settings['slider_desc_anim_delay'].'ms '.$settings['slider_desc_animation'];?> both;
                animation: <?php echo $settings['slider_desc_anim_duartion'].'ms '.$settings['slider_desc_anim_delay'].'ms '.$settings['slider_desc_animation'];?> both;
            }
            <?php endif;?>
            <?php if($settings['show_button_animation'] == 'yes'):?>
            .owl-item.active .slider-content .slider-btn {
                -webkit-animation: <?php echo $settings['slider_button_anim_duartion'].'ms '.$settings['slider_button_anim_delay'].'ms '.$settings['slider_button_animation'];?> both;
                animation: <?php echo $settings['slider_button_anim_duartion'].'ms '.$settings['slider_button_anim_delay'].'ms '.$settings['slider_button_animation'];?> both;
            }
            <?php endif;?>
        </style>
        <div <?php echo $this->get_render_attribute_string( 'slider_area_attr' );?>>
            <?php
            if ( $settings['slider_item'] ) :
            foreach ( $settings['slider_item'] as $slider_item ):
            ?>
            <div class="slider-single" style="background-image: url(<?php if(isset($slider_item['slider_bg_image']['url'])){ echo $slider_item['slider_bg_image']['url'];}?>)">
                <?php if ( Group_Control_Image_Size::get_attachment_image_html( $slider_item, 'slider_image_size', 'slider_image' ) ):?>
                <div class = "slider-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $slider_item, 'slider_image_size', 'slider_image' );
                    ?>
                </div>
                <?php endif;?>
                <div class="slider-content">
                    <?php if ( !empty($slider_item['slider_sub_title'] )):?>
                    <h4><?php echo esc_html($slider_item['slider_sub_title']);?></h4>
                    <?php endif;?>
                    <?php if ( !empty($slider_item['slider_title'] )):?>
                    <h2><?php echo esc_html($slider_item['slider_title']);?></h2>
                    <?php endif;?>
                    <div class="slider-description">
                        <?php echo $slider_item['slider_description'];?>
                    </div>
                    <div class="slider-btn">
                      <?php
                        $target = $slider_item['button_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $slider_item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <a href="<?php echo esc_attr($slider_item['button_link']['url']);?>" <?php echo $target.' '.$nofollow;?>><?php echo esc_html($slider_item['button_text']);?></a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
        <?php
     
    }

}