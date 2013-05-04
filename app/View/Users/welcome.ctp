<?php $this->Html->css('default', null, array('inline' => false)); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!DOCTYPE html>
<html>
<body>
<?php
	echo "welcome to Jingo!		";
	echo $this->Form->input('userid', array('type' => 'hidden', 'value' => $id));
?>
<a href="/FinalProject/pages/home">home</a></br>
<p id="demo">Click the button to get your coordinates:</p>
<button onclick="getLocation()">Do It</button>
</br>

<script>
	var this_id = $('#userid').val();
	var x=document.getElementById("demo");
	var this_latitude;
	var this_longitude;
	function getLocation()
	{
	  	alert(this_id);
	  if (navigator.geolocation)
		    {
		    navigator.geolocation.watchPosition(showPosition);
		    }
	  else
		  {
		  	x.innerHTML="Geolocation is not supported by this browser.";
		  }
	}	  
	function showPosition(position)
	  {
	  this_latitude = position.coords.latitude;
	  this_longitude = position.coords.longitude;
	   	$.post('/FinalProject/Users/welcome_process', {user_location:{
	  		uid : this_id,
	  		ulat : this_latitude,
	  		ulng : this_longitude
	  	}},function(data){

	  	},
	  	'json');

 	 x.innerHTML="Latitude: " + position.coords.latitude + 
  	"<br>Longitude: " + position.coords.longitude; 
	  }
</script>
</body>
</html>
