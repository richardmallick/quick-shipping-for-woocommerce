<?php

namespace WPPool\QS\Admin;

/**
 * Admin Notice Handeler Class
 */
class Notice{

    public function __construct(){

        //add_action('plugins_loaded', [$this, 'init']);
        if ( is_admin() ) :
            $this->notice_Init();
        endif;

    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after WooCommerce (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function notice_Init(){
        
         // Check for required PHP version
         if ( version_compare( PHP_VERSION, WPPOOL_QS_MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'wppool_qc_minimum_php_version'] );
            return;
        }

        // Check if WooCommerce installed and activated
        if ( ! class_exists( 'WooCommerce' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_plugin'] );
            return;
        }  

        // Check for required Woocommerce version
         if ( version_compare( WC_VERSION , WPPOOL_QS_MINIMUM_WC_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'wppool_qs_minimum_wc_version'] );
            return;
        }

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function wppool_qc_minimum_php_version(){

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', WPPOOL_QS_TEXTDOMAIN),
            '<strong>' . esc_html__('Quick Shipping for Woocommerce', WPPOOL_QS_TEXTDOMAIN) . '</strong>',
            '<strong>' . esc_html__('PHP', WPPOOL_QS_TEXTDOMAIN) . '</strong>',
            WPPOOL_QS_MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have WooCommerce installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin(){

        $screen = get_current_screen();
        if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
            return;
        }
        
        $plugin = 'WooCommerce';
        $file_path = 'woocommerce/woocommerce.php';
        $installed_plugins = get_plugins();

        if ( isset( $installed_plugins[$file_path] ) ) { // check if plugin is installed
            if (!current_user_can('activate_plugins')) {
                return;
            }
            $activation_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $file_path), 'activate-plugin_' . $file_path);

            $message = '<p><strong>' .  esc_html__('Quick Shipping for Woocommerce', WPPOOL_QS_TEXTDOMAIN) . '</strong>' . __(' not working because you need to activate the WooCommerce plugin.', WPPOOL_QS_TEXTDOMAIN) . '</p>';
            $message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate WooCommerce Now', WPPOOL_QS_TEXTDOMAIN)) . '</p>';
        } else {
            if (!current_user_can('install_plugins')) {
                return;
            }
            $install_url = wp_nonce_url(add_query_arg(array('action' => 'install-plugin', 'plugin' => $plugin), admin_url('update.php')), 'install-plugin' . '_' . $plugin);
            $message     = '<p><strong>' .  esc_html__('Quick Shipping for Woocommerce', WPPOOL_QS_TEXTDOMAIN) . '</strong>' . __(' not working because you need to install the WooCommerce plugin', WPPOOL_QS_TEXTDOMAIN) . '</p>';
            $message    .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install WooCommerce Now', WPPOOL_QS_TEXTDOMAIN)) . '</p>';
        }

        echo '<div class="error"><p>' . $message . '</p></div>';

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required WooCommerce version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function wppool_qs_minimum_wc_version(){

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required WPPool OC version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', WPPOOL_QS_TEXTDOMAIN),
            '<strong>' . esc_html__('Quick Shipping for Woocommerce', WPPOOL_QS_TEXTDOMAIN) . '</strong>',
            '<strong>' . esc_html__('Woocommerce', WPPOOL_QS_TEXTDOMAIN) . '</strong>',
            WPPOOL_QS_MINIMUM_WC_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

}