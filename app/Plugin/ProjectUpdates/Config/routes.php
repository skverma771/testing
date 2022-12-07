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
CmsRouter::connect('/blogs/project/:project', array(
    'controller' => 'blogs',
    'action' => 'ProjectUpdates',
    'plugin' => 'Projects',
) , array(
    'project' => '[a-zA-Z0-9\-]+'
));
CmsRouter::connect('/blogs/tag/:tag', array(
    'controller' => 'blogs',
    'action' => 'index',
    'plugin' => 'ProjectUpdates',
) , array(
    'tag' => '[a-zA-Z0-9\-]+'
));
CmsRouter::connect('/blogs/category/:category', array(
    'controller' => 'blogs',
    'action' => 'index',
    'plugin' => 'ProjectUpdates',
) , array(
    'tag' => '[a-zA-Z0-9\-]+'
));
CmsRouter::connect('/blogs/user/:username', array(
    'controller' => 'blogs',
    'action' => 'index',
    'plugin' => 'ProjectUpdates',
) , array(
    'username' => '[a-zA-Z0-9\-]+'
));
CmsRouter::connect('/blogs/status/:status', array(
    'controller' => 'blogs',
    'action' => 'index',
    'plugin' => 'ProjectUpdates',
) , array(
    'tag' => '[a-zA-Z\-]+'
));
