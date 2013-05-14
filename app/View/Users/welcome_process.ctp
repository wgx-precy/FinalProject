<?php $this->Html->css('default', null, array('inline' => false)); ?>
<?php 
$lat = $_COOKIE['userlat'];
$lng = $_COOKIE['userlng'];
echo $this->Form->create(null, array('url' => array('controller'=>'/Users/','action' =>'welcome_process')));
echo $this->Form->input('latitude', array('name'=>'userlat','value' => $lat));
echo $this->Form->input('longtitude', array('name'=>'userlng','value' => $lng));
?>

<b>State: &nbsp</b>
		
<select name="state">
	<option value="at home">at home</option>
	<option value="at work">at work</option>
	<option value="lunch break">lunch break</option>
	<option value="shopping">shopping</option>
	<option value="at school">at school</option>
</select>

<?php
echo $this->Form->end('location');
?>
