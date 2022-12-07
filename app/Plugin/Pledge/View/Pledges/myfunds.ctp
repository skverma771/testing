<?php /* SVN: $Id: index.ctp 2879 2010-08-27 11:08:48Z sakthivel_135at10 $ */ ?>
<?php if (!$this->request->params['isAjax']) { ?>

<div class="js-response">
  <?php } ?>
  <div class="bot-mspace clearfix pledge-block" id="js-pledge-scroll" itemtype="http://schema.org/Product" itemscope>
  <div class="pull-left circ space3 row offset1 pledge-status img-circle dc whitec" itemprop="Name"> <span class="show dc top-space"><?php echo $this->Html->image('pledge-hand.png', array('width' => 50, 'height' => 50)); ?></span><?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?> </div>
  <h4 class="pledgec ver-space span"><?php echo sprintf(__l('My %s'), Configure::read('project.alt_name_for_pledge_plural_caps')); ?></h4>
  </div>
  <div class="clearfix">
    <div class="alert alert-info ver-space"><span class="hor-mspace"><?php echo __l('Print reward voucher option will be available in funded projects'); ?></span></div>

  <?php
    if ($is_wallet_enabled) {
      $link1 = "Backed";
      $link2 = "Refunded";
      $link3 = 'Funded';
      $link ="Refunded";
    } else {
      $link1 = "Authorized";
      $link2 = "Voided";
      $link3 = 'Captured';
      $link ="Voided";
    }
  ?>
  <ul class="filter-list-block unstyled row-fluid">
    <li class="pull-left dc hor-space"> <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($fund_count,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'pledges','action'=>'myfunds', 'status' => 'all'), array('class' => 'js-filter js-no-pjax pull-left no-under', 'escape' => false));?> </li>
    <li class="pull-left dc hor-space"> <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($backed_count,false).'</span></span><span class="label label-warning">' .$link1. '</span>', array('controller'=>'pledges','action'=>'myfunds'), array('class' => 'js-filter js-no-pjax pull-left no-under', 'escape' => false));?> </li>
    <li class="pull-left dc hor-space"> <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($refunded_count,false).'</span></span><span class="label label-info">' .$link2. '</span>', array('controller'=>'pledges','action'=>'myfunds','status'=>'refunded'), array('class' => 'js-filter js-no-pjax pull-left no-under', 'escape' => false));?> </li>
    <li class="pull-left dc hor-space"> <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($paid_count,false).'</span></span><span class="label label-success">' .$link3. '</span>', array('controller'=>'pledges','action'=>'myfunds','status'=>'paid'), array('class' => 'js-filter js-no-pjax pull-left no-under', 'escape' => false));?> </li>
  </ul>
  </div>
  <?php  echo $this->element('paging_counter'); ?>
  <table class="table table-striped table-bordered table-condensed table-hover">
  <tr>
    <th class="dc"><?php echo __l('Actions');?></th>
    <th class="js-filter dl"><?php echo Configure::read('project.alt_name_for_project_singular_caps');?></th>
    <th class="js-filter dc"><div class="js-filter"><?php echo __l('Collected');?></div>
    / <?php echo __l('Needed Amount'). ' (' . Configure::read('site.currency') . ')';?></th>
    <th class="js-filter dr"><?php echo __l('Amount') . ' (' . Configure::read('site.currency') . ')' ;?></th>
    <th class="dc"><?php echo __l('Payment Status');?></th>
    <th class="js-filter js-no-pjax dc"><?php echo sprintf(__l('%s On'),Configure::read('project.alt_name_for_pledge_past_tense_caps'));?></th>
    <?php if (isPluginEnabled('ProjectRewards')) { ?>
    <th class="dl"><?php echo Configure::read('project.alt_name_for_reward_singular_caps');?></th>
    <th class="dl"><?php echo sprintf(__l('%s Status'), Configure::read('project.alt_name_for_reward_singular_caps'));?></th>
    <?php } ?>
  </tr>
  <?php
    if (!empty($projectFunds)):
      $i = 0;
      foreach ($projectFunds as $projectFund):
        $class = null;
        if ($i++ % 2 == 0) {
          $class = ' class="altrow"';
        }
        $refund = __l('Funded');
          if($projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding) {
            $refund = Configure::read('project.alt_name_for_pledge_past_tense_caps');
          } else {
            $refund = __l('Funded');
          }
        if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::PaymentFailed) {
          $refund = __l('Failed');
          $class = ' class="altrow hide js-faild"';
        } elseif ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::PaymentFailed) {
          $refund = __l('Canceled');
          $class = ' class="altrow hide js-faild"';
		} elseif ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Canceled) {
            $refund = 'Refunded';
          if($projectFund['ProjectFund']['is_canceled_from_gateway']) {
            $refund.= '(From Gateway)';
          }
          $refund = $refund;
        }
    ?>
  <tr<?php echo $class;?>>
    <td class="span1 dc"><div class="dropdown top-space"> <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
      <?php
          if ($projectFund['ProjectFund']['user_id'] == $this->Auth->user('id') && (Configure::read('Project.is_allow_fund_cancel_by_funder')) && (strtotime('+'.Configure::read('Project.minimum_days_before_fund_cancel').' days') < strtotime($projectFund['Project']['project_end_date'].'23:59:59'))  && $projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding): ?>
	<?php  if ($projectFund['ProjectFund']['project_fund_status_id'] != ConstProjectFundStatus::Expired && $projectFund['ProjectFund']['project_fund_status_id'] != ConstProjectFundStatus::Canceled) :
          $link = sprintf(__l('Cancel %s'), Configure::read('project.alt_name_for_pledge_singular_caps'));
              $type = 'cancel'; ?>
      <li> <?php echo $this->Html->link('<i class="icon-remove"></i>'.$link, array('controller'=> 'project_funds', 'action' => 'edit_fund', 'project_fund' => $projectFund['ProjectFund']['id'], 'type' => $type, 'return_page' => 'mydonations'), array('escape' => false,'class' => 'cancel js-confirm','title'=>$link,'escape'=>false)); ?> </li>
      <?php  endif;
          endif; ?>
      <li> <?php echo $this->Html->link('<i class="icon-user"></i>'.sprintf(__l('Contact %s'), Configure::read('project.alt_name_for_pledge_project_owner_singular_small')), array('controller' => 'projects', 'action' => 'view', $projectFund['Project']['slug'] . '#comments'), array('class' => 'cboxelement msg', 'escape' => false,'title' => sprintf(__l('Contact %s'), Configure::read('project.alt_name_for_project_owner_singular_small')))); ?> </li>
      <?php if (isPluginEnabled('ProjectRewards')) { ?>
      <?php if (!empty($projectFund['ProjectFund']['project_reward_id']) && $projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::FundingClosed && empty($projectFund['ProjectFund']['is_given']) ): ?>
      <li>
        <?php  echo $this->Html->link('<i class="icon-print"></i><span>'.__l('Print voucher').'</span>', array('controller' => 'project_funds', 'action' => 'view', $projectFund['ProjectFund']['id'],'type'=>'print'), array('escape' => false,'target'=>'_blank','title'=>__l('Print voucher'), 'class' => 'print-voucher', 'escape'=>false)); ?>
      </li>
      <?php endif; ?>
      <?php } ?>
      </ul>
    </div></td>
    <td class="dl"><?php
          if($is_wallet_enabled) {
            $project_status = $projectFund['Project']['Pledge']['PledgeProjectStatus']['name'];
          } else {
            $project_status = str_replace("Refunded","Voided",$projectFund['Project']['Pledge']['PledgeProjectStatus']['name']);
          }
        ?>
    <i title="<?php echo $this->Html->cText($project_status, false);?>" class="icon-sign-blank project-status-<?php echo $projectFund['Project']['Pledge']['pledge_project_status_id'];?>"></i> <?php echo $this->Html->link($this->Html->cText($projectFund['Project']['name']), array('controller'=> 'projects','action' => 'view', $projectFund['Project']['slug']), array('class' => 'cboxelement', 'escape' => false,'title'=> $this->Html->cText($projectFund['Project']['name'],false)));?> </td>
    <td class="dr pledge"><?php $collected_percentage = ($projectFund['Project']['collected_percentage']) ? $projectFund['Project']['collected_percentage'] : 0; ?>
    <div class="progress progress-mini progress-module">
      <div style="width:<?php echo ($collected_percentage > 100) ? '100%' : $collected_percentage.'%'; ?>;" title = "<?php echo $this->Html->cFloat($collected_percentage, false).'%'; ?>" class="bar"></div>
    </div>
    <p class="dc"><?php echo $this->Html->cCurrency($projectFund['Project']['collected_amount']); ?> / <?php echo $this->Html->cCurrency($projectFund['Project']['needed_amount']); ?></p></td>
    <td class="dr"><?php echo $this->Html->cCurrency($projectFund['ProjectFund']['amount']);?></td>
    <td class="dc"><?php echo $this->Html->cText($refund);?></td>
    <td class="dc"><?php echo $this->Html->cDateTimeHighlight($projectFund['ProjectFund']['created']);?></td>
    <?php if (isPluginEnabled('ProjectRewards')) { ?>
    <td class="dl"><span class="rewarded"><?php echo $this->Html->cText(!empty($projectFund['ProjectReward']['reward'])?$this->Html->truncate($projectFund['ProjectReward']['reward'], 150): sprintf(__l('No %s selected'), Configure::read('project.alt_name_for_reward_singular_small')));?></span>
    <?php
      if (!empty($projectFund['ProjectReward']['reward']) && !empty($projectFund['ProjectReward']['is_shipping']) && $projectFund['ProjectReward']['is_shipping']) {
        echo '<span class="blackc help textb">'.__l('Estimated Delivery Date: ').$this->Html->cDate($projectFund['ProjectReward']['estimated_delivery_date']).'</span>';
      }
    ?>
    </td>
    <td class="dc"><?php
          $reward = '';
          if (!empty($projectFund['ProjectFund']['project_reward_id']) && ($projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::FundingClosed || $projectFund['Project']['Pledge']['pledge_project_status_id']== ConstPledgeProjectStatus::GoalReached) && empty($projectFund['ProjectFund']['is_given'])):
            $reward = __l('Not received');?>
    <?php endif; ?>
    <?php if (!empty($projectFund['ProjectFund']['is_given'])):
          $reward = __l('Received');?>
    <?php endif; ?>
    <?php if(empty($reward)) {
            $reward = __l('n/a');
          }?>
    <p><span><?php echo $reward; ?></span></p></td>
    <?php } ?>
  </tr>
  <?php
      endforeach;
    else:
  ?>
  <tr>
    <td colspan="8" class="errorc space">
	  <div class="space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), Configure::read('project.alt_name_for_pledge_plural_caps'));?></p>
	  </div>
	</td>
  </tr>
  <?php
    endif;
  ?>
  </table>
  <?php if (!empty($projectFunds)) { ?>
  <div class="clearfix">
  <div class=" pull-right paging js-pagination js-no-pjax {'scroll':'js-pledge-scroll'}"> <?php echo $this->element('paging_links'); ?> </div>
  </div>
  <?php } ?>
  <?php if (!$this->request->params['isAjax']) { ?>
</div>
<?php } ?>
