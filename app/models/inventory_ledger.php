<?php

App::import('Model', 'JournalTransaction');
App::import('Model', 'Account');
App::import('Model', 'JournalTemplate');
App::import('Model', 'Department');

App::import('Model', 'CostCenterToDao');

App::import('Component', 'RecordReferer');

define('ACCOUNTCURRENCY_IDR_CODE', '360');
define('KPNODEPARTMENT_ID', '72');
define('Usage_template_id', '338');

class InventoryLedger extends AppModel {

    var $name = 'InventoryLedger';
    var $displayField = 'id';
    /* 	var $actsAs = array('Logable' => array( 
      'userModel' => 'InventoryLedger',
      'userKey' => 'id',
      'change' => 'list', // options are 'list' or 'full'
      'description_ids' => TRUE // options are TRUE or FALSE
      ));
     */
    var $validate = array(
        'date' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'item_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'qty' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'in_out' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'doc_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'po_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Department' => array(
            'className' => 'Department',
            'foreignKey' => 'department_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'BusinessType' => array(
            'className' => 'BusinessType',
            'foreignKey' => 'business_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'CostCenter' => array(
            'className' => 'CostCenter',
            'foreignKey' => 'cost_center_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Npb' => array(
            'className' => 'Npb',
            'foreignKey' => 'npb_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Po' => array(
            'className' => 'Po',
            'foreignKey' => 'po_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Retur' => array(
            'className' => 'Retur',
            'foreignKey' => 'retur_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Inlog' => array(
            'className' => 'Inlog',
            'foreignKey' => 'inlog_id',
            'dependent' => true,
        ),
        'Outlog' => array(
            'className' => 'Outlog',
            'foreignKey' => 'outlog_id',
            'dependent' => true,
        ),
        'SupplierRetur' => array(
            'className' => 'SupplierRetur',
            'foreignKey' => 'supplier_retur_id',
            'dependent' => true,
        ),
        'ReturDetail' => array(
            'className' => 'ReturDetail',
            'foreignKey' => 'retur_detail_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'InlogDetail' => array(
            'className' => 'InlogDetail',
            'foreignKey' => 'inlog_detail_id',
            'dependent' => true,
        ),
        'OutlogDetail' => array(
            'className' => 'OutlogDetail',
            'foreignKey' => 'outlog_detail_id',
            'dependent' => true,
        ),
        'SupplierReturDetail' => array(
            'className' => 'SupplierReturDetail',
            'foreignKey' => 'supplier_retur_detail_id',
            'dependent' => true,
        ),
        'SupplierReplace' => array(
            'className' => 'SupplierReplace',
            'foreignKey' => 'supplier_replace_id',
            'dependent' => true,
        ),
        'SupplierReplaceDetail' => array(
            'className' => 'SupplierReplaceDetail',
            'foreignKey' => 'supplier_replace_detail_id',
            'dependent' => true,
        ),
    );
    var $hasMany = array(
    );
    var $virtualFields = array(
        'item_code' => 'SELECT code from items where InventoryLedger.item_id = items.id'
    );
    var $recordRefererComponent = null;

    function __construct($id = false, $table = null, $ds = null) {
        $this->recordRefererComponent = new RecordRefererComponent;
        parent::__construct($id, $table, $ds);
    }

    function beforeSave() {
        //Calculate Amount
        if (isset($this->data['InventoryLedger']['qty']) && isset($this->data['InventoryLedger']['price'])) {
            $this->data['InventoryLedger']['amount'] = $this->data['InventoryLedger']['qty'] * $this->data['InventoryLedger']['price'];
        }
        return true;
    }

    function getItemBalances() {
        //kalau inlog : ++
        //kalau outlog atau supplierRetur : --
        if (DRIVER == 'mysql') {
            $params = array(
                'fields' => array('Item.id', SQL_INVENTORY_LEDGER_BALANCE),
                'joins' => array(
                    array('table' => 'inventory_ledgers',
                        'alias' => 'InventoryLedger',
                        'type' => 'inner',
                        'conditions' => array('Item.id=InventoryLedger.item_id')
                    )
                ),
                'group' => array('InventoryLedger.item_id')
            );
        } elseif (DRIVER == 'mssql') {
            $params = array(
                'fields' => array('Item.id', SQL_INVENTORY_LEDGER_BALANCE),
                'joins' => array(
                    array('table' => 'inventory_ledgers',
                        'alias' => 'InventoryLedger',
                        'type' => 'right',
                        'conditions' => array('Item.id=InventoryLedger.item_id')
                    )
                ),
                'group' => array('InventoryLedger.item_id', 'Item.id')
            );
        }
        $this->Item->recursive = 0;
        $itemBalances = $this->Item->find('all', $params);
        $tmp = array();
        foreach ($itemBalances as $bal) {
            $tmp[$bal['Item']['id']] = $bal[0]['balance'];
        }
        return $tmp;
    }

    function insert_to_journal($doc = null, $id = null, $journal_group_id = null) {

        if ($doc == 'outlog') {
            $outlog = $this->Outlog->read(null, $id);
            $detil = $this->OutlogDetail->find('all', array('conditions' => array('OutlogDetail.outlog_id' => $id)));

            if ($outlog['Outlog']['department_id'] != KPNODEPARTMENT_ID)
                $journal_group_id = $this->recordRefererComponent->getIdByModelNameAndRefName('JournalGroup', 'journal_group_usage_id');
            else
                $journal_group_id = $this->recordRefererComponent->getIdByModelNameAndRefName('JournalGroup', 'journal_group_usage_kpno_id');

            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $outlogDetil) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $outlogDetil['Item']['asset_category_id']))
                );

                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('account_code')));
                $i = 1;
                $count = 0;
                foreach ($journalTemplate['JournalTemplateDetail'] as $detil) {
                    $count += $i;
                }

