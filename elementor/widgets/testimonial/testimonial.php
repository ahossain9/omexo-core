<?php
/**
 * omexer_insight testimonial widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */
namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Testimonial extends Widget_Base {

	public function get_name() {
        return 'omexer-testimonial';
    }
    
    public function get_title() {
        return __( 'Testimonial', 'omexer-insight' );
    }

    public function get_icon() {
        return 'omexer-insight-icon eicon-testimonial';
    }

    public function get_categories() {
        return [ 'omexer_insight' ];
    }

    public function get_keywords() {
        return [ 
            'testimonial',
            'review',
            'feedback',
            'omexer',
        ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonial', 'omexer-insight' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'quote_icon_switcher',
			[
				'label' => __( 'Quote Icon', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'choose_quote_icon',
			[
				'label' => __( 'Icon', 'omexer-insight' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-quote-right',
					'library' => 'solid',
				],
				'condition' => [
					'quote_icon_switcher' => 'yes'
				]
			]
		);

		$this->add_control(
			'rating_switcher',
			[
				'label' => __( 'Rating', 'omexer-insight' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'omexer-insight' ),
				'label_off' => __( 'Hide', 'omexer-insight' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'rating_score',
			[
				'label' => __( 'Rating Score', 'omexer-insight' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 5,
				'step' => 0.5,
				'default' => 5,
                'condition' => [
                    'rating_switcher' => 'yes',
                ]
			]
		);

		$this->add_control(
			'rating_position',
			[
				'label' => __( 'Rating Position', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => __( 'Before Content', 'omexer-insight' ),
					'after' => __( 'After Content', 'omexer-insight' )
				],
				'condition' => [
                    'rating_switcher' => 'yes',
                ]
			]
		);

		$this->add_control(
			'testimonial_design',
			[
				'label' => __( 'Design', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'default' => __( 'Default', 'omexer-insight' ),
					'bubble' => __( 'Bubble', 'omexer-insight' ),
				],
				'default' => 'default'
			]
		);

		$this->add_control(
			'testimonial_content',
			[
				'label' => __( 'Content', 'omexer-insight' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'placeholder' => __( 'Type testimonial', 'omexer-insight' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_reviewer',
			[
				'label' => __( 'Reviewer', 'omexer-insight' ),
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
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => ['custom'],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'omexer-insight' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'aside',
				'options' => [
					'aside'  => __( 'Aside', 'omexer-insight' ),
					'top' => __( 'Top', 'omexer-insight' )
				]
			]
		);

		$this->add_control(
			'name',
			[
				'label' => __( 'Name', 'omexer-insight' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Adam Smith', 'omexer-insight' ),
				'placeholder' => __( 'Reviewer Name', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'designation',
			[
				'label' => __( 'Designation', 'omexer-insight' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Web Developer', 'omexer-insight' ),
				'placeholder' => __( 'Type reviewer designation', 'omexer-insight' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_global',
			[
				'label' => __( 'General', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonial_padding',
			[
				'label' => __( 'Padding', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap.default, .testimonial-wrap.bubble .testimonial-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'omexer-insight' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					],
				],
				'toggle' => false,
				'default' => 'left',
				'prefix_class' => 'testimonial-align-',
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'testimonial_bubble_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap.bubble .testimonial-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'testimonial_design' => 'bubble'
				]
			]
		);

		$this->start_controls_tabs( 'testimonial_tabs' );
		$this->start_controls_tab(
			'testimonial_normal',
			[
				'label' => __( 'Normal', 'omexer-insight' ),
			]
		);

		$this->add_control(
			'testimonial_global_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap.default, .testimonial-wrap.bubble .testimonial-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testi_global_border',
				'selector' => '{{WRAPPER}} .testimonial-wrap.default,.testimonial-wrap.bubble .testimonial-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testi_global_box_shadow',
				'selector' => '{{WRAPPER}} .testimonial-wrap.default, .testimonial-wrap.bubble .testimonial-inner',
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
			'testimonial_hover_global_bg_color',
			[
				'label' => __( 'Background Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap.default:hover, .testimonial-wrap.bubble .testimonial-inner:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testi_hover_global_border',
				'selector' => '{{WRAPPER}} .testimonial-wrap.default:hover, .testimonial-wrap.bubble .testimonial-inner:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testi_hover_global_box_shadow',
				'selector' => '{{WRAPPER}} .testimonial-wrap.default:hover, .testimonial-wrap.bubble .testimonial-inner:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'testimonial_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .testimonial-wrap.default, .testimonial-wrap.bubble .testimonial-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'testimonial_spacing',
			[
				'label' => __( 'Bottom Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'testimonial_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_typography',
				'selector' => '{{WRAPPER}} .testimonial-content'
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label' => __( 'Quote Icon', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'quote_icon_margin',
			[
				'label' => __( 'Margin', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tesimonial-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_size',
			[
				'label' => __( 'Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tesimonial-quote i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tesimonial-quote svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'quote_icon_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tesimonial-quote i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tesimonial-quote svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_spacing',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tesimonial-quote i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_icon',
			[
				'label' => __( 'Rating Icon', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'rating_icon_size',
			[
				'label' => __( 'Size', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_icon_color',
			[
				'label' => __( 'Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-rating i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'rating_icon_spacing',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_icon_margin',
			[
				'label' => __( 'Margin Bottom', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-img img' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.testimonial-align-left .testimonial-client-info.aside .testimonial-img' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.testimonial-align-center .testimonial-client-info.aside .testimonial-img' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.testimonial-align-right .testimonial-client-info.aside .testimonial-img' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-client-info.top .testimonial-img' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .testimonial-img img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'omexer-insight' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .testimonial-img img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_reviewer_style',
			[
				'label' => __( 'Reviewer', 'omexer-insight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_name',
			[
				'label' => __( 'Name', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-client-details h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .testimonial-client-details h4',
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[
				'label' => __( 'Spacing', 'omexer-insight' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-client-details h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_designation',
			[
				'label' => __( 'Title', 'omexer-insight' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'designation_color',
			[
				'label' => __( 'Text Color', 'omexer-insight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-client-details p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'selector' => '{{WRAPPER}} .testimonial-client-details p'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="testimonial-wrap <?php echo esc_attr( $settings['testimonial_design'] );?>">
			<div class="testimonial-inner">
				<?php if('yes' == $settings['quote_icon_switcher']):?>
				<div class="tesimonial-quote">
					<?php Icons_Manager::render_icon( $settings['choose_quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
				<?php endif;?>
				<?php if( 'yes' == $settings['rating_switcher'] && 'before' == $settings['rating_position']):?>
					<div class="testimonial-rating">
						<?php
						$rating_data = $settings['rating_score'];
						$stars_html = '';
			
						if ( $rating_data == 5 ) {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
						} elseif ( $rating_data == 4.5 ) {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>';
						} elseif ( $rating_data == 4 ) {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
						} elseif ( $rating_data == 3.5 ) {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i><i class="fa fa-star"></i>';
						} elseif ( $rating_data == 3 ) {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
						} else {
							$stars_html .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
						}
						echo $stars_html;
						?>
					</div>
				<?php endif;?>
			
				<?php if(!empty($settings['testimonial_content'])):?>
					<div class="testimonial-content">
						<?php echo esc_html($settings['testimonial_content']);?>
					</div>
				<?php endif;?>
				<?php if( 'yes' == $settings['rating_switcher'] && 'after' == $settings['rating_position']):?>
					<div class="testimonial-rating">
						<?php
						$rating_data = $settings['rating_score'];
						$stars_html = '';
			
						if ( $rating_data == 5 ) {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
						} elseif ( $rating_data == 4.5 ) {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
						} elseif ( $rating_data == 4 ) {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
						} elseif ( $rating_data == 3.5 ) {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
						} elseif ( $rating_data == 3 ) {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
						} else {
							$stars_html .= '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
						}
						echo $stars_html;
						?>
					</div>
				<?php endif;?>
			</div>
			<div class="testimonial-client-info <?php echo esc_attr($settings['image_position']);?>">
				<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
					<div class="testimonial-img">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
					</div>
				<?php endif; ?>
				<?php if(!empty($settings['name']) || !empty($settings['designation'])):?>
					<div class="testimonial-client-details">
						<?php if(!empty($settings['name'])):?>
							<h4><?php echo esc_html($settings['name']);?></h4>
						<?php endif; ?>
						<?php if(!empty($settings['designation'])):?>
							<p><?php echo esc_html($settings['designation']);?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
