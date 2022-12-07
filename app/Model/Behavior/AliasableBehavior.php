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
class AliasableBehavior extends ModelBehavior
{
    protected $_byIds = array();
    protected $_byAlias = array();
    public function setup(Model $model, $config = array()) 
    {
        $config = Set::merge(array(
            'id' => 'id',
            'alias' => 'alias',
        ) , $config);
        $this->settings[$model->alias] = $config;
        $this->reload($model);
    }
    public function reload(Model $model) 
    {
        $config = $this->settings[$model->alias];
        $this->_byIds[$model->alias] = $model->find('list', array(
            'fields' => array(
                $config['id'],
                $config['alias']
            ) ,
            'conditions' => array(
                $model->alias . '.' . $config['alias'] . ' != ' => '',
            ) ,
        ));
        $this->_byAlias[$model->alias] = array_flip($this->_byIds[$model->alias]);
    }
    public function byId(Model $model, $id) 
    {
        if (!empty($this->_byIds[$model->alias][$id])) {
            return $this->_byIds[$model->alias][$id];
        }
        return false;
    }
    public function byAlias(Model $model, $alias) 
    {
        if (!empty($this->_byAlias[$model->alias][$alias])) {
            return $this->_byAlias[$model->alias][$alias];
        }
        return false;
    }
    public function listById(Model $model) 
    {
        return $this->_byIds[$model->alias];
    }
    public function listByAlias(Model $model) 
    {
        return $this->_byAlias[$model->alias];
    }
}
