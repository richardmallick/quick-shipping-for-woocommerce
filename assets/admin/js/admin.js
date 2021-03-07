;(function($){
    // Tabs
    $(document).ready(function() {

        $('.wppool_product_cat').select2(); // Product Category List
        $('.wppool_product_list').select2(); // Product List

        // Have the previously selected tab open
        if (sessionStorage.activeTab) {

            $('.wppool-qs-tab-content ' + sessionStorage.activeTab).show().siblings().hide();
            $(".wppool-qs-tab-button li a[href=" + "\"" + sessionStorage.activeTab + "\"" + "]").parent().addClass('active').siblings().removeClass('active');
        
        }
        
        // Enable, disable and switch tabs on click
        $('.wppool-qs-tab-button > .btn > a').on('click', function(e)  {

            e.preventDefault();

            var currentAttrValue = $(this).attr('href');
            var activeTab = $(this).attr('href');

            if(activeTab.length){
                 
                // Show/Hide Tabs
                $('.wppool-qs-tab-content ' + currentAttrValue).fadeIn('fast').siblings().hide();
                sessionStorage.activeTab = currentAttrValue;

                $(this).parent('li').addClass('active').siblings().removeClass('active');
               
              }

        });
       
        // Enable, disable and switch tabs on click
        $(document).on('click','.wppool-qs-inner-tab-button > .btn > a', function(e)  {

            e.preventDefault();

            var currentAttrValue = $(this).attr('href');
            var activeTab = $(this).attr('href');

            if(activeTab.length){
                 
                // Show/Hide Tabs
                $('.wppool-qs-inner-tab-content ' + currentAttrValue).fadeIn('fast').siblings().hide();
                $(this).parent('li').addClass('inner-active').siblings().removeClass('inner-active');
               
              }

        }); 

    });

     // Admin Accordion
     $(document).on("click",".wppool-add-shipping-accordion-header", function(e){

        if( !$(e.target).hasClass("wppool-qs-title") ){
            if( $(this).hasClass('kdactive') ){
                $(this).removeClass('kdactive');
                $(this).next().slideUp();
           }else{
                $(this).addClass('kdactive');
                $(this).next().slideDown(); 
           }
        }
       
   });
   
    // Add Files
    var wrapper         = $(".wppool-add-shipping-options"); //Fields wrapper
    var add_field       = $("#wppool-add-shipping"); //Add button ID

    var i = WPPOOL_ASSETS.wppoolIds;

    var encodeCategories = WPPOOL_ASSETS.productCat;
    var encodeProducts = WPPOOL_ASSETS.products;
    var categories = jQuery.parseJSON( encodeCategories );
    var products   = jQuery.parseJSON( encodeProducts );

    function selectCat( categories ){
        let fields = '';
        $.each(categories, function( index, value ) {
            fields += "<option value=" + value.slug + ">" + value.name + "</option>";
          }) 
          return fields;
    }

    function selectProduct( products ){
        let fields = '';
        $.each(products, function( index, value ) {
            fields += "<option value=" + value.ID + ">" + value.post_title + "</option>";
          }) 
          return fields;
    }

    $(add_field).on('click', function(e){
         $(wrapper).append(`<div class="wppool-add-shipping-area">
         <div class="wppool-add-shipping-accordion-header kdactive">
             <div class="wppool-add-shipping-accordion-title">
                <span class="sort"></span>
                <input class="wppool-qs-title" type="text" name="wppool-qs-title[]" placeholder="Title"/>
             </div>
             <div class="wppool-add-shipping-accordion-delete-btn">
                 <i class="demo-icon icon-cancel"></i>
             </div>
         </div>
         <div class="wppool-add-shipping-accordion-content">
             <div class="wppool-add-shipping-accordion-details">
                <input type="hidden" name="add_shipping_hiden_id[]" value="${i}" />
                 <div class="wppool-shipping-inner-tabs">
                     <ul class="wppool-qs-inner-tab-button">
                         <li class="btn inner-active"><a href="#basic-info-${i}"><i class="demo-icon icon-settings"></i> Basic Info</a></li>
                         <li class="btn"><a href="#display-role-${i}"><i class="demo-icon icon-shipping"></i> Display Role</a></li>
                     </ul>
                     <div class="wppool-qs-inner-tab-content ">
                         <div id="basic-info-${i}" class="tab-item inner-active">
                             <h2><i class="demo-icon icon-shipping"></i>  Add Shipping Options</h2>
                             <div class="wppool-shipping-inner-options-area">
                                <div class="wppool-shipping-inner-options-${i}" id="innser-sortable-${i}">
                                    <div class="wppool-shipping-inner-options-header">
                                        <div class="wppool-shipping-inner-options-label">
                                            <input type="text" name="shipping-option-label-${i}[]" placeholder="Label">
                                        </div>
                                        <div class="wppool-shipping-inner-options-price">
                                            <input type="text" name="shipping-product-price-${i}[]" placeholder="Price">
                                        </div>
                                        <div class="wppool-shipping-inner-options-add" data-id="${i}">
                                            <i class="demo-icon icon-ok"></i>
                                        </div>
                                        <div class="wppool-shipping-inner-options-delete-btn-d">
                                            <i class="demo-icon icon-cancel"></i>
                                        </div>
                                        <div class="wppool-shipping-inner-options-title" data-id="${i}">
                                            <div class="sort sort-${i}"></div>
                                        </div>
                                    </div>

                                </div>
                         </div>
                         </div>
                            <div id="display-role-${i}" class="tab-item ">
                                <h2> <i class="demo-icon icon-shipping"></i>Display Role</h2>
                                <hr>
                                <div class="wppool-condition-area">
                                    <div class="wppool_qs_condition" >
                                        <label for="wppool_condition">Select</label>
                                        <select name="wppool_condition-${i}" class="wppool_condition" data-id="${i}">
                                            <option value="category">Category</option>
                                            <option value="product">Product</option>
                                        </select>
                                    </div>
                                    <div class="wppool_qs_condition_dependency">
                                        <div class="wppool_product_categorise condition-active" id="wppool_product_categorise_${i}">
                                            <label for="wppool_product_cat">Categories</label>
                                            <select name="wppool_product_cat-${i}[]" class="wppool_product_cat"  multiple="multiple">
                                                <option value="">--Select Category--</option>
                                                ${ selectCat( categories ) }
                                            </select>
                                        </div>
                                        <div class="wppool_condition_products" id="wppool_condition_products_${i}">
                                            <label for="wppool_product_list">Products</label>
                                            <select name="wppool_product-${i}[]" class="wppool_product_list" multiple="multiple">
                                                <option value="">--Select Product--</option>
                                                ${  selectProduct( products ) }  
                                            </select>
                                        </div>
                                    </div>
                            </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>`);
     
     //add input box
     i++;
     setTimeout(() => {
        $('.wppool_product_cat').select2(); // Product Category List
        $('.wppool_product_list').select2(); // Product List
     }, 200);
    });

    $(wrapper).on("click",".wppool-shipping-inner-options-delete-btn-d", function(e){ //user click on remove text
        alert("Opss! can't Remove this field");
    });
    $(wrapper).on("click",".wppool-add-shipping-accordion-delete-btn", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent().parent('div').remove();
    });

    // Inner Shipping Options
    $(wrapper).on('click', ".wppool-shipping-inner-options-add", function(){

        var id = $(this).data('id');

        var add_shipping_options_wrapper = $(`.wppool-shipping-inner-options-${id}`);

        $(add_shipping_options_wrapper).append(`<div class="wppool-shipping-inner-options-header">
            <div class="wppool-shipping-inner-options-label">
               <input type="text" name="shipping-option-label-${id}[]" placeholder="Label">
            </div>
            <div class="wppool-shipping-inner-options-price">
               <input type="number" name="shipping-product-price-${id}[]" placeholder="Price">
            </div>
            <div class="wppool-shipping-inner-options-add" data-id="${id}">
                <i class="demo-icon icon-ok"></i>
            </div>
            <div class="wppool-shipping-inner-options-delete-btn" data-id="${id}">
                <i class="demo-icon icon-cancel"></i>
            </div>
            <div class="wppool-shipping-inner-options-title" data-id="${id}">
                <div class="sort  sort-${id}"></div>
            </div>
        </div>`);

    });

    $(wrapper).on("click",".wppool-shipping-inner-options-delete-btn", function(e){ //user click on remove text
        e.preventDefault(); 

        var id = $(this).data('id');

        var add_shipping_options_wrapper = $(`.wppool-shipping-inner-options-${id}`);

        $(this).parent(add_shipping_options_wrapper).remove();

    });

     // Accordion Shortable
     $( function() {
        $( ".wppool-add-shipping-options" ).sortable({
          connectWith: ".wppool-add-shipping-options",
          handle: ".wppool-add-shipping-accordion-title .sort",
          cancel: ".wppool-add-shipping-accordion-content",
          placeholder: "portlet-placeholder"
        });

      } );
      
    $( function() {
        $( "#wppool-sortable" ).sortable();
        $( "#wppool-sortable" ).disableSelection();
      } );

    // Inner Shortable
    var InnerWraper = $(".wppool-shipping-inner-options-area");
    InnerWraper.on('mousedown', '.wppool-shipping-inner-options-title', function(){
        var id = $(this).data('id');
        setTimeout(function() {
            $( function() {
                InnerWraper.sortable({
                  connectWith: `.wppool-shipping-inner-options-area`,
                  handle: `.wppool-shipping-inner-options-title .sort-${id}`,
                  cancel: `.wppool-shipping-inner-options-${id}`,
                  placeholder: "portlet-placeholder"
                });
        
              } );

              $( function() {
                $( `#innser-sortable-${id}` ).sortable();
                $( `#innser-sortable-${id}` ).disableSelection();
              } );

         }, 300);
    });

    

    $(wrapper).on( 'change', '.wppool_condition',function() {
         var cSelected = $(this).find(":selected").val();
         var id = $(this).data('id');
         if ( cSelected == 'category' ){
            $(`#wppool_product_categorise_${id}`).show();
            $(`#wppool_condition_products_${id}`).hide();
            $(`#wppool_condition_products_${id}`).removeClass('condition-active');
            $(`#wppool_product_categorise_${id}`).addClass('condition-active');
         }else{
            $(`#wppool_product_categorise_${id}`).hide();
            $(`#wppool_condition_products_${id}`).show();
            $(`#wppool_product_categorise_${id}`).removeClass('condition-active');
            $(`#wppool_condition_products_${id}`).addClass('condition-active');

         }
      });
 

})(jQuery);



