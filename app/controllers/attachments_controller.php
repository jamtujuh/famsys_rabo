<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $is_ajax=false;
	
	function index() {
		$this->Attachment->recursive = 0;
		$this->paginate = array('order'=>'Attachment.id');
		$this->set('attachments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
	}
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}

	function add() {
		$msg=null;
		$attachment=null;
		$status=null;
		$count = 0;

		if (!empty($this->data)) {
		
			$file = $this->data['Attachment']['submittedfile'];
			if($file['error'] == 0 && $this->data['Attachment']['name'])
			{
				$path = 'files/';
				$random = uniqid().$file['name'];
				$uploadfile = $path.$random;
				$this->data['Attachment']['attachment_file_path'] 	= $path;
				$this->data['Attachment']['attachment_file_name'] 	= $random;
				$this->data['Attachment']['attachment_file_size'] 	= $file['size'];
				$this->data['Attachment']['attachment_content_type'] = $file['type'];
				
				if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
					$this->log('File is valid, and was successfully uploaded.');
				} else {
					$this->log('Possible file upload attack!');;
				}
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
				$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
			}
			
			$this->Attachment->create();
			if ($this->Attachment->save($this->data)) {
				if($this->is_ajax)
				{
					$npb_id = $this->data['Attachment']['npb_id'];
					$msg=__('The attachment has been saved', true);
					$status='ok';
					$attachment=$this->Attachment->read(null,$this->Attachment->id);
					$count = $this->Attachment->find('count', array('conditions'=>array('Npb.id'=>$npb_id)));
				}
				else
				{
					$this->Session->setFlash(__('The attachment has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$count = 0;
					$status='failed';
					$msg = __('The attachment could not be saved. Please, try again.', true);
				}
				else
				{
					$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
				}
			}
		}

		if($this->is_ajax)
		{
			$this->layout='ajax';
			$this->autoRender=false;
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$attachment, 'count'=>$count));
		}
		else
		{
			$npbs = $this->Attachment->Npb->find('list');
			$this->set(compact('npbs'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The attachment has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attachment->read(null, $id);
		}
		$npbs = $this->Attachment->Npb->find('list');
		$this->set(compact('npbs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		$attacment = $this->Attachment->read(null, $id);
		if ($this->Attachment->delete($id)) {
			unlink($attacment['Attachment']['attachment_file_path'].$attacment['Attachment']['attachment_file_name']);
			$this->Session->setFlash(__('Attachment deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'npbs','action'=>'view', $this->Session->read('Npb.id')));
		}
		$this->Session->setFlash(__('Attachment was not deleted', true));
		$this->redirect(array('controller'=>'npbs','action'=>'view', $this->Session->read('Npb.id')));
	}
}
?>