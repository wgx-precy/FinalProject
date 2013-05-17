<?php $this->Html->css('style', null, array('inline' => false)); ?>

<br>

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
    <h1>Login Error</h1>
    <!--END TITLE-->
    <!--DESCRIPTION-->
    <span>username or password is incorrect, please try again</span>
    <!--END DESCRIPTION-->
    <a href="/FinalProject/users/login">
    </div>
    <!--END HEADER-->	
	<!--CONTENT-->
    <div class="content">
	
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON-->
    <a href="/FinalProject/users/login"><input type="submit" name="submit" value="Login" class="button" id="login_button"/></a>
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

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->
</body>