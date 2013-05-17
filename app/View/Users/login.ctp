<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--<script type="text/javascript" src="/FinalProject/app/webroot/js/userlogin/login.js"></script>-->
<script language="javascript" type="text/javascript" src="jquery-1.3.2.min.js"></script>
<?php $this->Html->css('style', null, array('inline' => false)); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<!--STYLESHEETS-->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->

<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
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
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="/FinalProject/Users/login_process" method="post">

	<!--HEADER-->
    <div class="header">
    <!--TITLE-->
    <h1>Login Form</h1>
    <!--END TITLE-->
    <!--DESCRIPTION-->
    <span>Fill out the form below to login JINGO!</span>
    <!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME-->
	<input name="username" type="text" class="input username" id="username_input" value="username" onfocus="this.value=''" />
	<!--END USERNAME-->
    <!--PASSWORD-->
    <input name="password" type="password" class="input password" id="password_input" value="password" onfocus="this.value=''" />
    <!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON-->
    <input type="submit" name="submit" value="Login" class="button" id="login_button"/>
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
</br></br><a href="http://localhost/FinalProject/Users/register"><input type="submit" name="submit" value="Register" class="button" id="registerB" /></a>
<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->
</body>
</html>