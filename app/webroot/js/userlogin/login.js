(function($) {
	$(document).ready(function() {

		$('#login_button').click(function(e){
			e.preventDefault();
			alert('hello');
			stopexec = false;
			var this_username = $('#username_input').val();
			var this_password = $('#password_input').val();
			//alert(this_username+this_password);
			if(stopexec == true){
	            return;
	        }
		});

	});
	
})(jQuery);
