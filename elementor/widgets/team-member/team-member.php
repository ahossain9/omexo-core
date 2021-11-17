<?php
/**
 * omexer_insight team member widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */
namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
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
use Happy_Addons\Elementor\Traits\Button_Renderer;

defined( 'ABSPATH' ) || die();

class Team_Member extends Widget_Base {

	public function get_name() {
        return 'omexer-team-member';
    }
    
    public function get_title() {
        return __( 'Teacher', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-person';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [ 
            'team',
            'team member',
            'team members',
            'member',
            'members',
            'teacher',
            'teachers',
            'omexer',
        ];
    }

	protected static function get_profile_names() {
		return [
			'500px'          => __( '500px', 'omexer-insight' ),
			'apple'          => __( 'Apple', 'omexer-insight' ),
			'behance'        => __( 'Behance', 'omexer-insight' ),
			'bitbucket'      => __( 'BitBucket', 'omexer-insight' ),
			'codepen'        => __( 'CodePen', 'omexer-insight' ),
			'delicious'      => __( 'Delicious', 'omexer-insight' ),
			'deviantart'     => __( 'DeviantArt', 'omexer-insight' ),
			'digg'           => __( 'Digg', 'omexer-insight' ),
			'dribbble'       => __( 'Dribbble', 'omexer-insight' ),
			'email'          => __( 'Email', 'omexer-insight' ),
			'facebook'       => __( 'Facebook', 'omexer-insight' ),
			'flickr'         => __( 'Flicker', 'omexer-insight' ),
			'foursquare'     => __( 'FourSquare', 'omexer-insight' ),
			'github'         => __( 'Github', 'omexer-insight' ),
			'houzz'          => __( 'Houzz', 'omexer-insight' ),
			'instagram'      => __( 'Instagram', 'omexer-insight' ),
			'jsfiddle'       => __( 'JS Fiddle', 'omexer-insight' ),
			'linkedin'       => __( 'LinkedIn', 'omexer-insight' ),
			'medium'         => __( 'Medium', 'omexer-insight' ),
			'pinterest'      => __( 'Pinterest', 'omexer-insight' ),
			'product-hunt'   => __( 'Product Hunt', 'omexer-insight' ),
			'reddit'         => __( 'Reddit', 'omexer-insight' ),
			'slideshare'     => __( 'Slide Share', 'omexer-insight' ),
			'snapchat'       => __( 'Snapchat', 'omexer-insight' ),
			'soundcloud'     => __( 'SoundCloud', 'omexer-insight' ),
			'spotify'        => __( 'Spotify', 'omexer-insight' ),
			'stack-overflow' => __( 'StackOverflow', 'omexer-insight' ),
			'tripadvisor'    => __( 'TripAdvisor', 'omexer-insight' ),
			'tumblr'         => __( 'Tumblr', 'omexer-insight' ),
			'twitch'         => __( 'Twitch', 'omexer-insight' ),
			'twitter'        => __( 'Twitter', 'omexer-insight' ),
			'vimeo'          => __( 'Vimeo', 'omexer-insight' ),
			'vk'             => __( 'VK', 'omexer-insight' ),
			'website'        => __( 'Website', 'omexer-insight' ),
			'whatsapp'       => __( 'WhatsApp', 'omexer-insight' ),
			'wordpress'      => __( 'WordPress', 'omexer-insight' ),
			'xing'           => __( 'Xing', 'omexer-insight' ),
			'yelp'           => __( 'Yelp', 'omexer-insight' ),
			'youtube'        => __( 'YouTube', 'omexer-insight' ),
		];
	}

