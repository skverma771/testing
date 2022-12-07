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
class SudopayIpnLogsController extends AppController
{
    var $name = 'SudopayIpnLogs';
    function admin_index() 
    {
        $this->pageTitle = __l('Zazpay IPN Logs');
        $this->paginate = array(
            'order' => array(
                'SudopayIpnLog.id' => 'desc'
            ) ,
            'recursive' => 0
        );
        $this->set('sudopayIpnLogs', $this->paginate());
    }
}
?>
