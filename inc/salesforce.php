<?php 



// get fields
$firstName = get_field('first_name', 70);
$last_name = get_field('last_name', 70);
$email = get_field('email', 70);
$emailSecond = get_field('email_second', 70);
$phone = get_field('phone', 70);
$timeLocation = get_field('times_&_locations', 70);
$timeLocationDesc = get_field('times_&_locations_desc', 70);
$days = get_field('days', 70);
$days_desc = get_field('days_desc', 70);
$settingPreference = get_field('setting_preference', 70);
$settingPreference_desc = get_field('setting_desc', 70);
$time_commitment = get_field('time_commitment', 70);
$time_commitmentDesc = get_field('time_commitment_desc', 70);
$time_commitment_other = get_field('time_commitment_other', 70);
$time_commitment_other_desc = get_field('time_commitment_other_desc', 70);
$orientation_selection = get_field('orientation_selection', 70);
$orientation_selection_desc = get_field('orientation_selection_desc', 70);
$other_preferences = get_field('other_preferences', 70);
$other_preferences_desc = get_field('other_preferences_desc', 70);
$gen_availability = get_field('gen_availability', 70);
$gen_availability_desc = get_field('gen_availability_desc', 70);
$school_preference = get_field('school_preference', 70);
$school_preference_desc = get_field('school_preference_desc', 70);
$how_did_you_hear = get_field('how_did_you_hear', 70);
$dob_label = get_field('dob', 70);
$dob_desc = get_field('dob_desc', 70);
$resi_label = get_field('resi_label', 70);
$resi_desc = get_field('resi_desc', 70);
$internet_label = get_field('internet_label', 70);
$internet_desc = get_field('internet_desc', 70);
$how_did_you_hear_desc = get_field('how_did_you_hear_desc', 70);
$how_did_you_hear_hidden = get_field('how_did_you_hear_hidden', 70);
$how_did_you_hear_hidden_desc = get_field('how_did_you_hear_hidden_desc', 70);
$speak_spanish_desc = get_field('speak_spanish_desc', 70);
// show them or not.
$show_first_name = get_field('show_first_name', 70);
$show_last_name = get_field('show_last_name', 70);
$show_email = get_field('show_email', 70);
$show_emailSecond = get_field('show_email_second', 70);
$show_phone = get_field('show_phone', 70);
$show_time_location = get_field('show_time_location', 70);
$show_days = get_field('show_days', 70);
$show_settingPreference = get_field('show_setting_preference', 70);
$show_time = get_field('show_time', 70);
$show_time_other = get_field('show_time_other', 70);
$show_orientation_selection = get_field('show_orientation_selection', 70);
$show_other_preferences = get_field('show_other_preferences', 70);
$show_gen_avail = get_field('show_gen_avail', 70);
$show_school_preference = get_field('show_school_preference', 70);
$show_hear = get_field('show_hear', 70);
$show_hear_other = get_field('show_hear_other', 70);
$show_dob = get_field('show_dob', 70);
$show_resi = get_field('show_resi', 70);
$show_internet = get_field('show_internet', 70);
$show_speak_spanish = get_field('show_speak_spanish', 70);


 ?>



