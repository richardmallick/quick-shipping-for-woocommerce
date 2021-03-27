<?php

if (isset($_POST['submit'])) {

    $ids = $_POST['add_shipping_hiden_id'];
    update_option('quick_shipping_id', $ids);

    if ( $ids ){

        foreach ($ids as $id) {
            $shipping_name[]       = $_POST["shipping-option-label-$id"];
            $shipping_price[]      = $_POST["shipping-product-price-$id"];
            $wppool_product_cat[]  = $_POST["wppool_product_cat-$id"];
            $wppool_product[]      = $_POST["wppool_product-$id"];
        }

        foreach ( $ids  as $key => $id ) {
            $wppool_shipping_data[] = [
                "id" =>  $key,
                "title" => sanitize_text_field( $_POST["wppool-qs-title"][$key] ),
                "condition" => sanitize_text_field( $_POST["wppool_qs_condition"][$key] ),
                "label" => $shipping_name[$key],
                "price" => $shipping_price[$key],
                "categoryies" => $wppool_product_cat[$key],
                "products" => $wppool_product[$key]
            ];
        }
    
        $wppool_serialize_data = serialize( $wppool_shipping_data );
        update_option('wppool_qs_all_data', $wppool_serialize_data);

    }

}

// Get Serialized Data from database
$serialized_data = get_option('wppool_qs_all_data');
$wppool_unserialize_data = unserialize( $serialized_data ); // Unserialized data

// Get array column value
$shipping_ids           = array_keys( $wppool_unserialize_data );
$shipping_title         = array_column( $wppool_unserialize_data, 'title' );
$shipping_options_label = array_column( $wppool_unserialize_data, 'label' );
$shipping_options_price = array_column( $wppool_unserialize_data, 'price' );
$shipping_condition     = array_column( $wppool_unserialize_data, 'condition' );
$shipping_categories    = array_column( $wppool_unserialize_data, 'categoryies' );
$shipping_products      = array_column( $wppool_unserialize_data, 'products' );

// echo "<pre>";
// print_r( $shipping_condition );
// echo "</pre>";

//Count Shipping I
$wppool_id_count        = $wppool_unserialize_data ? count($wppool_unserialize_data) : 0;

// Get Categories
$pCategories = get_terms( ['taxonomy' => 'product_cat'] );
$categoryiesEncode = json_encode( $pCategories );

// Get All Products
$arr = get_posts( array(
    'posts_per_page' => -1,
    'post_type' => array('product','product_variation'),
  ) );

$Products_Query = new WP_Query( $arr );
$Products =  $Products_Query->query;
$productsEncode = json_encode( $Products );

// Condition Options
$opstions = [
    'category', 'products'
];

// Pass value to Jquery file
wp_localize_script( 'wppool-qs-admin-js', 'WPPOOL_ASSETS', [ 'wppoolIds' => $wppool_id_count, 'productCat' => $categoryiesEncode, 'products' => $productsEncode ] );

?>

