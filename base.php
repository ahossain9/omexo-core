<?php
namespace Omexer_Insight;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {
 
    /**
    * Instance
    *
    * @since 1.0.0
    * @access private
    * @static
    *
    * @var Plugin The single instance of the class.
    */
    private static $_instance = null;
 
    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.2.0
    * @access public
    *
    * @return Plugin An instance of the class.
    */
    public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
    }

    /**
    *  Plugin class constructor
    *
    * Register plugin action hooks and filters
    *
    * @since 1.2.0
    * @access public
    */
    public function __construct() {
        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

         // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category_two' ] );
    }
    
    /**
     * Add custom category.
     *
     * @param $elements_manager
     */
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'omexer_insight',
            [
                'title' => __( 'Omexer Insight', 'omexer_insight-core' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function add_category_two( $elements_manager ) {
        $elements_manager->add_category(
            'omexer_insight_cat_two',
            [
                'title' => __( 'Omexer Header & Footer', 'omexer_insight-core' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }
    
    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets() {

        $TutorLMSwidget = [
            'course-grid',
            'course-carousel',
            'category-image-box',
            'category-icon-box',
            'course-search',
            'dynamic-course-category',
        ];

        $widgets = [
            'dual-button',
            'webinar-box',
            'zoom-webinar-box',
            'video-popup',
            'mailchimp',
            'blog-post',
            'slider',
            'countdown',
            'pricing-table',
            'testimonial-carousel',
            'team-member',
            'testimonial',
            'skill-bar',
            'accordian',
            'step-flow',
            'spinning-image',
            'nav-menu',
            'site-logo',
            'mini-cart',
            'nav-category'
        ];

        if ( function_exists('tutor') ) {
            $widgets = array_merge($TutorLMSwidget, $widgets);
        }

        foreach ( $widgets as $widget ) {
            require( __DIR__ . '/elementor/widgets/' . $widget . '/'. $widget . '.php' );

            $class_name = str_replace( '-', '_', $widget );
            $class_name = __NAMESPACE__ . '\Widgets\\' . $class_name;
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
        }
    }

}
 
// Instantiate Plugin Class
Plugin::instance();