<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<?php $this->Html->script('userlogin/login.js', array('inline' => false)); ?>
<?php $this->Html->css('style1', null, array('inline' => false)); ?>
<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<!--STYLESHEETS-->

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$("#password_input_1").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$("#password_input_1").blur(function() {
		$(".pass-icon").css("left","0px");
	});

    $("#password_input_2").focus(function() {
        $(".pass-icon2").css("left","-48px");
    });
    $("#password_input_2").blur(function() {
        $(".pass-icon2").css("left","0px");
    });
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <div class="pass-icon2"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="/FinalProject/Users/register_process" method="post">

	<!--HEADER-->
    <div class="header">
    <!--TITLE-->
    <h1>User Register</h1>
    <!--END TITLE-->
    <!--DESCRIPTION-->
    <span>Fill out the form below to register for JINGO!</span>
    <!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME-->
	<input name="username" type="text" class="input username" id="username_input" value="username" onfocus="this.value=''" />
	<!--END USERNAME-->
    <!--PASSWORD-->
    <input name="password1" type="password" class="input password_1" id="password_input_1" value="password" onfocus="this.value=''" />
    <input name="password2" type="password" class="input password_2" id="password_input_2" value="password" onfocus="this.value=''" />
    <!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON-->
    <input type="submit" name="submit" value="Register" class="button" id="register_button"/>
    <!--END LOGIN BUTTON-->
    <!--REGISTER BUTTON-->
    <!--
    <input type="submit" name="submit" value="Register" class="register" id="register_button" />
    -->
    <!--END REGISTER BUTTON-->
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT-->
<div class="gradient"></div>
<!--END GRADIENT-->

</body>
</html>