(function($) {
	$(document).ready(function() {

		$('#login_button').click(function(e){
			e.preventDefault();
			stopexec = false;
			var this_username = $('#username_input').val();
			var this_password = $('#password_input').val();
			if(stopexec == true){
	            return;
	        }
		});

	});
	
})(jQuery);
