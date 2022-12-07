<?php /* SVN: $Id: view.ctp 2878 2010-08-27 11:07:18Z sakthivel_135at10 $ */ ?>
<?php Configure::write('highperformance.pids', $project['Project']['id']); ?>
<div class="ver-space pr clearfix js-project-view" data-project-id="<?php echo $project['Project']['id']; ?>">
	<?php
		$class = "project-affix-nonregister";
		if ($this->Auth->sessionValid()) {
			if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
				$class = "project-affix-user";
			} else {
				$class = "project-affix-admin";
			}
		}
		$projectStatus = array();
		$projectStatus = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
			'projectStatus' => $projectStatus,
			'project' => $project,
			'type'=> 'status'
		));
		if (strlen($project['Project']['name']) > 40) {
			$class .= ' title-double-line';
		}
	?>
	<section data-offset-top="10" class="panel-section project-affix row no-mar <?php echo $class; ?> affix-top" itemtype="http://schema.org/Person" itemscope>
		<div class="row no-mar ver-space">
			<?php /* ?><div class="span no-mar pull-left"> <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=70x70&chld=L|0" alt="QR Code" > </div> <?php */ ?>
			<div class="span no-mar pull-left"> <?php echo $this->Html->getUserAvatar($project['User'], 'normal_thumb', true,'','no-span'); ?> </div>
			<div class="span13">
			<div class="clearfix">
				<h3 class="hruncate span11 no-mar" itemprop="headline"><?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'], false), $project['Project']['detected_suspicious_words']), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug']), array('escape' => false,'title'=>$this->Html->cText($project['Project']['name'], false)));?></h3>
				<?php if(isPluginEnabled('HighPerformance')&& (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  { ?>
				<div class="alppcp hide">
				<div class="dropdown pull-right">
				<a href="#" class="btn dropdown-toggle js-no-pjax js-tooltip tooltiper no-under" data-toggle="dropdown" title = "<?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?>"><i class="icon-cog text-16"></i><span class="hide"><?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?></span> <span class="caret"></span></a>
				<ul class="unstyled dropdown-menu arrow arrow-right dl clearfix">
					<li class="hor-mspace sep-bot span5 textb bot-space">
						<span><?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?></span>
					</li>
					<?php if($project['Project']['is_draft'] || !empty($projectStatus->data['is_allow_to_edit_fund'])): ?>
		    		<li><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['Project']['id']), array('class' => 'edit js-edit js-no-pjax', 'title' => __l('Edit'),'escape'=>false)); ?></li>
					<?php endif; ?>
					<?php if (isPluginEnabled('ProjectUpdates')) { ?>
					<li class="tab">
						<?php
							if(!empty($project['Project']['feed_url'])):
								echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Updates'), array('controller'=>'projects','action'=>'view',$project['Project']['slug'].'#updates'),array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Updates'), 'rel' => '#updates', 'escape' => false));
							else:
								echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Updates'), array('controller'=>'projects','action'=>'view', $project['Project']['slug'].'/#updates'),array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Updates'), 'rel' => '#updates', 'escape' => false));
							endif;
						?>
					</li>
					<li>
						<?php
							if (empty($project['Project']['feed_url'])):
								echo $this->Html->link('<i class="icon-plus-sign"></i> '.__l('Add Update'), array('controller' => 'blogs', 'action' => 'add', 'project_id' => $project['Project']['id']),array('class' => 'blackc add js-no-pjax', 'data-target' => "#js-ajax", 'data-toggle' => "modal", 'escape'=>false,'title' => __l('Add Update')));
							endif;
						?>
					</li>
					<?php } ?>
					<?php if (!empty($project['Project']['facebook_feed_url']) || !empty($project['Project']['twitter_feed_url'])): ?>
						<li class="social-feeds tab"> <?php echo $this->Html->link('<i class="icon-tint"></i>'.__l('Stream'), '#social_feeds', array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Stream'), 'rel' => 'address:/social_feeds', 'escape' => false)); ?> </li>
					<?php endif; ?>
					<?php if (isPluginEnabled('Idea') && (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote']))):?>
						<li class="tab"><?php echo $this->Html->link('<i class="icon-star-empty"></i>'.__l('Voters'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#voters'), array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Votings'), 'rel' => '#voters', 'escape' => false)); ?></li>
					<?php endif;?>
					<?php
						if (empty($projectStatus->data['is_allow_to_vote'])):
					?>
					<?php if ($project['Project']['project_type_id'] == ConstProjectTypes::Donate) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('donate-icon.png', array('width' => 15, 'height' => 15)).' '.Configure::read('project.alt_name_for_donor_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_donor_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php } else if ($project['Project']['project_type_id'] == ConstProjectTypes::Lend) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('lend-hand.png', array('width' => 15, 'height' => 15)).' '.Configure::read('project.alt_name_for_lender_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_lender_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php }else if ($project['Project']['project_type_id'] == ConstProjectTypes::Equity) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('equity-hand.png', array('width' => 15, 'height' => 15)).' '. Configure::read('project.alt_name_for_investor_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_investor_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php } else { ?>
						<li class="tab"><?php echo $this->Html->link('<span class="">'.$this->Html->image('pledge-icon.png', array('width' => 10, 'height' => 10)).'</span>'.' '.Configure::read('project.alt_name_for_backer_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'/#backers'), array('class' => 'panel-link js-no-pjax', 'title' =>  Configure::read('project.alt_name_for_backer_plural_caps'),'rel' => '#backers',  'escape' => false)); ?></li>
					<?php } ?>
					<?php
							endif;
					?>
					<?php if(isPluginEnabled('ProjectFollowers')): ?>
						<li class="tab"><?php echo $this->Html->link('<i class="icon-group"></i>'.__l('Followers'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#followers'), array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Followers'), 'rel' => '#followers', 'escape' => false)); ?></li>
					<?php endif; ?>
				<?php if (Configure::read('Project.is_allow_owner_project_cancel') and !empty($projectStatus->data['is_allow_to_cancel_project'])) : ?>
					<li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Cancel'), array('controller' => 'projects', 'action' => 'cancel', $project['Project']['id']), array('class' => 'edit js-confirm cancel js-no-pjax', 'title' => __l('Cancel'), 'escape'=>false)); ?></li>
				<?php endif; ?>
				<?php  if (!empty($project['ProjectReward']) && !empty($projectStatus->data['is_allow_to_mange_reward'])): ?>
					<li><?php echo $this->Html->link('<i class="icon-gift"></i>'. sprintf(__l('Manage %s'), Configure::read('project.alt_name_for_reward_plural_caps')), array('controller'=>'project_funds','action'=>'index', 'project_id'=>$project['Project']['id'],'type'=>'manage'), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal','class'=>'js-no-pjax','id'=>'', 'escape' => false, 'title' => sprintf(__l('Manage %s'), Configure::read('project.alt_name_for_reward_plural_caps')))); ?></li>
				<?php endif; ?>
				<?php if (!empty($projectStatus->data['is_allow_to_share']) && isPluginEnabled('SocialMarketing')): ?>
						<li><?php	echo $this->Html->link('<i class="icon-share-alt"></i>'.__l('Share'), array('controller'=>'social_marketings','action'=>'publish', $project['Project']['id'],'type'=>'facebook', 'publish_action' => 'add'), array('class' => 'js-no-pjax', 'title' => __l('Share'),'escape'=>false)); ?></li>
				<?php endif; ?>
				</ul>
				</div>
				</div>
				<?php } else {
					if($project['Project']['user_id'] == $this->Auth->user('id')) :
				?>
				<div class="dropdown pull-right">
				<a href="#" class="btn dropdown-toggle js-no-pjax js-tooltip tooltiper no-under" data-toggle="dropdown" title = "<?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?>"><i class="icon-cog text-16"></i><span class="hide"><?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?></span> <span class="caret"></span></a>
				<ul class="unstyled dropdown-menu arrow arrow-right dl clearfix">
					<li class="hor-mspace sep-bot span5 textb bot-space">
						<span><?php echo sprintf(__l('%s Owner Control Panel'), Configure::read('project.alt_name_for_project_singular_caps')); ?></span>
					</li>
					<?php if($project['Project']['is_draft'] || !empty($projectStatus->data['is_allow_to_edit_fund'])): ?>
		    		<li><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['Project']['id']), array('class' => 'edit js-edit js-no-pjax', 'title' => __l('Edit'),'escape'=>false)); ?></li>
					<?php endif; ?>
					<?php if (isPluginEnabled('ProjectUpdates')) { ?>
					<li class="tab">
						<?php
							if(!empty($project['Project']['feed_url'])):
								echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Updates'), array('controller'=>'projects','action'=>'view',$project['Project']['slug'].'#updates'),array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Updates'), 'rel' => '#updates', 'escape' => false));
							else:
								echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Updates'), array('controller'=>'projects','action'=>'view', $project['Project']['slug'].'/#updates'),array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Updates'), 'rel' => '#updates', 'escape' => false));
							endif;
						?>
					</li>
					<li>
						<?php
							if (empty($project['Project']['feed_url'])):
								echo $this->Html->link('<i class="icon-plus-sign"></i> '.__l('Add Update'), array('controller' => 'blogs', 'action' => 'add', 'project_id' => $project['Project']['id']),array('class' => 'blackc add js-no-pjax', 'data-target' => "#js-ajax", 'data-toggle' => "modal", 'escape'=>false,'title' => __l('Add Update')));
							endif;
						?>
					</li>
					<?php } ?>
					<?php if (!empty($project['Project']['facebook_feed_url']) || !empty($project['Project']['twitter_feed_url'])): ?>
						<li class="social-feeds tab"> <?php echo $this->Html->link('<i class="icon-tint"></i>'.__l('Stream'), '#social_feeds', array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Stream'), 'rel' => 'address:/social_feeds', 'escape' => false)); ?> </li>
					<?php endif; ?>
					<?php if (isPluginEnabled('Idea') && (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote']))):?>
						<li class="tab"><?php echo $this->Html->link('<i class="icon-star-empty"></i>'.__l('Voters'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#voters'), array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Votings'), 'rel' => '#voters', 'escape' => false)); ?></li>
					<?php endif;?>
					<?php
						if (empty($projectStatus->data['is_allow_to_vote'])):
					?>
					<?php if ($project['Project']['project_type_id'] == ConstProjectTypes::Donate) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('donate-icon.png', array('width' => 15, 'height' => 15)).' '.Configure::read('project.alt_name_for_donor_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_donor_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php } else if ($project['Project']['project_type_id'] == ConstProjectTypes::Lend) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('lend-hand.png', array('width' => 15, 'height' => 15)).' '.Configure::read('project.alt_name_for_lender_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_lender_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php }else if ($project['Project']['project_type_id'] == ConstProjectTypes::Equity) { ?>
						<li class="tab"><?php echo $this->Html->link($this->Html->image('equity-hand.png', array('width' => 15, 'height' => 15)).' '. Configure::read('project.alt_name_for_investor_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#backers'), array('class' => 'js-no-pjax panel-link', 'title' => Configure::read('project.alt_name_for_investor_plural_caps'), 'rel' => '#backers', 'escape' => false)); ?></li>
					<?php } else { ?>
						<li class="tab"><?php echo $this->Html->link('<span class="">'.$this->Html->image('pledge-icon.png', array('width' => 10, 'height' => 10)).'</span>'.' '.Configure::read('project.alt_name_for_backer_plural_caps'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'/#backers'), array('class' => 'panel-link js-no-pjax', 'title' =>  Configure::read('project.alt_name_for_backer_plural_caps'),'rel' => '#backers',  'escape' => false)); ?></li>
					<?php } ?>
					<?php
							endif;
					?>
					<?php if(isPluginEnabled('ProjectFollowers')): ?>
						<li class="tab"><?php echo $this->Html->link('<i class="icon-group"></i>'.__l('Followers'), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'].'#followers'), array('class' => 'js-no-pjax panel-link', 'title' =>  __l('Followers'), 'rel' => '#followers', 'escape' => false)); ?></li>
					<?php endif; ?>
				<?php if (Configure::read('Project.is_allow_owner_project_cancel') and !empty($projectStatus->data['is_allow_to_cancel_project'])) : ?>
					<li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Cancel'), array('controller' => 'projects', 'action' => 'cancel', $project['Project']['id']), array('class' => 'edit js-confirm cancel js-no-pjax', 'title' => __l('Cancel'), 'escape'=>false)); ?></li>
				<?php endif; ?>
				<?php  if (!empty($project['ProjectReward']) && !empty($projectStatus->data['is_allow_to_mange_reward'])): ?>
					<li><?php echo $this->Html->link('<i class="icon-gift"></i>'. sprintf(__l('Manage %s'), Configure::read('project.alt_name_for_reward_plural_caps')), array('controller'=>'project_funds','action'=>'index', 'project_id'=>$project['Project']['id'],'type'=>'manage'), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal','class'=>'js-no-pjax','id'=>'', 'escape' => false, 'title' => sprintf(__l('Manage %s'), Configure::read('project.alt_name_for_reward_plural_caps')))); ?></li>
				<?php endif; ?>
				<?php if (!empty($projectStatus->data['is_allow_to_share']) && isPluginEnabled('SocialMarketing')): ?>
						<li><?php	echo $this->Html->link('<i class="icon-share-alt"></i>'.__l('Share'), array('controller'=>'social_marketings','action'=>'publish', $project['Project']['id'],'type'=>'facebook', 'publish_action' => 'add'), array('class' => 'js-no-pjax', 'title' => __l('Share'),'escape'=>false)); ?></li>
				<?php endif; ?>
				</ul>
				</div>
				<?php endif;
					} ?>
				</div>
				<p itemprop="containedIn"> <?php echo __l('A') . ' '; ?>
					<?php
						$response = Cms::dispatchEvent('View.Project.displaycategory', $this, array(
							'data' => $project,
							'class'=> 'linkc'
						));
						if (!empty($response->data['content'])) {
							echo $response->data['content'];
						}
					?>
					<?php echo sprintf(__l('%s in '), Configure::read('project.alt_name_for_project_singular_small')) . ' '; ?>
					<?php
						if (!empty($project['City']['name'])) {
							echo $this->Html->cText($project['City']['name'], false) . ', ';
						}
						if (!empty($project['Country']['name'])) {
							echo $project['Country']['name'];
						}
					?>
					<?php echo __l(' by '); ?><?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('title' => $project['User']['username'], 'escape' => false));?>
					<?php
						if ($project['User']['id'] !=  $this->Auth->user('id')) {
							if($this->Auth->user('id')) {
								echo $this->Html->link('<i class="icon-envelope"></i>'.__l(' Send message'), array('controller' => 'projects', 'action' => 'view',$project['Project']['slug'] . '/#comments'), array('class' => 'js-send-message js-no-pjax cboxelement msg msg1 panel-link', 'rel' => '#comments', 'escape' => false,'title'=>__l('send message')));
							} else {
								echo $this->Html->link('<i class="icon-envelope"></i>'.__l(' Send message'), array('controller' => 'users', 'action' => 'login/?f='.$this->request->url), array('escape' => false, 'class' => 'js-no-pjax msg msg1','title'=>__l('send message')));
							}
						}
					?>
				</p>

				</div>
			<?php
				if (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote'])) {
					$rated_users = array();
					$rating_count = 0;
			?>
			<div class="span5">
				<h5><?php echo __l("Voters"); ?></h5>
				<div class="row">
					<ul class="unstyled clearfix">
						<?php
							$i = 1;
							$rating_count = 0;
							if (!empty($project['ProjectRating'])):
								$rating_count = count($project['ProjectRating']);
								$extra = $rating_count - 5;
								foreach($project['ProjectRating'] as $projectrating) {
									array_push($rated_users, $projectrating['user_id']);
									if ($i <= 5) {
						?>
						<li class="span pull-left">
							<?php
								if (!empty($projectrating['user_id'])) {
									echo $this->Html->getUserAvatar($projectrating['User'], 'micro_thumb', true, "", "no-span");
								} else {
									echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous', "no-span");
								}
							?>
						</li>
						<?php
									}
									$i++;
								}
							endif;
						?>
						<?php if ($rating_count > 5) { ?>
							<li class="more span1 thumbnail dc pull-left"><?php echo $this->Html->link('+' . $extra . ' ' . __l('More ') . '&#187;', array('controller'=> 'projects', 'action'=>'view', $project['Project']['slug'].'#voters','admin' => false), array('class' => 'panel-link', 'rel' => '#comments', 'escape' => false, 'title' =>  sprintf(__l('Show all voters')))); ?></li>
						<?php } else { ?>
							<li class="more span1 thumbnail dc pull-left"><span class="show">
							<?php
								if($project['Project']['user_id'] == $this->Auth->user('id')){
									echo __l('X');
								} else {
									echo __l('You');
								}
							?>
							</span><?php echo __l('Here');?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } else { ?>
			<div class="span5" style="overflow:hidden;">
				<?php
					if ($project['Project']['project_type_id'] == ConstProjectTypes::Donate) {
						$title = Configure::read('project.alt_name_for_donor_plural_caps');
					}
					 else if($project['Project']['project_type_id'] == ConstProjectTypes::Lend){
						$title = Configure::read('project.alt_name_for_lender_plural_caps');
					}
					 else if($project['Project']['project_type_id'] == ConstProjectTypes::Equity){
						$title = Configure::read('project.alt_name_for_investor_plural_caps');
					}else {
						$title = Configure::read('project.alt_name_for_backer_plural_caps');
					}
				?>
				<h5 class="ver-space"><?php echo $title; ?></h5>
				<?php echo $this->element('backers', array('project_id' => $project['Project']['id'],'project_type'=>$project['ProjectType']['name'], 'backer_view' => 'compact')); ?>
				
			</div>
		<?php } ?>
		<div class="span3 pull-right">
		<img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=100x100&chld=L|0" alt="QR Code" >
		<div class="clearfix">
		<h6 style="font-size:10px;">Download QR code</h6>
		<select class="span3 browse_filter top-space js-select_model" id="at-select_model" name="select_model">
			<option value = "">Select</option>
			<option value ='120X120' data-valued="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=120x120&chld=L|0" >120X120</option>
			<option value ='250X250' data-valued="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=250x250&chld=L|0">250X250</option>
			<option value ='400x400' data-valued="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=400x400&chld=L|0">400x400</option>
		</select>
		</div>
		<div class="clearfix">
			<h6 style="font-size:10px;display:none;">
			<a style="display:none;" href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=120x120&chld=L|0" download title="Download QR Code"/>Download (120 x 120)</a>
		</h6>
          </div>
          <div class="clearfix">
              <h6 style="font-size:10px;display:none;"><a href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=250x250&chld=L|0" download title="Download QR Code"/>Download (250 x 250)</a></h6>
          </div>
          <div class="clearfix">
              <h6 style="font-size:10px;display:none;"><a href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).'project/'.$project['Project']['slug']; ?>&chs=400x400&chld=L|0" download title="Download QR Code"/>Download (400 x 400)</a></h6>
          </div>
		</div>
	</div>
		<div class="mob-ps top-social hor-space">
		
			<?php
				if (isPluginEnabled($project['ProjectType']['name'])) {
					echo $this->element('project_follow_link', array('follower' => isset($follower)?$follower:"", 'project' => $project), array('plugin' => $project['ProjectType']['name']));
				}
			?>
			<?php if (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote'])) { ?>
				<div class="clearfix view-page-vote pull-right bot-space pr follow-over-view">
					<?php
					    $rate_msg = "";
						if($project['Project']['user_id'] == $this->Auth->user('id')){
							$rate_msg = __l('Disabled. Reason: You can\'t rate your own project.');
						}
						else if(in_array($this->Auth->user('id'),$rated_users))
						{
							$rate_msg = __l('Disabled. Reason: You have already rated this project.');
						}
						$canrate = (!empty($projectStatus->data['is_allow_to_vote']) && $this->Auth->sessionValid() && !in_array($this->Auth->user('id'),$rated_users) && $project['Project']['user_id'] != $this->Auth->user('id')) ? 1 : 0;
						$average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
						echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>$canrate,'is_view'=>1, 'project_type' => $project['ProjectType']['slug'], 'rate_msg' => $rate_msg));
					?>
				</div>
			<?php } ?>
		</div>
</section>
<section class="row">
	<div id="ajax-tab-container-project" class='tab-container pr'>
		<ul class="nav nav-tabs tabs">
			<li class="tab"><?php echo $this->Html->link(sprintf(__l('About the %s'), Configure::read('project.alt_name_for_project_singular_caps')), '#project-details',array('class'=>'js-no-pjax panel-link', 'title'=>sprintf(__l('About the %s'), Configure::read('project.alt_name_for_project_singular_caps')), 'data-toggle'=>'tab', 'rel' => 'address:/project_details')); ?></li>
			<?php if (isPluginEnabled('ProjectUpdates')) { ?>
				<li class="tab">
					<?php
						if(!empty($project['Project']['feed_url'])):
							echo $this->Html->link(__l('Updates') . ' (' . $this->Html->cInt($project['Project']['project_feed_count'], false). ')', array('controller'=>'project_feeds','action'=>'index',$project['Project']['id']),array('class'=>'js-no-pjax', 'title' =>  __l('Updates'), 'data-target'=>'#updates','escape' => false));
						else:
							echo $this->Html->link(__l('Updates') . ' (' . $this->Html->cInt($project['Project']['blog_count'], false).')', array('controller'=>'blogs','action'=>'index','project_id' => $project['Project']['id'],'span_val' => 3),array('class'=>'js-no-pjax', 'title' =>  __l('Updates'),'data-target'=>'#updates', 'escape' => false));
						endif;
					?>
				</li>
			<?php } ?>
			<?php if (!empty($project['Project']['facebook_feed_url']) || !empty($project['Project']['twitter_feed_url'])): ?>
				<li class="social-feeds tab"> <?php echo $this->Html->link(__l('Stream'), '#social_feeds', array('class'=>'js-no-pjax panel-link', 'title' =>  __l('Stream'), 'data-toggle'=>'tab', 'rel' => 'address:/social_feeds', 'escape' => false)); ?> </li>
			<?php endif; ?>
			<?php if (isPluginEnabled('Idea') && (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote']))):?>
				<li class="tab"><?php echo $this->Html->link(__l('Voters').' ('.$this->Html->cInt($project['Project']['project_rating_count'], false).')' , array('controller' => 'project_ratings', 'action' => 'index', 'project_id' => $project['Project']['id']), array('class'=>'js-no-pjax', 'title' =>  __l('Votings'), 'data-target'=>'#voters','escape' => false)); ?></li>
			<?php endif;?>
			<?php
				if (empty($projectStatus->data['is_allow_to_vote'])):
			?>

			<li class="tab"><?php echo $this->Html->link(Configure::read('project.alt_name_for_'.$project['ProjectType']['funder_slug'].'_plural_caps') . ' (' . $this->Html->cInt($backer, false) . ')', array('controller' => 'project_funds', 'action' => 'index', 'project_id' => $project['Project']['id']), array('class'=>'js-no-pjax', 'title' => Configure::read('project.alt_name_for_'.$project['ProjectType']['funder_slug'].'_plural_caps'), 'data-target'=>'#backers','escape' => false)); ?></li>

			<?php
					endif;
			?>
			<?php if(isPluginEnabled('ProjectFollowers')): ?>
				<li class="tab"><?php echo $this->Html->link(__l('Followers') . ' ('.$this->Html->cInt($project['Project']['project_follower_count'], false).')', array('controller' => 'project_followers', 'action' => 'index', $project['Project']['id']), array('class'=>'js-no-pjax', 'title' =>  __l('Followers'), 'data-target'=>'#followers','escape' => false)); ?></li>
			<?php endif; ?>
		</ul>
		<div class="clearfix">
			<article class="span15 panel-container">
				<div class="tab-pane fade in active" id="project-details" style="display: block;">
					<section class="clearfix">
						<?php
							if (!empty($project['Attachment'])) {
								echo $this->Html->showImage('Project',$project['Attachment'],array('dimension' => 'very_big_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($project['Project']['name'], false)), 'class' => 'project-view-image', 'title' => $this->Html->cText($project['Project']['name'], false)));
							}
						?>							
						<?php if (!empty($project['Project']['video_embed_url'])): ?>
							<div class="clearfix">
								<?php
									/*if ($this->Embed->parseUrl($project['Project']['video_embed_url'])) {
										$params = $this->Embed->getObjectParams();
										$attr = $this->Embed->getObjectAttrib();
								?>
								<div class="ver-space video-player {'url':'<?php echo $params['movie'];?>','wmode':'transparent','pluginspage':'<?php echo $params['pluginspage'];?>','height':'<?php echo $attr['height'];?>','width':'<?php echo $attr['width'];?>'}"> <a href='#' class="no-under js-play-video js-no-pjax"> <span class="bot-space"> <?php //echo $this->Html->showImage('Project',$project['Attachment'],array('dimension' => 'very_big_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($project['Project']['name'], false)), 'class' => 'project-view-image', 'title' => $this->Html->cText($project['Project']['name'], false))); ?> </span></a>
								<span class="top-space offset6 show"><button class="btn js-tooltip space span2 js-play-video js-no-pjax"><i class="icon-play"></i> <?php echo __l('Play');?></button></span>
								</div>
								<?php } */ ?>
								<div class="ver-space" >
								<?php
								if ($this->Embed->parseUrl($project['Project']['video_embed_url'])) {
													$this->Embed->setObjectAttrib('wmode','transparent');
													$this->Embed->setObjectParam('wmode', 'transparent');
													echo $this->Embed->getEmbedCode();
									}
								?>
								</div>	
							</div>
						<?php endif; ?>
							
							<?php if (!empty($project['Project']['video_embed_url'])): ?>
							<div class="clearfix">
								<?php
									/*if ($this->Embed->parseUrl($project['Project']['video_url_2'])) {
										$params = $this->Embed->getObjectParams();
										$attr = $this->Embed->getObjectAttrib();
								?>
								<div class="ver-space video-player {'url':'<?php echo $params['movie'];?>','wmode':'transparent','pluginspage':'<?php echo $params['pluginspage'];?>','height':'<?php echo $attr['height'];?>','width':'<?php echo $attr['width'];?>'}"> <a href='#' class="no-under js-play-video js-no-pjax"> <span class="bot-space"> <?php //echo $this->Html->showImage('Project',$project['Attachment'],array('dimension' => 'very_big_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($project['Project']['name'], false)), 'class' => 'project-view-image', 'title' => $this->Html->cText($project['Project']['name'], false))); ?> </span></a>
								<span class="top-space offset6 show"><button class="btn js-tooltip space span2 js-play-video js-no-pjax"><i class="icon-play"></i> <?php echo __l('Play');?></button></span>
								</div>
								<?php } */
								?>
								<div class="ver-space" >
								<?php
								if ($this->Embed->parseUrl($project['Project']['video_url_2'])) {
													$this->Embed->setObjectAttrib('wmode','transparent');
													$this->Embed->setObjectParam('wmode', 'transparent');
													echo $this->Embed->getEmbedCode();
									}
								?>	
								</div>	
							</div>
							<?php endif; ?>
						<?php //else: ?>
							<?php // echo $this->Html->showImage('Project',$project['Attachment'],array('dimension' => 'very_big_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($project['Project']['name'], false)), 'class' => 'project-view-image', 'title' => $this->Html->cText($project['Project']['name'], false))); ?>
						<?php //endif; ?> &nbsp;
					</section>
					<section class="well space top-mspace">
						<div class="clearfix share-block">
							<div class="clearfix">
								<p class="pull-left textb"><?php echo sprintf(__l('Share this %s with your friends'), Configure::read('project.alt_name_for_project_singular_small')); ?></p>
								<?php
								if(isPluginEnabled('ProjectFlags')){
									if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {?>
									<div class="pull-right">
									<div class="aurp aurp-<?php echo $project['Project']['id'];?> hide">
									<?php
										echo $this->Html->link('<i class="icon-flag"></i> ' . sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'project_flags', 'action' => 'add', $project['Project']['id']), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal','class'=>'js-no-pjax','id'=>'', 'escape' => false, 'title' => sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps'))));
									?>
									</div>
									<div class="burp hide">
									<?php
										echo $this->Html->link('<i class="icon-flag"></i>'. sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array( 'title' => sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')),  'escape'=>false, 'class' => 'report'));
									?>
									</div>
									</div>
								<?php } else { ?>
									<div class="pull-right">
										<?php
											if ($this->Auth->sessionValid()):
												if($project['Project']['user_id'] != $this->Auth->user('id')) :
													echo $this->Html->link('<i class="icon-flag"></i> ' . sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'project_flags', 'action' => 'add', $project['Project']['id']), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal','class'=>'js-no-pjax','id'=>'', 'escape' => false, 'title' => sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps'))));
												endif;
											else :
												echo $this->Html->link('<i class="icon-flag"></i>'. sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array( 'title' => sprintf(__l('Report %s'), Configure::read('project.alt_name_for_project_singular_caps')),  'escape'=>false, 'class' => 'report'));
											endif;
										?>
									</div>
								<?php
									}
								}
								?>
							</div>
							<hr class="no-mar" />
							<?php
								$image_url = getImageUrl('Project',$project['Attachment'], array('full_url' => true, 'dimension' => 'big_thumb'));
								$project_url = Router::url(array('controller' => 'projects', 'action' => 'view', $project['Project']['slug']), true);
								$project_title = htmlentities($project['Project']['name'], ENT_QUOTES);
								$project_id = $project['Project']['id'];
							?>
							<div class="row share">
								<ul class="unstyled span top-space">
									<li class="span embed"><?php echo $this->Html->link(''.__l(' Embed'), '#embed_frame', array('data-toggle' => 'modal', 'data-target' => '#embed_frame', 'escape' => false, 'class' => 'js-no-pjax blackc', 'title' => __l('Embed Code')));?></li>
									<li class="span mail"><?php echo $this->Html->link(__l('Email!'), 'mailto:?body='.__l('Check out the great project on ').Configure::read('site.name').' - '.$project_url.'&amp;subject='.__l('Your friend has recommended that you check out').' '.$this->Html->cText($project['Project']['name'], false).__l(', a').' '.Configure::read('site.name').' '.__l('project by').' '.$project['User']['username'], array('target' => 'blank', 'title' => __l('Send a mail to friend about this project'), 'class' => 'quick'));?></li>
									<li class="span share-icon">
										<div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_compact" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4be1665734d1eaab"><?php echo __l('Share'); ?></a>
											<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4be1665734d1eaab"></script>
										</div>
									</li>
									<li class="span twit">
                        <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
                        <a href="http://twitter.com/share?url=<?php echo $project_url; ?>&amp;text=<?php echo $this->Html->cText($project['Project']['name'], false);?>&amp;lang=en&amp;via=<?php echo Configure::read('site.name'); ?>&amp;count=none" class="twitter-share-button" target="_blank"><?php echo __l('Tweet!');?></a></li>
                      <li class="span fb-share-block">
                        <fb:like href="<?php echo $project_url; ?>" layout="button_count" font="tahoma"></fb:like>
                      </li>
								</ul>
								<div class="modal space hide" id="embed_frame">
									<div class="modal-header">
										<button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h2><?php echo __l('Embed Code'); ?></h2>
									</div>
									
								<div>
								<?php
									if (!empty($projectStatus->data['is_allow_to_vote']) || !empty($projectStatus->data['is_show_vote'])):
										$height = '520';
									else:
										$height = '480';
									endif;
									$embed_url = Router::url(array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'],  'widget') , true);
									$embed_code = '<iframe src="'.$embed_url.'" width="301" height="' . $height . '" frameborder = "0" scrolling="no"></iframe>';
									echo $this->Form->input('embed_url', array('class' =>'span14 clipboard', 'id' => 'embed_url', 'readonly' => 'readonly', 'type' => 'textarea', 'label' => false, 'value' => $embed_code, 'readonly' => true));
								?>
							</div>
							<div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
						</div>
							
						  <?php 						  						  
						  if(isset($share_url)){
							echo "<div class='top-smspace'>";
							echo $this->Html->link('<i class="icon-share"></i>', $share_url, array('title'=>__l('Share'), 'escape' => false, 'class' => 'btn btn-small js-bootstrap-tooltip pull-left hor-smspace', 'target' => '_blank')); 
							echo "</div>";
						  }
						  ?>			 
					</div>
					<hr class="no-mar" />
					<div class="row top-space">
						<div>
							<?php
								$response = Cms::dispatchEvent('View.Project.displaycategory', $this, array(
									'data' => $project,
									'class'=> 'blackc'
								));
							?>
							<span class="span"><i class="icon-tag"></i> <?php echo $response->data['content'];?></span>
						</div>
						<address class="pull-right no-mar">
							<i class="icon-map-marker"></i>
							<?php
								if (!empty($project['City']['name'])) {
									$country_name = !empty($project['Country']['name'])?', '.$project['Country']['name']:'';
									echo $this->Html->link($this->Html->cText($project['City']['name'].$country_name, false) , array('controller' => 'projects', 'action' => 'index', 'city' => $project['City']['slug'], 'type' => 'home'), array('class' => 'blackc', 'title' => $project['City']['name']));
								}
							?>
						</address>
					</div>
				</div>
				<?php
					if(!empty($project['Submission']['SubmissionField'])) :
						$is_mediafile = $is_urls = $is_otherdetails = 0;
						foreach($project['Submission']['SubmissionField'] as $submissionField):
							if(!empty($submissionField['type']) and empty($submissionField['FormField']['depends_on'])):
								if (!empty($submissionField['type']) && $submissionField['type'] == 'file') {
									$is_mediafile=1;
								} elseif (!empty($submissionField['type']) && $submissionField['type'] == 'url') {
									$is_urls=1;
								} else {
									$is_otherdetails=1;
								}
							endif;
						endforeach;
				?>
				<?php if(!empty($is_urls)) { ?>
					<div class="clearfix share-block top-space">
						<div class="clearfix">
							<div class="clearfix">
								<h5 class="pull-left textb clearfix"><?php echo sprintf(__l('This %s in other websites'), Configure::read('project.alt_name_for_project_singular_small')); ?></h5>
							</div>
							<div class="clearfix top-space">
								<ul class="clearfix row unstyled">
									<?php
										foreach($project['Submission']['SubmissionField'] as $submissionField):
											if (!empty($submissionField['type']) && $submissionField['FormField']['type'] == 'url'):
									?>
									<li class="span"><a href="<?php echo $submissionField['response']; ?>" target="_blank" class="website" title="<?php echo $submissionField['FormField']['label']; ?>"><?php echo $submissionField['FormField']['label']; ?></a></li>
									<?php
											endif;
										endforeach;
									?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php endif; ?>
		</section>
		<section class="clearfix" itemtype="http://schema.org/WPHeader" itemscope>
			<?php if(!empty($project['Project']['description'])): ?>
				<h4 class="page-header ver-space textb ver-mspace" itemprop="headline"><?php echo sprintf(__l('About %s'), Configure::read('project.alt_name_for_project_singular_caps'));?></h4>
				<div>
					<p itemprop="description"><?php echo $this->Html->filterSuspiciousWords($this->Html->cHtml($project['Project']['description']), $project['Project']['detected_suspicious_words']);?></p>
				</div>
			<?php endif; ?>
		</section>
		<?php if(!empty($is_mediafile) && !empty($project['Submission']['SubmissionField'])): ?>
			<section class="clearfix ">
				<h4 class="page-header ver-space textb ver-mspace"><?php echo __l('Media and other files');?></h4>
				<?php
					$project_view_class = '';
					if (count($project['Submission']['SubmissionField']) >1) {
						$project_view_class = 'project-view-list';
					}
				?>
				<div class="<?php echo $project_view_class; ?> clearfix">
				
				<!--//New files added for slider -->
				<?php
					//<!-- jQuery (required) -->
					echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
					echo $this->Html->script('jquery.min');
					echo $this->Html->css('anythingslider');//<!-- Anything Slider -->
					echo $this->Html->script('jquery.anythingslider');
				?>
				<!-- Define slider dimensions here -->
				<style>#slider { width: 570px; height: 340px; }</style>
				<!-- AnythingSlider initialization -->
				<script>// DOM Ready
				$(function(){ $('#slider').anythingSlider(); });
				</script>
				
				<!--//End of slider files inclusion -->
				
					<?php $j = 0; $class = ' class="altrow"';?>
					<?php		
							$img_array =array();							
						foreach($project['Submission']['SubmissionField'] as $submissionField):
							if(empty($submissionField['FormField']['depends_on'])):
								$field_type = explode('_',$submissionField['form_field']);
								$div_class= '';
								$div_even = $j % 2;
								if($div_even == 0) {
									$div_class = 'grid_11 ';
								} else {
									$div_class = 'grid_right grid_11';
								}
								if($submissionField['SubmissionThumb']['mimetype'] == 'image/jpeg' || $submissionField['SubmissionThumb']['mimetype'] == 'image/png' || $submissionField['SubmissionThumb']['mimetype'] == 'image/jpg' || $submissionField['SubmissionThumb']['mimetype'] == 'image/gif') {
									$hide_class='hide';
								} else {
									$hide_class='';
								}
					?>					
					<?php /*<div class="<?php echo $div_class;?>">*/ ?>
						<div class="description-info <?php echo $hide_class;?>">							
							<?php if (!empty($submissionField['type']) && $submissionField['type'] == 'file') {?>
								<div class="row  bot-mspace">
										<div class='span1 space'>
										<?php if(!empty($submissionField['SubmissionThumb']['mimetype']) && ($submissionField['SubmissionThumb']['mimetype'] == 'image/jpeg' || $submissionField['SubmissionThumb']['mimetype'] == 'image/png' || $submissionField['SubmissionThumb']['mimetype'] == 'image/jpg' || $submissionField['SubmissionThumb']['mimetype'] == 'image/gif')) {?>
										 <?php $img_array[]=$this->Html->showImage('SubmissionThumb', $submissionField['SubmissionThumb'], array('dimension' => 'very_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'escape' => false)); ?>
										 
										
										<?php
										//echo $this->Html->showImage('SubmissionThumb', $submissionField['SubmissionThumb'], array('dimension' => 'micro_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'escape' => false));?>
										<?php } elseif (preg_match('/(\\.wmv|\\.flv|\\.avi)$/', $submissionField['SubmissionThumb']['filename'] )) { ?>
											<i class="icon-facetime-video text-32"></i>
										<?php } else { ?>
											<i class="icon-file text-32"></i>
										<?php }?>
																		
									<div class="top-mspace htruncate pull-right"> </div>
								</div>
							<?php 
									
									if(($submissionField['SubmissionThumb']['mimetype'] != 'image/jpeg' && $submissionField['SubmissionThumb']['mimetype'] != 'image/png' && $submissionField['SubmissionThumb']['mimetype'] != 'image/jpg' && $submissionField['SubmissionThumb']['mimetype'] != 'image/gif')):
										if(!empty($depends_on_fields[$submissionField['form_field']])) {
												$depends_array = $depends_on_fields[$submissionField['form_field']];
												foreach($depends_array  as $depends) {
													if($depends['type'] == 'text') {
										?>
										<div class ="top-space top-mspace pull-left span8"><div class="top-smspace"><?php echo $this->Html->link($this->Html->cText($depends['response'], false), array('controller' => 'projects', 'action' => 'mediadownload',$project['Project']['slug'],$submissionField['id'],$submissionField['SubmissionThumb']['id']), array('class' => 'download js-tooltip', 'escape' => false,'title'=>"Download - ".$submissionField['SubmissionThumb']['filename']));?></div></div>
										<?php
													}
												}
											} else {
												?>
												<div class ="top-space top-mspace pull-left span8"><div class="top-smspace"><?php echo $this->Html->link($this->Html->cText($submissionField['SubmissionThumb']['filename'], false), array('controller' => 'projects', 'action' => 'mediadownload',$project['Project']['slug'],$submissionField['id'],$submissionField['SubmissionThumb']['id']), array('class' => 'download js-tooltip', 'escape' => false,'title'=>"Download - ".$submissionField['SubmissionThumb']['filename']));?></div></div>
										<?php	}
									endif;
									?>
									<div class="top-mspace htruncate pull-right"> </div>
								</div>
							<?php } ?>						
						</div>
					<?php /*</div>*/ ?>
					<?php
								$j++;
							endif;
						endforeach;						
						?>
						</div>
						<ul id="slider">
						<?php for($i=0;$i<sizeof($img_array);$i++){ ?>
							<li><?php echo $img_array[$i]; ?> </li>
						<?php  } ?>

						</ul>
			</section>
		<?php endif; ?>
		<?php if(!empty($is_otherdetails) && !empty($project['Submission']['SubmissionField'])): ?>
			<section class="clearfix">
				<h4 class="page-header ver-space textb ver-mspace"><?php echo __l("Other Details");?></h4>
				<?php
					$project_view_class = '';
					if (count($project['Submission']['SubmissionField']) >1) {
						$project_view_class = 'project-view-list';
					}
				?>
				<div class="<?php echo $project_view_class; ?> clearfix">
					<dl class="clearfix dl-horizontal">
						<?php $j = 0; $class = ' class="altrow"';?>
						<?php foreach($project['Submission']['SubmissionField'] as $submissionField):?>
							<?php if(empty($submissionField['FormField']['depends_on'])):?>
							<?php
								$field_type = explode('_',$submissionField['form_field']);
								$div_class= '';
								$div_even = $j % 2;
								if($div_even == 0) {
									$div_class = 'grid_11 ';
								} else {
									$div_class = 'grid_right grid_11';
								}
							?>

							<?php
								$_form_field = '';
								$_form_field_info = '';
								if (!empty($submissionField['type']) && $submissionField['type'] != 'file' && $submissionField['type'] != 'url'):
								$_form_field = (!empty($submissionFieldDisplay[$submissionField['form_field']])) ? $this->Html->cText(Inflector::humanize(str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $submissionFieldDisplay[$submissionField['form_field']]))) : '';
								$_form_field_info = (!empty($submissionFieldDisplay[$submissionField['form_field']])) ? $this->Html->cText(Inflector::humanize(str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $submissionFieldDisplay[$submissionField['form_field']])), false) : '';
								endif;
							?>
							<dt class="dl" title="<?php echo $_form_field_info ;?>">
								<?php echo $_form_field;?>
							</dt>
							<dd class="description-info">
								<?php if(!empty($submissionField['type']) && $submissionField['type'] != 'file' && $submissionField['type'] != 'url'){?>
									<?php
										if (!empty($submissionField['type']) && $submissionField['type'] != 'thumbnail' && empty($submissionField['response'])) {
											echo __l('None specified');
										} else {
											if(!empty($submissionField['type']) && $submissionField['type'] == 'video') {
												if ($this->Embed->parseUrl($submissionField['response'])) {
													$this->Embed->setObjectAttrib('wmode','transparent');
													$this->Embed->setObjectParam('wmode', 'transparent');
													echo $this->Embed->getEmbedCode();
												}
											} elseif(!empty($submissionField['type']) && $submissionField['type'] == 'thumbnail') {
												if (empty($submissionField['ProjectCloneThumb'])){
													echo __l('None specified');
												} else {
													$regex = '/(?<!href=["\'])http:\/\//';
													$regex1 = '/(?<!href=["\'])https:\/\//';
													$display_url = preg_replace($regex, '', $submissionField['response']);
													$display_url = preg_replace($regex1, '', $display_url);
									?>
									<div class="clone-block">
										<?php echo $this->Html->link($this->Html->showImage('ProjectCloneThumb', $submissionField['ProjectCloneThumb'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false), 'escape' => false)), $submissionField['response'], array('target'=>'_blank','escape' => false)); ?>
										<p><?php echo $this->Html->link($display_url,$submissionField['response'], array('target'=>'_blank','escape' => false));?></p>
									</div>
									<?php
												}
											} elseif (!empty($submissionField['type']) && $submissionField['type'] == 'date') {
												$convert_date = explode("\n", $submissionField['response']);
                                                if (count($convert_date) > 1):
    												$dateval = $convert_date[2].'-'.$convert_date[0].'-'.$convert_date[1];
	    											echo $this->Html->cDate($dateval);
                                                endif;
											} elseif (!empty($submissionField['type']) && $submissionField['type'] == 'datetime') {
												$convert_date = explode("\n", $submissionField['response']);
                                                if (count($convert_date) > 5):
    												$dateval = $convert_date[2].'-'.$convert_date[0].'-'.$convert_date[1].' '.$convert_date[3].':'.$convert_date[4].' '.$convert_date[5];
    												echo $this->Html->cDateTime($dateval);
                                                endif;
											} elseif (!empty($submissionField['type']) && $submissionField['type'] == 'time') {
												$convert_date = explode("\n", $submissionField['response']);
                                                if (count($convert_date) > 1):
    												$dateval = $convert_date[0].':'.$convert_date[1].' '.$convert_date[2];
	    											echo $this->Html->cTime($dateval);
                                                endif;
											} elseif (!empty($submissionField['type']) && $submissionField['type'] == 'checkbox' || $submissionField['type'] == 'multiselect') {
												$convert_val = explode("\n", $submissionField['response']);
												$textval = implode("<br/>", $convert_val);
												echo $this->Html->cHtml($textval);
											}  elseif (!empty($submissionField['type']) && $submissionField['type'] == 'slider') {
												if (!empty($submissionFieldOption[$submissionField['form_field']])) {
													$option_val = explode(',', $submissionFieldOption[$submissionField['form_field']]);
									?>
									<div class="clearfix"> <span class="grid_left"><?php echo trim($option_val[0]); ?></span>
										<div class="ui-slider grid_left ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" role="application"> <span class="arrow" title="<?php echo $submissionField['response']; ?>%" style="left: <?php echo $submissionField['response'] - 5; ?>%;"></span> <span style="width: <?php echo $submissionField['response']; ?>%;" class="ui-slider-handle ui-state-default ui-corner-all" aria-valuetext="<?php echo $submissionField['response']; ?>" aria-valuenow="<?php echo $submissionField['response']; ?>" aria-valuemax="99" aria-valuemin="0" aria-labelledby="undefined" role="slider" tabindex="0"  style="" title="<?php echo $submissionField['response']; ?>%"></span> </div>
										<span class="grid_left"><?php echo trim($option_val[1]); ?></span>
									</div>
									<?php
												}
											} elseif(!empty($submissionField['type']) && $submissionField['type'] == 'url') {
												$url_string = $submissionField['response'];
												$find_string   = 'http';
												$return = strpos($url_string, $find_string);
												if ($return === false) {
									?>
													<a href="http://<?php echo $submissionField['response']; ?>" target = "_blank" > <?php echo $submissionField['response'];?></a>
									<?php
												} else {
													echo $this->Html->link($submissionField['response'],$submissionField['response'], array('target'=>'_blank','escape' => false));
												}
											} else {
												echo $submissionField['response'];
											}
										}
									}
								?>
								</dd>
								<?php
											$j++;
										endif;
									endforeach;
								?>
							</dl>
						</div>
					</section>
				<?php endif; ?>
				<?php if(isPluginEnabled('HighPerformance')&& (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  {  ?>
				<div class="alpc {'pid':'<?php echo Configure::read('highperformance.pids'); ?>'}">

			   </div>
			   <?php } else {?>
			   <section class="clearfix">
					<?php  if(Configure::read('Project.is_fb_project_comment_enabled')){?>
						<div class="main-section" id="comments">
							<h4 class="page-header ver-space textb ver-mspace"><?php echo __l('Comments');?></h4>
							<div id="js-comment-section">
							<?php
								$comment_code = Configure::read('Project.comment_code');
								echo strtr($comment_code,array(
									'##APPID##' => Configure::read('facebook.fb_user_id'),
									'##URL##' =>Router::url(array('controller' => 'projects', 'action' => 'view', $project['Project']['slug']), true),
								));
							?>
							</div>
						</div>
					<?php } else { ?>
						<?php echo $this->element('Projects.message-discussions',array('project_id'=>$project['Project']['id'], 'cache' => array('config' => 'sec'))); ?>
					     <div id="comments">
							<?php 
							
								if (!empty($is_comment_allow) && $this->Auth->user('id')) {
									echo $this->element('Projects.message-compose',array('user'=>$project['User']['username'],'project' => $project['Project'],'projecttype_slug' => $project['ProjectType']['slug'], 'funded_id' => !empty($this->request->params['named']['funded_id'])?$this->request->params['named']['funded_id']:'', 'cache' => array('config' => 'sec')));
								}
							?>
						</div>
					<?php } ?>
				</section> &nbsp;
				<?php } ?>
			</div>
			<?php if (isPluginEnabled('ProjectUpdates')) { ?>
				<div class="tab-pane fade in active" id="updates" style="display: block;">&nbsp;</div>
			<?php } ?>
			<div id="<?php if (!empty($project['Project']['facebook_feed_url']) || Configure::read('Project.is_fb_project_comment_enabled')){ echo 'js-comment-activity-section'; } else { echo 'facebook-comments'; } ?>" data-fb_app_id="<?php echo Configure::read('facebook.app_id'); ?>" data-add_url="<?php echo Router::url(array('controller'=>'facebook_comments','action'=>'add'),true); ?>" data-delete_url="<?php echo Router::url(array('controller'=>'facebook_comments','action'=>'remove'),true); ?>/id:"></div>
			<?php if (!empty($project['Project']['facebook_feed_url']) || !empty($project['Project']['twitter_feed_url'])): ?>
				<div class="tab-pane fade in active" id="social_feeds" style="display: block;">
					<h3><?php echo __l('Stream');?></h3>
					<?php if (!empty($project['Project']['facebook_feed_url'])): ?>
						<div class="facebook-block span6 clearfix" id="js-activity-section">
							<fb:activity site="<?php echo $project['Project']['facebook_feed_url'] ?>" width="225" height="300" header="false" recommendations="false"></fb:activity>
							<div id="fb-root"></div>
						</div>
					<?php endif; ?>
					<?php if (!empty($project['Project']['twitter_feed_url'])): ?>
						<div class="span6">
							<?php $feed_username = $project['Project']['twitter_feed_url']; ?>
							<div id="twtr-widget"></div>
							<script src="//widgets.twimg.com/j/2/widget.js"></script>
							<script> new TWTR.Widget({ version: 2, type: 'profile', rpp: 4, interval: 6000, width: 250, height: 300, id: 'twtr-widget', theme: { shell: { background: '#8ec1da', color: '#ffffff'}, tweets: {background: '#ffffff', color: '#444444', links: '#1985b5'}}, features: { scrollbar: false, loop: false, live: false, hashtags: true, timestamp: true, avatars: false, behavior: 'all' }}).render().setUser('<?php echo $feed_username; ?>').start(); </script>
						</div>
					<?php endif; ?> &nbsp;
				</div>
			<?php endif; ?>
			<?php if (isPluginEnabled('Idea')):?>
				<div class="tab-pane fade in active" id="voters" style="display: block;">&nbsp;</div>
			<?php endif;?>
			<?php if (empty($projectStatus->data['is_allow_to_vote'])): ?>

					<div class="tab-pane fade in active" id="backers" style="display: block;">&nbsp;</div>
			<?php endif; ?>
			<?php  if (isPluginEnabled('ProjectFollowers')) { ?>
				<div class="tab-pane fade in active" id="followers" style="display: block;">&nbsp;</div>
			<?php } ?>
		</article>
		<?php
			if (isPluginEnabled($project['ProjectType']['name'])) {
				echo $this->element('project_fund_details',array('project'=>$project),array('plugin'=> $project['ProjectType']['name']));
			}
		?>
		</div>
	</div>
</section>
 <div id="fb-root"></div>
        <script type="text/javascript">
			window.fbAsyncInit = function() {
				FB.init({appId: '<?php echo Configure::read('facebook.app_id');?>', status: true, cookie: true, xfbml: true});
			};
			(function() {
				var e = document.createElement('script'); e.async = true;
				e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
				document.getElementById('fb-root').appendChild(e);
			}());
		</script>
</div>

<div class="modal hide fade" id="js-ajax-modal">
	<div class="modal-body"></div>
	<div class="modal-footer"><a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a></div>
</div>
<div class="modal hide fade" id="js-ajax">
	<div class="modal-header hide"></div>
	<div class="modal-body"></div>
	<div class="modal-footer"><a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a></div>
</div>