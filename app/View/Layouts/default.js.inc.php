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
$js_files = array(
    JS . 'libs/jquery.js',
    JS . 'libs/jquery.form.js',
    JS . 'libs/jquery.blockUI.js',
    JS . 'libs/jquery.metadata.js',
    JS . 'libs/jquery-ui-1.10.3.custom.js',
    JS . 'libs/date.format.js',
    JS . 'libs/jquery.cookie.js',
    JS . 'libs/jquery.simplyCountable.js',
    JS . 'libs/jquery.flash.js',
    JS . 'libs/jquery.autogeocomplete.js',
    JS . 'libs/jquery.countdown.js',
    JS . 'libs/jquery.slug.js',
    JS . 'libs/jquery.oauthpopup.js',
    JS . 'libs/bootstrap-tab.js',
    JS . 'libs/jquery.easytabs.min.js',
    JS . 'libs/bootstrap-dropdown.js',
    JS . 'libs/bootstrap-modal.js',
    JS . 'libs/bootstrap-datetimepicker.min.js',
    JS . 'libs/bootstrap-tooltip.js',
    JS . 'libs/bootstrap-collapse.js',
    JS . 'libs/wysihtml5-0.3.0.js',
    JS . 'libs/bootstrap-wysihtml5-0.0.2.js',
    JS . 'libs/bootstrap-affix.js',
    JS . 'libs/socialite.js',
    JS . 'libs/jquery.timeago.js',
    JS . 'libs/jquery.easy-pie-chart.min.js',
    JS . 'libs/jquery.fullBg.js',
    JS . 'libs/jquery.scrollTo.js',
    JS . 'libs/bootstrap-popover.js',
    JS . 'libs/bootstro.js',
    JS . 'libs/jquery.pjax.js',
    JS . 'libs/jquery.sparkline.min.js',
    JS . 'libs/jquery.payment.js',
    JS . 'common.js',
);
$js_files = Set::merge($js_files, Configure::read('site.default.js_files'));
