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
class SuccessStoriesController extends AppController
{
    public $name = 'SuccessStories';
    public $permanentCacheAction = array(
        'user' => array(
            'index',
        )
    );
    public function beforeFilter() 
    {
        $this->Security->validatePost = false;
        parent::beforeFilter();
    }
	public function index() 
    {
		$this->disableCache();
		$this->pageTitle = __l('Success Stories');
		$success_stories = $this->SuccessStory->find('all',array(
									'contain' => array(
											'Project' => array('State','Country'),
											'Attachment',		
									),
									'conditions' => array(
											'SuccessStory.is_active' => 1,
									),
									'recursive' => 3,
							));
        //echo '<pre>'; print_r($success_stories); exit;							
		$this->set('success_stories', $success_stories);					
    }
    public function admin_index() 
    {
		$this->pageTitle = __l('Success Stories');
		$success_stories = $this->SuccessStory->find('all',array(
									'contain' => array(
											'Project' => array('Attachment'),
											'Attachment',		
									),
									'recursive' => 2,
							));
		$this->set('activated', $this->SuccessStory->find('count', array(
            'conditions' => array(
                'SuccessStory.is_active = ' => 1
            )
        )));
		$this->set('deactivated', $this->SuccessStory->find('count', array(
            'conditions' => array(
                'SuccessStory.is_active = ' => 0
            )
        )));
        $this->set('success_stories', $success_stories);
    }

	public function admin_add(){
		
		if($this->request->is('post')){
			$this->SuccessStory->create($this->request->data);
			if($this->SuccessStory->save($this->request->data)){
				   //Save Success Story Attachment
				   $success_story_id = $this->SuccessStory->getLastInsertId();
                    $this->loadModel('Attachment');
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
								$this->Attachment->Behaviors->attach('ImageUpload');
								$this->Attachment->set($this->request->data);
					}
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
					$image_info = getimagesize($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Attachment->create();
					$this->request->data['Attachment']['class'] = 'SuccessStory';
					$this->request->data['Attachment']['foreign_id'] = $success_story_id;
					$this->Attachment->save($this->request->data['Attachment']);
					// Update attachment id
					$attachment_id = $this->Attachment->getLastInsertId();
					$this->SuccessStory->id = $success_story_id;
					$this->SuccessStory->saveField('attachment_id',$attachment_id);
				    }
				$this->Session->setFlash(__l('Story Added Successfully') , 'default', null, 'success');
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__l('Story Added Failed') , 'default', null, 'success');
			}
		}
		$this->loadModel('Project');
		$projects = $this->Project->find('list',array('conditions' => array('is_successful' => '0')));
		$this->set('projects',$projects);
	}
	
	public function admin_edit($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$this->SuccessStory->id = $id;
        $this->loadModel('Attachment');
		if($this->request->is('post') || $this->request->is('put')){
			if($this->SuccessStory->save($this->request->data)){
				  //Save Success Story Attachment
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
								$this->Attachment->Behaviors->attach('ImageUpload');
								$this->Attachment->set($this->request->data);
					}
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
					$conditions = array('Attachment.foreign_id' => $id);
					$this->Attachment->deleteAll($conditions);
					$image_info = getimagesize($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Attachment->create();
					$this->request->data['Attachment']['class'] = 'SuccessStory';
					$this->request->data['Attachment']['foreign_id'] = $id;
					$this->Attachment->save($this->request->data[Attachment]);
					// Update attachment id
					$attachment_id = $this->Attachment->getLastInsertId();
					$this->SuccessStory->saveField('attachment_id',$attachment_id);
					}
					$this->Session->setFlash(__l('Story Edited Successfully') , 'default', null, 'success');
				    $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__l('Story Edited Failed') , 'default', null, 'success');
			}
	    }
		if(!empty($id)){
			$attachment_data = $this->Attachment->find('first', array(
                    'conditions' => array(
                        'Attachment.foreign_id' => $id,
                        'Attachment.class' => 'SuccessStory',
                    )
			));
		    $this->set('attachment_data',$attachment_data);
		}
		$this->request->data = $this->SuccessStory->read();
		$this->loadModel('Project');
		$projects = $this->Project->find('list',array('conditions' => array('is_successful' => '0')));
		$this->set('projects',$projects);
	
    }
	public function admin_delete($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if($this->SuccessStory->delete($id)){
			$this->Session->setFlash(__l('Story Deleted Successfully') , 'default', null, 'success');
			$this->redirect(array(
			        'action' => 'index'
			));
			
		}
	}
	public function admin_update_status($id = null, $status = null) 
    {
        if (is_null($id) || is_null($status)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->request->data['SuccessStory']['id'] = $id;
        if ($status == 'disapprove') {
            $this->request->data['SuccessStory']['is_active'] = 0;
            $this->Session->setFlash(__l('Selected record has been disapproved') , 'default', null, 'success');
        }
        if ($status == 'approve') {
            $this->request->data['SuccessStory']['is_active'] = 1;
            $this->Session->setFlash(__l('Selected record has been approved') , 'default', null, 'success');
        }
        $this->SuccessStory->save($this->request->data);
        $this->redirect(array(
                'action' => 'index'
        ));
    
    }
}
?>