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
App::uses('InstallAppModel', 'Install.Model');
class Install extends InstallAppModel
{
    public $name = 'Install';
    public $useTable = false;
    /** Finalize installation
     *  Prepares Config/settings.yml and update password for admin user
     *  @return $mixed if false, indicates processing failure
     */
    public function finalize()
    {
        if (Configure::read('Install.installed') && Configure::read('Install.secured')) {
            return false;
        }
        App::import('Model', 'Setting');
        $this->Setting = new Setting();
        $this->Setting->updateYaml();
        App::import('Model', 'User');
        $this->User = new User();
        $_data['User']['id'] = 1;
        $_data['User']['password'] = getCryptHash('agriya');
        $this->User->save($_data, false);
    }
}
