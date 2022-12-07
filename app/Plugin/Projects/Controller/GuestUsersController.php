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
class GuestUsersController extends AppController
{
    public $name = 'GuestUsers';	
	public function admin_view($id = null)
    {
		//exit('1223');
        $this->pageTitle = __l('Guest User Details');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
		}
		if(!empty($id)) {
		$this->loadModel('ProjectFund');
		$data = $this->GuestUser->find('first', array('conditions'=>array('id'=>$id)));
		$this->set('data', $data);
		/*
		$project_details = $this->ProjectFund->find('first', 
														array('conditions'=>array('ProjectFund.guest_user_id'=>$id)
															  ,'contain'=>array('Project'),'recursive' => 1)
													);
		if(!empty($project_details)) {
		$this->set('project_details', $project_details);}*/
		}
	}
}
?>