<?php $this->Html->css('default', null, array('inline' => false)); ?>
<head>
	<title>Filter</title>

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
					<li><a href="note_map">NoteMap</a></li>
					<li><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

	<a href="addfilter"><input type="submit" name="AddFilter" value="AddFilter" id="addFilterButton"></a>

	<div id="filter">
		<form>
		
		
		<pre>
			<pre>User Filters</pre>
			<table id="filter_table" class="tablesorter" border="5" cellpadding="5" cellspacing="5">	
					<tr style="pending:1px">
						<td id="yId"><center>ID</center></td>
						<td id="yStartD"><center>Start Date</center></td>
						<td id="yEndD"><center>End Date</center></td>
						<td id="yStartT"><center>Start Time</center></td>
						<td id="yEndT"><center>End Time</center></td>
						<td id="yState"><center>State</center></td>
						<td id="yArea"><center>Area</center></td>
						<td id="yTag"><center>Tag</center></td>	
						<td><center> </center></td>
					</tr>
			<tbody>		
		<?php
	//	echo $user_filters['0']['users_filters']['id'];
			$filter_display_id=1;	
			foreach($user_filters as $content_item): 	
		?>
			<form name="delete-note-form" class="delete-note" action="/FinalProject/Pages/filter" method="post">
				<input name="filter_id" type="hidden" value=<?=$content_item['users_filters']['fid']?>>
					<tr>
						<td id="xId"><center><?=$filter_display_id;?></center></td>
						<td><center><?php
								if($content_item['users_filters']['datestart'] == '0000-00-00'){
									if($content_item['users_filters']['week1'] == '1'){
										echo 'Sunday';
									}
									if($content_item['users_filters']['week1'] == '2'){
										echo 'Monday';
									}
									if($content_item['users_filters']['week1'] == '3'){
										echo 'Tuesday';
									}
									if($content_item['users_filters']['week1'] == '4'){
										echo 'Wednesday';
									}
									if($content_item['users_filters']['week1'] == '5'){
										echo 'Thursday';
									}
									if($content_item['users_filters']['week1'] == '6'){
										echo 'Friday';
									}
									if($content_item['users_filters']['week1'] == '7'){
										echo 'Saturday';
									}
								}
								else{
									echo $content_item['users_filters']['datestart'];
								}
							?></center></td>
						<td style=" align:center"><center><?php
								if($content_item['users_filters']['dateend'] == '0000-00-00'){
									if($content_item['users_filters']['week2'] == '1'){
										echo 'Sunday';
									}
									if($content_item['users_filters']['week2'] == '2'){
										echo 'Monday';
									}
									if($content_item['users_filters']['week2'] == '3'){
										echo 'Tuesday';
									}
									if($content_item['users_filters']['week2'] == '4'){
										echo 'Wednesday';
									}
									if($content_item['users_filters']['week2'] == '5'){
										echo 'Thursday';
									}
									if($content_item['users_filters']['week2'] == '6'){
										echo 'Friday';
									}
									if($content_item['users_filters']['week2'] == '7'){
										echo 'Saturday';
									}
								}
								else{
									echo $content_item['users_filters']['dateend'];
								}
							?></center></td>
						<td class="xxx"><center><?=$content_item['users_filters']['timestart'];?></center></td>
						<td class="xxx"><center><?=$content_item['users_filters']['timeend'];?></center></td>
						<td class="xxx"><center><?=$content_item['users_filters']['state'];?></center></td>
						<td id="xArea"><center><?=$content_item['users_filters']['district'];?></center></td>
						<td id="xTag"><center><?=$content_item['users_filters']['tags']?></td>

						<td><center><input name="deletenote" type="submit"id="delete_note" value="Delete"/></center></td>
					</tr>
				</form>
		<?php 
			$filter_display_id++;
			endforeach;
		?>
				</tbody>
			</table>		
		</pre>
		</form>

	</div>
	

	
</body>