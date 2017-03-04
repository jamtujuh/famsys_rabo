<?php

App::import('Model','User');

class PointRewardsController extends AppController {

	var $name = 'PointRewards';
    var $helpers = array('Ajax', 'Javascript', 'Time');
    var $components = array('RequestHandler');

    function index() {
		$this->PointReward->recursive = 0;
		$layout = $this->data['PointReward']['layout'];
		
		if(!empty($this->data))
		{
			if ($this->data['PointReward']['date_start'] == $this->data['PointReward']['date_end'].' '.'00:00:00.000'){
				$this->data['PointReward']['date_start']['day'] = $this->data['PointReward']['date_start']['day'] - 1;
			}
			$this->Session->write('PointReward.no', 				$this->data['PointReward']['mr_no']);
			$this->Session->write('PointReward.department_id', 		$this->data['PointReward']['department_id']);
			$this->Session->write('PointReward.business_type_id', 	$this->data['PointReward']['business_type_id']);
			$this->Session->write('PointReward.cost_center_id', 	$this->data['PointReward']['cost_center_id']);
			$this->Session->write('PointReward.date_start', 		$this->data['PointReward']['date_start']);
			$this->Session->write('PointReward.date_end', 			$this->data['PointReward']['date_end']);
		}
		
		$no = $this->data['PointReward']['mr_no'];
		
		if ($no)
			  $this->Session->write('PointReward.no', trim($no));
		else if (isset($this->data['PointReward']['no']))
			  $this->Session->write('PointReward.no', trim($this->data['PointReward']['no']));
		if ($no = $this->Session->read('PointReward.no'))
			  $conditions[] = array('PointReward.no LIKE' => '%'. $no . '%');
			  
		if (isset($this->data['PointReward']['department_id']))
			$this->Session->write('PointReward.department_id', $this->data['PointReward']['department_id']);
		if ($department_id = $this->Session->read('PointReward.department_id'))
            $conditions[] = array('PointReward.department_id' => $department_id);
			
		if (isset($this->data['PointReward']['cost_center_id']))
			if($this->data['CostCenter']['name'] == '')
				$this->data['PointReward']['cost_center_id'] = null;
				$this->Session->write('PointReward.cost_center_id', $this->data['PointReward']['cost_center_id']);
		if ($cost_center_id = $this->Session->read('PointReward.cost_center_id'))
			$conditions[] = array('PointReward.cost_center_id' => $cost_center_id);
		
		if (isset($this->data['PointReward']['business_type_id']))
			$this->Session->write('PointReward.business_type_id', $this->data['PointReward']['business_type_id']);
		if ($business_type_id = $this->Session->read('PointReward.business_type_id'))
			$conditions[] = array('PointReward.business_type_id' => $business_type_id);
			  
		list($date_start, $date_end) = $this->set_date_filters('pointReward');
            $conditions[] = array('pointReward.created_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day'] . ' 00:00:00.000'),
                'pointReward.created_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day'] . ' 23:59:59.000'));
				
		$conditions[]=array('PointReward.no not '=>null);
		
		$this->paginate = array('order'=>'PointReward.id');
		
				
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->PointReward->find('all', array('conditions'=>$conditions, 'order'=>'PointReward.id', 'fields'=>'DISTINCT PointReward.no'));
		}else{
			$con = $this->paginate($conditions);
		}
		//echo "<pre>";
		//var_dump($con);
		//echo "</pre>";die();
		
		$this->set('pointRewards', $con);

		$copyright_id = $this->configs['copyright_id'];
		$moduleName = 'Reports > List Point Reward';
		$departments = $this->PointReward->Department->find('list');
		$businessType = $this->PointReward->BusinessType->find('list');
		$costCenter = $this->PointReward->CostCenter->find('list');
		$costCenters = $this->PointReward->CostCenter->find('list', array('fields' => 'name'));
		//$cc 			= $this->PointReward->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
			
		$this->set(compact('departments', 
			'date_start','date_end',
			'costCenter', 'costCenters', 
			'businessType', 'moduleName',
			'date_start','date_end',
			'copyright_id'
			));
			
			//export to pdf or xls still pending
		if ($layout == 'pdf') {
			Configure::write('debug', 1); // Otherwise we cannot use this method while developing
			$this->layout = 'pdf'; //this will use the pdf.ctp layout
			$this->render('index_pdf');
		} else if ($layout == 'xls') {
			$this->render('index_xls', 'export_xls');
		}
	} 

}
?>