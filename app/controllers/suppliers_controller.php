<?php
class SuppliersController extends AppController {

	var $name = 'Suppliers';
	var $helpers = array('Number','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	
	function index() {
		$this->Supplier->recursive = 0;
		$bankAccountTypes=$this->Supplier->BankAccountType->find('list');
		$layout=$this->data['Supplier']['layout'];
		$this->set('bankAccountTypes', $bankAccountTypes);
		$copyright_id  = $this->configs['copyright_id'];
		$moduleName = 'Master Data > Supplier';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('copyright_id', 'moduleName'));
		$this->paginate = array('order'=>'Supplier.id');
		if($layout=='pdf' || $layout=='xls')
		{
			$con = $this->Supplier->find('all', array('order'=>'Supplier.id'));
		} else
		{
			$con = $this->paginate();
		}
		$this->set('suppliers', $con);
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('index_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('index_xls','export_xls');		
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('supplier', $this->Supplier->read(null, $id));
		$this->Session->write('Supplier.id',$id);     
		$bankAccountTypes=$this->Supplier->BankAccountType->find('list');
		$currencies=$this->Supplier->BankAccount->Currency->find('list');
		$this->set('bankAccountTypes', $bankAccountTypes);
		$this->set('currencies', $currencies);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Supplier->create();
			if ($this->Supplier->save($this->data)) {
				$this->Session->setFlash(__('The supplier has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier could not be saved. Please, try again.', true));
			}
		}
		$bankAccountTypes=$this->Supplier->BankAccountType->find('list');
		$this->set('bankAccountTypes', $bankAccountTypes);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Supplier->save($this->data)) {
				$this->Session->setFlash(__('The supplier has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Supplier->read(null, $id);
		}
		$bankAccountTypes=$this->Supplier->BankAccountType->find('list');
		$this->set('bankAccountTypes', $bankAccountTypes);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Supplier->delete($id)) {
			/************************************
			delete bank_account where supplier_id
			************************************/
			$sql = 'delete from bank_accounts where supplier_id="' . $id . '"';
			$this->log('deleting bank account: ' . $sql);
			$this->Supplier->query($sql);
			
			$this->Session->setFlash(__('Supplier deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Supplier was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function get_supplier_json()
	{
		if (!empty($this->data)) {
			$this->set('supplier',$this->Supplier->findById($this->data['Purchase']['supplier_id']));
		}
	}

	function get_supplier_info()
	{
		$this->autoRender = false;
		if (!empty($this->data)) {
			$sup = $this->Supplier->findById($this->data['Purchase']['supplier_id']);
			echo $sup['Supplier']['supplier_info'];
		}
	}
	
	function history() {
		//set up filters session
		if(!empty($this->data))
		{
			$this->Session->write('Supplier.supplier_id',$this->data['Supplier']['supplier_id']);
		}
		$layout=$this->data['Supplier']['layout'];
		//status
		$conditions[] = array('Po.po_status_id'=>status_po_sent_id);
		//is done filter
		if(DRIVER=='mysql') {
			$conditions[] = array('(SELECT if(sum(qty-qty_received)=0, 1, 0) FROM po_details WHERE po_details.po_id = Po.id) = 1' ); 
		}                
        elseif(DRIVER=='mssql') {
			$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = 1' );
		}
		
		//filters supplier_id
		$supplier_id=$this->Session->read('Supplier.supplier_id');
		$conditions[] = array('Po.supplier_id'=>$supplier_id);
		$this->paginate = array('order'=>'Supplier.id');
		///date fileter		
		list($date_start,$date_end) = $this->set_date_filters('Supplier');
		$conditions[] = array('po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		$copyright_id  = $this->configs['copyright_id'];
		$pos=$this->Supplier->Po->find('all', array('conditions'=>$conditions));
		$this->set('pos', $pos);
		$suppliers = $this->Supplier->find('list');
		$moduleName = 'Report > Supplier History';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('date_start', 'date_end', 'suppliers', 'copyright_id', 'moduleName'));	
		
		
				
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('history_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('history_xls','export_xls');		

		}

	}

	function auto_complete ()
	{
		$this->Supplier->recursive = 0;
		$this->set('suppliers',
			$this->Supplier->find('all',
				array('conditions'=>"
					Supplier.name LIKE '{$this->data['Supplier']['name']}%'
					
				"))
			);
		$this->layout = "ajax";
	}
	
	
	

}
?>