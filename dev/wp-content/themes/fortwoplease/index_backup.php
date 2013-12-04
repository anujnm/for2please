 <?php get_header(); ?>

<script src="/dev/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<div style="margin-right:auto;margin-left:auto;width:1020px;background-color:white;min-height:800px;overflow:hidden;padding:20px;">
<div style="background-image: url('/dev/wp-content/themes/images/search-widget-bckg.png'); width: 1035px; height: 224px; margin-bottom: 10px; margin-left: -8px;">

<div style="position: relative; float: left; top: 65px; left: 90px; color: rgb(255, 255, 255);"><h2 style="margin-top: 0px; margin-bottom: 0px;float:left;">WHAT</h2><h2 style="margin-top: 0px; margin-bottom: 0px; float: left; margin-left: 120px;">WHERE</h2><h2 style="margin-top: 0px; margin-bottom: 0px; float: left; margin-left: 110px;">WHEN</h2><h2 style="margin-top: 0px; margin-bottom: 0px; float: left; margin-left: 95px;">HOW MUCH</h2></div>
 <div style="position: relative; float: right; top: 180px; right: 30px;">
 <form id="text-form" style="position: relative;">
 <input id="input-text-search" type="text" style="height: 25px; position: relative; bottom: 10px; border: thin solid rgb(68, 68, 68); left: 3px; width: 175px;" />
 <img id="text-search" src="/dev/wp-content/themes/images/search-mag.png" />
 </form>
 </div>

<div id="preload" style="width:0px;height:0px;display:none;">
   <img src="/dev/wp-content/themes/images/go-button.png" width="1" height="1" alt="Image 01" />
   <img src="/dev/wp-content/themes/images/go-hover.png" width="1" height="1" alt="Image 02" />
   <img src="/dev/wp-content/themes/images/go-press.png" width="1" height="1" alt="Image 03" />
    <img src="/dev/wp-content/themes/images/suprise-button.png" width="1" height="1" alt="Image 04" />
     <img src="/dev/wp-content/themes/images/suprise-hover.png" width="1" height="1" alt="Image 05" />
      <img src="/dev/wp-content/themes/images/suprise-press.png" width="1" height="1" alt="Image 06" />
</div>


<div style="float: left; position: relative; top: 94px; left: 38px;">




