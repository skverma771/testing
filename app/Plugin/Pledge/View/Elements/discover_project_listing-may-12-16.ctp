	<?php if(!empty($this->request->params['named']['project_type'])): ?>
	<div class="span no-mar">
    <div class="bot-mspace clearfix pledge-block creative-ideas" itemtype="http://schema.org/Product" itemscope>
	<div class="circ space row offset1">
      <div class="pledge-status img-circle dc whitec" itemprop="Name">
      <span class="show top-space">
	  <?php echo $this->Html->image('pledge-hand.png', array('alt' => sprintf(__l('[Image: %s]'), Configure::read('project.alt_name_for_pledge_singular_caps')) ,'width' => 67, 'height' => 67)); ?></span><?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>
      </div>
	  </div>
      <p class="dc" itemprop="description"><?php echo sprintf(__l("In %s %s, amount is captured by end date and may offer %s."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p>
    </div>
    <?php if (isPluginEnabled('Idea')): ?>
      <article class="list-block">
        <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'is_idea' => 1, 'limit' => 4, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
      </article>
    <?php endif; ?>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'featured', 'limit' => 4, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'ending_soon', 'limit' => 4, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'almost_funded', 'limit' => 4, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'successful', 'limit' => 4, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    </div>
	<?php else: ?>
    <article class="list-block pledge-block space">
   <div class="span5 clearfix creative-ideas">
	<div class="circ space row offset1">
      <div class="pledge-status img-circle dc whitec" itemprop="Name">
      <span class="show top-space">
	  <?php echo $this->Html->image('pledge-hand.png', array('alt' => __l('[Image: Pledge]') ,'width' => 67, 'height' => 67)); ?></span><?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>
      </div>
	  </div>
      <p class="span4 hor-space"><?php echo sprintf(__l("In %s %s, amount is captured by end date and may offer %s."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p>
	  <span class="ver-mspace clearfix dc show span4"><?php echo $this->Html->link(__l('Browse All'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'text-16 js-tooltip','title' => __l('Browse All')));?></span>
    </div>
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'browse', 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
	<?php endif; ?>