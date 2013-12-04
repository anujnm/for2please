<?php
/*
Template Name: account
*/
 get_header();
 
  wp_get_current_user();
  
 
if(is_user_logged_in())
{ 
if($current_user->roles[0] == 'merchant')  //is merchant
  {
  ?>
  <div id="header-content" style="background:#FFF;color:black;overflow:hidden;">
  <div id="left-hand" style="float:left;width:640px;padding:20px;">
  <?php foreach (get_user_meta($current_user->ID, 'pckg',false) as $values){
	echo "<div style='margin-top:20px;text-decoration:underline;'>";
	echo "DATE PACKAGE: <b> ";
	echo "</div>";
	the_field('sub_title',$values);
	echo '</b><br/>';
	echo "Number Sold:<b> ";
	$count = 0;
		foreach (get_user_meta($current_user->ID, $values ,false) as $numbers){
			$count++;
		}
	echo $count;
	echo "</b><br/>";
	?>
   <h2>Purchased Date Packages </h2>
   <p>Tick the box of each Date Package below when it gets redeemed.</p>
	<table border="1">
	<?php
	if(get_user_meta($current_user->ID, $values ,false))
	{
	foreach (get_user_meta($current_user->ID, $values ,false) as $numbers){
			foreach (get_user_meta($current_user->ID, $numbers ,false) as $nums){
			$done = get_user_meta($current_user->ID, $numbers.'_d');
			if($done[0]=='notdone'){
				$user_info = get_userdata($nums);
				echo '<tr>';
				echo '<td><input type="checkbox" class="checkbox" name="redeemed" value="';
				echo $numbers.'_d';
				echo '" /></td>';
				echo '<td>Username: ' . $user_info->user_login . "</td>";
				echo '<td>Last Name: ' . $user_info->last_name . "</td>";
				echo '<td>First Name: ' . $user_info->first_name . "</td>";
				echo '<td>ID: ' . $nums . "</td>";
				echo '</tr>';
				
			}	
			
			}
			
		}
	}
	else{
		echo '<p style="color:red;">No Purchases</p>';
	}
  if(get_user_meta($current_user->ID, $values ,false))
	{
  ?>
  
  </table>
    <h2>Redeemed Date Packages </h2>
	
 <table border="1">
	<?php
	$flag=0;
	foreach (get_user_meta($current_user->ID, $values ,false) as $numbers){
		
			foreach (get_user_meta($current_user->ID, $numbers ,false) as $nums){
				
			$done = get_user_meta($current_user->ID, $numbers.'_d');
			if($done[0]=='done'){
				$user_info = get_userdata($nums);
				echo '<tr>';
				echo '<td><input type="checkbox" class="checkbox" name="redeemed" value="';
				echo $numbers.'_d';
				echo '" checked></td>';
				echo '<td>Username: ' . $user_info->user_login . "</td>";
				echo '<td>Last Name: ' . $user_info->last_name . "</td>";
				echo '<td>First Name: ' . $user_info->first_name . "</td>";
				echo '<td>ID: ' . $nums . "</td>";
				echo '</tr>';
			}	elseif($flag==0) {
				echo '<p style="color:red;">Nothing Redeemed</p>';
				$flag=1;}
				
			}
		}
	
  }
  
  }
  ?>
  
  </table>
  
  </div>
  <div id="right-hand" style="float:right;width:300px;padding:20px;">
  
  	Welcome <?php  echo $current_user->user_login ?>
	
	<h2>My Account</h2>
	<div id="account-info" style="border:1px solid #000;padding:5px">
	<p>Your unique ForTwoPlease ID is: <b><?php echo $current_user->ID ?></b> </p>
	<p>Email: <?php echo $current_user->user_email ?> </p>
	<form id="changepass" action="#" style="background:#222;color:white;;padding:5px;border-radius:10px;">
	<p>Reset Password</p>
	<p><label for="opass">Old Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:35px;" name="opass" /></p>
	<p><label for="npass">New Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:30px;" name="npass" /></p>
	<p><label for="npassc">Confirm Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:5px;" name="npassc" /></p>
	<p class="submit" style="margin-left:175px" ><input id="changepassword" type="submit" value="Submit" class="f2p-button" style="font-size:18px;padding:10px;marign-left;"/></p>
	</form>
	</div>
	
  </div>
  </div>
  

  
  <?php   //USER ACCOUT PAGE
  }else {

?>


<div id="header-content" style="background:#FFF;color:black;overflow:hidden;padding:20px;">
	
	<div id="right-account-side" style="float:right;width:300px;">
	
	Welcome <?php  echo $current_user->user_login ?>
	
	<h2>My Account</h2>
	<div id="account-info" style="border:1px solid #000;padding:5px">
	<p>Your unique ForTwoPlease ID is: <b><?php echo $current_user->ID ?></b> </p>
	<p>Email: <?php echo $current_user->user_email ?> </p>
	<form id="changepass" action="#" style="background:#222;color:white;;padding:5px;border-radius:10px;">
	<p>Reset Password</p>
	<p><label for="opass">Old Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:35px;" name="opass" /></p>
	<p><label for="npass">New Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:30px;" name="npass" /></p>
	<p><label for="npassc">Confirm Password</label> <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;margin-left:5px;" name="npassc" /></p>
	<p class="submit" style="margin-left:175px" ><input id="changepassword" type="submit" value="Submit" class="f2p-button" style="font-size:18px;padding:10px;marign-left;"/></p>
	</form>
	</div>
	</div>
	
	<div style="float:left;" id="date-holder">
	<h2 style="margin-top:0px;"> My Date Packages </h2>
	<?php  

	if (get_user_meta($current_user->ID, 'purchased',false))
	{
	foreach (get_user_meta($current_user->ID, 'purchased',false) as $values){
	$pid = get_user_meta($current_user->ID, $values.'_id');
	$done = get_user_meta($current_user->ID, $values.'_stat');
	$merchantuname = get_field('merchant_username',$pid[0]);
	$merchantuname = intval($merchantuname);
	$doneMerch = get_user_meta($merchantuname, $values.'_d');
		if($done[0] == 'notdone' && $doneMerch[0] == 'notdone') {
		?>
		<div style="float:left;clear:both;width:700px;margin-bottom:20px;">
		<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
		<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
		<div style="height:30px;"><input type="checkbox" class="checkbox" name="redeemed" value="<?php echo $values.'_stat';?>" />I've gone on this date! <br/></div>
		<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
		<div style="font-weight:700;"><?php echo the_field('sub_title',$pid[0]); ?> </div>
		<div style="margin:none;">Expires: <?php echo the_field('end_date',$pid[0]); ?> </div>
		<div style="font-style:italic;margin-top:5px;font-size:12px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
		</div>
		</div>
	<?php }
	}}else{echo "You do not currently have any active date packages";} ?>
	
	<?php  

	if (get_user_meta($current_user->ID, 'purchased',false))
	{?>
	
	<h2 style="clear:both;"> Date Packages I've Used </h2>
	<?php  
	foreach (get_user_meta($current_user->ID, 'purchased',false) as $values){
	$pid = get_user_meta($current_user->ID, $values.'_id');
	$done = get_user_meta($current_user->ID, $values.'_stat');
	$merchantuname = get_field('merchant_username',$pid[0]);
	$merchantuname = intval($merchantuname);
	$doneMerch = get_user_meta($merchantuname, $values.'_d');
	
		if($done[0] == 'done' && $doneMerch[0] == 'notdone') {
		?>
		<div style="float:left;clear:both;width:700px;margin-bottom:20px;">
		<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
		<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
		<div style="height:30px;"><input type="checkbox" class="checkbox" name="redeemed" value="<?php echo $values.'_stat';?>" checked>I've gone on this date! <br/></div>
		<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
		<div style="font-weight:700;"><?php echo the_field('sub_title',$pid[0]); ?> </div>
		<div style="margin:none;">Expires: <?php echo the_field('end_date',$pid[0]); ?> </div>
		<div style="font-style:italic;margin-top:5px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
		</div>
		</div>
		
	<?php } elseif($doneMerch[0] == 'done') {?>
	<div style="float:left;clear:both;width:700px;margin-bottom:20px;">
		<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
		<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
		<div style="height:30px;"><b>Redeemed by merchant.</b></div>
		<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
		<div style="font-weight:700;"><?php echo the_field('sub_title',$pid[0]); ?> </div>
		<div style="margin:none;">Expires: <?php echo the_field('end_date',$pid[0]); ?> </div>
		<div style="font-style:italic;margin-top:5px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
		</div>
		</div>
	
	
	<?php }
	}}?>
</div>
</div>
	<?php
}}
else{
?>
<div>You must be logged in </div>
<?php
  }
 get_footer(); 
?>

<script type="text/javascript">
jQuery(document).ready(function(jQuery) {
  jQuery("input:checkbox").change(function(){
    var uval = jQuery(this).val();
	if(jQuery(this).attr('checked') == 'checked'){
	var checked = 'checked';}
	else{
	var checked = 'notchecked';}
  	jQuery.ajax({
	type: "POST",
	url:  "/dev/wp-admin/admin-ajax.php",
	data: "action=donedate&uniqueval="+uval+"&checked="+checked,
	success: function(msg){
	
		setTimeout("location.reload(true);");
	}
	});
});


jQuery("#changepassword").click(function() {
	
	var input_data = jQuery('#changepass').serialize();
	jQuery.ajax({
	type: "POST",
	url:  "/dev/wp-admin/admin-ajax.php",
	data: "action=passchange&" + input_data,
	success: function(msg){
		alert(msg);
		setTimeout("location.reload(true);");
	}
	});
	return false;
	
	});
	
});




</script>


