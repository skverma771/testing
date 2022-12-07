<div class="row no-mar">
  <ul class="unstyled span8 clearfix no-mar">
  <?php
  $funded_user = 0;
  $friends_count = 0;
  $bake_ids = array();
  $total_count = count($projectFundFriends) + count($projectFunds);
  if(!empty($projectFundFriends)){
    $friends_count = count($projectFundFriends);
    foreach($projectFundFriends as $projectFundFriend) {
  ?>
  <li class="span dc pull-left">
    <?php
    $bake_ids[] = $projectFundFriend['ProjectFund']['id'];
    if (empty($projectFundFriend['ProjectFund']['is_anonymous']) || $projectFundFriend['User']['id'] == $this->Auth->user('id') || (!empty($projectFundFriend['ProjectFund']['is_anonymous']) && $projectFundFriend['ProjectFund']['is_anonymous'] == ConstAnonymous::FundedAmount)) {
    if(!empty($projectFundFriend['User']['id'])) {
      echo $this->Html->getUserAvatar($projectFundFriend['User'], 'micro_thumb');
    } else {
      echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
    }
    } else {
    echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
  ?>
    <?php
    }
  ?>
  </li>
  <?php
    if($projectFundFriend['User']['id'] == $this->Auth->user('id')) {
      $funded_user = 1;
    }
    }
  }
  ?>
  <?php
  if($friends_count < 5) {
    $remaining_count = 5 - $friends_count;
    $i=1;
    if (!empty($projectFunds)) {
    foreach($projectFunds as $projectFund) {
      if(empty($funded_user) && $projectFund['User']['id'] == $this->Auth->user('id')) {
      $funded_user = 1;
      }
      if($i > $remaining_count){
      break;
      }
  ?>
  <li class="span dc pull-left">
    <?php
    if (empty($projectFund['ProjectFund']['is_anonymous']) || $projectFund['User']['id'] == $this->Auth->user('id') || (!empty($projectFund['ProjectFund']['is_anonymous']) && $projectFund['ProjectFund']['is_anonymous'] == ConstAnonymous::FundedAmount)) {
    if (!empty($projectFund['User']['id'])) {
      echo $this->Html->getUserAvatar($projectFund['User'], 'micro_thumb');
    } else {
      echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
    }
    } else {
    echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
    }
  ?>
  </li>
  <?php
      $i++;
    }
    }
  }
  if ($total_count < $total_backe) {
    $extra = $total_backe - $total_count;
  ?>
  <?php 
  
  $backer_or_donor = Configure::read('project.alt_name_for_backer_plural_small');
  if(isset($projectFund['ProjectFund']['project_type_id']) && $projectFund['ProjectFund']['project_type_id'] == ConstProjectTypes::Donate) {
		$backer_or_donor = Configure::read('project.alt_name_for_donor_plural_small');
  }
			  
  ?>
  <li class="more span1 thumbnail pull-left dc"><?php echo $this->Html->link($this->Html->cText('+' . $extra . ' ' . __l('More ') . '&#187;', false), array('controller'=> 'projects', 'action'=>'view', $projectFund['Project']['slug'].'/#backers','admin' => false), array('class' => 'js-no-pajax', 'title' =>  sprintf(__l('Show all %s'), $backer_or_donor)));  ?></li>
  <?php
    }
    if (empty($projectFunds) && empty($projectFundFriends) || (empty($funded_user) && (count($projectFunds) + count($projectFundFriends)) < 6) && empty($extra)) {
  ?>
  <li class="more span1 thumbnail dc pull-left"><span class="show">
	<?php
		if($project['Project']['user_id'] == $this->Auth->user('id')){
			echo __l('X');
		} else {
			echo __l('You');
		}
	?>	
	</span><?php echo __l('Here');?></li>
  <?php } elseif(empty($projectFunds) && empty($projectFundFriends)) { ?>
  <li>
	<div class="thumbnail space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), Configure::read('project.alt_name_for_backer_plural_caps'));?></p>
    </div>
  </li>
  <?php } ?>
  </ul>
</div>