<?php
/**
 * Plugin Name: Omexer Insight
 * Plugin URI: https://omexer.com
 * Description: <a href="https://omexer.com">Omexer Insight</a> plugin is the collection of widgets for Elementor page builder
 * Version: 1.2.0
 * Author: Omexer
 * Author URI: https://omexer.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: omexer-insight
 * Domain Path: /languages/
 *
 * @package Omexer_Insight
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'OMEXER_INSIGHT_VERSION', '1.1.2' );
define( 'OMEXER_INSIGHT__FILE__', __FILE__ );
define( 'OMEXER_INSIGHT_DIR_PATH', plugin_dir_path( OMEXER_INSIGHT__FILE__ ) );
define( 'OMEXER_INSIGHT_DIR_URL', plugin_dir_url( OMEXER_INSIGHT__FILE__ ) );
define( 'OMEXER_INSIGHT_ASSETS', trailingslashit( OMEXER_INSIGHT_DIR_URL . 'assets' ) );

 
/**
 * Main Elementor Omexer_Insight Class
 *
 * The init class that runs the Elementor Omexer_Insight plugin.
 * The main class that initiates and runs the plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 * @since 1.0.0
 */

final class Omexer_Insight {
 
  /**
   * Plugin Version
   *
   * @since 1.0.0
   * @var string The plugin version.
   */
  const VERSION = '1.0.0';
 
  /**
   * Minimum Elementor Version
   *
   * @since 1.0.0
   * @var string Minimum Elementor version required to run the plugin.
   */
  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
 
  /**
   * Minimum PHP Version
   *
   * @since 1.0.0
   * @var string Minimum PHP version required to run the plugin.
   */
  const MINIMUM_PHP_VERSION = '7.0';
 
  /**
   * Constructor
   *
   * @since 1.0.0
   * @access public
   */
  public function __construct() {
 
    // Load translation
    add_action( 'init', array( $this, 'i18n' ) );
 
    // Init Plugin
    add_action( 'plugins_loaded', array( $this, 'init' ) );
  }
 
  /**
   * Load Textdomain
   *
   * Load plugin localization files.
   * Fired by `init` action hook.
   *
   * @since 1.2.0
   * @access public
   */
  public function i18n() {
    load_plugin_textdomain( 'omexer_insight-core' );
  }
 
  /**
   * Initialize the plugin
   *
   * Validates that Elementor is already loaded.
   * Checks for basic plugin requirements, if one check fail don't continue,
   * if all check have passed include the plugin class.
   *
   * Fired by `plugins_loaded` action hook.
   *
   * @since 1.2.0
   * @access public
   */
  public function init() {
 
    // Check if Elementor installed and activated
    if ( ! did_action( 'elementor/loaded' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
      return;
    }
 
    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
      return;
    }
 
    // Check for required PHP version
    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
      return;
    }
 
    // Once we get here, We have passed all validation checks so we can safely include our plugin
    require OMEXER_INSIGHT_DIR_PATH . 'base.php';
    require OMEXER_INSIGHT_DIR_PATH . '/inc/functions.php';
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have Elementor installed or activated.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_missing_main_plugin() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'omexer_insight-core' ),
      '<strong>' . esc_html__( 'Omexer_Insight Core', 'omexer_insight-core' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor Page Builder', 'omexer_insight-core' ) . '</strong>'
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required Elementor version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_elementor_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'omexer_insight-core' ),
      '<strong>' . esc_html__( 'Omexer_Insight Core', 'omexer_insight-core' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor Page Builder', 'omexer_insight-core' ) . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
 
  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required PHP version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_php_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
 
    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'omexer_insight-core' ),
      '<strong>' . esc_html__( 'Omexer_Insight Core', 'omexer_insight-core' ) . '</strong>',
      '<strong>' . esc_html__( 'PHP', 'omexer_insight-core' ) . '</strong>',
      self::MINIMUM_PHP_VERSION
    );
 
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
}
 
// Instantiate Omexer_Insight.
new Omexer_Insight();