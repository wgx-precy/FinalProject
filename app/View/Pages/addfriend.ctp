<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>AddFriend</title>
	<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>
	<script src="/tagPage/timeForm.js"></script>
</head>

<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li><a href="profile">Profile</a></li>
					<li><a href="filter">Filter</a></li>
					<li><a href="search">Search</a></li>
					<li><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li id="menu_active"><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="newFilter">
		<form action="submitfilter" method="post">
			<pre>Input the email of the people you wanna add as friend</pre>
			<pre>email:<input type="text" name="filterLocation" id="filterLocation"></pre>
			<input type="submit" name="friendSubmit" id="friendSubmit">
		</form>
	</div>




</body>