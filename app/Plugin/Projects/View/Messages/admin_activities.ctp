<?php
  if(!empty($this->request->params['named']['type'])) {
    $type = $this->request->params['named']['type'];
  } else {
    $type = 'user_messages';
  }
?>
<div class="messages index js-response js-responses">
<div class="pull-left hor-space span24 clearfix"><?php echo $this->element('paging_counter');?></div>
<div class="row-fluid">
<?php echo $this->Form->create('Message' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
<table class="table table-striped table-bordered table-condensed table-hover">
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
  <tr>
    <td>
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
      <?php echo sprintf(__l('%s canceled'), Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_singular_small')); ?>
    <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::StatusChange): ?>
      <?php
		$status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
							  'status_id' => $message['Message']['project_status_id'],
							  'project_type_id' => $message['Project']['project_type_id']
							));
        echo $reason =  $status_response->data['response'];
      ?>
    <?php endif; ?>
	<?php
		  echo $this->Html->link($this->Html->cText($message['Project']['name'],false), array('controller'=> 'projects', 'action' => 'view', $message['Project']['slug'], 'admin' => false), array('class' => 'js-tooltip no-under', 'escape' => false, 'title' => $this->Html->cText($message['Project']['name'],false)));
		  $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
	?>
	<span class="js-timestamp" title="<?php echo $time_format;?>"><?php echo $message['Message']['created']; ?></span>
  </tr>
  <?php
      endforeach;
    } else {
  ?>
  <tr>
    <td>
      <div class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo __l('No activities found');?></p>
	</td>
  </tr>
  <?php }  ?>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($messages)):
    ?>
<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
</section>
<?php
endif;
echo $this->Form->end();
?>
</div>
</div>
<div class="modal hide fade" id="js-ajax-modal">
  <div class="modal-header">
    <button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2><?php echo __l('Message'); ?></h2>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a>
  </div>
</div>