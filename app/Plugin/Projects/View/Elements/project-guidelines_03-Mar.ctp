<div class="ver-space ver-mspace">
  <div class="sep-top page-header no-bor">
   <span class="span project-logo">
   <?php echo $this->Html->image($project_type.'-s-icon.png', array('alt'=>$project_type, 'width' => '52', 'height' => '52')); ?> </span>
   <h2 class="dc pr ver-space"><span class="or-hor pa linkc top-mspace"><?php echo __l('Start Project');?></span></h2>
   <?php if(!empty($_SESSION['lendDetails'])){ ?>
	  <dl class="space offset3 clearfix">
		<dt class="pull-left textb hor-space"><?php echo __l('Needed Amount').' ('.Configure::read('site.currency').')'; ?></dt>
		<dd class="pull-left hor-space"><?php echo $this->Html->cInt($_SESSION['lendDetails']['lend_needed_amount']); ?></dd>
		<dt class="pull-left textb hor-space"><?php echo __l('Terms'); ?></dt>
		<dd class="pull-left hor-space"><?php echo Configure::read('lend.default_terms') . ' months'; ?></dd>
		<dt class="pull-left textb hor-space"><?php echo __l('Interest Rate (%)'); ?></dt>
		<dd class="pull-left hor-space"><?php echo $this->Html->cFloat($_SESSION['lendDetails']['lend_interest_rate']); ?></dd>
		<dt class="pull-left textb hor-space"><?php echo __l('Monthly Repayment').' ('.Configure::read('site.currency').')'; ?></dt>
		<dd class="pull-left hor-space"><?php echo $this->Html->cCurrency($_SESSION['lendDetails']['lend_per_month']); ?></dd>
	</dl>
  <?php } ?>
  <div class="clearfix page-header no-bor top-space">
    <div class="span18 dc">
	<?php if (isPluginEnabled('Idea')): ?>
	<?php echo $this->Html->image('idea-steps.png', array('alt' =>__l('Project Steps'), 'width' => '531', 'height' => '108')); ?>
	<?php else: ?>
	<?php echo $this->Html->image('project-steps.png', array('alt' =>__l('Project Steps'), 'width' => '531', 'height' => '108')); ?>
	<?php endif; ?>
	</div>
    <div class="span5 dc">
    <h4><?php echo __l('How It Works'); ?></h4>
    <i class="icon-question-sign text-46 grayc dc top-space"></i>
    <div><?php echo $this->Html->link(__l('Work flow'), array('controller' => 'nodes', 'action' => 'how_it_works', 'admin' => false), array('title' => __l('Work flow'), 'class' => 'js-tooltip btn btn-module')); ?></div>
    </div>
  </div>
  </div>
  <?php if (isPluginEnabled('Idea')): ?>
  <?php
	if($project_type == 'pledge'){
		$message = 'amount is captured by end date. May offer rewards';
	}elseif($project_type == 'donate'){
		$message = 'people immediately pay to you. Can\'t offer rewards';
	}elseif($project_type == 'equity'){
		$message = 'amount is captured by end date/goal reached. Entrepreneurs offer shares';
	}elseif($project_type == 'lend'){
		$message = 'amount is captured by end date/goal reached of the project. Borrowers offer interest';
	}
  ?>
	<div class="alert alert-info blackc clearfix"><?php echo sprintf(__l("Top voted ideas will be chosen for %s by admin. In %s %s, %s."), Configure::read(sprintf('project.alt_name_for_%s_present_continuous_small', $project_type)), $project_type, Configure::read('project.alt_name_for_project_plural_small'), $message); ?></div>
  <?php endif; ?>
  <?php if($project_type == 'equity' && isPluginEnabled('JobsAct')):?>
    <div class="well">
	  <h3> <?php echo __l('JOBS Act Implications');?></h3>
	  <ol class="hor-mspace space ">
	    <li class="ver-mspace"><?php echo __l('Companies can raise upto $1 million per year via crowdfunding.');?></li>
		<li class="ver-mspace"><?php echo __l('Target offering amount and deadline to reach that amount.');?></li>
		<li class="ver-mspace"><?php echo __l('Disclose shareholders with 20% or more of the company.');?></li>
		<li class="ver-mspace"><?php echo __l('Increases the number of shareholders a company can have before having to register common stock with SEC and become a public company. Now, companies can have 500 unaccredited investors and 2,0000 shareholders');?></li>
	</div>
  <?php endif; ?>
  <div> <?php echo $this->requestAction(array('controller' => 'nodes', 'action' => 'view', 'type' => 'page', 'slug' => 'project_guidelines'), array('return')); ?> </div>
</div>
