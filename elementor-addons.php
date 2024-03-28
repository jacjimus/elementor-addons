<?php

 /**
  * Plugin Name:      Elementor Hero Plugin
  * Description:      Custom Elementor Hero Plugin for PHP WP Developer - Containers Task.
  * Plugin URI:       https://elementor.com/
  * Version:          1.0.0
  * Author:           James Makau
  * Author URI:       https://developers.elementor.com/
  * Text Domain:      elementor-test-addon
  * License:          GPLv2
  * Requires Plugins: elementor
  */


 defined('ABSPATH') || exit;

 use ElementorAddons\Widgets\Hero_Widget;


 final class Plugin {

    private static $_instance = null;

     const MINIMUM_ELEMENTOR_VERSION = '3.20.0';

     const MINIMUM_PHP_VERSION = '8.0';

     public function __construct() {

         if ( $this->is_compatible() ) {
             add_action( 'elementor/init', [ $this, 'init' ] );
         }

     }

     public function init(): void
     {
         add_action( 'elementor/widgets/register', [$this, 'register_widgets']);
         add_action( 'wp_enqueue_scripts', [$this , 'elementor_widgets_dependencies'] );
         add_action( 'plugins_loaded', [$this, 'elementor_load_plugin_text_domain'] );
     }

     public function register_widgets( $widgets_manager ): void
     {
         require_once( __DIR__ . '/widgets/hero-widget.php' );

         $widgets_manager->register( new Hero_Widget() );

     }

     public function elementor_load_plugin_text_domain(): void
     {
         load_plugin_textdomain( 'elementoraddons' );
     }
     public function elementor_widgets_dependencies(): void
     {
         /* Styles */
         wp_register_style( 'hero-widget-style', plugins_url( 'assets/css/hero-widget.css', __FILE__ ) );
     }

     public function is_compatible(): bool
     {

         // Check if Elementor is installed and activated
         if ( ! did_action( 'elementor/loaded' ) ) {
             add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
             return false;
         }

         // Check for required Elementor version
         if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
             add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
             return false;
         }

         // Check for required PHP version
         if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
             add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
             return false;
         }

         return true;

     }

     public function admin_notice_minimum_elementor_version(): void
     {

         if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

         $message = sprintf(
         /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
             esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
             '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
             '<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
         );

         printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

     }

     public function admin_notice_minimum_php_version(): void
     {

         if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

         $message = sprintf(
         /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
             esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
             '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
             '<strong>' . esc_html__( 'PHP', 'elementor-test-addon' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
         );

         printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

     }

    public static function instance(): ?Plugin
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        self::$_instance->init();
        return self::$_instance;

    }


}

Plugin::instance();







