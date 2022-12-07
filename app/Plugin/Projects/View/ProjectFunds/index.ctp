<?php /* SVN: $Id: index.ctp 2879 2010-08-27 11:08:48Z sakthivel_135at10 $ */ ?>
<?php
$bakerordonor = Configure::read('project.alt_name_for_'.$project['ProjectType']['funder_slug'].'_singular_caps');
$bakersordonors = Configure::read('project.alt_name_for_'.$project['ProjectType']['funder_slug'].'_plural_caps');
?>
<div class="js-response js-manage-rewards-container">
  <div class="main-section content top-mspace">
  <h4 class="bot-space"><?php echo $bakersordonors;?></h4>
  <?php if (!empty($is_show_reward_filter) && ($project['Project']['user_id'] == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin)): ?>
  <ul class="filter-list-block unstyled row-fluid">
    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($all_count,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'project_funds','action'=>'index','project_id' => $this->request->params['named']['project_id'],'filter'=>'all'), array('class' => "pull-left no-under js-manage-rewards js-no-pjax { container:'.js-manage-rewards-container'}", 'escape' => false));?></li>
    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($given_count,false).'</span></span><span class="label label-success">' .__l('Given'). '</span>', array('controller'=>'project_funds','action'=>'index','project_id' => $this->request->params['named']['project_id'],'filter'=>'given'), array('class' => "pull-left no-under js-manage-rewards js-no-pjax { container:'.js-manage-rewards-container'}", 'escape' => false));?></li>
    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($not_given_count,false).'</span></span><span class="label label-important">' .__l('Not Given'). '</span>', array('controller'=>'project_funds','action'=>'index','project_id' => $this->request->params['named']['project_id'],'filter'=>'not_given'), array('class' => "pull-left no-under js-manage-rewards js-no-pjax { container:'.js-manage-rewards-container'}", 'escape' => false));?></li>
  </ul>
  <?php endif; ?>
  <ol class="unstyled no-mar">
    <?php
    if (!empty($projectFunds)):
      $i = 0;
      $projectStatus = array();
      foreach ($projectFunds as $projectFund):
        $class = null;
        if ($i++ % 2 == 0) {
          $class = ' altrow';
        }
  ?>
  <li class="row sep-top clearfix <?php echo $class ?>">
    <?php if (empty($projectFund['ProjectFund']['is_anonymous']) || $projectFund['User']['id'] == $this->Auth->user('id') || (!empty($projectFund['ProjectFund']['is_anonymous']) && $projectFund['ProjectFund']['is_anonymous'] == ConstAnonymous::FundedAmount)) { ?>
      <?php if(!empty($projectFund['User']['id'])) { ?>
  <div class="span2 dc top-space"><?php echo $this->Html->getUserAvatar($projectFund['User'],'medium_thumb', true, '', '', '',(isset($this->request->params['named']['modal']) && $this->request->params['named']['modal'] == "modal")?$this->request->params['named']['modal']:'');?></div>
      <?php } else { ?>
        <div class="span2 dc top-space"><div class="js-tooltip show"><?php echo $this->Html->getUserAvatar(array(), 'medium_thumb', false, 'anonymous'); ?></div></div>
      <?php } ?>
    <?php } else { ?>
      <div class="span2 dc top-space"><div class="js-tooltip show"><?php echo $this->Html->getUserAvatar(array(), 'medium_thumb', false, 'anonymous');?></div></div>
    <?php } ?>
    <div class="span">
      <div class="top-space">
        <span class="hor-space">
          <?php
            if (empty($projectFund['ProjectFund']['is_anonymous']) || $projectFund['User']['id'] == $this->Auth->user('id') || (!empty($projectFund['ProjectFund']['is_anonymous']) && $projectFund['ProjectFund']['is_anonymous'] == ConstAnonymous::FundedAmount)) {
              echo $this->Html->link($this->Html->cText($projectFund['User']['username']), array('controller'=> 'users', 'action' => 'view', $projectFund['User']['username']), array('escape' => false));
            } else {
              echo '<span class="c">'.__l('Anonymous').'</span>';
            }
          ?>
        </span>
        <span class=" pull-right">
          <?php
            $time_format = date('Y-m-d\TH:i:sP', strtotime($projectFund['ProjectFund']['created']));
          ?>
		  <i class="icon-time"></i>
          <span class="js-timestamp" title="<?php echo $time_format;?>"> <?php echo $projectFund['ProjectFund']['created']; ?></span>
        </span>
      </div>
      <div class="span12 ver-space no-mar">
        <?php if (empty($projectFund['ProjectFund']['is_anonymous'])) : ?>
          <?php if (!empty($projectFund['User']['unique_project_fund_count']) && $projectFund['User']['unique_project_fund_count'] > 1): ?>
            <?php $other_count = $projectFund['User']['unique_project_fund_count'] - 1; ?>
            <div class="clearfix hor-space"> <span><?php echo __l('Funded'). ' ';  ?></span> <?php echo $this->Html->link($this->Html->cInt($other_count, false), array('controller' => 'users', 'action' => 'view', $projectFund['User']['username'], '#project_funded'), array('class' => 'backers-icon', 'title' => $this->Html->cInt($other_count, false))); ?> <span><?php echo ' ' . sprintf(__l('other %s.'), Configure::read('project.alt_name_for_project_plural_small')); ?></span></div>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (isPluginEnabled('ProjectRewards') && $projectFund['ProjectFund']['project_type_id'] == ConstProjectTypes::Pledge && $project['Project']['project_reward_count'] > 0) { ?>
          <div class="clearfix hor-space"><?php echo !empty($projectFund['ProjectReward']['reward'])  ? $this->Html->cText($projectFund['ProjectReward']['reward']) : sprintf(__l('No %s chosen'), Configure::read('project.alt_name_for_reward_singular_small')); ?></div>
        <?php } ?>
        <?php if (!empty($projectFund['ProjectReward']['reward']) && !empty($projectFund['ProjectReward']['is_shipping']) && isPluginEnabled('Pledge')) { ?>
          <?php if ($this->Auth->user('id') == $projectFund['Project']['user_id'] || $this->Auth->user('role_id') == ConstUserTypes::Admin) { ?>
            <div class="clearfix hor-space"> <span class="textb no-mar span right-space"><?php echo __l('Shipping Address'); ?></span>
              <?php
                $location = array();
                $place = '';
                  if (!empty($projectFund['PledgeFund']['shipping_address'])) :
                  $location[] = $projectFund['PledgeFund']['shipping_address'];
                endif;
                if (!empty($projectFund['PledgeFund']['City'])) :
                  $location[] = $this->Html->cText($projectFund['PledgeFund']['City']['name'], false);
                endif;
                if (!empty($projectFund['PledgeFund']['Country']['name'])) :
                  $location[] = $projectFund['PledgeFund']['Country']['name'];
                endif;
                $place = implode(', ', $location);
                if ($place):
                  if (!empty($projectFund['PledgeFund']['Country']['iso_alpha2'])):
              ?>
              <span class="flags flag-<?php echo strtolower($projectFund['PledgeFund']['Country']['iso_alpha2']); ?>" title ="<?php echo $projectFund['PledgeFund']['Country']['name']; ?>"><?php echo $projectFund['PledgeFund']['Country']['name']; ?></span>
              <?php
                  endif;
                  echo $place;
                endif;
              ?>
            </div>
          <?php } ?>
        <?php } ?>
        <?php if(!empty($projectFund['PledgeFund']['additional_info'])) {  ?>
          <div class="clearfix hor-space"> <span class="textb"><?php echo $this->Html->cText($projectFund['ProjectReward']['additional_info_label'], false); ?></span> <?php echo $this->Html->cText($projectFund['PledgeFund']['additional_info'], false); ?> </div>
        <?php } ?>
        <?php
          if (empty($projectStatus[$projectFund['Project']['id']])) {
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
              'projectStatus' => $projectStatus,
              'project' => $projectFund,
              'type' => 'status'
            ));
            $projectStatus = $response->data['projectStatus'];
          }
        ?>
        <div class="clearfix hor-space">
          <?php if ($project['Project']['user_id'] == $this->Auth->user('id') || ($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id')) || (Configure::read('Project.is_show_backers_amount_for_guest_users')) || (Configure::read('Project.is_show_other_backers_amount_for_backers') && $backer) || $this->Auth->user('role_id') == ConstUserTypes::Admin): ?>
            <?php if (empty($projectFund['ProjectFund']['is_anonymous']) || $projectFund['User']['id'] == $this->Auth->user('id') || (!empty($projectFund['ProjectFund']['is_anonymous']) && $projectFund['ProjectFund']['is_anonymous'] == ConstAnonymous::Username)) { ?>
              <span class="pull-left"> <span class="label label-info"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($projectFund['ProjectFund']['amount'],false));?></span> </span>
            <?php } ?>
          <?php endif; ?>
          <?php if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Authorized && (($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_funder')) || ($projectFund['Project']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_owner')) || ($this->Auth->user('role_id') == ConstUserTypes::Admin)) && (strtotime('+'.Configure::read('Project.minimum_days_before_fund_cancel').' days') < strtotime($projectFund['Project']['project_end_date'].'23:59:59')) && !empty($response->data['is_allow_to_cancel_pledge'])): ?>            
              <?php
                if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Canceled) :
				  echo '<span class="pull-right label pro-status-5">';
                  echo __l('Refunded');
                else:
				  echo '<span class="pull-right">';
                  echo $this->Html->link('<i class="icon-remove"></i>'.sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_pledge_singular_caps')), array('controller'=> 'project_funds', 'action' => 'edit_fund', 'project_fund' => $projectFund['ProjectFund']['id'], 'type' => 'cancel'), array('escape' => false, 'class' => 'blackc js-confirm', 'title' => sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_pledge_singular_caps'))));
                endif;
              ?>
            </span>
          <?php endif; ?>
		   <?php if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Authorized && (($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_funder')) || ($projectFund['Project']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_owner')) || ($this->Auth->user('role_id') == ConstUserTypes::Admin)) && (strtotime('+'.Configure::read('Project.minimum_days_before_fund_cancel').' days') < strtotime($projectFund['Project']['project_end_date'].'23:59:59')) && !empty($response->data['is_allow_to_cancel_lend'])): ?>            
              <?php
                if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Canceled) :
				  echo '<span class="pull-right label pro-status-5">';
                  echo __l('Refunded');
                else:
				  echo '<span class="pull-right">';
                  echo $this->Html->link('<i class="icon-remove"></i>'.sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_lend_singular_caps')), array('controller'=> 'project_funds', 'action' => 'edit_fund', 'project_fund' => $projectFund['ProjectFund']['id'], 'type' => 'cancel'), array('escape' => false, 'class' => 'blackc js-confirm', 'title' => sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_lend_singular_caps'))));
                endif;
              ?>
            </span>
   			<?php endif; ?>
		   <?php if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Authorized && (($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_funder')) || ($projectFund['Project']['user_id'] == $this->Auth->user('id') && Configure::read('Project.is_allow_fund_cancel_by_owner')) || ($this->Auth->user('role_id') == ConstUserTypes::Admin)) && (strtotime('+'.Configure::read('Project.minimum_days_before_fund_cancel').' days') < strtotime($projectFund['Project']['project_end_date'].'23:59:59')) && !empty($response->data['is_allow_to_cancel_equity'])): ?>            
              <?php
                if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Canceled) :
				  echo '<span class="pull-right label pro-status-5">';
                  echo __l('Refunded');
                else:
				  echo '<span class="pull-right">';
                  echo $this->Html->link('<i class="icon-remove"></i>'.sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_equity_singular_caps')), array('controller'=> 'project_funds', 'action' => 'edit_fund', 'project_fund' => $projectFund['ProjectFund']['id'], 'type' => 'cancel'), array('escape' => false, 'class' => 'blackc js-confirm', 'title' => sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_invest_singular_caps'))));
                endif;
              ?>
            </span>
   			<?php endif; ?>			
          <?php if ($projectFund['Project']['user_id'] == $this->Auth->user('id') && in_array($projectFund['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount))): ?>
            <span class="pull-right"><?php echo $this->Html->link(' '.'<i class="icon-envelope"></i>'.' '.sprintf(__l('Contact %s'), $bakerordonor), array('controller' => 'projects', 'action' => 'view', $projectFund['Project']['slug'] .'/funded_id:'.$projectFund['ProjectFund']['id'].'#comments'), array('class' => 'blackc cboxelement msg js-no-pjax js-scrollto-target {\'targetid\':\'#comments\'}', 'escape' => false,'title'=>sprintf(__l('Contact %s'),$bakerordonor))); ?></span>
          <?php endif; ?>
          <?php if ($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id') && !empty($projectFund['ProjectFund']['project_reward_id']) && !empty($response->data['is_allow_to_print_voucher'])): ?>
            <span class="pull-right"><?php echo $this->Html->link(' '.'<i class="icon-print"></i>'.' '.__l('Print voucher'), array('controller' => 'project_funds', 'action' => 'view', $projectFund['ProjectFund']['id'],'type'=>'print'), array('escape' => false,'target'=>'_blank','class' => 'blackc', 'title'=>__l('Print voucher'))); ?></span>
          <?php endif; ?>
          <?php if ($projectFund['Project']['user_id'] == $this->Auth->user('id') && !empty($projectFund['ProjectFund']['project_reward_id']) && !empty($response->data['is_allow_to_change_given'])): ?>
            <span class="js-given-response js-no-pjax pull-right">
              <?php if (empty($projectFund['ProjectFund']['is_given'])): ?>
                <?php echo $this->Html->link('<i class="icon-thumbs-up"></i> ' . __l('Given'), array('controller' => 'project_funds', 'action' => 'reward_update', $projectFund['ProjectFund']['id']), array('class'=>'blackc js-given js-no-pjax {"title":"'.__l('Given').'"}','escape' => false,'title'=>__l('Given'))); ?>
              <?php else: ?>
                <?php echo $this->Html->link('<i class="icon-thumbs-down"></i> ' . __l('Not Given'), array('controller' => 'project_funds', 'action' => 'reward_update', $projectFund['ProjectFund']['id']), array('class'=>'blackc js-given js-no-pjax {"title":"'.__l('Not given').'"}','escape' => false,'title'=>__l('Not Given'))); ?>
              <?php endif; ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </li>
  <?php
      endforeach;
    else:
  ?>
  <li>
    <div class="thumbnail space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), $bakersordonors);?></p>
    </div>
  </li>
  <?php
    endif;
  ?>
</ol>
<?php if (!empty($projectFunds)) { ?>
  <div  class="top-space pull-right js-pagination js-no-pjax"> <?php echo $this->element('paging_links'); ?> </div>
<?php } ?>
<?php if (empty($this->request->params['named']['filter'])): ?>
    </div>
  </div>
<?php endif; ?>