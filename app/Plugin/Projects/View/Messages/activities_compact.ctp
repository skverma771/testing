<h5 class="bot-mspace"><?php echo __l('Recent activity ');?><i class="icon-rss"></i></h5>
<ul class="unstyled clearfix">
  <?php
    if (!empty($messages)) {
      foreach ($messages as $message):
		$pledgeordonate = Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_past_tense_small');
		$fundordonate = sprintf(__l('Opened for %s'), Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_present_continuous_small'));
  ?>
  <?php
				if (!isPluginEnabled('Idea') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectRating) {
					continue;
				} elseif (!isPluginEnabled('ProjectUpdates') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate) {
					continue;
				} elseif (!isPluginEnabled('ProjectUpdates') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment) {
					continue;
				} elseif (!isPluginEnabled('ProjectFollowers') && $message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower) {
					continue;
				}
            ?>
  <li class="bot-space">
    <?php
	  if ($message['Message']['activity_id'] == ConstProjectActivities::AmountRepayment){
			echo $this->Html->link($this->Html->cText($message['User']['username']), array('controller' => 'users', 'action' => 'view', $message['User']['username']), array('title' => $message['User']['username'], 'escape' => false));
	  } else if ($message['Message']['activity_id'] != ConstProjectActivities::StatusChange && $message['Message']['activity_id'] != ConstProjectActivities::ProjectRejected) {
        if ($message['Message']['activity_id'] != ConstProjectActivities::Fund || ($message['Message']['activity_id'] == ConstProjectActivities::Fund && (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $message['ActivityUser']['id'] == $this->Auth->user('id')))) {
          if (!empty($message['ActivityUser']['id'])) {
            echo $this->Html->link($this->Html->cText($message['ActivityUser']['username']), array('controller' => 'users', 'action' => 'view', $message['ActivityUser']['username']), array('title' => $message['ActivityUser']['username'], 'escape' => false));
          } else {
            echo __l('Anonymous');
          }
        } else {
          echo __l('Anonymous');
        }
      }
    ?>
    <?php if ($message['Message']['activity_id'] == ConstProjectActivities::Fund): ?>
      <?php echo $pledgeordonate; ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate): ?>
      <?php echo __l('update posted'); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment): ?>
      <?php echo __l('commented on update');  ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectRating): ?>
      <?php echo __l('voted'); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectComment): ?>
      <?php echo __l('commented on project'); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower): ?>
      <?php echo __l('started following'); ?>
	  <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::AmountRepayment): ?>
      <?php echo __l('Amount repayment'); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::FundCancel): ?>
      <?php echo sprintf(__l('%s canceled'), Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_singular_small')); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::StatusChange): ?>
      <?php
		$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
							  'status_id' => $message['Message']['project_status_id'],
							  'project_type_id' => $message['Project']['project_type_id']
							));
		echo $status_response->data['response'] ;
      ?>
	  <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectRejected && ($message['Project']['user_id'] == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin)): ?>
      <?php echo sprintf(__l('%s rejected by Admin'), Configure::read('project.alt_name_for_project_singular_caps')); ?>
    <?php endif; ?>
  </li>
  <?php
      endforeach;
    } else {
  ?>
  <li>
		<div class="thumbnail space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo __l('No activities found');?></p>
     </div>
  </li>
  <?php }  ?>
</ul>