<form id="searchform">
 
 	<select id="type" tabindex="1">
  	<option value="alltypes" selected="selected">All Types</option>
 	<option value="restaurants" >Dining</option>
    <option value="entertainment" >Entertainment</option>
    <option value="active" >Active</option>
    <option value="adventurous" >Adventurous</option>
    <option value="getaways" >Getaways</option>
    <option value="anniversary" >Anniversary</option>
    <option value="packages" >Packages</option>
    </select>
    
    <select id="location" tabindex="2">
  	<option value="alllocations" selected="selected">All Locations</option>
    <option value="north-shore" >North Shore</option>
    <option value="commercial" >Commercial Dr</option>
    <option value="downtown" >Downtown</option>
    <option value="gas-town" >Gastown</option>
    <option value="west-end" >West End</option>
    <option value="yaletown" >Yaletown</option>
    <option value="fairview-south-granville" >Fairview & S Granville</option>
    <option value="kitsilano" >Kitsilano</option>
    <option value="mount-pleasant-main-st" >Mt Pleasant & Main St</option>
    <option value="vancouver-vancouver" >South Cambie</option>
    <option value="vancouver-island" >Vancouver Island</option>
    <option value="whistler-squamish" >Whistler/Squamish</option>
    <option value="everything-else" >Everything Else</option>
    </select>
 	
    
  
     <div tabindex="3" id="dk_container_time" class="dk_container dk_theme_default" style="display: block;"><a class="dk_toggle" style="width: 69px;"><span class="dk_label">Any Time</span></a><div class="dk_options" style="top: 29px;color:white;list-style:none;"><ul style="list-style:none;"><li>Morning <input type="checkbox" id="chk-mor" name="time" value="morning" checked></li><li>Day <input type="checkbox" id="chk-day" name="time" value="day" style="margin-left: 31px;" checked></li><li>Evening <input type="checkbox" id="chk-eve" name="time" value="evening" style="margin-left:4px;" checked></li><li><div id="datepicker" style="width:180px;"></div></li></ul></div></div>
  
    <select id="price" tabindex="4">
  	<option value="allprice" selected="selected">All Prices</option>
 	<option value="0-25" >$0-25</option>
    <option value="25-50" >$25-50</option>
    <option value="50-100" >$50-100</option>
    <option value="100-150" >$100-150</option>
    <option value="150" >$150+</option>
    <option value="free-3" >Free</option>
    </select>
 
 </form>
 </div>
  <div id="searchsubmit" style="top:-5px;"></div>
 <div id="suprise-me" style="top:50px;"></div>
 <div id="qmark" style="background-image: url('/dev/wp-content/themes/images/qmark-normal.png'); height: 18px; width: 18px; position: relative; left: 420px; float: right; bottom: 50px;"></div>

 <div id="linkwrapper" style="width: 765px; height: 40px; background: none repeat scroll 0% 0% rgb(0, 0, 0); position: relative; border-radius: 0px 0px 15px 15px; overflow: hidden; color: rgb(255, 255, 255); float: right; top: 65px; right: 18px;"><span id="links-cat">
 <a id="dinning-link" herf="#">Dinning</a>
 <a id="enter-link" herf="#">Entertainment</a>
 <a id="active-link" herf="#">Active</a>
 <a id="adven-link" herf="#">Adventurous</a>
 <a id="getaway-link" herf="#">Getaways</a>
 <a id="anniver-link" herf="#">Anniversary</a>
 <a id="packg-link" herf="#" style="color:#FF0099">Packages</a>
 </span></div>
 
 
 
 </div>
  <div id="qmark-popup" style="background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);color:white;padding:20px;display:none;width:500px;text-align:left;">
     <strong>Find a date that’s right for you! </strong>
     <p>Your search results will be saved until you change them, so it’s easy to browse multiple date options by only changing one thing, like where you want to go or how much you want to spend. </p>
     <br />
     <br />
     <strong>Surprise Me!</strong>
     <p>This is a great way to find hidden gems and other exciting dates that you may not think of – every time you hit “Surprise Me!” we’ll show you different local date ideas. Have fun!</p>
     <br />
     <br />
     <strong>100% Guarantee</strong>
     <p>We give you all dates that 100% fit your request, but chances are you can’t dine for free at Black & Blue on a Saturday night, so we always recommend dates that you might like, plus a few wildcards because you just never know…!</p>
     <br />
     <br />
     <strong>Still have questions? </strong>
     <p>We’re here for you! Send us an email and we’ll get back to you within one business day. support@ForTwoPlease.com</p>
