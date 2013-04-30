<?php
/* 
 * @file 
 * Open Assembly User model.
 *
 * Defines the model for a User object.
 */
 
class Friend extends AppModel {
	var $name = 'Friends';
	var $useDbConfig = 'default';
	
	// public $hasOne = array(
	// 	'UserProfile' =>
	// 		array(
	// 			'className' => 'UserProfile',
	// 		),
	// );
	
	public $hasMany = array(
		'User',
	);
	
	// public $hasAndBelongsToMany = array(
	// 	'Roles' =>
	// 		array(
	// 			'className' => 'UserRole',
	// 		),
	// );
	/*
    public $validate = array(
        'username' => array (
			'correctLength' => array(
				'rule' => array('between',6,128),		
				'message'=> 'The email address must be between 6 and 128 characters long.',
			),
			'isUniqueUsername' => array(
				'rule'=> 'isUnique',
				'message'=> 'The email address you supplied is already chosen. Please supply a unique username.',
				'required' => true,
				'allowEmpty' => false,
			),
			'isEmail' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,			
				'message'=> 'You must supply a valid email address.',				
			),		
		),
		'password' => array(
			'correctLength' => array(
				'rule' => array('between',6,64),
				'required' => true,
				'allowEmpty' => false,			
				'message'=> 'Password should contain no fewer than 6 characters, and no more than 64.',
			//	'last' => false,				
			),			
		),
		'first_name' => array(
			'correctLength' => array(
				'rule' => array('between',1,64),
				'required' => true,		
				'message'=> 'Please provide your first name.'
			),	
		
		), 
		'last_name' => array(
			'correctLength' => array(
				'rule' => array('between',1,64),
				'required' => true,		
				'message'=> 'Please provide your last name.'		
			),	
		
		),
		
    );

	public function beforeSave($options = array()) {
		if( isset($this->data['User']['password']) && !isset($this->data['User']['confirmed']) && $this->data['User']['password'] != '' ) {	
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}

		if(isset($this->data['User']['username'])) {
			$this->data['User']['email'] = $this->data['User']['username'];
		}
		if(!isset($this->data['User']['email_confirm_code'])) {
			$this->data['User']['email_confirm_code'] = substr(md5(uniqid(rand(), true)), 0, 16); 
		}
		return true;
	}
	
	public function sendRegistrationEmail($theUniqueID, $theUserEmail) {
		App::uses('CakeEmail', 'Network/Email');
		$theSubject = 'Confirm your Open Assembly user account';
		$email = new CakeEmail();
		$email->config('default');
		$email->template('registration', 'default');
		$email->emailFormat('both');
		$email->viewVars(array('confirm_code' => $theUniqueID));
		$email->viewVars(array('email_subject' => $theSubject));
		$email->viewVars(array('url' => $_SERVER['HTTP_HOST']));
		$email->viewVars(array('email_subject' => $theSubject));
		$email->to($theUserEmail);
		$email->subject($theSubject);
		$email->send();	
	}
	
	public function sendForgotPasswordEmail($theUserEmail, $theTempPassword) {
		App::uses('CakeEmail', 'Network/Email');
		$theSubject = 'Open Assembly account password reset';
		$email = new CakeEmail();
		$email->config('default');
		$email->template('forgot_password', 'default');
		$email->emailFormat('both');
		$email->viewVars(array('temp_pass' => $theTempPassword));
		$email->viewVars(array('email_subject' => $theSubject));
		$email->to($theUserEmail);
		$email->subject($theSubject);
		$email->send();	
	}
	
	public function fullUserName($user_id = null) {

		if($user_id == null) {
			return null;
		} else {
			$conditions = array('User.id' => $user_id);
			$user_object = $this->find('first', array('conditions' => $conditions));
			
			if ($user_object['User']['psuedonym'] != null) {
				return $user_object['User']['psuedonym'];
			}
			else if($user_object['User']['username'] != null){
				return $user_object['User']['username'];
			}
			else {
				return null;
			}
		}
	}
	*/
}
