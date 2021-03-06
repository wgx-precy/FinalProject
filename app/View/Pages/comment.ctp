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
					<li><a href="/FinalProject/Pages/profile">Profile</a></li>
					<li><a href="/FinalProject/Pages/filter">Filter</a></li>
					<li><a href="/FinalProject/Pages/search">Search</a></li>					
					<li id="menu_active"><a href="/FinalProject/Pages/note_map">NoteMap</a></li>
					<li><a href="/FinalProject/Pages/postnote">PostNote</a></li>
					<li><a href="/FinalProject/Pages/friends">Friends</a></li>
					<li><a href="/FinalProject/Pages/requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div id="commentList">
	<pre>
		<table id="commentTable" border="1">
			<tr>
				<th id="comment1stColume">#</th>
				<th id="comment2ndColume">User Name</th>
				<th id="comment3rdColume" >Note</th>
				<th>Post Time</th>
			</tr>
			<tbody>
				<tr>
				<td>Note</td>
				<td><?=$note['0']['users']['username']?></td>
				<td id="commentNote"><?=$note['0']['notes']['note']?></td>
				<td><?=$note['0']['notes']['time']?></td>
				</tr>
			</tbody>
			<tr>
				<th>#</th>
				<th>User Name</th>
				<th>Comments</th>
				<th>Post Time</th>
			</tr>
			<tbody>
			<?php 
				$num = 1;
				foreach($comments as $comment):
				// echo $this->Form->create(null, array('url' => array('controller'=>'/Pages/','action' =>'requests')));
				// echo $this->Form->input('requestid', array('name'=>'requestid','type' => 'hidden','value' => $request['requests']['id']));
				// echo $this->Form->input('fid', array('name'=>'fid','type' => 'hidden','value' => $request['requests']['fid']));
			?>
				<tr>
				<td><?=$num;?></td>
				<td><?=$comment['users']['username']?></td>
				<td id="commentContent"><?=$comment['comments']['cnote']?></td>
				<td><?=$comment['comments']['ctime']?></td>
				</tr>
			<?php 
				//echo $this->Form->end();
				$num++;
				endforeach;
			?>
			<form name="comment-form" class="comment-form" action="/FinalProject/Pages/comment/?flag=<?=$nid?>" method="post">
				<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				</tr>
				<tr>
				<td>Comment</td>
				<td><?=$note['0']['notes']['like_value']?> people liked </br>this note, <a href="comment/?like=add&flag=<?=$note['0']['notes']['nid']?>">like</a> it?</td>		
				<td><input name="username" type="textarea" class="input username" id="username_input" value="Type here to make comments" onfocus="this.value=''" /></td>
				<td>
				<?php
					if($note['0']['notes']['ncomment'] == 1):
				?>
					<center><input type="submit" name="submit" value="Submit" class="button" id="login_button"/></center></td>
				<?php
					endif;
				?>
				</tr>
			</tbody>
		</table>
	</pre>
	</div>
	
</body>