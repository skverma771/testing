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
class SudopayPaymentGatewaysUser extends AppModel
{
    public $name = 'SudopayPaymentGatewaysUser';
    public $actsAs = array(
        'SuspiciousWordsDetector' => array(
            'fields' => array(
                'description'
            )
        )
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
        ) ,
        'SudopayPaymentGateway' => array(
            'className' => 'Sudopay.SudopayPaymentGateway',
            'foreignKey' => 'sudopay_payment_gateway_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->_permanentCacheAssociations = array(
            'User',
            'SudopayPaymentGateway',
        );
    }
}
