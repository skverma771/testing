<?php /* SVN: $Id: $ */ ?>
<div class="projectFlagCategories form">
  <?php echo $this->Form->create('ProjectFlagCategory', array('class' => 'form-horizontal space'));?>
    <ul class="breadcrumb">
      <li><?php echo $this->Html->link(sprintf(__l('%s Flag Categories'), Configure::read('project.alt_name_for_project_singular_caps')), array('action' => 'index'),array('title' => sprintf(__l('%s Flag Categories'), Configure::read('project.alt_name_for_project_singular_caps'))));?><span class="divider">&raquo</span></li>
      <li class="active"><?php echo sprintf(__l('Add %s'), sprintf(__l('%s Flag Category'), Configure::read('project.alt_name_for_project_singular_caps')));?></li>
    </ul>
    <ul class="nav nav-tabs">
      <li><?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?></li>
      <li class="active"><a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add');
      ?></a></li>
    </ul>
    <?php echo $this->Form->input('name'); ?>
    <?php echo $this->Form->input('is_active', array('label' => __l('Active?')));?>
    <div class="form-actions"><?php echo $this->Form->submit(__l('Add'));?></div>
  <?php echo $this->Form->end();?>
</div>