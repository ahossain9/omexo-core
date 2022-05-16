<?php
/**
 * omexer_insight course category image box widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Webinar_Box extends Widget_Base {

	public function get_name() {
        return 'omexer-webinar-box';
    }
    
    public function get_title() {
        return __( 'Webinar Box', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-slider-device';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [
            'webinar',
            'webinars',
            'webinar box',
            'omexer',
        ];
    }

	protected function register_controls() {
	
		$this->start_controls_section(
			'section_webinar_image',
			[
				'label' => __( 'Image', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_image',
			[
				'label' => __( 'Choose Image', 'omexer-insight' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_title',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Programming Career Guideline', 'omexer-insight' ),
				'placeholder' => __( 'Enter title', 'omexer-insight' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'webinar_desc',
			[
				'label' => __( 'Short Description', 'omexer-insight' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. ', 'omexer-insight' ),
				'placeholder' => __( 'Enter description here', 'omexer-insight' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'webinar_title_link',
			[
				'label' => __( 'Title Link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_meta',
			[
				'label' => __( 'Meta', 'omexer-insight' ),
			]
		);
        $this->add_control(
			'webinar_date',
			[
				'label' => __( 'Date', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '12 May, 2021', 'omexer-insight' ),
				'placeholder' => __( 'Enter date', 'omexer-insight' ),
				'label_block' => true,
			]
		);

        $this->add_control(
			'webinar_time',
			[
				'label' => __( 'Time', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '10:00 PM', 'omexer-insight' ),
				'placeholder' => __( 'Enter time', 'omexer-insight' ),
				'label_block' => true,
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'section_webinar_button',
			[
				'label' => __( 'Button', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_btn_text',
			[
				'label' => __( 'Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'omexer-insight' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'webinar_btn_link',
			[
				'label' => __( 'Link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'omexer-insight' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_global',
			[
				'label' => __( 'General', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'webinar_global_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'webinar_global_tabs_style' );

		$this->start_controls_tab(
			'webinar_global_style_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_global_bg',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .webinar-box-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'webinar_global_border',
				'selector' => '{{WRAPPER}} .webinar-box-wrap'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'webinar_global_shadow',
				'selector' => '{{WRAPPER}} .webinar-box-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'webinar_global_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_global_bg_hover_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .webinar-box-wrap:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'webinar_global_hover_border',
				'selector' => '{{WRAPPER}} .webinar-box-wrap:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'webinar_hover_global_shadow',
				'selector' => '{{WRAPPER}} .webinar-box-wrap:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'webinar_goabal_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'webinar_img_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'webinar_img_width',
			[
				'label' => __( 'Width', 'omexer-insight' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webinar-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'webinar_img_border',
				'selector' => '{{WRAPPER}} .webinar-img img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'webinar_img_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'webinar_img_box_shadow',
				'selector' => '{{WRAPPER}} .webinar-img img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'webinar_content_align',
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
				'selectors' => [
					'{{WRAPPER}} .webinar-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => __( 'Top', 'elementor' ),
					'center' => __( 'Middle', 'elementor' ),
					'flex-end' => __( 'Bottom', 'elementor' ),
				],
				'default' => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .webinar-box-wrap' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'webinar_content_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'webinar_heading_title',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'webinar_title_space',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webinar-content h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'webinar_title_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-content h3, {{WRAPPER}} .webinar-content h3 a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'webinar_title_hover_color',
			[
				'label' => __( 'Hover Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-content h3:hover, {{WRAPPER}} .webinar-content h3 a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webinar_title_typography',
				'selector' => '{{WRAPPER}} .webinar-content h3, {{WRAPPER}} .webinar-content h3 a',
			]
		);

		$this->add_control(
			'webinar_heading_desc',
			[
				'label' => __( 'Description', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'webinar_desc_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-content p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webinar_desc_typography',
				'selector' => '{{WRAPPER}} .webinar-content p',
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => __( 'Meta', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'webinar_meta_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'webinar_meta_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-meta li' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'webinar_meta_icon_color',
			[
				'label' => __( 'Icon Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-meta li i' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webinar_meta_typography',
				'selector' => '{{WRAPPER}} .webinar-meta li',
			]
		);

		$this->add_responsive_control(
			'webinar_meta_space',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webinar-meta li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'webinar_meta_icon_space',
			[
				'label' => __( 'Icon Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .webinar-meta li i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_btn',
			[
				'label' => __( 'Button', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'webinar_btn_typography',
				'selector' => '{{WRAPPER}} .webinar-btn a'
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_btn_text_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'webinar_btn_bg',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'webinar_btn_border',
				'selector' => '{{WRAPPER}} .webinar-btn a'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'webinar_btn_hover_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a:hover, {{WRAPPER}} .webinar-btn a:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'webinar_btn_bg_hover_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a:hover, {{WRAPPER}} .webinar-btn a:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'webinar_btn_hover_border',
				'selector' => '{{WRAPPER}} .webinar-btn a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'webinar_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'webinar_btn_box_shadow',
				'selector' => '{{WRAPPER}} .webinar-btn a',
			]
		);

		$this->add_responsive_control(
			'webinar_btn_text_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'webinar_btn_text_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .webinar-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() { 

		$settings = $this->get_settings_for_display();
		?>
        <div class="webinar-box-wrap">
			<?php if(! empty($settings['webinar_image']['url'])):?>
            <div class="webinar-img">
				<img src="<?php echo esc_attr($settings['webinar_image']['url'])?>" alt="">
            </div>
			<?php endif;?>
			<?php if(! empty($settings['webinar_title']) || ! empty($settings['webinar_desc'])):?>
            <div class="webinar-content">
				<?php
				$target = $settings['webinar_title_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['webinar_title_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<?php if(! empty($settings['webinar_title'])):?>
					<?php if(! empty($settings['webinar_title_link']['url'])):?>
                	<h3><?php echo '<a href="' . esc_attr($settings['webinar_title_link']['url']). '"' . $target . $nofollow . '>'.esc_html($settings['webinar_title']).'</a>';?></h3>
					<?php else:?>
					<h3><?php echo esc_html($settings['webinar_title']);?></h3>
					<?php endif;?>
				<?php endif;?>
				<?php if(! empty($settings['webinar_date']) || ! empty($settings['webinar_time'])):?>
				<ul class="webinar-meta">
					<?php if(! empty($settings['webinar_date'])):?>
					<li><i class="far fa-calendar-alt"></i> <?php echo esc_html($settings['webinar_date']);?></li>
					<?php endif;?>
					<?php if(! empty($settings['webinar_time'])):?>
					<li><i class="far fa-clock"></i> <?php echo esc_html($settings['webinar_time']);?></li>
					<?php endif;?>
				</ul>
				<?php endif;?>
				<?php if(! empty($settings['webinar_desc'])):?>
				<p><?php echo esc_html($settings['webinar_desc']);?></p>
				<?php endif;?>
				<?php if(! empty($settings['webinar_btn_text'])):?>
				<div class="webinar-btn">
					<?php
					$target = $settings['webinar_btn_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['webinar_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
					if(! empty($settings['webinar_btn_link']['url'])){
						$btn_attr = $settings['webinar_btn_link']['url'];
					}
					?>
					<a href="<?php echo esc_attr($btn_attr);?>" <?php echo $target .' '. $nofollow;?>><?php echo esc_html($settings['webinar_btn_text']);?></a>
				</div>
				<?php endif;?>
            </div>
			<?php endif;?>
        </div>
        <?php

	}

}