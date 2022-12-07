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
class UserOpenid extends AppModel
{
    public $name = 'UserOpenid';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        )
    );
    public function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'openid' => array(
                'rule3' => array(
                    'rule' => array(
                        '_isEmptyOpenID',
                        'openid',
                    ) ,
                    'message' => __l('OpenID already exists')
                ) ,
                'rule3' => array(
                    'rule' => '_isEmptyOpenID',
                    'message' => __l('Enter valid OpenID')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            )
        );
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
    }
    public function _isEmptyOpenID() 
    {
        if (empty($this->data[$this->name]['openid']) or ($this->data[$this->name]['openid'] == 'http://' or $this->data[$this->name]['openid'] == 'Click to Sign In')) {
            return false;
        }
        return true;
    }
}
?>