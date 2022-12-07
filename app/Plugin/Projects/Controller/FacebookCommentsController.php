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
class FacebookCommentsController extends AppController
{
    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'FacebookComments';
    /**
     * Components
     *
     * @var array
     * @access public
     */
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Security->disabledFields = array(
            'id'
        );
        $this->Security->validatePost = false;
    }
    public function add() 
    {
        if (!empty($this->request->data)) {
            $_data = array();
            $_data['facebook_comment_id'] = $this->request->data['commentID'];
            $_data['facebook_comment_creater_name'] = $this->request->data['userName'];
            $_data['comment_content'] = $this->request->data['commentText'];
            $_data['href'] = $this->request->data['href'];
            $this->FacebookComment->create();
            $this->FacebookComment->save($_data);
        }
        $this->layout = "ajax";
        $this->autoRender = false;
    }
    public function remove() 
    {
        $id = $this->request->params['named']['id'];
        $comment = $this->FacebookComment->find('first', array(
            'conditions' => array(
                'FacebookComment.facebook_comment_id' => $id,
            ) ,
        ));
        if (isset($comment['FacebookComment']['id']) && $this->FacebookComment->delete($comment['FacebookComment']['id'])) {
            echo "Success";
        }
        $this->layout = "ajax";
        $this->autoRender = false;
    }
}
