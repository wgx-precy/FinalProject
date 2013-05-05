<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>Friends</title>
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
					<li><a href="touchmap">TouchMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li id="menu_active"	><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<a href="addfriend"><input type="submit" name="addFriend" value="AddFriend" id="addFriendButton"></a>
	<div id="friendList">
		<pre>Your friend list:
			<table id="friend_table" class="tablesorter" border="5" cellpadding="5" cellspacing="5">	
					<tr style="pending:1px">
						<td style=" text-align=center">First Name</td>
						<td style=" text-align=center">Last Name</td>
						<td style=" align:center">E-mail</td>
					</tr>
				<tbody>		
		<?php

			foreach($friends as $content_item): 	
		?>
					<tr>
						<td><?=$content_item['users']['first_name'];?></td>
						<td><?=$content_item['users']['last_name'];?></td>
						<td><?=$content_item['users']['uemail'];?></td>
					</tr>
			<?php endforeach;?>
				</tbody>
			</table>


		</pre>


	<!--insert the result of selection from database-->
	</div>
	
</body>