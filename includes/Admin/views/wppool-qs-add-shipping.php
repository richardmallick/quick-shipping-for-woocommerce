<?php
if (isset($_POST['submit'])) {

    $ids = $_POST['add_shipping_hiden_id'];
    update_option('quick_shipping_id', $ids);

    foreach ($ids as $id) {
        $shipping_name[] = $_POST["shipping-option-label-$id"];
        $shipping_price[] = $_POST["shipping-product-price-$id"];
    }

    update_option('shipping-option-label', $shipping_name);
    update_option('shipping-product-price', $shipping_price);
}

$shipping_ids = get_option('quick_shipping_id');
$shipping_options_label = get_option('shipping-option-label');
$shipping_options_price = get_option('shipping-product-price');



echo "<pre>";
print_r($shipping_repeater_datas);
echo "</pre>";



?>



<form action="" method="POST">
    <h2> <i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Add Shipping', WPPOOL_QS_TEXTDOMAIN); ?></h2>
    <input type="submit" name="submit" value="Submit">
    <hr>
    <div class="wppool-tab-content">
        <div class="wppool-shipping-details">
            <div class="wppool-add-shipping-title">
                <label for="quick-shipping-title">Title</label><br>
                <input type="text" name="quick-shipping-title" id="quick-shipping-title">
            </div>

            <div class="wppool-add-shipping-accordion">
                <div class="wppool-add-shipping-options" id="wppool-sortable">




                    <?php
                    foreach ($shipping_ids as $shipping_id) :
                    ?>
                        <div class="wppool-add-shipping-area">
                            <div class="wppool-add-shipping-accordion-header">
                                <div class="wppool-add-shipping-accordion-title">
                                    <div class="sort"> Label</div>
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
                                            <div id="basic-info" class="tab-item inner-active">
                                                <h2><i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Add Shipping Options', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                                <div class="wppool-shipping-inner-options-area">
                                                    <div class="wppool-shipping-inner-options-<?php echo $shipping_id; ?>">


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

                                                                <div class="wppool-shipping-inner-options-title">
                                                                    <div class="sort"></div>
                                                                </div>
                                                            </div>
                                                        <?php endfor; ?>




                                                    </div>
                                                </div>
                                            </div>
                                            <div id="display-role-<?php echo $shipping_id; ?>" class="tab-item ">
                                                <h2> <i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Display Role', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                                <hr>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>









                </div>
                <div class="wppool-add-new-shipping-button">
                    <h2 id="wppool-add-shipping">Add Field</h2>
                </div>
            </div>
        </div>
    </div>
</form>