window.fbAsyncInit = function() {
	var uid;
	var accessToken;
	FB._https = (window.location.protocol == "https:");
	FB.init({
	// appId      : '140109872734286',
	//appId      : '121541631324064', // Facebook Local App ID
	appId      : '442143535808692', // Facebook Dev App ID
	//appId      : '185259828274700', // Facebook Live App ID
	//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	status     : true, // check login status
	cookie     : true, // enable cookies to allow the server to access the session
	xfbml      : true  // parse XFBML
	//oauth : true
	});
};

(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));

function equalHeight () {
	var date_details = jQuery(".date_details").height();
	var date_info = jQuery(".date_info").height();

	if (date_info >= date_details) {
		jQuery(".date_details").height(date_info+25);
	}
}


jQuery(document).ready(function($) {
	equalHeight();

	var id = postID;
	var id1 = 0;
	var id2 = 0;
	var id3 = 0;

	for(i=1;i<sessionStorage.length+1;i++) {
		if(sessionStorage.getItem(i) == id) {
			if(sessionStorage.getItem(i+1)) {
				var id2 = sessionStorage.getItem(i+1);
				if(sessionStorage.getItem(i+2)){
					var id3 = sessionStorage.getItem(i+2);
				}
			}

			if(sessionStorage.getItem(i-1)) {
				var id1 = sessionStorage.getItem(i-1);
			}
		}
	}

	input_data = "action=recommenddates&id1="+id1+"&id2="+id2+"&id3="+id3;
	jQuery.ajax({
		type: "POST",
		url:  homeURL + "/wp-admin/admin-ajax.php",
		data: input_data,
		success: function(msg){
			jQuery("#more-deals").html(msg);
		}
	});

	jQuery(".testsearch").live("mouseenter",function(){jQuery("div.testsearch2",this).fadeIn('fast');});
	jQuery(".testsearch").live("mouseleave",function(){jQuery("div.testsearch2",this).fadeOut('fast');});

	jQuery(".testsearch-content").live("mouseenter",function(){jQuery("div.testsearch2-content",this).fadeIn('fast');});
	jQuery(".testsearch-content").live("mouseleave",function(){jQuery("div.testsearch2-content",this).fadeOut('fast');});

	var i;
	var id = postID;
	for(i=1;i<sessionStorage.length+1;i++) {
		var thisitem = sessionStorage.getItem(i);
		if(thisitem == id) {
			if(sessionStorage.getItem(i-1)) {
				jQuery.ajax({
					type: "POST",
					url:  "/wp-admin/admin-ajax.php",
					data: "action=getpermalink&id=" + sessionStorage.getItem(i-1),
					success: function(msg){
						jQuery("#previous_page_link").html("<a href='"+msg+"'><div class='previous_page_link'><div>Prev</div></div></a>");
					}
				});
			}
			if(sessionStorage.getItem(i+1)) {
				jQuery.ajax({
					type: "POST",
					url:  "/wp-admin/admin-ajax.php",
					data: "action=getpermalink&id=" + sessionStorage.getItem(i+1),
					success: function(msg){
						jQuery("#next_page_link").html("<a href='"+msg+"'><div class='next_page_link'><div>Next</div></div></a>");
					}
				});
			}
		}
	}


	// Load the classic theme
	Galleria.loadTheme(homeURL+"/slider/themes/classic/galleria.classic.min.js");

	// Initialize Galleria
	jQuery('#galleria').galleria({
		        image_crop: true,
		        carousel: true,
		        carousel_speed: 2000,
		        autoplay: false,
		        thumbnails: true,
		        showInfo: true,
		        transition: 'fade',
		        transition_speed: 600
	});

	var geocoder;
	var map;
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		var myOptions = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});
		} else {
			alert("Geocode was not successful for the following reason: " + status);
		}
	});


	if(typeof price !== 'undefined') {

		jQuery('#share-submit').click(function(){
			var input_data = jQuery('#share-this-date').serialize();
			jQuery.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: "action=sharedate&" + input_data +"&pid="+postID,
				success: function(msg){
					jQuery('#share-date').trigger('close');
					return false;
				}
			});
			return false;
		});

		function getQueryVariable(variable, URL) {
			var query = URL;
			var vars = query.split("&");
			for (var i = 0; i < vars.length; i++) {
				var pair = vars[i].split("=");
				if (pair[0] == variable) {
					return unescape(pair[1]);
				}
			}
			alert('Query Variable ' + variable + ' not found');
		}

		function isLoggedIn(){
			return isUserLoggedIn;
		}

		jQuery("#submitbtn").click(function() {
			var input_data = jQuery('#wp_login_form').serialize();
			jQuery.ajax({
				type: "POST",
				url:  "/wp-admin/admin-ajax.php",
				data: "action=logmein&" + input_data,
				success: function(msg) {
					if(msg=='Success'){
						setTimeout("location.reload(true);");
						return false;
					} else {
						$('.lightboxMessage').html(msg).show();
					};
				}
			});
			return false;
		});

		jQuery("#submitbtn2").click(function() {
			var input_data = jQuery('#wp_reg_form').serialize();
			jQuery.ajax({
				type: "POST",
				url:  "/wp-admin/admin-ajax.php",
				data: "action=newuserreg&" + input_data,
				success: function(msg) {
					if(msg=='Success') {
						setTimeout("location.reload(true);");
						return false;
					} else {
						$('.lightboxMessage').html(msg).show();
					};
				}
			});
			return false;
		});

		jQuery("#fpassword").click(function(e) {
			e.preventDefault();
			jQuery("#user-ajax-login").hide();
			jQuery("#forgot-pass").show();
		});

		jQuery("#backtologin2").click(function(e){
			e.preventDefault();
			jQuery("#forgot-pass").hide();
			jQuery("#user-ajax-login").show();
		});

		jQuery("#regon").click(function() {
	        jQuery("#user-ajax-login").hide();
	        jQuery("#user-ajax-register").show();
	        return false;
		});

		jQuery("#logon").click(function() {
   			jQuery("#user-ajax-register").hide();
    		jQuery("#user-ajax-login").show();
    		return false;
		});

		mixpanel.track('Loaded Date Package', {'postID': postID });

	} else {
		var day = new Date().getUTCDay();
		var type = "packages";
		var location = "alllocations";
		var prices = "allprice";
		var time = "alltime";
		input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+prices+"&time="+time+"&day=" + day;
		populateDatePackages(input_date);

		mixpanel.track('Loaded Date Idea', {'postID': postID });
	}

	function populateDatePackages(iData){
		searchIndex = 1;
		jQuery("#results2").html("");
		jQuery("#ur-date-ideas2").html("");
		jQuery("#results").html("<img id='loadImage' src='/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		jQuery.ajax({
			type: "POST",
			url:  "/wp-admin/admin-ajax.php",
			dataType: 'json',
			data: input_date,
			success: function(msg) {
				jQuery('#loadImage').remove();
				searchResults = msg;
				store();
				loadResults(1, 2, true);
			}
		});
	}
});
