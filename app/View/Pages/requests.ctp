<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>Requests</title>
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
					<li><a href="friends">Friends</a></li>
					<li id="menu_active"><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="requestList">
	<pre>
		These requests are waiting for you to confirm: 
		<table border="1">
				<tr>
				<th>#</th>
				<th>User Name</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Permit</th>
				<th>Ignore</th>
				</tr>
			<tbody>
			<?php 
				$num = 1;
				foreach($friend_request as $request):
				echo $this->Form->create(null, array('url' => array('controller'=>'/Pages/','action' =>'reqquests')));
				echo $this->Form->input('permit', array('name'=>'permit','type' => 'hidden','value' => $request['requests']['id']));
			?>
				<tr>
				<td><?=$num;?></td>
				<td><?=$request['users']['username']?></td>
				<td><?=$request['users']['last_name']?></td>
				<td><?=$request['users']['first_name']?></td>
				<td><?php 
				echo $this->Form->submit('permit', array('name'=>'permit','value' => 'permit'));?></td>
				<td><?php echo $this->Form->submit('ignore', array('name'=>'ignore','value' => 'follow'));?></td>
				</tr>
			<?php 
				echo $this->Form->end();
				$num++;
				endforeach;
			?>
			</tbody>
		</table>
	</pre>
	</div>
	
</body>