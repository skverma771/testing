<div class="clearfix navbar-btn payment-edit">
<?php
	$subscriptionInfo[ConstBrandType::TransparentBranding] = __l('Payment will have to be handled through transparent API calls. Your users will not see ZazPay branding.');
    $subscriptionInfo[ConstBrandType::VisibleBranding] = __l('Payment will have to be handled through ZazPay payment button. Your users will visit zazpay.com and see ZazPay branding.');
    $subscriptionInfo[ConstBrandType::AnyBranding] = __l('Payment can either be handled through transparent API calls or ZazPay payment button. If using transparent API calls, your users will not see ZazPay branding.');
?>
	<div class="pull-left navbar-btn well">
        <div class="navbar-btn">
            <?php echo $this->Html->link( __l('Sync with ZazPay'), array('controller' => 'sudopays', 'action' => 'synchronize', 'admin' => true), array('escape' => false, 'class' => 'btn btn-primary mob-no-pad marg-right-20', 'title' => __l('Sync with ZazPay'))); ?>
            <span class="js-tooltip" title="<?php echo __l('This will fetch latest configurations (subscription plan & gateways) from zazpay.com.'); ?>"><i class="fa fa-question-circle"></i></span>
        </div>
	<?php if ($gateway_settings['is_payment_via_api'] != ConstBrandType::VisibleBranding) { ?>
		<div id="setting-sudopay_website_id">		
		<div class="media">
			<div class="col-md-3 navbar-left"><?php echo __l("Subscription Plan"); ?></div>
			<div class="media-body">			
				<div id="setting-sudopay_website_id">
					<?php echo $this->Html->cText($gateway_settings['sudopay_subscription_plan'], false); ?>
				</div>			
			</div>
		</div>		
		<div class="media">
			<div class="col-md-3 navbar-left"><?php echo __l("Branding"); ?></div>						
				<div id="setting-sudopay_website_id">
					<?php
						if ($gateway_settings['is_payment_via_api'] == ConstBrandType::TransparentBranding) {
							$branding = 'Transparent';
						} elseif ($gateway_settings['is_payment_via_api'] == ConstBrandType::VisibleBranding) {
							$branding = 'Visible';
						} elseif ($gateway_settings['is_payment_via_api'] == ConstBrandType::AnyBranding) {
							$branding = 'Any';
						}
					?>
				<?php echo $branding; ?>&nbsp<i class="fa fa-info-circle js-tooltip" title = "<?php echo $this->Html->cBool($subscriptionInfo[$gateway_settings['is_payment_via_api']], false); ?>"></i>
			</div>			
		</div>		
		<div class="media ver-space"><?php echo __l("Enabled Gateways"); ?></div>
		<?php
			foreach($supported_gateways as $gateways) {
				$gateway_datails = unserialize($gateways['SudopayPaymentGateway']['sudopay_gateway_details']);
				?>
				<div class="media">
					<div class="col-md-3 navbar-left">						
						<span class="show show"><?php echo $this->Html->cText($gateways['SudopayPaymentGateway']['sudopay_gateway_name'], false); ?></span>
							<span class="show">
								<span>
									<img src="<?php echo $gateway_datails['thumb_url'];?>" alt="<?php echo $this->Html->cText($gateways['SudopayPaymentGateway']['sudopay_gateway_name'], false); ?>"/>
								</span>
						</span>							
					</div>
					<div class="media-body">						
						<span class="show"><strong><?php echo __l("Supported Actions"); ?></strong></span>
						<?php
							$used_gateway_actions = array_diff($used_gateway_actions, $gateway_datails['supported_features'][0]['actions']);
							$action_arr = array();
							foreach($gateway_datails['supported_features'][0]['actions'] as $actions) {
								$action_arr[] = $actions;
							}
							echo implode(', ', $action_arr);
						 ?>							
						<div class="clearfix">							
							<span class="show"><strong><?php echo __l("Supported Currencies"); ?></strong></span>
								<?php
									$currency_arr = array();
									foreach($gateway_datails['supported_features'][0]['currencies'] as $currencies) {
										$currency_arr[] = $currencies;
									}
									echo implode(', ', $currency_arr);
								?>
							</div>						
					</div>
				</div>
		<?php
			}
		?>		
		</div>
		<?php
		if (!empty($used_gateway_actions)) {
		$missed_gateway_actions = implode('","', $used_gateway_actions);
		?>
		<div class="alert alert-danger clearfix">
			<?php
				echo sprintf(__l('We have used "%s" in %s. So enable payment gateways with supporting "%s" actions in ZazPay.'), $missed_gateway_actions, Configure::read('site.name'), $missed_gateway_actions);
			?>
		</div>

		<?php
		}

	} else { ?>
		<?php
		if (!empty($used_gateway_actions)) {
		$missed_gateway_actions = implode('","', $used_gateway_actions);
	?>
		<div class="alert alert-danger clearfix">
			<?php
				echo __l('Your current plan is not support for API calling. So we can\'t able to get your plan details and enabled payment gateways list from ZazPay.');
			?>
		</div>
		<div class="alert alert-info clearfix">
			<?php
				echo sprintf(__l('We have used "%s" in %s. So you please manually check whether your ZazPay payment gateway plan supports the mentioned actions'), $missed_gateway_actions, Configure::read('site.name'));
			?>
		</div>

	<?php
		} } ?>
	</div>
</div>