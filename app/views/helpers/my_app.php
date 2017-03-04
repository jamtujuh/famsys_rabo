<?php

/**
 * common view helpers
 * - showValue($array, $id): show value of an element of an $array identified by $id 
 *             prevent warning not existing array
 *  */
class MyAppHelper extends AppHelper {

      var $helpers = array('Html');
      
      function showArrayValue($array, $id, $default='')
      {
            if(isset($array[$id]))
                  return $array[$id];
            else
                  return $default;
      }
	  
	  function getPlaces($id) {
		  //switch ($id) {
				//case 1:$places=-1;break;
				/* case 2:$places=2;break;
				case 3:$places=2;break;
				case 4:$places=2;break;
				case 5:$places=-1;break;
				case 6:$places=2;break; */
				//default:$places=-1;break;
				//default:$places=2;break;
			//}
 			if($id == 0){
				$places = -1;
			}elseif($id == 1){
				$places = 2;
			}
		return $places;
	  }

}

?>