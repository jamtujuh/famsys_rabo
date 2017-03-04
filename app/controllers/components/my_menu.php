<?php 
class MyMenuComponent extends Object {
	var $components = array('Session');
 
	function startup() {
		$menu = ClassRegistry::init('Menu');
		$group = ClassRegistry::init('Group');
		$user =  $this->Session->read('Userinfo.username');
		$group_id =  $this->Session->read('Security.permissions');
		$menu->bindModel(array('hasOne' => array('GroupsMenu')));
		$items = $menu->find('threaded', array(
				'fields' => array('Menu.*'),
				'conditions'=>array('GroupsMenu.group_id'=>$group_id) 
		));
		
		$menus = array();
		$userMenu = array();
		$generalMenu = array();
 
 
		if(! $this->Session->check('Userinfo.username')) {
			$userMenu[__('Home', true)] = '/#'; 
			$userMenu[__('Login', true)] = '/users/login';
			$menus[__('User', true)] = $userMenu;
		} else {
			foreach ($items as $item)//array menu title
			{
				$menus[$item['Menu']['title']] = array();//menu title
				if(isset($item['children']))//cek menu title jika ada children*
				{
					$tmp=array();
					foreach ($item['children'] as $chld)///array menu children
					{
						if(count($chld['children']))///jika ada sub children maka ** jika tida ***
						{
							$tmp2=array();
							foreach($chld['ChildMenu'] as $sub2)////array sub children
							{
								$tmp2[$sub2['title']] = $sub2['url'];///view sub children
								//$this->Session->write('Menu.title', $sub2['title']);//view title sub1
							}
							$tmp[$chld['Menu']['title']] = $tmp2;///**
							//$this->Session->write('Menu.title', $chld['Menu']['title']);//view title sub2
						} else {
							$tmp[$chld['Menu']['title']] = $chld['Menu']['url'];///***
							//$this->Session->write('Menu.title', $chld['Menu']['title']);//view title sub2
						}
					}
					$menus[$item['Menu']['title']] = $tmp;//*
				}
			}	
		}
		$this->Session->write('Menu.main', $menus);
	}
}
?>