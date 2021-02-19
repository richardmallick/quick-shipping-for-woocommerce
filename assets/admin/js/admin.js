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

    });

})(jQuery);



