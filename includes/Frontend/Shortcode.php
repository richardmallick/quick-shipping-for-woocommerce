<?php

namespace WPPool\QS\Frontend;

/**
 * Shortcode
 */
class Shortcode{

    public function __construct()
    {
      add_shortcode("myshortcode", [ $this, 'my_shortcode'] );  
    }


    public function my_shortcode(){
        return "Return Form Shortcode";
    }

}

