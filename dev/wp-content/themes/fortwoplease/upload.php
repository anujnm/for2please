<style type="text/css">
form div.upload_fields { width:300px; padding-top:10px; padding-bottom: 10px;}
form div.upload_fields label { display:block; margin-bottom: 5px; font-weight:bold;}
form div.upload_checkbox {display: block; width:420px; padding-top:20px; padding-bottom: 20px;}
form div.upload_checkbox div {font-weight:bold;}
form div.upload_checkbox span {width:180px; display:inline-block;}
form div.upload_checkbox input { width:13px; height: 25px; }
form div.upload_fields input { width:300px; height: 25px; }
div.separation_line { border-bottom: 1px solid #3395df; margin: 20px 0 6px 0; clear:both; }
div.header-content {background:#FFF;color:black;overflow:hidden; border-bottom: 30px solid black; min-height:600px; width: 1060px; box-shadow: 1px 40px 30px 4px #333;}
.lightboxMessage {padding: 5px 20px;border-radius: 10px; background-color: #F2DEDE;border: 1px solid #EED3D7;color: #B94A48;width: 66%;margin: auto;}
.hide {display:none;}
</style>

<?php
/*
Template Name: upload
*/
  get_header();
  $args = array('hide_empty' => 0, 'fields' => 'id=>slug');
?>

  <div id='header-content' class="header-content" style='color:black;'>
      <div id="left-hand" style="float:left;width:640px;padding:20px 20px 20px 50px;">

        <?php
        if (isset($_GET['uploaded']) && $_GET['uploaded'] == 'True') {
          if (isset($_GET['city']) && get_term_by('slug', strtolower($_GET['city']), 'city')) {
            $city = get_term_by('slug', strtolower($_GET['city']), 'city');
            $current_city = $city->name;
            $current_city_id = $city->term_id;
          } elseif (isset($_GET['city']) && trim($_GET['city']) != '') {
            $current_city = $_GET['city'];
          }
          ?>
          <h1 style='margin:10px 0; color:#1596d0;'>THANKS FOR YOUR ENTRY!</h1>
          <div class="separation_line"></div><br/>
          <br/>
          <p>We'll review your date idea and get back to you as soon as we can!</p><br/>
          <p>Till then, feel free to make another entry.</p><br/>
          <?php
        } elseif (isset($_GET['city']) && get_term_by('slug', strtolower($_GET['city']), 'city')) {
            $city = get_term_by('slug', strtolower($_GET['city']), 'city');
            $current_city = $city->name;
            $current_city_id = $city->term_id;
          ?>
          <h1 style='margin:10px 0; color:#1596d0;'>FORTWOPLEASE GUIDE TO <?php echo strtoupper($current_city); ?>'<?php if (substr($current_city, strlen($current_city)-1) != 's') { echo 'S';}?> BEST FALL DATE SPOTS</h1>
          <div class="separation_line"></div><br/>
          <br/>
          <p>Hey there! </p><br/>
          <p>Are you one of <?php echo $current_city; ?>'<?php if (substr($current_city, strlen($current_city)-1) != 's') { echo 's';}?> best date spots for the fall?</p><br/>
          <p><b>Please fill out the form below by October 24, 2014, to be nominated for the "ForTwoPlease Guide to <?php echo $current_city; ?>'<?php if (substr($current_city, strlen($current_city)-1) != 's') { echo 's';}?> Best Fall Date Spots".</b></p><br/>
          <p>Final selections will be made by October 31, 2014.</p><br/><br/>
        <?php
      } else {
        if (isset($_GET['city']) && trim($_GET['city']) != '') {
          $current_city = trim($_GET['city']);
        }
        ?>
          <h1 style='margin:10px 0; color:#1596d0;'>TOP FALL DATE SPOTS GUIDE</h1>
          <div class="separation_line"></div><br/>
          <br/>
          <p>Hey there! </p><br/>
          <p>Are you one of your city's best date spots for the fall?</p><br/>
          <p><b>Please fill out the form below by October 24, 2014, to be nominated for the "ForTwoPlease Fall Date Spot".</b></p><br/>
          <p>Final selections will be made by October 31, 2014.</p><br/><br/>
        <?php
      }
        ?>
        <p>Thanks!</p><br/>
        <p>Devon, Community Manager</p><br/>
        <p>ForTwoPlease.com</p><br/>
        <div class="separation_line"></div><br/>

        <div>
          <p class="lightboxMessage hide m-t-m"></p>
          <p style="font-size: 18px; font-weight:bold;">Business Details </p>
          <form id="create_date_idea_form" action="/wp-admin/admin-ajax.php" method="post" enctype="multipart/form-data" data-remote="true">
            <input type='hidden' name='action' id='action' value='create_date_idea' />
            <?php
            if (isset($current_city) && isset($current_city_id)) {
              ?>
              <input type='hidden' name='city' value='<?php echo $current_city; ?>'>
              <input type='hidden' name='city_id' value='<?php echo $current_city_id; ?>'>
            <?php
            } else {
            ?>
              <input type='hidden' name='city' value=''>
              <input type='hidden' name='city_id' value=''>
            <?php
            }
            ?>
            <div class="upload_fields">
              <label>Business Name:</label>
              <input type="text" name="business_name" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Your Full Name:</label>
              <input type="text" name="user_name" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Best Email:</label>
              <input type="text" name="user_email" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Phone Number:</label>
              <input type="text" name="business_phone" class="text login_text business_phone" value="" />
            </div>
            <div class="upload_fields">
              <label>Business Website: </label>
              <input type="text" name="website" class="text login_text" value="" />
              <p style='font-size: 12px;'>Please enter the full URL. Example: https://www.google.com</p>
            </div>
            <div class="upload_fields">
              <label>Business Street Address: </label>
              <input type="text" name="street_address1" class="text login_text" value="" />
            </div>
            <div class="upload_fields">
              <label>City: </label>
              <input type="text" name="address_city" class="text login_text" value="" />
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
            <p style='padding-top:10px;'>Tell our couples why they should visit your business on their next date!</p><br/>

            <div class="upload_fields">
              <label>Date Idea Title: </label>
              <input id='date-idea-title' type="text" name="date_title" class="text login_text" value="" />
            </div>
            <p style='font-size: 12px;'><span id='title-chars'>45</span> characters remaining</p><br/>
            <div class="upload_fields">
              <label>Describe this Date Idea in one sentence: </label>
              <textarea id="date-idea-short-desc" name="short_desc" class="text login_text" value="" rows="10" cols="50"></textarea>
            </div>
            <p style='font-size: 12px;'><span id="short-desc-chars">180</span> characters remaining</p><br/><br/>
            <div style='padding-top:20px;font-weight:bold;'>
              <p>Provide more information about what a couple can expect and why this is a great date idea that they should experience. The more detailed information the better.</p><br/>
            </div>
            <div class="upload_fields">
              <textarea id='full_desc' name="full_desc" class="text login_text" value="" rows="10" cols="50"></textarea>
            </div>
            <p style='font-size: 12px;'>Recommended Minimum: 150 characters</p><br/>
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
            <div style='padding-top:20px;font-weight:bold;'>
              <p>Enter up to 3 sets of testimonials and awards: </p><br/>
              <p>Please ensure the testimonials and awards are descriptive. Mention the source of the review if possible, but please do not link to other websites. </p>
            </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 1: </label>
              <textarea name="testimonial1" class="text login_text testimonial" value="" rows="5" cols="50"/></textarea>
            </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 2: </label>
              <textarea name="testimonial2" class="text login_text testimonial" value="" rows="5" cols="50" /></textarea>
            </div>
            <div class="upload_fields">
              <label>Testimonials and Awards 3: </label>
              <textarea name="testimonial3" class="text login_text testimonial" value="" rows="5" cols="50" /></textarea>
            </div>
            <div style='font-weight:bold;padding-top:20px;'>Upload up to 5 images of resolutions 505x295 pixels or greater. Please ensure that the aspect ratio of your images is as close to this as possible. </div>
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

  $(".business_phone").on('change', function() {
    var number = $(this).val()
    number = number.replace(/[^0-9]/g, '').replace(/(\d{3})(\d{3})(\d{4})/, "$1.$2.$3");
    $(this).val(number)
  });

  jQuery("#submitbtn").click(function() {
    jQuery('.lightboxMessage').text('').hide();
    form = jQuery('#create_date_idea_form');
    if (validate_form(form) == false) {
      jQuery('.lightboxMessage').text('All fields on this form are compulsory unless marked otherwise. Please complete the form and try again.').show();
      return false;
    } else {
      form.submit();
      return false;
    }
  });

  function validate_form(form) {
    var is_valid = true;
    $('#create_date_idea_form input[type="text"]').each(function(index, data) {
      if (this.value == '') {
        is_valid = false;
      }
    });
    if (is_valid) {
      $('#create_date_idea_form textarea').each(function(index, data) {
        if (!(this.classList.contains('testimonial'))) {
          if (this.value == '') {
            is_valid = false;
          }
        }
      });
    }
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

});

(function($) {
  $.fn.extend( {
    limiter: function(limit, elem) {
      $(this).on("keyup focus", function() {
        setCount(this, elem);
      });
      function setCount(src, elem) {
        var chars = src.value.length;
        if (chars > limit) {
          src.value = src.value.substr(0, limit);
          chars = limit;
        }
        elem.html( limit - chars );
      }
      setCount($(this)[0], elem);
    }
  });
})(jQuery);
var elem = $("#short-desc-chars");
$("#date-idea-short-desc").limiter(180, elem);
var elem = $("#title-chars");
$("#date-idea-title").limiter(45, elem);
</script>
