<?php
/**
 * Dynamic menu  helper library.
 *
 * Methods to render dynamic menu .
 */
class MenuHelper extends AppHelper {
 
    var $helpers = array('Html');
 
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
       
        foreach($menu as $caption => $link) {
            $out = $out.'<li><a href="'.$this->webroot.$link.'" target="_self" title="'.$caption.'"><span>'.$caption.'</span></a></li>';
        }
        $out = '<ul>'.$out.'</ul>';
        $out = $this->Html->div('menu', $out);
        return $out;
    }
}
?>