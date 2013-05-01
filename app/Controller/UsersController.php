<?php


class UsersController extends AppController {
	public $name = 'Users';
	public $component = array('RequestHandlerComponent');
	public $uses = array('User');

//function beforeFilter() {
	// after finish the login part, cancel this comment
    //$this->Auth->allow('login', 'logout');
    //$this->Auth->allow();
    //$this->Auth->autoRedirect = false;
   // parent::beforeFilter();
//}

	public function login() {

		//if($this->Auth->User()) {

        	//$th
    		//$this->redirect(array('controller'=>'Pages','action'=>'front'));
    	//}
    	//echo "hey you";
    		//$this->redirect(array('controller'=>'Pages','action'=>'front'));
    	//}
    	//echo "hey you";

    	//$username=$this->request->data('username');
    	//print_r($username);


	}
	public function login_process(){
		$username =$this->request->data('username');
		$password =$this->request->data('password');
		$conditions = array('user.username'=>$username);
		$user_info = $this->User->find('first',array('conditions'=>$conditions));
		if($user_info['User']['password']==$password){
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
			if($password1!=$password2){
				$this->redirect(array('controller'=>'Users','action'=>'incorrect_password'));
			}
			else{
				//save profile

				$this->redirect(array('controller'=>'Users','action'=>'welcome'));
			}


		}
	}
	public function welcome(){

	}
	public function incorrect_login(){

	}
	public function incorrect_password(){

	}



/*	
	function jsonRegister() {
		$errors = array();
		$registration_output_array = array(
			'registration_output' => array(
				'success' => false,
				'validation_errors' => null,
			),
		);
		
		if ($this->request->is('post')) {
			//require_once('/home/openassembly/http_docs/app/webroot/libs/recaptcha-php-1.11/recaptchalib.php');
			$privatekey = '6Lcfg9MSAAAAAPGd22rBVOCpnloX6eVOM_Hi-gNp';
			//$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $this->request->data['jquery_post_data']['recaptcha_challenge_field'], $this->request->data['jquery_post_data']['recaptcha_response_field']);


				if ($this->User->save($this->request->data['jquery_post_data']['User'])) {
					$last = $this->User->findById($this->User->id);
					
					$this->User->sendRegistrationEmail($last['User']['email_confirm_code'], $last['User']['email']); 
					$registration_output_array = array(
						'registration_output' => array(
							'success' => true,
						),
					);
					$this->set('json_output', $registration_output_array);

					$conditions = array('CoursesUser.username' => $last['User']['username']);
					$set = array('CoursesUser.user_id' => $last['User']['id'], 'CoursesUser.subscribed' => 1);

  					$this->CoursesUser->updateAll($set, $conditions);

  					$check = $this->CoursesUser->find('list', array('conditions' => $conditions));
  					if(empty($check)){

  								$sample_course=16;
			  					$sample_content_no=49;
  						  		//sample content
			  					$uid = $last['User']['id'];
			  					$sample_content = array('OpenLibraryImport' => array('content_item_id' => $sample_content_no, 'user_id' => $uid));
			  					$this->OpenLibraryImport->save($sample_content);
			  					

								
								//register as student, take the sample course
								if($last['User']['role_id'] == 3){
									$data=array();
									$data['CoursesUser']['user_id'] = $last['User']['id'];
									$data['CoursesUser']['course_id'] = $sample_course;
									$data['CoursesUser']['subscribed'] = 1;
									$this->CoursesUser->save($data);
								}
								else{
										//copy a sample course
					  					App::uses('File', 'Utility');
					  					App::uses('Folder', 'Utility');
					  					$dir = new Folder(WWW_ROOT.'user_files/user_'.$uid, true, 0755);
					  					$dir = new Folder(WWW_ROOT.'user_files/user_'.$uid.'/course_images', true, 0755);
					  					$dir = new Folder(WWW_ROOT.'user_files/user_'.$uid.'/course_syllabi', true, 0755);
					  					
				  						//make a copy to local course
									    $conditions = array('Course.id' => $sample_course);
										$original_course = $this->Course->find('first', array('conditions' => $conditions));

										//copy course image
										$dest1 = "";
										$image = array();
										if($original_course['Course']['course_image']!=""){
											$file =  new File(WWW_ROOT.'/user_files'.$original_course['Course']['course_image'],false,0777);
											$dest1 = "/user_".$uid."/course_images/";
											$image = explode("/",$original_course['Course']['course_image']);
											$file->copy(WWW_ROOT.'/user_files/user_'.$uid."/course_images/".$image[3], true);
										}

										//copy syllabus
										$dest2 = "";
										$syllabus = array();
										if($original_course['Course']['syllabus_file']!=""){
											$file =  new File(WWW_ROOT.'/user_files'.$original_course['Course']['syllabus_file'],false,0777);
											$dest2 = "/user_".$uid."/course_syllabi/";
											$syllabus = explode("/",$original_course['Course']['syllabus_file']);

											$file->copy(WWW_ROOT.'/user_files/user_'.$uid."/course_syllabi/".$syllabus[3], true);
										}
										
										$copycourse=$sample_course;
					  					$this->Course->copy($sample_course);
										$new_course = $this->Course->id;
										$attribution = $original_course['Course']['attribution'];

										$this->Course->read(null, $new_course);
										$this->Course->set('user_id', $uid);
										$this->Course->set('imported', 1);
										if($dest1 != ""){
											$this->Course->set('course_image', $dest1.$image[3]);
										}
										if($dest2 != ""){
											$this->Course->set('syllabus_file', $dest2.$syllabus[3]);
										}					
										$this->Course->set('openlibrary', 'local');
										$this->Course->set('attribution', $attribution.", ".$last['User']['first_name']." ".$this->Auth->user('last_name'));
										$this->Course->save(null,false);

										$conditions = array('Module.course_id' => $sample_course);
										$old_modules = $this->Module->find('list', array('conditions' => $conditions));

										$conditions = array('Module.course_id' => $new_course);
										$new_modules = $this->Module->find('list', array('conditions' => $conditions));

										$new_new_modules = array();
										foreach ($new_modules as $value) {
											$new_new_modules[] = $value;
										}
										$i=0;
										foreach ($old_modules as $value) {
											//seach for topics
											$conditions = array('Topic.module_id' => $value);
											$old_topics = $this->Topic->find('list', array('conditions' => $conditions));

											$new_module = $new_new_modules[$i];

											foreach ($old_topics as $value1) {
												$this->Topic->copy($value1);
												$this->Topic->read(null, $this->Topic->id);
												$this->Topic->set('module_id', $new_module);
												$this->Topic->save(null,false);
											}

											//seach for contents
											$conditions = array('ModulesContentItem.module_id' => $value);
											$old_contents = $this->ModulesContentItem->find('list', array('conditions' => $conditions));

											foreach ($old_contents as $value2) {
												$this->ModulesContentItem->copy($value2);
												$this->ModulesContentItem->read(null, $this->ModulesContentItem->id);
												$this->ModulesContentItem->set('module_id', $new_module);
												$this->ModulesContentItem->save(null,false);
											}

											$i++;
										}
								}
								
  					}

				} else {
					$invalid_fields = $this->User->invalidFields();
					foreach($invalid_fields as $invalid_field) {
						$errors[] = $invalid_field[0];
					}
				}
			//}
		} else {
			$errors[] = 'Not post.';
		}
		
		if (count($errors) > 0 && $registration_output_array['registration_output']['success'] != true) {
			$registration_output_array['registration_output']['validation_errors'] = $errors;
		}
		
		$this->layout = 'serializedJson';  
		$this->set('json_output', $registration_output_array);
	}

	public function resendConfirm(){
		$conditions = array('User.username' => $this->request->data['user_email']);
		$theuser = $this->User->find('first', array('conditions' => $conditions));
		$this->log($theuser,'debug');
		$this->User->sendRegistrationEmail($theuser['User']['email_confirm_code'], $this->request->data['user_email']); 
		$return_array = array('success' => 'true');
		$this->layout = "serializedJson";
		$this->set('json_output', $return_array);
	}
	
	function jsonLogin() {
		$this->layout = 'serializedJson';
		$login_info_array = array( 'login_return_array' => array(
				'login_post_data' => $this->request->data,
				'success' => false,
			) 
		);

		if ($this->request->is('post')) {	
			$given_username = $this->request->data['User']['username'];
			$conditions = array('User.username' => $given_username);
			$username_if_exists = $this->User->find('first', array('conditions' => $conditions));
			
			if ($username_if_exists) {
				if ($username_if_exists['User']['confirmed'] == 1) {
					if ($this->Auth->login()) {
						$login_info_array = array( 
							'login_return_array' => array( 
								'logged_in_user' => $this->Auth->user(),
								'login_post_data' => $this->request->data,
								'success' => true,
							) 
						);
					} else {
						$login_info_array = array( 
							'login_return_array' => array(
								'login_post_data' => $this->request->data,
								'success' => false,
								'error' => 'The username or password you supplied is incorrect.',
							) 
						);
					}
				} else {
					$login_info_array = array( 
						'login_return_array' => array(
							'login_post_data' => $this->request->data,
							'success' => false,
							//'error' => 'Please <a href="#" class="confirm-modal-open">confirm your account</a> before logging in. <br>If you did not receive confirmation code, you can click <a href="#" class = "resend_confirm">Resend</a> to get a new one.',
							'error' => 'Please confirm your account before logging in. <br>If you did not receive confirmation link, you can click <a href="#" class = "resend_confirm">Resend</a> to get a new one.',
						) 
					);
				}
			} else {
				$login_info_array = array( 
					'login_return_array' => array(
						'login_post_data' => $this->request->data,
						'success' => false,
						'error' => 'The username or password you supplied is incorrect.',
					) 
				);
			}
		} else {
			$login_info_array = array( 'login_return_array' => array(
					'login_post_data' => $this->request->data,
					'success' => false,
					'error' => 'not post',
				) 
			);
		}
		
		$this->set('json_output', $login_info_array); 
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function view($id = NULL) {
				
		$conditions = array('User.id' => $id);
		$current_user = $this->User->find('first',array('conditions' => $conditions));
		$id = intval($id);
		
		$conditions = array( 'Course.user_id' => $id );
		$courses = $this->Course->find( 'list', array( 'conditions' => $conditions, ) );
		
	//	print_r($courses); exit();

		$courses_array = array();
		foreach($courses as $course => $course_id) {
	//		print_r($course); exit();
			$course_to_add = $this->Course->find('first', array('conditions' => array('Course.id' => $course_id ) ));
			$courses_array[] = $course_to_add;
		}
		
		$this->set( 'courses_listing', $courses_array );

		$this->set('user', $this->User->read(NULL, $id));

	//	$grav_default = 'http://'.$_SERVER['HTTP_HOST'].'/img/oa_icon.png';
	//	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->Auth->user('email') ) ) ) . "?d=" . urlencode( $grav_default ) . "&s=" . 300;
		$grav_url = "/user_files".$this->Auth->user('profile_image');
		$this->set( 'grav_img', $grav_url ); 
	}
	
	function user_confirm($validation_num = null) {
		if($validation_num != NULL) {
			$conditions = array('User.email_confirm_code' => $validation_num);
			if( $the_user = $this->User->find('first', array( 'conditions' => $conditions )) ) {

				$this->User->read(null, $the_user['User']['id']);
				$this->User->set(array(
					'confirmed' => 1,
					'email_confirm_code' => '',
				));
				$this->User->save();				
				
				$this->Session->setFlash("You have successfully validated the e-mail address for your account. You may now log in.");
				$this->redirect('/');	
			}
		} else {
			$this->Session->setFlash("There was an error validating your account! Please e-mail customer support for assistance.");
			$this->redirect('/');	
		}
	}
	
	function jsonUserConfirm() {
		$validation_output_array = array(
			'validation_output' => array(
				'success' => false,
				'error' => null,
			),
		);
		
		if ($this->request->is('post')) {
			if ($this->request->data['validation_code']) {
				$conditions = array('User.email_confirm_code' => $this->request->data['validation_code']);
				$user_to_validate = $this->User->find('first', array('conditions' => $conditions));
				if ($user_to_validate) {
					$this->User->read(null, $user_to_validate['User']['id']);
					$this->User->set(array(
						'confirmed' => 1,
						'email_confirm_code' => '',
					));
					$this->User->save();	
					$validation_output_array['validation_output']['success'] = true;
				} else {
					$validation_output_array['validation_output']['error'] = 'Incorrect validation number. Please double check the email you received again.';
				}
			} else {
				$validation_output_array['validation_output']['error'] = 'No validation number supplied';
			}
		} else {
			$validation_output_array['validation_output']['error'] = 'Not post';
		}
		
		$this->layout = 'serializedJson';  
		$this->set('json_output', $validation_output_array);		
	}

	function forgot_password() {
		$forgot_password_output_array = array(
			'password_return' => array(
				'success' => false,
				'error' => null,
			),
		);
		
		if ($this->request->is('post')) {

				$conditions = array('User.username' => $this->request->data['email']);
				$the_user = $this->User->find('first', array('conditions' => $conditions));
				if ($the_user) {
					$temp_pass = substr(md5(uniqid(rand(), true)), 0, 8);
					$temp_pass_hash = AuthComponent::password($temp_pass);
					
					$this->User->read(null, $the_user['User']['id']);
					$this->User->set(array(
						'password' => $temp_pass_hash,
					));
					$this->User->save(null,false);
					$this->User->sendForgotPasswordEmail($the_user['User']['email'], $temp_pass);
					$forgot_password_output_array = array(
						'password_return' => array(
							'success' => true,
						),
					);				
			
				} else {
					$forgot_password_output_array = array(
						'password_return' => array(
							'success' => false,
							'error' => 'The specified email address was not found in our system. Please double check the spelling of your email address',
						),
					);
				}

		} else {
			$forgot_password_output_array['password_return']['error'] = 'Not post.';
		}
		
		$forgot_password_output_array['password_return']['full_post'] = $this->request->data;
		
		$this->layout = 'serializedJson';  
		$this->set('json_output', $forgot_password_output_array);		
	}
	
        function _createStarterStuff($id){
                
        }

    public function verification($code){
			if ($code != "") {
				$conditions = array('User.email_confirm_code' => $code);
				$user_to_validate = $this->User->find('first', array('conditions' => $conditions));
				if ($user_to_validate) {
					$this->User->read(null, $user_to_validate['User']['id']);
					$this->User->set(array(
						'confirmed' => 1,
						'email_confirm_code' => '',
					));
					$this->User->save();	
					$message = "Success! You can login now!";
				} else {
					$message = 'Validation failed. Please double check the email you received again.';
				}
			} else {
				$message = 'No validation number supplied';
			}
		
        $this->set('message', $message);
    }
    */
}
