<?php

class ItemsController extends AppController {

      var $name = 'Items';
      var $helpers = array('Ajax', 'Javascript', 'Number');
      var $components = array('RequestHandler');

      function getassetcategoryid() {
			$this->layout='ajax';
			
			if(DRIVER=='mysql') {
				$this->set('options', $this->Item->AssetCategory->find('list', array(
							'conditions' => array(
								'AssetCategory.asset_category_type_id' => $this->data['Item']['asset_category_type_id']
							),
							'group' => array('AssetCategory.name')
								)
						)
				);
			} elseif(DRIVER=='mssql') {
				$this->set('options', $this->Item->AssetCategory->find('list', array(
							'conditions' => array(
								'AssetCategory.asset_category_type_id' => $this->data['Item']['asset_category_type_id']
							)
							)
						)
				);
			}
            $this->render('/items/ajax_dropdown');
      }

      function index() {
            $this->Item->recursive = 0;
			$res 	= $this->Item->query("select item_id, item_prefix from point_reward_items");
			foreach($res as $data){
				$this->Item->query("update items set prefix = '".$data[0]['item_prefix']."' where id = '".$data[0]['item_id']."' ");
			}
            $cons = array();
            $layout = $this->data['Item']['layout'];
            if (!empty($this->data)) {
				$this->Session->write('Item.asset_category_type_id', $this->data['Item']['asset_category_type_id']);
            }
            if (!$this->Session->check('Item.asset_category_type_id'))
                  $this->Session->write('Item.asset_category_type_id', 1);
				  
			if(isset($this->data['Item']['asset_category_id']))
				$this->Session->write('Item.asset_category_id', $this->data['Item']['asset_category_id']);

            $asset_category_type_id = $this->Session->read('Item.asset_category_type_id');
					
            if ($asset_category_id = $this->Session->read('Item.asset_category_id'))
                  $cons[] = array('Item.asset_category_id' => $asset_category_id);
            if($asset_category_type_id)
                  $cons[] = array('AssetCategory.asset_category_type_id' => $asset_category_type_id);

            $units = $this->Item->Unit->find('list');
            $assetCategoryTypes = $this->Item->AssetCategory->AssetCategoryType->find('list');
            $assetCategories = $this->Item->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $asset_category_type_id)));
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Item->find('all', array('conditions' => $cons));
            } else {
				  $this->paginate = array('order'=>'Item.id');
                  $con = $this->paginate($cons);
            }
			
            $this->set('items', $con);
            $this->set('units', $units);
            $this->set('assetCategories', $assetCategories);
            $this->set('assetCategoryTypes', $assetCategoryTypes);
            $copyright_id = $this->configs['copyright_id'];
			$moduleName = 'Master Data > Item';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
			$this->set(compact('moduleName'));
            $this->set(compact('copyright_id'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid item', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->set('item', $this->Item->read(null, $id));
            $units = $this->Item->Unit->find('list');
            $this->set('units', $units);
      }

      function add() {
            if (!empty($this->data)) {				
				$code = $this->data['Item']['code'];
				$exist = $this->Item->find('list', array('conditions' => array('Item.code' => $code)));
				if($exist){
					$this->Session->setFlash(__('The item could not be saved. Please, try different item code.', true));
				}else{
					$this->Item->create();
					if($this->data['Item']['request_type_id'] != request_type_point_reward_id){
						$this->data['Item']['prefix'] = null;
					};
					$this->data['Item']['code'] = trim($this->data['Item']['code']);
					if ($this->Item->save($this->data)) {
						if($this->data['Item']['request_type_id'] == request_type_point_reward_id){
							$item_id = $this->Item->id;
							$exist = $this->Item->query("select COUNT(*) as total from point_reward_items where item_id = '".$item_id."' ");
							if($exist[0][0]['total'] > 0){
								$update = $this->Item->query("update point_reward_items set item_prefix = '".$this->data['Item']['prefix']."' where item_id = '".$item_id."' ");
							}else{
								$update = $this->Item->query("insert into point_reward_items values ('".$item_id."', '".$this->data['Item']['prefix']."', 'VOUCHER')");
							}
						}
                        $this->Session->setFlash(__('The item has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
					} else {
                        $this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
					}
				}					
            }
            $assetCategoryTypes = $this->Item->AssetCategory->AssetCategoryType->find('list');
            $currencies = $this->Item->Currency->find('list');
            $requestTypes = $this->Item->RequestType->find('list');
            $units = $this->Item->Unit->find('list');
			$this->set(compact('assetCategoryTypes', 'assetCategories', 'currencies', 'requestTypes', 'units'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid item', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
				if(!$this->data['Item']['request_type_id'] == request_type_point_reward_id){
					$this->data['Item']['prefix'] = null;
				}
                  if ($this->Item->save($this->data)) {
						if($this->data['Item']['request_type_id'] == request_type_point_reward_id){
							$item_id = $id;
							$exist = $this->Item->query("select COUNT(*) as total from point_reward_items where item_id = '".$item_id."' ");
							if($exist[0][0]['total'] > 0){
								if($this->data['Item']['prefix']){
									$update = $this->Item->query("update point_reward_items set item_prefix = '".$this->data['Item']['prefix']."' where item_id = '".$item_id."' ");
								}else{
									$update = $this->Item->query("delete from point_reward_items where item_id = '".$item_id."' ");
								}								
							}else{
								$update = $this->Item->query("insert into point_reward_items values ('".$item_id."', '".$this->data['Item']['prefix']."', 'VOUCHER')");
							}
						}
                        $this->Session->setFlash(__('The item has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->Item->read(null, $id);
            }
            $assetCategories = $this->Item->AssetCategory->find('list');
            $assetCategoryTypes = $this->Item->AssetCategory->AssetCategoryType->find('list');
            $currencies = $this->Item->Currency->find('list');
            $requestTypes = $this->Item->RequestType->find('list');
            $units = $this->Item->Unit->find('list');
            $this->set(compact('assetCategories', 'assetCategoryTypes', 'currencies', 'requestTypes', 'units'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for item', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->Item->delete($id)) {
                  $this->Session->setFlash(__('Item deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Item was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function get_info() {
            $this->autoRender = false;
            if (!empty($this->data)) {
                  $item = $this->Item->findById($this->data['NpbDetail']['item_id']);
                  $d = $item['Item'];
                  $d['rp_rate'] = $item['Currency']['rp_rate'];
                  echo json_encode($d);
            }
      }

      function auto_complete($request_type_id) {
		$group_id = $this->Session->read('Security.permissions');
		$this->Item->recursive = -1;
		if($group_id == stock_management_group_id){			
			$this->set('items', $this->Item->find('all', array('conditions' => "request_type_id in ( '3', '5' )
					and (Item.name LIKE '{$this->data['Item']['name']}%'
					or Item.code LIKE '{$this->data['Item']['name']}%')
					and Item.id NOT IN (select item_id from point_reward_items)
				"))
            );
		}else{
			$this->set('items', $this->Item->find('all', array('conditions' => "request_type_id = '{$request_type_id}'
					and (Item.name LIKE '{$this->data['Item']['name']}%'
					or Item.code LIKE '{$this->data['Item']['name']}%')
				"))
            );
		}
			
            
		$this->layout = "ajax";
      }
      function auto_complete_reklass() {
			$this->Item->recursive = -1;
            $this->set('items', $this->Item->find('all', array('conditions' => "Item.name LIKE '%{$this->data['Item']['name']}%'
					or Item.code LIKE '%{$this->data['Item']['name']}%'
				"))
            );
            $this->layout = "ajax";
      }

      function item_status($asset_category_id=null) {
            $this->Item->recursive = 0;
			$res 	= $this->Item->query("select item_id, item_prefix from point_reward_items");
			foreach($res as $data){
				$this->Item->query("update items set prefix = '".$data[0]['item_prefix']."' where id = '".$data[0]['item_id']."' ");
			};
            $layout = $this->data['Item']['layout'];
            $cons = array();
			
			if(!empty($this->data))
			{
			  $this->Session->write('Item.stock_status', $this->data['Item']['stock_status']);
			}
            $cons[] = array('AssetCategory.asset_category_type_id' => 2);
			
            
			
			//set up filters session
            if ($asset_category_id || ($asset_category_id = $this->data['Item']['asset_category_id']))
                $this->Session->write('Item.asset_category_id', $asset_category_id);
            else if (isset($this->data['Item']['asset_category_id']))
                $this->Session->write('Item.asset_category_id', $this->data['Item']['asset_category_id']);
            if ($asset_category_id = $this->Session->read('Item.asset_category_id'))
                $cons[] = array('asset_category_id' => $asset_category_id);
			
            if ($this->Session->read('Item.stock_status')==1) {
                $cons[] = array('balance >' => intval('qty_reorder'));
            }
            else if ($this->Session->read('Item.stock_status')==2) {
                $cons[] = array('balance <=' => intval('qty_reorder'));
            }

			$this->paginate = array('order'=>'Item.id');
            if ($layout == 'pdf' | $layout == 'xls') {
                $con = $this->Item->find('all', array('conditions' => $cons));
            } else {
                $con = $this->paginate($cons);
            }
			
            $units = $this->Item->Unit->find('list');
            $assetCategories = $this->Item->AssetCategory->find('list', array('conditions' => array('AssetCategory.asset_category_type_id' => 2)));
            $this->set('items', $con);
            $this->set('units', $units);
            $this->set('assetCategories', $assetCategories);

            $copyright_id = $this->configs['copyright_id'];
            $this->set(compact('asset_category_id', 'copyright_id', 'units'));

            if ($layout == 'pdf') {
                Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
                $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                $this->render('item_status_pdf');
            } else if ($layout == 'xls') {
                $this->render('item_status_xls', 'export_xls');
            }
      }

      function item_status_pdf() {
            $this->Item->recursive = 0;
            $cons = array();
            if (!empty($this->data)) {
                  if ($this->data['Item']['asset_category_id'])
                        $this->Session->write('Item.asset_category_id', $this->data['Item']['asset_category_id']);
                  else
                        $this->Session->write('Item.asset_category_id', null);
            }

            $asset_category_id = $this->Session->read('Item.asset_category_id');

            if ($asset_category_id)
                  $cons[] = array('Item.asset_category_id' => $asset_category_id);
            else
                  $cons[] = array('AssetCategory.asset_category_type_id' => 2);

            $itemBalances = $this->Item->InventoryLedger->getItemBalances();

            $units = $this->Item->Unit->find('list');
            $assetCategories = $this->Item->AssetCategory->find('list', array('conditions' => array('AssetCategory.asset_category_type_id' => 2)));
            $this->set('items', $this->paginate($cons));
            $this->set('units', $units);
            $this->set('itemBalances', $itemBalances);
            $this->set('assetCategories', $assetCategories);
      }

}

?>
