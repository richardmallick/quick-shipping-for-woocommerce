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
        echo "Hello World";
    }
}