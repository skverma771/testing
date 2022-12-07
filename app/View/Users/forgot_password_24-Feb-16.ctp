<h2 class="ver-space"><?php echo __l('Forgot your password?');?></h2>
<section class="thumbnail row">
  <div class="alert alert-info">
  <?php echo __l('Enter your Email, and we will send you instructions for resetting your password.'); ?>
  </div>
  <?php echo $this->Form->create('User', array('action' => 'forgot_password', 'class' => 'space form-horizontal')); ?>
  <div class="offset5 span pull-left clearfix">
    <?php echo $this->Form->input('email', array('type' => 'text'));?>
    <?php if (Configure::read('user.is_enable_forgot_password_captcha')): ?>
    <?php if (Configure::read('system.captcha_type') == 'Solve Media') { ?>
      <div class="offset3 help">
      <?php
        include_once VENDORS . DS . 'solvemedialib.php';  //include the Solve Media library
        echo solvemedia_get_html(Configure::read('captcha.challenge_key'));  //outputs the widget
      ?>
      </div>
    <?php } else { ?>
    <div class="clearfix bot-space">
      <div class="input help js-captcha-container thumbnail span captcha-block">
      <div class="pull-left">
      <?php echo $this->Html->image($this->Html->url(array('controller' => 'users', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
      </div>
      <div class="input-append pull-left">
      <div class="dc text-20">
      <?php echo $this->Html->link('<i class="icon-refresh text-16"></i> <span class="hide">' . __l('Reload CAPTCHA') . '</span>', '#', array('escape' => false, 'class' => 'js-captcha-reload js-no-pjax captcha-reload blackc no-under', 'title' => __l('Reload CAPTCHA')));?>
      </div>
      <div class="text-16 top-smspace">
        <?php echo $this->Html->link(__l('Click to play'), Router::url('/',true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'users', 'action'=>'captcha_play')) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
      </div>
      </div>
      </div>
      </div>
      <?php echo $this->Form->input('captcha', array('value' =>'' ,'label' => __l('Security Code'))); ?>

    <?php } ?>
    <?php endif; ?>
    <div class="clearfix ver-space">
    <?php echo $this->Form->submit(__l('Send'));?>
    </div>
  </div>
  <?php echo $this->Form->end();?>
</section>