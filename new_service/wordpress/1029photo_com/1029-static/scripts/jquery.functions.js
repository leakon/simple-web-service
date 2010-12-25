/*	ClientName - js/jquery/functions.js

	jQuery-dependent functions
*/

$(window).load(function () {
	
	$('#slide-box').cycle({
		fx: 'scrollHorz',
		prev: '#slides-prev a',
		next: '#slides-next a',
		timeout: 0,
		speed: 800
	});
	
});

/* EOF */