	/**
	 * Register content related controls
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'_section_info',
			[
				'label' => __( 'Information', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Name', 'omexer-insight' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Adam Smith',
				'placeholder' => __( 'Type Member Name', 'omexer-insight' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'job_title',
			[
				'label' => __( 'Designation', 'omexer-insight' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Developer', 'omexer-insight' ),
				'placeholder' => __( 'Type Member Job Title', 'omexer-insight' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'bio',
			[
				'label' => __( 'Short Bio', 'omexer-insight' ),
				'description' => omexer_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. ', 'omexer-insight' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_link', [
				'label' => __( 'Title Link', 'omexer-insight' ),
				'placeholder' => __( 'Add your profile link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'autocomplete' => false,
				'show_external' => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_social',
			[
				'label' => __( 'Social Icons', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Profile Name', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'select2options' => [
					'allowClear' => false,
				],
				'options' => self::get_profile_names()
			]
		);

		$repeater->add_control(
			'link', [
				'label' => __( 'Profile Link', 'omexer-insight' ),
				'placeholder' => __( 'Add your profile link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'autocomplete' => false,
				'show_external' => false,
				'condition' => [
					'name!' => 'email'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'customize',
			[
				'label' => __( 'Want To Customize?', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'omexer-insight' ),
				'label_off' => __( 'No', 'omexer-insight' ),
				'return_value' => 'yes',
				'style_transfer' => true,
			]
		);

		$repeater->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes']
			]
		);
		$repeater->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$repeater->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'profiles',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
				'default' => [
					[
						'link' => ['url' => 'https://facebook.com/'],
						'name' => 'facebook'
					],
					[
						'link' => ['url' => 'https://twitter.com/'],
						'name' => 'twitter'
					],
					[
						'link' => ['url' => 'https://linkedin.com/'],
						'name' => 'linkedin'
					]
				],
			]
		);

		$this->add_control(
			'show_profiles',
			[
				'label' => __( 'Social Icons', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_global',
			[
				'label' => __( 'General', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'global_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'global_align',
			[
				'label' => __( 'Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				'toggle' => true,
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->start_controls_tabs( 'team_tabs' );
		$this->start_controls_tab(
			'team_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'team_global_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_global_border',
				'selector' => '{{WRAPPER}} .member-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_global_box_shadow',
				'selector' => '{{WRAPPER}} .member-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'team_hover_global_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_hover_global_border',
				'selector' => '{{WRAPPER}} .member-wrap:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_hover_global_box_shadow',
				'selector' => '{{WRAPPER}} .member-wrap:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'goabal_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .member-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Image', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'%' => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .member-figure' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .member-figure img'
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .member-figure img'
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-figure img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Name, Designation & Bio', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-name, .member-name a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Text Hover Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-name, .member-name a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .member-name, .member-name a'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .member-name, .member-name a',
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Designation', 'omexer-insight' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-position' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'selector' => '{{WRAPPER}} .member-position',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'job_title_text_shadow',
				'selector' => '{{WRAPPER}} .member-position',
			]
		);

		$this->add_control(
			'_heading_bio',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Short Bio', 'omexer-insight' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'bio_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bio_typography',
				'selector' => '{{WRAPPER}} .member-bio',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'bio_text_shadow',
				'selector' => '{{WRAPPER}} .member-bio',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_social',
			[
				'label' => __( 'Social Icons', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'social_wrap_padding',
			[
				'label' => __( 'Area Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'social_area_width',
			[
				'label' => __( 'Area Width', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_bottom_space',
			[
				'label' => __( 'Area Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-wrap:hover .member-links' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_are_bg_color',
			[
				'label' => __( 'Area Background', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-wrap .member-links' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_spacing',
			[
				'label' => __( 'Icon Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'links_width',
			[
				'label' => __( 'Icon Width', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_height',
			[
				'label' => __( 'Icon Height', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_line_height',
			[
				'label' => __( 'Icon Line Height', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_icon_size',
			[
				'label' => __( 'Icon Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'links_border',
				'selector' => '{{WRAPPER}} .member-links > a'
			]
		);

		$this->add_responsive_control(
			'links_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_links_colors' );
		$this->start_controls_tab(
			'_tab_links_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'links_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_links_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label' => __( 'Border Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .member-links > a:hover, {{WRAPPER}} .member-links > a:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'links_border_border!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'member-name' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'member-position' );

		$this->add_inline_editing_attributes( 'bio', 'intermediate' );
		$this->add_render_attribute( 'bio', 'class', 'member-bio' );
		?>

		<div class="member-wrap">
			<div class="member-image">
				<?php if ( $settings['image']['url'] || $settings['image']['id'] ) :
					$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
					?>
					<figure class="member-figure">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
					</figure>
				<?php endif; ?>
				<?php if ( $settings['show_profiles' ] && is_array( $settings['profiles' ] ) ) : ?>
					<div class="member-links">
						<?php
						foreach ( $settings['profiles'] as $profile ) :
							$icon = $profile['name'];
							$url = $profile['link']['url'];

							if ( $profile['name'] === 'website' ) {
								$icon = 'globe far';
							} elseif ( $profile['name'] === 'email' ) {
								$icon = 'envelope far';
								$url = 'mailto:' . antispambot( $profile['email'] );
							} else {
								$icon .= ' fab';
							}

							printf( '<a target="_blank" rel="noopener" href="%s" class="elementor-repeater-item-%s"><i class="fa fa-%s" aria-hidden="true"></i></a>',
								$url,
								esc_attr( $profile['_id'] ),
								esc_attr( $icon )
							);
						endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="member-body">
				<?php
					$target = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<?php if ( !empty($settings['title']) && !empty($settings['title_link']['url']) ) :?>
					<h4 class="member-name"><?php echo '<a href="' . esc_attr($settings['title_link']['url']). '"' . $target . $nofollow . '>'.esc_html($settings['title']).'</a>';?></h4>
				<?php else:?>
					<h4 class="member-name"><?php echo esc_html($settings['title'])?></h4>
				<?php endif; ?>

				<?php if ( $settings['job_title' ] ) : ?>
					<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo omexer_kses_basic( $settings['job_title' ] ); ?></div>
				<?php endif; ?>

				<?php if ( $settings['bio'] ) : ?>
					<div <?php $this->print_render_attribute_string( 'bio' ); ?>>
						<p><?php echo omexer_kses_intermediate( $settings['bio'] ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
