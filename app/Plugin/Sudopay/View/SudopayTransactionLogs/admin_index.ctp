<?php /* SVN: $Id: $ */ ?>
<div class="main-admn-usr-lst js-response">
	<div class="sudopayTransactionLogs index js-response">
		<div class="clearfix">
			<div class="navbar-btn">
				<ul class="list-unstyled clearfix">
					<li class="pull-left"> 
						<p><?php echo $this->element('paging_counter');?></p>
					</li>
				</ul>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="text-center"><?php echo __l('Actions');?></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('created', __l('Created'));?></div></th>
							<th class="text-left"><div><?php echo $this->Paginator->sort('class');?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('payment_id', __l('Payment'));?></div></th>
							<th class="text-right"><div><?php echo $this->Paginator->sort('amount', __l('Amount')) .' ('.Configure::read('site.currency').')';?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('sudopay_pay_key', __l('Pay Key'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('merchant_id', __l('Merchant'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('gateway_name', __l('Gateway'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('status', __l('Status'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('payment_type', __l('Payment Type'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('buyer_email', __l('Buyer Email'));?></div></th>
							<th class="text-center"><div><?php echo $this->Paginator->sort('buyer_address', __l('Buyer Address'));?></div></th>
						</tr>
					</thead>
					<tbody class="h6">
						<?php
						if (!empty($sudopayTransactionLogs)):
						foreach ($sudopayTransactionLogs as $sudopayTransactionLog):
						?>
						<tr>
							<td class="text-center">
								<div class="dropdown">
									<a href="#" title="Actions" data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle js-no-pjax"><i class="fa fa-cog"></i><span class="hide">Action</span></a>
									<ul class="dropdown-menu">
										<li>
										<?php echo $this->Html->link('<i class="fa fa-share"></i>'.__l('View'), array('controller' => 'sudopay_transaction_logs', 'action'=>'view', $sudopayTransactionLog['SudopayTransactionLog']['id']), array('class' => '', 'escape'=>false,'title' => __l('View')));?>
										</li>
									</ul>
								</div>
							</td>
							<td class="text-center"><?php echo $this->Html->cDateTimeHighlight($sudopayTransactionLog['SudopayTransactionLog']['created']);?></td>
							<td><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['class']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['payment_id']);?></td>
							<td class="text-right"><?php echo $this->Html->cCurrency($sudopayTransactionLog['SudopayTransactionLog']['amount']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['sudopay_pay_key']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['merchant_id']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['gateway_name']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['status']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['payment_type']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['buyer_email']);?></td>
							<td class="text-center"><?php echo $this->Html->cText($sudopayTransactionLog['SudopayTransactionLog']['buyer_address']);?></td>
						</tr>
						<?php
						endforeach;
						else:
						?>
						<tr>
							<td colspan="36"><i class="fa fa-exclamation-triangle"></i> <?php echo sprintf(__l('No %s available'), __l('ZazPay Transaction Logs'));?></td>
						</tr>
						<?php
						endif;
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="page-sec navbar-btn">
			<div class="row">
				<?php if (!empty($sudopayTransactionLogs))  : ?>
					<div class="col-xs-12 col-sm-6 pull-right">
						<?php echo $this->element('paging_links'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
