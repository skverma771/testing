<?php if (empty($this->request->params['prefix'])){ ?>
  <div class="clearfix"><h2 class="ver-space ver-mspace span no-mar"><?php echo __l('Change Password'); ?></h2>
  <div class="ver-space pull-right">
    <?php echo $this->element('settings-menu', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?></div>
	  </div>
<?php } ?>
<div class="clearfix space">
  <?php if (empty($this->request->params['prefix'])): ?>
  <div class="thumbnail main-section">
  <?php endif; ?>
  <?php echo $this->Form->create('User', array('action' => 'change_password' ,'class' => 'form-horizontal')); ?>
  <fieldset class="clearfix">
    <div>
    <?php
      if($this->Auth->user('role_id') == ConstUserTypes::Admin) :
      echo $this->Form->input('user_id', array('empty' => 'Select'));
      endif;
      if($this->Auth->user('role_id') != ConstUserTypes::Admin) :
      echo $this->Form->input('user_id', array('type' => 'hidden'));
      echo $this->Form->input('old_password', array('type' => 'password','label' => __l('Old password') ,'id' => 'old-password'));
      endif;
      echo $this->Form->input('passwd', array('type' => 'password','label' => __l('Enter a new password') , 'id' => 'new-password'));
      echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Confirm Password')));
    ?>
    </div>
  </fieldset>
  <div class="form-actions"><?php echo $this->Form->submit(__l('Change Password'));?></div>
  <?php echo $this->Form->end();?>
  <?php if (empty($this->request->params['prefix'])): ?>
  </div>
  <?php endif; ?>
</div>