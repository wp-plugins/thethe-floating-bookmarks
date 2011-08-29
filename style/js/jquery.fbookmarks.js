jQuery(document).ready(function($) {
	// Show social voter only if the browser is wide enough.
	if( $(window).width() >= 1030 )
		$('#social-float').show();

	// Update when user resizes browser.
	$(window).resize(function() {
		if( $(window).width() < 1030 ) {
			$('#social-float').hide();
		} else {
			$('#social-float').show();
		}
	});
});