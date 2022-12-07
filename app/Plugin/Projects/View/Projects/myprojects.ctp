<div class="span24">
  <?php if (!$this->request->params['isAjax']) { ?>
  <div class="clearfix">
    <div class="page-header no-mar"><h2><?php echo sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps'));?></h2></div>
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
			echo $this->element('myprojects', $data);
		}
	endforeach;
  ?>
</div>
<div class="modal hide fade" id="js-ajax-modal">
    <div class="modal-body"></div>
    <div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
</div>