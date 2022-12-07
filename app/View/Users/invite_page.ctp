<?php echo $this->Form->create('Subscription', array('action' => 'check_invitation', 'class' => "ver-space dl clearfix no-mar"));?>
<div>
  <div class="input text span blackc">
  <?php
    echo $this->Form->input('invite_hash',array('label'=>__l('Enter your invitation code'), 'class' => 'span8'));
  ?>
  </div>
</div>
<div class="submit btn-align span">
  <?php echo $this->Form->submit(__l('Sign Up')); ?>
</div>
<?php echo $this->Form->end();