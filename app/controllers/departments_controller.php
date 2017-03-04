<?php

class DepartmentsController extends AppController {

      var $name = 'Departments';
      var $helpers = array('Ajax', 'Javascript');

      function index() {
            $this->Department->recursive = 0;
			$this->paginate = array('order'=>'Department.id');
            $this->set('departments', $this->paginate());
			$moduleName = 'Master Data > Branch';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
			$this->set(compact('moduleName'));
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid department', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Department->recursive = 0;
            $this->Session->write('Department.id', $id);
            $this->set('department', $this->Department->read(null, $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->Department->create();
                  if ($this->Department->save($this->data)) {
                        $this->Session->setFlash(__('The department has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The department could not be saved. Please, try again.', true));
                  }
            }
            $businessTypes = $this->Department->BusinessType->find('list');
            $this->set(compact('businessTypes'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid department', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->Department->save($this->data)) {
                        $this->Session->setFlash(__('The department has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The department could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->Department->read(null, $id);
            }

            $businessTypes = $this->Department->BusinessType->find('list');
            $this->set(compact('businessTypes'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for department', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->Department->delete($id)) {
                  $this->Session->setFlash(__('Department deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Department was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function getDepartmentSubId($sender) {
            $this->layout = 'ajax';
            $this->set('options', $this->Department->DepartmentSub->find('list', array(
                        'conditions' => array(
                            'DepartmentSub.department_id' => $this->data[$sender]['department_id']
                        ),
                        'group' => array('DepartmentSub.name')
                            )
                    )
            );

            $this->render('/departments/ajax_dropdown');
      }

}

?>