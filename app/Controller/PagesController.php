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
	public $uses = array('User', 'Note','Tag','UserFilter','Request','Friend','FilterTag','Comment');

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
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if($this->request->is('post')){
			$location = $this->request->data('filterLocation');
			$state = $this->request->data('state');
			$filterTimeType = $this->request->data('filterTimeType');
			$startDate = $this->request->data('startDate');
			if($startDate==null) $startDate = '0000-00-00';
			$endDate = $this->request->data('endDate');
			if($endDate==null) $endDate = '0000-00-00';
			$startWeek = $this->request->data('startWeek');
			$endWeek = $this->request->data('endWeek');
			$startHour = $this->request->data('startHour');
			$startMinute = $this->request->data('startMinute');
			$endHour = $this->request->data('endHour');
			$endMinute = $this->request->data('endMinute');
			$starttime = $startHour.":".$startMinute.":00";
			$endtime = $endHour.":".$endMinute.":00";
			$this->UserFilter->set(array(
					'uid' => $id,
					'district' => $location,
					'state' => $state,
					'choice' => $filterTimeType,
					'datestart' => $startDate,
					'dateend' => $endDate,
					'week1' => $startWeek,
					'week2' => $endWeek,
					'timestart' => $starttime,
					'timeend' => $endtime
			));
			$this->UserFilter->save(null,false);
			//print_r($startHour.":".$startMinute.":00");
			//print_r($endHour.":".$endMinute.":00");exit();
			echo '<script>parent.window.location.reload(true);</script>';

		}

	}

	public function search(){

	}

	public function note_map(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$this->Session->read('user.latitude');
		$this->Session->read('user.longitude');
		$this->set('mylatitude',$this->Session->read('user.latitude'));
		$this->set('mylongitude',$this->Session->read('user.longitude'));

		$result = $this->Note->query("/*f-date,n-date*/
select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date' 
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week, n-date*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-date, n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date'
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week,n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y from users_filters, zips, filters_tags,notes,tags  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid 
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = 'lunch break' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'");
		//echo date("Y/m/d");
		$count = count($result);
		//print($count);
		$i = 0;
		$note = null;
		$note_id = null;
		$latitude = null;
		$longitude = null;
		$com = '<$=>';
		for($i=0; $i<$count; $i++){
			$note = $note.$result[$i]['0']['note'].$com;
			$latitude = $latitude.$result[$i]['0']['nloc_y'].$com;
			$longitude = $longitude.$result[$i]['0']['nloc_x'].$com;
			$note_id = $note_id.$result[$i]['0']['nid'].$com;
		}
		$j = 0;
		$m = 0;
		for($j = 0;$j<$count;$j++){
			$nid = $result[$j]['0']['nid'];
			$temp_tag[$m] = $this->Tag->query("SELECT * FROM `tags` WHERE tags.nid = $nid");
			$m++;			
		}
		//print_r($note_id);
		$num_tag = count($temp_tag);
		$k = 0;
		$l = 0;
		$flag = ',';
		for($k=0;$k<$count;$k++){
		 	$result[$k]['0']['tag'] = null;
		 	for($l = 0;$l<$num_tag;$l++){
		 		if($result[$k]['0']['nid'] == $temp_tag[$l]['0']['tags']['nid']){
		 			foreach($temp_tag[$l] as $tag){
		 				$result[$k]['0']['tag'] = $result[$k]['0']['tag'].$tag['tags']['tag'];
		 			}
		 		}
		 	}
		}
		$l = 0;
		$note_tag = null;
		for($l = 0;$l<$num_tag;$l++){
			$note_tag = $note_tag.$result[$l]['0']['tag'].$com;
		}
		//print_r($result);
		//print_r($temp_tag);
		//print_r($note_tag);
		$this->set('message_id',$note_id);
		$this->set('num',$count);
		$this->set('message',$note);
		$this->set('message_tag',$note_tag);
		$this->set('latitude',$latitude);
		$this->set('longitude',$longitude);

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

		if($this->request->is('post')){
			//$location = $this->request->data('filterLocation');
			$noteContent = $this->request->data('noteContent');
			$noteTags = $this->request->data('noteTags');
			$visibility = $this->request->data('visibility');
			$state = $this->request->data('state');
			$range = $this->request->data('range');
			$noteTimeType = $this->request->data('noteTimeType');
			$startDate = $this->request->data('startDate');
			if($startDate==null) $startDate = '0000-00-00';
			$endDate = $this->request->data('endDate');
			if($endDate==null) $endDate = '0000-00-00';
			$startWeek = $this->request->data('startWeek');
			$endWeek = $this->request->data('endWeek');
			$startHour = $this->request->data('startHour');
			$startMinute = $this->request->data('startMinute');
			$endHour = $this->request->data('endHour');
			$endMinute = $this->request->data('endMinute');
			$starttime = $startHour.":".$startMinute.":00";
			$endtime = $endHour.":".$endMinute.":00";
			$this->Note->set(array(
					'uid' => $id,
					'nloc_x' => $longitude,
					'nloc_y' => $latitude,
					'state' => $state,
					'note' => $noteContent,
					'ntype' => $visibility,
					'nradius' => $range,
					'choice' => $noteTimeType,
					'datestart' => $startDate,
					'dateend' => $endDate,
					'week1' => $startWeek,
					'week2' => $endWeek,
					'starttime' => $starttime,
					'endtime' => $endtime
			));
			$this->Note->save(null,false);
			//print_r($starttime.$endtime);exit();
			$tag_nid = $this->Note->query("select max(notes.nid) from notes");
			//print_r($tag_nid);exit();
			$tagContent = $this->request->data('noteTags');
			$tag_array = split(',', $tagContent);
			$i = 0;
			$tagnum = count($tag_array);
			for($i=0;$i<$tagnum;$i++){
			 	$this->Tag->set(array(
			 		'nid' => $tag_nid['0']['0']['max(notes.nid)'],
			 		'tag' => $tag_array[$i]
			 		));
			 	$this->Tag->save(null,false);
			}
			//print_r($tag_array);exit();
			//$this->Tag->save->set(array('uid'));
			//print_r($startHour.":".$startMinute.":00");
			//print_r($endHour.":".$endMinute.":00");exit();
			echo '<script>parent.window.location.reload(true);</script>';

		}
	}

	public function friends(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$conditions = array('userfilter.uid'=>$id);
		$friends_list =$this->Friend->query("SELECT *  FROM  users inner join friends on friends.fid = users.id where friends.uid = $id");
		$this->set('friends',$friends_list);
		if($this->request->is('post')){
			$fid = $this->request->data('friend_id');
			$this->Friend->query("DELETE FROM `friends`WHERE friends.uid = $id and friends.fid =$fid ");
			echo '<script>parent.window.location.reload(true);</script>';
		}
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

	public function filterchoice (){


	}

//	public function 

}
