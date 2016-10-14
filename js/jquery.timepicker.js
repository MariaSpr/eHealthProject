( function ( $ ) {
	'use strict';

	var namespace = 'jquery-timepicker',
		$window = $( window ),
		$document = $( document ),
		$body = $( document.body );

	// An extra body class for touch devices.
	if ( 'ontouchstart' in window ) {
		$body.addClass( namespace + '-touch' );
	}

	/**
	 * Adds a leading zero to a one digit natural number.
	 *
	 * @param {number} n Natural 1 or 2 digit number.
	 * @return {string}
	 */
	function zeroise( n ) {
		return ( n < 10 ? '0' : '' ) + n;
	}

	/**
	 * Creates a DIV element wrapped in a jQuery object.
	 *
	 * @return {jQuery}
	 */
	function $div() {
		return $( document.createElement( 'DIV' ) );
	}

	/**
	 * Timepicker constructor.
	 *
	 * @constructor
	 */
	function Timepicker( $el ) {
		this.$el = $el;
		this._init();
	}

	Timepicker.prototype = {

		/**
		 * The time of the clock.
		 * Should always represent the visual state of the clock.
		 * Use the _setClock method to change this.
		 *
		 * @type {object}
		 * @property {?number}  hours   Amount of hours. (0-11)
		 * @property {?number}  minutes Amount of minutes. (0-59)
		 * @property {?boolean} am      True if the time is AM.
		 */
		time: {
			hours: null,
			minutes: null,
			am: null
		},

		/**
		 * Initalises the timepicker.
		 * Builds it and adds all the event listeners.
		 */
		_init: function() {
			if ( this.initialised ) {
				return;
			}

			var self = this, i = 60, radius, radian;

			this.initialised = true;

			// Build the timepicker.

			this.$picker = $div().addClass( namespace );
			this.$clock = $div().addClass( namespace + '-clock' ).appendTo( this.$picker );
			this.$middle = $div().addClass( namespace + '-middle' ).appendTo( this.$clock );
			this.$hoursHand = $div().addClass( namespace + '-hours-hand' ).appendTo( this.$clock );
			this.$minutesHand = $div().addClass( namespace + '-minutes-hand' ).appendTo( this.$clock );
			this.$AMButton = $div().addClass( namespace + '-am-button' ).text( 'AM' ).appendTo( this.$clock );
			this.$PMButton = $div().addClass( namespace + '-pm-button' ).text( 'PM' ).appendTo( this.$clock );

			this.$picker.appendTo( $body );

			radius = this.$clock.width() / 2 - 10;

			while ( i-- ) {
				$div()
				.addClass( namespace + '-minute-' + ( i % 5 === 0 ? 'big' : 'small' ) )
				.css( {
					transform: 'rotate(' + ( i * 6 ) + 'deg)'
				} )
				.appendTo( this.$clock );

				if ( i % 5 === 0 ) {
					radian = i / 30 * Math.PI;

					$div()
					.text( i / 5 || 12 )
					.addClass( namespace + '-minute-number' )
					.css( {
						left: radius + Math.sin( radian ) * ( radius - 10 ),
						top: radius - Math.cos( radian ) * ( radius - 10 )
					} )
					.appendTo( this.$clock );
				}
			}

			// Add event listeners.

			// When touching a clock hand, start detecting movement.
			this.$minutesHand.add( this.$hoursHand ).on( 'mousedown.' + namespace + ' touchstart.' + namespace, function() {
				var hoursHand = this === self.$hoursHand.get( 0 ),
					clockOffset = self.$clock.offset();

				clockOffset.left += self.$clock.outerWidth() / 2;
				clockOffset.top += self.$clock.outerHeight() / 2;

				$body.addClass( namespace + '-grabbing' );

				// Whenever the mouse/finger moves, calculate the amount of degrees based on the x and y coordinates.
				// Set the clock hand based on the amount of degrees.
				$document.on( 'mousemove.' + namespace + ' touchmove.' + namespace, function( event ) {
					var e = event.type === 'touchmove' ? event.originalEvent.touches[0] : event,
						x = e.pageX - clockOffset.left,
						y = e.pageY - clockOffset.top,
						// Flip x and y axis and mirror x so it represents a clock.
						degrees = Math.atan( - x / y ) * 180 / Math.PI,
						divisor = 360 / ( hoursHand ? 12 : 60 ),
						remainder, value;

					// Fix quadrants.
					if ( x <= 0 || y >= 0 ) {
						degrees += 180;
					}

					if ( x <= 0 && y < 0 ) {
						degrees += 180;
					}

					// Round to closest minute or hour.

					remainder = degrees % divisor;

					if ( remainder > divisor / 2 ) {
						remainder -= divisor;
					}

					degrees -= remainder;

					if ( degrees === 360 ) {
						degrees = 0;
					}

					value = degrees / divisor;

					self._setClock( hoursHand ? { hours: value } : { minutes: value }, true );
				} );

				$document.one( 'mouseup.' + namespace + ' touchend.' + namespace, function() {
					$document.off( 'mousemove.' + namespace + ' touchmove.' + namespace );
					$body.removeClass( namespace + '-grabbing' );
				} );
			} );

			// Switch the time to AM/PM.
			this.$AMButton.add( this.$PMButton ).on( 'mousedown.' + namespace + ' touchstart.' + namespace, function() {
				self._setClock( { am: this === self.$AMButton.get( 0 ) }, true );
			} );

			this.$el
			.on( 'focus.' + namespace, $.proxy( this.show, this ) )
			.on( 'blur.' + namespace, $.proxy( this.hide, this ) )
			.on( 'change.' + namespace + ' input.' + namespace, $.proxy( this._setClock, this ) );

			// Make sure the input element stays focussed.
			this.$picker.on( 'mousedown.' + namespace + ' touchstart.' + namespace, function( event ) {
				event.preventDefault();
			} );

			// Try to parse the input value and use the current time if it fails.
			this._setClock( this._parseTime() || this._getCurrentTime() );
		},

		/**
		 * Shows the timepicker.
		 * Positions it next to the input element.
		 */
		show: function() {
			var inputOffset = this.$el.offset(),
				inputWidth = this.$el.outerWidth(),
				inputHeight = this.$el.outerHeight(),
				pickerWidth = this.$picker.outerWidth( true ),
				pickerHeight = this.$picker.outerHeight( true ),
				fixed = this.$el.css( 'position' ) === 'fixed',
				documentWidth, documentHeight, spaceBottom, spaceRight;

			// Check if any parents have position:fixed.
			! fixed && this.$el.parents().each( function() {
				return ! ( fixed |= $( this ).css( 'position' ) === 'fixed' );
			} );

			// If we have a position:fixed element, the offset needs to be relative to the window.
			if ( fixed ) {
				inputOffset.top -= $window.scrollTop();
				inputOffset.left -= $window.scrollLeft();
			}

			// Calculate the space to the bottom and right of the input element.
			documentWidth = ( fixed ? $window : $document ).width();
			documentHeight = ( fixed ? $window : $document ).height();
			spaceBottom = documentHeight - inputOffset.top - inputHeight;
			spaceRight = documentWidth - inputOffset.left;

			this.$picker
			.css( {
				position: fixed ? 'fixed' : null,
				// If there's not enough space at the bottom or left, display at the top or align right respectively.
				top: spaceBottom < pickerHeight ? inputOffset.top - pickerHeight : inputOffset.top + inputHeight,
				left: spaceRight < pickerWidth ? inputOffset.left + inputWidth - pickerWidth : inputOffset.left
			} )
			.show();
		},

		/**
		 * Hides the timepicker.
		 */
		hide: function() {
			this.$picker.hide();
		},

		/**
		 * Destroys the timepicker.
		 * Removes all event listeners, removes the timepicker element and the instance.
		 */
		destroy: function() {
			this.$minutesHand
			.add( this.$hoursHand )
			.add( this.$el )
			.add( this.$picker )
			.add( this.$AMButton )
			.add( this.$PMButton )
			.off( '.' + namespace );

			this.$picker.remove();
			this.$el.removeData( namespace );
		},

		/**
		 * Parses H:i date formatted string to a Timepicker.time object.
		 *
		 * @param {string} time Optional. Defaults to the input value.
		 * @return {Timepicker.time|undefined}
		 */
		_parseTime: function( time ) {
			var matches = ( time || this.$el.val() ).match( /^(\d{2}):(\d{2})$/ ),
				hours, minutes, am;

			if ( matches ) {
				hours = parseInt( matches[1], 10 );
				minutes = parseInt( matches[2], 10 );

				if ( hours < 24 && minutes < 60 ) {
					am = hours < 12;

					if ( ! am ) {
						hours -= 12;
					}

					return {
						hours: hours,
						minutes: minutes,
						am: am
					};
				}
			}
		},

		/**
		 * Turns a Timepicker.time object into a H:i date formatted string.
		 *
		 * @param {Timepicker.time} time Optional. Defaults tot the instance's Timepicker.time object.
		 * @return {string} H:i date formatted string.
		 */
		_composeTime: function( time ) {
			time = time || this.time;

			return zeroise( time.hours + ( time.am ? 0 : 12 ) ) + ':' + zeroise( time.minutes );
		},

		/**
		 * Get the current date in the form of a Timepicker.time object.
		 *
		 * @return {Timepicker.time}
		 */
		_getCurrentTime: function() {
			var date = new Date(),
				hours = date.getHours(),
				minutes = date.getMinutes(),
				am = hours < 12;

			if ( ! am ) {
				hours -= 12;
			}

			return {
				hours: hours,
				minutes: minutes,
				am: am
			};
		},

		/**
		 * Set the time of the clock.
		 *
		 * @param {Timepicker.time} time Optional. Defaults to the parsed input value. Will be extended with the instance's Timepicker.time object.
		 * @param {boolean} setInput Whether or not to set the input value as well.
		 */
		_setClock: function( time, setInput ) {
			var change;

			// Use the input time if `time` is not a Timepicker.time object.
			if ( ! time || ( time.hours == null && time.minutes == null && time.am == null ) ) {
				time = this._parseTime();
			}

			// Don't do anything if the input value is not parsable.
			if ( ! time ) {
				return;
			}

			// Extend `time` with the instance's Timepicker.time object.
			time = $.extend( {}, this.time, time );

			// Only do DOM manipulations where necessary.

			if ( change |= time.hours !== this.time.hours ) {
				this.$hoursHand.css( { transform: 'rotate(' + ( time.hours * 30 ) + 'deg)' } );
			}

			if ( change |= time.minutes !== this.time.minutes ) {
				this.$minutesHand.css( { transform: 'rotate(' + ( time.minutes * 6 ) + 'deg)' } );
			}

			if ( change |= time.am !== this.time.am ) {
				this.$AMButton.toggleClass( 'active', time.am );
				this.$PMButton.toggleClass( 'active', ! time.am );
			}

			if ( setInput && change ) {
				this.$el.val( this._composeTime( time ) );
			}

			// Update the instance's Timepicker.time object.
			this.time = time;
		}
	};

	/**
	 * Creates a new timepicker instance or applies a method if one is passed.
	 *
	 * @param {string} method Optional. The method to apply.
	 * @return {jQuery}
	 */
	$.fn.timepicker = function( method ) {
		return this.each( function() {
			// Do nothing if the element is not an input element.
			if ( this.nodeName !== 'INPUT' ) {
				return;
			}

			var $el = $( this ),
				data = $el.data( namespace );

			// If there there's already an instance attached to the element, apply the method,
			// if not, create a new instance.
			if ( data ) {
				if ( typeof data[ method ] === 'function' ) {
					data[ method ].apply( data );
				}
			} else {
				$el.data( namespace, new Timepicker( $el ) );
			}
		} );
	};
} )( window.jQuery );
