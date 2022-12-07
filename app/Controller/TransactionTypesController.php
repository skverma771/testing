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
class TransactionTypesController extends AppController
{
    var $name = 'TransactionTypes';
    function admin_index() 
    {
        $this->pageTitle = __l('Transaction Types');
        $this->TransactionType->recursive = -1;
        $this->set('transactionTypes', $this->paginate());
    }
    function admin_edit($id = null) 
    {
        $this->pageTitle = sprintf(__l('Edit %s') , __l('Transaction Type'));
        if (is_null($id)) {
            throw new NotFoundException();
        }
        if (!empty($this->request->data)) {
            if ($this->TransactionType->save($this->request->data)) {
                $this->Session->setFlash(sprintf(__l('%s has been updated') , __l('Transaction Type')) , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'transaction_types',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , __l('Transaction Type')) , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->TransactionType->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException();
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['TransactionType']['name'];
    }
}
?>