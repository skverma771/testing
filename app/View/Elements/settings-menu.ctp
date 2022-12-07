<div class="clearfix top-mspace dropdown">
  <a href="#" class="btn pull-right dropdown-toggle js-no-pjax js-tooltip" data-toggle="dropdown" title="<?php echo __l('Settings'); ?>"><i class="icon-cog text-16"></i> <span class="hide">Settings</span> <span class="caret top-mspace"></span></a>
  <ul class="unstyled dropdown-menu arrow arrow-right dl clearfix">
	<?php if (empty($logged_in_user['User']['is_facebook_register']) && empty($logged_in_user['User']['is_twitter_register']) && empty($logged_in_user['User']['is_yahoo_register']) && empty($logged_in_user['User']['is_google_register']) && empty($logged_in_user['User']['is_googleplus_register']) && empty($logged_in_user['User']['is_linkedin_register']) && empty($logged_in_user['User']['is_openid_register'])): ?>
	  <li><?php  echo $this->Html->link('<i class="icon-lock"></i>'.__l('Change Password'), array('controller' => 'users', 'action' => 'change_password'),array('title' => __l('Change Password'), 'escape' => false));?></li>
	<?php endif; ?>
	<?php if(isPluginEnabled('SocialMarketing')):?>
	  <li><?php  echo $this->Html->link('<i class="icon-share"></i>'.__l('Social'), array('controller' => 'social_marketings', 'action' => 'myconnections'), array('title' => __l('Social'), 'escape'=>false));?></li>
	<?php endif;?>
	<?php if (isPluginEnabled('Wallet') && isPluginEnabled('Sudopay')): ?>
	<?php 
		App::import('Model', 'Payment');
		$Payment = new Payment();
		$gatewayTypes = $Payment->getGatewayTypes('is_enable_for_add_to_wallet');
		if(!empty($gatewayTypes)) :
		?>
		  <li><?php  echo $this->Html->link('<i class="icon-save"></i>'.sprintf(__l('Add %s'), __l('Amount to Wallet')), array('controller' => 'wallets', 'action' => 'add_to_wallet'), array('class' => 'js-no-pjax', 'title' => sprintf(__l('Add %s'), __l('Amount to Wallet')), 'escape'=>false));?></li>
		<?php endif; ?>
	<?php endif; ?>
	<?php if(isPluginEnabled('Sudopay')): ?>
	<li><?php  echo $this->Html->link('<i class="icon-money"></i>'.__l('Payment Options'), array('controller' => 'sudopays', 'action' => 'payout_connections'), array('class' => 'js-no-pjax', 'title' => __l('Payment Options'), 'escape'=>false));?></li>
	<?php endif; ?>
	<?php if (isPluginEnabled('Wallet') && isPluginEnabled('Withdrawals')): ?>
	  <li><?php  echo $this->Html->link('<i class="icon-credit-card"></i>'.__l('Money Transfer Accounts'), array('controller' => 'money_transfer_accounts', 'action' => 'index'), array('title' => __l('Money Transfer Accounts'), 'escape'=>false));?></li>
	  <li><?php  echo $this->Html->link('<i class="icon-briefcase"></i>'.__l('Withdraw Fund Request'), array('controller' => 'user_cash_withdrawals', 'action' => 'index'), array('title' => __l('Withdraw Fund Request'), 'escape'=>false));?></li>
	<?php endif; ?>
  </ul>
</div>