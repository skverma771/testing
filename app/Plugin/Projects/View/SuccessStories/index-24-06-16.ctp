<section>
	<div class="clearfix">

		<div class="well no-round banner-block banner-block-new"> 
			  <div class="container dc">
					<div class="clearfix top-space"> 
						 <a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary start-busking-bg"> Start busking</a>
					 </div>
			  </div>
		</div>

		<h2 class="dc space bot-mspace textn p-btm-40"> Activating the world one street at a time </h2>


		<div class="no-mar dc pr p-btm-40">

			<div class="pull-left pa top-left mob-ps">
				<h1 class="text-50">Success</h1>
				<h5>awesome busking stories</h5>
			</div>

			<div class="bot-mspace clearfix pledge-block bot-space show-inline" itemtype="http://schema.org/Product" itemscope>
			   <div class="home-round-block js-home-hover clearfix no-mar">
					<div class="span dc clearfix top-space pledge"><span class="span no-mar ver-space"><?php echo $this->Html->link(__l('Browse'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'text-16 js-tooltip','title' => __l('Browse')));?></span><span class="space textb span no-mar text-14"><?php echo __l('OR'); ?></span><?php echo $this->Html->link(sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'projects', 'action' => 'add', 'project_type'=>'pledge', 'admin' => false), array('title' => sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')),'class' => 'btn btn-module span ver-smspace js-tooltip', 'escape' => false));?>
				  </div>
				</div>
			</div>
		</div>

		<div class="clearfix pad-right-left adjust-layout">
		<?php if ($success_stories):?>
			<?php //echo '<pre>'; print_r($success_stories); exit; ?>
			<div class="row dc">
				<?php $i=1; ?>
				<?php foreach ($success_stories as $success_story): ?>
				<?php	$no_mar_class='';
						if ($i%2==1) {
							$class='no-mar';
						}
				?>	
					<div class="pr span15 <?php echo $no_mar_class; ?>">
						<div class="space lighter-green-bg">
								<h5 class="grey-bg-head dc pa"><?php echo $this->Html->link('View Busker',array('controller'=>'projects','action'=>'view',$success_story['Project']['slug'])); ?></h5>
									<div class="pr over-hide">
											<div class="span8 no-mar">
												<?php
												if (!empty($success_story['SuccessStory']['video_url'])) {
													if ($this->Embed->parseUrl($success_story['SuccessStory']['video_url'])) {
														$this->Embed->setObjectAttrib('wmode','transparent');
														$this->Embed->setObjectParam('wmode', 'transparent');
														echo $this->Embed->getEmbedCode();
													}
												}	
												?>
											</div>
											<div class="span5 no-mar">
												<h5 class="text-18 space darkgreyC auto-height dl"><?php echo $this->Html->cCurrency($success_story['Project']['collected_amount']);?> pledged</h5>
													<div class="progress progress-mini progress-module progress-bar-alter no-mar span4">
														<?php
															if ($success_story['Project']['collected_percentage']>100) {
																$percentage=100.00;
															} else {
																$percentage = $this->Html->cFloat($success_story['Project']['collected_percentage'],false);
															}
															
															
														?>
														<div style="width:<?php echo $percentage; ?>%;" title="<?php echo $this->Html->cFloat($success_story['Project']['collected_percentage'], false).'%'; ?>" class="bar"></div>
														<p class="pull-left"><?php echo $this->Html->cFloat($success_story['Project']['collected_percentage'], false).'%'; ?> funded</p>
													</div>
													<div class="span1">
														<p class="text-12 textb blackc"><?php echo $this->Html->cFloat($success_story['Project']['collected_percentage'], false).'%'; ?> funded</p>
													</div>
													<div class="pa align-loc mob-ps dl"><p class="darkgreyC"><?php echo $success_story['Project']['State']['name'].','.$success_story['Project']['Country']['name']; ?></p> </div>
											</div>
									</div>
									<div class="clear-both dl">
										<?php if ($success_story['SuccessStory']['use_project_details']){ ?>
											<h4><i><?php echo $success_story['Project']['name']; ?></i></h4>
											<?php echo $success_story['Project']['description']; ?>
										<?php 	} else { ?>
											<h4><i><?php echo $success_story['SuccessStory']['title']; ?></i></h4>
											<?php echo $success_story['SuccessStory']['description']; ?>
									<?php	}?>
										
										
										
									</div>
						</div>
				</div>
				<?php endforeach; ?>
				
			</div>
		<?php endif;  ?>	
		</div>

	</div>
</section>