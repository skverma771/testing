<?php /* SVN: $Id: admin_index.ctp 2754 2010-08-16 06:18:32Z boopathi_026ac09 $ */ ?>
<div class="transactions index js-response js-responses">
  <div class="row-fluid">
  <section class="page-header no-mar ver-space mspace">
    <ul class="filter-list-block unstyled row-fluid">
    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="label">' .__l('All'). '</span>', array('controller' => 'transactions', 'action' => 'index', 'filter' => 'all'), array('class' => 'pull-left no-under', 'escape' => false));?></li>
    <li class="pull-left dc hor-space"><?php echo $this->Html->link('<span class="label label-warning">' .__l('Admin'). '</span>', array('controller' => 'transactions', 'action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?></li>
    </ul>
  </section>
  <ul class="nav nav-tabs mspace top-space">
    <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  </ul>
  <section class="space clearfix">
    <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
    <div class="pull-right">
    <?php echo $this->Form->create('Transaction' , array('class' => 'form-search', 'action' => 'admin_index')); ?>
      <div class="pull-left">
      <?php
        $username = '';
        $user_placeholder = __l('User');
        if (!empty($this->request->named['username'])) {
			$username = $this->request->named['username'];
			$user_placeholder = $this->request->named['username'];
        }
      ?>
      <div class="mapblock-info">
        <?php echo $this->Form->autocomplete('Transaction.username', array('label' => false, 'placeholder' => $user_placeholder, 'acFieldKey' => 'Transaction.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255', 'class' => 'search-query mob-clr span24')); ?>
        <div class="autocompleteblock"></div>
      </div>
      </div>
      <div class="pull-left hor-space">
      <?php
        $project_id = '';
        if (!empty($this->request->named['project_id'])) {
        $project_id = $this->request->named['project_id'];
        }
        $project_placeholder = Configure::read('project.alt_name_for_project_singular_caps');
        if (!empty($this->request->named['name'])) {
        $project_placeholder = $this->request->named['name'];
        }
      ?>
      <div class="mapblock-info">
        <?php echo $this->Form->autocomplete('Project.name', array('label' => false, 'placeholder' => $project_placeholder, 'acFieldKey' => 'Transaction.project_id', 'acFields' => array('Project.name'), 'acSearchFieldNames' => array('Project.name'), 'maxlength' => '255', 'class' =>'search-query span24')); ?>
        <div class="autocompleteblock"></div>
      </div>
      </div>
	  <div class="pull-left">
	  <div class="input date-time clearfix">
          <div class="js-datetime">
          <div class="js-cake-date">
            <?php echo $this->Form->input('from_date', array('label' => __l('From'), 'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
          </div>
          </div>
        </div>
	  </div>
		 <div class="pull-left">
        <div class="input date-time clearfix">
          <div class="js-datetime">
          <div class="js-cake-date">
            <?php echo $this->Form->input('to_date', array('label' => __l('To'),  'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
          </div>
          </div>
        </div>
		</div>
      <div class="pull-left">
      <?php echo $this->Form->submit(__l('Filter'));?>
      </div>
    <?php echo $this->Form->end(); ?>
    </div>
  </section>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
    <thead>
      <tr>
      <th class="dc js-filter js-no-pjax"><div><?php echo $this->Paginator->sort('created', __l('Created'));?></div> </th>
      <th class="dl js-filter js-no-pjax"><div><?php echo $this->Paginator->sort('user_id', __l('User'));?></div></th>
      <th class="dl"><div><?php echo __l('Message'); ?></div></th>
      <th class="dr js-filter js-no-pjax"><div class="credit round-3"><?php echo $this->Paginator->sort('amount', __l('Credit')).' ('.Configure::read('site.currency').')';?></div></th>
      <th class="dr js-filter js-no-pjax"><div class="debit round-3"><?php echo $this->Paginator->sort('amount', __l('Debit')).' ('.Configure::read('site.currency').')';?></div></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($transactions)):
        foreach ($transactions as $transaction):
      ?>
      <tr>
      <td class="dc"><?php echo $this->Html->cDateTimeHighlight($transaction['Transaction']['created']); ?></td>
      <td class="dl span3">
        <div class="row-fluid">
          <div class="span8"><?php echo $this->Html->getUserAvatar($transaction['User'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($transaction['User']); ?></div>
        </div>
      </td>
      <td class="dl">
        <?php
        if (in_array($transaction['Transaction']['transaction_type_id'], array(ConstTransactionTypes::AdminAddFundToWallet, ConstTransactionTypes::AdminDeductFundFromWallet))):
          echo $this->Html->cText($transaction['Transaction']['remarks']);
        else:
          echo $this->Html->transactionDescription($transaction);
        endif;
        if ($transaction['TransactionType']['id'] == ConstTransactionTypes::CashWithdrawalRequestPaid) {
            if ($transaction['Transaction']['payment_gateway_id'] == ConstPaymentGateways::ManualPay) {
              echo ' through Manual';
            }
        } elseif (($transaction['TransactionType']['id'] == ConstTransactionTypes::ProjectBacked || $transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) && $transaction['Transaction']['user_id'] != ConstUserIds::Admin && empty($this->request->params['named']['filter'])) {
            if ($transaction['TransactionType']['id'] == ConstTransactionTypes::ProjectBacked) {
            echo ' (' . __l('Funded Amount') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['amount'], false)) . ')';
            }
            if ($transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) {
            echo ' (' . __l('Canceled Amount') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['amount'], false)) . ')';
            }
        } elseif (($transaction['TransactionType']['id'] == ConstTransactionTypes::ProjectBacked || $transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) && $transaction['Transaction']['user_id'] != ConstUserIds::Admin) {
            echo ' (' . __l('Site Fee') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['site_fee'], false)) . ')';
        }  else {
            if ($transaction['TransactionType']['id'] == ConstTransactionTypes::ProjectBacked) {
            echo ' (' . __l('Funded Amount') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['amount'], false)) . ')';
            }
            if ($transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) {
            echo ' (' . __l('Canceled Amount') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['amount'], false)) . ')';
            }
        }
		if ($transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) {
				if ($transaction['ProjectFund']['canceled_by_user_id'] == ConstPledgeCanceledBy::Admin) {
					echo ' (' . __l('Canceled by Admin').')';
				}else if ($transaction['ProjectFund']['canceled_by_user_id'] == ConstPledgeCanceledBy::Owner) {
					echo ' (' . sprintf(__l('Canceled by %s Owner'), Configure::read('project.alt_name_for_project_singular_caps')).')';
				} else {
					echo ' (' . sprintf(__l('Canceled by %s'), Configure::read('project.alt_name_for_'.$transaction['ProjectFund']['Project']['ProjectType']['funder_slug'].'_singular_caps')).')';
				}
		  }
        ?>
      </td>
      <td class="dr">
        <?php
        if (!empty($transaction['TransactionType'][$credit_type])) {
          echo $this->Html->cCurrency($transaction['Transaction']['amount']);
        } else {
          echo '--';
        }
        ?>
      </td>
      <td class="dr">
        <?php
        if (!empty($transaction['TransactionType'][$credit_type])) {
          echo '--';
        } else {
          echo $this->Html->cCurrency($transaction['Transaction']['amount']);
        }
        ?>
      </td>
      </tr>
      <?php endforeach; ?>
      <tr class="total-block">
      <td class="dr" colspan="3"><span><?php echo __l('Total');?></span></td>
      <td class="dr credit-total"><?php echo $this->Html->cCurrency($total_credit_amount);?></td>
      <td class="dr debit-total"><?php echo $this->Html->cCurrency($total_debit_amount);?></td>
      </tr>
      <?php else: ?>
      <tr>
      <td colspan="11" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Transactions'));?></td>
      </tr>
      <?php endif; ?>
    </tbody>
    </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
    <?php if (!empty($transactions)) : ?>
    <div class="pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
    <?php endif; ?>
  </section>
  </div>
</div>