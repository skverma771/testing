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
CmsNav::add('plugins', array(
    'title' => __l('Plugins') ,
    'weight' => 70,
    'data-bootstro-step' => '7',
    'data-bootstro-content' => __l('To manage all plugins and their settings.') ,
    'icon-class' => 'certificate',
    'children' => array(
        'plugins' => array(
            'title' => __l('Plugins') ,
            'url' => array(
                'controller' => 'extensions_plugins',
                'action' => 'index',
            ) ,
            'htmlAttributes' => array(
                'class' => 'separator',
            ) ,
            'weight' => 10,
        ) ,
    ) ,
));
