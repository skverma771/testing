<?php Configure::write('highperformance.pids', $project['Project']['id']); ?>
<div class="list-block">
  <ol class="thumbnails row idea-list">
    <?php if (!empty($project)): ?>
      <li class="pr over-hide  pull-left">
        <div class="thumbnail">
          <div class="pr">
            <?php echo $this->Html->link($this->Html->showImage('Project', $project['Attachment'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false))), array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false, 'target' => '_blank', 'class' => 'js-no-pjax')); ?>
            <div class="clearfix trans-bg ver-space cat-pos pa <?php echo  $project['ProjectType']['slug']; ?>">
              <?php
                $response = Cms::dispatchEvent('View.Project.displaycategory', $this, array(
                  'data' => $project,
                  'class' => 'whitec js-no-pjax',
                  'target' => '_blank'
                ));
              ?>
              <?php if (!empty($response->data['content'])) { ?>
                <span class="pull-left hor-space cur"><?php echo $response->data['content'];?></span>
              <?php } ?>
              <?php if($project['Project']['is_featured']): ?>
                <span class="label hor-mspace label-info pull-right btn-module"><?php echo __l('Featured');?></span>
              <?php endif;?>
            </div>
          </div>
          <?php
            $projectStatus = array();
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
              'projectStatus' => $projectStatus,
              'project' => $project,
              'type'=> 'status',
            ));
          ?>
          <?php if (!empty($response->data['is_allow_to_vote']) || !empty($response->data['is_show_vote'])) { ?>
            <div class="embed-list-content list-content pr">
              <h5 class="top-mspace bot-space htruncate">
                <?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words']),array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false, 'target'=>'_blank', 'title' => $this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words'])));?>
              </h5>
              <p class="htruncate">
                <?php echo __l('by')?> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('escape' => false, 'target'=>'_blank', 'title' => $this->Html->cText($project['User']['username'], false)));?>
                <span class="top-space no-mar">
                  <?php
                    $location = array();
                    $place = '';
                    if (!empty($project['City'])) :
                      if (isset($project['City']['name']) && !empty($project['City']['name'])) {
                        $location[] = $project['City']['name'];
                      }
                    endif;
                    if (!empty($project['Country']['name'])) :
                      $location[] = $project['Country']['name'];
                    endif;
                    $place = implode(', ', $location);
                    if ($place) :
                      echo $this->Html->link('<i class="icon-map-marker"></i>' .$place, array('controller' => 'projects', 'action' => 'index', 'city'=>$project['City']['slug'], 'type' => 'home'), array('escape' => false, 'target'=>'_blank'));
                    endif;
                  ?>
                </span>
              </p>
              <div class="ver-space sep-top">
                <div class="row-fluid top-space top-smspace">
                  <div class="span7 pull-left no-mar">
                    <p class="no-mar"><strong><?php echo __l('Needed') ?></strong></p>
                    <?php $needed_amount = !empty($project['Project']['needed_amount'])?$this->Html->cCurrency($project['Project']['needed_amount']):'' ?>
                    <span title="<?php echo $this->Html->cInt($needed_amount, false);?>" class="c"><?php echo Configure::read('site.currency').$needed_amount ; ?></span>
                  </div>
                  <div class="span7 pull-left no-mar">
                    <p class="no-mar"><strong><?php echo __l('Votes') ?></strong></p>
                    <span title="<?php echo $this->Html->cInt($project['Project']['total_ratings'], false);?>" class="js-idea-vote-count-<?php echo $project['Project']['id']; ?> vote-count-value"><?php echo $this->Html->cInt($project['Project']['total_ratings']);?></span>
                  </div>
                </div>
              </div>
              <div class="ver-space">
                <ul class="unstyled well ver-space clearfix no-mar no-round">
                  <?php
                    $i = 1;
                    $rating_count = !empty($project['ProjectRating']) ? count($project['ProjectRating']) : 0;
                    $rated_users=array();
                    $extra = $rating_count - 3;
                    foreach($project['ProjectRating'] as $projectrating) {
                      array_push($rated_users, $projectrating['user_id']);
                      if ($i <= 3) {
                  ?>
                  <li class="span no-mar">
                    <?php
                      if (!empty($projectrating['user_id'])) {
                        echo $this->Html->getUserAvatar($projectrating['User'], 'micro_thumb');
                      } else {
                        echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                      }
                    ?>
                  </li>
                  <?php
                      }
                      $i++;
                    }
                    if ($rating_count < 4) {
                  ?>
                  <?php if (empty($response->data['is_not_show_you_here'])) { ?>
                    <li class="more span1 thumbnail dc pull-left grayc"><span class="show">
					<?php
						if($project['Project']['user_id'] == $this->Auth->user('id')){
							echo __l('X');
						} else {
							echo __l('You');
						}
					?>	
					</span><?php echo __l('Here');?></li>
                  <?php } ?>
                  <?php
                    }
                    if ($rating_count > 3) {
                  ?>
                  <li class="more span1 thumbnail dc pull-left"><?php echo '+' . $extra . ' ' . __l('More') . ' &#187;';?></li>
                  <?php } ?>
                </ul>
              </div>
              <div class="trans-bg embed-list-details list-details pr dc">
                <div class="row clearfix over-details top-space">
                  <div class="space mspace span5">
                    <div class="clearfix space top-mspace dropdown">
                      <?php if (!empty($project['ProjectFollower'])): ?>
                        <?php echo $this->Html->link(__l('Unfollow'), array('controller' => 'project_followers', 'action' => 'delete', $project['ProjectFollower'][0]['id']),array('class' => "btn span4 ver-mspace dc js-no-pjax js-tooltip js-ajax-statchange js-no-pjax",'data-addtitle'=>"Unfollow", 'data-addlabel'=>"Unfollow", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'), 'target' => '_blank')); ?>
                      <?php else: ?>
                        <?php echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => "btn span4 ver-mspace dc js-tooltip js-ajax-statchange js-no-pjax",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow'), 'target' => '_blank')); ?>
                      <?php endif; ?>
                    </div>
					 <?php
					  $rate_msg = "";
						if($project['Project']['user_id'] == $this->Auth->user('id')){
							$rate_msg = __l('Disabled. Reason: You can\'t rate your own project.');
						}
						if(in_array($this->Auth->user('id'),$rated_users))
						{
							$rate_msg =  __l('Disabled. Reason: You have already rated this project.');
						}
					  ?>
                    <div class="clearfix dropdown">
                      <?php if( $project['Project']['user_id'] == $this->Auth->user('id')): ?>
                        <div class="pull-left hor-mspace vote-container" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                          <?php if (isPluginEnabled('Idea')): ?>
                            <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                              <?php
                                $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>0,'is_view'=>0, 'project_type' => $project['ProjectType']['name'], 'rate_msg' => $rate_msg, 'target' => '_blank','class' => 'js-no-pjax'));
                              ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php  else: ?>
					  
                        <?php $canrate =(!in_array($this->Auth->user('id'),$rated_users)) ? 1 : 0; ?>
                        <div class="pull-left hor-mspace vote-container" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                          <?php if (isPluginEnabled('Idea')): ?>
                            <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                              <?php
                                $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>$canrate, 'is_view' => 0, 'project_type' => $project['ProjectType']['name'], 'rate_msg' => $rate_msg, 'target' => '_blank', 'class' => 'js-no-pjax'));
                              ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="embed-list-content list-content pr">
              <h5 class="top-mspace bot-space htruncate">
                <?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name']), $project['Project']['detected_suspicious_words']),array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false, 'class' => 'js-no-pjax', 'target' => '_blank', 'title' => $this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'], false), $project['Project']['detected_suspicious_words'])));?>
              </h5>
              <p class="htruncate">
                <?php echo __l('by')?> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('escape' => false, 'title' => $this->Html->cText($project['User']['username'], false), 'target' => '_blank', 'class' => 'js-no-pjax'));?>
                <span class="top-space no-mar">
                  <?php
                    $location = array();
                    $place = '';
                    if (!empty($project['City'])) :
                      if (isset($project['City']['name']) && !empty($project['City']['name'])) {
                        $location[] = $project['City']['name'];
                      }
                    endif;
                    if (!empty($project['Country']['name'])) :
                      $location[] = $project['Country']['name'];
                    endif;
                    $place = implode(', ', $location);
                    if ($place) :
                  ?>
                  <?php echo $this->Html->link('<i class="icon-map-marker"></i>' . $place, array('controller' => 'projects', 'action' => 'index', 'city' => $project['City']['slug']), array('escape' => false, 'target' => '_blank', 'class' => 'js-no-pjax')); ?>
                  <?php endif; ?>
                </span>
              </p>
              <?php
                if (isPluginEnabled($project['ProjectType']['name'])) {
                  echo $this->element('project_listing',array('project' => $project), array('plugin' => $project['ProjectType']['name']));
                }
                $fund_count = $project['Project']['project_fund_count'];
                $extra = $fund_count - 3;
              ?>
              <ul class="unstyled well ver-space clearfix no-mar no-round">
                <?php
                  $i = 1;
                  foreach($project['ProjectFund'] as $projectFund){
                    if ($i <= 3) {
                ?>
                <li class="span no-mar">
                  <?php
                    if (empty($projectFund['is_anonymous']) || $projectFund['user_id'] == $this->Auth->user('id') || (!empty($projectFund['is_anonymous']) && $projectFund['is_anonymous'] == ConstAnonymous::FundedAmount)) {
                      if(!empty($projectFund['user_id'])) {
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
                <?php } ?>
              </ul>
              <?php if(!$project['Project']['is_admin_suspended']):?>
                <div class="trans-bg embed-list-details list-details pr">
                  <div class="row over-details top-space">
                    <div class="space mspace span5">
                      <div class="clearfix space top-mspace dropdown">
                        <?php if (!empty($project['ProjectFollower'])): ?>
                          <?php echo $this->Html->link(__l('Unfollow'), array('controller' => 'project_followers', 'action' => 'delete', $project['ProjectFollower'][0]['id']),array('class' => "btn show ver-mspace js-tooltip js-ajax-statchange js-no-pjax clearfix dc widget-btn-height",'data-addtitle'=>"Unfollow", 'data-addlabel'=>"Unfollow", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'), 'target' => '_blank', 'class' => 'js-no-pjax')); ?>
                        <?php else: ?>
                          <?php echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => "btn span4 ver-mspace js-tooltip js-ajax-statchange js-no-pjax clearfix dc  widget-btn-height",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow'), 'target' => '_blank')); ?>
                        <?php endif; ?>
                      </div>  <?php 
						if(!empty($response->data['is_allow_to_fund']) && ($this->Auth->user('id') != $project['Project']['user_id'])){?>
							<div class="clearfix space ver-mspace <?php echo  $project['ProjectType']['slug']; ?>">
								<a href="<?php echo Router::url(array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id']), true); ?>" target="blank" class="btn btn-module ver-mspace dc span4 js-tooltip"><?php echo $project['ProjectType']['name']; ?></a>
							</div>
						<?php }?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php } ?>
        </div>
      </li>
    <?php else: ?>
      <li>
		<div class="space dc grayc">
			<p class="ver-mspace top-space text-16"><?php  echo sprintf(__l('No %s available'), Configure::read('project.alt_name_for_project_plural_caps'));?></p>
		</div>
	</li>
    <?php endif; ?>
  </ol>
</div>