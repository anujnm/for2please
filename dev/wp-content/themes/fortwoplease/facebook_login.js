/*
window.fbAsyncInit = function() {
	var uid;
	var accessToken;
	FB._https = (window.location.protocol == "https:");
	FB.init({
	// appId      : '140109872734286',
	appId      : '121541631324064', // App ID
	//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	status     : true, // check login status
	cookie     : true, // enable cookies to allow the server to access the session
	xfbml      : true  // parse XFBML
	//oauth : true
	});	
};
*/

function fb_login () {
	
	var uid;
	var accessToken;
	FB._https = (window.location.protocol == "https:");
	FB.init({
	//appId      : '140109872734286',
	//appId      : '121541631324064', // Local Facebook App ID
	appId      : '442143535808692', // Dev Facebook App ID
	//appId      : '185259828274700', // Live Facebook App ID
	//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	status     : true, // check login status
	cookie     : true, // enable cookies to allow the server to access the session
	xfbml      : true  // parse XFBML
	//oauth : true
	});
	
	console.log("button clicked...");
	/*
	FB.getLoginStatus(function(response) {
		//console.log(response);	
	  if (response.status === 'connected') {
	    // the user is logged in and has authenticated your
	    // app, and response.authResponse supplies
	    // the user's ID, a valid access token, a signed
	    // request, and the time the access token 
	    // and signed request each expire
	    var uid = response.authResponse.userID;
	    var accessToken = response.authResponse.accessToken;

		//console.log("is connected");

		FB.api('/me', function(info) {

//			console.log("user first_name: " + info.first_name);
//			console.log("user last_name: " + info.last_name);
//			console.log("user name: " + info.name);
//			console.log("user email: " + info.email);
//			console.log("user birthday: " + info.birthday);
//			console.log("user gender: " + info.gender);

			if (info.email === undefined)
				return;

			var input_data = "username=" + info.name  + "&fname=" + info.first_name + "&lname=" + info.last_name + "&email=" + info.email + "&password=123456&password2=123456";
			// input_data = jQuery(input_data).serialize();
			//console.log(input_data);
			jQuery.ajax({
				type: "POST",
				url: "/dev/wp-admin/admin-ajax.php",
				data: "action=fbcheckuserexists&" + input_data,
				success: function(msg) {
					if(msg == 'Success'){
						if (window.location.pathname.indexOf("subscribe") > 0 || window.location.pathname.indexOf("login") > 0
						 || window.location.pathname.indexOf("join") > 0  || window.location.pathname.indexOf("forgot-password") > 0)
							setTimeout("location.assign('/'+window.location.pathname.split('/')[1]);");
						else
							setTimeout("location.reload(true);");
					} else { 
						alert(msg)
					};
				}
			});
		});
	  } else {
	  */
	    // the user isn't logged in to Facebook.
		//console.log("is not logged in");
		FB.login(function(response) {
			if (response.authResponse) {
				FB.api('/me', function(info) {
/*
					console.log("user first_name: " + info.first_name);
					console.log("user last_name: " + info.last_name);
					console.log("user name: " + info.name);
					console.log("user email: " + info.email);
					console.log("user birthday: " + info.birthday);
					console.log("user gender: " + info.gender);
*/

					if (info.email === undefined) {
						if (info.username === undefined) {
							return;
						} else {
							var email = info.username + "@facebook.com";
							var input_data = "username=" + info.name  + "&fname=" + info.first_name + "&lname=" + info.last_name + "&email=" + email + "&password=123456&password2=123456";
						}
					} else {
						var input_data = "username=" + info.name  + "&fname=" + info.first_name + "&lname=" + info.last_name + "&email=" + info.email + "&password=123456&password2=123456";
					}

					jQuery.ajax({
						type: "POST",
						url: "/dev/wp-admin/admin-ajax.php",
						data: "action=fbcheckuserexists&" + input_data,
						success: function(msg) {
							if(msg == 'Success'){
								if (window.location.pathname.indexOf("subscribe") > 0 || window.location.pathname.indexOf("login") > 0
								 || window.location.pathname.indexOf("join") > 0  || window.location.pathname.indexOf("forgot-password") > 0)
									setTimeout("location.assign('/'+window.location.pathname.split('/')[1]);");
								else
									setTimeout("location.reload(true);");
							} else if ($('.lightboxMessage').length) { 
								$('.lightboxMessage').html(msg).show();
							} else {
								alert(msg);
							}
						}
					});	
				});
			} else {
			}
		}, {scope:'email'});
		/*
	  }
	 });
	 */
}


(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));