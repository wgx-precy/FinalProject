<?php
/* 
 * @file 
 * Open Assembly User model.
 *
 * Defines the model for a User object.
 */
 
class User extends AppModel {
	var $name = 'Users';
	var $useDbConfig = 'default';
	
	public $hasMany = array(

	);

}
