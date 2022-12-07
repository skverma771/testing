<div class="space">
  <fieldset>
  <legend><h3><?php echo __l('Disk Usage'); ?></h3></legend>
    <div class="well">
    <span ><?php echo $this->Html->link('<i class="icon-remove"></i> &nbsp;'.__l('Clear Cache'), array('controller' => 'devs', 'action' => 'clear_cache', '?f=' . $this->request->url), array('title' => __l('Clear Cache'), 'class' => 'pull-right js-confirm blackc', 'escape'=>false));  ?>.</span>
    <div id="disk-usage" style="display: block;" class="active">
    <ul class="unstyled">
      <li><?php echo __l('Used Cache Memory');?>: <span><?php echo $tmpCacheFileSize; ?></span> </li>
      <li><?php echo __l('Used Log Memory  ');?>  : <span><?php echo $tmpLogsFileSize; ?> </span> </li>
    </ul>
    </div>
  </div>
  <legend><h3><?php echo __l('Recent Errors & Logs'); ?></h3></legend>
  <div class="well">
    <?php echo $this->Html->link('<i class="icon-remove"></i> &nbsp;'.__l('Clear Error Log'), array('controller' => 'devs', 'action' => 'clear_logs', 'type' => 'error'), array('title' => __l('Clear Error Log'), 'class' => 'pull-right blackc', 'escape'=>false)); ?>
    <div><textarea class ="span24" rows="15" cols="80"><?php echo $error_log;?></textarea></div>
  </div>
  <legend><h3><?php echo __l('Debug Log')?></h3></legend>
  <div class="well">
    <?php echo $this->Html->link('<i class="icon-remove"></i> &nbsp;'.__l('Clear Debug Log'), array('controller' => 'users', 'action' => 'clear_logs', 'type' => 'debug'), array('title' => __l('Clear Debug Log'), 'class' => 'pull-right blackc', 'escape'=>false)); ?>
    <div><textarea class ="span24" rows="15" cols="80"><?php echo $debug_log;?></textarea></div>
  </div>
  <legend><h3><?php echo __l('Email Log')?></h3></legend>
  <div class="well">
    <?php echo $this->Html->link('<i class="icon-remove"></i> &nbsp;'.__l('Clear Email Log'), array('controller' => 'users', 'action' => 'clear_logs', 'type' => 'email'), array('title' => __l('Clear Email Log'), 'class' => 'pull-right blackc', 'escape'=>false)); ?>
    <div><textarea class ="span24" rows="15" cols="80"><?php echo $debug_log;?></textarea></div>
  </div>
  </fieldset>
</div>