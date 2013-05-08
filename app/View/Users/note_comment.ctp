<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="jquery-1.3.2.min.js"></script>
<?php $this->Html->css('style_comment', null, array('inline' => false)); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>
<link href="css/style_comment.css" rel="stylesheet" type="text/css" />

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

<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<form name="comment-form" class="comment-form" action="/FinalProject/Users/comment/?flag=<?=$nid?>" method="post">

    <div class="header">
    <h1>Comment Form</h1>
    <span>Fill out the form below to make a comment!</span>
    </div>
    <div class="content">
	<input name="username" type="textarea" class="input username" id="username_input" value="Type here to make a comment" onfocus="this.value=''" />
    </div>
    <div class="footer">
    <input type="submit" name="submit" value="Submit" class="button" id="login_button"/>
    </div>

</form>

</div>
<div class="gradient"></div>
</body>
</html>