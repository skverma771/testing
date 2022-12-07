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
class MontagesController extends AppController
{
    public $name = 'Montages';
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
	public $paginate = [
        'fields' => ['Montage.id'],
        'limit' => 15,
        'order' => [
            'Montage.title' => 'asc'
        ]
    ];	
	public function index() 
    {	
		$this->pageTitle = __l('Montages'); 
		
						
		if(!empty($this->request->params['named']['id'])) 
		{
			if($this->request->params['named']['id']==5555)
			{
				$conditions = array("User.created >" => date('Y-m-d', strtotime("-30 days"))); 
				App::import('Model', 'User');
				$this->User = new User();
				App::import('Model', 'Projects.Project');
				$this->Project = new Project();
				$user_lists = $user = $this->User->find('list', array(
					'conditions' =>$conditions,
						'fields' => array(
								'User.id',
							) ,
		
							'recursive' => -1
						));
				$project_conditions['Project.user_id']= $user_lists;	
				//$this->log($project_conditions);

				$project_lists = $this->Project->find('list', array(
					'conditions' =>$project_conditions,
						'fields' => array(
								'Project.id',
							) ,
							'recursive' => -1
						));		
						$montage_conditions['AND']['Montage.project_id'] = $project_lists;	
						$montage_conditions['AND']['Montage.is_active'] = 1;	
						$this->paginate = array(
							'conditions' => $montage_conditions,
							'contain' => array('Project','Attachment','Pledge'),
							'order' => array('Montage.title'=>'asc'),
							'recursive' => 0,
							'limit' => 15,
						);
			}else{
				$this->paginate = array(
					'conditions' => array('AND'=>array('Pledge.pledge_project_category_id'=>$this->request->params['named']['id'],'Montage.is_active'=>1)),
					'contain' => array('Project','Attachment','Pledge'),
					'order' => array('Montage.title'=>'asc'),
					'recursive' => 0,
					'limit' => 15,
				);		
			}	
		$this->set('category_id', $this->request->params['named']['id']);
		//echo "<pre>"; print_r($this->paginate()); exit;
		}
		else if(empty($this->request->params['named']['category'])) {
		$this->paginate = array(
                'conditions' => array('Montage.is_active' => 1),
                'contain' => array('Project','Attachment'),
                'order' => array('Montage.title'=>'asc'),
                'recursive' => 0,
                'limit' => 15,
            );
		}
		$this->loadModel('PledgeProjectCategory');
//		$project_category = $this->PledgeProjectCategory->find('all');
		$project_category = $this->PledgeProjectCategory->find('all',
	            array(
	                    'order' => array(
		                        'PledgeProjectCategory.name' => 'asc'
		                        )
		            )
            );
		$new_pro_cat[0]['PledgeProjectCategory']['id'] = 5555;
		$new_pro_cat[0]['PledgeProjectCategory']['name'] = __l('Newest Artists');
		$project_category = array_merge($new_pro_cat,$project_category);
		$this->set('project_categories', $project_category);
		$this->set('montages', $this->paginate());		
    }
	
	public function view($id=null) { 
	
	$this->pageTitle = __l('Product View Page');
	$montage = $this->Montage->find('first',array(
									'contain' => array(
											'Attachment',
											'Project',
											'Pledge',
									),
									'conditions' => array(
											'Montage.is_active' => 1,
											'Montage.id' => $id,
									),
							));
	$this->loadModel('PledgeProjectCategory');
	$project_category = $this->PledgeProjectCategory->find('first',array('conditions'=>array('id'=>$montage['Pledge']['pledge_project_category_id'])));
	//echo "<pre>"; print_r($project_category); exit;
	$montage['PledgeProjectCategory'] = $project_category['PledgeProjectCategory'];
	$this->set('montage', $montage);
	}
	
    public function admin_index() 
    {
		$this->pageTitle = __l('Montages');
		$montages = $this->Montage->find('all',array(
									'contain' => array(
											'Project' => array('Attachment'),
											'Attachment',		
									),
									'recursive' => 2,
							));
		//echo "<pre>"; 
		//print_r($montages);
		//exit;
		$this->set('activated', $this->Montage->find('count', array(
            'conditions' => array(
                'Montage.is_active = ' => 1
            )
        )));
		$this->set('deactivated', $this->Montage->find('count', array(
            'conditions' => array(
                'Montage.is_active = ' => 0
            )
        )));
		//echo '<pre>'; print_r($montages); exit;						
        $this->set('montages', $montages);
    }

