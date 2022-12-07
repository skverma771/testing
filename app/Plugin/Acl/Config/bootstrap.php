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
require_once 'constants.php';
CmsHook::setCssFile(array(
    APP . 'Plugin' . DS . 'Acl' . DS . 'webroot' . DS . 'css' . DS . 'acl.css'
) , 'admin');
CmsHook::setJsFile(array(
    APP . 'Plugin' . DS . 'Acl' . DS . 'webroot' . DS . 'js' . DS . 'common.js'
) , 'default');
