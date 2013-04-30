;$(document).ready(function() {

	$('#login_button').live('click', function(e){
			e.preventDefault();
			stopexec = false;
			var this_username = $('#username_input').val();
			var this_password = $('#password_input').val();
			alert(this_username+this_password);
			if(stopexec == true){
	            return;
	        }
		});

})(jQuery);