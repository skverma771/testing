<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */
class FormFieldGroupsController extends AppController
{
    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'FormFieldGroups';
    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array(
        'FormFieldGroup'
    );
    public function beforeFilter() 
    {
        $this->Security->validatePost = false;
        parent::beforeFilter();
    }
    public function admin_index($id = null) 
    {
        $this->pageTitle = __l('Form Field Groups');
        $this->paginate = array(
            'conditions' => array(
                'FormFieldGroup.project_type_id' => $id
            ) ,
            'order' => array(
                'FormFieldGroup.order' => 'ASC'
            ) ,
            'recursive' => -1
        );
        $this->set('FormFieldGroups', $this->paginate());
        $this->set('displayFields', $this->FormFieldGroup->displayFields());
    }
    public function admin_add() 
    {
        $this->pageTitle = sprintf(__l('Add %s') , __l('Form Field Group'));
        if (!empty($this->request->data)) {
            $this->FormFieldGroup->create();
            if ($this->FormFieldGroup->save($this->request->data)) {
                $this->Session->setFlash(sprintf(__l('%s has been added') , __l('Form Field Group')) , 'default', null, 'success');
                if ($this->RequestHandler->isAjax()) {
                    echo "success";
                    exit;
                } else {
                    $this->redirect(array(
                        'controller' => 'project_types',
                        'action' => 'edit',
                        $this->request->params['named']['type_id']
                    ));
                }
            } else {
                $this->Session->setFlash(sprintf(__l('%s could not be added. Please, try again.') , __l('Form Field Group')) , 'default', null, 'error');
            }
        } else {
            if (!empty($this->request->params['named']['type_id'])) {
                $this->request->data['FormFieldGroup']['project_type_id'] = $this->request->params['named']['type_id'];
            }
            if (!empty($this->request->params['named']['step_id'])) {
                $this->request->data['FormFieldGroup']['form_field_step_id'] = $this->request->params['named']['step_id'];
            }
        }
    }
    public function admin_edit($id = null) 
    {
        $this->pageTitle = sprintf(__l('Edit %s') , __l('Form Field Group'));
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(sprintf(__l('Invalid %s') , __l('Form Field Group')) , 'default', null, 'error');
            $this->redirect(array(
                'action' => 'index',
            ));
        }
        if (!empty($this->request->data)) {
            if ($this->FormFieldGroup->save($this->request->data)) {
                $this->Session->setFlash(sprintf(__l('%s has been updated') , __l('Form Field Group')) , 'default', null, 'success');
                if ($this->RequestHandler->isAjax()) {
                    echo "success";
                    exit;
                } else {
                    $this->redirect(array(
                        'controller' => 'project_types',
                        'action' => 'edit',
                        $this->request->data['FormFieldGroup']['project_type_id']
                    ));
                }
            } else {
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , __l('Form Field Group')) , 'default', null, 'error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->FormFieldGroup->read(null, $id);
        }
        $this->pageTitle.= ' - ' . $this->request->data['FormFieldGroup']['name'];
    }
    public function admin_delete($id = null) 
    {
        if (!$id) {
            $this->Session->setFlash(sprintf(__l('Invalid %s') , __l('Form Field Group')) , 'default', null, 'error');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $formFieldGroup = $this->FormFieldGroup->find('first', array(
            'conditions' => array(
                'FormFieldGroup.id' => $id,
                'FormFieldGroup.is_deletable' => 1
            ) ,
            'recursive' => -1
        ));
        if (empty($formFieldGroup)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->FormFieldGroup->delete($id)) {
            $this->loadModel('Projects.FormField');
            $form_fields = $this->FormField->find('all', array(
                'conditions' => array(
                    'FormField.form_field_group_id' => $id
                )
            ));
            foreach($form_fields as $form_field) {
                $this->FormField->delete($form_field['FormField']['id']);
            }
            $this->Session->setFlash(sprintf(__l('%s deleted') , __l('Form Field Group')) , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'project_types',
                'action' => 'edit',
                $formFieldGroup['FormFieldGroup']['project_type_id']
            ));
        }
    }
    public function admin_sort() 
    {
        if ($this->RequestHandler->isAjax()) {
            $order = 0;
            foreach($this->request->data['FormFieldGroup'] as $field) {
                $this->FormFieldGroup->create();
                $this->FormFieldGroup->id = $field['id'];
                $this->FormFieldGroup->saveField('order', $order);
                $order++;
            }
            $this->set('response', 'success');
            $this->render('../Elements/ajax_reponse');
        }
    }
}
