<style>
    .videos-extra {
        /* display: none; */
        margin-top: 21px;
    }
    .videos-extra .video-container {
        margin-bottom: 15px;
    }
    #ajax-tab-container-project .span9 .space {
        padding-top: 0 !important;
        margin-top: 0 !important
    }
    .common-banner-block-none > .container .thumbnail {
        margin: 0 10px !important
    }
    #ajax-tab-container-project .span9 .unstyled.row {
        margin-top: 10px !important
    }
    #ajax-tab-container-project .span9 .unstyled.row .pull-left:first-child {
        margin-left: 0 !important
    }
</style>

<aside class="span9">
  <div class="well space">
  <?php if ($project['Pledge']['pledge_project_status_id'] != ConstPledgeProjectStatus::OpenForIdea ){ ?>
  <section class="thumbnail bot-mspace">
    <div class="row no-mar">
    <div class="span2 no-mar dc">
      <h2 class="linkc"><span title="<?php echo $this->Html->cInt($project['Project']['project_fund_count'], false);?>" class="c"><?php echo $this->Html->cInt($project['Project']['project_fund_count']);?></span></h2>
      <p><?php echo Configure::read('project.alt_name_for_backer_plural_caps');?></p>
    </div>
    <?php } ?>
    <?php if ($project['Pledge']['pledge_project_status_id'] != ConstPledgeProjectStatus::OpenForIdea ){ ?>
    <div class="span4 dc">
      <h2 class="linkc"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($project['Project']['collected_amount'],false));?></h2>
      <p><?php echo sprintf(__l('%s of'),Configure::read('project.alt_name_for_pledge_singular_caps')) . ' '.$this->Html->siteCurrencyFormat($this->Html->cCurrency($project['Project']['needed_amount'],false)) . ' ' . __l('goal'); ?> </p>
    </div>
    <div class="span2 dc">
      <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::FundingClosed || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::Pending){ ?>
      <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached){?>
      <?php if (!empty($project[0]['enddate']) && round($project[0]['enddate']) > 0) { ?>
      <h2 class="linkc"> <span title="<?php echo $this->Html->cInt($project[0]['enddate'], false); ?>" class="c"><?php echo $this->Html->cInt($project[0]['enddate']); ?></span></h2>
      <?php } else { ?>
      <h2 class="linkc js-countdown"> <span title="<?php echo $project[0]['endhour'];?>" class=""><?php echo $project[0]['endhour'];?></span></h2>
      <?php } ?>
      <p><?php echo (round($project[0]['enddate']) > 0) ?__l('Days to go') : __l('Hours to go'); ?></p>
      <?php } ?>
      <?php } ?>
    </div>
    </div>
    <hr class="no-mar"/>
