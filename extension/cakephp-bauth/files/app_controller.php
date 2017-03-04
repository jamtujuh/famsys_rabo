<?php
class AppController extends Controller {
	
	var $components = array('Cookie', 'Session', 'Bauth');
	var $helpers = array('Session');

	
	function beforeFilter() {
		
		//Configure Authentication component
		//Will redirect users with group_id=1  to /home/user1/ to and group_id=2 to /home/user2
		$this->Bauth->logintrue = array(1 => '/home/user1/', 2 => '/home/user2/');
	}
	
	
}
?>