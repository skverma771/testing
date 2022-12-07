  <div class="no-mar dc">
    <div class="bot-mspace clearfix bot-space show-inline" itemtype="http://schema.org/Product" itemscope>
       <div class="home-round-block clearfix no-mar">
         <!--div class="circ space row offset1">
           <div class="pledge-status img-circle dc whitec" itemprop="Name"><span class="show top-space"><?php echo $this->Html->image('pledge-hand.png', array('width'=>67, 'height'=>67)); ?></span><?php echo Configure::read('project.alt_name_for_pledge_singular_caps'); ?>
			</div>
           </div-->
            <!--p class="span5 dl" itemprop="description"><?php echo sprintf(__l("In %s %s, amount is captured by end date and may offer %s."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p-->

			<div class="dc clearfix pledge">
				<span class="span no-mar">
					<?php echo $this->Html->link(__l('Browse'), array('controller' => 'projects', 'action' => 'discover'/*, 'project_type'=>'pledge'*/ , 'admin' => false), array('class'=>'btn btn-module span5 ver-smspace js-tooltip','title' => __l('Browse')));?>
				</span>
				<span class="space textb span no-mar text-14"><?php echo __l('OR'); ?></span>
				<span class="span no-mar">
				<?php echo $this->Html->link(sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'projects', 'action' => 'add', 'project_type'=>'pledge', 'admin' => false), array('title' => sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')),'class' => 'btn btn-module span5 ver-smspace js-tooltip', 'escape' => false));?>
				</span>
          </div>
        </div>
 </div>
 </div>
