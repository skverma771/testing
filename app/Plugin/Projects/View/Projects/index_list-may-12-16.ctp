<section class="clearfix bot-space container">
  <h4 class="dc space bot-mspace sep-bot">
    <?php echo __l('Crowdfunding Options'); ?>
  </h4>
  <div class="clearfix no-mar dc">
<?php 
	  foreach($projectTypes as $projectType):
		if(isPluginEnabled($projectType['ProjectType']['name'])){
				echo $this->element($projectType['ProjectType']['name'].'.home_project_listing');
	   }
	  endforeach;
?>
</div>
</section>