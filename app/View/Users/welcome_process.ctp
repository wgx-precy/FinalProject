<?php 
$lat = $_COOKIE['userlat'];
$lng = $_COOKIE['userlng'];
echo $this->Form->create(null, array('url' => array('controller'=>'/Users/','action' =>'welcome_process')));
echo $this->Form->input('userlat', array('name'=>'userlat','value' => $lat));
echo $this->Form->input('userlng', array('name'=>'userlng','value' => $lng));
echo $this->Form->end('location');
?>
