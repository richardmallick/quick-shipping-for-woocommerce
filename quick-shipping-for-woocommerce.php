<?php

/**
 * Plugin Name:       Quick Shipping for Woocommerce
 * Plugin URI:        https://wppool.dev
 * Description:       This is Quick Shipping for woocommerce.
 * Version:           1.0.0
 * Author:            WPPool
 * Author URI:        https://wppool.dev
 * Text Domain:       quick-shipping-for-woocommerce
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

/**
 * The main Plugin Class
 */
final class wppool_quick_shipping {

    /**
     * Plugin Version
     */
    const version = '1.0.0';
    /**
     * Php Version
     */
    const min_php_version = '5.6.20';

    /**
     * WC Version
     */
    const min_wc_version = '3.4';

    /**
     * Wordpress Version
     */
    const min_wp_version = '4.0';
    
    /**
     * Plugins Text Domain
     */
    const wppool_qs_text_domain = 'quick-shipping-for-woocommerce';

    /**
     * Class Constractor
     */
    private function __construct(){

        require_once __DIR__ . "/vendor/autoload.php";
        add_action('init', [$this, 'i18n']);
        $this->defineConstance();
        register_activation_hook( __FILE__, [ $this, 'Activate' ] );
        add_action( "plugins_loaded", [ $this, 'init_plugin' ] );
        add_action('admin_init', [$this, 'activation_redirect']);
        add_filter('plugin_action_links_' . plugin_basename(WPPOOL_QS_FILE), [__CLASS__, 'wppool_qs_action_links']);

    }

   /**
    * Initilize a singleton instance
    *
    * @return /wppool_quick_shipping
    */
    public static function init(){

        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Load Textdomain
     *
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n(){
        load_plugin_textdomain('quick-shipping-for-woocommerce');
    }

    /**
     * Plugin Constance
     *
     * @return /wppool_quick_shipping
     */
    public function defineConstance(){

        define('WPPOOL_QS_VERSION', self::version);
        define('WPPOOL_QS_TEXTDOMAIN', self::wppool_qs_text_domain);
        define('WPPOOL_QS_FILE', __FILE__);
        define('WPPOOL_QS_PATH', __DIR__);
        define('WPPOOL_QS_URL', plugins_url('', WPPOOL_QS_FILE));
        define('WPPOOL_QS_ASSETS', WPPOOL_QS_URL."/assets");
        define('WPPOOL_QS_MINIMUM_PHP_VERSION', self::min_php_version);
        define('WPPOOL_QS_MINIMUM_WC_VERSION', self::min_wc_version);
        define('WPPOOL_QS_MINIMUM_WP_VERSION', self::min_wp_version);

    }

    /**
     * After Activate Plugin
     *
     * @return /wppool_quick_shipping
     */
    public function Activate(){

        $installed = get_option('wppool_qs_installed');

        if ( ! $installed ) {
            update_option('wppool_qs_installed', time() );
        }

        update_option('wppool_qs_version', WPPOOL_QS_VERSION );
        add_option('wppool_qs_activation_redirect', true);
    }

    /**
     * Plugins Loaded
     *
     * @return /wppool_quick_shipping
     */
    public function init_plugin(){

        if ( is_admin() ) {
            new WPPool\QS\Admin();
        } else {
            new WPPool\QS\Frontend();
        }

        new WPPool\QS\Assets();

    }
    
    /**
     *
     * redirect to settings page after activation the plugin
     */
    public function activation_redirect() {

        if ( get_option('wppool_qs_activation_redirect', false) ) {

            delete_option('wppool_qs_activation_redirect');

            wp_redirect(admin_url('admin.php?page=quick-shipping-for-woocommerce'));
        }
    }

    /**
     *
     * Plugin Page Settings menu
     */
    public static function wppool_qs_action_links($links) {

        if ( ! current_user_can('manage_options') ) {
            return $links;
        }

        $links = array_merge( [
            sprintf('<a href="%s">%s</a>',
                    admin_url('admin.php?page=quick-shipping-for-woocommerce'),
                    esc_html__('Settings', WPPOOL_QS_TEXTDOMAIN)
            )
                ], $links );
        return $links;
    }
    
}

/**
 * Initilize the main plugin
 *
 * @return /wppool_quick_shipping
 */
function wppool_quick_shipping(){

    if ( class_exists( 'wppool_quick_shipping' ) ):

        return wppool_quick_shipping::init();

    endif;

}

/**
 * kick-off the plugin
 */
wppool_quick_shipping();


