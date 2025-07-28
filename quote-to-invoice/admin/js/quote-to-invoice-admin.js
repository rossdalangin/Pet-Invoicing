jQuery(document).ready(function($) {
	$('.nav-tab-wrapper a').click(function(e) {
		e.preventDefault();
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		$('.tab-content').hide();
		$($(this).attr('href')).show();
	});
});
