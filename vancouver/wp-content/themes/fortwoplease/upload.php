<style type="text/css">
form div.upload_fields { width:300px; padding-top:10px; padding-bottom: 10px;}
form div.upload_fields label { display:block; margin-bottom: 5px; font-weight:bold;}
form div.upload_checkbox {display: block; width:420px; padding-top:20px; padding-bottom: 20px;}
form div.upload_checkbox div {font-weight:bold;}
form div.upload_checkbox span {width:180px; display:inline-block;}
form div.upload_checkbox input { width:13px; height: 25px; }
form div.upload_fields input { width:300px; height: 25px; }

div.separation_line { border-bottom: 1px solid #3395df; margin: 20px 0 6px 0; clear:both; }

</style>

<?php
/*
Template Name: upload
*/
 get_header();
?>

  <div id="header-content" style="background:#FFF;color:black;overflow:hidden; border-bottom: 30px solid black; min-height:600px; width: 1060px; box-shadow: 1px 40px 30px 4px #333;">
      <div id="left-hand" style="float:left;width:640px;padding:20px;">

        <?php
        if (isset($_GET['uploaded']) && $_GET['uploaded'] == 'True') {
          ?>
          <h1 style='margin:10px 0; color:#1596d0;'>THANKS FOR YOUR ENTRY!</h1>
          <div class="separation_line"></div><br/>
          <br/>
          <p>We'll review your date idea and get back to you as soon as we can!</p><br/>
          <p>Till then, feel free to make another entry.</p><br/>
          <?php
        } else {
          ?>
          <h1 style='margin:10px 0; color:#1596d0;'>TOP SUMMER DATE SPOTS GUIDE</h1>
          <div class="separation_line"></div><br/>
          <br/>
          <p>Hey there! Are you one of Toronto's best date spots for summer?</p><br/>
          <p>Please fill out the form below by May 31, 2014, to be nominated for the "ForTwoPlease Summer Date Spot" - a guide To Toronto's Best Summer Date Spots.</p><br/>
          <p>Final selections will be made by June 30, 2014.</p><br/><br/>
        <?php
        }
        ?>
        <p>Thanks!</p><br/>
        <p>ForTwoPlease.com</p><br/>
        <div class="separation_line"></div><br/>

        <div>
          <p class="lightboxMessage hide m-t-m"></p>
          <p style="font-size: 18px; font-weight:bold;">Business Details </p>
          <form id="create_date_idea_form" action="/vancouver/wp-admin/admin-ajax.php" method="post" enctype="multipart/form-data" data-remote="true">
            <input type='hidden' name='action' id='action' value='create_date_idea' />
            <div class="upload_fields">
              <label>Business Name:</label>
              <input type="text" name="business_name" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Your Full Name:</label>
              <input type="text" name="user_name" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Your Title:</label>
              <input type="text" name="user_title" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Best Email:</label>
              <input type="text" name="user_email" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Phone Number:</label>
              <input type="text" name="business_phone" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Website: </label>
              <input type="text" name="website" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Street Address: </label>
              <input type="text" name="street_address1" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Street Address 2: </label>
              <input id='street_address2' type="text" name="street_address2" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>City: </label>
              <input type="text" name="city" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>State/Province: </label>
              <input type="text" name="province" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Postal/Zip Code: </label>
              <input type="text" name="postal_code" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Country: </label>
              <input type="text" name="country" class="text login_text" value="" />
            </div>

            <div class="separation_line"></div><br/>

            <p style="font-size: 18px; font-weight:bold;">Date Idea Content</p>
            <p style='padding-top:10px;'>Please tell us more about why you are a great date spot for couples.</p><br/>

            <div class="upload_fields">
              <label>Date Idea Title: </label>
              <input type="text" name="date_title" class="text login_text" value="" />
            </div>
            <p style='font-size: 12px;'>Maximum Allowed: 50 characters</p><br/>
            <div class="upload_fields">
              <label>Date Idea Short Description: </label>
              <textarea name="short_desc" class="text login_text" value="" maxlength="180" rows="10" cols="50">
              </textarea>
            </div>
            <p style='font-size: 12px;'>Maximum Allowed: 180 characters</p><br/>
            <div class="upload_fields">
              <label>Date Idea Full Description and Tips: </label>
              <textarea id='full_desc' name="full_desc" class="text login_text" value="" rows="10" cols="50">
              </textarea>
            </div>
            <p style='font-size: 12px;'>Minimum Allowed: 150 characters</p><br/>
            <div class="upload_checkbox date_idea_type">
              <div>Please select the Date Idea Types that apply to you (Maximum 3): </div>
              <span>
                <input id='choice1' type='checkbox' name='date_idea_type[]' value='3'>
                <label class='choice' for='choice1'>Dining</label>
              </span>
              <span>
                <input id='choice2' type='checkbox' name='date_idea_type[]' value='5'>
                <label class='choice' for='choice2'>Active</label>
              </span>
              <span>
                <input id='choice3' type='checkbox' name='date_idea_type[]' value='7'>
                <label class='choice' for='choice3'>Adventure</label>
              </span>
              <span>
                <input id='choice4' type='checkbox' name='date_idea_type[]' value='50'>
                <label class='choice' for='choice4'>Anniversary</label>
              </span>
              <span>
                <input id='choice5' type='checkbox' name='date_idea_type[]' value='9'>
                <label class='choice' for='choice5'>At Home</label>
              </span>
              <span>
                <input id='choice6' type='checkbox' name='date_idea_type[]' value='4'>
                <label class='choice' for='choice6'>Entertainment</label>
              </span>
              <span>
                <input id='choice7' type='checkbox' name='date_idea_type[]' value='13'>
                <label class='choice' for='choice7'>First Dates</label>
              </span>
              <span>
                <input id='choice8' type='checkbox' name='date_idea_type[]' value='6'>
                <label class='choice' for='choice8'>Getaways</label>
              </span>
              <span>
                <input id='choice9' type='checkbox' name='date_idea_type[]' value='14'>
                <label class='choice' for='choice9'>Other</label>
              </span>
              <span>
                <input id='choice10' type='checkbox' name='date_idea_type[]' value='52'>
                <label class='choice' for='choice10'>Relaxing</label>
              </span>
            </div>
            <div class="upload_checkbox">
              <div>Best Time for a Date (select all that apply): </div>
              <span>
                <input id='time1' type='checkbox' name='date_time[]' value='37'>
                <label class='choice' for='time1'>Morning</label>
              </span>
              <span>
                <input id='time2' type='checkbox' name='date_time[]' value='38'>
                <label class='choice' for='time2'>Daytime</label>
              </span>
              <span>
                <input id='time3' type='checkbox' name='date_time[]' value='39'>
                <label class='choice' for='time3'>Evening</label>
              </span>
            </div>
            <div style='padding-top:20px;font-weight:bold;'>Enter up to 3 sets of testimonials and awards: </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 1: </label>
              <textarea name="testimonial1" class="text login_text testimonial" value="" rows="5" cols="50"/>
              </textarea>
            </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 2: </label>
              <textarea name="testimonial2" class="text login_text testimonial" value="" rows="5" cols="50" />
              </textarea>
            </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 3: </label>
              <textarea name="testimonial3" class="text login_text testimonial" value="" rows="5" cols="50" />
              </textarea>
            </div>
            <div style='font-weight:bold;padding-top:20px;'>Upload up to 5 images of resolutions 700x350 pixels or greater: </div>
            <div class="upload_fields">
              <label>Image 1: </label>
              <input type='file' name='attach1' id='attach1'>
            </div>
            <div class="upload_fields">
              <label>Image 2: </label>
              <input type='file' name='attach2' id='attach2'>
            </div>
            <div class="upload_fields">
              <label>Image 3: </label>
              <input type='file' name='attach3' id='attach3'>
            </div>
            <div class="upload_fields">
              <label>Image 4: </label>
              <input type='file' name='attach4' id='attach4'>
            </div>
            <div class="upload_fields">
              <label>Image 5: </label>
              <input type='file' name='attach5' id='attach5'>
            </div>

            <div class="upload_fields">
              <label>Neighbourhood (Optional): </label>
              <input id='neighbourhood' type="text" name="neighbourhood" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Best time to contact you in case we have questions (Optional): </label>
              <input id='contact_time' type="text" name="contact_time" class="text login_text" value="" />
            </div>
            <input type="submit" id="submitbtn" name="submit" value="Submit" class="f2p-button login_btn m-t-l" />
          </form>
        </div>
      </div>
  </div>

<?php
 get_footer();
?>

<script type="text/javascript">
jQuery(document).ready(function(jQuery) {

  jQuery('#create_date_idea_form').bind('ajax:complete', function() {
    this.preventDefault();
    alert("Form submitted, id");
    debugger;
  });

  jQuery("#submitbtn").click(function() {
    form = jQuery('#create_date_idea_form');
    if (validate_form(form) == false) {
      return false;
    } else {
      form.submit();
      return false;
    }
    /*
    var input_data = form.serialize();
    jQuery.ajax({
      type: "POST",
      url:  "/dev/wp-admin/admin-ajax.php",
      data: "action=create_date_idea&" + input_data,
      success: function(data) {
        debugger;
        if(data.msg=='Success') {
          setTimeout("location.reload(true);");
          return false;
        } else {
          $('.lightboxMessage').html(msg).show();
        };
      }
    });
    return false;
    */
  });

  function validate_form(form) {
    var is_valid = true;
    $('#create_date_idea_form input[type="text"]').each(function(index, data) {
      if (!(this.id == 'contact_time') && !(this.id=='neighbourhood') && !(this.id=='street_address2')) {
        if (this.value == '') {
          is_valid = false;
        }
      }
    });
    $('#create_date_idea_form textarea').each(function(index, data) {
      if (!(this.id == 'testimonial')) {
        if (this.value == '') {
          is_valid = false;
        }
      }
    });
    return is_valid;
  }

  jQuery(function(){
    var max = 3;
    var checkboxes = jQuery('.upload_checkbox.date_idea_type input[type="checkbox"]');

    checkboxes.change(function(){
        var current = checkboxes.filter(':checked').length;
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
    });
  });

  function checktextarea() {

   var minLength = 150;

   var desc_length = $('#full_desc').text().length;
   if(desc_length < minLength) {
      var message = 'You need to enter at least ' + minLength + ' + characters in the Date Idea Full Description. You have currently entered ' + desc_length + '. ';
      jQuery('.lightboxMessage').html(message).show();
      return false;
   }
 }
});
</script>
