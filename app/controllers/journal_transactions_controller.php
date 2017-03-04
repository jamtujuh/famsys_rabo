<?php

App::import('Model', 'Asset');
App::import('Model', 'Invoice');
App::import('Model', 'InvoicePayment');
App::import('Model', 'Movement');
App::import('Model', 'Department');
App::import('Model', 'Disposal');
App::import('Model', 'SupplierRetur');
App::import('Model', 'Retur');
App::import('Model', 'Inlog');
App::import('Model', 'Outlog');
App::import('Model', 'Po');
App::import('Model', 'Reklass');
App::import('Model', 'DeliveryOrder');
App::import('Model', 'Usage');
App::import('Model', 'JournalTemplate');
App::import('Model', 'JournalInterfase');
App::import('Model', 'CostCenterToDao');
App::import('Model', 'TransactionCode');

define('ACCOUNT_CURRENCY_IDR_CODE', '360');
define('HQ_DEPARTMENT', '899');
define('HQ_DEPARTMENT_ID', '72');
define('KPNO_DEPARTMENT_ID', '72');

class JournalTransactionsController extends AppController {

    var $name = 'JournalTransactions';
    var $helpers = array('Number', 'Ajax', 'Javascript');
    var $components = array('RecordReferer', 'RequestHandler');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'JournalTransaction.id' => 'asc'
        )
    );

    function prepare_invoice_posting($doc_id = null) {
        $this->Session->write('JournalTransaction.doc_id', $doc_id);
        $departments = $this->JournalTransaction->Department->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));

        $Invoice = new Invoice;
        $InvoicePayment = new InvoicePayment;
        $invoice = $Invoice->read(null, $doc_id);
        $invoice_id = $doc_id;
        $other_cost = $invoice['Invoice']['other_cost_total'];
        //$department_id	= HQ_DEPARTMENT_ID ;

        $action = 'posting_invoice';
        $doc_id = 'invoice_id';

        //jumlah record details di jurnal template, utk langkap record di journal trx
        $detailSize = 2;
        $detail_source = 'invoice';

        $total_dp = 0;
        foreach ($invoice['Po'] as $po) {
            $total_dp += $po['down_payment'];
        }

        $payments = count($invoice['InvoicePayment']);
        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
        $accountT24_gl = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.t24_gl')));
        $accountSeq_t24 = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.seq_t24')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');
        $journalLines = array();
        $total_amount = 0;
        $offset_detail_dp = 0;

        //kalau ada dp
        if ($total_dp) {
            //echo 'dp<br>';
            // DP
            $start_index = 0;
            if ($invoice['Invoice']['request_type_id'] == request_type_stock_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_inventory_id');
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_service_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_service_id');
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_point_reward_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_point_reward_id');
            } else {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_down_payment_id');
            }
            $item_count = count($invoice['InvoiceDetail']);
            foreach ($invoice['InvoiceDetail'] as $detailIndex => $detail) {
                $tmp = array();
                $asset_category_id = $detail['asset_category_id'];
                $amount = $total_dp / $item_count;
                $department_id = $detail['department_id'];
                $start_index = count($journalLines);
                $tmp = $this->generatePaymentJournalLines($start_index, $amount, $department_id, $invoice_id, $journal_group_id, $departmentAccountCodes, $accountNames, $accountCodes, $journalPositions, $asset_category_id);
                if (!$tmp)
                    die('journal template journal group Pembelian FA DP not found for asset category ' . $asset_category_id);
                $journalLines += $tmp;
            }
            $offset_detail_dp = 2;
            //$total_amount 		+= $amount;
        }
        // ada dp atau beberapa pembayaran...	
        if ($payments > 1 || $total_dp) {
            $total_term = 0;
            //echo 'pay & dp<br>';
            if ($invoice['Invoice']['request_type_id'] == request_type_stock_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_inventory_id');;
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_service_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_service_id');
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_point_reward_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_point_reward_id');
            } else {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_id');
            }

            if ($journal_group_id == $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_id')) {
                $perCategoryPerDepartmentAmount = array();

                foreach ($invoice['InvoiceDetail'] as $detailIndex => $detail) {
                    $assetCategoryId = $detail['asset_category_id'];
                    $departmentId = $detail['department_id'];

                    if (!array_key_exists($assetCategoryId, $perCategoryPerDepartmentAmount)) {
                        $perCategoryPerDepartmentAmount[$assetCategoryId] = array();
                    }

                    if (!array_key_exists($departmentId, $perCategoryPerDepartmentAmount[$assetCategoryId])){
                        $perCategoryPerDepartmentAmount[$assetCategoryId][$departmentId] = 0;
                    }

                    $perCategoryPerDepartmentAmount[$assetCategoryId][$departmentId] += $detail['amount_nett'];
                }

                foreach ($perCategoryPerDepartmentAmount as $assetCategoryId => $departmentAmounts) {
                    foreach ($departmentAmounts as $departmentId => $departmentAmount) {
                        $startIndex = count($journalLines);
                        $tmp = $this->generatePaymentJournalLines($startIndex, $departmentAmount, $departmentId, $invoice_id, $journal_group_id, $departmentAccountCodes, $accountNames, $accountCodes, $journalPositions, $assetCategoryId);

                        if (count($tmp) == 0) {
                            die('journal template journal group Pembelian FA not found for asset category ' . $assetCategoryId);
                        }

                        $journalLines += $tmp;
                    }
                }
            } else {
                foreach ($invoice['InvoicePayment'] as $payment_index => $invoicePayment) {
                    $amount_paid = $invoicePayment['amount_paid'];
                    $amount_invoice = $invoicePayment['amount_invoice'];

                    $is_lunas = round($invoicePayment['amount_due'], 2) == round($invoicePayment['amount_paid'], 2);
                    $total_term = $total_term + $invoicePayment['term_percent'];

                    if ($amount_paid == 0) {
                        continue;
                    }

                    foreach ($invoice['InvoiceDetail'] as $detailIndex => $detail) {
                        $tmp = array();
                        $asset_category_id = $detail['asset_category_id'];
                        $total_amount = ($detail['amount_nett'] * $amount_paid / $amount_invoice);
                        $department_id = $detail['department_id'];

                        $start_index = count($journalLines);
                        $tmp = $this->generatePaymentJournalLines($start_index, $total_amount, $department_id, $invoice_id, $journal_group_id, $departmentAccountCodes, $accountNames, $accountCodes, $journalPositions, $asset_category_id);

                        if (!$tmp)
                            die('journal template journal group Pembelian FA not found for asset category ' . $asset_category_id);
                        //pembayaran pertama, kurangi dulu dgn dp
                        /* 					if($payment_index==0)
                          {
                         */ $tmp[$start_index]['amount_db'] = $total_amount; //- $total_dp;
                        $tmp[$start_index]['amount_cr'] = 0;
                        $tmp[$start_index + 1]['amount_db'] = 0;
                        $tmp[$start_index + 1]['amount_cr'] = $total_amount; //- $total_dp;					
                        $total_amount += $total_amount; //-$total_dp;
                        /* 					}
                          else
                          {
                          $tmp[$start_index]['amount_db'] 	= $amount_paid;
                          $tmp[$start_index]['amount_cr']		= 0;
                          $tmp[$start_index+1]['amount_db']	= 0;
                          $tmp[$start_index+1]['amount_cr'] 	= $amount_paid;
                          $total_amount 						+= $amount_paid;
                          }
                         */ $journalLines += $tmp;
                    }// details
                    // journal pelunasan
                    //if($is_lunas)
                    /* 				if($total_term == "100" || $total_term == "100.00")
                      {
                      if($invoice['Invoice']['request_type_id']==request_type_stock_id){
                      $journal_group_id 	= journal_group_inventory_id;
                      }elseif($invoice['Invoice']['request_type_id']==request_type_service_id){
                      $journal_group_id 	= journal_group_service_id;
                      }elseif($invoice['Invoice']['request_type_id']==request_type_point_reward_id){
                      $journal_group_id 	= journal_group_point_reward_id;
                      }else{
                      $journal_group_id 	= journal_group_purchase_id;
                      }

                      foreach($invoice['InvoiceDetail'] as $detailIndex=>$detail)
                      {
                      $tmp				= array();
                      $start_index		= count($journalLines);
                      $asset_category_id	= $detail['asset_category_id'];
                      $total_amount		= $detail['amount_nett'] ;
                      $department_id		= $detail['department_id'];

                      $tmp				= $this->generatePaymentJournalLines($start_index,$total_amount, $department_id,$invoice_id, $journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions, $asset_category_id);
                      if(!$tmp)
                      die('journal template journal_group_purchase_id not found for asset category ' . $asset_category_id);
                      //debug($start_index);
                      $journalLines 		+= $tmp;
                      }
                      }
                     */
                }//payments
            }
        }
        else { // 1 kali pembayaran
            //echo '1 byr<br>';
            $invoicePayment = $invoice['InvoicePayment'][0];
            //$total_amount		= $invoicePayment['amount_paid'];
            $start_index = 0;

            if ($invoice['Invoice']['request_type_id'] == request_type_stock_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_inventory_id');;
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_service_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_service_id');
            } elseif ($invoice['Invoice']['request_type_id'] == request_type_point_reward_id) {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_point_reward_id');
            } else {
                $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_id');
            }

            foreach ($invoice['InvoiceDetail'] as $i => $detail) {
                //$start_index 		= $detailSize * $i;
                $start_index = count($journalLines);
                $asset_category_id = $detail['asset_category_id'];
                $total_amount = $detail['amount_nett'];
                $department_id = $detail['department_id'];
                $tmp = $this->generatePaymentJournalLines($start_index, $total_amount, $department_id, $invoice_id, $journal_group_id, $departmentAccountCodes, $accountNames, $accountCodes, $journalPositions, $asset_category_id);
                if (!$tmp)
                    die('journal template journal_group_purchase_id not found for asset category ' . $asset_category_id);
                $journalLines += $tmp;
            }
        }
        if ($other_cost > 0) {
            //echo 'ot co<br>';
            $journalTemp = new JournalTemplate;
            $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                    'journal_group_id' => $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_pendapatan_id'),
            )));

            $start_index = count($journalLines);

            $tmp[$start_index]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $tmp[$start_index]['date'] = date('Y-m-d');
            $tmp[$start_index]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id']; // RAB umum
            $tmp[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $tmp[$start_index]['journal_position_id'] = '1';
            $tmp[$start_index]['journal_position_name'] = 'Debit';
            $tmp[$start_index]['amount_db'] = $other_cost;
            $tmp[$start_index]['amount_cr'] = '0';
            $tmp[$start_index]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
            $tmp[$start_index]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index]['reff']['id'] = $invoice['Invoice']['id'];

            $tmp[$start_index + 1]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index + 1]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $tmp[$start_index + 1]['date'] = date('Y-m-d');
            $tmp[$start_index + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id']; // Pendapatan
            $tmp[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $tmp[$start_index + 1]['journal_position_id'] = '2';
            $tmp[$start_index + 1]['journal_position_name'] = 'Credit';
            $tmp[$start_index + 1]['amount_db'] = '0';
            $tmp[$start_index + 1]['amount_cr'] = $other_cost;
            $tmp[$start_index + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
            $tmp[$start_index + 1]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index + 1]['reff']['id'] = $invoice['Invoice']['id'];
            $journalLines += $tmp;
        }
        if ($invoice['Invoice']['wht_total'] > 0) {
            //echo 'wht<br>';
            $journalTemp = new JournalTemplate;
            $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                    'journal_group_id' => $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_invoice_wht_total_id'),
            )));

            $start_index = count($journalLines);

            $tmp[$start_index]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $tmp[$start_index]['date'] = date('Y-m-d');
            $tmp[$start_index]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
            ; // RAB umum
            $tmp[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $tmp[$start_index]['journal_position_id'] = '1';
            $tmp[$start_index]['journal_position_name'] = 'Debit';
            $tmp[$start_index]['amount_db'] = $invoice['Invoice']['wht_total'];
            $tmp[$start_index]['amount_cr'] = '0';
            $tmp[$start_index]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
            $tmp[$start_index]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index]['reff']['id'] = $invoice['Invoice']['id'];

            $tmp[$start_index + 1]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index + 1]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $tmp[$start_index + 1]['date'] = date('Y-m-d');
            $tmp[$start_index + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
            ; // Pendapatan
            $tmp[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $tmp[$start_index + 1]['journal_position_id'] = '2';
            $tmp[$start_index + 1]['journal_position_name'] = 'Credit';
            $tmp[$start_index + 1]['amount_db'] = '0';
            $tmp[$start_index + 1]['amount_cr'] = $invoice['Invoice']['wht_total'];
            $tmp[$start_index + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
            $tmp[$start_index + 1]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index + 1]['reff']['id'] = $invoice['Invoice']['id'];

            $tmp[$start_index + 2]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index + 2]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
            $tmp[$start_index + 2]['date'] = date('Y-m-d');
            $tmp[$start_index + 2]['account_id'] = $journalTemplate['JournalTemplateDetail'][2]['account_id'];
            ; // Pendapatan
            $tmp[$start_index + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
            $tmp[$start_index + 2]['journal_position_id'] = '1';
            $tmp[$start_index + 2]['journal_position_name'] = 'Debit';
            $tmp[$start_index + 2]['amount_db'] = $invoice['Invoice']['wht_total'];
            $tmp[$start_index + 2]['amount_cr'] = '0';
            $tmp[$start_index + 2]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][2]['journal_template_id'];
            $tmp[$start_index + 2]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index + 2]['reff']['id'] = $invoice['Invoice']['id'];

            $tmp[$start_index + 3]['department_id'] = KPNO_DEPARTMENT_ID;
            $tmp[$start_index + 3]['account_code'] = HQ_DEPARTMENT . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
            $tmp[$start_index + 3]['date'] = date('Y-m-d');
            $tmp[$start_index + 3]['account_id'] = $journalTemplate['JournalTemplateDetail'][3]['account_id'];
            ; // Pendapatan
            $tmp[$start_index + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
            $tmp[$start_index + 3]['journal_position_id'] = '1';
            $tmp[$start_index + 3]['journal_position_name'] = 'Credit';
            $tmp[$start_index + 3]['amount_db'] = '0';
            $tmp[$start_index + 3]['amount_cr'] = $invoice['Invoice']['wht_total'];
            $tmp[$start_index + 3]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][3]['journal_template_id'];
            $tmp[$start_index + 3]['reff']['detail_source'] = 'invoice';
            $tmp[$start_index + 3]['reff']['id'] = $invoice['Invoice']['id'];

            $journalLines += $tmp;
        }

        //echo '<pre>';
        //var_dump($journal_group_id);
        //echo '</pre>';die();

        $journalTemplates = $this->JournalTransaction->JournalTemplate->find('list');
        $this->set(compact(
                        'journalLines', 'journal_group_id', 'journal_template_id', 'journalTemplates', 'action', 'departments')
        );
        $this->render('prepare_posting');
    }

    function generatePaymentJournalLines($start_index, $amount, $department_id, $invoice_id, $journal_group_id, $departmentAccountCodes, $accountNames, $accountCodes, $journalPositions, $asset_category_id = null) {
        $journalLines = null;

        //mencheck kpno atau bukan bila kpno dan journal group pembelian maka journal group nya di ganti
        //if($department_id==KPNO_DEPARTMENT_ID && $journal_group_id==journal_group_purchase_id)
        //$journal_group_id=journal_group_purchase_kpno_id;

        if ($asset_category_id)
            $con = array('conditions' => array('journal_group_id' => $journal_group_id, 'asset_category_id' => $asset_category_id));
        else
            $con = array('conditions' => array('journal_group_id' => $journal_group_id));

        /*
          if($journal_group_id == journal_group_invoice_payment_id)
          $con=array('conditions'=>array('journal_group_id'=>$journal_group_id));
         */


        $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', $con);

        $Invoice = new Invoice;
        $invoice_data = $Invoice->read(null, $invoice_id);
        $convert_asset = $invoice_data['Invoice']['convert_asset'];
        $res = $this->JournalTransaction->query('select count(id) as total from invoice_payments where invoice_id = "' . $invoice_id . '" ');
        $total_inv_pay = $res[0][0]['total'];

        if (
                $journal_group_id == $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_id')
                && $total_inv_pay != 0
                && $convert_asset == 0) {
                $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', array('conditions' => array(
                    'asset_category_id' => $asset_category_id,
                    'journal_group_id' => $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_as_cost')
                )));
        }
        //echo '<pre>';
        //var_dump($journalTemplate);
        //echo '</pre>';die();

        if (!empty($journalTemplate)) {
            foreach ($journalTemplate['JournalTemplateDetail'] as $j => $jtd) {
                $accounts = $this->JournalTransaction->Account->findById($jtd['account_id']);
                $acc_prefix = $accounts['Account']['acc_prefix'];

                $index = $start_index + $j;
                $amount_db = $jtd['journal_position_id'] == 1 ? $amount : "";
                $amount_cr = $jtd['journal_position_id'] == 2 ? $amount : "";
                $journalLines[$index]['department_id'] = $jtd['for_destination_branch'] == 1 ? $department_id : KPNO_DEPARTMENT_ID;
                $dep_id = $jtd['for_destination_branch'] == 1 ? $department_id : KPNO_DEPARTMENT_ID;
                $t24_acc_code = $this->JournalTransaction->Department->find('list', array('fields' => array('Department.t24_account_code')));

                if ($acc_prefix == "IDR") {
                    $journalLines[$index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($t24_acc_code[$dep_id], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$index]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$index]['account_id'] = $jtd['account_id'];
                $journalLines[$index]['account_name'] = $accountNames[$jtd['account_id']];

                if ($journal_group_id == $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_purchase_id') && $total_inv_pay != 0) {
                    // if purchase and set to biaya
                    if ($convert_asset == 0) {
                            //echo '<pre>';
                            //var_dump($journalTemplate);
                            //echo '</pre>';die();
                            $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
                            $accounts = $this->JournalTransaction->Account->findById($jtd['account_id']);
                            $acc_prefix = $accounts['Account']['acc_prefix'];
                            if ($acc_prefix == "IDR") {
                                $journalLines[$index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($t24_acc_code[$dep_id], 5, 4);
                            } else if ($acc_prefix == "PL") {
                                $journalLines[$index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                            } else {
                                $journalLines[$index]['account_code'] = $accounts['Account']['t24_gl'];
                            }

                        if ($index % 2 == 0) {
                            //$journalLines[$index]['account_code'] = 'PL62160';
                            //$journalLines[$index]['account_id'] = '63';
                            //$journalLines[$index]['account_name'] = 'Biaya Inventaris Kantor';

                            $journalLines[$index]['account_id'] = $jtd['account_id'];
                            $journalLines[$index]['account_name'] = $accounts['Account']['name'];
                        } else if ($index % 2 != 0) {
                            
                            $journalLines[$index]['account_id'] = $jtd['account_id'];
                            $journalLines[$index]['account_name'] = $accounts['Account']['name'];
                        }
                    }
                }

                //$journalLines[$index]['account_code']			= $departmentAccountCodes[$jtd['for_destination_branch']==1?$department_id:KPNO_DEPARTMENT_ID] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 

                $journalLines[$index]['date'] = date("Y-m-d");

                $journalLines[$index]['journal_position_id'] = $jtd['journal_position_id'];
                $journalLines[$index]['journal_position_name'] = $journalPositions[$jtd['journal_position_id']];

                $journalLines[$index]['amount_db'] = abs($amount_db);
                $journalLines[$index]['amount_cr'] = abs($amount_cr);
                $journalLines[$index]['journal_template_id'] = $jtd['journal_template_id'];
                $journalLines[$index]['reff'] = array('detail_source' => 'invoice', 'id' => $invoice_id);
            }// foreach 
        }//emtpy	

        return $journalLines;
    }

    function prepare_posting($detail_source = null, $journal_group_id = null, $doc_id = null, $holding = null) {

        $this->Session->write('JournalTransaction.doc_id', $doc_id);
        $this->Session->write('JournalTransaction.journal_group_id', $journal_group_id);
        $departments = $this->JournalTransaction->Department->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));

        $Asset = new Asset;
        $Invoice = new Invoice;
        $InvoicePayment = new InvoicePayment;
        $Movement = new Movement;
        $Department = new Department;
        $Disposal = new Disposal;
        $Inlog = new Inlog;
        $Outlog = new Outlog;
        $Retur = new Retur;
        $SupplierRetur = new SupplierRetur;
        $Usage = new Usage;
        $Po = new Po;
        $DeliveryOrder = new DeliveryOrder;
        $Reklass = new Reklass;

        /// check the type of details 
        if (empty($detail_source)) {
            $this->Session->flash(__('Please specify the details to create the journal from', true));
            $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
        }

        /// check the journal group
        if (empty($journal_group_id)) {
            $this->Session->flash(__('Please specify the journal group to create the journal from', true));
            $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
        }

        /// check the type of details
        if ($detail_source == 'invoice') { //one time invoice payment
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the invoice id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_invoice';
            $details = $Invoice->InvoiceDetail->find('all', array('conditions' => array('invoice_id' => $doc_id)));
            $model = 'InvoiceDetail';
            $amount_field = 'amount_nett';
            $doc_id = 'invoice_id';
            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        } else if ($detail_source == 'invoice_payment' && $holding != 'hold') { // partial invoice payment
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the invoice payment id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_invoice_payment';
            $invoicePayment = $InvoicePayment->read(null, $doc_id);
            $invoiceId = $invoicePayment['Invoice']['id'];
            $details = $InvoicePayment->Invoice->InvoiceDetail->find('all', array('conditions' => array('invoice_id' => $invoiceId)));
            $model = 'InvoiceDetail';
            $amount_field = 'amount_nett';
            $doc_id = 'invoice_id';
            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;

            $percentage = $invoicePayment['InvoicePayment']['amount_paid'] / $invoicePayment['Invoice']['total'];
        } else if ($detail_source == 'po') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the PO id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }

            $action = 'posting_po';

            $details = $Po->PoDetail->find('all', array('conditions' => array('po_id' => $doc_id)));

            //dihitung dari down payment / total 
            $percentage = $details[0]['Po']['down_payment'] / $details[0]['Po']['total_cur'];

            $model = 'PoDetail';
            $amount_field = 'amount_nett_cur';
            $doc_id = 'po_id';
            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        } else if ($detail_source == 'delivery_order') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the Delivery Order id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }

            $action = 'posting_delivery_order';

            $details = $DeliveryOrder->DeliveryOrderDetail->find('all', array('conditions' => array('delivery_order_id' => $doc_id)));

            $down_payment = $details[0]['Po']['down_payment'];
            $is_first_delivery_order = $details[0]['DeliveryOrder']['is_first'];
            $line_count = count($details);

            $model = 'DeliveryOrderDetail';
            $amount_field = 'amount_nett_cur';
            $doc_id = 'delivery_order_id';
            $detailSize = 2;
        } else if ($detail_source == 'asset') {
            $action = 'posting_asset';
            //$date_end =  date("Y-m-15",strtotime("+1 month"));
            //$date_end =  date("Y-m-15");
            $date_end = date("2013-12-15");


            $sql = "select ast.* from assets ast
						left join invoices inv on inv.id = ast.invoice_id
						where 
						ast.posting = '0'
						and ast.date_start is not null
						and ast.date_start <= '2013-12-15'
						and ast.date_end >= '2013-12-15'
						and ast.umurek > '0'
						and ast.price > '" . $this->configs['min_asset_value'] . "'
						or inv.convert_asset = '1'
						order by ast.id";
            $res = $Asset->query($sql);
            $n = 0;
            foreach ($res as $data) {
                $details[$n]['Asset'] = $data[0];        // ASSET
                $s = $Asset->query('select * from purchases where id = "' . $data[0]['purchase_id'] . '" ');
                if ($s) {
                    $details[$n]['Purchase'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['Purchase'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from asset_categories where id = "' . $data[0]['asset_category_id'] . '" ');
                if ($s) {
                    $details[$n]['AssetCategory'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['AssetCategory'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from currencies where id = "' . $data[0]['currency_id'] . '" ');
                if ($s) {
                    $details[$n]['Currency'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['Currency'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from departments where id = "' . $data[0]['department_id'] . '" ');
                if ($s) {
                    $details[$n]['Department'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['Department'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from locations where id = "' . $data[0]['location_id'] . '" ');
                if ($s) {
                    $details[$n]['Location'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['Location'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from cost_centers where id = "' . $data[0]['cost_center_id'] . '" ');
                if ($s) {
                    $details[$n]['CostCenter'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['CostCenter'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from business_types where id = "' . $data[0]['business_type_id'] . '" ');
                if ($s) {
                    $details[$n]['BusinessType'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['BusinessType'] = NULL;       // PURCHASE
                }
                $s = $Asset->query('select * from asset_details where asset_id = "' . $data[0]['id'] . '" ');
                if ($s) {
                    foreach ($s as $r) {
                        $details[$n]['AssetDetail'] = $s[0][0];       // PURCHASE
                    }
                } else {
                    $details[$n]['AssetDetail'] = NULL;       // PURCHASE						
                }
                $s = $Asset->query('select * from reklasses where asset_id = "' . $data[0]['id'] . '" ');
                if ($s) {
                    $details[$n]['Reklass'] = $s[0][0];       // PURCHASE
                } else {
                    $details[$n]['Reklass'] = NULL;        // PURCHASE
                }

                $n++;
            }

            /*
              $details = $Asset->find('all', array('conditions'=>array(
              'Asset.posting'=>0,
              'Asset.date_start !=' => null, //tidak sama dengan null
              'Asset.date_start <='=>date('2013-12-15'), // yang tanggal start lebih dari periode bulan ini , yaitu tgl 15 setiap bulan
              'Asset.date_end >='=>$date_end, // masih berlaku  di bulan ini
              'Asset.umurek >'=>0, // umurek diatas 0 yang di depreasiasi
              'Asset.price >'=>$this->configs['min_asset_value']
              ),
              'order'=>'asset.id'));
             */
            //echo '<pre>';
            //var_dump($details);
            //echo '</pre>';die();
            $model = 'Asset';

            $min_asset_value = $this->configs['min_asset_value'];

            if (empty($details)) {
                $this->redirect(array('action' => 'no_posting'));
            } else {
                $Asset->process_depr($min_asset_value);
            }

            $amount_field = 'depbln';
            $doc_id = 'id';
            $detailSize = 2;
        } else if ($detail_source == 'movement') {
            $action = 'posting_movement';
            $min_asset_value = $this->configs['min_asset_value'];
            $movement = $Movement->read(null, $doc_id);
            $Movement->recursive = 0;
            $details = $Movement->MovementDetail->find('all', array('conditions' => array('MovementDetail.movement_id' => $doc_id, 'MovementDetail.price >' => $min_asset_value)));
            $model = 'MovementDetail';

            //get source and dest department
            $source_dept_id = $movement['Movement']['source_department_id'];
            $source_dept = $Department->read(null, $source_dept_id);
            $dest_dept_id = $movement['Movement']['dest_department_id'];
            $dest_dept = $Department->read(null, $dest_dept_id);
            $doc_id = 'movement_id';
            $detailSize = 12;
        } else if ($detail_source == 'disposal') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the Disposal id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }

            $disposal = $Disposal->read(null, $doc_id);
            $department_id = $disposal['Disposal']['department_id'];
            $disposal_type_id = $disposal['Disposal']['disposal_type_id'];
            $min_asset_value = $this->configs['min_asset_value'];

            $action = 'posting_disposal';
            $details = $Disposal->DisposalDetail->find('all', array('conditions' => array('DisposalDetail.disposal_id' => $doc_id, 'DisposalDetail.price >' => $min_asset_value)));
            $model = 'DisposalDetail';
            $doc_id = 'disposal_id';
            $detailSize = 10;
        } else if ($detail_source == 'outlog') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the outlog id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_outlog';
            $details = $Outlog->OutlogDetail->find('all', array('conditions' => array('OutlogDetail.outlog_id' => $doc_id)));
            $model = 'OutlogDetail';
            $department_id = $details[0]['Outlog']['department_id'];
            $Outlog->query("update outlogs set outlog_status_id = '" . status_outlog_finish_id . "' where id = '" . $doc_id . "' ");


            //isi dulu asset_category_id  
            foreach ($details as $i => $d) {
                $details[$i][$model]['asset_category_id'] = $d['Item']['asset_category_id'];
                $details[$i][$model]['department_id'] = $department_id; /// nanti ganti dibawah menjadi kantor pusat, jika account = persediaan
            }
            $amount_field = 'amount';
            $doc_id = 'outlog_id';

            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        } else if ($detail_source == 'inlog') {
            
        } else if ($detail_source == 'usage') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the usage id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_usage';
            $details = $Usage->UsageDetail->find('all', array('conditions' => array('usage_id' => $doc_id)));
            $model = 'UsageDetail';
            $department_id = $details[0]['Usage']['department_id'];

            //isi dulu asset_category_id dan department_id
            foreach ($details as $i => $d) {
                $details[$i][$model]['asset_category_id'] = $d['Item']['asset_category_id'];
                $details[$i][$model]['department_id'] = $department_id;
            }
            $amount_field = 'amount';
            $doc_id = 'usage_id';

            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        } else if ($detail_source == 'retur') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the retur id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_retur';
            $details = $Retur->ReturDetail->find('all', array('conditions' => array('retur_id' => $doc_id)));
            $model = 'ReturDetail';
            $department_id = $details[0]['Retur']['department_id'];

            //isi dulu asset_category_id dan department_id
            foreach ($details as $i => $d) {
                $details[$i][$model]['asset_category_id'] = $d['Item']['asset_category_id'];
                $details[$i][$model]['department_id'] = $department_id;
            }
            $amount_field = 'amount';
            $doc_id = 'retur_id';

            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        } else if ($detail_source == 'supplier_retur') {
            if (empty($doc_id)) {
                $this->Session->flash(__('Please specify the supplier retur id for this type of detail source', true));
                $this->redirect(array('controller' => 'journal_transactions', 'action' => 'index'));
            }
            $action = 'posting_supplier_retur';
            $details = $SupplierRetur->SupplierReturDetail->find('all', array('conditions' => array('supplier_retur_id' => $doc_id)));
            $model = 'SupplierReturDetail';

            //isi dulu asset_category_id dan department_id
            foreach ($details as $i => $d) {
                $details[$i][$model]['asset_category_id'] = $d['Item']['asset_category_id'];
                $details[$i][$model]['department_id'] = HQ_DEPARTMENT_ID;
            }

            $amount_field = 'amount';
            $doc_id = 'supplier_retur_id';

            //jumlah record details di jurnal template, utk langkap record di journal trx
            $detailSize = 2;
        }

        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.t24_gl')));
        $seq = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.seq_t24')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');
        $journalLines = array();

        //untuk setiap items, cari journal template * detail nya
        if (!empty($details)) {

            foreach ($details as $i => $detail) {
                if ($detail_source == 'disposal' && $disposal_type_id == type_disposal_sales_id) {
                    $loss_profit = $detail[$model]['loss_profit_amount'];
                    if ($loss_profit > 0) {
                        $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_profit_sales_id');
                        $detailSize = 8;
                    } else if ($loss_profit == 0) {
                        $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_balance_sales_id');
                        $detailSize = 8;
                    } else if ($loss_profit < 0) {
                        $journal_group_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_loss_sales_id');
                        $detailSize = 8;
                    }
                }

                $amount_cr = $amount_db = 0;
                $assetCategoryId = $detail[$model]['asset_category_id'];

                $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $assetCategoryId))
                );

                if (!empty($journalTemplate)) {
                    foreach ($journalTemplate['JournalTemplateDetail'] as $j => $jtd) {
                        //$index = $detailSize*$i + $j;
                        $index = count($journalLines);

                        if ($detail_source == 'invoice') {
                            // $account_id		=$jtd['account_id'];
                            // $account 		=$this->JournalTransaction->Account->read(null, $account_id);
                            // $account_type_id=$account['Account']['account_type_id'];

                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'invoice_payment') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] * $percentage : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] * $percentage : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'po') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] * $percentage : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] * $percentage : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'delivery_order') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";

                            $account_id = $jtd['account_id'];
                            $account = $this->JournalTransaction->Account->read(null, $account_id);
                            $account_type_id = $account['Account']['account_type_id'];
                            //jika ada $down_payment dan delivery_order pertama, 
                            // maka tambahkan di credit account uang muka,
                            // jumlah credit dikurangi dgn $down_payment
                            if ($down_payment > 0 && $is_first_delivery_order == 1) {

                                if ($account_type_id == account_type_supplier_payable_id)
                                    $amount_cr -= $down_payment / $line_count;
                                else if ($account_type_id == account_type_down_payment_id)
                                    $amount_cr = $down_payment;
                            }else {
                                if ($account_type_id == account_type_down_payment_id) {
                                    $amount_db = 0;
                                    $amount_cr = 0;
                                }
                            }


                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'asset') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            $journalLines[$index]['new_code'] = $detail['Department']['t24_account_code'];
                            $journalLines[$index]['trcode'] = $jtd['transaction_code_id'];
                            $journalLines[$index]['pl_categ'] = $accountCodes[$jtd['account_id']];
                            $journalLines[$index]['account_name'] = $accountNames[$jtd['account_id']];

                            $journalLines[$index]['cost_center_id'] = $detail[$model]['cost_center_id'];
                            //$journalLines[$index]['account_code'] = $detail['Department']['account_code'] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);

                            //$journalLines[$index]['account_code']	= "IDR" . $accountCodes[$jtd['account_id']] . $seq[$jtd['account_id']] . substr($detail['Department']['t24_account_code'], 5) ; 
                        } else if ($detail_source == 'movement') {

                            //cari kolom jumlah dari movement_details berdasasran account_type_id:
                            //accumulasi     : accum_dep
                            //harga perolehan: price
                            //rpkp cabang    : book_value
                            //rp_umum

                            $journalLines[$index]['account_name'] = '';
                            if ($jtd['for_destination_branch'] == 1 && $jtd['journal_position_id'] == 1) {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[$dest_dept_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[$dest_dept_id];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = $dest_dept_id;
                                $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['price'] : "";
                                $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['price'] : "";
                            } elseif ($jtd['for_destination_branch'] == 0 && $jtd['journal_position_id'] == 2) {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[$source_dept_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[$source_dept_id];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = $source_dept_id;
                                $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['price'] : "";
                                $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['price'] : "";
                            } elseif ($jtd['for_destination_branch'] == 0 && $jtd['journal_position_id'] == 1) {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[$source_dept_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[$source_dept_id];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = $source_dept_id;
                                //$amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['book_value'] : "";
                                //$amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['book_value'] : "";
                                $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['accum_dep'] : "";
                                $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['accum_dep'] : "";
                            } elseif ($jtd['for_destination_branch'] == 1 && $jtd['journal_position_id'] == 2) {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[$dest_dept_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[$dest_dept_id];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = $dest_dept_id;
                                //$amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['book_value'] : "";
                                //$amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['book_value'] : "";
                                $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model]['accum_dep'] : "";
                                $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model]['accum_dep'] : "";
                            }
                        } else if ($detail_source == 'disposal') {
                            $account_id = $jtd['account_id'];
                            $account = $this->JournalTransaction->Account->read(null, $account_id);
                            $account_type_id = $account['Account']['account_type_id'];
                            if ($disposal_type_id == type_disposal_write_off_id) {
                                switch ($jtd['contra_account']) {
                                    case 'loss':
                                        $amount_field = 'loss_profit_amount';
                                        break;
                                    case 'accum_dep':
                                        $amount_field = 'accum_dep';
                                        break;
                                    // case account_type_non_operational_cost_id:
                                    // $amount_field = 'book_value';
                                    // break;
                                    // case account_type_acquisition_price_id:
                                    // $amount_field = 'price';
                                    // break;
                                    case '':
                                        if ($jtd['for_accum_dep'] == 0)
                                            $amount_field = 'price';
                                        else if ($jtd['for_accum_dep'] == 1)
                                            $amount_field = 'accum_dep';
                                        break;
                                    default:
                                        $amount_field = 'price';
                                        break;
                                }
                            }
                            else if ($disposal_type_id == type_disposal_sales_id) {

                                switch ($jtd['contra_account']) {
                                    case 'accum_dep':
                                        $amount_field = 'accum_dep';
                                        break;
                                    case 'fa':
                                        $amount_field = 'price';
                                        break;
                                    case 'profit':
                                        $amount_field = 'loss_profit_amount';
                                        break;
                                    case 'loss':
                                        $amount_field = 'loss_profit_amount';
                                        break;
                                    case 'rab_kas':
                                        $amount_field = 'loss_profit_amount';
                                        break;
                                    case 'book_value':
                                        $amount_field = 'book_value';
                                        break;
                                    /* case account_type_acquisition_price_id:
                                      $amount_field = 'price';
                                      break;
                                      case account_type_rp_id:
                                      if($jtd['contra_account'] 		== 'accum_dep')
                                      $amount_field = 'accum_dep';
                                      else if($jtd['contra_account'] 	== 'rab_kas')
                                      $amount_field = 'sales_amount';
                                      else if($jtd['contra_account'] 	== 'profit')
                                      $amount_field = 'loss_profit_amount';
                                      else if($jtd['contra_account'] 	== 'fa')
                                      $amount_field = 'price';
                                      break; */
                                }
                            }

                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            if ($jtd['for_destination_branch'] == 1) {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[$department_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[$department_id];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = $department_id;
                            } else {
                                //$journalLines[$index]['account_code'] = $departmentAccountCodes[HQ_DEPARTMENT_ID] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                                $departmentAccountCode = $departmentAccountCodes[HQ_DEPARTMENT_ID];
                                $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                                $journalLines[$index]['department_id'] = HQ_DEPARTMENT_ID;
                            }
                        } else if ($detail_source == 'outlog') {
                            $account_id = $jtd['account_id'];
                            $account = $this->JournalTransaction->Account->read(null, $account_id);
                            $account_type_id = $account['Account']['account_type_id'];

                            //if type account == account_type_inventory_id, maka department id= HQ
                            if ($account_type_id == account_type_inventory_id) {
                                $department_id = HQ_DEPARTMENT_ID;
                            } else {
                                $department_id = $detail[$model]['department_id'];
                            }

                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $department_id;
                            //$journalLines[$index]['account_code']	= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
                            $acc_prefix = $account['Account']['acc_prefix'];
                            if ($acc_prefix == "IDR") {
                                $journalLines[$index]['account_code'] = $account['Account']['acc_prefix'] . $account['Account']['t24_gl'] . $account['Account']['seq_t24'] . substr($departmentAccountCodes[$department_id], 5, 4);
                            } else if ($acc_prefix == "PL") {
                                $journalLines[$index]['account_code'] = $account['Account']['acc_prefix'] . $account['Account']['t24_gl'];
                            } else {
                                $journalLines[$index]['account_code'] = $account['Account']['t24_gl'];
                            }
                        } else if ($detail_source == 'inlog') {
                            
                        } else if ($detail_source == 'usage') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'retur') {
                            $account_id = $jtd['account_id'];
                            $account = $this->JournalTransaction->Account->read(null, $account_id);
                            $account_type_id = $account['Account']['account_type_id'];

                            //if type account == account_type_inventory_id, maka department id= HQ
                            if ($account_type_id == account_type_inventory_id) {
                                $department_id = HQ_DEPARTMENT_ID;
                            } else {
                                $department_id = $detail[$model]['department_id'];
                            }
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $department_id;
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$department_id] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$department_id];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        } else if ($detail_source == 'supplier_retur') {
                            $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                            $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                            $journalLines[$index]['department_id'] = $detail[$model]['department_id'];
                            //$journalLines[$index]['account_code'] = $departmentAccountCodes[$detail[$model]['department_id']] . '.' . ACCOUNT_CURRENCY_IDR_CODE . '.' . $accountCodes[$jtd['account_id']];
                            $departmentAccountCode = $departmentAccountCodes[$detail[$model]['department_id']];
                            $journalLines[$index]['account_code'] = $this->constructAccountCodeFromJournalTemplateDetail($jtd, $departmentAccountCode);
                        }


                        $journalLines[$index]['date'] = date("Y-m-d");
                        $journalLines[$index]['account_id'] = $jtd['account_id'];
                        $journalLines[$index]['account_name'] = $accountNames[$jtd['account_id']];
                        $journalLines[$index]['journal_position_id'] = $jtd['journal_position_id'];
                        $journalLines[$index]['journal_position_name'] = $journalPositions[$jtd['journal_position_id']];

                        $journalLines[$index]['amount_db'] = abs($amount_db);
                        $journalLines[$index]['amount_cr'] = abs($amount_cr);
                        $journalLines[$index]['journal_template_id'] = $jtd['journal_template_id'];
                        $journalLines[$index]['reff'] = array('detail_source' => $detail_source, 'id' => $detail[$model][$doc_id]);
                    }//foreach jtd
                }//empty jtd
            }
        }//foreach details 
        if ($detail_source == 'reklass') {
            $reklass = $Reklass->read(null, $doc_id);
            $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
            $start = (-1);
            /* $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', 
              array('conditions'=>array(
              'journal_group_id'=>$journal_group_id,
              'asset_category_id'=>$reklass['Asset']['asset_category_id']))
              );
             */
            $journalData = $this->JournalTransaction->query("select d.id as id_kategori_awal,d.name as kategori_awal,a.doc_no, f.id as id_status_reklas, f.name as status_name, c.id as id_kategori_akhir, c.name as kategori_akhir, a.amount, a.depthnini, e.id as id_item, e.name as item_name 
																	from reklasses a 
																	left join assets b on b.id = a.asset_id
																	left join asset_categories c on c.id = a.asset_category_id
																	left join asset_categories d on d.id = b.asset_category_id
																	left join items e on e.id = a.item_id
																	left join reklas_statuses f on f.id = a.reklas_status_id
																	where a.id = '" . $doc_id . "' ");



            $departments = $this->JournalTransaction->Department->find('list');
            $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
            $action = 'posting_reklass';
            $start++;
            $start_index = $start * 4;

            // golongan target menjadi db, golongan asal menjadi cr
            $cr_satu = $journalData[0][0]['id_kategori_awal'];
            $db_satu = $journalData[0][0]['id_kategori_akhir'];

            $res = $this->JournalTransaction->query("select b.id from asset_categories a
																left join asset_category_types b on b.id = a.asset_category_type_id
																where a.id = '" . $db_satu . "' ");
            $destination_id = $res[0][0]['id'];
            if ($destination_id == status_asset_category_type_fa_id) {
                $destination_template_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalTemplate', 'journal_template_reklas_to_fa_id');
            } else {
                $destination_template_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalTemplate', 'journal_template_reklas_to_oc_id');
            }

            if ($db_satu == 1) {
                $db_acc_id_satu = 32;
                $cr_acc_id_dua = 4;
            } else
            if ($db_satu == 4) {
                $db_acc_id_satu = 28;
                $cr_acc_id_dua = 3;
            } else
            if ($db_satu == 5) {
                $db_acc_id_satu = 52;
                $cr_acc_id_dua = 7;
            } else
            if ($db_satu == 8) {
                $db_acc_id_satu = 27;
                $cr_acc_id_dua = 2;
            } else
            if ($db_satu == 10) {
                $db_acc_id_satu = 50;
                $cr_acc_id_dua = 6;
            } else
            if ($db_satu == 11) {
                $db_acc_id_satu = 33;
                $cr_acc_id_dua = 5;
            } else
            if ($db_satu == 25) {
                $db_acc_id_satu = 26;
                $cr_acc_id_dua = 1;
            };

            if ($cr_satu == 1) {
                $cr_acc_id_satu = 32;
                $db_acc_id_dua = 4;
            } else
            if ($cr_satu == 4) {
                $cr_acc_id_satu = 28;
                $db_acc_id_dua = 3;
            } else
            if ($cr_satu == 5) {
                $cr_acc_id_satu = 52;
                $db_acc_id_dua = 7;
            } else
            if ($cr_satu == 8) {
                $cr_acc_id_satu = 27;
                $db_acc_id_dua = 2;
            } else
            if ($cr_satu == 10) {
                $cr_acc_id_satu = 50;
                $db_acc_id_dua = 6;
            } else
            if ($cr_satu == 11) {
                $cr_acc_id_satu = 33;
                $db_acc_id_dua = 5;
            } else
            if ($cr_satu == 25) {
                $cr_acc_id_satu = 26;
                $db_acc_id_dua = 1;
            };

            if ($destination_template_id == $this->RecordReferer->getIdByModelNameAndRefName('JournalTemplate', 'journal_template_reklas_to_fa_id')) {

                /* -------------------------- 1 --------------------------------- */

                $journalLines[$start_index]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($db_acc_id_satu);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index]['date'] = date("Y-m-d");
                $journalLines[$start_index]['account_id'] = $db_acc_id_satu;
                $journalLines[$start_index]['account_name'] = $accountNames[$db_acc_id_satu];
                $journalLines[$start_index]['journal_position_id'] = 1;
                $journalLines[$start_index]['journal_position_name'] = 'Debit';
                $journalLines[$start_index]['amount_db'] = $reklass['Reklass']['amount'];
                $journalLines[$start_index]['amount_cr'] = 0;
                $journalLines[$start_index]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index]['reff']['id'] = $doc_id;

                /* -------------------------- 2 --------------------------------- */

                $journalLines[$start_index + 1]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($cr_acc_id_satu);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 1]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 1]['date'] = date("Y-m-d");
                $journalLines[$start_index + 1]['account_id'] = $cr_acc_id_satu;
                $journalLines[$start_index + 1]['account_name'] = $accountNames[$cr_acc_id_satu];
                $journalLines[$start_index + 1]['journal_position_id'] = 2;
                $journalLines[$start_index + 1]['journal_position_name'] = 'Credit';
                $journalLines[$start_index + 1]['amount_db'] = 0;
                $journalLines[$start_index + 1]['amount_cr'] = $reklass['Reklass']['amount'];
                $journalLines[$start_index + 1]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 1]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 1]['reff']['id'] = $doc_id;

                if ($reklass['Reklass']['depthnini'] > 0) {

                    /* -------------------------- 3 --------------------------------- */

                    $journalLines[$start_index + 2]['department_id'] = KPNODEPARTMENT_ID;
                    $accounts = $this->JournalTransaction->Account->findById($db_acc_id_dua);
                    $acc_prefix = $accounts['Account']['acc_prefix'];
                    //$journalLines[$start_index + 2]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                    if ($acc_prefix == "IDR") {
                        $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                    } else if ($acc_prefix == "PL") {
                        $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                    } else {
                        $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['t24_gl'];
                    }
                    $journalLines[$start_index + 2]['date'] = date("Y-m-d");
                    $journalLines[$start_index + 2]['account_id'] = $db_acc_id_dua;
                    $journalLines[$start_index + 2]['account_name'] = $accountNames[$db_acc_id_dua];
                    $journalLines[$start_index + 2]['journal_position_id'] = 1;
                    $journalLines[$start_index + 2]['journal_position_name'] = 'Debit';
                    $journalLines[$start_index + 2]['amount_db'] = $reklass['Reklass']['depthnini'];
                    $journalLines[$start_index + 2]['amount_cr'] = 0;
                    $journalLines[$start_index + 2]['journal_template_id'] = $destination_template_id;
                    $journalLines[$start_index + 2]['reff']['detail_source'] = $detail_source;
                    $journalLines[$start_index + 2]['reff']['id'] = $doc_id;

                    /* -------------------------- 4 --------------------------------- */

                    $journalLines[$start_index + 3]['department_id'] = KPNODEPARTMENT_ID;
                    $accounts = $this->JournalTransaction->Account->findById($cr_acc_id_dua);
                    $acc_prefix = $accounts['Account']['acc_prefix'];
                    //$journalLines[$start_index + 3]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                    if ($acc_prefix == "IDR") {
                        $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                    } else if ($acc_prefix == "PL") {
                        $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                    } else {
                        $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['t24_gl'];
                    }
                    $journalLines[$start_index + 3]['date'] = date("Y-m-d");
                    $journalLines[$start_index + 3]['account_id'] = $cr_acc_id_dua;
                    $journalLines[$start_index + 3]['account_name'] = $accountNames[$cr_acc_id_dua];
                    $journalLines[$start_index + 3]['journal_position_id'] = 2;
                    $journalLines[$start_index + 3]['journal_position_name'] = 'Credit';
                    $journalLines[$start_index + 3]['amount_db'] = 0;
                    $journalLines[$start_index + 3]['amount_cr'] = $reklass['Reklass']['depthnini'];
                    $journalLines[$start_index + 3]['journal_template_id'] = $destination_template_id;
                    $journalLines[$start_index + 3]['reff']['detail_source'] = $detail_source;
                    $journalLines[$start_index + 3]['reff']['id'] = $doc_id;
                }
            } else {

                /* -------------------------- 1 --------------------------------- */
                // AKUMULASI PENYUSUTAN FA
                $acc = $db_acc_id_dua;

                $journalLines[$start_index]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index]['date'] = date("Y-m-d");
                $journalLines[$start_index]['account_id'] = $acc;
                $journalLines[$start_index]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index]['journal_position_id'] = 1;
                $journalLines[$start_index]['journal_position_name'] = 'Debit';
                $journalLines[$start_index]['amount_db'] = $reklass['Reklass']['depthnini'];
                $journalLines[$start_index]['amount_cr'] = 0;
                $journalLines[$start_index]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index]['reff']['id'] = $doc_id;


                /* -------------------------- 2 --------------------------------- */
                // REKENING PERANTARA AKUNTING
                $acc = '53';

                $journalLines[$start_index + 1]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 1]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 1]['date'] = date("Y-m-d");
                $journalLines[$start_index + 1]['account_id'] = $acc;
                $journalLines[$start_index + 1]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index + 1]['journal_position_id'] = 2;
                $journalLines[$start_index + 1]['journal_position_name'] = 'Credit';
                $journalLines[$start_index + 1]['amount_db'] = 0;
                $journalLines[$start_index + 1]['amount_cr'] = $reklass['Reklass']['depthnini'];
                $journalLines[$start_index + 1]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 1]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 1]['reff']['id'] = $doc_id;


                /* -------------------------- 3 --------------------------------- */
                // REKENING PERANTARA AKUNTING
                $acc = '53';

                $journalLines[$start_index + 2]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 2]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 2]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 2]['date'] = date("Y-m-d");
                $journalLines[$start_index + 2]['account_id'] = $acc;
                $journalLines[$start_index + 2]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index + 2]['journal_position_id'] = 1;
                $journalLines[$start_index + 2]['journal_position_name'] = 'Debit';
                $journalLines[$start_index + 2]['amount_db'] = $reklass['Reklass']['amount'];
                $journalLines[$start_index + 2]['amount_cr'] = 0;
                $journalLines[$start_index + 2]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 2]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 2]['reff']['id'] = $doc_id;

                /* -------------------------- 4 --------------------------------- */
                // FA
                $acc = $cr_acc_id_satu;

                $journalLines[$start_index + 3]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 3]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 3]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 3]['date'] = date("Y-m-d");
                $journalLines[$start_index + 3]['account_id'] = $acc;
                $journalLines[$start_index + 3]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index + 3]['journal_position_id'] = 2;
                $journalLines[$start_index + 3]['journal_position_name'] = 'Credit';
                $journalLines[$start_index + 3]['amount_db'] = 0;
                $journalLines[$start_index + 3]['amount_cr'] = $reklass['Reklass']['amount'];
                $journalLines[$start_index + 3]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 3]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 3]['reff']['id'] = $doc_id;


                /* -------------------------- 5 --------------------------------- */
                // BIAYA INVENTARIS KANTOR
                $acc = office_expense_account_id;
                $third_row_amount = $reklass['Reklass']['amount'] - $reklass['Reklass']['depthnini'];

                $journalLines[$start_index + 4]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 4]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 4]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 4]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 4]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 4]['date'] = date("Y-m-d");
                $journalLines[$start_index + 4]['account_id'] = $acc;
                $journalLines[$start_index + 4]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index + 4]['journal_position_id'] = 1;
                $journalLines[$start_index + 4]['journal_position_name'] = 'Debit';
                $journalLines[$start_index + 4]['amount_db'] = $third_row_amount;
                $journalLines[$start_index + 4]['amount_cr'] = 0;
                $journalLines[$start_index + 4]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 4]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 4]['reff']['id'] = $doc_id;

                /* -------------------------- 6 --------------------------------- */
                // REKENING PERANTARA AKUNTING
                $acc = '53';

                $journalLines[$start_index + 5]['department_id'] = KPNODEPARTMENT_ID;
                $accounts = $this->JournalTransaction->Account->findById($acc);
                $acc_prefix = $accounts['Account']['acc_prefix'];
                //$journalLines[$start_index + 5]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
                if ($acc_prefix == "IDR") {
                    $journalLines[$start_index + 5]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5, 4);
                } else if ($acc_prefix == "PL") {
                    $journalLines[$start_index + 5]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
                } else {
                    $journalLines[$start_index + 5]['account_code'] = $accounts['Account']['t24_gl'];
                }
                $journalLines[$start_index + 5]['date'] = date("Y-m-d");
                $journalLines[$start_index + 5]['account_id'] = $acc;
                $journalLines[$start_index + 5]['account_name'] = $accountNames[$acc];
                $journalLines[$start_index + 5]['journal_position_id'] = 2;
                $journalLines[$start_index + 5]['journal_position_name'] = 'Credit';
                $journalLines[$start_index + 5]['amount_db'] = 0;
                $journalLines[$start_index + 5]['amount_cr'] = $third_row_amount;
                $journalLines[$start_index + 5]['journal_template_id'] = $destination_template_id;
                $journalLines[$start_index + 5]['reff']['detail_source'] = $detail_source;
                $journalLines[$start_index + 5]['reff']['id'] = $doc_id;
            }
        }
        if ($detail_source == 'invoice_payment' && $holding == 'hold') {
            $invoicePay = $InvoicePayment->read(null, $doc_id);
            $Invoice = new Invoice;
            $invoice = $Invoice->read(null, $invoicePay['Invoice']['id']);

            $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
            $t24_acc_code = $this->JournalTransaction->Department->find('list', array('fields' => array('Department.t24_account_code')));
            $start = (-1);
            $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', array('conditions' => array(
                    'journal_group_id' => $journal_group_id
            )));
            $departments = $this->JournalTransaction->Department->find('list');
            $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
            $action = 'posting_invoice_payment_holding';

            $start++;
            $start_index = $start * 2;
            $amount = $invoicePay['InvoicePayment']['amount_due'];

            $journalLines[$start_index]['department_id'] = KPNODEPARTMENT_ID;
            //$journalLines[$start_index]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $accounts = $this->JournalTransaction->Account->findById($journalTemplate['JournalTemplateDetail'][0]['account_id']);
            $acc_prefix = $accounts['Account']['acc_prefix'];
            //$journalLines[$start_index]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
            if ($acc_prefix == "IDR") {
                $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($t24_acc_code[KPNODEPARTMENT_ID], 5, 4);
            } else if ($acc_prefix == "PL") {
                $journalLines[$start_index]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
            } else {
                $journalLines[$start_index]['account_code'] = $accounts['Account']['t24_gl'];
            }
            $journalLines[$start_index]['date'] = date("Y-m-d");
            $journalLines[$start_index]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
            $journalLines[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
            $journalLines[$start_index]['journal_position_id'] = 1;
            $journalLines[$start_index]['journal_position_name'] = 'Debit';
            $journalLines[$start_index]['amount_db'] = $amount;
            $journalLines[$start_index]['amount_cr'] = 0;
            $journalLines[$start_index]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
            $journalLines[$start_index]['reff']['detail_source'] = $detail_source;
            $journalLines[$start_index]['reff']['id'] = $doc_id;


            $journalLines[$start_index + 1]['department_id'] = KPNODEPARTMENT_ID;
            //$journalLines[$start_index+1]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $accounts = $this->JournalTransaction->Account->findById($journalTemplate['JournalTemplateDetail'][1]['account_id']);
            $acc_prefix = $accounts['Account']['acc_prefix'];
            //$journalLines[$start_index + 1]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accounts['Account']['t24_gl'];
            if ($acc_prefix == "IDR") {
                $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'] . $accounts['Account']['seq_t24'] . substr($t24_acc_code[KPNODEPARTMENT_ID], 5, 4);
            } else if ($acc_prefix == "PL") {
                $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['acc_prefix'] . $accounts['Account']['t24_gl'];
            } else {
                $journalLines[$start_index + 1]['account_code'] = $accounts['Account']['t24_gl'];
            }
            $journalLines[$start_index + 1]['date'] = date("Y-m-d");
            $journalLines[$start_index + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
            $journalLines[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
            $journalLines[$start_index + 1]['journal_position_id'] = 2;
            $journalLines[$start_index + 1]['journal_position_name'] = 'Credit';
            $journalLines[$start_index + 1]['amount_db'] = 0;
            $journalLines[$start_index + 1]['amount_cr'] = $amount;
            $journalLines[$start_index + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
            $journalLines[$start_index + 1]['reff']['detail_source'] = $detail_source;
            $journalLines[$start_index + 1]['reff']['id'] = $doc_id;
        }

        if ($detail_source == 'asset') {
            return $journalLines;
        }

        $journalTemplates = $this->JournalTransaction->JournalTemplate->find('list');
        $this->set(compact(
                        'journalLines', 'journal_group_id', 'journal_template_id', 'journalTemplates', 'action', 'departments')
        );
    }

    function montly_journal() {

        $journal_group_amortize_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_amortize_id');
        $journalLinesTotal = $this->prepare_posting('asset', $journal_group_amortize_id);
        $Asset = new Asset;
        foreach ($journalLinesTotal as $journalLines) {
            $asset_id = $journalLines['reff']['id'];

            $this->JournalTransaction->create();
            $journal['JournalTransaction']['department_id'] = $journalLines['department_id'];
            $journal['JournalTransaction']['account_code'] = $journalLines['account_code'];
            $journal['JournalTransaction']['date'] = $journalLines['date'];
            $journal['JournalTransaction']['account_id'] = $journalLines['account_id'];
            $journal['JournalTransaction']['journal_position_id'] = $journalLines['journal_position_id'];
            $journal['JournalTransaction']['amount_db'] = $journalLines['amount_db'];
            $journal['JournalTransaction']['amount_cr'] = $journalLines['amount_cr'];
            $journal['JournalTransaction']['journal_template_id'] = $journalLines['journal_template_id'];
            $journal['JournalTransaction']['source'] = $journalLines['reff']['detail_source'];
            $journal['JournalTransaction']['doc_id'] = $journalLines['reff']['id'];
            $this->JournalTransaction->save($journal);

            //update asset posting status
            $Asset->read(null, $asset_id);
            $Asset->set(array('posting' => 1));
            $Asset->save();
        }

        /*

          $out = '';
          $journalLinesTotal = $this->prepare_posting('asset', journal_group_amortize_id);

          //echo "journalLinesTotal";
          //echo "<pre>";
          //var_dump($journalLinesTotal);
          //echo "<pre>";

          //print_r($journalLinesTotal);
          //exit();
          $Asset = new Asset;
          $ctr = 0;
          $pagesize = 450; // 900/2

          $arrayPagging = array();
          $ctr_pagging = 0;
          foreach($journalLinesTotal as $journalLines)
          {
          $asset_id = $journalLines['reff']['id'];

          $this->JournalTransaction->create();
          $journal['JournalTransaction']['department_id'] 		= $journalLines['department_id'];
          $journal['JournalTransaction']['account_code'] 			= $journalLines['account_code'];
          $journal['JournalTransaction']['date'] 					= $journalLines['date'];
          $journal['JournalTransaction']['account_id'] 			= $journalLines['account_id'];
          $journal['JournalTransaction']['journal_position_id'] 	= $journalLines['journal_position_id'];
          $journal['JournalTransaction']['amount_db'] 			= $journalLines['amount_db'];
          $journal['JournalTransaction']['amount_cr'] 			= $journalLines['amount_cr'];
          $journal['JournalTransaction']['journal_template_id'] 	= $journalLines['journal_template_id'];
          $journal['JournalTransaction']['source'] 				= $journalLines['reff']['detail_source'];
          $journal['JournalTransaction']['doc_id'] 				= $journalLines['reff']['id'];
          //$journal['JournalTransaction']['branch_id'] 			= $journalLines['branch_id'];
          //$journal['JournalTransaction']['pl_categ'] 			= $journalLines['pl_categ'];
          $this->JournalTransaction->save($journal);

          $journal['JournalTransaction']['trcode'] 				= $journalLines['trcode'];

          //update asset posting status
          $Asset->read(null, $asset_id);
          //echo '<pre>';
          //var_dump($Asset);
          //echo '</pre>';die();
          $Asset->set(array('posting'=>1));
          $Asset->save();

          //RIC 2014-01-11
          if($journalLines['journal_position_id']==1){
          //debit
          //RIC 2014-01-11
          $cost_center_data = '';
          $new_mapping_cost_centers = new CostCenterToDao;
          if($journalLines['pl_categ']!=''){
          $t24dao = $new_mapping_cost_centers->find('first',
          array('conditions'=>array(
          'cost_center_id'=>$journalLines['cost_center_id'],
          ))
          );
          $cost_center_data = $t24dao['CostCenterToDao']['t24_dao'];
          }
          $journalLines['account_code'] = '';
          $journalLines['account_officer'] = $cost_center_data;

          }else if($journalLines['journal_position_id']==2){
          //credit
          $journalLines['pl_categ'] = '';
          $journalLines['account_officer'] = '';
          }

          $array_JL = array(0=>$journalLines);

          $with_header = true;
          if($ctr!=0) $with_header = false;

          $out .= $this->generateCsv($array_JL, $with_header, false);
          $ctr++;

          if($ctr>=$pagesize){
          $arrayPagging[$ctr_pagging] = $out;
          $out = '';
          $ctr = 0;

          $ctr_pagging++;
          }
          }

          if($ctr_pagging==0){
          $arrayPagging[$ctr_pagging] = $out;
          $out = '';
          $ctr = 0;

          $ctr_pagging++;
          }

          //print_r($arrayPagging);
          //exit();
          $this->set(compact(
          'arrayPagging'
          ));

          $this->set('arrayPagging', $arrayPagging);

          $this->render('journal_pagging_xls');


          //if($out){
          //	if($this->writeCsv($out)){
          //		$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));
          //	}
          //}

         */
    }

    function posting_invoice() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $invoice_id = $this->Session->read('JournalTransaction.doc_id');
        $Invoice = new Invoice;

        if ($this->configs['journal_cut_off'] > date('H:i:s')) {
            foreach ($this->data as $d) {
                $acc_code = $d['JournalTransaction']['account_code'];
                $prefix = substr($acc_code, 0, 2);
                if ($prefix == 'PL') {
                    $acc = substr($acc_code, 2, 5);
                    $res = $this->JournalTransaction->query("select account_code from departments where id = '" . $d['JournalTransaction']['department_id'] . "' ");
                    $dep_acc_code = $res[0][0]['account_code'];
                    $res = $this->JournalTransaction->query("select b.name from invoices a left join currencies b on b.id = a.currency_id where a.id = '" . $invoice_id . "' ");
                    $name = $res[0][0]['name'];
                    if ($name == "Rp") {
                        $name = '360';
                    } else if ($name == "USD") {
                        $name = '840';
                    } else if ($name == "AUD") {
                        $name = '036';
                    } else if ($name == "EUR") {
                        $name = '333';
                    } else if ($name == "HKD") {
                        $name = '333';
                    } else if ($name == "NZD") {
                        $name = '333';
                    } else if ($name == "Yen") {
                        $name = '333';
                    }
                    $d['JournalTransaction']['account_code'] = $dep_acc_code . "." . $name . "." . $acc;
                } else if ($prefix == 'ID' || $prefix == 'US' || $prefix == 'AU' || $prefix == 'EU' || $prefix == 'HK' || $prefix == 'NZ' || $prefix == 'YE') {
                    $name = substr($acc_code, 0, 3);
                    if ($name == "IDR") {
                        $name = '360';
                    } else if ($name == "USD") {
                        $name = '840';
                    } else if ($name == "AUD") {
                        $name = '036';
                    } else if ($name == "EUR") {
                        $name = '333';
                    } else if ($name == "HKD") {
                        $name = '333';
                    } else if ($name == "NZD") {
                        $name = '333';
                    } else if ($name == "Yen") {
                        $name = '333';
                    }
                    $acc = substr($acc_code, 3, 5);
                    $res = $this->JournalTransaction->query("select account_code from departments where id = '" . $d['JournalTransaction']['department_id'] . "' ");
                    $dep_acc_code = $res[0][0]['account_code'];
                    $d['JournalTransaction']['account_code'] = $dep_acc_code . "." . $name . "." . $acc;
                }
                //echo '<pre>';
                //var_dump($d);
                //echo '</pre>';die();
                $d['JournalTransaction']['doc_id'] = $invoice_id;
                $d['JournalTransaction']['source'] = 'invoice';
                $this->JournalTransaction->create();
                $this->JournalTransaction->save($d);
            }
            // //update invoice status:
            /// penerimaan barang
            // if( $journal_group_id==journal_group_receival_id)
            // $status_invoice_id = status_invoice_posted_receival_journal_id;
            /// pembayaran full
            //else 
            //if ( $journal_group_id==journal_group_payment_id)
            $status_invoice_id = status_invoice_posted_payment_journal_id;

            $inv = $Invoice->read(null, $invoice_id);
            $Invoice->set(array('status_invoice_id' => $status_invoice_id));
            if ($Invoice->save()) {
                if ($inv['Invoice']['request_type_id'] == request_type_stock_id) {
                    foreach ($inv['InvoiceDetail'] as $detil) {
                        $sql = 'update inlog_details set price=' . $detil['price'] . ' , amount=' . $detil['amount'] . ' , can_ledger=0 where npb_id=' . $detil['npb_id'] . ' and item_id=' . $detil['item_id'] . ' and qty=' . $detil['qty'] . '';
                        $this->JournalTransaction->query($sql);
                    }
                }
                $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $invoice_id . '/invoice"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
                //$this->Session->setFlash(__('Invoice posted successfully'.$download, true), 'default', array('class'=>'ok'));
                $this->Session->setFlash(__('Invoice posted successfully', true), 'default', array('class' => 'ok'));
                //$this->prepare_csv($invoice_id, 'invoice');
                $this->redirect(array('controller' => 'invoices', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('Invoice posted failed', true));
                $this->redirect(array('controller' => 'invoices', 'action' => 'view', $invoice_id));
            }
        } else {
            $this->Session->setFlash(__('Invoice can not be processed because it exceeded the time of ' . $this->configs['journal_cut_off'], true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    function posting_invoice_payment() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $invoice_payment_id = $this->Session->read('JournalTransaction.doc_id');
        $InvoicePayment = new InvoicePayment;

        foreach ($this->data as $d) {
            $acc_code = $d['JournalTransaction']['account_code'];
            $prefix = substr($acc_code, 0, 2);
            if ($prefix == 'PL') {
                $acc = substr($acc_code, 2, 5);
                $res = $this->JournalTransaction->query("select account_code from departments where id = '" . $d['JournalTransaction']['department_id'] . "' ");
                $dep_acc_code = $res[0][0]['account_code'];
                $res = $this->JournalTransaction->query("select b.name from invoices a left join currencies b on b.id = a.currency_id left join invoice_payments c on c.invoice_id = a.id where c.id = '" . $invoice_payment_id . "' ");
                $name = $res[0][0]['name'];
                if ($name == "Rp") {
                    $name = '360';
                } else if ($name == "USD") {
                    $name = '840';
                } else if ($name == "AUD") {
                    $name = '036';
                } else if ($name == "EUR") {
                    $name = '333';
                } else if ($name == "HKD") {
                    $name = '344';
                } else if ($name == "NZD") {
                    $name = '554';
                } else if ($name == "Yen") {
                    $name = '392';
                }
                $d['JournalTransaction']['account_code'] = $dep_acc_code . "." . $name . "." . $acc;
            } else if ($prefix == 'ID' || $prefix == 'US' || $prefix == 'AU' || $prefix == 'EU' || $prefix == 'HK' || $prefix == 'NZ' || $prefix == 'YE') {
                $name = substr($acc_code, 0, 3);
                if ($name == "IDR") {
                    $name = '360';
                } else if ($name == "USD") {
                    $name = '840';
                } else if ($name == "AUD") {
                    $name = '036';
                } else if ($name == "EUR") {
                    $name = '333';
                } else if ($name == "HKD") {
                    $name = '344';
                } else if ($name == "NZD") {
                    $name = '554';
                } else if ($name == "Yen") {
                    $name = '392';
                }
                $acc = substr($acc_code, 3, 5);
                $res = $this->JournalTransaction->query("select account_code from departments where id = '" . $d['JournalTransaction']['department_id'] . "' ");
                $dep_acc_code = $res[0][0]['account_code'];
                $d['JournalTransaction']['account_code'] = $dep_acc_code . "." . $name . "." . $acc;
            }
            $d['JournalTransaction']['doc_id'] = $invoice_payment_id;
            $d['JournalTransaction']['source'] = 'invoice_payment';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update invoice_payment status:
        // pembayaran termin

        $inv = $InvoicePayment->read(null, $invoice_payment_id);
        $invoice_id = $inv['InvoicePayment']['invoice_id'];
        $InvoicePayment->set(array('is_posted' => 1));
        $InvoicePayment->set(array('posted_date' => date('Y-m-d H:i:s')));
        if ($InvoicePayment->save()) {
            if ($inv['InvoicePayment']['amount_due'] - $inv['InvoicePayment']['amount_paid'] > 0) {
                //masih ada sisa lagi
                $sql = 'update invoices set status_invoice_id="' . status_invoice_posted_term_payment_journal_id . '" where id="' . $invoice_id . '"';
                $this->JournalTransaction->query($sql);
            } else {
                //lunas tak ada sisa
                $sql = 'update invoices set status_invoice_id="' . status_invoice_posted_payment_journal_id . '" where id="' . $invoice_id . '"';
                $this->JournalTransaction->query($sql);
            }
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $invoice_payment_id . '/invoice_payment"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('InvoicePayment posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('InvoicePayment posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $invoice_id));
        } else {
            $this->Session->setFlash(__('InvoicePayment posted failed', true));
            $this->redirect(array('controller' => 'invoice_payments', 'action' => 'view', $invoice_payment_id));
        }
    }

    function posting_po() { //down payment 
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $po_id = $this->Session->read('JournalTransaction.doc_id');
        $Po = new Po;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $po_id;
            $d['JournalTransaction']['source'] = 'po';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update po status:			
        $po = $Po->read(null, $po_id);
        $Po->set(array('is_down_payment_journal_generated' => 1));
        $Po->set(array('down_payment_journal_generated_date' => date('Y-m-d H:i:s')));
        if ($Po->save()) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $po_id . '/po"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('PO down payment journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('PO down payment journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'pos', 'action' => 'view', $po_id));
        } else {
            $this->Session->setFlash(__('PO down payment journal posted failed', true));
            $this->redirect(array('controller' => 'pos', 'action' => 'view', $po_id));
        }
    }

    function posting_delivery_order() { //down payment 
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $delivery_order_id = $this->Session->read('JournalTransaction.doc_id');
        $DeliveryOrder = new DeliveryOrder;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $delivery_order_id;
            $d['JournalTransaction']['source'] = 'delivery_order';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update delivery_order status:			
        $delivery_order = $DeliveryOrder->read(null, $delivery_order_id);
        $po_id = $delivery_order['DeliveryOrder']['po_id'];
        $DeliveryOrder->set(array('is_journal_generated' => 1));
        $DeliveryOrder->set(array('journal_generated_date' => date('Y-m-d H:i:s')));
        if ($DeliveryOrder->save()) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $delivery_order_id . '/delivery_order"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Delivery Order receive journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Delivery Order receive journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'delivery_orders', 'action' => 'index', $po_id));
        } else {
            $this->Session->setFlash(__('Delivery Order receive journal posting failed', true));
            $this->redirect(array('controller' => 'delivery_orders', 'action' => 'index', $po_id));
        }
    }

    function posting_supplier_retur() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $supplier_retur_id = $this->Session->read('JournalTransaction.doc_id');
        $SupplierRetur = new SupplierRetur;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $supplier_retur_id;
            $d['JournalTransaction']['source'] = 'supplier_retur';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update supplier_retur status:			
        //$supplier_retur=$SupplierRetur->read(null, $supplier_retur_id);
        $SupplierRetur->id = $supplier_retur_id;
        $SupplierRetur->set('supplier_retur_status_id', status_supplier_retur_finish_id);
        if ($SupplierRetur->save()) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $supplier_retur_id . '/supplier_retur"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Supplier Retur journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Supplier Retur journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'supplier_returs', 'action' => 'view', $supplier_retur_id));
        } else {
            $this->Session->setFlash(__('Supplier Retur journal posted failed', true));
            $this->redirect(array('controller' => 'supplier_returs', 'action' => 'view', $supplier_retur_id));
        }
    }

    function posting_invoice_payment_holding() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $invoice_payment_id = $this->Session->read('JournalTransaction.doc_id');
        $InvoicePayment = new InvoicePayment;
        $invoice = new Invoice;

        if ($this->configs['journal_cut_off'] > date('H:i:s')) {

            foreach ($this->data as $d) {
                $d['JournalTransaction']['doc_id'] = $invoice_payment_id;
                $d['JournalTransaction']['source'] = 'invoice_payments';
                $this->JournalTransaction->create();
                $this->JournalTransaction->save($d);
            }

            // //update supplier_retur status:			
            //$supplier_retur=$SupplierRetur->read(null, $supplier_retur_id);
            $invoice_pays = $InvoicePayment->read(null, $invoice_payment_id);
            $InvoicePayment->id = $invoice_payment_id;
            $InvoicePayment->set('invoice_payment_status_id', status_invoice_payment_finish_id);
            $InvoicePayment->set('amount_paid', $invoice_pays['InvoicePayment']['amount_due']);
            $InvoicePayment->set('date_paid', date('Y-m-d H:i:s'));

            if ($InvoicePayment->save()) {
                $invoice_pay = $InvoicePayment->read(null, $invoice_payment_id);
                $invoice_id = $invoice_pay['InvoicePayment']['invoice_id'];
                $invoice->Po->PoPayment->id = $invoice_pay['InvoicePayment']['po_payment_id'];
                $invoice->Po->PoPayment->set('amount_paid', str_replace(',', '', $invoice_pay['InvoicePayment']['amount_paid']));
                $invoice->Po->PoPayment->set('date_paid', $invoice_pay['InvoicePayment']['date_paid']);
                $invoice->Po->PoPayment->save();

                //update status invoice paid jika sudah lunas else unpaid
                $invoice->processSettlement($invoice_id);

                $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $invoice_payment_id . '/invoice_payments"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
                //$this->Session->setFlash(__('Invoice Payment journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
                $this->Session->setFlash(__('Invoice Payment journal posted successfully', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Invoice Payment journal posted failed', true));
                $this->redirect(array('controller' => 'invoice_payments', 'action' => 'view_payment', $invoice_payment_id));
            }
        } else {
            $this->Session->setFlash(__('Invoice Payment can not be processed because it exceeded the time of ' . $this->configs['journal_cut_off'], true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    function posting_usage() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $usage_id = $this->Session->read('JournalTransaction.doc_id');
        $Usage = new Usage;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $usage_id;
            $d['JournalTransaction']['source'] = 'usage';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update usage status:			
        $usage = $Usage->read(null, $usage_id);
        $Usage->set(array('usage_status_id' => status_usage_finish_id));
        if ($Usage->save()) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $usage_id . '/usage"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Usage journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Usage journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'usages', 'action' => 'view', $usage_id));
        } else {
            $this->Session->setFlash(__('Usage journal posted failed', true));
            $this->redirect(array('controller' => 'usages', 'action' => 'view', $usage_id));
        }
    }

    function posting_reklass() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $reklas_id = $this->Session->read('JournalTransaction.doc_id');
        $Reklass = new Reklass;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $reklas_id;
            $d['JournalTransaction']['source'] = 'reklass';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        //update usage status:			
        $reklass = $Reklass->read(null, $reklas_id);
        $Reklass->set(array('reklas_status_id' => status_reklass_finish_id));
        if ($Reklass->save()) {
            $Reklass->change_code($reklas_id);
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $reklas_id . '/reklass"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Usage journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Usage journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'reklasses', 'action' => 'view', $reklas_id));
        } else {
            $this->Session->setFlash(__('Usage journal posted failed', true));
            $this->redirect(array('controller' => 'reklasses', 'action' => 'view', $reklas_id));
        }
    }

    function posting_retur() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $retur_id = $this->Session->read('JournalTransaction.doc_id');
        $Retur = new Retur;

        foreach ($this->data as $d) {
            $d['JournalTransaction']['doc_id'] = $retur_id;
            $d['JournalTransaction']['source'] = 'retur';
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);
        }

        // //update retur status:			
        $retur = $Retur->read(null, $retur_id);
        $Retur->set(array('retur_status_id' => status_retur_finish_id));
        if ($Retur->save()) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $retur_id . '/retur"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Retur journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Retur journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'returs', 'action' => 'view', $retur_id));
        } else {
            $this->Session->setFlash(__('Retur journal posted failed', true));
            $this->redirect(array('controller' => 'returs', 'action' => 'view', $retur_id));
        }
    }

    function posting_outlog() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $outlog_id = $this->Session->read('JournalTransaction.doc_id');

        $postingSuccess = $this->do_posting_outlog($outlog_id, $this->data);

        $Outlog = new Outlog;
        $Outlog->read(null, $outlog_id);
        $Outlog->set(array('outlog_status_id' => status_outlog_finish_id));
        $outlogStatusSetToFinish = $Outlog->save();

        if ($postingSuccess && $outlogStatusSetToFinish) {
            $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $outlog_id . '/outlog"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
            //$this->Session->setFlash(__('Outlog journal posted successfully'.$download, true), 'default', array('class'=>'ok'));
            $this->Session->setFlash(__('Outlog journal posted successfully', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'outlogs', 'action' => 'view', $outlog_id));
        } else {
            $this->Session->setFlash(__('Outlog journal posted failed', true));
            $this->redirect(array('controller' => 'outlogs', 'action' => 'view', $outlog_id));
        }
    }

    function do_posting_outlog($outlog_id, $data) {
        $isSuccess = true;

        foreach ($data as $d) {
            $d['JournalTransaction']['doc_id'] = $outlog_id;
            $d['JournalTransaction']['source'] = 'outlog';
            $this->JournalTransaction->create();

            if (!$this->JournalTransaction->save($d)) {
                $isSuccess = false;
            }
        }

        return $isSuccess;
    }

    function do_prepare_posting_outlog($journal_group_id, $doc_id) {
        $detail_source = 'outlog';
        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
        $journalLines = array();
        $journalTransactions = array();

        $Outlog = new Outlog;
        $details = $Outlog->OutlogDetail->find('all', array('conditions' => array('OutlogDetail.outlog_id' => $doc_id)));
        $model = 'OutlogDetail';
        $department_id = $details[0]['Outlog']['department_id'];

        $Outlog->query("update outlogs set outlog_status_id = '" . status_outlog_finish_id . "' where id = '" . $doc_id . "' ");

        //isi dulu asset_category_id  
        foreach ($details as $i => $d) {
            $details[$i][$model]['asset_category_id'] = $d['Item']['asset_category_id'];
            $details[$i][$model]['department_id'] = $department_id; /// nanti ganti dibawah menjadi kantor pusat, jika account = persediaan
        }

        $amount_field = 'amount';
        $doc_id_field = 'outlog_id';
        
        if (!empty($details)) {

            foreach ($details as $i => $detail) {
                $amount_cr = $amount_db = 0;
                $assetCategoryId = $detail[$model]['asset_category_id'];

                $journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $assetCategoryId))
                );

                if (!empty($journalTemplate)) {
                    foreach ($journalTemplate['JournalTemplateDetail'] as $j => $jtd) {
                        //$index = $detailSize*$i + $j;
                        $index = count($journalLines);

                        $account_id = $jtd['account_id'];
                        $account = $this->JournalTransaction->Account->read(null, $account_id);
                        $account_type_id = $account['Account']['account_type_id'];

                        //if type account == account_type_inventory_id, maka department id= HQ
                        if ($account_type_id == account_type_inventory_id) {
                            $department_id = HQ_DEPARTMENT_ID;
                        } else {
                            $department_id = $detail[$model]['department_id'];
                        }

                        $amount_db = $jtd['journal_position_id'] == 1 ? $detail[$model][$amount_field] : "";
                        $amount_cr = $jtd['journal_position_id'] == 2 ? $detail[$model][$amount_field] : "";
                        $journalLines[$index]['department_id'] = $department_id;
                        //$journalLines[$index]['account_code']	= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
                        $acc_prefix = $account['Account']['acc_prefix'];
                        if ($acc_prefix == "IDR") {
                            $journalLines[$index]['account_code'] = $account['Account']['acc_prefix'] . $account['Account']['t24_gl'] . $account['Account']['seq_t24'] . substr($departmentAccountCodes[$department_id], 5, 4);
                        } else if ($acc_prefix == "PL") {
                            $journalLines[$index]['account_code'] = $account['Account']['acc_prefix'] . $account['Account']['t24_gl'];
                        } else {
                            $journalLines[$index]['account_code'] = $account['Account']['t24_gl'];
                        }

                        $journalLines[$index]['date'] = date("Y-m-d");
                        $journalLines[$index]['account_id'] = $jtd['account_id'];
                        $journalLines[$index]['account_name'] = $accountNames[$jtd['account_id']];
                        $journalLines[$index]['journal_position_id'] = $jtd['journal_position_id'];
                        $journalLines[$index]['journal_position_name'] = $journalPositions[$jtd['journal_position_id']];

                        $journalLines[$index]['amount_db'] = abs($amount_db);
                        $journalLines[$index]['amount_cr'] = abs($amount_cr);
                        $journalLines[$index]['journal_template_id'] = $jtd['journal_template_id'];
                        $journalLines[$index]['reff'] = array('detail_source' => $detail_source, 'id' => $detail[$model][$doc_id_field]);
                    }
                }
            }
        }
        
        foreach ($journalLines as $journalLineIndex => $journalLine) {
            $journalTransactions[$journalLineIndex]['JournalTransaction']['department_id'] = $journalLines[$journalLineIndex]['department_id'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['account_code'] = $journalLines[$journalLineIndex]['account_code'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['date'] = $journalLines[$journalLineIndex]['date'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['account_id'] = $journalLines[$journalLineIndex]['account_id'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['account_name'] = $journalLines[$journalLineIndex]['account_name'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['journal_position_id'] = $journalLines[$journalLineIndex]['journal_position_id'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['journal_position_name'] = $journalLines[$journalLineIndex]['journal_position_name'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['amount_db'] = $journalLines[$journalLineIndex]['amount_db'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['amount_cr'] = $journalLines[$journalLineIndex]['amount_cr'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['journal_template_id'] = $journalLines[$journalLineIndex]['journal_template_id'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['source'] = $journalLines[$journalLineIndex]['reff']['detail_source'];
            $journalTransactions[$journalLineIndex]['JournalTransaction']['doc_id'] = $journalLines[$journalLineIndex]['reff']['id'];
        }
        
        return $journalTransactions;
    }

    function posting_asset() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $Asset = new Asset;

        foreach ($this->data as $d) {
            $asset_id = $d['JournalTransaction']['doc_id'];
            $this->JournalTransaction->create();
            $this->JournalTransaction->save($d);


            //update asset posting status
            $Asset->read(null, $asset_id);
            $Asset->set(array('posting' => 1));
            $Asset->save();
        }

        $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $asset_id . '/asset"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
        $this->Session->setFlash(__('Asset Amortization posted successfully', true), 'default', array('class' => 'ok'));
        $this->redirect(array('controller' => 'assets', 'action' => 'index'));
    }

    function posting_movement() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $Movement = new Movement;
        $movement_id = $this->Session->read('JournalTransaction.doc_id');

        if ($this->configs['journal_cut_off'] > date('H:i:s')) {

            foreach ($this->data as $d) {
                $asset_id = $d['JournalTransaction']['doc_id'];
                $this->JournalTransaction->create();
                $this->JournalTransaction->save($d);
            }

            $Movement->read(null, $movement_id);
            $Movement->set(array('movement_status_id' => status_movement_finish_id));
            if ($Movement->save()) {
                $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $movement_id . '/movement"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
                $this->Session->setFlash(__('Movement posted successfully', true), 'default', array('class' => 'ok'));
                $this->redirect(array('controller' => 'movements', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('Movement posted failed', true));
                $this->redirect(array('controller' => 'movements', 'action' => 'view', $movement_id));
            }
        } else {
            $this->Session->setFlash(__('Movement can not be processed because it exceeded the time of ' . $this->configs['journal_cut_off'], true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }

        //update department_id in assets and asset_details		
    }

    function posting_disposal() {
        $journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $Disposal = new Disposal;
        $Asset = new Asset;
        if ($this->configs['journal_cut_off'] > date('H:i:s')) {

            foreach ($this->data as $d) {
                $disposal_id = $d['JournalTransaction']['doc_id'];
                $this->JournalTransaction->create();
                $this->JournalTransaction->save($d);
            }

            //update asset posting status
            $disDetails = $Disposal->read(null, $disposal_id);
            $Disposal->set(array('disposal_status_id' => status_disposal_finish_id));

            foreach ($disDetails['DisposalDetail'] as $disDetail) {
                $assetDetail = array();
                $asset = array();

                $asset_detail_id = $disDetail['asset_detail_id'];
                $assetDetail = $Disposal->DisposalDetail->AssetDetail->read(null, $asset_detail_id);
                if (empty($assetDetail)) {
                    debug('cannot find assetDetail with id ' . $asset_detail_id);
                    die;
                }
                /*                 * *******************
                  delete asset detail
                 * ******************* */
                $this->JournalTransaction->query('delete from asset_details where id=' . $asset_detail_id);

                /*                 * **************************
                  OR updating asset_details ada=T
                 * *************************** */
                //$ADA = 'T';
                //$sql='update asset_details set ada="'.$ADA.'" where id='. $disDetail['asset_detail_id'] ;
                //$this->JournalTransaction->query($sql);	

                $asset['Asset'] = $assetDetail['Asset'];
                $asset_id = $asset['Asset']['id'];
                /*                 * ****************
                  updating assets qty
                 * **************** */
                $sql = 'update assets set qty=qty-1 where id="' . $asset_id . '"';
                $this->log('updating old asset qty: ' . $sql);
                $this->JournalTransaction->query($sql);
                /*                 * ********************
                  delete asset if qty = 0
                 * ******************** */
                $sql = 'delete from assets where qty=0 and id="' . $asset_id . '"';
                $this->log('deleting old asset if qty=0: ' . $sql);
                $this->JournalTransaction->query($sql);
            }

            //aslinya tanpa update asset_details
            //update asset posting status
            //$Disposal->read(null, $disposal_id);
            //$Disposal->set(array('disposal_status_id'=>status_disposal_finish_id));
            if ($Disposal->save()) {
                $download = '<script>var url ="' . $this->base . '/journal_transactions/prepare_csv/' . $disposal_id . '/disposal"; var win=window.open(url, "DownLoadCSV","width=100,height=100");  </script>';
                $this->Session->setFlash(__('Disposal posted successfully', true), 'default', array('class' => 'ok'));
                $this->redirect(array('controller' => 'disposals', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('Disposal posted failed', true));
                $this->redirect(array('controller' => 'disposals', 'action' => 'view', $disposal_id));
            }
        } else {
            $this->Session->setFlash(__('Disposal can not be processed because it exceeded the time of ' . $this->configs['journal_cut_off'], true));
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    function index() {
        $layout = 'Screen';
        if (!empty($this->data)) {
            $this->Session->write('JournalTransaction.journal_group_id', $this->data['JournalTransaction']['journal_group_id']);
            $this->Session->write('JournalTransaction.journal_template_id', $this->data['JournalTransaction']['journal_template_id']);
            //$this->Session->write('JournalTransaction.journal_groups_id', $this->data['JournalTransaction']['journal_groups_id']);
            $layout = $this->data['JournalTransaction']['layout'];
        }
        $group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $this->JournalTransaction->recursive = 0;
        $departments = $this->JournalTransaction->Department->find('list');
        $journalGroup = $this->JournalTransaction->JournalTemplate->JournalGroup->find('list');
        $journalTemplates = $this->JournalTransaction->JournalTemplate->find('list', array('conditions' => array('journal_group_id' => $group_id)));
        $postings = array(1 => 'Yes', 0 => 'No');
        $con = array();
        if (isset($this->data['JournalTransaction']['department_id']))
            $this->Session->write('JournalTransaction.department_id', $this->data['JournalTransaction']['department_id']);

        if (isset($this->data['JournalTransaction']['journal_template_id']))
            $this->Session->write('JournalTransaction.journal_template_id', $this->data['JournalTransaction']['journal_template_id']);

        if (isset($this->data['JournalTransaction']['posting_id']))
            $this->Session->write('JournalTransaction.posting_id', $this->data['JournalTransaction']['posting_id']);

        list($date_start, $date_end) = $this->set_date_filters('JournalTransaction');
        $con[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
            'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));


        if (isset($this->data['JournalTransaction']['journal_groups_id']))
            $this->Session->write('JournalTransaction.journal_groups_id', $this->data['JournalTransaction']['journal_groups_id']);

        //DIT KOMEN DARI SINI - FILTERS
        //$journal_groups_id = null;
        /* if(($journal_groups_id=$this->data['JournalTransaction']['journal_groups_id']) ) {
          $journal_transactions_list_category = $this->JournalTransaction->journal_transactions_list_category($journal_groups_id);
          if($journal_groups_id!=''){
          $str = 'JournalTransaction.id';
          $array = array(-99);
          for($i=0;$i<count($journal_transactions_list_category);$i++){
          array_push($array, $journal_transactions_list_category[$i][0]['id']);
          }
          $con[] = array('JournalTransaction.id'=> $array);

          }
          } */
        //DIT KOMEN SAMPE SINI - FILTERS


        if ($department_id = $this->Session->read('JournalTransaction.department_id'))
            $con[] = array('department_id' => $department_id);
        if ($journal_template_id = $this->Session->read('JournalTransaction.journal_template_id'))
            $con[] = array('journal_template_id' => $journal_template_id);
        if ($posting_id = $this->Session->read('JournalTransaction.posting_id'))
            $con[] = array('posting' => $posting_id);
        if ($group_id)
            $con[] = array('JournalTemplate.journal_group_id' => $group_id);
        $copyright_id = $this->configs['copyright_id'];

        //echo '<pre>';
        //var_dump($con);
        //echo '</pre>';die();

        $z = $this->JournalTransaction->find('all', array('conditions' => $con, 'order' => 'JournalTransaction.id'));
        $totalGeneral = $this->JournalTransaction->totalGeneral($z);
        if ($layout == 'Screen') {
            $this->paginate = array('order' => 'JournalTransaction.id', 'limit' => 10);
            $z = $this->paginate($con);
        }

        //echo '<pre>';
        //var_dump($z);
        //echo '</pre>';die();

        $journal_group = new JournalGroup;

        $journal_groups = $journal_group->get_active_journal_group();

        $con_json = json_encode($con);
        $this->set('journalTransactions', $z);
        $this->set(compact(
                        'departments', 'department_id', 'journalTemplates', 'journal_template_id', 'postings', 'posting_id', 'date_start', 'date_end', 'copyright_id', 'journalGroup', 'totalGeneral', 'con_json'
                        /* 'journal_groups', 'journal_groups_id' */
        ));

        ///cari invoices terkait $z
        $doc_id = array();
        foreach ($z as $trx) {
            $doc_id[] = $trx['JournalTransaction']['doc_id'];
        }

        $Invoice = new Invoice;
        $invoices = $Invoice->find('list', array(/* 'conditions'=>array( 'id' => $doc_id) , */ 'fields' => 'no'));
        $this->set('invoices', $invoices);

        if ($layout == 'pdf') {
            Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->render('index_pdf');
        } else if ($layout == 'xls') {
            //echo "<pre>";
            //var_dump($z);
            //echo "</pre>";
            //die();
            $this->render('index_xls', 'export_xls');
        } else if ($layout == 'posting') {
            $this->copy_to_trans($con);
            $this->Session->setFlash(__('Posting Finish', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid journal transaction', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('journalTransaction', $this->JournalTransaction->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->JournalTransaction->create();
            if ($this->JournalTransaction->save($this->data)) {
                $this->Session->setFlash(__('The journal transaction has been saved', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The journal transaction could not be saved. Please, try again.', true));
            }
        }
        $journalTemplateDetails = $this->JournalTransaction->JournalTemplateDetail->find('list');
        $accounts = $this->JournalTransaction->Account->find('list');
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');
        $departments = $this->JournalTransaction->Department->find('list');
        $invoices = $this->JournalTransaction->Invoice->find('list');
        $this->set(compact('journalTemplateDetails', 'accounts', 'journalPositions', 'departments', 'invoices'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid journal transaction', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->JournalTransaction->save($this->data)) {
                $this->Session->setFlash(__('The journal transaction has been saved', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The journal transaction could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->JournalTransaction->read(null, $id);
        }
        $journalTemplateDetails = $this->JournalTransaction->JournalTemplateDetail->find('list');
        $accounts = $this->JournalTransaction->Account->find('list');
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');
        $departments = $this->JournalTransaction->Department->find('list');
        $invoices = $this->JournalTransaction->Invoice->find('list');
        $this->set(compact('journalTemplateDetails', 'accounts', 'journalPositions', 'departments', 'invoices'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for journal transaction', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->JournalTransaction->delete($id)) {
            $this->Session->setFlash(__('Journal transaction deleted', true), 'default', array('class' => 'ok'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Journal transaction was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    function copy_to_trans($con) {
        $this->JournalTransaction->recursive = 0;
        $params = array('conditions' => array('posting' => 0, $con));
        $journalTransactions = $this->JournalTransaction->find('all', $params);
        $departments = $this->JournalTransaction->Department->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');

        $data_source = "test1";
        $user = "user1";
        $password = "12345";
        if (!( $database = odbc_connect($data_source, $user, $password)))
            die("Could not connect to database");

        $account_db = '';
        $account_cr = '';
        $amount_db = 0;
        $amount_cr = 0;
        $dept_db = '';
        $sukses = false;
        foreach ($journalTransactions as $jt) {
            $id = $jt['JournalTransaction']['id'];
            $noref = '';
            if ($jt['JournalTransaction']['journal_position_id'] == 1) { //Db
                list($cab1, $cy1, $brg1) = explode('.', $jt['JournalTransaction']['account_code']);
                $amount_db = $jt['JournalTransaction']['amount_db'];
                $dept_db = $departmentAccountCodes[$jt['JournalTransaction']['department_id']];
                $id_db = $jt['JournalTransaction']['id'];
            } else if ($jt['JournalTransaction']['journal_position_id'] == 2) { //Cr
                list($cab2, $cy2, $brg2) = explode('.', $jt['JournalTransaction']['account_code']);
                $amount_cr = $jt['JournalTransaction']['amount_cr'];
                $dept_cr = $departmentAccountCodes[$jt['JournalTransaction']['department_id']];
                $date = date_create($jt['JournalTransaction']['date']);
                $dt = date_format($date, 'Ymd');

                $source_id = 'FIX';
                $source_dt = $dt; //blum bisa
                list($hh, $ii, $ss) = explode(':', date('H:i:s'));
                $source_tm = $hh . $ii . $ss; //number bisa beda keluarr nya
                $source_no = sprintf("%04d", rand(0, 9999)); //unik dari mulai 0001 ga boleh sama
                $kdcab = $departmentAccountCodes[$jt['JournalTransaction']['department_id']]; //alpha
                $kdtran = 510; //numberic wajib, no transaksi
                $noref = $source_id . $dt . $source_no; //alpaha numberic unik bisa di campir fix dan lain2
                $norek1 = $cab1 . $cy1 . substr($brg1, 0, 4); //number ga bisa co validasi nya harus di explode
                $norek2 = $cab2 . $cy2 . substr($brg2, 0, 4); //number
                $ccy1 = $cy1; //number mata uang menurut BI diambil dari account_code
                $ccy2 = $cy2;
                $nilai1 = $amount_db;  //harus koma tidak bisa titik
                $nilai2 = $amount_cr;
                $kurs = 1; // satu karena rupiah
                $costdept1 = $dept_db; //busines type-cost center
                $costdept2 = $dept_cr;
                $ket1 = $jt['JournalTransaction']['notes'];
                $ket2 = $jt['JournalTransaction']['source'];
                $ket3 = '';
                $costc1 = '';
                $costc2 = '';

                /* run insert */
                $stmt = odbc_prepare($database, "INSERT INTO trans (source_id, source_dt, source_no, source_tm, kdtran, noref, 
				kdcab1, kdcab2, ccy1, ccy2, norek1, norek2, ket1, ket2, ket3, kurs, costdept1, costdept2, nilai1, nilai2) 
				VALUES('$source_id', '$source_dt', '$source_no', '$source_tm', '$kdtran', '$noref', '$kdcab', '$kdcab', 
				'$ccy1', '$ccy2', '$norek1', '$norek2', '$ket1', '$ket2', '$ket3', $kurs, '$costdept1', '$costdept2', 
				$nilai1, $nilai2);");
                /* check for errors */
                if (!odbc_execute($stmt)) {
                    /* error */
                    echo " Error please re-check $noref <br/>";
                    $sukses = false;
                } else {
                    $sukses = true;
                }
            }
            if ($sukses) {
                //update current JournalTransaction record
                $this->JournalTransaction->id = $id;
                $this->JournalTransaction->saveField('posting', 1);
                $this->JournalTransaction->saveField('noref', $noref);
                $this->JournalTransaction->saveField('posting_date', date('Y-m-d H:i:s'));
                $this->JournalTransaction->id = $id_db;
                $this->JournalTransaction->saveField('posting', 1);
                $this->JournalTransaction->saveField('noref', $noref);
                $this->JournalTransaction->saveField('posting_date', date('Y-m-d H:i:s'));
            }
        }
    }

    function journal_interfase() {
        $this->JournalTransaction->recursive = 0;
        $params = array('conditions' => array('posting' => 0, 'source' => 'invoice'), 'order' => 'JournalTransaction.id');
        $journalTransactions = $this->JournalTransaction->find('all', $params);
        $departments = $this->JournalTransaction->Department->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');

        $account_db = '';
        $account_cr = '';
        $amount_db = 0;
        $amount_cr = 0;
        $dept_db = '';
        $sukses = false;
        foreach ($journalTransactions as $jt) {
            $id = $jt['JournalTransaction']['id'];
            $noref = '';

            if ($jt['JournalTransaction']['journal_position_id'] == 1) { //Db
                list($cab1, $cy1, $brg1) = explode('.', $jt['JournalTransaction']['account_code']);
                $amount_db = $jt['JournalTransaction']['amount_db'];
                $dept_db = $departmentAccountCodes[$jt['JournalTransaction']['department_id']];
                $id_db = $jt['JournalTransaction']['id'];
            } else if ($jt['JournalTransaction']['journal_position_id'] == 2) { //Cr
                list($cab2, $cy2, $brg2) = explode('.', $jt['JournalTransaction']['account_code']);
                $amount_cr = $jt['JournalTransaction']['amount_cr'];
                $dept_cr = $departmentAccountCodes[$jt['JournalTransaction']['department_id']];
                $date = date_create($jt['JournalTransaction']['date']);
                $dt = date_format($date, 'Ymd');

                $source_id = 'FIX';
                $source_dt = $dt; //blum bisa
                list($hh, $ii, $ss) = explode(':', date('H:i:s'));
                $source_tm = $hh . $ii . $ss; //number bisa beda keluarr nya
                $source_no = sprintf("%04d", rand(0, 9999)); //unik dari mulai 0001 ga boleh sama
                $kdcab1 = $dept_db; //alpha
                $kdcab2 = $dept_cr; //alpha
                $kdtran = 510; //numberic wajib, no transaksi
                $noref = $source_id . $dt . $source_no; //alpaha numberic unik bisa di campir fix dan lain2
                //$norek1		= $cab1.$cy1.substr($brg1, 0, 4); //number ga bisa co validasi nya harus di explode
                $norek1 = $brg1; //number ga bisa co validasi nya harus di explode
                //$norek2		= $cab2.$cy2.substr($brg2, 0, 4); //number
                $norek2 = $brg2; //number
                $ccy1 = $cy1; //number mata uang menurut BI diambil dari account_code
                $ccy2 = $cy2;
                $nilai1 = $amount_db;  //harus koma tidak bisa titik
                $nilai2 = $amount_cr;
                $kurs = 1; // satu karena rupiah
                $costdept1 = $dept_db; //busines type-cost center
                $costdept2 = $dept_cr;
                $ket1 = $jt['JournalTransaction']['notes'];
                $ket2 = $jt['JournalTransaction']['source'];
                $ket3 = '';
                $costc1 = '';
                $costc2 = '';

                /* run insert */
                $data['JournalInterfase']['source_id'] = $source_id;
                $data['JournalInterfase']['source_dt'] = $source_dt;
                $data['JournalInterfase']['source_no'] = $source_no;
                $data['JournalInterfase']['source_tm'] = $source_tm;
                $data['JournalInterfase']['kdtran'] = $kdtran;
                $data['JournalInterfase']['noref'] = $noref;
                $data['JournalInterfase']['kdcab1'] = $kdcab1;
                $data['JournalInterfase']['kdcab2'] = $kdcab2;
                $data['JournalInterfase']['ccy1'] = $ccy1;
                $data['JournalInterfase']['ccy2'] = $ccy2;
                $data['JournalInterfase']['norek1'] = $norek1;
                $data['JournalInterfase']['norek2'] = $norek2;
                $data['JournalInterfase']['ket1'] = $ket2;
                $data['JournalInterfase']['ket2'] = $ket1 ? $ket1 : '';
                $data['JournalInterfase']['ket3'] = $ket3;
                $data['JournalInterfase']['kurs'] = $kurs;
                $data['JournalInterfase']['costdept1'] = $costdept1;
                $data['JournalInterfase']['costdept2'] = $costdept2;
                $data['JournalInterfase']['nilai1'] = $nilai1;
                $data['JournalInterfase']['nilai2'] = $nilai2;

                $JournalInterfase = new JournalInterfase;
                $JournalInterfase->create();
                $JournalInterfase->save($data);

                $this->JournalTransaction->id = $id;
                $this->JournalTransaction->saveField('posting', 1);
                $this->JournalTransaction->saveField('noref', $noref);
                $this->JournalTransaction->saveField('posting_date', date('Y-m-d H:i:s'));
                $this->JournalTransaction->id = $id_db;
                $this->JournalTransaction->saveField('posting', 1);
                $this->JournalTransaction->saveField('noref', $noref);
                $this->JournalTransaction->saveField('posting_date', date('Y-m-d H:i:s'));
            }
        }

        $this->redirect(array('controller' => 'famsys_interfaces', 'action' => 'add'));
    }

    function no_posting() {
        $config = $this->configs['warning_depreciation'];
        $this->set(compact('config'));
    }

    function prepare_csv($doc_id = null, $source = null) {
        $jtn = new JournalTransaction;
        $jt = new JournalTemplate;
        $account = new Account;
        $department = new Department;

        $journalTransaction = $jtn->find('all', array('conditions' => array('doc_id' => $doc_id, 'source' => $source)));

        $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
        $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));
        $accountNames = $account->find('list', array('fields' => array('Account.name')));

        $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
        if ($accountCodes == null)
            $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

        //$res = $jt->findById('129');
        //echo '<pre>';		
        //var_dump($res);
        //echo '</pre>';die();	


        $start_index = (-1);
        $j = (-1);
        $out = array();

        foreach ($journalTransaction as $jts) {
            $j++;
            $journalTemplate = $jt->findById($jts['JournalTransaction']['journal_template_id']);
            $accountPrefix = $account->findById($jts['JournalTransaction']['account_id']);
            $acc_prefix = $accountPrefix['Account']['acc_prefix'];

            $journal[$j]['account_code'] = "IDR" . $accountCodes[$jts['JournalTransaction']['account_id']] . $seq[$jts['JournalTransaction']['account_id']] . substr($departmentAccountCodes[$jts['JournalTransaction']['department_id']], 5);
            $journal[$j]['journal_position_id'] = $jts['JournalTransaction']['journal_position_id'];
            $journal[$j]['amount_lcy'] = $jts['JournalTransaction']['amount_db'] + $jts['JournalTransaction']['amount_cr'];
            if ($j % 2 == 0) {
                $n = 0;
            } else {
                $n = 1;
            }
            if ($journalTemplate['JournalTemplateDetail'][$n]['transaction_code_id']) {
                $journal[$j]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][$j]['transaction_code_id'];
            } else {
                $journal[$j]['transaction_code'] = '';
            }
            $journal[$j]['account_name'] = $accountNames[$jts['JournalTransaction']['account_id']];
            $journal[$j]['pl_category'] = $accountCodes[$jts['JournalTransaction']['account_id']];
            $journal[$j]['customer_id'] = '';
            $journal[$j]['account_officer'] = '';
            $journal[$j]['product_category'] = '';
            $journal[$j]['value_date'] = date('Y') . date('m') . date('d');
            $journal[$j]['currency'] = "IDR";
            $journal[$j]['amount_fcy'] = '';
            $journal[$j]['exchange_rate'] = '';
            $journal[$j]['position_type'] = '';
            $journal[$j]['reversal_marker'] = '';
            $journal[$j]['accounting_date'] = '';
            $journal[$j]['branch_code'] = $departmentAccountCodes[$jts['JournalTransaction']['department_id']];

            $journal[$j]['account_code'] = "IDR" . $accountCodes[$jts['JournalTransaction']['account_id']] . $seq[$jts['JournalTransaction']['account_id']] . substr($departmentAccountCodes[$jts['JournalTransaction']['department_id']], 5);
            $journal[$j]['journal_position_id'] = $jts['JournalTransaction']['journal_position_id'];
            $journal[$j]['amount_lcy'] = $jts['JournalTransaction']['amount_db'] + $jts['JournalTransaction']['amount_cr'];
            if ($journalTemplate['JournalTemplateDetail'][$j]['transaction_code_id']) {
                $journal[$j]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][$j]['transaction_code_id'];
            } else {
                $journal[$j]['transaction_code'] = '';
            }
            $journal[$j]['account_name'] = $accountNames[$jts['JournalTransaction']['account_id']];
            $journal[$j]['pl_category'] = $accountCodes[$jts['JournalTransaction']['account_id']];
            $journal[$j]['customer_id'] = '';
            $journal[$j]['account_officer'] = '';
            $journal[$j]['product_category'] = '';
            $journal[$j]['value_date'] = date('Y') . date('m') . date('d');
            $journal[$j]['currency'] = "IDR";
            $journal[$j]['amount_fcy'] = '';
            $journal[$j]['exchange_rate'] = '';
            $journal[$j]['position_type'] = '';
            $journal[$j]['reversal_marker'] = '';
            $journal[$j]['accounting_date'] = '';
            $journal[$j]['branch_code'] = $departmentAccountCodes[$jts['JournalTransaction']['department_id']];
            $journal[$j]['account_id'] = $jts['JournalTransaction']['account_id'];

            $out += $journal;
        }
        $this->generateCsv($out);
    }

    function generateCsv($journalLines, $with_header = true, $with_html = true) {
        //echo '<pre>';
        //var_dump($journalLines);
        //echo '</pre>';die();
        $tc = new TransactionCode;
        $transactionCodes = $tc->find('list', array('fields' => array('code')));

        $account = new Account;

        $out = '';
        $header = '';

        $header .= "ACCOUNT NUMBER,";
        $header .= "SIGN,";
        $header .= "AMOUNT-LCY,";
        $header .= "TRANSACTION CODE,";
        $header .= "NARRATIVE,";
        $header .= "PL CATEGORY,";
        $header .= "CUSTOMER ID,";
        $header .= "ACCOUNT OFFICER,";
        $header .= "PRODUCT CATEGORY,";
        $header .= "VALUE DATE,";
        $header .= "CURRENCY,";
        $header .= "AMOUNT FCY,";
        $header .= "EXCHANGE RATE,";
        $header .= "POSITION TYPE,";
        $header .= "REVERSAL MARKER,";
        $header .= "ACCOUNTING DATE,";
        $header .= "BRANCH CODE\n";

        $n = 0;
        foreach ($journalLines as $j) {

            //$accountPrefix	= $account->findById($journalLines[$n]['account_id']);
            $account_id = $journalLines[$n]['account_id'];
            $res = $this->JournalTransaction->query('select acc_prefix from accounts where id = ' . $account_id);
            $acc_prefix = $res[0][0]['acc_prefix'];

            $pl = '';
            $trcode = '';
            $branchCode = '';
            $position = '';
            $amount = '';
            $account_officer = '';

            if (isset($j['pl_categ'])) {
                $pl = $j['pl_categ'];
            } else if (isset($j['pl_category'])) {
                $pl = $j['pl_category'];
            }

            if (isset($j['account_officer'])) {
                $account_officer = $j['account_officer'];
            }

            if (isset($j['trcode'])) {
                $trcode = $j['trcode'];
            } else {
                $trcode = $j['transaction_code'];
            }

            if (isset($j['new_code'])) {
                $branchCode = $j['new_code'];
            } else {
                $branchCode = $j['branch_code'];
            }

            if ($j['journal_position_id'] == 1 || $j['journal_position_id'] == 'D') {
                $position = "D";
            } else if ($j['journal_position_id'] == 2 || $j['journal_position_id'] == 'C') {
                $position = "C";
            }

            if (isset($j['amount_lcy'])) {
                $amount = $j['amount_lcy'];
            } else {
                $amount = ($j['amount_db'] + $j['amount_cr']);
            }

            $account_code = $j['account_code'];

            if ($acc_prefix == 'PL') {
                //if idr, stay, else empty
                $account_code = '';
            } else {
                //if pl, stay, else empty
                $pl = '';
            }

            $out .= $account_code . ","; //account number
            $out .= $position . ","; //sign
            $out .= $amount . ","; //amount-lcy
            if ($trcode) {
                $out .= $transactionCodes[$trcode] . ","; //trans code $myApp->showArrayValue($transactionCodes,$d['transaction_code']) . ",";
            } else {
                $out .= ","; //trans code $myApp->showArrayValue($transactionCodes,$d['transaction_code']) . ",";
            }
            $out .= $j['account_name'] . ","; //narrative
            $out .= $pl . ","; //pl cat
            $out .= ","; //customer id
            $out .= $account_officer . ","; //account officer
            $out .= ","; //product cat
            $out .= date('Y') . date('m') . date('d') . ","; //value date
            $out .= "IDR,"; //curr
            $out .= ","; //amount fcy
            $out .= ","; //exch rate
            $out .= ","; //position type
            $out .= ","; //reversal marker
            $out .= ","; //accounting date
            $out .= $branchCode . "\n"; //mungkin perlu cari dulu code Branch nya

            $n++;
        }

        if ($with_header == false) {
            $header = '';
        }

        if ($with_html == false) {
            return $header . $out;
        }

        $this->set(compact(
                        'header', 'out'
        ));

        $this->set('detail', $out);
        $this->set('header', $header);

        $this->render('journal_xls', 'export_xls');
    }

    function create_csv_pagging() {
        $csv_files = $_POST['csv_files'];
        $ctr = $_POST['ctr'] + 1;
        $total = $_POST['total'];

        $this->set(compact(
                        'csv_files', 'ctr', 'total'
        ));

        $this->set('csv_files', $csv_files);
        $this->set('ctr', $ctr);
        $this->set('total', $total);

        $this->render('journal_xls_pagging', 'export_xls');
    }

    function create_je_csv_pagging() {
        $csv_files = $_POST['csv_files'];
        $ctr = $_POST['ctr'] + 1;
        $total = $_POST['total'];

        $this->set(compact(
                        'csv_files', 'ctr', 'total'
        ));

        $this->set('csv_files', $csv_files);
        $this->set('ctr', $ctr);
        $this->set('total', $total);

        $this->render('journal_entry_xls_pagging', 'export_xls');
    }

    function journal_interfase_ft() {
        $this->JournalTransaction->recursive = 0;

        $use = "old";

        $data_ft = null;
        $paramIds = null;
        $departments = $this->JournalTransaction->Department->find('list');
        $departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields' => array('account_code')));
        $accountNames = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.name')));
        $accountCodes = $this->JournalTransaction->Account->find('list', array('fields' => array('Account.gl')));
        $journalPositions = $this->JournalTransaction->JournalPosition->find('list');

        if ($use == "old") {
            // -----OLD----- //
            $sql = "	select a.id, a.journal_position_id, a.department_id, d.txn_code, a.date, sum(a.amount_db) as amount_db, sum(a.amount_cr) as amount_cr, b.gl as pl_categ, b.t24_gl, b.seq_t24, c.name as ref, b.acc_prefix, a.account_code, e.t24_account_code, a.notes, a.source, a.noref
										from journal_transactions a, accounts b, journal_templates c, journal_groups d, departments e
										where a.account_id			= b.id
										and a.journal_template_id	= c.id
										and c.journal_group_id		= d.id
										and a.department_id			= e.id
										and a.posting				= '0'
										group by a.id, a.department_id, a.date, b.name, b.gl, b.t24_gl, b.seq_t24, b.acc_prefix, c.name, a.journal_position_id, d.txn_code, a.account_code, e.t24_account_code, a.notes, a.source, a.noref
										order by a.date, ref, a.id, a.journal_position_id, a.department_id, e.t24_account_code ";
            $journalRes = $this->JournalTransaction->query($sql);
            // -----OLD----- //
        } else {
            // -----NEW----- //
            // -----NEW----- //
        }


        if ($journalRes) {
            foreach ($journalRes as $data) {
                $journalTransactions[] = $data[0];
            }

            //echo '<pre>';
            //var_dump($journalTransactions);
            //echo '</pre>';die();

            $account_db = '';
            $account_cr = '';
            $amount_db = 0;
            $amount_cr = 0;
            $dept_db = '';
            $sukses = false;

            $n = 0;
            $count = 1;
            $t = 0;
            $arrayTmp = array();
            $cost_center_data = '';
            $new_mapping_cost_centers = new CostCenterToDao;

            $t24dao = $new_mapping_cost_centers->find('first', array('conditions' => array(
                    'cost_center_id' => $this->Session->read('Userinfo.cost_center_id'),
                ))
            );
            $cost_center_data = $t24dao['CostCenterToDao']['t24_dao'];
            foreach ($journalTransactions as $jt) {
                $id = $jt['id'];
                $noref = '';
                $date = date_create($jt['date']);
                $dt = date_format($date, 'Ymd');
                if ($jt['journal_position_id'] == 1) { //Db
                    $explodeCount = count(explode('.', $jt['account_code']));
                    if ($explodeCount == 3 && strlen($jt['account_code']) > 7 && strlen($jt['account_code']) < 16) {
                        list($cab1, $cy1, $brg1) = explode('.', $jt['account_code']);
                        $amount_db = $jt['amount_db'];
                        $dept_db = $departmentAccountCodes[$jt['department_id']];
                        $id_db = $jt['id'];
                    } else if (strlen($jt['account_code']) == 7) {
                        $id_db = $jt['id'];
                        $amount_db = $jt['amount_db'];
                        $cy1 = substr($jt['account_code'], 0, 2);
                        $dept_db = $departmentAccountCodes[$jt['department_id']];
                        $brg1 = substr($jt['account_code'], 2, 7);
                        if ($cy1 == "IDR") {
                            $cy1 = '360';
                        } else if ($cy1 == "USD") {
                            $cy1 = '840';
                        } else if ($cy1 == "AUD") {
                            $cy1 = '036';
                        } else if ($cy1 == "EUR") {
                            $cy1 = '333';
                        } else if ($cy1 == "HKD") {
                            $cy1 = '344';
                        } else if ($cy1 == "NZD") {
                            $cy1 = '554';
                        } else if ($cy1 == "Yen") {
                            $cy1 = '392';
                        } else if ($cy1 == 'PL') {
                            $cy1 = '360';
                        }
                    } else {
                        $id_db = $jt['id'];
                        $amount_db = $jt['amount_db'];
                        $cy1 = substr($jt['account_code'], 0, 3);
                        $dept_db = $departmentAccountCodes[$jt['department_id']];
                        $brg1 = substr($jt['account_code'], 3, 6);
                        if ($cy1 == "IDR") {
                            $cy1 = '360';
                        } else if ($cy1 == "USD") {
                            $cy1 = '840';
                        } else if ($cy1 == "AUD") {
                            $cy1 = '036';
                        } else if ($cy1 == "EUR") {
                            $cy1 = '333';
                        } else if ($cy1 == "HKD") {
                            $cy1 = '344';
                        } else if ($cy1 == "NZD") {
                            $cy1 = '554';
                        } else if ($cy1 == "Yen") {
                            $cy1 = '392';
                        }
                    }
                } else if ($jt['journal_position_id'] == 2) { //Cr
                    $explodeCount = count(explode('.', $jt['account_code']));
                    if ($explodeCount == 3 && strlen($jt['account_code']) > 7 && strlen($jt['account_code']) < 16) {
                        list($cab2, $cy2, $brg2) = explode('.', $jt['account_code']);
                        $amount_cr = $jt['amount_cr'];
                        $dept_cr = $departmentAccountCodes[$jt['department_id']];
                        $date = date_create($jt['date']);
                        $dt = date_format($date, 'Ymd');
                    } else if (strlen($jt['account_code']) == 7) {
                        $amount_cr = $jt['amount_cr'];
                        $cy2 = 'IDR';
                        $dept_cr = $departmentAccountCodes[$jt['department_id']];
                        $brg2 = substr($jt['account_code'], 2, 7);
                        if ($cy2 == "IDR") {
                            $cy2 = '360';
                        } else if ($cy2 == "USD") {
                            $cy2 = '840';
                        } else if ($cy2 == "AUD") {
                            $cy2 = '036';
                        } else if ($cy2 == "EUR") {
                            $cy2 = '333';
                        } else if ($cy2 == "HKD") {
                            $cy2 = '344';
                        } else if ($cy2 == "NZD") {
                            $cy2 = '554';
                        } else if ($cy2 == "Yen") {
                            $cy2 = '392';
                        } else if ($cy2 == 'PL') {
                            $cy2 = '360';
                        }
                    } else {
                        $amount_cr = $jt['amount_cr'];
                        $cy2 = substr($jt['account_code'], 0, 3);
                        $dept_cr = $departmentAccountCodes[$jt['department_id']];
                        $brg2 = substr($jt['account_code'], 3, 6);
                        if ($cy2 == "IDR") {
                            $cy2 = '360';
                        } else if ($cy2 == "USD") {
                            $cy2 = '840';
                        } else if ($cy2 == "AUD") {
                            $cy2 = '036';
                        } else if ($cy2 == "EUR") {
                            $cy2 = '333';
                        } else if ($cy2 == "HKD") {
                            $cy2 = '344';
                        } else if ($cy2 == "NZD") {
                            $cy2 = '554';
                        } else if ($cy2 == "Yen") {
                            $cy2 = '392';
                        }
                    }

                    $source_id = 'FIX';
                    $source_dt = $dt;             //blum bisa
                    list($hh, $ii, $ss) = explode(':', date('H:i:s'));
                    $source_tm = $hh . $ii . $ss;           //number bisa beda keluar nya
                    $source_no = sprintf("%04d", rand(0, 9999));      //unik dari mulai 0001 ga boleh sama
                    $kdcab1 = $dept_db;           //alpha
                    $kdcab2 = $dept_cr;           //alpha
                    $kdtran = 510;             //numberic wajib, no transaksi
                    $noref = $source_id . $dt . $source_no;       //alpaha numberic unik bisa di campir fix dan lain2
                    $norek1 = $brg1;            //number ga bisa co validasi nya harus di explode
                    $norek2 = $brg2;            //number
                    $ccy1 = $cy1;            //number mata uang menurut BI diambil dari account_code
                    $ccy2 = $cy2;
                    $nilai1 = $amount_db;            //harus koma tidak bisa titik
                    $nilai2 = $amount_cr;
                    $kurs = 1;             //satu karena rupiah
                    $costdept1 = $dept_db;           //busines type-cost center
                    $costdept2 = $dept_cr;
                    $ket1 = $jt['notes'];
                    //$ket2    	= $jt['source'].".".$jt['doc_id'];	
                    $ket2 = $jt['source'];
                    $ket3 = $jt['txn_code'];
                    $costc1 = '';
                    $costc2 = '';

                    /* run insert */
                    $data['JournalInterfase']['source_id'] = $source_id;
                    $data['JournalInterfase']['source_dt'] = $source_dt;
                    $data['JournalInterfase']['source_no'] = $source_no;
                    $data['JournalInterfase']['source_tm'] = $source_tm;
                    $data['JournalInterfase']['kdtran'] = $kdtran;
                    $data['JournalInterfase']['noref'] = $noref;
                    $data['JournalInterfase']['kdcab1'] = $kdcab1;
                    $data['JournalInterfase']['kdcab2'] = $kdcab2;
                    $data['JournalInterfase']['ccy1'] = $ccy1;
                    $data['JournalInterfase']['ccy2'] = $ccy2;
                    $data['JournalInterfase']['norek1'] = $norek1;
                    $data['JournalInterfase']['norek2'] = $norek2;
                    $data['JournalInterfase']['ket1'] = $ket2;
                    $data['JournalInterfase']['ket2'] = $ket1 ? $ket1 : '';
                    $data['JournalInterfase']['ket3'] = $ket3;
                    $data['JournalInterfase']['kurs'] = $kurs;
                    $data['JournalInterfase']['costdept1'] = $costdept1;
                    $data['JournalInterfase']['costdept2'] = $costdept2;
                    $data['JournalInterfase']['nilai1'] = $nilai1;
                    $data['JournalInterfase']['nilai2'] = $nilai2;

                    $JournalInterfase = new JournalInterfase;
                    $JournalInterfase->create();
                    $JournalInterfase->save($data);

                    //$this->JournalTransaction->id = $id; 
                    //$this->JournalTransaction->saveField( 'posting', 1);			
                    //$this->JournalTransaction->saveField( 'noref', $noref);			
                    //$this->JournalTransaction->saveField( 'posting_date', date('Y-m-d H:i:s'));
                    //$this->JournalTransaction->id = $id_db; 
                    //$this->JournalTransaction->saveField( 'posting', 1);			
                    //$this->JournalTransaction->saveField( 'noref', $noref);			
                    //$this->JournalTransaction->saveField( 'posting_date', date('Y-m-d H:i:s'));
                }

                if ($count % 2 == 0) {
                    $n = $n - 1;
                }
                $arrayTmp[$n]['version'] = 'FUNDS.TRANSFER,/I/PROCESS//0,USER/PASSWORD/';    //version	
                //$arrayTmp[$n]['pass'] 		= '';														//pass

                if ($jt['txn_code']) {
                    $arrayTmp[$n]['txn_code'] = $jt['txn_code'];           //txn type
                } else {
                    $arrayTmp[$n]['txn_code'] = "AC";              //txn type
                }
                if ($cost_center_data) {
                    $arrayTmp[$n]['dao'] = $cost_center_data;
                } else {
                    $arrayTmp[$n]['dao'] = '1000';
                }

                $arrayTmp[$n]['order_cust'] = 'Rabobank';
                $arrayTmp[$n]['rate'] = '';

                if ($jt['journal_position_id'] == 1) {
                    //debit
                    //dr account
                    if ($jt['t24_account_code']) {
                        $arrayTmp[$n]['branch'] = $jt['t24_account_code'];          //branch
                    } else {
                        $arrayTmp[$n]['branch'] = "ID0010001";             //branch
                    }

                    if ($jt['txn_code'] == 'ACF1' && $jt['t24_gl'] == '62160') {
                        $jt['acc_prefix'] = "PL";
                        $jt['t24_gl'] = '11506';
                    }

                    if ($jt['acc_prefix'] == "IDR") {
                        $arrayTmp[$n]['dr_acc'] = $jt['acc_prefix'] . $jt['t24_gl'] . $jt['seq_t24'] . substr($jt['t24_account_code'], 5, 4);
                    } else if ($jt['acc_prefix'] == "PL") {
                        $arrayTmp[$n]['dr_acc'] = "PL" . $jt['t24_gl'];
                    } else {
                        $arrayTmp[$n]['dr_acc'] = $jt['t24_gl'];
                    }
                    //dr ccy
                    $arrayTmp[$n]['dr_ccy'] = 'IDR';
                    //dr amount
                    if ($jt['amount_db']) {
                        $arrayTmp[$n]['dr_amount'] = $jt['amount_db'];
                    } else {
                        $arrayTmp[$n]['dr_amount'] = '0';
                    }

                    //dr value date
                    if (substr($jt['date'], 0, 10)) {
                        $arrayTmp[$n]['dr_date'] = substr($jt['date'], 0, 10);
                    } else {
                        $arrayTmp[$n]['dr_date'] = date('Ymd');
                    }
                    //dr reference
                    if ($jt['ref']) {
                        $arrayTmp[$n]['dr_ref'] = $jt['ref'];
                    } else {
                        $arrayTmp[$n]['dr_ref'] = 'Template';
                    }
                } else if ($jt['journal_position_id'] == 2) {
                    if ($count % 2 == 0) {
                        //credit
                        //cr account
                        if ($jt['acc_prefix'] == "IDR") {
                            $arrayTmp[$n]['cr_acc'] = $jt['acc_prefix'] . $jt['t24_gl'] . $jt['seq_t24'] . substr($jt['t24_account_code'], 5, 4);
                        } else if ($jt['acc_prefix'] == "PL") {
                            $arrayTmp[$n]['cr_acc'] = "PL" . $jt['t24_gl'];
                            $arrayTmp[$n]['branch'] = $jt['t24_account_code']; // Request by Rabobank. If the account is PL, set branch code to its corresponding branch in famsys interface entry.
                        } else {
                            $arrayTmp[$n]['cr_acc'] = $jt['t24_gl'];
                        }
                        //cr ccy
                        $arrayTmp[$n]['cr_ccy'] = 'IDR';
                        //cr amount
                        $arrayTmp[$n]['cr_amount'] = $jt['amount_cr'];
                        //cr value date
                        if (substr($jt['date'], 0, 10)) {
                            $arrayTmp[$n]['cr_date'] = substr($jt['date'], 0, 10);
                        } else {
                            $arrayTmp[$n]['cr_date'] = date('Ymd');
                        }

                        //cr reference
                        if ($jt['ref']) {
                            $arrayTmp[$n]['cr_ref'] = $jt['ref'];
                        } else {
                            $arrayTmp[$n]['cr_ref'] = 'Template';
                        }
                    }
                }

                $paramIds[$t]['id'] = $jt['id'];
                $paramIds[$t]['noref'] = $jt['noref'];
                $count++;
                $n++;
                $t++;
            }
            $data_ft = $arrayTmp;
        }

        $this->Session->write('ExcelGenerate', $data_ft);
        $this->Session->write('paramId', $paramIds);

        //echo '<pre>';
        //var_dump($data);
        //echo '</pre>';die();

        $this->set(compact('data_ft'));
        //$this->redirect(array('controller'=>'famsys_interfaces', 'action' => 'add_ft'));
    }

    function generateCsvEntry($journalLines, $with_header = true, $with_html = true) {
        //echo "journalLines on generateCsvEntry";
        //echo "<pre>";
        //var_dump($journalLines);
        //echo "<pre>";die();
        $out = '';
        $header = '';

        //$tc = new TransactionCode;
        //$transactionCodes = $tc->find('list', array('fields' => array('code')));

        $header .= "VERSION,";
        $header .= "USER-ID,";
        $header .= "BRANCH CODE,";
        $header .= "TXN TYPE,";
        $header .= "DR ACCOUNT,";
        $header .= "DR CCY,";
        $header .= "DR AMOUNT,";
        $header .= "DR VALUE DATE,";
        $header .= "DR REFERENCE,";
        $header .= "CR ACCOUNT,";
        $header .= "CR CCY,";
        $header .= "CR AMOUNT,";
        $header .= "CR VALUE DATE,";
        $header .= "CR REFERENCE,";
        $header .= "DAO,";
        $header .= "ORDERING CUST,";
        $header .= "EXCHANGE RATE\n";

        foreach ($journalLines as $j) {
            $out .= $j['version'] . ",";       //version
            $out .= "/,";           //user id
            $out .= $j['branch'] . ",";       //branch code
            $out .= $j['txn_code'] . ",";       //txn type
            $out .= $j['dr_acc'] . ",";       //dr account
            $out .= $j['dr_ccy'] . ",";       //dr ccy
            $out .= $j['dr_amount'] . ",";      //dr amount
            $out .= date('Ymd', strtotime($j['dr_date'])) . ","; //$out .= date('Y') . date('m') . date('d') . ",";  //dr value date
            $out .= $j['dr_ref'] . ",";       //dr reference
            $out .= $j['cr_acc'] . ",";       //cr account
            $out .= $j['cr_ccy'] . ",";       //cr ccy
            $out .= $j['cr_amount'] . ",";      //cr amount
            $out .= date('Ymd', strtotime($j['cr_date'])) . ","; //$out .= date('Y') . date('m') . date('d') . ",";  //cr value date
            $out .= $j['cr_ref'] . ",";       //cr reference
            $out .= $j['dao'] . ",";        //dao
            $out .= $j['order_cust'] . ",";      //ordering customer
            $out .= $j['rate'] . "\n";        //exchange rate
        }

        if ($with_header == false) {
            $header = '';
        }

        if ($with_html == false) {
            return $header . $out;
        }

        $this->set(compact(
                        'header', 'out'
        ));

        $this->set('detail', $out);
        $this->set('header', $header);

        $this->render('journal_entry_xls', 'export_xls');
    }

    function journal_entry($type = null) {
        $out = '';

        $group_id = $this->Session->read('JournalTransaction.journal_group_id');
        $this->JournalTransaction->recursive = 0;
        $departments = $this->JournalTransaction->Department->find('list');
        $journalGroup = $this->JournalTransaction->JournalTemplate->JournalGroup->find('list');
        $journalTemplates = $this->JournalTransaction->JournalTemplate->find('list', array('conditions' => array('journal_group_id' => $group_id)));
        $postings = array(1 => 'Yes', 0 => 'No');
        $con = array();

        list($date_start, $date_end) = $this->set_date_filters('JournalTransaction');
        $con[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
            'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

        if ($department_id = $this->Session->read('JournalTransaction.department_id'))
            $con[] = array('department_id' => $department_id);
        if ($journal_template_id = $this->Session->read('JournalTransaction.journal_template_id'))
            $con[] = array('journal_template_id' => $journal_template_id);
        if ($posting_id = $this->Session->read('JournalTransaction.posting_id'))
            $con[] = array('posting' => $posting_id);
        if ($group_id)
            $con[] = array('JournalTemplate.journal_group_id' => $group_id);

        //if($group_id != journal_group_inventory_id){
        $journalLinesTotal = $this->JournalTransaction->find('all', array('conditions' => $con, 'order' => 'JournalTransaction.id'));
        $totalGeneral = $this->JournalTransaction->totalGeneral($journalLinesTotal);
        /* }else{
          $sql				= "	select a.journal_position_id, a.department_id, d.txn_code, a.date, sum(a.amount_db) as amount_db, sum(a.amount_cr) as amount_cr, b.gl as pl_categ, b.t24_gl, b.seq_t24, c.name as ref, b.acc_prefix, a.account_code, e.t24_account_code
          from journal_transactions a, accounts b, journal_templates c, journal_groups d, departments e
          where a.date >= CONVERT(datetime,'".$date_start['year']."-".$date_start['month']."-".$date_start['day']."',120)
          and a.date <= CONVERT(datetime,'".$date_end['year']."-".$date_end['month']."-".$date_end['day']."',120)
          and a.account_id			= b.id
          and a.journal_template_id	= c.id
          and c.journal_group_id		= d.id
          and a.department_id			= e.id
          and d.id					= '1'
          group by a.department_id, a.date, b.name, b.gl, b.t24_gl, b.seq_t24, b.acc_prefix, c.name, a.journal_position_id, d.txn_code, a.account_code, e.t24_account_code
          order by a.department_id, a.date, ref";
          $journalRes			= $this->JournalTransaction->query($sql);
          foreach($journalRes as $data){
          $journalLinesTotal[] = $data[0];
          }
          } */



        $con_json = json_encode($con);
        //$this->set('journalTransactions', $journalLinesTotal);
        // ---------------- //
        $ctr = 0;
        $pagesize = 450;

        //echo '<pre>';
        //var_dump($journalLinesTotal);
        //echo '</pre>';die();

        $arrayPagging = array();
        $arrayTmp = array();
        $ctr_pagging = 0;

        $n = 0;
        $count = 1;
        $cost_center_data = '';
        $new_mapping_cost_centers = new CostCenterToDao;

        $t24dao = $new_mapping_cost_centers->find('first', array('conditions' => array(
                'cost_center_id' => $this->Session->read('Userinfo.cost_center_id'),
            ))
        );
        $cost_center_data = $t24dao['CostCenterToDao']['t24_dao'];
        foreach ($journalLinesTotal as $journalLines) {

            if ($count % 2 == 0) {
                $n = $n - 1;
            }

            if (strlen($journalLines['JournalTransaction']['account_code']) == 10) {
                $journalLines['JournalTransaction']['account_code'] = $journalLines['Department']['account_code'] . $journalLines['JournalTransaction']['account_code'];
            }

            //list($cab, $cy, $brg) = explode('.', $journalLines['JournalTransaction']['account_code']);
            $explodedAccountCode = explode('.', $journalLines['JournalTransaction']['account_code']);

            if (count($explodedAccountCode) < 3) {
                if (substr($journalLines['JournalTransaction']['account_code'], 0, 2) == 'PL') {
                    $cy = '360';
                } else {
                    $prefix = substr($journalLines['JournalTransaction']['account_code'], 0, 3);
                    if ($prefix == "IDR") {
                        $cy = '360';
                    } else if ($prefix == "USD") {
                        $cy = '840';
                    } else if ($prefix == "AUD") {
                        $cy = '036';
                    } else if ($prefix == "EUR") {
                        $cy = '333';
                    } else if ($prefix == "HKD") {
                        $cy = '344';
                    } else if ($prefix == "NZD") {
                        $cy = '554';
                    } else if ($prefix == "Yen") {
                        $cy = '392';
                    } else if ($prefix == 'PL') {
                        $cy = '360';
                    }
                }
            } else {
                $cy = $explodedAccountCode[1];
            }

            $arrayTmp[$n]['version'] = 'FAMSYS';   //version	
            $arrayTmp[$n]['user-id'] = '/';    //uid

            $arrayTmp[$n]['order_cust'] = 'Rabobank';
            $arrayTmp[$n]['rate'] = '';

            if ($journalLines['Department']['t24_account_code']) {
                $arrayTmp[$n]['branch'] = $journalLines['Department']['t24_account_code'];  //branch
            } else {
                $arrayTmp[$n]['branch'] = "ID0010001";  //branch
            }
            if ($journalLines['JournalGroup']['txn_code']) {
                $arrayTmp[$n]['txn_code'] = $journalLines['JournalGroup']['txn_code'];  //txn type
            } else {
                $arrayTmp[$n]['txn_code'] = "AC";  //txn type
            }
            if ($cost_center_data) {
                $arrayTmp[$n]['dao'] = $cost_center_data;
            } else {
                $arrayTmp[$n]['dao'] = '3072';
            }

            if ($journalLines['JournalPosition']['id'] == 1) {
                //debit
                //dr account
                if ($journalLines['Account']['acc_prefix'] == "IDR") {
                    $arrayTmp[$n]['dr_acc'] = $journalLines['Account']['acc_prefix'] . $journalLines['Account']['t24_gl'] . $journalLines['Account']['seq_t24'] . substr($journalLines['Department']['t24_account_code'], 5, 4);
                } else if ($journalLines['Account']['acc_prefix'] == null) {
                    $arrayTmp[$n]['dr_acc'] = $journalLines['Account']['t24_gl'];
                } else {
                    $arrayTmp[$n]['dr_acc'] = $journalLines['Account']['acc_prefix'] . $journalLines['Account']['t24_gl'];
                }
                //dr ccy
                if ($cy == "360") {
                    $arrayTmp[$n]['dr_ccy'] = 'IDR';
                } else if ($cy == "840") {
                    $arrayTmp[$n]['dr_ccy'] = 'USD';
                } else if ($cy == "036") {
                    $arrayTmp[$n]['dr_ccy'] = 'AUD';
                } else if ($cy == "333") {
                    $arrayTmp[$n]['dr_ccy'] = 'EUR';
                } else if ($cy == "344") {
                    $arrayTmp[$n]['dr_ccy'] = 'HKD';
                } else if ($cy == "554") {
                    $arrayTmp[$n]['dr_ccy'] = 'NZD';
                } else if ($cy == "392") {
                    $arrayTmp[$n]['dr_ccy'] = 'Yen';
                }
                //dr amount
                if ($journalLines['JournalTransaction']['amount_db']) {
                    $arrayTmp[$n]['dr_amount'] = $journalLines['JournalTransaction']['amount_db'];
                } else {
                    $arrayTmp[$n]['dr_amount'] = '0';
                }

                //dr value date
                if (substr($journalLines['JournalTransaction']['date'], 0, 10)) {
                    $arrayTmp[$n]['dr_date'] = substr($journalLines['JournalTransaction']['date'], 0, 10);
                } else {
                    $arrayTmp[$n]['dr_date'] = date('Ymd');
                }
                //dr reference
                if ($journalLines['JournalTemplate']['name']) {
                    $arrayTmp[$n]['dr_ref'] = $journalLines['JournalTemplate']['name'];
                } else {
                    $arrayTmp[$n]['dr_ref'] = 'Template';
                }
            } else if ($journalLines['JournalPosition']['id'] == 2) {
                if ($count % 2 == 0) {
                    //credit
                    //cr account
                    if ($journalLines['Account']['acc_prefix'] == "IDR") {
                        $arrayTmp[$n]['cr_acc'] = $journalLines['Account']['acc_prefix'] . $journalLines['Account']['t24_gl'] . $journalLines['Account']['seq_t24'] . substr($journalLines['Department']['t24_account_code'], 5, 4);
                    } else if ($journalLines['Account']['acc_prefix'] == null) {
                        $arrayTmp[$n]['cr_acc'] = $journalLines['Account']['t24_gl'];
                    } else {
                        $arrayTmp[$n]['cr_acc'] = $journalLines['Account']['acc_prefix'] . $journalLines['Account']['t24_gl'];
                    }
                    //cr ccy
                    if ($cy == "360") {
                        $arrayTmp[$n]['cr_ccy'] = 'IDR';
                    } else if ($cy == "840") {
                        $arrayTmp[$n]['cr_ccy'] = 'USD';
                    } else if ($cy == "036") {
                        $arrayTmp[$n]['cr_ccy'] = 'AUD';
                    } else if ($cy == "333") {
                        $arrayTmp[$n]['cr_ccy'] = 'EUR';
                    } else if ($cy == "344") {
                        $arrayTmp[$n]['cr_ccy'] = 'HKD';
                    } else if ($cy == "554") {
                        $arrayTmp[$n]['cr_ccy'] = 'NZD';
                    } else if ($cy == "392") {
                        $arrayTmp[$n]['cr_ccy'] = 'Yen';
                    }
                    //cr amount
                    if ($journalLines['JournalTransaction']['amount_cr']) {
                        $arrayTmp[$n]['cr_amount'] = $journalLines['JournalTransaction']['amount_cr'];
                    } else {
                        $arrayTmp[$n]['cr_amount'] = '0';
                    }
                    //cr value date
                    if (substr($journalLines['JournalTransaction']['date'], 0, 10)) {
                        $arrayTmp[$n]['cr_date'] = substr($journalLines['JournalTransaction']['date'], 0, 10);
                    } else {
                        $arrayTmp[$n]['cr_date'] = date('Ymd');
                    }

                    //cr reference
                    if ($journalLines['JournalTemplate']['name']) {
                        $arrayTmp[$n]['cr_ref'] = $journalLines['JournalTemplate']['name'];
                    } else {
                        $arrayTmp[$n]['cr_ref'] = 'Template';
                    }


                    $array_JL = array(0 => $arrayTmp[$n]);

                    $with_header = true;
                    if ($ctr != 0)
                        $with_header = false;

                    $out .= $this->generateCsvEntry($array_JL, $with_header, false);
                    $ctr++;

                    if ($ctr >= $pagesize) {
                        $arrayPagging[$ctr_pagging] = $out;
                        $out = '';
                        $ctr = 0;

                        $ctr_pagging++;
                    }
                }
            }

            $count++;
            $n++;
        }//end foreach
        //echo '<pre>';
        //var_dump($journalLinesTotal);
        //echo '</pre>';die();

        if ($ctr_pagging == 0) {
            $arrayPagging[$ctr_pagging] = $out;
            $out = '';
            $ctr = 0;

            $ctr_pagging++;
        }
        $this->set(compact(
                        'arrayPagging'
        ));

        $this->set('arrayPagging', $arrayPagging);

        $this->render('journal_entry_pagging_xls');
    }

    private function constructAccountCode($accountData, $departmentAccountCode) {
        $account = $accountData['Account'];
        $accountPrefix = $account['acc_prefix'];
        $accountCode = '';

        if ($accountPrefix == 'IDR') {
            $accountCode = $accountPrefix . $account['t24_gl'] . $account['seq_t24'] . substr($departmentAccountCode, 5, 4);
        } else if ($accountPrefix == 'PL') {
            $accountCode = $accountPrefix . $account['t24_gl'];
        } else {
            $accountCode = $account['t24_gl'];
        }
        return $accountCode;
    }

    private function constructAccountCodeFromJournalTemplateDetail($journalTemplateDetail, $departmentAccountCode) {
        $accountData = $this->JournalTransaction->Account->read(null, $journalTemplateDetail['account_id']);
        return $this->constructAccountCode($accountData, $departmentAccountCode);
    }

}

?>