<?php
/**
 * Dynamic menu  helper library.
 * Can be used with CSS from http://www.tanfa.co.uk/css/examples/menu/
 *
 * Methods to render dynamic menu .
 */
class MyMenuHelper extends AppHelper {
 
	var $helpers = array('Html', 'Session');
 
	/**
	 * Render  menu from session variable array. 
	 * Top item of the array is menu caption and div id
	 * Sub items are  menu items caption and link to the location, or array of subitems.
	 *
	 * @param array $menu Name of the session variable that stores menu array.
	 * @static
	 */
	function render($menu = null) {
		$out = '';
			//var_dump($menu);

		foreach($menu as $caption => $config) {
			$out = $out.'<ul><li><h2>'.$caption.'</h2>'.
				$this->Html->nestedList($this->parse($config)).'</li></ul>';
		}
		//$out = '<ul>'.$out.'</ul>';
		$out = $this->Html->div('', $out, array('id'=>'menu'));
		return $out;
	}
 
	/** 
	 * Transforms configuration array in to array of hyperlinks recursively.
	  * Returns arraly of list items.
	 */
	function parse($config) {
		$out = array();
		$here = Router::url(substr($this->here, strlen($this->webroot)-1));
		foreach($config as $caption => $link) {
			if (is_array($link)) {
				//$out[$this->Html->div('parent', $caption)] = $this->parse($link);
				$out[$this->Html->link($caption, '#')] = $this->parse($link);
			}
			else {
				if (Router::url($link) != $here) {
					$out[$caption] = $this->Html->link($caption, $link);
				}
				else {
					$out[$caption] = $this->Html->link($caption, '#');
					//$out[$caption] = $this->Html->div('current', $caption);
				}
			}
		}
		return $out;
	}
	
	
	function asset_reports_menu($sessionMenu)
	{
		$s = '<li>'. $this->Html->link(__('Home', true), '/pages/home' ) . '</li>';
		foreach( $sessionMenu as $parent=>$menus ):
			if($parent=='Reports')
			{
				if(is_array($menus['Fixed Assets']))
				{
					foreach($menus['Fixed Assets'] as $title=>$url)
					{ 
						$s.='<li>'. $this->Html->link(__($title, true), $url ) . '</li>';
					}
				}	
			}
		endforeach;

		return $s;		
	}
	
	/* function title_favicon($menu = null) {
	
		if(! $this->Session->check('Userinfo.username')) {
			echo 'Fixed Asset Management System';
		} else {
			echo 'Fixed Asset Management System';
		}
    } */
}
?>