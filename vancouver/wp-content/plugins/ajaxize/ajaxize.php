<?php
/*
    Plugin Name: Ajaxize
    Plugin URI: http://blog.gingerlime.com/ajaxizing
    Description: Ajaxize your plugins
    Author: Yoav Aner
    Version: 1.3.1
    Requires at least: 3.1
    Tested up to: 3.2.1
    Author URI: http://blog.gingerlime.com
    License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html

    Ajaxize will allow you to ajaxize almost any php function on your site.
    It can be a plugin, a function you wrote, or even a core wordpress function.

    == Description ==

    [Ajaxize](http://blog.gingerlime.com/ajaxize/ "WordPress plugin that allows you to ajaxize almost any php function on your site") will allow you to ajaxize almost any php function on your site.
    It can be a plugin, a function you wrote, or even a core wordpress function.

    1.3 : Updated to work within 404 templates (thanks to ovidiubica for reporting)

    1.2 : Small security improvements (added nonce to the javascript) and tested with Wordpress 3.2.1

    New in 1.1: Context Awareness. Ajaxize is now setting the correct context for functions automatically. Special thanks to [One Trick Pony](http://digitalnature.eu/) for helping set the hook in the right place.

    == Installation ==

    Automatic install:

    Using the WordPress dashboard

    * Login to your weblog
    * Go to Plugins
    * Select Add New
    * Search for ajaxize
    * Select Install
    * Select Install Now
    * Select Activate Plugin

    Manual:

    * Upload "ajaxize" folder to the "/wp-content/plugins/" directory.
    * Activate the plugin through the "Plugins" menu in WordPress.
    * Further information is available on the Settings->Ajaxize menu

    == Frequently Asked Questions ==

    = How does ajaxize work? =

    To ajaxize your plugin or function, the only thing you need is the function name.
    Go to Settings->ajaxize and enter your function name. Then click 'Generate DIV'.

    If all is working fine you should get a div that you can add to any page, post or template. 
    You should also see the output of the generated div below.

    = How do I find the correct function name? =
    Many plugins come with shortcodes or function names that can be entered directly into the template. 
    It is usually within the plugin documentation. Search the documentation for information how to use the plugin in your templates. Otherwise, you can try the plugin editor (Plugins->Editor), select your plugin and then search for the function name inside the php code.

    = Are there any limitations to which functions I can use? =
    Yes.
    1. Functions must return valid HTML - this will be called in php and returned via the Ajax call
    2. Functions cannot accept any parameters (at least at the moment)

    = How can I test if ajaxize is working? = 
    Try 'ajaxize_this_test' (without the quotes) and click Generate DIV to test it.

    = What is the Secret Key? Do I need to change it? =
    The secret key is there to allow you to ajaxize any function you want, but only the functions you want and not others. The secret key is used to create a 'signature' on the div you generate. This signature is generated using HMAC, and the Secret Key is the key used by HMAC.

    A few notes about the secret key:
    1. A random Secret Key is automatically generated when the plugin is first installed.
    2. You can change your secret key, but please be aware that any previously-generated divs will stop working.
    3. Do not post or share this key! Please only change it if you know what you're doing.

    = Can I add stuff or modify the div? =
    This is a normal div. The only part that you cannot change is the id section. Even the smallest change to the id will invalidate the signature, and it will stop working.
    Therefore, if you have a new function you also want to ajaxize - you'd have to use the ajaxize generator. Don't just replace the function name, because the signature will not be valid for any other function.

    = What is this good for? =
    ajaxize is most suitable when you are using a caching solution (W3 Total Cache, WP Super Cache etc). With ajaxize you can keep the page cached, but still pull content dynamically. Best used for quotes, feedbacks, statistics etc, but can work on almost any type of output.

    It might also be useful to speed up page loads with plugins like Facebook and Twitter buttons (which often take some time to load if embedded directly).

    It won't make you rich in 21 days nor will it make your pencil longer.

    = Can I automatically refresh the div every X seconds? =
    Yes, but currently you'd have to write your own javascript for it. 
    Here is a small example using jQuery (replace with your own div id):

        <script>
        var refreshId = setInterval(function() {

            var $data = $('div[id*="ajaxize_this:REPLACE_THIS"]');
            $data.each( function() {
                $data.fadeOut(2000, function() {
                    var newquery = $.query.set('ajaxize_this', $data.attr('id')).set('_wpnonce', ajaxizeParams._wpnonce);
                    $data.load(location.pathname + newquery, function() {
                        $data.fadeIn(2000);
                    });
                });
            });

            return false;
        }, 10000); 
        </script>

    = I'm getting an error after generating a DIV "ajaxize: Error executing <some name>. Is this function correct?" What's wrong? =
    Check that the function name is correct, do not include brackets. Use: *some_function* instead of *some_function()*.
    Make sure the function does not require any parameters either.

    = I generate a DIV but the Function output is empty. Why? =
    Some plugins/functions produce iframes and other content that might only get displayed in the right context.
    In general, if there's an error, you would get an error message on the settings page. Try to copy the div into a post instead. It might still work.

    == Changelog ==    
    = 1.3 =
    Updated to work within 404 templates (thanks to ovidiubica for reporting)

    = 1.2.1 = 
    Small change to documentation only.

    = 1.2 =
    Small security improvements (added nonce to the javascript) and tested with Wordpress 3.2.1

    = 1.1 =
    Context information is much better handled in ajaxize. Special thanks to One Trick Pony.

    = 1.0.2 =
    Code tidy-up. No functionality changes

    = 1.0.1 =
    quickfix for an all-encompasing hook that breaks lots of other wordpress functionality.

    = 1.0 =
    * First release
 */
