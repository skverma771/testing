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
class ProjectsController extends AppController
{
    public $name = 'Projects';
    public $components = array(
        'RequestHandler'
    );
    public $helpers = array(
        'Projects.Embed',
        'Projects.Cakeform'
    );
    public $permanentCacheAction = array(
        'user' => array(
            'publish',
        ) ,
        'admin' => array(
            'add',
            'edit',
        ) ,
        'is_view_count_update' => true
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment.filename',
            'ProjectReward',
            'Project.is_agree_terms_conditions',
            'Project.step',
            'Project.id',
            'Project.address',
            'Project.latitude',
            'Project.longitude',
            'Project.project_type',
            'Project.country_id',
            'Project.payment_gateway_id',
            'Project.payment_id',
            'Project.gateway_method_id',
            'Project.sudopay_gateway_id',
            'Project.wallet',
            'Project.normal',
            'Project.Update',
            'Project.Publish',
            'City.name',
            'State.name',
            'State.id',
            'Project.type',
            'Project.user_id',
            'City.id',
            'City.name',
            'State.id',
            'Project.project_type_slug',
            'Project.project_type_id',
            'Project.publish',
            'Project.draft',
            'Project.back',
            'Project.next',
            'Project.post',
            'Pledge',
            'Lend',
            'Equity',
            'Cdata.Project.post',
            'Form',
            '_wysihtml5_mode',
            's3_file_url',
            'Sudopay'
        );
        parent::beforeFilter();
        if (!Configure::read('suspicious_detector.is_enabled') || !Configure::read('Project.auto_suspend_project_on_system_flag')) {
            $this->Project->Behaviors->detach('SuspiciousWordsDetector');
        }
    }
    public function autocomplete($param_encode = null, $param_hash = null)
    {
        $this->_redirectPOST2Named(array(
            'project_type',
            'q'
        ));
        $conditions['Project.is_active'] = 1;
        $conditions['Project.is_draft'] = 0;
        $conditions['Project.is_admin_suspended'] = '0';
        if (!empty($this->request->params['named']['project_type'])) {
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.id' => $this->request->params['named']['project_type']
                ) ,
                'recursive' => -1
            ));
            $this->set('projectType', $projectType);
            $conditions['Project.project_type_id'] = $projectType['ProjectType']['id'];
            if (!empty($projectType)) {
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'data' => $projectType,
                    'type' => 'idea'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
            }
        } else {
            $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                'page' => 'userview',
                'type' => 'myprojects'
            ));
            if (!empty($response->data['conditions'])) {
                $conditions = array_merge($conditions, $response->data['conditions']);
            }
        }
        $recursive = 0;
        $this->XAjax->autocomplete($param_encode, $param_hash, $conditions, $recursive);
    }
    public function start()
    {
        $this->pageTitle = sprintf(__l('Start %s') , Configure::read('project.alt_name_for_project_singular_caps'));
        $projectTypes = $this->Project->ProjectType->find('all', array(
            'conditions' => array(
                'ProjectType.is_active' => 1
            ) ,
            'fields' => array(
                'ProjectType.name',
                'ProjectType.slug'
            ) ,
            'recursive' => -1
        ));
        $this->set('projectTypes', $projectTypes);
    }
    public function index()
    {
		
        $this->_redirectPOST2Named(array(
            'city',
            'name',
            'project_type',
            'type',
            'q'
        ));
        if (!isPluginEnabled('Pledge')) {
            if (!empty($this->request->params['named']['project_type']) && $this->request->params['named']['project_type'] == Configure::read('project.alt_name_for_pledge_singular_small')) {
                $this->request->params['named']['project_type'] = Configure::read('project.alt_name_for_donate_singular_small');
            }
        }
        if ((Configure::read('site.launch_mode') == 'Pre-launch' && $this->Auth->user('role_id') != ConstUserTypes::Admin) || (Configure::read('site.launch_mode') == 'Private Beta' && !$this->Auth->user('id'))) {
            if (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss') {
				$this->redirect("/");
            }
            $this->layout = 'subscription';
            $this->pageTitle = Configure::read('site.launch_mode');
        } else {
            if (empty($this->request->params['named']) && empty($this->request->data['Project']['q']) && $this->RequestHandler->prefers('json') == '' && $this->RequestHandler->prefers('rss') == '') {
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'browse'
                ));
            }
            $this->pageTitle = Configure::read('project.alt_name_for_project_plural_caps');
            $discover_heading = '';
            $heading = Configure::read('project.alt_name_for_project_plural_caps');
            $limit = 21;
            $order = array(
                'Project.project_end_date' => 'asc'
            );
            $conditions = array();
            if (!empty($this->request->params['named']['q'])) {
                $this->request->data['Project']['q'] = $this->request->params['named']['q'];
            } elseif (!empty($this->request->data['Project']['q'])) {
                $this->request->params['named']['q'] = $this->request->data['Project']['q'];
            }
            if (!empty($this->request->data['Project']['q'])) {
                $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->data['Project']['q']);
                $heading.= sprintf(__l(' - Search - %s') , $this->request->data['Project']['q']);
                $order = array(
                    'Project.created' => 'DESC'
                );
            }
            if (empty($this->request->data['Project']['q']) && isset($this->request->params['named']['q'])) {
                $this->pageTitle.= __l(' - Search - All');
                $heading.= __l(' - Search - All');
            }
            if (!isPluginEnabled('Pledge')) {
                $exclude_type_arr[] = ConstProjectTypes::Pledge;
            }
            if (!isPluginEnabled('Donate')) {
                $exclude_type_arr[] = ConstProjectTypes::Donate;
            }
            if (!isPluginEnabled('Lend')) {
                $exclude_type_arr[] = ConstProjectTypes::Lend;
            }
            if (!isPluginEnabled('Equity')) {
                $exclude_type_arr[] = ConstProjectTypes::Equity;
            }
            if (isset($exclude_type_arr)) {
                $conditions['NOT']['Project.project_type_id'] = $exclude_type_arr;
            }
            $conditions['Project.is_active'] = 1;
            $conditions['Project.is_draft'] = 0;
            $conditions['Project.is_admin_suspended'] = '0';
            $view = '';
			
			if (isPluginEnabled('Pledge')){
					App::import('Model', 'Pledge.Pledge');
					$pledge = new Pledge();
					$limit = 12; 
					$projectCategories =  $pledge->PledgeProjectCategory->find('list',array(
					'fields' => array(
						'PledgeProjectCategory.name',
						'PledgeProjectCategory.slug'
					) ,
					'limit' => $limit,
					'recursive' => -1,
					'order' => array(
						'PledgeProjectCategory.name' => 'asc'
					)
					));
					$this->set('projectCategories', $projectCategories);
				}
            if (!empty($this->request->params['named']['project_type'])) {
                $projectType = $this->Project->ProjectType->find('first', array(
                    'conditions' => array(
                        'ProjectType.slug' => $this->request->params['named']['project_type']
                    ) ,
                    'fiedls' => array(
                        'ProjectType.id',
                        'ProjectType.slug',
                        'ProjectType.name',
                    ) ,
                    'recursive' => -1
                ));
                $this->set('projectType', $projectType);
                $conditions['Project.project_type_id'] = $projectType['ProjectType']['id'];
            }
            if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'home')) {
                $conditions['Project.is_featured'] = 1;
                $order = array(
                    'Project.is_featured' => 'desc',
                    'Project.project_end_date' => 'asc'
                );
            }
            if (isPluginEnabled('Idea') && !empty($this->request->params['named']['is_idea'])) {
                $this->pageTitle.= ' - ' . sprintf(__l('Vote ideas for %s') , Configure::read('project.alt_name_for_' . $this->request->params['named']['project_type'] . '_present_continuous_small'));
                $discover_heading.= sprintf(__l('Vote ideas for %s') , Configure::read('project.alt_name_for_' . $this->request->params['named']['project_type'] . '_present_continuous_small'));
                unset($conditions['OR']);
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'data' => $projectType,
                    'type' => 'idea'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
                $order = array(
                    'Project.is_featured' => 'desc',
                    'Project.total_ratings' => 'desc'
                );
                $conditions['Project.project_end_date >= '] = date('Y-m-d');
                $limit = 8;
            } else {
                if (!empty($projectType)) {
                    $type = 'open';
                    if (isset($this->request->params['named']['idea'])) {
                        $type = 'idea';
                    }
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'data' => $projectType,
                        'type' => $type
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                }
            }
            if (!empty($this->request->params['named']['filter']) || !empty($this->request->params['named']['category'])) {
				//echo "<pre>"; print_r($this->request->data['Project']); exit;
				$this->set('project_category', $this->request->params['named']['category']);
				$this->set('select_category', $this->request->params['named']['filter']);
                unset($conditions['OR']);
                switch ($this->request->params['named']['filter']) {
                    case 'browse':
                        $db = ConnectionManager::getDataSource('default');
                        $conditions['(' . $db->startQuote . 'Project' . $db->endQuote . '.' . $db->startQuote . 'project_view_count' . $db->endQuote . ' + ' . $db->startQuote . 'Project' . $db->endQuote . '.' . $db->startQuote . 'project_comment_count' . $db->endQuote . ' + ' . $db->startQuote . 'Project' . $db->endQuote . '.' . $db->startQuote . 'project_follower_count' . $db->endQuote . ') >'] = Configure::read('project.trending_project_count');
                        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                            'data' => $projectType,
                            'type' => 'open'
                        ));
                        if (!empty($response->data['conditions'])) {
                            $conditions = array_merge($conditions, $response->data['conditions']);
                        }
                        $conditions['Project.project_end_date >= '] = date('Y-m-d');
                        $order = array(
                            'Project.project_end_date' => 'asc'
                        );
                        break;

                    case 'featured':
                        $this->pageTitle.= ' - ' . __l('Featured');
                        $discover_heading.= __l('Featured');
                        $conditions['Project.is_featured'] = 1;
                        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                            'data' => $projectType,
                            'type' => 'open'
                        ));
                        if (!empty($response->data['conditions'])) {
                            $conditions = array_merge($conditions, $response->data['conditions']);
                        }
                        $conditions['Project.project_end_date >= '] = date('Y-m-d');
                        $order = array(
                            'Project.project_end_date' => 'asc'
                        );
                        break;

                    case 'almost_funded':
                        $this->pageTitle.= ' - ' . sprintf(__l('Almost %s') , Configure::read('project.alt_name_for_' . $projectType['ProjectType']['slug'] . '_past_tense_caps'));
                        $discover_heading.= sprintf(__l('Almost %s') , Configure::read('project.alt_name_for_' . $projectType['ProjectType']['slug'] . '_past_tense_caps'));
                        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                            'data' => $projectType,
                            'type' => 'notclosed'
                        ));
                        if (!empty($response->data['conditions'])) {
                            $conditions = array_merge($conditions, $response->data['conditions']);
                        }
                        $conditions['Project.collected_percentage >= '] = Configure::read('Project.almost_funded_percentage');
                        $conditions['AND']['Project.collected_percentage < '] = 100;
                        $conditions['Project.project_end_date >= '] = date('Y-m-d');
                        $order = array(
                            'Project.collected_percentage' => 'DESC'
                        );
                        break;

                    case 'ending_soon':
                        $this->pageTitle.= ' - ' . __l('Ending Soon');
                        $discover_heading.= __l('Ending Soon');
                        $conditions['Project.project_end_date >= '] = date('Y-m-d');
                        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                            'data' => $projectType,
                            'type' => 'open'
                        ));
                        if (!empty($response->data['conditions'])) {
                            $conditions = array_merge($conditions, $response->data['conditions']);
                        }
                        $order = array(
                            'Project.project_end_date' => 'ASC',
                            'Project.collected_percentage' => 'DESC'
                        );
                        break;

                    case 'successful':
                        $this->pageTitle.= ' - ' . __l('Successful');
                        $discover_heading.= __l('Successful');
                        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                            'data' => $projectType,
                            'type' => 'closed'
                        ));
                        if (!empty($response->data['conditions'])) {								
							
                            $conditions = array_merge($conditions, $response->data['conditions']);
                        }
                        $order = array(
                            'Project.project_end_date' => 'DESC'
                        );
                        break;
                }
            }
            if (!empty($this->request->params['named']['category'])) {
                $projectTypeName = ucwords($projectType['ProjectType']['name']);
                App::import('Model', $projectTypeName . '.' . $projectTypeName);
                $model = new $projectTypeName();
                $response = $model->getCategoryConditions($this->request->params['named']['category']);	
					
                $this->pageTitle.= ' - ' . __l('Category') . ' - ' . $response['category_details']['name'];
                $heading.= ' - ' . __l('Category') . ' - ' . $response['category_details']['name'];
                if (!empty($response['conditions'])) {
                    $conditions = array_merge($conditions, $response['conditions']);					
                }
				
            }
            if (!empty($this->request->params['named']['city'])) {
                $city = $this->Project->City->find('first', array(
                    'conditions' => array(
                        'City.slug' => $this->request->params['named']['city']
                    ) ,
                    'recursive' => -1
                ));
                $this->pageTitle.= ' - ' . __l('City') . ' - ' . $city['City']['name'];
                $heading.= ' - ' . __l('City') . ' - ' . $city['City']['name'];
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'page' => 'cron',
                    'type' => 'city_count'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
                $conditions['Project.city_id'] = $city['City']['id'];
            }
            if ($this->RequestHandler->prefers('json') && !empty($this->request->query['key'])) {
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'page' => 'userview',
                    'type' => 'city_count'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
            }
            if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') {
                unset($conditions['Project.city_id']);
                unset($conditions['OR']);
                if (!empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'ideaproject') {
                    $conditions['Project.user_id'] = $this->request->params['named']['user'];
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'page' => 'userview',
                        'type' => 'idea'
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                    unset($conditions['Project.project_type_id']);
                } elseif (!empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'myprojects') {
                    $conditions['Project.user_id'] = $this->request->params['named']['user'];
                    $conditions['Project.is_admin_suspended'] != 1;
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'page' => 'userview',
                        'type' => 'myprojects'
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                    unset($conditions['Project.project_type_id']);
                } elseif (!empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'fundedprojects') {
                    $projectIds = $this->Project->ProjectFund->find('list', array(
                        'conditions' => array(
                            'ProjectFund.project_fund_status_id' => array(
                                ConstProjectFundStatus::Authorized,
                                ConstProjectFundStatus::PaidToOwner,
                                ConstProjectFundStatus::Closed,
                                ConstProjectFundStatus::DefaultFund
                            ) ,
                            'ProjectFund.is_anonymous' => array(
                                ConstAnonymous::None,
                                ConstAnonymous::FundedAmount,
                            ) ,
                            'ProjectFund.user_id' => $this->request->params['named']['user'],
                        ) ,
                        'fields' => array(
                            'ProjectFund.project_id',
                            'ProjectFund.project_id',
                        ) ,
                        'recursive' => -1
                    ));
                    $conditions['Project.id'] = $projectIds;
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'page' => 'userview',
                        'type' => 'myprojects'
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                    unset($conditions['Project.project_end_date >= ']);
                } elseif (isPluginEnabled('ProjectFollowers') && !empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'followingprojects') {
                    $projectIds = $this->Project->ProjectFollower->find('list', array(
                        'conditions' => array(
                            'ProjectFollower.user_id' => $this->request->params['named']['user']
                        ) ,
                        'fields' => array(
                            'ProjectFollower.project_id',
                            'ProjectFollower.project_id'
                        ) ,
                        'recursive' => -1
                    ));
                    $conditions['Project.id'] = $projectIds;
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'page' => 'userview',
                        'type' => 'count'
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                } elseif (isPluginEnabled('Idea') && !empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'ratedprojects') {
                    $ratings = $this->Project->ProjectRating->find('all', array(
                        'conditions' => array(
                            'ProjectRating.user_id' => $this->request->params['named']['user']
                        ) ,
                        'fields' => array(
                            'ProjectRating.project_id'
                        ) ,
                        'recursive' => -1
                    ));
                    $project_ids = array();
                    foreach($ratings as $rating) {
                        array_push($project_ids, $rating['ProjectRating']['project_id']);
                    }
                    $project_ids = array_unique($project_ids);
                    $conditions['Project.id'] = $project_ids;
                    $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                        'page' => 'userview',
                        'type' => 'myprojects'
                    ));
                    if (!empty($response->data['conditions'])) {
                        $conditions = array_merge($conditions, $response->data['conditions']);
                    }
                }
            }
            $this->set('heading', $heading);
            if (!empty($discover_heading)) {
                $this->set('discover_heading', $discover_heading);
            }
            if (!isPluginEnabled('Idea') && !empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'home') {
                if (isPluginEnabled('Pledge')) {
                    $conditions['Project.project_end_date >= '] = date('Y-m-d');
                    $conditions['Pledge.pledge_project_status_id'] = array(
                        ConstPledgeProjectStatus::OpenForFunding,
                        ConstPledgeProjectStatus::GoalReached
                    );
                }
                $limit = 5;
            }
            if ($this->RequestHandler->isRss()) {
                $order = array(
                    'Project.project_end_date' => 'desc'
                );
            }
            if (!empty($this->request->data['Project']['q'])) {
                $conditions['Project.name like'] = '%' . $this->request->data['Project']['q'] . '%';
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'page' => 'userview',
                    'type' => 'search'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
                $limit = 20;
            }
            $contain = array(
                'ProjectFund' => array(
                    'conditions' => array(
                        'ProjectFund.project_fund_status_id' => array(
                            ConstProjectFundStatus::Authorized,
                            ConstProjectFundStatus::PaidToOwner,
                            ConstProjectFundStatus::Closed,
                            ConstProjectFundStatus::DefaultFund
                        )
                    ) ,
                    'User',
                    'limit' => 5,
                    'order' => array(
                        'ProjectFund.id' => 'desc'
                    )
                ) ,
                'ProjectType' => array(
                    'fields' => array(
                        'ProjectType.id',
                        'ProjectType.name',
                        'ProjectType.slug'
                    )
                ) ,
                'User' => array(
                    'UserAvatar',
                    'fields' => array(
                        'User.username',
                        'User.id'
                    )
                ) ,
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
                ) ,
                'Message' => array(
                    'conditions' => array(
                        'Message.is_sender' => '0',
                        'Message.user_id' => $this->Auth->user('id') ,
                    ) ,
                ) ,
                'Attachment',
                'Transaction',
            );
            if (isPluginEnabled('Idea')) {
                $contain['ProjectRating'] = array(
                    'User' => array(
                        'UserAvatar'
                    ) ,
                );
            }
            if (isPluginEnabled('ProjectFollowers')) {
                $contain['ProjectFollower'] = array(
                    'conditions' => array(
                        'ProjectFollower.user_id' => $this->Auth->user('id') ,
                    ) ,
                    'fields' => array(
                        'ProjectFollower.id',
                        'ProjectFollower.user_id',
                        'ProjectFollower.project_id'
                    )
                );
            }
            if (isPluginEnabled('ProjectRewards')) {
                $contain['ProjectReward'] = array();
            }
            if ((!empty($projectType) && $projectType['ProjectType']['id'] == ConstProjectTypes::Donate) || (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') || (!empty($this->request->params['named']['q'])) || (!empty($this->request->params['named']['city'])) || (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss')) {
                if (isPluginEnabled('Donate')) {
                    $contain['Donate'] = array();
                }
            }
            if ((!empty($projectType) && $projectType['ProjectType']['id'] == ConstProjectTypes::Pledge) || (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') || (!empty($this->request->params['named']['q'])) || (!empty($this->request->params['named']['city'])) || (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss')) {
                if (isPluginEnabled('Pledge')) {
                    $contain['Pledge'] = array();
                }
            }
            if ((!empty($projectType) && $projectType['ProjectType']['id'] == ConstProjectTypes::Lend) || (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') || (!empty($this->request->params['named']['q'])) || (!empty($this->request->params['named']['city'])) || (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss')) {
                if (isPluginEnabled('Lend')) {
                    $contain['Lend'] = array();
                }
            }
            if ((!empty($projectType) && $projectType['ProjectType']['id'] == ConstProjectTypes::Equity) || (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') || (!empty($this->request->params['named']['q'])) || (!empty($this->request->params['named']['city'])) || (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss')) {
                if (isPluginEnabled('Equity')) {
                    $contain['Equity'] = array();
                }
            }
            if (!empty($this->request->params['named']['city'])) {
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'ProjectType' => isset($projectType) ? $projectType : '',
                    'page' => 'userview',
                    'type' => 'open'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
            }
            if (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss') {
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'type' => 'count',
                    'page' => 'rss'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
                $total_project_count = $this->Project->find('count', array(
                    'conditions' => $conditions,
                    'recursive' => 3
                ));
                $limit = $total_project_count;
            }
            if (isset($this->request->params['named']['q']) && isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'idea') {
                unset($conditions['OR']);
                $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                    'data' => $projectType,
                    'type' => 'idea'
                ));
                if (!empty($response->data['conditions'])) {
                    $conditions = array_merge($conditions, $response->data['conditions']);
                }
                $order = array(
                    'Project.is_featured' => 'desc',
                    'Project.total_ratings' => 'desc'
                );
                $conditions['Project.project_end_date >= '] = date('Y-m-d');
                $limit = 2;
            }
			
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => $contain,
                'order' => $order,
                'recursive' => 3,
                'limit' => $limit,
            );
            if ($this->RequestHandler->prefers('json') && !empty($this->request->query['key'])) {
                $response = Cms::dispatchEvent('Controller.ProjectType.getContain', $this, array(
                    'type' => 1
                ));
                $event_data['contain'] = $response->data['contain'];
                $event_data['conditions'] = $conditions;
                $event_data['order'] = $order;
                $event_data['limit'] = $limit;
                $event_data = Cms::dispatchEvent('Controller.Project.listing', $this, array(
                    'data' => $event_data
                ));
            }
			
            $this->set('project_type', isset($this->request->params['named']['project_type']) && $this->request->params['named']['project_type']);
            $this->set('projects', $this->paginate());
            if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'home') {
                $this->pageTitle = __l('Home');
                $view = 1;
            }
            $ajax_view = 0;
            if ($this->RequestHandler->isAjax()) {
                $ajax_view = 1;
            }
            $this->set('ajax_view', $ajax_view);
            if (!empty($this->request->params['ext']) && $this->request->params['ext'] == 'rss') {
                $this->autoRender = false;
                $this->render('index');
            } else if ($view) {
                $projectTypes = $this->Project->ProjectType->find('all', array(
                    'fields' => array(
                        'ProjectType.name',
                        'ProjectType.slug'
                    ) ,
                    'recursive' => -1
                ));
                $this->set('projectTypes', $projectTypes);
                $this->autoRender = false;
                $this->render('index_list');
            }
        }
    }
    public function discover()
    {
        $this->pageTitle = __l('Browse');
        $projectTypes = $this->Project->ProjectType->find('all', array(
            'conditions' => array(
                'ProjectType.is_active' => 1
            ) ,
            'fields' => array(
                'ProjectType.name',
                'ProjectType.slug'
            ) ,
            'recursive' => -1
        ));
        $this->set('projectTypes', $projectTypes);
        if (!empty($this->request->params['named']['project_type'])) {
            if (!isPluginEnabled(ucfirst($this->request->params['named']['project_type']))) {
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'browse',
                ));
            }
            $this->set('project_type', $this->request->params['named']['project_type']);
        }
    }
    public function view($slug = null, $view = null, $hash = null)
    {
        $this->pageTitle = Configure::read('project.alt_name_for_project_singular_caps');
        if (is_null($slug)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $condition['Project.is_active'] = 1;
        $condition['Project.slug'] = $slug;
        $funded_users = $this->Project->ProjectFund->find('count', array(
            'contain' => array(
                'Project'
            ) ,
            'conditions' => array(
                'ProjectFund.user_id' => $this->Auth->user('id') ,
                'Project.slug' => $slug,
            ) ,
            'recursive' => 0,
        ));
        $project_detail_condition['Project.slug'] = $slug;
        $project_detail = $project = $this->Project->find('first', array(
            'conditions' => $project_detail_condition,
            'recursive' => -1
        ));
        if ($this->Auth->user('role_id') == ConstUserTypes::Admin || $funded_users || $this->Auth->user('id') == $project_detail['Project']['user_id']) {
            unset($condition['Project.is_active']);
        }
        $contain = array(
            'User' => array(
                'UserAvatar',
                'UserProfile' => array(
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
                        ) ,
                    ) ,
                ) ,
                'UserWebsite' => array(
                    'fields' => array(
                        'UserWebsite.id',
                        'UserWebsite.website'
                    )
                ) ,
            ) ,
            'Submission' => array(
                'SubmissionField' => array(
                    'ProjectCloneThumb',
                    'SubmissionThumb',
                    'FormField'
                ) ,
            ) ,
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
            ) ,
            'Attachment',
            'ProjectType' => array(
                'fields' => array(
                    'ProjectType.name',
                    'ProjectType.slug',
                    'ProjectType.funder_slug',
                    'ProjectType.id',
                ) ,
            ) ,
            'ProjectFund' => array(
                'User' => array(
                    'UserAvatar'
                ) ,
                'limit' => 4,
                'order' => array(
                    'ProjectFund.id' => 'desc'
                )
            ) ,
        );
        if (isPluginEnabled('ProjectRewards')) {
            $contain['ProjectReward'] = array(
                'order' => array(
                    'ProjectReward.pledge_amount' => 'asc'
                )
            );
        }
        if (isPluginEnabled('Idea')) {
            $contain['ProjectRating'] = array(
                'fields' => array(
                    'ProjectRating.user_id'
                ) ,
                'User'
            );
        }
        $response = Cms::dispatchEvent('Controller.ProjectType.getContain', $this, array(
            'type' => 1
        ));
        $event_data['contain'] = $response->data['contain'];
        $contain = array_merge($contain, $response->data['contain']);
        $project = $this->Project->find('first', array(
            'conditions' => $condition,
            'contain' => $contain,
            'recursive' => 3,
        ));
        if (empty($project)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $followed_user = 0;
        if (isPluginEnabled('ProjectFollowers') && $this->Auth->user('id')) {
            $followed_user = $this->Project->ProjectFollower->find('count', array(
                'conditions' => array(
                    'ProjectFollower.user_id' => $this->Auth->user('id') ,
                ) ,
                'recursive' => -1
            ));
        }
        $projectTypeName = ucwords($project['ProjectType']['name']);
        App::import('Model', $projectTypeName . '.' . $projectTypeName);
        $model = new $projectTypeName();
        $response = $model->isAllowToViewProject($project, $funded_users, $followed_user);
        if (empty($response['is_allow_to_view_project'])) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $time_strap = strtotime($project['Project']['project_end_date']) -strtotime(date('Y-m-d'));
        $days = floor($time_strap/(60*60*24));
        if ($days > 0) {
            $project[0]['enddate'] = $days;
        } else {
            $project[0]['enddate'] = 0;
			$hours_strap = strtotime($project['Project']['project_end_date'] . ' 23:59:59') - strtotime(date('Y-m-d H:i:s'));
			$hours = floor($hours_strap/(60*60));
			if($hours > 0) {
				$project[0]['endhour'] = $hours;
			}else{
				$project[0]['endhour'] = 0;
			}
        }
        $project[0]['enddate'] = (strtotime($project['Project']['project_end_date']) -strtotime(date('Y-m-d'))) /(60*60*24);
        if ($this->Auth->user('id') != $project_detail['Project']['user_id'] && $this->Auth->user('role_id') != ConstUserTypes::Admin && (!empty($project['Project']['is_private']) && $project['Project']['is_private'] == 1) && is_null($hash)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $submissionFieldLabel = array();
        $submissionFieldOption = array();
        $submissionFieldDisplay = array();
        $this->loadModel('Projects.FormField');
        if (!empty($project['Project']['project_type_id'])) {
            $FormFields = $this->FormField->find('all', array(
                'conditions' => array(
                    'FormField.project_type_id' => $project['Project']['project_type_id'],
                    'FormField.is_active' => 1
                ) ,
                'order' => array(
                    'FormField.name' => 'asc'
                )
            ));
        }
        if (!empty($FormFields)) {
            foreach($FormFields as $key => $formField) {
                if ($formField['FormField']['is_dynamic_field'] == 1) {
                    $submissionFieldLabel[$formField['FormField']['name']] = $formField['FormField']['label'];
                    $submissionFieldOption[$formField['FormField']['name']] = $formField['FormField']['options'];
                    $submissionFieldDisplay[$formField['FormField']['name']] = (!empty($formField['FormField']['display_text']) ? $formField['FormField']['display_text'] : '');
                }
            }
        }
        $this->set('submissionFieldLabel', $submissionFieldLabel);
        $this->set('submissionFieldOption', $submissionFieldOption);
        $this->set('submissionFieldDisplay', $submissionFieldDisplay);
        $depends_on_fields = array();
        if (!empty($project['Submission']['SubmissionField'])) {
            foreach($project['Submission']['SubmissionField'] as $submissionField) {
                if (!empty($submissionField['FormField']['depends_on'])) {
                    if (empty($depends_on_fields[$submissionField['FormField']['depends_on']])) {
                        $depends_on_fields[$submissionField['FormField']['depends_on']] = array();
                    }
                    array_push($depends_on_fields[$submissionField['FormField']['depends_on']], $submissionField);
                }
            }
        }
        $this->set('depends_on_fields', $depends_on_fields);
        if (isPluginEnabled('Idea')) {
            $project_rating_count = $this->Project->ProjectRating->find('first', array(
                'conditions' => array(
                    'ProjectRating.project_id' => $project['Project']['id'],
                    'ProjectRating.user_id' => $this->Auth->user('id') ,
                ) ,
                'fields' => array(
                    'ProjectRating.project_id',
                )
            ));
            $this->set('project_rating_count', $project_rating_count);
        }
        if (($project['Project']['is_active'] == 0 || $project['Project']['is_admin_suspended'] == 1) && ($this->Auth->user('id') != $project['Project']['user_id']) && $this->Auth->user('role_id') != ConstUserTypes::Admin && (!$funded_users)) {
            if (!empty($project['Project']['is_admin_suspended'])) {
                $this->Session->setFlash(sprintf(__l('Admin was suspended this %s.') , Configure::read('project.alt_name_for_project_singular_small')) , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'index',
                    'type' => 'home'
                ));
            }
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($project['Project']['name'])) {
           
			$project_url = Router::url(array(
            'controller' => 'projects',
            'action' => 'view',
            $project['Project']['slug'],
			) , true);
		 Configure::write('meta.project_name', $project['Project']['name']);
		 Configure::write('meta.project_url', $project_url);
		 Configure::write('meta.project_description', $project['Project']['description']);
        }
        if (!empty($project['Attachment'])) {
            $image_options = array(
                'dimension' => 'small_big_thumb',
                'class' => '',
                'alt' => $project['Project']['name'],
                'title' => $project['Project']['name'],
                'type' => 'png',
                'full_url' => true
            );
            $project_image = getImageUrl('Project', $project['Attachment'], $image_options);
            Configure::write('meta.project_image', $project_image);
        }
        if (isPluginEnabled('ProjectFollowers')) {
            $follower = $this->Project->ProjectFollower->find('first', array(
                'conditions' => array(
                    'ProjectFollower.user_id' => $this->Auth->user('id') ,
                    'ProjectFollower.project_id' => $project['Project']['id']
                ) ,
                'fields' => array(
                    'ProjectFollower.id',
                    'ProjectFollower.user_id',
                    'ProjectFollower.project_id'
                ) ,
                'recursive' => -1
            ));
            $this->set('follower', $follower);
        }
        $backer = $this->Project->ProjectFund->find('count', array(
            'conditions' => array(
                'ProjectFund.project_fund_status_id' => array(
                    ConstProjectFundStatus::Authorized,
                    ConstProjectFundStatus::PaidToOwner,
                    ConstProjectFundStatus::Closed,
                    ConstProjectFundStatus::DefaultFund
                ) ,
                'ProjectFund.project_id' => $project['Project']['id'],
            ) ,
            'recursive' => -1
        ));
        if ($this->RequestHandler->prefers('json') && !empty($this->request->query['key'])) {
            $event_data['project'] = $project;
            $event_data['backer'] = $backer;
            Cms::dispatchEvent('Controller.Project.view', $this, array(
                'data' => $event_data
            ));
        }
        $this->set('backer', $project['Project']['project_fund_count']);
        $this->Project->ProjectView->create();
        $data['ProjectView']['project_id'] = $project['Project']['id'];
        $data['ProjectView']['project_type_id'] = $project['Project']['project_type_id'];
        $data['ProjectView']['user_id'] = $this->Auth->user('id');
        if ($view == 'widget') {
            $data['ProjectView']['project_view_type_id'] = ConstViewType::EmbedView;
        } else {
            $data['ProjectView']['project_view_type_id'] = ConstViewType::NormalView;
        }
        $data['ProjectView']['ip_id'] = $this->Project->ProjectView->toSaveIp();
        $this->Project->ProjectView->save($data, false);
        Configure::write('meta.keywords', $project['Project']['short_description']);
        Configure::write('meta.description', 'Funding for ' . $project['Project']['name']);
        $project_title = $project['Project']['name'];
        $this->pageTitle.= ' - ' . $project_title;
        $project['Project']['project_end_date'] = $project['Project']['project_end_date'] . ' 23:59:59';
        $this->set('project', $project);
        $count_conditions = array();
        $count_conditions = array(
            'Project.user_id' => $project['User']['id'],
            'Project.is_admin_suspended !=' => 1,
            'Project.is_active' => 1,
        );
        $conditions = array();
        $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
            'type' => 'count',
            'page' => 'userview'
        ));
        if (!empty($response->data['conditions'])) {
            $conditions = array_merge($count_conditions, $response->data['conditions']);
        }
        $project_count_contain = array();
        if (isPluginEnabled('Pledge')) {
            $project_count_contain['Pledge'] = array();
        }
        if (isPluginEnabled('Donate')) {
            $project_count_contain['Donate'] = array();
        }
        if (isPluginEnabled('Equity')) {
            $project_count_contain['Equity'] = array();
        }
        if (isPluginEnabled('Lend')) {
            $project_count_contain['Lend'] = array();
        }
        $project_count = $this->Project->find('count', array(
            'conditions' => $conditions,
            'contain' => $project_count_contain,
            'recursive' => 0
        ));
        $this->set('project_count', $project_count);
        if (isPluginEnabled('SocialMarketing')) {
            $social_url = Router::url(array(
                'controller' => 'social_marketings',
                'action' => 'publish',
                $project['Project']['id'],
                'type' => 'facebook',
                'publish_action' => 'add',
                'admin' => false
            ) , true);
            $this->set('share_url', $social_url);
        }
        if (isPluginEnabled('ProjectFollowers')) {
            $projectIds = $this->Project->ProjectFollower->find('list', array(
                'conditions' => array(
                    'ProjectFollower.user_id' => $project['User']['id']
                ) ,
                'fields' => array(
                    'ProjectFollower.project_id',
                    'ProjectFollower.project_id'
                ) ,
                'recursive' => -1
            ));
            $count_conditions['Project.id'] = $projectIds;
            $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                'type' => 'count',
                'page' => 'userview'
            ));
            if (!empty($response->data['conditions'])) {
                $conditions = array_merge($count_conditions, $response->data['conditions']);
            }
            $project_following_count = $this->Project->find('count', array(
                'conditions' => $conditions,
                'recursive' => 0
            ));
            $this->set('project_following_count', $project_following_count);
        }
        $is_comment_allow = $model->onProjectViewMessageDisplay($project);
        $this->set('is_comment_allow', $is_comment_allow);
        if (!empty($view)) {
            if ($view == 'widget') {
                $this->layout = 'embed';
            }
            $this->render($view);
        }
    }
    public function add($project_id = '', $form_field_step = '')
    {
        $_SESSION['post_action'] = 'add';
        Cms::dispatchEvent('Controller.Project.projectStart', $this, array(
            'data' => $this->request->params,
            'project_id' => $project_id
        ));
        if (!empty($this->request->params['named']['project_type'])) {
            if (!isPluginEnabled(ucfirst($this->request->params['named']['project_type']))) {
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'browse',
                ));
            }
        }
        if (!empty($_SESSION['lendDetails']) && !empty($this->request->data['Project'])) {
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.slug' => 'lend'
                ) ,
                'recursive' => -1
            ));
            $this->request->data['Project']['user_id'] = $this->Auth->user('id');
            $this->request->data['Project']['project_type_id'] = ConstProjectTypes::Lend;
            $this->request->data['Project']['needed_amount'] = $_SESSION['lendDetails']['lend_needed_amount'];
            $this->request->data['Lend']['target_interest_rate'] = $_SESSION['lendDetails']['lend_interest_rate'];
            $this->request->data['Lend']['lend_project_category_id'] = $_SESSION['lendDetails']['lend_category_id'];
            $this->request->data['Lend']['per_month'] = $_SESSION['lendDetails']['lend_per_month'];
            $this->request->data['Project']['project_end_date'] = date('Y-m-d', strtotime('+1 days'));
            if (isset($projectType['ProjectType']['listing_fee']) and $projectType['ProjectType']['listing_fee'] != 0 and !empty($projectType['ProjectType']['listing_fee_type'])) {
                if ($projectType['ProjectType']['listing_fee_type'] == ConstListingFeeType::amount) {
                    $fee_amount = $projectType['ProjectType']['listing_fee'];
                } else {
                    $fee_amount = $this->request->data['Project']['needed_amount']*($projectType['ProjectType']['listing_fee']/100);
                }
                $this->request->data['Project']['fee_amount'] = $fee_amount;
            } else {
                if (Configure::read('Project.project_listing_fee_type') == 'amount') {
                    $fee_amount = Configure::read('Project.listing_fee');
                } else {
                    $fee_amount = $this->request->data['Project']['needed_amount']*(Configure::read('Project.listing_fee') /100);
                }
                $this->request->data['Project']['fee_amount'] = $fee_amount;
            }
            $this->Project->save($this->request->data['Project']);
            $this->request->data['Project']['id'] = $this->Project->id;
            $this->request->data['Lend']['user_id'] = $this->Auth->user('id');
            $this->request->data['Lend']['lend_project_category_id'] = $_SESSION['lendDetails']['lend_category_id'];
            $this->request->data['Lend']['credit_score_id'] = $_SESSION['lendDetails']['lend_credit_score_id'];
            $this->request->data['Lend']['lend_project_status_id'] = ConstLendProjectStatus::Pending;
            $response = Cms::dispatchEvent('Controller.Projects.afterCheckRate', $this, array(
                'data' => $this->request->data
            ));
            $this->Session->delete('lendDetails');
            $this->redirect(array(
                'controller' => 'projects',
                'action' => 'add',
                'project_type' => 'lend',
                $this->request->data['Project']['id'],
                'step' => 1
            ));
        }
        // form field steps
        if (!empty($form_field_step)) {
            $this->request->data['Project']['form_field_step'] = $form_field_step;
            $this->request->data['Project']['step'] = 2;
            if (empty($this->request->data['Project']['project_end_date'])) {
                $end_date = explode('-', date('Y-m-d', strtotime('+' . Configure::read('maximum_project_expiry_day') . ' days')));
                $this->request->data['Project']['project_end_date']['month'] = $end_date[1];
                $this->request->data['Project']['project_end_date']['day'] = $end_date[2];
                $this->request->data['Project']['project_end_date']['year'] = $end_date[0];
            }
        }
        if (isPluginEnabled('Idea')) {
            $this->pageTitle = sprintf(__l('Add %s') , __l('Idea'));
        } else {
            $this->pageTitle = sprintf(__l('Add %s') , Configure::read('project.alt_name_for_project_singular_caps'));
        }
        $this->loadModel('Projects.Form');
        $this->loadModel('Projects.FormField');
        $userProfile = array();
        $project_user_id = (!empty($this->request->data['Project']['user_id'])) ? $this->request->data['Project']['user_id'] : $this->Auth->user('id');
        $userProfile = $this->Project->User->UserProfile->find('first', array(
            'conditions' => array(
                'UserProfile.user_id' => $project_user_id,
            ) ,
            'contain' => array(
                'City',
                'State',
                'Country',
                'User',
            ) ,
            'recursive' => 0
        ));
        $this->set('userProfile', $userProfile);
        if (!empty($project_id) || !empty($this->request->data['Project']['id'])) {
            if (!empty($this->request->data['Project']['id'])) {
                $project_id = $this->request->data['Project']['id'];
            }
            $conditions['Project.id'] = $project_id;
            if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
                $conditions['Project.user_id'] = $this->Auth->user('id');
            }
            $tmpProject = $this->Project->find('first', array(
                'conditions' => $conditions,
                'contain' => array(
                    'Country'
                ) ,
                'recursive' => 0
            ));
            if (empty($tmpProject)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            if (!empty($this->request->data)) {
                foreach($tmpProject['Project'] as $key => $value) {
                    if (!isset($this->request->data['Project'][$key]) && !empty($value)) {
                        $this->request->data['Project'][$key] = $value;
                        if ($key == 'country_id') {
                            $this->request->data['Project'][$key] = $tmpProject['Country']['iso_alpha2'];
                        }
                    }
                }
            }
        }
        if (!empty($this->request->params['named']['project_type']) || !empty($this->request->data['Project']['project_type_slug'])) {
            $project_type_slug = !empty($this->request->params['named']['project_type']) ? $this->request->params['named']['project_type'] : $this->request->data['Project']['project_type_slug'];
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.slug' => $project_type_slug
                ) ,
                'recursive' => -1
            ));
            $projectTypeFormFields = $this->Form->buildSchema($projectType['ProjectType']['id']);
			
			$form_field_steps_conditions['FormFieldStep.project_type_id'] = $projectType['ProjectType']['id'];
			// Get payment and payout step only if Sudopay is enable
			if (!isPluginEnabled('Sudopay')) {
				$form_field_steps_conditions['FormFieldStep.is_payout_step'] = 0;
			}
			
            $this->loadModel('Projects.FormFieldStep');
            $FormFieldSteps = $this->FormFieldStep->find('all', array(
                'conditions' => $form_field_steps_conditions,
                'contain' => array(
                    'FormFieldGroup' => array(
                        'conditions' => array() ,
                        'FormField' => array(
                            'conditions' => array(
                                'FormField.is_active' => 1,
                            ) ,
                            'order' => array(
                                'FormField.order' => 'ASC'
                            )
                        ) ,
                        'order' => array(
                            'FormFieldGroup.order' => 'ASC'
                        )
                    )
                ) ,
                'order' => array(
                    'FormFieldStep.order' => 'ASC'
                ) ,
                'recursive' => 2
            ));
            $project = $this->Project->find('first', array(
            		'conditions' => array(
            				'Project.id' => $project_id
            		) ,
            		'contain' => array(
            				'ProjectType',
            				'User'
            		) ,
            		'recursive' => 0
            ));
            //$data['Project']['id'] = $this->Project->id;
            if((count($FormFieldSteps) == $form_field_step && isPluginEnabled('Wallet')) || !empty($project['User']['sudopay_receiver_account_id'])){
            	 $this->Project->updateAll(array(
                            'Project.is_draft' => 0
                        ) , array(
                            'Project.id' => $project_id
                        ));
            }      
            if (!empty($FormFieldSteps)) {
                $total_groups_removed = 0;
                $total_fields_removed = 0;
                $temp_FormFieldSteps = $FormFieldSteps;
                $order = 1;
				foreach($temp_FormFieldSteps as $step_key => $FormFieldStep) {
                    if (empty($FormFieldStep['FormFieldStep']['is_splash']) && empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        $total_groups_in_step = count($FormFieldStep['FormFieldGroup']);
                        if ($total_groups_in_step == 0 && empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                            unset($FormFieldSteps[$step_key]);
                            continue;
                        }
                        foreach($FormFieldStep['FormFieldGroup'] as $group_key => $FormFieldGroup) {
                            $total_fields_in_group = count($FormFieldGroup['FormField']);
                            $total_groups_removed = 0;
                            if ($total_fields_in_group == 0) {
                                unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                $total_groups_removed++;
                                continue;
                            }
                            if (($FormFieldGroup['name'] == 'Project Updates') && !isPluginEnabled('ProjectUpdates')) {
                                unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                $total_groups_removed++;
                                continue;
                            }
                            foreach($FormFieldGroup['FormField'] as $field_key => $FormField) {
                                $remove_field = 0;
                                $_data = explode('.', $FormField['name']);
                                if ($_data[0] == 'ProjectReward' && !isPluginEnabled('ProjectRewards')) {
                                    $remove_field = 1;
                                }
                                if (!empty($remove_field)) {
                                    unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]['FormField'][$field_key]);
                                    $total_fields_removed++;
                                }
                                if (!empty($total_fields_removed) && $total_fields_in_group == $total_fields_removed) {
                                    unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                    $total_groups_removed++;
                                    $total_fields_removed = 0;
                                }
                            }
                        }
                        if (!empty($total_groups_removed) && $total_groups_in_step == $total_groups_removed) {
                            unset($FormFieldSteps[$step_key]);
                            $total_groups_removed = 0;
                        }
                    } elseif (!empty($tmpProject['Project']['is_paid']) && !empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        unset($FormFieldSteps[$step_key]);
                    } else if (empty($FormFieldStep['FormFieldStep']['is_splash']) && !empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        if ((($projectType['ProjectType']['listing_fee'] == 0) || ($projectType['ProjectType']['listing_fee'] == null))) {
                            if (!Configure::read('Project.listing_fee')) {
                                unset($FormFieldSteps[$step_key]);
                            }
                        }
                    }
                    if (!empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                        if (isPluginEnabled('Sudopay')) {
                            $this->loadModel('Sudopay.Sudopay');
                            $is_having_pending_gateways_connect = $this->Sudopay->isHavingPendingGatewayConnect($this->Auth->user('id'));
                            if (empty($is_having_pending_gateways_connect)) {
                                unset($FormFieldSteps[$step_key]);
                            }
                        } else {
							unset($FormFieldSteps[$step_key]);
						}
                    }
                }
            }
			$this->set('total_form_field_steps', count($FormFieldSteps));
            $this->set('FormFieldSteps', $FormFieldSteps);
            $this->set('projectTypeFormFields', $projectTypeFormFields);
            $this->set('projectType', $projectType);
            $this->set('project_type_slug', $project_type_slug);
        }
        if (empty($this->request->data['Project']['project_end_date'])) {
            $end_date = explode('-', date('Y-m-d', strtotime('+1 days')));
            $this->request->data['Project']['project_end_date']['month'] = $end_date[1];
            $this->request->data['Project']['project_end_date']['day'] = $end_date[2];
            $this->request->data['Project']['project_end_date']['year'] = $end_date[0];
        }
        if (!empty($this->request->data) && $this->request->isPost()) {
            $this->request->data['Project']['user_id'] = !empty($this->request->data['Project']['user_id']) ? $this->request->data['Project']['user_id'] : $this->Auth->user('id');
            if (!empty($this->request->data['Project']['pledge_type_id']) && $this->request->data['Project']['pledge_type_id'] == ConstPledgeTypes::Any) {
                unset($this->request->data[ucfirst($this->request->data['Project']['project_type_slug']) ]['min_amount_to_fund']);
            }
            if (!empty($this->request->data['Project']['step']) && $this->request->data['Project']['step'] == 2) {
                if (!empty($this->request->data['Attachment']['filename']['name']) && !Configure::read('Project.image.allowEmpty')) {
                    $this->Project->Attachment->Behaviors->attach('ImageUpload', Configure::read('Project.image'));
                    $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
                    $this->Project->Attachment->set($this->request->data);
                }
                $this->Project->set($this->request->data);
                $this->Project->User->UserProfile->set($this->request->data);
                if (isset($this->request->data['State']['name'])) {
                    $this->Project->State->set($this->request->data);
                }
                if (isset($this->request->data['City']['name'])) {
                    $this->Project->City->set($this->request->data);
                }
                $this->request->data['Project']['ip_id'] = $this->Project->toSaveIp();
                if (!empty($this->request->data['Attachment']['filename']['name'])) {
                    $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
                }
                if (empty($this->request->data['Project']['is_active'])) {
                    $this->request->data['Project']['is_active'] = 1;
                }
                if (!empty($this->request->data['Project']['draft'])) {
                    $this->request->data['Project']['is_draft'] = 1;
                } else {
                    $this->request->data['Project']['is_draft'] = 0;
                }
                $projectType = $this->Project->ProjectType->find('first', array(
                    'conditions' => array(
                        'ProjectType.slug' => $this->request->data['Project']['project_type_slug']
                    ) ,
                ));
                $response = Cms::dispatchEvent('Model.Project.beforeAdd', $this, array(
                    'data' => $this->request->data
                ));
                if (empty($this->request->data['Form'])) {
                    $this->request->data['Form'] = array();
                }
                $this->request->data['ValidateForm'] = $this->request->data['Form'];
                $formFields = $this->FormField->find('list', array(
                    'condition' => array(
                        'FormField.project_type_id' => $projectType['ProjectType']['id']
                    ) ,
                    'fields' => array(
                        'name',
                        'type'
                    )
                ));
                if (!empty($this->request->data['Form'])) {
                    foreach($this->request->data['Form'] as $tmpFormField => $value) {
                        $field_type = $formFields[$tmpFormField];
                        if (!empty($field_type) && ($field_type == 'date' || $field_type == 'datetime' || $field_type == 'time')) {
                            if ($field_type == 'date') {
                                $format = 'Y-m-d';
                            } elseif ($field_type == 'datetime') {
                                $format = 'Y-m-d H:i:s';
                            } elseif ($field_type == 'time') {
                                $format = 'H:i:s';
                            }
                            $this->request->data['ValidateForm'][$tmpFormField] = $this->Form->deconstructDate($value, $field_type, $format);
                        }
                    }
                    $this->Form->set($this->request->data['ValidateForm']);
                }
                $is_payout_error = 0;
                $is_payout_step = $this->FormFieldStep->find('first', array(
                    'conditions' => array(
                        'FormFieldStep.order' => $this->request->data['Project']['form_field_step'],
                        'FormFieldStep.is_payout_step' => 1,
                        'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                    ) ,
                    'recursive' => -1
                ));
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $this->Auth->user('id')
                    ) ,
                    'recursive' => -1
                ));
                if (empty($user['User']['sudopay_receiver_account_id']) && !isPluginEnabled('Wallet') && (!empty($is_payout_step) && isPluginEnabled('Sudopay'))) {
                    $is_payout_error = 1;
                }
                $is_addrees_ok = true;
                
                if (($form_field_step == 2 || $this->request->data['Project']['form_field_step'] == 2) && (!$this->Project->City->validates() or !$this->Project->State->validates())) {
                	$is_addrees_ok = false;
                }
                
                if ($this->Project->validates() &$this->Form->validates() &$this->Project->Attachment->validates() &empty($response->data['error'][$projectType['ProjectType']['name']]) &$is_addrees_ok &empty($response->data['error']['ProjectReward']) &empty($is_payout_error)) {
                    if (empty($this->request->data['Project']['id'])) {
                        $this->Project->create();
                    }
                    if (!empty($this->request->data['Project']['country_id'])) {
                        $this->request->data['Project']['country_id'] = $this->Project->Country->findCountryId($this->request->data['Project']['country_id']);
                    }
                    if (!empty($this->request->data['State']['name'])) {
                        $this->request->data['State']['country_id'] = $this->request->data['Project']['country_id'];
                        $this->request->data['Project']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->Project->State->findOrSaveAndGetIdWithArray($this->request->data['State']['name'], $this->request->data['State']);
                    }
                    if (!empty($this->request->data['City']['name'])) {
                        $this->request->data['City']['state_id'] = $this->request->data['Project']['state_id'];
                        $this->request->data['City']['country_id'] = $this->request->data['Project']['country_id'];
                        $this->request->data['Project']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->Project->City->findOrSaveAndGetIdWithArray($this->request->data['City']['name'], $this->request->data['City']);
                    }
                    if ($this->request->data['Project']['form_field_step'] == 1) {
                        if (isset($projectType['ProjectType']['listing_fee']) and $projectType['ProjectType']['listing_fee'] != 0 and !empty($projectType['ProjectType']['listing_fee_type'])) {
                            if ($projectType['ProjectType']['listing_fee_type'] == ConstListingFeeType::amount) {
                                $fee_amount = $projectType['ProjectType']['listing_fee'];
                            } else {
                                $fee_amount = $this->request->data['Project']['needed_amount']*($projectType['ProjectType']['listing_fee']/100);
                            }
                            $this->request->data['Project']['fee_amount'] = $fee_amount;
                        } else {
                            if (Configure::read('Project.project_listing_fee_type') == 'amount') {
                                $fee_amount = Configure::read('Project.listing_fee');
                            } else {
                                $fee_amount = $this->request->data['Project']['needed_amount']*(Configure::read('Project.listing_fee') /100);
                            }
                            $this->request->data['Project']['fee_amount'] = $fee_amount;
                        }
                    }
                    Cms::dispatchEvent('Controller.Project.beforeAdd', $this, array(
                        'data' => $this->request->data
                    ));
                    if ($this->Project->save($this->request->data, false)) {
                        $this->request->params['named']['project_id'] = $this->Project->id;
						$projectId = $this->Project->id;
                        $project = $this->Project->find('first', array(
                            'conditions' => array(
                                'Project.id' => $projectId
                            ) ,
                            'contain' => array(
                                'Attachment',
                                'User',
                                'ProjectType'
                            ) ,
                            'recursive' => 2
                        ));
                        if (isPluginEnabled('ProjectFollowers')) {
                            $follower = $this->Project->ProjectFollower->find('first', array(
                                'conditions' => array(
                                    'ProjectFollower.project_id' => $projectId,
                                    'ProjectFollower.user_id' => $this->Auth->user('id') ,
                                    'ProjectFollower.project_type_id' => $projectType['ProjectType']['id']
                                )
                            ));
                            if (empty($follower)) {
                                $this->request->data['ProjectFollower']['user_id'] = $this->Auth->user('id');
                                $this->request->data['ProjectFollower']['project_id'] = $projectId;
                                $this->request->data['ProjectFollower']['project_type_id'] = $projectType['ProjectType']['id'];
                                $this->Project->ProjectFollower->save($this->request->data);
                                Cms::dispatchEvent('Controller.IntegratedGoogleAnalytics.trackEvent', $this, array(
                                    '_trackEvent' => array(
                                        'category' => 'User',
                                        'action' => 'Followed',
                                        'label' => $this->Auth->user('username') ,
                                        'value' => '',
                                    ) ,
                                    '_setCustomVar' => array(
                                        'ud' => $this->Auth->user('id') ,
                                        'rud' => $this->Auth->user('referred_by_user_id') ,
                                    )
                                ));
                                Cms::dispatchEvent('Controller.IntegratedGoogleAnalytics.trackEvent', $this, array(
                                    '_trackEvent' => array(
                                        'category' => 'ProjectFollower',
                                        'action' => 'Followed',
                                        'label' => $projectId,
                                        'value' => '',
                                    ) ,
                                    '_setCustomVar' => array(
                                        'pd' => $projectId,
                                        'ud' => $this->Auth->user('id') ,
                                        'rud' => $this->Auth->user('referred_by_user_id') ,
                                    )
                                ));
                            }
                        }
                        if (!empty($this->request->data['Attachment']['filename']['name'])) {
                            $this->Project->Attachment->create();
                            $this->request->data['Attachment']['class'] = 'Project';
                            $this->request->data['Attachment']['foreign_id'] = (!empty($project_id)) ? $project_id : $projectId;
                            $this->Project->Attachment->save($this->request->data['Attachment']);
                        }
                        //Save hash
                        $data['Project']['hash'] = md5($projectId);
                        if (!empty($this->request->data['Project']['draft']) || (empty($this->request->data['Project']['draft']) && $this->request->data['Project']['form_field_step'] != count($FormFieldSteps))) {
                            $data['Project']['is_draft'] = 1;
                        } else {
                            $data['Project']['is_draft'] = 0;
                        }
                        $data['Project']['id'] = $projectId;
                        $this->Project->save($data);
                        //Save Dynamic form fields
                        $this->loadModel('Projects.Submission');
                        if (!empty($this->request->data['Form'])) {
                            $this->request->data['Submission'] = $this->request->data['Form'];
                            $this->request->data['Submission']['project_id'] = $projectId;
                            $submission = $this->Submission->find('first', array(
                                'conditions' => array(
                                    'Submission.project_id' => $projectId
                                ) ,
                                'recursive' => -1
                            ));
                            if (!empty($submission)) {
                                $this->request->data['Submission']['id'] = $submission['Submission']['id'];
                            }
                            $this->Submission->submit($this->request->data);
                        }
                        $this->request->data['Project']['id'] = $project['Project']['id'];
                        $response = Cms::dispatchEvent('Controller.Projects.afterAdd', $this, array(
                            'data' => $this->request->data
                        ));
                        $projectStatus = array();
                        $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                            'projectStatus' => $projectStatus,
                            'project' => $project,
                            'type' => 'status'
                        ));
						$is_next_payout_step = $this->FormFieldStep->find('first', array(
							'conditions' => array(
								'FormFieldStep.order' => $this->request->data['Project']['form_field_step']+1,
								'FormFieldStep.is_payout_step' => 1,
								'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
							) ,
							'recursive' => -1
						));
						if(!empty($is_next_payout_step) && ((!isPluginEnabled('Sudopay') && $this->request->data['Project']['form_field_step'] < count($FormFieldSteps)) || $this->Auth->user('role_id') == ConstUserTypes::Admin)){
							$this->request->data['Project']['form_field_step'] += 1;
						}
                        $this->Project->getAndUpdateTrackedSteps($projectId, $this->request->data['Project']['form_field_step'], '', '', $response->data);
                        if (!empty($this->request->data['Project']['draft'])) {
                            $this->Session->setFlash(sprintf(__l('%s has been added with drafted status.') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                            if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'index',
                                    'project_type' => $this->request->data['Project']['project_type_slug'],
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'myprojects'
                                ));
                            }
                        }
                        if (!empty($this->request->data['Project']['next'])) {
                            $form_field_step = $this->request->data['Project']['form_field_step'] = $this->request->data['Project']['form_field_step']+1;
                        } elseif ($this->request->data['Project']['form_field_step'] == count($FormFieldSteps)) {                        	
                            $this->Project->_sendAlertOnProjectAdd($project, 'New Project');
                            if (!empty($project['Project']['is_admin_suspended']) && $this->Auth->user('role_id') != ConstUserTypes::Admin) {
                                $this->Session->setFlash(sprintf(__l('%s has been suspended due to containing suspicious words') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                                $this->redirect(array(
                                    'controller' => 'users',
                                    'action' => 'dashboard',
                                    'admin' => false
                                ));
                            } else {
                                if (isPluginEnabled('SocialMarketing')) {
                                    $this->Session->setFlash(sprintf(__l('%s has been added') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                                    $this->redirect(array(
                                        'controller' => 'social_marketings',
                                        'action' => 'publish',
                                        $project['Project']['id'],
                                        'type' => 'facebook',
                                        'publish_action' => 'add',
                                        'admin' => false
                                    ));
                                }
                                if (!empty($project['Project']['is_active'])) {
                                    $this->Session->setFlash(sprintf(__l('%s has been added') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                                } else {
                                    $this->Session->setFlash(sprintf(__l('%s has been added. Admin will approve your %s') , Configure::read('project.alt_name_for_project_singular_caps') , Configure::read('project.alt_name_for_project_singular_small')) , 'default', null, 'success');
                                }
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'view',
                                    $project['Project']['slug'],
                                    'admin' => false
                                ));
                            }
                        }
                    }
                } else {
                    if (!empty($response->data['error'][$projectType['ProjectType']['name']])) {
                        $this->Project->$projectType['ProjectType']['name']->validationErrors = $response->data['error'][$projectType['ProjectType']['name']];
                    }
                    if (!empty($response->data['error']['ProjectReward'])) {
                        $this->Project->ProjectReward->validationErrors = array();
                        foreach($response->data['error']['ProjectReward'] as $key => $valid_error) {
                            $this->Project->ProjectReward->validationErrors[$key] = $valid_error;
                        }
                    }
                    $this->Session->setFlash(sprintf(__l('%s could not be added. Please, try again.') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                    if (!empty($is_payout_error)) {
                        $this->Session->setFlash(__l('You must connect atleast one gateway') , 'default', null, 'error');
                        $this->redirect(array(
			                'controller' => !empty($projectType['ProjectType']['name'])?strtolower($projectType['ProjectType']['name']):'projects',
			                'action' => 'add',
			                $this->request->data['Project']['id'],
                        	$this->request->data['Project']['form_field_step'],
			            ));
                    }
                }
            }
        } else {
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id
                ) ,
                'recursive' => -1
            ));
        }
        if (!empty($form_field_step)) {
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.id' => $project['Project']['project_type_id']
                ) ,
                'recursive' => -1
            ));
            $this->loadModel('Projects.FormFieldStep');
            $FormFieldSteps = $this->FormFieldStep->find('all', array(
                'conditions' => array(
                    'FormFieldStep.order >=' => $form_field_step,
                    'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                ) ,
                'contain' => array(
                    'FormFieldGroup' => array(
                        'FormField'
                    ) ,
                ) ,
                'order' => array(
                    'FormFieldStep.order' => 'asc'
                ) ,
                'recursive' => 2
            ));
            foreach($FormFieldSteps as $FormFieldStep) {
                $is_incremented = 0;
                foreach($FormFieldStep['FormFieldGroup'] as $FormFieldGroups) {
                    foreach($FormFieldGroups['FormField'] as $FormField) {
                        $_data = explode('.', $FormField['name']);
                        if ($_data[0] == 'ProjectReward' && !isPluginEnabled('ProjectRewards')) {
                            $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                            $is_incremented = 1;
                            break;
                        }
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                    $is_payout_step = 0;
                    if (isPluginEnabled('Sudopay')) {
                        $this->loadModel('Sudopay.Sudopay');
                        $user_id = $this->Auth->user('id');
                        if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
                            $user_id = $tmpProject['Project']['user_id'];
                        }
                        $is_having_pending_gateways_connect = $this->Sudopay->isHavingPendingGatewayConnect($user_id);
                        if (empty($is_having_pending_gateways_connect)) {
                            if (!empty($_SESSION['response_for_connect'])) {
                                $_SESSION['response_for_connect'] = 0;
                            }
                            $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                            $is_incremented = 1;
                        } else {
                            $this->set('is_payout_step', 1);
                        }
                        $connected_gateways = $this->Sudopay->GetUserConnectedGateways($user_id);
						$this->set('connected_gateways', $connected_gateways);
                        if (!empty($_SESSION['response_for_connect'])) {
                            if (in_array($_SESSION['response_for_connect'], $connected_gateways)) {
                                $_SESSION['response_for_connect'] = 0;
                            }
                        }
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                    if ((!Configure::read('Project.listing_fee') && $projectType['ProjectType']['listing_fee'] == 0 && $projectType['ProjectType']['listing_fee'] == null) || !empty($project['Project']['is_paid'])) {
                        if (!empty($_SESSION['payment_response'])) {
                            $_SESSION['payment_response'] = 0;
                        }
                        $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                        $is_incremented = 1;
                    } else {
                        $this->set('is_payment_step', 1);
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_splash']) && (!empty($tracked_steps_arr) && isset($tracked_steps_arr[$FormFieldStep['FormFieldStep']['order']]['is_admin_approved']) && $tracked_steps_arr[$FormFieldStep['FormFieldStep']['order']]['is_admin_approved'] == 1)) {
                    $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                    $is_incremented = 1;
                }
                if (empty($is_incremented)) {
                    break;
                }
            }
            $formFieldStep = $this->FormFieldStep->find('count', array(
                'conditions' => array(
                    'FormFieldStep.order' => $form_field_step,
                    'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                ) ,
                'recursive' => -1
            ));
            if (empty($formFieldStep)) {
                $return = $this->Project->getPendingSteps($project['Project']['id'], $project['Project']['project_type_id'], false);
                if (!empty($return['message'])) {
                    $this->Session->setFlash($return['message'], 'default', null, 'success');
                } elseif (!empty($return['error_message'])) {
                    $this->Session->setFlash($return['error_message'], 'default', null, 'error');
                }
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'view',
                    $project['Project']['slug']
                ));
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => 'view',
                    $project['Project']['slug']
                ));
            } else {
                $this->request->data['Project']['form_field_step'] = $form_field_step;
            }
        }
        if (!empty($userProfile)) {
            if (empty($this->request->data['Project']['country_id'])) {
                $this->request->data['Project']['country_id'] = !empty($userProfile['Country']['iso_alpha2']) ? $userProfile['Country']['iso_alpha2'] : '';
                $this->request->data['Country']['name'] = !empty($userProfile['UserProfile']['country_id']) ? $userProfile['Country']['name'] : '';
                $this->request->data['Country']['iso_alpha2'] = !empty($userProfile['Country']['iso_alpha2']) ? $userProfile['Country']['iso_alpha2'] : '';
            }
            if (empty($this->request->data['State']['name'])) {
                $this->request->data['State']['name'] = !empty($userProfile['UserProfile']['state_id']) ? $userProfile['State']['name'] : '';
            }
            if (empty($this->request->data['City']['name'])) {
                $this->request->data['City']['name'] = !empty($userProfile['UserProfile']['city_id']) ? $userProfile['City']['name'] : '';
            }
            if (empty($this->request->data['Project']['address'])) {
                $this->request->data['Project']['address'] = !empty($userProfile['UserProfile']['address']) ? $userProfile['UserProfile']['address'] : '';
            }
            if (empty($this->request->data['Project']['address1'])) {
                $this->request->data['Project']['address1'] = !empty($userProfile['UserProfile']['address1']) ? $userProfile['UserProfile']['address1'] : '';
            }
        }
        if (empty($this->request->data['Project']['user_id']) && $this->Auth->user('role_id') == ConstUserTypes::Admin) {
            $this->request->data['Project']['user_id'] = $this->Auth->user('id');
        }
        $this->set('userProfile', $userProfile);
        $users = $this->Project->User->find('list', array(
            'conditions' => array(
                'User.is_active' => 1
            ) ,
            'order' => array(
                'User.username' => 'asc'
            ) ,
        ));
        if (!empty($this->request->params['named']['name'])) {
            $this->request->data['Project']['name'] = $this->request->params['named']['name'];
        }
        $this->loadModel('PaymentGateway');
        $paymentGateways = $this->PaymentGateway->find('all', array(
            'fields' => array(
                'PaymentGateway.id',
                'PaymentGateway.is_active',
            ) ,
            'recursive' => -1
        ));
        $this->set('paymentGateways', $paymentGateways);
        $countries = $this->Project->Country->find('list', array(
            'fields' => array(
                'Country.iso_alpha2',
                'Country.name'
            )
        ));
        $is_disable_pledge_type_amount = 1;
        $pledgeTypes[ConstPledgeTypes::Any] = 'Any';
        if (Configure::read('Project.is_pledge_minimum_amount_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_minimum_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Minimum] = 'Minimum';
        }
        if (Configure::read('Project.is_suggested_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_suggested_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Reward] = 'Reward';
        }
        if (Configure::read('Project.is_multiple_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_multiple_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Multiple] = 'Multiple';
        }
        if (Configure::read('Project.is_fixed_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_fixed_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Fixed] = 'Fixed';
        }
        if (count($pledgeTypes) > 1) {
            $is_disable_pledge_type_amount = 0;
        }
        $this->set(compact('pledgeTypes'));
        $this->set('is_disable_pledge_type_amount', $is_disable_pledge_type_amount);
        $projectTypeName = ucwords($projectType['ProjectType']['name']);
        App::import('Model', $projectTypeName . '.' . $projectTypeName);
        $model = new $projectTypeName();
        $response = $model->onProjectCategories();
        $this->set($projectType['ProjectType']['slug'] . 'Categories', $response[$projectType['ProjectType']['slug'] . 'Categories']);
        if (isPluginEnabled('Lend')) {
            App::import('Model', 'Lend.CreditScore');
            $this->CreditScore = new CreditScore();
            $response = $this->CreditScore->GetProjectRelatedMasters();
            $this->set('creditScores', $response['creditScores']);
            $this->set('loanTerms', $response['loanTerms']);
            $this->set('repaymentSchedules', $response['repaymentSchedules']);
        }
        $paymentMethods = array(
            ConstPaymentMethod::AoN => 'Fixed Funding',
            ConstPaymentMethod::KiA => 'Flexible Funding'
        );
        if (empty($this->request->data['Project']['payment_method_id'])) {
            $this->request->data['Project']['payment_method_id'] = (Configure::read('Project.project_fund_capture') == 'Fixed Funding') ? ConstPaymentMethod::AoN : ConstPaymentMethod::KiA;
        }
        $this->set(compact('users', 'countries', 'paymentMethods'));
        if (!empty($project_id)) {
            // quick fix
            if (!empty($this->Project->validationErrors)) {
                $tmp_error = $this->Project->validationErrors;
            }
            $response = Cms::dispatchEvent('Controller.ProjectType.getContain', $this, array(
                'type' => 1
            ));
            $contain['contain'] = $response->data['contain'];
            $contain['contain'][] = 'City';
            $contain['contain'][] = 'State';
            $contain['contain'][] = 'Country';
            if (isPluginEnabled('ProjectRewards')) {
                $contain['contain'][] = 'ProjectReward';
            }
            $tmpProject = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id
                ) ,
                'contain' => $contain['contain'],
                'recursive' => 1
            ));
            if (!empty($tmp_error)) {
                $this->Project->validationErrors = $tmp_error;
            }
            if (!empty($this->request->data)) {
                foreach($tmpProject['Project'] as $key => $value) {
                    if (!isset($this->request->data['Project'][$key]) && !empty($value)) {
                        $this->request->data['Project'][$key] = $value;
                    }
                }
            }
            if (empty($this->request->data['ProjectReward']) && !empty($tmpProject['ProjectReward'])) {
                $this->request->data['ProjectReward'] = $tmpProject['ProjectReward'];
            }
            if (empty($this->request->data['City']['name']) && !empty($tmpProject['City'])) {
                $this->request->data['City'] = $tmpProject['City'];
            }
            if (empty($this->request->data['State']['name']) && !empty($tmpProject['State'])) {
                $this->request->data['State'] = $tmpProject['State'];
            }
            if (empty($this->request->data['Country']['name']) && !empty($tmpProject['Country'])) {
                $this->request->data['Country'] = $tmpProject['Country'];
                $this->request->data['Project']['country_id'] = $tmpProject['Country']['iso_alpha2'];
            }
            if (empty($this->request->data['Pledge']) && !empty($tmpProject['Pledge'])) {
                $this->request->data['Pledge'] = $tmpProject['Pledge'];
            }
            if (empty($this->request->data['Donate']) && !empty($tmpProject['Donate'])) {
                $this->request->data['Donate'] = $tmpProject['Donate'];
            }
            if (empty($this->request->data['Lend']) && !empty($tmpProject['Lend'])) {
                $this->request->data['Lend'] = $tmpProject['Lend'];
            }
            if (empty($this->request->data['Equity']) && !empty($tmpProject['Equity'])) {
                $this->request->data['Equity'] = $tmpProject['Equity'];
            }
            if (empty($this->request->data['Submission']) && !empty($tmpProject['Submission'])) {
                $this->request->data['Submission'] = $tmpProject['Submission'];
            }
            if (empty($this->request->data['Attachment']) && !empty($tmpProject['Attachment'])) {
                $this->request->data['Attachment'] = $tmpProject['Attachment'];
            }
            $project_media = array();
            if (!empty($this->request->data['Submission']['id'])) {
                $SubmissionFields = $this->Project->Submission->SubmissionField->find('all', array(
                    'conditions' => array(
                        'SubmissionField.submission_id' => $this->request->data['Submission']['id']
                    )
                ));
                if (!empty($SubmissionFields)) {
                    foreach($SubmissionFields as $submissionValue) {
                        if ($submissionValue['SubmissionField']['type'] == 'checkbox' || $submissionValue['SubmissionField']['type'] == 'multiselect') {
                            $multi_selects = explode("\n", $submissionValue['response']);
                            foreach($multi_selects as $multi_select) {
                                $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']][] = $multi_select;
                            }
                        } elseif ($submissionValue['SubmissionField']['type'] == 'date' || $submissionValue['SubmissionField']['type'] == 'datetime' || $submissionValue['SubmissionField']['type'] == 'time') {
                            if (!empty($submissionValue['response'])) {
                                $multi_selects = explode("\n", $submissionValue['response']);
                                if ($field_type[1] == 'date' || $field_type[1] == 'datetime') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['month'] = $multi_selects[0];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['day'] = $multi_selects[1];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['year'] = $multi_selects[2];
                                }
                                if ($submissionValue['SubmissionField']['type'] == 'datetime') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['hour'] = !empty($multi_selects[3]) ? $multi_selects[3] : '';
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['min'] = !empty($multi_selects[4]) ? $multi_selects[4] : '';
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['meridian'] = !empty($multi_selects[5]) ? $multi_selects[5] : '';
                                }
                                if ($submissionValue['SubmissionField']['type'] == 'time') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['hour'] = $multi_selects[0];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['min'] = $multi_selects[1];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['meridian'] = $multi_selects[2];
                                }
                            }
                        } else {
                            $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']] = $submissionValue['SubmissionField']['response'];
                        }
                        if (!empty($submissionValue['SubmissionThumb']['id'])) {
                            $project_media[$submissionValue['SubmissionField']['form_field']]['Attachment'] = $submissionValue['SubmissionThumb'];
                        }
                    }
                }
            }
            $this->set('project_media', $project_media);
        }
        if (empty($this->request->data['Project']['form_field_step'])) {
            $this->request->data['Project']['form_field_step'] = 1;
        }
        $this->set('current_form_step', $this->request->data['Project']['form_field_step']);
        $this->loadModel('Projects.FormFieldStep');
        $is_splash = $this->FormFieldStep->find('all', array(
            'conditions' => array(
                'FormFieldStep.order' => $this->request->data['Project']['form_field_step'],
                'FormFieldStep.is_splash' => 1,
                'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
            ) ,
            'recursive' => -1
        ));
        if (!empty($is_splash) && !empty($this->request->data['Project']['id'])) {
            $projectStatus = array();
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                'projectStatus' => $projectStatus,
                'project' => $tmpProject,
                'type' => 'status'
            ));
            $this->Project->getAndUpdateTrackedSteps($this->request->data['Project']['id'], $this->request->data['Project']['form_field_step'], '', '', $response->data);
        }
        if (isPluginEnabled('Lend')) {
            $this->loadModel('Lend.Lend');
            $lend = $this->Lend->find('first', array(
                'conditions' => array(
                    'Lend.project_id' => $project_id,
                ) ,
                'contain' => array(
                    'LoanTerm'
                ) ,
                'recursive' => 0
            ));
            $this->request->data['Lend']['credit_score_id'] = $lend['Lend']['credit_score_id'];
            if (!empty($lend['Lend']['loan_term_id'])) {
                $this->request->data['Lend']['loan_term_id'] = $lend['Lend']['loan_term_id'];
            }
            if (!empty($lend['Lend']['repayment_schedule_id'])) {
                $this->request->data['Lend']['repayment_schedule_id'] = $lend['Lend']['repayment_schedule_id'];
            }
            $this->request->data['Lend']['target_interest_rate'] = $lend['Lend']['target_interest_rate'];
            $needed_amount = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id,
                ) ,
                'fields' => array(
                    'Project.needed_amount'
                ) ,
                'recursive' => -1
            ));
            $this->set('needed_amount', $needed_amount);
            $this->set('lend', $lend);
        }
        if (empty($this->request->data['Project']['step']) && empty($this->request->params['named']['step'])) {
            $this->render('guidelines');
        }
    }
    public function flashupload()
    {
        $this->Project->Attachment->Behaviors->attach('ImageUpload', Configure::read('project.file'));
        $this->XAjax->flashupload();
    }
    // Posting Project on Facebook
    public function postOnFacebook($project = null, $message = null, $admin = null)
    {
        if (!empty($project)) {
            $slug = $project['Project']['slug'];
            $image_options = array(
                'dimension' => 'normal_thumb',
                'class' => '',
                'alt' => $project['Project']['name'],
                'title' => $project['Project']['name'],
                'type' => 'jpg'
            );
            if ($admin) {
                $facebook_dest_user_id = Configure::read('facebook.page_id') ? Configure::read('facebook.page_id') : Configure::read('facebook.fb_user_id');
                $facebook_dest_access_token = Configure::read('facebook.fb_access_token');
            } else {
                $facebook_dest_user_id = $project['User']['facebook_user_id'];
                $facebook_dest_access_token = $project['User']['facebook_access_token'];
            }
            App::import('Vendor', 'facebook/facebook');
            $this->facebook = new Facebook(array(
                'appId' => Configure::read('facebook.app_id') ,
                'secret' => Configure::read('facebook.fb_secrect_key') ,
                'cookie' => true
            ));
            if (empty($message)) {
                $message = $project['Project']['name'];
            }
            $image_url = Router::url('/', true) . getImageUrl('Project', $project['Attachment'], $image_options);
            $image_link = Router::url(array(
                'controller' => 'projects',
                'action' => 'view',
                'admin' => false,
                $slug
            ) , true);
            try {
                $getPostCheck = $this->facebook->api('/' . $facebook_dest_user_id . '/feed', 'POST', array(
                    'access_token' => $facebook_dest_access_token,
                    'message' => $message,
                    'picture' => $image_url,
                    'icon' => $image_url,
                    'link' => $image_link,
                    'description' => $project['Project']['description']
                ));
            }
            catch(Exception $e) {
                return 2;
            }
        }
    }
    public function update_status($id = null)
    {
    	if (is_null($id)) {
    		throw new NotFoundException(__l('Invalid request'));
    	}
    	$project = $this->Project->find('first', array(
    			'conditions' => array(
    					'Project.id' => $id
    			) ,
    			'contain' => array(
    					'ProjectType',
    					'User',
    			) ,
    			'recursive' => 0
    	));
    	if(!empty($project['User']['sudopay_receiver_account_id'])){
    		$this->Project->updateAll(array(
    				'Project.is_draft' => 0
    		) , array(
    				'Project.id' => $id
    		));
    		$this->Session->setFlash(sprintf(__l('%s has been activated successfully. Admin will approve your %s') , Configure::read('project.alt_name_for_project_singular_caps') , Configure::read('project.alt_name_for_project_singular_small')) , 'default', null, 'success');
    		 $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'myprojects'
                                ));
    	}
    	else{
    		$this->Session->setFlash(__l('You cannot activated. You must connect one gateway.') , 'default', null, 'error');
    		$this->redirect(array(
    				'controller' => 'projects',
    				'action' => 'myprojects'
    		));
    	}
    }
    public function edit($id = null, $form_field_step = null)
    {
        $_SESSION['post_action'] = 'edit';
        $this->pageTitle = sprintf(__l('Edit %s') , Configure::read('project.alt_name_for_project_singular_caps'));
        $this->loadModel('Projects.Form');
        $this->loadModel('Projects.FormField');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id' => $id
            ) ,
            'contain' => array(
                'ProjectType',
                'User',
            ) ,
            'recursive' => 0
        ));
        $rejected_info = array();
        if (!empty($project['Project']['tracked_steps'])) {
            $tracked_steps_arr = unserialize($project['Project']['tracked_steps']);
            if (!empty($tracked_steps_arr)) {
                ksort($tracked_steps_arr);
                foreach($tracked_steps_arr as $key => $value) {
                    if ($value['is_admin_approved'] == 2) {
                        if (!empty($value['information_to_user'])) {
                            $rejected_info = $value['information_to_user'];
                        }
                    }
                }
            }
        }
        if (!empty($rejected_info)) {
            $this->set('rejected_info', $rejected_info[count($rejected_info) -1]);
        }
        $time_strap = strtotime($project['Project']['project_end_date']) -strtotime(date('Y-m-d'));
        $days = floor($time_strap/(60*60*24));
        if ($days > 0) {
            $project[0]['enddate'] = $days;
        } else {
            $project[0]['enddate'] = 0;
        }
        $this->set('project', $project);
        $userProfile = $this->Project->User->UserProfile->find('first', array(
            'conditions' => array(
                'UserProfile.user_id' => $project['Project']['user_id'],
            ) ,
            'contain' => array(
                'City',
                'State',
                'Country',
                'User',
            ) ,
            'recursive' => 0
        ));
        $this->set('userProfile', $userProfile);
        if (!empty($id) || !empty($this->request->data['Project']['id'])) {
            if (!empty($this->request->data['Project']['id'])) {
                $id = $this->request->data['Project']['id'];
            }
            $conditions['Project.id'] = $id;
            if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
                $conditions['Project.user_id'] = $this->Auth->user('id');
            }
            $tmpProject = $this->Project->find('first', array(
                'conditions' => $conditions,
                'contain' => array(
                    'Country'
                ) ,
                'recursive' => 0
            ));
            if (empty($tmpProject)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            if (empty($this->request->data)) {
                unset($this->Project->validate['project_end_date']);
            }elseif($tmpProject['Project']['project_end_date'] == date('Y-m-d')){
				unset($this->Project->validate['project_end_date']['rule2']);
			}
			
            foreach($tmpProject['Project'] as $key => $value) {
                if (!isset($this->request->data['Project'][$key]) && !empty($value)) {
                    $this->request->data['Project'][$key] = $value;
                    if ($key == 'country_id') {
                        $this->request->data['Project'][$key] = $tmpProject['Country']['iso_alpha2'];
                    }
                }
            }
        }
        if (!empty($tmpProject['Project']['project_type_id'])) {
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.id' => $tmpProject['Project']['project_type_id']
                ) ,
                'recursive' => -1
            ));
            $projectStatus = array();
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                'projectStatus' => $projectStatus,
                'project' => $project,
                'type' => 'status'
            ));
            $projectTypeFormFields = $this->Form->buildSchema($projectType['ProjectType']['id']);
            $this->loadModel('Projects.FormFieldStep');
            $form_field_steps_conditions['FormFieldStep.project_type_id'] = $projectType['ProjectType']['id'];
            $form_field_groups_conditions = array();
            $form_fields_conditions['FormField.is_active'] = 1;
            if (!empty($response->data['is_allow_to_share'])) {
                $form_field_steps_conditions['FormFieldStep.is_editable'] = 1;
                $form_field_groups_conditions['FormFieldGroup.is_editable'] = 1;
                $form_fields_conditions['FormField.is_editable'] = 1;
            }
            if (!empty($project['Project']['is_paid']) || $this->Auth->user('role_id') == ConstUserTypes::Admin) {
                $form_field_steps_conditions['FormFieldStep.is_payment_step'] = 0;
            }
			
			// Get payment and payout step only if Sudopay is enable
			if (!isPluginEnabled('Sudopay') || $this->Auth->user('role_id') == ConstUserTypes::Admin) {
				$form_field_steps_conditions['FormFieldStep.is_payout_step'] = 0;
			}
            $FormFieldSteps = $this->FormFieldStep->find('all', array(
                'conditions' => $form_field_steps_conditions,
                'contain' => array(
                    'FormFieldGroup' => array(
                        'conditions' => $form_field_groups_conditions,
                        'FormField' => array(
                            'conditions' => $form_fields_conditions,
                            'order' => array(
                                'FormField.order' => 'ASC'
                            )
                        ) ,
                        'order' => array(
                            'FormFieldGroup.order' => 'ASC'
                        )
                    )
                ) ,
                'order' => array(
                    'FormFieldStep.order' => 'ASC'
                ) ,
                'recursive' => 2
            ));
            if (!empty($response->data['is_allow_to_pay_listing_fee'])) {
                $this->request->data['Project']['is_allow_to_edit_fund'] = $response->data['is_allow_to_pay_listing_fee'];
            }
            if (!empty($response->data['is_allow_to_move_for_voting'])) {
                $this->request->data['Project']['is_restrict_steps'] = 1;
            }
            if (!empty($response->data['is_allow_to_edit_fund'])) {
                $this->request->data['Project']['is_allow_to_edit_fund'] = $response->data['is_allow_to_edit_fund'];
            }
            if (!empty($FormFieldSteps)) {
                $total_groups_removed = 0;
                $total_fields_removed = 0;
                $temp_FormFieldSteps = $FormFieldSteps;
                $fund_fields = array(
                    'needed_amount',
                    'project_end_date',
                    'donate_project_category_id',
                    'pledge_project_category_id',
                    'lend_project_category_id',
                    'equity_project_category_id',
                    'pledge_type_id',
                    'min_amount_to_fund',
                    'is_allow_over_funding'
                );
                $order = 1;
                foreach($temp_FormFieldSteps as $step_key => $FormFieldStep) {
                    if (empty($FormFieldStep['FormFieldStep']['is_splash']) && empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        $total_groups_in_step = count($FormFieldStep['FormFieldGroup']);
                        if ($total_groups_in_step == 0 && empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                            unset($FormFieldSteps[$step_key]);
                            continue;
                        }
                        foreach($FormFieldStep['FormFieldGroup'] as $group_key => $FormFieldGroup) {
                            $total_fields_in_group = count($FormFieldGroup['FormField']);
                            $total_groups_removed = 0;
                            if ($total_fields_in_group == 0) {
                                unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                $total_groups_removed++;
                                continue;
                            }
                            if (($FormFieldGroup['name'] == 'Project Updates') && !isPluginEnabled('ProjectUpdates')) {
                                unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                $total_groups_removed++;
                                continue;
                            }
                            if (($FormFieldGroup['name'] == 'Reward') && !isPluginEnabled('ProjectRewards')) {
                                unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                $total_groups_removed++;
                                continue;
                            }
                            foreach($FormFieldGroup['FormField'] as $field_key => $FormField) {
                                $remove_field = 0;
                                if (empty($this->request->data['Project']['is_allow_to_edit_fund'])) {
                                    $field_name = explode('.', $FormField['name']);
                                    if (!empty($field_name[1]) && in_array($field_name[1], $fund_fields)) {
                                        $remove_field = 1;
                                    }
                                }
                                $_data = explode('.', $FormField['name']);
                                if ($_data[0] == 'ProjectReward' && !isPluginEnabled('ProjectRewards')) {
                                    $remove_field = 1;
                                    $this->request->data['Project']['form_field_step'] = $FormFieldSteps[$step_key]['FormFieldStep']['order']+1;
                                    break;
                                }
                                if (!empty($remove_field)) {
                                    unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]['FormField'][$field_key]);
                                    $total_fields_removed++;
                                }
                                if (!empty($total_fields_removed) && $total_fields_in_group == $total_fields_removed) {
                                    unset($FormFieldSteps[$step_key]['FormFieldGroup'][$group_key]);
                                    $total_groups_removed++;
                                    $total_fields_removed = 0;
                                }
                            }
                        }
                        if (!empty($total_groups_removed) && $total_groups_in_step == $total_groups_removed) {
                            unset($FormFieldSteps[$step_key]);
                            $total_groups_removed = 0;
                        }
                    } elseif (!empty($project['Project']['is_paid']) && !empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        unset($FormFieldSteps[$step_key]);
                    } else if (empty($FormFieldStep['FormFieldStep']['is_splash']) && !empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                        if ((($projectType['ProjectType']['listing_fee'] == 0) || ($projectType['ProjectType']['listing_fee'] == null))) {
                            if (!Configure::read('Project.listing_fee')) {
                                unset($FormFieldSteps[$step_key]);
                            }
                        }
                    }
                    if (!empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                        if (isPluginEnabled('Sudopay')) {
                            $this->loadModel('Sudopay.Sudopay');
                            $user_id = $this->Auth->user('id');
                            if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
                                $user_id = $tmpProject['Project']['user_id'];
                            }
                            $is_having_pending_gateways_connect = $this->Sudopay->isHavingPendingGatewayConnect($user_id);
                            if (empty($is_having_pending_gateways_connect) || (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')) {
                                unset($FormFieldSteps[$step_key]);
                            } 
                        } else {
							unset($FormFieldSteps[$step_key]);
						}
                    }
                }
            }
			
            $this->set('total_form_field_steps', count($FormFieldSteps));
            $this->set('FormFieldSteps', $FormFieldSteps);
            $this->set('projectTypeFormFields', $projectTypeFormFields);
            $this->set('projectType', $projectType);
        }
        if (!Configure::read('Project.is_allow_project_owner_to_edit_project_in_open_status')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data) && $this->request->isPost()) {
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->Project->Attachment->Behaviors->attach('ImageUpload', Configure::read('Project.image'));
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
                $this->Project->Attachment->set($this->request->data);
            }
            $is_reward_valid = true;
            if (!empty($this->request->data['Project']['pledge_type_id']) && $this->request->data['Project']['pledge_type_id'] == ConstPledgeTypes::Any) {
                unset($this->request->data[ucfirst($this->request->data['Project']['project_type_slug']) ]['min_amount_to_fund']);
            }
            if (isset($this->request->data['State']['name'])) {
                $this->Project->State->set($this->request->data);
            }
            if (isset($this->request->data['City']['name'])) {
                $this->Project->City->set($this->request->data);
            }
            $this->Project->set($this->request->data);
            $response = Cms::dispatchEvent('Model.Project.beforeAdd', $this, array(
                'data' => $this->request->data
            ));
            //Dynamic fields validation
            $projectTypeFormFields = $this->Form->buildSchema($this->request->data['Project']['project_type_id']);
            if (empty($this->request->data['Form'])) {
                $this->request->data['Form'] = array();
            }
            $this->request->data['ValidateForm'] = $this->request->data['Form'];
            $formFields = $this->FormField->find('list', array(
                'condition' => array(
                    'FormField.project_type_id' => $project['ProjectType']['id']
                ) ,
                'fields' => array(
                    'name',
                    'type'
                )
            ));
            foreach($this->request->data['Form'] as $tmpFormField => $value) {
                $field_type = $formFields[$tmpFormField];
                if (!empty($field_type) && ($field_type == 'date' || $field_type == 'datetime' || $field_type == 'time')) {
                    if ($field_type == 'date') {
                        $format = 'Y-m-d';
                    } elseif ($field_type == 'datetime') {
                        $format = 'Y-m-d H:i:s';
                    } elseif ($field_type == 'time') {
                        $format = 'H:i:s';
                    }
                    $this->request->data['ValidateForm'][$tmpFormField] = $this->Form->deconstructDate($value, $field_type, $format);
                }
            }
            $this->Form->set($this->request->data['ValidateForm']);
            if (!empty($response->data['error']['ProjectReward'])) {
                foreach($response->data['error']['ProjectReward'] as $i => $projectReward) {
                    $this->Project->ProjectReward->validationErrors[$i][key($projectReward) ] = $projectReward[key($projectReward) ];
                }
            }
            $is_payout_error = 0;
            $is_payout_step = $this->FormFieldStep->find('first', array(
                'conditions' => array(
                    'FormFieldStep.order' => $this->request->data['Project']['form_field_step'],
                    'FormFieldStep.is_payout_step' => 1,
                    'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                ) ,
                'recursive' => -1
            ));
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                ) ,
                'recursive' => -1
            ));
            if (empty($user['User']['sudopay_receiver_account_id'])  && !isPluginEnabled('Wallet') && (!empty($is_payout_step))) {
                $is_payout_error = 1;
            }
            if ($this->Project->validates() &$this->Form->validates() &$this->Project->Attachment->validates() &$this->Project->City->validates() &$this->Project->State->validates() &empty($response->data['error'][$project['ProjectType']['name']]) &empty($response->data['error']['ProjectReward']) ) {
                if (!empty($this->request->data['Project']['country_id'])) {
                    $this->request->data['Project']['country_id'] = $this->Project->Country->findCountryId($this->request->data['Project']['country_id']);
                }
                if (!empty($this->request->data['State']['name'])) {
                    $this->request->data['State']['country_id'] = $this->request->data['Project']['country_id'];
                    $this->request->data['Project']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->Project->State->findOrSaveAndGetIdWithArray($this->request->data['State']['name'], $this->request->data['State']);
                }
                if (!empty($this->request->data['City']['name'])) {
                    $this->request->data['City']['state_id'] = $this->request->data['Project']['state_id'];
                    $this->request->data['City']['country_id'] = $this->request->data['Project']['country_id'];
                    $this->request->data['Project']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->Project->City->findOrSaveAndGetIdWithArray($this->request->data['City']['name'], $this->request->data['City']);
                }
                if ($this->Project->save($this->request->data)) {
                    $projectStatus = array();
                    $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                        'projectStatus' => $projectStatus,
                        'project' => $tmpProject,
                        'type' => 'status'
                    ));
					$is_next_payout_step = $this->FormFieldStep->find('first', array(
							'conditions' => array(
							'FormFieldStep.order' => $this->request->data['Project']['form_field_step']+1,
							'FormFieldStep.is_payout_step' => 1,
							'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
						) ,
						'recursive' => -1
					));
					
					if(!empty($is_next_payout_step) && (!isPluginEnabled('Sudopay') || $this->Auth->user('role_id') == ConstUserTypes::Admin)){
						$this->request->data['Project']['form_field_step'] += 1;
					}
					$is_next_payment_step = $this->FormFieldStep->find('first', array(
							'conditions' => array(
							'FormFieldStep.order' => $this->request->data['Project']['form_field_step']+1,
							'FormFieldStep.is_payment_step' => 1,
							'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
						) ,
						'recursive' => -1
					));
					if(!empty($is_next_payment_step) && $this->Auth->user('role_id') == ConstUserTypes::Admin){
						$this->request->data['Project']['form_field_step'] += 1;
					}
                    $this->Project->getAndUpdateTrackedSteps($this->Project->id, $this->request->data['Project']['form_field_step'], '', '', $response->data);
                    if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        $attach = $this->Project->Attachment->find('first', array(
                            'conditions' => array(
                                'Attachment.foreign_id' => $this->request->data['Project']['id'],
                                'Attachment.class' => 'Project'
                            ) ,
                            'fields' => array(
                                'Attachment.id'
                            ) ,
                            'recursive' => -1
                        ));
                        $this->request->data['Attachment']['class'] = 'Project';
                        $this->request->data['Attachment']['foreign_id'] = $this->request->data['Project']['id'];
                        $this->request->data['Attachment']['id'] = $attach['Attachment']['id'];
                        $this->Project->Attachment->save($this->request->data['Attachment']);
                    }
                    //Save Dynamic form fields
                    $this->loadModel('Projects.Submission');
                    if (!empty($this->request->data['Form'])) {
                        $this->request->data['Submission'] = $this->request->data['Form'];
                        $this->request->data['Submission']['id'] = $this->request->data['Project']['submission_id'];
                        $this->request->data['Submission']['project_id'] = $this->Project->id;
                        $this->Submission->submit($this->request->data);
                    }
                    if (!empty($this->request->data['Project']['publish'])) {
                        $data['Project']['is_draft'] = 0;
                        $data['Project']['id'] = $this->Project->id;
                        $this->Project->save($data);
                    }
                    $response = Cms::dispatchEvent('Controller.Projects.afterEdit', $this, array(
                        'data' => $this->request->data
                    ));
                    $is_overwrite_data = 0;
                    if (!empty($this->request->data['Project']['draft'])) {
                        if ($project['Project']['is_admin_suspended']) {
                            $this->Session->setFlash(sprintf(__l('%s has been suspended due to containing suspicious words') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                        } else {
                            $this->Session->setFlash(sprintf(__l('%s has been updated with drafted status.') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                        }
                        if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                            $this->redirect(array(
                                'controller' => 'projects',
                                'action' => 'index',
                                'project_type' => $this->request->data['Project']['project_type_slug'],
                            ));
                        } else {
                            $this->redirect(array(
                                'controller' => 'projects',
                                'action' => 'myprojects'
                            ));
                        }
                    }
                    if (!empty($this->request->data['Project']['next'])) {
                        $this->request->data['Project']['form_field_step'] = $this->request->data['Project']['form_field_step']+1;
                    } else if (!empty($this->request->data['Project']['form_field_step']) && $this->request->data['Project']['form_field_step'] == count($FormFieldSteps)) {
                        if ($project['Project']['is_admin_suspended']) {
                            $this->Session->setFlash(sprintf(__l('%s has been suspended due to containing suspicious words') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                            if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'index',
                                    'project_type' => $this->request->data['Project']['project_type_slug'],
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'myprojects'
                                ));
                            }
                        } else {
                            $this->Session->setFlash(sprintf(__l('%s has been updated') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                            if ($project['Project']['name'] != $this->request->data['Project']['name']) {
                                $project = $this->Project->find('first', array(
                                    'conditions' => array(
                                        'Project.id' => $this->request->data['Project']['id']
                                    ) ,
                                    'fields' => array(
                                        'Project.slug',
                                    ) ,
                                    'recuesive' => -1
                                ));
                            }
                            if (!empty($this->request->params['admin'])) {
                                $this->redirect(array(
                                    'controller' => Inflector::pluralize($this->request->data['Project']['project_type_slug']) ,
                                    'action' => 'index',
                                    'admin' => true,
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'projects',
                                    'action' => 'view',
                                    $project['Project']['slug'],
                                    'admin' => false,
                                ));
                            }
                        }
                    }
                    if (empty($form_field_step)) {
                        $form_field_step = $this->request->data['Project']['form_field_step'];
                    }
                } else {
                    $is_overwrite_data = 1;
                    $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                }
            } else {
                $is_overwrite_data = 1;
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
                if (!empty($is_payout_error)) {
                    $this->Session->setFlash(__l('You must connect atleast one gateway') , 'default', null, 'error');
                }
            }
        } else {
            if (!empty($userProfile)) {
                if (empty($this->request->data['Project']['country_id'])) {
                    $this->request->data['Project']['country_id'] = !empty($userProfile['Country']['iso_alpha2']) ? $userProfile['Country']['iso_alpha2'] : '';
                    $this->request->data['Country']['name'] = !empty($userProfile['UserProfile']['country_id']) ? $userProfile['Country']['name'] : '';
                    $this->request->data['Country']['iso_alpha2'] = !empty($userProfile['Country']['iso_alpha2']) ? $userProfile['Country']['iso_alpha2'] : '';
                }
                if (empty($this->request->data['State']['name'])) {
                    $this->request->data['State']['name'] = !empty($userProfile['UserProfile']['state_id']) ? $userProfile['State']['name'] : '';
                }
                if (empty($this->request->data['City']['name'])) {
                    $this->request->data['City']['name'] = !empty($userProfile['UserProfile']['city_id']) ? $userProfile['City']['name'] : '';
                }
                if (empty($this->request->data['Project']['address'])) {
                    $this->request->data['Project']['address'] = !empty($userProfile['UserProfile']['address']) ? $userProfile['UserProfile']['address'] : '';
                }
                if (empty($this->request->data['Project']['address1'])) {
                    $this->request->data['Project']['address1'] = !empty($userProfile['UserProfile']['address1']) ? $userProfile['UserProfile']['address1'] : '';
                }
            }
        }
        if (!empty($form_field_step)) {
            $FormFieldSteps = $this->FormFieldStep->find('all', array(
                'conditions' => array(
                    'FormFieldStep.order >=' => $form_field_step,
                    'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                ) ,
                'contain' => array(
                    'FormFieldGroup' => array(
                        'FormField'
                    ) ,
                ) ,
                'order' => array(
                    'FormFieldStep.order' => 'asc'
                ) ,
                'recursive' => 2
            ));
            foreach($FormFieldSteps as $FormFieldStep) {
                $is_incremented = 0;
                foreach($FormFieldStep['FormFieldGroup'] as $FormFieldGroups) {
                    foreach($FormFieldGroups['FormField'] as $FormField) {
                        $_data = explode('.', $FormField['name']);
                        if ($_data[0] == 'ProjectReward' && !isPluginEnabled('ProjectRewards')) {
                            $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                            $is_incremented = 1;
                            break;
                        }
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_payout_step'])) {
                    $is_payout_step = 0;
                    if (isPluginEnabled('Sudopay')) {
                        $this->loadModel('Sudopay.Sudopay');
                        $user_id = $this->Auth->user('id');
                        if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
                            $user_id = $tmpProject['Project']['user_id'];
                        }
                        $is_having_pending_gateways_connect = $this->Sudopay->isHavingPendingGatewayConnect($user_id);
                        if (empty($is_having_pending_gateways_connect)) {
                            if (!empty($_SESSION['response_for_connect'])) {
                                $_SESSION['response_for_connect'] = 0;
                            }
                            $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                            $is_incremented = 1;
                        } else {
                            $this->set('is_payout_step', 1);
                        }
                        $connected_gateways = $this->Sudopay->GetUserConnectedGateways($user_id);
						$this->set('connected_gateways', $connected_gateways);
                        if (!empty($_SESSION['response_for_connect'])) {
                            if (in_array($_SESSION['response_for_connect'], $connected_gateways)) {
                                $_SESSION['response_for_connect'] = 0;
                            }
                        }
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_payment_step'])) {
                    if ((!Configure::read('Project.listing_fee') && $projectType['ProjectType']['listing_fee'] == 0 && $projectType['ProjectType']['listing_fee'] == null) || !empty($project['Project']['is_paid'])) {
                        if (!empty($_SESSION['payment_response'])) {
                            $_SESSION['payment_response'] = 0;
                        }
                        $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                        $is_incremented = 1;
                    } else {
                        $this->set('is_payment_step', 1);
                    }
                }
                if (!empty($FormFieldStep['FormFieldStep']['is_splash']) && (!empty($tracked_steps_arr) && isset($tracked_steps_arr[$FormFieldStep['FormFieldStep']['order']]['is_admin_approved']) && $tracked_steps_arr[$FormFieldStep['FormFieldStep']['order']]['is_admin_approved'] == 1)) {
                    $form_field_step = $FormFieldStep['FormFieldStep']['order']+1;
                    $is_incremented = 1;
                }
                if (empty($is_incremented)) {
                    break;
                }
                $formFieldStep = $this->FormFieldStep->find('count', array(
                    'conditions' => array(
                        'FormFieldStep.order' => $form_field_step,
                        'FormFieldStep.project_type_id' => $projectType['ProjectType']['id']
                    ) ,
                    'recursive' => -1
                ));
                if (empty($formFieldStep)) {
                    $return = $this->Project->getPendingSteps($project['Project']['id'], $project['Project']['project_type_id'], false);
                    if (!empty($return['message'])) {
                        $this->Session->setFlash($return['message'], 'default', null, 'success');
                    } elseif (!empty($return['error_message'])) {
                        $this->Session->setFlash($return['error_message'], 'default', null, 'error');
                    }
					 if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
							 $this->redirect(array(
								'controller' => Inflector::pluralize($project['ProjectType']['slug']) ,
								'action' => 'index',
							));
					 }else{
						$this->redirect(array(
							'controller' => 'projects',
							'action' => 'view',
							$project['Project']['slug']
						));
					}
                } else {
                    $this->request->data['Project']['form_field_step'] = $form_field_step;
                }
            }
        }
        if (!empty($id)) {
            // quick fix
            if (!empty($this->Project->validationErrors)) {
                $tmp_error = $this->Project->validationErrors;
            }
            $response = Cms::dispatchEvent('Controller.ProjectType.getContain', $this, array(
                'type' => 1
            ));
            $contain['contain'] = $response->data['contain'];
            $contain['contain'][] = 'City';
            $contain['contain'][] = 'State';
            $contain['contain'][] = 'Country';
            $contain['contain'][] = 'Attachment';
            $contain['contain'][] = 'Submission';
            if (isPluginEnabled('ProjectRewards')) {
                $contain['contain'][] = 'ProjectReward';
            }
            $tmpProject = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $id
                ) ,
                'contain' => $contain['contain'],
                'recursive' => 1
            ));
            if (!empty($tmp_error)) {
                $this->Project->validationErrors = $tmp_error;
            }
            if (!empty($this->request->data)) {
                foreach($tmpProject['Project'] as $key => $value) {
                    if (!isset($this->request->data['Project'][$key]) && !empty($value)) {
                        $this->request->data['Project'][$key] = $value;
                    }
                }
            }
            if (empty($is_overwrite_data)) {
                if (!empty($tmpProject['ProjectReward'])) {
                    $this->request->data['ProjectReward'] = $tmpProject['ProjectReward'];
                }
                if (!empty($tmpProject['City'])) {
                    $this->request->data['City'] = $tmpProject['City'];
                }
                if (!empty($tmpProject['State'])) {
                    $this->request->data['State'] = $tmpProject['State'];
                }
                if (!empty($tmpProject['Country'])) {
                    $this->request->data['Country'] = $tmpProject['Country'];
                    $this->request->data['Project']['country_id'] = $tmpProject['Country']['iso_alpha2'];
                }
                if (!empty($tmpProject['Pledge'])) {
                    $this->request->data['Pledge'] = $tmpProject['Pledge'];
                }
                if (!empty($tmpProject['Donate'])) {
                    $this->request->data['Donate'] = $tmpProject['Donate'];
                }
                if (!empty($tmpProject['Lend'])) {
                    $this->request->data['Lend'] = $tmpProject['Lend'];
                }
                if (!empty($tmpProject['Equity'])) {
                    $this->request->data['Equity'] = $tmpProject['Equity'];
                }
                if (!empty($tmpProject['Submission'])) {
                    $this->request->data['Submission'] = $tmpProject['Submission'];
                }
                if (!empty($tmpProject['Attachment'])) {
                    $this->request->data['Attachment'] = $tmpProject['Attachment'];
                }
            }
            $this->request->data['Project']['step'] = 2;
            $project_media = array();
            if (!empty($this->request->data['Submission']['id'])) {
                $SubmissionFields = $this->Project->Submission->SubmissionField->find('all', array(
                    'conditions' => array(
                        'SubmissionField.submission_id' => $this->request->data['Submission']['id']
                    ) ,
                    'recursive' => 1
                ));
                if (!empty($SubmissionFields)) {
                    foreach($SubmissionFields as $submissionValue) {
                        if ($submissionValue['SubmissionField']['type'] == 'checkbox' || $submissionValue['SubmissionField']['type'] == 'multiselect') {
                            $multi_selects = explode("\n", $submissionValue['response']);
                            foreach($multi_selects as $multi_select) {
                                $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']][] = $multi_select;
                            }
                        } elseif ($submissionValue['SubmissionField']['type'] == 'date' || $submissionValue['SubmissionField']['type'] == 'datetime' || $submissionValue['SubmissionField']['type'] == 'time') {
                            if (!empty($submissionValue['response'])) {
                                $multi_selects = explode("\n", $submissionValue['response']);
                                if ($field_type[1] == 'date' || $field_type[1] == 'datetime') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['month'] = $multi_selects[0];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['day'] = $multi_selects[1];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['year'] = $multi_selects[2];
                                }
                                if ($submissionValue['SubmissionField']['type'] == 'datetime') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['hour'] = !empty($multi_selects[3]) ? $multi_selects[3] : '';
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['min'] = !empty($multi_selects[4]) ? $multi_selects[4] : '';
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['meridian'] = !empty($multi_selects[5]) ? $multi_selects[5] : '';
                                }
                                if ($submissionValue['SubmissionField']['type'] == 'time') {
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['hour'] = $multi_selects[0];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['min'] = $multi_selects[1];
                                    $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']]['meridian'] = $multi_selects[2];
                                }
                            }
                        } else {
                            $this->request->data['Form'][$submissionValue['SubmissionField']['form_field']] = $submissionValue['SubmissionField']['response'];
                        }
                        if (!empty($submissionValue['SubmissionThumb']['id'])) {
                            $project_media[$submissionValue['SubmissionField']['form_field']]['Attachment'] = $submissionValue['SubmissionThumb'];
                        }
                    }
                }
            }
            $this->set('project_media', $project_media);
        }
        if (empty($this->request->data['Project']['form_field_step'])) {
            $this->request->data['Project']['form_field_step'] = 1;
        }
        if (!$this->request->isPost() && !empty($this->request->data['Project']['is_restrict_steps'])) {
            $firstStepToDisplay = $this->Project->getFirstStepToDisplay($id);
            $this->request->data['Project']['form_field_step'] = !empty($firstStepToDisplay) ? $firstStepToDisplay : 1;
        }
        if (!empty($form_field_step)) {
            $this->request->data['Project']['form_field_step'] = $form_field_step;
            $this->request->data['Project']['step'] = 2;
        }
        if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
            $users = $this->Project->User->find('list');
            $this->set(compact('users'));
        }
        $countries = $this->Project->Country->find('list', array(
            'fields' => array(
                'Country.iso_alpha2',
                'Country.name'
            )
        ));
        $projectTypeFormFields = $this->Form->buildSchema($project['ProjectType']['id']);
        if (empty($this->request->data['Project']['project_type_slug'])) {
            $this->request->data['Project']['project_type_slug'] = $project['ProjectType']['slug'];
        }
        if (empty($this->request->data['Project']['submission_id']) && !empty($this->request->data['Submission']['id'])) {
            $this->request->data['Project']['submission_id'] = $this->request->data['Submission']['id'];
        }
        $this->set('projectTypeFormFields', $projectTypeFormFields);
        $is_disable_pledge_type_amount = 1;
        $pledgeTypes[ConstPledgeTypes::Any] = 'Any';
        if (Configure::read('Project.is_pledge_minimum_amount_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_minimum_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Minimum] = 'Minimum';
        }
        if (Configure::read('Project.is_suggested_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_suggested_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Reward] = 'Reward';
        }
        if (Configure::read('Project.is_multiple_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_multiple_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Multiple] = 'Multiple';
        }
        if (Configure::read('Project.is_fixed_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_fixed_amount_pledge'))) {
            $pledgeTypes[ConstPledgeTypes::Fixed] = 'Fixed';
        }
        if (count($pledgeTypes) > 1) {
            $is_disable_pledge_type_amount = 0;
        }
        $this->set(compact('pledgeTypes'));
        $this->set('is_disable_pledge_type_amount', $is_disable_pledge_type_amount);
        $projectTypeName = ucwords($project['ProjectType']['name']);
        App::import('Model', $projectTypeName . '.' . $projectTypeName);
        $model = new $projectTypeName();
        $response = $model->onProjectCategories();
        $this->set($project['ProjectType']['slug'] . 'Categories', $response[$project['ProjectType']['slug'] . 'Categories']);
        $response = Cms::dispatchEvent('Controller.Project.ProjectRelatedMasters', $this, array(
            'data' => $this->request->data,
            'pledgeCategories' => null,
            'donateCategories' => null,
            'lendCategories' => null,
            'equityCategories' => null,
        ));
        if (isPluginEnabled('Lend')) {
        	App::import('Model', 'Lend.CreditScore');
        	$this->CreditScore = new CreditScore();
        	$response = $this->CreditScore->GetProjectRelatedMasters();
        	$this->set('creditScores', $response['creditScores']);
        	$this->set('loanTerms', $response['loanTerms']);
        	$this->set('repaymentSchedules', $response['repaymentSchedules']);
        }
        $this->set('current_form_step', $this->request->data['Project']['form_field_step']);
		if(!empty($response->data['creditScores'])) {
			$this->set('creditScores', $response->data['creditScores']);
		}
		if(!empty($response->data['loanTerms'])) {
			$this->set('loanTerms', $response->data['loanTerms']);
		}
		if(!empty($response->data['repaymentSchedules'])) {
			$this->set('repaymentSchedules', $response->data['repaymentSchedules']);
		}
        $paymentMethods = array(
            ConstPaymentMethod::AoN => 'Fixed Funding',
            ConstPaymentMethod::KiA => 'Flexible Funding'
        );
        if (empty($this->request->data['Project']['payment_method_id'])) {
            $this->request->data['Project']['payment_method_id'] = (Configure::read('Project.project_fund_capture') == 'Fixed Funding') ? ConstPaymentMethod::AoN : ConstPaymentMethod::KiA;
        }
        $this->set(compact('countries', 'paymentMethods'));
        $is_splash = $this->FormFieldStep->find('all', array(
            'conditions' => array(
                'FormFieldStep.order' => $this->request->data['Project']['form_field_step'],
                'FormFieldStep.is_splash' => 1,
                'FormFieldStep.project_type_id' => $project['ProjectType']['id']
            ) ,
            'recursive' => -1
        ));
        if (!empty($is_splash) && !empty($this->request->data['Project']['id'])) {
            $projectStatus = array();
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                'projectStatus' => $projectStatus,
                'project' => $tmpProject,
                'type' => 'status'
            ));
            $this->Project->getAndUpdateTrackedSteps($this->request->data['Project']['id'], $this->request->data['Project']['form_field_step'], '', '', $response->data);
        }
        $this->set('is_splash', $is_splash);
    }
    public function admin_cancel($id = null)
    {
        $this->setAction('cancel', $id);
    }
    public function cancel($id = null)
    {
        $this->pageTitle = sprintf(__l('Cancel %s') , Configure::read('project.alt_name_for_project_singular_caps'));
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id' => $id
            ) ,
            'contain' => array(
                'ProjectType'
            ) ,
            'recursive' => 0
        ));
        if (empty($project) || (!empty($project) && ((!Configure::read('Project.is_allow_owner_project_cancel') && $this->Auth->user('id') == $project['Project']['user_id']) || $this->Auth->user('id') != $project['Project']['user_id'] && $this->Auth->user('role_id') != ConstUserTypes::Admin))) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($project['Project']['project_type_id'] == ConstProjectTypes::Donate) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Project->
        {
            $project['ProjectType']['name']}->updateStatus(constant(sprintf('%s::%s', 'Const' . $project['ProjectType']['name'] . 'ProjectStatus', 'ProjectCanceled')) , $project['Project']['id']);
            if ($this->Project->save($this->request->data, false)) {
                $this->Session->setFlash(sprintf(__l('%s has been canceled successfully') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
            } else {
                $this->Session->setFlash(sprintf(__l('%s could not be canceled') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'error');
            }
            if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
                $this->redirect(array(
                    'controller' => 'pledges',
                    'action' => 'index',
                ));
            } else {
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'dashboard',
                ));
            }
        }
        public function admin_index()
        {
            $this->pageTitle = Configure::read('project.alt_name_for_project_plural_caps');
            if (!empty($this->request->params['named']['project_type'])) {
                $this->pageTitle = Configure::read('project.alt_name_for_' . $this->request->params['named']['project_type'] . '_singular_caps') . ' ' . $this->pageTitle;
                $project_type = $this->Project->ProjectType->find('first', array(
                    'conditions' => array(
                        'ProjectType.slug' => $this->request->params['named']['project_type']
                    ) ,
                    'recursive' => -1
                ));
                $this->set('project_type', $project_type);
            }
        }
        public function admin_add($id = null, $form_field_step = null)
        {
            $this->setAction('add', $id, $form_field_step);
        }
        public function admin_edit($id = null, $form_field_step = null)
        {
            $this->setAction('edit', $id, $form_field_step);
        }
        public function admin_open_funding($id = null)
        {
            if (is_null($id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id = ' => $id,
                ) ,
                'contain' => array(
                    'ProjectType'
                ) ,
                'recursive' => 0
            ));
            $data['project_id'] = $id;
            $response = Cms::dispatchEvent('Controller.Project.openFunding', $this, array(
                'data' => $data,
                'type' => $this->request->params['named']['type']
            ));
            if (!empty($response->data['message'])) {
                $this->Session->setFlash($response->data['message'], 'default', null, 'success');
            } else {
                $this->Session->setFlash($response->data['error_message'], 'default', null, 'error');
            }
            $this->redirect(array(
                'controller' => Inflector::pluralize($project['ProjectType']['slug']) ,
                'action' => 'index',
            ));
        }
        public function admin_delete($id = null)
        {
            if (is_null($id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $this->Project->_refund($id);
            if ($this->Project->delete($id)) {
                $this->Session->setFlash(sprintf(__l('%s deleted') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                if (!empty($this->request->params['named']['redirect_to'])) {
                    $this->redirect(array(
                        'controller' => $this->request->params['named']['redirect_to']
                    ));
                } else {
                    $this->redirect(array(
                        'action' => 'index'
                    ));
                }
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        public function admin_update()
        {
            if (!empty($this->request->data['Project'])) {
                $this->Project->Behaviors->detach('SuspiciousWordsDetector');
                $r = $this->request->data[$this->modelClass]['r'];
                $actionid = $this->request->data[$this->modelClass]['more_action_id'];
                unset($this->request->data[$this->modelClass]['r']);
                unset($this->request->data[$this->modelClass]['more_action_id']);
                $userIds = array();
                foreach($this->request->data['Project'] as $project_id => $is_checked) {
                    if ($is_checked['id']) {
                        $projectIds[] = $project_id;
                    }
                }
                if ($actionid && !empty($projectIds)) {
                    if ($actionid == ConstMoreAction::Inactive) {
                        foreach($projectIds as $val) {
                            $project['Project']['is_active'] = 0;
                            $project['Project']['id'] = $val;
                            $this->Project->save($project, false);
                        }
                        $this->Session->setFlash(__l('Checked records has been inactivated') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Active) {
                        foreach($projectIds as $val) {
                            $project = array();
                            $project['Project']['is_active'] = 1;
                            $project['Project']['id'] = $val;
                            $this->Project->save($project, false);
                            $condition['Project.id'] = $project['Project']['id'];
                            $project = $this->Project->find('first', array(
                                'conditions' => $condition,
                                'recursive' => 0
                            ));
                        }
                        $this->Session->setFlash(__l('Checked records has been activated') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Delete) {
                        foreach($projectIds as $id) {
                            $this->Project->_refund($id);
                            $this->Project->delete($id, false);
                        }
                        $this->Session->setFlash(__l('Checked records has been deleted') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Approved) {
                        foreach($projectIds as $id) {
                            $data['project_id'] = $id;
                            $response = Cms::dispatchEvent('Controller.Project.openFunding', $this, array(
                                'data' => $data,
                                'type' => 'approve',
                            ));
                        }
                        $this->Session->setFlash(__l('Checked records has been opened') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Suspend) {
                        foreach($projectIds as $id) {
                            $this->Project->_refund($id);
                            $project['Project']['is_admin_suspended'] = 1;
                            $project['Project']['id'] = $id;
                            $this->Project->save($project, false);
                        }
                        $this->Session->setFlash(__l('Checked records has been suspended') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Unsuspend) {
                        foreach($projectIds as $val) {
                            $project['Project']['is_admin_suspended'] = 0;
                            $project['Project']['id'] = $val;
                            $this->Project->save($project, false);
                        }
                        $this->Session->setFlash(__l('Checked records has been unsuspended') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Flagged) {
                        $this->Project->updateAll(array(
                            'Project.is_system_flagged' => 1
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        $this->Session->setFlash(__l('Checked records has been flagged') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Unflagged) {
                        $this->Project->updateAll(array(
                            'Project.is_system_flagged' => 0
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        $this->Session->setFlash(__l('Checked records has been unflagged') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Featured) {
                        $this->Project->updateAll(array(
                            'Project.is_featured' => 1
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        @unlink(APP . 'webroot' . DS . 'index.html');
                        $this->Session->setFlash(__l('Checked records has been featured') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Notfeatured) {
                        $this->Project->updateAll(array(
                            'Project.is_featured' => 0
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        @unlink(APP . 'webroot' . DS . 'index.html');
                        $this->Session->setFlash(__l('Checked records has been marked as not featured') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Successful) {
                        $this->Project->updateAll(array(
                            'Project.is_successful' => 0
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        $this->Session->setFlash(__l('Checked records has been marked as genuine') , 'default', null, 'success');
                    } else if ($actionid == ConstMoreAction::Failed) {
                        $this->Project->updateAll(array(
                            'Project.is_successful' => 1
                        ) , array(
                            'Project.id' => $projectIds
                        ));
                        $this->Session->setFlash(__l('Checked records has been marked as not genuine') , 'default', null, 'success');
                    }
                }
            }
            $this->redirect(Router::url('/', true) . $r);
        }
        public function guidelines()
        {
            $this->pageTitle = sprintf(__l('%s - Guidelines') , Configure::read('project.alt_name_for_project_singular_caps'));
            if (!empty($this->request->data)) {
                $this->Project->set($this->request->data);
                if ($this->Project->validates()) {
                    $this->redirect(array(
                        'action' => 'add',
                    ));
                }
            }
        }
        public function delete_attachment($project_id = null, $project_type_id = null, $id = null, $field_id = null, $action = 'edit', $step = null)
        {
            if (is_null($id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            if (!empty($field_id)) {
                $this->loadModel('Projects.Submission');
                $this->loadModel('Projects.FormField');
                $submission = $this->Submission->find('first', array(
                    'conditions' => array(
                        'Submission.project_id' => $project_id,
                    ) ,
                    'recursive' => -1
                ));
                $submission_field = $this->Submission->SubmissionField->find('first', array(
                    'conditions' => array(
                        'SubmissionField.id' => $field_id,
                    ) ,
                    'recursive' => -1
                ));
                $depended_formfield = $this->FormField->find('first', array(
                    'conditions' => array(
                        'FormField.depends_on' => $submission_field['SubmissionField']['form_field'],
                        'FormField.project_type_id' => $project_type_id,
                    ) ,
                    'recursive' => -1
                ));
                $depended_submission_field = $this->Submission->SubmissionField->find('first', array(
                    'conditions' => array(
                        'SubmissionField.submission_id' => $submission['Submission']['id'],
                        'SubmissionField.form_field_id' => $depended_formfield['FormField']['id'],
                    ) ,
                    'recursive' => -1
                ));
                $this->Submission->SubmissionField->delete($field_id);
                $this->Submission->SubmissionField->delete($depended_submission_field['SubmissionField']['id']);
            }
            if ($this->Project->Attachment->delete($id)) {
                $this->Session->setFlash(sprintf(__l('%s deleted') , __l('Attachment')) , 'default', null, 'success');
                if (!empty($step)) {
                    $this->redirect(array(
                        'controller' => 'projects',
                        'action' => $action,
                        $project_id,
                        $step,
                    ));
                }
                $this->redirect(array(
                    'controller' => 'projects',
                    'action' => $action,
                    $project_id
                ));
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        public function mediadownload($slug = null, $field_id = null, $attachment_id = null)
        {
            //checking Authontication
            if (empty($slug) or empty($attachment_id) or is_null($field_id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.slug =' => $slug,
                ) ,
                'contain' => array(
                    'Submission' => array(
                        'SubmissionField' => array(
                            'conditions' => array(
                                'SubmissionField.id' => $field_id
                            ) ,
                            'SubmissionThumb' => array(
                                'conditions' => array(
                                    'SubmissionThumb.id' => $attachment_id
                                )
                            ) ,
                        ) ,
                    ) ,
                ) ,
                'recursive' => 3
            ));
            if (empty($project['Submission']['SubmissionField'][0])) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $file = $project['Submission']['SubmissionField'][0]['SubmissionThumb'];
            // Code to download
            $this->viewClass = 'Media';
            // Download app/outside_webroot_dir/example.zip
            $file_arr = pathinfo($file['filename']);
            $params = array(
                'id' => $file['filename'],
                'name' => $file_arr['filename'],
                'download' => true,
                'extension' => $file_arr['extension'],
                'path' => 'media' . DS . $file['dir'] . DS
            );
            $this->set($params);
        }
        function chart()
        {
            $this->set('total_projects', $this->Project->find('count'));
        }
        function project_pay_now($project_id = null)
        {
            if (!empty($this->request->params['named']['project_id'])) {
                $project_id = $this->request->params['named']['project_id'];
            }
            $this->pageTitle = __l('Pay Listing Fee');
            if (!empty($this->request->data['Project']['id'])) {
                $project_id = $this->request->data['Project']['id'];
            }
            if (!empty($this->request->data)) {
                $this->request->data['Project']['sudopay_gateway_id'] = 0;
                if ($this->request->data['Project']['payment_gateway_id'] != ConstPaymentGateways::Wallet && strpos($this->request->data['Project']['payment_gateway_id'], 'sp_') >= 0) {
                    $this->request->data['Project']['sudopay_gateway_id'] = str_replace('sp_', '', $this->request->data['Project']['payment_gateway_id']);
                    $this->request->data['Project']['payment_gateway_id'] = ConstPaymentGateways::SudoPay;
                }
            }
            if (empty($project_id)) {
                $data['Project']['user_id'] = $this->Auth-user('id');
                $this->Project->save($data, false);
            }
            if (is_null($project_id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id,
                    'Project.is_paid' => 0,
                ) ,
                'fields' => array(
                    'Project.id',
                    'Project.name',
                    'Project.slug',
                    'Project.user_id',
                    'Project.project_type_id',
                    'Project.needed_amount',
                    'Project.is_active'
                ) ,
                'recursive' => -1,
            ));
            if (empty($project) || (!empty($project) && $project['Project']['user_id'] != $this->Auth->user('id'))) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $projectType = $this->Project->ProjectType->find('first', array(
                'conditions' => array(
                    'ProjectType.id' => $project['Project']['project_type_id']
                ) ,
            ));
            if (isset($projectType['ProjectType']['listing_fee']) and $projectType['ProjectType']['listing_fee'] != 0 and !empty($projectType['ProjectType']['listing_fee_type'])) {
                if ($projectType['ProjectType']['listing_fee_type'] == ConstListingFeeType::amount) {
                    $total_amount = $projectType['ProjectType']['listing_fee'];
                } else {
                    $total_amount = $project['Project']['needed_amount']*($projectType['ProjectType']['listing_fee']/100);
                }
            } else {
                if (Configure::read('Project.project_listing_fee_type') == 'amount') {
                    $total_amount = Configure::read('Project.listing_fee');
                } else {
                    $total_amount = $project['Project']['needed_amount']*(Configure::read('Project.listing_fee') /100);
                }
            }
            if (!empty($this->request->data)) {
                if ($this->request->data['Project']['payment_gateway_id'] == ConstPaymentGateways::Wallet and isPluginEnabled('Wallet')) {
                    $this->loadModel('Wallet.Wallet');
                    $return = $this->Wallet->processPayToProject($this->Auth->user('id') , $total_amount, $project_id);
                    if (!$return) {
                        $this->Session->setFlash(__l('Your wallet has insufficient money') , 'default', null, 'error');
                        if ($this->request->data['Project']['id'] && $this->request->data['Project']['step_id'] && $this->request->data['Project']['page']) {
                            $this->redirect(array(
                                'controller' => $projectType['ProjectType']['slug'],
                                'action' => $this->request->data['Project']['page'],
                                $this->request->data['Project']['id'],
                                $this->request->data['Project']['step_id']
                            ));
                        } else {
                            $controller = ($this->request->data['Project']['page'] == 'edit') ? 'projects' : $projectType['ProjectType']['slug'];
                            $this->redirect(array(
                                'controller' => $controller,
                                'action' => $this->request->data['Project']['page'],
                                $this->request->data['Project']['id'],
                                $this->request->data['Project']['step_id']
                            ));
                        }
                    } else {
                        $this->Session->setFlash(sprintf(__l('%s has been added') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                        if (!empty($this->request->data['Project']['step_id'])) {
                            $controller = ($this->request->data['Project']['page'] == 'edit') ? 'projects' : $projectType['ProjectType']['slug'];
                            $next_step = $this->Project->getProjectNextStep($project, $this->request->data['Project']['page'], $this->request->data['Project']['step_id']);
                           if($next_step > $this->request->data['Project']['step_id']){
								 $this->redirect(array(
									'controller' => $controller,
									'action' => $this->request->data['Project']['page'],
									$project['Project']['id'],
									$next_step
								));
							}
                        } 
						$this->redirect(array(
							'controller' => 'projects',
							'action' => 'view',
							$project['Project']['slug'],
						));
                    }
                } elseif ($this->request->data['Project']['payment_gateway_id'] == ConstPaymentGateways::SudoPay) {
                    $_data = array();
                    $_data['Project']['id'] = $this->request->data['Project']['id'];
                    $_data['Project']['sudopay_gateway_id'] = $this->request->data['Project']['sudopay_gateway_id'];
                    $this->Project->save($_data);
                    $this->loadModel('Sudopay.Sudopay');
                    $sudopay_gateway_settings = $this->Sudopay->GetSudoPayGatewaySettings();
                    $this->set('sudopay_gateway_settings', $sudopay_gateway_settings);
                    if ($sudopay_gateway_settings['is_payment_via_api'] == ConstBrandType::VisibleBranding) {
                        $sudopay_data = $this->Sudopay->getSudoPayPostData($project['Project']['id'], ConstPaymentType::ProjectListing);
                        $sudopay_data['merchant_id'] = $sudopay_gateway_settings['sudopay_merchant_id'];
                        $sudopay_data['website_id'] = $sudopay_gateway_settings['sudopay_website_id'];
                        $sudopay_data['secret_string'] = $sudopay_gateway_settings['sudopay_secret_string'];
                        $sudopay_data['action'] = 'capture';
                        $this->set('sudopay_data', $sudopay_data);
                    } else {
                        $this->request->data['Sudopay'] = !empty($this->request->data['Sudopay']) ? $this->request->data['Sudopay'] : '';
                        $return = $this->Sudopay->processPayment($project['Project']['id'], ConstPaymentType::ProjectListing, $this->request->data['Sudopay']);
                        if (!empty($return['pending'])) {
                            $this->Session->setFlash(__l('Your payment is in pending.') , 'default', null, 'success');
							 if (!empty($this->request->data['Project']['step_id'])) {
                                $controller = ($this->request->data['Project']['page'] == 'edit') ? 'projects' : $projectType['ProjectType']['slug'];
                                $next_step = $this->Project->getProjectNextStep($project, $this->request->data['Project']['page'], $this->request->data['Project']['step_id']);
								if($next_step > $this->request->data['Project']['step_id']){
									 $this->redirect(array(
										'controller' => $controller,
										'action' => $this->request->data['Project']['page'],
										$project['Project']['id'],
										$next_step
									));
								}
                               
                            }
							$this->redirect(array(
								'controller' => 'projects',
								'action' => 'view',
								$project['Project']['slug'],
							));
                        } elseif (!empty($return['success'])) {
                            $this->Project->processPayment($project['Project']['id'], $total_amount, ConstPaymentGateways::SudoPay);
                            $this->Session->setFlash(__l('You have paid listing fee successfully.') , 'default', null, 'success');
                            if (!empty($this->request->data['Project']['step_id'])) {
                                $controller = ($this->request->data['Project']['page'] == 'edit') ? 'projects' : $projectType['ProjectType']['slug'];
                                $next_step = $this->Project->getProjectNextStep($project, $this->request->data['Project']['page'], $this->request->data['Project']['step_id']);
								if($next_step > $this->request->data['Project']['step_id']){
									 $this->redirect(array(
										'controller' => $controller,
										'action' => $this->request->data['Project']['page'],
										$project['Project']['id'],
										$next_step
									));
								}
                               
                            }
							$this->redirect(array(
								'controller' => 'projects',
								'action' => 'view',
								$project['Project']['slug'],
							));
                        } elseif (!empty($return['error'])) {
                            $this->Session->setFlash($return['error_message'] . __l('Payment could not be completed.') , 'default', null, 'error');
                            $controller = ($this->request->data['Project']['page'] == 'edit') ? 'projects' : $projectType['ProjectType']['slug'];
                            $this->redirect(array(
                                'controller' => $controller,
                                'action' => $this->request->data['Project']['page'],
                                $this->request->data['Project']['id'],
                                $this->request->data['Project']['step_id']
                            ));
                        }
                    }
                }
            } else {
                $this->request->data = $project;
            }
            if (!empty($this->request->params['named']['step_id'])) {
                $this->request->data['Project']['step_id'] = $this->request->params['named']['step_id'];
                $this->request->data['Project']['page'] = $this->request->params['named']['page'];
            }
            $this->set('total_amount', $total_amount);
        }
        public function myprojects()
        {
            $this->pageTitle = __l('Projects Posted');
            $projectTypes = $this->Project->ProjectType->find('all', array(
                'conditions' => array(
                    'ProjectType.is_active' => 1
                ) ,
                'fields' => array(
                    'ProjectType.name',
                    'ProjectType.slug'
                ) ,
                'recursive' => -1
            ));
            $this->set('projectTypes', $projectTypes);
            if (!empty($this->request->params['named']['from'])) {
                $projectTypes = $this->Project->ProjectType->find('list', array(
                    'fields' => array(
                        'ProjectType.name'
                    ) ,
                    'recursive' => -1
                ));
                foreach($projectTypes as $key => $type) {
                    $count[$key] = $this->Project->find('count', array(
                        'conditions' => array(
                            'Project.is_active' => 1,
                            'Project.user_id' => $this->Auth->user('id') ,
                            'Project.project_type_id' => $key
                        ) ,
                        'recursive' => -1
                    ));
                }
                $this->set('count', $count);
                $this->render('project_filter');
            }
            if (!empty($this->request->query['_pjax'])) {
                $this->request->params['isAjax'] = 0;
            }
        }
        public function myfunds()
        {
            $this->pageTitle = __l('Projects Funded');
            $projectTypes = $this->Project->ProjectType->find('all', array(
                'conditions' => array(
                    'ProjectType.is_active' => 1
                ) ,
                'fields' => array(
                    'ProjectType.name',
                    'ProjectType.slug'
                ) ,
                'recursive' => -1
            ));
            $this->set('projectTypes', $projectTypes);
            if (!empty($this->request->params['named']['from'])) {
                $this->set('count', $count);
                $this->render('funds_filter');
            }
        }
        public function admin_pending_approval_steps($project_id = null)
        {
            $this->request->data['Project']['id'] = $project_id;
            $submission = $this->Project->Submission->find('first', array(
                'conditions' => array(
                    'Submission.project_id' => $project_id
                ) ,
                'contain' => array(
                    'SubmissionField'
                ) ,
                'recursive' => 2
            ));
            if (!empty($submission)) {
                $submissionFields = array();
                foreach($submission['SubmissionField'] as $submissionField) {
                    $submissionFields[$submissionField['form_field']] = $submissionField['response'];
                }
                $this->set('submissionFields', $submissionFields);
            }
            $contain = array(
                'User' => array(
                    'UserAvatar',
                    'UserProfile' => array(
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
                            ) ,
                        ) ,
                    ) ,
                    'UserWebsite' => array(
                        'fields' => array(
                            'UserWebsite.id',
                            'UserWebsite.website'
                        )
                    ) ,
                ) ,
                'Submission' => array(
                    'SubmissionField' => array(
                        'ProjectCloneThumb',
                        'SubmissionThumb',
                        'FormField'
                    ) ,
                ) ,
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
                ) ,
                'State' => array(
                    'fields' => array(
                        'State.name',
                    )
                ) ,
                'Attachment',
                'ProjectType' => array(
                    'fields' => array(
                        'ProjectType.name',
                        'ProjectType.slug',
                        'ProjectType.funder_slug',
                        'ProjectType.id',
                    ) ,
                ) ,
                'ProjectFund' => array(
                    'User' => array(
                        'UserAvatar'
                    ) ,
                    'limit' => 4,
                    'order' => array(
                        'ProjectFund.id' => 'desc'
                    )
                ) ,
            );
            if (isPluginEnabled('ProjectRewards')) {
                $contain['ProjectReward'] = array(
                    'order' => array(
                        'ProjectReward.pledge_amount' => 'asc'
                    )
                );
            }
            if (isPluginEnabled('Idea')) {
                $contain['ProjectRating'] = array(
                    'fields' => array(
                        'ProjectRating.user_id'
                    ) ,
                    'User'
                );
            }
            $response = Cms::dispatchEvent('Controller.ProjectType.getContain', $this, array(
                'type' => 1
            ));
            $event_data['contain'] = $response->data['contain'];
            $contain = array_merge($contain, $response->data['contain']);
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id
                ) ,
                'contain' => $contain,
                'recursive' => 3
            ));
            $this->set('project', $project);
            App::import('Model', 'Projects.FormFieldStep');
            $this->FormFieldStep = new FormFieldStep();
            $formFieldSteps = $this->FormFieldStep->find('all', array(
                'conditions' => array(
                    'FormFieldStep.project_type_id' => $project['Project']['project_type_id']
                ) ,
                'contain' => array(
                    'FormFieldGroup' => array(
                        'FormField' => array(
                            'order' => array(
                                'FormField.order' => 'DESC'
                            ) ,
                        ) ,
                        'order' => array(
                            'FormFieldGroup.order' => 'DESC'
                        ) ,
                    ) ,
                ) ,
                'order' => array(
                    'FormFieldStep.order' => 'DESC'
                ) ,
                'recursive' => 2
            ));
            $this->set('formFieldSteps', $formFieldSteps);
            if (isPluginEnabled('SeisScheme')) {
                $this->loadModel('SeisScheme.SeisEntry');
                $seisEntry = $this->SeisEntry->find('first', array(
                    'conditions' => array(
                        'SeisEntry.project_id' => $project['Project']['id'],
                    ) ,
                    'recursive' => -1
                ));
                $this->set('seisEntry', $seisEntry);
            }
            $pending_steps_arr = $this->Project->getAdminPendingSteps($project_id);
            $this->set('pending_step_arr', $pending_steps_arr);
            $pledgeTypes[ConstPledgeTypes::Any] = 'Any';
            if (Configure::read('Project.is_pledge_minimum_amount_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_minimum_amount_pledge'))) {
                $pledgeTypes[ConstPledgeTypes::Minimum] = 'Minimum';
            }
            if (Configure::read('Project.is_suggested_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_suggested_pledge'))) {
                $pledgeTypes[ConstPledgeTypes::Reward] = 'Reward';
            }
            if (Configure::read('Project.is_multiple_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_multiple_amount_pledge'))) {
                $pledgeTypes[ConstPledgeTypes::Multiple] = 'Multiple';
            }
            if (Configure::read('Project.is_fixed_amount_pledge_enabled') && ($this->Auth->user('role_id') == ConstUserTypes::Admin || Configure::read('Project.is_allow_user_to_set_fixed_amount_pledge'))) {
                $pledgeTypes[ConstPledgeTypes::Fixed] = 'Fixed';
            }
            $this->set('pledgeTypes', $pledgeTypes);
        }
        public function admin_update_tracked_step()
        {
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $this->request->params['named']['project_id']
                ) ,
                'recursive' => -1
            ));
			
            $this->set('project', $project);
            if (!empty($this->request->data)) {
                $is_admin_approved = 0;
                if (empty($this->request->params['named']['reject'])) {
                    $is_admin_approved = 1;
                }
				
                $this->Project->getAndUpdateTrackedSteps($this->request->params['named']['project_id'], $this->request->params['named']['step'], $is_admin_approved, $this->request->data, array() , true);
                $projectType = $this->Project->ProjectType->find('first', array(
                    'conditions' => array(
                        'ProjectType.id' => $this->request->params['named']['project_type_id']
                    ) ,
                    'recursive' => -1
                ));
                $controller = Inflector::pluralize($projectType['ProjectType']['slug']);
                if (!empty($this->request->params['named']['reject'])) {
                    $this->Session->setFlash(sprintf(__l('%s has been rejected') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(sprintf(__l('%s has been approved') , Configure::read('project.alt_name_for_project_singular_caps')) , 'default', null, 'success');
                }
				if(isPluginEnabled('Idea'))	{
					$redirect_status =  ConstPledgeProjectStatus::OpenForIdea;
				}else{
					$redirect_status =  ConstPledgeProjectStatus::OpenForFunding;
				}
                $this->redirect(array(
                    'controller' => $controller,
                    'action' => 'index',
                    'project_status_id' => $redirect_status,
                    'admin' => true
                ));
            }
        }
        public function admin_tracked_step_activities($project_id = null, $project_type_id = null)
        {
            // find tracked_steps where project_id
            $tracked_steps = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $project_id
                ) ,
                'fields' => array(
                    'Project.tracked_steps',
                ) ,
                'recursive' => 0
            ));
            App::import('Model', 'Projects.FormFieldStep');
            $FormFieldStep = new FormFieldStep();
            $form_field_steps = $FormFieldStep->find('all', array(
                'conditions' => array(
                    'FormFieldStep.project_type_id' => $project_type_id
                ) ,
                'recursive' => -1
            ));
            $this->set('tracked_steps', $tracked_steps);
            $this->set('form_field_steps', $form_field_steps);
        }
        public function show_admin_control_panel()
        {
            $this->disableCache();
            if (!empty($this->request->params['named']['view_type']) && $this->request->params['named']['view_type'] == 'project') {
                $project = $this->Project->find('first', array(
                    'conditions' => array(
                        'Project.id' => $this->request->params['named']['id']
                    ) ,
                    'recursive' => 0
                ));
                $this->set('project', $project);
            }
            $this->layout = 'ajax';
        }
    }
?>