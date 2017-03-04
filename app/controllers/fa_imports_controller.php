<?php

App::import('Vendor', 'php-excel-reader/excel_reader2'); //import statement
App::import('Model', 'AssetDetail');
App::import('Model', 'Asset');
App::import('Model', 'AssetCategory');

class FaImportsController extends AppController {

      var $name = 'FaImports';
      var $helpers = array('Ajax', 'Javascript', 'Time');
      var $components = array('RequestHandler');
      var $errorMsg = null;
      var $duplicates = '';
      var $totalDuplicates = 0;
      var $records = 0;
      var $success = 0;
      var $failed = 0;
      var $total_price = 0;
      var $total_book_value = 0;

      function index($import_status_id=null, $fa_import_department_id=null) {
            $layout = $this->data['FaImport']['layout'];
            $this->FaImport->recursive = 0;
            if ($import_status_id || ($import_status_id = $this->data['FaImport']['import_status_id'])) {
                  $conditions[] = array('import_status_id' => $import_status_id);
            }

            if ($fa_import_department_id || ($fa_import_department_id = $this->data['FaImport']['department_id'])) {
                  $conditions[] = array('department_id' => $fa_import_department_id);
            }

            list($date_start, $date_end) = $this->set_date_filters('FaImport');
            $conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->FaImport->find('all', array('conditions' => $conditions, 'order'=>'FaImport.id'));
            } else {
				  $this->paginate = array('order'=>'FaImport.id');
                  $con = $this->paginate($conditions);
            }

            $this->set('fa_imports', $con);

            $departments = $this->FaImport->Department->find('list');
            $copyright_id = $this->configs['copyright_id'];
            $importStatuses = $this->FaImport->ImportStatus->find('list');
			$moduleName = 'Fixed Assets > Register > Import Assets';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('moduleName', 'copyright_id', 'departments', 'fa_import_department_id', 'importStatuses', 'import_status_id', 'date_start', 'date_end'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function index_pdf() {
            $this->FaImport->recursive = 0;

            if ($fa_import_department_id || ($fa_import_department_id = $this->data['FaImport']['department_id'])) {
                  $conditions[] = array('department_id' => $fa_import_department_id);
            }

            list($date_start, $date_end) = $this->set_date_filters('FaImport');
            $conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            $this->set('imports', $this->paginate($conditions));

            $departments = $this->FaImport->Department->find('list');
            $this->set(compact('departments', 'fa_import_department_id', 'date_start', 'date_end'));
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid import', true));
                  $this->redirect(array('action' => 'index'));
            }
            $group_id = $this->Session->read('Security.permissions');

            $fa_import = $this->FaImport->read(null, $id);
            $this->Session->write('FaImport.id', $id);
            $this->Session->write('FaImport.can_approve', false);
            $this->Session->write('FaImport.can_process', false);
            $this->Session->write('FaImport.can_generate_journal', false);
            $this->Session->write('FaImport.can_edit', false);
            $this->Session->write('FaImport.can_send_to_supervisor', false);
            $this->Session->write('FaImport.can_upload', false);

            if ($group_id == fa_management_group_id) {
                  $this->Session->write('FaImport.can_edit', $fa_import['FaImport']['import_status_id'] == status_fa_import_draft_id ? true : false);
                  $this->Session->write('FaImport.can_send_to_supervisor', $fa_import['FaImport']['import_status_id'] == status_fa_import_draft_id ? true : false);
                  $this->Session->write('FaImport.can_upload', $fa_import['FaImport']['import_status_id'] == status_fa_import_draft_id ? true : false);
            } else if ($group_id == fa_supervisor_group_id) {
                  $this->Session->write('FaImport.can_approve', $fa_import['FaImport']['import_status_id'] == status_fa_import_sent_to_supervisor_id ? true : false);
            } else if ($group_id == fincon_group_id) {
                  ///$this->Session->write('FaImport.can_generate_journal', $fa_import['FaImport']['import_status_id']==status_fa_import_approved_id?true:false);		
                  $this->Session->write('FaImport.can_process', $fa_import['FaImport']['import_status_id'] == status_fa_import_approved_id ? true : false);
            }

            $this->set('fa_import', $fa_import);
            $this->set(compact('assetCategories'));
      }

