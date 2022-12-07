<div class="js-response js-activities">
  <?php
    if (empty($this->request->params['named']['user_id'])) { ?>
		<div class="js-response bot-space clearfix">
			<?php  echo $this->element('update_email_notification'); ?>
		</div>
  <?php } ?>
  <section class="thumbnail clearfix bot-mspace">
    <?php if (!empty($messages)): ?>
      <?php $projectStatus = array();?>
        <article class="row span24">
          <ul class="thumbnails over-block1 row">
            <?php
              $i = 0;
              end($messages);
              $last = key($messages);
              reset($messages);
              foreach ($messages as $key=>$message):
                $separtor = '';
                if ($key != $last) {
                  $separtor = ' sep-bot';
                }
                $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                  'projectStatus' => $projectStatus,
                  'project' => $message,
                  'type'=> 'status'
                ));
                $projectStatus = $response->data['projectStatus'];
            ?>
            <?php
				if (!isPluginEnabled('Idea') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectRating) {
					continue;
				} elseif (!isPluginEnabled('ProjectUpdates') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate) {
					continue;
				} elseif (!isPluginEnabled('ProjectUpdates') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment) {
					continue;
				} elseif (!isPluginEnabled('ProjectFollowers') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower) {
					continue;
				}
            ?>
			  <?php
				$project['Project'] = $message['Project'];
				$project['ProjectType'] = $message['Project']['ProjectType'];
				$category_response = Cms::dispatchEvent('View.Project.displaycategory', $this, array(
				  'data' => $project,
				  'class'=> 'whitec'
				));
			  ?>
			 <?php if(!empty($message['ActivityMessage']['MessageContent']['is_admin_suspended'])){
				 continue;
			  } ?>
            <li class="pr no-mar<?php echo $separtor . " " . $project['ProjectType']['slug']; ?>">
              <section class="row ver-space">
                <div class="span10 list-content sep-right pr">
                  <h5 class="bot-space clearfix"><?php echo $this->Html->link($this->Html->cText($message['Project']['name'],false), array('controller'=> 'projects', 'action' => 'view', $message['Project']['slug']), array('class' => 'no-mar span6 htruncate js-tooltip', 'escape' => false, 'title' => $this->Html->cText($message['Project']['name'],false)));?>
                  <span class="span2 htruncate label pull-right hor-mspace js-tooltip" title="<?php echo $this->Html->cText($category_response->data['content'],false);?>"><?php echo $this->Html->cText($category_response->data['content'],false);?></span></h5>
                  <div class="row">
                    <div class="span4 pull-left">
                      <?php echo $this->Html->link($this->Html->showImage('Project', $message['Project']['Attachment'], array('dimension' => 'very_small_big_thumb', 'class' => 'js-tooltip',  'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($message['Project']['name'], false)), 'title' => $this->Html->cText($message['Project']['name'], false)),array('aspect_ratio'=>1)), array('controller' => 'projects', 'action' => 'view',  $message['Project']['slug'], 'admin' => false), array('escape' => false));?>
                    </div>
                    <div class="span6">
                      <div class="row no-mar bot-space">
                        <div class="span no-mar">
                          <?php $collected_percentage = ($message['Project']['collected_percentage']) ? $message['Project']['collected_percentage'] : 0; ?>
                          <p class="no-mar"><strong><?php echo __l('funded'); ?></strong></p>
                          <span class="c" title="<?php echo $this->Html->cInt($collected_percentage, false); ?>"><?php echo $this->Html->cInt($collected_percentage);?></span><?php echo '%';?>
                        </div>
                        <div class="span">
                          <p class="no-mar"><strong>
                            <?php
							  echo Configure::read('project.alt_name_for_'.$project['ProjectType']['slug'].'_past_tense_small');
                            ?>
                          </strong></p>
                          <?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($message['Project']['collected_amount'],false)); ?>
                        </div>
                        <div class="span">
						<?php
						if(!empty($message['Project']['project_end_date'])):
						$time_strap= strtotime($message['Project']['project_end_date']) -strtotime( date('Y-m-d'));
						$days = floor($time_strap /(60*60*24));
						if ($days > 0) {
						  $message[0]['enddate'] = $days;
						} else {
						  $message[0]['enddate'] =0;
						}
						endif;
						$end_time = intval(strtotime($message['Project']['project_end_date']) - time());
						?>
                          <p class="no-mar"><strong><?php echo (round($message[0]['enddate']) >0) ? __l('days to go') : __l('hours to go');?></strong></p>
						  <?php if(!empty($message[0]['enddate']) && round($message[0]['enddate']) > 0){
						echo $this->Html->cInt($message[0]['enddate']) . " ";
						}else{
						?>
						<span title="<?php echo 0;?> " class="js-time">0</span>
						<?php
						}
						?>
                        </div>
                      </div>
                      <div class="hor-space">
                        <div class="progress row progress-mini progress-module progress2">
                          <div class="bar" style="width:<?php echo ($collected_percentage > 100) ? '100%' : $collected_percentage.'%'; ?>;" title = "<?php echo $this->Html->cFloat($collected_percentage,false).'%'; ?>"></div>
                        </div>
                      </div>
                      <?php
                        $fund_count = count($message['Project']['ProjectFund']);
                        $extra = $fund_count - 3;
                      ?>
                      <ul class="unstyled row no-pad clearfix">
                        <?php
                          $i = 1;
                          foreach($message['Project']['ProjectFund'] as $projectFund) {
                            if ($i <= 3) {
                        ?>
						<li class="span pull-left">
						<?php
                            if (in_array($projectFund['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $projectFund['user_id'] == $this->Auth->user('id')) {
                              if (!empty($projectFund['user_id'])) {
                                echo $this->Html->getUserAvatar($projectFund['User'], 'micro_thumb');
                              } else {
                                echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                              }
                            } else {
                              echo $this->Html->getUserAvatar(array(),'micro_thumb',false,'anonymous');
                            }
                          ?>
                        </li>
                        <?php
                            }
                            $i++;
                          }
                          if ($fund_count < 4) {
                        ?>
                        <li class="more span1 thumbnail dc pull-left grayc"><span class="show">
							<?php
								if($project['Project']['user_id'] == $this->Auth->user('id')){
									echo __l('X');
								} else {
									echo __l('You');
								}
							?>
							</span><?php echo __l('Here');?></li>
                        <?php
                          }
                          if ($fund_count > 3) {
                        ?>
                        <li class="more span1 thumbnail dc pull-left"><?php echo '+' . $extra . ' ' . __l('More') . ' &#187;';?></li>
                        <?php
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                  <section class="trans-bg pr list-details">
                    <div class="row over-details">
                      <div class="span10">
                        <div class="space bot-mspace">
                          <div class="row">
                          <?php
                          $follow_class = 'offset1';
                          if (!empty($response->data['is_allow_to_vote']) || !empty($response->data['is_show_vote'])) {
                            $follow_class = 'hor-space hor-mspace';
                          } ?>
                            <span class="<?php echo $follow_class; ?> pull-left span bot-space hor-space">
                              <?php
                                if (isPluginEnabled('ProjectFollowers')) {
                                  if ($this->Auth->sessionValid()):
                                    if (!empty($projectFollowers) && in_array($message['Project']['id'], $projectFollowers)) {
                                      echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $projectFollowerIds[$message['Project']['id']]), array('class' => "btn span3 no-mar dc js-tooltip  js-unfollow",'escape' => false,'data-addtitle'=>"Following", 'data-addlabel'=>"Following", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow')));
                                    } else {
                                      $redirect_url = Router::url(array(
                                        'controller' => 'project_followers',
                                        'action' => 'add',
                                        $project['Project']['id']
                                      ), true);
                                      echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => 'btn span3 dc no-mar js-tooltip', 'title'=>__l('Follow')));
                                    }
                                  else:
                                    if (!empty($response->data['is_allow_to_follow'])) {
                                      echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'btn span3 dc no-mar js-tooltip', 'title' => __l('Follow')));
                                    }
                                  endif;
                                }
                              ?>
                            </span>
                            <?php
                              if (!empty($response->data['is_allow_to_vote']) || !empty($response->data['is_show_vote'])) {
                            ?>
                            <span class="pull-left hor-space">
                            <?php
                              $project_type = $project['ProjectType']['name'];
                              $rating_count = !empty($message['ProjectRating']) ? count($message['ProjectRating']) : 0;
                            ?>
                              <?php if( $project['Project']['user_id'] == $this->Auth->user('id')): ?>
                                <div class="pull-left vote-container" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                                  <?php if (isPluginEnabled('Idea')): ?>
                                    <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                                      <?php
                                        $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                        echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>0,'is_view'=>0, 'project_type' => $project_type ));
                                      ?>
                                    </div>
                                  <?php endif; ?>
                                </div>
                              <?php  else: ?>
                                <?php $canrate = ($message['ProjectRating']['rating'] > 0 ) ? 0 : 1; ?>
                                <div class="pull-left vote-container" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                                  <?php if (isPluginEnabled('Idea')): ?>
                                    <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                                      <?php
                                        $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                        echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>$canrate,'is_view'=>0, 'project_type' => $project_type ));
                                      ?>
                                    </div>
                                  <?php endif; ?>
                                </div>
                              <?php endif; ?>
                            </span>
                            <?php } else { ?>
                            <?php
								if (!empty($response->data['is_allow_to_fund'])): ?>
                              <?php if (($this->Auth->user('id') != $project['Project']['user_id']) || Configure::read('Project.is_allow_owner_fund_own_project')): ?>
                                  <span class="pull-left hor-space">
                                    <a href="<?php echo Router::url(array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), true); ?>" class="btn btn-module dc span3 no-mar js-tooltip" title="<?php echo Configure::read('project.alt_name_for_'.$project['Project']['ProjectType']['slug'].'_singular_caps'); ?>"> <?php echo Configure::read('project.alt_name_for_'.$project['Project']['ProjectType']['slug'].'_singular_caps'); ?></a>
                                  </span>
                                <?php else: ?>
                                  <span class="pull-left hor-space">
                                    <span class="disabled btn btn-module dc span3 no-mar js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: You can\'t %s your own %s.'), Configure::read('project.alt_name_for_'.$project['Project']['ProjectType']['slug'].'_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?>"><?php echo Configure::read('project.alt_name_for_'.$project['Project']['ProjectType']['slug'].'_singular_caps');?></span>
                                  </span>
                                <?php endif; ?>
                              <?php else :
								$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
									  'status_id' => $projectStatus[$project['Project']['id']]['id'],
									  'project_type_id' => $project['Project']['project_type_id']
									));
								$reason =  $status_response->data['response'];
                                ?>
                                <span class="pull-left hor-space">
                                  <span class="disabled btn btn-module dc span3 no-mar js-tooltip" title="<?php echo sprintf(__l('Disabled. Reason: %s.'),  $reason); ?>"><?php echo Configure::read('project.alt_name_for_'.$project['Project']['ProjectType']['slug'].'_singular_caps');?></span>
                                </span>
                              <?php endif; ?>
                           <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
				<div class="span13 no-mar">
				<div class="clearfix">
				<div class="span">
				   <span class="clearfix show">
                    <?php
						$pledgeordonate = Configure::read('project.alt_name_for_'.$project['ProjectType']['slug'].'_singular_caps');
						$fundordonate = sprintf(__l('Opened for %s'), Configure::read('project.alt_name_for_'.$project['ProjectType']['slug'].'_present_continuous_small'));
					?>
                        <?php if ($message['Message']['activity_id'] == ConstProjectActivities::Fund): ?>
                        <?php echo  Configure::read('project.alt_name_for_'.$project['ProjectType']['funder_slug'].'_past_tense_caps');?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate): ?>
                          <?php echo __l('Update Posted'); ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment): ?>
                          <?php echo __l('Commented on Update');  ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectRating): ?>
                          <?php echo __l('Voted'); ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectComment): ?>
                          <?php echo __l('Commented on Project'); ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower): ?>
                          <?php echo __l('Started Following'); ?>
						  <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::AmountRepayment): ?>
                          <?php echo __l('Amount repayment'); ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::FundCancel): ?>
                          <?php echo sprintf(__l('%s Canceled'), $pledgeordonate); ?>
                        <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::StatusChange): ?>
                          <?php
							$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
							  'status_id' => $message['Message']['project_status_id'],
							  'project_type_id' => $message['Project']['project_type_id']
							));
						    echo $reason =  $status_response->data['response'];
                          ?>
                    <?php endif; ?>
                  </span>
				</div>
				<div class="no-mar dropdown clearfix pull-right">
                    <?php
                      $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
                    ?>
                    <a href="#" class="hor-mspace pull-right show btn btn-mini dropdown-toggle js-no-pjax js-tooltip tooltiper no-under" data-toggle="dropdown" title = "<?php echo __l('Settings'); ?>"><i class="icon-cog text-16"></i><span class="hide"><?php echo __l('Settings');?></span> <span class="caret"></span></a>
                    <span class="js-timestamp pull-right show" title="<?php echo $time_format;?>"><?php echo $message['Message']['created']; ?></span>
                    <ul class="unstyled dropdown-menu arrow arrow-right dl clearfix">
					<?php if (isPluginEnabled('SocialMarketing')): ?>
                      <li>
                        <?php
                          if ($this->Auth->sessionValid()) {
                            if (($message['Message']['activity_id'] != ConstProjectActivities::Fund || ($message['Message']['activity_id'] == ConstProjectActivities::Fund && (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $message['ActivityUser']['id'] == $this->Auth->user('id')))) && !empty($message['ActivityUser']['id']) && $message['ActivityUser']['id'] != $this->Auth->user('id')) {
                              if (!empty($userFollowers) && in_array($message['ActivityUser']['id'], $userFollowers)) {
                                echo $this->Html->link('<i class="icon-remove"></i> '.__l('Unfollow User'), array('controller' => 'user_followers', 'action' => 'delete', $userFollowerIds[$message['ActivityUser']['id']]), array('class' => 'js-confirm js-add-remove-followers js-tooltip', 'escape' => false,'title'=>__l('Unfollow User')));
                              } else {
                                echo $this->Html->link('<i class="icon-ok"></i> '.__l('Follow User'), array('controller' => 'user_followers', 'action' => 'add', $message['ActivityUser']['username']), array('class' => 'js-confirm js-add-remove-followers js-tooltip', 'escape' => false,'title'=>__l('Follow User')));
                              }
                            }
                          } else {
                            echo $this->Html->link('<i class="icon-ok"></i> '.__l('Follow User'), array('controller' => 'user_followers', 'action' => 'add', $message['ActivityUser']['username']), array('class' => 'js-confirm js-add-remove-followers js-tooltip', 'escape' => false,'title'=>__l('Follow User')));
                          }
                        ?>
                      </li>
					  <?php endif; ?>
                      <?php if (isPluginEnabled('ProjectFollowers')): ?>
                      <li>
                        <?php
                          if ($this->Auth->sessionValid()):
                            if (!empty($projectFollowers) && in_array($message['Project']['id'], $projectFollowers)) {
                              echo $this->Html->link('<i class="icon-remove"></i> '.__l('Unfollow Project'), array('controller' => 'project_followers', 'action' => 'delete', $projectFollowerIds[$message['Project']['id']]),array('class' => 'js-confirm js-add-remove-followers js-tooltip', 'title' => __l('Unfollow Project'), 'escape' => false));
                            } else {
                              echo $this->Html->link('<i class="icon-ok"></i> '.__l('Follow Project'), array('controller' => 'project_followers', 'action' => 'add', $message['Project']['id']),array('class' => 'add_follower js-add-remove-followers js-tooltip', 'title' => __l('Follow Project'), 'escape' => false));
                            }
                          else:
                            if (!empty($response->data['is_allow_to_follow'])) {
                              echo $this->Html->link('<i class="icon-ok"></i>'.__l('Follow Project'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('class' => 'add_follower js-tooltip', 'title' => __l('Follow Project'), 'escape' => false));
                            }
                          endif;
                        ?>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </div>
				  </div>
				<div class="clearfix">
                <div class="span12 pr activities-share <?php echo  $message['Project']['ProjectType']['slug']; ?>">
                  <?php if (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::Username)) || $message['ActivityUser']['id'] == $this->Auth->user('id')) { ?>
                    <?php
                      if ($message['Message']['activity_id'] == ConstProjectActivities::Fund) {
                        if (!empty($message['ProjectFund']['ProjectReward']) && isPluginEnabled('ProjectRewards')) {
                    ?>
                      <div class="htruncate-ml2 js-tooltip" title="<?php echo $this->Html->cText($message['ProjectFund']['ProjectReward']['reward'], false); ?>"><?php echo '<span class="textb">' . Configure::read('project.alt_name_for_reward_singular_caps') . ': ' . '</span>' . $message['ProjectFund']['ProjectReward']['reward']; ?></div>
                      <?php if(!empty($message['ProjectFund']['ProjectReward']['estimated_delivery_date']) && !empty($message['ProjectFund']['ProjectReward']['is_shipping']) && $message['ProjectFund']['ProjectReward']['is_shipping']) : ?>
                        <div class="blackc textb"><?php echo __l('Estimated Delivery Date: ') . $this->Html->cDate($message['ProjectFund']['ProjectReward']['estimated_delivery_date']); ?></div>
                      <?php endif; ?>
                      <?php } ?>
                      <div class="clearfix">
                        <span class="label label-info"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($message['ProjectFund']['amount'],false)); ?></span>
                      </div>
                    <?php } ?>
                  <?php } ?>
                  <?php if ($message['Message']['activity_id'] == ConstProjectActivities::ProjectRating) { ?>
                    <span><?php echo isset($message['ProjectRating']['rating']) ? $this->Html->cInt($message['ProjectRating']['rating'],false): '0';echo ' '. __l('Vote(s)'); ?></span>
                  <?php } ?>
                  <?php if ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate): ?>
                    <?php

                      $redirect_url = Router::url(array(
                        'controller' => 'blogs',
                        'action' => 'view',
                        'from' => 'activity',
                        $message['Blog']['slug']
                      ), true);
                    ?>
                    <span><?php echo $this->Html->cHtml($this->Html->truncate($message['Blog']['content'])); ?></span>
                    <a data-target="#myModal1" href="<?php echo $redirect_url; ?>" role="button" data-toggle="modal" class="js-no-pjax"><?php echo __l('more..');?></a>
                  <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment): ?>
                    <?php
                      $redirect_url = Router::url(array(
                        'controller' => 'blogs',
                        'action' => 'view',
                        'from' => 'activity',
                        $message['BlogComment']['Blog']['slug'],
						'modal' => 'modal'
                      ), true);
                    ?>
                    <div class="htruncate-ml2 js-tooltip" title="<?php echo $this->Html->cText($message['BlogComment']['comment'], false); ?>"><?php echo $this->Html->cText($message['BlogComment']['comment'], false); ?></div>
                    <a data-target="#myModal1" href="<?php echo $redirect_url; ?>" role="button" data-toggle="modal" class="js-no-pjax"><?php echo __l('View update');?></a>
                    <?php if ($this->Auth->sessionValid() && !empty($message['BlogComment']['blog_id'])): ?>
					   <?php echo $this->element('blog-comments', array('blog_id' => $message['BlogComment']['blog_id'] ,'message_type' => !empty($this->request->params['named']['user_id']) ? 'userview' : 'dashboard','redirect_username' => $user['User']['username']));?>
                    <?php endif; ?>
                  <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectComment): ?>
                    <div class="htruncate-ml2 js-tooltip" title="<?php echo $this->Html->cText($message['ActivityMessage']['MessageContent']['message'], false); ?>"><?php echo $this->Html->cText($message['ActivityMessage']['MessageContent']['message'], false); ?></div>
                    <?php if ($this->Auth->sessionValid() && $message['Message']['activity_user_id'] != $this->Auth->user('id')): ?>
					   <?php echo $this->element('compose-message', array('message_id' => $message['Message']['id'] ,'user' => $message['OtherUser']['username'], 'project_id' => $message['Project']['id'], 'root' => $message['Message']['root'], 'message_type' => !empty($this->request->params['named']['user_id']) ? 'userview' : 'dashboard', 'redirect_username' => $user['User']['username'], 'm_path' => $message['Message']['materialized_path']));?>
                    <?php endif; ?>
                  <?php elseif (isPluginEnabled('SocialMarketing') && in_array($message['Message']['activity_id'], array(ConstProjectActivities::Fund, ConstProjectActivities::ProjectFollower))): ?>
                    <div class="dropdown pa cat-pos">
                      <?php
                        if($message['Message']['activity_id'] == ConstProjectActivities::Fund) {
                          $action = 'fund';
                        } else if($message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower) {
                          $action = 'follow';
                        }
                        $share_link = Router::url(array(
                          'controller' => 'social_marketings',
                          'action' => 'publish',
                          $message['Message']['foreign_id'],
                          'type' => 'facebook',
                          'publish_action' => $action,
                        ) , false);
                      ?>
                      <a class="btn btn-small span"  href="<?php echo $share_link; ?>"><i class="icon-share"></i> <?php echo __l('Share');?> </a>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="dr mob-clr clearfix no-mar <?php echo !empty($this->request->params['named']['user_id'])?'pull-right':'';?>" >
                  <?php if($message['Message']['activity_id'] != ConstProjectActivities::StatusChange) { ?>
                    <ul class="unstyled row pull-right">
                      <li class="pull-right hor-space top-mspace">
                        <?php
						  if ($message['Message']['activity_id'] == ConstProjectActivities::AmountRepayment){
							  echo $this->Html->getUserAvatar($message['User'], 'micro_thumb');
						  } else if ($message['Message']['activity_id'] != ConstProjectActivities::Fund || ($message['Message']['activity_id'] == ConstProjectActivities::Fund && (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $message['ActivityUser']['id'] == $this->Auth->user('id')))) {
                            if (!empty($message['ActivityUser']['id'])) {
                              echo $this->Html->getUserAvatar($message['ActivityUser'], 'micro_thumb');
                            } else {
                              echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                            }
                          } else {
                            echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                          }
                        ?>
                      </li>
                    </ul>
                  <?php } ?>
                </div>
				</div>
				</div>
              </section>
            </li>
          <?php endforeach;?>
        </ul>
      </article>
    <?php else : ?>
      <ol class="unstyled space no-pad no-mar">
        <li>
        <div class="thumbnail space dc grayc">
        <p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No activities available'));?></p>
        </div>
      </li>
      </ol>
    <?php endif;?>
  </section>
  <?php if (!empty($messages)) { ?>
    <div class="pull-right mob-clr top-mspace">
      <div class="paging clearfix js-pagination js-no-pjax">
        <?php echo $this->element('paging_links'); ?>
      </div>
    </div>
  <?php } ?>
  <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header hide"></div>
    <div class="modal-body js-social-link-div clearfix">
      <div class="dc">
	  <?php echo $this->Html->image('ajax-circle-loader.gif', array('alt' => __l('[Image:Loader]') ,'width' => 100, 'height' => 100, 'class' => 'js-loader')); ?></div>
    </div>
	<div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
  </div>