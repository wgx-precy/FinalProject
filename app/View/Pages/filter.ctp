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
		<tbody>		
		<?php
		echo $user_filters['0']['users_filters']['id'];
			foreach($openlib as $content_item) :
				for ($i=0; $i < $length; $i++) { 
					if ($counting[$i]['0']['content_items']['id']==$content_item['ContentItem']['id']) 
						{
						$i++;
						$No=$i;
						}
			}
		?>

		<?php	if ($content_item['ContentItem']['id']!=null):
		//print_r($content_item['ContentItem']['openlibrary']);
					if($content_item['ContentItem']['openlibrary'] != "open"):
						if($content_item['ContentItem']['openlibrary'] != "local"):
		?>
					<tr>
						<td>
						<?=$numb;
							$numb++;
						?> 
						</td>
						<td abbr="<?=$content_item['ContentItem']['content_title'];?>">
							<a class='content-list-title edit-content-item-button' type='button' data-id='<?=$content_item['ContentItem']['id']?>' ><?=$content_item['ContentItem']['content_title'];?></a></td>
						<td abbr="<?=$content_item['OpenLibraryRequest']['email'];?>"><?=$content_item['OpenLibraryRequest']['email'];?></td>
						<td abbr="<?=$content_item['OpenLibraryRequest']['request_time'];?>"><?=$content_item['OpenLibraryRequest']['request_time'];?></td>
						<td abbr="<?=$content_item['OpenLibraryRequest']['respond_time'];?>"><?=$content_item['OpenLibraryRequest']['respond_time'];?></td>
							<td><?=$content_item['OpenLibraryRequest']['UserNumber'];?> </td>
						<td>
							<textarea class="admin_request_note" id="admin_request_note<?=$content_item['OpenLibraryRequest']['id']?>">
								<?=$content_item['OpenLibraryRequest']['note'];?>
							</textarea>
				    	</td>
				    	<script>
				    	$('.content-list-title').live('click', function() {
							$('#open_library_delete_confirm'+$(this).attr('data-id')).dialog("close");
						});
				    	</script>
						<td>
								<?php
								//echo "<a class='request_respond' data-id='".$content_item['ContentItem']['id']."'> Respond</a>";
								?>
								<?php
									$currenttime=date("Y-m-d H:i:s");
									echo '<input type=button  class=Admin_respond_Button value=Respond value1='.$content_item['ContentItem']['id'].' value2="'.$currenttime.'" value3='.$content_item['ContentItem']['openlibrary'].' value4='.$content_item['OpenLibraryRequest']['id'].' value5="'.$content_item['OpenLibraryRequest']['email'].'"/>';
									// print_r($currenttime);
									// print_r($note);exit();
								?>
							</td>
							 <script> 
							 $('.request_respond').live('click',function(e){
							 	e.preventDefault();
							 	var obj ={};
							 	obj[1] = $(this).attr("data-id");
							 	//alert('OK!');
							 	//$('.item-listing-wrapper').load('/dashboard/list_content_items/', obj)
							 });
							 </script>
						<td>
								<div class='request-list-button-open_library', type='button', data-id=<?=$content_item['ContentItem']['id'] ?> padding="5px" >
								<div class='requet_function', style="margin:10px; width:120px; display:inline">

								<?php	if ($content_item['ContentItem']['openlibrary'] == 'add-request') {
											$add_delete = "add";
											for ($i=0; $i < $length; $i++) { 
											 	if ($counting[$i]['0']['content_items']['id']==$content_item['ContentItem']['id']) {
											 		//echo "Number of Users: ";
											 		//echo $counting[$i]['0']['0']['Total'];
											 		$UserNumber="Null";
											 		//echo $UserNumber;
												 }
											 }
											// $add_delete = "";
										}

										else if ($content_item['ContentItem']['openlibrary'] == 'delete-request') {
											$add_delete="delete";
											 for ($i=0; $i < $length; $i++) { 
											 	if ($counting[$i]['0']['content_items']['id']==$content_item['ContentItem']['id']) {
											 		$UserNumber=$counting[$i]['0']['0']['Total'];
											 		//echo $UserNumber;
											 	}
											 }
											 
										}
									//print_r($add_delete);exit();
									echo '<input type=button  class=Admin_permit_Button  value="'.$add_delete.'" value1="'.$content_item['ContentItem']['id'].'" value2="'.$currenttime.'" value3="'.$content_item['ContentItem']['openlibrary'].'" value5="'.$content_item['OpenLibraryRequest']['email'].'"/>';
									$add_delete = "";
									?>
									<div class='add_notice' id="ol_add_notice" style="display:none" title="Notice">
                  					<p>By deleting this content from the open library, it will no content be publicity accessible，existing users will be able to keep copies with their libraries and courses. Are you sure you want to delete this content?</p>
               						 </div>
							</div>
						</div>
							</td>		
					</tr>
					<?php endif;?>
					<?php endif;?>
				<?php endif;?>
	<?php endforeach;?>
				</tbody>
			</table>		
		
		</form>

	</div>
	

	
</body>