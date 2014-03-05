// ** disable support for IE8 and below
function getInternetExplorerVersion() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}
function checkVersion() {
    var msg = false;
    var ver = getInternetExplorerVersion();
    if (ver > -1) {
        if (ver >= 8.0)
            msg = false;
        else
            msg = true;
    }
    if(msg==true)
	{window.location = "error-ie.html";
	}
	
}

checkVersion();

if (navigator.appVersion.indexOf("Mac")!=-1){
jQuery(body).css("background-color","#DEDEE0");	
};


jQuery(document).ready(function(){
	
			jQuery("#nav-one li").hover(
				function(){ jQuery("ul", this).fadeIn("fast"); }, 
				function() { } 
			);
	  	if (document.all) {
				jQuery("#nav-one li").hoverClass ("sfHover");
			}
	  
        jQuery("#nav-two li").hover(
            function(){ jQuery("ul", this).fadeIn("fast"); }, 
            function() { } 
        );
        if (document.all) {
                jQuery("#nav-two li").hoverClass ("sfHover");
        }

	        jQuery.fn.hoverClass = function(c) {
	            return this.each(function(){
	                jQuery(this).hover( 
	                    function() { jQuery(this).addClass(c);  },
	                    function() { jQuery(this).removeClass(c); }
	                );
	            });
	        };    
        
        jQuery("#submit-login").click(function() {
    
    var input_data = jQuery('#wp_login_form_head').serialize();
    jQuery.ajax({
    type: "POST",
    url:  "/vancouver/wp-admin/admin-ajax.php",
    data: "action=logmein&" + input_data,
    success: function(msg){
        if(msg=='Success'){
        setTimeout("location.reload(true);");
        }
        else
        { alert(msg)};
    }
    });
    	return false;
    
	});
	
jQuery(".logmein").click(function(e){
		jQuery('#login-window').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
});

jQuery(".registerme").click(function(e){
        jQuery('#register-window').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
});

	

jQuery("#forgotpass").click(function(){
	jQuery("#login-part").hide();
	jQuery("#tab3_login").show();
	});
	
jQuery("#backtologin").click(function(){
	jQuery("#tab3_login").hide();
	jQuery("#login-part").show();
});

jQuery("#submitreg").click(function() {
    
    var input_data = jQuery('#wp_reg_form_head').serialize();
    jQuery.ajax({
    type: "POST",
    url:  "/vancouver/wp-admin/admin-ajax.php",
    data: "action=newuserreg&" + input_data,
    success: function(msg){
    
    if(msg=='Success'){
        setTimeout("location.reload(true);");
        }
        else
        { alert(msg)};
    }
    
    });
    return false;
    
    });
    
        
jQuery("#env-img").click(function(e) {
    jQuery('#share-date').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
});

	jQuery("#qmark").click(function(e){
		jQuery('#qmark-popup').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
	});

	jQuery("#howitworks").click(function(e){
		jQuery('#how-it-works').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
	return false;
});

jQuery("#suggestadate").click(function(e){
		jQuery('#suggest-date').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
	return false;
});

});