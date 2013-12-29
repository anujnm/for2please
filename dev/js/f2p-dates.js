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
	var date_content = jQuery(".date_content").height();
	
	if (date_content >= date_details) {
		jQuery(".date_details").height(date_content+25);
	}
}

function stripeResponseHandler(status, response)
{
   if (response.error) 
   {
      $("#payment-error").html(response.error.message).show();;
      $("#buy-now").removeAttr("disabled");
      $("#loading").hide();
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
      var pricePerItem = $("#price").text().substring(8);
      var price = $("#total_amount").html();
      var quantity = $("#buy-quantity").val();
 
      var request = $.ajax({
		type: "POST",
		url: "/dev/wp-admin/admin-ajax.php",
		dataType: "json",
		data: "action=pp_action&stripeToken="+token+"&email="+email+"&firstName="+firstName+"&lastName="+lastName+"&price="+price+"&quantity="+quantity+"&theID="+postID+"&redemptionFirstName="+redemptionFirstName+"&redemptionLastName="+redemptionLastName+"&pricePerItem="+pricePerItem
	});

 	request.success(function(msg)
	{
      if (msg.result === 0)
      {
        jQuery('#buy-process').html(msg.message).attr("style", "display:none; z-index: 100; position: absolute; background-color: #1a1a1a; overflow:hidden; margin-bottom:20px;");
        jQuery("#buy-process").show();
      }
      else
      {
        if (msg.message !== null && msg.message !== undefined) {
        	$("#payment-error").html(msg.message).show();;
        }
      }
      $("#buy-now").removeAttr("disabled");
      $("#loading").hide();
    });

    request.error(function(jqXHR, textStatus)
    {
    	$("#payment-error").html("Failed to complete request, your card was not charged").show();;
    	$("#buy-now").removeAttr("disabled");
    	$("#loading").hide();
    });
   }
}


