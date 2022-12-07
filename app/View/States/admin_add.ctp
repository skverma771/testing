<?php /* SVN: $Id: $ */ ?>
<div class="states form space">
  <?php echo $this->Form->create('State',  array('action' => 'add', 'class' => 'form-horizontal'));?>
  <ul class="breadcrumb">
  <li><?php echo $this->Html->link(__l('States'), array('action' => 'index'), array('title' => __l('States')));?><span class="divider">&raquo</span></li>
  <li class="active"><?php echo sprintf(__l('Add %s'), __l('State'));?></li>
  </ul>
  <ul class="nav nav-tabs">
  <li>
  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
  </li>
  <li class="active"><a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a></li>
  </ul>
    <?php
      echo $this->Form->input('country_id',array('empty' => __l('Please Select')));
      echo $this->Form->input('name', array('label' => __l('Name')));
      echo $this->Form->input('is_approved', array('label' => __l('Approved?')));
    ?>
    <div class="form-actions">
      <?php echo $this->Form->submit(__l('Add'));?>
    </div>
     <?php echo $this->Form->end();?>
</div>
