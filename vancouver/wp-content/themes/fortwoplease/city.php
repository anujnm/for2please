<?php
/*
Template Name: city
*/

?>
<head>
<title>ForTwoPlease | Join</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
body { margin: 0; font-family: 'Ubuntu'; }

div.center_box { position:relative; width: 514px; height: 448px; background: url('/date-ideas/wp-content/themes/images/sign_in_box.png') no-repeat top left; color: white; text-align: center;}
div.center_box p { margin: 0; font-size: 122%; }
div.center_box div.top { padding: 35px 20px 0 20px; text-align: center; }
div.center_box div.top h1 { color: #f4782c !important;  padding: 0; font-size: 222%; }
div.center_box div.top p { margin-top: 12px; font-size: 133%; }
div.center_box div.inputs { position: relative; top: 34px; margin: 0 auto; width: 514px; }
div.center_box div.inputs p { padding: 6px 0; }
div.center_box form { margin-top: 10px; }
div.center_box form input.text { width: 280px; margin: 0; font-size: 18px; text-align: center; }
div.center_box form input.f2p-button { margin: 4px 0; }
div.center_box div.fb_connect { }
div.center_box div.bottom { position:absolute; top: 340px; margin: 0 auto; display:block; width: 514px; }
div.center_box div.bottom p { color: #2895d8; font-size: 20px; }
div.center_box div.bottom p label { color: white; }
div.center_box select {margin-bottom: 10px;}
div.center_box .inputs p {width: 80%; margin-left: 52px;}
</style>

<script type="text/javascript">
    if (typeof(jQuery) === 'undefined') {
        document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'>\<\/script>");
    }
</script>

<script src="<?php bloginfo('stylesheet_directory'); ?>/facebook_login.js" type="text/javascript"></script>

<script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22573395-1']);
  _gaq.push(['_setDomainName', 'fortwoplease.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/
</script>
</head>

<?php $randVal = rand(); ?>

<div class="center_box" id="join_block">
    <div class="top">
        <h1>Not from Vancouver?</h1>
    </div>

    <div class="inputs">
        <p style='width:80%; text-align: center; margin-left:52px; margin-right:51px;'>Tell us where you're from and we'll update you when we launch there!</p>
        <form id="email_subscription_form" action="" method="post">
            <select name="location">
                <option value="Victoria">Victoria</option>
                <option value="Seattle">Seattle</option>
                <option value="New York City">New York City</option>
                <option value="San Francisco">San Francisco</option>
                <option value="Los Angeles">Los Angeles</option>
                <option value="Toronto">Toronto</option>
                <option value="Calgary">Calgary</option>
                <option value="Montreal">Montreal</option>
                <option value="Chicago">Chicago</option>
                <option value="San Diego">San Diego</option>
                <option value="Portland">Portland</option>
                <option value="Denver">Denver</option>
                <option value="Houston">Houston</option>
                <option value="Austin">Austin</option>
                <option value="Philadelphia">Philadelphia</option>
                <option value="Phoenix">Phoenix</option>
                <option value="San Antonio">San Antonio</option>
                <option value="Dallas">Dallas</option>
                <option value="San Jose">San Jose</option>
                <option value="Ottawa">Ottawa</option>
                <option value="Jacksonville">Jacksonville</option>
                <option value="Indianapolis">Indianapolis</option>
                <option value="Edmonton">Edmonton</option>
                <option value="Fort Worth">Fort Worth</option>
                <option value="Charlotte">Charlotte</option>
                <option value="Las Vegas">Las Vegas</option>
                <option value="Halifax">Halifax</option>
                <option value="Quebec">Quebec</option>
                <option value="Kitchener-Cambridge-Waterloo">Kitchener-Cambridge-Waterloo</option>
                <option value="Saskatoon">Saskatoon</option>
                <option value="Regina">Regina</option>
                <option value="Winnipeg">Winnipeg</option>
                <option value="Nashville">Nashville</option>
                <option value="Atlanta">Atlanta</option>
                <option value="Miami">Miami</option>
                <option value="Other">Other</option>
            </select>
            <p>
                <input type="text" id='email' name="email" value="Email" class="text" onblur="onBlur(this);" onfocus="onFocus(this);" />
            </p>
            <p class="lightboxMessage hide"></p>
            <p>
                <input type="submit" id="submit-email" name="submit" value="SIGN UP" class="f2p-button" />
            </p>
        </form>
        <br/>
    </div>

    <div class="bottom">
        <p><label>Wait, you're from Vancouver after all?</label> <a href="#" id="login_link" style="font-weight: bold;">Login here</a></p>
    </div>
</div>

<script type="text/javascript">
    jQuery('#login_link').click(function() {
        jQuery("#join_block").load("/date-ideas/login", function() {
            // Don't need Google Analytics on Dev
            //window.setTimeout("GoogleTracking('/dev/login/');", 100);
        });
    });

    function onBlur(el) {
        if (el.value == '') {
            el.value = el.defaultValue;
        }
    }
    function onFocus(el) {
        if (el.value == el.defaultValue) {
            el.value = '';
        }
    }

    jQuery('#password-clear<?php echo $randVal ?>').focus(function() {
        jQuery('#password-clear<?php echo $randVal ?>').hide();
        jQuery('#password-password<?php echo $randVal ?>').show();
        jQuery('#password-password<?php echo $randVal ?>').focus();
    });

    jQuery('#password-password<?php echo $randVal ?>').blur(function() {
        if(jQuery('#password-password<?php echo $randVal ?>').val() == '') {
            jQuery('#password-clear<?php echo $randVal ?>').show();
            jQuery('#password-password<?php echo $randVal ?>').hide();
        }
    });

    function verifyEmail(email){
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
         if (email.search(emailRegEx) == -1) {
              $('.lightboxMessage').html("Please enter a valid email address.").show();
         } else {
              status = true;
         }
         return status;
    }

    jQuery("#submit-email").click(function() {
        $('.lightboxMessage').hide();
        if (verifyEmail(jQuery('#email').val())) {
            var input_data = jQuery('#email_subscription_form').serialize();
            jQuery.ajax({
                type: "POST",
                url:  "/date-ideas/wp-admin/admin-ajax.php",
                data: "action=location_subscribe&" + input_data,
                success: function(msg) {
                    if(msg == 'Success') {
                        if (window.location.pathname.indexOf('subscribe') > 0) {
                            mixpanel.track('Successful Non-Vancouver Sign Up', { 'url': 'Subscribe' }, function() {
                                $('.lightboxMessage').html('Thanks for signing up! We\'ll be sure to notify you first when we launch in your city!').show();
                                setTimeout("location.assign('<?php echo home_url(); ?>');", 5000);
                            });
                        } else {
                            mixpanel.track('Successful Non-Vancouver Sign Up', { 'url': 'Lightbox' }, function() {
                                $('.lightboxMessage').html('Thanks for signing up! We\'ll be sure to notify you first when we launch in your city!').show();
                                setTimeout("location.reload(true);", 5000);
                            });
                        }
                    } else {
                        $('.lightboxMessage').html(msg).show();
                    };
                }
            });
        }
        return false;
    });
</script>
