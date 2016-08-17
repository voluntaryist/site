jQuery(document).ready(function($) {
	var $destination = $("#customize-info .accordion-section-title");
	$destination.prepend('<a style="width: 80%; margin: 10px auto; display: block; text-align: center;" href="http://wordpress.org/support/view/theme-reviews/impronta/" class="button" target="_blank">{review}</a>'.replace( '{review}', topbtns.review ) );
 	$destination.prepend('<a style="width: 80%; margin: 10px auto; display: block; text-align: center;" href="https://www.quemalabs.com/?utm_source=Impronta%20Theme&utm_medium=More%20Themes%20Button&utm_campaign=Impronta" class="button" target="_blank">{more}</a>'.replace( '{more}', topbtns.more ) );
});