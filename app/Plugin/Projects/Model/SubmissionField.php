<?php
class SubmissionField extends AppModel
{
    public $name = 'SubmissionField';
    public $validate = array(
        //'submission_id' => array('numeric'),
        //'form_field' => array('notempty')
        
    );
    public $belongsTo = array(
        'Submission' => array(
            'className' => 'Projects.Submission',
            'foreignKey' => 'submission_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'FormField' => array(
            'className' => 'Projects.FormField',
            'foreignKey' => 'form_field_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasOne = array(
        'ProjectCloneThumb' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => false,
            'conditions' => array(
                'ProjectCloneThumb.class' => 'ProjectCloneThumb',
            ) ,
            'fields' => '',
            'order' => ''
        ) ,
        'SubmissionThumb' => array(
            'className' => 'Projects.SubmissionThumb',
            'foreignKey' => 'foreign_id',
            'dependent' => false,
            'conditions' => array(
                'SubmissionThumb.class' => 'SubmissionThumb',
            ) ,
            'fields' => '',
            'order' => ''
        )
    );
}
?>