<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>PostNote</title>
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
					<li><a href="note_map">NoteMap</a></li>
					<li id="menu_active"><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

<div id="newNote">
		<form action="submitnote" method="post">
			<p>Wanna share your idear with other people?</p>
			<p>Just post what you wanna show up here!</p>

			<p>Your current location is: latitude:<?=$latitude;?> longitude:<?=$longitude;?></p>
			
			</br>State:&nbsp
			<form>
				<select name="state">
					<option value="atHome">at home</option>
					<option value="atWork">at work</option>
					<option value="lunchTime">lunch time</option>
					<option value="shopping">shopping</option>
				</select>
			</form>

			<pre>Tags: <input type="text" name="noteTags"></pre>
			<pre>Note: <input type="text" name="noteContent"></pre>
			Who can see your idear:&nbsp
			<form>
				<select name="state">
					<option value="public">public</option>
					<option value="followed">followed</option>
					<option value="friends">friends</option>
					</select>
			</form>
			<pre>EffectiveRange: <input type="text" name="range" id="range">(meters)</pre>
			
			<input type="submit" name="noteSubmit" value="PostNote" id="noteSubmit">
		</form>
	</div>
	
</body>