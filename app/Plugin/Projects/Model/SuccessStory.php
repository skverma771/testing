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
class SuccessStory extends AppModel
{
    public $name = 'SuccessStory';   
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'attachment_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) 	
    );
   /* public $hasMany = array(
        'Project' => array(
            'className' => 'Projects.Project',
            'foreignKey' => 'city_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
    );*/
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        
        $this->isFilterOptions = array(
            ConstMoreAction::Inactive => __l('Unapproved') ,
            ConstMoreAction::Active => __l('Approved')
        );
        $this->moreActions = array(
            ConstMoreAction::Inactive => __l('Disapprove') ,
            ConstMoreAction::Active => __l('Approve') ,
            ConstMoreAction::Delete => __l('Delete')
        );
        $this->validate = array(
            'name' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'state_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'country_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            )
        );
    }
}
?>