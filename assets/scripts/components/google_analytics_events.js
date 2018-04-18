(function($) {

	var launchGoogleEvents = function() {

		var googleElements = [];

		var bindEvent = function( el ) {

			if ( typeof ga === 'function' ) {

				el.bind( 'click', function(){

					var eventDescription = {'hitType' : 'event'};

					if ( Array.isArray( el.eventCategory ) ) {

						for ( i = 0; i < el.eventCategory.length; i++ )	{

							eventDescription = {'hitType' : 'event'};

							if ( el.eventCategory && el.eventCategory[i] ) { eventDescription.eventCategory = el.eventCategory[i]; }
							if ( el.eventAction && el.eventAction[i] ) { eventDescription.eventAction = el.eventAction[i]; }
							if ( el.eventLabel && el.eventLabel[i] ) { eventDescription.eventLabel = el.eventLabel[i]; }
							if ( el.eventValue && el.eventValue[i] ) { eventDescription.eventValue = el.eventValue[i]; }

							ga( 'send', eventDescription );

						}

					} else {

						if ( el.eventCategory ) { eventDescription.eventCategory = el.eventCategory; }
						if ( el.eventAction ) { eventDescription.eventAction = el.eventAction; }
						if ( el.eventLabel ) { eventDescription.eventLabel = el.eventLabel; }
						if ( el.eventValue ) { eventDescription.eventValue = el.eventValue; }

						ga( 'send', eventDescription );
					}
				});
			}
		};

	// fetch Google Analytics Events data from html data attributes and bind js Events to them
	var analyticsEvents = $('[data-ga-cat]');

	analyticsEvents.each(function(k){

		el = $(this);

		el.eventCategory = el.data('ga-cat');
		el.eventAction = el.data('ga-act');
		el.eventLabel = el.data('ga-lbl');

		if ( el.data('ga-val') ) {
			el.eventValue = parseInt( el.data('ga-val') );
		}

		// add element to array of registered Google Analytics Events
		googleElements.push(el);

		$(bindEvent(el));

	});

	function gaTimeout() {
		return ("ga( 'send', 'event', 'Bounce Rate Optimizer', 'Benn on the page at least 40 seconds' )");
	}

	if (typeof ga === "function") {

		setTimeout(gaTimeout(), 40000);

	}

};

$(launchGoogleEvents);

})(jQuery);