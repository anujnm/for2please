<?php
/*
Template Name: account
*/
 get_header();
 
if(is_user_logged_in())
{

    
	?>
	
	<p> Welcome <?php wp_get_current_user();  echo $current_user->user_login . "</p>" . "<p>Your unique account number is:" . $current_user->ID . "</p>" ; if ( !empty( $current_user->roles ) && is_array( $current_user->roles ) ) {
    foreach ( $current_user->roles as $role )
        echo $role;
} ?> </p>
	
	
	<p> Items Purchased </p>
	<?php  
	foreach (get_user_meta(wp_get_current_user(), 'purchased',false) as $values){
	echo $values;
	echo '<br/>';
	}?>
	
	<?php
}

else{
?>

<div>You must be logged in </div>

<?php
  }
 
 get_footer(); 


?>