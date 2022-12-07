<div class="container-fluid">
  <div class="row ver-space">
    <h1 class="span8 no-pad no-mar text-16">
      <?php echo $this->Html->link(Configure::read('site.name') . '<span class="sfont"><small class="sfont blackc"> Admin</small></span>', array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('class' => 'brand blackc', 'escape' => false, 'title' => ('Admin')));?>
    </h1>
	<div class="pull-right mob-clr">
      <ul class="dc unstyled span no-mar">
		<?php 
		$class = 'hide';
		if((($this->request->params['controller']=='users')&&($this->request->params['action']=='admin_stats'))||(($this->request->params['controller']=='google_analytics')&&($this->request->params['action']=='admin_analytics_chart'))) { $class = ''; }?>
		<li class="span js-live-tour-link <?php echo $class; ?>"><a href="#" class="bootstro-goto grayc bootstro js-no-pjax" data-bootstro-step="0" data-bootstro-title="Live Tour"data-bootstro-content="Look out for a Live Tour link in the top of page for live demo of product" data-bootstro-placement="bottom" escape="false">Live Tour</a></li>
		<li class="span"><?php echo $this->Html->link(__l('View Site'), Router::url('/',true), array('class' => 'js-no-pjax blackc textb', 'escape'=>false, 'title' => __l('View Site'))); ?></li>
		<li class="span">
		<?php if($this->request->params['controller'] == 'users' && $this->request->params['action']=='admin_stats') { ?>
		<?php  echo $this->Html->link(__l('Tools'), array('controller' => 'nodes', 'action' => 'tools', 'admin' => true),array('class' => 'grayc bootstro','data-bootstro-step'=>'11' ,'data-bootstro-title'=>'Tools' , 'data-bootstro-content'=>__l("For manually trigger the corn to update the project status, also to update daily status."), 'data-bootstro-placement'=>'bottom', 'escape'=>false));?>
		<?php } else { ?>
		<?php  echo $this->Html->link(__l('Tools'), array('controller' => 'nodes', 'action' => 'tools', 'admin' => true),array('class' => 'grayc', 'escape'=>false));?>
		<?php } ?>
		</li>
        <li class="span"> <?php  echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true),array('class' => 'grayc', 'escape'=>false, 'title' => __l('Diagnostics')));?> </li>
        <li class="span"> <?php  echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id'), 'admin' => true), array('class' => 'grayc', 'escape'=>false, 'title' => __l('My Account')));?> </li>
        <li class="span"> <?php  echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'change_password', 'admin' => true),array('class' => 'grayc', 'escape'=>false, 'title' => __l('Change Password')));?> </li>
        <li class="span"> <?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'js-no-pjax blackc textb', 'escape'=>false, 'title' => __l('Logout')));?></li>
      </ul>
    </div>
  </div>
</div>