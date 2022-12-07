<section>
<!--.list-block ol.thumbnails > li:hover .list-details { margin-top: 150px; } -->

<div class="js-response clearfix">

		<div class="well no-round banner-block banner-block-new"> 
			  <div class="container dc">
					<div class="clearfix top-space"> 
					 	<a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary start-busking-bg"> Start busking</a>
                    </div>
			  </div>
		</div>
<div class="light-green-bg txt montage-block">	
  <div class="project-block" id="js-pledge-trending_performance-scroll">
    <div class="montage-main">
	  <?php if (!empty($project_categories)) :
	  //echo "<pre>";
	  //print_r($project_categories); ?>
			<div class="span4">
			<label class="label-adjust">Browse Category</label>
			</div>
			<select class="span6 browse_filter offset4" onchange="if (this.value) window.location.href=this.value;">
			<option value = "">Select</option>
			 <?php 
			
			 foreach ($project_categories as $project_categorie) { 
			 if(!empty($category_id) && ($category_id == $project_categorie['PledgeProjectCategory']['id'])) {
			 //exit;
			 ?>
			 <option value = '<?php echo Router::url('/', true);?>montages/index/id:<?php echo $project_categorie['PledgeProjectCategory']['id']; ?>' selected="selected"><?php echo $project_categorie['PledgeProjectCategory']['name']; ?></option>
			<?php } else { ?>
			 <option value = '<?php echo Router::url('/', true);?>montages/index/id:<?php echo $project_categorie['PledgeProjectCategory']['id']; ?>'><?php echo $project_categorie['PledgeProjectCategory']['name']; ?></option>
			<?php } }?>
			</select>
	 <?php endif;?>
    <div>
	 <?php if ($montages):?>
	  <article class="">
	  <ol class="clearfix clsmontage-list">
		
			<?php //echo '<pre>'; print_r($montages); exit; ?>
				<?php $i=1; ?>
				<?php foreach ($montages as $montage): ?>
				<?php	$no_mar_class='';
						if ($i%2==1) {
							$class='no-mar';
						}
						$name = null;
						$description = null;
						if ($montage['Montage']['use_project_details']){ 
									$name = substr($montage['Project']['name'], 0, 20);
									$description = substr($montage['Project']['description'],0,100); }
							else { 
									$name = substr($montage['Montage']['title'], 0, 30);  
									$description = substr($montage['Montage']['description'],0,100); } 
									?>	
					<li class="simple_layout">
					<a  class="links montage-link" href="<?php echo Router::url('/', true)."montages/view/".$montage['Montage']['id'];?>">
					<section class="montage">
					<div class="montage-list-content montage-content pr">
					<?php						
												if (!empty($montage['Montage']['attachment_id']) && empty($montage['Montage']['video_url'])) {
													if(!empty($montage['Attachment']['filename']) && $montage['Attachment']['class'] == 'Montage'){
														echo $this->Html->showImage($montage['Attachment']['class'], $montage['Attachment'], array('dimension' => 'youtube_thumb','class' => 'js-tooltip','title' => $this->Html->cText($montage['Attachment']['filename'], false)));
													}
													else if(!empty($montage['Attachment']['filename']) && $montage['Attachment']['class'] == 'Project') {
														echo $this->Html->showImage($montage['Attachment']['class'], $montage['Attachment'], array('dimension' => 'big_thumb','class' => 'js-tooltip','title' => $this->Html->cText($montage['Attachment']['filename'], false)));
													}
												}
												else if(!empty($montage['Montage']['video_url'])){ 
														$parts = explode('=',  $montage['Montage']['video_url']);?>
														<img src="https://img.youtube.com/vi/<?php echo trim(end($parts), " "); ?>/hqdefault.jpg"></img>
												<?php
												} else {?>
												<img src="<?php echo Router::url('/', true);?>img/default.jpg" width="100%" height="100%"></img>
											<?php }?>
						<div class="face montage-list-content">
						<section class="meta-slide-up">
							<div class="show-meta"><div class="title-container">
									<div class="clearfix bot-mspace dropdown wordwrap pa clsListHd">
									
									</div>       
							</div></div>
                            
						</section></div>
						</div>
						
					</section>
					<div class="dec wordwrap text-justify desc-adjust text-12">
							<h5 class="links"><?php echo $name; ?></h5>
							<?php echo $description; ?>
					</div>
					</a>
						<div class="clearfix  space wordwrap dropdown clsListHd montage-title">
							<p class="text-14 no-mar montage-name"><a  class="" href="<?php echo Router::url('/', true)."montages/view/".$montage['Montage']['id'];?>"><?php echo $name; ?></a></p>
						</div><br>
						
				</li>
				
				<?php endforeach; ?>	
				</ol>
			</article>
		<?php else: ?>
				<div class="span24 redc text-24 space">
				<?php echo "The Montage Videos Not Found"; ?>
				</div>
		<?php endif;  ?>			 
        </div>
			<section>
				<?php if (!empty($montages)) { ?>
				<div class="pull-right span4 mob-clr adjust">
				<div class="paging clearfix js-pagination js-no-pjax">
					<?php echo $this->element('paging_links'); ?>
				</div>
				</div>
				<?php } ?>
			</section>
			 
		</div>
		
	</div>
		
	</div>
	</div>
</section>