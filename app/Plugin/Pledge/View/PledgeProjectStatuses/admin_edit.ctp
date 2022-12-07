<?php /* SVN: $Id: $ */ ?>
<div class="projectStatuses form space">
<?php echo $this->Form->create('PledgeProjectStatus', array('class' => 'form-horizontal'));?>
  <fieldset>
  <ul class="breadcrumb">
    <li><?php echo $this->Html->link(sprintf(__l('%s %s Statuses'), Configure::read('project.alt_name_for_pledge_singular_caps'), Configure::read('project.alt_name_for_project_singular_caps')), array('action' => 'index'),array('title' => sprintf(__l('%s %s Statuses'), Configure::read('project.alt_name_for_pledge_singular_caps'), Configure::read('project.alt_name_for_project_singular_caps'))));?><span class="divider">&raquo</span></li>
    <li class="active"><?php echo sprintf(__l('Edit %s'), sprintf(__l('%s %s Status'), Configure::read('project.alt_name_for_pledge_singular_caps'), Configure::read('project.alt_name_for_project_singular_caps')));?></li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
    <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active"><a class="blackc" href="#add_form"><i class="icon-edit"></i><?php echo __l('Edit'); ?></a></li>
  </ul>
  <?php
    echo $this->Form->input('id');
    echo $this->Form->input('name');
  ?>
  </fieldset>
<div class="form-actions">
 <?php echo $this->Form->submit(__l('Update'));?>
</div>
<?php echo $this->Form->end();?>
</div>