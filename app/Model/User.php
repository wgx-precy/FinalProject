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
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
    );

}
