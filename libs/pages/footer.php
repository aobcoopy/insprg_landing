

<button id="top" class="b_top"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#top').fadeIn(300);
			} else {
				$('#top').fadeOut(300);
			}
		});

		// scroll body to 0px on click
		$('#top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>