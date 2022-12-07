
<section class="clearfix bot-space container">
<div class="row mspace">

<?php if(empty($this->request->params['named']['project_type'])) { ?>
<div class="dc top-space ver-mspace"><h4 class="bot-space"><?php echo sprintf(__l('Trending Projects')); ?></h4></div>
<?php } ?>

<?php 
	  foreach($projectTypes as $projectType):
		if(isPluginEnabled($projectType['ProjectType']['name'])){
			if((!empty($this->request->params['named']['project_type']) && $this->request->params['named']['project_type'] ==  $projectType['ProjectType']['slug']) || empty($this->request->params['named']['project_type']))
				echo $this->element($projectType['ProjectType']['name'].'.discover_project_listing');
	   }
	  endforeach;
	?>
</div>
</section>
<?php if (Configure::read('widget.home_script')) { ?>
      <div class="dc clearfix bot-space">
      <?php echo Configure::read('widget.home_script'); ?>
      </div>
<?php } ?>