<div class="js-response clearfix">
  <section>
    <?php if (!empty($messages)): ?>
      <?php $projectStatus = array();?>
      <article class="row span11">
        <ol class="thumbnails">
          <?php
            $i = 0;
            end($messages);
            $last = key($messages);
            reset($messages);
            foreach ($messages as $key=>$message):
              $separtor = '';
              if ($key != $last) {
                $separtor = ' sep-bot';
              }
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
          <li class="pr hor-mspace sep-bot">
            <section class="row no-mar ver-space">
              <div class="span6 no-mar list-content">
                <div class="row">
                  <div class="span no-mar payment-img">
                    <?php echo $this->Html->link($this->Html->showImage('Project', $message['Project']['Attachment'], array('dimension' => 'medium_thumb', 'class'=>'js-tooltip', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($message['Project']['name'], false)), 'title' => $this->Html->cText($message['Project']['name'], false)),array('aspect_ratio'=>1)), array('controller' => 'projects', 'action' => 'view',  $message['Project']['slug'], 'admin' => false), array('class' => 'hor-space', 'escape' => false));?>
                  </div>
                  <div class="span4 no-mar">
                    <h5><?php echo $this->Html->link($this->Html->cText($message['Project']['name'],false), array('controller'=> 'projects', 'action' => 'view', $message['Project']['slug']), array('class' => 'no-mar no-pad linkc textb span4 htruncate js-tooltip', 'escape' => false, 'title' => $this->Html->cText($message['Project']['name'],false)));?></h5>
                    <span class="clearfix">
                      <?php
						$pledgeordonate = Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_past_tense_caps');
                        $fundordonate = sprintf(__l('Opened for %s'), Configure::read('project.alt_name_for_'.$message['Project']['ProjectType']['slug'].'_present_continuous_small'));
                      ?>
                      <?php if ($message['Message']['activity_id'] == ConstProjectActivities::Fund): ?>
                        <?php echo  $pledgeordonate; ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdate): ?>
                        <?php echo __l('update posted'); ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectUpdateComment): ?>
                        <?php echo __l('Commented on Update');  ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectRating): ?>
                        <?php echo __l('Voted'); ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectComment): ?>
                        <?php echo __l('Commented on Project'); ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::ProjectFollower): ?>
                        <?php echo __l('Started Following'); ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::FundCancel): ?>
                        <?php echo __l('Canceled'); ?>
                      <?php elseif ($message['Message']['activity_id'] == ConstProjectActivities::StatusChange): ?>
                        <?php
						  $status_response = Cms::dispatchEvent('View.Project.projectStatusValue', $this, array(
							  'status_id' => $message['Message']['project_status_id'],
							  'project_type_id' => $message['Project']['project_type_id']
							));
						 echo $reason =  $status_response->data['response'];
                        ?>
                      <?php endif; ?>
                    </span>
                  </div>
                </div>
              </div>
              <div class="dr mob-clr span5 no-mar <?php echo !empty($this->request->params['named']['user_id'])?'pull-right':'';?>">
			  <?php $time_format_class = "span4 hor-space no-mar"; ?>
			   <?php if($message['Message']['activity_id'] != ConstProjectActivities::StatusChange) { ?>
 			    <?php $time_format_class = "span3 no-mar"; ?>
                  <div class="span">
                    <?php
                      if ($message['Message']['activity_id'] != ConstProjectActivities::Fund || ($message['Message']['activity_id'] == ConstProjectActivities::Fund && (in_array($message['ProjectFund']['is_anonymous'], array(ConstAnonymous::None, ConstAnonymous::FundedAmount)) || $message['ActivityUser']['id'] == $this->Auth->user('id')))) {
                        if (!empty($message['ActivityUser']['id'])) {
                          echo $this->Html->getUserAvatar($message['ActivityUser'], 'micro_thumb');
                        } else {
                          echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                        }
                      } else {
                        echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                      }
                    ?>
                  </div>
                <?php } ?>
                <div class="span">
                  <?php
                    $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
                  ?>
                  <span class="js-timestamp <?php echo $time_format_class;?>"  title="<?php echo $time_format;?>"><?php echo $message['Message']['created']; ?></span>
                </div>
              </div>
            </section>
          </li>
          <?php endforeach; ?>
        </ol>
      </article>
    <?php else : ?>
      <ol class="unstyled space no-mar no-pad">
        <li>
		 <div class="thumbnail space dc grayc">
		  <p class="ver-mspace top-space text-10"><?php echo __l('No activities available');?></p>
         </div>
		</li>
      </ol>
    <?php endif;?>
  </section>
  <?php if (!empty($messages)): ?>
    <section>
	<div class="pull-left">
        <?php echo $this->Html->link(__l('See all notifications'), array('controller' => 'users', 'action' => 'dashboard', 'admin' => false), array('class' => 'linkc top-mspace','escape' => false));?>
      </div>
      <div class="pull-right">
        <?php echo $this->Html->link(__l('Clear notification'), array('controller' => 'messages', 'action' => 'clear_notifications', 'admin' => false, 'final_id' => $final_id['Message']['id']), array('class' => 'mspace js-no-pjax btn','escape' => false));?>
      </div>
    </section>
  <?php endif; ?>
</div>