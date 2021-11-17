<?php
/**
 * omexer insight assets manager
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Inc;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Assets {
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

    public function __construct() {
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_frontend_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', array ( $this, 'enqueue_frontend_scripts' ), 10 );
        add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'omexer_insight_editor_styles' ) );
    }
    
    public function omexer_insight_editor_styles() {
        wp_enqueue_style('omexer-insight-elementor-editor', OMEXER_INSIGHT_ASSETS . 'css/elementor-editor.css', '', OMEXER_INSIGHT_VERSION );
    }
    
    // Register Styles
    public function register_frontend_styles() {  
        wp_register_style(
            'font-awesome',
            OMEXER_INSIGHT_ASSETS . 'css/font-awesome.min.css',
            null,
            OMEXER_INSIGHT_VERSION
        );

        wp_register_style(
            'owl-carousel',
            OMEXER_INSIGHT_ASSETS . 'css/owl.carousel.min.css',
            null,
            OMEXER_INSIGHT_VERSION
        );

        wp_register_style(
            'magnific-popup',
            OMEXER_INSIGHT_ASSETS . 'css/magnific-popup.css',
            null,
            OMEXER_INSIGHT_VERSION
        );
        wp_register_style(
            'magnific-popup',
            OMEXER_INSIGHT_ASSETS . 'css/animate.min.css',
            null,
            OMEXER_INSIGHT_VERSION
        );
        
        wp_register_style(
            'omexer_insight-icons',
            OMEXER_INSIGHT_ASSETS . 'css/omexer-insight-icons.css',
            null,
            OMEXER_INSIGHT_VERSION
        );
        
        wp_register_style(
            'omexer-insight',
            OMEXER_INSIGHT_ASSETS . 'css/omexer-insight.css',
            null,
            OMEXER_INSIGHT_VERSION
        );

	}
    
    public function enqueue_frontend_styles() {
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'animate' );
		wp_enqueue_style( 'omexer-insight-icons' );
		wp_enqueue_style( 'omexer-insight' );

	}
    
    // Register Scripts
    public function register_frontend_scripts() {
        wp_register_script(
            'owl-carousel',
            OMEXER_INSIGHT_ASSETS . 'js/owl.carousel.min.js',
            array('jquery'),
            OMEXER_INSIGHT_VERSION,
            true
        );

        wp_register_script(
            'magnific-popup',
            OMEXER_INSIGHT_ASSETS . 'js/magnific-popup.min.js',
            array('jquery'),
            OMEXER_INSIGHT_VERSION,
            true
        );

        wp_register_script(
            'countdown',
            OMEXER_INSIGHT_ASSETS . 'js/countdown.js',
            array('jquery'),
            OMEXER_INSIGHT_VERSION,
            true
        );
        
        wp_register_script(
            'omexer-insight',
            OMEXER_INSIGHT_ASSETS . 'js/omexer-insight.js',
            array('jquery'),
            OMEXER_INSIGHT_VERSION,
            true
        ); 

	}
    
    public function enqueue_frontend_scripts() {
        wp_enqueue_script( 'omexer-insight' );
        wp_enqueue_script( 'countdown' );
        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_script( 'magnific-popup' );
	}
}

// Assets Plugin Class
Assets::instance();