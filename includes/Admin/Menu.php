<?php

namespace WPPool\QS\Admin;

/**
 * Menu Handeler Calss
 */
class Menu {

    public function __construct(){

        add_action("admin_menu", [ $this, 'adminMenu'] );
       
    }

    public function adminMenu(){
        add_menu_page(__('Quick Shipping', WPPOOL_QS_TEXTDOMAIN), __('Quick Shipping', WPPOOL_QS_TEXTDOMAIN), 'manage_options', 'quick-shipping-for-woocommerce', [ $this, 'wppool_qs_plugin_page'], 'dashicons-cart', 30);
    }

    public function wppool_qs_plugin_page(){

        wp_enqueue_style("wppool-qs-admin-style"); // Enqueue admin Style
        wp_enqueue_style("wppool-qs-fontello-style");// Enqueue fontello Style
        wp_enqueue_style("wppool-qs-select2-style");// Enqueue Select2 Style

        wp_enqueue_script("wppool-qs-admin-js");// Enqueue Admin Js
        wp_enqueue_script("wppool-qs-select2-js");// Enqueue Select2 Js

        if (file_exists(__DIR__ . "/views/wppool-qs-admin-tabs.php")) {
            include __DIR__ . "/views/wppool-qs-admin-tabs.php";
        }
    }
}