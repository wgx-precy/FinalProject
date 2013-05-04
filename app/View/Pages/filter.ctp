<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>Profile</title>

	<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>
	<script src="/tagPage/timeForm.js"></script>
</head>

<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li><a href="profile">Profile</a></li>
					<li id="menu_active"><a href="filter">Filter</a></li>
					<li><a href="search">Search</a></li>
					<li><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<a href="addfilter"><input type="submit" name="AddFilter" value="AddFilter" id="AddFilterButton"></a>

	<div id="filter">
		<p>These are all filters you have:</p>
		<form>
			<pre>|StartDay	|EndDay		|StartTime	|EndTime	|Filter State	|Location<pre>
			<!--Should insert the selection result of filter in database-->
				
		</form>
	</div>
	

	
</body>