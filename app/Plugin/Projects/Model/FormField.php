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
class FormField extends AppModel
{
    public $name = 'FormField';
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
        'FormFieldGroup' => array(
            'className' => 'Projects.FormFieldGroup',
            'foreignKey' => 'form_field_group_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        )
    );
    public $types = array(
        'text' => 'Single Line of Text',
        'textarea' => 'Multiple Lines of Text',
        'select' => 'Select Box',
        'checkbox' => 'Checkboxes',
        'radio' => 'Radio Buttons',
        'file' => 'File Upload',
        'date' => 'Date Picker',
        'time' => 'Time Picker',
        'datetime' => 'Datetime Picker',
        'multiselect' => 'Multiple Option Select Box',
        //  'color' => 'Color Picker',
        'thumbnail' => 'Website/Clone URL',
        'video' => 'Video URL',
        'url' => 'URL'
    );
    public $multiTypes = array(
        'checkbox',
        'radio',
        'select',
        'multiselect',
        'slider'
    );
    public function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
		$this->_memcacheModels = array(
            'FormFieldGroup',
            'FormFieldStep',
        );
        $this->_permanentCacheAssociations = array(
            'Project',
        );
        $this->validate = array(
            'display_text' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => true
            ) ,
            'label' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
        );
    }
}
?>