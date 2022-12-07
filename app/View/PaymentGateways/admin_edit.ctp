<?php /* SVN: $Id: admin_edit.ctp 2895 2010-09-02 10:58:05Z sakthivel_135at10 $ */ ?>
<div class="paymentGateways form space">
  <?php echo $this->Form->create('PaymentGateway');?>
  <ul class="breadcrumb">
  <li><?php echo $this->Html->link(__l('Payment Gateways'), array('action' => 'index'), array('title' => __l('Payment Gateways')));?><span class="divider">&raquo</span></li>
  <li class="active"><?php echo sprintf(__l('Edit %s'), __l('Payment Gateway'));?></li>  
  </ul>
  <ul class="nav nav-tabs">
  <li>
  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
  </li>
  <li class="active"><a class="blackc" href="#add_form"><i class="icon-edit"></i><?php echo __l('Edit');?></a></li>
  </ul>
  <div>
	<?php
		if(!empty($SudoPayGatewaySettings['sudopay_merchant_id']) && $id == ConstPaymentGateways::SudoPay) {
			echo $this->element('sudopay-info', array('cache' => array('config' => 'sec')), array('plugin' => 'Sudopay'));
		}		
	?>
  </div>
  <fieldset class="offset1">
    <?php
 	echo $this->Form->input('id');
    if ($this->request->data['PaymentGateway']['id'] != ConstPaymentGateways::Wallet && $this->request->data['PaymentGateway']['id'] == ConstPaymentGateways::SudoPay):
      echo $this->Form->input('is_test_mode', array('label' => __l('Test Mode?'), 'help' => __l('On disabling this, live account will used instead of sandbox payment details. (Disable this, When site is in production stage)')));
    endif;
    
    foreach($paymentGatewaySettings as $paymentGatewaySetting) {
      $options['type'] = $paymentGatewaySetting['PaymentGatewaySetting']['type'];
      if($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_project'):
      $options['label'] = sprintf(__l('Enable for %s listing'), Configure::read('project.alt_name_for_project_singular_small'));
      elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_pledge'):
      $options['label'] = sprintf(__l('Enable for %s'),Configure::read('project.alt_name_for_pledge_singular_small'));
      elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_donate'):
      $options['label'] = sprintf(__l('Enable for %s'),Configure::read('project.alt_name_for_donate_singular_small'));
	  elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_lend'):
      $options['label'] = sprintf(__l('Enable for %s'),Configure::read('project.alt_name_for_lend_singular_small'));
	  elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_equity'):
      $options['label'] = sprintf(__l('Enable for %s'),Configure::read('project.alt_name_for_equity_singular_small'));
      elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_add_to_wallet'):
      $options['label'] = __l('Enable for add to wallet');
	  elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_signup_fee'):
      $options['label'] = __l('Enable for sign up fee');
      elseif($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_live'):
        $options['label'] = __l('Enable for Live');
      endif;
      $options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['test_mode_value'];
      $options['div'] = array('id' => "setting-{$paymentGatewaySetting['PaymentGatewaySetting']['name']}");
      if($options['type'] == 'checkbox' && !empty($options['value'])):
      $options['checked'] = 'checked';
      else:
      $options['checked'] = '';
      endif;
      if($options['type'] == 'select'):
      $selectOptions = explode(',', $paymentGatewaySetting['PaymentGatewaySetting']['options']);
      $paymentGatewaySetting['PaymentGatewaySetting']['options'] = array();
      if(!empty($selectOptions)):
        foreach($selectOptions as $key => $value):
        if(!empty($value)):
          $paymentGatewaySetting['PaymentGatewaySetting']['options'][trim($value)] = trim($value);
        endif;
        endforeach;
      endif;
      $options['options'] = $paymentGatewaySetting['PaymentGatewaySetting']['options'];
      endif;
      if (!empty($paymentGatewaySetting['PaymentGatewaySetting']['description']) && empty($options['after'])):
      $options['help'] = "{$paymentGatewaySetting['PaymentGatewaySetting']['description']}";
      else:
      $options['help'] = '';
      endif;
      if ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_signup_fee' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_test_mode' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_project' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_pledge'|| $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_donate' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_add_to_wallet' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_lend' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_enable_for_equity' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'is_live'):
      echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.test_mode_value", $options);
      endif;
    }
    if ($paymentGatewaySettings && $this->request->data['PaymentGateway']['id'] != ConstPaymentGateways::Wallet) {
    ?>

    <?php
    $j = $i = $z = $n = $x= 0;
    foreach($paymentGatewaySettings as $paymentGatewaySetting) {
      $options['type'] = $paymentGatewaySetting['PaymentGatewaySetting']['type'];
      $options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['test_mode_value'];
      $options['div'] = array('id' => "setting-{$paymentGatewaySetting['PaymentGatewaySetting']['name']}");
      if($options['type'] == 'checkbox' && $options['value']):
      $options['checked'] = 'checked';
      endif;
      if($options['type'] == 'select'):
            $selectOptions = explode(',', $paymentGatewaySetting['PaymentGatewaySetting']['options']);
            $paymentGatewaySetting['PaymentGatewaySetting']['options'] = array();
            if(!empty($selectOptions)):
              foreach($selectOptions as $key => $value):
                if(!empty($value)):
                  $paymentGatewaySetting['PaymentGatewaySetting']['options'][trim($value)] = trim($value);
                endif;
              endforeach;
            endif;
            $options['options'] = $paymentGatewaySetting['PaymentGatewaySetting']['options'];
          endif;
      $options['label'] = false;
      if (!empty($paymentGatewaySetting['PaymentGatewaySetting']['description']) && empty($options['after'])):
      $options['help'] = "{$paymentGatewaySetting['PaymentGatewaySetting']['description']}";
      else:
      $options['help'] = '';
      endif;
    ?>
      </fieldset>
      <?php if($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_merchant_id' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_website_id' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_secret_string' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_api_key'|| 
      $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_Password' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_AppID' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'payee_account'|| $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_UserName' ||  $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_Signature'): ?>
         
	  <?php if($x == 0):?>
        <fieldset class="fields-block round-5">
        <?php if($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_merchant_id' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_website_id' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_secret_string' || $paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_api_key'){ ?>
        <h3 class="span5"><?php echo __l('SudoPay API Details'); ?></h3>
        
        <?php }else {?>
         <h3 class="span5"><?php echo __l('Paypal API Details'); ?></h3>
        <?php }?>
        <div class="clearfix span offset4">
        <h5  class="span6"><?php echo __l('Live Mode Credential'); ?></h5>
        <h5  class="span5"><?php echo __l('Test Mode Credential'); ?></h5>
        </div>
         </fieldset>
      <?php endif;?>
		<div class="input text clearfix">
          <label class="span3 pull-left">
			<?php
				if ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_merchant_id') {
					echo __l('Merchant ID in SudoPay');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_website_id') {
					echo __l('Website ID in SudoPay');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_secret_string') {
					echo __l('Secret Key in SudoPay');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'sudopay_api_key') {
					echo __l('API Key in SudoPay');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_Password') {
					echo __l('API password');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'payee_account') {
					echo __l('Payee account');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_UserName') {
					echo __l('API username');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_AppID') {
					echo __l('API ID');
				} elseif ($paymentGatewaySetting['PaymentGatewaySetting']['name'] == 'adaptive_API_Signature') {
					echo __l('API Signature');
				}
			?>
		  </label>
          <div class="offset1 span5 hor-space pull-left">
          
          <?php
            $options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['live_mode_value'];
            echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.live_mode_value", $options);
          ?>
          </div>
          <div class="offset1 span5 hor-space pull-left">
          
	         <?php
            	$options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['test_mode_value'];
            	echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.test_mode_value", $options);
         	 ?>
          </div>
        </div>
	  <?php if($x == 2):?>
       
      <?php endif;?>
      <?php $x++;?>
	  <?php endif; ?>
  <?php
      }
  }
  ?>
  <div class="offset4 clearfix">
  <?php echo $this->Form->end(__l('Update'));?>
  </div>
</div>