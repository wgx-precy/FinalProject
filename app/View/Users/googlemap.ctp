<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style type="text/css">
#user_gmap{ width:600px;height:400px; margin:20px auto 0px; border:solid 1px #111; }
#user_glink {width:600px; text-align:right; font-size:10px; font-weight:normal; padding:0px; height:20px; margin:0px auto;}
</style>
<script type="text/javascript">
google.maps.event.addDomListener(window, 'load', function() {
	var mapdiv = document.getElementById('user_gmap');
	var myOptions = {
	zoom: 3,
	center: new google.maps.LatLng(34.166207146958016,108.89845648083497),
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	scaleControl: true
	};
	var map = new google.maps.Map(mapdiv, myOptions);
	var marker = new google.maps.Marker({
	position: new google.maps.LatLng(34.166207146958016,108.89845648083497),
	map: map, 
	title: 'test tag'
	});
	var infowindow = new google.maps.InfoWindow({
	content: '<strong>test tag</strong><br />这是我的位置',
	size: new google.maps.Size(200, 200)
	});
	google.maps.event.addListener(marker, 'click', function() {
	infowindow.open(map,marker);
	});
	infowindow.open(map,marker);

	var marker1 = new google.maps.Marker({
	position1: new google.maps.LatLng(34.1662071469,108.898456480),
	map: map, 
	title: 'test tag'
	});
	var infowindow = new google.maps.InfoWindow({
	content: '<strong>test tag</strong><br />这是我的位置',
	size: new google.maps.Size(200, 200)
	});
	google.maps.event.addListener(marker1, 'click', function() {
	infowindow.open(map,marker1);
	});
	infowindow.open(map,marker1);
});
</script>
<div id="user_gmap"></div>
<div id="user_glink"><a href="http://www.nap.st/google_map_generator/?lang=zh-CN" target="_blank">Google Map Generator</a></div>
