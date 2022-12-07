<?php /* SVN: $Id: admin_index.ctp 2754 2010-08-16 06:18:32Z boopathi_026ac09 $ */ ?>
<?php if(empty($this->request->params['named']['stat']) && !$isAjax): ?>
  <div class="page-header no-mar"><h2><?php echo __l('Transactions'); ?></h2></div>
  <?php echo $this->element('user-avatar', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
  <div class="Transaction index">
  <div class="container space-top clearfix">
    <div class="thumbnail">
    <div class="clearfix">
      <h3><?php echo __l('Account Summary'); ?></h3>
      <?php if (isPluginEnabled('Wallet')) { ?>
      <div class="well clearfix">
        <div class="pull-right no-mar row">
        <div class="hor-msapce textb span"><?php echo __l('Account Balance: ');?><span class="textn"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($logged_in_user['User']['available_wallet_amount'],false));?></span></div>
        </div>
        <?php if (isPluginEnabled('Withdrawals')) { ?>
        <div class="pull-right no-mar row">
          <div class="hor-msapce textb"><?php echo __l('Withdraw Request: ');?><span class="textn"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($blocked_amount,false));?></span></div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php echo $this->Form->create('Transaction', array('action' => 'index', 'class' => 'form-horizontal thumbnail js-ajax-form {"container":"js-responses"}')); ?>
      <div class="transaction-category">
      <div class="group-block">
        <?php echo $this->Form->input('filter', array('default' => __l('All'), 'type' => 'radio', 'options' => $filter, 'legend' => false, 'class' => 'js-transaction-filter js-no-pjax')); ?>
      </div>
      <div class="js-filter-window hide clearfix">
        <div class="clearfix">
        <div class="input date-time clearfix">
          <div class="js-datetime">
          <div class="js-cake-date">
            <?php echo $this->Form->input('from_date', array('label' => __l('From'), 'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
          </div>
          </div>
        </div>
        <div class="input date-time clearfix">
          <div class="js-datetime">
          <div class="js-cake-date">
            <?php echo $this->Form->input('to_date', array('label' => __l('To'),  'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
          </div>
          </div>
        </div>
        <?php echo $this->Form->input('tab_check', array('type' => 'hidden','value' => 'tab_check'));?>
        <div class="pull-left"><?php echo $this->Form->submit(__l('Filter'));?></div>
        </div>
      </div>
      </div>
    <?php echo $this->Form->end(); ?>
    <div class="clearfix js-responses js-response">
<?php endif; ?>
      <?php echo $this->element('paging_counter');?>
      <table class="table table-bordered table-striped table-condensed">
      <tr>
        <th class="dc"><div class="js-filter js-no-pjax"><?php echo $this->Paginator->sort('created', __l('Created'));?></div> </th>
        <th class="dl"><div class="dl"><?php echo __l('Message'); ?></div></th>
        <th class="dr"><div class="js-filter js-no-pjax  credit round-3"><span class="label label-success"><?php echo __l('Credit') . ' (' . Configure::read('site.currency') . ')';?></span></div></th>
        <th class="dr"><div><span class="label label-info"><?php echo __l('Debit') . ' (' . Configure::read('site.currency') . ')';?></span></div></th>
      </tr>
      <?php
        if (!empty($transactions)):
        foreach ($transactions as $transaction):
          $from = $this->Html->cDate($duration_from);
          $to = $this->Html->cDate($duration_to);
      ?>
      <tr>
        <td class="dc"><?php echo $this->Html->cDateTimeHighlight($transaction['Transaction']['created']); ?></td>
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
          } elseif (($transaction['TransactionType']['id'] == ConstTransactionTypes::ProjectBacked || $transaction['TransactionType']['id'] == ConstTransactionTypes::Refunded) && $transaction['Transaction']['user_id'] != ConstUserIds::Admin) {
            echo ' (' . __l('Site Fee') . ' ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($transaction['ProjectFund']['site_fee'], false)) . ')';
          } else {
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
				} else if ($transaction['ProjectFund']['canceled_by_user_id'] == ConstPledgeCanceledBy::Backer) {
					echo ' (' . sprintf(__l('Canceled by %s'), Configure::read('project.alt_name_for_'.$transaction['ProjectFund']['Project']['ProjectType']['funder_slug'].'_singular_caps')).')';
				} else {
					echo ' (' . __l('Due to Expire').')';
				}
		  }
        ?>
        </td>
        <td class="dr">
        <?php
          if ($transaction['TransactionType']['is_credit'] || ($transaction['Transaction']['receiver_user_id'] == $this->Auth->user('id') && $transaction['TransactionType']['is_credit_to_receiver'])) {
          echo $this->Html->cCurrency($transaction['Transaction']['amount']);
          } else {
          echo '--';
          }
        ?>
        </td>
        <td class="dr">
        <?php
          if ($transaction['TransactionType']['is_credit'] || ($transaction['Transaction']['receiver_user_id'] == $this->Auth->user('id') && $transaction['TransactionType']['is_credit_to_receiver'])):
          echo '--';
          else:
          echo $this->Html->cCurrency($transaction['Transaction']['amount']);
          endif;
        ?>
        </td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td class="dr" colspan="2"><span><?php echo __l('Total') . ' ';?></span><span class="grayc"><?php echo $from . ' ' . __l('to') . ' ' . $to; ?></span></td>
        <td class="dr credit-total"><?php echo $this->Html->cCurrency($total_credit_amount);?></td>
        <td class="dr debit-total"><?php echo $this->Html->cCurrency($total_debit_amount);?></td>
      </tr>
      <?php else: ?>
      <tr>
        <td colspan="11" class="errorc space">
			<div class="space dc grayc">
		<p class="ver-mspace top-space text-16">
		<?php echo sprintf(__l('No %s available'), __l('Transactions'));?>
		</p>
	</div>
		</td>
      </tr>
      <?php endif; ?>
    </table>
    <?php if (!empty($transactions)) : ?>
      <div class="pull-right js-pagination js-no-pjax">
      <?php echo $this->element('paging_links'); ?>
      </div>
    <?php endif; ?>
<?php if(empty($this->request->params['named']['stat']) && !$isAjax): ?>
    </div>
    </div>
  </div>
  </div>
<?php endif; ?>