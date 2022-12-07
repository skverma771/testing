<?php
  if(!empty($this->request->params['named']['type'])) {
    $type = $this->request->params['named']['type'];
  } else {
    $type = 'user_messages';
  }
?>
<div class="messages index js-response js-responses">
<div class="row-fluid">
<?php echo $this->Form->create('Message' , array('class' => 'js-shift-click js-no-pjax no-mar','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
  <?php
    if (!empty($messages)) {
      foreach ($messages as $message):
		$pledgeordonate = !empty($message['Project']['ProjectType'])?Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_past_tense_small'):'';
		$fundordonate = !empty($message['Project']['ProjectType'])?sprintf(__l('Opened for %s'), Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_present_continuous_small')):'';
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
  <div class="top-smspace">
    <?php
      if ($message['Message']['activity_id'] != ConstProjectActivities::StatusChange) {
        if ($message['Message']['activity_id'] != ConstProjectActivities::Fund || ($message['Message']['activity_id'] == ConstProjectActivities::Fund && (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $message['ActivityUser']['id'] == $this->Auth->user('id')))) {
          if (!empty($message['ActivityUser']['id'])) {
            echo $this->Html->link($this->Html->cText($message['ActivityUser']['username']), array('controller' => 'users', 'action' => 'view', $message['ActivityUser']['username'], 'admin' => false), array('title' => $message['ActivityUser']['username'], 'class' => 'js-tooltip no-under', 'escape' => false));
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
      <?php echo __l('following'); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::FundCancel): ?>
      <?php echo sprintf(__l('%s canceled'), Configure::read('project.alt_name_for_pledge_singular_small')); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::StatusChange): ?>
      <?php
        $pledgeProjectStatus = array(ConstPledgeProjectStatus::Pending => __l('Pending'), ConstPledgeProjectStatus::OpenForFunding => $fundordonate, ConstPledgeProjectStatus::FundingClosed => __l('Funding Closed'), ConstPledgeProjectStatus::FundingExpired => sprintf(__l('%s Expired'), Configure::read('project.alt_name_for_project_singular_caps')), ConstPledgeProjectStatus::ProjectCanceled => sprintf(__l('%s Canceled'), Configure::read('project.alt_name_for_project_singular_caps')), ConstPledgeProjectStatus::GoalReached => __l('Goal Reached'), ConstPledgeProjectStatus::OpenForIdea => __l('Opened for voting'));
        if(array_key_exists($message['Message']['project_status_id'],$pledgeProjectStatus)){
          echo $pledgeProjectStatus[$message['Message']['project_status_id']];
        }
      ?>
    <?php endif; ?>
	<?php
		  echo $this->Html->link($this->Html->cText($message['Project']['name'],false), array('controller'=> 'projects', 'action' => 'view', $message['Project']['slug'], 'admin' => false), array('class' => 'js-tooltip no-under', 'escape' => false, 'title' => $this->Html->cText($message['Project']['name'],false)));
		  $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
	?>
	<span class="js-timestamp" title="<?php echo $time_format;?>"><?php echo $message['Message']['created']; ?></span>
</div>
  <?php
      endforeach;
    } else {
  ?>


      <div class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo __l('No activities found');?></p>


  <?php }  ?>

</section>

<?php
echo $this->Form->end();
?>
</div>
</div>
