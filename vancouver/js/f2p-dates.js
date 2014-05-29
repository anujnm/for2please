function equalHeight () {
	var date_details = jQuery(".date_details").height();
	var date_info = jQuery(".date_info").height();

	if (date_info >= date_details) {
		jQuery(".date_details").height(date_info+25);
	}
}

/*
function stripeResponseHandler(status, response)
{
   if (response.error)
   {
      $("#payment-error").html(response.error.message).show();;
      $("#buy-now").removeAttr("disabled");
      $("#overlay").css("visibility", "hidden");
      $("#overlay-background").css("visibility", "hidden");
   }
   else
   {
      // Stripe.js generated a token successfully. The card can now be charged.
      var token = response.id;
      var redemptionFirstName = $("#first_name").val();
      var redemptionLastName = $("#last_name").val();
      var firstName = $("#billing_fname").val();
      var lastName = $("#billing_lname").val();
      var email = $("#billing_email").val();
      var quantity = $("#buy-quantity").val();
      var nonce_name = 'purchase_' + postID;
      var ajax_nonce = $('#' + nonce_name).val();

      var request = $.ajax({
		type: "POST",
		url: "/vancouver/wp-admin/admin-ajax.php",
		dataType: "json",
		data: "action=pp_action&stripeToken="+token+"&email="+email+"&firstName="+firstName+"&lastName="+lastName+"&quantity="+quantity+"&theID="+postID+"&redemptionFirstName="+redemptionFirstName+"&redemptionLastName="+redemptionLastName+"&checkout="+ajax_nonce
	});

 	request.success(function(msg)
	{
      if (msg.result === 0)
      {
        jQuery('#buy-process').html(msg.message).attr("style", "display:none; z-index: 100; position: absolute; background-color: #1a1a1a; overflow:hidden; margin-bottom:20px;");
        jQuery("#buy-process").show();
        mixpanel.track('Purchase Successful', {'postID': postID });
        var ga_data = msg.ga_data;
        GAAddTransaction(ga_data.transID, ga_data.merchantName, ga_data.total, ga_data.tax);
        GAAddItem(ga_data.transID, ga_data.productName, ga_data.category, ga_data.price_per_item, ga_data.quantity);
        ga('ecommerce:send');
      }
      else
      {
        if (msg.message !== null && msg.message !== undefined) {
        	$("#payment-error").html(msg.message).show();;
        }
      }
      $("#buy-now").removeAttr("disabled");
      $("#overlay").css("visibility", "hidden");
      $("#overlay-background").css("visibility", "hidden");
    });

    request.error(function(jqXHR, textStatus)
    {
    	$("#payment-error").html("Failed to complete request, your card was not charged").show();;
    	$("#buy-now").removeAttr("disabled");
    	$("#overlay").css("visibility", "hidden");
    	$("#overlay-background").css("visibility", "hidden");
    });
   }
}
*/

function GAAddTransaction(transID, merchantName, revenue, tax) {
	ga('ecommerce:addTransaction', {
		'id': transID,                     // Transaction ID. Required.
		'affiliation': merchantName,   // Affiliation or store name.
		'revenue': '' + revenue,               // Grand Total.
		'shipping': '0',                  // Shipping.
		'tax': '' + tax                     // Tax.
	});
}

