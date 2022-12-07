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
class StaticpagesController extends AppController
{
	public $name = 'Staticpages';
    public function beforeFilter() 
    {
        $this->Security->disabledFields = array(
            'title',
			'body',
			'attachments',
        );
        parent::beforeFilter();
		
		// $this->Auth->allow(array('admin_index'));
		 
		 $this->Components->disable('Security');
        
		if (isset($this->request->params['slug'])) {
            $this->request->params['named']['slug'] = $this->request->params['slug'];
        }
        if (isset($this->request->params['type'])) {
            $this->request->params['named']['type'] = $this->request->params['type'];
        }
    }

	public function admin_index() 
	{
		$this->loadModel('Attachment');
		$how = $this->Staticpage->find('all', array(
						'conditions' => array(
							'Staticpage.active' => 1,
						),
				'contain' => array(
						'Attachment',
						)
				));
				
		$this->set('how', $how);
		
	}
	public function admin_add() 
	{
		$this->loadModel('Attachment');
		if($this->request->data)
		{
			$data['Staticpage']['title'] = $this->request->data['Staticpage']['title'];
			$data['Staticpage']['body'] = $this->request->data['Staticpage']['body'];
			$data['Staticpage']['active'] = $this->request->data['Staticpage']['active'];
			$this->Staticpage->save($data);
			$foreign_id = $this->Staticpage->getLastInsertId();
								
								if (!empty($this->request->data['Staticpage']['filename']['tmp_name'])) {
									$this->Attachment->Behaviors->attach('ImageUpload');
									$this->Attachment->set($this->request->data);
								}
								if (!empty($this->request->data['Staticpage']['filename']['tmp_name'])) {
									$image_info = getimagesize($this->request->data['Staticpage']['filename']['tmp_name']);
									$this->Attachment->create();
									$this->request->data['Staticpage']['class'] = 'Staticpage';
									$this->request->data['Staticpage']['foreign_id'] = $foreign_id;
									$this->Attachment->save($this->request->data['Staticpage']);
								}
			$this->Session->setFlash('Saved successfully');
			 $this->redirect(array(
					'controller' => 'staticpages',
					'action' => 'index',
					'admin' => true
					));
		}
		
	}	

	public function admin_edit($id=null) {		
	
	
	  $this->loadModel('Attachment');
	  $this->pageTitle = __l('Edit');
	  
	if(!empty($this->request->data)) {
		//echo '<pre>'; print_r($this->request->data); exit;
			$this->Staticpage->id = $foreign_id = $this->request->data['Staticpage']['id'];
			$data['Staticpage']['title'] = $this->request->data['Staticpage']['title'];
			$data['Staticpage']['body'] = $this->request->data['Staticpage']['body'];
			$data['Staticpage']['active'] = $this->request->data['Staticpage']['active'];
			$this->Staticpage->save($data['Staticpage']);
			

								if (!empty($this->request->data['Staticpage']['filename']['tmp_name'])) {
									$this->Attachment->Behaviors->attach('ImageUpload');
									$this->Attachment->set($this->request->data);
								}
									
								if (!empty($this->request->data['Staticpage']['filename']['tmp_name'])) {
									
								$conditions = array('Attachment.foreign_id' => $foreign_id);
								$this->Attachment->deleteAll($conditions);
								//$this->Attachment->delete($this->request->data['How']['attach_id']);
								$image_info = getimagesize($this->request->data['Staticpage']['filename']['tmp_name']);
								$this->Attachment->create();
								$this->request->data['Staticpage']['Attachment']['filename'] = $this->request->data['Staticpage']['filename'];
								$this->request->data['Staticpage']['Attachment']['class'] = 'Staticpage';
								$this->request->data['Staticpage']['Attachment']['foreign_id'] = $foreign_id;
								$this->Attachment->save($this->request->data['Staticpage']);
								}
								
					$this->Session->setFlash('Updated successfully');
					$this->redirect(array(
					'controller' => 'staticpages',
					'action' => 'index',
					'admin' => true
					));
			}
			
	  if(!empty($id))
			{
				$this->Staticpage->id = $id;
				$how = $this->Staticpage->find('first', array(
						'conditions' => array(
							'Staticpage.id' => $id,
						),
						'contain' => array(
						'Attachment',
						)
				));
				
				$this->set('How', $how);				
				$this->set('Attachment', $how['Attachment']);
				$this->request->data = $this->Staticpage->read();
			}
	
		  
	}
	
	public function view() 
		{
			$how = $this->Staticpage->find('all', array(
					'conditions' => array(
					'Staticpage.active' => 1,
					),
					'contain' => array(
						'Attachment',
						)
				));
				
			$this->set('how', $how);
		
	}
	public function admin_view() {
		$this->setAction('view');
	}
	
	public function admin_delete($id=null) {
		
		if($this->Staticpage->delete($id) ) {
			$this->Session->setFlash('Record is successfully deleted');
			 $this->redirect(array(
					'controller' => 'staticpages',
					'action' => 'index',
					'admin' => true,
					));
			}
		
	} 
}
?>