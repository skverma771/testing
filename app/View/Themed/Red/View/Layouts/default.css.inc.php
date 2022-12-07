<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-03-07
 *
 */
$css_files = array(
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'dev1bootstrap.less',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'responsive.less',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'custom.less',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'bootstrap-wysihtml5-0.0.2.css',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'bootstrap-datetimepicker.min.css',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'flag.css',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'slickmap.css',
    APP . 'View' . DS . 'Themed' . DS . 'Red' . DS . 'webroot' . DS . 'css' . DS . 'bootstro.css'
);
$css_files = Set::merge($css_files, Configure::read('site.default.css_files'));
?>