<ul class="unstyled no-mar ver-space">
    <?php
      $inbox_count = '';
      if (!empty($inbox)):
        $inbox_count = ' (' . $inbox . ')';
      endif;
    ?>
    <?php $class = (!empty($folder_type) && $folder_type == 'inbox') ? 'linkc js-unread' : 'blackc js-unread'; ?>
    <li class="span pull-left">
      <?php echo $this->Html->link(__l('Inbox') . $inbox_count, array('controller' => 'messages', 'action' => 'inbox'),array('title'=>__l('Inbox'),'class' => $class)); ?>
    </li>
    <?php $class = (!empty($folder_type) && $folder_type == 'sent') ? 'linkc' : 'blackc'; ?>
    <li class="span pull-left">
      <?php echo $this->Html->link(__l('Replied') , array('controller' => 'messages', 'action' => 'sentmail'),array('title'=>__l('Replied'), 'class' => $class)); ?>
    </li>
    <?php $class = (!empty($folder_type) && $folder_type == 'starred' && !empty($is_starred)) ? 'linkc' : 'blackc'; ?>
    <li class="starred span pull-left">
      <?php echo $this->Html->link(__l('Starred (' . $stared . ')') , array('controller' => 'messages', 'action' => 'starred'),array('title'=>__l('Starred (' . $stared . ')'), 'class' => $class)); ?><em class="starred"></em>
    </li>
    <?php $class = (!empty($folder_type) && $folder_type == 'all' && empty($is_starred)) ? 'linkc' : 'blackc'; ?>
    <li class="span pull-left">
      <?php echo $this->Html->link(__l('All') , array('controller' => 'messages', 'action' => 'all'), array('title'=>__l('All'), 'class' => $class)); ?>
    </li>
</ul>