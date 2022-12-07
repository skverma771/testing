<div class="row-fluid ver-space js-cache-load-admin-user-activities">
 <?php $i=0; ?>
          <section class="span24 space" >
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#registration','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#a47ae2'}"><?php echo $user_reg_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph1c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_user_reg;?>"><?php echo $total_user_reg;?> </div>
								<div class="text-12 pull-right <?php if ($user_reg_data_per>0) {?> greenc <?php } else if($user_reg_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $user_reg_data_per;?>%</span>
									<?php if (!empty($user_reg_data_per)) {?>
										<i class="<?php if ($user_reg_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('User Registration'); ?>"><?php echo __l('User Registration'); ?></div>
						</div>
					</div>
				 </div>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#login','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#4986e7'}"><?php echo $user_log_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph2c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_user_login;?>"><?php echo $total_user_login;?> </div>
								<div class="text-12 pull-right <?php if ($user_log_data_per>0) {?> greenc <?php } else if($user_log_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $user_log_data_per;?>%</span>
									<?php if (!empty($user_log_data_per)) {?>
										<i class="<?php if ($user_log_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>

							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('User Logins'); ?>"><?php echo __l('User Logins'); ?></div>
						</div>
					</div>
				 </div>
				 <?php if (isPluginEnabled('SocialMarketing')) {?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#login','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#f691b2'}"><?php echo $user_follow_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph3c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_user_follow;?>"><?php echo $total_user_follow;?> </div>
								<div class="text-12 pull-right <?php if ($user_follow_data_per>0) {?> greenc <?php } else if($user_follow_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $user_follow_data_per;?>%</span>
									<?php if (!empty($user_follow_data_per)) {?>
										<i class="<?php if ($user_follow_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('User Followers'); ?>"><?php echo __l('User Followers'); ?></div>
						</div>
					</div>
				 </div>
				 <?php }?>
				 <?php if (isPluginEnabled('Projects')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#pledges','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#cd74e6'}"><?php echo $projects_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph4c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_projects;?>"><?php echo $total_projects;?> </div>
								<div class="text-12 pull-right <?php if ($projects_data_per>0) {?> greenc <?php } else if($projects_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $projects_data_per;?>%</span>
									<?php if (!empty($projects_data_per)) {?>
										<i class="<?php if ($projects_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span  bot-space htruncate js-tooltip" title="<?php echo __l('Projects'); ?>"><?php echo __l('Projects'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('Projects')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					 <?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#pledges','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#ff7537'}"><?php echo $project_fund_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph5c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_fund;?>"><?php echo $total_project_fund;?> </div>
								<div class="text-12 pull-right <?php if ($project_fund_data_per>0) {?> greenc <?php } else if($project_fund_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_fund_data_per;?>%</span>
									<?php if (!empty($project_fund_data_per)) {?>
										<i class="<?php if ($project_fund_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Funded'); ?>"><?php echo __l('Project Funded'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('Projects')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectcomments','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#d06b64'}"><?php echo $project_comments_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph6c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_comment;?>"><?php echo $total_project_comment;?> </div>
								<div class="text-12 pull-right <?php if ($project_comments_data_per>0) {?> greenc <?php } else if($project_comments_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_comments_data_per;?>%</span>
									<?php if (!empty($project_comments_data_per)) {?>
										<i class="<?php if ($project_comments_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Comments'); ?>"><?php echo __l('Project Comments'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('ProjectUpdates')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectcomments','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#42d692'}"><?php echo $project_updates_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph7c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_update;?>"><?php echo $total_project_update;?> </div>
								<div class="text-12 pull-right <?php if ($project_updates_data_per>0) {?> greenc <?php } else if($project_updates_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_updates_data_per;?>%</span>
									<?php if (!empty($project_updates_data_per)) {?>
										<i class="<?php if ($project_updates_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Updates'); ?>"><?php echo __l('Project Updates'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('ProjectUpdates')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectfollowers','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#16a765'}"><?php echo $project_update_comments_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph8c htruncate js-tooltip span10 js-tooltip" title="<?php echo !empty($total_update_comments)?$total_update_comments:'';?>"><?php echo !empty($total_update_comments)?$total_update_comments:'';?></div>
								<div class="text-12 pull-right <?php if ($project_update_comments_data_per>0) {?> greenc <?php } else if($project_update_comments_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_update_comments_data_per;?>%</span>
									<?php if (!empty($project_update_comments_data_per)) {?>
										<i class="<?php if ($project_update_comments_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Update Comments'); ?>"><?php echo __l('Project Update Comments'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('Idea')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectflag','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#ac725e'}"><?php echo $project_rating_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph9c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_ratings;?>"><?php echo $total_project_ratings;?> </div>
								<div class="text-12 pull-right <?php if ($project_rating_data_per>0) {?> greenc <?php } else if($project_rating_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_rating_data_per;?>%</span>
									<?php if (!empty($project_rating_data_per)) {?>
										<i class="<?php if ($project_rating_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Ratings'); ?>"><?php echo __l('Project Ratings'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <?php if (isPluginEnabled('ProjectFollowers')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectfollowers','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#9fe1e7'}"><?php echo $project_follower_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph10c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_follower;?>"><?php echo $total_project_follower;?> </div>
								<div class="text-12 pull-right <?php if ($project_follower_data_per>0) {?> greenc <?php } else if($project_follower_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_follower_data_per;?>%</span>
									<?php if (!empty($project_follower_data_per)) {?>
										<i class="<?php if ($project_follower_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Followers'); ?>"><?php echo __l('Project Followers'); ?></div>
						</div>
					</div>
				 </div>
				 <?php }?>
				 <?php if (isPluginEnabled('ProjectFlags')) { ?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#projectflag','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#b99aff'}"><?php echo $project_flag_data;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph11c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_project_flag;?>"><?php echo $total_project_flag;?> </div>
								<div class="text-12 pull-right <?php if ($project_flag_data_per>0) {?> greenc <?php } else if($project_flag_data_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $project_flag_data_per;?>%</span>
									<?php if (!empty($project_flag_data_per)) {?>
										<i class="<?php if ($project_flag_data_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>

							</div>
							<div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Project Flags'); ?>"><?php echo __l('Project Flags'); ?></div>
						</div>
					</div>
				 </div>
				  <?php }?>
				 <div class="span8 sep-right sep sep-bot sep-top <?php if($i%3==0) {?> no-mar <?php } ?>"> <?php $i++;?>
					<?php if (isPluginEnabled('Insights')): ?>
						<div class="pull-right space "><?php echo $this->Html->link('<i class="icon-share-alt blackc"></i>', array('controller' => 'insights','action' => 'index','#revenue','admin'=>true),array('escape'=> false));?></div>
					<?php endif; ?>
					<div class="hor-space span clearfix">
						<div class="span7" style="display: none; visbility:hidden;">
							<span class="js-sparkline-chart {'colour':'#ffad46'}"><?php echo $revenue;?></span>
						</div>
						<div class="span15">
							<div class="span">
								<div class="text-24 pull-left graph12c htruncate js-tooltip span10 js-tooltip" title="<?php echo $total_revenue;?>"><?php echo $total_revenue;?></div>
								<div class="text-12 pull-right <?php if ($rev_per>0) {?> greenc <?php } else if($rev_per == 0) { ?> grayc <?php } else { ?> redc <?php } ?>">
									<span class="text-16  pull-left"><?php echo $rev_per;?>%</span>
									<?php if (!empty($rev_per)) {?>
										<i class="<?php if ($rev_per>0) {?> icon-arrow-up  <?php } else { ?> icon-arrow-down <?php } ?> text-24  pull-left"></i>
									<?php } ?>
								</div>
							</div>
                            <div class="span bot-space htruncate js-tooltip" title="<?php echo __l('Revenue').' ('.Configure::read('site.currency').')'; ?>"><?php echo __l('Revenue').' ('.Configure::read('site.currency').')'; ?></div>
						</div>
					</div>
				 </div>
          </section>
        </div>