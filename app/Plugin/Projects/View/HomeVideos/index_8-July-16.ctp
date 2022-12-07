<section>
	<div class="clearfix">

		<div class="well no-round banner-block banner-block-new"> 
			  <div class="container dc">
					<div class="clearfix top-space"> 
						 <a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary start-busking-bg"> Start busking</a>
					 </div>
			  </div>
		</div>
       
		<div id="home-video-hide" class="clearfix pad-right-left adjust-layout">
		<?php if ($home_videos):?>
			<?php //echo '<pre>'; print_r($success_stories); exit; ?>
			<div class="row dc video-home-page-bg">
				<?php $i=1; ?>
				<?php //foreach ($home_videos as $home_videos): ?>
				<?php	$no_mar_class='';
						if ($i%2==1) {
							$class='no-mar';
						}
				?>
					<div class="pr span24 offset2<?php echo $no_mar_class; ?>" style="padding:30px;">
					<div class="dl whitec"><h3 class="dc pa"><?php echo $home_videos[0]['HomeVideo']['title']; ?></h3>
					<div class="pull-right home-video" style="cursor: pointer;"><?php echo $this->Html->image("close-button.png");?></div>
					</div>
					
						<div class="space span24 videobgcolor">
						
									<div class="pr over-hide">
											<div class="span12 no-mar">
		                                    
												
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
											<div class="span12 no-mar pull-right" style="background-color:#000; height:250px;">
											<div class="space">
											<?php echo $this->Html->image("download-red.png", array('class' => 'pull-left space', "alt" => "Download PDF",'url' => array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']))); ?>
											<h6 class="space dl whitec">PDF link to files for <?php echo $this->Html->link('free guide', array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'no-under js-no-pjax js-helptip', 'escape' => false));?> download</h6>
											</div>
											<div class="whitec dl"><?php echo $home_videos[0]['HomeVideo']['video_description']; ?></div>
											<div class="no-round"> 
												  <div class="clearfix space dl">
												  <?php echo $this->Html->link('&DownArrowBar;'.' Download your free '.'HOW TO '.'guide now', array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'btn btn-large btn-primary', 'escape' => false));?>		
												  </div>
											</div>
											</div>
									</div>
									<div class="clear-both dl whitec">
											<h4><?php echo $home_videos[0]['HomeVideo']['video_title']; ?></h4>
									</div>
						</div>
				</div>
				<?php //endforeach; ?>
				
			</div>
		<?php endif;  ?>	
		</div>

	</div>
</section>