<ul class="unstyled">
	<li><b><?php echo sprintf(__l('Flagged %s %s'), Configure::read('project.alt_name_for_pledge_singular_caps'), Configure::read('project.alt_name_for_project_plural_caps'));?></b></li>
	<li><i class="icon-caret-right grayc"></i><?php echo $this->Html->link(__l('System Flagged') . ' (' . $pledge_system_flagged_count. ')', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Flagged), array('class' => 'grayc'));?></li>
	<?php if (isPluginEnabled('ProjectFlags')) { ?>
	<li><i class="icon-caret-right grayc"></i><?php echo $this->Html->link(__l('User Flagged') . ' (' . $pledge_user_flagged_count. ')', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::UserFlagged), array('class' => 'grayc'));?> </li>
	<?php } ?>
</ul>