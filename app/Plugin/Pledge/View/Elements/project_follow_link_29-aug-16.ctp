<?php
	$redirect_url = Router::url(array(
		'controller' => 'project_followers',
		'action' => 'add',
		$project['Project']['id']
	), true);
	$projectStatus = array();
	$response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
		'projectStatus' => $projectStatus,
		'project' => $project,
		'type'=> 'status'
	));
	$arrow_class = 'arrow-middle';
	if (!empty($response->data['is_allow_to_vote']) || !empty($response->data['is_show_vote'])) {
		$arrow_class = 'arrow-right';
	}
?>
<div class="pull-right mob-clr dropdown pr follow-over-view pledge">
  <?php
		if (isPluginEnabled('ProjectFollowers')) {
			if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {?>
							<div class="alpuf-<?php echo $project['Project']['id'];?> pull-left hide">
								<?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $follower['ProjectFollower']['id']),array('class'=>"show btn btn-module span3 js-add-remove-followers js-no-pjax js-tooltip js-unfollow",'escape' => false, 'title'=>__l('Unfollow')));  ?>
							</div>
							<div class="alpuf-sm-<?php echo $project['Project']['id'];?> pull-left hide">
								<a id="js-follow-id" class="btn span2 btn-module js-tooltip js-follow {'project_id':'<?php echo $project['Project']['id'];?>'}" data-target="#" data-toggle="dropdown" title="<?php echo __l('Follow');?>" href="#"><?php echo __l('Follow');?></a>
								<div class="dropdown-menu arrow <?php echo $arrow_class; ?> js-social-link-div clearfix">
									<div class="dc">
									<?php echo $this->Html->image('ajax-follow-loader.gif', array('alt' => __l('[Image:Loader]') ,'width' => 16, 'height' => 11, 'class' => 'js-loader')); ?></div>
								</div>
							</div>

							<div class='alpf-<?php echo $project['Project']['id'];?> pull-left hide'>
								<a class="btn span2 btn-module js-tooltip" title="<?php echo __l('Follow');?>" href="<?php echo $redirect_url; ?>"><?php echo __l('Follow');?></a>
							</div>
							<div class='blpuf-<?php echo $project['Project']['id'];?> pull-left hide'>
									<?php echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'btn span2 btn-module tooltiper js-tooltip', 'title' => __l('Follow')));	?>
							</div>
			<?php } else {

			if ($this->Auth->sessionValid()):
				if (!empty($follower)):
					echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $follower['ProjectFollower']['id']),array('class'=>"show btn btn-module span3 js-add-remove-followers js-no-pjax js-tooltip js-unfollow",'escape' => false, 'title'=>__l('Unfollow')));
				else:
					if (in_array($project['Pledge']['pledge_project_status_id'], array(ConstPledgeProjectStatus::OpenForIdea, ConstPledgeProjectStatus::OpenForFunding, ConstPledgeProjectStatus::GoalReached, ConstPledgeProjectStatus::FundingClosed, ConstPledgeProjectStatus::Pending))):
				?>
						<?php if (isPluginEnabled('SocialMarketing')): ?>
							<a id="js-follow-id" class="btn span2 js-tooltip js-follow {'project_id':'<?php echo $project['Project']['id'];?>'}" data-target="#" data-toggle="dropdown" title="<?php echo __l('Follow');?>" href="#"><?php echo __l('Follow');?></a>
							<div class="dropdown-menu arrow <?php echo $arrow_class; ?> js-social-link-div clearfix">
								<div class="dc">
								<?php echo $this->Html->image('ajax-follow-loader.gif', array('alt' => __l('[Image:Loader]') ,'width' => 16, 'height' => 11, 'class' => 'js-loader')); ?></div>
							</div>
						<?php else: ?>
							<a class="btn span2 btn-module js-tooltip" title="<?php echo __l('Follow');?>" href="<?php echo $redirect_url; ?>"><?php echo __l('Follow');?></a>
						<?php endif; ?>
			  <?php
					else:
					?>
					<span class="btn span2 btn-module js-tooltip" title="<?php echo __l('Follow');?>"><?php echo __l('Follow');?></span>
			  <?php	endif;
				endif;
			else:
				if (in_array($project['Pledge']['pledge_project_status_id'], array(ConstPledgeProjectStatus::OpenForIdea, ConstPledgeProjectStatus::OpenForFunding, ConstPledgeProjectStatus::GoalReached , ConstPledgeProjectStatus::FundingClosed))):
					echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'btn span2 btn-module tooltiper js-tooltip', 'title' => __l('Follow')));
				endif;
			endif;
		} }
	if (empty($response->data['is_allow_to_vote']) && empty($response->data['is_show_vote'])) {


		 if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  {
		 $status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
									  'status_id' => $project['Pledge']['pledge_project_status_id'],
									  'project_type_id' => $project['Project']['project_type_id']
									));
		if($status_response->data['response']){
			$reason =  $status_response->data['response'];
		}
		else{
			echo '';
		} if($project['Project']['is_admin_suspended']){
					$reason = __l("Admin Suspended");
		}
		?>
		<div class="clearfix pull-left">

			<div class='alf-<?php echo $project['Project']['id'];?> hide'> <?php //after login project fund?>
				<?php echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), array('title' => Configure::read('project.alt_name_for_pledge_singular_caps'),'class'=>'btn span2 btn-module tooltiper js-no-pjax js-tooltip', 'escape' => false)); ?>
			</div>
			<div class='blf-<?php echo $project['Project']['id'];?> hide'> <?php //before login project fund?>
				<?php echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'btn span2 btn-module tooltiper js-no-pjax js-tooltip', 'title' => Configure::read('project.alt_name_for_pledge_singular_caps'))); ?>
			</div>
			<div class='alof-<?php echo $project['Project']['id'];?> hide'>  <?php //after login project owner fund?>
				<span class="disabled btn btn-module span2 tooltiper  js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: You can\'t %s your own %s.'), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
			</div>

			<div class='ablfc-<?php echo $project['Project']['id'];?> hide'> <?php //after or before login project fund closed?>
			 <span class="disabled btn btn-module span2 tooltiper  js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: %s.'), $reason); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
			</div>

		</div>
	<?php } else {
		if (in_array($project['Pledge']['pledge_project_status_id'], array(ConstPledgeProjectStatus::OpenForFunding, ConstPledgeProjectStatus::GoalReached)) && !$project['Project']['is_admin_suspended']):
			if ($this->Auth->sessionValid()) {
				if ($project['Project']['user_id'] != $this->Auth->user('id') || Configure::read('Project.is_allow_owner_fund_own_project')) {
					echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), array('title' => Configure::read('project.alt_name_for_pledge_singular_caps'),'class'=>'btn span2 btn-module tooltiper js-tooltip js-no-pjax', 'escape' => false));
				} else {
		?>
  <span class="disabled btn btn-module span2 tooltiper  js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: You can\'t %s your own %s.'), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
  <?php
				}
			} else {
				echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'btn span2 btn-module tooltiper js-tooltip', 'title' => Configure::read('project.alt_name_for_pledge_singular_caps')));
			}
		else:
		$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
									  'status_id' => $project['Pledge']['pledge_project_status_id'],
									  'project_type_id' => $project['Project']['project_type_id']
									));
		if($status_response->data['response']){
			$reason =  $status_response->data['response'];
		}
		else{
			echo '';
		} if($project['Project']['is_admin_suspended']){
					$reason = __l("Admin Suspended");
		}
		?>
  <span class="disabled btn btn-module span2 tooltiper  js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: %s.'), $reason); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></span>
  <?php
		endif;
		} }
	?>
</div>
