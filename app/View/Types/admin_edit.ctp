<div class="types form space">
  <?php echo $this->Form->create('Type', array('class' => 'form-horizontal'));?>
  <fieldset>
  <ul class="breadcrumb">
    <li><?php echo $this->Html->link(__l('Types'), array('action' => 'index'), array('title' => __l('Types')));?><span class="divider">&raquo</span></li>
    <li class="active"><?php echo sprintf(__l('Edit %s'), __l('Type'));?></li>
  </ul>
  <ul class="nav nav-tabs">
  <li>
  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
  </li>
  <li class="active"><a class="blackc" href="#add_form"><i class="icon-edit"></i><?php echo __l('Edit'); ?></a></li>
  </ul>
      <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#type" class="js-no-pjax"><span><?php echo __l('Type'); ?></span></a></li>
      <li><a data-toggle="tab" href="#type-taxonomy" class="js-no-pjax"><span><?php echo __l('Taxonomy'); ?></span></a></li>
          <?php echo $this->Layout->adminTabs(); ?>
        </ul>
    <div class="tab-content" id="myTabContent">
    <div id="type" class="tab-pane fade in active">
      <?php
      echo $this->Form->input('id');
      echo $this->Form->input('title');
      echo $this->Form->input('description');
      ?>
    </div>
    <div id="type-taxonomy" class="tab-pane fade">
      <?php echo $this->Form->input('Vocabulary.Vocabulary'); ?>
    </div>
    <?php echo $this->Layout->adminTabs(); ?>
    </div>
  </fieldset>
  <div class="clearfix form-actions">
    <div class = "pull-left" ><?php echo $this->Form->submit(__l('Update')); ?></div>
    <div class = "hor-mspace hor-space pull-left" >
    <?php echo $this->Html->link(__l('Cancel'), array('action' => 'index'), array('class' => 'btn')); ?>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>