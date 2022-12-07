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
$path = '/';
$url = array(
    'plugin' => 'install',
    'controller' => 'install'
);
if (file_exists(APP . 'Config' . DS . 'settings.yml')) {
    if (!Configure::read('Install.secured')) {
        $path = '/*';
        $url['action'] = 'finish';
    }
}
CmsRouter::connect($path, $url);