<div class="row no-mar">
  <div class="span6">
    <p class="space grayc">
      <?php
        if (date('Y', strtotime($project['Project']['project_end_date'])) > date('Y') ) {
          $projectEndDate = strftime('%A %b %d %Y, %I:%M %p', strtotime($project['Project']['project_end_date']));
        } else {
          $projectEndDate = strftime('%A %b %d, %I:%M %p', strtotime($project['Project']['project_end_date']));
        }
        if (empty($project['Pledge']['is_allow_over_funding'])):
          $project_end_date = $project['Pledge']['project_fund_goal_reached_date'];
        else:
          $project_end_date = $project['Project']['project_end_date'];
        endif;
        if(!$project['Project']['is_admin_suspended']):
          if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached):
            if ($project['Project']['needed_amount'] != 0):
              if ($project['Project']['collected_amount'] >= $project['Project']['needed_amount'] && !empty($project['Pledge']['is_allow_over_funding'])):
                echo sprintf(__l('Goal Reached, but it allows for over funding and this %s will be closed on'), Configure::read('project.alt_name_for_project_singular_small')) . ' <span title="' . strftime(Configure::read('site.datetime.tooltip'), strtotime($project['Project']['project_end_date'])) . '">' . $projectEndDate . ' ' . date('T') . '</span>';
              else:
				if($project['Project']['payment_method_id'] == ConstPaymentMethod::KiA) :
					echo sprintf(__l('This %s received all of its funded amount by %s'), Configure::read('project.alt_name_for_project_singular_small'), '<span title="' . strftime(Configure::read('site.datetime.tooltip'), strtotime($project['Project']['project_end_date'])) . '">' . $projectEndDate . ' ' . date('T') . '</span>');
				else:
					// echo sprintf(__l('This %s will only be funded if at least %s is pledged by %s'), Configure::read('project.alt_name_for_project_singular_small'), $this->Html->siteCurrencyFormat($this->Html->cCurrency($project['Project']['needed_amount'], false)), '<span title="' . strftime(Configure::read('site.datetime.tooltip'), strtotime($project['Project']['project_end_date'])) . '">' . $projectEndDate . ' ' . date('T') . '</span>');
                    echo sprintf("This 'Buskerdues' Project will be closed for funding on %s, at which time project funds will be released to this busker.", '<span title="' . strftime(Configure::read('site.datetime.tooltip'), strtotime($project['Project']['project_end_date'])) . '">'.$projectEndDate .' '. date('T') . '</span>');
                endif;
              endif;
            endif;
          elseif($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::FundingClosed):
            if($project['Project']['payment_method_id'] == ConstPaymentMethod::KiA) :
              echo sprintf(__l('This %s received all of its funded amount %s'), Configure::read('project.alt_name_for_project_singular_small'), $this->Time->timeAgoInWords($project_end_date));
            else :
              echo sprintf(__l('This %s successfully raised its funding goal %s'), Configure::read('project.alt_name_for_project_singular_small'), $this->Time->timeAgoInWords($project_end_date));
            endif;
          endif;
        endif;
      ?>
    </p>
  </div>
  <div class="span2 pull-right no-mar mob-clr">
      <?php
          /* Chart block */
          $collected_percentage = ($project['Project']['collected_percentage']) ? $project['Project']['collected_percentage'] : 0;
          $needed__percentage = 0;
          if($collected_percentage < 100){
            $needed__percentage = 100-$collected_percentage;
          }
          echo $this->Html->image('https://chart.googleapis.com/chart?cht=p&amp;chd=t:'.$collected_percentage.','.$needed__percentage.'&amp;chs=70x70&amp;chco=00AFEF|C1C1BA&amp;chf=bg,s,FF000000', array('title' => __l('Collected') . ': ' . $collected_percentage.'%'));
          /* Chart block ends*/
        ?>
    </div>
    </div>
  </section>
  <?php } ?>
  <?php if (isPluginEnabled('Idea') && $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForIdea) :?>
  <section class="thumbnail bot-mspace">
    <div class="row no-mar">
    <div class="span2 no-mar dc">
      <h2 class="linkc"><span class="b-color js-idea-vote-count-<?php echo $project['Project']['id']; ?> vote-count-value"><?php echo $this->Html->cInt($project['Project']['total_ratings']); ?></span> </h2>
      <p class ="textb"><?php echo __l('Votes'); ?></p>
    </div>
    <div class="span2 dc">
      <h2 class="linkc"><span class="b-color js-idea-voters-count"><?php echo $this->Html->cInt($project['Project']['project_rating_count']);?></span></h2>
      <p class ="textb"><?php echo __l('Voters'); ?></p>
    </div>
    <div class="span3 dc">
      <h2 class="linkc"><span class="b-color js-idea-rating-count">
      <?php
                       if($project['Project']['project_rating_count']!=0)
                       {
                        $average_rating = $project['Project']['total_ratings']/$project['Project']['project_rating_count'];
                        echo $this->Html->cFloat($average_rating);
                       }
                       else
                       {
                        echo $this->Html->cFloat(0);
                       }
                      ?>
      </span> </h2>
      <p class ="textb"><?php echo __l('Average votes'); ?></p>
    </div>
    </div>
    <hr class="no-mar"/>
    <p class="grayc"> <?php echo __l('This idea will only be listed for funding only if at least enough voters support it. Admin will move top votes ideas to projects based on number of votes.');?> </p>
  </section>
  <?php endif;?>
  <section class="bot-space">
  <h3  class="text-16 dc ver-space label project-status">
  <?php
    $projectStatus = array();
    $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
        'projectStatus' => $projectStatus,
        'project' => $project,
        'type'=> 'status'
      ));
    $projectStatus = $response->data['projectStatus'];
	$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
									  'status_id' => $projectStatus[$project['Project']['id']]['id'],
									  'project_type_id' => $project['Project']['project_type_id']
									));
	if($status_response->data['response']){
		echo $reason =  $status_response->data['response'];
	}
	else{
		echo __l('Draft');
	}
  ?>
  </h3>
  </section>
  <?php if ($project['Project']['payment_method_id'] == ConstPaymentMethod::KiA && Configure::read('Project.is_project_owner_select_funding_method')): ?>
  <section class="bot-space">
  <h3  class="text-16 dc ver-space label label-info"><?php echo __l('Flexible Funding'); ?><i class="js-tooltip icon-question-sign hor-space" title="<?php echo sprintf(__l('%s fund will be captured even if it does not reached the needed amount'), Configure::read('project.alt_name_for_project_singular_caps')); ?>"></i></h3>
  </section>
  <?php endif; ?>
  <?php if ($project['Pledge']['pledge_project_status_id'] != ConstPledgeProjectStatus::OpenForIdea ){ ?>
  <?php
    $more= ($project['Pledge']['pledge_type_id']!=ConstPledgeTypes::Fixed && $project['Pledge']['pledge_type_id']!=ConstPledgeTypes::Reward) ? __l('or more') : '';
    if (($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached || ConstPledgeProjectStatus::FundingClosed) && !$project['Project']['is_admin_suspended'] && !empty($project['ProjectReward']) && isPluginEnabled('ProjectRewards')) { ?>
  <section class="thumbnail bot-mspace">
    <ol class="unstyled over-block clearfix">
    <?php
        $i=0;
        foreach ($project['ProjectReward'] as $projectReward){ ?>
    <?php
            $i++;
            $limit_flag = 0;
            $reward_class = 'disabled';
          if ($projectReward['pledge_max_user_limit'] > $projectReward['project_fund_count'] || empty($projectReward['pledge_max_user_limit'])){
            $limit_flag = 1;
            $reward_class = '';
          }
          if(count($project['ProjectReward']) != $i){
          $reward_class.= " sep-bot";
          }
          ?>
    <li class="pr over-hide <?php echo $reward_class;?>">
      <section class="clearfix list-content">
      <div class="clearfix">
        <h5 class="space pull-left span4 htruncate no-mar js-tooltip" title="<?php echo Configure::read('project.alt_name_for_pledge_singular_caps') .  ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($projectReward['pledge_amount'],false),false)  .' ' . __l('or more'); ?>"><?php echo Configure::read('project.alt_name_for_pledge_singular_caps') .  ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($projectReward['pledge_amount'], false), false)  .' ' . __l('or more'); ?></h5>
        <?php $project_fund_count = !empty($projectReward['project_fund_count'])?$projectReward['project_fund_count']:'0'; ?>
        <div class="pull-right mspace"><span class="label label-info pull-right"><?php echo !empty($projectReward['pledge_max_user_limit'])? __l('Limited').' ('.$project_fund_count.'/'.$projectReward['pledge_max_user_limit'].')': __l('Unlimited'); ?></span></div>
      </div>
      <p class="hor-mspace desc-cont over-hide"><span><?php echo $this->Html->cText($this->Html->truncate($projectReward['reward']), false);?></span></p>
      <p class="hor-mspace bot-space">
      <?php if(!empty($projectReward['estimated_delivery_date']) && !empty($projectReward['is_shipping']) && $projectReward['is_shipping']): ?>
      <span class="textb"><?php echo __l('Estimated delivery date') . ': ';?></span><?php echo $this->Html->cDate($projectReward['estimated_delivery_date']);?>
      <?php else: ?>
      &nbsp;
      <?php endif; ?>
      </p>
      <?php  echo $this->element('backers', array('project_id' => $project['Project']['id'], 'reward_id' => $projectReward['id'], 'project_type' => $project['ProjectType']['name'], 'backer_view' => 'compact')); ?>
      <?php if ($project['User']['id'] !=  $this->Auth->user('id')) :  ?>
      <?php if(($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached) && !$project['Project']['is_admin_suspended'] && !empty($limit_flag)):?>
      <section class="list-details trans-bg pr">
       <?php
	  if ($this->Auth->sessionValid()) {
	  ?>
        <div class="hor-mspace pa">
        <div class="space hor-mspace clearfix pledge"> <?php echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'project_funds', 'action' => 'add', $project['Project']['id'], 'project_reward_id' => $projectReward['id']), array('title' => Configure::read('project.alt_name_for_pledge_singular_caps'),'class'=>'btn btn-module offset4 span2 js-tooltip js-no-pjax', 'escape' => false)); ?> </div>
        </div>
	 <?php
	 }
	 else {
	 ?>
	 <div class="hor-mspace pa">
        <div class="space hor-mspace clearfix pledge"> <?php echo $this->Html->link(Configure::read('project.alt_name_for_pledge_singular_caps'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false), array('title' => Configure::read('project.alt_name_for_pledge_singular_caps'),'class'=>'btn btn-module offset4 span2 js-tooltip', 'escape' => false)); ?> </div>
        </div>
	 <?php
	 }
	 ?>
      </section>

      <?php  endif;
            endif; ?>
    </section>
    </li>
    <?php } ?>
    </ol>
  </section>
  <?php } ?>
  <?php }?>
  <section class="clearfix sep-bot sep-top top-space">
    <h5 class="bot-mspace" itemtype="http://schema.org/Organization" itemscope itemprop="headline"><?php echo sprintf(__l('%s by'), Configure::read('project.alt_name_for_project_singular_caps'));?></h5>
    <div class="row no-mar">
    <div class="span no-mar"> <?php echo $this->Html->getUserAvatar($project['User'], 'normal_thumb'); ?> </div>
    <div class="span5 hor-space">
      <p class="no-mar"> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller'=> 'users', 'action' => 'view', $project['User']['username']), array('title' => $project['User']['username'], 'escape' => false, 'itemtype' =>'http://schema.org/Organization', 'itemscope' => '', 'itemprop' =>'name'));?> </p>
      <p class="no-mar" itemscope itemtype="http://schema.org/interactionCount" itemprop="attendees"><strong><?php echo $project_count;?></strong><?php echo __l(' Projects posted'); ?></p>
      <p class="no-mar" itemscope itemtype="http://schema.org/interactionCount" itemprop="attendees"><strong><?php echo $project['User']['unique_project_fund_count'];?></strong><?php echo __l(' Projects funded'); ?></p>
	  <?php if(isPluginEnabled('ProjectFollowers')):?>
      <p class="no-mar" itemscope itemtype="http://schema.org/interactionCount" itemprop="attendees"> <?php echo __l('Following ');?> <strong><?php echo $project_following_count;?></strong> <?php echo __l(' project(s)'); ?> </p>
	  <?php endif;?>
    </div>
    </div>
    <address class="row" itemtype="http://schema.org/Organization" itemscope>
    <?php
        $userLocation = array();
        if (!empty($project['User']['UserProfile']['City'])) :
          $userLocation[] = $this->Html->cText($project['User']['UserProfile']['City']['name'],false);
        endif;
        if (!empty($project['User']['UserProfile']['Country'])) :
          $userLocation[] = $this->Html->cText($project['User']['UserProfile']['Country']['name'],false);
        endif;
        $userplace = implode(', ', $userLocation);
        if ($userplace) :
      ?>
    <span class="span pull-left "><i class="icon-map-marker"></i><span title="<?php echo $userplace; ?>" itemprop="location"><?php echo ' ' . $userplace; ?></span></span>
    <?php if ($project['User']['id'] !=  $this->Auth->user('id')) {  ?>
    <span class="pull-right">
    <?php
            if($this->Auth->user('id')):
              echo $this->Html->link('<i class="icon-envelope"></i>'.__l(' Send message'), array('controller' => 'projects', 'action' => 'view',$project['Project']['slug'] . '/#comments'), array('class' => 'js-send-message js-no-pjax cboxelement msg msg1 panel-link', 'rel' => '#comments', 'escape' => false,'title'=>__l('send message'), 'itemprop' => 'email'));
            endif;
          ?>
    </span>
    <?php } ?>
    <?php endif; ?>
    </address>
  </section>
  <?php if (isPluginEnabled('ProjectFollowers')) { ?>
  <section class="clearfix top-space sep-bot">
    <?php  echo $this->element('followers', array('project_id' => $project['Project']['id']), array('plugin' => 'ProjectFollowers')); ?>
  </section>
  <?php } ?>
  <section class="clearfix top-space"> <?php echo $this->element('project-activities', array('project_id' => $project['Project']['id'], 'project_type'=>$project['Project']['project_type_id'], 'cache' => array('config' => 'sec', 'key' => $project['Project']['id'])));?> </section>
  <?php if (Configure::read('widget.project_script')) { ?>
  <section class="clearfix top-space sep-bot">
    <div class="dc clearfix bot-space"> <?php echo Configure::read('widget.project_script'); ?> </div>
  </section>
  <?php } ?>
  </div>

  <div class="videos-extra">
    <?php for($i=3;$i<6;$i++): ?>
    <?php echo $this->Embed->hotFixEmbed($project['Project']['video_url_'.$i]); ?>
    <?php endfor; ?>
  </div>
</aside>