	public function admin_add(){
		
		if($this->request->is('post')){
			$this->Montage->create($this->request->data);
			if($this->Montage->save($this->request->data)){
				//echo "<pre>"; print_r($this->request->data);exit;
				if(!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
				   //Save Montage Attachment
					$this->loadModel('Attachment');
					$montage_id = $this->Montage->getLastInsertId();
					$this->Attachment->create();
					$this->request->data['Attachment']['class'] = 'Montage';
					$this->request->data['Attachment']['foreign_id'] = $montage_id;
					$this->Attachment->save($this->request->data['Attachment']);
					$attachment_id = $this->Attachment->getLastInsertId();
					$this->Montage->saveField('attachment_id',$attachment_id);
					// Update attachment id
					}
				$this->Session->setFlash(__l('Montage Added Successfully') , 'default', null, 'success');
				$this->redirect(array('action' => 'index'));
			
			 } else {
				$this->Session->setFlash(__l('Montage Added Failed') , 'default', null, 'success');
				}
		}
		$this->loadModel('Project');
		//$projects = $this->Project->find('list',array('conditions' => array('or'=>array('is_successful' => '1','is_active'=>1))));
		$projects = $this->Project->find('list',
	            array(
	                    'conditions' =>
	                    array(
		                        'or'=>array('is_successful' => '1','is_active'=>1)
		                        ),
		                'order' => array(
		                    'name' => 'asc'
	                    )
            )
        );
    		$this->set('projects',$projects);
	}
	
	public function admin_edit($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$this->Montage->id = $id;
        $this->loadModel('Attachment');
		if($this->request->is('post') || $this->request->is('put')){
		//echo "<pre>";
		//print_r($this->request->data);
		//exit;
				if($this->Montage->save($this->request->data)){
				  //Save Montage Attachment
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
								$this->Attachment->Behaviors->attach('ImageUpload');
								$this->Attachment->set($this->request->data);
					}
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
						$conditions = array('Attachment.foreign_id' => $id);
						$this->Attachment->deleteAll($conditions);
						$image_info = getimagesize($this->request->data['Attachment']['filename']['tmp_name']);
						$this->Attachment->create();
						$this->request->data['Attachment']['class'] = 'Montage';
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->Attachment->save($this->request->data[Attachment]);
						// Update attachment id
						$attachment_id = $this->Attachment->getLastInsertId();
						$this->Montage->saveField('attachment_id',$attachment_id);
					}
					$this->Session->setFlash(__l('Montage Edited Successfully') , 'default', null, 'success');
				    $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__l('Montage Edited Failed') , 'default', null, 'success');
			}
	    }
			
		if(!empty($id)){
		
		
			$attachment_data = $this->Montage->find('first', array('conditions'=>array('Montage.id'=>$id),'contain'=>'Attachment'));	
			if(empty($attachment_data)) {			
			$attachment_data = $this->Attachment->find('first', array(
                    'conditions' => array(
                        'Attachment.foreign_id' => $id,
                        'Attachment.class' => 'Montage',
                    )
			));
			}		
			//echo "<pre>";
			//print_r($attachment_data);
			//exit;
			$this->set('attachment_data',$attachment_data);
		}
		$this->request->data = $this->Montage->read();
		$this->loadModel('Project');
		$projects = $this->Project->find('list', 
            array(
                'conditions' => array(
                    'or' => array(
                        'is_successful' => '1',
                        'is_active' => 1
                    )
                ),
                'order' => array(
                    'name' => 'ASC'
                ),
            )
        );
		$this->set('projects',$projects);
	
    }
	public function admin_delete($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if($this->Montage->delete($id)){
			$this->Session->setFlash(__l('Montage Deleted Successfully') , 'default', null, 'success');
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
        $this->request->data['Montage']['id'] = $id;
        if ($status == 'disapprove') {
            $this->request->data['Montage']['is_active'] = 0;
            $this->Session->setFlash(__l('Selected record has been disapproved') , 'default', null, 'success');
        }
        if ($status == 'approve') {
            $this->request->data['Montage']['is_active'] = 1;
            $this->Session->setFlash(__l('Selected record has been approved') , 'default', null, 'success');
        }
        $this->Montage->save($this->request->data);
        $this->redirect(array(
                'action' => 'index'
        ));
    
    }
	public function admin_get_project_details($id) {
		$this->loadModel('Project');
		$project_detrails = $this->Project->find('first', array('conditions'=>array('Project.id'=>$id),'contain'=>'Attachment'));
		$this->set(compact('project_detrails'));
		
		if ($this->RequestHandler->prefers('json')) {
            $response = Cms::dispatchEvent('Controller.Montage.admin_get_project_details', $this, array(
				'project_detrails' => $project_detrails,
				'id' => $id
			));
        }
	}
	
}
?>
