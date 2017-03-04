<?php
App::import('Model','Config');
App::import('Model','User');

class BauthComponent extends Object {

	//Database constants
	var $table 				= 'users';
//	var $user 				= 'email';
//	var $user 				= 'username';
	var $user 				= 'ad_user';
	var $username 			= 'name';
	var $user_id 			= 'id';
	var $passwd 			= 'password';
	var $account 			= 'account_id';
	var $perm 				= 'group_id';
	var $user_model 		= 'User';
	var $account_model 		= 'Account';
	var $account_redirect 	= '/pages/home/';
	var $session_array 		= 'userinfo';
	var $dev_prefix 		= 'dev';
	var $dev_host 			= 'localhost';
	
	//Authentication constants
	var $use_accounts 		= false;
	var $enctype 			= 'md5';  		//Only md5 available for now
	var $use_remember 		= false;
	var $remember_field 	= 'remember';
	var $use_activation 	= false;
	var $activation_field 	= 'active';
	var $authprefix 		= 'admin_';	// Cake admin routing prefix
	
	//Redirections and pages
	var $redirect_field 	= 'redirect';  //Optional hidden form field to redirect from form
	var $loginform 			= '/users/login';
	var $logoutPage 		= '/users/login';
	var $logintrue;
	var $loginfalse;
	var $regfields;
	
	//Messages & so on
	var $logoutmsg 			= 'Logging you out...';

	//Do not change below
	var $components    		= array('Session', 'Cookie');
    var $controller    		= true;

	
    function initialize(&$controller) {
		$this->controller =& $controller;
		//FIXME: This breaks scaffolded views and cake always shows users views
		$this->controller->uses = array($this->user_model);
		
		//Initializes Session array if there is no info
		if(!$this->controller->Session->check('Userinfo')) {
			$userinfo = array();
			$this->controller->Session->write('Userinfo', $userinfo);
		 	$this->controller->set('Userinfo', $this->Session->read('Userinfo'));
		}
		else {  //Makes the information available in the view
			$this->controller->set('Userinfo', $this->Session->read('Userinfo'));
		}
   		if(!$this->controller->Session->check('Security')) {
			$security = array();
			$this->controller->Session->write('Security', $security);
			$this->controller->Session->write('Security.logged_in', 0);
			$this->controller->Session->write('Security.permissions', 0);
			$this->controller->set('Security', $this->Session->read('Security'));
		}
   		 else {  //Makes the information available in the view
			$this->controller->set('Security', $this->Session->read('Security'));
		}
	
	}
	