      function process($id, $reprint=false) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid import', true));
                  $this->redirect(array('action' => 'index'));
            }
            $fa_import = $this->FaImport->read(null, $id);

            //insert ke stock cabang, type import
            foreach ($fa_import['FaImportDetail'] as $detail) {
                  $data['Stock']['date'] = $fa_import['FaImport']['date'];
                  $data['Stock']['item_id'] = $detail['item_id'];
                  $data['Stock']['qty'] = -1 * $detail['qty'];
                  $data['Stock']['in_out'] = 'import';
                  $data['Stock']['price'] = $detail['price'];
                  $data['Stock']['amount'] = $detail['amount'];
                  $data['Stock']['import_id'] = $detail['import_id'];
                  $data['Stock']['department_id'] = $fa_import['FaImport']['department_id'];
                  $this->FaImport->Stock->create();
                  $this->FaImport->Stock->save($data);
            }

            $this->set('import', $fa_import);
            $assetCategories = $this->FaImport->FaImportDetail->Item->AssetCategory->find('list');
            $units = $this->FaImport->FaImportDetail->Item->Unit->find('list');
//		$this->set(compact('import','assetCategories', 'units'));		

            $this->FaImport->set('is_process', 1);
            $this->FaImport->set('import_status_id', status_fa_import_processed_id);
            if ($this->FaImport->save()) {
                  $this->Session->setFlash(__('The import has been processed', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'view', $id));
            } else {
                  $this->Session->setFlash(__('The import could not be processed. Please, try again.', true));
                  $this->redirect(array('action' => 'index'));
            }
      }

      function add($npb_id=null) {
            if (!empty($this->data)) {
                  $this->FaImport->create();

                  if ($this->FaImport->save($this->data)) {

                        $this->Session->setFlash(__('The import has been Send To FA Management', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'view', $this->FaImport->id));
                  } else {
                        $this->Session->setFlash(__('The import could not be saved. Please, try again.', true));
                  }
            }
            $newId = $this->FaImport->getNewId();

            //created from NPB ?
            $departments = $this->FaImport->Department->find('list');
            $this->set(compact('departments', 'newId'));
      }

      function upload() {
            if (!empty($this->data)) {

                $file = $this->data['FaImport']['submittedfile'];
				//system('echo "teststs" > files/new.txt');

                  if ($file['error'] == 0) {
                        $path = "files/";
                        $uploadfile = $path .   $file['name'];
                        $this->data['FaImport']['id'] = $this->Session->read('FaImport.id');
                        $this->data['FaImport']['upload_file_path'] = $path;
                        $this->data['FaImport']['upload_file_name'] = $file['name'];
                        $this->data['FaImport']['upload_file_size'] = $file['size'];
                        $this->data['FaImport']['upload_content_type'] = $file['type'];

                        if ($this->FaImport->save($this->data)) {
						
                              if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                                    if ($this->import_xls($uploadfile)) {
                                          $this->data['FaImport']['total_records'] = $this->records;
                                          $this->data['FaImport']['total_success'] = $this->success;
                                          $this->data['FaImport']['total_failed'] = $this->failed;
                                          $this->data['FaImport']['total_duplicate'] = $this->totalDuplicates;
                                          $this->data['FaImport']['duplicates'] = $this->duplicates;
                                          $this->data['FaImport']['total_price'] = $this->total_price;
                                          $this->data['FaImport']['total_book_value'] = $this->total_book_value;
                                          $this->FaImport->save($this->data);
                                          $this->Session->setFlash(__('The file was successfully uploaded.', true), 'default', array('class' => 'ok'));
                                    } else {
                                          $this->Session->setFlash($this->errorMsg);
                                    }
                              } else {
                                    $this->Session->setFlash(__('The upload could not be saved. Please, try again. Possible file upload attack!', true));
                              }
                        } else {
                              $this->Session->setFlash(__('The FAImport could not be saved. Please, try again.', true));
                        }
                  } else {
                        $this->Session->setFlash(__('The upload could not be saved. Please, try again.', true));
                  }
            }
            $this->redirect(array('action' => 'view', $this->Session->read('FaImport.id')));
      }

      function import_xls($file) {
            /*
              1.  NO
              2.  -CAB
              3.  -LT
              4.  -UNIT KERJA
              5.  -LOKASI
              6.  -GOL
              7.  -KODE
              8.  NAMA										= name
              9.  JENIS										= type
              10. KETERANGAN									= notes
              11. WARNA										= color
              12. NO  INV  (ACCT)								= code
              13. TGL	PEROLEHAN								= date_start = date_of_purchase
              14. Mounthend									= date_end
              15. -Hari
              16. -total penyusutan (Days) s/d Des 2010
              17. -total penyusutan (mounth) s/d Des 2010
              18. NILAI PEROLEHAN	(ACCT) 						= price
              19. NILAI BUKU S/D DES 2010
              20. Akumulasi Penyusutan						= depthnlalu
              21. Penyusutan per bulan						= depbln
              22. Penyusutan	per Jan s/d Mei 2011			= depthnini
              23. Nilai buku s/d Mei 2011 					= book_value
              24. -KETERANGAN
              25. Status										= status

              1.	NO
              2.	CAB
              3.	LT
              4.	UNIT  KERJA
              5.	LOKASI
              6.	Gol
              7.	KODE
              8.	NAMA
              9.	JENIS
              10.	WARNA
              11.	NO  INV CABANG
              12.	TGL	PEROLEHAN
              13.	Mounthend
              14.	NILAI	PEROLEHAN	(ACCT)
              15.	NILAI BUKU SD	MEI 2011

             */
            ini_set('max_execution_time', 0);


            $departments = $this->FaImport->ImportAssetDetail->Department->find('list', array('fields' => array('code', 'id')));
            $businessTypes = $this->FaImport->ImportAssetDetail->BusinessType->find('list', array('fields' => array('name', 'id')));
            $costCenters = $this->FaImport->ImportAssetDetail->CostCenter->find('list', array('fields' => array('cost_centers', 'id')));

            $this->FaImport->ImportAssetDetail->deleteAll(array('fa_import_id' => $this->data['FaImport']['fa_import_id']));

            $start_row = $this->data['FaImport']['upload_start_row'];
            $data = new Spreadsheet_Excel_Reader($file, true);

            foreach ($data->sheets as $sheet) {
			if(!isset($sheet['cells']))
				continue;
                  foreach ($sheet['cells'] as $i => $cell) {
                        if ($i < $start_row)
                              continue;
                        foreach ($cell as $j => $c) {
                              $cell[$j] = trim($c);
                        }

                        $import['CAB'] = isset($cell[2]) ? $cell[2] : '';
                        $import['LT'] = isset($cell[3]) ? $cell[3] : '';
                        $import['UNIT_KERJA'] = isset($cell[4]) ? $cell[4] : '';
                        $import['LOKASI'] = isset($cell[5]) ? $cell[5] : '';
                        $import['GOL'] = isset($cell[6]) ? $cell[6] : '';
                        $import['item_code'] = isset($cell[7]) ? $cell[7] : '';
                        $import['name'] = isset($cell[8]) ? $cell[8] : '';
                        $import['type'] = isset($cell[9]) ? $cell[9] : '';
                        $import['color'] = isset($cell[10]) ? $cell[10] : '';
                        $import['code'] = isset($cell[11]) ? $cell[11] : '';
                        $import['date_of_purchase'] = isset($cell[12]) ? $this->toSqlDate($cell[12]) : '';
                        $import['date_start'] = isset($cell[12]) ? $this->toSqlDate($cell[12]) : '';
                        //$import['date_end'] = isset($cell[13]) ? $this->toSqlDate($cell[13]) : '';
                        $import['price'] = isset($cell[13]) ? str_replace(',', '', $cell[13]) : 0;
                        $import['book_value'] = isset($cell[16]) ? str_replace(',', '', $cell[16]) : 0;
						
                        $import['BUSINNESTYPE'] = isset($cell[17]) ? str_replace(',', '', $cell[17]) : 0;
                        $import['BUSINNESTYPE'] = $import['BUSINNESTYPE'] ? trim($import['BUSINNESTYPE']) : 'Retail';
                        $import['COSTCENTER'] = isset($cell[18]) ? str_replace(',', '', $cell[18]) : 0;
                        $import['COSTCENTER'] = $import['COSTCENTER'] ? trim($import['COSTCENTER']) : 'SD050100';
						
                        $import['serial_no'] = isset($cell[19]) ? $cell[19] : '';
                        //end of records??
                        if (!$import['item_code'] && !$import['code']) {
                              //debug($this->total_book_value );
                              return true;
                        }
                        // $import['NILAI_BUKU_THN_LALU']		=	isset($cell[19])?$cell[19]:'';
                        // $import['depthnlalu']				=	isset($cell[20])?$cell[20]:'';
                        // $import['depbln']					=	isset($cell[21])?$cell[21]:'';
                        // $import['depthnini']				=	isset($cell[22])?$cell[22]:'';
                        // $import['notes']					=	isset($cell[24])?$cell[24]:'';
                        // $import['status']					=	isset($cell[25])?$cell[25]:'';
                        // $import['KETERANGAN']				=	isset($cell[10])?$cell[11]:'';
                        // $import['HARI']						=	isset($cell[15])?$cell[15]:'';
                        // $import['TOTAL_PENYUSUTAN_DAYS']	=	isset($cell[16])?$cell[16]:'';
                        // $import['TOTAL_PENYUSUTAN_MONTH']	=	isset($cell[17])?$cell[17]:'';	
                        //processes fields
						//var_dump($import['CAB']);
                        $import['department_id'] = $import['CAB'] ? $departments[$import['CAB']] : null;
                        $import['business_type_id'] = $import['BUSINNESTYPE'] ? $businessTypes[$import['BUSINNESTYPE']] : null;
                        $import['cost_center_id'] = $import['COSTCENTER'] ? $costCenters[$import['COSTCENTER']] : null;
						
                        if ($department_id = $import['department_id'])
                              $import['location_id'] = $import['LOKASI'] ? $this->FaImport->ImportAssetDetail->Location->findOrAdd($department_id, $import['LOKASI'], $import['UNIT_KERJA']) : null;
                        else
                              $import['location_id'] = null;
							  

                        //asset category_id
/*                         if ($gol = $import['GOL']) {
                              $import['asset_category_id'] = $gol == 1 ? asset_category_inv_gol1_id : asset_category_inv_gol2_id;
                              $import['umurek'] = 5;
                              $import['maksi'] = 60;
                        } else {
                              $import['asset_category_id'] = asset_category_inv_gol1_id;
                              $import['umurek'] = 5;
                              $import['maksi'] = 60;
                        }
 */                      
						if($import['type'] == '' || $import['type'] == null){
							$import['type']='-';
						}
						if($import['color'] == '' || $import['color'] == null){
							$import['color']='-';
						}
						if ($import['GOL'] == 1 || $import['GOL'] == 2 || $import['GOL'] == 0) {
                              $import['asset_category_id'] = 8;
                        }	
						if ($import['GOL'] == 'HDW') {
                              $import['asset_category_id'] = 4;
                        }	
						if ($import['GOL'] == 'LSH') {
                              $import['asset_category_id'] = 11;
                        }	
						if ($import['GOL'] == 'BLD') {
                              $import['asset_category_id'] = 25;
                        }	
						if ($import['GOL'] == 'REN') {
                              $import['asset_category_id'] = 16;
                        }	
						if ($import['GOL'] == 'SER') {
                              $import['asset_category_id'] = 29;
                        }	
						if ($import['GOL'] == 'SOF') {
                              $import['asset_category_id'] = 10;
                        }	
						if ($import['GOL'] == 3) {
                              $import['asset_category_id'] = 5;//kendaraan
                        }	
						if ($import['GOL'] == 'LND') {
                              $import['asset_category_id'] = 1;//tanah
                        }	
							  $AssetCategory	= new AssetCategory;
 							  $asset_categry    = $AssetCategory->read(null, $import['asset_category_id']);
                              $import['umurek'] = $asset_categry['AssetCategory']['depr_year_com'];
                              $import['maksi']  = $asset_categry['AssetCategory']['depr_year_com']*12;
						if($import['date_of_purchase'] == '-' || $import['date_of_purchase'] == ''){
							$import['date_of_purchase'] = date('Y-m-d');
							$import['date_start'] = date('Y-m-d');
						}	
						list($y,$m,$d) = explode('/', $import['date_of_purchase']);
                        $import['year'] = $y;
                        $import['date_end'] = $y+$import['umurek'] .'/'. $m.'/'.$d;
						
						if($import['price'] == '-' || $import['price'] == '' || $import['price'] == 0)
							$import['price'] = 1;
						if($import['book_value'] == '-' || $import['book_value'] == '' || $import['book_value'] == 0)//tambah ini
							$import['book_value'] = 1;
							
						if($import['maksi']==0)
							$import['depbln'] = 0;
						else
							$import['depbln'] = $import['price'] / $import['maksi'];
                        //fa import id
                        $import['fa_import_id'] = $this->data['FaImport']['fa_import_id'];

                        $this->FaImport->ImportAssetDetail->create();
                        if (!$this->FaImport->ImportAssetDetail->save(array('ImportAssetDetail' => $import))) {
                              $this->failed++;
                              foreach ($this->FaImport->ImportAssetDetail->validationErrors as $field => $error) {
                                    if ($error == 'isUnique') {
                                          $this->duplicates .= "Line " . ($i - $start_row + 1) . " : {$import['code']}\n";
                                          $this->totalDuplicates++;
                                    } else {
                                          $this->errorMsg = 'Line: ' . ($i - $start_row + 1) . ' Field: ' . $field . ' Error: ' . $error;
                                          return false;
                                    }
                              }
                        } else {
                              $this->success++;
                              $this->total_price += $import['price'];
                              $this->total_book_value += $import['book_value'];
                        }

                        $this->records++;
                  }
            }
            return true;
      }

      function toSqlDate($str) {
			list($yy,$mm,$dd) = explode('.', $str);
			$newStr = $yy.'/'.$mm.'/'.$dd;
            return strval($newStr);
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid import', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->FaImport->save($this->data)) {
                        $this->Session->setFlash(__('The import has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The import could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->FaImport->read(null, $id);
            }
            $departments = $this->FaImport->Department->find('list');
            $this->set(compact('departments'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for import', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->FaImport->delete($id)) {
                  $this->Session->setFlash(__('FaImport deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('FaImport was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function update_status($id=null, $new_status=null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid import', true));
                  $this->redirect(array('action' => 'index'));
            }
            $fa_import = $this->FaImport->read(null, $id);

            if ($new_status == status_fa_import_approved_id) {
                  if (!$this->process_import($id)) {
                        $this->Session->setFlash(__('Failed to process the import. Please, try again.', true));
                        $this->redirect(array('action' => 'index'));
                  }
                  else
                        $new_status = status_fa_import_finish_id;
            }


            $this->FaImport->set('import_status_id', $new_status);
            if ($this->FaImport->save($this->data)) {
                  $this->Session->setFlash(__('The import status has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The import status could not be saved. Please, try again.', true));
            }

            $this->redirect(array('action' => 'view', $id));
      }

      function process_import($id) {
            $fa_import = $this->FaImport->read(null, $id);
            $AssetDetail = new AssetDetail;
            $Asset = new Asset;

            foreach ($fa_import['ImportAssetDetail'] as $iad) {
                  //debug($iad);
                  $iad['source'] = 'import:' . $iad['id'];

                  unset($iad['id']);
                  $iad['purchase_id'] = 0;
                  $iad['ada'] = 'Y';
                  $iad['qty'] = 1;
                  $iad['amount'] = $iad['price'];

                  $Asset->create();
                  $Asset->save(array('Asset' => $iad));
                  $iad['asset_id'] = $Asset->id;

                  $AssetDetail->create();
                  $AssetDetail->save(array('AssetDetail' => $iad));
            }
            return true;
      }

}

?>