<?php
/**
 *
 * @package		360Project
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2011-03-09
 *
 */
class FormFieldGroup extends AppModel
{
    public $name = 'FormFieldGroup';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'name'
            )
        ) ,
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'ProjectType' => array(
            'className' => 'Projects.ProjectType',
            'foreignKey' => 'project_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'FormFieldStep' => array(
            'className' => 'Projects.FormFieldStep',
            'foreignKey' => 'form_field_step_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        )
    );
    public $hasMany = array(
        'FormField' => array(
            'className' => 'Projects.FormField',
            'foreignKey' => 'form_field_group_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
		$this->_memcacheModels = array(
            'FormFieldStep',
        );
        $this->_permanentCacheAssociations = array(
            'Project',
            'ProjectType',
        );
        $this->validate = array(
            'name' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
        );
    }
}
?>
