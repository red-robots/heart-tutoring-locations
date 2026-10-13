<?php
/**
 * Volunteer sign-up experience: Charlotte (see inc/volunteer-signup.php).
 *
 * The stepped version of inc/salesforce.php. Labels, descriptions, show/hide
 * switches and the school list come from the same ACF fields (page 70), and
 * every input keeps the Salesforce field name the classic form uses, so
 * nothing changes on the Salesforce side.
 *
 * Markup the script relies on:
 *  .vsx-step            one screen; data-title is the step name in the progress bar
 *  .vsx-field           one question; data-label is its name on the review step
 *  data-require-one     the field needs at least one box ticked (value is the message)
 *  data-when-name/value only shown while that radio group has that value
 *  data-format          a school region, shown for the matching format preference
 *
 * @package bellaworks
 */

$f = function ( $key ) {
	return get_field( $key, 70 );
};
$show = function ( $key ) use ( $f ) {
	return 'Yes' === $f( $key );
};

$email = bellaworks_vsx_split_label( $f( 'email' ) );

// The classic form explains how to ctrl-click a multi-select; the day chips don't need it.
$days_desc = preg_replace( '/\s*\(To select multiple[^)]*\)/i', '', (string) $f( 'days_desc' ) );

$has_format = $show( 'show_setting_preference' );
?>

