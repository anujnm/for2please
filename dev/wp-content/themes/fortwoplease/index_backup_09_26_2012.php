<?php get_header(); ?>

<script type="text/javascript">
<?php if ( !is_user_logged_in() ) { ?>
if (document.referrer == "" || document.referrer.indexOf("fortwoplease") < 0) {
	window.location.assign('/dev/subscribe');
}
<?php } ?>

</script>

<link rel="stylesheet" type="text/css" href="/dev/wp-content/themes/fortwoplease/index.css" />
<script src="/dev/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8"></script>


<div class="date_content">
	<div class="search_box">

	<div class="filter_box">
		<h2 class="what_title">WHAT</h2>
		<h2 class="where_title">WHERE</h2>
		<h2 class="when_title">WHEN</h2>
		<h2 class="how_much_title">HOW MUCH</h2>
	</div>
	
	<div class="search_form">
		<form id="text-form" style="position: relative;">
			<input id="input-text-search" type="text" class="search_field" />
			<img id="text-search" src="/dev/wp-content/themes/images/search-mag.png" />
		 </form>
	</div>

	<div id="preload" class="preload_images">
		<img src="/dev/wp-content/themes/images/go-button.png" width="1" height="1" alt="Image 01" />
		<img src="/dev/wp-content/themes/images/go-hover.png" width="1" height="1" alt="Image 02" />
		<img src="/dev/wp-content/themes/images/go-press.png" width="1" height="1" alt="Image 03" />
		<img src="/dev/wp-content/themes/images/suprise-button.png" width="1" height="1" alt="Image 04" />
		<img src="/dev/wp-content/themes/images/suprise-hover.png" width="1" height="1" alt="Image 05" />
		<img src="/dev/wp-content/themes/images/suprise-press.png" width="1" height="1" alt="Image 06" />
	</div>

	<div class="search_filters">
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

			<div tabindex="3" id="dk_container_time" class="dk_container dk_theme_default" style="display: block;">
				<a class="dk_toggle" style="width: 69px;">
					<span class="dk_label">Any Time</span>
				</a>
				<div class="dk_options" style="top: 29px;color:white;list-style:none;">
					<ul style="list-style:none;">
						<li>Morning <input type="checkbox" id="chk-mor" name="time" value="morning" checked></li>
						<li>Day <input type="checkbox" id="chk-day" name="time" value="day" style="margin-left: 31px;" checked></li>
						<li>Evening <input type="checkbox" id="chk-eve" name="time" value="evening" style="margin-left:4px;" checked></li>
						<li>
						<div id="datepicker" style="width:180px;"></div>
						</li>
					</ul>
				</div>
			</div>
  
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

	<div id="linkwrapper" class="categories">
		<span id="links-cat">
			<a id="dinning-link" herf="#">Dinning</a>
			<a id="enter-link" herf="#">Entertainment</a>
			<a id="active-link" herf="#">Active</a>
			<a id="adven-link" herf="#">Adventurous</a>
			<a id="getaway-link" herf="#">Getaways</a>
			<a id="anniver-link" herf="#">Anniversary</a>
			<a id="packg-link" herf="#" class="packages">Packages</a>
		</span>
	</div>

	</div>
	<div id="qmark-popup" class="question_popup">
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
 
	<div id="ur-date-ideas" class="date_ideas">
		<p class="date_search_title">------------------------------ SEARCH LOCAL DATE IDEAS ABOVE ------------------------------</p>
	</div>
	<div id="results" class="date_results"></div>
  	
  	<div id="ur-date-ideas2" class="date_ideas"></div>
  	<div id="results2" class="date_results"></div>
</div>

<script src="/dev/js/f2p-main.js" type="text/javascript" charset="utf-8"></script>
<?php get_footer(); ?>