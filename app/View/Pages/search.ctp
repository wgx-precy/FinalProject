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
					<li><a href="filter">Filter</a></li>
					<li id="menu_active"><a href="search">Search</a></li>
					<li><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="search">
		<form action="submitSearch" method="post">
			<pre>Location: <input type="text" name="searchLocation"></pre>
			
			<b>State:&nbsp</b>
			<form>
				<select name="state">
					<option value="atHome">at home</option>
					<option value="atWork">at work</option>
					<option value="lunchTime">lunch time</option>
					<option value="shopping">shopping</option>
					</select>
			</form>

			<pre>Tags: <input type="text" name="searchTags"></pre>

			<input type="submit" name="search" value="search" id="filterSubmit">
		</form>
	</div>
	
</body>