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
class CronComponent extends Component
{
    public function main() 
    {
        $this->_cronsInPlugin('main');
    }
    public function daily() 
    {
        $this->_cronsInPlugin('daily');
    }
    public function _cronsInPlugin($function) 
    {
        $plugins = explode(',', Configure::read('Hook.bootstraps'));
        if (!empty($plugins)) {
            App::uses('ComponentCollection', 'Controller');
            $collection = new ComponentCollection();
            foreach($plugins AS $plugin) {
                $pluginName = Inflector::camelize($plugin);
                if (file_exists(APP . 'Plugin' . DS . $pluginName . DS . 'Controller' . DS . 'Component' . DS . $pluginName . 'CronComponent.php')) {
                    $pluginComponent = $pluginName . 'CronComponent';
                    App::uses($pluginComponent, $pluginName . '.Controller/Component');
                    $cronObj = new $pluginComponent($collection);
                    if (method_exists($cronObj, $function)) {
                        $cronObj->{$function}();
                    }
                }
            }
        }
    }
}
