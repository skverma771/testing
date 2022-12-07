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
class CronShell extends AppShell
{
    function main() 
    {
        App::uses('Router', 'Routing');
        // site settings are set in config
        App::import('Vendor', 'Spyc/Spyc');
        if (file_exists(APP . 'Config' . DS . 'settings.yml')) {
            $settings = Spyc::YAMLLoad(file_get_contents(APP . 'Config' . DS . 'settings.yml'));
            foreach($settings AS $settingKey => $settingValue) {
                Configure::write($settingKey, $settingValue);
            }
        }
        // include cron component
        App::uses('ComponentCollection', 'Controller');
        $collection = new ComponentCollection();
        App::import('Component', 'Cron');
        $this->Cron = new CronComponent($collection);
        $option = !empty($this->args[0]) ? $this->args[0] : '';
        $this->log('Cron started without any issue');
        if (!empty($option) && $option == 'main') {
            $this->Cron->main();
        } elseif (!empty($option) && $option == 'daily') {
            $this->Cron->daily();
        }
    }
}
?>