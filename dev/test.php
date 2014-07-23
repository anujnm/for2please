<?php 

require( dirname(__FILE__) . '/wp-load.php' );

$creds = array();
$creds['user_login'] = $_POST["username"];
$creds['user_password'] = $_POST["password"];
$creds['remember'] = true;


$user = wp_signon( $creds, false );
if ( is_wp_error($user) )
   echo $user->get_error_message();


?> 