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
class TotalViewsController extends AppController
{
    public $name = 'TotalViews';
    
    /*public function beforeFilter() 
    {
        $this->Security->disabledFields = array(
            'State.id',
        );
        parent::beforeFilter();
    }*/
    public function view_count()  
    {
		
		$this->TotalView->create();
		$this->request->data['TotalView']['view'] = '1';
		$this->request->data['TotalView']['ip_address'] = '111.111.111.111';
		$this->TotalView->save($this->request->data[TotalView]);
    
	
	
	}
}   