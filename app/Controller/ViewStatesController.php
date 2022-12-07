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
class ViewStatesController extends AppController
{
    public $name = 'ViewStates';
    /*public $permanentCacheAction = array(
        'user' => array(
            'index',
        )
    );*/
    /*public function beforeFilter() 
    {
        $this->Security->disabledFields = array(
            'State.id',
        );
        parent::beforeFilter();
    }*/
    public function index() 
    {
		/*$this->loadModel('TotalView');
		$this->pageTitle = __l('View States');
		$last_day = $this->TotalView->find(
		  'count',
		  array(
			'conditions' => array(
			  'TotalView.date >=' => date('Y-m-d H:i:s', strtotime('-24 hour'))
			)
		  )
		);
		$this->set('last_day', $last_day);*/
		
    }
}   