<div class="vsx" id="vsx">

	<div class="vsx-progress" id="vsx-progress" hidden>
		<ol class="vsx-progress-list"></ol>
		<div class="vsx-progress-mobile">
			<span class="vsx-progress-count"></span>
			<span class="vsx-progress-name"></span>
		</div>
		<div class="vsx-progress-bar" aria-hidden="true"><span></span></div>
	</div>

	<form class="vsx-form" id="vsx-form" action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
		<input type="hidden" name="oid" value="00D6A000001iTWP">
		<input type="hidden" name="retURL" value="http://hearttutoring.org/thank-you/">
		<input type="hidden" name="00N2G00000C7uNN" value="Charlotte">

		<?php // honeypot ?>
		<div class="vsx-pot" aria-hidden="true">
			<label for="pardot_extra_field">Comments</label>
			<input type="text" id="pardot_extra_field" name="pardot_extra_field" tabindex="-1" autocomplete="off">
		</div>

		<!-- Step: About you -->
		<fieldset class="vsx-step" data-title="About you">
			<legend class="vsx-step-title">Tell us about you</legend>
			<p class="vsx-step-lede">We'll use this to get in touch about orientation and scheduling.</p>

			<div class="vsx-grid">
				<?php if ( $show( 'show_first_name' ) ) : ?>
				<div class="vsx-field" data-label="First name">
					<label class="vsx-label" for="first_name"><?php echo esc_html( $f( 'first_name' ) ); ?></label>
					<input class="vsx-input" id="first_name" name="first_name" type="text" maxlength="40" autocomplete="given-name" required>
				</div>
				<?php endif; ?>

				<?php if ( $show( 'show_last_name' ) ) : ?>
				<div class="vsx-field" data-label="Last name">
					<label class="vsx-label" for="last_name"><?php echo esc_html( $f( 'last_name' ) ); ?></label>
					<input class="vsx-input" id="last_name" name="last_name" type="text" maxlength="80" autocomplete="family-name" required>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( $show( 'show_email' ) ) : ?>
			<div class="vsx-field" data-label="Email">
				<label class="vsx-label" for="email"><?php echo esc_html( $email['label'] ); ?></label>
				<?php echo bellaworks_vsx_hint( $email['hint'] ); ?>
				<input class="vsx-input" id="email" name="email" type="email" maxlength="80" autocomplete="email" required>
			</div>
			<?php endif; ?>

			<div class="vsx-grid">
				<?php if ( $show( 'show_email_second' ) ) : ?>
				<div class="vsx-field" data-label="Alternate email">
					<label class="vsx-label" for="00N2G00000CheFA"><?php echo esc_html( $f( 'email_second' ) ); ?></label>
					<input class="vsx-input" id="00N2G00000CheFA" name="00N2G00000CheFA" type="email" maxlength="80">
				</div>
				<?php endif; ?>

				<?php if ( $show( 'show_phone' ) ) : ?>
				<div class="vsx-field" data-label="Phone">
					<label class="vsx-label" for="00N2G00000ChccW"><?php echo esc_html( $f( 'phone' ) ); ?></label>
					<input class="vsx-input" id="00N2G00000ChccW" name="00N2G00000ChccW" type="tel" maxlength="40" autocomplete="tel" data-vsx="phone" required>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( $show( 'show_dob' ) ) : ?>
			<div class="vsx-field" data-label="Birthdate">
				<label class="vsx-label" for="00N2G00000ChRfC"><?php echo esc_html( rtrim( (string) $f( 'dob' ), ': ' ) ); ?></label>
				<?php echo bellaworks_vsx_hint( $f( 'dob_desc' ) ); ?>
				<input class="vsx-input vsx-input--short" id="00N2G00000ChRfC" name="00N2G00000ChRfC" type="text" inputmode="numeric" maxlength="10" placeholder="MM/DD/YYYY" autocomplete="bday" data-vsx="dob" required>
			</div>
			<?php endif; ?>
		</fieldset>

		<!-- Step: Availability -->
		<?php if ( $show( 'show_time' ) || $show( 'show_days' ) || $show( 'show_gen_avail' ) ) : ?>
		<fieldset class="vsx-step" data-title="Availability">
			<legend class="vsx-step-title">When can you tutor?</legend>

			<?php if ( $show( 'show_time' ) ) : ?>
			<div class="vsx-field" data-label="Time commitment">
				<div class="vsx-label"><?php echo esc_html( $f( 'time_commitment' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $f( 'time_commitment_desc' ) ); ?>
				<?php
				bellaworks_vsx_choices( '00N6A00000MTg6j', array(
					'1 hour once per week (two sessions)'      => array( '1 hour, once a week', 'Two 30-minute sessions' ),
					'30 minutes once per week (one session)'   => array( '30 minutes, once a week', 'One session' ),
					'30 minutes twice per week (two sessions)' => array( '30 minutes, twice a week', 'Two sessions' ),
					'1 hour twice per week (four sessions)'    => array( '1 hour, twice a week', 'Four sessions' ),
					'Other'                                    => array( 'Other', 'Tell us what works' ),
				), array( 'required' => true ) );
				?>
			</div>

			<?php if ( $show( 'show_time_other' ) ) : ?>
			<div class="vsx-field" data-label="Time commitment (other)" data-when-name="00N6A00000MTg6j" data-when-value="Other">
				<label class="vsx-label" for="00N6A00000MTsDX"><?php echo esc_html( $f( 'time_commitment_other' ) ); ?></label>
				<?php echo bellaworks_vsx_hint( $f( 'time_commitment_other_desc' ) ); ?>
				<input class="vsx-input" id="00N6A00000MTsDX" name="00N6A00000MTsDX" type="text" maxlength="255">
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<?php if ( $show( 'show_gen_avail' ) ) : ?>
			<div class="vsx-field" data-label="General availability" data-require-one="Choose at least one time of day." data-exclusive="No Preference">
				<div class="vsx-label"><?php echo esc_html( $f( 'gen_availability' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $f( 'gen_availability_desc' ) ); ?>
				<?php
				bellaworks_vsx_choices( '00N6A00000Mikyd', array(
					'Early morning'              => 'Early morning',
					'Mid-Morning'                => 'Mid-morning',
					'Lunch Time/Early Afternoon' => 'Lunch time / early afternoon',
					'Late Afternoon'             => 'Late afternoon',
					'No Preference'              => 'No preference',
				), array( 'type' => 'checkbox', 'style' => 'chips' ) );
				?>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_days' ) ) : ?>
			<div class="vsx-field" data-label="Tutoring days" data-require-one="Choose at least one day." data-exclusive="No Preference">
				<div class="vsx-label"><?php echo esc_html( $f( 'days' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $days_desc ); ?>
				<?php
				bellaworks_vsx_choices( '00N6A00000MTg6K', array(
					'Monday'        => 'Monday',
					'Tuesday'       => 'Tuesday',
					'Wednesday'     => 'Wednesday',
					'Thursday'      => 'Thursday',
					'Friday'        => 'Friday',
					'No Preference' => 'No preference',
				), array( 'type' => 'checkbox', 'style' => 'chips' ) );
				?>
			</div>
			<?php endif; ?>
		</fieldset>
		<?php endif; ?>

		<!-- Step: Where -->
		<?php if ( $has_format || $show( 'show_time_location' ) || $show( 'show_school_preference' ) || $show( 'show_other_preferences' ) ) : ?>
		<fieldset class="vsx-step" data-title="Schools">
			<legend class="vsx-step-title">Where would you like to tutor?</legend>

			<?php if ( $has_format ) : ?>
			<div class="vsx-field" data-label="Program format">
				<div class="vsx-label"><?php echo esc_html( $f( 'setting_preference' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $f( 'setting_desc' ) ); ?>
				<?php
				bellaworks_vsx_choices( '00N2G00000ChccM', array(
					'In-person only' => array( 'In-person', 'At a partner school' ),
					'Virtual only'   => array( 'Virtual', 'Online, by video' ),
				), array( 'required' => true ) );
				?>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_school_preference' ) ) : ?>
			<div class="vsx-field" data-label="School preferences">
				<label class="vsx-label" for="00N6A00000MU3xQ"><?php echo esc_html( $f( 'school_preference' ) ); ?></label>
				<?php echo bellaworks_vsx_hint( $f( 'school_preference_desc' ) ); ?>
				<textarea class="vsx-input" id="00N6A00000MU3xQ" name="00N6A00000MU3xQ" rows="3"></textarea>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_time_location' ) ) : ?>
			<div class="vsx-field vsx-field--schools" data-label="Times &amp; locations" data-require-one="Choose at least one school and time.">
				<div class="vsx-label"><?php echo wp_kses_post( $f( 'times_&_locations' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $f( 'times_&_locations_desc' ) ); ?>

				<?php if ( $has_format ) : ?>
				<p class="vsx-empty" id="vsx-schools-empty">Choose a format above to see the schools and times.</p>
				<?php endif; ?>

				<div class="vsx-regions"<?php echo $has_format ? ' data-format-name="00N2G00000ChccM"' : ''; ?>>
					<?php
					if ( have_rows( 'regions', 70 ) ) :
						while ( have_rows( 'regions', 70 ) ) :
							the_row();
							$region_name = get_sub_field( 'r_name' );
							$rows        = get_sub_field( 'r_schools' );
							// Same rule as the classic form: the Virtual region shows for virtual, every other region for in-person.
							$region_format = ( 'Virtual' === $region_name ) ? 'Virtual' : 'In-person';

							// Group the "School - time" rows so each school lists its times together.
							$schools = array();
							foreach ( (array) $rows as $row ) {
								if ( 'Yes' !== ( $row['r_show'] ?? '' ) || empty( $row['r_id'] ) ) {
									continue;
								}
								$parts  = explode( ' - ', (string) $row['r_name'], 2 );
								$school = trim( $parts[0] );
								$schools[ $school ][] = array(
									'id'   => $row['r_id'],
									'time' => isset( $parts[1] ) ? trim( $parts[1] ) : 'Any time',
									'full' => $row['r_name'],
								);
							}
							if ( ! $schools ) {
								continue;
							}
							?>
							<div class="vsx-region" data-format="<?php echo esc_attr( $region_format ); ?>">
								<h4 class="vsx-region-title"><?php echo esc_html( $region_name ); ?></h4>
								<?php foreach ( $schools as $school => $slots ) : ?>
								<div class="vsx-school">
									<div class="vsx-school-name"><?php echo esc_html( $school ); ?></div>
									<div class="vsx-choices vsx-choices--chips">
										<?php foreach ( $slots as $slot ) : ?>
										<label class="vsx-choice">
											<input type="checkbox" name="<?php echo esc_attr( $slot['id'] ); ?>" value="1" data-summary="<?php echo esc_attr( $slot['full'] ); ?>">
											<span class="vsx-choice-body"><span class="vsx-choice-label"><?php echo esc_html( $slot['time'] ); ?></span></span>
										</label>
										<?php endforeach; ?>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							<?php
						endwhile;
					endif;
					?>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_internet' ) ) : ?>
			<div class="vsx-field" data-label="Device and internet access"<?php echo $has_format ? ' data-when-name="00N2G00000ChccM" data-when-value="Virtual only"' : ''; ?>>
				<?php if ( $f( 'internet_label' ) ) : ?>
				<div class="vsx-label"><?php echo esc_html( $f( 'internet_label' ) ); ?></div>
				<?php endif; ?>
				<?php echo bellaworks_vsx_hint( $f( 'internet_desc' ) ); ?>
				<label class="vsx-check">
					<input id="00N2G00000Cd9wC" name="00N2G00000Cd9wC" type="checkbox" value="1">
					<span>I have both device and internet access</span>
				</label>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_other_preferences' ) ) : ?>
			<div class="vsx-field" data-label="Other preferences">
				<label class="vsx-label" for="00N6A00000MTxGr"><?php echo esc_html( $f( 'other_preferences' ) ); ?> <span class="vsx-optional">optional</span></label>
				<?php echo bellaworks_vsx_hint( $f( 'other_preferences_desc' ) ); ?>
				<textarea class="vsx-input" id="00N6A00000MTxGr" name="00N6A00000MTxGr" rows="3"></textarea>
			</div>
			<?php endif; ?>
		</fieldset>
		<?php endif; ?>

		<!-- Step: A few more things -->
		<?php if ( $show( 'show_hear' ) || $show( 'show_speak_spanish' ) || $show( 'show_resi' ) || $show( 'show_orientation_selection' ) ) : ?>
		<fieldset class="vsx-step" data-title="Last details">
			<legend class="vsx-step-title">A few last details</legend>

			<?php if ( $show( 'show_orientation_selection' ) ) : ?>
			<div class="vsx-field" data-label="Orientation">
				<label class="vsx-label" for="00N2G00000CArmJ"><?php echo esc_html( $f( 'orientation_selection' ) ); ?></label>
				<?php echo bellaworks_vsx_hint( $f( 'orientation_selection_desc' ) ); ?>
				<textarea class="vsx-input" id="00N2G00000CArmJ" name="00N2G00000CArmJ" rows="3" required></textarea>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_hear' ) ) : ?>
			<div class="vsx-field" data-label="How you heard about Heart">
				<div class="vsx-label"><?php echo esc_html( $f( 'how_did_you_hear' ) ); ?></div>
				<?php echo bellaworks_vsx_hint( $f( 'how_did_you_hear_desc' ) ); ?>
				<?php
				bellaworks_vsx_choices( '00N6A00000MTsDm', array(
					'Returning Tutor' => 'I am a returning Heart tutor',
					'Other'           => 'Other',
				), array( 'required' => true ) );
				?>
			</div>

			<?php if ( $show( 'show_hear_other' ) ) : ?>
			<div class="vsx-field" data-label="How you heard (details)" data-when-name="00N6A00000MTsDm" data-when-value="Other">
				<label class="vsx-label" for="00N6A00000Mk09D"><?php echo esc_html( $f( 'how_did_you_hear_hidden' ) ); ?></label>
				<?php echo bellaworks_vsx_hint( $f( 'how_did_you_hear_hidden_desc' ) ); ?>
				<textarea class="vsx-input" id="00N6A00000Mk09D" name="00N6A00000Mk09D" rows="3" required></textarea>
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<?php if ( $show( 'show_speak_spanish' ) ) : ?>
			<div class="vsx-field" data-label="Spanish speaker">
				<?php echo bellaworks_vsx_hint( $f( 'speak_spanish_desc' ) ); ?>
				<label class="vsx-check">
					<input id="00N2G00000C7uS8" name="00N2G00000C7uS8" type="checkbox" value="1">
					<span>Yes, I speak Spanish fluently</span>
				</label>
			</div>
			<?php endif; ?>

			<?php if ( $show( 'show_resi' ) ) : ?>
			<div class="vsx-field" data-label="NC or SC resident">
				<?php if ( $f( 'resi_label' ) ) : ?>
				<div class="vsx-label"><?php echo esc_html( $f( 'resi_label' ) ); ?></div>
				<?php endif; ?>
				<?php echo bellaworks_vsx_hint( $f( 'resi_desc' ) ); ?>
				<label class="vsx-check">
					<input id="00N2G00000Cd9w2" name="00N2G00000Cd9w2" type="checkbox" value="1">
					<span>I am a resident of North or South Carolina.</span>
				</label>
			</div>
			<?php endif; ?>
		</fieldset>
		<?php endif; ?>

		<!-- Step: Review -->
		<fieldset class="vsx-step vsx-step--review" data-title="Review">
			<legend class="vsx-step-title">Look it over and send</legend>
			<p class="vsx-step-lede vsx-js-only">Make sure everything looks right. You can go back and change anything.</p>
			<div class="vsx-review" id="vsx-review"></div>

			<div class="vsx-captcha">
				<div class="g-recaptcha" data-sitekey="6LdIzNEUAAAAAJPp55-3Bve0vGcrmK3KtN6uel8t" data-callback="vsxCaptchaOk" data-expired-callback="vsxCaptchaExpired"></div>
			</div>
			<p class="vsx-error" id="vsx-submit-error" role="alert" hidden></p>
		</fieldset>

		<div class="vsx-nav">
			<button type="button" class="vsx-back" id="vsx-back" hidden>&larr; Back</button>
			<button type="button" class="vsx-btn" id="vsx-next" hidden>Continue <span aria-hidden="true">&rarr;</span></button>
			<button type="submit" class="vsx-btn vsx-btn--submit" id="vsx-submit">Submit interest form</button>
		</div>
	</form>

	<div class="vsx-dry" id="vsx-dry" hidden>
		<h3 class="vsx-step-title">Test run: nothing was sent</h3>
		<p class="vsx-step-lede">This is what Salesforce would have received.</p>
		<table class="vsx-dry-table"><tbody></tbody></table>
	</div>
</div>
