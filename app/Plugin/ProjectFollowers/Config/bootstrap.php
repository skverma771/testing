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
CmsNav::add('activities', array(
    'title' => __l('Activities') ,
    'weight' => 30,
    'children' => array(
        'Project Followers' => array(
            'title' => sprintf(__l('%s Followers') , Configure::read('project.alt_name_for_project_singular_caps')) ,
            'url' => array(
                'controller' => 'project_followers',
                'action' => 'index',
            ) ,
            'weight' => 10,
        ) ,
    ) ,
));
CmsHook::setExceptionUrl(array(
    'project_followers/index',
));
$defaultModel = array(
    'User' => array(
        'hasMany' => array(
            'ProjectFollower' => array(
                'className' => 'ProjectFollowers.ProjectFollower',
                'foreignKey' => 'user_id',
                'dependent' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            ) ,
        ) ,
    ) ,
);
$pluginModel = array();
if (isPluginEnabled('Projects')) {
    $pluginModel = array(
        'Project' => array(
            'hasMany' => array(
                'ProjectFollower' => array(
                    'className' => 'ProjectFollowers.ProjectFollower',
                    'foreignKey' => 'project_id',
                    'dependent' => true,
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'limit' => '',
                    'offset' => '',
                    'exclusive' => '',
                    'finderQuery' => '',
                    'counterQuery' => ''
                ) ,
            ) ,
        ) ,
        'Message' => array(
            'belongsTo' => array(
                'ProjectFollower' => array(
                    'className' => 'ProjectFollowers.ProjectFollower',
                    'foreignKey' => 'foreign_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                ) ,
            ) ,
        ) ,
    );
    $defaultModel = $defaultModel+$pluginModel;
}
CmsHook::bindModel($defaultModel);
