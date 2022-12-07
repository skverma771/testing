<?php
class MobileAppEventHandler extends UtObject implements CakeEventListener
{
    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents() 
    {
        return array(
            'Controller.Project.handleApp' => array(
                'callable' => '_handleApp',
            ) ,
            'Controller.Project.listing' => array(
                'callable' => 'onProjecListing',
            ) ,
            'Controller.Project.view' => array(
                'callable' => 'onProjectView',
            ) ,
            'Controller.ProjectFollowers.follow' => array(
                'callable' => 'onProjectFollow',
            ) ,
            'Controller.ProjectFollowers.unfollow' => array(
                'callable' => 'onProjectUnfollow',
            ) ,
            'Controller.Project.follow_listing' => array(
                'callable' => 'onfollowerListing',
            ) ,
            'Controller.Blog.listing' => array(
                'callable' => 'onBlogListing',
            ) ,
            'Controller.BlogComment.listing' => array(
                'callable' => 'onBlogCommentListing',
            ) ,
            'Controller.User.validate_user' => array(
                'callable' => 'validate_user',
            ) ,
            'Controller.ProjectFund.listing' => array(
                'callable' => 'onProjectFundsListing'
            ) ,
            'Controller.ProjectRating.listing' => array(
                'callable' => 'onProjectRatingListing'
            ) ,
            'Controller.ProjectComment.listing' => array(
                'callable' => 'onProjectCommentListing',
            ) ,
        );
    }
    public function _handleApp($event) 
    {
        $controller = $event->subject();
        App::uses('User', 'Model');
        $this->User = new User();
        if (!empty($_POST['data']) && in_array($controller->request->params['action'], array(
            'validate_user',
        ))) {
            foreach($_POST['data'] as $controller => $values) {
                $controller->request->data[Inflector::camelize(Inflector::singularize($controller)) ] = $values;
            }
        }
        if (!empty($_GET['username']) && $controller->request->params['action'] != 'validate_user') {
            $controller->request->data['User'][Configure::read('user.using_to_login') ] = trim($_GET['username']);
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.mobile_app_hash' => $_GET['passwd']
                ) ,
                'fields' => array(
                    'User.password'
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                $controller->set('iphone_response', array(
                    'status' => 1,
                    'message' => sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login'))
                ));
            } else {
                $controller->request->data['User']['password'] = $user['User']['password'];
                if (!$controller->Auth->login($controller->request->data)) {
                    $controller->set('iphone_response', array(
                        'status' => 1,
                        'message' => sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login'))
                    ));
                }
                if ($controller->Auth->user('id') && !empty($_GET['latitude']) && !empty($_GET['longtitude'])) {
                    $this->update_iphone_user($_GET['latitude'], $_GET['longtitude'], $controller->Auth->user('id'));
                }
            }
        }
    }
    function update_iphone_user($latitude, $longitude, $user_id) 
    {
        App::uses('User', 'Model');
        $this->User = new User();
        $this->User->updateAll(array(
            'User.iphone_latitude' => $latitude,
            'User.iphone_longitude' => $longitude,
            'User.iphone_last_access' => "'" . date("Y-m-d H:i:s") . "'"
        ) , array(
            'User.id' => $user_id
        ));
    }
    public function onProjecListing($event) 
    {
        $obj = $event->subject();
        $conditions = $event->data['data']['conditions'];
        $order = $event->data['data']['order'];
        $limit = $event->data['data']['limit'];
        $contain = array(
            'Attachment',
            'User' => array(
                'fields' => array(
                    'User.username',
                    'User.id'
                )
            ) ,
        );
        if (!empty($event->data['data']['contain'])) {
            $contain = array_merge($contain, $event->data['data']['contain']);
        }
        $obj->paginate = array(
            'conditions' => $conditions,
            'contain' => $contain,
            'fields' => array(
                'Project.id',
                'Project.name',
                'Project.project_end_date',
                'Project.collected_amount',
                'Project.collected_percentage',
                'Project.slug',
                'Project.needed_amount',
                'Project.project_type_id',
                'Project.user_id',
            ) ,
            'order' => $order,
            'recursive' => 4,
            'limit' => $limit,
        );
        $iphone_project_index = $obj->paginate();
        for ($end = 0; $end < count($iphone_project_index); $end++) {
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $image_url = getImageUrl('Project', $iphone_project_index[$end]['Attachment'], $image_options);
            $big_image_options = array(
                'dimension' => 'iphone_big_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $big_thumb_image_url = getImageUrl('Project', $iphone_project_index[$end]['Attachment'], $big_image_options);
            $this->saveiPhoneAppThumb($iphone_project_index[$end]['Attachment']);
            if (strtotime($iphone_project_index[$end]['Project']['project_end_date']) < strtotime(date('Y-m-d'))) {
                $date = date('d', strtotime($iphone_project_index[$end]['Project']['project_end_date']));
                $month = date('F', strtotime($iphone_project_index[$end]['Project']['project_end_date']));
                $year = date('y', strtotime($iphone_project_index[$end]['Project']['project_end_date']));
                $days_to_go = $month . " " . $year;
                $text = __l('Funded');
            } elseif (strtotime($iphone_project_index[$end]['Project']['project_end_date']) == strtotime(date('Y-m-d'))) {
                $days_to_go = floor((strtotime(date('Y-m-d h:i:s')) -strtotime($iphone_project_index[$end]['Project']['project_end_date'])) /3600);
                $text = __l('Hours to go');
            } else {
                $days_to_go = (strtotime($iphone_project_index[$end]['Project']['project_end_date']) -strtotime(date('Y-m-d'))) /(60*60*24);
                $text = __l('Days to go');
            }
            $project_descrption = sprintf(__l('A %s in by %s') , Configure::read('project.alt_name_for_project_singular_caps') , $iphone_project_index[$end]['User']['username']);
            $backer = $obj->Project->ProjectFund->find('count', array(
                'conditions' => array(
                    'ProjectFund.project_fund_status_id' => array(
                        ConstProjectFundStatus::Authorized,
                        ConstProjectFundStatus::PaidToOwner,
                        ConstProjectFundStatus::Closed,
                        ConstProjectFundStatus::DefaultFund
                    ) ,
                    'ProjectFund.project_id' => $iphone_project_index[$end]['Project']['id'],
                ) ,
                'recursive' => -1
            ));
            $project_updates = $iphone_project_index[$end]['Blog'];
            $updates = array();
            $update_comments = array();
            for ($n = 0; $n < count($project_updates); $n++) {
                $date = date('d', strtotime($project_updates[$n]['created']));
                $month = date('F', strtotime($project_updates[$n]['created']));
                $update_created = $month . " " . $date;
                $updates[$n]['Update_title'] = $project_updates[$n]['title'];
                $updates[$n]['Update_slug'] = $project_updates[$n]['slug'];
                $updates[$n]['Update_description'] = $project_updates[$n]['content'];
                $updates[$n]['Update_created'] = $update_created;
                $updates[$n]['Update_username'] = $project_updates[$n]['User']['username'];
                $updates[$n]['Update_user_image'] = getImageUrl('UserAvatar', $project_updates[$n]['User']['UserAvatar'], $image_options);
                $project_update_comments = $project_updates[$n]['BlogComment'];
                for ($j = 0; $j < count($project_update_comments); $j++) {
                    $date = date('d', strtotime($project_update_comments[$j]['created']));
                    $month = date('F', strtotime($project_update_comments[$j]['created']));
                    $update_comment_created = $month . " " . $date;
                    $update_comments[$j]['BlogComment_comment'] = $project_update_comments[$j]['comment'];
                    $update_comments[$j]['BlogComment_created'] = $update_comment_created;
                    $update_comments[$j]['BlogComment_username'] = $project_update_comments[$j]['User']['username'];
                    $update_comments[$j]['Blogcomment_user_image'] = getImageUrl('UserAvatar', $project_update_comments[$j]['User']['UserAvatar'], $image_options);
                }
                $updates[$n]['UpdateComments'] = $update_comments;
            }
            $ProjectTypeStatus = Cms::dispatchEvent('Controller.ProjectType.getProjectTypeStatus', $obj, array(
                'project' => $iphone_project_index[$end]
            ));
            $iphone_project_indexs[$end]['Project_id'] = $iphone_project_index[$end]['Project']['id'];
            $iphone_project_indexs[$end]['Project_name'] = $iphone_project_index[$end]['Project']['name'];
            $iphone_project_indexs[$end]['Project_slug'] = $iphone_project_index[$end]['Project']['slug'];
            if (!empty($iphone_project_index[$end]['Project']['needed_amount'])) {
                $iphone_project_indexs[$end]['Funding_amount'] = $iphone_project_index[$end]['Project']['needed_amount'];
            }
            $iphone_project_indexs[$end]['Funded'] = ($iphone_project_index[$end]['Project']['collected_percentage'] != "") ? $iphone_project_index[$end]['Project']['collected_percentage'] : 0.00;
            $iphone_project_indexs[$end]['Progress_bar_percentage'] = ($iphone_project_index[$end]['Project']['collected_percentage'] != "") ? $iphone_project_index[$end]['Project']['collected_percentage'] : 0.00;
            $iphone_project_indexs[$end]['Project_image_url'] = $image_url;
            $iphone_project_indexs[$end]['Days_to_go'] = $days_to_go;
            $iphone_project_indexs[$end]['Days_to_go_text'] = $text;
            $iphone_project_indexs[$end]['Project_description'] = $project_descrption;
            $iphone_project_indexs[$end]['Backers'] = $backer;
            $iphone_project_indexs[$end]['Backers_text'] = Configure::read('project.alt_name_for_backer_plural_caps');;
            $iphone_project_indexs[$end]['Project_big_thumb_image_url'] = $big_thumb_image_url;
            $iphone_project_indexs[$end]['Project_username'] = $iphone_project_index[$end]['User']['username'];
            $iphone_project_indexs[$end]['Project_big_thumb_image_url'] = $image_url;
            $iphone_project_indexs[$end] = array_merge($iphone_project_indexs[$end], $ProjectTypeStatus->data['data']);
            $iphone_project_indexs[$end]['Currency_symbol'] = Configure::read('site.currency');
            $follower = Cms::dispatchEvent('Controller.ProjectFollower.followerStatus', $obj, array(
                'data' => array(
                    'follow_text' => __l('Follow') ,
                    'follow_url' => ''
                ) ,
                'project_id' => $iphone_project_index[$end]['Project']['id']
            ));
            $iphone_project_indexs[$end] = array_merge($iphone_project_indexs[$end], $follower->data['data']);
            $percentage = 0;
            if ($iphone_project_index[$end]['Project']['collected_amount'] > 0) {
                $percentage = floatval($iphone_project_index[$end]['Project']['needed_amount']) /floatval($iphone_project_index[$end]['Project']['collected_amount']);
            }
            if ($percentage != 0) {
                $current_percentage = number_format($iphone_project_index[$end]['Project']['collected_percentage'], 2);
                $total_percentage = number_format(100-$current_percentage);
            } else {
                $current_percentage = 0;
                $total_percentage = 100;
            }
            $google_pie_chart_url = "http://chart.googleapis.com/chart?cht=p&amp;chd=t:" . floatval($current_percentage) . "," . floatval($total_percentage) . "&amp;chs=58x58&amp;chco=00AFEF|C1C1BA&amp;chf=bg,s,FF000000";
            $iphone_project_indexs[$end]['Project_pie_chart_url'] = $google_pie_chart_url;
            $iphone_project_indexs[$end]['Updates'] = $updates;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_indexs);
    }
    public function onProjectView($event) 
    {
        $obj = $event->subject();
        $project = $event->data['data']['project'];
        $backer = $event->data['data']['backer'];
        $image_options = array(
            'dimension' => 'iphone_big_thumb',
            'class' => '',
            'alt' => 'alt',
            'title' => 'title',
            'type' => 'jpg',
            'full_url' => true
        );
        $this->saveiPhoneAppThumb($project['Attachment']);
        $image_url = getImageUrl('Project', $project['Attachment'], $image_options);
        if (strtotime($project['Project']['project_end_date']) < strtotime(date('Y-m-d'))) {
            $month = date('F', strtotime($project['Project']['project_end_date']));
            $year = date('y', strtotime($project['Project']['project_end_date']));
            $days_to_go = $month . " " . $year;
            $text = __l('Funded');
        } else {
            $days_to_go = (strtotime($project['Project']['project_end_date']) -strtotime(date('Y-m-d'))) /(60*60*24);
            $text = __l('Days to go');
        }
        $iphone_project_view['Project_id'] = $project['Project']['id'];
        $iphone_project_view['Project_name'] = $project['Project']['name'];
        $iphone_project_view['Project_username'] = $project['User']['username'];
        $iphone_project_view['Backers'] = $backer;
        $iphone_project_view['Project_image_url'] = $image_url;
        $iphone_project_view['Days_to_go'] = $days_to_go;
        $iphone_project_view['Days to go text'] = $text;
        $iphone_project_view['Funding_amount'] = $project['Project']['collected_amount'];
        $iphone_project_view['Circle_graph_percentage'] = $project['Project']['collected_percentage'];
        $iphone_project_view['Needed_amount'] = $project['Project']['needed_amount'];
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_view);
    }
    public function onProjectFollow($event) 
    {
        $obj = $event->subject();
        $response = $event->data['data'];
        $obj->view = 'Json';
        $obj->set('json', $response);
    }
    public function onProjectUnfollow($event) 
    {
        $obj = $event->subject();
        $response = $event->data['data'];
        $obj->view = 'Json';
        $obj->set('json', $response);
    }
    public function onfollowerListing($event) 
    {
        $obj = $event->subject();
        $iphone_project_followers = $obj->paginate();
        $iphone_project_follower = array();
        for ($i = 0; $i < count($iphone_project_followers); $i++) {
            $month = date('F', strtotime($iphone_project_followers[$i]['ProjectFollower']['created']));
            $year = date('Y', strtotime($iphone_project_followers[$i]['ProjectFollower']['created']));
            $date = date('d', strtotime($iphone_project_followers[$i]['ProjectFollower']['created']));
            $created = $month . " " . $date;
            $image_options = array(
                'dimension' => 'iphone_big_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $this->saveiPhoneAppThumb($iphone_project_followers[$i]['User']['UserAvatar'], 'UserAvatar');
            if (!empty($iphone_project_followers[$i]['User']['UserAvatar'])) {
                $image_url = getImageUrl('UserAvatar', $iphone_project_followers[$i]['User']['UserAvatar'], $image_options);
            } else {
                $iphone_project_followers[$i]['User']['UserAvatar']['id'] = constant(sprintf('%s::%s', 'ConstAttachment', 'UserAvatar'));
                $image_url = getImageUrl('UserAvatar', $iphone_project_followers[$i]['User']['UserAvatar'], $image_options);
            }
            $iphone_project_follower[$i]['Follower_username'] = $iphone_project_followers[$i]['User']['username'];
            $iphone_project_follower[$i]['Follower_user_image'] = $image_url;
            $iphone_project_follower[$i]['Follower_created'] = $created;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_follower);
    }
    public function onBlogListing($event) 
    {
        $obj = $event->subject();
        $iphone_project_updates = $obj->paginate();
        $iphone_project_update = array();
        for ($i = 0; $i < count($iphone_project_updates); $i++) {
            $date = date('d', strtotime($iphone_project_updates[$i]['Blog']['created']));
            $month = date('F', strtotime($iphone_project_updates[$i]['Blog']['created']));
            $created = $month . " " . $date;
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $this->saveiPhoneAppThumb($iphone_project_updates[$i]['Project']['User']['UserAvatar'], 'UserAvatar');
            if (!empty($iphone_project_updates[$i]['Project']['User']['UserAvatar'])) {
                $image_url = getImageUrl('UserAvatar', $iphone_project_updates[$i]['Project']['User']['UserAvatar'], $image_options);
            } else {
                $iphone_project_updates[$i]['Project']['User']['UserAvatar']['id'] = constant(sprintf('%s::%s', 'ConstAttachment', 'UserAvatar'));
                $image_url = getImageUrl('UserAvatar', $iphone_project_updates[$i]['Project']['User']['UserAvatar'], $image_options);
            }
            $update_comments = array();
            $iphone_project_update_comments = $iphone_project_updates[$i]['BlogComment'];
            for ($j = 0; $j < count($iphone_project_update_comments); $j++) {
                $date = date('d', strtotime($iphone_project_update_comments[$j]['created']));
                $month = date('F', strtotime($iphone_project_update_comments[$j]['created']));
                $comment_created = $month . " " . $date;
                $update_comments[$j]['BlogComment_comment'] = $iphone_project_update_comments[$j]['comment'];
                $update_comments[$j]['BlogComment_created'] = $comment_created;
                $update_comments[$j]['BlogComment_username'] = $iphone_project_update_comments[$j]['User']['username'];
                $update_comments[$j]['Blogcomment_user_image'] = getImageUrl('UserAvatar', $iphone_project_update_comments[$j]['User']['UserAvatar'], $image_options);
            }
            $iphone_project_update[$i]['Update_id'] = $iphone_project_updates[$i]['Blog']['id'];
            $iphone_project_update[$i]['Update_title'] = $iphone_project_updates[$i]['Blog']['title'];
            $iphone_project_update[$i]['Update_description'] = $iphone_project_updates[$i]['Blog']['content'];
            $iphone_project_update[$i]['Update_slug'] = $iphone_project_updates[$i]['Blog']['slug'];
            $iphone_project_update[$i]['Comment_count'] = $iphone_project_updates[$i]['Blog']['blog_comment_count'];
            $iphone_project_update[$i]['Update_created'] = $created;
            $iphone_project_update[$i]['Update_username'] = $iphone_project_updates[$i]['Project']['User']['username'];
            $iphone_project_update[$i]['Update_user_image'] = $image_url;
            $iphone_project_update[$i]['UpdateComments'] = $update_comments;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_update);
    }
    public function onBlogCommentListing($event) 
    {
        $obj = $event->subject();
        $iphone_blog_comments = $obj->paginate();
        $iphone_blog_comment = array();
        for ($i = 0; $i < count($iphone_blog_comments); $i++) {
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $this->saveiPhoneAppThumb($iphone_blog_comments[$i]['User']['UserAvatar'], 'UserAvatar');
            $image_url = getImageUrl('UserAvatar', $iphone_blog_comments[$i]['User']['UserAvatar'], $image_options);
            $date = date('d', strtotime($iphone_blog_comments[$i]['BlogComment']['created']));
            $month = date('F', strtotime($iphone_blog_comments[$i]['BlogComment']['created']));
            $comment_created = $month . " " . $date;
            $iphone_blog_comment[$i]['BlogComment_id'] = $iphone_blog_comments[$i]['BlogComment']['id'];
            $iphone_blog_comment[$i]['BlogComment_blog_id'] = $iphone_blog_comments[$i]['BlogComment']['blog_id'];
            $iphone_blog_comment[$i]['BlogComment_created'] = $comment_created;
            $iphone_blog_comment[$i]['BlogComment_comment'] = $iphone_blog_comments[$i]['BlogComment']['comment'];
            $iphone_blog_comment[$i]['Blog_title'] = $iphone_blog_comments[$i]['Blog']['title'];
            $iphone_blog_comment[$i]['Blog_slug'] = $iphone_blog_comments[$i]['Blog']['slug'];
            $iphone_blog_comment[$i]['Blog_title'] = $iphone_blog_comments[$i]['Blog']['title'];
            $iphone_blog_comment[$i]['Blog_project_id'] = $iphone_blog_comments[$i]['Blog']['project_id'];
            $iphone_blog_comment[$i]['User_username'] = $iphone_blog_comments[$i]['User']['username'];
            $iphone_blog_comment[$i]['User_id'] = $iphone_blog_comments[$i]['User']['id'];
            $iphone_blog_comment[$i]['Blogcomment_user_image'] = $image_url;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_blog_comment);
    }
    public function validate_user($event) 
    {
        $obj = $event->subject();
        if ((Configure::read('user.using_to_login') == 'email') && isset($obj->request->data['User']['username'])) {
            $obj->request->data['User']['email'] = $obj->request->data['User']['username'];
            unset($obj->request->data['User']['username']);
        }
        $obj->request->data['User'][Configure::read('user.using_to_login') ] = trim($obj->request->data['User'][Configure::read('user.using_to_login') ]);
        if (!empty($obj->request->data['User'][Configure::read('user.using_to_login') ])) {
            $user = $obj->User->find('first', array(
                'conditions' => array(
                    'User.username' => $obj->request->data['User'][Configure::read('user.using_to_login') ]
                ) ,
                'recursive' => -1
            ));
            $obj->request->data['User']['password'] = crypt($obj->request->data['User']['password'], $user['User']['password']);
        }
        if ($obj->Auth->login()) {
            $mobile_app_hash = md5($obj->_unum() . $obj->request->data['User'][Configure::read('user.using_to_login') ] . $obj->request->data['User']['password'] . Configure::read('Security.salt'));
            $obj->User->updateAll(array(
                'User.mobile_app_hash' => '\'' . $mobile_app_hash . '\'',
                'User.mobile_app_time_modified' => '\'' . date('Y-m-d h:i:s') . '\'',
            ) , array(
                'User.id' => $obj->Auth->user('id')
            ));
            if (!empty($obj->request->data['User']['devicetoken'])) {
                $obj->User->ApnsDevice->findOrSave_apns_device($obj->Auth->user('id') , $obj->request->data['User']);
            }
            if (!empty($_GET['latitude']) && !empty($_GET['longtitude'])) {
                $this->update_iphone_user($_GET['latitude'], $_GET['longtitude'], $obj->Auth->user('id'));
            }
            $resonse = array(
                'status' => 0,
                'message' => __l('Success') ,
                'hash_token' => $mobile_app_hash,
                'username' => $obj->request->data['User'][Configure::read('user.using_to_login') ]
            );
        } else {
            $resonse = array(
                'status' => 1,
                'message' => sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login'))
            );
        }
        if ($obj->RequestHandler->prefers('json')) {
            $obj->view = 'Json';
            $obj->set('json', (empty($obj->viewVars['iphone_response'])) ? $resonse : $obj->viewVars['iphone_response']);
        }
    }
    public function onProjectFundsListing($event) 
    {
        $obj = $event->subject();
        $iphone_project_backers = $obj->paginate();
        $iphone_project_backer = array();
        for ($i = 0; $i < count($iphone_project_backers); $i++) {
            $month = date('F', strtotime($iphone_project_backers[$i]['ProjectFund']['created']));
            $year = date('Y', strtotime($iphone_project_backers[$i]['ProjectFund']['created']));
            $date = date('d', strtotime($iphone_project_backers[$i]['ProjectFund']['created']));
            $created = $month . " " . $date . " " . $year;
            $other_count = $iphone_project_backers[$i]['User']['unique_project_fund_count']-1;
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            if (empty($iphone_project_backers[$i]['ProjectFund']['is_anonymous']) || $iphone_project_backers[$i]['User']['id'] == $obj->Auth->user('id') || (!empty($iphone_project_backers[$i]['ProjectFund']['is_anonymous']) && $iphone_project_backers[$i]['ProjectFund']['is_anonymous'] == ConstAnonymous::FundedAmount)) {
                $backer_name = $iphone_project_backers[$i]['User']['username'];
                if (!empty($iphone_project_backers[$i]['User']['UserAvatar'])) {
                    $image_url = getImageUrl('UserAvatar', $iphone_project_backers[$i]['User']['UserAvatar'], $image_options);
                } else {
                    $iphone_project_backers[$i]['User']['UserAvatar']['id'] = constant(sprintf('%s::%s', 'ConstAttachment', 'UserAvatar'));
                    $image_url = getImageUrl('UserAvatar', $iphone_project_backers[$i]['User']['UserAvatar'], $image_options);
                }
            } else {
                $backer_name = __l('Anonymous');
                $iphone_project_backers[$i]['User']['UserAvatar']['id'] = constant(sprintf('%s::%s', 'ConstAttachment', 'Anonymous'));
                $image_url = getImageUrl('UserAvatar', $iphone_project_backers[$i]['User']['UserAvatar'], $image_options);
            }
            if (empty($iphone_project_backers[$i]['ProjectFund']['is_anonymous']) || $iphone_project_backers[$i]['User']['id'] == $obj->Auth->user('id') || (!empty($iphone_project_backers[$i]['ProjectFund']['is_anonymous']) && $iphone_project_backers[$i]['ProjectFund']['is_anonymous'] == ConstAnonymous::Username)) {
                $backer_amount = $iphone_project_backers[$i]['ProjectFund']['amount'];
            } else {
                $backer_amount = '';
            }
            $this->saveiPhoneAppThumb($iphone_project_backers[$i]['User']['UserAvatar'], 'UserAvatar');
            $iphone_project_backer[$i]['Backer_username'] = $backer_name;
            $iphone_project_backer[$i]['Backer_amount'] = $backer_amount;
            $iphone_project_backer[$i]['Backer_user_image'] = $image_url;
            $iphone_project_backer[$i]['Backer_created'] = $created;
            if (!empty($iphone_project_backers[$i]['ProjectReward']['reward'])) {
                $iphone_project_backer[$i]['Backer_reward'] = $iphone_project_backers[$i]['ProjectReward']['reward'];
            } else {
                $iphone_project_backer[$i]['Backer_reward'] = __l('No reward');
            }
            $iphone_project_backer[$i]['Other_projects'] = $other_count;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_backer);
    }
    public function onProjectRatingListing($event) 
    {
        $obj = $event->subject();
        $iphone_project_voters = $obj->paginate();
        for ($i = 0; $i < count($iphone_project_voters); $i++) {
            $month = date('F', strtotime($iphone_project_voters[$i]['ProjectRating']['created']));
            $year = date('Y', strtotime($iphone_project_voters[$i]['ProjectRating']['created']));
            $date = date('d', strtotime($iphone_project_voters[$i]['ProjectRating']['created']));
            $created = $month . " " . $date;
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            $this->saveiPhoneAppThumb($iphone_project_voters[$i]['User']['UserAvatar'], 'UserAvatar');
            $image_url = getImageUrl('UserAvatar', $iphone_project_voters[$i]['User']['UserAvatar'], $image_options);
            $iphone_project_voter[$i]['Voters username'] = $iphone_project_voters[$i]['User']['username'];
            $iphone_project_voter[$i]['Voters user image'] = $image_url;
            $iphone_project_voter[$i]['Vote created'] = $created;
            $iphone_project_voter[$i]['Vote count'] = $iphone_project_voters[$i]['ProjectRating']['rating'];
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_voter);
    }
    public function onProjectCommentListing($event) 
    {
        $obj = $event->subject();
        $iphone_project_comments = $obj->paginate();
        $iphone_project_comment = array();
        for ($i = 0; $i < count($iphone_project_comments); $i++) {
            $image_options = array(
                'dimension' => 'iphone_small_thumb',
                'class' => '',
                'alt' => 'alt',
                'title' => 'title',
                'type' => 'jpg',
                'full_url' => true
            );
            if (!empty($iphone_project_comments[$i]['OtherUser']['UserAvatar'])) {
                $image_url = getImageUrl('UserAvatar', $iphone_project_comments[$i]['OtherUser']['UserAvatar'], $image_options);
            } else {
                $iphone_project_comments[$i]['OtherUser']['UserAvatar']['id'] = constant(sprintf('%s::%s', 'ConstAttachment', 'UserAvatar'));
                $image_url = getImageUrl('UserAvatar', $iphone_project_comments[$i]['OtherUser']['UserAvatar'], $image_options);
            }
            if ($iphone_project_comments[$i]['Message']['is_private'] && (!$obj->Auth->user('id') || ($obj->Auth->user('id') != $iphone_project_comments[$i]['Message']['user_id'] && $obj->Auth->user('id') != $iphone_project_comments[$i]['Message']['other_user_id']))) {
                $message_content = '[' . __l('Private Message') . ']';
            } else {
                $message_content = $iphone_project_comments[$i]['MessageContent']['message'];
            }
            $this->saveiPhoneAppThumb($iphone_project_comments[$i]['OtherUser']['UserAvatar'], 'UserAvatar');
            $date = date('d', strtotime($iphone_project_comments[$i]['Message']['created']));
            $month = date('F', strtotime($iphone_project_comments[$i]['Message']['created']));
            $comment_created = $month . " " . $date;
            $iphone_project_comment[$i]['Comment_created'] = $comment_created;
            $iphone_project_comment[$i]['Comment'] = $message_content;
            $iphone_project_comment[$i]['Blogcomment_title'] = $iphone_project_comments[$i]['Project']['name'];
            $iphone_project_comment[$i]['Comment_username'] = $iphone_project_comments[$i]['OtherUser']['username'];
            $iphone_project_comment[$i]['Comment_user_image'] = $image_url;
        }
        $obj->view = 'Json';
        $obj->set('json', $iphone_project_comment);
    }
    public function saveiPhoneAppThumb($attachments, $model = 'Project') 
    {
        $options[] = array(
            'dimension' => 'iphone_big_thumb',
            'class' => '',
            'alt' => '',
            'title' => '',
            'type' => 'jpg',
            'full_url' => true
        );
        $options[] = array(
            'dimension' => 'iphone_small_thumb',
            'class' => '',
            'alt' => '',
            'title' => '',
            'type' => 'jpg',
            'full_url' => true
        );
        $attachment = $attachments;
        foreach($options as $option) {
            if (!empty($attachment['id'])) {
                $destination = APP . 'webroot' . DS . 'img' . DS . $option['dimension'] . DS . $model . DS . $attachment['id'] . '.' . md5(Configure::read('Security.salt') . $model . $attachment['id'] . $option['type'] . $option['dimension'] . Configure::read('site.name')) . '.' . $option['type'];
                if (!file_exists($destination) && !empty($attachment['id'])) {
                    $url = getImageUrl($model, $attachment, $option);
                    getimagesize($url);
                }
            }
        }
    }
}
?>