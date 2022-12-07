<?php /* SVN: $Id: $ */ ?>
<div class="sudopays index">
<section class="container social-myconnect setting-drop-menu">
<?php 
if(isset($this->request->query['error_code'])) { 
	if($this->request->query['error_code'] != 0) { ?>
		<div class="alert alert-error"><?php 
			echo sprintf('%s. %s', $this->request->query['error_message'], __l('Connection not completed. Please try again.')); ?>
		</div><?php 
	} 
} ?>
	<div class="clearfix user-heading">
		<h3 class="col-xs-8 col-sm-6 h2 text-uppercase navbar-btn"><?php echo __l('Payment Options / Payout Methods');?></h3>
		<div class="col-xs-4 col-sm-6 h2 navbar-btn">
			<?php echo $this->element('settings-menu', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?></div>
		</div>
	</div>
<div class="container">	  
<p><?php echo __l('When you receive a payment, we call that payment to you a "payout". Our secure payment system supports below payout methods, which can be setup here.');?></p>
<p><?php echo __l('Note that buyers will be provided with the payment options, based on below setup only.');?></p>
<div class="thumbnail clearfix">
<?php
if (!empty($supported_gateways)):
foreach ($supported_gateways as $gateways):
$gateway_details = unserialize($gateways['SudopayPaymentGateway']['sudopay_gateway_details']);
?>
 <div class="clearfix navbar-btn">
    <div class="col-md-2  pull-left navbar-btn">
		<img src="<?php echo $gateway_details['thumb_url'];?>" alt="<?php echo $this->Html->cText($gateways['SudopayPaymentGateway']['sudopay_gateway_name'], false);?>">
	</div>
	<div class="col-md-6 img-thumbnail pull-left">
	<span class="pull-left"><strong>
	<?php echo $this->Html->cText($gateways['SudopayPaymentGateway']['sudopay_gateway_name']);?></strong></span>
	<span class="pull-left">
	<?php echo $this->Html->cText(!empty($gateway_details['connect_instruction'])?$gateway_details['connect_instruction']:'');?></span>
	</div>
    <div class="col-md-2 navbar-btn">
		<?php 
			if(!empty($connected_gateways) && in_array($gateways['SudopayPaymentGateway']['sudopay_gateway_id'], $connected_gateways)) { ?>
				<?php echo $this->Html->link('<i class="fa fa-check"></i>'.__l('Connected'), array('controller' => 'sudopays', 'action' => 'delete_account', $gateways['SudopayPaymentGateway']['sudopay_gateway_id'], $user['User']['id'],'0','','admin' => false), array('class' => 'btn btn-primary js-sudopay-disconnect js-bootstrap-tooltip js-no-pjax','escape'=>false, 'title'=> __l('Disconnect')));
			} else {
				$class = '';
				if($this->Auth->user('role_id') != ConstUserTypes::Admin){ $class=''; }
				echo $this->Html->link(sprintf(__l('Connect my %s account'),$gateways['SudopayPaymentGateway']['sudopay_gateway_name']), array('controller' => 'sudopays', 'action' => 'add_account', $gateways['SudopayPaymentGateway']['sudopay_gateway_id'], $user['User']['id'],'0','','admin'=>false), array('class' => 'btn btn-primary navbar-btn js-no-pjax'.$class));
			}
		?>
	</div>
	</div>
<?php
  endforeach;
else:
?>
<div>
    <span colspan="6"><i class="fa fa-exclamation-triangle"></i> <?php echo sprintf(__l('No %s available'), __l('Gateways'));?></span>
  </div>
<?php
endif;
?>
  </div>
</section>
</div>
