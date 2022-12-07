<?php
  $bg_class = '';
  $text_class = "js-show-submit-block span12";
  if (!empty($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'inbox') {
    $bg_class = 'com-bg clearfix';
    $text_class = "js-show-submit-block span12";
  }
  if (!empty($this->request->params['named']['is_activity'])) {
    $text_class = "js-show-submit-block span10";
  }
?>
<div class="messages com-bg clearfix index ver-space <?php echo $bg_class;?>">
  <?php
    $avatar_flag = 0;
    $message_class = 'js-add-block hide';
    if (!empty($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'inbox') {
      $redirect = Router::url(array('controller' => 'messages', 'action' => 'index'), true);
    } elseif (!empty($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'dashboard') {
      $redirect = Router::url(array('controller' => 'users', 'action' => 'dashboard'), true);
    } elseif (!empty($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'userview') {
      $redirect = Router::url(array('controller' => 'users', 'action' => 'view', $this->request->params['named']['redirect_username']), true);
    } else {
      $redirect = Router::url(array('controller' => 'projects', 'action' => 'view', $project['Project']['slug']), true);
    }
  ?>
  <?php if (empty($this->request->params['named']['reply_type'])) { ?>
    <h5 class="ver-space sep-bot"><?php echo __l('Post Comment') ;?></h5>
  <?php } ?>
  <?php
    if (!empty($this->request->params['named']['reply_type']) and $this->request->params['named']['reply_type'] == 'quickreply') {
      echo $this->Form->create('Message', array('action' => 'compose'));
      echo $this->Form->input('quickreply', array('type' => 'hidden', 'value' => 'quickreply'));
    } else {
      echo $this->Form->create('Message', array('action' => 'compose', 'class' => 'space message-compose {"redirect_url":"'.$redirect.'"}'));
  ?>
  <div class="row">
    <div class="span"><?php echo $this->Html->getUserAvatar($logged_in_user['User'], 'normal_thumb'); ?></div>
  <?php
    }
  ?>
  <div class="span12">
    <?php
      echo $this->Form->input('project_id', array('type' => 'hidden'));
      echo $this->Form->input('parent_message_id', array('type' => 'hidden'));
      if (!empty($this->request['data']['Message']['parent_message_id'])) {
        $button_text = __l('Reply');
      } else {
        $button_text = __l('Post Comment');
      }
      echo $this->Form->input('type', array('type' => 'hidden'));
      if (!empty($this->request->params['named']['message_type']) && in_array($this->request->params['named']['message_type'], array('dashboard', 'userview'))) {
        echo $this->Form->input('redirect_url', array('type' => 'hidden', 'value' => $redirect));
      }
      if (!empty($project['Project']['user_id']) && $project['Project']['user_id'] == $this->Auth->user('id') && empty($this->request->params['named']['reply_type'])) {
        echo $this->Form->input('to', array('options' => $select_array, 'label' => false));
        echo $this->Form->input('message', array('type' => 'textarea', 'class'=> $text_class, 'label'=>false, 'placeholder' =>"Write a comment"));
        echo $this->Form->input('redirect_url', array('type' => 'hidden', 'value' => $redirect));
      } else {
        if (!empty($this->request->params['named']['user'])):
          echo $this->Form->input('to', array('type' => 'hidden', 'value' => $this->request->params['named']['user']));
        endif;
        echo $this->Form->input('message', array('type' => 'textarea', 'class'=> $text_class, 'label'=>false, 'placeholder' => $button_text));
      }
      echo $this->Form->input('message_type', array('type' => 'hidden'));
      echo $this->Form->input('root', array('type' => 'hidden'));
      echo $this->Form->input('m_path', array('type' => 'hidden'));
    ?>
    <div class="<?php echo $message_class;?>">
      <?php
        if (empty($this->request->params['named']['reply_type'])):
          if (!empty($project['Project']['user_id']) && $project['Project']['user_id'] == $this->Auth->user('id')) {
            echo $this->Form->input('is_private', array('type' => 'hidden'));
          } else {
            echo $this->Form->input('is_private', array('label' => __l('Private')));
          }
        endif;
        $message_class = 'btn';
        if (!empty($this->request->params['isAjax'])) {
          $parent_message_id = !empty($this->request->data['Message']['parent_message_id']) ? $this->request->data['Message']['parent_message_id'] : '';
          $message_class = "btn js-no-pjax js-toggle-show {'container':'js-quickreplydiv-" . $parent_message_id . "'}";
        }
      ?>
      <div class="submit-block clearfix bot-space <?php if(!empty($this->request->params['named']['projecttype_slug'])) { echo $this->request->params['named']['projecttype_slug']; } ?>">
        <div class="pull-left">
        <?php echo $this->Form->submit($button_text, array('class' => 'js-no-pjax btn-module','div'=>'submit span')); ?>
		<?php $parent_message_id = !empty($parent_message_id) ? $parent_message_id : ''; ?>
		<?php if (empty($this->request->params['named']['is_activity']) && (!empty($this->request->params['named']['user']) && !empty($this->request->params['named']['reply_type']))) { ?>
			<a class="btn hor-mspace js-no-pjax js-toggle-reply-show {'container':'js-quickreplydiv-<?php echo $parent_message_id; ?>','pid':'<?php echo $parent_message_id; ?>'}" title="<?php echo __l('Cancel'); ?>" href="#"><?php echo __l('Cancel'); ?></a>
		<?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php if (empty($this->request->params['named']['reply_type'])) { ?>
    </div>
  <?php } ?>
  <?php echo $this->Form->end(); ?>
</div>