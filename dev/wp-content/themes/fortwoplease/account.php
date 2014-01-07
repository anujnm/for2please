<style type="text/css">
table.merchant { border-collapse: collapse; font-size: 14px; color: #535090; }
table.merchant tr { background-color: #e3e8ff; height: 30px; border-bottom: 1px solid #fff;}
table.merchant tr:hover { background-color: #c6d0fc; color: #2727b5; }
table.merchant tr.header { background-color: #3395df; /*#abbbfd;*/ }
table.merchant td { padding:2px; }
table.merchant th { width: 260px; text-align:left; color:#fff; font-size: 16px; font-weight:normal; }
table.merchant th.f2p_id { text-align: center; padding-right: 10px; }
table.merchant td.f2p_id { text-align: center; padding-right: 10px; }

p { padding-bottom: 4px; }
label.pass_label { float: left; line-height: 20px; height: 20px; margin-bottom:5px; text-align: right; width:120px; }
input.pass { background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px; width:140px; float: right; }

div.separation_line { border-bottom: 1px solid #3395df; margin: 20px 0 6px 0; clear:both; }

</style>


<?php
/*
Template Name: account
*/
 get_header();
 
  wp_get_current_user();
  
$total_packages_sold = 0;
$total_sales_amount = 0.00;
$total_packages_available =0;

if(is_user_logged_in())
{ 
?>
	<div id="header-content" style="background:#FFF;color:black;overflow:hidden; border-bottom: 30px solid black; min-height:600px; width: 1060px; box-shadow: 1px 40px 30px 4px #333;">
		<?php
		if($current_user->roles[0] == 'merchant')  //is merchant
		{
		?>
			<div id="left-hand" style="float:left;width:640px;padding:20px;">
				<?php 
				echo "<h1 style='margin:10px 0; color:#1596d0;'>MY DATE PACKAGES</h1>";
				foreach (get_user_meta($current_user->ID, 'pckg',false) as $values) {
					echo "<div class='separation_line'></div>";
					echo "<b style='font-size:155%;'>";
					the_field('sub_title',$values);
					echo '</b><br/>';
					echo "Number Sold:<b> ";
					$count = 0;
					foreach (get_user_meta($current_user->ID, $values ,false) as $numbers) {
						$count++;
					}
					$total_packages_available ++;
					echo $count;
					$package_price = get_field('price',$values);
					echo "</b><br/>Current Price:<b> ".money_format('$%i', $package_price);
					$total_packages_sold += $count;
					echo "</b><br/>";
				?>
					<br/>
					<p style="font-size: 18px; font-weight:bold;">Purchased Date Packages </p>
					<p>Below are the Date Packages that have been purchased by a ForTwoPlease member at your business.</p><br/>
					<p>Tick the box of each Date Package below when it gets redeemed.</p>
					<p>You will be paid for each Date Package that is redeemed at your business on a monthly basis.</p>
					<table class="merchant" border="0">
						<tr class="header"><th>First Name</th><th>Last Name</th><th>Purchase Date</th><th class="f2p_id">Voucher ID</th><th>Mark As Redeemed</th></tr>
						<?php
						if(get_user_meta($current_user->ID, $values ,false)) {
							foreach (get_user_meta($current_user->ID, $values ,false) as $index=>$numbers) {
								foreach (get_user_meta($current_user->ID, $numbers ,false) as $nums) {
									$done = get_user_meta($current_user->ID, $numbers.'_d');
									if($done[0]=='notdone'){
										$user_info = get_userdata($nums);
										echo '<tr>';
										//echo '<td><input type="checkbox" class="checkbox" name="redeemed" value="';
										//echo $numbers.'_d';
										//echo '" /></td>';
										// echo '<td>Username: ' . $user_info->user_login . "</td>";$first_name = get_user_meta($user_info->ID, $numbers.'_for_fname');
										$first_name = get_user_meta($user_info->ID, $numbers.'_for_fname');
										$last_name = get_user_meta($user_info->ID, $numbers.'_for_lname');
										if ($first_name != null && $last_name != null) {
											echo '<td>' . $first_name[0] . "</td>";
											echo '<td>' . $last_name[0] . "</td>";
										} else {
											echo '<td>' . $user_info->first_name . "</td>";
											echo '<td>' . $user_info->last_name . "</td>";
										}
										$purchased_date = get_user_meta($user_info->ID, $numbers.'_time');
										echo '<td>'.$purchased_date[0].'</td>';
										echo '<td class="f2p_id">' . $numbers . "</td>";
										echo '<td><input id="'.$numbers.'_d" type="button" value="Redeem" class="f2p-button-redeemed"/></td>';
										echo '</tr>';
										
										$item_price = get_user_meta($user_info->ID, $numbers.'_amount');
										if ($item_price!= null && $item_price[0] && $item_price[0]!=null) {
											$total_sales_amount += $item_price[0];
										}
									}
								}
							}
						} else {
							echo '<p style="color:red;">No Purchases</p>';
						}
						?>
					</table>
					<p style="font-size: 18px; font-weight:bold; margin-top:40px;">Redeemed Date Packages </p>
					<p>Below are the Date Packages that have been redeemed by a ForTwoPlease member at your business.</p><br/>
						<?php
						//$table_content = '<table class="merchant" border="0"><tr class="header"><td style="width:20px;"></td><th>First Name</th><th>Last Name</th><th class="f2p_id">Voucher ID</th></tr>';
						$table_content = '<table class="merchant" border="0"><tr class="header"><th>First Name</th><th>Last Name</th><th>Purchase Date</th><th class="f2p_id">Voucher ID</th><th>Mark as UnRedeemed</th></tr>';
						if($what = get_user_meta($current_user->ID, $values ,false)) {
							$has_data = false;
							// $flag=0;
							foreach (get_user_meta($current_user->ID, $values ,false) as $numbers) {
								foreach (get_user_meta($current_user->ID, $numbers ,false) as $nums) {
									$done = get_user_meta($current_user->ID, $numbers.'_d');;
									if($done[0]=='done') {
										$user_info = get_userdata($nums);
										$table_content .= '<tr>';
										//$table_content .= '<td><input type="checkbox" class="checkbox" name="redeemed" value="';
										//$table_content .= $numbers.'_d';
										//$table_content .= '" checked></td>';
										$first_name = get_user_meta($user_info->ID, $numbers.'_for_fname');
										$last_name = get_user_meta($user_info->ID, $numbers.'_for_lname');
										if ($first_name != null && $last_name != null) {
											$table_content .= '<td>' . $first_name[0] . "</td>";
											$table_content .= '<td>' . $last_name[0] . "</td>";
										} else {
											$table_content .= '<td>' . $user_info->first_name . "</td>";
											$table_content .= '<td>' . $user_info->last_name . "</td>";
										}
										$purchased_date = get_user_meta($user_info->ID, $numbers.'_time');
										$table_content .= '<td>'.$purchased_date[0].'</td>';
										$table_content .= '<td class="f2p_id">' . $numbers . "</td>";
										$table_content .= '<td><input id="'.$numbers.'_d" type="button" value="UnRedeem" class="f2p-button-unredeem"/></td>';
										$table_content .= '</tr>';
										$has_data = true;
									}
									/*
									 else if($flag==0) {
										echo '<p style="color:red;">Nothing Redeemed</p>';
										$flag=1;
									}
									*/
								}
							}

						}
						$table_content .= '</table>';
						?>
					
				<?php
					if (!$has_data) {
						echo '<p style="color:red;">Nothing Redeemed</p>';
					} else {
						echo $table_content;
					}
				}
  				?>
			</div>
  		<?php   //USER ACCOUT PAGE
		} else {
			?>
			<div style="float:left; wdith:640px; padding: 20px 0 20px 20px;" id="date-holder">
				<b style='font-size:155%;'>Need help with a Date Package you purchased?</b>
				<p>Email us anytime at <a href="mailto:support@fortwoplease.com">support@fortwoplease.com</a>.</p>
				<br/>
				<h1 style='color:#1596d0; font-weight: normal;'>MY PURCHASED DATE PACKAGES</h1><br/>
				<?php  
				if (get_user_meta($current_user->ID, 'purchased',false)) {
					foreach (get_user_meta($current_user->ID, 'purchased',false) as $values) {
						$pid = get_user_meta($current_user->ID, $values.'_id');
						$done = get_user_meta($current_user->ID, $values.'_stat');
						$merchantuname = get_field('merchant_username',$pid[0]);
						$merchantuname = intval($merchantuname);
						$doneMerch = get_user_meta($merchantuname, $values.'_d');
						$purchased_date = get_user_meta($current_user->ID, $values.'_time');
						$date = date_create($purchased_date[0]);
						if($done[0] == 'notdone' && $doneMerch[0] == 'notdone') {
				?>
							<div class="separation_line"></div>
							<div style="float:left;clear:both;width:680px;margin-bottom:20px;">
								<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
								<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
									<div style="height:30px;">
										<input type="checkbox" class="checkbox" name="redeemed" value="<?php echo $values.'_stat';?>" />I've gone on this date!<br/>
									</div>
									<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
									<div style="font-weight:700;"><a href="<?php echo get_permalink($pid[0]) ?>"><?php echo the_field('sub_title',$pid[0]); ?></a></div>
									<div>Purchased Date: <?php echo date_format($date, 'd/m/Y') ?></div>
									<div style="margin:none;">Expiry Date: <?php echo the_field('end_date',$pid[0]); ?> </div>
									<div style="font-style:italic;margin-top:5px;font-size:12px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
									<p style="font-size:18px; font-weight:bold;"><a href="../pdf?pid=<?php echo $pid[0] ?>&guid=<?php echo $values ?>&uid=<?php echo $current_user->ID ?>" target="_blank">Download My Voucher</a></p>
								</div>
							</div>
						<?php
						}
					}
				} else {
					echo "You do not currently have any active date packages";
				} ?>
				
				<div class="separation_line"></div><br/>
				
				<?php
				if (get_user_meta($current_user->ID, 'purchased',false)) {
				?>
					<h1 style='color:#1596d0; font-weight: normal; clear:both;'>MY REDEEMED DATE PACKAGES</h1><br/>
					<?php
					foreach (get_user_meta($current_user->ID, 'purchased',false) as $values) {
						$pid = get_user_meta($current_user->ID, $values.'_id');
						$done = get_user_meta($current_user->ID, $values.'_stat');
						$merchantuname = get_field('merchant_username',$pid[0]);
						$merchantuname = intval($merchantuname);
						$doneMerch = get_user_meta($merchantuname, $values.'_d');
						$purchased_date = get_user_meta($current_user->ID, $values.'_time');
						$date = date_create($purchased_date[0]);
						if($done[0] == 'done' && $doneMerch[0] == 'notdone') {
					?>
							<div style="float:left;clear:both;width:680px;margin-bottom:20px;">
								<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
								<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
									<div style="height:30px;">
										<!--<input type="checkbox" class="checkbox" name="redeemed" value="<?php echo $values.'_stat';?>" checked />I've gone on this date! <br/>-->
										<b>I've gone on this date!</b>
									</div>
									<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
									<div style="font-weight:700;"><a href=""><?php echo the_field('sub_title',$pid[0]); ?></a></div>
									<div>Purchased Date: <?php echo date_format($date, 'd/m/Y') ?></div>
									<div style="margin:none;">Expiry Date: <?php echo the_field('end_date',$pid[0]); ?> </div>
									<div style="font-style:italic;margin-top:5px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
									<p style="font-size:18px; font-weight:bold;"><a href="../pdf?pid=<?php echo $pid[0] ?>&guid=<?php echo $values ?>&uid=<?php echo $current_user->ID ?>" target="_blank">Download My Voucher</a></p>
								</div>
							</div>
						<?php
						} elseif($doneMerch[0] == 'done') {
						?>
							<div style="float:left;clear:both;width:680px;margin-bottom:20px;">
								<img style="loat: left; padding-right: 5px;" src="<?php echo the_field('thumbnail',$pid[0]); ?>" />
								<div style="width:300px;float:right;margin-right:40px;margin-top:10px;">
									<div style="height:30px;"><b>Redeemed by merchant.</b></div>
									<div style="font-size:18px;"><?php echo get_the_title($pid[0]); ?> </div>
									<div style="font-weight:700;"><a href=""><?php echo the_field('sub_title',$pid[0]); ?></a></div>
									<div>Purchased Date: <?php echo date_format($date, 'd/m/Y') ?></div>
									<div style="margin:none;">Expiry Date: <?php echo the_field('end_date',$pid[0]); ?> </div>
									<div style="font-style:italic;margin-top:5px;"><?php echo the_field('fine_print',$pid[0]); ?></div>
								</div>
							</div>
						<?php 
						}
					}
				}
				?>
			</div>
			<?php
		}
		?>
		<div id="right-hand" style="float:right;width:300px;padding-right:20px; margin-top: 30px;">
			<h3 style="color:#1596d0;">Welcome <?php  echo $current_user->user_login ?></h3><br/>
			<h4>My <?php if($current_user->roles[0] == 'merchant') { echo 'Business'; } ?> Account</h4>
			<div id="account-info" style="border:1px solid #000;padding:5px; margin-top:5px; ">
				<!-- <p>Your unique ForTwoPlease ID is: <b><?php echo $current_user->ID ?></b> </p> -->
				<p>Email: <?php echo $current_user->user_email ?> </p>
				
				<form id="set_pass" action="#" style="background:#222;color:white;;padding:8px;border-radius:10px; display: none;">
					<p style="font-size:18px; margin-bottom:8px;">Set My ForTwoPlease Password</p>
					<p><label class="pass_label"for="npass">New Password</label> <input class="pass" type="password" style="" name="npass" /></p>
					<p><label class="pass_label" for="npassc">Confirm Password</label> <input class="pass" type="password" style="" name="npassc" /></p>
					<div style="clear:both;"></div>
					<p class="submit" style="margin: 14px 0 0 175px;" ><input id="set_pass_btn" type="submit" value="Submit" class="f2p-button" style="font-size:18px;padding:10px;marign-left;"/></p>
				</form>
				
				<form id="changepass" action="#" style="background:#222;color:white;;padding:8px;border-radius:10px; display: none;">
					<p style="font-size:18px; margin-bottom:8px;">Reset Password</p>
					<p><label class="pass_label" for="opass">Old Password</label> <input class="pass" type="password" style="" name="opass" /></p>
					<p><label class="pass_label"for="npass">New Password</label> <input class="pass" type="password" style="" name="npass" /></p>
					<p><label class="pass_label" for="npassc">Confirm Password</label> <input class="pass" type="password" style="" name="npassc" /></p>
					<div style="clear:both;"></div>
					<p class="submit" style="margin: 14px 0 0 175px;" ><input id="changepassword" type="submit" value="Submit" class="f2p-button" style="font-size:18px;padding:10px;marign-left;"/></p>
				</form>
			</div>

			<?php 
			if($current_user->roles[0] == 'merchant') {
			?>
			<div style="border:1px solid #000;padding:5px; margin-top:50px; ">
				<div style="background:#222;color:white;;padding:8px;border-radius:10px;">
					<p style="font-size:18px; margin-bottom:8px;">Mini Dashboard</p>
					<div class="pass" style="padding-bottom: 5px;">Number of Packages Available: <?php echo $total_packages_available; ?></div>
					<div class="pass" style="padding-bottom: 5px;">Total Number of Packages Sold: <?php echo $total_packages_sold; ?></div>
					<div class="pass" style="padding-bottom: 5px;">Total Sales: <?php echo money_format('$%i', $total_sales_amount); ?></div>
				</div>
			</div>
			<?php
			}?>
		</div>
	</div>
	
<?php
} else {
?>
<div>You must be logged in </div>
<?php
  }
 get_footer(); 
?>

<script type="text/javascript">
jQuery(document).ready(function(jQuery) {

	$(".f2p-button-redeemed").click(function() {
		var confirmation = confirm("Are you sure?");
		var uval = $(this).attr('id');
		if (confirmation) {
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: "action=donedate&uniqueval="+uval+"&checked=checked",
				success: function(msg) {
					setTimeout("location.reload(true);");
				}
			});
		}
	});

	$(".f2p-button-unredeem").click(function() {
		var confirmation = confirm("Are you sure?");
		var uval = $(this).attr('id');
		if (confirmation) {
			jQuery.ajax({
				type: "POST",
				url:  "/dev/wp-admin/admin-ajax.php",
				data: "action=donedate&uniqueval="+uval+"&checked=notchecked",
				success: function(msg) {
					setTimeout("location.reload(true);");
				}
			});
		}
	});
	
	jQuery.ajax({
		type: "POST",
		url:  "/dev/wp-admin/admin-ajax.php",
		data: "action=userhasftpaccount&" + "user_login=<?php echo $current_user -> user_email ?>" ,
		success: function(msg) {
			if(msg == 'Success0'){
				jQuery("#set_pass").show();
			} else {
				jQuery("#changepass").show();
			}
		}
	});
});


jQuery("#changepassword").click(function() {
	var input_data = jQuery('#changepass').serialize();
	jQuery.ajax({
		type: "POST",
		url:  "/dev/wp-admin/admin-ajax.php",
		data: "action=passchange&" + input_data,
		success: function(msg) {
			alert(msg.substring(0, msg.length-1));
			setTimeout("location.reload(true);");
		}
	});
	return false;
});

jQuery("#set_pass_btn").click(function() {
	var input_data = jQuery('#set_pass').serialize();
	jQuery.ajax({
		type: "POST",
		// url:  "/dev/wp-admin/admin-ajax.php",
		url:  "/dev/wp-admin/admin-ajax.php",
		data: "action=setftppass&" + input_data,
		success: function(msg) {
			alert(msg.substring(0, msg.length-1));
			setTimeout("location.reload(true);");
		}
	});
	return false;
});




</script>


