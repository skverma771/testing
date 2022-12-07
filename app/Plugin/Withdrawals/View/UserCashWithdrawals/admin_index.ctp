<?php /* SVN: $Id: admin_index.ctp 69575 2011-10-25 05:50:05Z sakthivel_135at10 $ */ ?>
<div class="row-fluid">
  <section class="page-header no-mar ver-space">
    <ul class="filter-list-block unstyled row-fluid">
      <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($pending,false).'</span></span><span class="label pro-status-6">' .__l('Pending'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Pending), array('class' => 'pull-left no-under', 'escape' => false));?></li>
      <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($rejected,false).'</span></span><span class="label label-important">' .__l('Rejected'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Rejected), array('class' => 'pull-left no-under', 'escape' => false));?></li>
      <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($success,false).'</span></span><span class="label label-success">' .__l('Success'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Success), array('class' => 'pull-left no-under', 'escape' => false));?></li>
      <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($approved + $pending + $rejected + $success ,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?></li>
    </ul>
  </section>
  <?php if($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved): ?>
    <div class="alert alert-info">
      <?php echo __l('Following withdrawal request has been submitted to payment gateway API, These are waiting for IPN from the payment gateway API. Either it will move to Success or Failed'); ?>
    </div>
  <?php endif; ?>
  <section class="space clearfix">
    <div class="pull-left hor-space">
      <?php echo $this->element('paging_counter');?>
    </div>
  </section>
  <?php echo $this->Form->create('UserCashWithdrawal' , array('action' => 'update', 'class' => 'js-shift-click js-no-pjax')); ?> <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <thead>
        <tr>
          <?php if(isset($this->request->params['named']['filter_id']) && ($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending)):?>
            <th class="select dc"><?php echo __l('Select'); ?></th>
          <?php endif;?>
          <th class="dc"><?php echo __l('Actions'); ?></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('User.username', __l('User'));?></div></th>
          <th class="dr"><div><?php echo $this->Paginator->sort('UserCashWithdrawal.amount', __l('Amount')).' ('.Configure::read('site.currency').')';?> </div></th>
          <?php if(empty($this->request->params['named']['filter_id'])) { ?>
            <th><div><?php echo $this->Paginator->sort('WithdrawalStatus.name', __l('Status'));?></div></th>
          <?php } ?>
          <th class="dr"><div><?php echo $this->Paginator->sort('UserCashWithdrawal.created', __l('Withdraw Requested Date'));?> </div></th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (!empty($userCashWithdrawals)):
            foreach ($userCashWithdrawals as $userCashWithdrawal):
        ?>
        <tr>
          <?php if(isset($this->request->params['named']['filter_id']) && ($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending)):?>
            <td class="select dc">
              <?php echo $this->Form->input('UserCashWithdrawal.'.$userCashWithdrawal['UserCashWithdrawal']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userCashWithdrawal['UserCashWithdrawal']['id'], 'label' => false, 'class' => 'js-checkbox-list ' )); ?>
            </td>
          <?php endif;?>
          <td class="span1 dc">
            <div class="dropdown top-space">
              <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
              <ul class="unstyled dropdown-menu dl arrow clearfix">
                <li><?php echo $this->Html->link('<i class="icon-remove"></i>' . __l('Delete'), array('action' => 'delete', $userCashWithdrawal['UserCashWithdrawal']['id']), array('class' => 'js-confirm ', 'escape' => false, 'title' => __l('Delete')));?></li>
                <?php if($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved): ?>
                  <li><?php echo $this->Html->link('<i class="icon-hdd"></i> ' . __l('Move to success'), array('action' => 'move_to', $userCashWithdrawal['UserCashWithdrawal']['id'], 'type' => 'success'), array('escape' => false, 'title' => __l('Move to success')));?></li>
                  <li><?php echo $this->Html->link('<i class="icon-remove-sign"></i> ' . __l('Move to failed'), array('action' => 'move_to', $userCashWithdrawal['UserCashWithdrawal']['id'], 'type' => 'failed'), array('class' => '', 'escape' => false, 'title' => __l('Move to failed')));?></li>
                <?php endif;?>
                <?php echo $this->Layout->adminRowActions($userCashWithdrawal['UserCashWithdrawal']['id']);  ?>
              </ul>
            </div>
          </td>
          <td class="dl">
            <?php echo $this->Html->showImage('UserAvatar', $userCashWithdrawal['User']['UserAvatar'], array('dimension' => 'micro_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($userCashWithdrawal['User']['username'], false)), 'title' => $this->Html->cText($userCashWithdrawal['User']['username'], false)));?>
            <?php echo $this->Html->link($this->Html->cText($userCashWithdrawal['User']['username']), array('controller'=> 'users', 'action'=>'view', $userCashWithdrawal['User']['username'],'admin' => false), array('title'=>$this->Html->cText($userCashWithdrawal['User']['username'],false),'escape' => false));?>
            <?php
			  if($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending):
					foreach($userCashWithdrawal['User']['MoneyTransferAccount'] as $moneyTransferAccount):
					if(!empty($moneyTransferAccount['is_default'])):
				?>
				<?php
					endif;
				  endforeach;
			  endif;
            ?>
          </td>
          <td class="dr">
			<?php echo $this->Html->cCurrency($userCashWithdrawal['UserCashWithdrawal']['amount']);?>
			<?php if(!empty($userCashWithdrawal['UserCashWithdrawal']['remark'])): ?>
			<span class="js-tooltip" title="<?php echo $this->Html->cText($userCashWithdrawal['UserCashWithdrawal']['remark'], false); ?>"><i class="icon-question-sign"></i></span>
			<?php endif; ?>
		  </td>
          <?php if(empty($this->request->params['named']['filter_id'])) { ?>
            <td><?php echo $this->Html->cText($userCashWithdrawal['WithdrawalStatus']['name']);?></td>
          <?php } ?>
          <td class="dr span5"><?php echo $this->Html->cDate($userCashWithdrawal['UserCashWithdrawal']['created']);?></td>
        </tr>
        <?php
            endforeach;
          else:
        ?>
        <tr>
          <td colspan="8" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('User Cash Withdrawals'));?></td>
        </tr>
        <?php
          endif;
        ?>
      </tbody>
    </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
    <?php if (!empty($userCashWithdrawals)) { ?>
      <?php if(isset($this->request->params['named']['filter_id']) && ($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending)):?>
        <div class="admin-select-block pull-left">
          <?php echo __l('Select:'); ?>
          <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
          <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
        </div>
        <div class="admin-checkbox-button pull-left hor-space">
          <div class="input select">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
          </div>
        </div>
        <div class="hide">
          <?php echo $this->Form->submit('Submit');  ?>
        </div>
      <?php endif; ?>
      <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
    <?php } ?>
  </section>
  <?php echo $this->Form->end(); ?>
</div>