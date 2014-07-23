jQuery(document).ready(function($) {
	var id = postID;
	var id1 = 0;
	var id2 = 0;
	var id3 = 0;
	
	jQuery('#share-submit').click(function(e){
	e.preventDefault();
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
					jQuery("#nplinks").html("<a href='"+msg+"'>< Previous</a>");
				}
			});
		}
		if(sessionStorage.getItem(i+1)) {
			jQuery.ajax({
				type: "POST",
				url:  "/vancouver/wp-admin/admin-ajax.php",
				data: "action=getpermalink&id=" + sessionStorage.getItem(i+1),
				success: function(msg){
					jQuery("#nplinks2").html("<a href='"+msg+"'>Next ></a>");
				}
			});
		}
	}
}


// Load the classic theme
Galleria.loadTheme(homeURL+"/slider/themes/classic/galleria.classic.min.js");

// Initialize Galleria
jQuery('#galleria').galleria({
    autoplay: 4000 // will move forward every 7 seconds
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


if(price) { 

	jQuery("#buy-button").click(function() {
		jQuery("#buy-button").hide();
		jQuery("#loading").show();
		if(isLoggedIn()==0) {
			jQuery("#loading").hide();
			jQuery("#buy-process").html("<div style='height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>PAYMENT</h1><img style='float:right;margin-top:5px;margin-bottom:10px;margin-right:20px;' src='/vancouver/wp-content/themes/images/step2.png' /></div><div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div><div style='clear:both;margin-left:80px;margin-bottom:10px;float:right;margin-right:20px;'>Quantity: <select style='background-color:#CCC;border:none;'id='buy-quantity'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select><span id='price'> Price: $" + price.toFixed(2) + "</span></div><div id='price-detail' style='float:right;clear:both;height:60px;margin-right:20px;'><div id='taxes'>Taxes: $"+ taxes.toFixed(2) +"</div><div id='fees'>Fees: $"+ fees.toFixed(2) +"</div><div id='total_price'>Total: $"+ total.toFixed(2) +"</div></div><div style='float:right;margin-right:20px;margin-bottom:10px;'><img src='/vancouver/wp-content/themes/images/payments.png'></img></div><div style='float:right;clear:both;margin-right:20px;'><div style='height:30px;width:300px;'>CardHolder Name: <input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;'/></div><div style='height:30px;'>Card Number: <input type='text' id='cnumber' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' /></div><div style='height:30px;'>Exp year:<select style='float:right;background-color:#CCC;border:none;'id='eyear'><option value='12'>2012</option><option value='13'>2013</option><option value='14'>2014</option><option value='15'>2015</option><option value='16'>2016</option><option value='17'>2017</option><option value='18'>2018</option><option value='19'>2019</option></select></div><div style='height:30px;'>Exp Month:<select style='float:right;background-color:#CCC;border:none;' id='emonth'><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select></div><div style='height:30px;'>Security Code: <input type='text' id='csv' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px; margin-bottom: 5px; float: right; margin-left: 10px; width: 35px;'/></div><div style='height:30px;'></div>  <input style='float:right;clear:both;margin-right:50px;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button'></div>").show();
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
			jQuery("#buy-process").html("<div style='height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>PAYMENT</h1><img style='float:right;margin-top:5px;margin-bottom:10px;margin-right:20px;' src='/vancouver/wp-content/themes/images/step2.png' /></div><div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div><div style='clear:both;margin-left:80px;margin-bottom:10px;float:right;margin-right:20px;'>Quantity: <select style='background-color:#CCC;border:none;'id='buy-quantity'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select><span id='price'> Price: $" + price.toFixed(2) + "</span></div><div id='price-detail' style='float:right;clear:both;height:60px;margin-right:20px;'><div id='taxes'>Taxes: $"+ taxes.toFixed(2) +"</div><div id='fees'>Fees: $"+ fees.toFixed(2) +"</div><div id='total_price'>Total: $"+ total.toFixed(2) +"</div></div><div style='float:right;margin-right:20px;margin-bottom:10px;'><img src='/vancouver/wp-content/themes/images/payments.png'></img></div><div style='float:right;clear:both;margin-right:20px;'><div style='height:30px;width:300px;'>CardHolder Name: <input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;'/></div><div style='height:30px;'>Card Number: <input type='text' id='cnumber' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' /></div><div style='height:30px;'>Exp year:<select style='float:right;background-color:#CCC;border:none;'id='eyear'><option value='12'>2012</option><option value='13'>2013</option><option value='14'>2014</option><option value='15'>2015</option><option value='16'>2016</option><option value='17'>2017</option><option value='18'>2018</option><option value='19'>2019</option></select></div><div style='height:30px;'>Exp Month:<select style='float:right;background-color:#CCC;border:none;' id='emonth'><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select></div><div style='height:30px;'>Security Code: <input type='text' id='csv' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px; margin-bottom: 5px; float: right; margin-left: 10px; width: 35px;'/></div><div style='height:30px;'></div>  <input style='float:right;clear:both;margin-right:50px;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button'></div>").show();
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
		jQuery('#total_price').html("Total: $" + total_t.toFixed(2));
	});

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
			url: "/vancouver/wp-admin/admin-ajax.php",
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
				jQuery("#buy-process").html("<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>Approved!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/vancouver/wp-content/themes/images/step3.png' /></div><div style='margine:float:left;clear:both;'><p>Success! Your card has been charged the amount of $"+amount+".</p><p>Your authorization code is: "+authCode+".</p><p> A confirmation email has been emailed. Please check your account for details on how to make a reservation</p></div></div>");
				input_data ="action=sendconfmail&theID="+theID+"&totalPrice="+amount+"&transID="+authCode; 
				jQuery.ajax({
					type: "POST",
					url:  "/vancouver/wp-admin/admin-ajax.php",
					data: input_data,
					success: function(msg) {	
					}
				});
			}
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
	var result = false;
	jQuery.ajax({
		type: "POST",
		url: "/vancouver/wp-admin/admin-ajax.php",
		data: "action=loggedin&",
		async: false,
		success: function(name){
			result = name;
		}	
	});
	return result;
}

jQuery("#submitbtn").click(function() {
	var input_data = jQuery('#wp_login_form').serialize();
	jQuery.ajax({
		type: "POST",
		url:  "/vancouver/wp-admin/admin-ajax.php",
		data: "action=logmein&" + input_data,
		success: function(msg) {
			if(msg=='Success'){
				jQuery("#user-ajax-login").hide();
				jQuery("#buy-process").append("<div style='height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>PAYMENT</h1><img style='float:right;margin-top:5px;margin-bottom:10px;margin-right:20px;' src='/vancouver/wp-content/themes/images/step2.png' /></div><div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div><div style='clear:both;margin-left:80px;margin-bottom:10px;float:right;margin-right:20px;'>Quantity: <select style='background-color:#CCC;border:none;'id='buy-quantity'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select><span id='price'> Price: $" + price.toFixed(2) + "</span></div><div id='price-detail' style='float:right;clear:both;height:60px;margin-right:20px;'><div id='taxes'>Taxes: $"+ taxes.toFixed(2) +"</div><div id='fees'>Fees: $"+ fees.toFixed(2) +"</div><div id='total_price'>Total: $"+ total.toFixed(2) +"</div></div><div style='float:right;margin-right:20px;margin-bottom:10px;'><img src='/vancouver/wp-content/themes/images/payments.png'></img></div><div style='float:right;clear:both;margin-right:20px;'><div style='height:30px;width:300px;'>CardHolder Name: <input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;'/></div><div style='height:30px;'>Card Number: <input type='text' id='cnumber' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' /></div><div style='height:30px;'>Exp year:<select style='float:right;background-color:#CCC;border:none;'id='eyear'><option value='12'>2012</option><option value='13'>2013</option><option value='14'>2014</option><option value='15'>2015</option><option value='16'>2016</option><option value='17'>2017</option><option value='18'>2018</option><option value='19'>2019</option></select></div><div style='height:30px;'>Exp Month:<select style='float:right;background-color:#CCC;border:none;' id='emonth'><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select></div><div style='height:30px;'>Security Code: <input type='text' id='csv' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px; margin-bottom: 5px; float: right; margin-left: 10px; width: 35px;'/></div><div style='height:30px;'></div>  <input style='float:right;clear:both;margin-right:50px;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button'></div>").show();
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
		url:  "/vancouver/wp-admin/admin-ajax.php",
		data: "action=newuserreg&" + input_data,
		success: function(msg) {
			if(msg=='Success') {
				jQuery("#user-ajax-register").hide();
				jQuery("#buy-process").append("<div style='height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>PAYMENT</h1><img style='float:right;margin-top:5px;margin-bottom:10px;margin-right:20px;' src='/vancouver/wp-content/themes/images/step2.png' /></div><div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div><div style='clear:both;margin-left:80px;margin-bottom:10px;float:right;margin-right:20px;'>Quantity: <select style='background-color:#CCC;border:none;'id='buy-quantity'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select><span id='price'> Price: $" + price.toFixed(2) + "</span></div><div id='price-detail' style='float:right;clear:both;height:60px;margin-right:20px;'><div id='taxes'>Taxes: $"+ taxes.toFixed(2) +"</div><div id='fees'>Fees: $"+ fees.toFixed(2) +"</div><div id='total_price'>Total: $"+ total.toFixed(2) +"</div></div><div style='float:right;margin-right:20px;margin-bottom:10px;'><img src='/vancouver/wp-content/themes/images/payments.png'></img></div><div style='float:right;clear:both;margin-right:20px;'><div style='height:30px;width:300px;'>CardHolder Name: <input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;'/></div><div style='height:30px;'>Card Number: <input type='text' id='cnumber' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' /></div><div style='height:30px;'>Exp year:<select style='float:right;background-color:#CCC;border:none;'id='eyear'><option value='12'>2012</option><option value='13'>2013</option><option value='14'>2014</option><option value='15'>2015</option><option value='16'>2016</option><option value='17'>2017</option><option value='18'>2018</option><option value='19'>2019</option></select></div><div style='height:30px;'>Exp Month:<select style='float:right;background-color:#CCC;border:none;' id='emonth'><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select></div><div style='height:30px;'>Security Code: <input type='text' id='csv' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px; margin-bottom: 5px; float: right; margin-left: 10px; width: 35px;'/></div><div style='height:30px;'></div>  <input style='float:right;clear:both;margin-right:50px;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button'></div>").show();
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