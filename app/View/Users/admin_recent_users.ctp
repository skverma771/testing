<div class="no-mar no-bor clearfix box-head space">
  <h5 class="pull-left"><i class="icon-user no-bg space"></i><?php echo __l('Recently Registered Users'); ?></h5>
</div>
<section class="space">
  <?php
    if (!empty($recentUsers)):
      $users = '';
      foreach ($recentUsers as $user):
        $users .= $this->Html->link($this->Html->cText($user['User']['username'], false), array('controller'=> 'users', 'action' => 'view', $user['User']['username'], 'admin' => false), array('class' => 'grayc')) . ', ';
      endforeach;
  ?>
  <p><?php echo substr($users, 0, -2);?></p>
  <?php else: ?>
    <p><?php echo __l('Recently no users registered');?></p>
  <?php endif; ?>
</section>