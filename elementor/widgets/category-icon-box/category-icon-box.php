<?php
/**
 * omexer_insight course category icon box widget for elementor
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

class Category_Icon_Box extends Widget_Base {

	public function get_name() {
        return 'omexer-category-icon-box';
    }
    
    public function get_title() {
        return __( 'Category Icon Box', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-table-of-contents';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [
            'category',
            'course category icon box',
            'course category',
            'omexer',
        ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_icon',
			[
				'label' => __( 'Icon', 'omexer-insight' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
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
			'cat_title',
			[
				'label' => __( 'Category Name', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Design', 'omexer-insight' ),
				'placeholder' => __( 'Enter category title', 'omexer-insight' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cat_number',
			[
				'label' => __( 'Number of Courses', 'omexer-insight' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '2 Courses', 'omexer-insight' ),
				'placeholder' => __( 'Enter number of courses', 'omexer-insight' ),
				'rows' => 10,
				'separator' => 'none',
				'label_block' => true,
			]
		);

		$this->add_control(
			'cat_title_link',
			[
				'label' => __( 'Title Link', 'omexer-insight' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'omexer-insight' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cat_icon_position',
			[
				'label' => __( 'Icon Position', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'omexer-insight' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'omexer-insight' ),
						'icon' => 'eicon-v-align-top',
					]
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cat_button',
			[
				'label' => __( 'Button', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_btn_text',
			[
				'label' => __( 'Text', 'omexer-insight' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'omexer-insight' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cat_btn_link',
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
			'cat_icon_global_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'cat_icon_global_tabs_style' );

		$this->start_controls_tab(
			'cat_icon_global_style_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_icon_global_bg',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_global_border',
				'selector' => '{{WRAPPER}} .course-category-icon-box'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_global_shadow',
				'selector' => '{{WRAPPER}} .course-category-icon-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_icon_global_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_icon_global_bg_hover_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_global_hover_border',
				'selector' => '{{WRAPPER}} .course-category-icon-box:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_hover_global_shadow',
				'selector' => '{{WRAPPER}} .course-category-icon-box:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'cat_icon_goabal_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'cat_icon_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_icon_space',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box.left .course-category-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .course-category-icon-box.top .course-category-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cat_icon_size',
			[
				'label' => __( 'Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .course-category-icon-box svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_icon_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_icon_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-icon span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_border',
				'selector' => '{{WRAPPER}} .course-category-icon i',
			]
		);
		
		$this->add_control(
			'cat_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .course-category-icon-box span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_box_shadow',
				'selector' => '{{WRAPPER}} .course-category-icon span',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'cat_icon_hover_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-icon span:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon span:hover svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'cat_icon_hover_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-category-icon span:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_hover_icon_border',
				'selector' => '{{WRAPPER}} .course-category-icon span:hover',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cat_icon_hover_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .course-category-icon span:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cat_icon_content_align',
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
					'{{WRAPPER}} .course-category-icon-box.top' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon-box-content' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => __( 'Top', 'omexer-insight' ),
					'center' => __( 'Middle', 'omexer-insight' ),
					'flex-end' => __( 'Bottom', 'omexer-insight' ),
				],
				'default' => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_title_style',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_title_space',
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
					'{{WRAPPER}} .course-category-icon-box h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon-box h4 a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'cat_title_hover_color',
			[
				'label' => __( 'Hover Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box h4:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon-box h4 a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .course-category-icon-box h4, {{WRAPPER}} .course-category-icon-box h4 a',
			]
		);

		$this->add_control(
			'cat_desc_style',
			[
				'label' => __( 'Description', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cat_desc_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_desc_typography',
				'selector' => '{{WRAPPER}} .course-category-icon-box p',
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
				'name' => 'cat_icon_btn_typography',
				'selector' => '{{WRAPPER}} .course-cat-icon-box-btn a'
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
			'cat_icon_btn_text_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_icon_btn_bg',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_btn_border',
				'selector' => '{{WRAPPER}} .course-cat-icon-box-btn a'
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
			'cat_icon_btn_hover_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a:hover, {{WRAPPER}} .course-cat-icon-box-btn a:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'cat_icon_btn_bg_hover_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a:hover, {{WRAPPER}} .course-cat-icon-box-btn a:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_btn_hover_border',
				'selector' => '{{WRAPPER}} .course-cat-icon-box-btn a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'cat_icon_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_btn_box_shadow',
				'selector' => '{{WRAPPER}} .course-cat-icon-box-btn a',
			]
		);

		$this->add_responsive_control(
			'cat_icon_btn_text_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_icon_btn_text_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .course-cat-icon-box-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() { 

		$settings = $this->get_settings_for_display();
	
		?>
        <div class="course-category-icon-box <?php echo esc_attr($settings['cat_icon_position']);?>">
			<?php if(! empty($settings['cat_icon']['value'])):?>
            <div class="course-category-icon" <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
				<span><?php Icons_Manager::render_icon( $settings['cat_icon'], [ 'aria-hidden' => 'true' ] );?></span>
            </div>
			<?php endif;?>
			<?php if(! empty($settings['cat_title']) || ! empty($settings['cat_number'])):?>
            <div class="course-category-icon-box-content">
				<?php
				$target = $settings['cat_title_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['cat_title_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<?php if(! empty($settings['cat_title'])):?>
					<?php if(! empty($settings['cat_title_link']['url'])):?>
                	<h4><?php echo '<a href="' . esc_url($settings['cat_title_link']['url']). '"' . $target . $nofollow . '>'.esc_html($settings['cat_title']).'</a>';?></h4>
					<?php else:?>
					<h4><?php echo esc_html($settings['cat_title']);?></h4>
					<?php endif;?>
				<?php endif;?>
				<?php if(! empty($settings['cat_number'])):?>
				<p><?php echo esc_html($settings['cat_number']);?></p>
				<?php endif;?>
				<?php if(! empty($settings['cat_btn_text'])):?>
				<div class="course-cat-icon-box-btn">
					<?php
					$target = $settings['cat_btn_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $settings['cat_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
					$btn_attr = '';
					if(! empty($settings['cat_btn_link']['url'])){
						$btn_attr = $settings['cat_btn_link']['url'];
					}
					?>
					<a href="<?php echo esc_url($btn_attr);?>" <?php echo $target .' '. $nofollow;?>><?php echo esc_html($settings['cat_btn_text']);?></a>
				</div>
				<?php endif;?>
            </div>
			<?php endif;?>
        </div>
        <?php

	}

}
