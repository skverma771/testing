<?php /* SVN: $Id: $ */ ?>
<div class="main-admn-usr-lst js-response">
	<div class="sudopayIpnLogs index">
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
							<th class="text-center"><?php echo $this->Paginator->sort('created', __l('Added On'));?></th>
							<th><?php echo $this->Paginator->sort('ip', __l('IP'));?></th>
							<th><?php echo $this->Paginator->sort('post_variable', __l('Post Variable'));?></th>
						</tr>
					</thead>
					<tbody class="h6">
						<?php
						if (!empty($sudopayIpnLogs)):
						foreach ($sudopayIpnLogs as $sudopayIpnLog):
						?>
						<tr>
							<td class="text-center"><?php echo $this->Html->cDateTimeHighlight($sudopayIpnLog['SudopayIpnLog']['created']);?></td>
							<td><?php echo $this->Html->cText($sudopayIpnLog['SudopayIpnLog']['ip']);?></td>
							<td><?php echo $this->Html->cText($sudopayIpnLog['SudopayIpnLog']['post_variable']);?></td>
						</tr>
						<?php
						endforeach;
						else:
						?>
						<tr>
							<td colspan="6"><i class="fa fa-exclamation-triangle"></i><?php echo sprintf(__l('No %s available'), __l('ZazPay IPN Logs'));?></td>
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
				<?php if (!empty($sudopayIpnLogs)) { ?>
				<div class="col-xs-12 col-sm-6 pull-right">
					<?php echo $this->element('paging_links');?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

