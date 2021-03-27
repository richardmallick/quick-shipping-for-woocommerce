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
        //add_filter( 'woocommerce_get_price_html', [ $this,  'wppool_qs_alter_price_display' ], 9999, 2 );
        add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'custom_product_price_field' ], 5 );
        add_filter('woocommerce_add_cart_item_data', [ $this , 'add_custom_field_data' ], 20, 2 );
        add_action( 'woocommerce_before_calculate_totals', [ $this, 'extra_price_add_custom_price' ], 20, 1 );
        add_filter( 'woocommerce_get_item_data', [ $this, 'display_custom_item_data' ], 10, 2 );
    }



    // Add a custom field before single add to cart
        
        function custom_product_price_field(){

            global $product;

            
            $product_price = $product->get_variation_price( 'max' );

            print_r( $product_price );
        
            // Get Serialized Data from database
             $serialized_data = get_option('wppool_qs_all_data');
             $wppool_unserialize_datas = unserialize( $serialized_data ); // Unserialized data
             $i = 0;

             if ( $wppool_unserialize_datas  ) {
                foreach ( $wppool_unserialize_datas as $keyId => $wppool_unserialize_data ){
                    $i++;
                    $product_id = $product->get_id();
        
                    $products = $wppool_unserialize_data['products'];
                    
                    if ( $products ) {
                        if ( $wppool_unserialize_data['condition'] == 'products' && in_array( $product_id, $products) ){
            
                            $labels = $wppool_unserialize_data['label'];
                            $prices = $wppool_unserialize_data['price'];
                            
                            ?>
                            <div class="wppoll-qs-single-product">
                                <p><b><?php echo __( $wppool_unserialize_data['title'], WPPOOL_QS_TEXTDOMAIN) ?></b></p>
                                <p>
                                    <?php
                                        if (  $labels ){
                                            foreach ( $labels as $key => $label ){
                                                ?>
                                                    <input type="hidden" name="wppool_qs_label" value="<?php echo $wppool_unserialize_data['title']; ?>">
                                                    <input type="radio" data-id="<?php echo $prices[$key]; ?>" id="wppool_qs_price_<?php echo $prices[$key]; ?>" name="wppool_qs_price_<?php echo $keyId; ?>" value="<?php echo $prices[$key]; ?>">
                                                    <label for="wppool_qs_price_<?php echo $prices[$key]; ?>"><?php echo __($label, WPPOOL_QS_TEXTDOMAIN); ?></label><br>
                                                <?php
                                            }
                                        }
                                    ?>
                                </p>
                            </div>
            
                            <?php
                            if ( $i == 1 )
                            break;
                        }
                    }   
    
                }
            }
        }


        // Get custom field value, calculate new item price, save it as custom cart item data
        
        function add_custom_field_data( $cart_item_data, $product_id ){

             // Get Serialized Data from database
             $serialized_data = get_option('wppool_qs_all_data');
             $wppool_unserialize_datas = unserialize( $serialized_data ); // Unserialized data

             if ( isset($_POST['wppool_qs_label']) && ! empty($_POST['wppool_qs_label']) ){
                $cart_item_data['custom_data']['title'] = $_POST['wppool_qs_label'];
            }

             $qs_custom_price = 0;
            foreach ( $wppool_unserialize_datas as $keyId => $wppool_unserialize_data ){
                $qs_custom_price += $_POST["wppool_qs_price_$keyId"];
            }

            
            if ( isset( $qs_custom_price ) && ! empty( $qs_custom_price ) ){

                $product = wc_get_product($product_id); // The WC_Product Object

                // if( $product->is_on_sale() ) {
                //     $base_price  = (float) $product->get_sale_price();
                // }else{
                //     $base_price = (float) $product->get_regular_price();
                // }
                $base_price = (float) $product->get_variation_sale_price( 'max' );
                $custom_price = (float) sanitize_text_field(  $qs_custom_price );

                $cart_item_data['custom_data']['base_price'] = $base_price;
                $cart_item_data['custom_data']['new_price'] = $base_price + $custom_price;
            }
            if ( isset($cart_item_data['custom_data']['new_price']) || isset($cart_item_data['custom_data']['title']) ){
                $cart_item_data['custom_data']['unique_key'] = md5( microtime() . rand() ); // Make each item unique
            }
            return $cart_item_data;
        }


        // Set the new calculated cart item price
        
        function extra_price_add_custom_price( $cart ) {
            if ( is_admin() && ! defined( 'DOING_AJAX' ) )
                return;

            if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
                return;

            foreach ( $cart->get_cart() as $cart_item ) {
                if( isset($cart_item['custom_data']['new_price']) )
                    $cart_item['data']->set_price( (float) $cart_item['custom_data']['new_price'] );
            }
        }

        

        // Display in cart item the selected date
        function display_custom_item_data( $cart_item_data, $cart_item ) {

            if ( isset( $cart_item['custom_data']['new_price'] ) ){

                $cart_item_data[] = array(
                    'name' => __($cart_item['custom_data']['title'], "woocommerce" ),
                    'value' =>   date('d.m.Y', strtotime($cart_item['custom_data']['date'])),
                );
            }
            return $cart_item_data;

        }













 
    public function wppool_qs_alter_price_display( $price_html, $product ) {
        
        // ONLY ON FRONTEND
        if ( is_admin() ) 
        return $price_html;
        
        //ONLY IF PRICE NOT NULL
        if ( '' === $product->get_price() )
        return $price_html;

        $orig_price = wc_get_price_to_display( $product );
        $price_html = wc_price( $orig_price + 100);
        return $price_html;
    
    }


    
}