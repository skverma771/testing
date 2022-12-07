<div class="projectFunds index js-response">
    <div class="row-fluid">
        <?php if(empty($this->request->params['named']['view_type'])) : ?>
            <section class="page-header no-mar ver-space mspace">
                <ul class="filter-list-block unstyled row-fluid">
                    <?php
                        if ($is_wallet_enabled) {
                            $project_status = "Refunded";
                        } else {
                            $project_status = "Voided";
                        }
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
                        $project_percentage = '';
                        $project_stat = '';
                        $all = $fund_count;
                    ?>
                    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($authorized_count, false).'</span></span><span class="label label-warning">' .__l('Authorized'). '</span>', array('controller'=>'pledges','action'=>'funds', 'type' => 'authorized'), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Authorized')));?></li>
                    <?php
                        //for small pie chart
                        $project_percentage .= ($project_percentage != '') ? ',' : '';
                        $project_stat .= (!empty($project_stat)) ? '|'.$link1 : $link1;
                        $project_percentage .= round((empty($authorized_count)) ? 0 : ( ($authorized_count / $all) * 100 ));
                    ?>
                    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($captured_count, false).'</span></span><span class="label label-success">' .__l('Captured'). '</span>', array('controller'=>'pledges','action'=>'funds', 'type' => 'captured'), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Captured')));?></li>
                    <?php
                        //for small pie chart
                        $project_percentage .= ($project_percentage != '') ? ',' : '';
                        $project_stat .= (!empty($project_stat)) ? '|'.$link2 : $link2;
                        $project_percentage .= round((empty($captured_count)) ? 0 : ( ($captured_count / $all) * 100 ));
                    ?>
                    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($voided_count, false).'</span></span><span class="label label-important">' .__l('Voided'). '</span>', array('controller'=>'pledges','action'=>'funds', 'type' => 'voided'), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Voided')));?></li>
                    <?php
                        //for small pie chart
                        $project_percentage .= ($project_percentage != '') ? ',' : '';
                        $project_stat .= (!empty($project_stat)) ? '|'.$link3 : $link3;
                        $project_percentage .= round((empty($voided_count)) ? 0 : ( ($voided_count / $all) * 100 ));
                    ?>
                    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($failed_count, false).'</span></span><span class="label label-info">' .__l('Failed'). '</span>', array('controller'=>'pledges','action'=>'funds', 'type' => 'failed'), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Failed')));?></li>
                    <?php
                        //for small pie chart
                        $project_percentage .= ($project_percentage != '') ? ',' : '';
                        $project_stat .= (!empty($project_stat)) ? '|'.$link : $link;
                        $project_percentage .= round((empty($failed_count)) ? 0 : ( ($failed_count / $all) * 100 ));
                    ?>
                    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($all, false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'pledges', 'action'=>'funds'), array('class' => 'pull-left no-under', 'escape' => false));?></li>
                    <li class="span2 pull-right"><?php echo $this->Html->image('http://chart.googleapis.com/chart?cht=p&amp;chd=t:'.$project_percentage.'&amp;chs=120x120&amp;chco=FFAD46|468847|8D92D6|FD66B5&amp;chf=bg,s,FF000000'); ?></li>
                </ul>
            </section>
            <ul class="nav nav-tabs mspace top-space">
                <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
            </ul>
<?php
    $placeholder = __l('Search');
    if (!empty($this->request->params['named']['q'])) {
      $placeholder = $this->request->params['named']['q'];
    }
  ?>
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
      <div class="pull-right">
      <?php echo $this->Form->create('Pledge' ,array('url' => array('controller' => 'pledges','action' => 'funds')), array('type' => 'get', 'class' => 'form-search no-mar')); ?>
      <?php echo $this->Form->input('q', array('label' => false,' placeholder' => $placeholder, 'class' => 'search-query mob-clr')); ?>
      <div class="hide">
       <?php echo $this->Form->submit(__l('Search'));?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>

