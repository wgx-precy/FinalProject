<?php
class UsersController extends AppController {
	public $name = 'Users';
	public $component = array('RequestHandlerComponent');
	public $uses = array('User','UserLocation','Comment','Note');


	public function login() {

	}
	public function login_process(){
		$username =$this->request->data('username');
		$password =$this->request->data('password');
		$conditions = array('user.username'=>$username);
		$user_info = $this->User->find('first',array('conditions'=>$conditions));
		$id=$user_info['User']['id'];
		if($user_info['User']['password']==$password){
			$this->Session->write('user.id', $id);
			$this->Session->write('user.login','true');
			$this->redirect(array('controller'=>'Users','action'=>'welcome'));
		}
		else{
			$this->redirect(array('controller'=>'Users','action'=>'incorrect_login'));
		}

	}
	public function register(){

	}
	public function register_process(){
		if($this->request->is('post')){
			$username =$this->request->data('username');
			$password1 =$this->request->data('password1');
			$password2 =$this->request->data('password2');
			$first_name =$this->request->data('firstname');
			$last_name =$this->request->data('lastname');
			if($password1!=$password2){
				$this->redirect(array('controller'=>'Users','action'=>'incorrect_password'));
			}
			else{
				$this->User->set(array(
					'username' => $username,
					'uemail' => $username,
					'password' => $password1,
					'first_name' => $first_name,
					'last_name' => $last_name,
				));
				$this->User->save(null,false);
				$this->redirect(array('controller'=>'Users','action'=>'register_success'));
			}
		}
	}
	public function register_success(){

	}
	public function welcome(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$this->set('id',$id);

	}
	public function welcome_process(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if($this->request->is('post')){
			$ulat =$this->request->data('userlat');
			$ulng =$this->request->data('userlng');
				$this->UserLocation->set(array(
					'uid' => $id,
					'location_x' => $ulat,
					'location_y' => $ulng,
				));
			$this->UserLocation->save(null,false);
			$this->Session->write('user.latitude',$ulat);
			$this->Session->write('user.longitude',$ulng);
			$this->redirect(array('controller'=>'Pages','action'=>'profile'));
		}
	}
	public function note_comment(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if(isset($_GET['flag'])){
			print_r($_GET['flag']);
			$this->set('nid',$_GET['flag']);
		}
		if($this->request->is('post')){
			print_r('hello');
			$comment =$this->request->data('username');
				$this->Comment->set(array(
					'cid' => '',
					'nid' => $_GET['flag'],
					'uid' => $id,
					'ctime' => '',
					'cnote' => $comment,
				));
			$this->Comment->save(null,false);
			$this->redirect(array('controller'=>'Users','action'=>'note_comment'));
		}
	}
	public function comment(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if(isset($_GET['flag'])){
			$nid = $_GET['flag'];
			$this->set('nid',$_GET['flag']);
		}
		$comments = $this->Comment->query("SELECT * FROM `comments`, `users` WHERE nid = $nid and comments.uid = users.id ");
		$note = $this->Note->query("SELECT * FROM `notes`, `users` WHERE nid = $nid and notes.uid = users.id");
		$this->set('comments',$comments);
		$this->set('note',$note);
		if($this->request->is('post')){
			$comment =$this->request->data('username');
				$this->Comment->set(array(
					'cid' => '',
					'nid' => $_GET['flag'],
					'uid' => $id,
					'ctime' => '',
					'cnote' => $comment,
				));
			$this->Comment->save(null,false);
			echo '<script>parent.window.location.reload(true);</script>';		
		}

	}
	public function incorrect_login(){

	}
	public function incorrect_password(){

	}
	public function logout(){

	}
	public function geoname(){

	}
	public function googlemap(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
	}
	public function getlocation(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}

	}
	public function googletest(){

	}
}
