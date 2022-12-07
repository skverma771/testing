<div class="thumbnail span5 dc module-start pledge">
	<?php echo $this->Html->image('pledge-hand2.png', array('width' => 110, 'height' => 110)); ?>
	<?php echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'). " " . Configure::read('project.alt_name_for_project_singular_caps'), array('controller' => 'projects', 'action' => 'add', 'project_type'=>'pledge', 'admin' => false), array('title' => Configure::read('project.alt_name_for_pledge_singular_caps'). " " . Configure::read('project.alt_name_for_project_singular_caps'),'class' => 'js-tooltip ver-mspace btn btn-large btn-module', 'escape' => false));?>
	<p class="text-12"><?php echo __l('People initially pledge. Amount is captured by end date. May offer rewards.'); ?></p>
</div>