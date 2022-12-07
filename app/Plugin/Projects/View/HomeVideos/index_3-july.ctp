<section>
	<div class="clearfix">
<h2 class="dc textn banner-bottom">
    <?php echo __l('Activating the world one street at a time'); ?>
  </h2>
		
       
		<div id="home-video-hide" class="clearfix adjust-layout pad-20">
		<?php if ($home_videos):?>
			<?php //echo '<pre>'; print_r($home_videos); exit; ?>
			<div class="row dc video-home-page-bg">
				<?php $i=1; ?>
				<?php //foreach ($home_videos as $home_videos): ?>
				<?php	$no_mar_class='';
						if ($i%2==1) {
							$class='no-mar';
						}
				?>
					<div class="clearfix<?php echo $no_mar_class; ?>">
					<div class="dl whitec pr">
					<div class="navbar-right home-video mob-dr pa" style="cursor: pointer;"><?php echo $this->Html->image("close-button.png");?></div>
					</div>
					
						<div class="space videobgcolor">
						
									<div class="pr clearfix bor-grey">
											<div class="span12 no-mar wid-50">
		                                    
												
												<?php
												if (!empty($home_videos[0]['HomeVideo']['video_url'])) {
													if ($this->Embed->parseUrl($home_videos[0]['HomeVideo']['video_url'])) {
														$this->Embed->setObjectAttrib('wmode','transparent');
														$this->Embed->setObjectParam('wmode', 'transparent');
														echo $this->Embed->getEmbedCode();
													}
												}	
												?>
											</div>
											<div class="span12 no-mar pull-right wid-50">
												<div class="right-content">
													<div class="space">
														<?php echo $this->Html->image("download-red.png", array('class' => 'pull-left space', "alt" => "Download PDF",'url' => array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']))); ?>
														<h6 class="space dl whitec">PDF link to files for <?php echo $this->Html->link('free guide', array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'no-under js-no-pjax js-helptip', 'escape' => false));?> download</h6>
													</div>
													<div class="video-title">
														<h3 class="space dl whitec">What makes Jewcer the Chosen Crowdfunding Platform?</h3>
													</div>
											    <!--<ul class="whitec dl video-desc">
														<li>Personal Mentorship</li>
														<li>Tax Deductions for Supporters</li>
														<li>Specialized Grants</li>
														<li>Lower Fees</li>
														<li>An Audience that Cares!</li>
													</ul>-->
													<div class="whitec dl left-space video-desc"><?php echo $home_videos[0]['HomeVideo']['video_description']; ?></div>
													<div class="no-round"> 
														  <div class="clearfix space dl mob-dc">
															  <?php echo $this->Html->link('START YOUR CAMPAIGN', array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'btn btn-large btn-primary js-no-pjax start-btn', 'escape' => false));?><?php echo $this->Html->link('Learn More About Jewcer', array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'btn btn-large btn-primary js-no-pjax  learn-btn', 'escape' => false));?>	
														  </div>
													</div>
												</div>
											</div>
									</div>
									<!--<div class="clear-both dl whitec">
											<h4><?php echo $home_videos[0]['HomeVideo']['video_title']; ?></h4>
									</div>-->
						</div>
				</div>
				<?php //endforeach; ?>
				
			</div>
		<?php endif;  ?>	
		</div>

	</div>
</section>