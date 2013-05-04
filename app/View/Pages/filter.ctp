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
					<li><a href="touchmap">TouchMap</a></li>
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
		<h4>User Filter</h4>
		<table id="filter_table" class="tablesorter" border="5" cellpadding="5" cellspacing="5">	
					<tr style="pending:1px">
						<td style=" text-align=center"> Filter ID</td>
						<td style=" align:center">Start Day</td>
						<td style=" text-align:center">End Day</td>
						<td style=" align:center">Start Week</td>
						<td style=" align:center">End Week</td>
						<td style=" align:center">Start Time </td>
						<td style=" align:center">End Time </td>
						<td style=" text-align:center">State </td>
						<td style=" align:center">Location </td>
						<td style=" align:center">Tag </td>	
					</tr>	
		
		</form>

	</div>
	

	
</body>