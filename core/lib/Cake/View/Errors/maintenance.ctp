<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Model', 'Setting');
$settings = new Setting();
$date = $settings->findByName('site.date_end');

// echo "<pre>";
// print_r($date['Setting']);
?>
<?php $this->pageTitle = $name; ?>
<h1 class="maintenance-title text-46 space blackc"><?php echo __l('Maintenance Mode');?></h1>
<p class="no-mar"><?php echo __l('Sorry for the inconvenience.');?></p>
<p class="no-mar"><?php echo __l('Our website is currently undergoing schedule maintenance.');?></p>

<h3>
    <?php echo __l('Please come back on '); ?><br>
    <?= date('l (F d, Y)', strtotime($date['Setting']['value'])); ?>
</h3>
<p class="no-mar"><?php echo __l('Thank you for understanding');?></p>

<h3>Visit our <?php echo $this->Html->link('' . __l('Blog') . '</span>', array('controller' => 'blog', 'action' => 'index', 'admin' => false), array('title' => __l('Blog'),'class' => 'clearfix dc', 'escape' => false));?></h3>