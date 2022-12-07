<section class="clearfix bot-space container">
  <h2 class="dc space bot-mspace textn p-btm-40">
    <?php echo __l('Activating the world one street at a time'); ?>
  </h2>
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