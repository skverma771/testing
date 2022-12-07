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
class SudopayTransactionLogsController extends AppController
{
    public $name = 'SudopayTransactionLogs';
    public function admin_index($class = '', $foreign_id = '') 
    {
        $this->pageTitle = __l('Zazpay Transaction Logs');
        $conditions = array();
        if (!empty($class)) {
            $conditions['SudopayTransactionLog.class'] = Inflector::classify($class);
        }
        if (!empty($foreign_id)) {
            $conditions['SudopayTransactionLog.foreign_id'] = $foreign_id;
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array(
                'SudopayTransactionLog.id' => 'desc'
            ) ,
            'recursive' => 0
        );
        $this->set('sudopayTransactionLogs', $this->paginate());
    }
    public function admin_view($id = null) 
    {
        $this->pageTitle = __l('Zazpay Transaction Log');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $sudopayTransactionLog = $this->SudopayTransactionLog->find('first', array(
            'conditions' => array(
                'SudopayTransactionLog.id = ' => $id
            ) ,
            'recursive' => 0,
        ));
        if (empty($sudopayTransactionLog)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $sudopayTransactionLog['SudopayTransactionLog']['id'];
        $this->set('sudopayTransactionLog', $sudopayTransactionLog);
    }
}
?>
