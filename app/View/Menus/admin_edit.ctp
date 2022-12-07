<div class="menus form space">
  <?php echo $this->Form->create('Menu', array('url' => array('controller' => 'menus', 'action' => 'edit', 'admin' => true),'class' => 'form-horizontal')); ?>
  <fieldset>
    <ul class="breadcrumb">
      <li><?php echo $this->Html->link(__l('Menus'), array('action' => 'index'), array('title' => __l('Menus')));?><span class="divider">&raquo</span></li>
      <li class="active"><?php echo sprintf(__l('Edit %s'), __l('Menu'));?></li>
    </ul>
    <ul class="nav nav-tabs">
      <li>
        <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'menus', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
      </li>
      <li class="active"><a class="blackc" href="#add_form"><i class="icon-edit"></i><?php echo __l('Edit');?></a></li>
    </ul>
    <div class="panel-container">
      <div id="add_form" class="tab-pane fade in active">
        <div id="menu-basic" class="clearfix">
          <?php
            echo $this->Form->input('id');
            echo $this->Form->input('title');
            echo $this->Form->input('alias');
          ?>
        </div>
        <div class="form-actions">
          <div class = "pull-left" >
            <?php echo $this->Form->submit(__l('Update')); ?>
          </div>
          <div class = "hor-mspace hor-space pull-left" >
            <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'menus', 'action' => 'index'), array('title' => __l('Cancel'), 'class' => 'btn', 'escape' => false)); ?>
          </div>
        </div>
      </div>
    </div>
  </fieldset>
  <?php echo $this->Form->end(); ?>
</div>