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
class PaymentGatewayData {

	public $table = 'payment_gateways';

	public $records = array(
		array(
			'id' => '2',
			'created' => '',
			'modified' => '2012-05-21 02:48:51',
			'name' => 'Wallet',
			'display_name' => 'Wallet',
			'description' => 'Payment within the website using user\'s account balance.',
			'gateway_fees' => '',
			'transaction_count' => '0',
			'payment_gateway_setting_count' => '0',
			'is_test_mode' => '1',
			'is_active' => '1',
			'is_mass_pay_enabled' => ''
		),
		array(
			'id' => '3',
			'created' => '2013-06-04 17:27:49',
			'modified' => '2013-06-04 17:27:49',
			'name' => 'SudoPay',
			'display_name' => 'SudoPay',
			'description' => 'Payment through SudoPay',
			'gateway_fees' => '2.90',
			'transaction_count' => '0',
			'payment_gateway_setting_count' => '0',
			'is_test_mode' => '1',
			'is_active' => '1',
			'is_mass_pay_enabled' => ''
		),
	);

}