<div class="heartform">
  <div class="gform_wrapper">
    <form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
    <div class="gform_body">
      <ul class="gform_fields top_label form_sublabel_below description_below">
      <input type=hidden name="oid" value="00D6A000001iTWP">
      <input type=hidden name="retURL" value="http://hearttutoring.org/thank-you/">
        

          <?php if( $show_first_name == 'Yes') { ?>
          <li class="gfield">
            <label for="first_name" class="gfield_label"><strong><?php echo $firstName; ?></strong></label><br>
            <input id="first_name" maxlength="40" name="first_name" size="20" type="text" class="medium" required="true" required />
          </li>
          <br>
          <?php } ?>

          <?php if( $show_last_name == 'Yes') { ?>
          <li class="gfield">
            <label for="last_name" class="gfield_label"><strong><?php echo $last_name; ?></strong></label><br>
            <input id="last_name" maxlength="80" name="last_name" size="20" type="text" class="medium" required="true" required />
          </li><br>
          <?php } ?>

          <?php if( $show_email == 'Yes') { ?>
          <li class="gfield">
            <label for="email" class="gfield_label"><strong><?php echo $email; ?></strong></label><br>
            <input id="email" maxlength="80" name="email" size="20" type="text" class="medium" required="true" required />
          </li><br>
          <?php } ?>

          <?php if( $show_emailSecond == 'Yes') { ?>
          <li class="gfield">
            <label for="email" class="gfield_label"><strong><?php echo $emailSecond; ?></strong></label><br>
            <input  id="00N2G00000CheFA" maxlength="80" name="00N2G00000CheFA" size="20" class="medium" type="text" />
          </li><br>
          <?php } ?>


          <?php if( $show_phone == 'Yes') { ?>
          <li class="gfield">
            <label for="email" class="gfield_label"><strong><?php echo $phone; ?></strong></label><br>
            <input  id="00N2G00000ChccW" maxlength="40" name="00N2G00000ChccW" class="medium" onkeydown="formatPhoneOnEnter(this, event);" size="20" type="text" />
          </li><br>
          <?php } ?>


          <li class="gfield" style="display: none;">
            <label for="email" class="gfield_label"><strong>Region:</strong></label><br>
              <select required required="true" id="00N2G00000C7uNN" name="00N2G00000C7uNN" title="Region">
              <option value="">--None--</option>
              <option value="Charlotte" selected="selected">Charlotte</option>
              <option value="Charleston">Charleston</option>
              <option value="Winston-Salem">Winston-Salem</option>
            </select>
          </li>
          
           <!-- 

              Prefered Time

           -->

          <?php if( $show_time == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label"><strong><?php echo $time_commitment; ?></strong></label><br>
            <?php if($time_commitmentDesc != '') { ?>
                <label class="gfield_label"><?php echo $time_commitmentDesc; ?></label><br>
              <?php } ?>
          <select required required="true" class="medium gfield_select" id="00N6A00000MTg6j"; title="Time Commitment" name="00N6A00000MTg6j">
            <option value="">--None--</option>
            <option value="1 hour once per week (two sessions)">1 hour once per week (two sessions)</option>
            <option value="30 minutes once per week (one session)">30 minutes once per week (one session)</option>
            <option value="30 minutes twice per week (two sessions)">30 minutes twice per week (two sessions)</option>
            <option value="1 hour twice per week (four sessions)">1 hour twice per week (four sessions)</option>
            <option value="Other">Other</option>
          </select  required="true" required>
          </li><br>
          <?php } ?>

           <!-- 

              Prefered Time Other

           -->

          <?php if( $show_time_other == 'Yes') { ?>
          <li class="gfield togglepref" style="display: none;">
            <label class="gfield_label " ><strong><?php echo $time_commitment_other; ?></strong></label><br>
            <?php if( $time_commitment_other_desc != '') { ?>
              <label class="gfield_label " ><?php echo $time_commitment_other_desc; ?></label><br>
            <?php } ?>
            <input id="00N6A00000MTsDX" maxlength="255" name="00N6A00000MTsDX" size="20" type="text" class="medium" />
          </li><br>
          <?php } ?>

           <!-- 

              General Availability

           -->

          <?php if( $show_gen_avail == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label "><strong><?php echo $gen_availability; ?></strong></label><br>
            <?php if( $gen_availability_desc != '') { ?>
              <label class="gfield_label " ><?php echo $gen_availability_desc; ?></label><br>
            <?php } ?>
            <select  required required="true" class="medium gfield_select"  id="00N6A00000Mikyd" multiple="multiple" name="00N6A00000Mikyd" title="General Availability (Interest Form)">
              <option value="">Choose</option>
              <option value="Early morning">Early morning</option>
              <option value="Mid-Morning">Mid-Morning</option>
              <option value="Lunch Time/Early Afternoon">Lunch Time/Early Afternoon</option>
              <option value="Late Afternoon">Late Afternoon</option>
              <option value="No Preference">No Preference</option>
            </select  required="true" required>
          </li><br>
          <?php } ?>


          <!-- 

              Tutoring Days

           -->

          <?php if( $show_days == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label"><strong><?php echo $days; ?></strong></label><br>
            <?php if($days_desc != '') { ?>
                <label class="gfield_label"><?php echo $days_desc; ?></label><br>
              <?php } ?>
            <select required required="true" class="medium gfield_select" id="00N6A00000MTg6K" title="Tutoring Days Selected" multiple="multiple" name="00N6A00000MTg6K">
              <option value="">Choose</option>
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <!-- <option value="Friday">Friday</option> -->
              <option value="No Preference">No Preference</option>
            </select  required="true" required>
          </li><br>
          <?php } ?>


          <!-- 

              Setting Preference

           -->
           <?php if( $show_settingPreference == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label"><strong><?php echo $settingPreference; ?></strong></label><br>
            <?php if($settingPreference_desc != '') { ?>
                <label class="gfield_label"><?php echo $settingPreference_desc; ?></label><br>
              <?php } ?>
            <select  required required="true" id="00N2G00000ChccM" name="00N2G00000ChccM" title="Setting Preference" class="medium gfield_select">
              <option value="">Please Select</option>
              <option  value="In-person only">In-person</option>
              <option  value="Virtual only">Virtual</option>
              
            </select  required="true" required>
          </li><br>
          <?php } ?>

          <!-- 

              School Preference

           -->

          <?php if( $show_school_preference == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label "><strong><?php echo $school_preference; ?></strong></label><br>
            <?php if( $school_preference_desc != '') { ?>
              <label class="gfield_label " ><?php echo $school_preference_desc; ?></label><br>
            <?php } ?>
            <textarea  id="00N6A00000MU3xQ" class="medium gfield_select" name="00N6A00000MU3xQ" type="text" wrap="soft"></textarea>
          </li><br>
          <?php } ?>



          <!-- 

              Schools

           -->

          <?php if( $show_time_location == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label"><strong><?php echo $timeLocation; ?></strong></label><br>
            <?php if($timeLocationDesc != '') { ?>
                <label class="gfield_label"><?php echo $timeLocationDesc; ?></label><br>
              <?php } ?>
              <div class="checkboxes schools" id="checkboxes">
                <style type="text/css">
                  /*#checkboxes label {
                      display: none;
                  }*/
                  .region {
                    min-width: 40%;
                    padding: 20px;
                    margin-right: 10px;
                    display: none;
                  }
                  .region h4 {
                    margin-bottom: 15px;
                    font-weight: bold;
                    font-size: 22px;
                  }
                </style>

                  <?php 
                  // $get = get_field('schools', 70);
                  // echo '<pre>';
                  // print_r($get);
                  // echo '</pre>';

                  // $get = get_field('regions', 70);
                  //   echo '<pre>';
                  //   print_r($get);
                  //   echo '</pre>';

                  if(have_rows('regions', 70)) : while(have_rows('regions', 70)) : the_row(); 

                    

                        $rTitle = get_sub_field('r_name');
                        $r_schools = get_sub_field('r_schools');
                        if( $rTitle == 'Virtual' ) {
                          $format = 'Virtual';
                        } else {
                          $format = 'In-person';
                        }
                        

                         ?>
                          <div id="region" class="region" data-format="<?php echo $format; ?>">
                            <h4><?php echo $rTitle; ?></h4>
                          <?php 
                          foreach( $r_schools as $rs ) { 
                            $sName = $rs['r_name'];
                            $fieldID = $rs['r_id'];
                            $show = $rs['r_show'];
                            $format = $rs['r_format'];
                            if( $format == "inperson") {
                              $format = 'In-person';
                            }
                            if( $format == "virtual") {
                              $format = 'Virtual';
                            }
                            if( $show == 'Yes' ) {
                              echo '<div class="item school "><label>';
                              echo '<input data-format="'.$format.'" id="'.$fieldID.'" name="'.$fieldID.'" type="checkbox" value="1">'.$sName;
                              echo '</label></div>';
                            }
                          } ?>
                          </div>
                        
                        <?php

                  endwhile; 
                  endif;


                  // if(have_rows('schools', 70)) : while(have_rows('schools', 70)) : the_row(); 
                            
                  //       $sName = get_sub_field('name');
                  //       $fieldID = get_sub_field('id');
                  //       $show = get_sub_field('show');
                  //       $format = get_sub_field('format');
                  //       if( $format == "inperson") {
                  //         $format = 'In-person';
                  //       }
                  //       if( $format == "virtual") {
                  //         $format = 'Virtual';
                  //       }

                  //       if( $show == 'Yes' ) {
                  //         echo '<div class="item school "><label>';
                  //         echo '<input data-format="'.$format.'" id="'.$fieldID.'" name="'.$fieldID.'" type="checkbox" value="1">'.$sName;
                  //         echo '</label></div>';
                  //       }


                  //     endwhile; 
                  //     endif;
                  ?>

            </div>
          </li><br>
          <?php } ?>




           
          <!-- 

          Other Preferences
          
           -->
          <?php if( $show_other_preferences == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label "><strong><?php echo $other_preferences; ?></strong></label><br>
            <?php if( $other_preferences_desc != '') { ?>
              <label class="gfield_label " ><?php echo $other_preferences_desc; ?></label><br>
            <?php } ?>
            <textarea id="00N6A00000MTxGr" name="00N6A00000MTxGr" rows="3" wrap="soft" class="medium" ></textarea>
          </li><br>
          <?php } ?>
          

         


           <!-- 

          Orientation Selection
          
           -->
          <?php if( $show_orientation_selection == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label "><strong><?php echo $orientation_selection; ?></strong></label><br>
            <?php if( $orientation_selection_desc != '') { ?>
              <label class="gfield_label " ><?php echo $orientation_selection_desc; ?></label><br>
            <?php } ?>
            <textarea  id="00N2G00000CArmJ" name="00N2G00000CArmJ" rows="3" type="text" wrap="soft" class="medium" required="true" required ></textarea>
          </li><br>
          <?php } ?>



           

           
          

          

          <?php // honeypot ?>
          <div style="position:absolute; left:-9999px; top: -9999px;">
            <label for="pardot_extra_field">Comments</label>
            <input type="text" id="pardot_extra_field" name="pardot_extra_field" />
          </div><br>
          <?php // honeypot ?>

           <!-- 

          How did you hear??
          
           -->

          <?php if( $show_hear == 'Yes') { ?>
          <li class="gfield">
            <label class="gfield_label"><strong><?php echo $how_did_you_hear; ?></strong></label><br>
            <?php if( $how_did_you_hear_desc != '') { ?>
              <label class="gfield_label " ><?php echo $how_did_you_hear_desc; ?></label><br>
            <?php } ?>
            <select required required="true" class="medium gfield_select" id="00N6A00000MTsDm" title="How Did You Hear About Heart?" name="00N6A00000MTsDm">
              <option value="">--None--</option>
              <option value="Returning Tutor">I am a returning Heart tutor</option>
              <option value="Other">Other</option>
            </select  required="true" required>
          </li>
          <br>
          <br>
          <br>
          <?php } ?>

          <?php if( $show_speak_spanish == 'Yes') { ?>
          <li class="gfield">
          <label class="gfield_label"><strong><?php echo $speak_spanish_desc; ?></strong></label>
            <input  id="00N2G00000C7uS8" name="00N2G00000C7uS8" type="checkbox" value="1" /><br>
          </li><br><br>
         <?php } ?>

          <!-- 

          How did you hear?? Other
          
           -->

          <?php if( $show_hear_other == 'Yes') { ?>
          <li  class="gfield toggle" style="display: none;">
            <label class="gfield_label"><strong><?php echo $how_did_you_hear_hidden; ?></strong></label><br>
            <?php if( $how_did_you_hear_hidden_desc != '') { ?>
              <label class="gfield_label " ><?php echo $how_did_you_hear_hidden_desc; ?></label><br>
            <?php } ?>
            <textarea class="textarea medium" id="00N6A00000Mk09D" name="00N6A00000Mk09D" rows="3" wrap="soft"></textarea>
          </li>
          <?php } ?>


          

          <!-- 

          DOB Try to make required not working?
          
           -->

          <?php if( $show_dob == 'Yes') { ?>
            <li class="gfield">
              
              <label class="gfield_label"><strong><?php echo $dob_label; ?></strong></label><br>
              <?php if( $dob_desc != '') { ?>
                <label class="gfield_label " ><?php echo $dob_desc; ?></label><br>
              <?php } ?>
              <input value="" id="00N2G00000ChRfC" name="00N2G00000ChRfC" size="12" type="text" required="true" required />
              <span>Please use the format MM/DD/YYYY</span>
            </li>
            <br>
            <br>
          <?php } ?>


          <!-- 

          Resident
          
           -->

          <?php if( $show_resi == 'Yes') { ?>
            <li class="gfield">
              
              <label class="gfield_label"><strong><?php echo $resi_label; ?></strong></label><br>
              <?php if( $resi_desc != '') { ?>
                <label class="gfield_label " ><?php echo $resi_desc; ?></label><br>
              <?php } ?>
              <input  id="00N2G00000Cd9w2" name="00N2G00000Cd9w2" type="checkbox" value="1" /> I am a resident of North or South Carolina.
            </li>
            <br>
            <br>
          <?php } ?>


          <!-- 

          Internet Confirmation
          
           -->

          <?php if( $show_internet == 'Yes') { ?>
            <li class="gfield">
              
              <label class="gfield_label"><strong><?php echo $internet_label; ?></strong></label>
              <?php if( $internet_desc != '') { ?>
                <label class="gfield_label " ><strong><?php echo $internet_desc; ?></strong></label><br>
              <?php } ?>
              <input  id="00N2G00000Cd9wC" name="00N2G00000Cd9wC" type="checkbox" value="1"  /> I have both device and internet access
            </li>
          <?php } ?>




          
          <div class="g-recaptcha" data-sitekey="6LdIzNEUAAAAAJPp55-3Bve0vGcrmK3KtN6uel8t" data-callback="enableBtn"></div>
        <!-- <div class="g-recaptcha" data-sitekey="6LebCuwaAAAAALZ4hG93-DU29pd-7mvH2J3a2SOT" data-callback="enableBtn"></div> -->
          
       


          <input name="submit" type="submit" class="heart-submit " id="btnSubmit" />

          
        </ul>
      </div>
      </form>

      <script>
        $("#btnSubmit").attr("disabled", true);
        function enableBtn(){
          document.getElementById("btnSubmit").disabled = false;
        }

