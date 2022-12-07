<?php /* SVN: $Id: $ */ ?>
<div class="container">
  <?php echo $this->Form->create('Wallet', array('action' => 'add_to_wallet', 'id' => 'PaymentOrderForm', 'class' => 'form-horizontal js-submit-target')); ?>
    <div class="clearfix">
      <div class="ver-space ver-mspace span no-mar"><h2><?php echo sprintf(__l('Add %s'), __l('Amount to Wallet')); ?></h2></div>
	    <div class="ver-space pull-right">
    <?php echo $this->element('settings-menu', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?></div>
    </div>
    <?php
      if (Configure::read('site.currency_symbol_place') == 'left'):
        $currecncy_place = 'between';
        $class ='input-prepend';
      else:
        $currecncy_place = 'after';
        $class ='input-append';
      endif;
    ?>
    <div class="thumbnail main-section">
	  <?php
		if(isset($this->request->data['UserAddWalletAmount']['wallet']) && $this->request->data['UserAddWalletAmount']['payment_gateway_id'] == ConstPaymentGateways::SudoPay && !empty($sudopay_gateway_settings) && $sudopay_gateway_settings['is_payment_via_api'] == ConstBrandType::VisibleBranding) {
			echo $this->element('sudopay_button', array('data' => $sudopay_data, 'cache' => array('config' => 'sec')), array('plugin' => 'Sudopay'));
		} else {
	  ?>
      <div class="alert alert-info">
        <span><?php echo __l('Your current available balance:').' '. $this->Html->siteCurrencyFormat($this->Html->cCurrency($user_info['User']['available_wallet_amount'],false));?></span>
      </div>
      <?php
        echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Auth->user('id')));
        if (!Configure::read('wallet.max_wallet_amount')):
          $max_amount = 'No limit';
        else:
          $max_amount = $this->Html->siteCurrencyFormat($this->Html->cCurrency(Configure::read('wallet.max_wallet_amount'),false));
        endif;
        $info = sprintf(__l('Minimum Amount: %s <br/> Maximum Amount: %s'), $this->Html->siteCurrencyFormat($this->Html->cCurrency(Configure::read('wallet.min_wallet_amount'),false)), $max_amount);
      ?>
      <div class="input text required <?php echo $class;?>">
        <?php echo $this->Form->input('UserAddWalletAmount.amount',array($currecncy_place => '<span class="currency add-on">'.Configure::read('site.currency').'</span>','div'=>false, 'info' => $info, 'class' => 'js-remove-error'));?>
      </div>
      <h3 class="sep-bot"><?php echo __l('Payment Type'); ?></h3>
      <?php echo $this->element('payment-get_gateways', array('model' => 'UserAddWalletAmount', 'type' => 'is_enable_for_add_to_wallet', 'is_enable_wallet' => 0, 'cache' => array('config' => 'sec'))); ?>
    </div>
  <?php echo $this->Form->end();?>
  <?php } ?>
</div>