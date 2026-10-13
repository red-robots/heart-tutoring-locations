/**
 * Volunteer sign-up experience (see inc/volunteer-signup.php).
 *
 * Walks the Salesforce Web-to-Lead interest form one step at a time. The form
 * still posts straight to Salesforce with the same field names; this script
 * only shows one .vsx-step at a time, checks each step before moving on,
 * builds the review screen and remembers answers for the browser tab.
 *
 * Fields that don't apply (a hidden "If other" box, schools for the other
 * format) are disabled so they are neither checked nor sent.
 */
( function () {
	'use strict';

	var root = document.getElementById( 'vsx' ),
		form = document.getElementById( 'vsx-form' );
	if ( ! root || ! form ) {
		return;
	}

	var steps = Array.prototype.slice.call( form.querySelectorAll( '.vsx-step' ) ),
		last = steps.length - 1,
		idx = 0,
		reached = 0,
		captchaOk = false,
		dry = /[?&]dry=1(&|$)/.test( window.location.search ),
		KEY = 'vsx-' + window.location.pathname;

	var el = {
		progress: document.getElementById( 'vsx-progress' ),
		list: root.querySelector( '.vsx-progress-list' ),
		count: root.querySelector( '.vsx-progress-count' ),
		name: root.querySelector( '.vsx-progress-name' ),
		bar: root.querySelector( '.vsx-progress-bar span' ),
		back: document.getElementById( 'vsx-back' ),
		next: document.getElementById( 'vsx-next' ),
		submit: document.getElementById( 'vsx-submit' ),
		review: document.getElementById( 'vsx-review' ),
		submitError: document.getElementById( 'vsx-submit-error' ),
		regions: root.querySelector( '.vsx-regions' ),
		schoolsEmpty: document.getElementById( 'vsx-schools-empty' ),
		dry: document.getElementById( 'vsx-dry' )
	};

	// ---------- small helpers ----------

	function all( sel, ctx ) {
		return Array.prototype.slice.call( ( ctx || form ).querySelectorAll( sel ) );
	}

	function checkedValue( name ) {
		var input = form.querySelector( 'input[name="' + name + '"]:checked' );
		return input ? input.value : '';
	}

	function controls( ctx ) {
		return all( 'input, select, textarea', ctx ).filter( function ( c ) {
			return c.type !== 'hidden' && ! c.closest( '.vsx-pot' ) && ! c.closest( '.g-recaptcha' );
		} );
	}

	function setEnabled( ctx, on ) {
		controls( ctx ).forEach( function ( c ) {
			c.disabled = ! on;
			if ( ! on && ( c.type === 'checkbox' || c.type === 'radio' ) ) {
				c.checked = false;
			}
		} );
	}

	function choiceText( input ) {
		if ( input.getAttribute( 'data-summary' ) ) {
			return input.getAttribute( 'data-summary' );
		}
		var label = input.closest( 'label' ),
			text = label ? label.querySelector( '.vsx-choice-label' ) : null;
		return ( text || label || input ).textContent.replace( /\s+/g, ' ' ).trim();
	}

	// ---------- fields that depend on other answers ----------

	function applyConditions( force ) {
		all( '[data-when-name]' ).forEach( function ( field ) {
			var on = checkedValue( field.getAttribute( 'data-when-name' ) ) === field.getAttribute( 'data-when-value' );
			if ( force || field.hidden === on ) {
				setEnabled( field, on );
			}
			field.hidden = ! on;
		} );

		if ( ! el.regions ) {
			return;
		}
		var formatName = el.regions.getAttribute( 'data-format-name' ),
			format = formatName ? checkedValue( formatName ) : '';
		all( '.vsx-region', el.regions ).forEach( function ( region ) {
			// "In-person only" matches the In-person regions, "Virtual only" the Virtual one.
			var on = ! formatName || ( format !== '' && format.indexOf( region.getAttribute( 'data-format' ) ) === 0 );
			if ( force || region.hidden === on ) {
				setEnabled( region, on );
			}
			region.hidden = ! on;
		} );
		if ( el.schoolsEmpty ) {
			el.schoolsEmpty.hidden = ! formatName || format !== '';
		}
	}

	// "No preference" clears the other chips, and picking a chip clears "No preference".
	function applyExclusive( input ) {
		var field = input.closest( '[data-exclusive]' );
		if ( ! field || input.type !== 'checkbox' || ! input.checked ) {
			return;
		}
		var value = field.getAttribute( 'data-exclusive' );
		all( 'input[type="checkbox"]', field ).forEach( function ( other ) {
			if ( other !== input && ( input.value === value || other.value === value ) ) {
				other.checked = false;
			}
		} );
	}

	// ---------- validation ----------

	function parseDob( value ) {
		var m = value.match( /^(\d{2})\/(\d{2})\/(\d{4})$/ );
		if ( ! m ) {
			return null;
		}
		var date = new Date( +m[3], +m[1] - 1, +m[2] );
		if ( date.getFullYear() !== +m[3] || date.getMonth() !== +m[1] - 1 || date.getDate() !== +m[2] ) {
			return null;
		}
		return date;
	}

	function fieldProblem( field ) {
		var inputs = controls( field ).filter( function ( c ) { return ! c.disabled; } ),
			i, c, value;

		if ( field.hasAttribute( 'data-require-one' ) ) {
			if ( ! inputs.some( function ( c ) { return c.checked; } ) ) {
				return field.getAttribute( 'data-require-one' );
			}
			return '';
		}

		for ( i = 0; i < inputs.length; i++ ) {
			c = inputs[ i ];
			value = c.value.trim();

			if ( c.type === 'radio' ) {
				if ( c.required && ! checkedValue( c.name ) ) {
					return 'Please choose one.';
				}
				continue;
			}
			if ( c.type === 'checkbox' ) {
				if ( c.required && ! c.checked ) {
					return 'Please check the box to continue.';
				}
				continue;
			}
			if ( c.required && value === '' ) {
				return 'This one is required.';
			}
			if ( value === '' ) {
				continue;
			}
			if ( c.type === 'email' && ! /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test( value ) ) {
				return 'That email address doesn\'t look right.';
			}
			if ( c.getAttribute( 'data-vsx' ) === 'phone' && value.replace( /\D/g, '' ).length < 10 ) {
				return 'Please enter a 10-digit phone number.';
			}
			if ( c.getAttribute( 'data-vsx' ) === 'dob' ) {
				var dob = parseDob( value ), now = new Date();
				if ( ! dob || dob > now || dob.getFullYear() < 1900 ) {
					return 'Please use the format MM/DD/YYYY.';
				}
				var eighteenth = new Date( dob.getFullYear() + 18, dob.getMonth(), dob.getDate() );
				if ( eighteenth > now ) {
					return 'Volunteers must be at least 18 years old.';
				}
			}
		}
		return '';
	}

	function setError( field, message ) {
		var box = field.querySelector( '.vsx-error' );
		if ( ! message ) {
			field.classList.remove( 'vsx-field--error' );
			if ( box ) {
				box.hidden = true;
			}
			return;
		}
		if ( ! box ) {
			box = document.createElement( 'p' );
			box.className = 'vsx-error';
			box.setAttribute( 'role', 'alert' );
			field.appendChild( box );
		}
		box.textContent = message;
		box.hidden = false;
		field.classList.add( 'vsx-field--error' );
	}

	// Returns the first field with a problem, or null when the step is fine.
	function validateStep( step ) {
		var first = null;
		all( '.vsx-field', step ).forEach( function ( field ) {
			if ( field.hidden ) {
				return;
			}
			var message = fieldProblem( field );
			setError( field, message );
			if ( message && ! first ) {
				first = field;
			}
		} );
		return first;
	}

	function focusField( field ) {
		var target = controls( field ).filter( function ( c ) { return ! c.disabled; } )[0];
		if ( target ) {
			target.focus( { preventScroll: true } );
		}
		field.scrollIntoView( { block: 'center', behavior: 'smooth' } );
	}

	// ---------- remembering answers for this tab ----------

	function save() {
		var data = { step: idx, reached: reached, values: {} };
		controls().forEach( function ( c ) {
			if ( ! c.name ) {
				return;
			}
			if ( c.type === 'checkbox' || c.type === 'radio' ) {
				if ( c.checked ) {
					( data.values[ c.name ] = data.values[ c.name ] || [] ).push( c.value );
				}
			} else if ( c.value !== '' ) {
				data.values[ c.name ] = c.value;
			}
		} );
		try { window.sessionStorage.setItem( KEY, JSON.stringify( data ) ); } catch ( e ) {}
	}

	function restore() {
		var data;
		try { data = JSON.parse( window.sessionStorage.getItem( KEY ) ); } catch ( e ) {}
		if ( ! data || ! data.values ) {
			return;
		}
		controls().forEach( function ( c ) {
			var value = data.values[ c.name ];
			if ( value === undefined ) {
				return;
			}
			if ( c.type === 'checkbox' || c.type === 'radio' ) {
				c.checked = value.indexOf( c.value ) !== -1;
			} else {
				c.value = value;
			}
		} );
		reached = Math.min( parseInt( data.reached, 10 ) || 0, last );
		idx = Math.min( parseInt( data.step, 10 ) || 0, reached );
	}

	// ---------- progress ----------

	function buildProgress() {
		steps.forEach( function ( step, i ) {
			var li = document.createElement( 'li' ),
				btn = document.createElement( 'button' );
			btn.type = 'button';
			btn.className = 'vsx-progress-step';
			btn.innerHTML = '<span class="vsx-progress-dot"><span>' + ( i + 1 ) + '</span></span><span class="vsx-progress-label"></span>';
			btn.querySelector( '.vsx-progress-label' ).textContent = step.getAttribute( 'data-title' );
			btn.addEventListener( 'click', function () {
				if ( i < idx ) {
					go( i, true );
				} else if ( i > idx && i <= reached ) {
					advanceTo( i );
				}
			} );
			li.appendChild( btn );
			el.list.appendChild( li );
		} );
		el.progress.hidden = false;
	}

	function paintProgress() {
		all( '.vsx-progress-step', el.list ).forEach( function ( btn, i ) {
			var state = i < idx ? 'done' : ( i === idx ? 'current' : 'todo' );
			btn.setAttribute( 'data-state', state );
			btn.disabled = i > reached;
			if ( i === idx ) {
				btn.setAttribute( 'aria-current', 'step' );
			} else {
				btn.removeAttribute( 'aria-current' );
			}
		} );
		el.count.textContent = 'Step ' + ( idx + 1 ) + ' of ' + steps.length;
		el.name.textContent = steps[ idx ].getAttribute( 'data-title' );
		el.bar.style.width = ( ( idx + 1 ) / steps.length * 100 ) + '%';
	}

	// ---------- review ----------

	function fieldSummary( field ) {
		var inputs = controls( field ).filter( function ( c ) { return ! c.disabled; } ),
			picked = [];
		inputs.forEach( function ( c ) {
			if ( c.type === 'radio' ) {
				if ( c.checked ) {
					picked.push( choiceText( c ) );
				}
			} else if ( c.type === 'checkbox' ) {
				if ( c.checked ) {
					picked.push( c.closest( '.vsx-check' ) ? 'Yes' : choiceText( c ) );
				}
			} else if ( c.value.trim() !== '' ) {
				picked.push( c.value.trim() );
			}
		} );
		return picked;
	}

	function buildReview() {
		el.review.innerHTML = '';
		steps.forEach( function ( step, i ) {
			if ( i === last ) {
				return;
			}
			var rows = [];
			all( '.vsx-field', step ).forEach( function ( field ) {
				var values = field.hidden ? [] : fieldSummary( field );
				if ( values.length ) {
					rows.push( { label: field.getAttribute( 'data-label' ), values: values } );
				}
			} );
			if ( ! rows.length ) {
				return;
			}

			var section = document.createElement( 'section' ),
				head = document.createElement( 'div' ),
				title = document.createElement( 'h4' ),
				edit = document.createElement( 'button' ),
				dl = document.createElement( 'dl' );
			section.className = 'vsx-review-section';
			head.className = 'vsx-review-head';
			title.textContent = step.getAttribute( 'data-title' );
			edit.type = 'button';
			edit.className = 'vsx-review-edit';
			edit.textContent = 'Edit';
			edit.setAttribute( 'aria-label', 'Edit ' + step.getAttribute( 'data-title' ) );
			edit.addEventListener( 'click', function () { go( i, true ); } );
			head.appendChild( title );
			head.appendChild( edit );

			rows.forEach( function ( row ) {
				var dt = document.createElement( 'dt' ), dd = document.createElement( 'dd' );
				dt.textContent = row.label;
				if ( row.values.length > 1 ) {
					var ul = document.createElement( 'ul' );
					row.values.forEach( function ( value ) {
						var li = document.createElement( 'li' );
						li.textContent = value;
						ul.appendChild( li );
					} );
					dd.appendChild( ul );
				} else {
					dd.textContent = row.values[0];
				}
				dl.appendChild( dt );
				dl.appendChild( dd );
			} );

			section.appendChild( head );
			section.appendChild( dl );
			el.review.appendChild( section );
		} );
	}

	// ---------- moving between steps ----------

	function go( i, scroll ) {
		idx = Math.max( 0, Math.min( i, last ) );
		reached = Math.max( reached, idx );
		steps.forEach( function ( step, n ) {
			step.hidden = n !== idx;
		} );
		el.back.hidden = idx === 0;
		el.next.hidden = idx === last;
		el.submit.hidden = idx !== last;
		if ( idx === last ) {
			buildReview();
			paintSubmit();
		}
		paintProgress();
		save();
		if ( scroll ) {
			root.scrollIntoView( { block: 'start', behavior: 'smooth' } );
			var title = steps[ idx ].querySelector( '.vsx-step-title' );
			if ( title ) {
				title.setAttribute( 'tabindex', '-1' );
				title.focus( { preventScroll: true } );
			}
		}
	}

	// Move forward, stopping at the first step that still has a problem.
	function advanceTo( target ) {
		for ( var i = idx; i < target; i++ ) {
			var bad = validateStep( steps[ i ] );
			if ( bad ) {
				if ( i !== idx ) {
					go( i, false );
				}
				focusField( bad );
				return false;
			}
		}
		go( target, true );
		return true;
	}

	function paintSubmit() {
		el.submit.disabled = ! captchaOk && ! dry;
	}

	window.vsxCaptchaOk = function () {
		captchaOk = true;
		el.submitError.hidden = true;
		paintSubmit();
	};
	window.vsxCaptchaExpired = function () {
		captchaOk = false;
		paintSubmit();
	};

	function showDryRun() {
		var body = el.dry.querySelector( 'tbody' ), data = new FormData( form );
		body.innerHTML = '';
		data.forEach( function ( value, name ) {
			if ( name === 'g-recaptcha-response' ) {
				return;
			}
			var tr = document.createElement( 'tr' ), th = document.createElement( 'th' ), td = document.createElement( 'td' );
			th.textContent = name;
			td.textContent = value;
			tr.appendChild( th );
			tr.appendChild( td );
			body.appendChild( tr );
		} );
		el.dry.hidden = false;
		el.dry.scrollIntoView( { block: 'start', behavior: 'smooth' } );
	}

	// ---------- events ----------

	el.next.addEventListener( 'click', function () {
		advanceTo( idx + 1 );
	} );

	el.back.addEventListener( 'click', function () {
		go( idx - 1, true );
	} );

	form.addEventListener( 'change', function ( e ) {
		applyExclusive( e.target );
		applyConditions();
		var field = e.target.closest( '.vsx-field' );
		if ( field && field.classList.contains( 'vsx-field--error' ) ) {
			setError( field, fieldProblem( field ) );
		}
		save();
	} );

	form.addEventListener( 'input', function ( e ) {
		var c = e.target;
		if ( c.getAttribute && c.getAttribute( 'data-vsx' ) === 'dob' ) {
			var digits = c.value.replace( /\D/g, '' ).slice( 0, 8 ),
				out = digits.slice( 0, 2 );
			if ( digits.length > 2 ) {
				out += '/' + digits.slice( 2, 4 );
			}
			if ( digits.length > 4 ) {
				out += '/' + digits.slice( 4 );
			}
			// Leave the value alone while deleting, so backspace can cross a slash.
			if ( e.inputType !== 'deleteContentBackward' ) {
				c.value = out;
			}
		}
		save();
	} );

	// Enter in a text box moves on instead of submitting the whole form early.
	form.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Enter' && e.target.tagName === 'INPUT' && idx < last && e.target.type !== 'checkbox' && e.target.type !== 'radio' ) {
			e.preventDefault();
			advanceTo( idx + 1 );
		}
	} );

	form.addEventListener( 'submit', function ( e ) {
		if ( idx < last ) {
			e.preventDefault();
			advanceTo( idx + 1 );
			return;
		}
		// Check every step once more; anything changed since is caught here.
		for ( var i = 0; i < last; i++ ) {
			var bad = validateStep( steps[ i ] );
			if ( bad ) {
				e.preventDefault();
				go( i, false );
				focusField( bad );
				return;
			}
		}
		if ( dry ) {
			e.preventDefault();
			showDryRun();
			return;
		}
		if ( ! captchaOk ) {
			e.preventDefault();
			el.submitError.textContent = 'Please check the "I\'m not a robot" box.';
			el.submitError.hidden = false;
			return;
		}
		try { window.sessionStorage.removeItem( KEY ); } catch ( err ) {}
		el.submit.textContent = 'Sending…';
	} );

	// ---------- start ----------

	root.classList.add( 'vsx--js' );
	if ( dry ) {
		root.classList.add( 'vsx--dry' );
	}
	form.setAttribute( 'novalidate', 'novalidate' );
	restore();
	applyConditions( true );
	buildProgress();
	go( idx, false );

}() );