	function login($data) {

		$model  = $this->user_model;
		$user   = $data[$model][$this->user];
		$passwd = $data[$model][$this->passwd];
		
		//TODO: Sanitiza usernames and passwords
		//App::import('Sanitize');
		//$user = Sanitize::paranoid($user, array('@', '.', '_', '-'));
		//$cleanpasswd = Sanitize::paranoid($passwd);
		$cleanpasswd = $passwd;
		
		 //Crypts password
		 switch ($this->enctype):
		 	case 'md5':
				$passwd = md5($cleanpasswd);
			break;
		 endswitch;
		
		
		 //Generates conditions from config variables
		 $conditions = array(
		 					$this->user => $user,
							//$this->passwd => $passwd,
							);
		
							
		//If we are using accounts, we should add the condition
		//TODO: RE-Enable account management, disabled for cake 1.2 testing
		/*if($this->use_accounts) {
			$conditions[$this->user_model . "." . $this->account] = $this->controller->Session->read('Account.account_id');
		*/
		
		//If we are using activation, we should add the condition
		if($this->use_activation) {
			$conditions[$this->user_model . "." . $this->activation_field] = 1;
		}
		$conditions[$this->user_model . ".aktif" ] = 1;

		
		 //Finds user
		 $totalUsers = $this->controller->{$model}->find('count', array('conditions' => $conditions));
		
		 //If the user is valid
		 if($totalUsers > 0) {
			$change_password_message=null;
			$config = new Config;
			$configs = $config->find('list', array('conditions'=>array('key'=>'expired_password')));// ambil dari config
			$password_old = $configs['expired_password'] ; //days

		 	//Gets user d`etails
		 	$details = $this->controller->{$model}->find('first', array('conditions' => $conditions));
			unset($details['Log']);
			$last_password_change = strtotime($details['User']['last_password_change']);
			$now = strtotime(date('Y-m-d H:i:s'));
			$warning = $password_old - 7;
			/*
			if(($now-$last_password_change) > $warning *24*60*60) //85 hari => detik tergantung config
			{
				$this->controller->Session->write('ric.custom.password_is_expired', true);

				$change_password_message = __('Your password is almost ',true) .$password_old. __(' days old, please change for security reasons, if not changes username will be disabled', true);
			}
			if(($now-$last_password_change) > $password_old *24*60*60) //85 hari => detik tergantung config
			{
				$User = new User;
				$User->read(null,$details[$model]['id']);
				$User->set('aktif', 0);
				$User->save();
			} 
			*/
			//Registers user information
			$registration = $this->register_user($details);
			
		 	//Register authentication cookies if user has saved data
		 	if($this->use_remember && !empty($data[$model][$this->remember_field])) {
		 		if($data[$model][$this->remember_field]) {
		 			$sdata[$this->user] = $user;
					//$sdata[$this->passwd] = $passwd;
					$this->controller->Cookie->write('session_data', $sdata, true, 864000);
		 		}
		 	}
			
		 	//Redirects to appropiate page, based on the user permissions and previous URL
		 	if($this->controller->Session->read('Security.prev_url')) {
		 			$redirect = $this->controller->Session->read('Security.prev_url');
		 			$this->controller->Session->write('Security.prev_url', null);
					//new redirect to choose_group // 24 Nov 2014
					$redirect = '/users/choose_group/';
		 		}
			elseif(is_array($this->logintrue)) {
					//$redirect = $this->logintrue[$details[$this->user_model][$this->perm]];
					
					//$redirect = '/';
					//new redirect to choose_group // 24 Nov 2014
					$redirect = '/users/choose_group/';
		 		}
			else {
				$redirect = $this->logintrue;
				//new redirect to choose_group // 24 Nov 2014
				$redirect = '/users/choose_group/';
			}
			$this->Session->setFlash(__('Login Success. Please Choose Your Famsys Role.', true) . '<br>' . $change_password_message, 'default', array('class'=>'ok'));
			$this->Session->write('User.failed_login'.$user,0);
			$this->controller->redirect($redirect);
		 }
		 else {
			//If loginFalse is set, we use it
			$failed_login		= $this->Session->read('User.failed_login'.$user)+1;
			$config 			= new Config;
			$configs 			= $config->find('list', array('conditions'=>array('key'=>'max_login_attemp')));// ambil dari config
			$max_login_attemp 	= $configs['max_login_attemp'];
			$attemp_left 		= $max_login_attemp-$failed_login;
			$this->Session->write('User.failed_login'.$user, $failed_login);
			
			//$aktif = $this->controller->{$model}->query('select aktif from users where ad_user="'.$user.'" and aktif = "1" ');			
			$totalUser	= $this->controller->{$model}->query('select count(id) as total_user from users where ad_user = "'.$user.'" ');
			$aktif	= $this->controller->{$model}->query('select count(id) as total from users where ad_user = "'.$user.'" and aktif = "1" ');
			
			if($attemp_left>0)
			{
				if($totalUser[0][0]['total_user'] == 0){
					$msg =  __('Login Failed: Invalid username or User not existed in Famsys.', true);
				}else if($totalUser[0][0]['total_user'] > 0 && $aktif[0][0]['total'] == 0){
					$msg =  __('Login Failed: Your account is disabled. Please contact Administrator', true);
				}				
			}
			else
			{
				$msg =  __('Login Failed: Your account is disabled, too many wrong login attempts. Please contact Administrator', true);
				$this->controller->{$model}->query('update users set aktif=0 where ad_user="'.$user.'"');
				
				// RENDI 21 May -- RECORD TO ACTIVITY LOG
				$name 		= $user;		
				$process 	= 'LOGIN FAILED';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= 'TOO MANY ATTEMPT. USER '.$user.' DISABLED BY SYSTEM';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);				
				$Activity 	= new ActivityLogsController;
				$Activity->add($ActivityDataArray);
			}
			
			$this->Session->setFlash( $msg);
			
			if($this->loginfalse) {
				$this->controller->redirect($this->loginfalse);
				exit();
			}
			else {
			
				//$this->controller->set('loginerr', __d('components', 'Invalid username or password', true));
			}		
		 }
	}
	
	//Logins the user based of the saved cookie.
	//This method can be called straight up, without requiring restrict, so the user can
	//be logged in on a non-restricted page (Ideally can be used from the app_controller)
	function cookie_login() {
		//Only execute if parameter is set up
		if($this->use_remember) {
			$model = $this->user_model;
			
			if($this->controller->Cookie->read('session_data') && (!$this->controller->Session->read('Security.logged_in'))) {
				$sdata[$model] = $this->controller->Cookie->read('session_data');
				$sdata[$model][$this->remember_field] = true;
				
				$conditions = array(
			 					$this->user => $sdata[$model][$this->user],
								//$this->passwd => $sdata[$model][$this->passwd],
								);
				
			
				//If we are using accounts, we should add the condition
				//TODO: RE-Enable account management, disabled for cake 1.2 testing
				/*if($this->use_accounts) {
					$conditions[$this->user_model . "." . $this->account] = $this->controller->Session->read('Account.account_id');
				*/
			
				//If we are using activation, we should add the condition
				if($this->use_activation) {
					$conditions[$this->user_model . "." . $this->activation_field] = 1;
				}
				
				//Obtains user data
				$details = $this->controller->{$model}->find($conditions);
				
				if($details) {
					$registration = $this->register_user($details);
					return true;
				}
				return false;
			}
		}
		
	}
	
	function register_user($details) {
			
			
			//Logins the user
		 	$this->controller->Session->write('Security.logged_in', 1);
			$this->controller->Session->write('Security.permissions', $details[$this->user_model][$this->perm]);
		 	
		 	//Register base user information in the session
		 	$this->controller->Session->write('Userinfo.id', $details[$this->user_model][$this->user_id]);
		 	$this->controller->Session->write('Userinfo.'.$this->user, $details[$this->user_model][$this->user]);
		 	$this->controller->Session->write('Userinfo.'.$this->username, $details[$this->user_model][$this->username]);
		 	$this->controller->Session->write('Userinfo.'.$this->perm, $details[$this->user_model][$this->perm]);
		 	//$this->controller->Session->write('Userinfo.'.$this->last_pass, $details[$this->user_model][$this->last_pass]);
			
		 	//Registers base user information in a cookie in order to  be acceses by other programs like WYS
		 	// $this->Cookie->write('Userinfo.id', $details[$this->user_model][$this->user_id]);
		 	// $this->Cookie->write('Userinfo.'.$this->user, $details[$this->user_model][$this->user]);
		 	// $this->Cookie->write('Userinfo.'.$this->username, $details[$this->user_model][$this->username]);
		 	// $this->Cookie->write('Userinfo.'.$this->perm, $details[$this->user_model][$this->perm]);
	 	
		 	//Register extended user information in the session
		 	if(is_array($this->regfields)) {
		 		foreach($this->regfields as $field) {
		 			$this->controller->Session->write('Userinfo.'.$field, $details[$this->user_model][$field]);
		 		}
		 	}

		 	//Sets security and Userinfo variables to the view
		 	$this->controller->set('Userinfo', $this->Session->read('Userinfo'));
			$this->controller->set('Security', $this->Session->read('Security'));
		
			return true;
	}
	

	function restrict($permissions=null, $return=false) {
		$model = $this->user_model;
		
		//Disables access by default
		$access = false;
		
		//Verifies the Cookie data
		if($this->cookie_login()) {
			$access = true;
		} else {
			//Do not restrict when login form is shown
			if($this->controller->action != 'login') {
				
				//If there are permissions, we check against them
				if($permissions) {
					$userPermissions = $this->controller->Session->read('Security.permissions');
	
					//If permissions aren't an array, we create one from comma separated values
					if(!is_array($permissions)) {
						$permissions = split(',', $permissions);
					}
				
					//If the user role is in the array, we allow access
					if(in_array($userPermissions, $permissions)) {
						$access = true;
					}
	
				}
			}
		}
		
		//If return is enabled we just return the result
	    if($return) {
	    	return $access;
	    }
	    //Otherwise we send the user back to the login form
	    else {
	    	if($access == false) {
	    		$this->controller->redirect($this->loginform);
				exit();
	    	}
	    }


	}
	
	function setUrl() {
		//TODO: There should be a way to do this faster!
		if(isset($this->controller->params['url']['url'])) {
			$final_redirect = $this->controller->params['url']['url'];
		}
		else {
			$final_redirect = $this->controller->params['url'];
		}
		$this->controller->Session->write('Security.prev_url', $final_redirect);
		/*
		$base = $this->controller->base;
		$full_url = Router::url(null, false);
		$final_redirect = split($base, $full_url);
		$url = $this->controller->Session->write('prev_url', $final_redirect[1]);
		*/
}
	
	function logout() {
		$this->controller->Session->destroy('logged_id');
		$this->controller->Session->destroy('user_id');
		$this->controller->Session->destroy();
		// $this->Cookie->delete('Userinfo');
		// $this->Cookie->delete('session_data');
		// $this->Cookie->destroy();
		$this->controller->Flash($this->logoutmsg, '/users/login');	
		//$this->controller->render('/users/login');	
		
	}
}
?>