<section>
<?php if(!empty($montage['Montage'])) {
//echo "<pre>"; print_r($montage); exit;
          ?>
	<div class="container">
			<div class="videoDesBg">
							<div class="video-container">
												<?php
												if (!empty($montage['Montage']['video_url'])) {
													/*if ($this->Embed->parseUrl($montage['Montage']['video_url'])) {
														$this->Embed->setObjectAttrib('wmode','transparent');
														$this->Embed->setObjectParam('wmode', 'transparent');
														echo $this->Embed->getEmbedCode();
													}*/
												$parts = explode('=',  $montage['Montage']['video_url']); ?>	
												<iframe width="420" height="345" src="https://www.youtube.com/embed/<?php echo trim(end($parts), " "); ?>"></iframe>
												<?php
												} else if (!empty($montage['Montage']['attachment_id'])) {
													if(!empty($montage['Attachment']['filename'])){
													
													//echo $montage['Attachment']['filename'];
														echo $this->Html->showImage($montage['Attachment']['class'], $montage['Attachment'], array('dimension' => 'full_thumb'));
													}
												} else {
														//echo "http://img.youtube.com/vi/".$montage['Montage']['video_url']."/0.jpg";
														//echo "http://img.youtube.com/vi/".$montage['Montage']['video_url']."/sddefault.jpg";?>
														<img src="<?php echo Router::url('/', true);?>img/default.jpg" width="100%" height="100%"></img>
												<?php
												}
												?>					
							</div>
			</div>
	</div>
	<div class="videoDesBg"><div class="container ">
    <div class="center-block space">
	<h2 class="space titles">
	<?php if(!empty($montage['Project'])) { ?>
	<a href="<?php echo Router::url('/', true);?>project/<?php echo $montage['Project']['slug']; ?>"><?php echo $montage['Montage']['title']; ?></a>
	<a class="pull-right dance-btn" href="<?php echo Router::url('/', true);?>montages/index/pledge/id:<?php echo $montage['Pledge']['pledge_project_category_id']; ?>"><button class="btn btn-large btn-primary" type="button"><?php echo $montage['PledgeProjectCategory']['name']; ?></button></a></h2>
	<?php } ?>
	<p class="space text-justify align_txt"><?php echo $montage['Montage']['description']; ?></p>
    <?php if(!empty($montage['Pledge']) && !empty($montage['PledgeProjectCategory'])) {?>
	<div class="support-seemore">
	<a href="<?php echo Router::url('/', true);?>how-it-works"><button class="btn btn-large btn-primary" type="button">Support</button></a>
	<a href="<?php echo Router::url('/', true);?>project_funds/add/"<?php echo $montage['Project']['id']; ?>><button class="btn btn-large btn-primary" type="button">See More</button></a>
	</div>
	<?php }?>
	</div>
    </div>
    </div>
	<?php } ?>
	
</section>