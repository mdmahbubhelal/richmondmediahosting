<?php
if (!is_user_logged_in() && !isset($_SESSION['guestVisitor'])) {
	//include_once 'initialPopUp.php'; 
}
if (!is_user_logged_in() && !isset($_SESSION['visitingAs'])) {
	//include_once 'visitorTypePopUp.php'; 
}
?>

<script>
jQuery(function ($) {
    $('#landingPageLoginModal').modal('show');
	$('#visitorTypeModal').modal('show');
	var ajaxurl = "<?php echo esc_url( admin_url('admin-ajax.php')); ?>";

	$(document).on('submit', '#landingPageLoginModalLoginForm', function (event) {
		event.preventDefault();
		var submitBtn 	= $('#landingPageLoginModalLoginForm .btn-submit');
		var username	= $('#username').val();
		var password	= $('#password').val();
		var remember	= $('#remember').prop('checked');
		var redirect	= "<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>";

		// validation
		var error = {};
		if (!username) { 
			$('.usernameError').text('Username is required.');
			error.username = 'username error';
		} else {
			$('.usernameError').text('');
			delete(error.username);
		}
		if (!password) { 
			$('.passwordError').text('Password is required.');
			error.password = 'password error';
		} else {
			$('.passwordError').text('');
			delete(error.password);
		}

		if ($.isEmptyObject(error)) {
			// form validation successfull
			var ajaxData 	= {action: 'pub_userLogin', username:username, password:password, remember:remember, redirect:redirect};
			$.ajax({
				url: ajaxurl,
				data: ajaxData,
				method: 'post',
				beforeSend: function() {
					// inactive submit button
					submitBtn.text('Login...').attr('disabled', true);
				},
				success: function (response) {
					// redirect user to the desired page
					response = JSON.parse(response);
					if (response.status == 200) {
						location.reload();
					} else {
						$('.errorContainer').html('<br>'+ response.message)
					}
					console.log(response);
					submitBtn.text('Login').attr('disabled', false);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					// show error message
					console.log(errorThrown);
					submitBtn.text('Login').attr('disabled', false);
				}
			});
		} else {
			//console.log(error);
		}
	});

	// User decided to not logged in
	$("#landingPageLoginModal").on("hidden.bs.modal", function (event) {
		event.preventDefault();
		$.ajax({
			url: ajaxurl,
			data: {action: 'pub_userNotLogin'},
			method: 'post',
			beforeSend: function() {
				// inactive submit button
			},
			success: function (response) {
				// redirect user to the desired page
				alert(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// show error message
				console.log(errorThrown);
			}
		});
	});

	jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');
        if (!max) { max = 99999; }
        if (!min) { min = 1; }

      btnUp.click(function() {
        var oldValue = parseInt(input.val());
        if (oldValue >= max) { var newVal = oldValue; } 
        else {var newVal = oldValue + 1; }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseInt(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });
    });

});
</script>