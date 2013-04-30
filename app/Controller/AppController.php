<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Js', 'Session', 'Form');
/*
	var $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'courses', 'action' => 'index'),
			'authError' => 'You must be logged in as a registered user to access that page.',
			'authorize' => array('Controller'),
		)
	);
*/
/*		
	public function isAuthorized() {
		return true;
	}
	
	public function beforeFilter() {
		session_start();

		$this->Auth->allow('');
		$current_user = $this->Auth->user();
		$this->set( 'logged_in', $this->Auth->loggedIn() );
		$this->set( 'full_user_info', $this->Auth->user() );
		$this->set( 'user_id', $this->Auth->user('id') );

		if ($this->Auth->user('psuedonym') != '') {
			$this->set( 'user_first_name', $this->Auth->user('psuedonym') );
		} else {
			$this->set( 'user_first_name', $this->Auth->user('email') );
		}
		
	//	$grav_default = 'http://'.$_SERVER['HTTP_HOST'].'/img/oa_icon.png';
	//	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->Auth->user('email') ) ) ) . "?d=" . urlencode( $grav_default ) . "&s=" . 50;
	//	$grav_url="/user_files".$this->Auth->user('thumbnail');
	//	$this->set( 'grav_img', $grav_url ); 
	}
	*/
}
