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
class ProjectFeedsController extends AppController
{
    public $name = 'ProjectFeeds';
    public function index($project_id = null) 
    {
        $this->pageTitle = __l('Updates');
        $conditions = array();
        if ($project_id) {
            $conditions['ProjectFeed.project_id'] = $project_id;
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'recursive' => -1,
        );
        $this->set('projectFeeds', $this->paginate());
    }
}
?>