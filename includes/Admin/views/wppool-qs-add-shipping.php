<div class="wppool-shipping-details">
    <div class="wppool-add-shipping-title">
        <label for="quick-shipping-title">Title</label><br>
        <input type="text" name="quick-shipping-title" id="quick-shipping-title">
    </div>

    <div class="wppool-add-shipping-accordion">
        <div class="wppool-add-shipping-options" id="wppool-sortable">
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
                        <div class="wppool-shipping-inner-tabs">
                            <ul class="wppool-qs-inner-tab-button">
                                <li class="btn inner-active"><a href="#basic-info"><i class="demo-icon icon-settings"></i> <?php echo  esc_html__('Basic Info', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
                                <li class="btn"><a href="#display-role"><i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Display Role', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
                            </ul>
                            <div class="wppool-qs-inner-tab-content ">
                                <div id="basic-info" class="tab-item inner-active">
                                    <h2> <i class="demo-icon icon-settings"></i> <?php echo  esc_html__('Basic Info', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                    
                                </div>
                                <div id="display-role" class="tab-item ">
                                    <h2> <i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Display Role', WPPOOL_QS_TEXTDOMAIN); ?></h2>
                                    <hr>
                                  
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wppool-add-new-shipping-button">
            <h2 id="wppool-add-shipping">Add Field</h2>
        </div>
    </div>
</div>