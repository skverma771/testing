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
class SudopaysController extends AppController
{
    public function beforeFilter()
    {
        if (in_array($this->request->action, array(
            'success_payment',
            'cancel_payment',
            'process_payment',
            'process_ipn',
            'update_account',
        ))) {
            $this->Security->validatePost = false;
        }
        parent::beforeFilter();
    }
    public function admin_user_accounts()
    {
        $this->setAction('user_accounts');
    }
    public function user_accounts()
    {
        $s = $this->Sudopay->getSudoPayObject();
        $this->loadModel('Sudopay.SudopayPaymentGateway');
        $supported_gateways = $this->SudopayPaymentGateway->find('all', array(
            'conditions' => array(
                'SudopayPaymentGateway.is_marketplace_supported' => 1
            ) ,
            'recursive' => -1,
        ));
        $user = $this->request->params['named']['user'];
        $connected_gateways = array();
        App::import('Model', 'Sudopay.SudopayPaymentGatewaysUser');
        $this->SudopayPaymentGatewaysUser = new SudopayPaymentGatewaysUser();
        $connected_gateways = $this->SudopayPaymentGatewaysUser->find('list', array(
            'conditions' => array(
                'SudopayPaymentGatewaysUser.user_id' => $this->Auth->user('id') ,
            ) ,
            'fields' => array(
                'SudopayPaymentGatewaysUser.sudopay_payment_gateway_id',
            ) ,
            'recursive' => -1,
        ));
        $pending_count = array();
        if (empty($pending_count)) {
            $redirect = Router::url(array(
                'controller' => 'projects',
                'action' => 'add',
                $this->request->params['named']['project'],
                $this->request->params['named']['step']+1
            ) , true);
        }
        $this->set('user', $this->request->params['named']['user']);
        $this->set('project', $this->request->params['named']['project']);
        $this->set('step', $this->request->params['named']['step']);
        $this->set('connected_gateways', $connected_gateways);
        $this->set('supported_gateways', $supported_gateways);
    }
    public function payout_connections()
    {
		
		$s = $this->Sudopay->getSudoPayObject();
        $this->pageTitle = __l('Payment Options / Payout Methods');
        $this->loadModel('Sudopay.SudopayPaymentGateway');
        $supported_gateways = $this->SudopayPaymentGateway->find('all', array(
            'conditions' => array(
                'SudopayPaymentGateway.is_marketplace_supported' => 1
            ) ,
            'recursive' => -1,
        ));
        $connected_gateways = array();
        App::import('Model', 'Sudopay.SudopayPaymentGatewaysUser');
        $this->SudopayPaymentGatewaysUser = new SudopayPaymentGatewaysUser();
        $connected_gateways = $this->SudopayPaymentGatewaysUser->find('list', array(
            'conditions' => array(
                'SudopayPaymentGatewaysUser.user_id' => $this->Auth->user('id') ,
            ) ,
            'fields' => array(
                'SudopayPaymentGatewaysUser.sudopay_payment_gateway_id',
            ) ,
            'recursive' => -1,
        ));
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id') ,
            ) ,
            'recursive' => -1,
        ));
        $this->set('user', $user);
        $this->set('connected_gateways', $connected_gateways);
        $this->set('supported_gateways', $supported_gateways);
    }
    public function add_account($gateway_id, $user, $step, $project = "")
    {
        App::import('Model', 'Sudopay.SudopayPaymentGateway');
        $this->SudopayPaymentGateway = new SudopayPaymentGateway();
        $SudopayPaymentGateway = $this->SudopayPaymentGateway->find('first', array(
            'conditions' => array(
                'SudopayPaymentGateway.sudopay_gateway_id' => $gateway_id,
            ) ,
            'recursive' => -1
        ));
        App::import('Model', 'User');
        $this->User = new User();
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user,
            ) ,
            'recursive' => -1
        ));
        App::import('Model', 'Projects.Project');
        $this->Project = new Project();
        $project_details = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id' => $project,
            ) ,
            'contain' => array(
                'ProjectType'
            ) ,
            'recursive' => 0
        ));
		
        if (!empty($_SESSION['post_action']) && !empty($project)) {
            $return_url = Router::url(array(
                'controller' => ($_SESSION['post_action'] == 'add') ? $project_details['ProjectType']['slug'] : 'projects',
                'action' => $_SESSION['post_action'],
                $project,
                $step
            ) , true);
        } else {
            $return_url = Router::url(array(
                'controller' => 'sudopays',
                'action' => 'payout_connections'
            ) , true);
        }
        $post = array(
			//Cache::read('site_url_for_shell', 'long')
            'gateway_id' => $gateway_id,
            'notify_url' => Router::url('/', true) . 'sudopays/update_account/' . $gateway_id . '/' . $user['User']['id'],
            'return_url' => $return_url			
        );	
		//print_r($post); exit;
        $_SESSION['response_for_connect'] = $gateway_id;
        if (!empty($user['User']['sudopay_receiver_account_id'])) {
            $post['receiver'] = $user['User']['sudopay_receiver_account_id'];
        }
        $post['name'] = $user['User']['username'];
        $post['email'] = $user['User']['email'];
        $s = $this->Sudopay->getSudoPayObject();
        $create_account = $s->callCreateReceiverAccount($post);
        if (!empty($create_account['error']['message'])) {
            $this->Session->setFlash($create_account['error']['message'], 'default', null, 'error');
            if (!empty($project)) {
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'add',
                    'project_type' => $project_details['ProjectType']['slug'],
                    $project,
                    $step,
                ));
            } else {
                $this->redirect(array(
                    'controller' => 'sudopays',
                    'action' => 'payout_connections'
                ));
            }
        }
        header('location: ' . $create_account['gateways']['gateway_callback_url']);
        exit;
    }
	
    public function update_account($gateway_id, $user_id)
    {	
        if (empty($gateway_id) || empty($user_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $s = $this->Sudopay->getSudoPayObject();
        if ($s->isValidIPNPost($_POST) && empty($_POST['error_code'])) {
			
            $this->loadModel('User');
            $data = array();
            $data['id'] = $user_id;
            $data['sudopay_receiver_account_id'] = $_POST['id'];
            $this->User->save($data);
            App::import('Model', 'Sudopay.SudopayPaymentGatewaysUser');
            $this->SudopayPaymentGatewaysUser = new SudopayPaymentGatewaysUser();
            $sudopayUser = $this->SudopayPaymentGatewaysUser->find('first', array(
                'conditions' => array(
                    'SudopayPaymentGatewaysUser.user_id' => $user_id,
                    'SudopayPaymentGatewaysUser.sudopay_payment_gateway_id' => $_POST['gateway_id'],
                ) ,
                'recursive' => -1
            ));
            if (empty($sudopayUser)) {
                $data = array();
                $data['user_id'] = $user_id;
                $data['sudopay_payment_gateway_id'] = $_POST['gateway_id'];
                $this->SudopayPaymentGatewaysUser->create();
                $this->SudopayPaymentGatewaysUser->save($data);
            }
        } die;
        $this->autoRender = false;
    }
    public function process_payment($foreign_id, $transaction_type)
    {
        $return = $this->Sudopay->processPayment($foreign_id, $transaction_type);
        if (!empty($return)) {
            return $return;
        }
        $this->autoRender = false;
    }
    public function process_ipn($foreign_id, $transaction_type)
    {
		$this->Sudopay->_saveIPNLog();
		//$this->log($_POST);
        $s = $this->Sudopay->getSudoPayObject();
        if ($s->isValidIPNPost($_POST)) {
			$this->_processPayment($foreign_id, $transaction_type, $_POST);
        }
        $this->autoRender = false;
    }
    public function delete_account($gateway_id, $user_id, $step, $from = "")
    {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'recursive' => -1
        ));
        $donate_count = 0;
        $pledge_count = 0;
        $lend_count = 0;
        $equity_count = 0;
        App::import('Model', 'Projects.Project');
        $this->Project = new Project();
        if (isPluginEnabled('Donate')) {
            App::import('Model', 'Donate.Donate');
            $this->Donate = new Donate();
            $donate_count = $this->Donate->getUserOpenProjectCount($user_id);
        }
        if (isPluginEnabled('Pledge')) {
            App::import('Model', 'Pledge.Pledge');
            $this->Pledge = new Pledge();
            $pledge_count = $this->Pledge->getUserOpenProjectCount($user_id);
        }
        if (isPluginEnabled('Lend')) {
            App::import('Model', 'Lend.Lend');
            $this->Lend = new Lend();
            $lend_count = $this->Lend->getUserOpenProjectCount($user_id);
        }
        if (isPluginEnabled('Equity')) {
            App::import('Model', 'Equity.Equity');
            $this->Equity = new Equity();
            $equity_count = $this->Equity->getUserOpenProjectCount($user_id);
        }
        $connected_gateways = $this->Sudopay->GetUserConnectedGateways($user_id);
        // Need to revise this
        if ($donate_count == 0 && $pledge_count == 0 && $lend_count == 0 && $equity_count == 0) { // check for joborder which are in penidng payment status which uses this payment gateway
            App::import('Model', 'Sudopay.SudopayPaymentGatewaysUser');
            $this->SudopayPaymentGatewaysUser = new SudopayPaymentGatewaysUser();
            $SudopayPaymentGatewaysUser = $this->SudopayPaymentGatewaysUser->find('first', array(
                'conditions' => array(
                    'SudopayPaymentGatewaysUser.sudopay_payment_gateway_id' => $gateway_id,
                    'SudopayPaymentGatewaysUser.user_id' => $user_id,
                ) ,
                'recursive' => -1
            ));
            // From Account delete from sudopay
            $receiver_id = $user['User']['sudopay_receiver_account_id'];
            $s = $this->Sudopay->getSudoPayObject();
            $response = $s->callDisconnectGateway($gateway_id, $receiver_id);
            if ((count($connected_gateways) >= 1)) { // Check for active job
                if ($this->SudopayPaymentGatewaysUser->delete($SudopayPaymentGatewaysUser['SudopayPaymentGatewaysUser']['id'])) {
                    $this->Session->setFlash(__l('You have successfully disconnected') , 'default', null, 'success');
                }
            } else {
                $this->Session->setFlash(__l('Sorry you have active project in your project listing. So you can\'t disconnect this payment gateway.') , 'default', null, 'error');
            }
        } else {
            $this->Session->setFlash(__l('Sorry you have some projects which using this payment gateway. So you can\'t disconnect this payment gateway.') , 'default', null, 'error');
        }
        if (empty($from)) {
            $this->redirect(array(
                'controller' => 'sudopays',
                'action' => 'payout_connections',
            ));
        } else {
            $project_details = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $from,
                ) ,
                'contain' => array(
                    'ProjectType'
                ) ,
                'recursive' => 0
            ));
            $this->redirect(array(
                'controller' => 'projects',
                'action' => 'add',
                'project_type' => $project_details['ProjectType']['slug'],
                $from,
                $step
            ));
        }
        $this->autoRender = false;
    }
    private function _processPayment($foreign_id, $transaction_type, $post)
    {
        $redirect = '';
        $s = $this->Sudopay->getSudoPayObject();
        switch ($transaction_type) {
            case ConstPaymentType::PledgeCapture:
                App::import('Model', 'Projects.ProjectFund');
                $this->ProjectFund = new ProjectFund();
                $_data = array();
                $_data['ProjectFund']['id'] = $foreign_id;
                $_data['ProjectFund']['sudopay_payment_id'] = $post['id'];
                $_data['ProjectFund']['sudopay_pay_key'] = $post['paykey'];
                $this->ProjectFund->save($_data);
                $projectFund = $this->ProjectFund->find('first', array(
                    'conditions' => array(
                        'ProjectFund.id' => $foreign_id
                    ) ,
                    'contain' => array(
                        'Project',
                        'ProjectType'
                    ) ,
                    'recursive' => 2
                ));
                if (!empty($post['status']) && (($post['status'] == 'Captured' && $projectFund['Project']['project_type_id'] == ConstProjectTypes::Donate) || (in_array($post['status'], array(
                    'Authorized',
                    'Captured'
                )) && $projectFund['Project']['project_type_id'] == ConstProjectTypes::Pledge)) && in_array($projectFund['ProjectFund']['project_fund_status_id'], array(
                    ConstProjectFundStatus::ManualPending,
                    ConstProjectFundStatus::PendingToPay
                ))) {
                    $this->ProjectFund->updateStatus($projectFund['ProjectFund']['id'], ConstProjectFundStatus::Backed, ConstPaymentGateways::SudoPay);
                } elseif (!empty($post['status']) && in_array($post['status'], array(
                    'Voided',
                    'Refunded',
                    'Canceled'
                )) && !in_array($projectFund['ProjectFund']['project_fund_status_id'], array(
                    ConstProjectFundStatus::Expired,
                    ConstProjectFundStatus::Canceled
                ))) {
                    $this->ProjectFund->updateStatus($foreign_id, ConstProjectFundStatus::Refunded, ConstPaymentGateways::SudoPay, 1);
                }
                $this->Session->setFlash(sprintf(__l('You have successfully %s') , Configure::read('project.alt_name_for_' . $projectFund['ProjectType']['slug'] . '_singular_caps')) , 'default', null, 'success');
                if (isPluginEnabled('SocialMarketing')) {
                    $redirect = Router::url(array(
                        'controller' => 'social_marketings',
                        'action' => 'publish',
                        $foreign_id,
                        'type' => 'facebook',
                        'publish_action' => 'fund',
                    ) , true);
                } else {
                    $redirect = Router::url(array(
                        'controller' => 'projects',
                        'action' => 'view',
                        $projectFund['Project']['slug']
                    ) , true);
                }
                break;

            case ConstPaymentType::ProjectListing:
                App::import('Model', 'Projects.Project');
                $this->Project = new Project();
                $_data = array();
                $_data['Project']['id'] = $foreign_id;
                $_data['Project']['sudopay_payment_id'] = $post['id'];
                $_data['Project']['sudopay_pay_key'] = $post['paykey'];
                $this->Project->save($_data);
                $project = $this->Project->find('first', array(
                    'conditions' => array(
                        'Project.id' => $foreign_id
                    ) ,
                    'contain' => array(
                        'ProjectType'
                    ) ,
                    'recursive' => 0
                ));
                if (!empty($post['status']) && $post['status'] == 'Captured') {
                    $projectTypeName = ucwords($project['ProjectType']['name']);
                    App::import('Model', $projectTypeName . '.' . $projectTypeName);
                    $model = new $projectTypeName();
                    $response = $model->isAllowToProcessPayment($project['Project']['id']);
                    if (!empty($response['is_allow_process_payment'])) {
                        $total_amount = 0;
                        if ($project['ProjectType']['listing_fee'] != 0 and !empty($project['ProjectType']['listing_fee_type'])) {
                            if ($project['ProjectType']['listing_fee_type'] == ConstListingFeeType::amount) {
                                $total_amount = $project['ProjectType']['listing_fee'];
                            } else {
                                $total_amount = $project['Project']['needed_amount']*($project['ProjectType']['listing_fee']/100);
                            }
                        } else {
                            if (Configure::read('Project.project_listing_fee_type') == 'amount') {
                                $total_amount = Configure::read('Project.listing_fee');
                            } else {
                                $total_amount = $this->request->data['Project']['needed_amount']*(Configure::read('Project.listing_fee') /100);
                            }
                        }
                        $this->Project->processPayment($foreign_id, $total_amount, ConstPaymentGateways::SudoPay);
                    }
                    $payment_step = $this->Project->getProjectPaymentStep($project['Project']['id']);
                    if (!empty($payment_step)) {
                        $controller = ($_SESSION['post_action'] == 'add') ? $project['ProjectType']['slug'] : 'projects';
                        $redirect = Router::url(array(
                            'controller' => $controller,
                            'action' => $_SESSION['post_action'],
                            $project['Project']['id'],
                            $payment_step+1
                        ) , true);
                    } else {
                        if (isPluginEnabled('SocialMarketing') && $project['Project']['is_active'] == 1) {
                            $redirect = Router::url(array(
                                'controller' => 'social_marketings',
                                'action' => 'publish',
                                $project['Project']['id'],
                                'type' => 'facebook',
                                'publish_action' => 'add',
                                'admin' => false
                            ) , true);
                        }
                    }
                    $this->Sudopay->_savePaidLog($foreign_id, $response_data, 'Project');
                }
                if (empty($redirect)) {
                    $redirect = Router::url(array(
                        'controller' => 'projects',
                        'action' => 'view',
                        $project['Project']['slug']
                    ) , true);
                }
                break;

            case ConstPaymentType::Wallet:
                if (isPluginEnabled('Wallet')) {
                    $this->loadModel('Wallet.Wallet');
                    $this->loadModel('User');
                    $_data = array();
                    $_data['UserAddWalletAmount']['id'] = $foreign_id;
                    $_data['UserAddWalletAmount']['sudopay_payment_id'] = $post['id'];
                    $_data['UserAddWalletAmount']['sudopay_pay_key'] = $post['paykey'];
                    $this->User->UserAddWalletAmount->save($_data);
                    $userAddWalletAmount = $this->User->UserAddWalletAmount->find('first', array(
                        'conditions' => array(
                            'UserAddWalletAmount.id' => $foreign_id
                        ) ,
                        'contain' => array(
                            'User'
                        ) ,
                        'recursive' => 1,
                    ));
                    if (empty($userAddWalletAmount)) {
                        throw new NotFoundException(__l('Invalid request'));
                    }
                    if (!empty($post['status']) && $post['status'] == 'Captured') {
                        if ($this->Wallet->processAddtoWallet($foreign_id, ConstPaymentGateways::SudoPay)) {
                            $this->Session->setFlash(__l('Amount added to wallet') , 'default', null, 'success');
                            $this->Sudopay->_savePaidLog($foreign_id, $post, 'UserAddWalletAmount');
                        } else {
                            $this->Session->setFlash(__l('Amount could not be added to wallet') , 'default', null, 'error');
                        }
                    } else {
                        $this->Session->setFlash(__l('Amount could not be added to wallet') , 'default', null, 'error');
                    }
                }
                $redirect = Router::url(array(
                    'controller' => 'users',
                    'action' => 'dashboard',
                    'admin' => false,
                ) , true);
                break;

            case ConstPaymentType::Signup:
                $this->loadModel('Payment');
                $this->loadModel('User');
                $_data = array();
                $_data['User']['id'] = $foreign_id;
                $_data['User']['sudopay_payment_id'] = $post['id'];
                $_data['User']['sudopay_pay_key'] = $post['paykey'];
                $this->User->save($_data);
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $foreign_id,
                    ) ,
                    'recursive' => -1,
                ));
                if (!empty($post['status']) && ($post['status'] == 'Captured' || $post['status'] == 'COMPLETED')) {
                    App::import('Model', 'Payment');
                    $this->Payment = new Payment();
                    if ($this->Payment->processUserSignupPayment($foreign_id, ConstPaymentGateways::SudoPay)) {
						//echo "I am here"; exit;
                        if (empty($user['User']['is_openid_register']) && empty($user['User']['is_linkedin_register']) && empty($user['User']['is_google_register']) && empty($user['User']['is_googleplus_register']) && empty($user['User']['is_angellist_register']) && empty($user['User']['is_yahoo_register']) && empty($user['User']['is_facebook_register']) && empty($user['User']['is_twitter_register'])) {
                            if (empty($user['User']['is_email_confirmed']) && Configure::read('user.is_admin_activate_after_register') && Configure::read('user.is_email_verification_for_register')) {
                                $this->Session->setFlash(__l('You have paid membership fee successfully. Once you verified your email and administrator approved your account will be activated.') , 'default', null, 'success');
                            } else if (Configure::read('user.is_admin_activate_after_register')) {
                                $this->Session->setFlash(__l('You have paid membership fee successfully, will be activated once administrator approved') , 'default', null, 'success');
                            } else if (empty($user['User']['is_email_confirmed']) && Configure::read('user.is_email_verification_for_register')) {
                                $this->Session->setFlash(sprintf(__l('You have paid membership fee successfully. Now you can login with your %s after verified your email') , Configure::read('user.using_to_login')) , 'default', null, 'success');
                            } else {
                                $this->Session->setFlash(sprintf(__l('You have paid membership fee successfully. Now you can login with your %s') , Configure::read('user.using_to_login')) , 'default', null, 'success');
                            }
                            $this->Auth->logout();
                        } else {
                            if (Configure::read('user.is_admin_activate_after_register')) {
                                $this->Session->setFlash(__l('You have paid membership fee successfully, will be activated once administrator approved') , 'default', null, 'success');
                            } else {
                                $this->Session->setFlash(__l('You have paid membership fee successfully.') , 'default', null, 'success');
                            }
                        }
                        $this->Sudopay->_savePaidLog($foreign_id, $post, 'User');
                    }
                }
                $redirect = Router::url(array(
                    'controller' => 'users',
                    'action' => 'login',
                    'admin' => false
                ) , true);
                break;
            }
            return $redirect;
        }
        public function success_payment($foreign_id, $transaction_type)
        {
			$this->Session->setFlash(__l('Payment successfully completed') , 'default', null, 'success');
            $redirect = $this->_getRedirectUrl($foreign_id, $transaction_type);
            $this->redirect($redirect);
        }
        public function cancel_payment($foreign_id, $transaction_type)
        {
            $this->Session->setFlash(__l('Payment Failed. Please, try again') , 'default', null, 'error');
            $redirect = $this->_getRedirectUrl($foreign_id, $transaction_type);
            $this->redirect($redirect);
        }
        private function _getRedirectUrl($foreign_id, $transaction_type)
        {
            switch ($transaction_type) {
                case ConstPaymentType::Pledge:
                    $redirect = Router::url(array(
                        'controller' => 'projects',
                        'action' => 'myfunds'
                    ) , true);
                    break;

                case ConstPaymentType::PledgeCapture:
                    App::import('Model', 'Projects.ProjectFund');
                    $this->ProjectFund = new ProjectFund();
                    $projectFund = $this->ProjectFund->find('first', array(
                        'conditions' => array(
                            'ProjectFund.id' => $foreign_id
                        ) ,
                        'contain' => array(
                            'Project'
                        ) ,
                        'recursive' => 0
                    ));
                    $redirect = Router::url(array(
                        'controller' => 'projects',
                        'action' => 'view',
                        $projectFund['Project']['slug']
                    ) , true);
                    break;

                case ConstPaymentType::ProjectListing:
                    App::import('Model', 'Projects.Project');
                    $this->Project = new Project();
                    $payment_step = $this->Project->getProjectPaymentStep($foreign_id);
                    $project = $this->Project->find('first', array(
                        'conditions' => array(
                            'Project.id' => $foreign_id
                        ) ,
                        'contain' => array(
                            'ProjectType'
                        ) ,
                        'recursive' => 0
                    ));
                    $_SESSION['payment_response'] = $foreign_id;
                    $redirect = Router::url(array(
                        'controller' => ($_SESSION['post_action'] == 'add') ? $project['ProjectType']['slug'] : 'projects',
                        'action' => $_SESSION['post_action'],
                        $foreign_id,
                        $payment_step
                    ) , true);
                    break;

                case ConstPaymentType::Wallet:
                    $redirect = Router::url(array(
                        'controller' => 'wallets',
                        'action' => 'add_to_wallet'
                    ) , true);
                    break;

                case ConstPaymentType::Signup:
                    $redirect = Router::url(array(
                        'controller' => 'users',
                        'action' => 'register',
                    ) , true);
                    break;

                default:
                    $redirect = Router::url('/');
                    break;
            }
            return $redirect;
        }
        public function admin_sudopay_admin_info()
        {
            $this->loadModel('Sudopay.SudopayPaymentGateway');
            $this->loadModel('Sudopay.Sudopay');
            $response = $this->Sudopay->GetSudoPayGatewaySettings();
            $this->set('gateway_settings', $response);
            $supported_gateways = $this->SudopayPaymentGateway->find('all', array(
                'recursive' => -1,
            ));
            $used_gateway_actions = array(
                'Marketplace-Auth',
                'Marketplace-Auth-Capture',
                'Marketplace-Void',
                'Marketplace-Capture',
                'Capture'
            );
            $this->set(compact('supported_gateways', 'used_gateway_actions'));
        }
        public function confirmation($foreign_id, $transaction_type)
        {
            $this->pageTitle = __l('Payment Confirmation');
            $redirect = $this->_getRedirectUrl($foreign_id, $transaction_type);
            if ($transaction_type == ConstPaymentType::ProjectListing) {
                App::uses('Projects.Project', 'Model');
                $obj = new Project();
                $Data = $obj->find('first', array(
                    'conditions' => array(
                        'Project.id' => $foreign_id,
                    ) ,
                    'contain' => array(
                        'User',
                    ) ,
                    'recursive' => 0
                ));
                $sudopay_token = $Data['Project']['sudopay_token'];
                $sudopay_revised_amount = $Data['Project']['sudopay_revised_amount'];
                $receiver_data = $obj->getReceiverdata($foreign_id, $transaction_type, $project['User']['email']);
                $amount = $receiver_data['amount']['0'];
            } elseif ($transaction_type == ConstPaymentType::Signup) {
                App::uses('User', 'Model');
                $obj = new User();
                $Data = $obj->find('first', array(
                    'conditions' => array(
                        'User.id' => $foreign_id,
                    ) ,
                    'fields' => array(
                        'User.id',
                        'User.username',
                        'User.email'
                    ) ,
                    'recursive' => -1
                ));
                $sudopay_token = $Data['User']['sudopay_token'];
                $sudopay_revised_amount = $Data['User']['sudopay_revised_amount'];
                $amount = Configure::read('User.signup_fee');
            } elseif ($transaction_type == ConstPaymentType::Wallet) {
                App::import('Model', 'Wallet.UserAddWalletAmount');
                $obj = new UserAddWalletAmount();
                $Data = $obj->find('first', array(
                    'conditions' => array(
                        'UserAddWalletAmount.id' => $foreign_id,
                    ) ,
                    'contain' => array(
                        'User',
                    ) ,
                    'recursive' => 0
                ));
                $sudopay_token = $Data['UserAddWalletAmount']['sudopay_token'];
                $sudopay_revised_amount = $Data['UserAddWalletAmount']['sudopay_revised_amount'];
                $amount = $Data['UserAddWalletAmount']['amount'];
            }
            if (!empty($this->request->data) && !empty($this->request->data['Sudopay']['confirm'])) {
                $s = $this->Sudopay->GetSudoPayObject();
                $post_data = array();
                $post_data['confirmation_token'] = $sudopay_token;
                $response = $s->callCaptureConfirm($post_data);
                if (empty($response['error']['code'])) {
                    if (!empty($response['status']) && $response['status'] == 'Pending') {
                        $return['pending'] = 1;
                    } elseif (!empty($response['status']) && $response['status'] == 'Captured') {
                        $return['success'] = 1;
                    } elseif (!empty($response['gateway_callback_url'])) {
                        header('location: ' . $response['gateway_callback_url']);
                        exit;
                    }
                } else {
                    $return['error'] = 1;
                    $return['error_message'] = $response['error']['message'];
                }
                if (!empty($return['success'])) {
                    if ($transaction_type == ConstPaymentType::ProjectListing) {
                        $obj->processPayment($foreign_id, $amount, ConstPaymentGateways::SudoPay);
                        $this->Session->setFlash(__l('You have paid listing fee successfully.') , 'default', null, 'success');
                    } elseif ($transaction_type == ConstPaymentType::Signup) {
                        App::import('Model', 'Payment');
                        $obj = new Payment();
                        $obj->processUserSignupPayment($foreign_id, ConstPaymentGateways::SudoPay);
                        $this->Session->setFlash(__l('You have paid signup fee successfully') , 'default', null, 'success');
                    } elseif ($transaction_type == ConstPaymentType::Wallet) {
                        $obj->processAddtoWallet($foreign_id, ConstPaymentGateways::SudoPay);
                        $this->Session->setFlash(__l('Amount added to wallet') , 'default', null, 'success');
                    }
                } elseif (!empty($return['error'])) {
                    $return['error_message'].= '. ';
                    $this->Session->setFlash($return['error_message'] . __l('Your payment could not be completed.') , 'default', null, 'error');
                } elseif (!empty($return['pending'])) {
                    $this->Session->setFlash(__l('Your payment is in pending.') , 'default', null, 'success');
                }
                $this->redirect($redirect);
            }
            $this->set(compact('amount', 'foreign_id', 'transaction_type', 'redirect', 'sudopay_revised_amount'));
        }
        public function admin_synchronize()
        {
            $s = $this->Sudopay->GetSudoPayObject();
            $currentPlan = $s->callPlan();
            if (!empty($currentPlan['error']['message'])) {
                if ($currentPlan['error']['message'] == 'MismatchOfPlanForAPI') {
                    $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                        'PaymentGatewaySetting.live_mode_value' => ConstBrandType::VisibleBranding,
                    ) , array(
                        'PaymentGatewaySetting.payment_gateway_id' => ConstPaymentGateways::SudoPay,
                        'PaymentGatewaySetting.name' => 'is_payment_via_api'
                    ));
                }
                $this->Session->setFlash($currentPlan['error']['message'], 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'payment_gateways',
                    'action' => 'edit',
                    ConstPaymentGateways::SudoPay,
                    'admin' => true
                ));
            }
            if ($currentPlan['brand'] == 'Transparent Branding') {
                $plan = ConstBrandType::TransparentBranding;
            } elseif ($currentPlan['brand'] == 'Visible Branding') {
                $plan = ConstBrandType::VisibleBranding;
            } elseif ($currentPlan['brand'] == 'Any Branding') {
                $plan = ConstBrandType::AnyBranding;
            }
            $this->loadModel('PaymentGateway');
            $paymentGateway = $this->PaymentGateway->find('first', array(
                'fields' => array(
                    'PaymentGateway.is_test_mode',
                ) ,
                'conditions' => array(
                    'PaymentGateway.id' => ConstPaymentGateways::SudoPay
                ) ,
                'recursive' => -1
            ));
            if ($paymentGateway['PaymentGateway']['is_test_mode']) {
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.test_mode_value' => $plan,
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => ConstPaymentGateways::SudoPay,
                    'PaymentGatewaySetting.name' => 'is_payment_via_api'
                ));
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.test_mode_value' => "'" . $currentPlan['name'] . "'",
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => ConstPaymentGateways::SudoPay,
                    'PaymentGatewaySetting.name' => 'sudopay_subscription_plan'
                ));
            } else {
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.live_mode_value' => $plan,
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => ConstPaymentGateways::SudoPay,
                    'PaymentGatewaySetting.name' => 'is_payment_via_api'
                ));
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.live_mode_value' => "'" . $currentPlan['name'] . "'",
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => ConstPaymentGateways::SudoPay,
                    'PaymentGatewaySetting.name' => 'sudopay_subscription_plan'
                ));
            }
            $gateway_response = $s->callGateways();
            if (!empty($gateway_response['error']['message'])) {
                $this->Session->setFlash($gateway_response['error']['message'], 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'payment_gateways',
                    'action' => 'edit',
                    ConstPaymentGateways::SudoPay,
                    'admin' => true
                ));
            }
            $this->loadModel('Sudopay.SudopayPaymentGateway');
            $this->loadModel('Sudopay.SudopayPaymentGroup');
            $this->SudopayPaymentGroup->deleteAll(array(
                '1 = 1'
            ));
            $this->SudopayPaymentGateway->deleteAll(array(
                '1 = 1'
            ));
            foreach($gateway_response['gateways'] as $gateway_group) {
                $group_data = array();
                $group_data['sudopay_group_id'] = $gateway_group['id'];
                $group_data['name'] = $gateway_group['name'];
                $group_data['thumb_url'] = $gateway_group['thumb_url'];
                $this->SudopayPaymentGroup->create();
                $this->SudopayPaymentGroup->save($group_data);
                $group_id = $this->SudopayPaymentGroup->id;
                foreach($gateway_group['gateways'] as $gateway) {
                    $_data = array();
                    $supported_actions = $gateway['supported_features'][0]['actions'];
                    $_data['is_marketplace_supported'] = 0;
                    if (in_array('Marketplace-Auth', $supported_actions)) {
                        $_data['is_marketplace_supported'] = 1;
                    }
                    $_data['sudopay_gateway_id'] = $gateway['id'];
                    $_data['sudopay_gateway_details'] = serialize($gateway);
                    $_data['sudopay_gateway_name'] = $gateway['display_name'];
                    $_data['sudopay_payment_group_id'] = $group_id;
                    $this->SudopayPaymentGateway->create();
                    $this->SudopayPaymentGateway->save($_data);
                }
            }
            $this->Session->setFlash(sprintf(__l('%s have been synchronized') , __l('SudoPay Payment Gateways')) , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'payment_gateways',
                'action' => 'edit',
                ConstPaymentGateways::SudoPay,
                'admin' => true
            ));
        }
}
?>