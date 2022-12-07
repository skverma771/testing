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
require __DIR__.'/../Vendor/autoload.php';

use Kreait\Firebase\Factory;

class UserProfilesController extends AppController
{
    public $name = 'UserProfiles';
    public $uses = array(
        'UserProfile',
        'Attachment',
        'EmailTemplate'
    );
    public $components = array(
        'Email'
    );
    public $permanentCacheAction = array(
        'admin' => array(
            'edit',
        )
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'UserAvatar.filename',
            'City.id',
            'State.id',
            'UserProfile.country_id',
            'User.latitude',
            'User.longitude',
            'State.name',
            'City.name',
            'UserWebsite',
            's3_file_url'
        );
        parent::beforeFilter();
    }
    function createNotification($name = '')
    {
        $factory = (new Factory)
            ->withDatabaseUri('https://buskerdues-1b4cc-default-rtdb.firebaseio.com')
            ->withServiceAccount('/home/buskerdues/buskerdues.com/app/webroot/buskerdues-1b4cc-firebase-adminsdk-j35k1-0ac3c36081.json');

        $firebase = $factory->createDatabase();
        $ref = $firebase->getReference('new_user')->getSnapshot();

        if($ref->exists()) {
            $firebase->getReference('new_user/username')->set($name);
        }
        
        return true;
    }
    public function edit($user_id = null)
    {
        $this->pageTitle = sprintf(__l('Edit %s') , __l('Profile'));
        $this->UserProfile->User->UserAvatar->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
            unset($this->UserProfile->validate['country_id']);
            unset($this->UserProfile->City->validate['name']);
            unset($this->UserProfile->State->validate['name']);
            unset($this->UserProfile->validate['gender_id']);
            unset($this->UserProfile->validate['dob']);
        }

        $myself = false;
        if (!empty($this->request->data)) {
            if (empty($this->request->data['User']['id'])) {
                $myself = true;
                $this->request->data['User']['id'] = $this->Auth->user('id');
            }

            // create notification
            if (!$myself) {
                App::import('Model', 'User');
                $userActive = $this->User->findById($this->request->data['User']['id']);
                if ($userActive['User']['is_active'] == 0 && $this->request->data['User']['is_active'] == 1) {
                    $this->createNotification($userActive['User']['username']);
                }
            }

            $user = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->data['User']['id']
                ) ,
                'contain' => array(
                    'UserProfile',
                    'UserAvatar',
                    'UserWebsite'
                ) ,
                'recursive' => 0
            ));
            if (!empty($user)) {
                $this->request->data['UserProfile']['id'] = $user['UserProfile']['id'];
                if (!empty($user['UserAvatar']['id'])) {
                    $this->request->data['UserAvatar']['id'] = $user['UserAvatar']['id'];
                }
            }
            $this->request->data['UserProfile']['user_id'] = $this->request->data['User']['id'];

            if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                $this->request->data['UserAvatar']['filename']['type'] = get_mime($this->request->data['UserAvatar']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['UserAvatar']['filename']['name']) || (!Configure::read('avatar.file.allowEmpty') && empty($this->request->data['UserAvatar']['id']))) {
                $this->UserProfile->User->UserAvatar->set($this->request->data);
            }
            // validating UserWebsite data
            $is_website_valid = true;
            $this->UserProfile->User->UserWebsite->deleteAll(array(
                'UserWebsite.user_id' => $this->request->data['User']['id']
            ));
            foreach($this->request->data['UserWebsite'] as $key => $userWebsite) {
                $data['UserWebsite']['website'] = $userWebsite['website'];
                $this->UserProfile->User->UserWebsite->set($data);
                if (!$this->UserProfile->User->UserWebsite->validates()) {
                    $UserWebsiteValidationError[$key] = $this->UserProfile->User->UserWebsite->validationErrors;
                    $is_website_valid = false;
                    $this->Session->setFlash(sprintf(__l('%s could not be added. Please, try again.') , __l('User Website')) , 'default', null, 'error');
                }
            }
            $this->UserProfile->User->UserWebsite->validationErrors = array();
            if (!empty($UserWebsiteValidationError)) {
                foreach($UserWebsiteValidationError as $key => $error) {
                    $this->UserProfile->User->UserWebsite->validationErrors[$key] = $error;
                }
            }
            $this->UserProfile->set($this->request->data);
            $this->UserProfile->User->set($this->request->data);
            if (empty($this->request->data['UserProfile']['country_id'])) {
                unset($this->UserProfile->validate['country_id']);
            }
            if (!empty($this->request->data['UserProfile']['country_id'])) {
                $this->request->data['UserProfile']['Country']['iso_alpha2'] = $this->request->data['UserProfile']['country_id'];
            }
            if (!empty($this->request->data['State']['name'])) {
                $this->UserProfile->State->set($this->request->data);
            }
            if (!empty($this->request->data['City']['name'])) {
                $this->UserProfile->City->set($this->request->data);
            }
            $ini_upload_error = 1;
            if ((!empty($this->request->data['UserAvatar']['filename']) && $this->request->data['UserAvatar']['filename']['error'] == 1)) {
                $ini_upload_error = 0;
            }
            if ($this->UserProfile->User->validates() &$this->UserProfile->validates() &$this->UserProfile->User->UserAvatar->validates() &$this->UserProfile->City->validates() &$this->UserProfile->State->validates() && $ini_upload_error && $is_website_valid) {                
                if (!empty($this->request->data['UserProfile']['country_id'])) {
                    $this->request->data['UserProfile']['country_id'] = $this->UserProfile->Country->findCountryId($this->request->data['UserProfile']['country_id']);
                }
                $this->request->data['State']['country_id'] = $this->request->data['UserProfile']['country_id'];
                $state_id = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->UserProfile->State->findOrSaveAndGetIdWithArray($this->request->data['State']['name'], $this->request->data['State']);
                $this->request->data['UserProfile']['state_id'] = !empty($state_id) ? $state_id : 0;
                $this->request->data['City']['state_id'] = $this->request->data['UserProfile']['state_id'];
                $this->request->data['City']['country_id'] = $this->request->data['UserProfile']['country_id'];
                $city_id = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->UserProfile->City->findOrSaveAndGetIdWithArray($this->request->data['City']['name'], $this->request->data['City']);
                $this->request->data['UserProfile']['city_id'] = !empty($city_id) ? $city_id : 0;
                if ($this->UserProfile->save($this->request->data)) {
                    $this->UserProfile->User->save($this->request->data['User']);
                    Cms::dispatchEvent('Controller.Users.redirectToJobAct', $this, array(
                        'data' => $this->request->data
                    ));
                    $this->UserProfile->User->UserWebsite->deleteAll(array(
                        'UserWebsite.user_id' => $this->request->data['User']['id']
                    ));
                    if (!empty($this->request->data['UserWebsite'])) {
                        foreach($this->request->data['UserWebsite'] as $userWebsite) {
                            if (!empty($userWebsite['website'])) {
                                $data['UserWebsite']['user_id'] = $this->request->data['User']['id'];
                                $data['UserWebsite']['website'] = $userWebsite['website'];
                                $this->UserProfile->User->UserWebsite->create();
                                $this->UserProfile->User->UserWebsite->save($data);
                            }
                        }
                    }

                    if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                        $this->Attachment->create();
                        $this->request->data['UserAvatar']['class'] = 'UserAvatar';
                        $this->request->data['UserAvatar']['foreign_id'] = $this->request->data['User']['id'];
                        $this->Attachment->save($this->request->data['UserAvatar']);
                    }
                }
                if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
                    // Send mail to user to activate the account and send account details
                    $emailFindReplace = array(
                        '##USERNAME##' => $user['User']['username'],
					);
                    App::import('Model', 'EmailTemplate');
                    $this->EmailTemplate = new EmailTemplate();
                    $template = $this->EmailTemplate->selectTemplate('Admin User Edit');
                    $this->UserProfile->_sendEmail($template, $emailFindReplace, $user['User']['email']);
                }
                Cms::dispatchEvent('Controller.IntegratedGoogleAnalytics.trackEvent', $this, array(
                    '_trackEvent' => array(
                        'category' => 'UserProfile',
                        'action' => 'Updated',
                        'label' => $this->Auth->user('username') ,
                        'value' => '',
                    ) ,
                    '_setCustomVar' => array(
                        'ud' => $this->Auth->user('id') ,
                        'rud' => $this->Auth->user('referred_by_user_id') ,
                    )
                ));
                $this->Session->setFlash(sprintf(__l('%s has been updated sss') , __l('User Profile')) , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'user_profiles',
                    'action' => 'edit',
                    $this->request->data['User']['id']
                ));
            } else {
                if (!empty($this->request->data['UserAvatar']['filename']) && $this->request->data['UserAvatar']['filename']['error'] == 1) {
                    $this->UserProfile->User->UserAvatar->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , __l('User Profile')) , 'default', null, 'error');
            }
            $user = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->data['User']['id']
                ) ,
                'contain' => array(
                    'UserProfile' => array(
                        'fields' => array(
                            'UserProfile.id'
                        )
                    ) ,
                    'UserAvatar'
                ) ,
                'recursive' => 0
            ));
            if (!empty($user['User'])) {
                unset($user['UserProfile']);
                $this->request->data['User'] = array_merge($user['User'], $this->request->data['User']);
                $this->request->data['UserAvatar'] = $user['UserAvatar'];
            }
        } else {
            if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
                $user_id = $this->Auth->user('id');
            } else {
                $user_id = $user_id ? $user_id : $this->Auth->user('id');
            }
            $this->request->data = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id
                ) ,
                'contain' => array(
                    'UserAvatar',
                    'UserWebsite' => array(
                        'fields' => array(
                            'UserWebsite.id',
                            'UserWebsite.website'
                        )
                    ) ,
                    'UserProfile' => array(
                        'City' => array(
                            'fields' => array(
                                'City.name'
                            )
                        ) ,
                        'State' => array(
                            'fields' => array(
                                'State.name'
                            )
                        ) ,
                        'Country' => array(
                            'fields' => array(
                                'Country.iso_alpha2'
                            )
                        ) ,
                    )
                ) ,
                'recursive' => 2
            ));
            if (!empty($this->request->data['UserProfile']['City'])) {
                $this->request->data['City']['name'] = $this->request->data['UserProfile']['City']['name'];
            }
            if (!empty($this->request->data['UserProfile']['State']['name'])) {
                $this->request->data['State']['name'] = $this->request->data['UserProfile']['State']['name'];
            }
            if (isPluginEnabled('SecurityQuestions')) {
                $this->loadModel('SecurityQuestions.SecurityQuestion');
                $securityQuestions = $this->SecurityQuestion->find('list', array(
                    'conditions' => array(
                        'SecurityQuestion.is_active' => 1
                    )
                ));
                $this->set(compact('securityQuestions'));
            }
        }

        $this->pageTitle.= ' - ' . $this->request->data['User']['username'];
        $genders = $this->UserProfile->genderOptions;
        $countries = $this->UserProfile->Country->find('list', array(
            'fields' => array(
                'Country.iso_alpha2',
                'Country.name'
            ) ,
            'order' => array(
                'Country.name' => 'ASC'
            )
        ));
        $translantions = array();
        $translantions = $this->UserProfile->Language->Translation->find('all', array(
            'fields' => array(
                'DISTINCT Translation.language_id',
            ) ,
            'recursive' => -1,
        ));
        $translantion_id = array();
        foreach($translantions as $translantion) {
            $translantion_id[] = $translantion['Translation']['language_id'];
        }
        $languages = $this->UserProfile->Language->find('list', array(
            'conditions' => array(
                'Language.is_active' => 1,
                'Language.id' => $translantion_id,
            )
        ));
        $this->set(compact('genders', 'countries', 'languages'));
    }
    public function profile_image($user_id = null)
    {
		if (!isPluginEnabled('SocialMarketing')) {
			throw new NotFoundException(__l('Invalid request'));
		}
        $this->pageTitle = sprintf(__l('%s Image') , __l('Profile'));
        $this->UserProfile->User->UserAvatar->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
            if (empty($this->request->data['User']['id'])) {
                $this->request->data['User']['id'] = $this->Auth->user('id');
            }
            $user = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->data['User']['id']
                ) ,
                'contain' => array(
                    'UserAvatar'
                ) ,
                'recursive' => 0
            ));
            if (!empty($user)) {
                if (!empty($user['UserAvatar']['id'])) {
                    $this->request->data['UserAvatar']['id'] = $user['UserAvatar']['id'];
                }
            }
            if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                $fileName = $this->request->data['UserAvatar']['filename']['name'];
                $filePath = $this->request->data['UserAvatar']['filename']['tmp_name'];
                $tmpName = get_mime($filePath);
                $exif = exif_read_data($filePath);

                $this->request->data['UserAvatar']['filename']['type'] = $tmpName;

                if (!empty($exif['Orientation'])) {
                    if (strpos($tmpName, 'jpeg') !== false) {
                        // echo "jpeg <br>";
                        $imageResource = @imagecreatefromjpeg($filePath);
                    } else if (strpos($tmpName, 'png') !== false) {
                        // echo "png <br>";
                        $imageResource = @imagecreatefrompng($filePath);
                    }

                    if (isset($imageResource)) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $image = imagerotate($imageResource, 180, 0);
                            break;

                            case 6:
                                $image = imagerotate($imageResource, -90, 0);
                            break;

                            case 8:
                                $image = imagerotate($imageResource, 90, 0);
                            break;

                            default:
                                $image = $imageResource;
                            break;
                        }
                        // exit( "Orientation: ".$exif['Orientation']." - Type: " . $tmpName );

                        if (strpos($tmpName, 'jpeg') !== false) {
                            imagejpeg($image, $filePath, 90);
                        } else if (strpos($tmpName, 'png') !== false) {
                            imagepng($image, $filePath, 90);
                        }

                        imagedestroy($imageResource);
                        imagedestroy($image);
                    }
                }
                // $this->request->data['UserAvatar']['filename']['type'] = get_mime($this->request->data['UserAvatar']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['UserAvatar']['filename']['name']) || !empty($this->request->data['s3_file_url']) || (!Configure::read('avatar.file.allowEmpty') && empty($this->request->data['UserAvatar']['id']))) {
                $this->UserProfile->User->UserAvatar->set($this->request->data);
            }
            $this->UserProfile->User->set($this->request->data);
            $ini_upload_error = 1;
            if ($this->request->data['UserAvatar']['filename']['error'] == 1 && empty($this->request->data['s3_file_url'])) {
                $ini_upload_error = 0;
            }
            if ($this->UserProfile->User->validates() && $this->UserProfile->User->UserAvatar->validates() && $ini_upload_error) {
                $this->UserProfile->User->save($this->request->data['User']);
                if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                    $this->Attachment->create();
                    $this->request->data['UserAvatar']['class'] = 'UserAvatar';
                    $this->request->data['UserAvatar']['foreign_id'] = $this->request->data['User']['id'];
                    $this->Attachment->save($this->request->data['UserAvatar']);
                }
                $this->Session->setFlash(sprintf(__l('%s has been updated') , __l('Profile Image')) , 'default', null, 'success');
                $this->redirect(array(
                    'controller' => 'user_profiles',
                    'action' => 'profile_image',
                    $this->request->data['User']['id']
                ));
            } else {
                if ($this->request->data['UserAvatar']['filename']['error'] == 1) {
                    $this->UserProfile->User->UserAvatar->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , __l('Profile Image')) , 'default', null, 'error');
            }
            $user = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->data['User']['id']
                ) ,
                'contain' => array(
                    'UserProfile' => array(
                        'fields' => array(
                            'UserProfile.id'
                        )
                    ) ,
                    'UserAvatar'
                ) ,
                'recursive' => 0
            ));
            if (!empty($user['User'])) {
                unset($user['UserProfile']);
                $this->request->data['User'] = array_merge($user['User'], $this->request->data['User']);
                $this->request->data['UserAvatar'] = $user['UserAvatar'];
            }
        } else {
            if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
                $user_id = $this->Auth->user('id');
            } else {
                $user_id = $user_id ? $user_id : $this->Auth->user('id');
            }
            $this->request->data = $this->UserProfile->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id
                ) ,
                'contain' => array(
                    'UserAvatar'
                ) ,
                'recursive' => 0
            ));
        }
        $this->pageTitle.= ' - ' . $this->request->data['User']['username'];
    }
    public function admin_edit($id = null)
    {
        if (is_null($id) && empty($this->request->data)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->setAction('edit', $id);
    }
}
?>