</div>
 
 <div id="ur-date-ideas" style="margin-bottom:10px;;"><p style="font-size:24px;color:#F07323;">------------------------------     START A SEARCH ABOVE     ------------------------------</p></div>
  <div id="results" style="width:1020px;
	margin-left:auto;
	margin-right:auto;
	background:white;"></div>
  
  <div id="ur-date-ideas2" style="margin-bottom:10px;;"></div>
   <div id="results2" style="width:1020px;
	margin-left:auto;
	margin-right:auto;
	background:white;"></div>
  </div>


 <script type="text/javascript">

	var searchResults = new Array();
	var searchIndex = 15;
	
	$('#type').dropkick();
	$('#location').dropkick();
	$('#price').dropkick();
	


 jQuery(function() {
		jQuery( "#datepicker" ).multiDatesPicker();
	});
 
 jQuery("#testclick").click(function(){
	 var date = jQuery( "#datepicker" ).datepicker('getDate');
	 if(date==null)
	 {
		 alert("please choose a date");
		
	 }
	else{ var dayOfWeek = date.getUTCDay();
	 alert(dayOfWeek);}
 });
  
 jQuery("#searchsubmit").click(function() {
	jQuery("#ur-date-ideas").html("<p style='font-size:24px;color:#777;'>------------------------------     YOUR DATES     ------------------------------</p>");
	//jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
	 var date = jQuery( "#datepicker" ).datepicker('getDate');
	 if(date==null)
	 {
		 alert("please choose a date");
		return false;
	 }
	else{ var day = date.getUTCDay();}
	
	var type = jQuery("#type").val();
	var location = jQuery("#location").val();
	var price = jQuery("#price").val();
	var time = "alltime";
	
	input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day=" + day;
	
	searchDate(input_date);
	

	});
	
	function clearAllSelected(){
		jQuery("#linkwrapper>span>a").each(function(index, element) {
            jQuery(this).removeClass("selected");
        });
	}
	
		
	//****************************************************CATEGORIES*********************************************//
	
	jQuery("#dinning-link").click(function(){
	clearAllSelected();
	jQuery(this).addClass("selected");
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
				if(!sessionStorage){
			  alert("noresults");
		  }
		  
		  var cookies = get_cookies_array();
	
			var cookies = get_cookies_array();
			for(var name in cookies) {
 			if(name == 'f2p-browsing')
			{
		   var iselector = "#"+cookies[name];
			}
}
		  
		  
		//	jQuery("#results").hide();
			for (var i = start; i < end; i++) {
					
					if(sessionStorage.getItem(i)!="undefined" && sessionStorage.getItem(i)){
					input_date = "action=loaddate&dateID="+sessionStorage.getItem(i);
					   jQuery.ajax({
						type: "POST",
						url:  "/dev/wp-admin/admin-ajax.php",
						data: input_date,
						success: function(msg){
						jQuery("#results").append(msg);
						if(iselector){			
		  				 jQuery(iselector).find('.testsearch2').css('display','block');
						}
						
					}
					});	}
					else{
						jQuery("#ur-date-ideas2").html('<p style="font-size:24px;color:#777;clear:both;">------------------------------     WE ALSO SUGGEST     ------------------------------</p>');
						input_date = "action=loaddate&dateID=rand";
					   jQuery.ajax({
						type: "POST",
						url:  "/dev/wp-admin/admin-ajax.php",
						data: input_date,
						success: function(msg){
						jQuery("#results2").append(msg);	
							
					}
					});	}
		
			}
				//jQuery("#results").show();
				searchIndex += end;
				
	}
	//************************************DO A SEARCH*******************************************//
	function searchDate(iData){
		searchIndex = 1;
		jQuery("#results2").html("");
		jQuery("#ur-date-ideas2").html("");
		jQuery("#results").html("<img id='loadImage' src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		jQuery.ajax({
		type: "POST",
		url:  "/dev/wp-admin/admin-ajax.php",
		dataType: 'json',
		data: input_date,
		success: function(msg){	
			jQuery('#loadImage').remove();
        	searchResults = msg; 
			store();	
			loadResults(1,15);
			
			}
		});
	}
	
	function store(){
		if(searchResults)
		{
			sessionStorage.clear();
		for(var i=1;i<searchResults.length+1;i++)
		{
			sessionStorage[i] = searchResults[i];
		}
		}
	}

	jQuery(document).ready(function($) {
		
			jQuery("#dk_container_time").live("mouseenter",function (e) {
	e.preventDefault();
    jQuery(this).addClass("dk_focus dk_open");
	
  }).live("mouseleave",function (e) {
   jQuery(this).removeClass("dk_focus dk_open");
 }
);

		  var cookies = get_cookies_array();
	
			var cookies = get_cookies_array();
			for(var name in cookies) {
 			if(name == 'f2p-type')
			{
		  jQuery("#dk_container_type>a>span").html(cookies[name]);
			}
			if(name == 'f2p-location')
			{
		  jQuery("#dk_container_location>a>span").html(cookies[name]);
			}
			if(name == 'f2p-price')
			{
		  jQuery("#dk_container_price>a>span").html(cookies[name]);
			}
			if(name == 'f2p-time')
			{
		  jQuery("#dk_container_time>a>span").html(cookies[name]);
			}
			}
	
	

	//	jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
	if(sessionStorage.length<1)
	{
   var date = jQuery( "#datepicker" ).datepicker('getDate');
	 if(date==null)
	 {
		 alert("please choose a date");
		return false;
	 }
	else{ var day = date.getUTCDay();}
	var type = jQuery("#type").val();
	var location = jQuery("#location").val();
	var price = jQuery("#price").val();
	var time = "alltime";
	
	input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day=" + day;
	
	searchDate(input_date);
	}
	else{
		loadResults(1,15);
	}

	jQuery(window).scroll(function(){
        if  (jQuery(window).scrollTop() == $(document).height() - $(window).height()){
          loadResults(searchIndex,searchIndex+15);
        }
});

});

	jQuery("#suprise-me").click(function() {
		jQuery("#ur-date-ideas").html("<p style='font-size:24px;color:#CCC;'>------------------------------     YOUR DATES     ------------------------------</p>");
		//jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
		
   var date = jQuery( "#datepicker" ).datepicker('getDate');
	 if(date==null)
	 {
		 alert("please choose a date");
		return false;
	 }
	else{ var day = date.getUTCDay();}
	
	var type = jQuery("#type").val();
	var location = jQuery("#location").val();
	var price = jQuery("#price").val();
	var time = "alltime";
	
	input_date = "action=searchdates&datetype="+type+"&location="+location+"&price="+price+"&time="+time+"&day=" + day;
	
	
	searchDate(input_date);
	

});
//***********************TEXT SEARCH BOX*******************
jQuery("#text-search").click(function(){
	//jQuery("#results").html("<img src='/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif' />");
	jQuery("#ur-date-ideas").html("<p style='font-size:24px;color:#CCC;'>------------------------------     YOUR DATES     ------------------------------</p>");
	searchIndex = 1;
	jQuery("#results").html("");
	input_data = "action=searchbykeyword&key="+jQuery("#input-text-search").val();
	jQuery.ajax({
	type: "POST",
	url:  "/dev/wp-admin/admin-ajax.php",
	data: input_data,
	dataType: 'json',
	success: function(msg){
		searchResults = msg; 
		store();	
		loadResults(1,15);
	}
	});
	});
	
	jQuery("#text-form").submit(function(e){
	e.preventDefault();
	jQuery("#ur-date-ideas").html("<p style='font-size:24px;color:#CCC;'>------------------------------     YOUR DATES     ------------------------------</p>");
	searchIndex = 1;
	jQuery("#results").html("");
	input_data = "action=searchbykeyword&key="+jQuery("#input-text-search").val();
	jQuery.ajax({
	type: "POST",
	url:  "/dev/wp-admin/admin-ajax.php",
	data: input_data,
	dataType: 'json',
	success: function(msg){
		searchResults = msg; 
		store();	
		loadResults(1,15);
	}
	});
	});
	
function get_cookies_array() {
 
    var cookies = { };
	 
	    if (document.cookie && document.cookie != '') {
        var split = document.cookie.split(';');
	        for (var i = 0; i < split.length; i++) {
	            var name_value = split[i].split("=");
            name_value[0] = name_value[0].replace(/^ /, '');
            cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
        }    }
 
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
	
	if(morChk&&dayChk&&eveChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Any Time");
	}
	else if(morChk&&dayChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning, Day");
	}
	else if(morChk&&eveChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning, Evening");
	}
	else if(dayChk&&eveChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Day, Evening");
	}
	
	else if(morChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Morning");
	}
	
	else if(dayChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Day");
	}
	else if(eveChk){ 
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Evening");
	}
	else{
		jQuery("div#dk_container_time>a.dk_toggle>span.dk_label").html("Please Select");
	}
	
	
		
	}
	
	
	</script>
 

<?php get_footer(); ?>