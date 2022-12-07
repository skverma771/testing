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
CmsNav::add('masters', array(
    'title' => 'Masters',
    'weight' => 200,
    'children' => array(
        'Account' => array(
            'title' => __l('Account') ,
            'url' => '',
            'weight' => 1100,
        ) ,
        'Security Questions' => array(
            'title' => __l('Security Questions') ,
            'url' => array(
                'controller' => 'security_questions',
                'action' => 'index'
            ) ,
            'weight' => 1110,
        ) ,
    )
));
$defaultModel = array(
    'User' => array(
        'belongsTo' => array(
            'SecurityQuestion' => array(
                'className' => 'SecurityQuestions.SecurityQuestion',
                'foreignKey' => 'security_question_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            ) ,
        ) ,
    ) ,
);
CmsHook::bindModel($defaultModel);
