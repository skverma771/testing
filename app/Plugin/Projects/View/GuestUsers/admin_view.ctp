<?php /* SVN: $Id: view.ctp 2888 2010-08-30 10:12:30Z boopathi_026ac09 $ */
foreach($data as $user) {?>
<section id="user-main" class="clearfix container js-user-view">
  <div class="ver-space">
	<section class="row">
		<div class="table">
			<table class="table">
				<!--<thead><tr><td class="text-20"><?php echo __l('Guest User Details'); ?></td></tr></thead> -->
					<tbody>
						<tr><td><?php echo __l('Name'); ?></td><td class="text-14"><strong><?php echo $user['name'];?></strong></td></tr>
						<tr><td><?php echo __l('Email'); ?></td><td class="text-14"><strong><?php echo $user['email'];?></strong></td></tr>
						<tr><td><?php echo __l('Funded Amount'); ?></td><td class="text-14"><strong><?php echo Configure::read('site.currency')." ".$user['amount'];?></strong></td></tr>
						<tr><td><?php echo __l('Address'); ?></td><td class="text-14"><strong><?php echo $user['address'];?></strong></td></tr>
						<tr><td><?php echo __l('PinCode'); ?></td><td class="text-14"><strong><?php echo $user['zip_code'];?></strong></td></tr>
						<?php /*foreach($project_details as $project_detail) {?>
						<tr><td><?php echo __l('Funded Project'); ?></td><td class="text-14"><strong><?php echo $project_detail['name'];?></strong></td></tr>
						<?php }*/?>
		</tbody>
		</table>
	
	</div>
	</section>
  </div>
</section>
<?php } ?>