function GAAddItem(transID, productName, category, price, quantity) {
	ga('ecommerce:addItem', {
		'id': transID,                     // Transaction ID. Required.
		'name': productName,    // Product name. Required.
		'sku': '',                 // SKU/code.
		'category': category,         // Category or variation.
		'price': '' + price,                 // Unit price.
		'quantity': '' + quantity                   // Quantity.
	});
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

	if(typeof price !== 'undefined') {
		/*
		var price_t=price*jQuery('#buy-quantity').val();
		var taxe_t=taxes*jQuery('#buy-quantity').val();
		var fees_t=fees*jQuery('#buy-quantity').val();
		var total_t = total*jQuery('#buy-quantity').val();

		jQuery('#price').html("Price: $" + price_t.toFixed(2));
		jQuery('#taxes').html("Taxes: $" + taxe_t.toFixed(2));
		jQuery('#fees').html("Fees: $" + fees_t.toFixed(2));
		jQuery('#total_price').html("Total: $<span id='total_amount'>" + total_t.toFixed(2) + "</span>");
		jQuery('#amount').val(total_t.toFixed(2));
		*/
	}

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
					url:  "/vancouver/wp-admin/admin-ajax.php",
					data: "action=getpermalink&id=" + sessionStorage.getItem(i-1),
					success: function(msg){
						jQuery("#previous_page_link").html("<a href='"+msg+"'><div class='previous_page_link'><div>Prev</div></div></a>");
					}
				});
			}
			if(sessionStorage.getItem(i+1)) {
				jQuery.ajax({
					type: "POST",
					url:  "/vancouver/wp-admin/admin-ajax.php",
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
		/*
		jQuery("#buy-button").click(function() {
			jQuery("#buy").hide();
			$("#overlay").css("visibility", "visible");
			$("#overlay-background").css("visibility", "visible");

			if(isLoggedIn()==0) {
				$("#overlay").css("visibility", "hidden");
				$("#overlay-background").css("visibility", "hidden");
				ga('send', 'event', 'button', 'click', 'buy-button-logged-in', 1);
				mixpanel.track('Clicked Buy Button', { 'postID': postID });
				jQuery("#buy-process").show();
				return false;
			} else {
				$("#overlay").css("visibility", "hidden");
				$("#overlay-background").css("visibility", "hidden");
				ga('send', 'event', 'button', 'click', 'buy-button-not-logged-in', 1);
				mixpanel.track('Clicked Buy Button', { 'postID': postID });
				jQuery("#user-ajax-login").show();
				return false;
			}
		});

		jQuery("#price-descriptor").click(function(){
			jQuery("#buy-button").hide();
			$("#overlay").css("visibility", "visible");
			$("#overlay-background").css("visibility", "visible");

			if(isLoggedIn()==0) {
				$("#overlay").css("visibility", "hidden");
				$("#overlay-background").css("visibility", "hidden");
				jQuery("#buy-process").show();
				return false;
			} else {
				$("#overlay").css("visibility", "hidden");
				$("#overlay-background").css("visibility", "hidden");
				jQuery("#user-ajax-login").show();
				return false;
			}
		});

		jQuery('#buy-quantity').live("change",function(){
			var price_t=price*jQuery('#buy-quantity').val();
			var taxe_t=taxes*jQuery('#buy-quantity').val();
			var fees_t=fees*jQuery('#buy-quantity').val();
			var total_t = total*jQuery('#buy-quantity').val();

			jQuery('#price').html("Price: $" + price_t.toFixed(2));
			jQuery('#taxes').html("Taxes: $" + taxe_t.toFixed(2));
			jQuery('#fees').html("Fees: $" + fees_t.toFixed(2));
			jQuery('#total_price').html("Total: $<span id='total_amount'>" + total_t.toFixed(2) + "</span>");
			jQuery('#amount').val(total_t.toFixed(2));
		});

		jQuery('#buy-now').live("click",function(){

			$("#payment-error").html("").hide();
			// Boom! We passed the basic validation, so request a token from Stripe:
			var user_firstname = $("#first_name").val();
			var user_lastname = $("#last_name").val();
			var fName = $('#billing_fname').val();
	      	var lName = $('#billing_lname').val();
	      	if ((fName == null || fName == "") && (lName == null || lName == "")) {
	      		$("#payment-error").html("Please enter a valid name for billing.").show();
	      		return false;
	      	}
	      	var email = $('#billing_email').val();
	      	if (email == null || email == "") {
	      		$("#payment-error").html("Sorry, we couldn't find your email address. Are you sure you're logged in? ").show();
	      		return false;
	      	}
	      	var cardNumber = $('#cnumber').val();
	      	if (cardNumber == null || cardNumber == "") {
	      		$("#payment-error").html("Please enter a valid card number.").show();
	      		return false;
	      	}
	      	var cardCVC = $('#csv').val();
	      	if (cardCVC == null || cardCVC == "") {
	      		$("#payment-error").html("Please enter a valid CVC.").show();
	      		return false;
	      	}
	      	Stripe.setPublishableKey('');
			// Disable button and remove errors.
			$("#buy-now").attr("disabled", "disabled");
			$("#overlay").css("visibility", "visible");
			$("#overlay-background").css("visibility", "visible");
			Stripe.createToken({
			   number: cardNumber,
			   cvc: cardCVC,
			   exp_month: $('#emonth').val(),
			   exp_year: $('#eyear').val(),
			   name: (fName+ " " + lName).trim()
			}, stripeResponseHandler);
		    mixpanel.track('Clicked Purchase', {'postID': postID });
			ga('send', 'event', 'button', 'click', 'buy-now', 1);
			// Prevent the default submit action on the form
			return false;

		});*/

		jQuery('#share-submit').click(function(){
			var input_data = jQuery('#share-this-date').serialize();
			jQuery.ajax({
				type: "POST",
				url: "/vancouver/wp-admin/admin-ajax.php",
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
				url:  "/vancouver/wp-admin/admin-ajax.php",
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
				url:  "/vancouver/wp-admin/admin-ajax.php",
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
		jQuery("#results").html("<img id='loadImage' src='/vancouver/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		jQuery.ajax({
			type: "POST",
			url:  "/vancouver/wp-admin/admin-ajax.php",
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
