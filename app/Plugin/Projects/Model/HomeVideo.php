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
class HomeVideo extends AppModel
{
    public $name = 'HomeVideo';   
    //The Associations below have been created with all possible keys, those that are not needed can be removed
   public $hasOne = array(
		'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class =' => 'HomePagePdf'
            ) ,
            'fields' => '',
            'order' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->_permanentCacheAssociations = array(
            'UserProfile',
            'User',
            'Project',
            'ProjectFund',
        );
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
            'title' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ),
			'video_title' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ),
			'video_description' => array(
				'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ),
			'video_url' => array(
				'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            )
        );
    }
}
?>