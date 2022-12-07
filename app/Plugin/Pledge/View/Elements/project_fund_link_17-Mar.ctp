<?php
  $status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
		  'status_id' => $projectStatus[$project['Project']['id']]['id'],
		  'project_type_id' => $project['Project']['project_type_id']
));
$reason =  $status_response->data['response']; ?>
<?php  if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  {?>
<div class="clearfix space top-mspace dropdown">

	<div class='alf-<?php echo $project['Project']['id'];?> hide'> <?php //after login project fund?>
		<a href="<?php echo Router::url(array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), true); ?>" class="btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>"> <?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?></a>
	</div>
	<div class='blf-<?php echo $project['Project']['id'];?> hide'> <?php //before login project fund?>
		<a href="<?php echo Router::url(array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), true); ?>" class="btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>"> <?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?></a>
	</div>
	<div class='alof-<?php echo $project['Project']['id'];?> hide'>  <?php //after login project owner fund?>
		<span class="disabled btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: You can\'t %s your own %s.'), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
	</div>

	<div class='ablfc-<?php echo $project['Project']['id'];?> hide'> <?php //after or before login project fund closed?>
	  <span class="disabled btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: %s.'),  $reason); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
	</div>

</div>
<?php } else { ?>
<?php if (($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding ||  $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached)): ?>
<div class="clearfix space bot-mspace">
<?php if(($this->Auth->user('id') != $project['Project']['user_id']) || Configure::read('Project.is_allow_owner_fund_own_project')):?>
  <a href="<?php echo Router::url(array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), true); ?>" class="btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>"> <?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?></a>
<?php else : ?>
  <span class="disabled btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: You can\'t %s your own %s.'), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
<?php endif; ?>
</div>
<?php else :
  $status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
  'status_id' => $projectStatus[$project['Project']['id']]['id'],
		  'project_type_id' => $project['Project']['project_type_id']
));
$reason =  $status_response->data['response'];
?>
<div class="clearfix space bot-mspace">
  <span class="disabled btn btn-module ver-mspace dc span4 js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: %s.'),  $reason); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
</div>
<?php endif;?>
<?php }?>