<?php endif; ?>
<section class="space">
  <table class="table table-striped table-bordered table-condensed table-hover no-mar">
    <thead>
    <tr>
     <th class="dc"><?php echo __l('Action');?></th>
    <?php if(empty($this->request->params['named']['view_type'])) : ?>
    <th class="dl"><div><?php echo $this->Paginator->sort('Project.name', Configure::read('project.alt_name_for_project_singular_caps'), array('class' => 'js-no-pjax js-filter'));?></div></th>
    <?php endif;?>
    <th><div><?php echo $this->Paginator->sort('User.username', Configure::read('project.alt_name_for_backer_singular_caps'), array('class' => 'js-no-pjax js-filter'));?></div></th>
    <th class="dr"><div><?php echo __l('Paid Amount') . ' ('.Configure::read('site.currency').')';?></div></th>
    <th class="dr"><div><?php echo $this->Paginator->sort('amount', sprintf(__l('Amount to %s'), Configure::read('project.alt_name_for_pledge_project_owner_singular_caps')), array('class' => 'js-no-pjax js-filter')).' ('.Configure::read('site.currency').')';?></div></th>
    <th class="dr"><div><?php echo $this->Paginator->sort('site_fee', __l('Site Commission'), array('class' => 'js-no-pjax js-filter')).' ('.Configure::read('site.currency').')';?></div></th>
    <th class="dc"><div><?php echo $this->Paginator->sort('created', sprintf(__l('%s On'), Configure::read('project.alt_name_for_pledge_past_tense_caps')), array('class' => 'js-no-pjax js-filter'));?></div></th>
    <th><div><?php echo $this->Paginator->sort('Status', __l('Status'));?></div></th>
    <?php if (isPluginEnabled('ProjectRewards')) { ?>
      <th class="dl"><div><?php echo $this->Paginator->sort('project_reward_id', __l('Reward'), array('class' => 'js-no-pjax js-filter'));?></div></th>
      <th class="js-filter js-no-pjax dl"><?php echo sprintf(__l('%s Status'), Configure::read('project.alt_name_for_reward_singular_caps'));?></th>
    <?php } ?>
    </tr>
   </thead>
   <tbody>
<?php
if (!empty($projectFunds)):
$pledge_amount = $site_fee_amount = $paid_amount = 0;
foreach ($projectFunds as $projectFund):
  $pledge_amount += $projectFund['ProjectFund']['amount'] - $projectFund['ProjectFund']['site_fee'];
  $site_fee_amount += $projectFund['ProjectFund']['site_fee'];
  $paid_amount += $projectFund['ProjectFund']['amount'];
