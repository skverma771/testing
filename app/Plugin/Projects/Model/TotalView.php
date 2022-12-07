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
class TotalView extends AppModel
{
    public $name = 'TotalView';   
    //The Associations below have been created with all possible keys, those that are not needed can be removed
   /*public $hasOne = array(
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

    );*/
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
    }
}
?>