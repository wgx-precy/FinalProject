<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<?php $this->Html->css('default', null, array('inline' => false)); ?>
<style type="text/css">
#user_gmap{ width:800px;height:500px; margin: 0px auto 0px; border:solid 1px #111; }
#user_glink {width:600px; text-align:right; font-size:10px; font-weight:normal; padding:0px; height:20px; margin:0px auto;}
</style>

<?php
  $note_lat = 40.730901;
  $note_lng = -73.997684;
  $num = 3;
  ?>
<input type="submit" name="submit" value="Login" class="button" id="login_button"/>
<?php
  echo $this->Form->input('lat', array('type' => 'hidden', 'id' => 'note_lat','value' => $note_lat));
  echo $this->Form->input('lng', array('type' => 'hidden', 'id' => 'note_lng','value' => $note_lng));
?>
<script type="text/javascript">
google.maps.event.addDomListener(window, 'load', function() {
  var mapdiv = document.getElementById('user_gmap');
  $('#login_button').click(function(e){
    var note_lat = Number($('#note_lat').val());
    var note_lng = Number($('#note_lng').val());
    //control the number of bubble
    var num =3;   
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
          southWest.lat() + latSpan * Math.random(),
          southWest.lng() + lngSpan * Math.random());
      var marker = new google.maps.Marker({
        position: position,
        map: map
      });

      marker.setTitle((i + 1).toString());
      attachSecretMessage(marker, i);
    }

    function attachSecretMessage(marker, num) {
      var message = ['This', 'is', 'the', 'secret', 'message','xie','hong','quan','xie','xie','hong'];
      var infowindow = new google.maps.InfoWindow({
        content:message[num]
      });

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(marker.get('map'), marker);
      });
  }
  //google.maps.event.addDomListener(window, 'load', initialize);
    });
});
</script>
<div id="user_gmap"></div>