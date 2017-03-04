<?php
class ldapmock{
    private $mockupArgs = array();

    public function  __construct() {
		
    }

    public function setMockupArgs($mockupArgs = array()) {
	    $this->mockupArgs = $mockupArgs;
    }
 
    public function auth($user,$pass=null)
    {
	   if (array_key_exists('auth_ok', $this->mockupArgs)) {
		   return $this->mockupArgs['auth_ok'];
	   }
        return true;
    }
 
    public function getInfo($user, $pass){
	   $entries[0]['givenname'][0] = 'mock_givenname';
	   $entries[0]['sn'][0] = 'mock_sn';
	   $entries[0]['mail'][0] = 'mock_mail@host.tld';
	   $entries[0]['samaccountname'][0] = $user;

	   if (array_key_exists('ad_user_givenname', $this->mockupArgs)) {
		   $entries[0]['givenname'][0] = $this->mockupArgs['ad_user_givenname'];
	   }

	   if (array_key_exists('ad_user_sn', $this->mockupArgs)) {
		   $entries[0]['sn'][0] = $this->mockupArgs['ad_user_sn'];
	   }

	   if (array_key_exists('ad_user_mail', $this->mockupArgs)) {
		   $entries[0]['mail'][0] = $this->mockupArgs['ad_user_mail'];
	   }

	   if (array_key_exists('ad_user_samaccountname', $this->mockupArgs)) {
		   $entries[0]['samaccountname'][0] = $this->mockupArgs['ad_user_samaccountname'];
	   }

        return $this->formatInfo($entries);
    }
 
    private function formatInfo($array){
        $info = array();
        $info['first_name']	= $array[0]['givenname'][0];
        $info['last_name'] 	= $array[0]['sn'][0];
        $info['name'] 		= $info['first_name'] .' '. $info['last_name'];
        $info['email'] 		= $array[0]['mail'][0];
        $info['user'] 		= $array[0]['samaccountname'][0];
        //$info['groups'] 	= $this->groups($array[0]['memberof']);
 
        return $info;
    }
 
    private function groups($array)
    {
        $groups = array();
        $tmp = array();
 
        foreach( $array as $entry )
        {
            $tmp = array_merge($tmp,explode(',',$entry));
        }
 
        foreach($tmp as $value) {
            if( substr($value,0,2) == 'CN' ){
                $groups[] = substr($value,3);
            }
        }
 
        return $groups;
    }
}
?>