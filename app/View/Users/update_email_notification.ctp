  <div class="pull-right js-no-pjax">
  <span class="top-smspace span"><?php echo __l("Notify me through Email"); ?></span>
  <span class="btn-group span">
    <a class="btn <?php if($is_send_activities_mail == 1) { echo 'btn-success'; } ?> js-filter" href="<?php echo Router::url(array(
    'controller' => 'users',
    'action' => 'update_email_notification',
    'notify' => 0
  ), true); ?>"><?php echo __l("Yes"); ?></a>
    <a class="btn <?php if($is_send_activities_mail == 0) { echo 'btn-success'; } ?> js-filter" href="<?php echo Router::url(array(
    'controller' => 'users',
    'action' => 'update_email_notification',
    'notify' => 1
  ), true); ?>"><?php echo __l("No"); ?></a>
  </span>
  </div>
