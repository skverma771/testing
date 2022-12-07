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
class PaymentsController extends AppController
{
	public $name = 'Payments';
	public function beforeFilter()
	{
		$this->Security->disabledFields = array(
				'User.normal',
				'User.payment_gateway_id',
				'User.wallet',
				'User.payment_id',
				'User.gateway_method_id',
				'Sudopay'
		);
		parent::beforeFilter();
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
							'User.is_paid' => 0,
					) ,
					'fields' => array(
							'User.id',
							'User.username',
					) ,
					'recursive' => -1,
			));
			if (empty($user)) {
				throw new NotFoundException(__l('Invalid request'));
			}
			$total_amount = round(Configure::read('User.signup_fee') , 2);
			if (!empty($this->request->data)) {
				//print_r($this->request->data); exit;
				$this->request->data['User']['sudopay_gateway_id'] = 0;
				if ($this->request->data['User']['payment_gateway_id'] != ConstPaymentGateways::Wallet && strpos($this->request->data['User']['payment_gateway_id'], 'sp_') >= 0) {
					$this->request->data['User']['sudopay_gateway_id'] = str_replace('sp_', '', $this->request->data['User']['payment_gateway_id']);
					$this->request->data['User']['payment_gateway_id'] = ConstPaymentGateways::SudoPay;
				}
				$_data = array();
				$_data['User']['id'] = $this->request->data['User']['id'];
				$_data['User']['sudopay_gateway_id'] = $this->request->data['User']['sudopay_gateway_id'];
				
				$this->User->save($_data);
				$data['user_id'] = $this->request->data['User']['id'];
				$data['amount'] = $total_amount;
				if ($this->request->data['User']['payment_gateway_id'] == ConstPaymentGateways::SudoPay) {
					$this->loadModel('Sudopay.Sudopay');
					$sudopay_gateway_settings = $this->Sudopay->GetSudoPayGatewaySettings();
					$this->set('sudopay_gateway_settings', $sudopay_gateway_settings);
					if ($sudopay_gateway_settings['is_payment_via_api'] == ConstBrandType::VisibleBranding) {
						$sudopay_data = $this->Sudopay->getSudoPayPostData($this->request->data['User']['id'], ConstPaymentType::Signup);
						$sudopay_data['merchant_id'] = $sudopay_gateway_settings['sudopay_merchant_id'];
						$sudopay_data['website_id'] = $sudopay_gateway_settings['sudopay_website_id'];
						$sudopay_data['secret_string'] = $sudopay_gateway_settings['sudopay_secret_string'];
						$sudopay_data['action'] = 'capture';
						$this->set('sudopay_data', $sudopay_data);
					} else {
						$this->request->data['Sudopay'] = !empty($this->request->data['Sudopay']) ? $this->request->data['Sudopay'] : '';
						
						$return = $this->Sudopay->processPayment($this->request->data['User']['id'], ConstPaymentType::Signup, $this->request->data['Sudopay']);
						$redirect = 0;
						if (!empty($return['pending'])) {
							$this->Session->setFlash(__l('Your payment is in pending.') , 'default', null, 'success');
							$redirect = 1;
						} elseif (!empty($return['success'])) {
							$this->Payment->processUserSignupPayment($this->request->data['User']['id'], ConstPaymentGateways::SudoPay);
							$this->Session->setFlash(__l('You have paid signup fee successfully') , 'default', null, 'success');
							$redirect = 1;
						} elseif (!empty($return['error'])) {
							$this->Session->setFlash($return['error_message'] . __l('Your payment could not be completed.') , 'default', null, 'error');
						}
						if (!empty($redirect)) {
							$this->redirect('/');
						}
					}
				}
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
	public function success_payment($foreign_id, $transaction_type,$slug)
    {
        $this->Session->setFlash(__l('Payment successfully completed. Stauts will be updated soon.') , 'default', null, 'success');
        $redirect = $this->_getRedirectUrl($foreign_id, $transaction_type,$slug);
        $this->redirect($redirect);
    }
	
	public function cancel_payment($foreign_id, $transaction_type,$slug)
	{
		$this->Session->setFlash(__l('Payment Failed. Please, try again') , 'default', null, 'error');
        $redirect = $this->_getRedirectUrl($foreign_id, $transaction_type,$slug);
        $this->redirect($redirect);
	}
	
	private function _getRedirectUrl($foreign_id, $transaction_type,$slug)
    {
        switch ($transaction_type) {
            
            case ConstProjectFundStatus::Backed:
                $redirect = Router::url(array(
					'controller' => 'projects',
					'action' => 'view',
					$slug
				) , true);
                break;
			
           default:
                $redirect = Router::url('/');
                break;
        }
        return $redirect;
    }
	
	public function process_ipn($foreign_id, $transaction_type,$slug)
	{
        //if ($_POST) {
            $this->_processPayment($foreign_id, $transaction_type, $_POST,$slug);
        //}
        $this->autoRender = false;
	}
	
	private function _processPayment($foreign_id, $transaction_type, $post,$slug)
    {
        $redirect = '';
        switch ($transaction_type) {
			case ConstProjectFundStatus::Backed:
				$contain = array(
					'Attachment',
					'User',
					'ProjectType',
					'Country' => array(
						'fields' => array(
							'Country.name',
							'Country.iso_alpha2'
						)
					) ,
					'City' => array(
						'fields' => array(
							'City.name',
							'City.slug'
						)
					)
				);
				$project = $this->ProjectFund->Project->find('first', array(
					'conditions' => array(
						'Project.slug' => $slug,
						'Project.is_admin_suspended' => 0,
						'Project.is_active' => 1,
					) ,
					'contain' => $contain,
					'recursive' => 1
				));
				$this->Session->setFlash(sprintf(__l('You have %s successfully') , Configure::read('project.alt_name_for_' . $project['ProjectType']['slug'] . '_past_tense_small')) , 'default', null, 'success');
				$this->redirect(array(
					'controller' => 'projects',
					'action' => 'view',
					$project['Project']['slug']
				));
            break; 
		
        }
    	return $redirect;
	}
	public function get_gateways()
	{
		App::import('Model', 'User');
		$this->loadModel('User');
		$countries = $this->User->UserProfile->Country->find('list', array(
				'fields' => array(
						'Country.iso_alpha2',
						'Country.name'
				) ,
				'order' => array(
						'Country.name' => 'ASC'
				) ,
				'recursive' => -1,
		));
		$user_profile = $this->User->UserProfile->find('first', array(
				'conditions' => array(
						'UserProfile.user_id' => $this->Auth->user('id') ,
				) ,
				'contain' => array(
						'User',
						'City',
						'State',
						'Country'
				) ,
				'recursive' => 0,
		));
		$gateway_ids="";
		$gatewaygroup_ids="";
		if (isPluginEnabled('Sudopay')) {
			$this->loadModel('Sudopay.SudopayPaymentGatewaysUser');
			$this->SudopayPaymentGatewaysUser = new SudopayPaymentGatewaysUser();
			$this->loadModel('Sudopay.SudopayPaymentGateway');
			$this->SudopayPaymentGateway = new SudopayPaymentGateway();
			
			$connected_gateways = $this->SudopayPaymentGatewaysUser->find('all', array(
					'conditions' => array(
							'SudopayPaymentGatewaysUser.user_id' => $this->request->params['named']['user_id'] ,
					) ,
					'contain'=>array(
							'SudopayPaymentGateway',
					),
					'recursive' => 0,
			));
			 
			foreach ($connected_gateways as $gateway_id){
				$connected_gateways_group = $this->SudopayPaymentGateway->find('first', array(
						'conditions' => array(
								'SudopayPaymentGateway.sudopay_gateway_id' =>$gateway_id['SudopayPaymentGatewaysUser']['sudopay_payment_gateway_id'],
						) ,
						'contain'=>array(
								'SudopayPaymentGroup',
						),
						'recursive' => 0
				));
				$gateway_ids = $gateway_id['SudopayPaymentGatewaysUser']['sudopay_payment_gateway_id'].",".$gateway_ids;
				$gatewaygroup_ids = $connected_gateways_group['SudopayPaymentGroup']['sudopay_group_id'].",".$gatewaygroup_ids;
			}
		}
		$gateway_ids = explode(",",$gateway_ids);
		$gatewaygroup_ids = explode(",",$gatewaygroup_ids);
		
		if(!empty($this->request->params['named']['project_type'])){
			
			$this->log('$project_typesssss');
			$this->log($project_type);
			$project_type = $this->request->params['named']['project_type'];
		}
		if (!empty($this->request->params['named']['type'])) {
			$type = $this->request->params['named']['type'];
			$this->log('$typessssssss');
			$this->log($type);
			$gateway_types = $this->Payment->getGatewayTypes($type);
			$this->log('$gateway_types if');
			$this->log($gateway_types);
		} else {
			$gateway_types = $this->Payment->getGatewayTypes();
			$this->log('$gateway_types else');
			$this->log($gateway_types);
		}
		if (isPluginEnabled('Sudopay') && !empty($gateway_types[ConstPaymentGateways::SudoPay])) {
			$this->request->data[$this->request->params['named']['model']]['payment_gateway_id'] = ConstPaymentGateways::SudoPay;
		} elseif (isPluginEnabled('Wallet') && !empty($gateway_types[ConstPaymentGateways::Wallet]) && !empty($this->Auth->user('id'))) {
			$this->request->data[$this->request->params['named']['model']]['payment_gateway_id'] = ConstPaymentGateways::Wallet;
		}
		if (isPluginEnabled('Sudopay')) {
			$this->loadModel('Sudopay.Sudopay');
			$this->Sudopay = new Sudopay();
			$response = $this->Sudopay->GetSudoPayGatewaySettings();
			$this->set('response', $response);
		}
		$this->set('model', $this->request->params['named']['model']);
		$this->set('foreign_id', $this->request->params['named']['foreign_id']);
		$this->set('transaction_type', $this->request->params['named']['transaction_type']);
		$this->set(compact('countries', 'user_profile', 'gateway_types','project_type','gateway_ids','gatewaygroup_ids'));
	}
}
?>

