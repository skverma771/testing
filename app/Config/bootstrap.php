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
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */
/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
App::import('Lib', 'CmsHook');
App::uses('PhpReader', 'Configure');
Configure::config('default', new PhpReader());
Configure::load('config');
require_once 'constants.php';
App::uses('CakeLog', 'Log');
App::uses('CmsPlugin', 'Extensions.Lib');
App::uses('CmsEventManager', 'Event');
App::import('Lib', 'Cms');
App::import('Lib', 'CmsNav');
CakePlugin::load(array(
    'Extensions'
) , array(
    'bootstrap' => true
));
CakePlugin::load(array(
    'DebugKit'
));
// settings
App::import('Vendor', 'Spyc/Spyc');
if (file_exists(APP . 'Config' . DS . 'settings.yml')) {
    $settings = Spyc::YAMLLoad(file_get_contents(APP . 'Config' . DS . 'settings.yml'));
    foreach($settings AS $settingKey => $settingValue) {
        Configure::write($settingKey, $settingValue);
    }
    require_once 'cms_menus.php';
}
require_once 'cms_bootstrap.php';
// Load Install plugin
if (Configure::read('Security.salt') == 'f78b12a5c38e9e5c6ae6fbd0ff1f46c77a1e3' || Configure::read('Security.cipherSeed') == '60170779348589376') {
    $_securedInstall = false;
}
Configure::write('Install.secured', !isset($_securedInstall));
Configure::write('Install.installed', file_exists(APP . 'Config' . DS . 'database.php') && file_exists(APP . 'Config' . DS . 'settings.yml'));
if (!Configure::read('Install.installed') || !Configure::read('Install.secured')) {
    CakePlugin::load('Install', array(
		'bootstrap' => true,
        'routes' => true
    ));
}
if (($baseUrl = Configure::read('App.baseUrl')) !== false) {
	Configure::write('App.base', $baseUrl);
}
function isPluginEnabled($pluginName)
{
    $plugins = explode(',', Configure::read('Hook.bootstraps'));
    if (in_array($pluginName, $plugins)) {
        return true;
    }
    return false;
}
define('LICENSE_HASH', 'e9a5561se42c5a4if06c0b8v281cf43a');
if (!defined('STDIN') && !empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != 'localhost' && strstr($_SERVER['HTTP_HOST'], '.dev1.agriya.com') != '.dev1.agriya.com' && strstr($_SERVER['HTTP_HOST'], '.dev.agriya.com') != '.dev.agriya.com' && strstr($_SERVER['HTTP_HOST'], '.cssilize.com') != '.cssilize.com' && Configure::read('Install.installed') === true && Configure::read('Install.secured') === true) {
    require_once 'class_ionoLicenseHandler.php';
	$host = preg_replace('/^(touch\.|www\.|m\.(.*))/i', '${2}', $_SERVER['HTTP_HOST']);
    if (!empty($_GET['url']) && preg_match('/admin\//', $_GET['url']) && empty($_SESSION['is_skip_license_check'])) {
        $license_obj = new IonoLicenseHandler();
        $license_obj->setErrorTexts();
        $err_msg = $license_obj->ionLicenseHandler(Configure::read('site.license_key') , 1);
        if ($err_msg != '') {
            die($err_msg);
        } else {
			$_SESSION['is_skip_license_check'] = 1;
		}
    } else {
		$plugins = array();
		$corePlugins = array('Acl', 'Extensions', 'Install', 'DebugKit', 'SecurityQuestions', 'LaunchModes', 'MobileApp', 'Translation', 'Wallet', 'Withdrawals', 'Projects', 'ProjectFlags', 'ProjectFollowers', 'ProjectUpdates','Idea');
        $folder = new Folder;
        $pluginPaths = App::path('plugins');
        foreach($pluginPaths as $pluginPath) {
            $folder->path = $pluginPath;
            if (!file_exists($folder->path)) {
                continue;
            }
            $pluginFolders = $folder->read();
            foreach($pluginFolders[0] as $pluginFolder) {
                if (substr($pluginFolder, 0, 1) != '.' && !in_array($pluginFolder, $corePlugins)) {
                    $plugins[$pluginPath . $pluginFolder] = $pluginFolder;
                }
            }
        }
		$is_plugin_key_available = 1;
		if (!empty($plugins)) {
			foreach($plugins as $plugin) {
				if (!file_exists(APP . 'tmp' . DS . $plugin . '_key.php')) {
					$is_plugin_key_available = 0;
					break;
				}
			}
		}
        $license_key_path = APP . 'tmp' . DS . 'key.php';
        if (file_exists($license_key_path) && !empty($is_plugin_key_available)) {
            require_once $license_key_path;
            $str = $CFG['app']['license_key'] . $host . LICENSE_HASH;
            $hash = md5($str);
            if ($CFG['app']['license_verified'] != $hash) {
                die('Sorry invalid license');
            }
			if (!empty($plugins)) {
				foreach($plugins as $plugin) {
					require_once APP . 'tmp' . DS . $plugin . '_key.php';
					$str = $CFG['app']['license_key'] . $host . $plugin . LICENSE_HASH;
					$hash = md5($str);
					if ($CFG['app']['license_verified'] != $hash) {
						die('Sorry invalid plugin license');
					}
				}
			}
        } else {
            $license_key = Configure::read('site.license_key');
            $license_obj = new IonoLicenseHandler();
            $license_obj->setErrorTexts();
            $err_msg = $license_obj->ionLicenseHandler($license_key, 3); //3 for binding the domain and IP
            if ($err_msg == '') {
                $str = $license_key . $host . LICENSE_HASH;
                $str = md5($str);
                $str = <<<CONT
<?php
\$CFG['app']['license_key'] = '$license_key';
\$CFG['app']['license_verified'] = '$str';
?>
CONT;
                $handle = fopen($license_key_path, 'x+');
                fwrite($handle, $str);
                fclose($handle);
				if (!empty($plugins)) {
					$moduleIds = array();
					foreach($plugins as $pluginPath => $plugin) {
						$pluginData = json_decode(file_get_contents($pluginPath . DS . 'Config' . DS . 'plugin.json'));
						if (!in_array($pluginData->module_id, $moduleIds) && $pluginData->module_hash == md5($pluginData->module_id . LICENSE_HASH . $plugin)) {
							$moduleIds[] = $pluginData->module_id;
							$err_msg = $license_obj->ionLicenseHandler($license_key, 3, $pluginData->module_id); //3 for binding the domain and IP
							if ($err_msg == '') {
								$str = $license_key . $host . $plugin . LICENSE_HASH;
								$str = md5($str);
								$str = <<<CONT
<?php
\$CFG['app']['license_key'] = '$license_key';
\$CFG['app']['license_verified'] = '$str';
?>
CONT;
								$plugin_license_key_path = APP . 'tmp' . DS . $plugin . '_key.php';
								$handle = fopen($plugin_license_key_path, 'x+');
								fwrite($handle, $str);
								fclose($handle);
							} else {
								die($err_msg);
							}
						} else {
							die('Invalid Plugin');
						}
					}
				}
                $email_content = 'Hi,

	Crowdfunding installed successfully in http://' . $_SERVER['HTTP_HOST'] . '/ on ' . date('h:ia, d F, Y') . '.
	IP ADDRESS: ' . $_SERVER['REMOTE_ADDR'] . '
	Package Version: v2.0b1
	License Key: ' . $license_key . '

Regards,
Crowdfunding Dev Team';
                mail('crowdfunding@agriya.in', 'Crowdfunding installed successfully in http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) , $email_content, 'From: Crowdfunding Dev Team <crowdfunding@agriya.in>');
            } else {
            	$email_content = 'Hi,

	Crowdfunding installed but license verification failed in http://' . $_SERVER['HTTP_HOST'] . '/ on ' . date('h:ia, d F, Y') . '.
	IP ADDRESS: ' . $_SERVER['REMOTE_ADDR'] . '
	Package Version: v2.0b1
	License Key: ' . $license_key . '

Regards,
Crowdfunding Dev Team';
                mail('crowdfunding@agriya.in', 'Crowdfunding license verification failed in http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) , $email_content, 'From: Crowdfunding Dev Team <crowdfunding@agriya.in>');
                die($err_msg);
            }
        }
    }
}
