<div class="no-mar no-bor clearfix box-head space">
  <h5 class="pull-left"><i class="icon-warning-sign no-bg space"></i><?php echo __l('Actions to Be Taken'); ?></h5>
</div>
<section class="space">
  <?php if(configure::read('user.is_admin_activate_after_register')) :?>
     <ul class="unstyled" >
      <li><b><?php echo __l('Users');?></b></li>
      <li><i class="icon-caret-right grayc"></i><?php echo $this->Html->link(__l('Pending Approval Users') . ' (' . $pending_approval_users. ')', array('controller'=> 'users', 'action' => 'index', 'type' => 'user_messages' , 'filter_id' =>ConstMoreAction::Inactive), array('class' => 'grayc'));?></li>
    </ul>
  <?php endif; ?>
  <?php 
	$content = array(
		'PendingProject' => '',
		'FlaggedProjects' => '',
		'SystemFlagged' => '',
		'UserWithdrawRequests' => '',
		'AffiliateWithdrawRequests' => '',
		'LendLatePayment' => '',
	);
	$response = Cms::dispatchEvent('View.AdminDasboard.onActionToBeTaken', $this, array(
		'content' => $content
	));	
	if(!empty($response->data['content']['PendingProject'])) {
  ?>
	<ul class="unstyled">
	<li><b><?php echo Configure::read('project.alt_name_for_project_plural_caps');?></b></li>
	<ul class="unstyled">
		<?php echo $response->data['content']['PendingProject']; ?>
    </ul>
	</ul>	
	<ul class="unstyled">
		<li><b><?php echo __l('Pending Payments');?></b></li>
		<ul class="unstyled">
			<?php echo $response->data['content']['LendLatePayment']; ?>
		</ul>
	</ul>
  <?php
	}
	echo $response->data['content']['FlaggedProjects'];
  ?>
  <?php
	if(!empty($response->data['content']['SystemFlagged'])) {
  ?>
     <ul class="unstyled">
      <li><b><?php echo __l('System Flagged ');?></b></li>
	  <?php echo $response->data['content']['SystemFlagged']; ?>
    </ul>
  <?php } ?>
  <?php 
	echo $response->data['content']['UserWithdrawRequests'];
	echo $response->data['content']['AffiliateWithdrawRequests'];
  ?>
</section>