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

//************************************LOAD SIGNLE RESULT WINDOW *******************************************//
function loadResults(start,end){
	if(!sessionStorage) {
		alert("noresults");
	}

	var cookies = get_cookies_array();
	for(var name in cookies) {
		if(name == 'f2p-browsing') {
			var iselector = "#"+cookies[name];
		}
	}

	
	//jQuery("#results").hide();
	for (var i = start; i < end; i++) {
		if (sessionStorage.getItem(i) && sessionStorage.getItem(i) != "undefined") {
		    var date1 = sessionStorage.getItem(i);
			if(sessionStorage.getItem(i+1) && sessionStorage.getItem(i+1) != "undefined"){
				var date2 = sessionStorage.getItem(i+1);
				i = i+1;
			}
			else{
			 date2 = "empt";
			 }
			if(sessionStorage.getItem(i+1) && sessionStorage.getItem(i+1) != "undefined"){
				var date3 = sessionStorage.getItem(i+1);
				i = i+1;
			}
			else{
				date3 = "empt";
			}

			input_date = "action=loaddate&dateID1="+date1+"&dateID2="+date2+"&dateID3="+date3;
			
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: input_date,
				success: function(msg){
					jQuery("#results2").append(msg);
					if(iselector){			
						jQuery(iselector).find('.testsearch2').css('display','block');
					}
				}
			});
		} else {
			jQuery("#ur-date-ideas2").html('<p style="font-size:24px;color:#777;clear:both;">------------------------------ WE ALSO SUGGEST ------------------------------</p>');
			input_date = "action=loaddate&dateID1=rand";
			
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: input_date,
				success: function(msg){
				jQuery("#results2").append(msg);	

				}
			});
		}
	}
	
	//jQuery("#results").show();
	searchIndex += end;
}


//************************************DO A SEARCH*******************************************//
function searchDate(iData, isLandingPage){
	searchIndex = 1;
	jQuery("#results2").html("");
	jQuery("#ur-date-ideas2").html("");
	jQuery("#results").html("<img id='loadImage' src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
	jQuery.ajax({
		type: "POST",
		url:  "/dev/wp-admin/admin-ajax.php",
		dataType: 'json',
		data: input_date,
		success: function(msg) {	
			jQuery('#loadImage').remove();
			searchResults = msg; 
			store();
			if (typeof isLandingPage === "undefined") {
				loadResults(1,15);
			} else {
				loadResults(1, msg.length);
			}
			console.log("success");
			console.log(msg);
		}
	});
}

function store() {
	if(searchResults) {
		sessionStorage.clear();
		for(var i=1;i<searchResults.length+1;i++) {
			sessionStorage[i] = searchResults[i];
		}
	}
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
		//jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
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
		var time = "alltime";
	
		input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day=" + day;
	
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
			url:  "/dev/wp-admin/admin-ajax.php",
			data: input_data,
			dataType: 'json',
			success: function(msg) {
				searchResults = msg; 
				store();	
				loadResults(1,15);
			}
		});
	} else {
		//jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		//if(sessionStorage.length < 1) {
			var day = new Date().getUTCDay();
			var type = "packages";
			var location = "alllocations";
			var price = "allprice";
			var time = "alltime";
			input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day=" + day;
			
			console.log("searchDate");
			searchDate(input_date, true);
			//loadResults(1,9);
		//} else {
			//console.log("loadResults");
		//	loadResults(1,15);
		//}
	}

	jQuery(window).scroll(function () {
		if ((jQuery(window).scrollTop() == $(document).height() - $(window).height()) && (searchIndex-1) % 15 == 0) {
			loadResults(searchIndex,searchIndex+15);
		}
	});
});

//***********************TEXT SEARCH BOX*******************
function get_cookies_array() {
	var cookies = { };

	if (document.cookie && document.cookie != '') {
		var split = document.cookie.split(';');
		for (var i = 0; i < split.length; i++) {
	   		var name_value = split[i].split("=");
	  		name_value[0] = name_value[0].replace(/^ /, '');
	  		cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
		}
	}

	return cookies;
}

//***********************TEXT SEARCH BOX*******************
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
