<div class="container">
  <div class="clearfix">
  <div class="page-header no-mar"><h2><?php echo __l('Dashboard'); ?></h2></div>
  <?php echo $this->element('user-avatar', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
  </div>
  <?php echo $this->element('dashboard-activities', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
</div>