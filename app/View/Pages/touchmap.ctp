<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>TouchMap</title>
	<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>
</head>

<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li><a href="profile">Profile</a></li>
					<li><a href="filter">Filter</a></li>
					<li><a href="search">Search</a></li>
					<li id="menu_active"><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="map">
		<pre>You can touch the the map to get the informaion about notes near there</pre>
	</div>
	
</body>