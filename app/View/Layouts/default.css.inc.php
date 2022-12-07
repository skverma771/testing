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
$css_files = array(
    CSS . 'dev1bootstrap.less',
    CSS . 'responsive.less',
    CSS . 'custom.less',
    CSS . 'bootstrap-wysihtml5-0.0.2.css',
    CSS . 'bootstrap-datetimepicker.min.css',
    CSS . 'flag.css',
    CSS . 'slickmap.css',
    CSS . 'bootstro.css'
);
$css_files = Set::merge($css_files, Configure::read('site.default.css_files'));
?>