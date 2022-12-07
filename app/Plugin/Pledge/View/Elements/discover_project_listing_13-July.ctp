<section class="pr z-top">
<div class="bot-mspace clearfix pledge-block creative-ideas tip-block" itemtype="http://schema.org/Product" itemscope>
	<div class="circ space row">
      <div class="dc whitec tooltip-display" itemprop="Name">
      <span class="show-inline top-space js-tooltip" title="pushing the button allows viewer to tip a performance; the offered amount will captured and held in a Busker's account until the project end date is reached, funds are then released." data-placement="bottom">
	  <?php echo $this->Html->image('pledge-hand.png', array('alt' => sprintf(__l('[Image: %s]'), Configure::read('project.alt_name_for_pledge_singular_caps')) ,'width' => 100, 'height' => 100)); ?></span>
      </div>
	  </div>
      <!--p class="dc" itemprop="description"><?php echo sprintf(__l("pushing the button allows viewer to tip a performance; <br/> the offered amount will captured and held in a Busker's account until the project <br/> end date is reached, funds are then released."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p-->
</div>
</section>

<section>
<div class="row span24 no-mar">

  <div class="span6 right-mspace ver-space">

	  <div class="filter-menu">
		<h3 class="text-14 mtop-20 textb">Browse Projects</h3>
			<ul class="unstyled side-bar order-list no-mar">				
				<li><?php echo $this->Html->link('Recommended',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'recommended',
														)); ?></li>
				<li><?php echo $this->Html->link('Popular',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'popular',
														)); ?></li>	
				<li><?php echo $this->Html->link('Almost Funded',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'almost_funded',
														)); ?></li>
				<li><?php echo $this->Html->link('Ending Soon',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'ending_soon',
														)); ?></li>		
				<li><?php echo $this->Html->link('Small Projects',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'small_projects',
														)); ?></li>
				<li><?php echo $this->Html->link('Hall of Fame',array(
												'controller' => 'projects',
												'action' => 'index',
												'project_type' => 'pledge',
												'filter'=>'hall_of_fame',
														)); ?></li>															
				
			</ul>
		</div>

		<div class="filter-menu filter-menu-1">
		
			<?php echo $this->element('Pledge.pledge_project_categories-list'); ?>
			<!-- <ul class="unstyled side-bar no-mar">
				<li><a href="#" title="Street Mime">Street Mime</a></li>
				<li><a href="#" title="Street Musicians">Street Musicians</a></li>
				<li><a href="#" title="Street Rap ">Street Rap </a></li>
				<li><a href="#" title="Street Spoken Word">Street Spoken Word</a></li>
				<li><a href="#" title="Street Statue ">Street Statue </a></li>
				<li><a href="#" title="Street Theatre ">Street Theatre </a></li>
			</ul>
		<div class="paging-bg dc ver-space">
			<div class="paging-new clearfix">
				<span><a href="#" class="prev">Prev</a></span>
				<span><a href="#">1</a></span> 
				<span class="current active">2</span>
				<span class="next">Next</span>
			</div>
		</div> -->
	</div>

</div>


<div class="span18 no-mar">  	
	<?php if(!empty($this->request->params['named']['project_type'])): ?>
	<div class="span no-mar top-mspace">
    <?php if (isPluginEnabled('Idea')): ?>
      <article class="list-block">
        <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'is_idea' => 1, 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
      </article>
    <?php endif; ?>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'featured', 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'ending_soon', 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'almost_funded', 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    <article class="list-block">
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'successful', 'limit' => 3, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
    </div>
	<?php else: ?>
    <article class="list-block pledge-block ver-space">
   <div class="span6 clearfix creative-ideas">
	<div class="circ space row offset1">
      <div class="dc whitec" itemprop="Name">
      <span class="show top-space">
	  <?php echo $this->Html->image('pledge-hand.png', array('alt' => __l('[Image: Pledge]') ,'width' => 100, 'height' => 100)); ?></span>
      </div>
	  </div>
      <p class="span5 hor-space dc"><?php echo sprintf(__l("When tipping a performance, the offered amount is captured and held in a Busker's account until the project end date is reached. <br/> <br/> Then, Buskerdues releases funds to the respective project owner."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p>
	  <span class="ver-mspace clearfix dc show span4"><?php echo $this->Html->link(__l('Browse All'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'text-16 js-tooltip','title' => __l('Browse All')));?></span>
    </div>
      <?php echo $this->element('discover_projects-index', array('project_type' => 'pledge', 'filter' => 'browse', 'limit' => 2, 'cache' => array('config' => 'sec', 'key' => $this->Auth->user('id'))));?>
    </article>
	<?php endif; ?>

	</div>
</div>
</section>