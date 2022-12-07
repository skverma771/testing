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
require_once 'constants.php';
CmsHook::setExceptionUrl(array(
    'sudopays/cancel_payment',
    'sudopays/success_payment',
    'sudopays/process_payment',
    'sudopays/process_ipn',
    'sudopays/update_account',
));
$pluginModel = array();
if (isPluginEnabled('Projects')) {
    $pluginModel = array(
        'ProjectFund' => array(
            'belongsTo' => array(
                'SudopayPaymentGateway' => array(
                    'className' => 'Sudopay.SudopayPaymentGateway',
                    'foreignKey' => 'sudopay_gateway_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'counterCache' => false
                ) ,
            ) ,
        ) ,
    );
}
CmsHook::bindModel($pluginModel);
?>