/*

        Require the Explanation field if the "ohter was chosen"

*/
        $('select[name=00N6A00000MTsDm]').change(function () {
            if ($(this).val() == 'Other') {
                // $('#provinceselect').show();
                $('#00N6A00000Mk09D').prop('required',true);
            } else {
                $('#00N6A00000Mk09D').prop('required',false);
                // $('#provinceselect').hide();
            }
        });



        
        document.getElementById('00N2G00000ChccM').addEventListener('change', function() {
             // Get the selected option's value and normalize it
            var selectedType = this.value.split(' ')[0]; // Extracts "virtual" or "in-person" from the option value
            console.log(selectedType);

            // Hide all checkboxes initially
            // var checkboxes = document.querySelectorAll('#checkboxes input[type="checkbox"]');
            var checkboxes = document.querySelectorAll('.region');
            checkboxes.forEach(function(checkbox) {
                // checkbox.parentNode.style.display = 'none';  // Hide the parent label
                checkbox.style.display = 'none';  // Hide the parent label
            });

            // Display checkboxes that match the selected type
            checkboxes.forEach(function(checkbox) {
                if (checkbox.dataset.format === selectedType) {
                    // checkbox.parentNode.style.display = 'block';
                    checkbox.style.display = 'block';
                }
            });
        });



    // function recaptchaCallback() {
    //     var btnSubmit = document.getElementById("btnSubmit");

    //     if ( btnSubmit.classList.contains("hidden") ) {
    //         btnSubmit.classList.remove("hidden");
    //         btnSubmitclassList.add("show");
    //     }
    // }
</script>
<?php if( $show_time_location == 'Yes') { ?>
  <script type="text/javascript">
      // Make required checkboxes for submit btn
    $('#btnSubmit').click(function() {
        checked = $(".school input[type=checkbox]:checked").length;

        if(!checked) {
          alert("You must check at least one prefered location.");
          return false;
        }

      });
  </script>
<?php } ?>
  </div>
</div>
