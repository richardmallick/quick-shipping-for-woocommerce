<?php

namespace WPPool\QS;

/**
 * Assets Handeler class
 */
class Assets {

    public function __construct() {

        add_action( "admin_enqueue_scripts", [ $this, 'admin_enqueue_Assets' ] );

    }

    public function admin_enqueue_Assets(){
        
        // Enqueue Admin CSS
        wp_register_style('wppool-qs-admin-style', WPPOOL_QS_ASSETS. "/admin/css/admin.css", null, filemtime(WPPOOL_QS_PATH."/assets/admin/css/admin.css"));
        wp_register_style('wppool-qs-fontello-style', WPPOOL_QS_ASSETS. "/lib/icon/css/fontello.css", null, filemtime(WPPOOL_QS_PATH."/assets/lib/icon/css/fontello.css"));
        wp_register_style('wppool-qs-select2-style', WPPOOL_QS_ASSETS. "/lib/select2/select2.min.css", null, filemtime(WPPOOL_QS_PATH."/assets/lib/select2/select2.min.css"));

        // Enqueue Admin Js
        wp_register_script('wppool-qs-admin-js', WPPOOL_QS_ASSETS. "/admin/js/admin.js", ['jquery', 'jquery-ui-sortable'], filemtime(WPPOOL_QS_PATH."/assets/admin/js/admin.js"), true);
        wp_register_script('wppool-qs-select2-js', WPPOOL_QS_ASSETS. "/lib/select2/select2.min.js", ['jquery'], filemtime(WPPOOL_QS_PATH."/assets/lib/select2/select2.min.js"), true);
       

    }

}