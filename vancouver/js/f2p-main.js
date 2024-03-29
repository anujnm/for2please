var searchResults = new Array();
var searchIndex = 15;

jQuery(function() {
	//jQuery("#datepicker").multiDatesPicker();
});

jQuery("#testclick").click( function() {
	var date = jQuery( "#datepicker" ).datepicker('getDate');
	if(date==null) {
		alert("please choose a date");
	} else {
		var dayOfWeek = date.getUTCDay();
		alert(dayOfWeek);
	}
});



function clearAllSelected() {
	jQuery("#linkwrapper>span>a").each(function(index, element) {
		jQuery(this).removeClass("selected");
	});
}

//****************************************************CATEGORIES*********************************************//
jQuery("#dinning-link").click(function() {
	clearAllSelected();
	jQuery(this).addClass("selected");
	//input_date = "action=searchdates&datetype=restaurants&location=alllocations&price=allprice&time=alltime";
	input_date = "action=searchdates&datetype=restaurants&location=alllocations&price=allprice&time=alltime";
	searchDate(input_date);
});

jQuery("#active-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=active&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});

jQuery("#adven-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=adventurous&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});

jQuery("#getaway-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=getaways&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});

jQuery("#anniver-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=anniversary&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});

jQuery("#enter-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=entertainment&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});

jQuery("#packg-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
	input_date = "action=searchdates&datetype=packages&location=alllocations&price=allprice&time=alltime";

	searchDate(input_date);
});


//************************************DO A SEARCH*******************************************//
function searchDate(iData, isLandingPage){
	searchIndex = 1;
	jQuery("#results2").html("");
	jQuery("#ur-date-ideas2").html("");
	jQuery("#results").html("<img id='loadImage' src='/date-ideas/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
	jQuery.ajax({
		type: "POST",
		url:  "/date-ideas/wp-admin/admin-ajax.php",
		dataType: 'json',
		data: input_date,
		success: function(msg) {
			jQuery('#loadImage').remove();
			searchResults = msg;
			store();
			var max = msg.length > 15 ? 15 : msg.length;
			if (typeof isLandingPage === "undefined") {
				loadResults(1, max);
			} else if (typeof isLandingPage == "boolean" && isLandingPage == true) {
				loadResults(1, max);
			} else {
				loadResults(1, msg.length);
			}
		}
	});
}

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.search);
  if(results == null)
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
}

jQuery(document).ready(function($) {

	jQuery("#searchsubmit").click( function() {
		jQuery("#ur-date-ideas-title").html("YOUR DATE IDEAS");
		//jQuery("#results").html("<img src='/date-ideas/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		var date = jQuery("#datepicker").datepicker('getDate');
		if(date == null) {
			alert("please choose a date");
			return false;
		} else {
			var day = date.getUTCDay();
		}

		var type = jQuery("#type").val();
		var location = jQuery("#location").val();
		var price = jQuery("#price").val();
		var city = (jQuery('#downarrow')[0].href).substring(44);
		var time = "alltime";

		input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day="+day+"&city="+city;

		searchDate(input_date);
	});

	$('#type').dropkick();
	$('#location').dropkick();
	$('#price').dropkick();

	jQuery("#dk_container_time").live("mouseenter",function (e) {
		e.preventDefault();
		jQuery(this).addClass("dk_focus dk_open");
	}).live("mouseleave",function (e) {
		jQuery(this).removeClass("dk_focus dk_open");
	});

	var cookies = get_cookies_array();
	for(var name in cookies) {
		if(name == 'f2p-type') {
			jQuery("#dk_container_type>a>span").html(cookies[name]);
		}
		if(name == 'f2p-location') {
			jQuery("#dk_container_location>a>span").html(cookies[name]);
		}
		if(name == 'f2p-price') {
			jQuery("#dk_container_price>a>span").html(cookies[name]);
		}
		if(name == 'f2p-time') {
			jQuery("#dk_container_time>a>span").html(cookies[name]);
		}
	}

	var querySearch = getParameterByName("q");
	console.log(querySearch);

	if (querySearch != "") {
		jQuery("#ur-date-ideas-title").html("YOUR DATE IDEAS");
		searchIndex = 1;
		jQuery("#results2").html("");
		input_data = "action=searchbykeyword&key="+querySearch;
		jQuery.ajax({
			type: "POST",
			url:  "/date-ideas/wp-admin/admin-ajax.php",
			data: input_data,
			dataType: 'json',
			success: function(msg) {
				searchResults = msg;
				store();
				loadResults(1,15);
			}
		});
	} else {
			var day = new Date().getUTCDay();
			var type = "alltypes";
			var location = "alllocations";
			var price = "allprice";
			var time = "alltime";
			var city = (jQuery('#downarrow')[0].href).substring(44);
			input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day="+day+"&city="+city;
			searchDate(input_date, true);
	}

	jQuery(window).scroll(function () {
		if (jQuery(window).scrollTop() == $(document).height() - $(window).height()) {
			loadResults(searchIndex,searchIndex+15);
		}
	});
});

jQuery(".testsearch").live("mouseenter",function(){jQuery("div.testsearch2",this).fadeIn('fast');});
jQuery(".testsearch").live("mouseleave",function(){jQuery("div.testsearch2",this).fadeOut('fast');});

jQuery(".testsearch").live("click",function(){
	document.cookie = 'f2p-browsing='+this.id;
	document.cookie = 'f2p-type='+jQuery("#dk_container_type>a>span").text();
	document.cookie = 'f2p-location='+jQuery("#dk_container_location>a>span").text();
	document.cookie = 'f2p-time='+jQuery("#dk_container_time>a>span").text();
	document.cookie = 'f2p-price='+jQuery("#dk_container_price>a>span").text();

	window.location=$(this).find("a").attr("href");
	return false;
});


jQuery("#chk-mor").click(function(){
	checkboxTrigger();
});

jQuery("#chk-day").click(function(){
	checkboxTrigger();
});

jQuery("#chk-eve").click(function(){
	checkboxTrigger();
});

function checkboxTrigger(){
	var morChk = jQuery("#chk-mor").is(':checked');
	var dayChk = jQuery("#chk-day").is(':checked');
	var eveChk = jQuery("#chk-eve").is(':checked');

	if(morChk&&dayChk && eveChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Any Time");
	} else if(morChk && dayChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning, Day");
	} else if(morChk && eveChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning, Evening");
	} else if(dayChk && eveChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Day, Evening");
	} else if(morChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning");
	} else if(dayChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Day");
	} else if(eveChk) {
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Evening");
	} else{
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Please Select");
	}
}
