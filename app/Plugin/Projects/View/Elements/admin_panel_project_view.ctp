<?php if($this->Auth->user('role_id') == ConstUserTypes::Admin): ?>
	<div class="accordion-admin-panel" id="js-admin-panel">
		<div class="clearfix js-admin-panel-head admin-panel-block">
			<div class="admin-panel-inner span3 pa accordion-heading no-mar no-bor clearfix box-head admin-panel-menu">
				<a data-toggle="collapse" data-parent="#accordion-admin-panel" href="#adminPanel" class="btn js-show-panel accordion-toggle js-toggle-icon js-no-pjax blackc no-under clearfix"><i class="pull-right caret"></i><i class="icon-user"></i> <?php echo __l('Admin Panel'); ?></a>
			</div>
			<div class="accordion-body no-round no-bor collapse" id="adminPanel">
				<div id="ajax-tab-container-admin" class="accordion-inner thumbnail clearfix no-bor tab-container admin-panel-inner-block pr">
					<ul class="nav nav-tabs tabs tabs-span clearfix">
						<li class="tab"><?php echo $this->Html->link(__l('Actions'), '#admin-actions',array('class' => 'js-no-pjax span2', 'title'=>__l('Actions'), 'data-toggle'=>'tab', 'rel' => 'address:/admin_actions')); ?></li>
						<li class="tab"><em></em><?php echo $this->Html->link(sprintf(__l('%s Views'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'project_views', 'action' => 'index', 'project_id' => $project['Project']['id'], 'view_type' => 'user_view', 'admin' => true), array('class' => 'js-no-pjax', 'data-target' => '#admin-project-views', 'escape' => false)); ?></li>
						<?php if (isPluginEnabled('Idea')) :?>
							<li class="tab"><em></em><?php echo $this->Html->link(sprintf(__l('%s Votings'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'project_ratings', 'action' => 'index', 'project_id' => $project['Project']['id'], 'view_type' => 'user_view', 'admin' => true), array('class' => 'js-no-pjax', 'data-target' => '#admin-project-ratings', 'escape' => false)); ?></li>
						<?php endif; ?>
							<li class="tab"><em></em><?php echo $this->Html->link(sprintf(__l('%s Funding'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => Inflector::Pluralize($project['ProjectType']['slug']), 'action' => 'funds', 'project_id' => $project['Project']['id'], 'view_type' => 'user_view', 'admin' => true), array('class' => 'js-no-pjax', 'data-target' => '#admin-project-funds', 'escape' => false)); ?></li>
						<?php if(isPluginEnabled('ProjectFlags')) :?>
							<li class="tab"><em></em><?php echo $this->Html->link(sprintf(__l('%s Flags'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'project_flags', 'action' => 'index', 'project_id' => $project['Project']['id'], 'view_type' => 'user_view', 'admin' => true), array('class' => 'js-no-pjax', 'data-target' => '#admin-project-flags', 'escape' => false)); ?></li>
						<?php endif; ?>
					</ul>
					<article class="panel-container clearfix span">
						<div class="span24 tab-pane fade in active clearfix" id="admin-actions" style="display: block;">
							<ul class="unstyled clearfix">
								<?php if (!empty($projectStatus->data['is_allow_to_move_for_voting']) && isPluginEnabled('Idea')): ?>
									<li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-move"></i> '.__l('Move for voting'), array('controller'=>'projects','action'=>'admin_open_funding', $project['Project']['id'],'type'=>'vote','admin'=>true), array('class' => 'btn blackc js-no-pjax',  'escape'=>false,'title' => __l('Move for voting')));?></li>
								<?php elseif (!empty($projectStatus->data['is_allow_to_move_for_funding'])): ?>
									<li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-hdd"></i> '.__l('Move for funding'), array('controller'=>'projects','action'=>'admin_open_funding', $project['Project']['id'],'admin'=>true), array('class' => 'btn blackc js-no-pjax',  'escape'=>false,'title' => __l('Move for funding')));?></li>
								<?php endif; ?>
								<li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-edit"></i> '.__l('Edit'), array('controller'=>'projects','action' => 'edit', $project['Project']['id'],'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Edit')));?></li>
								<?php if(isPluginEnabled('Insights')):?>
								<li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-tasks"></i> '.__l('Stats'), array('controller'=>'insights','action' => 'project_detailed_stats', $project['Project']['id'],'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Stats')));?></li>
								<?php endif;?>
								<li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-remove"></i> '.__l('Delete'), array('controller'=>'projects','action' => 'delete', $project['Project']['id'],'admin'=>true, 'redirect_to' => Inflector::Pluralize($project['ProjectType']['slug'])), array('class' => 'btn blackc js-no-pjax js-confirm', 'escape'=>false,'title' => __l('Delete')));?></li>
								<?php if($project['Project']['is_system_flagged']):?>
                                    <li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-remove-circle"></i> '.__l('Clear Flag'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'unflag', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Clear Flag')));?></li>
								<?php else: ?>
									<?php if (!empty($projectStatus->data['is_allow_to_change_status'])):?>
                                        <li class="pull-left dc mspace"><?php echo $this->Html->link('<i class="icon-flag"></i> '.__l('Flag'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'flag', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Flag')));?></li>
									<?php endif; ?>
								<?php endif;?>
								<?php if($project['Project']['is_admin_suspended']):?>
                                    <li class="pull-left dc mspace"> <?php echo $this->Html->link('<i class="icon-repeat"></i> '.__l('Unsuspend'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'unsuspend', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Unsuspend')));?></li>
								<?php else: ?>
									<?php if (!empty($projectStatus->data['is_allow_to_change_status'])):?>
                                        <li class="pull-left dc  mspace"> <?php  echo $this->Html->link('<i class="icon-off"></i> '.__l('Suspend'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'suspend', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Suspend')));?></li>
									<?php endif;?>
								<?php endif; ?>
								<?php if($project['Project']['is_featured']):?>
                                    <li class="pull-left dc  mspace"><?php echo $this->Html->link('<i class="icon-screenshot"></i> '.__l('Not Featured'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'notfeatured', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Not Featured')));?></li>
								<?php else: ?>
									<?php if (!empty($projectStatus->data['is_allow_to_change_status'])):?>
                                        <li class="pull-left dc  mspace"><?php echo $this->Html->link('<i class="icon-map-marker"></i> '.__l('Featured'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'featured', 'project_type' => $project['ProjectType']['slug'], 'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Featured')));?></li>
									<?php endif;?>
								<?php endif; ?>
								<?php if (!empty($projectStatus->data['is_allow_to_cancel_project'])):?>
									<li class="pull-left dc  mspace"><?php echo $this->Html->link('<i class="icon-remove-sign"></i> '.__l('Cancel'), array('controller'=>'projects','action'=>'admin_cancel', $project['Project']['id'],'admin'=>true), array('class' => 'btn blackc js-no-pjax','escape'=>false, 'title' => __l('Cancel')));?></li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="tab-pane fade in active span23" id="admin-project-comments" style="display: block;"></div>
						<div class="tab-pane fade in active span23" id="admin-project-views" style="display: block;"></div>
						<div class="tab-pane fade in active span23" id="admin-project-ratings" style="display: block;"></div>
						<div class="tab-pane fade in active span23" id="admin-project-funds" style="display: block;"></div>
						<div class="tab-pane fade in active span23" id="admin-project-flags" style="display: block;"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>