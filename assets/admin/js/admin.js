;(function($){

    // Tabs
    $(document).ready(function() {


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
     $(document).on("click",".wppool-add-shipping-accordion-header", function(){

        if( $(this).hasClass('kdactive') ){
             $(this).removeClass('kdactive');
             $(this).next().slideUp();
        }else{
             $(this).addClass('kdactive');
             $(this).next().slideDown(); 
        }
   });
   


    // Add Files
    var wrapper         = $(".wppool-add-shipping-options"); //Fields wrapper
    var add_field      = $("#wppool-add-shipping"); //Add button ID

    var i = WPPOOL_ASSETS.wppoolIds;

    console.log(i);

    $(add_field).on('click', function(e){
         $(wrapper).append(`<div class="wppool-add-shipping-area">
         <div class="wppool-add-shipping-accordion-header kdactive">
             <div class="wppool-add-shipping-accordion-title">
                 <div class="sort"> Label</div>
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
                                <div class="wppool-shipping-inner-options-${i}">
                                    <div class="wppool-shipping-inner-options-header">
                                        <div class="wppool-shipping-inner-options-label">
                                            <input type="text" name="shipping-option-label-${i}[]" placeholder="Label">
                                        </div>
                                        <div class="wppool-shipping-inner-options-price">
                                            <input type="text" name="shipping-product-price-${i}[]" placeholder="Price">
                                        </div>
                                        <div class="wppool-shipping-inner-options-add"  data-id="${i}">
                                            <i class="demo-icon icon-ok"></i>
                                        </div>
                                        <div class="wppool-shipping-inner-options-delete-btn-d">
                                            <i class="demo-icon icon-cancel"></i>
                                        </div>
                                        <div class="wppool-shipping-inner-options-title">
                                            <div class="sort"></div>
                                        </div>
                                    </div>

                                </div>
                         </div>
                         </div>
                         <div id="display-role-${i}" class="tab-item ">
                             <h2> <i class="demo-icon icon-shipping"></i>Display Role</h2>
                             <hr>
                           
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>`); //add input box
     i++;
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
            <div class="wppool-shipping-inner-options-delete-btn"  data-id="${id}">
                <i class="demo-icon icon-cancel"></i>
            </div>
            <div class="wppool-shipping-inner-options-title">
                <div class="sort"></div>
            </div>
        </div>`);

    });

    $(wrapper).on("click",".wppool-shipping-inner-options-delete-btn", function(e){ //user click on remove text
        e.preventDefault(); 

        var id = $(this).data('id');

        var add_shipping_options_wrapper = $(`.wppool-shipping-inner-options-${id}`);

        $(this).parent(add_shipping_options_wrapper).remove();
    });


     // Shortable
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


})(jQuery);



