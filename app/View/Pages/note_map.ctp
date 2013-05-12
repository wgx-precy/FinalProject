
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<?php $this->Html->css('default', null, array('inline' => false)); ?>
<style type="text/css">
#user_gmap{ width:800px;height:500px; margin: 0px auto 0px; border:solid 1px #111; }
#user_glink {width:600px; text-align:right; font-size:10px; font-weight:normal; padding:0px; height:20px; margin:0px auto;}
</style>
<input type="submit" name="submit" value="Show Note" class="button" id="ShowNote"/>
<?php
	echo $this->Form->input('lat', array('type' => 'hidden', 'id' => 'note_lat','value' => $mylatitude));
	echo $this->Form->input('lng', array('type' => 'hidden', 'id' => 'note_lng','value' => $mylongitude));
	echo $this->Form->input('message_id', array('type' => 'hidden', 'id' => 'note_message_id','value' =>$message_id));
	echo $this->Form->input('message', array('type' => 'hidden', 'id' => 'note_message','value' =>$message));
	echo $this->Form->input('message_tag', array('type' => 'hidden', 'id' => 'note_message_tag','value' =>$message_tag));
	echo $this->Form->input('num', array('type' => 'hidden', 'id' => 'note_num','value' => $num));
	echo $this->Form->input('longitude', array('type' => 'hidden', 'id' => 'note_longitude','value' => $longitude));
	echo $this->Form->input('latitude', array('type' => 'hidden', 'id' => 'note_latitude','value' => $latitude));
?>
<script type="text/javascript">
google.maps.event.addDomListener(window, 'load', function() {
	var mapdiv = document.getElementById('user_gmap');
	$('#ShowNote').click(function(e){
		var note_lat = Number($('#note_lat').val());
		var note_lng = Number($('#note_lng').val());
		var note = $('#note_message').val();
		var note_id = $('#note_message_id').val();
		var note_tag = $('#note_message_tag').val();
		var num = Number($('#note_num').val());
		var message_id = note_id.split("<$=>");
		var message = note.split("<$=>");
		var message_tag = note_tag.split("<$=>");
		var lng = $('#note_longitude').val();
		var longitude = lng.split("<$=>");
		var lat = $('#note_latitude').val();
		var latitude = lat.split("<$=>");
		//alert(Number(longitude[0]));
		//control the number of bubble	
		//alert(message_id);
	function initialize(){
		var myOptions = {
		zoom: 5,
		center: new google.maps.LatLng(note_lat,note_lng),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true
		};
	}
	var myOptions = {
		zoom: 5,
		center: new google.maps.LatLng(note_lat,note_lng),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true
		};
	var map = new google.maps.Map(mapdiv, myOptions);
	var southWest = new google.maps.LatLng(note_lat-0.05,note_lng-0.05);
	var northEast = new google.maps.LatLng(note_lat+0.05,note_lng+0.05);

	var bounds = new google.maps.LatLngBounds(southWest, northEast);
	  map.fitBounds(bounds);

	var lngSpan = northEast.lng() - southWest.lng();
	var latSpan = northEast.lat() - southWest.lat();

	for (var i = 0; i < num; i++) {
	    var position = new google.maps.LatLng(
	    	Number(latitude[i]),
	    	Number(longitude[i])
	        //southWest.lat() + latSpan * Math.random(),
	        //southWest.lng() + lngSpan * Math.random()
	        );
	    var marker = new google.maps.Marker({
	      position: position,
	      map: map
	    });

	    marker.setTitle((i + 1).toString());
	    attachSecretMessage(marker, i, message, message_tag, message_id);
  	}

  	function attachSecretMessage(marker, num, note, note_tag, note_id) {
		  //var message = ['This', 'is', 'the', 'secret', 'message','xie','hong','quan','xie','xie','hong'];
		  var message = note;
		  var message_tag = note_tag;
		  var message_id = note_id;
		  var infowindow = new google.maps.InfoWindow({
		    content:"<strong style='font-family:arial;color:black;font-size:15px;''>"+message_tag[num]+"</strong><a href="+"comment/?flag="+message_id[num]+">comment</a></br>"+"<p style='font-family:arial;color:black;font-size:15px;'>"+message[num]+'</p>'
		  });
		  google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(marker.get('map'), marker);
		  });
	}
	google.maps.event.addDomListener(window, 'load', initialize);
		});
});
</script>

<div id="user_gmap"></div>

