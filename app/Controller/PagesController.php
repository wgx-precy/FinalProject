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
	// public function logout(){
	// 	$id = $this->Session->read('user.id');
	// 	$login = $this->Session->read('user.login');
	// 	if($login != 'true'){
	// 		$this->redirect(array('controller'=>'Users','action'=>'login'));
	// 	}
	// 	$this->Session->write('user.login','false');
	// 	echo '<script>parent.window.location.reload(true);</script>';

	// }

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
		$fid = $user_filters['0']['users_filters']['fid'];
		//$filters_tags = $this->FilterTag->query("SELECT * FROM `filters_tags` WHERE filters_tags.fid = ")
		$num = count($user_filters);
		$i = 0;
		for($i=0;$i<$num;$i++){
			$fid[$i] = $user_filters[$i]['users_filters']['fid'];
			$filters_tags[$i] = $this->FilterTag->query("SELECT * FROM `filters_tags` WHERE filters_tags.fid = $fid[$i]");
		}
		$no = count($filters_tags);
		$k = 0;	
		//print_r($filters_tags);
		for($i=0;$i<$num;$i++){
			$user_filters[$i]['users_filters']['tags'] = null;
			for($k=0;$k<$no;$k++){
				if($user_filters[$i]['users_filters']['fid'] == $filters_tags[$k]['0']['filters_tags']['fid'])
					$user_filters[$i]['users_filters']['tags'] = $user_filters[$i]['users_filters']['tags'].$filters_tags[$k]['0']['filters_tags']['tag'];
			}
		}
		//print_r($user_filters);
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
			$filterTags = $this->request->data('filterTags');
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
//

			$tag_nid = $this->UserFilter->query("select max(users_filters.fid) from users_filters");
			//print_r($tag_nid);exit();
			$tagContent = $this->request->data('filterTags');
			$tag_array = split(',', $tagContent);
			$i = 0;
			$tagnum = count($tag_array);
			for($i=0;$i<$tagnum;$i++){
			 	$this->FilterTag->set(array(
			 		'nid' => $tag_nid['0']['0']['max(users_filters.fid)'],
			 		'tag' => $tag_array[$i]
			 		));
			 	$this->FilterTag->save(null,false);
			}
			// print_r($tag_array[0]);exit();
