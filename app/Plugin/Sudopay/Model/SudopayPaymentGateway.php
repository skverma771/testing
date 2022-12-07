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
class SudopayPaymentGateway extends AppModel
{
    public $name = 'SudopayPaymentGateway';
    public $displayField = '';
    public $actsAs = array(
        'Polymorphic' => array(
            'classField' => 'class',
            'foreignKey' => 'foreign_id',
        )
    );
    public $hasMany = array(
    		'SudopayPaymentGatewaysUser' => array(
    				'className' => 'Sudopay.SudopayPaymentGatewaysUser',
    				'foreignKey' => 'sudopay_payment_gateway_id',
    				'dependent' => true,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		)
    );
    public $belongsTo = array(
    		'SudopayPaymentGroup' => array(
    				'className' => 'Sudopay.SudopayPaymentGroup',
    				'foreignKey' => 'sudopay_payment_group_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'counterCache' => true,
    		) ,
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
    }
}
?>
