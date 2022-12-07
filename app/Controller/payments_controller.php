<?php
class PaymentsController extends AppController
{
    public $name = 'Payments';
    public $uses = array(
        'Payment',
        'PaypalAccount',
        'PaymentGateway',
    );
	 public function beforeFilter()
    {
		 $this->Security->disabledFields = array(
            'Payment.normal',
            'Payment.payment_gateway_id',
			'Payment.wallet',
			'Payment.user_paypal_connection_id',
			'Payment.connection',
			'Payment.paypal',
        );
		$this->Security->validatePost = false; 
        parent::beforeFilter();
    }
    public function order($id)
    {
        $this->pageTitle = __l('Order');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->loadModel('Project');
        $itemDetail = $this->Project->ProjectFund->find('first', array(
            'conditions' => array(
                'ProjectFund.id = ' => $id
            ) ,
            'contain' => array(
                'Project' => array(
                    'Attachment',
                    'User',
                ) ,
                'ProjectReward',
                'User',
            ) ,
            'recursive' => 2,
        ));
        $this->pageTitle.= ' - ' . $itemDetail['Project']['name'];
        if (empty($itemDetail) || (!empty($itemDetail) && $itemDetail['ProjectFund']['user_id'] != $this->Auth->user('id'))) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$payment_options = $this->Payment->getGatewayTypes('is_enable_for_pledge');
        $all_userPaypalConnections = $this->Project->User->UserPaypalConnection->find('all', array(
            'conditions' => array(
                'UserPaypalConnection.is_active' => 1,
                'UserPaypalConnection.user_id' => $this->Auth->user('id')
            ) ,
            'recursive' => - 1
        ));
        $userPaypalConnections = array();
        if (!empty($all_userPaypalConnections)) {
            foreach($all_userPaypalConnections as $userPaypalConnection) {
                $userPaypalConnections[$userPaypalConnection['UserPaypalConnection']['id']] = $userPaypalConnection['UserPaypalConnection']['sender_email'];
                if (!empty($userPaypalConnection['UserPaypalConnection']['is_default'])) {
                    $this->request->data['Payment']['user_paypal_connection_id'] = $userPaypalConnection['UserPaypalConnection']['id'];
                }
            }
        }
        $payment_gateway = $this->PaymentGateway->find('first', array(
            'conditions' => array(
                'PaymentGateway.id' => ConstPaymentGateways::PayPal,
            ) ,
            'contain' => array(
                'PaymentGatewaySetting' => array(
                    'fields' => array(
                        'PaymentGatewaySetting.key',
                        'PaymentGatewaySetting.test_mode_value',
                        'PaymentGatewaySetting.live_mode_value',
                    ) ,
                ) ,
            ) ,
            'recursive' => 1
        ));
        
        $gateway_fee = 0;// gateway fee is now not collected from user
        $total_amount = round($itemDetail['ProjectFund']['amount'] + $gateway_fee, 2);
		if (empty($this->request->data['Payment']['payment_gateway_id'])) {
            if (!empty($payment_options[ConstPaymentGateways::PayPal])) {
                $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
            }
			if (!empty($payment_options[ConstPaymentGateways::AuthorizeNet])) {
				$this->loadModel('City');
				$this->loadModel('State');
				$this->loadModel('Country');
				
				$this->Payment->validate = array_merge($this->Payment->validate, $this->Payment->validateCreditCard);
				$this->City->State->validate = array_merge($this->City->State->validate, $this->City->State->validateStateName);
				$this->request->data['User']['is_show_new_card'] = 0;
                $gateway_options['cities'] = $this->City->find('list', array(
                    'conditions' => array(
                        'City.is_approved =' => 1
                    ) ,
                    'fields' => array(
                        'City.name',
                        'City.name'
                    ) ,
                    'order' => array(
                        'City.name' => 'asc'
                    )
                ));
                $gateway_options['states'] =  $this->State->find('list', array(
                    'conditions' => array(
                        'State.is_approved =' => 1
                    ) ,
                    'fields' => array(
                        'State.code',
                        'State.name'
                    ) ,

                    'order' => array(
                        'State.name' => 'asc'
                    )
                ));
                $gateway_options['countries'] = $this->Country->find('list', array(
                    'fields' => array(
                        'Country.iso2',
                        'Country.name'
                    ) ,
                    'conditions' => array(
                        'Country.iso2 != ' => '',
                    ) ,
                    'order' => array(
                        'Country.esort' => 'desc',
						'Country.name' => 'asc'
                    ) ,
                ));
                $gateway_options['creditCardTypes'] = array(
                    'Visa' => __l('Visa') ,
                    'MasterCard' => __l('MasterCard') ,
                    'Discover' => __l('Discover') ,
                    'Amex' => __l('Amex')
                );
                if (empty($this->request->data['Payment']['payment_gateway_id'])) {
                    if (!empty($payment_options[ConstPaymentGateways::AuthorizeNet])) {
                        $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::AuthorizeNet;
                    }
                }
			}
        }
		if(!empty($this->request->params['named']['payment_gateway_id']))
		{
			$this->request->data['Payment']['payment_gateway_id']=$this->request->params['named']['payment_gateway_id'];
		}
		if (!$this->Auth->user()) {
            unset($gateway_options['paymentGateways'][ConstPaymentGateways::Wallet]);
        } else {
            $userPaymentProfiles = $this->Project->User->UserPaymentProfile->find('all', array(
                'fields' => array(
                    'UserPaymentProfile.masked_cc',
                    'UserPaymentProfile.name',
                    'UserPaymentProfile.cim_payment_profile_id',
                    'UserPaymentProfile.is_default',
                    'UserPaymentProfile.id',
                    'UserPaymentProfile.last_digit'
                ) ,
                'conditions' => array(
                    'UserPaymentProfile.user_id' => $this->Auth->user('id')
                ) ,
            ));			
            foreach($userPaymentProfiles as $userPaymentProfile) {
                $gateway_options['Paymentprofiles'][$userPaymentProfile['UserPaymentProfile']['cim_payment_profile_id']] = $userPaymentProfile['UserPaymentProfile']['masked_cc'] .'-'. $userPaymentProfile['UserPaymentProfile']['last_digit'];
                if (!empty($userPaymentProfile['UserPaymentProfile']['is_default'])) {
                    $this->request->data['Payment']['payment_profile_id'] = $userPaymentProfile['UserPaymentProfile']['cim_payment_profile_id'];
                }
            }
        }
		$user_info = $this->Project->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            ) ,
            'fields' => array(
                'User.id',
                'User.username',
				'User.cim_profile_id',
                'User.available_balance_amount',
                'User.available_wallet_amount',
            ) ,
            'recursive' => -1
        ));
        $gateway_options['paymentGateways'] = $payment_options;
		$this->set('user_info', $user_info);
		$this->set('gateway_options', $gateway_options);
        $this->set('payment_gateway', $payment_gateway);
        $this->set('gateway_fee', $gateway_fee);
        $this->set('total_amount', $total_amount);
        $this->set('itemDetail', $itemDetail);
        $this->set('userPaypalConnections', $userPaypalConnections);
        $this->set('userPaymentProfiles', $userPaymentProfiles);
        $this->request->data['Payment']['item_id'] = $id;
    }
    public function process_order()
    {
		$this->disableCache();
        $this->autoRender = false;
        $this->loadModel('Project');
        if (empty($this->request->data)) {
            throw new NotFoundException(__l('Invalid request'));
        } else {
            $projectfund = $this->Project->ProjectFund->find('first', array(
					'conditions' => array(
						'ProjectFund.id' => $this->request->data['Payment']['item_id']
					) ,
					'contain' => array(
						'Project',
						'ProjectReward'
					) ,
					'recursive' => 1
				));
			if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) {
                        $user = $this->Project->User->find('first', array(
                            'conditions' => array(
                                'User.id' => $this->Auth->user('id')
                            ) ,
                            'fields' => array(
                                'User.id',
                                'User.username',
                                'User.available_balance_amount',
                                'User.available_wallet_amount',
                            ) ,
                            'recursive' => -1
                        ));
                        if (empty($user)) {
                            throw new NotFoundException(__l('Invalid request'));
                        }
                        if ($user['User']['available_wallet_amount'] < ($this->request->data['Payment']['amount'])) {
                            $this->Session->setFlash(__l('Your wallet has insufficient money') , 'default', null, 'error');
                            $this->redirect(array(
								'controller' => 'payments',
								'action' => 'order',
								$projectfund['ProjectFund']['id'],
								'payment_gateway_id'=>ConstPaymentGateways::Wallet,
								
                            ));
                        }
                    }
			if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::PayPal) {
            if (!empty($this->request->data['Payment']['user_paypal_connection_id']) && !empty($this->request->data['Payment']['connection'])) {
                $userPaypalConnection = $this->Project->User->UserPaypalConnection->find('first', array(
                    'conditions' => array(
                        'UserPaypalConnection.id' => $this->request->data['Payment']['user_paypal_connection_id']
                    ) ,
                    'recursive' => - 1
                ));
                if (empty($userPaypalConnection)) {
                    throw new NotFoundException(__l('Invalid request'));
                }
                if (($userPaypalConnection['UserPaypalConnection']['amount'] - $userPaypalConnection['UserPaypalConnection']['charged_amount'] < $this->request->data['Payment']['amount'])) {
                    $this->Session->setFlash(sprintf('%s %s ', __l('Selected PayPal connection have insufficient money to order this') , 'project') , 'default', null, 'error');
                    if (empty($this->request->params['isAjax'])) {
                        $this->redirect(array(
                            'controller' => 'payments',
                            'action' => 'order',
                            $projectfund['ProjectFund']['id'],
                        ));
                    } else {
                        $ajax_url = Router::url(array(
                            'controller' => 'payments',
                            'action' => 'order',
                            $projectfund['ProjectFund']['id']
                        ) , true);
                        $success_msg = 'redirect*' . $ajax_url;
                        echo $success_msg;
                        exit;
                    }
                }
            }
			elseif ( !empty($this->request->data['Payment']['paypal'])) {
				unset($this->request->data['Payment']['user_paypal_connection_id']);
				}
			}
			//Newly integrated for authourizenet payment//
			if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::AuthorizeNet){
				if (!empty($this->request->data['State']['name'])) {
					$this->request->data['Payment']['state'] = $this->request->data['State']['name'];
					unset($this->request->data['State']);
				}
				if ($this->request->data['Payment']['is_show_new_card'] == 0) {
					$payment_gateway_id_validate = array(
						'payment_profile_id' => array(
							'rule1' => array(
								'rule' => 'notempty',
								'message' => __l('Required')
							)
						)
					);
					$this->Payment->validate = array_merge($this->Payment->validate, $payment_gateway_id_validate);
				}else{
					unset($this->request->data['Payment']['payment_profile_id']);
				}
				$this->Payment->validate = array_merge($this->Payment->validate, $this->Payment->validateCreditCard);
				$this->Project->City->State->validate = array_merge($this->Project->City->State->validate, $this->Project->City->State->validateStateName);
				$check_expire = $this->Payment->_checkExpiryMonthAndYear($this->request->data['Payment']['expDateMonth']['month'], $this->request->data['Payment']['expDateYear']['year']);
				if($this->Payment->validates() & $this->Project->City->State->validates() & $check_expire == 0){
                        $authorize_orginal_amount = $this->request->data['Payment']['amount'];
						//FOR AUTHORIZE.NET CURRENY CONVERSION NOW ITS NO NEED//
                        //$this->request->data['Payment']['amount'] = $this->Payment->_convertAuthorizeAmount($this->request->data['Payment']['amount']);
                        $user = $this->Project->User->find('first', array(
                            'conditions' => array(
                                'User.id' => $this->Auth->user('id')
                            ) ,
                            'fields' => array(
                                'User.id',
                                'User.cim_profile_id'
                            ),
							'recursive' => -1
                        ));
                        if (!empty($this->request->data['Payment']['creditCardNumber'])) {
                            //create payment profile
                            $data = $this->request->data['Payment'];
                            $data['expirationDate'] = $this->request->data['Payment']['expDateYear']['year'] . '-' . $this->request->data['Payment']['expDateMonth']['month'];
                            $data['customerProfileId'] = $user['User']['cim_profile_id'];							
                            $payment_profile_id = $this->Project->User->_createCimPaymentProfile($data);
							
							$this->log('$payment_profile_id');
							$this->log($payment_profile_id);
                            if (is_array($payment_profile_id) && !empty($payment_profile_id['payment_profile_id']) && !empty($payment_profile_id['masked_cc'])) {
                                $payment['UserPaymentProfile']['user_id'] = $this->Auth->user('id');
                                $payment['UserPaymentProfile']['cim_payment_profile_id'] = $payment_profile_id['payment_profile_id'];
                                $payment['UserPaymentProfile']['masked_cc'] = $payment_profile_id['masked_cc'];
                                $payment['UserPaymentProfile']['name'] = $payment_profile_id['name'];
                                $payment['UserPaymentProfile']['is_default'] = 0;
                                $payment['UserPaymentProfile']['last_digit'] = $payment_profile_id['last_digit'];
								$this->log('payment$payment new');
								$this->log($payment);
                                $this->loadModel('UserPaymentProfile');
								$this->UserPaymentProfile->create();
                                $this->UserPaymentProfile->save($payment);
                                $this->request->data['Payment']['payment_profile_id'] = $payment_profile_id['payment_profile_id'];
								
								/////////////NEWLY added///////////////
								$data['customerProfileId'] = $user['User']['cim_profile_id'];
								$data['customerPaymentProfileId'] = $this->request->data['Payment']['payment_profile_id'];
								$data['amount'] = $this->request->data['Payment']['amount'];
								$data['quantity'] = 1;
								$data['item_id'] = $this->request->data['Payment']['item_id'];
								$project_fund_id = $this->request->data['Payment']['item_id'];
								$response = $this->Project->User->_createCustomerProfileTransaction($data, 'profileTransAuthCapture');
							
								if (!empty($response['cim_approval_code']) && $response['capture'] == 1) {
									$this->Payment->processAuthorizenetOrderPayment($response, $project_fund_id);
									$this->redirect(array(
										'controller' => 'payments',
										'action' => 'success_order',
										'project',
										$project_fund_id,
									));
								} else {								
									$this->Session->setFlash(sprintf(__l('Gateway error1: %s <br>Note: Due to security reasons, error message from gateway may not be verbose. Please double check your card number, security number and address details. Also, check if you have enough balance in your card.') , $response['message']) , 'default', null, 'error');
									$this->redirect(array(
										'controller' => 'payments',
										'action' => 'order',
										$projectfund['ProjectFund']['id']
									));
								}
                            } else {
                                $this->Session->setFlash(sprintf(__l('Gateway error2: %s <br>Note: Due to security reasons, error message from gateway may not be verbose. Please double check your card number, security number and address details. Also, check if you have enough balance in your card.') , $payment_profile_id['message']) , 'default', null, 'error');
                                $this->redirect(array(
                                   'controller' => 'payments',
									'action' => 'order',
									$projectfund['ProjectFund']['id'],
                                ));
                            }
                        }
                      	if (!empty($this->request->data['Payment']['payment_profile_id'])) {							
                            $data['customerProfileId'] = $user['User']['cim_profile_id'];
                            $data['customerPaymentProfileId'] = $this->request->data['Payment']['payment_profile_id'];
                            $data['amount'] = $this->request->data['Payment']['amount'];
							$data['quantity'] = 1;
                            $data['item_id'] = $this->request->data['Payment']['item_id'];
							$project_fund_id = $this->request->data['Payment']['item_id'];
							$payment_profile_id = !empty($this->request->data['Payment']['payment_profile_id']) ? $this->request->data['Payment']['payment_profile_id'] : '';
							$response = $this->Project->User->_createCustomerProfileTransaction($data, 'profileTransAuthCapture');
                            if (!empty($response['cim_approval_code']) && $response['capture'] == 1) {
								$this->Payment->processAuthorizenetOrderPayment($response, $project_fund_id, $payment_profile_id);
								$this->redirect(array(
									'controller' => 'payments',
									'action' => 'success_order',
									'project',
									$project_fund_id,
								));
                            } else {								
								$this->Session->setFlash(sprintf(__l('Gateway error3: %s <br>Note: Due to security reasons, error message from gateway may not be verbose. Please double check your card number, security number and address details. Also, check if you have enough balance in your card.') , $response['message']) , 'default', null, 'error');
								$this->redirect(array(
									'controller' => 'payments',
									'action' => 'order',
									$projectfund['ProjectFund']['id']
								));
                            }
                        } else {
							$this->Session->setFlash(__l('Credit card could not be updated. Please, try again.') , 'default', null, 'error');
							$this->redirect(array(
								'controller' => 'payments',
								'action' => 'order',
								$projectfund['ProjectFund']['id']
							));
                        }
            	}else{
					if(!empty($check_expire)){
						$this->set('check_expire', $check_expire);
					}
					$this->Session->setFlash(__l('Credit card could not be updated. Please, try again.') , 'default', null, 'error');
					$this->redirect(array(
						'controller' => 'payments',
						'action' => 'order',
						$projectfund['ProjectFund']['id'],
					));
				}
			}
            $return = $this->Payment->processOrder($this->request->data['Payment']);
            if (empty($return['error'])) {

			if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::PayPal) {
                if ((!empty($this->request->data['Payment']['user_paypal_connection_id'])) && (!empty($this->request->data['Payment']['connection']))) {
                    $this->Payment->processOrderPayment($return['order_id']);
                    $this->redirect(array(
                        'controller' => 'payments',
                        'action' => 'success_order',
						'project',
                        $projectfund['ProjectFund']['id']
                    ));
                }
			 }else if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) {
			       if(($projectfund['Project']['project_status_id'] == ConstProjectStatus::ReserveAmountReached) || ($projectfund['Project']['project_status_id'] == ConstProjectStatus::GoalReached))
				   {
					   $this->Session->setFlash(__l('Your payment is successful.') , 'default', null, 'success');
				   }
				   else
				   {
			           $this->Session->setFlash(__l('Your donation was successful.') , 'default', null, 'success');
				   }
					$project = $this->Project->find('first', array(
					'conditions' => array(
						'Project.id' => $projectfund['ProjectFund']['project_id']
					) ,
					'fields' => array(
						'Project.slug',
					) ,
					'recursive' => -1
				));
					 $this->redirect(array(
						'controller' => 'projects',
						'action' => 'view',
						$project['Project']['slug']
                ) , true);
					}
            } else {
                $this->Session->setFlash($return['error_message'] . __l('. Your payment could not be completed') , 'default', null, 'error');
                if (empty($this->request->params['isAjax'])) {
                    $this->redirect(array(
                        'controller' => 'payments',
                        'action' => 'order',
                        $projectfund['ProjectFund']['id']
                    ));
                } else {
                    $ajax_url = Router::url(array(
                        'controller' => 'payments',
                        'action' => 'order',
                        $projectfund['ProjectFund']['id']
                    ) , true);
                    $success_msg = 'redirect*' . $ajax_url;
                    echo $success_msg;
                    exit;
                }
            }
        }
    }
	public function success_order($type, $order_id)
    {
        $this->log('Success Order');
        $this->pageTitle = __l('Payment Success');
        $this->Session->setFlash(__l('Your payment has been received') , 'default', null, 'success');
        switch ($type) {
            case 'project':
				//$this->Session->setFlash(__l('Project Fund has been added') , 'default', null, 'success');
				$this->loadModel('Project');
				$projectFund = $this->Project->ProjectFund->find('first', array(
					'conditions' => array(
						'ProjectFund.id' => $order_id
					) ,
					'contain' => array(
						'Project',
						'ProjectReward'
					) ,
					'recursive' => 1
				));
				$this->log($projectFund);
				if(!empty($projectFund) && $projectFund['ProjectFund']['payment_gateway_id'] != ConstPaymentGateways::AuthorizeNet){
					$this->Payment->processOrderPayment($order_id);
				}
				if(!empty($projectFund['Project']['project_status_id']) && ($projectFund['Project']['project_status_id'] == ConstProjectStatus::ReserveAmountReached) || ($projectFund['Project']['project_status_id'] == ConstProjectStatus::GoalReached)){
                    $this->Session->setFlash(__l('Your payment is successful.') , 'default', null, 'success');
                }
                else
                {
                    $this->Session->setFlash(__l('Your donation was successful.') , 'default', null, 'success');
                }
				if (!empty($projectFund['ProjectReward']['id'])) {
					$redirect = Router::url(array(
						'controller' => 'project_funds',
						'action' => 'view',
						$projectFund['ProjectFund']['id']
					), true);
				} else {
					$this->log('im erhe');
					$redirect = Router::url(array(
						'controller' => 'projects',
						'action' => 'view',
						$projectFund['Project']['slug']
					), true);
				}
				break;
			case 'user':
                $this->Payment->processUserWalletPayment($order_id);
				$this->Session->setFlash(__l('Amount has been added in wallet') , 'default', null, 'success');
                $redirect = Router::url(array(
                    'controller' => 'users',
                    'action' => 'add_to_wallet',
                ) , true);
                break;
        }
        if (Configure::read('paypal.is_embedded_payment_enabled')) {
            $this->set('redirect', $redirect);
        } else {
            $this->redirect($redirect);
        }
    }
	public function cancel_order($type, $order_id)
    {
        $this->log('Cancel Order');
        $this->pageTitle = __l('Payment Cancel');
        $this->Session->setFlash(__l('Your payment has been canceled') , 'default', null, 'success');
        switch ($type) {
            case 'project':
                    $this->loadModel('Project');
					$projectFund = $this->Project->ProjectFund->find('first', array(
						'conditions' => array(
							'ProjectFund.id' => $order_id
						) ,
						'contain' => array(
							'Project',
						) ,
						'recursive' => 1
					));
					 $redirect = Router::url(array(
						'controller' => 'projects',
						'action' => 'view',
						$projectFund['Project']['slug']
					));                
					break;

            case 'user':
                $redirect = Router::url(array(
                    'controller' => 'users',
                    'action' => 'add_to_wallet',
                ) , true);
                break;
        }
        $this->redirect($redirect);
    }
    public function processpayment($type, $order_id, $is_from_paypal = ConstResponseFrom::site)
    {
        $this->log('Process payment');
        $this->log('ipn starts');
            $this->log(print_r($_POST, true));
            $this->log($type);
            $this->log($order_id);
            $this->log('ipn ends');
        switch ($type) {
            case 'project':
                $this->Payment->processOrderPayment($order_id, $is_from_paypal);
                break;

            case 'user':
                $this->Payment->processUserWalletPayment($order_id);
                break;
        }
       $this->autoRender = false;
    }
    public function connect($user_id = null)
    {
        if (is_null($user_id)) {
            $user_id = $this->Auth->user('id');
        }
        $this->Payment->processPaypalConnect($user_id);
        $this->autoRender = false;
    }
    public function success_connect($user_paypal_connection_id)
    {
        $this->pageTitle = __l('Payment Success');
        $this->_processPaypalConnection($user_paypal_connection_id);
        $this->Session->setFlash(__l('You have connected with PayPal successfully') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'user_paypal_connections',
            'action' => 'index',
        ));
        $this->autoRender = false;
    }
    public function cancel_connect($user_paypal_connection_id)
    {
        $this->pageTitle = __l('Payment Cancel');
        $this->Session->setFlash(__l('Your connection has been cancelled.') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'user_paypal_connections',
            'action' => 'index',
        ));
        $this->autoRender = false;
    }
    public function _processPaypalConnection($user_paypal_connection_id)
    {
        $this->loadModel('User');
        $userPaypalConnection = $this->User->UserPaypalConnection->find('first', array(
            'conditions' => array(
                'UserPaypalConnection.id' => $user_paypal_connection_id
            ) ,
            'recursive' => - 1
        ));
        if (empty($userPaypalConnection)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $paypalConnection = $this->Payment->getPreapprovalDetails($userPaypalConnection['UserPaypalConnection']['pre_approval_key']);
        if (empty($paypalConnection)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($paypalConnection['approved'] == 'true' && strtoupper($paypalConnection['status']) == 'ACTIVE') {
            $this->Payment->updateUserConnection($paypalConnection, $userPaypalConnection);
        }
    }
    public function processconnect($user_paypal_connection_id)
    {
        $this->autoRender = false;
        $this->_processPaypalConnection($user_paypal_connection_id);
    }
    public function create_paypal_account($user_id = null)
    {
        $this->pageTitle = __l('Create Paypal Account');
        if (!empty($this->request->data)) {
            $this->PaypalAccount->create();
            $this->request->data['PaypalAccount']['currency_code'] = Configure::read('site.currency_code');
            if ($this->PaypalAccount->save($this->request->data)) {
                $paypalAccount = $this->PaypalAccount->find('first', array(
                    'conditions' => array(
                        'PaypalAccount.id = ' => $this->PaypalAccount->id
                    ) ,
                    'contain' => array(
                        'PaypalCountry' => array(
                            'fields' => array(
                                'PaypalCountry.name',
                                'PaypalCountry.code'
                            )
                        ) ,
                        'PaypalCitizenshipCountry' => array(
                            'fields' => array(
                                'PaypalCitizenshipCountry.name',
                                'PaypalCitizenshipCountry.code'
                            )
                        ) ,
                    )
                ));
                $return = $this->Payment->createPaypalAccount($paypalAccount);
                if (!empty($return['error'])) {
                    $this->PaypalAccount->delete($this->PaypalAccount->id);
                    $this->Session->setFlash($return['error_message'], 'default', null, 'error');
                } else {
                    $this->Session->setFlash(__l('PayPal Account has been added') , 'default', null, 'success');
                }
            } else {
                $this->Session->setFlash(__l('PayPal Account could not be created. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->loadModel('User');
            if (empty($user_id)) {
                $user_id = $this->Auth->user('id');
            }
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id
                ) ,
                'contain' => array(
                    'UserProfile'
                ) ,
                'recursive' => 0
            ));
            $this->request->data['PaypalAccount']['email'] = $user['User']['email'];
            $this->request->data['PaypalAccount']['user_id'] = $user['User']['id'];
            $this->request->data['PaypalAccount']['first_name'] = $user['UserProfile']['first_name'];
            $this->request->data['PaypalAccount']['last_name'] = $user['UserProfile']['last_name'];
            $this->request->data['PaypalAccount']['zip'] = $user['UserProfile']['zip_code'];
            $this->request->data['PaypalAccount']['dob'] = $user['UserProfile']['dob'];
        }
        $this->PaypalAccount->validate;
        $this->set('referralURL', $this->Payment->getMerchantReferralURL());
        $paypalCountries = $this->PaypalAccount->PaypalCountry->find('list');
        $paypalCitizenshipCountries = $this->PaypalAccount->PaypalCitizenshipCountry->find('list');
        $this->set(compact('paypalCountries', 'paypalCitizenshipCountries'));
    }
    public function success_account()
    {
        $this->pageTitle = __l('Create Paypal Account Success');
        $this->Session->setFlash(__l('Your paypal account has been created successfully') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'gigs',
            'action' => 'index',
        ));
        $this->autoRender = false;
    }
    public function cancel_account()
    {
        $this->pageTitle = __l('Create Paypal Account Cancel');
        $this->Session->setFlash(__l('Your paypal account creation has been cancelled.') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'gigs',
            'action' => 'index',
        ));
        $this->autoRender = false;
    }
    public function project_pay_now($project_id = null)
    {
        $this->pageTitle = __l('Pay Now');
        $this->loadModel('Project');

        if (!empty($this->request->data['Project']['id'])) {
            $project_id = $this->request->data['Project']['id'];
        }
        if (is_null($project_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id = ' => $project_id,
                'Project.project_status_id = ' => ConstProjectStatus::Pending,
            ) ,
            'fields' => array(
                'Project.id',
                'Project.name',
                'Project.slug',
                'Project.needed_amount',
                'Project.user_id'
            ) ,
            'recursive' => - 1,
        ));
        if (empty($project) || (!empty($project) && $project['Project']['user_id'] != $this->Auth->user('id'))) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (Configure::read('Project.project_listing_fee_type') == 'amount') {
            $total_amount = Configure::read('Project.listing_fee');
        } else {
            $total_amount = $project['Project']['needed_amount'] * (Configure::read('Project.listing_fee') / 100);
            $total_amount = round($total_amount, 2);
        }
        if (!empty($this->request->data)) {
			if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) {
                        $user = $this->Project->User->find('first', array(
                            'conditions' => array(
                                'User.id' => $this->Auth->user('id')
                            ) ,
                            'fields' => array(
                                'User.id',
                                'User.username',
                                'User.available_balance_amount',
                                'User.available_wallet_amount',
                            ) ,
                            'recursive' => -1
                        ));
                        if (empty($user)) {
                            throw new NotFoundException(__l('Invalid request'));
                        }
                        if ($user['User']['available_wallet_amount'] < ($total_amount)) {
                            $this->Session->setFlash(__l('Your wallet has insufficient money') , 'default', null, 'error');
                            $this->redirect(array(
                                'controller' => 'payments',
                                'action' => 'project_pay_now',
                                $this->request->data['Project']['id'],
                                'payment_gateway_id' => $this->request->data['Payment']['payment_gateway_id']
                            ));
                        }
                    }
            $data['project_id'] = $this->request->data['Project']['id'];
            $data['amount'] = $total_amount;
			$data['payment_gateway_id'] = $this->request->data['Payment']['payment_gateway_id'];
            $return = $this->Payment->payProject($data);
            var_dump($this->Payment);
            die();
            $this->log($return);
            if (!empty($return['error'])) {
                $this->Session->setFlash(__l('Payment could not be completed.') , 'default', null, 'error');
            }
			else
			{
				if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet){
				$this->success_projectpayment($data['project_id'],$data['payment_gateway_id']);
				}
			}
        } else {
            $this->request->data = $project;
        }
		$payment_options = $this->Payment->getGatewayTypes('is_enable_for_project');
        if (empty($this->request->data['Payment']['payment_gateway_id'])) {
            if (!empty($payment_options[ConstPaymentGateways::PayPal])) {
                $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
            } 
        }
		$user_info = $this->Project->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            ) ,
            'fields' => array(
                'User.id',
                'User.username',
                'User.available_balance_amount',
                'User.available_wallet_amount',
            ) ,
            'recursive' => -1
        ));

        $all_userPaypalConnections = $this->Project->User->UserPaypalConnection->find('all', array(
            'conditions' => array(
                'UserPaypalConnection.is_active' => 1,
                'UserPaypalConnection.user_id' => $this->Auth->user('id')
            ) ,
            'recursive' => - 1
        ));
        $userPaypalConnections = array();
        if (!empty($all_userPaypalConnections)) {
            foreach($all_userPaypalConnections as $userPaypalConnection) {
                $userPaypalConnections[$userPaypalConnection['UserPaypalConnection']['id']] = $userPaypalConnection['UserPaypalConnection']['sender_email'];
                if (!empty($userPaypalConnection['UserPaypalConnection']['is_default'])) {
                    $this->request->data['Payment']['user_paypal_connection_id'] = $userPaypalConnection['UserPaypalConnection']['id'];
                }
            }
        }
        
        $gateway_options['paymentGateways'] = $payment_options;
		$this->set('user_info', $user_info);
		$this->set('gateway_options', $gateway_options);
        $this->set('userPaypalConnections', $userPaypalConnections);
        $this->set('total_amount', $total_amount);
    }
    public function processprojectpayment($project_id)
    {
        $this->Payment->processProjectPayment($project_id);
        $this->autoRender = false;
    }
    public function success_projectpayment($project_id, $gateway_id = null)
    {
        $this->log('Success Project payment');
        $this->loadModel('Project');
		if (empty($gateway_id)) {
			$gateway_id = ConstPaymentGateways::PayPal;
		}
        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id = ' => $project_id,
            ) ,
            'fields' => array(
                'Project.id',
                'Project.name',
                'Project.slug',
                'Project.admin_suspend',
                'Project.project_status_id',
            ) ,
            'recursive' => - 1,
        ));
		if ($gateway_id == ConstPaymentGateways::PayPal) {
			$this->Payment->processProjectPayment($project_id);
		}
		
		
		// tim2015
		$tempuser = $this->Html->getCurrUserInfo($this->Auth->user('id'));		
		
        if ($project['Project']['admin_suspend']) {
            $this->Session->setFlash(__l('Project has been suspended, due to some bad words.') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'dashboard',
                'admin' => false
            ));
        } else {
			if (Configure::read('Project.is_auto_approve') || $tempuser['User']['is_charity_approved'] == 1) {
				if (Configure::read('Project.is_enable_idea')) {
	                $this->Session->setFlash(__l('Payment has been successfully completed. Now your idea has been opened for voting.') , 'default', null, 'success');
				} else {
					$this->Session->setFlash(__l('Payment has been successfully completed. Now your project has been opened for funding.') , 'default', null, 'success');
				}
            } else {
				if (Configure::read('Project.is_enable_idea')) {
	                $this->Session->setFlash(__l('Payment has been successfully completed. It will be available for voting once admin approve your idea.') , 'default', null, 'success');
				} else {
					$this->Session->setFlash(__l('Payment has been successfully completed. It will be available for funding once admin approve your project.') , 'default', null, 'success');
				}
            }
            $this->redirect(array(
                'controller' => 'projects',
                'action' => 'view',
                $project['Project']['slug'],
                'admin' => false
            ));
        }
        $this->autoRender = false;
    }
    public function cancel_projectpayment($project_id)
    {
        $this->log('cancel project payment');
        $this->Session->setFlash(__l('Payment Failed. Please, try again') , 'default', null, 'error');
        $this->loadModel('Project');
        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id = ' => $project_id,
            ) ,
            'fields' => array(
                'Project.id',
                'Project.name',
                'Project.slug',
            ) ,
            'recursive' => - 1,
        ));
        $this->redirect(array(
            'controller' => 'projects',
            'action' => 'view',
            $project['Project']['slug']
        ));
        $this->autoRender = false;
    }
    public function admin_sitepaymentbalance()
    {
        $this->set('paypal_balance', $this->Payment->getBalance());
    }
    public function user_pay_now($user_id = null, $hash = null)
    {
        $this->pageTitle = __l('Pay Sign Up Fee');
        $this->loadModel('User');

        if (!empty($this->request->data['User']['id'])) {
            $user_id = $this->request->data['User']['id'];
        }
        if (is_null($user_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
	 if ($this->User->isValidActivateHash($user_id, $hash)) {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id = ' => $user_id,
                'User.is_active' => '0',
            ) ,
            'fields' => array(
                'User.id',
                'User.username',
            ) ,
            'recursive' => - 1,
        ));
        if (empty($user)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $total_amount = round(Configure::read('User.signup_fee') , 2);
        if (!empty($this->request->data)) {
            $data['user_id'] = $this->request->data['User']['id'];
            $data['amount'] = $total_amount;
            $return = $this->Payment->payUser($data);
            if (!empty($return['error'])) {
                $this->Session->setFlash(__l('Payment could not be completed.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $user;
        }
        $this->set('total_amount', $total_amount);
		 } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function processuserpayment($user_id)
    {
        $this->log('ipn user starts');
            $this->log(print_r($_POST, true));
            $this->log('ipn user ends');
        
        $this->Payment->processUserPayment($user_id);
        $this->autoRender = false;
        exit;
    }
    public function success_userpayment($user_id)
    {
        $this->log('Success user payment');
        $this->log('ipn succss starts');
            $this->log(print_r($_POST, true));
            $this->log('ipn success ends');
		if (is_null($user_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->loadModel('User');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ) ,
            'recursive' => -1
        ));
		if (empty($user)) {
			throw new NotFoundException(__l('Invalid request'));
		}
        $this->Payment->processUserPayment($user_id);
        $this->Session->setFlash(__l('Payment has been successfully completed.') , 'default', null, 'success');
        $this->request->data['User']['username'] = $user['User']['username'];
        $this->request->data['User']['email'] = $user['User']['email'];
        $this->request->data['User']['password'] = $user['User']['password'];
		if (!empty($user['User']['is_gmail_register']) || !empty($user['User']['is_yahoo_register']) || !empty($user['User']['is_openid_register']) || !empty($user['User']['fb_user_id']) || !empty($user['User']['twitter_user_id'])) {
            if ($this->Auth->login($this->request->data)) {
				$this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'index',
                    'type' => 'home'
                ));
            }
        } else {
            //For openid register no need to send the activation mail, so this code placed in the else
            if (Configure::read('user.is_email_verification_for_register') && empty($user['User']['is_paid'])) {
                $this->Session->setFlash(__l('You have successfully registered with our site and your activation mail has been sent to your mail inbox.') , 'default', null, 'success');
                $this->User->_sendActivationMail($user['User']['email'], $user['User']['id'], $this->User->getActivateHash($user['User']['id']));
            }
        }
		// tim2016 splitting welcome emails
		// assuming this won't be used because signup is free
		// but if it is, only donors pay money, so they're not a nonprofit
        // send welcome mail to user if is_welcome_mail_after_register is true
        if (!Configure::read('user.is_email_verification_for_register') and !Configure::read('user.is_admin_activate_after_register') and Configure::read('user.is_welcome_mail_after_register')) {
            $this->User->_sendWelcomeMail($user['User']['id'], $user['User']['email'], $user['User']['username'], false);
        }
        if (!Configure::read('user.is_email_verification_for_register') and Configure::read('user.is_auto_login_after_register')) {
            $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
            if ($this->Auth->login($this->request->data)) {
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'index',
                    'type' => 'home'
                ));
            }
        }
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'login'
        ));
        $this->autoRender = false;
    }
    public function cancel_userpayment($user_id)
    {
        $this->log('Cancel user payment');
        $this->Session->setFlash(__l('Payment Failed. Please, try again') , 'default', null, 'error');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'register',
        ));
        $this->autoRender = false;
    }
}
?>