?>
  <tr>
     <td class="span1 dc">
    <?php if ($projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding && ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Authorized)): ?>
        <div class="dropdown top-space">
            <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
            <ul class="unstyled dropdown-menu dl arrow clearfix">
            <li>
            <?php  echo $this->Html->link('<i class="icon-remove"></i>'.sprintf(__l('Cancel %s'),Configure::read('project.alt_name_for_pledge_singular_caps')), array('controller' => 'project_funds', 'action' => 'edit_fund', 'project_fund' => $projectFund['ProjectFund']['id'], 'type' => 'cancel', 'return_page' => 'admin', 'admin' => false), array('class' => 'js-confirm','escape'=>false, 'title' => sprintf(__l('Cancel %s'),Configure::read('project.alt_name_for_pledge_singular_caps')))); ?>
            </li>
            <?php echo $this->Layout->adminRowActions($projectFund['ProjectFund']['id']);  ?>
          </ul>
        </div>
      <?php endif; ?>
    </td>
   <?php if(empty($this->request->params['named']['view_type'])) : ?>
    <td class="dl">
            <div class="clearfix">
             <?php
             if($is_wallet_enabled)
             {
              $project_status = $projectFund['Project']['Pledge']['PledgeProjectStatus']['name'];
             }
               else
               {
               $project_status = str_replace("Refunded","Voided",$projectFund['Project']['Pledge']['PledgeProjectStatus']['name']);
               }
            ?>
              <i title="<?php echo $this->Html->cText($project_status, false);?>" class="icon-sign-blank project-status-<?php echo $projectFund['Project']['Pledge']['pledge_project_status_id'];?>"></i>
            <?php echo $this->Html->link($this->Html->cText($projectFund['Project']['name']), array('controller'=> 'projects', 'action'=>'view', $projectFund['Project']['slug'],'admin' => false), array('escape' => false,'title'=>$this->Html->cText($projectFund['Project']['name'],false)));?>
            </div>
          </td>
  <?php endif; ?>
  
    <td class="dl span4">
            <div class="row-fluid">
              <div class="span8"><?php echo $this->Html->getUserAvatar($projectFund['User'], 'micro_thumb',true, '', 'admin');?></div>
              <div class="span16 vtop left-space htruncate">
			  <?php 
			  if($projectFund['ProjectFund']['guest_user_id'] == 0) {
			  echo $this->Html->getUserLink($projectFund['User']); 
				} else if(!empty($projectFund['GuestUser']) && $projectFund['ProjectFund']['guest_user_id'] != 0 && $projectFund['ProjectFund']['guest_user_id'] == $projectFund['GuestUser']['id']) {
				echo $this->Html->link($this->Html->cText($projectFund['GuestUser']['name']), array('controller'=> 'guest_users', 'action'=>'view', $projectFund['GuestUser']['id'],'admin' => true), array('escape' => false,'title'=>$this->Html->cText($projectFund['GuestUser']['name'],false))); ?>
				<br><span class="label label-success"><?php echo __l('Guest User'); ?></span>
			<?php }  ?>
			  </div>
            </div>
          </td>
        <td class="dr"><?php echo $this->Html->cCurrency($projectFund['ProjectFund']['amount']);?></td>

        <td class="dr">
         <?php echo $this->Html->cCurrency($projectFund['ProjectFund']['amount'] - $projectFund['ProjectFund']['site_fee']); ?>

        </td>
        <td class="dr"><?php echo $this->Html->cCurrency($projectFund['ProjectFund']['site_fee']);?></td>


           <td class="dc"><?php echo $this->Html->cDateTimeHighlight($projectFund['ProjectFund']['created']);?></td>

         <td>
        <?php
          $refund = __l('Funded');
            if($projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding) {
              $refund = Configure::read('project.alt_name_for_pledge_past_tense_caps');
            } else {
              $refund = __l('Funded');
            }
          if ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::PaymentFailed) {
            $refund = __l('Failed');
            $class = ' class="hide js-faild"';
          } elseif ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::PaymentFailed) {
            $refund = __l('Canceled');
            $class = ' class="hide js-faild"';
         } elseif ($projectFund['ProjectFund']['project_fund_status_id'] == ConstProjectFundStatus::Canceled) {
              $refund = 'Refunded';
            $refund = $refund;
          }
          echo $refund;
        ?>
      </td>
      <?php if (isPluginEnabled('ProjectRewards')) { ?>
        <td class="dl">
            <?php
                if ($projectFund['ProjectFund']['project_reward_id'] == 0) :
                    echo __l('n/a');
            ?>
            <?php else: ?>
                <div class="htruncate-ml2 js-tooltip" title="<?php echo Configure::read('site.currency') . $this->Html->cText($projectFund['ProjectReward']['pledge_amount'], false).' + '.$this->Html->cText($projectFund['ProjectReward']['reward'], false); ?>">
                    <?php echo Configure::read('site.currency').$this->Html->cText($projectFund['ProjectReward']['pledge_amount']).' + '.$this->Html->cText($projectFund['ProjectReward']['reward']); ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($projectFund['ProjectReward']['estimated_delivery_date']) && !empty($projectFund['ProjectReward']['is_shipping']) && $projectFund['ProjectReward']['is_shipping']) : ?>
              <span class="blackc textb"><?php echo __l('Estimated Delivery Date: ').$this->Html->cDate($projectFund['ProjectReward']['estimated_delivery_date']); ?></span>
            <?php endif; ?>
        </td>
        <td class="dc">
        <?php
          $reward = '';
          if (!empty($projectFund['ProjectFund']['project_reward_id']) && ($projectFund['Project']['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::FundingClosed || $projectFund['Project']['Pledge']['pledge_project_status_id']== ConstPledgeProjectStatus::GoalReached) && empty($projectFund['ProjectFund']['is_given'])):
            $reward = __l('Not received');?>
          <?php endif; ?>
          <?php if (!empty($projectFund['ProjectFund']['is_given'])):
            $reward = __l('Received');?>
          <?php endif; ?>
          <?php if(empty($reward)) {
            $reward = __l('n/a');
          }
        ?>
          <p><span><?php echo $reward; ?></span></p>
        </td>
      <?php } ?>
  </tr>
<?php
  endforeach;
  ?>
    <?php
else:
?>
  <tr>
    <td colspan="9" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s Funds available'), Configure::read('project.alt_name_for_project_singular_caps'));?></td>
  </tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($projectFunds)) : ?>
<div class="pull-right">
   <?php  echo $this->element('paging_links'); ?>
</div>
<?php endif;?>
</section>
</div>