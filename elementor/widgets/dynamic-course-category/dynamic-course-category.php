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
		return 'omexer-.dynamic-course-category';
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
				'label' => __('Select Category', 'omexer-insight'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->course_category(),
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
				'default' => 'left'
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
			'section_options',
			[
				'label' => __('Options', 'omexer-insight'),
			]
		);

		$this->add_control(
			'label_switcher',
			[
				'label' => __('Course Number Label', 'omexer-insight'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'omexer-insight'),
				'label_off' => __('Hide', 'omexer-insight'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'label_text',
			[
				'label' => __('Label Text', 'omexer-insight'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Courses', 'omexer-insight'),
				'placeholder' => __('Enter course number label text', 'omexer-insight'),
				'label_block' => true,
				'condition' => [
					'label_switcher' => 'yes'
				]
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
					'{{WRAPPER}} .dynamic-course-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_global_border',
				'selector' => '{{WRAPPER}} .dynamic-course-category'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_global_shadow',
				'selector' => '{{WRAPPER}} .dynamic-course-category',
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
					'{{WRAPPER}} .dynamic-course-category:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_global_hover_border',
				'selector' => '{{WRAPPER}} .dynamic-course-category:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_hover_global_shadow',
				'selector' => '{{WRAPPER}} .dynamic-course-category:hover',
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
					'{{WRAPPER}} .dynamic-course-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category.left .dynamic-course-category-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dynamic-course-category.top .dynamic-course-category-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dynamic-course-category svg' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_icon_bg_color',
			[
				'label' => __('Background Color', 'omexer-insight'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dynamic-course-category-icon span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category-icon span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_icon_border',
				'selector' => '{{WRAPPER}} .dynamic-course-category-icon i',
			]
		);

		$this->add_control(
			'cat_icon_border_radius',
			[
				'label' => __('Border Radius', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .dynamic-course-category span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dynamic-course-category span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_box_shadow',
				'selector' => '{{WRAPPER}} .dynamic-course-category-icon span',
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
					'{{WRAPPER}} .dynamic-course-category-icon span:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category-icon span:hover svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_icon_hover_bg_color',
			[
				'label' => __('Background Color', 'omexer-insight'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dynamic-course-category-icon span:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_hover_icon_border',
				'selector' => '{{WRAPPER}} .dynamic-course-category-icon span:hover',
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
					'{{WRAPPER}} .dynamic-course-category span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cat_icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .dynamic-course-category-icon span:hover',
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
					'{{WRAPPER}} .dynamic-course-category.top' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category-content' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .dynamic-course-category' => 'align-items: {{VALUE}};',
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
					'{{WRAPPER}} .dynamic-course-category h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .dynamic-course-category h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category h4 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .dynamic-course-category h4:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dynamic-course-category h4 a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_title_typography',
				'selector' => '{{WRAPPER}} .dynamic-course-category h4, {{WRAPPER}} .dynamic-course-category h4 a',
			]
		);

		$this->add_control(
			'cat_number_style',
			[
				'label' => __('Course Number', 'omexer-insight'),
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
					'{{WRAPPER}} .dynamic-course-category p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_desc_typography',
				'selector' => '{{WRAPPER}} .dynamic-course-category p',
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

	protected function get_course_category_name($slug)
	{
		$term = get_term_by('slug', $slug, 'course-category');
		if ($term && !is_wp_error($term)) {
			return $term->name;
		}
		return '';
	}

	protected function get_course_category_post_count($slug)
	{
		$term = get_term_by('slug', $slug, 'course-category');
		if ($term && !is_wp_error($term)) {
			return $term->count;
		}
		return 0;
	}

	protected function get_course_category_url($slug)
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

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$course_category = $settings['course_category'];

?>
		<?php if (!empty($course_category)) : ?>
			<div class="dynamic-course-category <?php echo esc_attr($settings['cat_icon_position']); ?>">
				<?php if (!empty($settings['cat_icon']['value'])) : ?>
					<div class="dynamic-course-category-icon" <?php echo $this->get_render_attribute_string('icon'); ?>>
						<span><?php Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']); ?></span>
					</div>
				<?php endif; ?>

				<div class="dynamic-course-category-content">
					<h4><a href="<?php echo esc_url($this->get_course_category_url($course_category)); ?>"><?php echo esc_html($this->get_course_category_name($course_category)); ?></a></h4>
					<p>
						<?php echo esc_html($this->get_course_category_post_count($course_category)); ?>
						<?php if($settings['label_switcher'] == 'yes'):?>
							<span class="label-text">
								<?php echo esc_html__($settings['label_text'], 'omexer-insight');?>
							</span>
						<?php endif;?>
					</p>
				</div>
			</div>
		<?php else : ?>
			<div class="dynamic-course-category-warning">
				<?php _e('Please, select a category', 'omexer-insight'); ?>
			</div>
		<?php endif; ?>
<?php

	}
}
