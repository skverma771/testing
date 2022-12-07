<?php   
  $total_span = 23;
  $plugin_count = count($projectTypes);
  $offset = floor(($total_span - (5 * $plugin_count)) / 2);
?>  
<section id="pjax-bodyy">
<section class="clearfix ver-space container <?php echo $this->Html->getUniquePageId();?>" id="main">
  <h2 class="dc pr project-status-7 start-title"><span class="pa"><?php echo __l('Start Project'); ?></span></h2>
  <section class="row ver-space">
  <div class="span20 offset2 bot-space">
   <div class="bot-space"><p class="dc text-16 bot-space start-view"><?php echo __l('Have idea? No money? Need someone to help? Start a project and use crowd power to raise funds.'); ?> </p></div>
  </div>
   <div class="offset<?php echo $offset; ?>">
	<?php 
	foreach($projectTypes as $projectType):
		if(isPluginEnabled($projectType['ProjectType']['name'])){
			echo $this->element($projectType['ProjectType']['name'].'.start'); 
		}
	endforeach;
	?>
   </div>
  </section>
</section>
</section>