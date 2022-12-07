<?php /* SVN: $Id: admin_add.ctp 1456 2010-04-28 08:53:26Z vinothraja_091at09 $ */ ?>
<?php echo $this->Form->create('User', array('class' => 'space form-horizontal form-large-fields'));?>
<fieldset>
  <ul class="breadcrumb">
  <li><?php echo $this->Html->link(__l('Users'), array('action' => 'index'), array('title' => __l('Users')));?><span class="divider">&raquo</span></li>
  <li class="active"><?php echo sprintf(__l('Add %s'), __l('User'));?></li>
  </ul>
  <ul class="nav nav-tabs">
  <li>
  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'users', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
  </li>
  <li class="active"><a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add');?></a></li>
  </ul>
  <div class="panel-container">
  <div id="add_form" class="tab-pane fade in active">
  <?php
  echo $this->Form->input('role_id');
  echo $this->Form->input('email');
  echo $this->Form->input('username');
  echo $this->Form->input('passwd', array('label' => __l('Password')));
  ?>
  </div>
  <div id="list_form" class="tab-pane fade in active">
  </div>
  </div>
</fieldset>
<div class="form-actions">
  <div class="submit"><?php echo $this->Form->end(__l('Add'));?></div>
</div>