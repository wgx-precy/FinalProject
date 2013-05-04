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

	<div id="newFilter">
		<form action="submitfilter" method="post">
			<pre>Location: <input type="text" name="filterLocation" id="filterLocation"></pre>
						
			<b>State: &nbsp</b>
			<form>
				<select name="state">
					<option value="atHome">at home</option>
					<option value="atWork">at work</option>
					<option value="lunchTime">lunch time</option>
					<option value="shopping">shopping</option>
					</select>
			</form>
			<pre>Tags: <input type="text" name="filterTags" id="filterTags"></pre>
			<pre>Time: <div><input type="radio" name="filterTimeType" value="date" id="filterTimeType">by date</div><div><input type="radio" name="filterTimeType" value="week" id="filterTimeType">by week</div>   (This option is to make sure the time rule is based on date or week.)</pre>

			<input type="submit" name="filterSubmit" id="filterSubmit">

		</form>
	</div>




</body>