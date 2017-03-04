<?php
//App::import('Core', 'ConnectionManager');
class AppController extends Controller {

      var $components = array('Cookie', 'Session', 'Bauth', 'MyMenu');
      var $helpers = array('Number', 'Session', 'Html', 'Form', 'MyMenu', 'Javascript', 'MyApp','Time');
      var $uses = array('Config');
      var $configs = array();
      //var $driver = null;

      /**
       * Returns an indented html select based on children depth
       *
       * @param array $data_array - Array of data passed in from cake's find('threaded') feature
       * @param array $model - the model name
       * @param array $key - the key field on the model
       * @param array $value - the value field on the model
       * @param array $list - Used internally, contains array to be returned
       * @param int $counter - Used Internally, counter for depth
       * @return array
       */
      public function threaded_to_list($data_array, $model=null, $key='id', $value='name', &$list = array(), $counter = 0, $separator='__') {
            if (!is_array($data_array))
                  return array();

            foreach ($data_array AS $data) {
                  $list[$data[$model][$key]] = str_repeat($separator, $counter) . $data[$model][$value];
                  if (!empty($data['children'])) {
                        $this->threaded_to_list($data['children'], $model, $key, $value, $list, $counter + 1);
                  }
            }
            return $list;
      }

      function beforeFilter() {
            $this->configs = $this->Config->find('list');
			
            $this->Bauth->logintrue = '/';
            $this->Bauth->loginfalse = '/users/login';
			
			if($this->params['url']['url'] != 'assets/process_depr' && $this->params['url']['url'] != 'journal_transactions/montly_journal' 
			&& $this->params['url']['url'] != 'journal_transactions/journal_interfase' 
			&& $this->params['url']['url'] != 'asset_details/process_depr' && $this->params['url']['url'] != 'famsys_interfaces/insert_into_csb' && $this->params['url']['url'] != 'famsys_interfaces/read_csb')
			{
				if($this->configs['cut_on'] < date('H:i:s') && $this->configs['cut_off'] > date('H:i:s'))
				{
					if ($this->name != 'Users' && !$this->Session->check('Userinfo.id')) {
						  $this->redirect('/users/login');
						  exit;
					}
				}
				else
				{
					if($this->Session->check('Userinfo.id'))
					{
						$this->Session->destroy();
						if(!$this->Session->check('Userinfo.id'))
						{
							$this->redirect('/users/login');
							exit;
						}
					}
					
					if ($this->name != 'Users' && !$this->Session->check('Userinfo.id')) {
						  $this->redirect('/users/login');
						  exit;
					}
					//$this->params['controller'] = false;
					$this->Session->setFlash(__($this->configs['warning_cut_off'], true));
				}
            }			

			if($this->Session->check('Userinfo.id'))
			{
				$this->Session->write('idle_time', $this->configs['idle_time']);
			} 
			
			if($this->Session->check('Userinfo.id') && $this->params['url']['url'] == 'users/login')
			{
				$this->redirect('/');
				exit;
			}
            $UserModel = new User;
            $activeUser = array(
                $UserModel->alias => array(
                    $UserModel->primaryKey => $this->Session->read('Userinfo.id'),
                    $UserModel->displayField => $this->Session->read('Userinfo.name')
                )
            );

            if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
                  $this->{$this->modelClass}->setUserData($activeUser);
            }

      }

      function set_date_filters($model) {
            if (isset($this->data[$model]['date_start']))
                  $this->Session->write($model . '.date_start', $this->data[$model]['date_start']);

            if (isset($this->data[$model]['date_end']))
                  $this->Session->write($model . '.date_end', $this->data[$model]['date_end']);

            $date_start = $this->Session->read($model . '.date_start');
            $date_end = $this->Session->read($model . '.date_end');
            $date_start = $date_start ? $date_start : array('month' => date('m'), 'day' => 1, 'year' => date('Y'));
            $date_end = $date_end ? $date_end : array('month' => date('m'), 'day' => date('d'), 'year' => date('Y'));

            return array($date_start, $date_end);
      }
	  
	  function getPlaces($id) {
		  if($id == 0){
				$places = -1;
			}elseif($id == 1){
				$places = 2;
			}
		return $places;
	  }
	 
	 
	 /* ambil segment terakhir dari 
	 Asset  > name1 > name2 > name3
	 ****************/
	function lastSegment($name)
	{
		$a = explode(' > ' , $name);
		$last = $a[ count($a) - 1 ];
		return $last;
	}
	
	function set_date_filters_for_report($model) {
		if (isset($this->data[$model]['date_of_purchase_start']))
			  $this->Session->write($model . '.date_of_purchase_start', $this->data[$model]['date_of_purchase_start']);

		if (isset($this->data[$model]['date_of_purchase_end']))
			  $this->Session->write($model . '.date_of_purchase_end', $this->data[$model]['date_of_purchase_end']);

		$date_of_purchase_start		= $this->Session->read($model . '.date_of_purchase_start');
		$date_of_purchase_end		= $this->Session->read($model . '.date_of_purchase_end');
		$date_of_purchase_start		= $date_of_purchase_start ? $date_of_purchase_start : array('month' => 1, 'day' => 1, 'year' => 1980);
		$date_of_purchase_end		= $date_of_purchase_end ? $date_of_purchase_end : array('month' => date('m'), 'day' => date('d'), 'year' => date('Y'));
		
		return array($date_of_purchase_start, $date_of_purchase_end);
	}

}

?>
