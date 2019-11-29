; (function ($) {

    kprod = function (options) {
        var o = {
            getProByCatUrl:'http://localhost/DemoUglifyJs/Controller/CategorieController.php?action=getProduit',
		};
		
        // constructor
        var construct = function (options) {
            $.extend(o, options);
        };

      
        this.getProByCat = function (onDataReceived) {
            $.ajax({
                method: "GET",
                url: o.getProByCatUrl,
                dataType: "json",
                data: {idcat: 1 },
                async: true,
                success: function (result) {
    	        		onDataReceived(result);
    	        
    	        },
            })
           
        };
    
    };
}(jQuery));
