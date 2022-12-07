<div class="span24">
  <?php if (!$this->request->params['isAjax']) { ?>
  <div class="clearfix">
    <div class="page-header no-mar"><h2><?php echo sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_plural_caps'));?></h2></div>
    <?php echo $this->element('user-avatar', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
  </div>
  <?php } ?>
  <?php
	  foreach($projectTypes as $projectType):
		  if(isPluginEnabled($projectType['ProjectType']['name'])){
			$data = array(
				'project_type' => Inflector::Pluralize($projectType['ProjectType']['slug']),
				'cache' => array(
					'config' => 'sec',
					'key' => $this->Auth->user('id')
				)
			);
			echo $this->element('myfunds', $data);
	  	 }
	  endforeach;
  ?>
</div>