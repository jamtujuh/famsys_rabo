<?php
class MenuComponent extends Object {
    var $components = array('Session');
 
    function startup() {
         
        $user = $this->Session->read('User');
 
        //menus array
        $menus = array();
        $menus[__('Home', true)] = '';
        $menus[__('Twitter Accounts', true)] = array('a'=>'accounts/view','b'=>'dsfhjs');
        $menus[__('RSS Your Tweets', true)] = '';
        $menus[__('Tweet Scheduler', true)] = '';
       
        if (!$this->Session->check('User')){
            $menus[__('Register', true)] = 'users/register';
            $menus[__('Login', true)] = 'users/login';
        }else{
            $menus[__('MyAccount', true)] = 'users/account';
            $menus[__('Logout', true)] = 'users/logout';       
        }
        $this->Session->write('Menu.main', $menus);
    }
}
?>