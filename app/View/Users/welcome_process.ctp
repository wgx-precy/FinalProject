<?php $this->Html->css('default', null, array('inline' => false)); ?>
<?php 
$lat = $_COOKIE['userlat'];
$lng = $_COOKIE['userlng'];
echo $this->Form->create(null, array('url' => array('controller'=>'/Users/','action' =>'welcome_process')));
echo $this->Form->input('latitude', array('name'=>'userlat','value' => $lat));
echo $this->Form->input('longtitude', array('name'=>'userlng','value' => $lng));
echo $this->Form->end('location');
?>