                $j++;
                $start_index = $j * 4;

                $journal[$start_index]['department_id'] = $journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['date'] = date("Y-m-d");
                $journal[$start_index]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
                $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['journal_position_id'] = 1;
                $journal[$start_index]['amount_db'] = $outlogDetil['OutlogDetail']['amount'];
                $journal[$start_index]['amount_cr'] = 0;
                $journal[$start_index]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
                $journal[$start_index]['source'] = $doc;
                $journal[$start_index]['doc_id'] = $id;

                $journal[$start_index + 1]['department_id'] = $journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + 1]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['date'] = date("Y-m-d");
                $journal[$start_index + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['journal_position_id'] = 2;
                $journal[$start_index + 1]['amount_db'] = 0;
                $journal[$start_index + 1]['amount_cr'] = $outlogDetil['OutlogDetail']['amount'];
                $journal[$start_index + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
                $journal[$start_index + 1]['source'] = $doc;
                $journal[$start_index + 1]['doc_id'] = $id;

                if ($count == 4) {

                    $journal[$start_index + 2]['department_id'] = $journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID;
                    $journal[$start_index + 2]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['date'] = date("Y-m-d");
                    $journal[$start_index + 2]['account_id'] = $journalTemplate['JournalTemplateDetail'][2]['account_id'];
                    $journal[$start_index + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['journal_position_id'] = 1;
                    $journal[$start_index + 2]['amount_db'] = $outlogDetil['OutlogDetail']['amount'];
                    $journal[$start_index + 2]['amount_cr'] = 0;
                    $journal[$start_index + 2]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][2]['journal_template_id'];
                    $journal[$start_index + 2]['source'] = $doc;
                    $journal[$start_index + 2]['doc_id'] = $id;

                    $journal[$start_index + 3]['department_id'] = $journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID;
                    $journal[$start_index + 3]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['date'] = date("Y-m-d");
                    $journal[$start_index + 3]['account_id'] = $journalTemplate['JournalTemplateDetail'][3]['account_id'];
                    $journal[$start_index + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['journal_position_id'] = 2;
                    $journal[$start_index + 3]['amount_db'] = 0;
                    $journal[$start_index + 3]['amount_cr'] = $outlogDetil['OutlogDetail']['amount'];
                    $journal[$start_index + 3]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][3]['journal_template_id'];
                    $journal[$start_index + 3]['source'] = $doc;
                    $journal[$start_index + 3]['doc_id'] = $id;
                }
            }
        } else if ($doc == 'retur') {
            $retur = $this->Retur->read(null, $id);
            $detil = $this->ReturDetail->find('all', array('conditions' => array('ReturDetail.retur_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $returDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $returDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('account_code')));

                $start_index++;
                $j++;

                $journal[$start_index + $j]['department_id'] = $journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $retur['Retur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $retur['Retur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['date'] = date("Y-m-d");
                $journal[$start_index + $j]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
                $journal[$start_index + $j]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['journal_position_id'] = 1;
                $journal[$start_index + $j]['amount_db'] = $returDetail['ReturDetail']['amount'];
                $journal[$start_index + $j]['amount_cr'] = 0;
                $journal[$start_index + $j]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
                $journal[$start_index + $j]['source'] = $doc;
                $journal[$start_index + $j]['doc_id'] = $id;

                $journal[$start_index + $j + 1]['department_id'] = $journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $retur['Retur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 1]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $retur['Retur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
                $journal[$start_index + $j + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['journal_position_id'] = 2;
                $journal[$start_index + $j + 1]['amount_db'] = 0;
                $journal[$start_index + $j + 1]['amount_cr'] = $returDetail['ReturDetail']['amount'];
                $journal[$start_index + $j + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
                $journal[$start_index + $j + 1]['source'] = $doc;
                $journal[$start_index + $j + 1]['doc_id'] = $id;
            }
        } else if ($doc == 'supplierRetur') {
            $supplierRetur = $this->SupplierRetur->read(null, $id);
            $detil = $this->SupplierReturDetail->find('all', array('conditions' => array('SupplierReturDetail.supplier_retur_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $supplierReturDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $supplierReturDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('account_code')));

                $start_index++;
                $j++;

                $journal[$start_index + $j]['department_id'] = $journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['date'] = date("Y-m-d");
                $journal[$start_index + $j]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
                $journal[$start_index + $j]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['journal_position_id'] = 1;
                $journal[$start_index + $j]['amount_db'] = $supplierReturDetail['SupplierReturDetail']['amount'];
                $journal[$start_index + $j]['amount_cr'] = 0;
                $journal[$start_index + $j]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
                $journal[$start_index + $j]['source'] = $doc;
                $journal[$start_index + $j]['doc_id'] = $id;

                $journal[$start_index + $j + 1]['department_id'] = $journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 1]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
                $journal[$start_index + $j + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['journal_position_id'] = 2;
                $journal[$start_index + $j + 1]['amount_db'] = 0;
                $journal[$start_index + $j + 1]['amount_cr'] = $supplierReturDetail['SupplierReturDetail']['amount'];
                $journal[$start_index + $j + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
                $journal[$start_index + $j + 1]['source'] = $doc;
                $journal[$start_index + $j + 1]['doc_id'] = $id;

                $journal[$start_index + $j + 2]['department_id'] = $journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 2]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                $journal[$start_index + $j + 2]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 2]['account_id'] = $journalTemplate['JournalTemplateDetail'][2]['account_id'];
                $journal[$start_index + $j + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                $journal[$start_index + $j + 2]['journal_position_id'] = 1;
                $journal[$start_index + $j + 2]['amount_db'] = $supplierReturDetail['SupplierReturDetail']['amount'];
                $journal[$start_index + $j + 2]['amount_cr'] = 0;
                $journal[$start_index + $j + 2]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][2]['journal_template_id'];
                $journal[$start_index + $j + 2]['source'] = $doc;
                $journal[$start_index + $j + 2]['doc_id'] = $id;

                $journal[$start_index + $j + 3]['department_id'] = $journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 3]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $supplierRetur['SupplierRetur']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                $journal[$start_index + $j + 3]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 3]['account_id'] = $journalTemplate['JournalTemplateDetail'][3]['account_id'];
                $journal[$start_index + $j + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                $journal[$start_index + $j + 3]['journal_position_id'] = 2;
                $journal[$start_index + $j + 3]['amount_db'] = 0;
                $journal[$start_index + $j + 3]['amount_cr'] = $supplierReturDetail['SupplierReturDetail']['amount'];
                $journal[$start_index + $j + 3]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][3]['journal_template_id'];
                $journal[$start_index + $j + 3]['source'] = $doc;
                $journal[$start_index + $j + 3]['doc_id'] = $id;
            }
        } else if ($doc == 'supplierReplace') {
            $supplierReplace = $this->SupplierReplace->read(null, $id);
            $detil = $this->SupplierReplaceDetail->find('all', array('conditions' => array('SupplierReplaceDetail.supplier_replace_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $supplierReplaceDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $supplierReplaceDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('account_code')));

                $start_index++;
                $j++;

                $journal[$start_index + $j]['department_id'] = $journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['date'] = date("Y-m-d");
                $journal[$start_index + $j]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
                $journal[$start_index + $j]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['journal_position_id'] = 1;
                $journal[$start_index + $j]['amount_db'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'];
                $journal[$start_index + $j]['amount_cr'] = 0;
                $journal[$start_index + $j]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
                $journal[$start_index + $j]['source'] = $doc;
                $journal[$start_index + $j]['doc_id'] = $id;

                $journal[$start_index + $j + 1]['department_id'] = $journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 1]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
                $journal[$start_index + $j + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['journal_position_id'] = 2;
                $journal[$start_index + $j + 1]['amount_db'] = 0;
                $journal[$start_index + $j + 1]['amount_cr'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'];
                $journal[$start_index + $j + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
                $journal[$start_index + $j + 1]['source'] = $doc;
                $journal[$start_index + $j + 1]['doc_id'] = $id;

                $journal[$start_index + $j + 2]['department_id'] = $journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 2]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                $journal[$start_index + $j + 2]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 2]['account_id'] = $journalTemplate['JournalTemplateDetail'][2]['account_id'];
                $journal[$start_index + $j + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                $journal[$start_index + $j + 2]['journal_position_id'] = 1;
                $journal[$start_index + $j + 2]['amount_db'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'];
                $journal[$start_index + $j + 2]['amount_cr'] = 0;
                $journal[$start_index + $j + 2]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][2]['journal_template_id'];
                $journal[$start_index + $j + 2]['source'] = $doc;
                $journal[$start_index + $j + 2]['doc_id'] = $id;

                $journal[$start_index + $j + 3]['department_id'] = $journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID;
                $journal[$start_index + $j + 3]['account_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $supplierReplace['SupplierReplace']['department_id'] : KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                $journal[$start_index + $j + 3]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 3]['account_id'] = $journalTemplate['JournalTemplateDetail'][3]['account_id'];
                $journal[$start_index + $j + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                $journal[$start_index + $j + 3]['journal_position_id'] = 2;
                $journal[$start_index + $j + 3]['amount_db'] = 0;
                $journal[$start_index + $j + 3]['amount_cr'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'];
                $journal[$start_index + $j + 3]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][3]['journal_template_id'];
                $journal[$start_index + $j + 3]['source'] = $doc;
                $journal[$start_index + $j + 3]['doc_id'] = $id;
            }
        } else if ($doc == 'inlog') {
            $Inlog = $this->Inlog->read(null, $id);
            $detil = $this->InlogDetail->find('all', array('conditions' => array('InlogDetail.inlog_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));
            $start_index = (-1);
            $j = (-1);

            foreach ($detil as $inlogDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $inlogDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('account_code')));

                $start_index++;
                $j++;

                $dep_id = '72';
                //echo '<pre>';
                //var_dump($journalTemplate);
                //echo '</pre>';
                $journal[$start_index + $j]['department_id'] = KPNODEPARTMENT_ID;

//print_r($start_index.'#'.$inlogDetail['InlogDetail']['id'].'#'.$journalTemplate['JournalTemplateDetail'][0]['account_id']);
//print_r('<br><br>');

                $journal[$start_index + $j]['account_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                //echo '1 - '.$departmentAccountCodes[$dep_id] .'<br>';
                //echo '2 - '.ACCOUNTCURRENCY_IDR_CODE .'<br>';
                //echo '3 - '.$journalTemplate['JournalTemplateDetail'][0]['account_id'] .'<br>';
                //echo '4 - '.$accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] .'<br>';
                //die();
                //$journal[$start_index+$j]['department_id'] = $dep_id;
                //$journal[$start_index+$j]['account_code'] = $departmentAccountCodes[$dep_id] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' .$accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['date'] = date("Y-m-d");
                $journal[$start_index + $j]['account_id'] = $journalTemplate['JournalTemplateDetail'][0]['account_id'];
                $journal[$start_index + $j]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index + $j]['journal_position_id'] = 1;
                $journal[$start_index + $j]['amount_db'] = $inlogDetail['InlogDetail']['amount'];
                $journal[$start_index + $j]['amount_cr'] = 0;
                $journal[$start_index + $j]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][0]['journal_template_id'];
                $journal[$start_index + $j]['source'] = $doc;
                $journal[$start_index + $j]['doc_id'] = $id;

                $journal[$start_index + $j + 1]['department_id'] = $dep_id;
                $journal[$start_index + $j + 1]['account_code'] = $departmentAccountCodes[$dep_id] . '.' . ACCOUNTCURRENCY_IDR_CODE . '.' . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['date'] = date("Y-m-d");
                $journal[$start_index + $j + 1]['account_id'] = $journalTemplate['JournalTemplateDetail'][1]['account_id'];
                $journal[$start_index + $j + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + $j + 1]['journal_position_id'] = 2;
                $journal[$start_index + $j + 1]['amount_db'] = 0;
                $journal[$start_index + $j + 1]['amount_cr'] = $inlogDetail['InlogDetail']['amount'];
                $journal[$start_index + $j + 1]['journal_template_id'] = $journalTemplate['JournalTemplateDetail'][1]['journal_template_id'];
                $journal[$start_index + $j + 1]['source'] = $doc;
                $journal[$start_index + $j + 1]['doc_id'] = $id;
            }
        }
//exit;		
        //echo '<pre>';
        //var_dump($journal);
        //echo '</pre>';die();

        if (isset($journal)) {
            $journalTransaction = new JournalTransaction;
        }

        //debug($journal);
        if (isset($journal)) {

            foreach ($journal as $journalSave) {
                $journalTransaction->create();
                $journalTransaction->save($journalSave);
            }
        }
    }

    function insert_to_journal_csv($doc = null, $id = null, $journal_group_id = null) {

        if ($doc == 'outlog') {
            $outlog = $this->Outlog->read(null, $id);
            $detil = $this->OutlogDetail->find('all', array('conditions' => array('OutlogDetail.outlog_id' => $id)));

            if ($outlog['Outlog']['department_id'] != KPNODEPARTMENT_ID)
                $journal_group_id = $this->recordRefererComponent->getIdByModelNameAndRefName('JournalGroup', 'journal_group_usage_id');
            else
                $journal_group_id = $this->recordRefererComponent->getIdByModelNameAndRefName('JournalGroup', 'journal_group_usage_kpno_id');

            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

            $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $outlogDetil) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $outlogDetil['Item']['asset_category_id']))
                );

                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));
                $i = 1;
                $count = 0;
                foreach ($journalTemplate['JournalTemplateDetail'] as $detil) {
                    $count += $i;
                }

                $j++;
                $start_index = $j * 4;

                //CHANGES RIC 2013-12-22
                $cost_center_data = '';
                $new_mapping_cost_centers = new CostCenterToDao;
                if ($accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] != '') {
                    $t24dao = $new_mapping_cost_centers->find('first', array('conditions' => array(
                            'cost_center_id' => $outlog['Outlog']['cost_center_id'],
                        ))
                    );
                    $cost_center_data = $t24dao['CostCenterToDao']['t24_dao'];
                }


                $journal[$start_index]['account_code'] = ''; //"IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch']==1?$outlog['Outlog']['department_id']:KPNODEPARTMENT_ID], 5);
                $journal[$start_index]['journal_position_id'] = "D";
                $journal[$start_index]['amount_lcy'] = $outlogDetil['OutlogDetail']['amount'] + 0;
                $journal[$start_index]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][0]['transaction_code_id'];
                $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['customer_id'] = '';
                $journal[$start_index]['account_officer'] = $cost_center_data;
                $journal[$start_index]['product_category'] = '';
                $journal[$start_index]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index]['currency'] = "IDR";
                $journal[$start_index]['amount_fcy'] = '';
                $journal[$start_index]['exchange_rate'] = '';
                $journal[$start_index]['position_type'] = '';
                $journal[$start_index]['reversal_marker'] = '';
                $journal[$start_index]['accounting_date'] = '';
                $journal[$start_index]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                $journal[$start_index + 1]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index + 1]['journal_position_id'] = "C";
                $journal[$start_index + 1]['amount_lcy'] = $outlogDetil['OutlogDetail']['amount'] + 0;
                $journal[$start_index + 1]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][1]['transaction_code_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['pl_category'] = ''; //$accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['customer_id'] = '';
                $journal[$start_index + 1]['account_officer'] = '';
                $journal[$start_index + 1]['product_category'] = '';
                $journal[$start_index + 1]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index + 1]['currency'] = "IDR";
                $journal[$start_index + 1]['amount_fcy'] = '';
                $journal[$start_index + 1]['exchange_rate'] = '';
                $journal[$start_index + 1]['position_type'] = '';
                $journal[$start_index + 1]['reversal_marker'] = '';
                $journal[$start_index + 1]['accounting_date'] = '';
                $journal[$start_index + 1]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                if ($count == 4) {

                    $journal[$start_index + 2]['account_code'] = ''; //"IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch']==1?$outlog['Outlog']['department_id']:KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 2]['journal_position_id'] = "D";
                    $journal[$start_index + 2]['amount_lcy'] = $outlogDetil['OutlogDetail']['amount'] + 0;
                    $journal[$start_index + 2]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][2]['transaction_code_id'];
                    $journal[$start_index + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['customer_id'] = '';
                    $journal[$start_index + 2]['account_officer'] = $cost_center_data;
                    $journal[$start_index + 2]['product_category'] = '';
                    $journal[$start_index + 2]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 2]['currency'] = "IDR";
                    $journal[$start_index + 2]['amount_fcy'] = '';
                    $journal[$start_index + 2]['exchange_rate'] = '';
                    $journal[$start_index + 2]['position_type'] = '';
                    $journal[$start_index + 2]['reversal_marker'] = '';
                    $journal[$start_index + 2]['accounting_date'] = '';
                    $journal[$start_index + 2]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                    $journal[$start_index + 3]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 3]['journal_position_id'] = "C";
                    $journal[$start_index + 3]['amount_lcy'] = $outlogDetil['OutlogDetail']['amount'] + 0;
                    $journal[$start_index + 3]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][3]['transaction_code_id'];
                    $journal[$start_index + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['pl_category'] = ''; //$accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['customer_id'] = '';
                    $journal[$start_index + 3]['account_officer'] = '';
                    $journal[$start_index + 3]['product_category'] = '';
                    $journal[$start_index + 3]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 3]['currency'] = "IDR";
                    $journal[$start_index + 3]['amount_fcy'] = '';
                    $journal[$start_index + 3]['exchange_rate'] = '';
                    $journal[$start_index + 3]['position_type'] = '';
                    $journal[$start_index + 3]['reversal_marker'] = '';
                    $journal[$start_index + 3]['accounting_date'] = '';
                    $journal[$start_index + 3]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];
                }
            }
        } else if ($doc == 'retur') {
            $retur = $this->Retur->read(null, $id);
            $detil = $this->ReturDetail->find('all', array('conditions' => array('ReturDetail.retur_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

            $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $returDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $returDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));

                $start_index++;
                $j++;

                $journal[$start_index]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index]['journal_position_id'] = "D";
                $journal[$start_index]['amount_lcy'] = $returDetail['ReturDetail']['amount'] + 0;
                $journal[$start_index]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][0]['transaction_code_id'];
                $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['customer_id'] = '';
                $journal[$start_index]['account_officer'] = '';
                $journal[$start_index]['product_category'] = '';
                $journal[$start_index]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index]['currency'] = "IDR";
                $journal[$start_index]['amount_fcy'] = '';
                $journal[$start_index]['exchange_rate'] = '';
                $journal[$start_index]['position_type'] = '';
                $journal[$start_index]['reversal_marker'] = '';
                $journal[$start_index]['accounting_date'] = '';
                $journal[$start_index]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                $journal[$start_index + 1]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index + 1]['journal_position_id'] = "C";
                $journal[$start_index + 1]['amount_lcy'] = $returDetail['ReturDetail']['amount'] + 0;
                $journal[$start_index + 1]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][1]['transaction_code_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['customer_id'] = '';
                $journal[$start_index + 1]['account_officer'] = '';
                $journal[$start_index + 1]['product_category'] = '';
                $journal[$start_index + 1]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index + 1]['currency'] = "IDR";
                $journal[$start_index + 1]['amount_fcy'] = '';
                $journal[$start_index + 1]['exchange_rate'] = '';
                $journal[$start_index + 1]['position_type'] = '';
                $journal[$start_index + 1]['reversal_marker'] = '';
                $journal[$start_index + 1]['accounting_date'] = '';
                $journal[$start_index + 1]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];
            }
        } else if ($doc == 'supplierRetur') {
            $supplierRetur = $this->SupplierRetur->read(null, $id);
            $detil = $this->SupplierReturDetail->find('all', array('conditions' => array('SupplierReturDetail.supplier_retur_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

            $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $supplierReturDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $supplierReturDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));

                $start_index++;
                $j++;

                $journal[$start_index]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index]['journal_position_id'] = "D";
                $journal[$start_index]['amount_lcy'] = $supplierReturDetail['SupplierReturDetail']['amount'] + 0;
                $journal[$start_index]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][0]['transaction_code_id'];
                $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['customer_id'] = '';
                $journal[$start_index]['account_officer'] = '';
                $journal[$start_index]['product_category'] = '';
                $journal[$start_index]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index]['currency'] = "IDR";
                $journal[$start_index]['amount_fcy'] = '';
                $journal[$start_index]['exchange_rate'] = '';
                $journal[$start_index]['position_type'] = '';
                $journal[$start_index]['reversal_marker'] = '';
                $journal[$start_index]['accounting_date'] = '';
                $journal[$start_index]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                $journal[$start_index + 1]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index + 1]['journal_position_id'] = "C";
                $journal[$start_index + 1]['amount_lcy'] = $supplierReturDetail['SupplierReturDetail']['amount'] + 0;
                $journal[$start_index + 1]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][1]['transaction_code_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['customer_id'] = '';
                $journal[$start_index + 1]['account_officer'] = '';
                $journal[$start_index + 1]['product_category'] = '';
                $journal[$start_index + 1]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index + 1]['currency'] = "IDR";
                $journal[$start_index + 1]['amount_fcy'] = '';
                $journal[$start_index + 1]['exchange_rate'] = '';
                $journal[$start_index + 1]['position_type'] = '';
                $journal[$start_index + 1]['reversal_marker'] = '';
                $journal[$start_index + 1]['accounting_date'] = '';
                $journal[$start_index + 1]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                if ($count == 4) {

                    $journal[$start_index + 2]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 2]['journal_position_id'] = "D";
                    $journal[$start_index + 2]['amount_lcy'] = $supplierReturDetail['OutlogDetail']['amount'] + 0;
                    $journal[$start_index + 2]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][2]['transaction_code_id'];
                    $journal[$start_index + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['customer_id'] = '';
                    $journal[$start_index + 2]['account_officer'] = '';
                    $journal[$start_index + 2]['product_category'] = '';
                    $journal[$start_index + 2]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 2]['currency'] = "IDR";
                    $journal[$start_index + 2]['amount_fcy'] = '';
                    $journal[$start_index + 2]['exchange_rate'] = '';
                    $journal[$start_index + 2]['position_type'] = '';
                    $journal[$start_index + 2]['reversal_marker'] = '';
                    $journal[$start_index + 2]['accounting_date'] = '';
                    $journal[$start_index + 2]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                    $journal[$start_index + 3]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 3]['journal_position_id'] = "C";
                    $journal[$start_index + 3]['amount_lcy'] = $supplierReturDetail['OutlogDetail']['amount'] + 0;
                    $journal[$start_index + 3]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][3]['transaction_code_id'];
                    $journal[$start_index + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['customer_id'] = '';
                    $journal[$start_index + 3]['account_officer'] = '';
                    $journal[$start_index + 3]['product_category'] = '';
                    $journal[$start_index + 3]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 3]['currency'] = "IDR";
                    $journal[$start_index + 3]['amount_fcy'] = '';
                    $journal[$start_index + 3]['exchange_rate'] = '';
                    $journal[$start_index + 3]['position_type'] = '';
                    $journal[$start_index + 3]['reversal_marker'] = '';
                    $journal[$start_index + 3]['accounting_date'] = '';
                    $journal[$start_index + 3]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];
                }
            }
        } else if ($doc == 'supplierReplace') {
            $supplierReplace = $this->SupplierReplace->read(null, $id);
            $detil = $this->SupplierReplaceDetail->find('all', array('conditions' => array('SupplierReplaceDetail.supplier_replace_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

            $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $supplierReplaceDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $supplierReplaceDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));

                $start_index++;
                $j++;

                $journal[$start_index]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index]['journal_position_id'] = "D";
                $journal[$start_index]['amount_lcy'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'] + 0;
                $journal[$start_index]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][0]['transaction_code_id'];
                $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['customer_id'] = '';
                $journal[$start_index]['account_officer'] = '';
                $journal[$start_index]['product_category'] = '';
                $journal[$start_index]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index]['currency'] = "IDR";
                $journal[$start_index]['amount_fcy'] = '';
                $journal[$start_index]['exchange_rate'] = '';
                $journal[$start_index]['position_type'] = '';
                $journal[$start_index]['reversal_marker'] = '';
                $journal[$start_index]['accounting_date'] = '';
                $journal[$start_index]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][0]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                $journal[$start_index + 1]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                $journal[$start_index + 1]['journal_position_id'] = "C";
                $journal[$start_index + 1]['amount_lcy'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'] + 0;
                $journal[$start_index + 1]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][1]['transaction_code_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['customer_id'] = '';
                $journal[$start_index + 1]['account_officer'] = '';
                $journal[$start_index + 1]['product_category'] = '';
                $journal[$start_index + 1]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index + 1]['currency'] = "IDR";
                $journal[$start_index + 1]['amount_fcy'] = '';
                $journal[$start_index + 1]['exchange_rate'] = '';
                $journal[$start_index + 1]['position_type'] = '';
                $journal[$start_index + 1]['reversal_marker'] = '';
                $journal[$start_index + 1]['accounting_date'] = '';
                $journal[$start_index + 1]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][1]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                if ($count == 4) {

                    $journal[$start_index + 2]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][2]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 2]['journal_position_id'] = "D";
                    $journal[$start_index + 2]['amount_lcy'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'] + 0;
                    $journal[$start_index + 2]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][2]['transaction_code_id'];
                    $journal[$start_index + 2]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][2]['account_id']];
                    $journal[$start_index + 2]['customer_id'] = '';
                    $journal[$start_index + 2]['account_officer'] = '';
                    $journal[$start_index + 2]['product_category'] = '';
                    $journal[$start_index + 2]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 2]['currency'] = "IDR";
                    $journal[$start_index + 2]['amount_fcy'] = '';
                    $journal[$start_index + 2]['exchange_rate'] = '';
                    $journal[$start_index + 2]['position_type'] = '';
                    $journal[$start_index + 2]['reversal_marker'] = '';
                    $journal[$start_index + 2]['accounting_date'] = '';
                    $journal[$start_index + 2]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][2]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];

                    $journal[$start_index + 3]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][3]['account_id']] . substr($departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID], 5);
                    $journal[$start_index + 3]['journal_position_id'] = "C";
                    $journal[$start_index + 3]['amount_lcy'] = $supplierReplaceDetail['SupplierReplaceDetail']['amount'] + 0;
                    $journal[$start_index + 3]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][3]['transaction_code_id'];
                    $journal[$start_index + 3]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['pl_category'] = $accountCodes[$journalTemplate['JournalTemplateDetail'][3]['account_id']];
                    $journal[$start_index + 3]['customer_id'] = '';
                    $journal[$start_index + 3]['account_officer'] = '';
                    $journal[$start_index + 3]['product_category'] = '';
                    $journal[$start_index + 3]['value_date'] = date('Y') . date('m') . date('d');
                    $journal[$start_index + 3]['currency'] = "IDR";
                    $journal[$start_index + 3]['amount_fcy'] = '';
                    $journal[$start_index + 3]['exchange_rate'] = '';
                    $journal[$start_index + 3]['position_type'] = '';
                    $journal[$start_index + 3]['reversal_marker'] = '';
                    $journal[$start_index + 3]['accounting_date'] = '';
                    $journal[$start_index + 3]['branch_code'] = $departmentAccountCodes[$journalTemplate['JournalTemplateDetail'][3]['for_destination_branch'] == 1 ? $outlog['Outlog']['department_id'] : KPNODEPARTMENT_ID];
                }
            }
        } else if ($doc == 'inlog') {

            //CHANGES RICKY 2013-12-22
            $Inlog = $this->Inlog->read(null, $id);
            $detil = $this->InlogDetail->find('all', array('conditions' => array('InlogDetail.inlog_id' => $id)));
            $account = new Account;
            $accountNames = $account->find('list', array('fields' => array('Account.name')));
            $accountCodes = $account->find('list', array('fields' => array('Account.t24_gl')));
            if ($accountCodes == null)
                $accountCodes = $account->find('list', array('fields' => array('Account.gl')));

            $seq = $account->find('list', array('fields' => array('Account.seq_t24')));
            $start_index = (-1);
            $j = (-1);
            foreach ($detil as $inlogDetail) {
                $journalTemp = new JournalTemplate;
                $journalTemplate = $journalTemp->find('first', array('conditions' => array(
                        'journal_group_id' => $journal_group_id,
                        'asset_category_id' => $inlogDetail['Item']['asset_category_id']))
                );
                $department = new Department;
                $departmentAccountCodes = $department->find('list', array('fields' => array('t24_account_code')));

                $start_index++;
                $j++;




                $journal[$start_index]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][0]['account_id']] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5);
                $journal[$start_index]['journal_position_id'] = "D";
                $journal[$start_index]['amount_lcy'] = $inlogDetail['InlogDetail']['amount'] + 0;
                $journal[$start_index]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][0]['transaction_code_id'];
                if (empty($journalTemplate['JournalTemplateDetail'][0]['account_id'])) {
                    $journal[$start_index]['account_name'] = '';
                } else {
                    $journal[$start_index]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][0]['account_id']]; // ERROR DI SINI
                }
                $journal[$start_index]['pl_category'] = ''; //$accountCodes[$journalTemplate['JournalTemplateDetail'][0]['account_id']];
                $journal[$start_index]['customer_id'] = '';
                $journal[$start_index]['account_officer'] = '';
                $journal[$start_index]['product_category'] = '';
                $journal[$start_index]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index]['currency'] = "IDR";
                $journal[$start_index]['amount_fcy'] = '';
                $journal[$start_index]['exchange_rate'] = '';
                $journal[$start_index]['position_type'] = '';
                $journal[$start_index]['reversal_marker'] = '';
                $journal[$start_index]['accounting_date'] = '';
                $journal[$start_index]['branch_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID];



                $journal[$start_index + 1]['account_code'] = "IDR" . $accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . $seq[$journalTemplate['JournalTemplateDetail'][1]['account_id']] . substr($departmentAccountCodes[KPNODEPARTMENT_ID], 5);
                $journal[$start_index + 1]['journal_position_id'] = "C";
                $journal[$start_index + 1]['amount_lcy'] = $inlogDetail['InlogDetail']['amount'] + 0;
                $journal[$start_index + 1]['transaction_code'] = $journalTemplate['JournalTemplateDetail'][1]['transaction_code_id'];
                $journal[$start_index + 1]['account_name'] = $accountNames[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['pl_category'] = ''; //$accountCodes[$journalTemplate['JournalTemplateDetail'][1]['account_id']];
                $journal[$start_index + 1]['customer_id'] = '';
                $journal[$start_index + 1]['account_officer'] = '';
                $journal[$start_index + 1]['product_category'] = '';
                $journal[$start_index + 1]['value_date'] = date('Y') . date('m') . date('d');
                $journal[$start_index + 1]['currency'] = "IDR";
                $journal[$start_index + 1]['amount_fcy'] = '';
                $journal[$start_index + 1]['exchange_rate'] = '';
                $journal[$start_index + 1]['position_type'] = '';
                $journal[$start_index + 1]['reversal_marker'] = '';
                $journal[$start_index + 1]['accounting_date'] = '';
                $journal[$start_index + 1]['branch_code'] = $departmentAccountCodes[KPNODEPARTMENT_ID];
            }
        }
        //debug($journal);
        if (isset($journal)) {
            return $journal;
        }
    }

}

?>