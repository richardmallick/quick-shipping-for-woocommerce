<?php

namespace  WPPool\QS\Frontend\Classes;


/**
 * FrontEnd Features
 */
class Wpool_quick_shipping_unit{

    /**
     * FrontEnd Constructor
     */
    public function __construct(){
        add_filter( 'woocommerce_get_price_html', [ $this,  'bbloomer_alter_price_display' ], 9999, 2 );
        add_action( 'woocommerce_before_calculate_totals', [ $this, 'bbloomer_alter_price_cart' ], 9999 );
    }
 
    public function bbloomer_alter_price_display( $price_html, $product ) {
        
        // ONLY ON FRONTEND
        if ( is_admin() ) 
        return $price_html;
        
        //ONLY IF PRICE NOT NULL
        if ( '' === $product->get_price() )
        return $price_html;
        
        // //IF CUSTOMER LOGGED IN, APPLY 20% DISCOUNT   
        // if ( wc_current_user_has_role( 'customer' ) ) {
        
        // }
    
        $orig_price = wc_get_price_to_display( $product );
        $price_html = wc_price( $orig_price + 100);
        return $price_html;
    
    }


 
    public function bbloomer_alter_price_cart( $cart ) {

    
        // LOOP THROUGH CART ITEMS & APPLY 20% DISCOUNT
        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
            $product = $cart_item['data'];
            $price = $product->get_price();
            $cart_item['data']->set_price( $price + 100 );
        }
    
    }
    
}