//
			//print_r($startHour.":".$startMinute.":00");
			//print_r($endHour.":".$endMinute.":00");exit();
			echo '<script>parent.window.location.reload(true);</script>';

		}

	}

	public function search(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if($this->request->is('post')){
		$keyWords = $this->request->data('kayWords');
		$ifByArea = $this->request->data('ifByArea');
		$selectArea = $this->request->data('selectArea');
		//print_r($ifByArea);
		if($ifByArea == 'yes'){
			$searchresult = $this->Note->query("select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from  zips, notes,tags, users
where notes.uid = users.id and notes.nid = tags.nid and zips.district = '$selectArea' and notes.choice = 'date' and (notes.note like '%$keyWords%' or tags.tag like '%$keyWords%')
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and zips.z_x1<=notes.nloc_x and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from  zips, notes,tags, users
where notes.uid = users.id and notes.nid = tags.nid and zips.district = '$selectArea' and notes.choice = 'week' and (notes.note like '%$keyWords%' or tags.tag like '%$keyWords%')
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and zips.z_x1<=notes.nloc_x and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'"
				);
		}
		if($ifByArea != 'yes'){
			//print_r($ifByArea);
			$searchresult = $this->Note->query("select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from  notes,tags, users
where notes.uid = users.id and notes.nid = tags.nid and notes.choice = 'date' and (notes.note like '%$keyWords%' or tags.tag like '%$keyWords%')
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from  notes,tags, users
where notes.uid = users.id and notes.nid = tags.nid and notes.choice = 'week' and (notes.note like '%$keyWords%' or tags.tag like '%$keyWords%')
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'"
				);

		}
		//print_r($searchresult);
		if(isset($searchresult)){
			$this->set('searchresult',$searchresult);
		}
		
		
		}
	}

	public function note_map(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		$this->Session->read('user.latitude');
		$this->Session->read('user.longitude');
		$state = $this->Session->read('user.state');
		$this->set('mylatitude',$this->Session->read('user.latitude'));
		$this->set('mylongitude',$this->Session->read('user.longitude'));


		$result = $this->Note->query("/*f-date,n-date*/
select  distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from users_filters, zips, filters_tags,notes,tags,users  
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid and users.id = notes.uid
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date' 
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = '$state' and zips.z_x1<=notes.nloc_x
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week, n-date*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from users_filters, zips, filters_tags,notes,tags,users 
where users_filters.uid = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid and users.id = notes.uid
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'date' 
and month(notes.startdate)*100+day(notes.startdate) <= month(current_date())*100+day(current_date()) and month(notes.enddate)*100+day(notes.enddate) >= month(current_date())*100+day(current_date) and users_filters.state = '$state' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-date, n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from users_filters, zips, filters_tags,notes,tags, users  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid and users.id = notes.uid
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'date'
and month(users_filters.datestart)*100+day(users_filters.datestart) <= month(current_date())*100+day(current_date()) and month(users_filters.dateend)*100+day(users_filters.dateend) >= month(current_date())*100+day(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = '$state' and zips.z_x1<=notes.nloc_x 
and zips.z_x2>=notes.nloc_x and zips.z_y2<=notes.nloc_y and zips.z_y1>=notes.nloc_y and hour(users_filters.timestart)*100+minute(users_filters.timestart) <= hour(current_time())*100+minute(users_filters.timestart) 
and hour(users_filters.timeend)*100+minute(users_filters.timeend) >= hour(current_time())*100+minute(current_time()) and hour(notes.starttime)*100+minute(notes.starttime) <= hour(current_time())*100+minute(current_time()) and hour(notes.endtime)*100+minute(notes.endtime) >= hour(current_time())*100+minute(current_time()) and notes.ntype = 'public'
union
/*f-week,n-week*/
select distinct notes.nid, notes.uid, notes.time, notes.note, notes.like_value, notes.nloc_x, notes.nloc_y, users.first_name from users_filters, zips, filters_tags,notes,tags, users  
where users_filters.uid  = $id and  users_filters.district = zips.district and users_filters.fid = filters_tags.fid and users.id = notes.uid
and notes.nid = tags.nid and filters_tags.tag = tags.tag and users_filters.choice = 'week' 
and users_filters.week1 <= dayofweek(current_date()) and users_filters.week2 >= dayofweek(current_date()) and notes.choice = 'week' 
and notes.week1 <= dayofweek(current_date()) and notes.week2 >= dayofweek(current_date()) and users_filters.state = '$state' and zips.z_x1<=notes.nloc_x 
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
		$first_name = null;
		$com = '<$=>';
		for($i=0; $i<$count; $i++){
			$note = $note.$result[$i]['0']['note'].$com;
			$latitude = $latitude.$result[$i]['0']['nloc_y'].$com;
			$longitude = $longitude.$result[$i]['0']['nloc_x'].$com;
			$note_id = $note_id.$result[$i]['0']['nid'].$com;
			$first_name = $first_name.$result[$i]['0']['first_name'].$com;
		}
		$j = 0;
		$m = 0;
		for($j = 0;$j<$count;$j++){
			$nid = $result[$j]['0']['nid'];
			$temp_tag[$m] = $this->Tag->query("SELECT * FROM `tags` WHERE tags.nid = $nid");
			$m++;			
		}
		if(isset($result)){
		$num_tag = count($result);
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
		$this->set('message_tag',$note_tag);
	}
		$this->set('latitude',$latitude);
		$this->set('longitude',$longitude);
		$this->set('first_name',$first_name);
		$this->set('message_id',$note_id);
		$this->set('num',$count);
		$this->set('message',$note);

		$long=floatval($this->Session->read('user.latitude'));
		$lat=floatval($this->Session->read('user.longitude'));
		$result2 = $this->Note->query("select * from Notes, Friends, Users
where 6 = Friends.uid and Friends.fid = Notes.uid and Notes.nloc_x >= $lat - (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) 
and Notes.nloc_x <= $lat + (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) and Notes.nloc_y >= $long - (360*nradius)/(2*3.141592653589793*6371004) 
and Notes.nloc_y <= $long + (360*nradius)/(2*3.141592653589793*6371004) and choice = 'date' and month(startdate)*100 + day(startdate) <= month(current_date)*100 + day(current_date) 
and month(enddate)*100 + day(enddate) >= month(current_date)*100 + day(current_date) and hour(starttime)*100 + minute(starttime) <= hour(current_time)*100 + minute(current_time) 
and hour(endtime)*100 + minute(endtime) >= hour(current_time)*100 + minute(current_time) and users.id = notes.uid
union
select * from Notes, Friends, Users
where 6 = Friends.uid and Friends.fid = Notes.uid and Notes.nloc_x >= $lat - (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) 
and Notes.nloc_x <= $lat + (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) and Notes.nloc_y >= $long - (360*nradius)/(2*3.141592653589793*6371004) 
and Notes.nloc_y <= $long + (360*nradius)/(2*3.141592653589793*6371004) and choice = 'week' and week1 <= dayofweek(current_date) and week2 >= dayofweek(current_date) 
and hour(starttime)*100 + minute(starttime) <= hour(current_time)*100 + minute(current_time) and hour(endtime)*100 + minute(endtime) >= hour(current_time)*100 + minute(current_time) 
and users.id = notes.uid
union 
select * from Notes, Friends, Users
where 6 = Friends.uid and Friends.fid != Notes.uid and Notes.ntype = 'public' and Notes.nloc_x >= $lat - (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) 
and Notes.nloc_x <= $lat + (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) and Notes.nloc_y >= $long - (360*nradius)/(2*3.141592653589793*6371004) 
and Notes.nloc_y <= $long + (360*nradius)/(2*3.141592653589793*6371004) and choice = 'date' and month(startdate)*100 + day(startdate) <= month(current_date)*100 + day(current_date) 
and month(enddate)*100 + day(enddate) >= month(current_date)*100 + day(current_date) and hour(starttime)*100 + minute(starttime) <= hour(current_time)*100 + minute(current_time) 
and hour(endtime)*100 + minute(endtime) >= hour(current_time)*100 + minute(current_time) and users.id = notes.uid
union 
select * from Notes, Friends, Users
where 6 = Friends.uid and Friends.fid != Notes.uid and Notes.ntype = 'public' and Notes.nloc_x >= $lat - (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) 
and Notes.nloc_x <= $lat + (360*nradius)/(2*3.141592653589793*6371004*cos(Notes.nloc_y*2*3.141592653589793/360)) and Notes.nloc_y >= $long - (360*nradius)/(2*3.141592653589793*6371004) 
and Notes.nloc_y <= $long + (360*nradius)/(2*3.141592653589793*6371004) and choice = 'week' and week1 <= dayofweek(current_date) and week2 >= dayofweek(current_date) 
and hour(starttime)*100 + minute(starttime) <= hour(current_time)*100 + minute(current_time) and hour(endtime)*100 + minute(endtime) >= hour(current_time)*100 + minute(current_time) 
and users.id = notes.uid");
		//print_r($result2);
		$count2 = count($result2);
		$i = 0;
		$look_note = null;
		$look_note_id = null;
		$look_latitude = null;
		$look_longitude = null;
		$look_first_name = null;
		$com = '<$=>';
		for($i=0; $i<$count2; $i++){
			$look_note = $look_note.$result2[$i]['0']['note'].$com;
			$look_latitude = $look_latitude.$result2[$i]['0']['nloc_y'].$com;
			$look_longitude = $look_longitude.$result2[$i]['0']['nloc_x'].$com;
			$look_note_id = $look_note_id.$result2[$i]['0']['nid'].$com;
			$look_first_name = $look_first_name.$result2[$i]['0']['first_name'].$com;
		}
		$j = 0;
		$m = 0;
		for($j = 0;$j<$count2;$j++){
			$nid = $result2[$j]['0']['nid'];
			$look_temp_tag[$m] = $this->Tag->query("SELECT * FROM `tags` WHERE tags.nid = $nid");
			$m++;			
		}
		//print_r($note_id);
		$look_note_tag = null;
		if(isset($look_temp_tag)){
		$look_num_tag = count($look_temp_tag);
		$k = 0;
		$l = 0;
		$flag = ',';
		for($k=0;$k<$count2;$k++){
		 	$result2[$k]['0']['tag'] = null;
		 	for($l = 0;$l<$look_num_tag;$l++){
		 		if($result2[$k]['0']['nid'] == $look_temp_tag[$l]['0']['tags']['nid']){
		 			foreach($look_temp_tag[$l] as $look_tag){
		 				$result2[$k]['0']['tag'] = $result2[$k]['0']['tag'].$look_tag['tags']['tag'];
		 			}
		 		}
		 	}
		}
		$l = 0;
		for($l = 0;$l<$look_num_tag;$l++){
			$look_note_tag = $look_note_tag.$result2[$l]['0']['tag'].$com;
		}
		//print_r($look_note.$look_latitude.$look_note_id.$look_first_name.$look_note_tag);				
		}
		$this->set('look_message_tag',$look_note_tag);
		$this->set('look_message_id',$look_note_id);
		$this->set('num2',$count2);
		$this->set('look_message',$look_note);
		$this->set('look_latitude',$look_latitude);
		$this->set('look_longitude',$look_longitude);
		$this->set('look_first_name',$look_first_name);



	}
	public function comment(){
		$id = $this->Session->read('user.id');
		$login = $this->Session->read('user.login');
		if($login != 'true'){
			$this->redirect(array('controller'=>'Users','action'=>'login'));
		}
		if(isset($_GET['like'])){
			$nid = $_GET['flag'];
			$this->set('nid',$_GET['flag']);
			$temp_note = $this->Note->query("SELECT * FROM `notes`, `users` WHERE nid = $nid and notes.uid = users.id");
			$like = $temp_note['0']['notes']['like_value']+1;
			$this->Note->query("UPDATE `notes` SET  `like_value` =  $like WHERE  notes.nid = $nid ");		
			$comments = $this->Comment->query("SELECT * FROM `comments`, `users` WHERE nid = $nid and comments.uid = users.id ");
			$note = $this->Note->query("SELECT * FROM `notes`, `users` WHERE nid = $nid and notes.uid = users.id");
			$this->set('comments',$comments);
			$this->set('note',$note);
			echo "<script>location.href='/FinalProject/Pages/comment/?flag=$nid'</script>"; 
		}
		
		if(isset($_GET['flag'])&& !isset($_GET['like'])){
			$nid = $_GET['flag'];
			$this->set('nid',$_GET['flag']);		
			$comments = $this->Comment->query("SELECT * FROM `comments`, `users` WHERE nid = $nid and comments.uid = users.id ");
			$note = $this->Note->query("SELECT * FROM `notes`, `users` WHERE nid = $nid and notes.uid = users.id");
			//print_r($note);
			$this->set('comments',$comments);
			$this->set('note',$note);
			//echo "<script>location.href='http://www.project.com/FinalProject/Pages/comment/?flag=$nid'</script>"; 
		}

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
			$startDate = '0000-00-00';
			if($noteTimeType=='date'){
				$startDate = $this->request->data('startDate');
			}		
			$endDate = '0000-00-00';
			if($noteTimeType=='date'){
				$endDate = $this->request->data('endDate');
			}		
				
			//$startDate = $this->request->data('startDate');	
			//$endDate = $this->request->data('endDate');
			// $startDate = $this->request->data('startDate');
			// if($startDate==null) $startDate = '0000-00-00';
			// $endDate = $this->request->data('endDate');
			// if($endDate==null) $endDate = '0000-00-00';
			// $startWeek = $this->request->data('startWeek');
			if($noteTimeType=='week'){$startWeek = $this->request->data('startWeek');}
			else{$startWeek = '0';}
			if($noteTimeType=='week'){$endWeek = $this->request->data('endWeek');}		
			else{$endWeek = '0';}		
			//$startWeek = $this->request->data('startWeek');
			//$endWeek = $this->request->data('endWeek');
			$startHour = $this->request->data('startHour');
			$startMinute = $this->request->data('startMinute');
			$endHour = $this->request->data('endHour');
			$endMinute = $this->request->data('endMinute');
			$starttime = $startHour.":".$startMinute.":00";
			$endtime = $endHour.":".$endMinute.":00";
			$allowComment = $this->request->data('allowComment');
			$this->Note->set(array(
					'uid' => $id,
					'nloc_x' => $longitude,
					'nloc_y' => $latitude,
					'state' => $state,
					'note' => $noteContent,
					'ntype' => $visibility,
					'ncomment' => $allowComment,
					'nradius' => $range,
					'choice' => $noteTimeType,
					'startdate' => $startDate,
					'enddate' => $endDate,
					'week1' => $startWeek,
					'week2' => $endWeek,
					'starttime' => $starttime,
					'endtime' => $endtime
			));
			$this->Note->save(null,false);
			//print_r($startDate.$endDate.$noteTimeType.$startWeek.$endWeek);exit();
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
			$this->Request->set(array(
					'uid' => $id,
					'fid' => $fid,
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
