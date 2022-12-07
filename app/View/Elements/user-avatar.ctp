<section class="row ver-space">
  <div class="span14">
    <div class="row">
	 <div class="span dc pull-left">
		<img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).$this->request->params['controller'].'/'.$this->request->params['action']; ?>&chs=120x120&chld=L|0" alt="QR Code" >
          <div class="clearfix">
            <h6><a href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).$this->request->params['controller'].'/'.$this->request->params['action']; ?>&chs=120x120&chld=L|0" download title="Download QR Code"/>Download (120 x 120)</a></h6>
          </div>
          <div class="clearfix">
              <h6><a href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).$this->request->params['controller'].'/'.$this->request->params['action']; ?>&chs=250x250&chld=L|0" download title="Download QR Code"/>Download (250 x 250)</a></h6>
          </div>
          <div class="clearfix">
              <h6><a href = "https://chart.googleapis.com/chart?cht=qr&chl=<?php echo Router::url('/', true).$this->request->params['controller'].'/'.$this->request->params['action']; ?>&chs=400x400&chld=L|0" download title="Download QR Code"/>Download (400 x 400)</a></h6>
          </div>  
      </div>
      <div class="span no-mar dc pull-left">
        <?php echo $this->Html->getUserAvatar(!empty($logged_in_user['User']) ? $logged_in_user['User'] : '', 'user_thumb'); ?>
      </div>
      <div class="span5">
        <?php if(!empty($logged_in_user['User']['username'])):?>
          <h4 class="ver-space"><?php echo $this->Html->link($this->Html->cText($logged_in_user['User']['username']), array('controller' => 'users', 'action' => 'view',  $logged_in_user['User']['username'], 'admin' => false), array('escape' => false, 'title'=>$this->Html->cText($logged_in_user['User']['username'], false))); ?></h4>
        <?php endif;?>
        <?php if(!empty($logged_in_user['User']['created'])):?>
          <p class="no-mar"><?php echo __l('Joined:'); ?> <span class="textb"><?php  echo $this->Html->cDateTimeHighlight($logged_in_user['User']['created']); ?></span></p>
        <?php endif; ?>
        <?php
          $location = array();
          $place = '';
          if (!empty($logged_in_user['UserProfile']['City']['name'])) :
            $location[] = $this->Html->cText($logged_in_user['UserProfile']['City']['name'],false);
          endif;
          if (!empty($logged_in_user['UserProfile']['Country']['name'])):
            $location[] = $this->Html->cText($logged_in_user['UserProfile']['Country']['name'],false);
          endif;
          $place = implode(', ', $location);
        ?>
        <?php if ($place): ?>
          <?php if(!empty($logged_in_user['UserProfile']['Country']['iso_alpha2'])): ?>
            <p class="no-mar">
              <span class="flags flag-<?php echo strtolower($logged_in_user['UserProfile']['Country']['iso_alpha2']); ?>" title ="<?php echo $logged_in_user['UserProfile']['Country']['name']; ?>"><?php echo $this->Html->cText($logged_in_user['UserProfile']['Country']['name'],false); ?></span>
              <?php echo  ' ' . $place; ?>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="span10">
  <?php echo $this->element('settings-menu', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
    <ul class="row unstyled pull-right">
      <?php if (isPluginEnabled('Wallet')): ?>
        <li class="span3"><span class="show textb"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($logged_in_user['User']['available_wallet_amount'],false)); ?></span><span class="show"><?php echo sprintf(__l('Available Balance')); ?></span></li>
      <?php endif; ?>
	  <li class="span3"><span class="show textb">
	  <?php 
		if($this->request->params['controller'] == 'user' && $this->request->action == 'view') { 
		  echo $this->Html->cInt($project_count, false);  
		} else { 
		  echo $this->Html->cInt($all_project_count, false); 
		} 
	  ?>
	  </span><span class="show"><?php echo sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
      <?php if (isPluginEnabled('Idea')): ?>
        <li class="span3"><span class="show textb"><?php echo $this->Html->cInt($idea_count, false); ?></span><span class="show"><?php echo __l('Ideas Posted'); ?></span></li>
      <?php endif; ?>
        <li class="span3"><span class="show textb"><?php echo !empty($logged_in_user['User']['unique_project_fund_count'])? $this->Html->cInt($logged_in_user['User']['unique_project_fund_count'], false):'0'; ?></span><span class="show"><?php echo sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
        <li class="span3"><span class="show textb"><?php echo !empty($project_following_count) ? $this->Html->cInt($project_following_count, false) : '0'; ?></span><span class="show"><?php echo sprintf(__l('Following %s'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
    </ul>
  </div>
</section>
<section class="clearfix sep-top">
  <?php
    $border_class = ($this->request->params['controller'] == 'messages' || ($this->request->params['controller'] == 'users' && $this->request->params['action'] != 'dashboard'))? ' nav-tabs':'';
  ?>
  <ul class="unstyled nav clearfix top-space cus-menu bot-mspace <?php echo $border_class; ?>">
    <?php
      $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'dashboard') ? ' active' : '';
      $a_class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'dashboard') ? ' whitec' : '';
    ?>
      <li class="span no-mar bot-space <?php echo $class;?>"><?php echo $this->Html->link('<i class="icon-rss"></i>'.__l('Activities'), array('controller' => 'users', 'action' => 'dashboard'), array('class' => $a_class . ' btn cur no-bor js-tooltip', 'escape' => false, 'title' => __l('Activities'))); ?></li>
    <?php if (isPluginEnabled('Pledge') || isPluginEnabled('Donate') || isPluginEnabled('Lend')|| isPluginEnabled('Equity')): ?>
      <?php
        $class = ($this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'myprojects') ? ' active' : '';
        $a_class = ($this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'myprojects') ? ' whitec' : '';
      ?>
      <li class="span bot-space <?php echo $class;?>"><?php echo $this->Html->link('<i class="icon-book"></i>' . Configure::read('project.alt_name_for_project_plural_caps') . ' ' . __l('Posted') , array('controller' => 'projects', 'action' => 'myprojects'), array('title' => Configure::read('project.alt_name_for_project_plural_caps') . ' ' . __l('Posted'), 'class' => $a_class . ' btn cur no-bor js-tooltip', 'escape' => false)); ?></li>
      <?php
        $class = ($this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'myfunds') ? ' active' : '';
        $a_class = ($this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'myfunds') ? ' whitec' : '';
      ?>
      <li class="span bot-space <?php echo $class;?>"><?php echo $this->Html->link('<i class="icon-dashboard"></i>' . Configure::read('project.alt_name_for_project_plural_caps') . ' ' . __l('Funded'), array('controller' => 'projects', 'action' => 'myfunds'), array('class' => $a_class . ' btn cur no-bor js-tooltip', 'escape' => false, 'title' => Configure::read('project.alt_name_for_project_plural_caps') . ' ' . __l('Funded'))); ?></li>
    <?php endif; ?>
    <?php
      $class = ($this->request->params['controller'] == 'transactions' && $this->request->params['action'] == 'index') ? ' active' : '';
      $a_class = ($this->request->params['controller'] == 'transactions' && $this->request->params['action'] == 'index') ? ' whitec' : '';
    ?>
    <li class="span bot-space <?php echo $class;?>"><?php echo $this->Html->link('<i class="icon-resize-full"></i>'.__l('Transactions'), array('controller' => 'transactions', 'action' => 'index'), array('class' => $a_class . ' btn cur no-bor js-tooltip', 'escape' => false, 'title' => __l('Transactions'))); ?></li>
    <?php if (isPluginEnabled('Affiliates')): ?>
      <?php
        $class = ($this->request->params['controller'] == 'affiliates' && $this->request->params['action'] == 'index') ? ' active' : '';
        $a_class = ($this->request->params['controller'] == 'affiliates' && $this->request->params['action'] == 'index') ? ' whitec' : '';
      ?>
      <li class="span bot-space <?php echo $class;?>"><?php echo $this->Html->link('<i class="icon-group"></i>'.__l('Affiliate'), array('controller' => 'affiliates', 'action' => 'index'), array('class' => $a_class . ' btn cur no-bor js-tooltip', 'escape' => false, 'title' => __l('Affiliate'))); ?></li>
    <?php endif; ?>
  </ul>
</section>