define( 'PLUGIN_DIR', dirname(__FILE__).'/' );  
require_once(PLUGIN_DIR . '/ajaxize_admin.php');

add_action('admin_init', 'ajaxize_request_handler'); // loading on admin pages
add_action('template_redirect', 'ajaxize_request_handler'); // loading on user-facing pages
add_action('wp_print_scripts', 'ajaxize_this_javascript');

function ajaxize_this_javascript () {
    $params = array ( '_wpnonce' => wp_create_nonce('ajaxize_this_nonce'), 'is_404' => is_404() );
    wp_enqueue_script ( "ajaxize_this", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/ajaxize_this.js"), array( 'jquery', 'jquery-query' ) );
    wp_localize_script ('ajaxize_this', 'ajaxizeParams', $params);

}

function ajaxize_this_execute_function($request_str) {
    // Executing the function (if request is authenticated)
    if (! ajaxize_this_authenticate_request($request_str) ) {
        exit();	
    }
    list($prefix, $func_name, $signature) = split(':', $request_str, 3);
    if (function_exists($func_name)) {
        return call_user_func($func_name);
    }
    return "ajaxize: Error executing " . $func_name . ". Is this function correct?<br/> Request: " . $request_str;
}

function ajaxize_request_handler() {
    if ( isset($_REQUEST['ajaxize_this']) ) {
        check_ajax_referer('ajaxize_this_nonce', '_wpnonce');
        $req = $_REQUEST['ajaxize_this'];
        echo ajaxize_this_execute_function($req);
        exit();
    }
}

function ajaxize_this_authenticate_request($request_str) {
/*
This function authenticates the request. 
The request would be split into three parts:
1. prefix - 'ajaxize_this'
2. The function name - this is the php function to be called
3. The hashed (HMAC) signature of the function name (with the secret key)
e.g. request_str = "my_function:x6b93kd93ljqkdjslkjdpq"

Only if the signature matches the function name the request is authenticated.

This would allow exposing only certain functions via ajax, whilst not allowing anybody 
to 'guess' a valid signature for any other function.
 */

    list($prefix, $func_name, $signature) = split(':', $request_str, 3);
    if (ajaxize_this_hmac($func_name) == $signature) {
        return true;
    }
    return false;

}

function ajaxize_this_hmac($text) {
    // returns a hmac of the string using the secret key option
    $options = get_option('ajaxize_this_options');
    return hash_hmac('sha1', $text, $options['secret_key']);
}

function ajaxize_test() {
    $output = <<<EOD
<div>
<h1>Ajaxize: test function</h1>
<h2>If you see this message then ajaxize is working!</h2>
</div>
EOD;
    return $output;
}

?>
