<?php /* SVN: $Id: admin_edit.ctp 4657 2010-12-07 12:52:49Z siva_063at09 $ */ ?>
<div class="transactionTypes form space">
  <?php echo $this->Form->create('TransactionType', array('class' => 'form-horizontal form-large-fields'));?>
  <fieldset>
  <ul class="breadcrumb">
  <li><?php echo $this->Html->link(__l('Transaction Types'), array('action' => 'index'), array('title' => __l('Transaction Types')));?><span class="divider">&raquo</span></li>
  <li class="active"><?php echo sprintf(__l('Edit %s'), __l('Transaction Type'));?></li>
  </ul>
  <ul class="nav nav-tabs">
  <li>
  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
  </li>
  <li class="active"><a class="blackc" href="#add_form"><i class="icon-edit"></i><?php echo __l('Edit'); ?></a></li>
  </ul>
  <?php
    echo $this->Form->input('id');
    echo $this->Form->input('name', array('label'=>__l('Name')));
    echo $this->Form->input('message', array('label'=>__l('Message')));
    echo $this->Form->input('message_for_admin', array('label'=>__l('Message for admin')));
    if(!empty($this->request->data['TransactionType']['message_for_receiver'])){
    echo $this->Form->input('message_for_receiver', array('label'=>__l('Message for receiver')));
    }
  ?>
  </fieldset>
  <div class="form-actions">
    <div class="pull-left"> <?php echo $this->Form->submit(__l('Update')); ?></div>
    <div class="hor-mspace hor-space pull-left">
    <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'transaction_types', 'action' => 'index'), array('title' => __l('Cancel'), 'class' => 'btn', 'escape' => false)); ?>
    </div>
  </div>
  <?php echo $this->Form->end();?>
</div>