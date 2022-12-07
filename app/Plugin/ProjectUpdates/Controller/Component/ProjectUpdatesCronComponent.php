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
class ProjectUpdatesCronComponent extends Component
{
    public function main() 
    {
        App::import('Model', 'Project');
        $this->Project = new Project();
        $projects = $this->Project->find('all', array(
            'conditions' => array(
                'Project.feed_url !=' => Null
            ) ,
            'recursive' => -1
        ));
        foreach($projects as $project) {
            if (!empty($project['Project']['feed_url'])) {
                $this->Project->ProjectFeed->rss_feed($project);
            }
        }
    }
}
