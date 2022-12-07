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
class HomeVideosController extends AppController
{
    public $name = 'HomeVideos';
    public function beforeFilter() 
    {
        $this->Security->validatePost = false;
        parent::beforeFilter();
    }
	public function index() 
    {
		$this->pageTitle = __l('Home Videos');
		$home_videos = $this->HomeVideo->find('all',array(
                                    'contain' => 'Attachment', 
									'conditions' => array(
											'HomeVideo.is_active' => 1,
									),
									'recursive' => -1,
							));
        //echo '<pre>'; print_r($home_videos); exit;							
		$this->set('home_videos', $home_videos);					
    }
    public function admin_index() 
    {
		$this->pageTitle = __l('Home Videos');
		$home_videos = $this->HomeVideo->find('all',array(
									'recursive' => -1,
							));
		$this->set('activated', $this->HomeVideo->find('count', array(
            'conditions' => array(
                'HomeVideo.is_active = ' => 1
            )
        )));
		$this->set('deactivated', $this->HomeVideo->find('count', array(
            'conditions' => array(
                'HomeVideo.is_active = ' => 0
            )
        )));
        $this->set('home_videos', $home_videos);
    }

	public function admin_add(){
		
		if($this->request->is('post')){
            $this->loadModel('Attachment');
		    if (empty($this->request->data['Attachment']['filename']['tmp_name'])) {
						$this->HomeVideo->Attachment->validationErrors['filename'] = __l('Required');
		    }
			$this->HomeVideo->create($this->request->data);
			if($this->HomeVideo->save($this->request->data)){
				   $home_page_video_id = $this->HomeVideo->getLastInsertId();
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
								$this->Attachment->Behaviors->attach('ImageUpload');
								$this->Attachment->set($this->request->data);
					}
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
					$image_info = getimagesize($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Attachment->create();
					$this->request->data['Attachment']['class'] = 'HomePagePdf';
					$this->request->data['Attachment']['foreign_id'] = $home_page_video_id;
					$this->Attachment->save($this->request->data[Attachment]);
					// Update attachment id
					$attachment_id = $this->Attachment->getLastInsertId();
					$this->HomeVideo->id = $home_page_video_id;
					$this->HomeVideo->saveField('attachment_id',$attachment_id);
				    }
				$this->Session->setFlash(__l('Video Added Successfully') , 'default', null, 'success');
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__l('Video Added Failed') , 'default', null, 'success');
			}
		}
	}
	
	public function admin_edit($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$this->HomeVideo->id = $id;
        $this->loadModel('Attachment');
		if($this->request->is('post') || $this->request->is('put')){
			if($this->HomeVideo->save($this->request->data)){
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
								$this->Attachment->Behaviors->attach('ImageUpload');
								$this->Attachment->set($this->request->data);
					}
					if (!empty($this->request->data['Attachment']['filename']['tmp_name'])) {
					$conditions = array('Attachment.foreign_id' => $id);
					$this->Attachment->deleteAll($conditions);
					$image_info = getimagesize($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Attachment->create();
					$this->request->data['Attachment']['class'] = 'HomePagePdf';
					$this->request->data['Attachment']['foreign_id'] = $id;
					$this->Attachment->save($this->request->data[Attachment]);
					$attachment_id = $this->Attachment->getLastInsertId();
					$this->HomeVideo->saveField('attachment_id',$attachment_id);
					}
					$this->Session->setFlash(__l('Video Edited Successfully') , 'default', null, 'success');
				    $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__l('Video Edited Failed') , 'default', null, 'success');
			}
	    }
		if(!empty($id)){
			$attachment_data = $this->Attachment->find('first', array(
                    'conditions' => array(
                        'Attachment.foreign_id' => $id,
                        'Attachment.class' => 'HomePagePdf',
                    )
			));
		    $this->set('attachment_data',$attachment_data);
		}
		//echo '<pre>'; print_r($attachment_data); exit; 
	    $this->set('home_page_video_id',$id);
		$this->request->data = $this->HomeVideo->read();
	
    }
	public function admin_delete($id = null){
		
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if($this->HomeVideo->delete($id)){
			$this->Session->setFlash(__l('Video Deleted Successfully') , 'default', null, 'success');
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
        $this->request->data['HomeVideo']['id'] = $id;
        if ($status == 'disapprove') {
            $this->request->data['HomeVideo']['is_active'] = 0;
            $this->Session->setFlash(__l('Selected record has been disapproved') , 'default', null, 'success');
        }
        if ($status == 'approve') {
            $this->request->data['HomeVideo']['is_active'] = 1;
            $this->Session->setFlash(__l('Selected record has been approved') , 'default', null, 'success');
        }
        $this->HomeVideo->save($this->request->data);
        $this->redirect(array(
                'action' => 'index'
        ));
    
    }
	public function admin_homepage_pdf_download($user_id, $attachment_id)
    {
		$this->loadModel('Attachment');
	    $attachment_data = $this->Attachment->find('first', array(
            'conditions' => array(
                    'Attachment.id' => $attachment_id,
					'Attachment.class' => 'HomePagePdf'
                ),
            'recursive' => 2,
        ));
        header('Content-type: ' . $attachment_data['Attachment']['mimetype']);
        header('Content-length: ' . $attachment_data['Attachment']['filesize']);
        header('Content-Disposition: attachment; filename="' . $attachment_data['Attachment']['filename'] . '"');
       	echo $contents = file_get_contents('../media' . DS . 'HomePagePdf' . '/' . $user_id . '/' . $attachment_data['Attachment']['filename']);
		$this->autoRender = false;
    }
	public function homepage_pdf_download($user_id, $attachment_id)
    {
		$this->loadModel('Attachment');
	    $attachment_data = $this->Attachment->find('first', array(
            'conditions' => array(
                    'Attachment.id' => $attachment_id,
					'Attachment.class' => 'HomePagePdf'
                ),
            'recursive' => 2,
        ));
        header('Content-type: ' . $attachment_data['Attachment']['mimetype']);
        header('Content-length: ' . $attachment_data['Attachment']['filesize']);
        header('Content-Disposition: attachment; filename="' . $attachment_data['Attachment']['filename'] . '"');
       	echo $contents = file_get_contents('../media' . DS . 'HomePagePdf' . '/' . $user_id . '/' . $attachment_data['Attachment']['filename']);
		$this->autoRender = false;
    }
}
?>   