function stripeChargeError(data) {
    alert("Error: failed to call pay.php to process the transaction.");
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
		var price_t=price*jQuery('#buy-quantity').val();
		var taxe_t=taxes*jQuery('#buy-quantity').val();
		var fees_t=fees*jQuery('#buy-quantity').val();
		var total_t = total*jQuery('#buy-quantity').val();
	
		jQuery('#price').html("Price: $" + price_t.toFixed(2));
		jQuery('#taxes').html("Taxes: $" + taxe_t.toFixed(2));
		jQuery('#fees').html("Fees: $" + fees_t.toFixed(2));
		jQuery('#total_price').html("Total: $<span id='total_amount'>" + total_t.toFixed(2) + "</span>");
		jQuery('#amount').val(total_t.toFixed(2));
	}

	jQuery(".testsearch").live("mouseenter",function(){jQuery("div.testsearch2",this).fadeIn('fast');});
	jQuery(".testsearch").live("mouseleave",function(){jQuery("div.testsearch2",this).fadeOut('fast');});

	var i;
	var id = postID;
	for(i=1;i<sessionStorage.length+1;i++) {
		var thisitem = sessionStorage.getItem(i);
		if(thisitem == id) {
			if(sessionStorage.getItem(i-1)) {
				jQuery.ajax({
					type: "POST",
					url:  "/dev/wp-admin/admin-ajax.php",
					data: "action=getpermalink&id=" + sessionStorage.getItem(i-1),
					success: function(msg){
						jQuery("#previous_page_link").html("<a href='"+msg+"'><div class='previous_page_link'><div>Prev</div></div></a>");
					}
				});
			}
			if(sessionStorage.getItem(i+1)) {
				jQuery.ajax({
					type: "POST",
					url:  "/dev/wp-admin/admin-ajax.php",
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

	/*var map = new GMap2(document.getElementById("map_canvas"));
	geocoder = new GClientGeocoder();
	if (geocoder) {
		geocoder.getLatLng(
			address,
			function(point) {
				if (!point) {
					alert(address + " not found");
				} else { 
					map.setCenter(point, 15);
					var marker = new GMarker(point);
					map.addOverlay(marker);
				}
			}
		);
	}*/

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

		jQuery("#buy-button").click(function() {
			jQuery("#buy").hide();
			jQuery("#loading").show();
			if(isLoggedIn()==0) {
				jQuery("#loading").hide();
				jQuery("#buy-process").show();
				return false;
			} else {
				jQuery("#loading").hide();
				jQuery("#user-ajax-login").show();
				return false;	
			}
		});

		jQuery("#price-descriptor").click(function(){	
			jQuery("#buy-button").hide();
			jQuery("#loading").show();
			if(isLoggedIn()==0) {
				jQuery("#loading").hide();
				jQuery("#buy-process").show();
				return false;
			} else {
				jQuery("#loading").hide();
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
			
			//var input_data = jQuery('#buy_package_form').serialize();
			//var theID = theID;
			//jQuery.ajax({
			//	type: "POST",
			//	url: "/dev/wp-admin/admin-ajax.php",
			//	data: "action=pp_action&" + input_data + "&theID=" + postID + "&postid=" + postID,
			//	success: function(msg) {
			//		if (msg.indexOf("payment did not go through") > 0)
			//			alert(msg.substring(0,msg.length-1));
			//		else
			//			jQuery('#buy-process').html(msg).show();
			//	}
			//});
			//return false;

			// Disable button and remove errors.
			$("#buy-now").attr("disabled", "disabled");
			$("#loading").show();
			$("#payment-error").html("").hide();
			// Boom! We passed the basic validation, so request a token from Stripe:
			var user_firstname = $("#first_name").val();
			var user_lastname = $("#last_name").val();
			var fName = $('#billing_fname').val();
	      	var lName = $('#billing_lname').val();
	      	var email = $('#billing_email').val();
	      	var cardNumber = $('#cnumber').val();
	      	var cardCVC = $('#csv').val();
	      	

			Stripe.createToken({
			   number: cardNumber,
			   cvc: cardCVC,
			   exp_month: $('#emonth').val(),
			   exp_year: $('#eyear').val(),
			   name: (fName+ " " + lName).trim()
			}, stripeResponseHandler);
			 
			// Prevent the default submit action on the form
			return false;

		});

	/*
		jQuery('#buy-now').live("click",function(){
			cardholder = jQuery("#fullname").val();
			eyear = jQuery("#eyear").val();
			emonth = jQuery("#emonth").val();
			nump = jQuery("#buy-quantity").val();
			cardnum = jQuery("#cnumber").val();
			csv = jQuery("#csv").val();
			
			var data= "url=https://www.beanstream.com/scripts/process_transaction.asp?merchant_id=117582634&requestType=BACKEND&trnType=P&trnOrderNumber="+postID+"-"+orderID+"&trnAmount="+total+"&trnCardOwner="+cardholder+"&trnCardNumber="+cardnum+"&ordName="+cardholder+"&trnCardCvd="+csv+"&trnExpMonth="+emonth+"&trnExpYear="+eyear;
			jQuery.ajax({
				type: "POST",
				url: "/dev/wp-admin/admin-ajax.php",
				data: "action=my_special_action&" + data +"&postid="+postID+"&numberp="+nump,
				success: function(msg){
				if(getQueryVariable("trnApproved",msg) == 0) {
					var perror = getQueryVariable("messageText",msg);
					var perror2 = perror.replace(/\+/g," ");
					jQuery("#payment-error").html(perror2).show();;
				}

				if(getQueryVariable("trnApproved",msg) == 1) {
					var theID = postID;
					var amount = getQueryVariable("trnAmount",msg);
					var authCode = getQueryVariable("authCode",msg);
					jQuery("#buy-process").html("<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>Approved!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/dev/wp-content/themes/images/step3.png' /></div><div style='margine:float:left;clear:both;'><p>Success! Your card has been charged the amount of $"+amount+".</p><p>Your authorization code is: "+authCode+".</p><p> A confirmation email has been emailed. Please check your account for details on how to make a reservation</p></div></div>");
					input_data ="action=sendconfmail&theID="+theID+"&totalPrice="+amount+"&transID="+authCode; 
					jQuery.ajax({
						type: "POST",
						url:  "/dev/wp-admin/admin-ajax.php",
						data: input_data,
						success: function(msg) {	
						}
					});
				}
			}
		});
		return false;
	});
	*/

		jQuery('#share-submit').click(function(){
			var input_data = jQuery('#share-this-date').serialize();
			jQuery.ajax({
				type: "POST",
				url: "/dev/wp-admin/admin-ajax.php",
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
			/*
			var result = false;
			jQuery.ajax({
				type: "POST",
				url: "/dev/wp-admin/admin-ajax.php",
				data: "action=loggedin&",
				async: false,
				success: function(name){
					console.log("logged in? " + name);
					result = name;
				}	
			});
			return result;
			*/
			return isUserLoggedIn;
		}

		jQuery("#submitbtn").click(function() {
			var input_data = jQuery('#wp_login_form').serialize();
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: "action=logmein&" + input_data,
				success: function(msg) {
					if(msg=='Success'){
						jQuery("#user-ajax-login").hide();
						jQuery("#buy-process").show();
						return false;
					} else{ alert(msg) };
				}
			});
			return false;
		});



		jQuery("#submitbtn2").click(function() {
			var input_data = jQuery('#wp_reg_form').serialize();
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: "action=newuserreg&" + input_data,
				success: function(msg) {
					if(msg=='Success') {
						jQuery("#user-ajax-register").hide();
						jQuery("#buy-process").show();
						return false;
					} else { alert(msg) };
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
	}
});
