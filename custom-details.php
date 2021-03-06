<?php
/**
 * Plugin Name:       Customer Details - Easy Digital Downloads
 * Plugin URI:        https://github.com/themeaazz/customer-details
 * Description:       Customer details of easy-digital-downloads.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nazmul Hasan
 * Author URI:        https://github.com/themeaazz
 * Text Domain:       customer-details
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * The main plugin class.
 */
final class Customer_Details {

    const version = '1.0';

    /**
     * Class constructor.
     */
    private function __construct() {

        $this->define_constants();
        $this->includes();

        add_action( 'plugins_loaded', [ $this, 'load_plugin_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Load customer-details textdomain.
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'customer-details', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
    }

    /**
     * Initializes a singleton instance.
     *
     * @return \Customer_Details classes.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Pre defined constance.
     */
    public function define_constants() {
        define( 'Customer_Details_VERSION', self::version );
        define( 'Customer_Details_FILE', __FILE__ );
        define( 'Customer_Details_PATH', __DIR__ );
        define( 'Customer_Details_URL', plugins_url( '', Customer_Details_FILE ) );
        define( 'Customer_Details_ASSETS', Customer_Details_URL . '/assets' );
    }
    
    /**
     * Included files.
     */
    public function includes() {

        require_once __DIR__ . '/includes/assets.php';
        require_once __DIR__ . '/includes/menu.php';
        require_once __DIR__ . '/includes/customer-list.php';

    }


    /**
     * Initializes the plugin.
     *
     * @param void
     */
    public function init_plugin() {
        
        if ( is_admin() ) {
            new Customer_Details\Assets;
            new Customer_Details\Menu();
        }
    }

}

/**
 * Initializes the main plugin.
 * @return \Customer_Details
 */
function EDD_Customer_Details() {
    return Customer_Details::init();
}

//Kick off the plugin.
EDD_Customer_Details();