<?php
class ActivityLog extends AppModel{

	var $name = 'ActivityLog';
	//public function save(array $data = null, array $params = array()){
	public function save($data = null, $validate = false, $fieldList = array()) {        
		//return parent::save($this->data, $params);
		return parent::save($data, $validate, $fieldList);    }
	
}
?>