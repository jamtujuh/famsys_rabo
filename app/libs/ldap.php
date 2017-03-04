<?php
class ldap{
 
    private $ldap 			= null;
    private $ldapServer 	= 'idns111031.ap.rabonet.com';
    private $ldapPort 		= '';
    private $ldapUser 		= 'idn.Famsys';
    private $ldapPassword 	= 'Rabobank5';
	private $groups			= 'Users';
    private $host			= 'idns111031.ap.rabonet.com';
	public $suffix 			= '@ap.rabonet.com';
    public $baseDN 			= 'OU=User, OU=Accounts, OU=IDN, dc=ap, dc=rabonet,dc=com';
	public $debug 			= true;	
 
    public function  __construct() {
    
    }
 
    public function auth($user,$pass=null)
    {
        if (empty($user))
        {
            return false;
        }
		
		if($this->debug){
			//ldap_set_option(null, LDAP_OPT_DEBUG_LEVEL, 7);
		}
		
		$suffix		= "@ap.rabonet.com";
		
		$adServer	= "ldap://idns111031.ap.rabonet.com";
		$ldap		= ldap_connect($adServer);
		$ldaprdn	= 'rabonet.com' . "\\" . $user;
		
		if	(empty($pass)){
			$good = @ldap_bind($ldap, $user . $suffix);
		}else{
			$good = @ldap_bind($ldap ,$user . $suffix, $pass);
		}
		
		//these next two lines are required for windows server 03
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if( $good === true ){
			ldap_close($ldap);
            return true;
        }else{
			ldap_close($ldap);
			return false;
			//echo 'bind failed<br>';
			//echo 'error:<br>'.ldap_error($ldap);die();           
        }
    }
 
    public function getInfo($user, $pass){
        $baseDN		= 'OU=User, OU=Accounts, OU=IDN, dc=ap, dc=rabonet,dc=com';
		$adServer	= "ldap://idns111031.ap.rabonet.com";
		$ldap		= ldap_connect($adServer);
		$suffix		= "@ap.rabonet.com";
		
        $attributes = array('sn','mail','samaccountname','memberof');
        //$attributes = array('givenName','sn','mail','samaccountname','memberof');
		$filter = "(samAccountname=$user)";
 
		$good = @ldap_bind($ldap, $user . $suffix, $pass);
		
		if($good === true){
			$result = @ldap_search($ldap, $baseDN, $filter, $attributes);
			$entries = @ldap_get_entries($ldap, $result);
			ldap_close($ldap);
			return $this->formatInfo($entries);
		}else{
			//echo 'error:<br>'.ldap_error($this->ldap);die(); 
			ldap_close($ldap);
			return false;
		}
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