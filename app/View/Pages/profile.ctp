<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>Profile</title>
	<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>
</head>

<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li id="menu_active"><a href="profile">Profile</a></li>
					<li><a href="filter">Filter</a></li>
					<li><a href="search">Search</a></li>
					<li><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="userInfor">
		<pre>First name: <?php echo $user_profile['0']['User']['first_name'];?></pre>
		<pre>Last name: <?php echo $user_profile['0']['User']['last_name'];?></pre>
		<pre>Username: <?php echo $user_profile['0']['User']['username'];?></pre>
		<pre>Email: <?php echo $user_profile['0']['User']['uemail'];?></pre>
		<pre>Credit: <?php echo $user_profile['0']['User']['credit'];?></pre>
	</div>
	
</body>