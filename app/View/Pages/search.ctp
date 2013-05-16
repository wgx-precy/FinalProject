<?php $this->Html->css('default', null, array('inline' => false)); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<head>
	<title>Search</title>

	<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>
	<script src="/tagPage/timeForm.js"></script>
</head>


<script>
				$(document).ready(function(){
					$("#ifByArea1").click(function(){
							$("#selectArea").css("display","block");			
					});
					$("#ifByArea2").click(function(){
							$("#selectArea").css("display","none");			
					});
				});
			</script>


<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li><a href="profile">Profile</a></li>
					<li><a href="filter">Filter</a></li>
					<li id="menu_active"><a href="search">Search</a></li>
					<li><a href="note_map">NoteMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<div id="search">
		<form action="/FinalProject/Pages/search" method="post">
			<pre>keyWords: <input type="text" name="keyWords"></pre>
			<b>SelectByArea:&nbsp</b>
			<ul>
				<li><input type="radio" name="ifByArea" value="yes" id="ifByArea1">Yes&nbsp</li>
				<li><input type="radio" name="ifByArea" value="no" id="ifByArea2">No&nbsp</li>
			</ul>
			<select name="selectArea" id="selectArea" style='display:none'>

				<option value="Fort Greene">Fort Greene</option>
				<option value="Downtown Brooklyn">Downtown Brooklyn</option>
				<option value="ChinaTown">ChinaTown</option>
				<option value="Time Square">Time Square</option>
				<option value="East Village">East Village</option>
				<option value="Soho">Soho</option>		
			</select>
			

			</br></br><input type="submit" name="search" value="search" id="filterSubmit">
		</form>
	
	<?php if(isset($searchresult)):?>
			<table border="1">
				<tr>
				<th><center>User Name</center></th>
				<th><center>Note</center></th>
				<th><center>Post Time</center></th>
				<th><center>Comment</center></th>
				</tr>
			<tbody>
				<?php foreach($searchresult as $result):?>
				<tr>
				<td><center><?=$result['0']['first_name']?></center></td>
				<td><center><?=$result['0']['note']?></center></td>
				<td><center><?=$result['0']['time']?></center></td>
				<td><center><a href ='comment/?flag=<?=$result['0']['nid']?>'>Comment</a></center></td>
				</tr>
				<?php endforeach;?>
	<?php endif;?>
	</div>
	
</body>