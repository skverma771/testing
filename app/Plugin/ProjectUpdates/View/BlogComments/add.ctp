<?php /* SVN: $Id: $ */ ?>
<?php if (empty($this->request->data['BlogComment']['display'])) { ?>
  <div class="hor-space messages index js-ajax-form-container">
    <h5 class="bot-space sep-bot"><?php echo __l('Post Comment') ;?></h5>
    <?php echo $this->Form->create('BlogComment', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'Form', 'class' => "normal ver-space js-modal-form {container:'js-ajax-form-container',responsecommandcontainer:'js-responses-".$this->request->data['BlogComment']['blog_id']."'}"));?>
    <div class="row">
      <div class="span no-mar"><?php echo $this->Html->getUserAvatar($logged_in_user['User']); ?></div>
      <div class="span11">
        <fieldset>
          <?php
            echo $this->Form->input('blog_id', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'BlogId', 'type' => 'hidden'));
            echo $this->Form->input('comment', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'Comment', 'label'=>false,'class'=>"textarea-large js-show-submit-block span12"));
            echo $this->Form->input('display', array('id' => 'BlogCommentdisplay' . $this->request->data['BlogComment']['blog_id'] . 'Comment', 'type'=>'hidden'));
          ?>
        </fieldset>
      </div>
    </div>
    <div class="row">
      <div class="offset2"><?php echo $this->Form->submit(__l('Submit'));?></div>
    </div>
    <?php echo $this->Form->end();?>
  </div>
<?php } else { ?>
  <div class="com-bg">
    <?php echo $this->Form->create('BlogComment', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'Form', 'class' => "normal space"));?>
    <?php echo $this->Form->input('blog_id', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'BlogId', 'type' => 'hidden')); ?>
    <div class="row-fluid">
      <div class="span20">
        <?php
          $redirect = '';
          if (isset($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'dashboard') {
            $redirect = Router::url(array('controller' => 'users', 'action' => 'dashboard'), true);
          } elseif (isset($this->request->params['named']['message_type']) && $this->request->params['named']['message_type'] == 'userview') {
            $redirect = Router::url(array('controller' => 'users', 'action' => 'view', $this->request->params['named']['redirect_username']), true);
          }
          echo $this->Form->input('redirect_url', array('type' => 'hidden', 'value' => $redirect));
          echo $this->Form->input('comment', array('id' => 'BlogComment' . $this->request->data['BlogComment']['blog_id'] . 'Comment', 'label' => false, 'class' => 'span', 'cols' => 30, 'rows' => 6));
          echo $this->Form->input('display', array('id' => 'BlogCommentdisplay' . $this->request->data['BlogComment']['blog_id'] . 'Comment', 'type' => 'hidden'));
        ?>
      </div>
      <div class="span <?php echo $blog['Project']['ProjectType']['slug']; ?>"><?php echo $this->Form->submit(__l('Submit'), array('class' => 'btn btn-module', 'div' => false));?></div>
	  </div>
      <?php echo $this->Form->end();?>
  </div>
<?php } ?>