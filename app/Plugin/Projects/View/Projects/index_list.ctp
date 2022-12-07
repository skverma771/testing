<section class="clearfix bot-space">
  
  <div class="clearfix no-mar dc ver-mspace">
<?php 
	  foreach($projectTypes as $projectType):
		if(isPluginEnabled($projectType['ProjectType']['name'])){
				echo $this->element($projectType['ProjectType']['name'].'.home_project_listing');
	   }
	  endforeach;
?>
</div>
<?php if (!empty($projects)): ?>
<div class="ver-mspace">
	<div class="clearfix dc">
			<ul class="unstyled over-hide pad-20">
				<?php foreach ($projects as $project): ?>
				<li class="span6 wid-20 pr over-hide pledge project-list">
					<section class="project-bg">
						<h4 class="ptop-space htruncate home-list-title textn"> <?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words']),array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('class' => 'blackc','escape' => false, 'title' => $this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words'])));?></h4>
						<p class="htruncate pbot-space">
							<?php echo __l('by')?> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('escape' => false, 'title' => $this->Html->cText($project['User']['username'], false)));?>
						</p>
						<div style="position:relative;">
                            <span class="rotate" style="display:none;"><i class="icon-repeat icon-2x"></i></span>
						    <?php echo $this->Html->link($this->Html->showImage('Project', $project['Attachment'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false)),array('aspect_ratio'=>1)), array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false)); ?>
						</div>
						<div class="list-content">   
							<p class="htruncate-multiple-lines dl"><?php echo $this->Html->cText($project['Project']['short_description']);?></p>
							<p class="htruncate dl">             
									<span class="top-space no-mar">
									<span class="flags flag-<?= strtolower($project['Country']['iso_alpha2']); ?>"></span><?php echo $project['City']['name'] . ', ' . $project['Country']['name']; ?>
									</span>
							</p>

							<div class="clearfix">
								<dl class="no-mar clearfix pull-left">
								  <dt class="pull-left"><span class="c textn" title="zero"><?php echo $this->Html->cInt($project['Project']['project_fund_count']);?></span></dt>
								  <dd class="pull-left left-smspace"><?php echo __l('Backers'); ?></dd>
								</dl>
								<dl class="no-mar pull-right clearfix">
								  <dt class="pull-right left-smspace textn"><?php echo __l('Followers'); ?></dt>
								  <dd class="pull-right"><span class="c" title="zero"><?php echo $this->Html->cInt($project['Project']['project_follower_count']);?></span></dd>
								</dl>
                            </div>

							<div class="clearfix">
								<dl class="feature-list pull-left">
								<dt class="updates" title="Updates"><?php echo __l('Updates:'); ?></dt>
								<dd>
								<?php
								if(!empty($project['Project']['feed_url'])):
									echo $this->Html->link($this->Html->cInt($project['Project']['project_feed_count'], false), array('controller'=>'project_feeds','action'=>'index',$project['Project']['id']),array('class'=>'js-no-pjax', 'title' =>  __l('Updates'), 'data-target'=>'#updates','escape' => false));
								else:
									echo $this->Html->link($this->Html->cInt($project['Project']['blog_count'], false), array('controller'=>'blogs','action'=>'index','project_id' => $project['Project']['id'],'span_val' => 3),array('class'=>'js-no-pjax', 'title' =>  __l('Updates'),'data-target'=>'#updates', 'escape' => false));
								endif;
								?>
								</dd>
								<dt class="views" title="Views"><?php echo __l('Views:'); ?> </dt>
								<dd>
								<?php echo $this->Html->link($this->Html->cInt($project['Project']['project_view_count']), array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false,'title' => ''));?>
								</dd>
								</dl>
							</div>
                
							<div class="top-space-25 sep-top">
								<div class="progress progress-mini progress-module progress-bar-alter">
									<div style="width:<?php echo ($project['Project']['collected_percentage'] > 100) ? '100%' : $project['Project']['collected_percentage'].'%'; ?>;" title = "<?php echo $this->Html->cFloat($project['Project']['collected_percentage'], false).'%'; ?>" class="bar"></div>
								</div>
								<div class="row-fluid no-mar dl">
									<div class="span7 pull-left no-mar">
										<span class="c" title=""><strong><?php echo $this->Html->cFloat($project['Project']['collected_percentage'], false).'%'; ?></strong></span>
										<p class="no-mar"><?php echo __l('funded'); ?></p>
										
									</div>
									<div class="span7 pull-left">
										<strong>$</strong><span class="c cr" title=""><strong><?php echo $this->Html->cFloat($project['Project']['collected_amount'], false); ?></strong></span>
										<p class="no-mar htruncate"><?php echo __l('tipped'); ?></p>  
									</div>
									<div class="span10 pull-left">
										<?php
										$days = $this->Html->getdays($project['Project']['project_end_date']);
									    $display_text = (round($days['day']) >0) ? __l('days to go') : __l('hours to go');
										if(!empty($days['day']) && round($days['day']) >0):
										  $days = $this->Html->cInt($days['day'], false);
										else:
										  $countdown = 1;
										  $days = round(intval(strtotime($project['Project']['project_end_date'] . ' 23:59:59') - time())/(60 * 60));
										endif;
										?>
										<span class="c" title=""><strong><?php echo $days; ?></strong></span>
										<p class="no-mar htruncate"><?php echo $display_text; ?></p>
									</div>
								</div>
							</div>


						  <div class="no-mar">
							<div class="clearfix dc pledge pledge-btn">
                                <?php echo $this->Html->link(__l('Follow'),array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => 'show-inline btn btn-module mspace dc','title' => __l('Follow'))); ?>
								<?php echo $this->Html->link(__l('Tip'),array('controller' => 'project_funds', 'action' => 'add',$project['Project']['id']),array('class' => 'show-inline btn btn-module mspace dc','title' => __l('Tip'))); ?>
							</div>
						  </div>

					</div>
				</section>
			</li>
			<?php endforeach; ?>
	  </ul>
	
	</div>
</div>
<?php endif;?>
<div class="clearfix dc pledge ver-mspace space">
	<p class="ver-mspace" title="Tip more projects"> 
<?php echo $this->Html->link(__l('Tip more projects'), array('controller' => 'projects', 'action' => 'browse'),array('class' => 'btn hor-mspace btn-primary textb'));?>
	</p>
</div>

<div class="clearfix dc pledge ver-mspace space">
	<p class="ver-mspace text-center" title="Blog">
        <?php echo $this->Html->image('BLOG_BUTTON_MADE.png', array(
            'alt' => 'Buskersdues Blog',
            'style' => 'width: 100px',
            'url' => array('controller' => 'blog', 'action' => 'index', 'admin' => false)
        )); ?>
    </p>
</div>

</section>