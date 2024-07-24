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

defined('ABSPATH') || die();

class Dynamic_Course_Category extends Widget_Base
{

	public function get_name()
	{
		return 'omexer-dynamic-course-category';
	}

	public function get_title()
	{
		return __('Dynamic Course Category', 'omexer-insight');
	}

	public function get_icon()
	{
		return 'omexer-insight-icon eicon-table-of-contents';
	}

	public function get_categories()
	{
		return ['omexer_insight'];
	}

	public function get_keywords()
	{
		return [
			'category',
			'dynamic course category',
			'course category',
			'omexo',
		];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Category', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'course_category',
			[
				'label' => __('Select Category', 'mesonix-core'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->course_category(),
				// 'multiple' => false,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __('Icon and Image', 'omexer-insight'),
			]
		);
		$this->add_control(
			'cat_icon_position',
			[
				'label' => __('Position', 'omexer-insight'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __('Left', 'omexer-insight'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __('Top', 'omexer-insight'),
						'icon' => 'eicon-v-align-top',
					]
				],
			]
		);
		$this->add_control(
			'cat_icon',
			[
				'label' => __('Icon', 'omexer-insight'),
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
				'label' => __('Content', 'omexer-insight'),
			]
		);

		$this->add_control(
			'cat_title',
			[
				'label' => __('Category Name', 'omexer-insight'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Web Design', 'omexer-insight'),
				'placeholder' => __('Enter category title', 'omexer-insight'),
				'label_block' => true,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_global',
			[
				'label' => __('General', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'cat_icon_global_padding',
			[
				'label' => __('Padding', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('cat_icon_global_tabs_style');

		$this->start_controls_tab(
			'cat_icon_global_style_normal',
			[
				'label' => __('Normal', 'omexer-insight'),
			]
		);

		$this->add_control(
			'cat_icon_global_bg',
			[
				'label' => __('Background Color', 'omexer-insight'),
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
				'label' => __('Hover', 'omexer-insight'),
			]
		);

		$this->add_control(
			'cat_icon_global_bg_hover_color',
			[
				'label' => __('Background Color', 'omexer-insight'),
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
				'label' => __('Border Radius', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
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
				'label' => __('Icon and Image', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'cat_icon_padding',
			[
				'label' => __('Padding', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .course-category-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_icon_space',
			[
				'label' => __('Spacing', 'omexer-insight'),
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
				'label' => __('Size', 'omexer-insight'),
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

		$this->start_controls_tabs('icon_colors');

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __('Normal', 'omexer-insight'),
			]
		);

		$this->add_control(
			'cat_icon_color',
			[
				'label' => __('Color', 'omexer-insight'),
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
				'label' => __('Background Color', 'omexer-insight'),
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
				'label' => __('Border Radius', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
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
				'label' => __('Hover', 'omexer-insight'),
			]
		);

		$this->add_control(
			'cat_icon_hover_color',
			[
				'label' => __('Color', 'omexer-insight'),
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
				'label' => __('Background Color', 'omexer-insight'),
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
				'label' => __('Border Radius', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
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
				'label' => __('Content', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cat_icon_content_align',
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
					'{{WRAPPER}} .course-category-icon-box.top' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .course-category-icon-box-content' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __('Vertical Alignment', 'omexer-insight'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => __('Top', 'omexer-insight'),
					'center' => __('Middle', 'omexer-insight'),
					'flex-end' => __('Bottom', 'omexer-insight'),
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
				'label' => __('Title', 'omexer-insight'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cat_title_space',
			[
				'label' => __('Spacing', 'omexer-insight'),
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
				'label' => __('Color', 'omexer-insight'),
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
				'label' => __('Hover Color', 'omexer-insight'),
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
				'label' => __('Description', 'omexer-insight'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cat_desc_color',
			[
				'label' => __('Color', 'omexer-insight'),
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
	}

	protected function course_category()
	{
		$terms = get_terms(array(
			'taxonomy' => 'course-category',
			'hide_empty' => false,
		));

		$cats = [];

		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$cats[$term->slug] = $term->name;
			}
		}

		return $cats;
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$course_category = $settings['course_category'];

		function get_course_category_name($slug)
		{
			$term = get_term_by('slug', $slug, 'course-category');
			if ($term && !is_wp_error($term)) {
				return $term->name;
			}
			return '';
		}

		function get_course_category_post_count($slug)
		{
			$term = get_term_by('slug', $slug, 'course-category');
			if ($term && !is_wp_error($term)) {
				return $term->count;
			}
			return 0;
		}
		function get_course_category_url($slug)
		{
			$term = get_term_by('slug', $slug, 'course-category');
			if ($term && !is_wp_error($term)) {
				$term_link = get_term_link($term);
				if (!is_wp_error($term_link)) {
					return $term_link;
				}
			}
			return '';
		}
?>
		<?php if (!empty($course_category)) : ?>
			<div class="dynamic-course-category <?php echo esc_attr($settings['cat_icon_position']); ?>">
				<?php if (!empty($settings['cat_icon']['value'])) : ?>
					<div class="dynamic-course-category-icon" <?php echo $this->get_render_attribute_string('icon'); ?>>
						<span><?php Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']); ?></span>
					</div>
				<?php endif; ?>

				<div class="dynamic-course-category-content">
					<h4><a href="<?php echo esc_url(get_course_category_url($course_category)); ?>"><?php echo esc_html(get_course_category_name($course_category)); ?></a></h4>
					<p><?php echo esc_html(get_course_category_post_count($course_category)); ?></p>
				</div>
			</div>
		<?php endif; ?>
<?php

	}
}