<form action="" method="POST">
    <div class="wppool-qs-add-shipping-header">
        <h2> <i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Add Shipping', WPPOOL_QS_TEXTDOMAIN); ?></h2>
        <button class="button-primary" type="submit" name="submit">Save Changes</button>
    </div>
    <hr>
    <div class="wppool-tab-content">
        <div class="wppool-shipping-details">
            <div class="wppool-add-shipping-accordion">
                <div class="wppool-add-shipping-options" id="wppool-sortable">
                    <?php
                    if ( $shipping_ids ):
                    foreach ($shipping_ids as $shipping_id => $id ) :
                        
                    ?>
                        <div class="wppool-add-shipping-area">
                            <div class="wppool-add-shipping-accordion-header">
                                <div class="wppool-add-shipping-accordion-title">
                                    <span class="sort"></span>
                                    <input class="wppool-qs-title" type="text" name="wppool-qs-title[]" placeholder="Title" value="<?php echo esc_html($shipping_title[$shipping_id]); ?>"/>
                                </div>
                                <div class="wppool-add-shipping-accordion-delete-btn">
                                    <i class="demo-icon icon-cancel"></i>
                                </div>
                            </div>
                            <div class="wppool-add-shipping-accordion-content" style="display: none;">
                                <div class="wppool-add-shipping-accordion-details">
                                    <input type="hidden" name="add_shipping_hiden_id[]" value="<?php echo $shipping_id; ?>" />
                                    <div class="wppool-shipping-inner-tabs">
                                        <ul class="wppool-qs-inner-tab-button">
                                            <li class="btn inner-active"><a href="#basic-info-<?php echo $shipping_id; ?>"><i class="demo-icon icon-settings"></i> <?php echo  esc_html__('Basic Info', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
                                            <li class="btn"><a href="#display-role-<?php echo $shipping_id; ?>"><i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Display Role', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
                                        </ul>
                                        <div class="wppool-qs-inner-tab-content ">
                                            <div id="basic-info-<?php echo $shipping_id; ?>" class="tab-item inner-active">
                                                <h2><i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Add Shipping Options', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                                <div class="wppool-shipping-inner-options-area">
                                                    <div class="wppool-shipping-inner-options-<?php echo $shipping_id; ?>" id="innser-sortable-<?php echo $shipping_id; ?>">
                                                        <?php
                                                        $_count = count($shipping_options_label[$shipping_id]);
                                                        for ($i = 0; $i < $_count; $i++) :
                                                        ?>
                                                            <div class="wppool-shipping-inner-options-header">
                                                                <div class="wppool-shipping-inner-options-label">
                                                                    <input type="text" name="shipping-option-label-<?php echo $shipping_id; ?>[]" placeholder="Label" value="<?php echo $shipping_options_label[$shipping_id][$i]; ?>">
                                                                </div>
                                                                <div class="wppool-shipping-inner-options-price">
                                                                    <input type="number" name="shipping-product-price-<?php echo $shipping_id; ?>[]" placeholder="Price" value="<?php echo $shipping_options_price[$shipping_id][$i]; ?>">
                                                                </div>
                                                                <div class="wppool-shipping-inner-options-add" data-id="<?php echo $shipping_id; ?>">
                                                                    <i class="demo-icon icon-ok"></i>
                                                                </div>
                                                                <?php if ($i == 0) {
                                                                ?>
                                                                    <div class="wppool-shipping-inner-options-delete-btn-d">
                                                                        <i class="demo-icon icon-cancel"></i>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="wppool-shipping-inner-options-delete-btn">
                                                                        <i class="demo-icon icon-cancel"></i>
                                                                    </div>
                                                                <?php } ?>

                                                                <div class="wppool-shipping-inner-options-title"  data-id="<?php echo $shipping_id; ?>">
                                                                    <div class="sort sort-<?php echo $shipping_id; ?>"></div>
                                                                </div>
                                                            </div>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div id="display-role-<?php echo $shipping_id; ?>" class="tab-item ">
                                                <h2> <i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Display Role', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                                <hr>
                                                <div class="wppool-condition-area">
                                                    <div class="wppool_qs_condition" >
                                                        <label for="wppool_condition"><?php echo __("Select", WPPOOL_QS_TEXTDOMAIN); ?></label>
                                                       
                                                        <select name="wppool_qs_condition[]" class="wppool_condition" data-id="<?php echo $shipping_id; ?>">
                                                            <?php 
                                                            foreach ( $opstions as $opstion ){  
                                                                $_opstion = ucfirst($opstion);
                                                                $selected = $shipping_condition[$shipping_id] == $opstion ? 'selected': '';

                                                                echo $shipping_condition[$shipping_id];
                                                            ?>
                                                                <option value="<?php echo $opstion; ?>" <?php echo $selected; ?>><?php echo __($_opstion, WPPOOL_QS_TEXTDOMAIN); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="wppool_qs_condition_dependency">
                                                        <?php 
                                                        $activeCategory = $activeProduct = '';
                                                        if ( $shipping_condition[$shipping_id] == 'category' ){
                                                            $activeCategory = 'condition-active';
                                                        } else {
                                                            $activeProduct = 'condition-active';
                                                        }
                                                        ?>
                                                        <div class="wppool_product_categorise <?php echo $activeCategory; ?>" id="wppool_product_categorise_<?php echo $shipping_id; ?>">
                                                            <label for="wppool_product_cat"><?php echo __("Categories", WPPOOL_QS_TEXTDOMAIN); ?></label>
                                        
                                                            <select name="wppool_product_cat-<?php echo $shipping_id; ?>[]" class="wppool_product_cat"  multiple="multiple">
                                                                <option value="">--Select Category--</option>
                                                                <?php  
                                                                    foreach ( $pCategories as $key => $pCategory ): 

                                                                     $catSelected = in_array( $pCategory->slug, $shipping_categories[$shipping_id]) ? 'selected' : ''; ?>
                                                                    ?>
                                                                    <option value="<?php echo $pCategory->slug; ?>" <?php echo $catSelected; ?>><?php echo $pCategory->name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="wppool_condition_products <?php echo $activeProduct; ?>" id="wppool_condition_products_<?php echo $shipping_id; ?>">
                                                            <label for="wppool_product_list"><?php echo __("Products", WPPOOL_QS_TEXTDOMAIN); ?></label>

                                                            <select name="wppool_product-<?php echo $shipping_id; ?>[]" class="wppool_product_list" multiple="multiple">
                                                                <option value="">--Select Product--</option>
                                                                <?php 
                                                                foreach ( $Products as $key => $Product ):
                                                                    $productSelected =  in_array( $Product->ID, $shipping_products[$shipping_id]) ? 'selected' : ''; ?> 
                                                                ?>
                                                                    <option value="<?php echo $Product->ID; ?>" <?php echo $productSelected; ?>><?php echo $Product->post_title; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                  
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach; 
                    endif;?>
                </div>
                <div class="wppool-add-new-shipping-button">
                    <h2 id="wppool-add-shipping">Add Field</h2>
                </div>
            </div>
        </div>
    </div>
</form>