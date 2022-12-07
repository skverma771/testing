<?php /* SVN: $Id: admin_add.ctp 63884 2011-08-22 09:47:12Z arovindhan_144at11 $ */ ?>
<div class="languages form">
  <?php echo $this->Form->create('Language', array('class' => 'form-horizontal space'));?>
    <ul class="breadcrumb">
      <li><?php echo $this->Html->link(__l('Languages'), array('action' => 'index'),array('title' => __l('Languages')));?><span class="divider">&raquo</span></li>
      <li class="active"><?php echo sprintf(__l('Add %s'), __l('Language'));?></li>
    </ul>
    <ul class="nav nav-tabs">
      <li><?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?></li>
      <li class="active"><a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add');?></a></li>
    </ul>
  <?php
    echo $this->Form->input('name',array('label' => __l('Name')));
    echo $this->Form->input('iso2',array('label' => __l('ISO2')));
    echo $this->Form->input('iso3',array('label' => __l('ISO3')));
    echo $this->Form->input('is_active', array('label' => __l('Active')));
  ?>
  <div class="form-actions">
    <?php echo $this->Form->submit(__l('Add'));?>
    <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'languages', 'action' => 'index'), array( 'title' => __l('Cancel'), 'class' => 'btn js-tooltip', 'escape' => false));?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>