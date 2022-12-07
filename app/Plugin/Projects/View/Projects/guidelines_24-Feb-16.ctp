<div class="projects form top-space <?php echo $this->request->params['named']['project_type']; ?>">
  <?php
  $disabled_class = 'js-project-submit';
  echo $this->Form->create('Project', array('class' => 'clearfix ' . $disabled_class, 'url' => array('controller' => 'projects', 'action'=> 'add', 'project_type' => $this->request->params['named']['project_type'])));
  echo $this->Form->input('step',array('value'=>'1','type'=>'hidden'));
  echo $this->Form->input('project_type_id',array('value'=>$projectType['ProjectType']['id'],'type'=>'hidden'));
  echo $this->Form->input('project_type_slug',array('value'=>$projectType['ProjectType']['slug'],'type'=>'hidden'));
  if (!empty($this->request->data['Project']['name'])) {
    echo $this->Form->input('name',array('type'=>'hidden'));
  }
  ?>
  <?php if (empty($this->request->params['admin'])): ?>
  <?php
    echo $this->element('project-guidelines', array('project_type' => $projectType['ProjectType']['slug'], 'cache' => array('config' => 'sec')));
    echo $this->Form->input('is_agree_terms_conditions',array('class'=>'js-term js-no-pjax','type'=>'checkbox','label'=>__l('I have read and understand ').Configure::read('site.name').__l('\'s project guidelines.')));
  ?>
  <div class="pull-left ver-mspace">
    <?php echo $this->Form->submit(__l('Continue'), array('class' => 'js-disable btn-module disabled', 'disabled' => true, 'div' => false));?>
  </div>
  <?php else: ?>
  <div class="space">
    <ul class="breadcrumb">
	<li><?php echo $this->Html->link(Configure::read('project.alt_name_for_project_plural_caps'), array('controller' => Inflector::pluralize($projectType['ProjectType']['slug']),'action' => 'index'),array('title' => Configure::read('project.alt_name_for_project_plural_caps')));?><span class="divider">&raquo</span></li>
    <li class="active"><?php echo sprintf(__l('Add %s'), Configure::read('project.alt_name_for_project_singular_caps'));?></li>
    </ul>
    <ul class="nav nav-tabs mspace top-space">
    <li><?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'pledges', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'), 'escape' => false));?></li>
    <li class="active"><a class="blackc" href="#"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a></li>
    </ul>
    <div class="clearfix top-space form-actions">
    <?php echo $this->Form->input('user_id', array('empty' => __l('Please Select'),'label'=>__l('User'))); ?>
    <?php echo $this->Form->submit(__l('Continue'), array('class' => 'btn btn-module')); ?>
    </div>
  </div>
  <?php endif; ?>
  <?php echo $this->Form->end(); ?>
</div>