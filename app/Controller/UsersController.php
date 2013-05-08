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
	public function comment(){
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



		$result = $this->Note->query("/*f-date,n-date*/
select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date' 
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week, n-date*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-date, n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date'
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week,n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'");
		//echo date("Y/m/d");
		print_r($result);
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
