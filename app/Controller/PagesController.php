<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User', 'Note','Tag','UserFilter','Request','Friend','FilterTag');

	public $helpers = array('Html');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
/*
function beforeFilter() {
	parent::beforeFilter();
    //$this->Auth->allow('login', 'logout','login_process','front','register_success','incorrect_login','incorrect_password');   	
}
*/
	public function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

	public function front(){
		
	}
	public function index(){
		
	}

	//user profile pages
	public function profile(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$conditions = array('user.id'=>$id);
		$user_profile = $this->User->find('all',array('conditions'=>$conditions));
		$this->set('user_profile',$user_profile);
	}

	public function filter(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$conditions = array('userfilter.uid'=>$id);
		//$user_filters = $this->UserFilter->find('all',array('conditions'=>$conditions));
		$user_filters =$this->UserFilter->query("SELECT * FROM `users_filters` WHERE uid = $id");
		//print_r($user_filters);
		print_r("JINGO");
		$this->set('user_filters',$user_filters);
		if($this->request->is('post')){
			$fid = $this->request->data('filter_id');
			$this->UserFilter->query("DELETE FROM `users_filters`WHERE users_filters.fid = $fid");
			$this->FilterTag->query("DELETE FROM `filters_tags`WHERE filters_tags.fid = $fid");
			echo '<script>parent.window.location.reload(true);</script>';
		}


	}

	public function addfilter(){

	}

	public function search(){

	}

	public function touchmap(){

	}

	public function postnote(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$latitude = $this->Session->read('user.latitude');
		$longitude = $this->Session->read('user.longitude');
		$this->set('latitude',$latitude);
		$this->set('longitude',$longitude);
	}

	public function friends(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$conditions = array('userfilter.uid'=>$id);
		//$user_filters = $this->UserFilter->find('all',array('conditions'=>$conditions));
		$friends_list =$this->Friend->query("SELECT *  FROM  users inner join friends on friends.fid = users.id where friends.uid = $id");
		$this->set('friends',$friends_list);
	}

	public function addfriend(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if($this->request->is('post')){
			$useremail = $this->request->data('useremail');
			$userinfo = $this->User->query("select * from users where users.username = '$useremail'");
			//print_r($userinfo);
			$fid = $userinfo['0']['users']['id'];
			$this->Request->set(array(
					'uid' => $fid,
					'fid' => $id,
				));
			$this->Request->save(null,false);
			echo '<script>parent.window.location.reload(true);</script>';
		}

	}

	public function requests(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$friend_request = $this->Request->query("select * from requests inner join users on requests.fid = users.id where requests.uid = $id and status = 'request'");
		//print_r($friend_request);
		$this->set('friend_request',$friend_request);	
		if($this->request->is('post')){
			$rid =$this->request->data('requestid');
			$fid =$this->request->data('fid');
			$permit =$this->request->data('permit');
			$ignore =$this->request->data('ignore');
			$this->Request->query("update requests set requests.status = 'friend' where requests.id = $rid");
			$this->Friend->set(array(
					'uid' => $id,
					'fid' => $fid,
				));
			$this->Friend->save(null,false);
			echo '<script>parent.window.location.reload(true);</script>';
		}
	}

//	public function 

}
