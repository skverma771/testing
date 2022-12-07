<div class="well">
  <h3><?php echo __l('Add new comment'); ?></h3>
  <?php
    $type = $types_for_layout[$node['Node']['type']];
    if ($this->request->params['controller'] == 'comments') {
      $nodeLink = $this->Html->link(__l('Go back to original post') . ': ' . $node['Node']['title'], $node['Node']['url']);
      echo $this->Html->tag('p', $nodeLink, array('class' => 'back'));
    }
    $formUrl = array('controller' => 'comments', 'action' => 'add', $node['Node']['id']);
    if (isset($parentId) && $parentId != null) {
      $formUrl[] = $parentId;
    }
    echo $this->Form->create('Comment', array('class' => 'form-horizontal', 'url' => $formUrl));
    if ($this->Session->check('Auth.User.id')) {
      echo $this->Form->input('Comment.name', array('label' => __l('Name'), 'value' => $this->Session->read('Auth.User.name'), 'readonly' => 'readonly'));
      echo $this->Form->input('Comment.email', array('label' => __l('Email'), 'value' => $this->Session->read('Auth.User.email'), 'readonly' => 'readonly'));
      echo $this->Form->input('Comment.website', array('label' => __l('Website'), 'value' => $this->Session->read('Auth.User.website'), 'readonly' => 'readonly'));
      echo $this->Form->input('Comment.body', array('label' => false));
    } else {
      echo $this->Form->input('Comment.name', array('label' => __l('Name')));
      echo $this->Form->input('Comment.email', array('label' => __l('Email')));
      echo $this->Form->input('Comment.website', array('label' => __l('Website')));
      echo $this->Form->input('Comment.body', array('label' => false));
    }
  ?>
  <div class="clearfix bot-space">
    <div class="input help js-captcha-container thumbnail span captcha-block">
      <div class="pull-left">
        <?php echo $this->Html->image($this->Html->url(array('controller' => 'comments', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
      </div>
      <div class="input-append pull-left">
        <div class="dc text-20">
          <?php echo $this->Html->link('<i class="icon-refresh text-16"></i> <span class="hide">' . __l('Reload CAPTCHA') . '</span>', '#', array('escape' => false, 'class' => 'js-captcha-reload js-no-pjax captcha-reload blackc', 'title' => __l('Reload CAPTCHA')));?>
        </div>
        <div class="text-16 top-smspace">
          <div class="play-link">
            <?php echo $this->Html->link(__l('Click to play'), Router::url('/', true) . "flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'comments', 'action'=>'captcha_play', 'comments')) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php echo $this->Form->input('Comment.captcha', array('label' => __l('Security Code'))); ?>
  <?php
    echo $this->Form->end(__l('Post Comment'));
  ?>
</div>