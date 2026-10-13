<?php
/**
 * Volunteer sign-up experience.
 *
 * A stepped version of the Salesforce Web-to-Lead interest form on a city
 * page. Salesforce still receives exactly the same field names and values as
 * the classic form (inc/salesforce*.php); only the presentation changes.
 * assets/volunteer-signup/volunteer-signup.js walks the visitor through the
 * steps, and without JavaScript the steps simply stack into one long form.
 *
 * Each city page gets an entry in bellaworks_vsx_pages() pointing at its
 * partial in inc/volunteer-signup/. A page without an entry renders the
 * classic form exactly as before.
 *
 * Switching it on:
 *  - 'enabled' => true turns it on for everyone.
 *  - ?regx=1 on the page URL previews it while 'enabled' is false.
 *  - ?regx=0 forces the classic form (handy for staff troubleshooting).
 *  - add &dry=1 to try the whole flow without sending anything to Salesforce;
 *    the last step lists what would have been sent instead.
 *
 * @package bellaworks
 */

/**
 * City pages that have a stepped form, keyed by page ID.
 *
 * @return array
 */
function bellaworks_vsx_pages() {
	return array(
		// Charlotte. Off for everyone until it's been tried on live with ?regx=1.
		14907 => array(
			'enabled' => false,
			'partial' => 'inc/volunteer-signup/charlotte',
		),
	);
}

/**
 * The stepped form config for the page being viewed, if it should run.
 *
 * @return array|null
 */
function bellaworks_vsx_current() {
	static $resolved = false, $current = null;
	if ( $resolved ) {
		return $current;
	}
	$resolved = true;

	if ( ! is_page() ) {
		return null;
	}

	$flag = isset( $_GET['regx'] ) ? sanitize_key( wp_unslash( $_GET['regx'] ) ) : '';
	if ( '0' === $flag ) {
		return null;
	}

	$pages = bellaworks_vsx_pages();
	$id    = get_queried_object_id();
	if ( empty( $pages[ $id ] ) ) {
		return null;
	}
	if ( empty( $pages[ $id ]['enabled'] ) && '1' !== $flag ) {
		return null;
	}

	$current = $pages[ $id ];
	return $current;
}

/**
 * Stylesheet and the step script.
 */
function bellaworks_vsx_scripts() {
	if ( ! bellaworks_vsx_current() ) {
		return;
	}

	$dir = get_template_directory() . '/assets/volunteer-signup';
	$uri = get_template_directory_uri() . '/assets/volunteer-signup';
	$ver = function ( $file ) use ( $dir ) {
		return file_exists( $dir . '/' . $file ) ? (string) filemtime( $dir . '/' . $file ) : '1.0';
	};

	wp_enqueue_style( 'bellaworks-vsx', $uri . '/volunteer-signup.css', array(), $ver( 'volunteer-signup.css' ) );
	wp_enqueue_script( 'bellaworks-vsx', $uri . '/volunteer-signup.js', array(), $ver( 'volunteer-signup.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'bellaworks_vsx_scripts', 20 );

/**
 * Split an ACF label like "Primary Email Address (We recommend ...)" into the
 * short label and the note in brackets, so long notes can sit under the label.
 *
 * @param string $label
 * @return array { label, hint }
 */
function bellaworks_vsx_split_label( $label ) {
	$label = trim( wp_strip_all_tags( (string) $label ) );
	if ( strlen( $label ) > 60 && preg_match( '/^(.+?)\s*\((.+)\)\s*$/s', $label, $m ) ) {
		return array( 'label' => trim( $m[1] ), 'hint' => trim( $m[2] ) );
	}
	return array( 'label' => rtrim( $label, ': ' ), 'hint' => '' );
}

/**
 * A field description, with any bare URLs made clickable.
 *
 * @param string $text
 * @return string
 */
function bellaworks_vsx_hint( $text ) {
	$text = trim( (string) $text );
	if ( '' === $text ) {
		return '';
	}
	return '<p class="vsx-hint">' . make_clickable( wp_kses_post( $text ) ) . '</p>';
}

/**
 * A set of radio or checkbox choices drawn as cards or chips.
 *
 * @param string $name    Salesforce field name.
 * @param array  $options value => label, or value => array( label, note ).
 * @param array  $args    type (radio|checkbox), style (cards|chips), required.
 */
function bellaworks_vsx_choices( $name, $options, $args = array() ) {
	$args = wp_parse_args( $args, array(
		'type'     => 'radio',
		'style'    => 'cards',
		'required' => false,
	) );
	$i = 0;
	echo '<div class="vsx-choices vsx-choices--' . esc_attr( $args['style'] ) . '">';
	foreach ( $options as $value => $label ) {
		$note = '';
		if ( is_array( $label ) ) {
			list( $label, $note ) = $label;
		}
		printf(
			'<label class="vsx-choice"><input type="%1$s" name="%2$s" value="%3$s"%4$s><span class="vsx-choice-body"><span class="vsx-choice-label">%5$s</span>%6$s</span></label>',
			esc_attr( $args['type'] ),
			esc_attr( $name ),
			esc_attr( $value ),
			( $args['required'] && 'radio' === $args['type'] && 0 === $i ) ? ' required' : '',
			esc_html( $label ),
			$note ? '<span class="vsx-choice-note">' . esc_html( $note ) . '</span>' : ''
		);
		$i++;
	}
	echo '</div>';
}
