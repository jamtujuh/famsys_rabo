<?php

class StocksController extends AppController {

      var $name = 'Stocks';
      var $paginate = array(
          'limit' => 10,
          'order' => array(
              'Stock.id' => 'asc'
          )
      );

      function index($department_id=null) {
            $layout = $this->data['Stock']['layout'];

            $this->paginate = array(
                'Stock' =>
                array('limit' => 20,
                    'order' => array('Stock.id' => 'desc')/* ,
                    'fields' => array('Stock.*, Item.*,Department.*', 'sum(qty) as qty'),
                    'group' => array('Stock.item_id')) */
            ));

            if (!empty($this->data)) {
                  $department_id = $this->data['Stock']['department_id'];
            } else {
                  $department_id = $this->Session->read('Userinfo.department_id');
            }
            $this->Session->write('Stock.department_id', $department_id);

            $conditions[] = array('Stock.department_id' => $this->Session->read('Stock.department_id'));
            list($date_start, $date_end) = $this->set_date_filters('Stock');
            $conditions[] = array('Stock.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Stock.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            $this->Stock->recursive = 0;
            if ($layout == 'pdf' || $layout == 'xls') {
                  $stocks = $this->Stock->find('all', array('conditions' => $conditions,
                              'order' => array('Stock.id' => 'desc')
                              /*  ,
                              'fields' => array('Stock.*, Item.*,Department.*', 'sum(qty) as qty'),
                              'group' => array('Stock.item_id'))) */
                    ));
            } else {
                  $stocks = $this->paginate($conditions);
            }
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->Stock->Department->find('list');
            $this->set(compact('departments', 'department_id', 'date_start', 'date_end', 'copyright_id'));
            $this->set('stocks', $stocks);

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function history($item_id=null) {

            $layout = $this->data['Stock']['layout'];

            if (isset($this->data['Stock']['item_id']))
                  $item_id = $this->data['Stock']['item_id'];

            $item = $this->Stock->Item->read(null, $item_id);
            $item_name = $item['Item']['name'];

            $conditions[] = array('Stock.item_id' => $item_id);

            if ($department_id = $this->data['Stock']['department_id']) {
                  $conditions[] = array('Stock.department_id' => $department_id);
            }
            $department_id = $this->Session->read('Userinfo.department_id');

            list($date_start, $date_end) = $this->set_date_filters('Stock');
            $conditions[] = array('Stock.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Stock.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->Stock->Department->find('list');
            $outlog = $this->Stock->Outlog->find('list');
            $usage = $this->Stock->Usage->find('list');
            $retur = $this->Stock->Retur->find('list');
            $this->Stock->recursive = 0;

            if ($layout == 'pdf' || $layout == 'xls') {
                  $stocks = $this->Stock->find('list', array('conditions' => $conditions));
            } else {
                  $stocks = $this->paginate($conditions);
            }
            $this->set('stocks', $stocks);

            $this->set(compact('item_id', 'item_name', 'departments', 'department_id', 'date_start', 'date_end', 'outlog', 'usage', 'retur', 'copyright_id'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('history_pdf');
            } else if ($layout == 'xls') {
                  $this->render('history_xls', 'export_xls');
            }
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid stock', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->set('stock', $this->Stock->read(null, $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->Stock->create();
                  if ($this->Stock->save($this->data)) {
                        $this->Session->setFlash(__('The stock has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The stock could not be saved. Please, try again.', true));
                  }
            }
            $items = $this->Stock->Item->find('list');
            $outlogs = $this->Stock->Outlog->find('list');
            $usages = $this->Stock->Usage->find('list');
            $departments = $this->Stock->Department->find('list');
            $this->set(compact('items', 'outlogs', 'usages', 'departments'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid stock', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->Stock->save($this->data)) {
                        $this->Session->setFlash(__('The stock has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The stock could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->Stock->read(null, $id);
            }
            $items = $this->Stock->Item->find('list');
            $outlogs = $this->Stock->Outlog->find('list');
            $usages = $this->Stock->Usage->find('list');
            $departments = $this->Stock->Department->find('list');
            $this->set(compact('items', 'outlogs', 'usages', 'departments'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for stock', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->Stock->delete($id)) {
                  $this->Session->setFlash(__('Stock deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Stock was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

}

?>