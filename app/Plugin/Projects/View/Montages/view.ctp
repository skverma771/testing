<section>
<?php if(!empty($montage['Montage'])) {
//echo "<pre>"; print_r($montage); exit;
          ?>
	<div class="container">
			<div class="videoDesBg">
							<div class="video-container">
                                <!-- 
													/*if ($this->Embed->parseUrl($montage['Montage']['video_url'])) {
														$this->Embed->setObjectAttrib('wmode','transparent');
														$this->Embed->setObjectParam('wmode', 'transparent');
														echo $this->Embed->getEmbedCode();
													}*/
												// $parts = explode('=',  $montage['Montage']['video_url']); ?>	
												<iframe width="420" height="345" src="https://www.youtube.com/embed/<?php echo trim(end($parts), " "); ?>"></iframe> -->
												<?php
                                                function hotFixEmbed($url, $type = null)
                                                {
                                                    if(strpos($url, 'youtu') !== false) {
                                                        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
                                                        if (preg_match($pattern, $url, $match)) {
                                                            return '<iframe width="100%" height="324" src="https://www.youtube.com/embed/'.$match[1].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                        }
                                                    }
                                                }

												if (!empty($montage['Montage']['video_url'])) {
                                                    echo hotFixEmbed($montage['Montage']['video_url']);
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
	<div class="videoDesBg">
	<div class="container">
		<div class="row">
			<div class="span10">			
				<h2 class="space titles">
					<?php if(!empty($montage['Project'])) { 						
						?>
						<a href="<?php echo Router::url('/', true);?>project/<?php echo $montage['Project']['slug']; ?>"><?php echo $montage['Montage']['title']; ?></a>
					<?php } ?>	
				</h2>
			</div>
			<div class="span11" style="margin-top:15px;">
			<?php if ($montage['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $montage['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached): ?>
			<?php echo $this->Html->link('tip', array('controller' => 'project_funds', 'action' => 'add', $montage['Project']['id']), array('title' => 'more info','class'=>'pull-left span3 btn btn-large btn-primary', 'escape' => false)); ?>
			<?php endif; ?>
				<a class="pull-left dance-btn" href="<?php echo Router::url('/', true);?>project/<?php echo $montage['Project']['slug']; ?>"><button class="btn btn-large btn-primary" type="button">more info</button></a>	
			</div>			
		</div>
    	<div class="center-block space">			
			<p class="space text-justify align_txt"><?php echo $montage['Montage']['description']; ?></p>
    		<?php if(!empty($montage['Pledge']) && !empty($montage['PledgeProjectCategory']) && $montage['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $montage['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::GoalReached) {?>
				<div class="support-seemore">
					<?php echo $this->Html->link('Tip',array('controller'=>'project_funds','action'=>'add',$montage['Project']['id']),array('class'=>'span4 btn btn-large btn-primary'));?>	
					<a href="<?php echo Router::url('/', true);?>montages/index"><button class="btn btn-large btn-primary" type="button">See More</button></a>
				</div>
			<?php }?>
		</div>
    </div>
    </div>
	<?php } ?>
	
</section>